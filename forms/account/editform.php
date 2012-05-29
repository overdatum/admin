<?php namespace Admin\Forms\Account;

use Layla\API;
use Layla\Module;
use Layla\Module\Form;

class EditForm extends Form {

	public static $rules = array();

	public static function render($id)
	{
		return Module::render(function($form) use ($id)
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

			$form->text('name',  __('admin::account.edit.form.name'));
			$form->text('email', __('admin::account.edit.form.email'));
			$form->password('password', __('admin::account.edit.form.password'));
			$form->multiple('roles', __('admin::account.edit.form.roles'), $roles, $active_roles);
			$form->dropdown('language_id', __('admin::account.edit.form.language'), $languages);

			$form->actions(function($form)
			{
				$form->submit(__('admin::account.edit.buttons.edit'), 'primary');
			});
		});
	}

}