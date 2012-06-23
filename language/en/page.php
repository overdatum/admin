<?php

return array(

	'read_multiple' => array(
		'title' => 'Pages',
		'table' => array(
			'no_results' => 'There are no pages yet, add one!'
		),
		'buttons' => array(
			'add' => 'Add page'
		)
	),
	
	'create' => array(
		'title' => 'Create page',
		'form' => array(
			'lang' => array(
				'meta_title' => 'Title',
				'meta_description' => 'Meta description',
				'meta_keywords' => 'Meta keywords',
				'menu' => 'Menu',
				'url' => 'URL',
			),
			'template_id' => 'Template',
		),
		'buttons' => array(
			'add' => 'Add page'
		)
	),
	
	'update' => array(
		'title' => 'Edit page',
		'form' => array(
			'lang' => array(
				'meta_title' => 'Title',
				'meta_description' => 'Meta description',
				'meta_keywords' => 'Meta keywords',
				'menu' => 'Menu',
				'url' => 'URL',
			),
			'template_id' => 'Template',
		),
		'buttons' => array(
			'edit' => 'Save changes'
		)
	),
	
	'delete' => array(
		'title' => 'Are you sure?',
		'message' => 'You are about to delete the page named ":meta_title". <b>If you do, there is no turning back!</b>',
		'buttons' => array(
			'delete' => 'Delete page',
			'cancel' => 'Nope, I changed my mind'
		)
	)

);