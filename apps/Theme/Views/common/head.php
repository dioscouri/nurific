<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo $SCHEME . "://" . $HOST . $BASE . "/"; ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo $this->app->get('meta.keywords'); ?>" />
	<meta name="description" content="<?php echo $this->app->get('meta.description'); ?>" />
	<meta name="generator" content="<?php echo $this->app->get('meta.generator'); ?>" />
	<meta name="author" content="">


    <link href="/minify/css" rel="stylesheet">
    <script src="/minify/js"></script>

    <title><?php echo $this->app->get('meta.title'); ?></title>

</head>