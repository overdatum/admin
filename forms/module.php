<?php

use Layla\API;

class Admin_Module_Form {

	public static function create($view)
	{
		$view->tabs(function($tabs)
		{
			$tabs->tab('Module Settings', function($view)
			{
				$view->text('name',  __('admin::module.create.form.name'), Input::old('name'));

				$view->actions(function($view)
				{
					$view->next_tab('Next up, add some schemas &nbsp; <i class="icon-arrow-right icon-white"></i>', 'primary');
				});
			});

			$tabs->tab('Schemas', function($view)
			{
				$view->table(function($table)
				{
					$table->header(array(
						'name' => array('title' => __('admin::account.read_multiple.table.name'), 'attributes' => array('class' => 'first big')),
						'relationships',
						'buttons' => array('attributes' => array('class' => 'buttons last'))
					));
					$table->no_results(function($table)
					{
						$table->well(function($table)
						{
							$table->raw(__('admin::account.read_multiple.table.no_results'));
						});
					});
					$table->display(array(
						'relationships' => function($schema)
						{
							$relationships = '';
							if(isset($schema->relationships))
							{
								foreach ($schema->relationships as $relationship)
								{
									$relationships .=
										'<b>'.
											$relationship->name.
										'</b><br>'.
										$relationship->type;
								}
							}
							
							return $relationships;						
						},
						'buttons' => function($schema)
						{
							return
								HTML::link(prefix('admin').'module/add/', '<span class="icon-pencil"></span>', array('class' => 'btn btn-small')).
								HTML::link(prefix('admin').'module/add/', '<span class="icon-trash icon-white"></span>', array('class' => 'btn btn-primary'));
						}
					));
				});

				$view->button('#add-schema', 'Add Schema', 'primary');
			});
		});
	}

	public static function install($view)
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

		$view->text('name',  __('admin::account.create.form.name'), Input::old('name'));
		$view->text('email', __('admin::account.create.form.email'), Input::old('email'));
		$view->password('password', __('admin::account.create.form.password'));
		$view->multiple('roles[]', __('admin::account.create.form.roles'), $roles, Input::old('roles'));
		$view->dropdown('language_id', __('admin::account.create.form.language'), $languages, Input::old('language_id'));

		$view->actions(function($view)
		{
			$view->submit(__('admin::account.create.buttons.add'), 'primary');
		});
	}

	public static function update($view, $id)
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

		$view->text('name',  __('admin::account.update.form.name'), Input::old('name', $account->name));
		$view->text('email', __('admin::account.update.form.email'), Input::old('email', $account->email));
		$view->password('password', __('admin::account.update.form.password'));
		$view->multiple('roles[]', __('admin::account.update.form.roles'), $roles, Input::old('roles', $active_roles));
		$view->dropdown('language_id', __('admin::account.update.form.language'), $languages, Input::old('language_id', $account->language->id));

		$view->actions(function($view)
		{
			$view->submit(__('admin::account.update.buttons.edit'), 'primary');
		});
	}

	public static function delete($view, $id)
	{
		$view->actions(function($view)
		{
			$view->submit(__('admin::account.delete.buttons.delete'), 'primary');
			$view->button(prefix('admin').'account', __('admin::account.delete.buttons.cancel'));
		});
	}

}