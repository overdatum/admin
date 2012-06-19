<?php

use Laravel\Messages;

use Layla\API;
use Layla\Module;
use Layla\Module\Form;

use Admin\Forms\Account\EditForm;

class Admin_Module_Controller extends Admin_Base_Controller
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
		$modules = API::get(array('account', 'all'), $options);

		// Paginate the Accounts
		$modules = Paginator::make($modules->get('results'), $modules->get('total'), $this->per_page);

		$this->layout->content = Module::page('module.index', $modules);
	}

	public function get_install()
	{
		$this->layout->content = Module::page('module.install');
	}

	public function get_create()
	{
		$this->layout->content = Module::page('module.create');
	}

	public function post_add()
	{
		$response = API::post(array('module'), Input::all());
		
		// Error were found our data! Redirect to form with errors and old input
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'module/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created module');

		return Redirect::to(prefix('admin').'module');
	}

	public function get_edit($id = null)
	{
		$this->layout->content = Module::page('module.edit', $id);
	}

	public function put_edit($id = null)
	{
		// Update the Account
		$response = API::put(array('module', $id), Input::all());

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'module/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated module');

		return Redirect::to(prefix('admin').'module');
	}

	public function get_delete($id = null)
	{
		$this->layout->content = Module::page('module.delete', $id);
	}

	public function delete_delete($id = null)
	{
		// Delete the Account
		$response = API::delete(array('module', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted module');

		return Redirect::to(prefix('admin').'module');
	}

}