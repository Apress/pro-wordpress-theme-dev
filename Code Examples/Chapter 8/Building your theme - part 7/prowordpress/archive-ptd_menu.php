<?php
/**
 *	Template menu archive
 */
?>
<?php get_header(); ?>

	<h2>Our menu</h2>

	<?php if( have_posts() ): ?>

		<?php while( have_posts() ): the_post(); ?>
			
			<?php get_template_part( 'content', 'menu' ); ?>

		<?php endwhile; ?>

	<?php else: ?>
		
		<article class="error">
			<h3>Sorry there were no news articles found</h3>
		</article>

	<?php endif; ?>

<?php get_footer(); ?>