<?php

/**
 * Querying with custom fields
 */

WP_Query( array( 
	'post_type'           => 'ptd_movie',
	'meta_query'          => array(
			'relation'    => 'AND',
			array(
				'key'     => 'ptd_release_year', 
				'value'   => array(2000,2010), 
				'compare' => 'BETWEEN'
			),
			array(
				'key'     => 'ptd_running_time', 
				'value'   => 120 
				'compare' => '<'
			)
		)
	) 
);
