<?php 

/**
 * Full user registration example
 */

// Example of some form fields
?>

<label for="email-address">Email address</label>
<input type="email" name="user_email" id="email-address" placeholder="name@example.com" required>

<label for="username">Username</label>
<input type="text" name="user_login" id="username" required>

<label for="firstname">First name</label>
<input type="text" name="first_name" id="firstname" required>

<?php
// Processing function

function prowordpress_process_full_registration() {
	
	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['full_registration']) ) {
		// Unset the submit button value from the postdata 
		unset($_POST['full_registration']);

		$userdata = array();		

		// Loop through the $_POST variable to create our $userdata array
		foreach($_POST as $key => $value) {
			$userdata[ $key ] = $value;
		}

		if( email_exists( $userdata['user_email'] ) ) {
			wp_redirect( $_SERVER['REQUEST_URI'] . '?error=1' );
			exit();
		} elseif( username_exists( $userdata['user_login'] )) {
			wp_redirect( $_SERVER['REQUEST_URI'] . '?error=2' );
			exit();
		}
		else {
			$user = wp_insert_user( $userdata );

			if( is_wp_error($user) ) {
				wp_redirect( $_SERVER['REQUEST_URI'] . '?error=3');
				exit();
			} else {
				wp_new_user_notification( $user );
			}			
		}
	}
}
add_action('template_redirect', 'prowordpress_process_full_registration');
