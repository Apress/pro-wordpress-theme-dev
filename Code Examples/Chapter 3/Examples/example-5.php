<?php

/**
 * Multiple queries
 */

if( have_posts() ): while( have_posts() ): the_post();
	// Do stuff
endwhile; endif;

$secondary_query = new WP_Query( $args );

if( $ secondary_query->have_posts() ): while( $ secondary_query->have_posts() ): $ secondary_query->the_post();
	// Do stuff - with normal template tags
endwhile; endif;

wp_reset_postdata();