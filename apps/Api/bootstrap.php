<?php
class ApiBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Api';
	
    protected function runApi()
    {
    	//\Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Userlistener::instance());
    	 
    	\Dsc\System::instance()->get('router')->mount( new \Api\Site\Routes, $this->namespace );
    	
    }
    
    protected function runSite()
    {    

        $f3 = \Base::instance();

      //  \Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Userlistener::instance());
     //  \Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Pusherlistener::instance());
 
        parent::runSite();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }

    protected function runAdmin()
    {   
        $f3 = \Base::instance();
       

        parent::runAdmin();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }


}
$app = new ApiBootstrap();