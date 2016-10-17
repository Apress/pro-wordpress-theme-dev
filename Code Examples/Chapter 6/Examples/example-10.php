<?php

/**
 * Register dynamic sidebars example
 */

// Functions file

function prowordpress_setup_sidebars() {
	$args = array(
		'name'          => __( 'Sidebar right', 'prowordress' ),
		'id'            => 'sidebar-right',
		'before_widget' => '<section class="widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>' 
	);
	register_sidebar($args);
}
add_action( 'widgets_init', 'prowordpress_setup_sidebars' );


// Sidebar file
?>
<aside class="sidebar news">
	<?php if( ! dynamic_sidebar( 'sidebar-right' ) ): ?>
		<h2>Movie genres</h2>
		<ul class="genre-navigation">
			<?php 
			$args = array( 
					'taxonomy'     => 'ptd_genre',
					'orderby'      => 'name',
					'order'        => 'ASC',
					'style'        => 'list',
					'show_count'   => 0,
					'hide_empty'   => 0,
					'title_li'     => '',
					'depth'        => 1,
				);

			wp_list_categories( $args ); ?>
		</ul>
	<?php endif; ?>
</aside>
