<?php
$app = require '../vendor/bcosca/fatfree/lib/base.php';

$app->set('PATH_ROOT', __dir__ . '/../');
$app->set('AUTOLOAD', $app->get('PATH_ROOT') . 'lib/;' . $app->get('PATH_ROOT') . 'apps/;');

require $app->get('PATH_ROOT') . 'vendor/autoload.php';

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