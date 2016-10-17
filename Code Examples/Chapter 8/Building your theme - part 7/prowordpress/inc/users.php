<?php

/**
 * Register user role
 */

// Custom metadata for each staff member for their Twitter and Facebook accounts
function prowordpress_add_staff_role() {
	$result = add_role('staff', 'Staff Member', array(
		'read'                   => 1,
		'delete_posts'           => 1,
		'delete_published_posts' => 1, 
		'edit_posts'             => 1,
		'edit_published_posts'   => 1,
		'publish_posts'          => 1,
		'upload_files'           => 1,
	));
}
add_action('after_switch_theme', 'prowordpress_add_staff_role');

/**
 * Output login form
 */
function prowordpress_login_form() {
?>	
	<?php
	$args = array(
			'redirect' => home_url(),
			'form_id'         => 'loginform-custom',
			'id_username'     => 'user-login-custom',
			'id_password'     => 'user-pass-custom',
			'id_remember'     => 'rememberme-custom',
			'id_submit'       => 'wp-submit-custom',
		);
	wp_login_form( $args ); ?>

	<p><a class="forgot-pass-link" href="<?php echo wp_lostpassword_url(); ?>" title="<?php _e('Forgotten your password?', 'prowordpress'); ?>"><?php _e('Forgotten your password?', 'prowordpress'); ?></a></p>
<?php
}

/**
 * Handle failed login
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

/**
 * Handle blank login form error
 */
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

/**
 * Registration form action
 */
function prowordpress_register() {
	do_action('registration_form'); 
}

/**
 * Profile form action
 */
function prowordpress_profile() {
	do_action('profile_form'); 
}

function prowordpress_generate_form() {

	$args = array(
			'action'       => '',
			'submit_label' => __('Register', 'prowordpress'),
			'form'         => current_filter(),
		);

	// If we are dealing with a submitted form process the form
	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['user_form_submit']) ) {
		
		unset($_POST['user_form_submit']);

		if( 'profile_form' === $args['form'] ) {
			$result = prowordpress_process_update_user();
			echo $result['message'];
		} else {
			$result = prowordpress_process_registration();
			echo $result['message'];
		}
	}

	// If the hook is for the profile form, get the current user and pass it to the generate form function
	if( 'profile_form' === $args['form'] ) {
		$current_user = wp_get_current_user();
		$args['submit_label'] = __('Update profile', 'prowordpress');
		prowordpress_user_form($args, $current_user);
	// Else output an empty form
	} else {
		if( isset($result['user'] ) ) {
			// Cheat method of converting an array to an object
			$user = json_decode(json_encode($result['user']), FALSE);
		} else {
			$user = false;
		}
		prowordpress_user_form($args, $user);
	}	
}

add_action( 'registration_form', 'prowordpress_generate_form' );
add_action( 'profile_form', 'prowordpress_generate_form' );

/**
 * Output form for users for registration and profile page
 * @return [type] [description]
 */
function prowordpress_user_form($args, $user = false) {

	// Extract the arguments in the $args array to create usable variables
	extract($args);

	$username_disabled = '';

	if( 'profile_form' === $form ) {
		$username_disabled = 'disabled';
	}

	?>
	<form action="<?php echo $action; ?>" class="user-form" method="post">
		<ul>
			<li class="user-profile-field">
				<label for="username">Username</label>
				<input type="text" name="user_login" id="username" required value="<?php if( $user ) { echo $user->user_login; } ?>" <?php echo $username_disabled; ?>>
			</li>

			<li class="user-profile-field">
				<label for="firstname">First name</label>
				<input type="text" name="first_name" id="firstname" required value="<?php if( $user ) { echo $user->user_firstname; } ?>">
			</li>
			
			<li class="user-profile-field">
				<label for="lastname">Surname</label>
				<input type="text" name="last_name" id="lastname" required value="<?php if( $user ) { echo $user->user_lastname; } ?>">	
			</li>

			<li class="user-profile-field">
				<label for="email-address">Email address</label>
				<input type="email" name="user_email" id="email-address" placeholder="name@example.com" required value="<?php if( $user ) { echo $user->user_email; } ?>">
			</li>

			<li class="user-profile-field">
				<label for="facebook">Facebook</label>
				<input type="text" name="ptd_facebook_username" id="facebook" value="<?php if( $user ) { echo get_user_meta( $user->ID, 'ptd_facebook_username', true ); } ?>">
			</li>

			<li class="user-profile-field">
				<label for="twitter">Twitter</label>
				<input type="text" name="ptd_twitter_username" id="twitter" value="<?php if( $user ) { echo get_user_meta( $user->ID, 'ptd_twitter_username', true ); } ?>">
			</li>
			
			<?php if( 'registration_form' === $form ): ?>

				<li class="user-profile-field">
					<label for="password">Password</label>
					<input type="password" name="user_pass" id="password" required>
				</li>

				<li class="user-profile-field">
					<label for="confirm">Confirm Password</label>
					<input type="password" name="user_pass_confirm" id="confirm" required>
				</li>

			<?php endif; ?>

			<li class="user-profile-field">
				<input type="submit" value="<?php echo $submit_label; ?>" name="user_form_submit" class="user-form-submit">
			</li>
		</ul>
	</form>
	<?php
}

/**
 * Process user registration
 * @return new or updated user
 */
function prowordpress_process_registration() {
	
	$userdata = array();
	$usermeta = array();	

	// Loop through the $_POST variable to create our $userdata array
	foreach($_POST as $key => $value) {
		if( 'ptd_twitter_username' === $key || 'ptd_facebook_username' === $key ) {
			$usermeta[ $key ] = $value;
			$current_usermeta[ $key ] = get_user_meta( $user_id, $key, true );
		} else {
			if( 'user_pass_confirm' === $key ) {
				$confirm_password = $value;
			} else {
				$userdata[ $key ] = $value;	
			}
		}
	}

	if( $confirm_password !== $userdata['user_pass'] ) {
		return array(
			'message' => 'Passwords did not match. Please try again',
			'user'    => $userdata,
		);
	}

	if( email_exists( $userdata['user_email'] ) ) {
		return array(
			'message' => 'Email address is already in use. Have you <a class="forgot-pass-link" href="' . wp_lostpassword_url() .'" title="Forgotten your password?">forgotten your password?</a>',
			'user'    => $userdata,
		);
	} elseif( username_exists( $userdata['user_login'] )) {
		return array(
			'message' => 'Username is already taken',
			'user'    => $userdata,
		);
	} else {
		$user = wp_insert_user( $userdata );

		if( is_wp_error($user) ) {
			return array(
				'message' => 'Apologies there seems to have been an error. Please try again.',
				'user'    => $userdata,
			);	
		} else {
			wp_new_user_notification( $user );

			foreach( $usermeta as $meta_key => $meta_value ) {
				add_user_meta( $user, $meta_key, $meta_value, true );
			}
			
			return array(
				'message' => 'New user created. Please <a href="'. home_url( '/login' ) . '">login</a>.',
				'user'    => $userdata,
			);
		}			
	}
}

function prowordpress_process_update_user () {
	// FORM UPDATE

	$userdata = array();
	$usermeta = array();	

	$user_id = get_current_user_id();

	$userdata = array(
			'ID' => $user_id,
		);

	// Loop through the $_POST variable to create our $userdata array
	foreach($_POST as $key => $value) {
		if( 'ptd_twitter_username' === $key || 'ptd_facebook_username' === $key ) {
			$usermeta[ $key ] = $value;
			$current_usermeta[ $key ] = get_user_meta( $user_id, $key, true );
		} else {
			$userdata[ $key ] = $value;
		}
	}

	$result = wp_update_user( $userdata );
	var_dump($result);

	foreach( $usermeta as $meta_key => $meta_value ) {
		if ( $meta_value && '' == $current_usermeta[$key] ) {
			add_user_meta( $user_id, $meta_key, $meta_value, true );
		} elseif ( $meta_value && $meta_value != $current_usermeta[$key] ) {
			update_user_meta( $user_id, $meta_key, $meta_value, $current_usermeta[$key]);
		} elseif ( '' == $meta_value && $current_value ) {
			delete_user_meta( $user_id, $meta_key, $current_usermeta[$key] );
		}	
	}

	return array( 'message' => 'Profile updated' );
}

/**
 * Show custom user meta in the User admin screens
 */
function prowordpress_show_user_meta_in_admin( $user ) { 
?>
	<h3>User social media</h3>

	<table class="form-table">
		<tr>
			<th><label for="facebook">Facebook</label></th>

			<td>
				<input type="text" name="ptd_facebook_username" id="facebook" value="<?php echo esc_attr( get_user_meta( $user->ID, 'ptd_facebook_username', true ) ); ?>" class="regular-text"><br />
				<span class="description">Please enter your Facebook username.</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter username</label></th>

			<td>
				<input type="text" name="ptd_twitter_username" id="twitter" value="<?php echo esc_attr( get_user_meta( $user->ID, 'ptd_twitter_username', true ) ); ?>" class="regular-text"><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
		</tr>
	</table>
<?php 
}

add_action( 'show_user_profile', 'prowordpress_show_user_meta_in_admin' );
add_action( 'edit_user_profile', 'prowordpress_show_user_meta_in_admin' );

/**
 * Save user data submitted from WordPress admin
*/ 
function prowordpress_save_user_meta_in_admin( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	// Store all the custom user meta in an array
	$usermeta = array(
			'ptd_facebook_username' => $_POST['ptd_facebook_username'],
			'ptd_twitter_username'  => $_POST['ptd_twitter_username'],
		);

	// Loop through and process the updated meta values
	foreach( $usermeta as $meta_key => $meta_value ) {
		$current_value = get_user_meta( $user_id, $meta_key, true );

		if ( $meta_value && '' == $current_value ) {
			add_user_meta( $user_id, $meta_key, $meta_value, true );
		} elseif ( $meta_value && $meta_value != $current_value ) {
			update_user_meta( $user_id, $meta_key, $meta_value, $current_value);
		} elseif ( '' == $meta_value && $current_value ) {
			delete_post_meta( $user_id, $meta_key, $current_value );
		}	
	}	
}

add_action( 'personal_options_update', 'prowordpress_save_user_meta_in_admin' );
add_action( 'edit_user_profile_update', 'prowordpress_save_user_meta_in_admin' );
