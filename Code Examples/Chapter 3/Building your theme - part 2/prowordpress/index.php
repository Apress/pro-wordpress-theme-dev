<?php get_header(); ?>
	<?php if( have_posts() ): ?>

		<?php while( have_posts() ): the_post(); ?>
			
			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php else: ?>
		
		<article class="error">
			<h1>Sorry there were no articles found</h1>
		</article>

	<?php endif; ?>
<?php get_footer(); ?>