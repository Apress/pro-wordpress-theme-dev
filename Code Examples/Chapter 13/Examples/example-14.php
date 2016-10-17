<?php

function rar_create_admin_page(){
?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Ratings &amp; Reviews Settings</h2>

	<form action="options.php" method="post">
		<?php 
		// This prints out all hidden setting fields
		settings_fields('rar_options');	
		do_settings_sections('rar-settings-admin');

		submit_button(); ?>
	</form>
</div>
<?php
}

if( is_admin() ) {
	add_action( 'admin_init', 'rar_register_options' );
}

function rar_register_options() {
	register_setting( 'rar_options', 'rar-options', 'rar_options_validate' );

	add_settings_section( 'rar-defaults', 'Defaults', 'rar_section_info', 'rar-settings-admin' );

	add_settings_field( 'display-count', 'Display count', 'rar_field_display_count', 'rar-settings-admin', 'rar-defaults' );
}

function rar_field_display_count() {
	$options = get_option('rar-options');
	
	if( isset( $options['display-count']) ) {
		$display_count = $options['display-count'];
	} else {
		$display_count = '';
	}

	echo '<input name="rar-options[display-count]" id="rar-display-count" type="text" value="' . $display_count . '" />';
}

function rar_section_info() {
	echo '<p>Set the default outputs of the plugin</p>';
}

register_setting( 'rar_options', 'rar-options', 'rar_options_validate' );

function rar_options_validate ( $input ) {
	
	if( is_numeric($input['display-count']) ){
		$newinput['display-count'] = $input['display-count'];
	} else {
		$newinput['display-count'] = '';
	}

	return $newinput;
}
