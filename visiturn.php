<?php
/*
Plugin Name: Visiturn
Plugin URI:  
Description: Add Visiturn code in wordpress all pages to get site stats.
Version:     1.0.3
Author:      NetStudios
Author URI:  http://www.netstudios.in/
License:     MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: visiturn
Domain Path: /languages
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'VISITURN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/* Administration */
require VISITURN_PLUGIN_DIR . 'includes/admin.php';


/* Template Tags */
require VISITURN_PLUGIN_DIR . 'includes/template-tags.php';

/* Load the plugin textdomain */
function load_visiturn_textdomain() {
	load_plugin_textdomain( 'visiturn', false, VISITURN_PLUGIN_DIR . '/languages/' );
}

add_action( 'plugins_loaded', 'load_visiturn_textdomain' );