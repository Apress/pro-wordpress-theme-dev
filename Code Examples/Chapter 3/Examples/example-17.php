<?php
/**
* Include category IDs in body_class and post_class
*/
function add_category_classes($classes) {
	global $post;
	
	foreach((get_the_category($post->ID)) as $category) {
		$classes [] = 'cat-' . $category->slug;
	}

	return $classes;
}
add_filter('post_class', 'add_category_classes');