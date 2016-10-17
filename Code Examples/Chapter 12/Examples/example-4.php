<?php

/**
 * Comments rating field
 */

function comments_rating_field () { 
	echo '<p><label>' . __('Rating', 'prowordpress') . '<span class="required">*</span></label>' .
		'<select name="ptd_comment_rating">' .
			'<option value="">Please choose</option>' .
			'<option value="rubbish">Rubbish</option>' .
			'<option value="ok">Ok</option>' .
			'<option value="excellent">Excellent</option>' .
		'</select></p>';
}

add_action( 'comment_form_logged_in_after', 'comments_rating_field' );
add_action( 'comment_form_after_fields', 'comments_rating_field' );


// Testing ratings field has been submitted

function process_comment_rating_field( $commentdata ) {
	$ratings = array('rubbish', 'ok', 'excellent' );

	if ( ! isset( $_POST['ptd_comment_rating'] ) ) {
		wp_die( __( 'Error: You did not add a rating. Use the Back button on your Web browser to revisit the post and resubmit your comment.' ) );
	} elseif ( ! in_array($_POST['ptd_comment_rating'], $ratings) ) {
		wp_die( __( 'Error: You did not set a rating correctly. Use the Back button on your Web browser to revisit the post and resubmit your comment.' ) );
	}
		
	return $commentdata;
}

add_filter( 'preprocess_comment', 'process_comment_rating_field' );


// Saving ratings with comment meta

function prowordpress_save_comment_meta( $comment_id ) {
	if ( ( isset( $_POST['ptd_comment_rating'] ) ) && ( $_POST['ptd_comment_rating'] != '') ) {
		$rating = wp_filter_nohtml_kses($_POST['ptd_comment_rating']);
		add_comment_meta( $comment_id, 'ptd_comment_rating', $rating );
	}
}

add_action( 'comment_post', 'prowordpress_save_comment_meta' );
