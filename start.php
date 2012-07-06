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

$admin_prefix = Config::get('layla.admin.url_prefix') ? Config::get('layla.admin.url_prefix').'/' : '';

Route::get($admin_prefix.'page/(:any)/translate/(:any)', 'admin::page@translate');
Route::put($admin_prefix.'page/(:any)/translate/(:any)', 'admin::page@translate');

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
	->add('home', 'Home', null, array('class' => 'menu-icon-home'))
	->add('pages', 'Pages', null, array('class' => 'menu-icon-pages'))
	->add('layouts', 'Layouts', null, array('class' => 'menu-icon-layouts'))
	->add('media', 'Media', null, array('class' => 'menu-icon-media'))
	->add('accounts', 'Accounts', null, array('class' => 'menu-icon-accounts'))
	->add('settings', 'Settings', null, array('class' => 'menu-icon-settings'))
	->add('#', '', null, array('class' => 'logo'))
	->add('profile', 'Profile', null, array('class' => 'menu-icon-profile'));

// --------------------------------------------------------------
// Registering forms and pages
// --------------------------------------------------------------
Artifact::register('page', 'account.read_multiple', 'admin::account@read_multiple');
Artifact::register('page', 'account.create', 'admin::account@create');
Artifact::register('page', 'account.update', 'admin::account@update');
Artifact::register('page', 'account.delete', 'admin::account@delete');

Artifact::register('page', 'page.read_multiple', 'admin::page@read_multiple');
Artifact::register('page', 'page.create', 'admin::page@create');
Artifact::register('page', 'page.update', 'admin::page@update');
Artifact::register('page', 'page.translate', 'admin::page@translate');
Artifact::register('page', 'page.delete', 'admin::page@delete');

Artifact::register('page', 'media.read_multiple', 'admin::media@read_multiple');
Artifact::register('page', 'media.group.read_multiple', 'admin::media.group@read_multiple');
Artifact::register('page', 'media.group.asset.read_multiple', 'admin::media.group.asset@read_multiple');