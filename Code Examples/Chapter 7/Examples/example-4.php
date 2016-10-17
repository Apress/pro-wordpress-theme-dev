<?php 

/**
 * Outputting CSS to the head (from customizations) example
 */

function prowordpress_customize_css()
{
	?>
		 <style type="text/css">
			 a { color:#<?php echo get_theme_mod('link_color', 'FF00FF'); ?>; }
		 </style>
	<?php
}
add_action( 'wp_head', 'prowordpress_customize_css');
