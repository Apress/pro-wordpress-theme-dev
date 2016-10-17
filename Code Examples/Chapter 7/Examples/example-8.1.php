<?php

/**
 * Customizer color scheme control
 */

class PTD_Color_Scheme_Control extends WP_Customize_Control {

	public $type = 'color_palette';

	public function render_content() {
		
		$name = '_customize-radio-' . $this->id;
		$values = array(
				'palette-1' => 'Palette 1',
				'palette-2' => 'Palette 2',
				'palette-3' => 'Palette 3',
			);

		?>
		<span class="customize-control-title">Color palettes</span>
		<?php

		foreach( $values as $value => $label ):
		?>
		<label class="color-palette-option">
			<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
			<img src="<?php echo get_template_directory_uri() . '/images/color-palettes/' . $value . '.png'; ?>" alt="<?php echo $label; ?>">
		</label>
		<?php
		endforeach;
	}
}

// Add styles to the customizer sidebar

function prowordpress_customizer_styles () {
	?>
	<style>
		.customize-control-color_palette .color-palette-option { float:left; width:100%; margin-bottom:10px; }
		.customize-control-color_palette .color-palette-option input { float:left; margin:13px 10px 0 0; }
	</style>
	<?php 
}

add_action( 'customize_controls_print_styles', 'prowordpress_customizer_styles', 30 );


// Add color schemes demo JS and CSS (example-8.2.js amd example-8.3.css)
// 
function prowordpress_customizer_script()
{
	wp_enqueue_script( 'prowordpress-customizer-script',  
		get_template_directory_uri().'/javascript/theme-options.js', 
		array( 'jquery','customize-preview' ), 
		'1', 
		true 
	);

	wp_enqueue_style( 'palette', get_template_directory_uri() . '/css/palette-previews.css' );
}
add_action( 'customize_preview_init', 'prowordpress_customizer_script' );