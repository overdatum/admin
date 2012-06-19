<?php

use Layla\API;

class Admin_Page_Page {

	public function index($view, $pages)
	{
		$templates = array(
			'listitem' => View::make('admin::pages.pages.listitem')
		);

		$view->notifications();

		$view->full_list(function($view) use ($pages, $templates)
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

			$view->items(function($view) use ($pages, $templates)
			{
				if(count($pages->results) > 0)
				{
					foreach ($pages->results as $page)
					{
						$view->add($templates['listitem']->with('page', $page)->render());
					}
				}
				else
				{
					$view->no_results(__('admin::page.index.table.no_results'));
				}
			});
		});

		$view->templates($templates);
	}
}