<?php

/**
 * Custom user meta examples
 */


// Get custom user meta from the user data submitted
$userdata = array();
$usermeta = array();

// Loop through the $_POST variable to create our $userdata array
foreach($_POST as $key => $value) {
	if( 'ptd_twitter_username' === $key || 'ptd_facebook_username' === $key ) {
		$usermeta[ $key ] = $value;
	} else {
		$userdata[ $key ] = $value;	
	}			
}

// Loop through and add custom user meta
foreach( $usermeta as $meta_key => $meta_value ) {
	add_user_meta( $user, $meta_key, $meta_value, true );
}

// Outputting custom user meta
?>
<label for="facebook">Facebook</label>
<input type="text" name="ptd_facebook_username" id="facebook" value="<?php echo get_user_meta( $userdata->ID, 'ptd_facebook_username', true ); ?>">

<label for="twitter">Twitter</label>
<input type="text" name="ptd_twitter_username" id="twitter" value="<?php echo get_user_meta( $userdata->ID, 'ptd_twitter_username', true ); ?>">
<?php

// Updating custom user meta

$usermeta = array();
$current_usermeta = array();

// Loop through the $_POST variable to create our $userdata array
foreach($_POST as $key => $value) {
	if( 'ptd_twitter_username' === $key || 'ptd_facebook_username' === $key ) {
		$usermeta[ $key ] = $value;
		$current_usermeta[ $key ] = get_user_meta( $user_id, $key, true );
	} else {
		$userdata[ $key ] = $value;
	}
}

$user = wp_update_user( $userdata );

foreach( $usermeta as $meta_key => $meta_value ) {
	if ( $meta_value && '' == $current_usermeta[$key] ) {
		add_user_meta( $user_id, $meta_key, $meta_value, true );
	} elseif ( $meta_value && $meta_value != $current_usermeta[$key] ) {
		update_user_meta( $user_id, $meta_key, $meta_value, $current_usermeta[$key]);
	} elseif ( '' == $meta_value && $current_value ) {
		delete_user_meta( $user_id, $meta_key, $current_usermeta[$key] );
	}	
}



// Display custom user meta in the admin

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
				<input type="text" name="ptd_twitter_username" id="twitter" value="<?php echo esc_attr( get_user_meta( $user->ID, 'ptd_twitter_username', true ); ?>" class="regular-text"><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
		</tr>

	</table>
<?php 
}

add_action( 'show_user_profile', 'prowordpress_show_user_meta_in_admin' );
add_action( 'edit_user_profile', 'prowordpress_show_user_meta_in_admin' );


// Save user meta data from the WordPress admin

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
