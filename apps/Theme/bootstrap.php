<?php
class ThemeBootstrap extends \Dsc\Bootstrap
{

    protected $dir = __DIR__;

    protected $base = __DIR__;

    protected $namespace = 'Theme';

    /**
     * Register this app's view files for all global_apps
     * 
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
        
        // Tell the admin that this is an available front-end theme
        \Dsc\System::instance()->get('theme')->registerTheme('Theme', $this->app->get('PATH_ROOT') . 'apps/Theme/');
        
        if (class_exists('\Modules\Factory')) 
        {
            // register this theme's module positions with the admin
            \Modules\Factory::registerPositions(array(
                'theme-below-header',
                'theme-above-footer',
                'theme-below-footer',
                'theme-above-content',
                'theme-below-content',
                'theme-left-content',
                'theme-right-content'
            ));
        }
    }

    /**
     * Triggered when the front-end global_app is run
     */
    protected function runSite()
    {
        // link the theme to public folder
        if (!is_dir($this->app->get('PATH_ROOT') . 'public/Theme'))
        {
            $public_theme = $this->app->get('PATH_ROOT') . 'public/Theme';
            $theme_assets = realpath( $this->app->get('PATH_ROOT') . 'apps/Theme/Assets' );
            $res = symlink($theme_assets, $public_theme);
        }
        
        \Dsc\System::instance()->get('theme')->setTheme('Theme', $this->app->get('PATH_ROOT') . 'apps/Theme/');
        \Dsc\System::instance()->get('theme')->registerViewPath($this->app->get('PATH_ROOT') . 'apps/Theme/Views/', 'Theme/Views');
        
        // tell Minify where to find Media, CSS and JS files
        \Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/Theme/");
        \Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/Theme/css/");
        \Minify\Factory::registerPath($this->app->get('PATH_ROOT') . "public/");
        
        // register the less css file
        \Minify\Factory::registerLessCssSource($this->app->get('PATH_ROOT') . "apps/Theme/Less/global.less.css");
        
        // add the media assets to be minified
        $files = array(
            'css/style.css'
        );
        
        foreach ($files as $file)
        {
            \Minify\Factory::css($file);
        }
        
        $files = array(
            'js/script.js'
        );
        
        foreach ($files as $file)
        {
            \Minify\Factory::js($file, array(
                'priority' => 1
            ));
        }
        
        \Dsc\System::instance()->getDispatcher()->addListener(\Theme\Listeners\Error::instance());
        
        parent::runSite();
    }
}
$app = new ThemeBootstrap();
