<?php
/**
 * Ratings and reviews plugin class file.
 *
 * @package   RatingsAndReviews
 * @author    Adam Onishi < >
 * @license   GPL2
 * @copyright 2013 Adam Onishi
 */
class RatingsAndReviews {

	protected static $version = '0.0.1';

	protected static $plugin_slug = 'ratings-and-reviews';

	protected static $instance = null;

	private function __construct() {

		// Where we set up our plugin's functionality

	}

	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}
