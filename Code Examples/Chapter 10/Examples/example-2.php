<?php

/**
 * Changer the default login error message
 */

function plain_error_message($message) {
	$message = "<strong>Error</strong>: Incorrect username or password.";
	return $message;
}

add_filter('login_errors', 'plain_error_message' );
