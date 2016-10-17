<?php

function rar_get_reviews( $query = array() ) {
	global $wpdb;

	// Set table name
	$table_name = $wpdb->prefix . "ratings_and_reviews";

	// Setup array of default arguments
	$defaults = array (
			'id'      => false,
			'post_id' => false,
			'user_id' => false,
			'order'   => 'ASC',
			'number'  => 10,
			'offset'  => 0
		);

	// wp_parse_args to set full arguments
	$args = wp_parse_args( $query, $defaults );

	// Create variables of the array keys
	extract($args);
	
	// Start SQL
	$sql_start = "SELECT * FROM {$table_name}";

	// Check if the ID is set first, if so we're just doing a query for a single result
	if( $id ) {

		// Prepare the WHERE clause
		$sql_where = $wpdb->prepare('WHERE id = %d', $id);
		
		// Join all SQL parts
		$sql = "$sql_start $sql_where";

		// Return the single result
		return $wpdb->get_row($sql, ARRAY_A);

	} else {

		// Initialise the WHERE clause with an automatic true condition
		$sql_where = "WHERE 1=1";

		// Create a post__in query
		if( $post_id ) {

			// Force $post_id to be an array
			if( ! is_array( $post_id ) ) {
				$post_id = array( $post_id );
			}				

			$post_id = array_map('absint',$post_id); // Cast as positive integers
			$post_id__in = implode(',',$post_id);
			$sql_where .=  " AND post_id IN($post_id__in)";
		}

		// Create a user__in query
		if( $user_id ) {

			// Force $user_id to be an array
			if( ! is_array( $user_id ) ) {
				$user_id = array( $user_id );
			}				

			$user_id = array_map('absint',$user_id); // Cast as positive integers
			$user_id__in = implode(',',$user_id);
			$sql_where .=  " AND user_id IN($user_id__in)";
		}

		// Create order part of query
		$order = strtoupper($order);
		$order = ( 'ASC' == $order ? 'ASC' : 'DESC' );
	 
		$sql_order = "ORDER BY posted $order";

		// Create limit part of query
		$offset = absint($offset); // Ensure positive integer
		if( $number == -1 ){
			 $sql_limit = "";
		} else {
			 $number = absint($number); // Ensure positive integer
			 $sql_limit = "LIMIT $offset, $number";
		}

		// Build full SQL statement
		$sql = "$sql_start $sql_where $sql_order $sql_limit";

		// return results using the $wpdb->get_results function
		return $wpdb->get_results($sql, ARRAY_A);
	}
}
