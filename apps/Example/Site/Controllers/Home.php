<?php 
namespace Example\Site\Controllers;

class Home extends \Dsc\Controller 
{    

	 public function index($f3)
    {   
        $f3->set('pagetitle', 'Home');
        $f3->set('subtitle', '');

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Example/Site/Views::home/index.php');
    }

}
