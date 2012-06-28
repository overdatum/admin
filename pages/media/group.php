<?php

use Layla\API;

class Admin_Media_Group_Page {

	public function read_multiple($view, $mediagroups, $module_id)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.media.group.listitem')
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
					$view->no_results(__('admin::media.group.read_multiple.list.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

}