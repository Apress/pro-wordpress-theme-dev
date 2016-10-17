<?php

/**
 * Categories template tags
 */

$args = array(
	'orderby'    => 'count',
	'order'      => 'ASC',
	'style'      => 'list',
	'show_count' => 1,
	'hide_empty' => 0,
	'title_li'   => '',
	'number'     => 10,
	'depth'      => -1,
);
wp_list_categories( $args );