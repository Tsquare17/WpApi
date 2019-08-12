<?php

namespace Tsquare\WpApi;

class User {

	/**
	 * @param $id string
	 *
	 * @return object
	 */
	public static function byId( $id )
	{
		$url = env('APP_WP_API');
		return Get::byId($url, 'users', $id);
	}
}