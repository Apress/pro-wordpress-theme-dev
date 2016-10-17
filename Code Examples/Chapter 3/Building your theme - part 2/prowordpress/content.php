<article <?php post_class(); ?>>
	<h3><?php the_title(); ?></h3>

	<?php the_excerpt(); ?>

	<a href="<?php the_permalink(); ?>">Read more &raquo;</a>
</article>