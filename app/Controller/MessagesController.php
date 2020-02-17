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
		$this->Auth->allow('getUpdatedMessages');
	}

	//Adding new messages on database
	public function add() {
		Debugger::log($this->request->data);
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$id = $this->Message->getLastInsertID();
				$this->Message->recursive = 1;
				$conversation = $this->Message->findById($id);
				return json_encode($conversation);
			}
		}
	}

	public function delete($id = null) {
		$this->autoRender = false;
		if ($this->request->is('delete')) {
			if ($this->Message->delete($id)) {
				$message = array('status' => 'ok');
				return json_encode($message);
			}
		}
	}

	//return recent message on a certain conversation using the id
	public function getUpdatedMessages($id = null) {
		$this->autoRender = false;
		//get all messages from database
		$latestMessages = $this->Message->find('all', array(
			'recursive' => '1',
			'order' => array(
				'Message.created' => 'ASC'
			),
			'conditions' => array(
				'Message.conversation_id' => $id,
			)
		));
		return json_encode($this->formatMessageData($latestMessages));
	}

	//get message data based on the selected conversation
	public function getMessages($id = null) {
		$this->autoRender = false;

		$messages = $this->Message->find('all', array(
			'recursive' => '-1', 
			'limit' => '8',
			'offset' => $this->request->query['offset'] * -1,
			'order' => array(
				'Message.created' => 'DESC'
			),
			'conditions' => array(
				'Message.conversation_id' => $id
			)
		));

		return json_encode($this->formatMessageData($messages));
	}

	//format message data
	public function formatMessageData($conversation) {
		if (!empty($conversation)) {
			$messages = array('otherUser' => array(), 'messages' => array(), 'conversation_id' => $conversation[0]['Message']['conversation_id'], 'messages_count' => count($conversation));
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
