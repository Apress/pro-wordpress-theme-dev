<?php

/**
 * Modifying the default query
 */

// version 1

global $query_string;
query_posts( $query_string . "&cat=-5" );

if( have_posts() ): while( have_posts() ): the_post();
	// Do stuff
endwhile; endif;

// version 2

function exclude_category( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'cat', '-5' );
	}
}
add_action( 'pre_get_posts', 'exclude_category' );