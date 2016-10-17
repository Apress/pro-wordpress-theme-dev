<?php get_header(); ?>
	
		<?php if (is_category()) : ?>
			<h1>Archive for category: <?php single_cat_title(); ?></h1>
		<?php elseif( is_tag() ) : ?>
			<h1>Posts Tagged: <?php single_tag_title(); ?></h1>
		<?php elseif (is_day()) : ?>
			<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
		<?php elseif (is_month()) : ?>
			<h1>Archive for <?php the_time('F, Y'); ?></h1>
		<?php elseif (is_year()) : ?>
			<h1>Archive for <?php the_time('Y'); ?></h1>
		<?php elseif (is_author()) : ?>
			<h1>Author Archive</h1>
		<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
			<h1>Archives</h1>
		<?php endif; ?>

		<?php rewind_posts(); ?>

		<?php if ( is_user_logged_in()  && current_user_can( 'publish_posts' ) ): ?>

			<?php if (have_posts()) : the_post(); ?>

				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

			<?php else : ?>

				<?php if (is_category()) :  ?>
					<h1>Sorry, but there aren't any posts in the <?php single_cat_title(); ?> category yet.</h1>
				<?php elseif (is_date()) : ?>
					<h1>Sorry, but there aren't any posts with this date.</h1>
				<?php elseif (is_author()) : ?>
					<?php get_userdatabylogin(get_query_var('author_name')); ?>
					<h1>Sorry, but there aren't any posts by <?php echo $userdata->display_name; ?> yet.</h1>
				<?php else : ?>
					<h1>No posts found.</h1>
				<?php endif; ?>

			<?php endif; ?>

		<?php else: ?>

			<p>Please login to view posts</p>

			<?php prowordpress_login_form(); ?>

		<?php endif; ?>

<?php get_footer(); ?>