<?php

/**
 * Related posts shortcode example
 */

function prowordpress_related_posts_shortcode() {
	global $post;

	$tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
	$output = false;
	if ($tags) {
		$args = array(
			'tag__in'          => $tags,
			'post__not_in'     => array($post->ID),
			'posts_per_page'   => 5,
		);
	
		$related = new WP_Query($args);
		
		if( $related->have_posts() ) {
			$output = '<h2>Recent posts</h2>';
			$output .= '<ul class="related-posts">';

			while ($related->have_posts()) {
				$related->the_post();
				$output .= '<li><a href="'.get_permalink().'">'. get_the_title().'</a></li>';
			}

			$output .= "</ul>";
		
		}
	
		return $output;
	}

	// if no related posts then show an error message
	return "<p>There are currently no related posts for this article</p>";
}

function prowordpress_setup_shortcodes () {
	add_shortcode('related_posts', 'prowordpress_related_posts_shortcode');	
}

add_action( 'init', 'prowordpress_setup_shortcodes' );
