<?php

/**
 * Shortcode
 *
 * Shortcode for variables
 */

namespace RichJenks\WPVariables;

class Shortcode extends Plugin {

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register shortcode
		add_action( 'init', function() {
			add_shortcode( 'variable', array( $this, 'shortcode' ) );
		} );

	}

	/**
	 * shortcode
	 *
	 * Outputs content for shortcode
	 */

	public function shortcode( $atts, $content = false ) {

		global $wpdb;

		// If post not specified by title, return false
		if ( !isset( $atts['var'] ) ) return false;

		// Get post content
		$content = $wpdb->get_var( $wpdb->prepare(
			"SELECT post_content FROM $wpdb->posts WHERE post_title = %s AND post_type = %s AND post_status = 'publish'" , array(
				$atts['var'],
				$this->prefix,
			)
		) );

		// Inject variables from shortcode (shortcode takes priority)
		foreach ( $atts as $key => $value ) {
			$content = str_replace( '[' . $key . ']', $value, $content );
		}

		// Inject variables from query string
		parse_str( $_SERVER['QUERY_STRING'], $query );
		foreach ( $query as $key => $value ) {
			$content = str_replace( '[' . substr( $key, 1 ) . ']', $value, $content );
		}

		// Make shortcodes work
		return do_shortcode( $content );

	}

}

new Shortcode;