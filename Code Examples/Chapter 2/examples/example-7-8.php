<?php

// Get the current theme object
$theme = wp_get_theme();
wp_register_style( 'prowordpress-style', get_stylesheet_uri(), false, $theme->Version, 'screen');
wp_enqueue_style('prowordpress-style');

global $wp_styles;

wp_register_style( 'prowordpress-ie', get_template_directory_uri() . '/ie-old.css', array( 'prowordpress-style' ));
$wp_styles->add_data( 'prowordpress-ie', 'conditional', 'lte IE 7' );
wp_enqueue_style('prowordpress-ie');