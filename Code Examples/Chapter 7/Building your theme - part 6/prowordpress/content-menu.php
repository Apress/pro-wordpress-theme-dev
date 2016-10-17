		<article <?php post_class(); ?>>
			<header>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php if( has_post_thumbnail() ): ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>
			</header>
			
			<?php the_excerpt(); ?>

			<p><a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
		</article>