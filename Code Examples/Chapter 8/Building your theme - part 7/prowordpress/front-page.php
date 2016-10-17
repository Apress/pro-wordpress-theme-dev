<?php get_header(); ?>
<?php the_post(); ?>

	<article class="page-content">
		<?php the_content(); ?>
	</article>

	<aside class="latest-news">
		<?php if( ! dynamic_sidebar( 'homepage-widget-area' ) ): ?>
			<h2>Latest News</h2>

			<?php 
			// New Query for news articles
			$args = array( 
					'post_type'      => 'post',
					'orderby'        => 'date',
					'order'          => 'ASC',
					'posts_per_page' => 2, 
				);

			$latest_news = new WP_Query( $args );

			if( $latest_news->have_posts() ): while( $latest_news->have_posts() ): $latest_news->the_post();
			?>
				<article <?php post_class(); ?>>
					<h3><?php the_title(); ?></h3>

					<?php the_excerpt(); ?>

					<a href="<?php the_permalink(); ?>">Read more &raquo;</a>
				</article>
			<?php endwhile; endif; ?>

			<?php wp_reset_query(); ?>
		<?php endif; ?>
	</aside>

	<aside class="featured-item">
		<h2>Featured item</h2>

		<?php
		// New query for featured menu item
		$item_id = get_theme_mod( 'featured_item' );
		$args = array( 
				'post_type'       => 'ptd_menu',
				'posts_per_page'  => 1,
				'p'               => $item_id,
			);

		$featured = new WP_Query( $args );

		if( $featured->have_posts() ): while( $featured->have_posts() ): $featured->the_post();
		?>
			<article <?php post_class(); ?>>
				<h3><?php the_title(); ?></h3>

				<?php the_post_thumbnail( 'small'); ?>

				<a href="<?php the_permalink(); ?>">Find our more &raquo;</a>
			</article>
		<?php endwhile; endif; ?>

		<?php wp_reset_query(); ?>

	</aside>

<?php get_footer(); ?>