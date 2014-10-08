<?php

namespace Api\Site\Controllers;

class Auth extends Base {
	
	public function beforeroute() {
		$array = $this->input->getArray ();
		
		if (empty ( $array ['key'] )) {
			\Dsc\Mongo\Collections\Logs::add('KEY WAS EMPTY');
			
			$this->apiError ('Key is required' );
		} else {
			$key = $array ['key'];
			//\Dsc\Mongo\Collections\Logs::add($key);
		}
		
		$actor = (new \Rystband\Models\Users ())->setState ( 'filter.auto_login_token', $key )->getItem ();
		
		if (empty ( $actor->id )) {
			$this->apiError( 'Invalid Key, login again to refresh your key');
			\Dsc\Mongo\Collections\Logs::add('Invalid Key, login again to refresh your key');
		} else {
			$this->app->set ( 'user', $actor );
			return;
		}
			
	}
	
}
