<?php

/**
 * Simple registration example
 */

// Form for registration
?>
<form action="<?php the_permalink(); ?>" method="post">
	<label for="email-address">Enter your email address to register</label>
	<input type="email" name="email_address" id="email-address" placeholder="name@example.com" required>

	<input type="submit" name="simple_registration" value="Register">
</form>


<?php
// Processing function

function prowordpress_process_simple_registration() {
	// Check that a POST request has been made 
	// and that there is POST data 
	// and the POST data contains the simple_registration field	
	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['simple_registration']) ) {
		// Save the POST email value to a local variable
		$email = $_POST['email_address'];

		// Check if there is already a user with the email address or username already set up
		if( email_exists( $email ) || username_exists( $email ) ) {
			// redirect to the same page with an error
			wp_redirect( $_SERVER['REQUEST_URI'] . '?error=1' );
			exit();			
		} else {
			// Generate a password for the user
			$password = wp_generate_password( 8 );
			// Create the user, returns either the User ID or error
			$user = wp_create_user( $email, $password, $email );

			// Test if there was an error when the user was created
			if( is_wp_error($user) ) {
				// redirect to the same page with an error
				wp_redirect( $_SERVER['REQUEST_URI'] . '?error=1');
				exit();
			} else {
				// Notify the new user and send them their password
				wp_new_user_notification( $user, $password );
			}			
		}
	}

}
add_action('template_redirect', 'prowordpress_process_simple_registration');
