<?php

use Layla\API;

class Admin_Media_Page {

	public function index($view, $modules)
	{
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
					$view->no_results(__('admin::module.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

	public function groups($view, $mediagroups, $module_id)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.media.groups.listitem')
		);

		$view->notifications();

		$view->full_list(function($view) use ($mediagroups, $templates, $module_id)
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

			$view->items(function($view) use ($mediagroups, $templates, $module_id)
			{
				if(count($mediagroups->results) > 0)
				{
					foreach ($mediagroups->results as $mediagroup)
					{
						$view->add(
							$templates['listitem']
								->with('mediagroup', $mediagroup)
								->with('module_id', $module_id)
								->render()
						);
					}
				}
				else
				{
					$view->no_results(__('admin::mediagroup.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

	public function assets($view, $assets, $module_id, $mediagroup_id)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.media.asset.listitem')
		);

		$view->notifications();

		$view->full_list(function($view) use ($assets, $templates, $module_id, $mediagroup_id)
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

			$view->items(function($view) use ($assets, $templates, $module_id, $mediagroup_id)
			{
				if(count($assets->results) > 0)
				{
					foreach ($assets->results as $asset)
					{
						$view->add(
							$templates['listitem']
								->with('asset', $asset)
								->with('module_id', $module_id)
								->with('mediagroup_id', $mediagroup_id)
								->render()
						);
					}
				}
				else
				{
					$view->no_results(__('admin::asset.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

}