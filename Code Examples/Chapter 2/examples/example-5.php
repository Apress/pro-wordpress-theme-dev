<?php get_header(); ?>
	<div class="container">
		<div class="search">
			<?php get_search_form(); ?>
		</div>
		<div class="main">
			<?php // do stuff ?>
			<?php comments_template(); ?>
		</div>
		
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>