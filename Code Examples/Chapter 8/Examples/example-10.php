<?php

/**
 * Adding new login page logo with hook
 */

function twelvedevs_login_logo() { ?>
	<style type="text/css">
		.login #login {
			padding-top:50px;
		}

		.login h1 a {
			width:100%;
			height:220px;
			padding-bottom: 30px;
			background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/12devslogo.png);
			background-size:221px 220px;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'twelvedevs_login_logo' );
