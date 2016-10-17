<?php
/*
Plugin Name: Content word counter
Description: Returns the word count of the content of a post
Version: 1.0
Author: Adam Onishi
Author URI: http://adamonishi.com
License: GPL2
*/
?>
<?php
/*  Copyright 2013  Adam Onishi  (email :)
	[...]
*/
?>

<?php
function ptd_get_the_content_word_count($post_id = false) {

	if( ! $post_id ) {
		$post_id = get_the_ID();
	} 

	$content = get_the_content($post_id);
	
	$word_count = str_word_count($content);

	return $word_count;
}

?>
