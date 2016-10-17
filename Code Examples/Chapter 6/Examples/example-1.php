<?php 

/**
 * Body class filtering function
 */

function prowordpress_add_category_classes( $classes ) {
	global $post;

	// Adds classes for the current post categories
	if( is_single() ) {
		$categories = get_the_category( $post->ID );
		foreach ( $categories as $cat ) {
			$classes[] = $cat->slug;
		}
	}

	return $classes;
}
add_filter( 'body_class', 'prowordpress_add_category_classes' );
