<?php

/**
 * Registers the `type` taxonomy,
 * for use with 'recipe'.
 */
function type_init() {
	register_taxonomy( 'type', [ 'recipe' ], [
		'hierarchical'          => true,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => false,
		'rewrite'               => false,
		'capabilities'          => [
			'manage_terms' => 'manage_types',
			'edit_terms'   => 'edit_types',
			'delete_terms' => 'delete_types',
			'assign_terms' => 'assign_types',
		],
		'labels'                => [
			'name'                       => __( 'Types', 'ocooking' ),
			'singular_name'              => _x( 'Type', 'taxonomy general name', 'ocooking' ),
			'search_items'               => __( 'Search Types', 'ocooking' ),
			'popular_items'              => __( 'Popular Types', 'ocooking' ),
			'all_items'                  => __( 'All Types', 'ocooking' ),
			'parent_item'                => __( 'Parent Type', 'ocooking' ),
			'parent_item_colon'          => __( 'Parent Type:', 'ocooking' ),
			'edit_item'                  => __( 'Edit Type', 'ocooking' ),
			'update_item'                => __( 'Update Type', 'ocooking' ),
			'view_item'                  => __( 'View Type', 'ocooking' ),
			'add_new_item'               => __( 'Add New Type', 'ocooking' ),
			'new_item_name'              => __( 'New Type', 'ocooking' ),
			'separate_items_with_commas' => __( 'Separate Types with commas', 'ocooking' ),
			'add_or_remove_items'        => __( 'Add or remove Types', 'ocooking' ),
			'choose_from_most_used'      => __( 'Choose from the most used Types', 'ocooking' ),
			'not_found'                  => __( 'No Types found.', 'ocooking' ),
			'no_terms'                   => __( 'No Types', 'ocooking' ),
			'menu_name'                  => __( 'Types', 'ocooking' ),
			'items_list_navigation'      => __( 'Types list navigation', 'ocooking' ),
			'items_list'                 => __( 'Types list', 'ocooking' ),
			'most_used'                  => _x( 'Most Used', 'type', 'ocooking' ),
			'back_to_items'              => __( '&larr; Back to Types', 'ocooking' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'recipes/types',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'type_init' );

/**
 * Sets the post updated messages for the `type` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `type` taxonomy.
 */
function type_updated_messages( $messages ) {

	$messages['type'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Type added.', 'ocooking' ),
		2 => __( 'Type deleted.', 'ocooking' ),
		3 => __( 'Type updated.', 'ocooking' ),
		4 => __( 'Type not added.', 'ocooking' ),
		5 => __( 'Type not updated.', 'ocooking' ),
		6 => __( 'Types deleted.', 'ocooking' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'type_updated_messages' );
