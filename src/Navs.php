<?php

namespace Tsquare\WpApi;

class Navs {

	/**
	 * @param $url string
	 *
	 * @return array
	 */
	public static function all( $url ): array
	{
		return json_decode(Curl::get($url . '/wp-json/navroute/menu'), true);
	}
}
