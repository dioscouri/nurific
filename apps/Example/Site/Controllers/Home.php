<?php
namespace Example\Site\Controllers;

class Home extends \Dsc\Controller
{

    public function index()
    {
        echo $this->theme->render('Example/Site/Views::home/index.php');
    }
}
