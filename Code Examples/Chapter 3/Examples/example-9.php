<?php

/**
 * Taxonomy queries
 */

// Get review posts which are in the category sci-fi and actors included Matt LeBlanc and Heather Graham
$args = array (
	'post_type' => 'review',
	'tax_query' => array(
	'relation'  => 'AND',
				array (
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => 'sci-fi',
				),
				array (
					'taxonomy' => 'actor',
					'field'    => 'slug',
					'terms'    => array('matt-leblanc','heather-graham'),
					'operator' => 'IN',
				),
	),
);

$new_query = new WP_Query($args);