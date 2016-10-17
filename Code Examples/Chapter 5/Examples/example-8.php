<?php 

/**
 * Post meta box functions
 */


// Setup meta box
function prowordpress_movies_meta_box () {
	add_meta_box (
			'ptd_movies_meta',
			__('Movie details', 'prowordpress'),
			'prowordpress_movie_meta_fields',
			'ptd_movie',
			'side',
			'core'
		);
}

add_action ('add_meta_boxes', 'prowordpress_movies_meta_box');

// Add content to meta box

function prowordpress_movie_meta_fields ( $post ) {
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ptd_movie_meta_noncename' );

	$rating = get_post_meta( $post->ID, 'ptd_movie_rating', true );
	$running = get_post_meta( $post->ID, 'ptd_movie_running_time', true );
	$release = get_post_meta( $post->ID, 'ptd_movie_release_date', true );
	$review = get_post_meta( $post->ID, 'ptd_movie_review_rating', true );
?>
	<p>
		<label for="ptd_movie_rating">Movie classification</label><br />
		<select name="ptd_movie_rating" id="ptd_movie_rating">
			<option value="">Select a classification</option>
			<option value="G" <?php if( 'G' === $rating ) echo 'selected'; ?>>G</option>
			<option value="PG" <?php if( 'PG' === $rating ) echo 'selected'; ?>>PG</option>
			<option value="PG-13" <?php if( 'PG-13' === $rating ) echo 'selected'; ?>>PG-13</option>
			<option value="R" <?php if( 'R' === $rating ) echo 'selected'; ?>>R</option>
			<option value="NC-17" <?php if( 'NC-17' === $rating ) echo 'selected'; ?>>NC-17</option>
		</select><br />
		<span class="description">Select the US rating classification from the dropdown</span>
	</p>
	
	<p>
		<label for="ptd_movie_running_time">Running time</label><br />
		<input type="text" class="all-options" name="ptd_movie_running_time" id="ptd_movie_running_time" value="<?php echo esc_attr( $running ); ?>" />
		<span class="description">Enter the running time in minutes</span>
	</p>
	
	<p>
		<label for="ptd_movie_release_date">Release date</label><br />
		<input type="text" class="all-options" name="ptd_movie_release_date" id="ptd_movie_release_date" value="<?php echo esc_attr( $release ); ?>" />
		<span class="description">Enter the release date or year of the movie</span>
	</p>

	<p>
		<label>Review rating</label><br />
		<label for="review_rating_1"><input type="radio" value="1" id="review_rating_1" name="ptd_movie_review_rating" <?php if( '1' === $review ) echo 'checked'; ?> /> <span>1 star</span></label><br />
		<label for="review_rating_2"><input type="radio" value="2" id="review_rating_2" name="ptd_movie_review_rating" <?php if( '2' === $review ) echo 'checked'; ?> /> <span>2 star</span></label><br />
		<label for="review_rating_3"><input type="radio" value="3" id="review_rating_3" name="ptd_movie_review_rating" <?php if( '3' === $review ) echo 'checked'; ?> /> <span>3 star</span></label><br />
		<label for="review_rating_4"><input type="radio" value="4" id="review_rating_4" name="ptd_movie_review_rating" <?php if( '4' === $review ) echo 'checked'; ?> /> <span>4 star</span></label><br />
		<label for="review_rating_5"><input type="radio" value="5" id="review_rating_5" name="ptd_movie_review_rating" <?php if( '5' === $review ) echo 'checked'; ?> /> <span>5 star</span></label><br />
		<span class="description">Select the movie review rating</span>
	</p>
<?php 
}


// Save meta data

function prowordpress_movie_meta_save ( $post_id ) {
	// verify if this is an auto save routine. 
// If it is the post has not been updated, so we don’t want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// verify this came from the screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !isset( $_POST['ptd_movie_meta_noncename'] ) || !wp_verify_nonce( $_POST['ptd_movie_meta_noncename'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	// Get the post type object.
	global $post;
	$post_type = get_post_type_object( $post->post_type );

	// Check if the current user has permission to edit the post.
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Get the posted data and pass it into an associative array for ease of entry
	$metadata['ptd_movie_rating'] = ( isset( $_POST['ptd_movie_rating'] ) ? $_POST['ptd_movie_rating'] : '' );
	$metadata['ptd_movie_running_time'] = ( isset( $_POST['ptd_movie_running_time'] ) ? $_POST['ptd_movie_running_time'] : '' );
	$metadata['ptd_movie_release_date'] = ( isset( $_POST['ptd_movie_release_date'] ) ? $_POST['ptd_movie_release_date'] : '' );
	$metadata['ptd_movie_review_rating'] = ( isset( $_POST['ptd_movie_review_rating'] ) ? $_POST['ptd_movie_review_rating'] : '' );

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

add_action ('save_post', 'prowordpress_movie_meta_save');
