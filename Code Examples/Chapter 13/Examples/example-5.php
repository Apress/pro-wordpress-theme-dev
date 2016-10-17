<?php

private function __construct() {

	// Load stylesheets and scripts
	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

}

public function enqueue_styles() {
	wp_enqueue_style( $this->plugin_slug . '-styles', plugins_url( 'css/style.css', __FILE__ ), array(), $this->version );
}

public function enqueue_scripts() {
	wp_enqueue_script( $this->plugin_slug . '-scripts', plugins_url( 'js/scripts.js', __FILE__ ), array('jquery'), $this->version, true );
}
