<?php

namespace Tsquare\WpApi;

class Categories {

	protected $url;
	public $totalCategories;
	public $totalPages;
	public $categories;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->url = env('APP_WP_API');
	}

	/**
	 *
	 * @return object
	 */
	public function all()
	{
		$request = Get::all($this->url, 'categories');
		$this->totalCategories = (int) $request['total-items'][0];
		$this->totalPages = (int) $request['total-pages'][0];
		$this->categories = $request['result'];

		return $this;
	}
}