(function ($) {

	wp.customize( 'color_palette', function( value ) {
		value.bind( function( to ) {
			for(var i=1; i<4; i++ ) {
				$('body').removeClass('preview-palette-' + i);	
			}
			
			$('body').addClass('preview-' + to);
		} );
	} );

} )( jQuery );
