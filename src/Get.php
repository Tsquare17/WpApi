<?php

namespace Tsquare\WpApi;

class Get {

	/**
	 * @param $url string
	 * @param $endpoint string
	 *
	 * @return object
	 */
	public static function all( $url, $endpoint )
	{
		return json_decode(self::curl("{$url}/wp-json/wp/v2/{$endpoint}"), false);
	}

	/**
	 * @param $url string
	 * @param $endpoint string
	 * @param $id string|int
	 *
	 * @return object
	 */
	public static function byId( $url, $endpoint, $id )
	{
		return json_decode(self::curl("{$url}/wp-json/wp/v2/{$endpoint}/{$id}"), false);
	}

	public static function bySlug( $url, $endpoint, $slug ): array
	{
		return json_decode(self::curl("{$url}/wp-json/wp/v2/{$endpoint}?slug={$slug}"), false);
	}

	/**
	 * @param $url string
	 *
	 * @return string
	 */
	private static function curl( $url ): string
	{
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch);
			curl_close($ch);
		} catch(\Exception $e) {
			return $e->getMessage();
		}

		return $result;
	}
}