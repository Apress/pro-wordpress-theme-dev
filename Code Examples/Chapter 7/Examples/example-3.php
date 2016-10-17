<?php

/**
 * Simple Customizer example
 */

function prowordpress_customize_( $wp_customize ) {
	$wp_customize->add_setting( 'link_color' , array(
		'default'           => 'FF00FF',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
	));

	$wp_customize->add_section( 'prowordpress_content_customizations' , array(
		'title'       => __('Content customizations', 'prowordpress'),
		'description' => __('Customize the link colors in the theme', 'prowordpress'),
		'priority'    => 30,
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_control', array(
		'label'        => __( 'Link Color', 'prowordpress' ),
		'section'    => 'prowordpress_content_customizations',
		'settings'   => 'link_color',
	)));
}
add_action( 'customize_register', 'prowordpress_customize_register' );
