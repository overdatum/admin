<?php

class Admin_Account_Page {

	public function add($page, $id)
	{
		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.add.title'));
		});

		$page->form(Module::load('account.add', $id), 'POST', prefix().'account/add/'.$id);
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
		$page->page_header(function($page)
		{
			$page->float_right(function($page)
			{
				$page->search();
			});

			$page->title(__('admin::account.delete.title'));
		});

		$page->form(Module::form('account.delete', $id), 'DELETE', prefix().'account/delete/'.$id);		
	}

}