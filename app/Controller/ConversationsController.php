<?php
App::uses('AppController', 'Controller');
/**
 * Conversations Controller
 */
class ConversationsController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeFilter()
	{
		$this->Auth->allow();
	}
}
