<?php
namespace Api\Models;

class Users extends \Users\Models\Users
{
    
    protected function fetchConditions()
    {
        parent::fetchConditions();
        

        $filter_auto_login_token = $this->getState( 'filter.auto_login_token' );
        if (strlen($filter_auto_login_token))
        {
        	$this->setCondition('auto_login.token', (string)$filter_auto_login_token );
        	
        }       
        
                
        return $this;
    }


}