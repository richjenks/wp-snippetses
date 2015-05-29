<?php namespace RichJenks\WPSnippetses;

/**
 * Shortcode for variables
 */
class Shortcode {

	/**
	 * Register shortcode
	 */
	public function __construct() {
		add_action( 'init', function() { add_shortcode( 'snippet', array( $this, 'shortcode' ) ); } );
	}

	/**
	 * Outputs content for shortcode
	 *
	 * @param array  $atts    Shortcode attributes
	 * @param string $content Text inside enclosing shortcode
	 *
	 * @return string Snippet with variables injected
	 */
	public function shortcode( $atts = array(), $content = null ) {

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