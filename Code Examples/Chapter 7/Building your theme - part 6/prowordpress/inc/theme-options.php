<?php

/**
 * Theme customizer
 */

/**
 * Posts custom control
 */
if (class_exists('WP_Customize_Control')) {

	class Posts_Dropdown_Custom_Control extends WP_Customize_Control {

		/**
		 * @access public
		 * @var string
		 */
		public $post_type = 'post';

		/**
		* Render the control's content
		*/
		public function render_content() {
		?>
			<label>
				<span class="customize-post-dropdown"><?php echo esc_html( $this->label ); ?></span>
				<select id="<?php echo $this->id; ?>" <?php $this->link(); ?>>
					<option value="">Please select</option>
					<?php
					$args = wp_parse_args( array(
							'post_type'   => $this->post_type,
							'numberposts' => '-1',
						)
					);
					$posts = get_posts($args);

					foreach ( $posts as $post ) {
						echo '<option value="'.$post->ID.'" '.selected($this->value(), $post->ID).'>'.$post->post_title.'</option>';
					}
					?>
				</select>
			</label>
		<?php
		}
	}
}

/**
 * Create textarea control
 */
if( class_exists('WP_Customize_Control') ) {
	
	class PTD_Textarea_Control extends WP_Customize_Control {
		public function render_content() {
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
						<?php echo esc_textarea( $this->value() ); ?>
					</textarea>
				</label>
			<?php
		}

	}	
}

/**
 * Create Colour Scheme control
 */
if( class_exists('WP_Customize_Control') ) {
	class PTD_Color_Scheme_Control extends WP_Customize_Control {

		public $type = 'color_palette';

		public function render_content() {
			
			$name = '_customize-radio-' . $this->id;
			$values = array(
					'palette-1' => 'Option 1',
					'palette-2' => 'Option 2',
					'palette-3' => 'Option 3',
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
	} // End class
} // End if


/**
 * Register customization controls
 */
function prowordpress_customize_register( $wp_customize ) {
	// Update transport method of default customizations
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Add site logo customize option
	$wp_customize->add_setting( 'site_logo' , array(
		'default'           => '',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_section( 'prowordpress_logo_section' , array(
		'title'       => __('Custom logo', 'prowordpress'),
		'description' => __('Add a custom logo for the site', 'prowordpress'),
		'priority'    => 30,
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
		'label'        => __( 'Site logo', 'prowordpress' ),
		'section'    => 'prowordpress_logo_section',
	)));

	// Add contact details customize options
	$wp_customize->add_setting( 'contact_details' , array(
		'default'           => '',
	));

	$wp_customize->add_section( 'prowordpress_contact_section' , array(
		'title'       => __('Contact details', 'prowordpress'),
		'description' => __('Add the contact details to go in the footer and contact page', 'prowordpress'),
		'priority'    => 35,
	));

	$wp_customize->add_control( new PTD_Textarea_Control( $wp_customize, 'contact_details_control', array(
		'label'       => __( 'Contact details', 'prowordpress' ),
		'section'     => 'prowordpress_contact_section',
		'settings'    => 'contact_details',
	)));

	// Add customization control for featured item
	$wp_customize->add_setting( 'featured_item' , array(
		'default'           => '',
		'transport'         => 'refresh',
	));

	$wp_customize->add_section( 'prowordpress_featured_item' , array(
		'title'       => __('Featured item', 'prowordpress'),
		'description' => __('Add a featured item to the homepage', 'prowordpress'),
		'priority'    => 40,
	));

	$wp_customize->add_control( new Posts_Dropdown_Custom_Control( $wp_customize, 'featured_item', array(
		'label'      => __( 'Featured item', 'prowordpress' ),
		'section'    => 'prowordpress_featured_item',
		'post_type'  => 'ptd_menu',
	)));

	// Add customization control for Color palette selector
	$wp_customize->add_setting( 'colour_palette' , array(
		'default'           => '',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_section( 'prowordpress_colour_palette' , array(
		'title'       => __('Color Palette', 'prowordpress'),
		'description' => __('Select the color palette for the site to use', 'prowordpress'),
		'priority'    => 40,
	));

	$wp_customize->add_control( new PTD_Color_Scheme_Control( $wp_customize, 'colour_palette', array(
		'label'      => __( 'Select color palette', 'prowordpress' ),
		'section'    => 'prowordpress_colour_palette',
	)));
}
add_action( 'customize_register', 'prowordpress_customize_register' );

/**
 * Styles for color palette customizer option
 */
function prowordpress_customizer_styles () {
	?>
	<style>
		.customize-control-color_palette .color-palette-option { float:left; width:100%; margin-bottom:10px; }
		.customize-control-color_palette .color-palette-option input { float:left; margin:13px 10px 0 0; }
	</style>
	<?php 
}

add_action( 'customize_controls_print_styles', 'prowordpress_customizer_styles', 30 );


function prowordpress_customizer_script()
{
	wp_enqueue_script( 'prowordpress-customizer-script',  
		get_template_directory_uri().'/javascript/theme-options.js', 
		array( 'jquery','customize-preview' ), 
		'2', 
		true 
	);

	// wp_enqueue_style( 'palette', get_template_directory_uri() . '/css/palette-previews.css' );
}
add_action( 'customize_preview_init', 'prowordpress_customizer_script' );