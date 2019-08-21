<?php

namespace Tsquare\WpApi;

class Tags {

	protected $url;
	public $tags;
	public $totalTags;
	public $totalPages;

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->url = env('APP_WP_API');
	}

	/**
	 *
	 * @return object
	 */
	public function all()
	{
		$request = Get::all($this->url, 'tags');
		$this->totalTags = (int) $request['total-items'][0];
		$this->totalPages = (int) $request['total-pages'][0];
		$this->tags = $request['result'];

		return $this;
	}
}