<?php

return array(

	'index' => array(
		'title' => 'Modules',
		'table' => array(
			'name' => 'name',
			'email' => 'email',
			'roles' => 'roles',
			'no_results' => 'There are no accounts yet, add one!'
		),
		'buttons' => array(
			'add' => 'Add module'
		)
	),
	
	'create' => array(
		'title' => 'Create Module',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'create' => 'Create module'
		)
	),

	'install' => array(
		'title' => 'Create Module',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'install' => 'Add module'
		)
	),
	
	'edit' => array(
		'title' => 'Edit Module',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'edit' => 'Save changes'
		)
	),
	
	'delete' => array(
		'title' => 'Are you sure?',
		'message' => 'You are about to delete the module named ":name". <b>If you do, there is no turning back!</b>',
		'buttons' => array(
			'delete' => 'Delete module',
			'cancel' => 'Nope, I changed my mind'
		)
	)

);