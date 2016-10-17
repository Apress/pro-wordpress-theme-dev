<?php

/**
 * Adding role to admin with the WP_User class
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
		'edit_pages' => false,
	));

	if (null !== $result) {
		$admin = new WP_User( 1 );
		$admin->add_role('moderator');
	} 
}
