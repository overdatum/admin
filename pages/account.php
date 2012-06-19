<?php

use Layla\API;

class Admin_Account_Page {

	public function index($view, $accounts)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.accounts.listitem')
		);

		$view->notifications();

		$view->full_list(function($view) use ($accounts, $templates)
		{
			$view->header(function($view)
			{
				$view->search();
				$view->tabs(function($tab)
				{
					$tab->add('<i class="icon-list"></i>');
					$tab->add('<i class="icon-tree"></i>');
				});
			});

			$view->items(function($view) use ($accounts, $templates)
			{
				if(count($accounts->results) > 0)
				{
					foreach ($accounts->results as $account)
					{
						$view->add($templates['listitem']->with('account', $account)->render());
					}
				}
				else
				{
					$view->no_results(__('admin::account.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

	public function add($view)
	{
		$view->form(Module::form('account.add'), 'POST', prefix('admin').'account/add');
	}

	public function edit($view, $account)
	{
		$templates = array(
			'versionitem' => View::make('admin::pages.accounts.versionitem')
		);

		$view->form(function($view) use ($account)
		{
			// The response body is the Account
			$account = $account->get();

			// Get Roles and put it in a nice array for the dropdown
			$roles = array('' => '') + model_array_pluck(API::get(array('role', 'all'))->get('results'), function($role)
			{
				return $role->lang->name;
			}, 'id');

			// Get the Roles that belong to a User and put it in a nice array for the dropdown
			$active_roles = array();
			if(isset($account->roles))
			{ 
				$active_roles = model_array_pluck($account->roles, 'id', '');
			}

			// Get Languages and put it in a nice array for the dropdown
			$languages = model_array_pluck(API::get(array('language', 'all'))->get('results'), function($language)
			{
				return $language->name;
			}, 'id');

			$view->text('name',  __('admin::account.edit.form.name'), Input::old('name', $account->name));
			$view->text('email', __('admin::account.edit.form.email'), Input::old('email', $account->email));
			$view->password('password', __('admin::account.edit.form.password'));
			$view->multiple('roles[]', __('admin::account.edit.form.roles'), $roles, Input::old('roles', $active_roles));
			$view->dropdown('language_id', __('admin::account.edit.form.language'), $languages, Input::old('language_id', $account->language->id));

			$view->actions(function($view)
			{
				$view->submit(__('admin::account.edit.buttons.edit'), 'primary');
			});
		}, 'PUT', prefix('admin').'account/edit/'.$account->get('id'));
	}

	public function delete($view, $id)
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

		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::account.delete.title'));
		});

		$view->well(function($view) use ($account)
		{
			$view->raw(__('admin::account.delete.message', array('name' => $account->name, 'email' => $account->email)));
		});

		$view->form(Module::form('account.delete', $id), 'DELETE', prefix('admin').'account/delete/'.$id);		
	}

}