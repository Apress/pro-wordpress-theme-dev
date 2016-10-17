<?php

/**
 * Shortcode with parameters example
 */

function prowordpress_related_posts_shortcode($atts) {
	global $post;

	extract(shortcode_atts( array(
			'limit'    => 5,
			'category' => ""
		), $atts ));

	$tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
	$output = false;
	if ($tags) {
		$args = array(
			'tag__in'          => $tags,
			'post__not_in'     => array($post->ID),
			// Using the extracted $limit attribute
			'posts_per_page'   => $limit, 
			// Using the extracted $category attribute
			'category_name'    => $category, 
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

	// if no related posts just get recent posts
	return "<p>There are currently no related posts for this article</p>";
}
