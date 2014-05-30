<?php
class ThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $base = __DIR__;
    protected $namespace = 'Theme';
    
    /**
     * Register this app's view files for all global_apps
     * @param string $global_app
     */
    protected function registerViewFiles($global_app)
    {
        \Dsc\System::instance()->get('theme')->registerViewPath($this->dir . '/' . $global_app . '/Views/', $this->namespace . '/' . $global_app . '/Views');
    }

    /**
     * Triggered when the admin global_app is run
     */
    protected function runAdmin()
    {
        parent::runAdmin();

        $f3 = \Base::instance();
        
        // Tell the admin that this is an available front-end theme
        \Dsc\System::instance()->get('theme')->registerTheme('Theme', $f3->get('PATH_ROOT') . 'apps/Theme/' );
        
        // register this theme's module positions with the admin
        \Modules\Factory::registerPositions( array('theme-below-header', 'theme-above-footer', 'theme-below-footer', 'theme-above-content', 'theme-below-content', 'theme-left-content', 'theme-right-content') );
    }

    /**
     * Triggered when the front-end global_app is run
     */
    protected function runSite()
    {
        parent::runSite();
         $f3 = \Base::instance();

        if(!is_dir($f3->get('PATH_ROOT').'public/theme')) {
            $publictheme = $f3->get('PATH_ROOT').'public/theme';
            $admintheme = $f3->get('PATH_ROOT').'apps/theme/Assets';
            $res = symlink( $admintheme, $publictheme );
        }


       

        \Dsc\System::instance()->get('theme')->setTheme('Theme', $f3->get('PATH_ROOT') . 'apps/Theme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT') . 'apps/Theme/Views/', 'Theme/Views' );

        // tell Minify where to find Media, CSS and JS files
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/theme/");
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/theme/css/");
        \Minify\Factory::registerPath($f3->get('PATH_ROOT') . "public/");
        
        // register the less css file
        \Minify\Factory::registerLessCssSource( $f3->get('PATH_ROOT') . "apps/Theme/Less/global.less.css" );

        // add the media assets to be minified
        $files = array(
             'css/style.css',
        );

        foreach ($files as $file)
        {
            \Minify\Factory::css($file);
        }

        $files = array(
            'js/script.js',
        );

        foreach ($files as $file)
        {
            \Minify\Factory::js($file, array('priority' => 1));
        }
        
        \Dsc\System::instance()->getDispatcher()->addListener(\Theme\Listeners\Error::instance());
    }
}
$app = new ThemeBootstrap();