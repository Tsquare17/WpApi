<?php

namespace Tsquare\WpApi;

class Navs {

	/**
	 * @param $url string
	 * @param $route string
	 * @param $menu string
	 *
	 * @return array
	 */
	public static function all( $url, $route, $menu ): array
	{
		$nav = json_decode(Curl::get("{$url}/wp-json/{$route}/{$menu}"), true);

		$navItems = [];
		foreach ($nav as $key => $value) {
			$navItems[] = [
				'ID' => $value['ID'],
				'Title' => $value['title'],
				'href' => $value['url'],
			];
		}

		return $navItems;
	}
}
