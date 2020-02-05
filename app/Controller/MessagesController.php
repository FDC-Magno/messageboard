<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 */
class MessagesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeFilter()
	{
		// $this->Auth->allow();
	}
}
