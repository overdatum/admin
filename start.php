<?php

// --------------------------------------------------------------
// Load helpers
// --------------------------------------------------------------
require __DIR__.DS.'helpers'.EXT;

// --------------------------------------------------------------
// Map the Base Controller
// --------------------------------------------------------------
Autoloader::map(array(
	'Layla_Base_Controller' => __DIR__.DS.'controllers'.DS.'base'.EXT,
));

// --------------------------------------------------------------
// Load namespaces
// --------------------------------------------------------------
Autoloader::namespaces(array(
	'Admin' => __DIR__
));

// --------------------------------------------------------------
// Load controllers
// --------------------------------------------------------------
Route::controller(array(
	'layla_admin::account',
	'layla_admin::media',
	'layla_admin::page',
	'layla_admin::auth',
));

// --------------------------------------------------------------
// Load bundles
// --------------------------------------------------------------
Bundle::start('layla_thirdparty_bootsparks');

// --------------------------------------------------------------
// Default Composer
// --------------------------------------------------------------
View::composer('layla_admin::layouts.default', function($view)
{
	$view->shares('url', Config::get('layla.admin.url_prefix').'/');

	Asset::container('header')->add('jquery', 'js/jquery.min.js')
		->add('bootstrap', 'css/bootstrap.css')
		->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
		->add('main', 'css/main.css');
	
	Asset::container('footer')->add('bootstrap', 'js/bootstrap.js');
});