<?php

return array(

	'read_multiple' => array(
		'title' => 'Pages',
		'table' => array(
			'no_search_results' => 'No pages have been found, try a broader search criteria',
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
	
	'translate' => array(
		'title' => 'Add :language translation',
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
			'edit' => 'Add translation'
		)
	),

	'update' => array(
		'title' => 'Edit :language translation',
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