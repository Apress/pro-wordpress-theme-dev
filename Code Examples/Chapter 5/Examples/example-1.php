<?php

/**
 * Basic taxonomy setup
 */

function prowordpress_taxonomies() {
	register_taxonomy( 'ptd_genre', 'ptd_movie',
		array(
			'label'        => __( 'Genre', 'prowordpress' ),
			'rewrite'      => array( 'slug' => 'genre' ),
			'hierarchical' => true,
		)
	);
}
add_action('init', 'prowordpress_taxonomies');
