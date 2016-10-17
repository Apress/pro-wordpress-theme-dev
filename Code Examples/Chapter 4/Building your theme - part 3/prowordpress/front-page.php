<?php get_header(); ?>
<?php the_post(); ?>

	<article class="page-content">
		<?php the_content(); ?>
	</article>

	<aside class="latest-news">
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
	</aside>

<?php get_footer(); ?>