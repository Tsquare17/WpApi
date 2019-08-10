<?php

namespace Tsquare\WpApi;

class Get {
	/**
	 * @param $url string
	 * @param $endpoint string
	 *
	 * @return array
	 */
	public static function all( $url, $endpoint ): array
	{
		return json_decode(Curl::get("{$url}/wp-json/wp/v2/{$endpoint}"), true);
	}

	/**
	 * @param $url string
	 * @param $endpoint string
	 * @param $id string|int
	 *
	 * @return array
	 */
	public static function byId( $url, $endpoint, $id ): array
	{
		return json_decode(Curl::get("{$url}/wp-json/wp/v2/{$endpoint}/{$id}"), true);
	}
}