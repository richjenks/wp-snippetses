<?php

/**
 * VariableShortcode
 *
 * Shortcode for variables
 */

namespace RichJenks\WPVariables;

class VariableShortcode {

	/**
	 * @var string Post Type
	 */

	private $post_type = 'rj_variables';

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register shortcode
		add_action( 'init', function() {
			add_shortcode( 'var', array( $this, 'shortcode' ) );
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
		if ( !isset( $atts['title'] ) ) return false;

		// Get post content
		$query = 'SELECT post_content FROM ' . $wpdb->prefix . 'posts WHERE post_title = "' . $atts['title'] . '" AND post_type = "' . $this->post_type . '" AND post_status = "publish" LIMIT 1';
		$content = $wpdb->get_var( $query );

		// Replace variables in content
		unset( $atts['title'] );
		foreach ( $atts as $key => $value ) {
			$content = str_replace( '{' . $key . '}', $value, $content );
		}

		return $content;

	}

}

new VariableShortcode;