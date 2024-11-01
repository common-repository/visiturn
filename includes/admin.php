<?php
/* Dashboard Admin Menu */

/** Registers the 'edit_visiturn' cap with WordPress */

function add_visiturn_caps() {
	$roles = apply_filters( 'visiturn_roles', array( 'editor', 'administrator' ) );

	foreach ( $roles as $role ) {
		/* Retrieve the editor role to add the cap to */
		$role = get_role( $role );

		/* Add the capability to edit footer text */
		$role->add_cap( 'edit_visiturn' );
	}
}

add_action( 'admin_init', 'add_visiturn_caps');


/**
 * Add the Visiturn options page to the 'Settings' dashboard menu
 * @uses   add_options_page() To register the new sub-menu
 * @return void
 */
function add_visiturn_options_page() {
	add_options_page(
		__( 'Visiturn', 'visiturn' ),
		__( 'Visiturn', 'visiturn' ),
		'edit_visiturn',
		'visiturn',
		'render_visiturn_options_page',
		plugin_dir_url( __FILE__ ) . 'assets/icon-256x256.png'
	);
}

add_action( 'admin_menu', 'add_visiturn_options_page' );


/**
 * Display the Visiturn code enter page and save code to the database
 *
 * @uses   update_option() To save the text to the database
 * @uses   wp_editor()     For a visual editor and disable WYSIWYG
 * @uses   get_option()    To retrieve the current text from the database
 * @uses   submit_button() To generate a form submit button
 *
 * @return void
 */
function render_visiturn_options_page() {
	$submit_done = false;
	if ( isset( $_POST['visiturn'] ) ) {
		update_option( 'theme_visiturn', stripslashes( $_POST['visiturn'] ) );
		$submit_done = true;
	}

	echo '<div class="wrap">';
	printf ( '<h1>%s</h1>', __( 'Visiturn Code', 'visiturn' ) );

 	if ( $submit_done == 'true' ) {
 		echo '<p class="form-submit-success" style="color: green">Your Visiturn code has been updated successfully</p>';
 	}

	echo '<form method="post" action="" style="margin: 20px 0;">';

	$settings = array( 'tinymce' => false, 'media_buttons' => false, 'quicktags' => false, 'wpautop' => false, 'editor_height' => 120 );
	wp_editor( get_option( 'theme_visiturn', '' ), 'visiturn', $settings );
	submit_button();

	echo '</form></div>';

}