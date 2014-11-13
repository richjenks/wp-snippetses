<?php

/**
 * PostType
 *
 * Custom Post Type for variables
 */

namespace RichJenks\WPVariables;

class PostType extends Plugin {

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Init Actions
		add_action( 'init', function() {

			// Register post type
			register_post_type( $this->prefix, $this->get_args() );

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
			'menu_icon'          => 'dashicons-format-quote',
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
		$text_domain = 'richjenks_wpvariables';
		return array(
			'name'               => _x( 'Variables', 'post type general name', $text_domain ),
			'singular_name'      => _x( 'Variable', 'post type singular name', $text_domain ),
			'menu_name'          => _x( 'Variables', 'admin menu', $text_domain ),
			'name_admin_bar'     => _x( 'Variable', 'add new on admin bar', $text_domain ),
			'add_new'            => _x( 'Add New', 'Variable', $text_domain ),
			'all_items'          => __( 'All Variables', $text_domain ),
			'add_new_item'       => __( 'Add Variable', $text_domain ),
			'new_item'           => __( 'New Variable', $text_domain ),
			'edit_item'          => __( 'Edit Variable', $text_domain ),
			'view_item'          => __( 'View Variable', $text_domain ),
			'search_items'       => __( 'Search Variables', $text_domain ),
			'parent_item_colon'  => __( 'Parent Variable:', $text_domain ),
			'not_found'          => __( 'No Variables found.', $text_domain ),
			'not_found_in_trash' => __( 'No Variables found in Trash.', $text_domain ),
		);
	}

}

new PostType;