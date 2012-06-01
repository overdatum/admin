<?php

use Layla\API;

class Admin_Account_Page {

	public function index($page, $accounts)
	{
		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.index.title'));
		});

		$page->notifications();

		$page->table(function($table) use ($accounts)
		{
			$table->header(array(
				'name' => __('admin::account.index.table.name'),
				'email' => __('admin::account.index.table.email'),
				'roles' => __('admin::account.index.table.roles'),
				'buttons' => ''
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
						HTML::link(prefix('admin').'account/delete/'.$account->id, '<span class="icon-trash icon-white"></span>', array('class' => 'btn btn-danger'));
				}
			));
		});

		$page->links($accounts);

		$page->float_right(function($page)
		{
			$page->button(prefix('admin').'account/add', 'Add account', 'primary');
		});
	}

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

		$page->form(Module::form('account.add'), 'POST', prefix('admin').'account/add');
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

		$page->form(Module::form('account.edit', $id), 'PUT', prefix('admin').'account/edit/'.$id);		
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

		$page->form(Module::form('account.delete', $id), 'DELETE', prefix('admin').'account/delete/'.$id);		
	}

}