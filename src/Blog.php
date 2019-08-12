<?php

namespace Tsquare\WpApi;

/**
 * Call to necessary endpoints and form an easy to use array of a specified number of objects for displaying posts on the blog page.
 *
 * @package Tsquare\WpApi
 */
class Blog {

	protected $url;

	public function __construct($url = null)
	{
		$this->url = $url ?: env('APP_WP_API');
	}

	public function getPosts( $perPage = 100, $page = 1 ): Blog
	{
		// need to refactor Get class to use optional parameters
	}
}