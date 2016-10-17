<?php

/**
 * Changing login page links
 */

function twelvedevs_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'twelvedevs_login_logo_url' );

function twelvedevs_login_logo_url_title() {
	return '12 Devs';
}
add_filter( 'login_headertitle', 'twelvedevs_login_logo_url_title' );
