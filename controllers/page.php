<?php

use Layla\API;

/**
* 
*/
class Admin_Page_Controller extends Admin_Base_Controller
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

	public function get_index()
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'meta_title'),
			'order' => Input::get('order', 'ASC')
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'menu', 
					'meta_title',
					'content'
				)
			);
		}

		// Get the Pages
		$pages = API::get(array('page', 'all'), $options);
		
		// Paginate the Pages
		$pages = Paginator::make($pages->get('results'), $pages->get('total'), $this->per_page);

		$this->layout->content = View::make('admin::page.index')->with('pages', $pages);
	}

	public function get_add()
	{
		// Get Languages
		$languages = model_array_pluck(API::get(array('language', 'all'))->get('results'), function($language)
		{
			return $language->name;
		}, 'id');

		// Get Layouts and put it in a nice array for the dropdown
		$layouts = model_array_pluck(API::get(array('layout', 'all'))->get('results'), function($layout)
		{
			return $layout->name;
		}, 'id');

		$this->layout->content = View::make('admin::page.add')
									 ->with('languages', $languages)
									 ->with('layouts', $layouts);
	}

	public function post_add()
	{
		$response = API::post(array('page'), Input::all());
		// Error were found our data! Redirect to form with errors and old input
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'page/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input();
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created page');

		return Redirect::to(prefix('admin').'page');
	}

	public function get_edit($id = null)
	{
		// Get the Page
		$response = API::get(array('page', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// The response body is the Page
		$page = $response->get();

		// Get Languages
		$languages = model_array_pluck(API::get(array('language', 'all'))->get('results'), function($language)
		{
			return $language->name;
		}, 'id');

		// Get Layouts and put it in a nice array for the dropdown
		$layouts = model_array_pluck(API::get(array('layout', 'all'))->get('results'), function($layout)
		{
			return $layout->name;
		}, 'id');

		$this->layout->content = View::make('admin::page.edit')
									 ->with('page', $page)
									 ->with('languages', $languages)
									 ->with('layouts', $layouts);
	}

	public function put_edit($id = null)
	{
		// Update the Page
		$response = API::put(array('page', $id), Input::all());

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to(prefix('admin').'page/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input();
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated page');

		return Redirect::to(prefix('admin').'page');
	}

	public function get_delete($id = null)
	{
		// Get the Page
		$response = API::get(array('page', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// The request body is the Page
		$page = $response->get();

		$this->layout->content = View::make('admin::page.delete')
									 ->with('page', $page);
	}

	public function delete_delete($id = null)
	{
		// Delete the Page
		$response = API::delete(array('page', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted page');

		return Redirect::to(prefix('admin').'page');
	}

}