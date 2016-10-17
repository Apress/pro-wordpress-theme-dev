<?php
/**
 * Pro WordPress functions and definitions
 *
 * @package prowordpress
 */

/**
 * Include our custom types functions
 */
require( get_template_directory() . '/inc/custom-types.php' );

/**
 * Include custom theme functions
 */
require( get_template_directory() . '/inc/theme-functions.php' );
/**
 * Include the custom widgets file
 */
require( get_template_directory() . '/inc/custom-widgets.php' );
/**
 * Include the theme options file
 */
require( get_template_directory() . '/inc/theme-options.php' );

/**
 * Include the users file - contains all functions for working with users on the site
 */
require( get_template_directory() . '/inc/users.php' );

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
 * Enqueue scripts and styles
 */
function prowordpress_scripts_and_styles() {
	wp_enqueue_style( 'fonts', 'http://fonts.googleapis.com/css?family=Clicker+Script|EB+Garamond' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array( 'fonts' ) );


	// $palette = get_theme_mod('color_palette', 'palette-1');
	// wp_enqueue_style( 'palette', get_template_directory_uri() . '/css/' . $palette . '.css' , array('style') );

	/**
	 * Better jQuery inclusion
	 */
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '1.9', true);
		wp_enqueue_script('jquery');
	}
}
add_action( 'wp_enqueue_scripts', 'prowordpress_scripts_and_styles' );

function prowordpress_register_widgets() {
	register_widget( 'Featured_Widget' );
}

add_action( 'widgets_init', 'prowordpress_register_widgets' );
