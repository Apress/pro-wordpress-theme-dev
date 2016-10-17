<?php

function rar_create_table() {
	global $wpdb;

	$table_name = $wpdb->prefix . "ratings_and_reviews";

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		user_id bigint(20) unsigned NOT NULL default '0',
		post_id bigint(20) unsigned NOT NULL default '0',
		posted datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		review_title VARCHAR(255) DEFAULT '' NOT NULL,
		review_content text NOT NULL,
		rating tinyint(10) unsigned NOT NULL default '1',
		PRIMARY KEY  (id)
		);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
