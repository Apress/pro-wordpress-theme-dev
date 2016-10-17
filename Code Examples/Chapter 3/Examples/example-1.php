<?php

/**
 * Versions of Query posts
 */

// version 1

$args = array(
		'cat'            => 5,
		'posts_per_page' => 2,
		'order'          => 'ASC'
	);
query_posts($args);

// version 2

$args = "cat=5&posts_per_page=2&order=ASC";
query_posts($args);

// version 3

query_posts("cat=5" );

if( have_posts() ): while( have_posts() ): the_post();
	// Do stuff
endwhile; endif;