<?php

class Admin_Auth_Controller extends Admin_Base_Controller {

	/**
	 * Setting the page title
	 * 
	 * @var string
	 */
	public $meta_title = 'Profile';

	public function get_index()
	{
		$this->layout->content = View::make('admin::profile.index');
	}

}