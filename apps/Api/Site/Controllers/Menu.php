<?php

namespace Api\Site\Controllers;

class Menu extends Auth {
	
	public function getMenu() {

		$array = $this->getInputs();
		
		$user = $this->app->get ( 'user');
		
		$results = $this->app->get('results');
		
		
		//do some ACL LOGIN etc to build a menu based on this user and the optional event
		$menu = array();
		$menu[] = array('title' => 'Profile', 'http://ryst.cc/user');
		$menu[] = array('title' => 'Wristbands', 'http://ryst.cc/user/wristbands');
		
		$results['result'] = $menu;
		
		
		$this->app->set('results', $results);
		
		
		
		
	}
	
}
