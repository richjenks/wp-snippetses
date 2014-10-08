<?php

/**
 * SnippetsPostType
 *
 * Custom Post Type for snippets
 */

namespace RichJenks\WPSnippets;

class SnippetsPostType {

	/**
	 * @var string Post Type
	 */

	private $post_type = 'rj_snippets';

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Init Actions
		add_action( 'init', function() {

			// Register post type
			register_post_type( $this->post_type, $this->get_args() );

		} );

		// Post Save Filter
		add_filter( 'wp_insert_post_data', function( $data , $postarr ) {

			// Trim Title
			$data['post_title'] = trim( $data['post_title'] );

			return $data;

		}, 99, 2 );

	}

	/**
	 * get_args
	 *
	 * @return array Hard-coded arguments for post type
	 */

	private function get_args() {
		return array(
			'labels'             => $this->get_labels(),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'menu_icon'          => 'dashicons-welcome-write-blog',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' ),
		);
	}

	/**
	 * get_labels
	 *
	 * @return array Hard-coded labels for post type
	 */

	private function get_labels() {
		return array(
			'name'               => _x( 'Snippets', 'post type general name', 'richjenks_wpsnippets' ),
			'singular_name'      => _x( 'Snippet', 'post type singular name', 'richjenks_wpsnippets' ),
			'menu_name'          => _x( 'Snippets', 'admin menu', 'richjenks_wpsnippets' ),
			'name_admin_bar'     => _x( 'Snippet', 'add new on admin bar', 'richjenks_wpsnippets' ),
			'add_new'            => _x( 'Add New', 'Snippet', 'richjenks_wpsnippets' ),
			'all_items'          => __( 'All Snippets', 'richjenks_wpsnippets' ),
			'add_new_item'       => __( 'Add Snippet', 'richjenks_wpsnippets' ),
			'new_item'           => __( 'New Snippet', 'richjenks_wpsnippets' ),
			'edit_item'          => __( 'Edit Snippet', 'richjenks_wpsnippets' ),
			'view_item'          => __( 'View Snippet', 'richjenks_wpsnippets' ),
			'search_items'       => __( 'Search Snippets', 'richjenks_wpsnippets' ),
			'parent_item_colon'  => __( 'Parent Snippet:', 'richjenks_wpsnippets' ),
			'not_found'          => __( 'No Snippets found.', 'richjenks_wpsnippets' ),
			'not_found_in_trash' => __( 'No Snippets found in Trash.', 'richjenks_wpsnippets' ),
		);
	}

	/**
	 * usage_notice
	 *
	 * Show a notice with usage information for snippet
	 *
	 * @param int $post ID for post
	 */

	private function usage_notice() {

	}

}

new SnippetsPostType;