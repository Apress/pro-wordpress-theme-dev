<?php 

/**
 * Admin styles example
 */

add_action('admin_enqueue_scripts', 'my_admin_theme_style');

function my_admin_theme_style() {
    wp_enqueue_style('ptd-admin-theme', get_bloginfo('template_directory') . '/css/admin-style.css' );
}
