Cod<?php get_header(); ?>

	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<article <?php post_class(); ?>>
			<header>
				<h1><?php the_title(); ?></h1>
				<p class="byline">by <?php the_author(); ?> | <?php echo get_the_date(); ?></p>
			</header>
			
			<?php the_content(); ?>
		</article>

	<?php endwhile; endif; ?>

	<?php get_sidebar('news'); ?>

<?php get_footer(); ?>