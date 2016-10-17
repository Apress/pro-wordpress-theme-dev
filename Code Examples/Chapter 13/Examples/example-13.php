<?php

if( is_admin() ) {
    add_action( 'admin_menu', 'rar_add_plugin_menu' );
}

function rar_add_plugin_menu() {
	// Add the top level menu page
	add_menu_page( 'Ratings & Reviews settings', 'Ratings & Reviews', 'manage_options', 'rar-admin-menu' );
	// Add the first sub-page - overwrite default
	add_submenu_page( 'rar-admin-menu', 'Ratings & Reviews - Dashboard', 'Dashboard', 'manage_options', 'rar-admin-menu', 'rar_create_admin_dashboard' );
	// Add more sub-pages
	add_submenu_page( 'rar-admin-menu', 'Ratings & Reviews - View posts', 'View posts', 'manage_options', 'rar-admin-view-posts', 'rar_create_admin_view_posts' );
}

function rar_create_admin_dashboard() {
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2>Dashboard</h2>			
        
</div>
<?php
}

function rar_create_admin_view_posts() {
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2>View Posts</h2>			
        
</div>
<?php
}
