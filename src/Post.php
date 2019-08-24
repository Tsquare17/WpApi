<?php


namespace Tsquare\WpApi;


class Post {

	/**
	 * @param $slug string
	 *
	 * @return array
	 */
	public function bySlug( $slug )
	{
		$url = env('APP_WP_API');
		$result = Get::bySlug($url, 'posts', $slug);

		return $this->formatPosts(json_decode($result['result'], false)[0])[0];
	}

	private function formatPosts( $post )
	{
		$formattedPosts = [];
		$term = 'wp:term';

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