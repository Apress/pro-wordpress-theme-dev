	<aside class="sidebar news">
		
		<h2>Archives</h2>
		<ul class="news-navigation">
			<?php wp_get_archives(); ?>
		</ul>

		<h2>Popular categories</h2>
		<ul class="news-navigation">
			<?php 
			$args = array( 
					'title_li' => '', 
					'number' => 10, 
					'orderby' => 'count', 
				);

			wp_list_categories( $args ); ?>
		</ul>

	</aside>