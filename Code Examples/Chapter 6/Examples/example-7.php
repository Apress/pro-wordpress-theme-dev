<?php 

/**
 * Shortcode (wrapper style) with content 
 */

function prowordpress_related_posts_shortcode($atts, $content = null) {
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
			if( ! is_null( $content ) ) {
				$output = $content;	
			} else {
				$output = '<h2>Related posts</h2>';
			}
			
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
