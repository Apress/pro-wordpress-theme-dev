<?php

/**
 * Custom data sanitization function
 */

function prowordpress_sanitize_html( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}
