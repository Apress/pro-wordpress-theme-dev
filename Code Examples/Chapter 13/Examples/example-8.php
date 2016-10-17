<?php

function rar_add_review( $data ) {
	global $wpdb;

	$table_name = $wpdb->prefix . "ratings_and_reviews";

	$column_formats = array(
			'post_id'        => '%d',
			'user_id'        => '%d',
			'posted'         => '%s',
			'review_title'   => '%s',
			'review_content' => '%s',
			'rating'         => '%d',
		);

	$defaults = array(
			'user_id' => get_current_user_id(),
			'posted'  => current_time('mysql')
		);

	$data = wp_parse_args( $data, $defaults );
	
	// Remove any unneeded data from the first array where 
	// a column does not exist (based on the column_formats array)
	$data = array_intersect_key($data, $column_formats);

	// Reorder $column_formats array to match the order of columns in the data array
	$data_keys = array_keys($data);
	$column_formats = array_merge(array_flip($data_keys), $column_formats);

	$wpdb->insert($table_name, $data, $column_formats);

	return $wpdb->insert_id;
}
