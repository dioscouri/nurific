<?php

namespace Api\Site\Controllers;

class Base extends \Dsc\Controller {
	
	public function getInputs() {
		$array = (array) json_decode( file_get_contents('php://input') );
	
		if(empty($array)) {
			$array = $this->input->getArray();
	
		}
		return $array;
	
	}

	
	public function  afterroute() {
		echo $this->outputJson ( $this->getJsonResponse ( $this->app->get('results') ) );
	}
	
	public function apiError($message, $code = 400) {
		echo $this->outputJson ( $this->getJsonResponse ( array (
				'message' => $message,
				'code' => $code
		) ) );
		die ();
	}
	
}
