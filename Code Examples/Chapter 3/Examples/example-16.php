<?php
/**
 * Menu template tags example
 */

// Register the menu location in your functions.php file
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'prowordpress' ),
) );

?>


<?php
	// To be able to access the menu in your templates through the wp_nav_menu function
	wp_nav_menu( array('theme_location' => 'primary', 'container' => '' ));
?>