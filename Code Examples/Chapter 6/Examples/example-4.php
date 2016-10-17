<?php

/**
 * Custom filter example
 */

$title = apply_filters( 'ptd_movie_title', get_the_title() );

// And the application

function ptd_edit_movie_title( $title ) {
	// Do stuff

	return $title;
}

add_filter( 'ptd_movie_title', 'ptd_edit_movie_title' );
