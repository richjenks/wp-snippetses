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
			'id'     => '',
			'title'  => '',
			'inline' => false,
		), $atts );

		// Get content
		$query = "SELECT post_content
			FROM $wpdb->posts
			WHERE ( ID = %d OR post_title = %s )
			AND post_type = %s
			AND post_status = 'publish'
			LIMIT 1";
		$prepared = $wpdb->prepare( $query, $atts['id'], $atts['title'], 'snippetses' );
		$return   = $wpdb->get_var( $prepared );

		// If post not found, no point continuing
		if ( is_null( $return ) ) return;

		// Make array of custom atts
		$vars = $atts;
		unset( $vars['id'] );
		unset( $vars['title'] );
		unset( $vars['inline'] );
		if ( $content ) $vars['content'] = $content;

		// Inject variables from shortcode
		foreach ( $vars as $key => $value ) {
			$pattern = "/{($key.*?)}/";
			$return  = preg_replace( $pattern, $value, $return );
		}

		// Check for unmached placeholders with default values
		$pattern = "/{.*default=\"(.*?)\".*?}/";
		$return  = preg_replace( $pattern, '\1', $return );

		// Make shortcodes work
		$return = do_shortcode( $return );

		// Inline content? (e.g. single var, not paragraphs)
		if ( !$atts['inline'] ) $return = wpautop( $return );

		// Return formatted
		return $return;

	}

}

new Shortcode;