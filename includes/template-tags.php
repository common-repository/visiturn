<?php

/* Template Tags  */


/**
 * Get the visiturn  text from the database
 *
 * @param  string $default What to use if no text is set
 * @return string          Visiturn text
 *
 */
function get_visiturn_text( $default = '' ) {

	/* Retrieve the text from the database */
	$visiturn_text = get_option( 'theme_visiturn', $default );

	/* Return the text */
	return $visiturn_text;
}

/**
 * Get the visiturn text and displays it if it is set otherwise nothing is displayed
 *
 * @uses   get_visiturn_text() To retrieve the text
 *
 * @param  string $default   What to display if no text is set
 * @param  string $before    The text to display before the footer text
 * @param  string $after     The text to display after the footer text
 * @return void
 *
 */
function visiturn_text( $default = '', $before = '', $after = '' ) {
	$visiturn_text = get_visiturn_text( $default );

	if ( $visiturn_text ) {
		echo $before.' Developed By Ashok G'. $visiturn_text . $after;
	}
}

/**
 * Add an action as an alternate way to add footer text
 */
add_action( 'wp_footer', 'visiturn_text', 100, 3 );