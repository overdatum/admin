<?php

use Layla\API;

class Admin_Module_Page {

	public function read_multiple($view, $modules)
	{
		extract($data);
		
		$templates = array(
			'listitem' => View::make('admin::pages.media.listitem')
		);

		$view->notifications();

		$view->full_list(function($view) use ($modules, $templates)
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

			$view->items(function($view) use ($modules, $templates)
			{
				if(count($modules->results) > 0)
				{
					foreach ($modules->results as $module)
					{
						$view->add($templates['listitem']->with('module', $module)->render());
					}
				}
				else
				{
					$view->no_results(__('admin::media.read_multiple.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

	public function create($view)
	{
		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::module.create.title'));
		});

		$view->form(Artifact::form('module.create'), 'POST', prefix('admin').'module/create');
	}

	public function update($view, $id)
	{
		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::module.edit.title'));
		});

		$view->form(Artifact::form('module.update', $id), 'PUT', prefix('admin').'module/edit/'.$id);		
	}

	public function delete($view, $id)
	{
		// Get the Account
		$response = API::get(array('module', $id));

		// Handle response codes other than 200 OK
		if( ! $response->success)
		{
			return Event::first($response->code);
		}

		// The response body is the Account
		$module = $response->get();

		$view->page_header(function($view)
		{
			$view->float_right(function($view)
			{
				$view->search();
			});

			$view->title(__('admin::module.delete.title'));
		});

		$view->well(function($view) use ($module)
		{
			$view->raw(__('admin::module.delete.message', array('name' => $module->name, 'email' => $module->email)));
		});

		$view->form(Artifact::form('module.delete', $id), 'DELETE', prefix('admin').'module/delete/'.$id);		
	}

}