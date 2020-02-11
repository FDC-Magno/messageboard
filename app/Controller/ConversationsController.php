<?php
App::uses('AppController', 'Controller');
/**
 * Conversations Controller
 */
class ConversationsController extends AppController {
	public $uses = array('User', 'Message', 'Conversation');
/**
 * Scaffold
 *
 * @var mixed
 */

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('view', 'add');
	}

	//Getting messages when clicking a conversation and opening chat details
	public function view()
	{
		$conversationId = $this->request->params['id'];
		$conversation = $this->readMessage($conversationId);
		$this->set(compact('conversation'));
	}
	
	public function add(){
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$conversationData = array(
				'sender_id' => $this->request->data['sender_id'],
				'receiver_id' => $this->request->data['receiver_id']
			);
			$conversation = $this->Conversation->findByReceiverId($conversationData['receiver_id']);
			if (empty($conversation)) {
				if ($this->Conversation->save($conversationData)) {
					$messageData = array(
						'user_id' => $this->request->data['sender_id'],
						'message' => $this->request->data['message'],
						'conversation_id' => $this->Conversation->getLastInsertId()
					);
					if ($this->Conversation->Message->save($messageData)) {
						$this->updateUserConversations();
						return json_encode(array(
							'status' => 'ok',
							'url' => Router::url(array('controller' => 'conversations', 'action' => 'view', 'id' => $this->Conversation->getLastInsertId()))
						));
					}
				}
			}
			else{
				$this->updateUserConversations();
				$this->Flash->error("Conversation with {$conversation['Receiver']['name']} already exists");
				return json_encode(array('url' => Router::url(array('controller' => 'users', 'action' => 'welcome'))));
			}
		}
	}

	//delete conversation
	public function delete(){
		$this->request->onlyAllow('ajax');
		$this->layout = false;
		$this->autoRender = false;
		if ($this->request->is(array('delete', 'post'))) {
			$id = $this->request->params['id'];
			if($this->Conversation->delete($id)){
				$this->response->type('application/json');
				$this->response->body(json_encode(array('status' => 'ok')));
				$this->updateUserConversations();
				return $this->response;
			}
		}
	}

	//sets the datetime of the message that is red
	public function readMessage($id){
		$conversation = $this->Conversation->findById($id);
		$date = date('Y-m-d H:i:s');
		foreach ($conversation['Message'] as $key => $message) {
			if ($message['user_id'] != AuthComponent::user('User')['id'] && !$message['read']) {
				$this->Message->id = $message['id'];
				$this->Message->saveField('read', $date);
				$this->Message->clear();
			}
		}
		$this->updateUserConversations();
		return $conversation;
	}

	//updates user's conversation list in session
	public function updateUserConversations(){
		$conversations = $this->User->Conversation->find('all', array('recursive' => '2', 'conditions' => array('Conversation.sender_id' => $this->Auth->user('User')['id'])));
		// var_dump($this->Auth->user('User')['id']);
		$this->Session->write('conversations', compact('conversations'));
	}
}
