<?php

/**
 * Custom display meta box
 */

// Example 1

if( 'template-page-custom.php' === get_post_meta( $post->ID, '_wp_page_template', true) ) {
	add_meta_box (
			'ptd_page_meta',
			__('Custom page fields', 'prowordpress'),
			'prowordpress_page_meta_fields',
			'page'
		);
}

// Example 2

if ( has_term( 'comedy', 'ptd_genre', $post) ) {
	add_meta_box (
			'ptd_movies_meta',
			__('Movie details', 'prowordpress'),
			'prowordpress_movie_meta_fields',
			'ptd_movie',
			'side',
			'core'
		);	
} 
