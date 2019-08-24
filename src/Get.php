<?php

namespace Tsquare\WpApi;

class Get {

	/**
	 * @param $url string
	 * @param $endpoint string
	 *
	 * @param int $page
	 * @param int $perPage
	 *
	 * @return array
	 */
	public static function all( $url, $endpoint, $page = 1, $perPage = 100 )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}?_embed&per_page={$perPage}&page={$page}");
	}

	/**
	 * @param $url string
	 * @param $endpoint string
	 * @param $id string|int
	 *
	 * @return array
	 */
	public static function byId( $url, $endpoint, $id )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}/{$id}");
	}

	public static function bySlug( $url, $endpoint, $slug )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}?_embed&slug={$slug}");
	}

	public static function categoryById( $url, $endpoint, $id )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}/?category={$id}");
	}

	public static function byCategory( $url, $endpoint, $category, $page = 1, $perPage = 100 )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}?_embed&category={$category}&per_page={$perPage}&page={$page}");
	}

	public static function byTag( $url, $endpoint, $tag, $page = 1, $perPage = 100 )
	{
		return self::curl("{$url}/wp-json/wp/v2/{$endpoint}?_embed&tags={$tag}&per_page={$perPage}&page={$page}");
	}

	/**
	 * @param $url string
	 *
	 * @return string
	 */
	private static function curl( $url ): array
	{
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);

			$headers = [];
			curl_setopt($ch, CURLOPT_HEADERFUNCTION,
				function($curl, $header) use (&$headers)
				{
					$len = strlen($header);
					$header = explode(':', $header, 2);
					if (count($header) < 2) {
						return $len;
					}
					$headers[strtolower(trim($header[0]))][] = trim($header[1]);

					return $len;
				}
			);

			$result = curl_exec($ch);
			curl_close($ch);
		} catch(\Exception $e) {
			return $e->getMessage();
		}

		$return = [];
		if ( isset($headers['x-wp-total']) && isset($headers['x-wp-totalpages']) ) {
			$return['total-items'] = $headers['x-wp-total'];
			$return['total-pages'] = $headers['x-wp-totalpages'];
		}
		$return['result'] = $result;

		return $return;
	}
}