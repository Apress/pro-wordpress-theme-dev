<?php

/**
 * Testing user capabilites examples
 */

if ( current_user_can( 'update_plugins' ) ) {
	$update_plugins = get_site_transient( 'update_plugins' );
	if ( ! empty( $update_plugins->response ) )
		$counts['plugins'] = count( $update_plugins->response );
}

if ( current_user_can( 'update_themes' ) ) {
	$update_themes = get_site_transient( 'update_themes' );
	if ( ! empty( $update_themes->response ) )
		$counts['themes'] = count( $update_themes->response );
}

if ( function_exists( 'get_core_updates' ) && current_user_can( 'update_core' ) ) {
	$update_wordpress = get_core_updates( array('dismissed' => false) );
	if ( ! empty( $update_wordpress ) && ! in_array( $update_wordpress[0]->response, array('development', 'latest') ) && current_user_can('update_core') )
		$counts['wordpress'] = 1;
}

// In custom meta boxes

function prowordpress_movies_meta_box () {
	global $post;

	if( current_user_can('publish_movies') ) {
		add_meta_box (
				'ptd_movies_meta',
				__('Movie details', 'prowordpress'),
				'prowordpress_movie_meta_fields',
				'ptd_movie',
				'side',
				'core'
			);
	}
}

add_action ('add_meta_boxes', 'prowordpress_movies_meta_box');

// In the custom meta save function

// Check if the current user has permission to edit the post.
if ( ! current_user_can( 'publish_movies', $post_id ) ) {
	return $post_id;
}

