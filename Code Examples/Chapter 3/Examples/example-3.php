<?php 

/**
 * Using WP_Query
 */

$new_query = new WP_Query( $args );

if( $new_query->have_posts() ): while( $new_query->have_posts() ): $new_query->the_post();
	// Do stuff - with normal template tags
endwhile; endif;