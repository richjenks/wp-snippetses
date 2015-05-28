<?php namespace RichJenks\WPSnippetses;

/**
 * Shortcode
 *
 * Shortcode for variables
 */

class Shortcode {

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register shortcode
		add_action( 'init', function() {
			add_shortcode( 'snippet', array( $this, 'shortcode' ) );
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
		$query = "SELECT post_content
			FROM $wpdb->posts
			WHERE ( ID = %d OR post_title = %s )
			AND post_type = %s
			AND post_status = 'publish'
			LIMIT 1";
		$prepared = $wpdb->prepare( $query, $atts['id'], $atts['title'], 'snippetses' );
		$return = $wpdb->get_var( $prepared );

		// Inject variables from shortcode
		foreach ( $atts as $key => $value ) $return = str_replace( '[' . $key . ']', $value, $return );

		// Inject content?
		if ( $content ) $return = str_replace( '[content]', $content, $return );

		// Make shortcodes work
		$return = do_shortcode( $return );

		// Return formatted
		return wpautop( $return );

	}

}

new Shortcode;