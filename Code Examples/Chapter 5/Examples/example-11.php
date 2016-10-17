<?php

/**
 * Add custom fields to RSS
 */

function prowordpress_add_review_to_rss( $content ) {
	global $wp_query;
	$post_id = $wp_query->post->ID;

	$review = get_post_meta($post_id, 'ptd_movie_review_rating', true);

	if ( is_feed() && '' !== $review ) {
		$content = '<h2>Movie review score: ' . $review . ' stars</h2>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'prowordpress_add_review_to_rss');
add_filter('the_content', 'prowordpress_add_review_to_rss');
