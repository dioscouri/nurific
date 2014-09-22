<?php
/**
 * The Convention would be to name the main application for your site here in the app.
 *
 * So you would have a main app, apps/Sitename/
 */
class ExampleBootstrap extends \Dsc\Bootstrap
{

    protected $dir = __DIR__;

    protected $namespace = 'Example';
    
     /**
     * Register this app's view files for all global_apps
     * @param string $global_app
     */
    protected function registerViewFiles($global_app)
    {
    	\Dsc\System::instance()->get('theme')->registerViewPath($this->dir . '/' . $global_app . '/Views/', $this->namespace . '/' . $global_app . '/Views');
    }
}
$app = new ExampleBootstrap();
