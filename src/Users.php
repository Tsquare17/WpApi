<?php

namespace Tsquare\WpApi;

use Tsquare\WpApi\Curl;

class Users {


    /**
     * @param $url string
     *
     * @return object
     */
    public static function all( $url ): object
    {
        return Curl::get($url . '/wp-json/wp/v2/users');
    }

    public static function byId( $id ): object
    {
        return Curl::get($url . "/wp-json/wp/v2/users/{$id}");
    }
}
