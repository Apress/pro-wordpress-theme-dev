<?php
/**
 * Get the post slug tag example
 */

function get_the_post_slug($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	
	return $slug;
}