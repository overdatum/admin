<?php

use Layla\API;

class Admin_Media_Page {

	public function read_multiple($view, $data)
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
					$view->no_results(__('admin::module.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}

}