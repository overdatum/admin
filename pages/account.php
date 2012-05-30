<?php

use Layla\API;

class Admin_Account_Page {

	public function add($page)
	{
		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.add.title'));
		});

		$page->form(Module::form('account.add'), 'POST', prefix().'account/add');
	}

	public function edit($page, $id)
	{
		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.edit.title'));
		});

		$page->form(Module::form('account.edit', $id), 'PUT', prefix().'account/edit/'.$id);		
	}

	public function delete($page, $id)
	{
		// Get the Account
		$response = API::get(array('account', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// The response body is the Account
		$account = $response->get();

		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.delete.title'));
		});

		$page->well(function($page) use ($account)
		{
			$page->raw(__('admin::account.delete.message', array('name' => $account->name, 'email' => $account->email)));
		});

		$page->form(Module::form('account.delete', $id), 'DELETE', prefix().'account/delete/'.$id);		
	}

}