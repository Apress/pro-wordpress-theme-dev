<?php

/**
 * Custom post types query example
 */

$args = array(
		'post_type'      => 'ptd_movie',
		'posts_per_page' => 10,
		'orderby'        => 'title',
		'order'          => 'ASC'
		);
$movies = new WP_Query( $args );

if( $movies->have_posts() ) : while( $movies->have_posts() ) : $movies->the_post(); ?>

	<article <?php post_class(); ?>>
		<h2><?php the_title(); ?></h2>
		
		<?php the_content(); ?>
	</article>

<?php endwhile; endif; ?>

<?php
// Adding custom post types to default query

add_action( 'pre_get_posts', 'prowordpress_custom_post_types_in_main_query' );

function prowordpress_custom_post_types_in_main_query( $query ) {
	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'ptd_movie' ) );
	}
		
	return $query;
}
