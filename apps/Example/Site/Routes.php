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
    }
}