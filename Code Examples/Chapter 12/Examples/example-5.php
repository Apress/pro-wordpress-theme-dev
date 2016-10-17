<?php

/**
 * Loading text domains
 */


// Standard Theme
function prowordpress_setup() {

	load_theme_textdomain('prowordpress', get_template_directory() . '/lang');
}
add_action( 'after_setup_theme', 'prowordpress_setup' );


// Plugins
function prowordpress_plugin_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'prowordpress', false, $plugin_dir );
}

add_action('plugins_loaded', 'prowordpress_plugin_init');


// Child themes
function prowordpress_child_theme_setup() {
	load_child_theme_textdomain( 'prowordpress-child', get_stylesheet_directory() . '/lang' );
}
add_action( 'after_setup_theme', 'prowordpress_child_theme_setup' );

