<?php
/*
The Convention would be to name the main application for your site here in the app.

So you would have a main app, apps/Sitename/

*/
class ExampleBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Example';

     protected function runSite()
    {   $f3 = \Base::instance();

        \Dsc\System::instance()->get('router')->mount( new \Example\Site\Routes );
        \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Site/Views/', 'Example/Site/Views' );
         

        parent::runSite();
    }
     protected function runAdmin()
    {   $f3 = \Base::instance();
        \Dsc\System::instance()->get('router')->mount( new \Example\Admin\Routes );
         \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Admin/Views/', 'Example/Admin/Views' );
         

        parent::runAdmin();
        
    }
}
$app = new ExampleBootstrap();