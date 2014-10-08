<?php

namespace Api\Site\Controllers;

class Avatar extends Auth {
	
	public function SaveAvatar() {

		$array = $this->getInputs();
		
		$user = $this->app->get ( 'user');
		
		$results = $this->app->get('results');
		
		
		
		
		//DEBUGGING
		\Dsc\Mongo\Collections\Logs::add('Avatar method was called from user ' .$user->fullName());
		 		 
		//TODO Should we delete the previous avatar?
		if(!empty($_FILES['avatar'])) {
			\Dsc\Mongo\Collections\Logs::add('Image found');
			//todo more width/height to settings
			$_FILES['avatar']['name'] = $user->fullName() . "'s Avatar";
			
			$avatar = \Users\Models\Avatars::createFromUpload($_FILES['avatar'], array('width'=>200, 'height'=>200, 'tags' =>array($user->id, $user->fullName()) ));
			$user->set('avatar.slug', $avatar->{'slug'});
			$user->save();
		
			$results['result'] = array('slug' => '/asset/thumb/'. $avatar->{'slug'});
		
			\Dsc\Mongo\Collections\Logs::add($avatar->{'slug'} . ' returned via json');
		} else {
			\Dsc\Mongo\Collections\Logs::add(' FILES[avatar] IS EMPTY');
			
			$results['code'] = 400;
			$results['message'] = '$_FILES[\'avatar\'] superglobal is empty, either you input was in correct or you did not send a file.';
			$results['result'] = array();
			
		}
		
	
		
		$this->app->set('results', $results);
		
		
		
	}
	
}
