<?php

namespace Tsquare\WpApi;

class Tags {

	/**
	 * @param $url string
	 *
	 * @return array
	 */
	public static function all( $url ): array
	{
		return json_decode(Curl::get($url . '/wp-json/wp/v2/tags'), true);
	}
}
