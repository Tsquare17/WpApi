<?php

namespace Tsquare\WpApi;

class Categories {

	protected $categories;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$url = env('APP_WP_API');
		$this->categories = Get::all($url, 'categories');
	}

	/**
	 *
	 * @return object
	 */
	public function all()
	{
		return $this->categories;
	}
}