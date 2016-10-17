<?php
/**
 * version of get_posts
 */

// version 1

$new_posts = get_posts( $args );

foreach ( $new_posts as $post ):
	setup_postdata($post);
	// Do stuff - using normal template tags
endforeach;

wp_reset_postdata();

// version 2

$new_posts = get_posts( $args );
foreach ( $new_posts as $post ):
	echo '<h1>'.$post->post_title.'</h1>';
	
	echo $post->post_content; // raw
	
	echo apply_filters('the_content', $post->post_content); // formatted
endforeach;