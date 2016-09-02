<?php
/**
 * Copyright Andreas Nurbo
 *
 * @package GooseStudio\CPTPersons
 */

namespace GooseStudio\CPTPersons;

/**
 * Class CPT_Persons
 *
 * @package GooseStudio\CPTPersons
 */
class CPT_Persons {

	/**
	 * Setups actions and filters
	 */
	public function init() {
		add_action( 'init', [ $this, 'register_post_type' ] );
	}

	/**
	 * Registers the post type
	 *
	 * @since 0.1
	 */
	public function register_post_type() {
		$labels       = array(
			'name'                  => _x( 'Persons', 'Post Type General Name', 'cpt-persons' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'cpt-persons' ),
			'menu_name'             => __( 'Persons', 'cpt-persons' ),
			'name_admin_bar'        => __( 'Persons', 'cpt-persons' ),
			'archives'              => __( 'Persons', 'cpt-persons' ),
			'parent_item_colon'     => __( 'Parent person:', 'cpt-persons' ),
			'all_items'             => __( 'All Persons', 'cpt-persons' ),
			'add_new_item'          => __( 'Add New Person', 'cpt-persons' ),
			'add_new'               => __( 'Add New', 'cpt-persons' ),
			'new_item'              => __( 'New Person', 'cpt-persons' ),
			'edit_item'             => __( 'Edit Person', 'cpt-persons' ),
			'update_item'           => __( 'Update Person', 'cpt-persons' ),
			'view_item'             => __( 'View Person', 'cpt-persons' ),
			'search_items'          => __( 'Search Person', 'cpt-persons' ),
			'not_found'             => __( 'Not found', 'cpt-persons' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'cpt-persons' ),
			'featured_image'        => __( 'Portrait', 'cpt-persons' ),
			'set_featured_image'    => __( 'Set portrait image', 'cpt-persons' ),
			'remove_featured_image' => __( 'Remove portrait image', 'cpt-persons' ),
			'use_featured_image'    => __( 'Use as portrait image', 'cpt-persons' ),
			'insert_into_item'      => __( 'Insert into person', 'cpt-persons' ),
			'uploaded_to_this_item' => __( 'Uploaded to this person', 'cpt-persons' ),
			'items_list'            => __( 'Persons list', 'cpt-persons' ),
			'items_list_navigation' => __( 'Persons list navigation', 'cpt-persons' ),
			'filter_items_list'     => __( 'Filter persons list', 'cpt-persons' ),
		);
		$capabilities = array(
			'edit_post'          => 'edit_person',
			'read_post'          => 'read_person',
			'delete_post'        => 'delete_person',
			'edit_posts'         => 'edit_persons',
			'edit_others_posts'  => 'edit_others_persons',
			'publish_posts'      => 'publish_persons',
			'read_private_posts' => 'read_private_persons',
		);
		$args         = array(
			'label'               => __( 'Person', 'cpt-persons' ),
			'description'         => __( 'Makes it possible to add persons to your site', 'cpt-persons' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 70,
			'menu_icon'           => 'dashicons-businessman',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capabilities'        => $capabilities,
		);
		register_post_type( 'persons', $args );
	}
}
