<?php
namespace Example\Site;

class Routes extends \Dsc\Routes\Group
{

    public function initialize()
    {
        $this->setDefaults(array(
            'namespace' => '\Example\Site\Controllers',
            'url_prefix' => ''
        ));
        
        $this->add('/', 'GET', array(
            'controller' => 'Home',
            'action' => 'index'
        ));
        
        $this->add('/payload', 'GET|POST', array(
        		'controller' => 'Home',
        		'action' => 'payload'
        ));
        
        $this->add('/pi', 'GET', array(
        		'controller' => 'Home',
        		'action' => 'pi'
        ));
        
        $this->add('/demo1', 'GET', array(
        		'controller' => 'Home',
        		'action' => 'demo1'
        ));
        $this->add('/demo2', 'GET', array(
        		'controller' => 'Home',
        		'action' => 'demo2'
        ));
        
        $this->add('/alert/@id', 'GET', array(
        		'controller' => 'Home',
        		'action' => 'alert'
        ));
        $this->add('/remove/@id', 'GET', array(
        		'controller' => 'Home',
        		'action' => 'remove'
        ));
    }
}