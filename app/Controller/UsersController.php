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

	public $components = array(
		'RequestHandler'
	);

	public function signup()
	{
		// set the signup's layout to user.ctp
		$this->layout = 'user';
		$destination = WWW_ROOT.DS."files".DS."profiles".DS;
		// check if request is post
		if ($this->request->is('post')) {
			$this->User->create();
			// store the whole image data in the $image variable first to prevent overwrite
			$image = $this->request->data['User']['image'];
			$this->request->data['User']['image'] = $this->request->data['User']['image']['name'];

			$this->request->data['User']['email'] = $this->request->data('email');
			$this->request->data['User']['created_ip'] = $this->RequestHandler->getClientIp();
			$this->request->data['User']['modified_ip'] = $this->RequestHandler->getClientIp();
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
					'User.email' => $this->request->data['Users']['email'],
					'User.password' => AuthComponent::password($this->request->data['Users']['password'])
				)
			));
			//log user in if user data is available
			if ($user) {
				$this->Auth->login($user);
				$this->Flash->success(__('You have successfully logged in.'));
                return $this->redirect(array('action' => 'welcome'));
			}else{
				return $this->Flash->error(__('Invalid email or password.'));
			}
		}
	}

	public function welcome(){

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
	 * TODO: File upload and page redirection
	 */
	public function edit(){
		//set layout as false to unset default CakePHP layout. This is to prevent our JSON response from mixing with HTML
		$this->layout = false; 
		$directory = WWW_ROOT.DS."files".DS."profiles".DS;
		//set default response
		$response = array('status'=>'failed', 'message'=>'HTTP method not allowed');
		
		//check if HTTP method is correct for edit
		if($this->request->is('post')){
			//get data from request object
			$data = $this->request->data;			
			//check if product ID was provided
			if(!empty($data['id'])){
				//set the product ID to update
				$user = $this->User->findById($data['id']);
				$finalData = array_merge($user['User'], $data);
				$this->User->id = $data['id'];
				$finalData['image'] = $data['image']['name'];
				// var_dump($data);
				var_dump($finalData);
				// var_dump($this->User->id);
				// var_dump($this->User->validationErrors);
				if($this->User->save($finalData)){
					$this->Auth->login($this->User->read(null, $this->Auth->User('id')));
					move_uploaded_file($data['image']['tmp_name'], $directory.$finalData['image']);
					$response = array('status'=>'success','message'=>'Profile successfully updated');
				} else {
					$response['message'] = "Failed to update Profile";
				}
			} else {
				$response['message'] = 'Please provide user ID';
			}
		}
			
		$this->response->type('application/json');
		$this->response->body(json_encode($response));
		return $this->response->send();
	}

	public function index(){
		$this->layout = false;
		$user = $this->User->find('all');
		$this->response->type('application/json');
		$this->response->body(json_encode($user));
		return $this->response->send();
	}
}
