<?php 

class Featured_Widget extends WP_Widget {

	public function __construct () {
		// Widget settings. 
		$widget_ops = array( 'classname' => 'featured-content', 'description' => 'A widget that can display either or both featured menu items and the staff member of the month' );

		// Create the widget - calling the parent class construct method
		parent::__construct(
	 		'featured_widget', // Base ID
			'Featured Widget', // Name
			$widget_ops
		);
	}

public function widget( $args, $instance ) {
	extract( $args );

	// Get the user-selected settings
	$title = apply_filters('widget_title', $instance['title'] );
	$show_featured = isset( $instance['show_featured'] ) ? $instance['show_featured'] : false;
	$show_staff = isset( $instance['show_staff'] ) ? $instance['show_staff'] : false;
	
	// Before widget code (defined in the register sidebar function).
	echo $before_widget;

	if ( $title ) {
		echo $before_title.$title.$after_title;
	}

	if( $show_featured ) {
		
		$args = array( 
			'posts_per_page'  => 1,
			'post_type'       => 'ptd_menu',
			'orderby'         => 'rand',
			'meta_query'      => array(
						array(
							'key'     => 'ptd_menu_item_featured',
							'value'   => 'on',
							'compare' => '='
						)
				)
		);

		$featured = new WP_Query( $args );
		if( $featured->have_posts() ) {

			echo '<div class="featured-item">';
			echo '<h3>Featured item</h3>';
		
			while( $featured->have_posts() ) {
				$featured->the_post();
?>
				<h3><?php the_title(); ?></h3>

				<?php the_post_thumbnail( 'small' ); ?>

				<a href="<?php the_permalink(); ?>">Find our more &raquo;</a>
<?php
			}
			echo '</div>';

			wp_reset_query();
		}
	}

	if( $show_staff ) {
		
		$args = array( 
			'posts_per_page'  => 1,
			'post_type'       => 'ptd_staff',
			'orderby'         => 'date',
			'meta_query'      => array(
						array(
							'key'     => 'ptd_staff_of_the_month',
							'value'   => 'on',
							'compare' => '='
						)
				)
		);

		$staff = new WP_Query( $args );
		if( $staff->have_posts() ) {

			echo '<div class="featured-staff">';
			echo '<h3>Staff of the month</h3>';
		
			while( $staff->have_posts() ) {
				$staff->the_post();
?>
				<h3><?php the_title(); ?></h3>

				<?php the_post_thumbnail( 'small' ); ?>

				<a href="<?php the_permalink(); ?>">Find our more &raquo;</a>
<?php
			}
			echo '</div>';
			wp_reset_query();
		}			
	

		echo '</div>';
	}

	// After widget code (defined in the register sidebar function).
	echo $after_widget;
}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_featured'] = $new_instance['show_featured'];
		$instance['show_staff'] = $new_instance['show_staff'];

		return $instance;
	}

	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured content', 'show_featured' => false, 'show_staff' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_featured'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_featured' ); ?>" name="<?php echo $this->get_field_name( 'show_featured' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_featured' ); ?>">Show featured menu item?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_staff'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_staff' ); ?>" name="<?php echo $this->get_field_name( 'show_staff' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_staff' ); ?>">Show staff of the month?</label>
		</p>
	<?php

	}

}