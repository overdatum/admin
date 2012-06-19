<?php

use Layla\API;

class Admin_Layout_Page {

	public function index($view, $accounts)
	{
		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::account.index.title'));
		});

		$view->notifications();

		$view->table(function($table) use ($accounts)
		{
			$table->header(array(
				'name' => array('title' => __('admin::account.index.table.name'), 'attributes' => array('class' => 'first big')),
				'email' => __('admin::account.index.table.email'),
				'roles' => __('admin::account.index.table.roles'),
				'buttons' => array('attributes' => array('class' => 'buttons last'))
			));
			$table->sortable(array('name', 'email'));
			$table->rows($accounts);
			$table->no_results(function($table)
			{
				$table->well(function($table)
				{
					$table->raw(__('admin::account.index.table.no_results'));
				});
			});
			$table->display(array(
				'roles' => function($account)
				{
					$roles = '';
					if(isset($account->roles))
					{
						foreach ($account->roles as $role)
						{
							$roles .=
								'<b>'.
									$role->lang->name.
								'</b><br>'.
								$role->lang->description;
						}
					}
					
					return $roles;						
				},
				'buttons' => function($account)
				{
					return
						HTML::link(prefix('admin').'account/edit/'.$account->id, '<span class="icon-pencil"></span>', array('class' => 'btn btn-small')).
						HTML::link(prefix('admin').'account/delete/'.$account->id, '<span class="icon-trash icon-white"></span>', array('class' => 'btn btn-primary'));
				}
			));
		});

		$view->links($accounts);

		$view->float_right(function($view)
		{
			$view->button(prefix('admin').'account/add', 'Add account', 'primary');
		});
	}

	public function add($view)
	{
		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::account.add.title'));
		});

		$view->form(Module::form('account.add'), 'POST', prefix('admin').'account/add');
	}

	public function edit($view, $id)
	{
		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::account.edit.title'));
		});

		$view->form(Module::form('account.edit', $id), 'PUT', prefix('admin').'account/edit/'.$id);		
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