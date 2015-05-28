<?php namespace RichJenks\WPSnippetses;

/**
 * PostType
 *
 * Custom Post Type for Templates
 */

class PostType {

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register post type
		add_action( 'init', function() {
			register_post_type( 'snippetses', $this->get_args() );
		} );

	}

	/**
	 * get_args
	 *
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
	 * get_labels
	 *
	 * @return array Hard-coded labels for post type
	 */

	private function get_labels() {
		$text_domain = 'richjenks_templates';
		return array(
			'name'               => _x( 'Snippets', 'post type general name', $text_domain ),
			'singular_name'      => _x( 'Snippet', 'post type singular name', $text_domain ),
			'menu_name'          => _x( 'Snippets', 'admin menu', $text_domain ),
			'name_admin_bar'     => _x( 'Snippet', 'add new on admin bar', $text_domain ),
			'add_new'            => _x( 'Add New', 'Snippet', $text_domain ),
			'all_items'          => __( 'All Snippets', $text_domain ),
			'add_new_item'       => __( 'Add Snippet', $text_domain ),
			'new_item'           => __( 'New Snippet', $text_domain ),
			'edit_item'          => __( 'Edit Snippet', $text_domain ),
			'view_item'          => __( 'View Snippet', $text_domain ),
			'search_items'       => __( 'Search Snippets', $text_domain ),
			'parent'             => __( 'Parent Snippet', $text_domain ),
			'parent_item_colon'  => __( 'Parent Snippet:', $text_domain ),
			'not_found'          => __( 'No Snippets found.', $text_domain ),
			'not_found_in_trash' => __( 'No Snippets found in Trash.', $text_domain ),
		);
	}

}

new PostType;