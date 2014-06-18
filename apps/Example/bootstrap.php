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
}
$app = new ExampleBootstrap();