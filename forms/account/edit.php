<?php

use Layla\API;
use Layla\Module;
use Layla\Module\Form;

class Admin_Account_Edit_Form extends Form {

	public static $rules = array(
		'name' => 'required',
		'email' => 'required|email',
		'language_id' => 'required',
	);

	public static function form($form, $id)
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

		$form->text('name',  __('admin::account.edit.form.name'), Input::get('name', $account->name));
		$form->text('email', __('admin::account.edit.form.email'), Input::get('email', $account->email));
		$form->password('password', __('admin::account.edit.form.password'));
		$form->multiple('roles[]', __('admin::account.edit.form.roles'), $roles, Input::get('roles', $active_roles));
		$form->dropdown('language_id', __('admin::account.edit.form.language'), $languages, Input::get('language_id', $account->language->id));

		$form->actions(function($form)
		{
			$form->submit(__('admin::account.edit.buttons.edit'), 'primary');
		});
	}

}