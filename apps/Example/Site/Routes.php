<?php

namespace Example\Site;

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
					'namespace' => '\Example\Site\Controllers',
					'url_prefix' => ''
				)
		);
		$this->add( '/', 'GET', array(
								'controller' => 'Home',
								'action' => 'index'
								));

	}
}