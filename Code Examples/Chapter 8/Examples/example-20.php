<?php

/**
 * Updating the users password
 */

// Form
?>

<h3>Update your password</h3>

<form action="<?php the_permalink(); ?>" method="post">

	<label for="current">Current password</label>
	<input type="password" name="old_passwd" id="current" required>

	<label for="new-passwd">New password</label>
	<input type="password" name="new_passwd" id="new-passwd" required>

	<label for="confirm-passwd">Repeat password</label>
	<input type="password" name="new_passwd_confirm" id="confirm-passwd" required>

	<input type="submit" name="update_user_password" value="Update password">
</form>

<?php

// Processing the update

function prowordpress_update_user_pass() {

	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['update_user_password']) ) {
		$user = get_current_user();

		if( $user && ! wp_check_password( $_POST['old_passwd'], $user->user_pass, $user->ID) ) {
			wp_redirect( $_SERVER['REQUEST_URI'] . '?error=1');
			exit();
		} else {
			if( $_POST['new_passwd'] && $_POST['new_passwd_confirm'] && $_POST['new_passwd'] === $_POST['new_passwd_confirm'] ) {
				wp_set_password( $_POST['new_passwd'], $user->ID );
				
				wp_redirect( $_SERVER['REQUEST_URI'] . '?update=1');
				exit();
			} else {
				wp_redirect( $_SERVER['REQUEST_URI'] . '?error=2');
				exit();	
			}
		}
	}
}
add_action('template_redirect', 'prowordpress_update_user_pass');
