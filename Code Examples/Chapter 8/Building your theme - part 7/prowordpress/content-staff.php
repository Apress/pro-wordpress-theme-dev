		<article <?php post_class(); ?>>
			<div class="thumbnail">
				<?php if( has_post_thumbnail() ): ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>
			</div>
			<header>
				<h1><?php the_title(); ?> - <span><?php echo get_the_term_list( get_the_id(), 'ptd_job_roles'); ?></span></h1>
			</header>
		</article>