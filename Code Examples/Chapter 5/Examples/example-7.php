<?php

/**
 * Post meta functions
 */

// Add

// Add running time meta data
add_post_meta( $post_id, 'running_time', '92 minutes', true );

// Add classification meta data with array
$classifications = array(
		'usa' => 'R',
		'uk'  => '18'
	)
add_post_meta( $post_id, 'movie_classification', $classifications, true);


// Update

// Using update meta data if there is already a post meta in the database
if( ! add_post_meta( $post_id, 'running_time', '108 minutes', true) ) {
	update_post_meta( $post_id, 'running_time', '108 minutes' );
}

// update post meta for a value already in the database
update_post_meta( $post_id, 'running_time', '108 minutes', '92 minutes' );


// Delete

delete_post_meta( $post_id, 'running_time' );


// Get meta data

get_post_meta( $post_id, 'movie_classification', true );