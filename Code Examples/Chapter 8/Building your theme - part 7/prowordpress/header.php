<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package prowordpress
 * @since prowordpress 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory') ?>/javascript/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="container">
		<header>
			<h1>
				<a href="<?php echo home_url( '/' ); ?>">
					<?php bloginfo( 'blogname' ); ?>
				</a>
			</h1>
		</header>

		<nav class="menu main-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false )); ?>
		</nav>
		
		<div class="main" role="main">