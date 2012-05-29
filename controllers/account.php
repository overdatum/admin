<?php

use Laravel\Messages;

use Layla\API;
use Layla\Module;
use Layla\Module\Form;

use Admin\Forms\Account\EditForm;

class Admin_Account_Controller extends Admin_Base_Controller
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

		$this->layout->content = View::make('admin::account.index')->with('accounts', $accounts);
	}

	public function get_add()
	{
		// Get Roles and put it in a nice array for the dropdown
		$roles = array('' => '') + model_array_pluck(API::get(array('role', 'all'))->get('results'), function($role)
		{ 
			return $role->lang->name;
		}, 'id');

		// Get Languages and put it in a nice array for the dropdown
		$languages = model_array_pluck(API::get(array('language', 'all'))->get('results'), function($language)
		{
			return $language->name;
		}, 'id');

		$this->layout->content = View::make('admin::account.add')
									 ->with('roles', $roles)
									 ->with('languages', $languages);
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
				return Redirect::to($this->url.'account/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		Form::make($this->edit_form)->valid();

		// Add success notification
		Notification::success('Successfully created account');

		return Redirect::to($this->url.'account');
	}

	public function get_edit($id = null)
	{
		$url_prefix = $this->url;
		$this->layout->content = Module::render(function($page) use ($id, $url_prefix)
		{
			$page->page_header(function($page)
			{
				$page->float_right(function($page)
				{
					$page->search();
				});

				$page->title(__('admin::account.add.title'));
			});

			$page->form(EditForm::render($id), 'PUT', $url_prefix.'account/edit/'.$id);
		});
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
				return Redirect::to($this->url.'account/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated account');

		return Redirect::to($this->url.'account');
	}

	public function get_delete($id = null)
	{
		// Get the Account
		$response = API::get(array('account', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// The request body is the Account
		$account = $response->get();

		$this->layout->content = View::make('admin::account.delete')
									 ->with('account', $account);
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

		return Redirect::to($this->url.'account');
	}

}