<?php

/**
 * Rewind posts
 */

?>

<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
	<h2><a href="#faq-<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
<?php endwhile; endif; ?>

<?php rewind_posts(); ?>

<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
	
	<article id="faq-<?php the_ID(); ?>">
		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
	</article>

<?php endwhile; endif; ?>