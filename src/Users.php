<?php

namespace Tsquare\WpApi;

class Users {

    /**
     * @param $url string
     *
     * @return array
     */
    public static function all( $url ): array
    {
        return json_decode(Curl::get($url . '/wp-json/wp/v2/users'), true);
    }

	/**
	 * @param $url string
	 * @param $id string|int
	 *
	 * @return array
	 */
    public static function byId( $url, $id ): array
    {
        return json_decode(Curl::get($url . "/wp-json/wp/v2/users/{$id}"), true);
    }
}
