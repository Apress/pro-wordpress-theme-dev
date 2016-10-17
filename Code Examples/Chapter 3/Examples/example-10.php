<?php

/**
 * Meta data queries
 */

$args = array (
	'post_type'  => 'any',
	'meta_key'   => 'title',
	'meta_value' => 'desc',
);

$new_query = new WP_Query($args);

// Advanced example

$args = array (
	'post_type'  => 'any',
	'meta_query' => array(
			array (
				'key'     => 'publisher',
				'value'   => 'Marvel',
				'compare' => '=',
			),
			array (
				'key'     => 'price',
				'value'   => array( 50, 100 ),
				'type'    => 'numeric',
				'compare' => 'BETWEEN',
			),
		),
);
$new_query = new WP_Query($args);