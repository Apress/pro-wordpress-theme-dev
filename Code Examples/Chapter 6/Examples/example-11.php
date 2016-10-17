<?php

/**
 * Register widget example
 */

function prowordpress_register_widgets() {
	register_widget( 'Genre_Widget' );
}

add_action( 'widgets_init', 'prowordpress_register_widgets' );
