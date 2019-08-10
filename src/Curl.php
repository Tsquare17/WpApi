<?php

namespace Tsquare\WpApi;

class Curl {

	/**
	 * @param $url string
	 *
	 * @return string
	 */
    public static function get( $url ): string
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
