<?php

/**
 * Deleting a user example
 */


// Delete user form
?>

<h3>Close account</h3>
<form action="<?php the_permalink(); ?>" method="post">
	<label>To delete your account permanently please click the button below.</label>
	<input type="submit" name="delete_user" value="Delete account">
</form>

<?php
// Deleting user function

function prowordpress_delete_user() {

	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['delete_user']) ) {
		$user_id = get_current_user_id();

		wp_delete_user( $user_id );

		wp_redirect( home_url( '/user-deleted') );
		exit();
	}
}
add_action('template_redirect', 'prowordpress_delete_user');
