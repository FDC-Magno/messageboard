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
		$this->Auth->allow('view', 'add', 'getConversations');
	}

	//Getting messages when clicking a conversation and opening chat details
	//FIXED(Jann 02/12/2020): redirect if conversation does not exist
	public function view()
	{
		$conversationId = $this->request->params['id'];
		//checks if conversation exist with the conversationId
		if ($this->readMessage($conversationId)) {
			$conversation = $this->readMessage($conversationId);
			$this->set(compact('conversation'));
		}
		else {
			return $this->redirect(Router::url(array('controller' => 'users', 'action' => 'welcome')));
		}
	}
	// FIXED(Jann 02/12/2020): duplicate conversations 
	public function add(){
		$this->autoRender = false;
		if ($this->request->is('post')) {
			if ($this->addToDatabase($this->request->data)) {
				return json_encode(array(
					'status' => 'ok',
					'url' => Router::url(array('controller' => 'conversations', 'action' => 'view', 'id' => $this->Conversation->getLastInsertId()))
				));
			}
			else{
				$this->Flash->error("Conversation already exists");
				return json_encode(array('url' => Router::url(array('controller' => 'users', 'action' => 'welcome'))));
			}
		}
	}

	//delete conversation
	public function delete(){
		$this->request->onlyAllow('ajax');
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

	public function addToDatabase($data) {
		$conversationData = array(
			'sender_id' => $data['sender_id'],
			'receiver_id' => $data['receiver_id']
		);
		$conversation = $this->Conversation->findByReceiverId($data['receiver_id']);
		if (empty($conversation)) {
			if ($this->Conversation->save($conversationData)) {
				$messageData = array(
					'user_id' => $data['sender_id'],
					'message' => $data['message'],
					'conversation_id' => $this->Conversation->getLastInsertId()
				);
				if ($this->Conversation->Message->save($messageData)) {
					$this->updateUserConversations();
					return true;
				}
			}
		}
		return false;
	}

	//sets the datetime of the message that is red
	public function readMessage($id){
		$this->Conversation->recursive = 2;
		if ($this->Conversation->findById($id)) {
			$conversation = $this->Conversation->findById($id);
			$date = date('Y-m-d H:i:s');
			foreach ($conversation['Message'] as $key => $message) {
				if ($message['user_id'] != AuthComponent::user('User')['id'] && !$message['read']) {
					$this->Message->id = $message['id'];
					$this->Message->saveField('read', $date);
					$this->Message->clear();
				}
			}
			return $conversation;
		}
		return false;
	}

	//updates user's conversation list in session
	public function updateUserConversations(){
		$conversations = $this->User->Conversation->find('all', array(
			'recursive' => '2', 
			'conditions' => array(
				'or' => array(
					'Conversation.receiver_id' => $this->Auth->user('User')['id'],
					'Conversation.sender_id' => $this->Auth->user('User')['id']
				),
				'order' => array('Conversation.created' => 'DESC'),
				'limit' => 8
			)
		));
		$this->Session->write('conversations', compact('conversations'));
	}

	//get data for infinite scrolling
	public function getConversations() {
		$this->autoRender = false;
		$conversation = $this->User->Conversation->find('all', array(
			'recursive' => '2', 
			'conditions' => array(
				'or' => array(
					'Conversation.receiver_id' => $this->Auth->user('User')['id'],
					'Conversation.sender_id' => $this->Auth->user('User')['id']
				)
			),
			'order' => array('Conversation.created' => 'DESC'),
			'limit' => 8,
			'offset' => $this->request->query('offset')
		));
		// return json_encode($conversation);
		return json_encode($this->formatData($conversation));
	}

	//format data before sending it to client
	public function formatData($conversations)
	{
		$data = array();
		foreach ($conversations as $key => $conversation) {
			$temp = '';
			$temp = array(
				'id' => $conversation['Conversation']['id'],
				'image' => $conversation['Sender']['id'] == $this->Auth->user('User')['id'] ? $conversation['Receiver']['image'] : $conversation['Sender']['image'],
				'name' => $conversation['Sender']['id'] == $this->Auth->user('User')['id'] ? $conversation['Receiver']['name'] : $conversation['Sender']['name'],
				'message' => $conversation['Sender']['id'] == $this->Auth->user('User')['id'] ? explode(" ", $conversation['Receiver']['name'])[0].": ".$conversation['Message'][count($conversation['Message']) - 1]['message'] : "You: ".$conversation['Message'][count($conversation['Message']) - 1]['message'],
				'created' => $conversation['Sender']['id'] == $this->Auth->user('User')['id'] ? date_format(date_create($conversation['Receiver']['created']), 'H:i A') : $conversation['Sender']['created'],
			);

			array_push($data, $temp);
		}

		return $data;
	}
}
