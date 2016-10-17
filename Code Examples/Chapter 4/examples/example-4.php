<?php

/**
 * Updated messages example
 */

function prowordpress_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['ptd_movie'] = array(
		0 => '', 
		1 => sprintf( __('Movie updated. <a href="%s">View movie</a>', 'prowordpress'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'prowordpress'),
		3 => __('Custom field deleted.', 'prowordpress'),
		4 => __('movie updated.', 'prowordpress'),
		5 => isset($_GET['revision']) ? sprintf( __('Movie restored to revision from %s', 'prowordpress'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Movie published. <a href="%s">View Movie</a>', 'prowordpress'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Movie saved.', 'prowordpress'),
		8 => sprintf( __('Movie submitted. <a target="_blank" href="%s">Preview movie</a>', 'prowordpress'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Movie scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview movie</a>', 'prowordpress'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Movie draft updated. <a target="_blank" href="%s">Preview movie</a>', 'prowordpress'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'prowordpress_updated_messages' );
