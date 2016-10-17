<?php

function rar_delete_review( $review_id ) {
	global $wpdb;

	$table_name = $wpdb->prefix . "ratings_and_reviews";

	// Final check to ensure the ID is a positive integer
	$review_id = absint($review_id);     
	if( empty($review_id) ) {
		return false;
	}

	// Set up arrays for the delete function
	$where = array( 'post_id' => $review_id );
	$where_format = array( '%d' );

	return $wpdb->delete( $table_name, $where, $where_format );
}
