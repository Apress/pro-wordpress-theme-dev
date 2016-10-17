<?php 

/**
 * Custom post types
 */
function prowordpress_post_types() {
	$types = array(
			'ptd_staff' => array(
				'menu_title' => 'Staff',
				'plural'     => 'People',
				'singular'   => 'Person',
				'supports'   => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'page-attributes', 'custom-fields'),
				'slug'       => 'staff',
				),
			'ptd_menu' => array(
				'menu_title' => 'Menu',
				'plural'     => 'Items',
				'singular'   => 'Item',
				'supports'   => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'page-attributes', 'custom-fields'),
				'slug'       => 'menu'
				)

		);

	$counter = 0;
	foreach( $types as $type => $arg ) {

		$labels = array(
			'name'               => $arg['menu_title'],
			'singular_name'      => $arg['singular'],
			'add_new'            => 'Add new',
			'add_new_item'       => 'Add new '.strtolower($arg['singular']),
			'edit_item'          => 'Edit '.strtolower($arg['singular']),
			'new_item'           => 'New '.strtolower($arg['singular']),
			'all_items'          => 'All '.strtolower($arg['plural']),
			'view_item'          => 'View '.strtolower($arg['plural']),
			'search_items'       => 'Search '.strtolower($arg['plural']),
			'not_found'          => 'No '.strtolower($arg['plural']).' found',
			'not_found_in_trash' => 'No '.strtolower($arg['plural']).' found in Trash', 
			'parent_item_colon'  => '',
			'menu_name'          => $arg['menu_title']
		);

		register_post_type( $type, 
			array(
				'labels'          => $labels,
				'public'          => true,
				'has_archive'     => true,
				'capability_type' => 'post',
				'supports'        => $arg['supports'],
				'rewrite'         => array( 'slug' => $arg['slug'] ),
				'menu_position'   => (20 + $counter),
			)
		);

		$counter++;
	}
}
add_action('init', 'prowordpress_post_types');

function prowordpress_updated_messages( $messages ) {
	global $post, $post_ID;

	$types = array(
			'ptd_staff' => 'Person',
			'ptd_menu' => 'Item',
		);

	foreach( $types as $type => $title) {
		$messages[$type] = array(
			0 => '', 
			1 => sprintf( __('%s updated. <a href="%s">View %s</a>'),$title, esc_url( get_permalink($post_ID) ),$title ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __(strtolower($title).' updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('%s restored to revision from %s'),$title, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('%s published. <a href="%s">View %s</a>'), $title, esc_url( get_permalink($post_ID) ), strtolower($title) ),
			7 => __($title.' saved.'),
			8 => sprintf( __('%s submitted. <a target="_blank" href="%s">Preview %s</a>'), $title, esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), strtolower($title) ),
			9 => sprintf( __('%s scheduled for: <strong>%2$s</strong>. <a target="_blank" href="%3$s">Preview %1$s</a>'), $title, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('%s draft updated. <a target="_blank" href="%s">Preview %s</a>'), $title, esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), strtolower($title) ),
		);	
	}
	return $messages;
}
add_filter( 'post_updated_messages', 'prowordpress_updated_messages' );

function prowordpress_custom_columns( $cols ) {
	$cols = array(
		'cb'       => '<input type="checkbox" />',
		'title'    => __( 'Title', 'prowordpress' ),
		'photo' => __( 'Thumbnail', 'prowordpress' ),
		'date'     => __( 'Date', 'prowordpress' ),
	);
	return $cols;
}
add_filter( "manage_ptd_staff_posts_columns", "prowordpress_custom_columns" );
add_filter( "manage_ptd_menu_posts_columns", "prowordpress_custom_columns" );

function prowordpress_custom_column_content( $column, $post_id ) {
  
	switch ( $column ) {
		case "photo":
			if( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, array(50,50));
			}
			break;
  	}
}
add_action( "manage_ptd_staff_posts_custom_column", "prowordpress_custom_column_content", 10, 2 );
add_action( "manage_ptd_menu_posts_custom_column", "prowordpress_custom_column_content", 10, 2 );


function prowordpress_taxonomies() {

	$taxs = array(
			'ptd_menu_category' => array(
				'menu_title'   => 'Menu Category',
				'plural'       => 'Categories',
				'singular'     => 'Category',
				'hierarchical' => true,
				'slug'         => 'menu-category',
				'post_type'    => 'ptd_menu'
				),
			'ptd_job_roles' => array(
				'menu_title'   => 'Job Roles',
				'plural'       => 'Roles',
				'singular'     => 'Role',
				'hierarchical' => true,
				'slug'         => 'job-role',
				'post_type'    => 'ptd_staff'
				)
		);

	foreach( $taxs as $tax => $args ) {
		
		$labels = array(
			'name'                => _x( $args['plural'], 'taxonomy general name' ),
			'singular_name'       => _x( $args['singular'], 'taxonomy singular name' ),
			'search_items'        => __( 'Search '.$args['plural'] ),
			'all_items'           => __( 'All '.$args['plural'] ),
			'parent_item'         => __( 'Parent '.$args['plural'] ),
			'parent_item_colon'   => __( 'Parent '.$args['singular'].':' ),
			'edit_item'           => __( 'Edit '.$args['singular'] ), 
			'update_item'         => __( 'Update '.$args['singular'] ),
			'add_new_item'        => __( 'Add New '.$args['singular'] ),
			'new_item_name'       => __( 'New '.$args['singular'].' Name' ),
			'menu_name'           => __( $args['menu_title'] )
		); 	

		$tax_args = array(
			'hierarchical'        => $args['hierarchical'],
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => array( 'slug' => $args['slug'] ),
		);

		register_taxonomy( $tax, $args['post_type'], $tax_args );	
	}
	
}
add_action('init', 'prowordpress_taxonomies');


/********************************
* CUSTOM FIELDS CODE
********************************/

function prowordpress_meta_boxes () {
	
	add_meta_box ( 'ptd_menu_meta',
				__('Menu item info', 'prowordpress'),
				'prowordpress_menu_meta_fields',
				'ptd_menu',
				'side',
				'core'
			);

	add_meta_box ( 'ptd_staff_meta',
				__('Staff extra info', 'prowordpress'),
				'prowordpress_staff_meta_fields',
				'ptd_staff',
				'side',
				'core'
			);
}
add_action ('add_meta_boxes', 'prowordpress_meta_boxes');

function prowordpress_menu_meta_fields ( $post ) {
	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'ptd_custom_meta_noncename' );

	$price = get_post_meta( $post->ID, 'ptd_menu_item_price', true );
	$featured = get_post_meta( $post->ID, 'ptd_menu_item_featured', true );
?>
	
	<p>
		<label for="ptd_menu_item_price">Price</label><br />
		<input type="text" class="all-options" name="ptd_menu_item_price" id="ptd_menu_item_price" value="<?php echo esc_attr( $price ); ?>" />
		<span class="description">Enter the price in &pound;s</span>
	</p>
	
	<p>
		<label for="ptd_menu_item_featured"><input type="checkbox" id="ptd_menu_item_featured" name="ptd_menu_item_featured" <?php if( 'on' === $featured ) echo 'checked'; ?> /> <span>Featured item</span></label><br />
		<span class="description">Select whether this item should be featured on the homepage</span>
	</p>
<?php 
}

function prowordpress_staff_meta_fields ( $post ) {
	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'ptd_custom_meta_noncename' );

	$ofthemonth = get_post_meta( $post->ID, 'ptd_staff_of_the_month', true );
?>
	<p>
		<label for="ptd_staff_of_the_month"><input type="checkbox" id="ptd_staff_of_the_month" name="ptd_staff_of_the_month" <?php if( 'on' === $ofthemonth ) echo 'checked'; ?> /> <span>staff member of the month</span></label><br />
		<span class="description">Select whether this person is staff member of the month</span>
	</p>
<?php 
}

function prowordpress_meta_save ( $post_id ) {
    
    // verify if this is an auto save routine. 
	// If it is the post has not been updated, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !isset( $_POST['ptd_custom_meta_noncename'] ) || !wp_verify_nonce( $_POST['ptd_custom_meta_noncename'], basename( __FILE__ ) ) ) {
		return $post_id;
	}	

	// Get the post type object.
	global $post;
	$post_type = get_post_type_object( $post->post_type );

	// Check if the current user has permission to edit the post.
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	$metadata = array();

	if( 'ptd_menu' === $post_type->name ) {
		$metadata['ptd_menu_item_price'] = ( isset( $_POST['ptd_menu_item_price'] ) ? $_POST['ptd_menu_item_price'] : '' );
		$metadata['ptd_menu_item_featured'] = ( isset( $_POST['ptd_menu_item_featured'] ) ? $_POST['ptd_menu_item_featured'] : '' );
	} else {
		$metadata['ptd_staff_of_the_month'] = ( isset( $_POST['ptd_staff_of_the_month'] ) ? $_POST['ptd_staff_of_the_month'] : '' );
	}
	
	// add/update record (both are taken care of by update_post_meta)
	foreach( $metadata as $key => $value ) {
		// get current meta value
		$current_value = get_post_meta( $post_id, $key, true);

		if ( $value && '' == $current_value ) {
			add_post_meta( $post_id, $key, $value, true );
		} elseif ( $value && $value != $current_value ) {
			update_post_meta( $post_id, $key, $value );
		} elseif ( '' == $value && $current_value ) {
			delete_post_meta( $post_id, $key, $current_value );
		}
	}
}

add_action ('save_post', 'prowordpress_meta_save');