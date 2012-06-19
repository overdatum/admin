<?php

use Laravel\Messages;

use Layla\API;
use Layla\Module;

class Admin_Media_Controller extends Admin_Base_Controller
{

	public $edit_form;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Account overview
	 */
	public function get_index()
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'name'),
			'order' => Input::get('order', 'ASC')
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'name', 
					'email'
				)
			);
		}

		// Get the Accounts
		$modules = API::get(array('module', 'all'), $options);
		
		// Paginate the modules
		$modules = Paginator::make($modules->get('results'), $modules->get('total'), $this->per_page);

		$this->layout->content = Module::page('media.index', $modules);
	}

	public function get_module($id = null)
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'name'),
			'order' => Input::get('order', 'ASC'),
			'filter' => array(
				'module_id' => $id
			)
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'name', 
					'email'
				)
			);
		}

		// Get the Accounts
		$mediagroups = API::get(array('mediagroup', 'all'), $options);
		
		// Paginate the mediagroups
		$mediagroups = Paginator::make($mediagroups->get('results'), $mediagroups->get('total'), $this->per_page);

		$this->layout->content = Module::page('media.groups', $mediagroups, $id);
	}

	public function get_group($module_id, $id = null)
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'name'),
			'order' => Input::get('order', 'ASC'),
			'filter' => array(
				'group_id' => $id
			)
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'name', 
					'email'
				)
			);
		}

		// Get the Accounts
		$assets = API::get(array('asset', 'all'), $options);
		
		// Paginate the assets
		$assets = Paginator::make($assets->get('results'), $assets->get('total'), $this->per_page);

		$this->layout->content = Module::page('media.assets', $assets, $module_id, $id);
	}

}