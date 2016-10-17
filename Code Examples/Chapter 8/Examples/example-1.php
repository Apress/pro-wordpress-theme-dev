<?php

/**
 * Adding roles example
 */

function prowordpress_add_moderator_role () {
	$result = add_role('moderator', 'Moderator', array(
		'read' => 1,
		'edit_posts' => 1,
		'delete_posts' => 1,
		'edit_others_posts' => 1,
		'edit_published_posts' => 1,
		'publish_posts' => 1,
		'delete_others_posts' => 1,
		'delete_published_posts' => 1,
		'moderate_comments' => 1,
		'manage_categories' => 1,
		'upload_files' => 1,
		'edit_pages' => false, // explicitly deny capability
	));

	if (null !== $result) {
		echo "Role created";
	} else {
		echo "Role already exists!";
	}
}

add_action('after_switch_theme', 'prowordpress_add_moderator_role');


/**
 * Removing a role example
 */

function prowordpress_remove_moderator_role () {
	remove_role( 'moderator' );
}

add_action('switch_theme', 'prowordpress_remove_moderator_role');
