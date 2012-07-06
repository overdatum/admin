<?php

use Laravel\Messages;

use Layla\API;
use Layla\Artifact;

class Admin_Media_Group_Asset_Controller extends Admin_Base_Controller
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

	public function get_read_multiple($module_id, $id = null)
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
		$assets = API::get(array('media', $module_id, 'group', $id, 'assets'), $options);
		
		// Paginate the assets
		$assets = Paginator::make($assets->get('results'), $assets->get('total'), $this->per_page);

		$this->layout->content = Artifact::page('media.group.asset.read_multiple')
			->with('assets', $assets)
			->with('module_id', $module_id)
			->with('mediagroup_id', $id);
	}

}