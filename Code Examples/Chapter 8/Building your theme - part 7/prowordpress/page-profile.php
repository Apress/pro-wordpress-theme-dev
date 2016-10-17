<?php get_header(); ?>

	<?php if( is_user_logged_in() ): ?>

		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
			
			<article <?php post_class(); ?>>
				<h1><?php _e('Your Profile', 'prowordpress'); ?></h1>
				
				<?php prowordpress_profile(); ?>
				
			</article>

		<?php endwhile; endif; ?>
	<?php else: ?>

		<p>You need to be a registered member of the site to view your profile, please either login below or <a href="/register">register here</a> to view your profile.</p>

		<?php prowordpress_login_form(); ?>

	<?php endif; ?>

<?php get_footer(); ?>