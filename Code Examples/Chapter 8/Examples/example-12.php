<?php

/**
 * Adding a stylesheet to the login page 
 */

function twelvedevs_login_style() { ?>
	<link rel="stylesheet" id="custom_wp_login_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/css/login.css'; ?>" type="text/css" media="all" />
<?php 
}
add_action( 'login_enqueue_scripts', 'twelvedevs_login_style' );
