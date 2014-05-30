<?php
namespace Theme\Listeners;

class Error extends \Dsc\Singleton
{
    public function onError( $event )
    {
        $f3 = \Base::instance();
        
        if ($f3->get('ERROR.code') == '404')
        {
            if ($f3->get('APP_NAME') == 'site') 
            {
                $response = $event->getArgument('response');
                
                $html = \Dsc\System::instance()->get('theme')->renderView('Theme\Views::404.php');
                
                $response->action = 'html';
                $response->html = $html;
                 
                $event->setArgument('response', $response);                
            }
        }
    }
}