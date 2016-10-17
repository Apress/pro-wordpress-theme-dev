<?php

/**
 * Custom backgrounds theme support example
 */


// Simple
add_theme_support( 'custom-background' );

// With arguments
$defaults = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );
