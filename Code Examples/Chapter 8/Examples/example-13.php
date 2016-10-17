<?php 

/**
 * Custom Login page template example
 */
?>


<?php
/**
 * Template Name: Login template
 */
get_header();
?>

	<div class="content">

		<h2><?php the_title(); ?></h2>

		<?php if ( ! is_user_logged_in() ): ?>
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
			
		<?php else: ?>
			<p><?php wp_loginout( home_url() ); ?></p>
		<?php endif; ?>


	</div>

<?php get_footer(); ?>
