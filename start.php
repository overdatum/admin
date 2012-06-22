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

Route::get('manage/media/module/(:num)/group/(:num)', 'admin::media@group');

Route::controller(array(
	'admin::accounts',
	'admin::module',
	'admin::media',
	'admin::pages',
	'admin::auth',
));


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
Module::register('page', 'account.index', 'admin::account@index');
Module::register('page', 'account.add', 'admin::account@add');
Module::register('form', 'account.add', 'admin::account@add');
Module::register('page', 'account.edit', 'admin::account@edit');
Module::register('form', 'account.edit', 'admin::account@edit');
Module::register('page', 'account.delete', 'admin::account@delete');
Module::register('form', 'account.delete', 'admin::account@delete');

Module::register('page', 'page.index', 'admin::page@index');
Module::register('page', 'page.add', 'admin::page@add');
Module::register('form', 'page.add', 'admin::page@add');
Module::register('page', 'page.edit', 'admin::page@edit');
Module::register('form', 'page.edit', 'admin::page@edit');
Module::register('page', 'page.delete', 'admin::page@delete');
Module::register('form', 'page.delete', 'admin::page@delete');

Module::register('page', 'media.index', 'admin::media@index');
Module::register('page', 'media.groups', 'admin::media@groups');
Module::register('page', 'media.assets', 'admin::media@assets');