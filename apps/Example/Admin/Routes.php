<?php
namespace Example\Admin;

class Routes extends \Dsc\Routes\Group
{

    public function initialize()
    {
        $this->setDefaults(array(
            'namespace' => '\Example\Admin\Controllers',
            'url_prefix' => '/admin/example'
        ));
        
        $this->add('', 'GET', array(
            'controller' => 'Home',
            'action' => 'index'
        ));
    }
}