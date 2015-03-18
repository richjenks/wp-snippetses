<?php

/**
 * Shortcode
 *
 * Shortcode for variables
 */

namespace RichJenks\WPTemplates;

class Shortcode {

	use Plugin;

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register shortcode
		add_action( 'init', function() {
			add_shortcode( 'template', array( $this, 'shortcode' ) );
		} );

	}

	/**
	 * shortcode
	 *
	 * Outputs content for shortcode
	 */

	public function shortcode( $atts = array(), $content = false ) {

		global $wpdb;

		// If neither id nor title set, do nothing
		if ( empty( $atts['id'] ) && empty( $atts['title'] ) ) return false;

		// Prepare array for query
		$atts = array_merge( array(
			'id'    => '',
			'title' => '',
		), $atts );

		// Get content
		$query = "SELECT post_content FROM $wpdb->posts WHERE ( ID = %d OR post_title = %s ) AND post_type = %s AND post_status = 'publish'";
		$prepared = $wpdb->prepare( $query, $atts['id'], $atts['title'], $this->post_type );
		$content = $wpdb->get_var( $prepared );

		// Inject variables from shortcode
		foreach ( $atts as $key => $value ) $content = str_replace( '[' . $key . ']', $value, $content );

		// Make shortcodes work
		return do_shortcode( $content );

	}

}

new Shortcode;