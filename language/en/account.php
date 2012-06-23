<?php

return array(

	'read_multiple' => array(
		'title' => 'Accounts',
		'table' => array(
			'name' => 'name',
			'email' => 'email',
			'roles' => 'roles',
			'no_search_results' => 'No accounts have been found, try a broader search criteria',
			'no_results' => 'There are no accounts yet, add one!'
		),
		'buttons' => array(
			'add' => 'Add account'
		)
	),
	
	'create' => array(
		'title' => 'Create Account',
		'form' => array(
			'name' => 'Name',
			'email' => 'E-mail address',
			'password' => 'Password',
			'roles' => 'Roles',
			'language' => 'Language'
		),
		'buttons' => array(
			'add' => 'Add account'
		)
	),
	
	'update' => array(
		'title' => 'Edit Account',
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
		'message' => 'You are about to delete the account for ":name (:email)". <b>If you do, there is no turning back!</b>',
		'buttons' => array(
			'delete' => 'Delete account',
			'cancel' => 'Nope, I changed my mind'
		)
	)

);