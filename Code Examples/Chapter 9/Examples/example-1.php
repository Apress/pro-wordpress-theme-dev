<?php 

/**
 * Pagination example
 */

global $wp_query;

$big = 999999999; // need an unlikely integer

echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '/page/%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages,
	'prev_next'    => True,
	'prev_text'    => __('« Newer posts'),
	'next_text'    => __('Older posts »'),
) );
