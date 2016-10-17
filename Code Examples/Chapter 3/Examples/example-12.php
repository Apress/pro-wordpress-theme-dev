<?php

/**
 * Comment template tags
 */

$args = array(
	'style'       => 'ul',
	'per_page'    => 10,
	'avatar_size' => 50,
);
wp_list_comments($args); ?>