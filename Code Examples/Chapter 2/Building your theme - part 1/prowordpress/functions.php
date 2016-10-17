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
	}

endif; // ao_starter_setup
add_action( 'after_setup_theme', 'prowordpress_setup' );

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