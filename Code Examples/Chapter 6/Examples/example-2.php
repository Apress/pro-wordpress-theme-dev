<?php

/**
 * Hooks class example
 */

class prowordpress_notifications {

	function email($post_ID)  {

		$addresses = "someone@somewhere.com";
		$subject = "New post on Pro Wordpress: ".get_the_title( $post_ID );
		
		$content = "Hi x, \n\n Here's the latest from the Pro WordPress blog. \n\n";
		$content .= get_the_title( $post_ID ). "\n\n";
		$content .= 'Read it here: '.get_permalink( $post_ID);

		wp_mail($addresses, $subject, $content);
		
		return $post_ID;
	}
}

add_action('publish_post', array('prowordpress_notifications', 'email') );
