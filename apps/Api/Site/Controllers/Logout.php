<?php

namespace Api\Site\Controllers;

class Logout extends Auth {
	
	public function doLogout() {
		
		$array = $this->getInputs();
		
		$user = $this->app->get ( 'user');
		$session = (new \Dsc\Mongo\Collections\Sessions)->setState('filter.user',$user->id )->getItem();
		session_id($session->session_id);
		session_start();
		session_destroy();
		session_commit();
		
		$message = 'Logout out : '.  $user->fullName();
		
		\Dsc\Mongo\Collections\Logs::add($message  . ' ' . $array['key']);
		
		$session->remove();
		
		// 3. hijack then destroy session specified.
		
		$results = $this->app->get('results');
		//$user->set('auto_login.token', '')->save();
	
		$results['result'] = $message ."'s Session Deleted";
		
		
		$this->app->set('results', $results);
				
		
	}
	
}
