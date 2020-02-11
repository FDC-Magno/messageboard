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

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add', 'signup', 'index');
	}

	public function index(){
		$this->autoRender = false;
		$users = $this->User->find('all', array(
			'conditions' => array(
				'User.name LIKE' => "{$this->request->query['search']}%",
				'User.id !=' => AuthComponent::user('User')['id']
			),
			'recursive' => -1
		));
		$users = Set::extract('/User/.', $users);
		return json_encode($users);
	}

	public function signup()
	{
		// set the signup's layout to user.ctp
		$this->layout = 'user';
		$destination = WWW_ROOT.DS."files".DS."profiles".DS;
		// check if request is post
		Debugger::log($this->request->data);
		if ($this->request->is('post')) {
			$this->User->create();
			// store the whole image data in the $image variable first to prevent overwrite
			$image = $this->request->data['image'];
			$this->request->data['image'] = $this->request->data['image']['name'];

			$this->request->data['email'] = $this->request->data('email');
			$this->request->data['created_ip'] = $this->RequestHandler->getClientIp();
			$this->request->data['modified_ip'] = $this->RequestHandler->getClientIp();
            if ($this->User->save($this->request->data)) {
				// move the uploaded file to profiles folder inside files folder
				move_uploaded_file($image['tmp_name'], $destination . "" . $image['name']);
                $this->Flash->success(__('You have successfully registered.'));
                return $this->redirect(array('action' => 'welcome'));
            }
            $this->Flash->error(__('Unable to add your user.'));
        }

	}

	public function login(){
		// set the signup's layout to user.ctp
		$this->layout = 'user';
		// check if request is post
		if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirectUrl());
		}
		if ($this->request->is('post')) {
			// redirect to home page if the user is already logged in
			// find a matching user with the request data
			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.email' => $this->request->data['email'],
					'User.password' => AuthComponent::password($this->request->data['password'])
				),
				'recursive' => -1
			));
			//log user in if user data is available
			if ($user) {
				if($this->Auth->login($user)){ 
					$this->updateLoginFields();
					$this->Flash->success(__('You have successfully logged in.'));
					return $this->redirect(array('action' => 'welcome'));
				}
			}else{
				return $this->Flash->error(__('Invalid email or password.'));
			}
		}
	}

	//update last login time field when user logs in
	protected function updateLoginFields(){
        $this->User->id = $this->Auth->user('User')['id'];
        $this->User->read();
        $this->User->data['User']['last_login_time'] = date('Y-m-d H:i:s');
        $this->User->save($this->User->data, false);
    }

	/**
	 * FIXED: Get sender data and receiver data from the current user's conversation
	 */
	public function welcome(){
		$conversations = $this->User->Conversation->find('all', array('recursive' => '2', 'conditions' => array('Conversation.sender_id' => $this->Auth->user('User')['id'])));
		$this->Session->write('conversations', compact('conversations'));
	}

	public function editPassword(){
		$this->autoRender = false;
		if ($this->request->is('post')) {
			if($this->Auth->user('User')['password'] == AuthComponent::password($this->request->data['current-password'])){
				$this->User->id = $this->Auth->user('User')['id'];
				if($this->User->saveField('password', AuthComponent::password($this->request->data['password']))){
					$this->Flash->success('Password successfully changed');
					return $this->redirect('/');
				}
			}
		}
	}

	public function logout()
	{
		if($this->Auth->user())
		{
			$this->redirect($this->Auth->logout());
		}
		else
		{
			$this->redirect(array('controller'=>'pages','action' => 'display','home'));
			$this->Session->setFlash(__('Not logged in'), 'default', array(), 'auth');
		}
	}

	/**
	 * FIXED(02-11-2020): use user image if the image data field is empty or it is equal to user's image 
	 */
	public function edit(){
		//set autoRender as false to unset default CakePHP layout. This is to prevent our JSON response from mixing with HTML
		$this->autoRender = false; 
		$directory = WWW_ROOT.DS."files".DS."profiles".DS;
		//check if HTTP method is correct for edit
		if($this->request->is('post')){
			//get data from request object
			$data = $this->request->data;			
			//check if product ID was provided
			if(!empty($data['id'])){
				$this->User->recursive = -1;
				$user = $this->User->findById($data['id']);
				$finalData = array_merge($user['User'], $data);
				//set the user ID to update
				$this->User->id = $data['id'];
				$finalData['image'] = $data['image']['name'] == $user['User']['image'] || $data['image']['name'] == '' ? $user['User']['image'] : $data['image']['name'];
				Debugger::log($data['image']['name'] == '');
				if($this->User->save($finalData)){
					$this->Auth->login($this->User->read(null, $this->Auth->User('id')));
					if ($finalData['image'] != $user['User']['image']) {
						move_uploaded_file($data['image']['tmp_name'], $directory.$finalData['image']);
					}
					$this->Flash->success(__('Profile successfully updated'));
					return $this->redirect(array('action' => 'welcome'));
				} else {
					$this->Flash->error(__('Failed to update Profile'));
				}
			} else {
				$this->Flash->error(__('Please provide user ID'));
			}
		}
	}
}
