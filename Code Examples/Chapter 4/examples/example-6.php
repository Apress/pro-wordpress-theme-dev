<?php 

/**
 * Custom help tabs example
 */

function prowordpress_custom_help_tab() {
	global $post_ID;
	$screen = get_current_screen();

	if( isset($_GET['post_type']) ) $post_type = $_GET['post_type'];
	else $post_type = get_post_type( $post_ID );

	if( $post_type == 'ptd_movies' ) {

		$screen->add_help_tab( array(
			'id' => 'movie_help_genre', //unique id for the tab
			'title' => 'Genres', //unique visible title for the tab
			'content' => '<h3>Choosing genres</h3><p>For help with selecting the correct genre for your movie you could check out the information on <a href="http://www.imdb.com/">imdb.com</a>.</p>', 
		));
	}
}

add_action('admin_head', 'prowordpress_custom_help_tab');
