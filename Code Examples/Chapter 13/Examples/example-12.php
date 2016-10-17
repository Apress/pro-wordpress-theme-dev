<?php

if( is_admin() ) {
    add_action( 'admin_menu', 'rar_add_plugin_options_page' );
}

function rar_add_plugin_options_page(){
	add_options_page('Ratings & Reviews settings', 'Ratings & Reviews', 'manage_options', 'rar-settings-admin', 'rar_create_admin_page' );
}

function rar_create_admin_page(){
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2>Ratings &amp; Reviews Settings</h2>			
        
</div>
<?php
}
