<?php

/**
 * Taxonomy contextual help tabs
 */

function prowordpress_add_help_text( $contextual_help, $screen_id, $screen ) { 
 	if ( 'ptd_movie' == $screen->id ) {

		// Add contextual help to $contextual_help variable

	} elseif ( 'edit-ptd_movie' == $screen->id ) {

		// Add contextual help to $contextual_help variable

 	} elseif ( 'edit-ptd_genre' == $screen->id ) {

	    $contextual_help .= 
	      '<p>' . __('Add movie genres to the Genre taxonomy to help classify the movies added', 'prowordpress') . '</p>' ;
 	}

return $contextual_help;
}
add_action( 'contextual_help', 'prowordpress_add_help_text', 10, 3 );


function prowordpress_custom_help_tab() {
	global $post_ID;
	$screen = get_current_screen();

	// Custom post type code here

	if ( is_taxonomy( 'ptd_genre' ) ) {
		$screen->add_help_tab( array(
			'id' => 'movie_help_genre', //unique id for the tab
			'title' => 'Genres', //unique visible title for the tab
			'content' => '<h3>Choosing genres</h3><p>For help with selecting the correct genre for your movie you could check out the information on <a href="http://www.imdb.com/">imdb.com</a>.</p>', 
		));	
	}
}

add_action('admin_head', 'prowordpress_custom_help_tab');
