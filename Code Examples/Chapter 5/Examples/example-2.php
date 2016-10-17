<?php

/**
 * Taxonomy full setup
 */

function prowordpress_taxonomies() {

	$labels = array(
		'name'                => _x( 'Genres', 'taxonomy general name', 'prowordpress' ),
		'singular_name'       => _x( 'Genre', 'taxonomy singular name', 'prowordpress' ),
		'search_items'        => __( 'Search Genres', 'prowordpress' ),
		'all_items'           => __( 'All Genres', 'prowordpress' ),
		'parent_item'         => __( 'Parent Genre', 'prowordpress' ),
		'parent_item_colon'   => __( 'Parent Genre:', 'prowordpress' ),
		'edit_item'           => __( 'Edit Genre', 'prowordpress' ), 
		'update_item'         => __( 'Update Genre', 'prowordpress' ),
		'add_new_item'        => __( 'Add New Genre', 'prowordpress' ),
		'new_item_name'       => __( 'New Genre Name', 'prowordpress' ),
		'menu_name'           => __( 'Genre', 'prowordpress' )
	); 	

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => true,
		'public'              => true,
		'show_tagcloud'       => false,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'genre' ),
		'sort'                => true,
	);

	register_taxonomy( 'ptd_genre', 'ptd_movie', $args );
}
add_action('init', 'prowordpress_taxonomies');
