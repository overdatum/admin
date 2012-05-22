<?php namespace Layla\Admin;

use Laravel\Session;
use Laravel\View;

class Notification  {

	public static $notifications = array();

	public static function success($message, $time = 5000, $close = false)
	{
		static::add('success', $message, $time, $close);
	}

	public static function error($message, $time = 5000, $close = false)
	{
		static::add('error', $message, $time, $close);
	}

	public static function warning($message, $time = 5000, $close = false)
	{
		static::add('warning', $message, $time, $close);
	}

	public static function info($message, $time = 5000, $close = false)
	{
		static::add('info', $message, $time, $close);
	}

	public static function show()
	{
		$notifications = Session::get('notifications');
			if(count($notifications) > 0)
			{
				return View::make('layla_admin::layouts/notifications')->with('notifications', $notifications);
			}
	}

	protected static function add($type, $message, $time, $close)
	{
		static::$notifications[] = array(
			'type' => $type,
			'message' => $message,
			'time' => $time,
			'close' => $close
		);
		Session::flash('notifications', static::$notifications);
	}

}