<?php

/**
 * Adding custom admin columns
 */

function prowordpress_custom_columns( $cols ) {
	$cols = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Title', 'prowordpress' ),
		'director' => __( 'Director', 'prowordpress' ),
		'year'     => __( 'Year', 'prowordpress' ),
	);
	return $cols;
}
add_filter( "manage_ptd_movie_posts_columns", "prowordpress_custom_columns" );

/**
 * Populating columns
 */

function prowordpress_custom_column_content( $column, $post_id ) {
  
	switch ( $column ) {
		case "director":
			echo get_post_meta( $post_id, 'director', true);
			break;
    		case "year":
			echo get_post_meta( $post_id, 'year_released', true);
			break;
  	}
}
add_action( "manage_ptd_movie_posts_custom_column", "prowordpress_custom_column_content", 10, 2 );


/**
 * Enabling sortable columns
 */

function prowordpress_sortable_custom_columns() {
	return array(
		'title'    => 'title',
		'director' => 'director',
		'year'     => 'year'
	);
}

add_filter( "manage_edit-ptd_movie_sortable_columns", "prowordpress_sortable_custom_columns");
