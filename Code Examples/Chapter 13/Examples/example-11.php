<?php
/**
 * Called when the plugin is uninstalled.
 */

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

// Set table name
$table_name = $wpdb->prefix . "ratings_and_reviews";

// Remove the table (if it exists)
$wpdb->query("DROP TABLE IF EXISTS $table_name");

// Remove any other options the plugin installed
