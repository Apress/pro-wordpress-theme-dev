<?php
/**
 *	Template menu archive
 */
?>
<?php get_header(); ?>

	<h1>Our menu</h1>

	<?php if( have_posts() ): ?>

		<?php while( have_posts() ): the_post(); ?>
			
			<?php get_template_part( 'content', 'menu' ); ?>

		<?php endwhile; ?>

	<?php else: ?>
		
		<article class="error">
			<h1>Sorry there were no news articles found</h1>
		</article>

	<?php endif; ?>

<?php get_footer(); ?>