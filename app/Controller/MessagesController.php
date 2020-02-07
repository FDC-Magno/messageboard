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

	public function beforeFilter()
	{
		parent::beforeFilter();
		// $this->Auth->allow();
	}

}
