<?php

namespace Tsquare\WpApi;

class Tags {

	protected $tags;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$url = env('APP_WP_API');
		$this->tags = Get::all($url, 'tags');
	}

	/**
	 *
	 * @return object
	 */
	public function all()
	{
		return $this->tags;
	}
}