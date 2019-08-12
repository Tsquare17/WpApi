<?php

namespace Tsquare\WpApi;

class Posts {

	protected $posts;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$url = env('APP_WP_API');
		$this->posts = Get::all($url, 'posts');
	}

	/**
	 *
	 * @return object
	 */
	public function all()
	{
		return $this->posts;
	}

}
