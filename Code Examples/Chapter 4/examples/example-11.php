<?php

/**
 * Adding custom post types to RSS feed
 */

function prowordpress_customise_feed($args) {

	if( isset($args['feed']) && !isset($args['post_type']) ) {
		$args['post_type'] = array('post', 'ptd_movie');
	}
	
	return $args;
}
add_filter('request', 'prowordpress_customise_feed');
