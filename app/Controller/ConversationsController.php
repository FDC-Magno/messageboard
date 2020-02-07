<?php
App::uses('AppController', 'Controller');
/**
 * Conversations Controller
 */
class ConversationsController extends AppController {
	public $uses = array('Message', 'Conversation');
/**
 * Scaffold
 *
 * @var mixed
 */

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

	public function view()
	{
		$conversationId = $this->request->params['id'];

		$conversation = $this->Conversation->findById($conversationId);

		$this->set(compact('conversation'));
	}

	public function add(){
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		if ($this->request->is('post')) {
			$this->Message->create();
			if($this->Message->save($this->request->data)){
				$id = $this->Message->getLastInsertID();
				$message = $this->Message->findById($id, array('recursive' => '0'));
				// $this->response->type('application/json');
				// $this->response->body(json_encode($message));
				// return $this->response->send();
				return json_encode($message);
			}else{
				$this->set(array('message' => 'Error has occured'));
			}
		}
	}
}
