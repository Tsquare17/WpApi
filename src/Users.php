<?php

namespace Tsquare\WpApi;

class Users {

	public $users;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$url = env('APP_WP_API');
		$this->users = Get::all($url, 'users');
	}

	public function all()
	{
		return $this->users;
	}
}