(function ($) {

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
			$('#site-title a').css('color', to );
		} );
	} );

	// Update site background color in real time
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$('body').css('background-color', to );
		} );
	} );

	// Update link color in real time
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$('a').css('color', to );
		} );
	} );

} )( jQuery );
