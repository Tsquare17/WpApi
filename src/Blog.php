<?php

namespace Tsquare\WpApi;

/**
 * Call to necessary endpoints and form an easy to use array of a specified number of objects for displaying posts on the blog page.
 *
 * @package Tsquare\WpApi
 */
class Blog {

	protected $url;
	public $totalPosts;
	public $totalPages;
	public $posts;
	public $category;
	public $tag;

	public function __construct($url = null)
	{
		$this->url = $url ?: env('APP_WP_API');
	}

	public function getPosts( $page = 1, $perPage = 100 ): Blog
	{
		$request = Get::all($this->url, 'posts', $page, $perPage);

		$this->totalPosts = (int) $request['total-items'][0];
		$this->totalPages = (int) $request['total-pages'][0];
		$this->posts = $this->formatPosts( json_decode($request['result']) );

		return $this;
	}

	public function getByCategory( $endpoint, $category ): Blog
	{
		$request = Get::byCategory($this->url, $endpoint, $category);

		$this->totalPosts = (int) $request['total-items'][0];
		$this->totalPages = (int) $request['total-pages'][0];
		$this->posts = $this->formatPosts( json_decode($request['result']) );

		return $this;
	}

	public function getByTag( $endpoint, $tag ): Blog
	{
		$request = Get::byTag($this->url, $endpoint, $tag);

		$this->totalPosts = (int) $request['total-items'][0];
		$this->totalPages = (int) $request['total-pages'][0];
		$this->posts = $this->formatPosts( json_decode($request['result']) );

		return $this;
	}


	private function formatPosts( $posts )
	{
		$formattedPosts = [];
		$term = 'wp:term';
		foreach ( $posts as $post ) {
			$formattedPost = [];
			$formattedPost['id'] = $post->id;
			$formattedPost['slug'] = $post->slug;
			$formattedPost['title'] = $post->title->rendered;
			$formattedPost['author'] = $post->_embedded->author[0]->name;
			$formattedPost['author_id'] = $post->_embedded->author[0]->id;
			$formattedPost['date'] = $post->date;
			$formattedPost['excerpt'] = $post->excerpt->rendered;
			$formattedPost['content'] = $post->content->rendered;

			[$categories, $tags] = $this->sortTags($post->_embedded->$term);
			$formattedPost['categories'] = $categories;
			$formattedPost['tags'] = $tags;

			$formattedPosts[] = $formattedPost;
		}

		return $formattedPosts;
	}

	private function sortTags( $items ): array
	{
		$postCategories = [];
		$postTags = [];
		foreach ( $items as $item ) {
			if ( is_array($item) ) {
				foreach ($item as $subItem ) {
					if ( $subItem->taxonomy === 'category' ) {
						$postCategories[] = ['id' => $subItem->id, 'name' => $subItem->name, 'slug' => $subItem->slug];
					}
					if ( $subItem->taxonomy === 'post_tag' ) {
						$postTags[] = [ 'id' => $subItem->id, 'name' => $subItem->name, 'slug' => $subItem->slug];
					}
				}
			} else {
				if ( $item->taxonomy === 'category' ) {
					$postCategories[] = ['id' => $item->id, 'name' => $item->name, 'slug' => $item->slug];
				}
				if ( $item->taxonomy === 'post_tag' ) {
					$postTags[] = [ 'id' => $item->id, 'name' => $item->name, 'slug' => $item->slug];
				}
			}
		}

		return [$postCategories, $postTags];
	}
}