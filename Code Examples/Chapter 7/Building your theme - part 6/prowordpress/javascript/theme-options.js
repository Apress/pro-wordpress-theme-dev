(function ($) {

	wp.customize( 'site_logo', function( value ) {
		value.bind( function( to ) {
			$('img.site-logo').attr('src', to);
		} );
	} );

	// Update site title in real time
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).html( to );
		} );
	} );
	
	// Update the site description in real time
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		} );
	} );

	// Update site title color in real time
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			$('.post h3').css('color', to );
		} );
	} );

	// Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$('body').css('background-color', to );
		} );
	} );

	wp.customize( 'color_palette', function( value ) {
		value.bind( function( to ) {
			for(var i=1; i<4; i++ ) {
				$('body').removeClass('preview-palette-' + i);	
			}
			
			$('body').addClass('preview-' + to);
		} );
	} );


} )( jQuery );