<?php

/**
 * Flush rewrite rules examples
 */

// Basic

add_action( 'after_switch_theme', 'prowordpress_flush_rewrite_rules' );

function prowordpress_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// Full example based on registering post types

add_action( 'init', 'my_cpt_init' );
function my_cpt_init() {
	// register our post types
}

function my_rewrite_flush() {
	my_cpt_init();

	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'my_rewrite_flush' );

function myplugin_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'myplugin_deactivate' );
