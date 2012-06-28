<?php

use Layla\API;

class Admin_Media_Group_Asset_Page {

	public function read_multiple($view, $assets, $module_id, $mediagroup_id)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.media.group.asset.listitem')
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
					$view->no_results(__('admin::media.group.asset.read_multiple.list.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

}