<?php get_header(); ?>

	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<article <?php post_class(); ?>>

			<h1>Login</h1>

			<?php if( ! is_user_logged_in() ): ?>
		
				<?php
				if( isset($_GET['login']) && 'failed' === $_GET['login']) :
				?>
					<div class="message error-message">
						<p><?php _e('Login failed. Please check your details and try again.', 'prowordpress'); ?></p>
					</div>
				<?php endif; ?>

				<?php prowordpress_login_form(); ?>
			<?php else: ?>
				<p>You're already logged in. <?php wp_loginout( home_url() ); ?>?</p>
			<?php endif; ?>
		</article>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>