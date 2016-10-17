<?php

/**
 * Contextual help example
 */

function prowordpress_add_help_text( $contextual_help, $screen_id, $screen ) { 
 	if ( 'ptd_movie' == $screen->id ) {
		$contextual_help =
		  '<p>' . __('Things to remember when adding or editing a movie:', 'prowordpress') . '</p>' .
		  '<ul>' .
		  '<li>' . __('Add the synopsis to the main content editor.', 'prowordpress') . '</li>' .
		  '<li>' . __('You can also add a custom excerpt of the synopsis to display on the listing page in the excerpt box', 'prowordpress') . '</li>' .
		  '</ul>' .
		  '<p>' . __('If you want to schedule the book review to be published in the future:', 'prowordpress') . '</p>' .
		  '<ul>' .
		  '<li>' . __('Under the Publish module, click on the Edit link next to Publish.', 'prowordpress') . '</li>' .
		  '</ul>' .
		  '<p><strong>' . __('For more information:', 'prowordpress') . '</strong></p>' .
		  '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>', 'prowordpress') . '</p>' .
		  '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'prowordpress') . '</p>' ;
	} elseif ( 'edit-ptd_movie' == $screen->id ) {
	    $contextual_help .= 
	      '<p>' . __('Pick a movie to edit from the list or add a new movie from this screen', 'prowordpress') . '</p>' ;
 	}
  return $contextual_help;
}
add_action( 'contextual_help', 'prowordpress_add_help_text', 10, 3 );
