		<article <?php post_class(); ?>>
			<header>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</header>
			
			<?php the_content(); ?>

			<p><a href="<?php the_permalink(); ?>">Find out more &raquo;</a></p>
		</article>