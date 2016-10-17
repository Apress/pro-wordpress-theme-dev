<?php get_header(); ?>

	<h1>Latest news</h1>

	<?php if( have_posts() ): ?>

		<?php while( have_posts() ): the_post(); ?>
			
			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php else: ?>
		
		<article class="error">
			<h1>Sorry there were no news articles found</h1>
		</article>

	<?php endif; ?>

	<p class="post-page-navigation">
		<?php previous_posts_link( "&laquo; More recent news"); ?>
		<?php next_posts_link( "Past news &raquo;"); ?>
	</p>

	<?php get_sidebar( 'news' ); ?>

<?php get_footer(); ?>