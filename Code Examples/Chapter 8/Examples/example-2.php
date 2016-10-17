<?php

/**
 * Capabilities examples
 */

// Adding capabilities

function prowordpress_setup_roles () {
	$author = get_role('author');

	$author->add_cap('edit_pages');
	$author->add_cap('publish_pages');
	$author->add_cap('delete_pages', false);
}

add_action('after_switch_theme', 'prowordpress_setup_roles');


// Removing capabilities

function prowordpress_reset_roles () {
	$author = get_role('author');

	$author->remove_cap('edit_pages');
	$author->remove_cap('publish_pages');
	$author->remove_cap('delete_pages');	
}

add_action('switch_theme', 'prowordpress_reset_roles');
