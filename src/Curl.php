<?php

namespace Tsquare\WpApi;

class Curl {
    public static function get( $url ): object
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        curl_close($ch);


        return $result;
    }
}
