<?php 

/**
 * Listing all taxonomy terms (like categories)
 */

$args = array(
	'taxonomy'     => 'ptd_genre',
	'orderby'      => 'name',
	'order'        => 'ASC',
	'style'        => 'list',
	'show_count'   => 0,
	'hide_empty'   => 0,
	'title_li'     => '',
	'depth'        => 1,
); 
?>

<ul class="genre-terms">
	<?php wp_list_categories( $args ); ?>
</ul>


<?php

/**
 * Return terms in PHP
 */

$args = array(
	'orderby'      => 'name',
	'order'        => 'ASC',
	'style'        => 'list',
	'show_count'   => 0,
	'hide_empty'   => 0,
	'title_li'     => '',
	'depth'        => 1,
); 

$genres = get_terms( 'ptd_genre', $args ); 
?>
