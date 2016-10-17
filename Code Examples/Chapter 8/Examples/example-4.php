<?php

/**
 * Creating custom user capabilities
 */

// With a new role

function prowordpress_add_reviewer_role () {
	$result = add_role(reviewer', 'Movie Reviewer, array(
		'read' => 1,
		'edit_movies' => 1,
		'publish_movies' => 1,
		'delete_movies' => 1,
		'upload_files' => 1,
	));
}

add_action('after_switch_theme', 'prowordpress_add_reviewer_role');

// Adding to an existing role

$mod = get_role('moderator');

$caps = array (
		'edit_movies',
		'publish_movies',
		'delete_movies',
		'edit_others_movies',
		'delete_others_movies',
		'read_private_movies',
	);

foreach( $caps as $cap ) {
	$mod->add_cap( $cap );	
}
