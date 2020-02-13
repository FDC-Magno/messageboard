<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 */
class MessagesController extends AppController {
	public $uses = array(
		'Message', 'Conversation'
	);
/**
 * Scaffold
 *
 * @var mixed
 */

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	//Adding new messages on database
	public function add() {
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$id = $this->Message->getLastInsertID();
				$this->Message->recursive = 1;
				$message = $this->Message->findById($id);
				$this->response->type('application/json');
				$this->response->body(json_encode($message));
				return $this->response;
			}
		}
	}

	public function delete() {
		$this->autoRender = false;
		if ($this->request->is('delete')) {
			if ($this->Message->delete($this->request->params['id'])) {
				$message = array('status' => 'ok');
				return json_encode($message);
			}
		}
	}

	//get message data based on the selected conversation
	public function getMessages() {
		$this->autoRender = false;

		$messages = $this->Message->find('all', array(
			'recursive' => '-1', 
			'limit' => '8',
			'offset' => $this->request->query['offset'] * -1,
			'order' => array(
				'Message.created' => 'DESC'
			),
			'conditions' => array(
				'Message.conversation_id' => $this->request->params['id']
			)
		));

		return json_encode($this->formatMessageData($messages, $this->request->params['id']));
	}

	//format message data
	public function formatMessageData($conversation, $id) {
		// debug($conversation);
		if (!empty($conversation)) {
			$messages = array('otherUser' => array(), 'messages' => array(), 'conversation_id' => $id);
			$date = date('Y-m-d H:i:s');
			//get the other user data on the conversation
			foreach ($conversation as $key => $message) {
				if ($message['Message']['user_id'] != AuthComponent::user('User')['id']) {
					$messages['otherUser'] = $message['User'];
					break;
				}
			}
			foreach ($conversation as $key => $message) {
				array_push($messages['messages'], array(
					'id' => $message['Message']['id'], 
					'image' => $message['User']['image'],
					'message' => $message['Message']['message'],
					'user_id' => $message['Message']['user_id'],
					'created' => date_format(date_create($message['Message']['created']), 'h:i A')
				));
				if ($message['Message']['user_id'] != AuthComponent::user('User')['id'] && !$message['Message']['read']) {
					$this->Message->id = $message['Message']['id'];
					$this->Message->saveField('read', $date);
					$this->Message->clear();
				}
			} 
			
			return $messages;
		}
		return false;
	}

}
