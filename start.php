<?php

// --------------------------------------------------------------
// Load helpers
// --------------------------------------------------------------
require __DIR__.DS.'helpers'.EXT;

// --------------------------------------------------------------
// Map the Base Controller
// --------------------------------------------------------------
Autoloader::map(array(
	'Admin_Base_Controller' => __DIR__.DS.'controllers'.DS.'base'.EXT,
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
	'admin::account',
	'admin::media',
	'admin::page',
	'admin::auth',
));

// --------------------------------------------------------------
// Load bundles
// --------------------------------------------------------------
Bundle::start('thirdparty_bootsparks');
Bundle::start('thirdparty_menu');

// --------------------------------------------------------------
// Obtain the url prefix
// --------------------------------------------------------------
$url_prefix = Config::get('layla.admin.url_prefix');

// --------------------------------------------------------------
// Default Composer
// --------------------------------------------------------------
View::composer('admin::layouts.default', function($view) use ($url_prefix)
{
	$view->shares('url', $url_prefix . '/');

	Asset::container('header')->add('jquery', 'js/jquery.min.js')
		->add('bootstrap', 'css/bootstrap.css')
		->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
		->add('main', 'css/main.css');
	
	Asset::container('footer')->add('bootstrap', 'js/bootstrap.js');
});

// --------------------------------------------------------------
// Adding menu items
// --------------------------------------------------------------
Menu::container('main', $url_prefix)
	->add('account', 'Accounts')
	->add('page', 'Pages');


// --------------------------------------------------------------
// Registering forms and pages
// --------------------------------------------------------------
Module::register('form', 'account.edit', 'admin::account.edit@form');
Module::register('page', 'account.edit', 'admin::account@edit');