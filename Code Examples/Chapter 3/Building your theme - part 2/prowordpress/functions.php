<?php
/**
 * Pro WordPress functions and definitions
 *
 * @package prowordpress
 */

if ( ! function_exists( 'prowordpress_setup' ) ) :

	function prowordpress_setup() {

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'prowordpress' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	}

endif; // ao_starter_setup
add_action( 'after_setup_theme', 'prowordpress_setup' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );


/**
 * Enqueue scripts and styles
 */
function prowordpress_scripts_and_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	/**
	 * Better jQuery inclusion
	 */
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
		wp_enqueue_script('jquery');
	}
}
add_action( 'wp_enqueue_scripts', 'prowordpress_scripts_and_styles' );

/**
 * Extra helper functions
 */

function simple_copyright () {
	echo "&copy; " . get_bloginfo('name') ." ". date("Y");
}

/**
 * Custom post types
 */
function prowordpress_post_types() {
	$types = array(
			'ptd_staff' => array(
				'menu_title' => 'Staff',
				'plural'     => 'People',
				'singular'   => 'Person',
				'supports'   => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'page-attributes'),
				'slug'       => 'staff'
				),
			'ptd_menu' => array(
				'menu_title' => 'Menu',
				'plural'     => 'Items',
				'singular'   => 'Item',
				'supports'   => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'page-attributes'),
				'slug'       => 'menu'
				)
		);

	$counter = 0;
	foreach( $types as $type => $arg ) {

		$labels = array(
			'name'               => $arg['menu_title'],
			'singular_name'      => $arg['singular'],
			'add_new'            => 'Add new',
			'add_new_item'       => 'Add new '.strtolower($arg['singular']),
			'edit_item'          => 'Edit '.strtolower($arg['singular']),
			'new_item'           => 'New '.strtolower($arg['singular']),
			'all_items'          => 'All '.strtolower($arg['plural']),
			'view_item'          => 'View '.strtolower($arg['plural']),
			'search_items'       => 'Search '.strtolower($arg['plural']),
			'not_found'          => 'No '.strtolower($arg['plural']).' found',
			'not_found_in_trash' => 'No '.strtolower($arg['plural']).' found in Trash', 
			'parent_item_colon'  => '',
			'menu_name'          => $arg['menu_title']
		);

		register_post_type( $type, 
			array(
				'labels'          => $labels,
				'public'          => true,
				'has_archive'     => true,
				'capability_type' => 'post',
				'supports'        => $arg['supports'],
				'rewrite'         => array( 'slug' => $arg['slug'] ),
				'menu_position'   => (20 + $counter),
			)
		);

		$counter++;
	}
}
add_action('init', 'prowordpress_post_types');


function prowordpress_updated_messages( $messages ) {
	global $post, $post_ID;

	$types = array(
			'ptd_staff' => 'Person',
			'ptd_menu' => 'Item',
		);

	foreach( $types as $type => $title) {
		$messages[$type] = array(
			0 => '', 
			1 => sprintf( __('%s updated. <a href="%s">View %s</a>'),$title, esc_url( get_permalink($post_ID) ),$title ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __(strtolower($title).' updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('%s restored to revision from %s'),$title, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('%s published. <a href="%s">View %s</a>'), $title, esc_url( get_permalink($post_ID) ), strtolower($title) ),
			7 => __($title.' saved.'),
			8 => sprintf( __('%s submitted. <a target="_blank" href="%s">Preview %s</a>'), $title, esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), strtolower($title) ),
			9 => sprintf( __('%s scheduled for: <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview %1$s</a>'), $title, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('%s draft updated. <a target="_blank" href="%s">Preview %s</a>'), $title, esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), strtolower($title) ),
		);	
	}
	return $messages;
}
add_filter( 'post_updated_messages', 'prowordpress_updated_messages' );

function prowordpress_custom_columns( $cols ) {
	$cols = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Title', 'prowordpress' ),
		'photo' => __( 'Thumbnail', 'prowordpress' ),
		'date'     => __( 'Date', 'prowordpress' ),
	);
	return $cols;
}
add_filter( "manage_ptd_staff_posts_columns", "prowordpress_custom_columns" );
add_filter( "manage_ptd_menu_posts_columns", "prowordpress_custom_columns" );

function prowordpress_custom_column_content( $column, $post_id ) {
  
	switch ( $column ) {
		case "photo":
			if( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array(50,50));
			}
			break;
  	}
}
add_action( "manage_ptd_staff_posts_custom_column", "prowordpress_custom_column_content", 10, 2 );
add_action( "manage_ptd_menu_posts_custom_column", "prowordpress_custom_column_content", 10, 2 );

function prowordpress_customise_feed($args) {

	if( isset($args['feed']) && !isset($args['post_type']) ) {
		$args['post_type'] = array('post', 'ptd_menu');
	}
	
	return $args;
}
add_filter('request', 'prowordpress_customise_feed');