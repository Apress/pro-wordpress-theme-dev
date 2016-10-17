<?php

/**
 * TinyMCE button example
 */

function prowordpress_register_shortcode_button( $buttons ) {
	array_push( $buttons, "relatedposts" );
	return $buttons;
}

function prowordpress_add_shortcode_plugin( $plugin_array ) {
	$plugin_array['relatedposts'] = get_template_directory_uri() . '/javascript/shortcode.js';
	return $plugin_array;
}


function prowordpress_related_posts_button() {

	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}

	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'prowordpress_add_shortcode_plugin' );
		add_filter( 'mce_buttons', 'prowordpress_register_shortcode_button' );
	}

}

add_action('init', 'prowordpress_related_posts_button');
