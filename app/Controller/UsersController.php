<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 */
class UsersController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeFilter()
	{
		$this->Auth->allow('add', 'welcome', 'signup');
	}

	public $components = array(
		'RequestHandler'
	);

	public function signup()
	{
		$this->layout = 'user';

		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['email'] = $this->request->data('email');
			$this->request->data['User']['created_ip'] = $this->RequestHandler->getClientIp();
			$this->request->data['User']['modified_ip'] = $this->RequestHandler->getClientIp();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('You have successfully registered.'));
                return $this->redirect(array('action' => 'welcome'));
            }
            $this->Flash->error(__('Unable to add your user.'));
        }

	}

	public function login(){
		$this->layout = 'user';
		if ($this->request->is('post')) {
			$user = $this->User->find('first', array(
				'condition' => array(
					'email' => $this->request->data['Users']['email'],
					'password' => $this->request->data['Users']['password']
				)
			));
			if ($user) {
				$this->Auth->login($user);
				$this->Flash->success(__('You have successfully logged in.'));
                return $this->redirect(array('action' => 'welcome'));
			}
		}
	}

	public function welcome()
	{
		$user = $this->Auth->user();

		$this->set(compact('user'));
	}

	

}
