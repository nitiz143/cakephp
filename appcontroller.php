<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	//Function 'checkAdminSession' for admin check in controller
	function checkAdminSession(){
		// if the admin session hasn't been set
		if(!$this->Session->read('User.is_admin')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area','default',array('class' => 'alert alert-danger'));
			$this->redirect('/admin');
			exit();
		}
	}
	//Function 'checkCustomerSession' for customer check in controller
	function checkCustomerSession() {	
		// if the customer session hasn't been set
		if(!$this->Session->read('Customer')){
			// set flash message and redirect
			$this->Session->setFlash('You need to be logged in to access this area','default',array('class' => 'alert alert-danger'));
			$this->redirect('/');
			exit();
		}
	}
	
	//Function 'callConstants' to define constants
	function callConstants()	{
		app::import('Model','Config');
		$this->Config = new Config();
		$configs = $this->Config->find('first');
		foreach($configs['Config'] as $key => $value){
			if(!defined(strtoupper($key))) 
				define(strtoupper($key), $value);
		}

	}
}
