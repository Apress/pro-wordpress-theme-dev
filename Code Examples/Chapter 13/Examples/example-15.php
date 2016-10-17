<?php

function rar_settings_link($actions, $file) {

	if(false !== strpos($file, 'ratings-and-reviews')) {
		$actions['settings'] = '<a href="options-general.php?page=rar-settings-admin">Settings</a>';
	}
 		
	return $actions; 
}

add_filter('plugin_action_links', 'rar_settings_link', 2, 2);
