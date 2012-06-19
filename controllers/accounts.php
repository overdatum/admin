<?php

use Laravel\Messages;

use Layla\API;
use Layla\Module;
use Layla\Module\Form;

use Admin\Forms\Account\EditForm;

class Admin_Accounts_Controller extends Admin_Base_Controller
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
		$accounts = API::get(array('account', 'all'), $options);

		// Paginate the Accounts
		$accounts = Paginator::make($accounts->get('results'), $accounts->get('total'), $this->per_page);

		$this->layout->content = Module::page('account.index', $accounts);
	}

	public function get_add()
	{
		$this->layout->content = Module::page('account.add');
	}

	public function post_add()
	{
		$response = API::post(array('account'), Input::all());
		
		// Error were found our data! Redirect to form with errors and old input
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'account/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created account');

		return Redirect::to(prefix('admin').'account');
	}

	public function get_edit($id = null, $sub = null, $sub_id = null)
	{
		//var_dump($id, $sub, $sub_id); die;
		$account = API::get(array('account', $id), array('version' => $sub_id));

		$this->layout->content = Module::page('account.edit', $account);
	}

	public function put_edit($id = null)
	{
		// Update the Account
		$response = API::put(array('account', $id), Input::all());

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'account/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated account');

		return Redirect::to(prefix('admin').'account');
	}

	public function get_delete($id = null)
	{
		$this->layout->content = Module::page('account.delete', $id);
	}

	public function delete_delete($id = null)
	{
		// Delete the Account
		$response = API::delete(array('account', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted account');

		return Redirect::to(prefix('admin').'account');
	}

}