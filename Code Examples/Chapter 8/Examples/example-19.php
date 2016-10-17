<?php

/**
 * User profile page example
 */
?>

<?php
/**
 * Template Name: Profile page
 */
get_header(); ?>

	<div class="content">

	<h2>Your profile</h2>

	<?php if( is_user_logged_in() ): ?>

		<?php $userdata = wp_get_current_user(); ?>

		<form action="<?php the_permalink(); ?>" method="post">

			<label for="email-address">Email address</label>
			<input type="email" name="user_email" id="email-address" value="<?php echo $userdata->user_email; ?>" required>
			
			<label for="firstname">First name</label>
			<input type="text" name="first_name" id="firstname" value="<?php echo $userdata->first_name; ?>" required>
			
			<label for="lastname">Last name</label>
			<input type="text" name="last_name" id="lastnam" value="<?php echo $userdata->last_name; ?>" required>
			
			<label for="website">Website</label>
			<input type="url" name="user_url" id="website" value="<?php echo $userdata->user_url; ?>">

			<input type="submit" name="update_user_profile" value="Update">
		</form>


	<?php else: ?>
		<p>You need to be a registered member of the site to view your profile, please either login below or <a href="/register">register here</a> to view your profile.</p>

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

	<?php endif; ?>
	</div>

<?php get_footer(); ?>


<?php
/**
 * Processing update of user details
 */

function prowordpress_process_update_user() {
	
	if( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['update_user_profile']) ) {
		// Unset the submit button value from the postdata 
		unset($_POST['update_user_profile']);

		$user_id = get_current_user_id();

		$userdata = array(
				'user_id' => $user_id,
			);
		
		// Loop through the $_POST variable to create our $userdata array
		foreach($_POST as $key => $value) {
			$userdata[ $key ] = $value;
		}

		wp_update_user( $userdata );

		wp_redirect( $_SERVER['REQUEST_URI'] . '?update=1');
		exit();
	}
}
add_action('template_redirect', 'prowordpress_process_update_user');
