(function ($) {

	// Update  link color in real time
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$('a').css('color', to );
		} );
	} );

} )( jQuery );
