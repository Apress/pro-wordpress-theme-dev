<?php


/**
 * Extra helper functions
 */

function simple_copyright () {
	echo "&copy; " . get_bloginfo('name') ." ". date("Y");
}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

function prowordpress_customise_feed($args) {

	if( isset($args['feed']) && !isset($args['post_type']) ) {
		$args['post_type'] = array('post', 'ptd_menu');
	}
	
	return $args;
}
add_filter('request', 'prowordpress_customise_feed');

function prowordpress_build_our_menu(){
	$menu_terms = get_terms( 'ptd_menu_category', array( 'order' => 'DESC' ) );

	if( $menu_terms ){
		foreach( $menu_terms  as $term ){
            
			$args = array(
				'post_type' => 'ptd_menu',
				'tax_query' => array(
						array(
							'taxonomy' => 'ptd_menu_category',
							'field'    => 'slug',
							'terms'     => $term->slug               				
						)
					),
				'posts_per_page' => -1,
            );
			
			$menu_items = new WP_Query( $args );
			if( $menu_items->have_posts() ) { 
?>
				<h2 id="<?php echo $term->slug; ?>" class="tax_term-heading"><?php echo $term->name; ?></h2>
<?php
				while ($menu_items->have_posts()) : $menu_items->the_post(); 
					get_template_part('content', 'menu');
				endwhile;

			}
			wp_reset_query();
		}
	}
}

function prowordpress_setup_sidebars() {
	$widget_areas = array (
			array(
				'name' => __( 'News widget area', 'prowordress' ),
				'id'   => 'news-widget-area'
				),
			array(
				'name' => __( 'Subnav widget area', 'prowordress' ),
				'id'   => 'subnav-widget-area'
				),
			array(
				'name' => __( 'Homepage widget area', 'prowordress' ),
				'id'   => 'homepage-widget-area'
				)
		);

	foreach( $widget_areas as $area ) {
		$args = array(
			'name'          => $area['name'],
			'id'            => $area['id'],
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>' 
		);
		register_sidebar($args);
	}
}
add_action( 'widgets_init', 'prowordpress_setup_sidebars' );

function prowordpress_featured_shortcode($atts, $content = NULL, $tag) {
	// No attributes for this function

	// Set up an array for the arguments for our query
	$args = array( 
		'posts_per_page'  => 1,
	);
	$class = $tag;

	switch( $tag ) {
		case 'featured_product':
			$args['post_type'] = 'ptd_menu';
			$args['orderby'] = 'rand';
			$args['meta_query'] = array(
					array(
						'key'     => 'ptd_menu_item_featured',
						'value'   => 'on',
						'compare' => '='
					)
			);

			$title = "<h2>Featured item</h2>";
			
			break;
		case 'staff_of_the_month':
			$args['post_type'] = 'ptd_staff';
			$args['orderby'] = 'date';
			$args['meta_query'] = array(
					array(
						'key'     => 'ptd_staff_of_the_month',
						'value'   => 'on',
						'compare' => '='
					)
			);
			$title = "<h2>Staff member of the month</h2>";
			
			break;
	}

	$featured = new WP_Query( $args );
	if( $featured->have_posts() ) {

		$output = '<div class="'.$class.'">';

		if( ! is_null($content) ) {
			$output .= '<h2>'.$content.'</h2>';
		} else {
			$output .= $title;
		}

		while( $featured->have_posts() ) {
			$featured->the_post();

			$output .= '<h3>'.get_the_title().'</h3>';

			$output .= get_the_post_thumbnail( get_the_id(), 'small');

			$output .= '<a href="'.get_permalink().'">Find our more &raquo;</a>';

		}

		$output .='</div>';
	}

	return $output;
}

add_shortcode('staff_of_the_month', 'prowordpress_featured_shortcode');
add_shortcode('featured_product', 'prowordpress_featured_shortcode');