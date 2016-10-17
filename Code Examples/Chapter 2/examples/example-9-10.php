<?php

$theme = wp_get_theme();
wp_register_script( 'core', get_template_directory_uri() . '/javascript/core.js', array( 'jquery' ), $theme->Version, true);

if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', (" http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js "), false);
	wp_enqueue_script('jquery');
}