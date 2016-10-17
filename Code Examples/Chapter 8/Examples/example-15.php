<?php

/**
 * Members only area
 */


if( is_user_logged_in() ):
	the_content();
else:
	the_excerpt(); ?>

	<p>Please login to view the rest of the content:</p>

	<?php
	if( isset($_GET['login']) && 'failed' === $_GET['login']) :
	?>
		<div class="alert alert-error">
			<p><?php _e('Login failed. Please check your details and try again.', 'prowordpress'); ?></p>
		</div>
	<?php
	endif;
	?>

	<?php 
	$args = array(
			'form_id'         => 'loginform-custom',
			'id_username'     => 'user-login-custom',
			'id_password'     => 'user-pass-custom',
			'id_remember'     => 'rememberme-custom',
			'id_submit'       => 'wp-submit-custom',
		);
	wp_login_form( $args ); ?>
<?php endif; ?>
