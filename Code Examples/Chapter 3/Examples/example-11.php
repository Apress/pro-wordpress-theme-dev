<?php

/**
 * Custom queries pagination
 */

global $paged; // globalize the paged variable.
query_posts('post_type=review&posts_per_page=4&paged='.$paged);

if( have_posts() ):
	while( have_posts() ): the_post();
		// Do stuff...
	endwhile;
	
	next_posts_link();
	previous_posts_link();
endif;