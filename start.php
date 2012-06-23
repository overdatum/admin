<?php

use Layla\API;

// --------------------------------------------------------------
// Load helpers
// --------------------------------------------------------------
require __DIR__.DS.'helpers'.EXT;

// --------------------------------------------------------------
// Register the Base Controller
// --------------------------------------------------------------
Autoloader::map(array(
	'Admin_Base_Controller' => __DIR__.DS.'controllers'.DS.'base'.EXT,
));

// --------------------------------------------------------------
// Register namespaces
// --------------------------------------------------------------
Autoloader::namespaces(array(
	'Admin' => __DIR__
));

// --------------------------------------------------------------
// Register controllers
// --------------------------------------------------------------

Route::pages(Config::get('routes'), 'admin', Config::get('layla.admin.url_prefix'));

// --------------------------------------------------------------
// Start bundles
// --------------------------------------------------------------
Bundle::start('thirdparty_bootsparks');
Bundle::start('thirdparty_menu');

// --------------------------------------------------------------
// Default Composer
// --------------------------------------------------------------
View::composer('admin::layouts.default', function($view)
{
	$view->shares('url', prefix('admin').'/');

	Asset::container('header')->add('jquery', 'js/jquery.min.js')
		->add('bootstrap', 'bootstrap/css/bootstrap.css')
		//->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
		->add('main', 'html/layla.css');
	
	Asset::container('footer')->add('bootstrap', 'js/bootstrap.js');
});

// --------------------------------------------------------------
// Adding menu items
// --------------------------------------------------------------
Menu::handler('main')
	->add('home', 'Home', null, array('class' => 'icon-home'))
	->add('pages', 'Pages', null, array('class' => 'icon-pages'))
	->add('media', 'Media', null, array('class' => 'icon-media'))
	->add('accounts', 'Accounts', null, array('class' => 'icon-accounts'))
	->add('settings', 'Settings', null, array('class' => 'icon-settings'))
	->add('#', '', null, array('class' => 'logo'))
	->add('profile', 'Profile', null, array('class' => 'icon-profile'));

// --------------------------------------------------------------
// Registering forms and pages
// --------------------------------------------------------------
Module::register('page', 'account.read_multiple', 'admin::account@read_multiple');
Module::register('page', 'account.create', 'admin::account@create');
Module::register('form', 'account.create', 'admin::account@create');
Module::register('page', 'account.update', 'admin::account@update');
Module::register('form', 'account.update', 'admin::account@update');
Module::register('page', 'account.delete', 'admin::account@delete');
Module::register('form', 'account.delete', 'admin::account@delete');

Module::register('page', 'page.read_multiple', 'admin::page@read_multiple');
Module::register('page', 'page.create', 'admin::page@create');
Module::register('form', 'page.create', 'admin::page@create');
Module::register('page', 'page.update', 'admin::page@update');
Module::register('form', 'page.update', 'admin::page@update');
Module::register('page', 'page.delete', 'admin::page@delete');
Module::register('form', 'page.delete', 'admin::page@delete');

Module::register('page', 'media.read_multiple', 'admin::media@read_multiple');
Module::register('page', 'media.group.read_multiple', 'admin::media.group@read_multiple');
Module::register('page', 'media.group.asset.read_multiple', 'admin::media.group.asset@read_multiple');