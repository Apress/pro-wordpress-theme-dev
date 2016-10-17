<?php

/**
 * Menu page capabilities example
 */

function prowordpress_add_moderator_page() {
	add_menu_page( 'Moderation stats', 'Moderation Stats', 'moderator_view_stats', 'moderator-admin-menu', 'prowordpress_build_moderator_stats' );

	$mod = get_role('moderator');
	$mod->add_cap('moderator_view_stats');

	$admin = get_role('administrator');
	$admin->add_cap('moderator_view_stats');
}

if( is_admin() ) {
	add_action( 'admin_menu', 'prowordpress_add_moderator_page' );
}
