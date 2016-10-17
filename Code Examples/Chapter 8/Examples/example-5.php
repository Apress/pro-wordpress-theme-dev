<?php

/**
 * Custom post type capabilities
 */

register_post_type(
	'ptd_movie',
	array(
		'public' => true,
		'capability_type' => 'movie',
		'capabilities' => array(
			'publish_posts' => 'publish_movies',
			'edit_posts' => 'edit_movies',
			'edit_others_posts' => 'edit_others_movies',
			'delete_posts' => 'delete_movies',
			'delete_others_posts' => 'delete_others_movies',
			'read_private_posts' => 'read_private_movies',
			'edit_post' => 'edit_movie',
			'delete_post' => 'delete_movie',
			'read_post' => 'read_movie',
		),
	)
);
