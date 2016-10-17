<?php

/**
 * Handling login errors examples
 */

function prowordpress_failed_login( $user ) {
	// save the referrer to a local var
	if( isset($_SERVER['HTTP_REFERER']) ) {
		$referrer = $_SERVER['HTTP_REFERER'];
	}

	// Check the referrer to make sure we're not coming from the default login page and there is no user set
	if ( ! empty($referrer) && ! strstr($referrer,'wp-login') && ! strstr($referrer,'wp-admin') && $user !== null ) {
		// Make sure the current referrer doesn't already have the login failed query string
		if ( ! strstr($referrer, '?login=failed' ) ) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer . '?login=failed');
		} else {
			wp_redirect( $referrer );
		}

		exit;
	}
}
add_action( 'wp_login_failed', 'prowordpress_failed_login' );


// Handling blank logins

function prowordpress_blank_login( $username ){
	// save the referrer to a local var
	if( isset($_SERVER['HTTP_REFERER']) ) {
		$referrer = $_SERVER['HTTP_REFERER'];	
	}	

	$error = false;
	// Check if either the username value or POST password value is empty
	if( empty($username) || empty($_POST['pwd']) ) {
		$error = true;
	}

	// check that were not on the default login page
	if ( ! empty($referrer) && ! strstr($referrer,'wp-login') && ! strstr($referrer,'wp-admin') && $error ) {

		// Make sure the current referrer doesn't already have the login failed query string
		if ( ! strstr($referrer, '?login=failed' ) ) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer . '?login=failed');
		} else {
			wp_redirect( $referrer );
		}

	exit;

	}
}

add_action( 'wp_authenticate', 'prowordpress_blank_login');


// Displaying login errors

?>
<?php
if( isset($_GET['login']) && 'failed' === $_GET['login']) :
?>
	<div class="message error-message">
		<p><?php _e('Login failed. Please check your details and try again.', 'prowordpress'); ?></p>
	</div>
<?php
endif;
?>
