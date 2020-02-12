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

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('add', 'delete');
	}

	//Adding new messages on database
	public function add(){
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		if ($this->request->is('post')) {
			$this->Message->create();
			if($this->Message->save($this->request->data)){
				$id = $this->Message->getLastInsertID();
				$message = $this->Message->findById($id, array('recursive' => '0'));
				$this->response->type('application/json');
				$this->response->body(json_encode($message));
				return $this->response;
			}
		}
	}

	public function delete(){
		$this->autoRender = false;
		if ($this->request->is('delete')) {
			if ($this->Message->delete($this->request->params['id'])) {
				$message = array('status' => 'ok');
				return json_encode($message);
			}
		}
	}

}
