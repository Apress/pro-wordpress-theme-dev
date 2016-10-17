<?php

/**
 * Full custom post type setup example
 */

$labels = array(
	'name'               => 'Movies',
	'singular_name'      => 'Movie',
	'add_new'            => 'Add New',
	'add_new_item'       => 'Add New Movie',
	'edit_item'          => 'Edit Movie',
	'new_item'           => 'New Movie',
	'all_items'          => 'All Movies',
	'view_item'          => 'View Movies',
	'search_items'       => 'Search Movies',
	'not_found'          => 'No movies found',
	'not_found_in_trash' => 'No movies found in Trash', 
	'parent_item_colon'  => '',
	'menu_name'          => 'Movies'
  );

$args = array(
	'labels'              => $labels,
	'description'         => "",
	'exclude_from_search' => false,
	'public'              => true,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_nav_menus'   => true, 
	'show_in_menu'        => true, 
	'show_in_admin_bar'   => true, 
	'query_var'           => true,
	'rewrite'             => array( 'slug' => 'movie' ),
	'capability_type'     => 'post',
	'menu_icon'           => bloginfo('template_directory') . '/images/movie-menu-icon.png',
	'has_archive'         => true,
	'hierarchical'        => false,
	'menu_position'       => 20,
	'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
	'can_export'          => true,
  ); 

register_post_type( 'ptd_movie', $args );
