<?php

/**
 * Adding post type support to default post types
 */

add_action('init', 'prowordpress_add_excerpt_support');

function prowordpress_add_excerpt_support() {
	add_post_type_support( 'page', 'excerpt' );
}


/**
 * Testing for post type support
 */
?>

<?php if( post_type_supports( 'ptd_movie', 'excerpt' ) ) : ?>

	<div class="movie-synopsis">
		<?php the_excerpt(); ?>
	</div>

<?php endif; ?>
