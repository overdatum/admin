<?php

use Laravel\Messages;

use Layla\API;
use Layla\Module;

class Admin_Media_Group_Controller extends Admin_Base_Controller
{

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function get_read_multiple($id = null)
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
					'name'
				)
			);
		}

		// Get the Accounts
		$mediagroups = API::get(array('media', $id, 'groups'), $options);
		
		// Paginate the mediagroups
		$mediagroups = Paginator::make($mediagroups->get('results'), $mediagroups->get('total'), $this->per_page);

		$this->layout->content = Module::page('media.group.read_multiple', $mediagroups, $id);
	}

}