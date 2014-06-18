<?php
namespace Example\Admin\Controllers;

class Home extends \Admin\Controllers\BaseAuth
{

    public function index()
    {
        echo $this->theme->render('Example/Admin/Views::home/index.php');
    }
}
