<?php 

/**
 * Taxonomy query example
 */

if ( !empty($q['tag__and']) ) {
	$q['tag__and'] = array_map('absint', array_unique( (array) $q['tag__and'] ) );
	$tax_query[] = array(
		'taxonomy' => 'post_tag',
		'terms' => $q['tag__and'],
		'operator' => 'AND'
	);
}


// Another query example

'tax_query' => array(
	array(
		'taxonomy' => 'ptd_genre',
		'field' => 'slug',
		'terms' => 'comedy'
		)
	
),

// Full tax query example

'tax_query' => array(
		array(
			'taxonomy'         => 'ptd_genre',
			'field'            => 'slug',
			'terms'            => array('horror', 'thriller', 'drama'),
			'operator'         => 'NOT IN',
			'include_children' => false,
			)
		
	)

// Multiple taxonomies in the same query

'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy'         => 'ptd_genre',
			'field'            => 'slug',
			'terms'            => array('horror', 'thriller', 'drama'),
			'operator'         => 'NOT IN',
			'include_children' => false,
			),
		array(
			'taxonomy'         => 'ptd_actor',
			'field'            => 'slug',
			'terms'            => array('simon-pegg', 'nick-frost' ),
			'operator'         => 'AND',
			)		
	)

// And even more

'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'ptd_genre',
			'field'    => 'slug',
			'terms'    => array('horror', 'thriller', 'drama'),
			'operator' => 'NOT IN',
			),
		array(
			'taxonomy' => 'ptd_actor',
			'field'    => 'slug',
			'terms'    => array( 'zooey-deschanel' ),
			),
		array(
			'taxonomy' => 'ptd_writer',
			'field'    => 'slug',
			'terms'    => array( 'seth-rogen', 'kevin-smith' ),
		),
	)
