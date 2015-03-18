<?php

/**
 * PostType
 *
 * Custom Post Type for Templates
 */

namespace RichJenks\WPTemplates;

class PostType {

	use Plugin;

	/**
	 * __construct
	 *
	 * Start the magic...
	 */

	public function __construct() {

		// Register post type
		add_action( 'init', function() {
			register_post_type( $this->post_type, $this->get_args() );
		} );

		// Trim Title
		add_filter( 'wp_insert_post_data', function( $data , $postarr ) {
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
			'name'               => _x( 'Templates', 'post type general name', $text_domain ),
			'singular_name'      => _x( 'Template', 'post type singular name', $text_domain ),
			'menu_name'          => _x( 'Templates', 'admin menu', $text_domain ),
			'name_admin_bar'     => _x( 'Template', 'add new on admin bar', $text_domain ),
			'add_new'            => _x( 'Add New', 'Template', $text_domain ),
			'all_items'          => __( 'All Templates', $text_domain ),
			'add_new_item'       => __( 'Add Template', $text_domain ),
			'new_item'           => __( 'New Template', $text_domain ),
			'edit_item'          => __( 'Edit Template', $text_domain ),
			'view_item'          => __( 'View Template', $text_domain ),
			'search_items'       => __( 'Search Templates', $text_domain ),
			'parent'             => __( 'Parent Template', $text_domain ),
			'parent_item_colon'  => __( 'Parent Template:', $text_domain ),
			'not_found'          => __( 'No Templates found.', $text_domain ),
			'not_found_in_trash' => __( 'No Templates found in Trash.', $text_domain ),
		);
	}

}

new PostType;