<?php namespace RichJenks\WPSnippetses;

/**
 * Custom Post Type for Templates
 */
class PostType {

	/**
	 * Go!
	 */
	public function __construct() {

		// Register post type
		add_action( 'init', function() { register_post_type( 'snippetses', $this->get_args() ); } );

		// Register shortcode column
		add_filter( 'manage_edit-snippetses_columns', [ $this, 'register_shortcode_column' ] );
		add_action( 'manage_snippetses_posts_custom_column', [ $this, 'manage_snippetses_columns' ], 10, 2 );

	}

	/**
	 * @return array Hard-coded arguments for post type
	 */
	private function get_args() {
		return array(
			'labels'             => $this->get_labels(),
			'public'             => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-format-quote',
			'show_in_menu'       => true,
			'query_var'          => false,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'page-attributes' ),
		);
	}

	/**
	 * @return array Hard-coded labels for post type
	 */
	private function get_labels() {
		$text_domain = 'snippetses';
		return array(
			'name'               => _x( 'Snippetses', 'post type general name', $text_domain ),
			'singular_name'      => _x( 'Snippet', 'post type singular name', $text_domain ),
			'menu_name'          => _x( 'Snippetses', 'admin menu', $text_domain ),
			'name_admin_bar'     => _x( 'Snippet', 'add new on admin bar', $text_domain ),
			'add_new'            => _x( 'Add New', 'Snippet', $text_domain ),
			'all_items'          => __( 'All Snippetses', $text_domain ),
			'add_new_item'       => __( 'Add Snippet', $text_domain ),
			'new_item'           => __( 'New Snippet', $text_domain ),
			'edit_item'          => __( 'Edit Snippet', $text_domain ),
			'view_item'          => __( 'View Snippet', $text_domain ),
			'search_items'       => __( 'Search Snippetses', $text_domain ),
			'parent'             => __( 'Parent Snippet', $text_domain ),
			'parent_item_colon'  => __( 'Parent Snippet:', $text_domain ),
			'not_found'          => __( 'No Snippetses found.', $text_domain ),
			'not_found_in_trash' => __( 'No Snippetses found in Trash.', $text_domain ),
		);
	}

	/**
	 * Adds a column in post list for each snippet's shortcode
	 * Also hides date, because it's not needed
	 */
	public function register_shortcode_column( $gallery_columns ) {
		unset( $gallery_columns[ 'date' ] );
		$gallery_columns[ 'shortcode' ] = __( 'Shortcode' );
		return $gallery_columns;
	}

	/**
	 * Adds value to shortcode column in post list
	 */
	public function manage_snippetses_columns( $column, $id ) {
		if ( $column === 'shortcode' ) {
			echo '[snippet id="' . $id . '"]';
		}
	}

}

new PostType;