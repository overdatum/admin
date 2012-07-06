<?php

use Laravel\Messages;

use Layla\API;
use Layla\Artifact;

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
	public function get_read_multiple()
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
					'name'
				)
			);
		}

		// Get the Accounts
		$modules = API::get(array('media'), $options);

		// Paginate the modules
		$modules = Paginator::make($modules->get('results'), $modules->get('total'), $this->per_page);

		$this->layout->content = Artifact::page('media.read_multiple')
			->with('modules', $modules);
	}

}