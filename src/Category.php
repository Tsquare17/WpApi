<?php

namespace Tsquare\WpApi;

class Category {

	/**
	 * @param $id string
	 *
	 * @return object
	 */
	public static function byId( $id )
	{
		$url = env('APP_WP_API');
		return Get::byId($url, 'categories', $id);
	}
}