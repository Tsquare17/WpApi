<?php


namespace Tsquare\WpApi;


class Post {

	/**
	 * @param $slug string
	 *
	 * @return object
	 */
	public static function bySlug( $slug ): object
	{
		$url = env('APP_WP_API');
		return Get::bySlug($url, 'posts', $slug)[0];
	}
}