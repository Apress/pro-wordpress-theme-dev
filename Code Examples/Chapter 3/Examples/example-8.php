<?php

/**
 * Advanced query examples
 */

$args = array (
	'post_type' => 'post',
	'cat'       => '5',
	'orderby'   => 'title',
	'order'     => 'desc',
);

$new_query = new WP_Query($args);

// Get posts which are in categories 2 and 6
$args = array (
	'post_type'     => 'post',
	'orderby'       => 'title',
	'order'         => 'desc',
	'category__and' => array( 2, 6 ),
);

$new_query = new WP_Query($args);