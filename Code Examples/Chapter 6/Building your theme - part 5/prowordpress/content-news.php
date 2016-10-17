		<article <?php post_class(); ?>>
			<header>
				<h1><?php the_title(); ?></h1>
				<p class="byline">by <?php the_author(); ?> | <?php echo get_the_date(); ?></p>
			</header>
			
			<?php the_content(); ?>
		</article>