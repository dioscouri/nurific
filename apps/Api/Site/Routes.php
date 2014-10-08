<?php

namespace Api\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){

		$this->setDefaults(
				array(
					'namespace' => '\Api\Site\Controllers',
					'url_prefix' => ''
				)
		);
		
		$this->add( '/signin', 'GET|POST', array(
								'controller' => 'Signin',
								'action' => 'doSignin'
								));
		$this->add( '/signup', 'GET|POST', array(
				'controller' => 'Signup',
				'action' => 'doSignup'
		));
		
		$this->add( '/user/menu', 'GET|POST', array(
				'controller' => 'Menu',
				'action' => 'getMenu'
		));
		
		$this->add( '/user/logout', 'GET|POST', array(
				'controller' => 'Logout',
				'action' => 'doLogout'
		));
		
		$this->add( '/user/avatar', 'GET|POST', array(
				'controller' => 'Avatar',
				'action' => 'saveAvatar'
		));
		
		
	}
}