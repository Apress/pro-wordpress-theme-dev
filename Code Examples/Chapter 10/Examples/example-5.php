<?php

/**
 * Relocating folders in the WordPress install (to go in wp-config.php)
 */

// Relocating the wp-content folder
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/content');
define('WP_CONTENT_URL', 'http://review.dev/content');
define('WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/content/plugins');
define('WP_PLUGIN_URL', 'http://review.dev/content/plugins');
define('PLUGINDIR', $_SERVER['DOCUMENT_ROOT'] . '/content/plugins');
