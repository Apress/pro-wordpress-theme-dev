<?php

/**
 * Custom action with parameters
 */

$genres = get_the_terms(get_the_id(), 'ptd_genre');
foreach( $genres as $gen ):
	$gen_ids[] = $gen->term_id;
endforeach;

do_action( 'ptd_movie_end_main_content', get_the_ID(), $gen_ids, 'ptd_genre' );

// You would then need to set the function and add_action calls up like this:

function ptd_show_related_movie_trailer( $post_id, $term_ids, $taxonomy_slug ) {
	// Do stuff
}

add_action( 'ptd_movie_end_main_content', 'ptd_show_related_movie_trailer', 10, 3 );
