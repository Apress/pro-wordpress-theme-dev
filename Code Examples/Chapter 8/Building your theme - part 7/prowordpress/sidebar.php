<aside class="sidebar page-navigation">
	<?php
		global $post;
		$ancestors = get_post_ancestors( $post ); 
		$top = get_post(end($ancestors), "OBJECT");
	?>
	<h2><?php echo $top->post_title; ?></h2>
	<ul class="sub-nav">
		<?php wp_list_pages('title_li=&child_of='.$top->ID); ?>
	</ul>

	<?php dynamic_sidebar( 'subnav-widget-area' ); ?>
</aside>