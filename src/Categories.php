<?php

namespace Tsquare\WpApi;

class Categories {

	/**
	 * @param $url string
	 *
	 * @return array
	 */
	public static function all( $url ): array
	{
		return json_decode(Curl::get($url . '/wp-json/wp/v2/categories'), true);
	}
}
