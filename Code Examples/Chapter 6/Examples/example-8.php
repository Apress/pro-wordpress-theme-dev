<?php

/**
 * Handling multiple similar shortcodes
 */

// One function with attributes
function prowordpress_embed_shortcode($atts) {
	extract(shortcode_atts( array(
			'site' => 'youtube',
			'id'   => ''
		), $atts ));

	switch( $site ) {
		case 'youtube':
			return '<iframe width="853" height="480" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>'
			break;
		case 'vimeo':
			return "...";
			break;
	}
}

// Multiple functions, multiple shortcodes
function prowordpress_youtube_embed_shortcode($atts) {
	extract(shortcode_atts( array(
			'id'   => ''
		), $atts ));

	return '<iframe width="853" height="480" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
}
function prowordpress_vimeo_embed_shortcode($atts) {
	extract(shortcode_atts( array(
			'id'   => ''
		), $atts ));

	return '<iframe src="http://player.vimeo.com/video/'..'" width="850" height="478" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
}

add_shortcode('youtube', 'prowordpress_youtube_embed_shortcode');
add_shortcode('vimeo', 'prowordpress_vimeo_embed_shortcode');


// Best way - multiple shortcodes, one function ($tag parameter)

function prowordpress_embed_shortcode($atts, $content = NULL, $tag) {

	extract(shortcode_atts( array(
			'id'   => ''
		), $atts ));

	switch( $tag ) {
		case 'youtube':
			return '<iframe width="853" height="480" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
			break;
		case 'vimeo':
			return '<iframe src="http://player.vimeo.com/video/'.$id.'" width="850" height="478" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			break;
	}
}

add_shortcode('youtube', 'prowordpress_embed_shortcode');
add_shortcode('vimeo', 'prowordpress_embed_shortcode');
