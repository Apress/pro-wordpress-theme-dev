<?php get_header(); ?>

	<?php if( is_user_logged_in() && current_user_can( 'publish_posts' ) ): ?>

		<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
			
			<article <?php post_class(); ?>>
				
				<header>
					<h1><?php the_title(); ?></h1>
				</header>
				
				<?php the_content(); ?>

			</article>

		<?php endwhile; endif; ?>

	<?php else: ?>

		<p>Please login or <a href="<?php echo home_url( 'register' ); ?>">register</a> to view posts</p>

		<?php prowordpress_login_form(); ?>

	<?php endif; ?>

	<?php get_sidebar('news'); ?>

<?php get_footer(); ?>