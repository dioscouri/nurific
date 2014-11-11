<?php
//AUTOLOAD all your composer libraries now.
(@include_once (__dir__ . '/../vendor/autoload.php')) OR die("You need to run php composer.phar install for your application to run.");

$app = Base::instance();

$app->set('PATH_ROOT', __dir__ . '/../');
$app->set('AUTOLOAD', $app->get('PATH_ROOT') . 'lib/;' . $app->get('PATH_ROOT') . 'apps/;');

//AUTOLOAD all your composer libraries now. 
(@include_once ($app->get('PATH_ROOT') . 'vendor/autoload.php')) OR die("You need to run php composer.phar install for your application to run.");

$app->set('APP_NAME', 'site');
if (strpos(strtolower($app->get('URI')), $app->get('BASE') . '/admin') !== false)
{
    $app->set('APP_NAME', 'admin');
}

// common config
$app->config($app->get('PATH_ROOT') . 'config/common.config.ini');

$logger = new \Log($app->get('application.logfile'));
\Registry::set('logger', $logger);

if ($app->get('DEBUG'))
{
    ini_set('display_errors', 1);
}

// bootstap each mini-app
\Dsc\Apps::instance()->bootstrap();

// load routes
\Dsc\System::instance()->get('router')->registerRoutes();

// trigger the preflight event
\Dsc\System::instance()->preflight();

$app->run();
