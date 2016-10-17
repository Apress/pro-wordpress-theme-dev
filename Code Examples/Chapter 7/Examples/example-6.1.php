<?php

/**
 * Live updating the customizer
 */

// Add postMessage transport parameter

$wp_customize->add_setting( 'link_color' , array(
	'default'           => 'FF00FF',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'sanitize_hex_color_no_hash',
));


// Add customizer script (code in example-6.2.js)

function prowordpress_customizer_script()
{
	wp_enqueue_script( 'prowordpress-customizer-script',  
		get_template_directory_uri().'/javascript/theme-options.js', 
		array( 'jquery','customize-preview' ), 
		'', 
		true 
	);
}
add_action( 'customize_preview_init', 'prowordpress_customizer_script' );
