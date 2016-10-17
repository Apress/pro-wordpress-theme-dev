<?php

/**
 * Simple register post type
 */

register_post_type( 'ptd_movie',
		array(
			'labels' => array(
				'name' => __( 'Movies', 'prowordpress' ),
				'singular_name' => __( 'Movie', 'prowordpress' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);


// Inside an action

add_action('init', 'new_post_types');

function new_post_types() {
	register_post_type( 'ptd_movie',
			array(
				'labels' => array(
					'name' => __( 'Movies', 'prowordpress' ),
					'singular_name' => __( 'Movie', 'prowordpress' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);	
}
