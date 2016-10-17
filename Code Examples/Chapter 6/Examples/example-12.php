<?php

/**
 * Widget example
 */

class Genre_Widget extends WP_Widget {

	public function __construct () {
		// Widget settings. 
		$widget_ops = array( 'classname' => 'genre-list', 'description' => 'A widget that displays the genres for our movies' );

		// Create the widget - calling the parent class construct method
		parent::__construct(
	 		'genre_widget', // Base ID
			'Genre Widget', // Name
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		// Get the user-selected settings
		$title = apply_filters('widget_title', $instance['title'] );
		$order = $instance['sort_order'];
		$show_hidden = isset( $instance['show_hidden'] ) ? $instance['show_hidden'] : false;
		$show_count = isset( $instance['show_post_count'] ) ? $instance['show_post_count'] : false;
		

		// Before widget code (defined in the register sidebar function).
		echo $before_widget;

		// Title of widget - with fallback (before and after defined by register sidebar function)
		echo $before_title;
		if ( $title ) {
			echo $title;
		} else {
			echo "Genres";
		}
		echo $after_title;
		
		echo '<ul class="genre-list">';

		$args = array( 
				'taxonomy'     => 'ptd_genre',
				'orderby'      => $order,
				'order'        => 'ASC',
				'style'        => 'list',
				'show_count'   => $show_count,
				'hide_empty'   => $show_hidden,
				'title_li'     => '',
				'depth'        => 1,
			);

		wp_list_categories( $args );

		echo '</ul>';
		
		// After widget code (defined in the register sidebar function).
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['sort_order'] = $new_instance['sort_order'];
		$instance['show_hidden'] = $new_instance['show_hidden'];
		$instance['show_post_count'] = $new_instance['show_post_count'];

		return $instance;
	}

	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Genres', 'sort_order' => 'name', 'show_hidden' => false, 'show_post_count' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'sort_order' ); ?>">Sort order:</label> 
			<select id="<?php echo $this->get_field_id( 'sort_order' ); ?>" name="<?php echo $this->get_field_name( 'sort_order' ); ?>" class="widefat">
				<option <?php selected( $instance['sort_order'], 'name' ) ?>>name</option>
				<option <?php selected( $instance['sort_order'], 'slug' ) ?>>slug</option>
				<option <?php selected( $instance['sort_order'], 'count' ) ?>>count</option>
			</select>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_hidden'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_hidden' ); ?>" name="<?php echo $this->get_field_name( 'show_hidden' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_hidden' ); ?>">Hide empty genres?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_count'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_post_count' ); ?>" name="<?php echo $this->get_field_name( 'show_post_count' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_post_count' ); ?>">Display post count?</label>
		</p>
	<?php

	}

}