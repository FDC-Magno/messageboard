<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'users', 'action' => 'welcome'));
	Router::connect('/home', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/users/editPassword', array('controller' => 'users', 'action' => 'editPassword'));
	Router::connect('/getConversations', array('controller' => 'conversations', 'action' => 'getConversations'));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/users/index/search?', array('controller' => 'users', 'action' => 'index'));
	Router::connect('/chat/:id', array('controller' => 'conversations', 'action' => 'view'), array('pass' => array('id')));
	Router::connect('/messages/add', array('controller' => 'messages', 'action' => 'add'));
	Router::connect('/messages/:id/getUpdatedMessages', array('controller' => 'messages', 'action' => 'getUpdatedMessages'), array('pass' => array('id')));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));
	Router::connect('/welcome', array('controller' => 'users', 'action' => 'welcome'));
	Router::connect('/conversations/:id/delete', array('controller' => 'conversations', 'action' => 'delete'), array('pass' => array('id')));
	Router::connect('/messages/:id/delete', array('controller' => 'messages', 'action' => 'delete'), array('pass' => array('id')));
	Router::connect('/:id/getMessages', array('controller' => 'messages', 'action' => 'getMessages'), array('pass' => array('id')));
	Router::connect('/conversations/add', array('controller' => 'conversations', 'action' => 'add'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::parseExtensions('json'); 

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
