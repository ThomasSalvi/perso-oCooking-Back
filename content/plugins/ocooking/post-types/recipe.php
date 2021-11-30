<?php

/**
 * Registers the `recipe` post type.
 */
function recipe_init() {
	$recipe = register_post_type(
		'recipe',
		[
			'labels'                => [
				'name'                  => __( 'Recipes', 'ocooking' ),
				'singular_name'         => __( 'Recipe', 'ocooking' ),
				'all_items'             => __( 'All Recipes', 'ocooking' ),
				'archives'              => __( 'Recipe Archives', 'ocooking' ),
				'attributes'            => __( 'Recipe Attributes', 'ocooking' ),
				'insert_into_item'      => __( 'Insert into Recipe', 'ocooking' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Recipe', 'ocooking' ),
				'featured_image'        => _x( 'Featured Image', 'recipe', 'ocooking' ),
				'set_featured_image'    => _x( 'Set featured image', 'recipe', 'ocooking' ),
				'remove_featured_image' => _x( 'Remove featured image', 'recipe', 'ocooking' ),
				'use_featured_image'    => _x( 'Use as featured image', 'recipe', 'ocooking' ),
				'filter_items_list'     => __( 'Filter Recipes list', 'ocooking' ),
				'items_list_navigation' => __( 'Recipes list navigation', 'ocooking' ),
				'items_list'            => __( 'Recipes list', 'ocooking' ),
				'new_item'              => __( 'New Recipe', 'ocooking' ),
				'add_new'               => __( 'Add New', 'ocooking' ),
				'add_new_item'          => __( 'Add New Recipe', 'ocooking' ),
				'edit_item'             => __( 'Edit Recipe', 'ocooking' ),
				'view_item'             => __( 'View Recipe', 'ocooking' ),
				'view_items'            => __( 'View Recipes', 'ocooking' ),
				'search_items'          => __( 'Search Recipes', 'ocooking' ),
				'not_found'             => __( 'No Recipes found', 'ocooking' ),
				'not_found_in_trash'    => __( 'No Recipes found in trash', 'ocooking' ),
				'parent_item_colon'     => __( 'Parent Recipe:', 'ocooking' ),
				'menu_name'             => __( 'Recipes', 'ocooking' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions' ],
			'has_archive'           => false,
			'rewrite'               => false, // pas besoin d'URL front car on utilise WordPress seulement avec son API
			'query_var'             => false,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-carrot',
			'show_in_rest'          => true,
			'rest_base'             => 'recipes',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			// 'capability_type'       => [ 'recipe', 'recipes' ],
			'capabilities'          => [
				'edit_post'              => 'edit_recipe',
				'read_post'              => 'read_recipe',
				'delete_post'            => 'delete_recipe',
				'edit_posts'             => 'edit_recipes',
				'edit_others_posts'      => 'edit_others_recipes',
				'delete_posts'           => 'delete_recipes',
				'publish_posts'          => 'publish_recipes',
				'read_private_posts'     => 'read_private_recipes',
				'delete_private_posts'   => 'delete_private_recipes',
				'delete_published_posts' => 'delete_published_recipes',
				'delete_others_posts'    => 'delete_others_recipes',
				'edit_private_posts'     => 'edit_private_recipes',
				'edit_published_posts'   => 'edit_published_recipes',
				'create_posts'           => 'create_recipes',
			],
			'map_meta_cap' => true
		]
	);

	/**
	 * J'ajoute une meta de mon post type dans l'API
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_meta/
	 */
	register_meta(
		'post',
		'difficulty',
		[
			'object_subtype' => 'recipe',
			'type'           => 'number',
			'description'    => __( 'A number between 1 and 5', 'ocooking' ),
			'single'         => true,
			'show_in_rest'   => [
				'schema' => [
					'type' => 'number',
					'minimum' => 1,
					'maximum' => 5
				]
			]
		]
	);

	register_meta(
		'post',
		'preparation_time',
		[
			'object_subtype' => 'recipe',
			'type'           => 'number',
			'description'    => __( 'In minutes', 'ocooking' ),
			'single'         => true,
			'show_in_rest'   => [
				'schema' => [
					'type' => 'number',
					'minimum' => 1,
					'maximum' => 1000
				]
			]
		]
	);

	register_meta(
		'post',
		'cooking_time',
		[
			'object_subtype' => 'recipe',
			'type'           => 'number',
			'description'    => __( 'In minutes', 'ocooking' ),
			'single'         => true,
			'show_in_rest'   => [
				'schema' => [
					'type' => 'number',
					'minimum' => 0,
					'maximum' => 1000
				]
			]
		]
	);

	register_meta(
		'post',
		'person_count',
		[
			'object_subtype' => 'recipe',
			'type'           => 'number',
			'single'         => true,
			'show_in_rest'   => [
				'schema' => [
					'type' => 'number',
					'minimum' => 1,
					'maximum' => 20
				]
			]
		]
	);

	register_meta(
		'post',
		'cost_per_person',
		[
			'object_subtype' => 'recipe',
			'type'           => 'number',
			'description'    => __( 'In euros (€)', 'ocooking' ),
			'single'         => true,
			'show_in_rest'   => [
				'schema' => [
					'type' => 'number',
					'minimum' => 1,
					'maximum' => 1000
				]
			]
		]
	);
}

add_action( 'init', 'recipe_init' );

/**
 * Sets the post updated messages for the `recipe` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `recipe` post type.
 */
function recipe_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['recipe'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Recipe updated. <a target="_blank" href="%s">View Recipe</a>', 'ocooking' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'ocooking' ),
		3  => __( 'Custom field deleted.', 'ocooking' ),
		4  => __( 'Recipe updated.', 'ocooking' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Recipe restored to revision from %s', 'ocooking' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Recipe published. <a href="%s">View Recipe</a>', 'ocooking' ), esc_url( $permalink ) ),
		7  => __( 'Recipe saved.', 'ocooking' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Recipe submitted. <a target="_blank" href="%s">Preview Recipe</a>', 'ocooking' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Recipe scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Recipe</a>', 'ocooking' ), date_i18n( __( 'M j, Y @ G:i', 'ocooking' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Recipe draft updated. <a target="_blank" href="%s">Preview Recipe</a>', 'ocooking' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'recipe_updated_messages' );

/**
 * Sets the bulk post updated messages for the `recipe` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `recipe` post type.
 */
function recipe_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['recipe'] = [
		/* translators: %s: Number of Recipes. */
		'updated'   => _n( '%s Recipe updated.', '%s Recipes updated.', $bulk_counts['updated'], 'ocooking' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Recipe not updated, somebody is editing it.', 'ocooking' ) :
						/* translators: %s: Number of Recipes. */
						_n( '%s Recipe not updated, somebody is editing it.', '%s Recipes not updated, somebody is editing them.', $bulk_counts['locked'], 'ocooking' ),
		/* translators: %s: Number of Recipes. */
		'deleted'   => _n( '%s Recipe permanently deleted.', '%s Recipes permanently deleted.', $bulk_counts['deleted'], 'ocooking' ),
		/* translators: %s: Number of Recipes. */
		'trashed'   => _n( '%s Recipe moved to the Trash.', '%s Recipes moved to the Trash.', $bulk_counts['trashed'], 'ocooking' ),
		/* translators: %s: Number of Recipes. */
		'untrashed' => _n( '%s Recipe restored from the Trash.', '%s Recipes restored from the Trash.', $bulk_counts['untrashed'], 'ocooking' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'recipe_bulk_updated_messages', 10, 2 );
