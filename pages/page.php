<?php

use Layla\API;

class Admin_Page_Page {

	public function read_multiple($view, $data)
	{
		extract($data);

		Asset::container('footer')->add('flyout', 'js/flyout.js');

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
					if(Input::get('q'))
					{
						$view->no_results(__('admin::page.read_multiple.table.no_search_results'));
					}
					else
					{
						$view->no_results(__('admin::page.read_multiple.table.no_results'));
					}
				}
			});
		});

		$view->templates($templates);
	}

	public function translate($view, $data)
	{
		extract($data);

		$view->form(function($view) use ($id, $language)
		{
			$view->page_header(function($view) use ($language)
			{
				$view->title(__('admin::page.translate.title', array('language' => $language->name)));
			});

			$view->text('lang['.$language->id.'][meta_title]',  __('admin::page.translate.form.lang.meta_title'));
			$view->text('lang['.$language->id.'][meta_keywords]', __('admin::page.translate.form.lang.meta_keywords'));
			$view->textarea('lang['.$language->id.'][meta_description]', __('admin::page.translate.form.lang.meta_description'));

			/**
			 * @todo stop laravel from adding id's to the form fields
			 */
			$view->text('lang['.$language->id.'][menu]', __('admin::page.translate.form.lang.menu'));
			$view->text('lang['.$language->id.'][url]', __('admin::page.translate.form.lang.url'));

			$view->actions(function($view)
			{
				$view->submit(__('admin::page.translate.buttons.edit'), 'primary');
			});
		}, 'PUT', prefix('admin').'page/'.$id.'/translate/'.$language->slug);
	}

	public function update($view, $data)
	{
		extract($data);

		$view->form(function($view) use ($page, $language)
		{
			$view->page_header(function($view) use ($language)
			{
				$view->title(__('admin::page.update.title', array('language' => $language->name)));
			});

			$view->text('lang['.$page->lang->language_id.'][meta_title]',  __('admin::page.update.form.lang.meta_title'), $page->lang->meta_title);
			$view->text('lang['.$page->lang->language_id.'][meta_keywords]', __('admin::page.update.form.lang.meta_keywords'), $page->lang->meta_keywords);
			$view->textarea('lang['.$page->lang->language_id.'][meta_description]', __('admin::page.update.form.lang.meta_description'), $page->lang->meta_description);

			/**
			 * @todo stop laravel from adding id's to the form fields
			 */
			$view->text('lang['.$page->lang->language_id.'][menu]', __('admin::page.update.form.lang.menu'), $page->lang->menu);
			$view->text('lang['.$page->lang->language_id.'][url]', __('admin::page.update.form.lang.url'), $page->lang->url);

			$view->actions(function($view)
			{
				$view->submit(__('admin::page.update.buttons.edit'), 'primary');
			});
		}, 'PUT', prefix('admin').'page/'.$page->lang->slug.'/edit');
	}

}