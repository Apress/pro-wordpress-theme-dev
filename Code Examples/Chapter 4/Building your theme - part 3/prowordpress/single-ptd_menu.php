<?php
/**
 *	Template menu single
 */
?>
<?php get_header(); ?>

	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
		
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
	
			<?php if( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			
			<?php the_content(); ?>
		</article>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>