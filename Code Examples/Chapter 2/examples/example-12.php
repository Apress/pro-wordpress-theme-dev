<?php 
function prowordpress_is_template( $name = false ) {
	global $post;
	$template_file = get_post_meta($post->ID,'_wp_page_template',TRUE);

	// check for a template type
	if( $name ):
		if ( $name === $template_file ):
			return true;
		else:
			return false;
		endif;
	else:
		return $template_file;
	endif;
}