<?php get_header(); ?>

	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<article <?php post_class(); ?>>
			<h1><?php _e('Register', 'prowordpress'); ?></h1>
			
			<?php if( ! is_user_logged_in() ): ?>
				<?php prowordpress_register(); ?>
			<?php else: ?>
				<p>You're already logged in to your account, <a href="<?php echo home_url('/profile'); ?>">view your profile?</a></p>
			<?php endif; ?>

		</article>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>