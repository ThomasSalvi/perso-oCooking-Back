<?php

/**
 * Registers the `ingredient` taxonomy,
 * for use with 'recipe'.
 */
function ingredient_init() {
	register_taxonomy( 'ingredient', [ 'recipe' ], [
		'hierarchical'          => true,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => false,
		'rewrite'               => false,
		'capabilities'          => [
			'manage_terms' => 'manage_ingredients',
			'edit_terms'   => 'edit_ingredients',
			'delete_terms' => 'delete_ingredients',
			'assign_terms' => 'assign_ingredients',
		],
		'labels'                => [
			'name'                       => __( 'Ingredients', 'ocooking' ),
			'singular_name'              => _x( 'Ingredient', 'taxonomy general name', 'ocooking' ),
			'search_items'               => __( 'Search Ingredients', 'ocooking' ),
			'popular_items'              => __( 'Popular Ingredients', 'ocooking' ),
			'all_items'                  => __( 'All Ingredients', 'ocooking' ),
			'parent_item'                => __( 'Parent Ingredient', 'ocooking' ),
			'parent_item_colon'          => __( 'Parent Ingredient:', 'ocooking' ),
			'edit_item'                  => __( 'Edit Ingredient', 'ocooking' ),
			'update_item'                => __( 'Update Ingredient', 'ocooking' ),
			'view_item'                  => __( 'View Ingredient', 'ocooking' ),
			'add_new_item'               => __( 'Add New Ingredient', 'ocooking' ),
			'new_item_name'              => __( 'New Ingredient', 'ocooking' ),
			'separate_items_with_commas' => __( 'Separate Ingredients with commas', 'ocooking' ),
			'add_or_remove_items'        => __( 'Add or remove Ingredients', 'ocooking' ),
			'choose_from_most_used'      => __( 'Choose from the most used Ingredients', 'ocooking' ),
			'not_found'                  => __( 'No Ingredients found.', 'ocooking' ),
			'no_terms'                   => __( 'No Ingredients', 'ocooking' ),
			'menu_name'                  => __( 'Ingredients', 'ocooking' ),
			'items_list_navigation'      => __( 'Ingredients list navigation', 'ocooking' ),
			'items_list'                 => __( 'Ingredients list', 'ocooking' ),
			'most_used'                  => _x( 'Most Used', 'ingredient', 'ocooking' ),
			'back_to_items'              => __( '&larr; Back to Ingredients', 'ocooking' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'recipes/ingredients',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'ingredient_init' );

/**
 * Je modifie la construction de l'instance de WP_Query pour mon post type recipe à l'aide du hook rest_recipe_query
 *
 * @link https://developer.wordpress.org/reference/hooks/rest_this-post_type_query/
 */
add_filter(
	'rest_recipe_query',
	/**
	 * @param array $args List of WP_Query arguments
	 * @param WP_REST_Request $request HTTP Request object representation
	 *
	 * @return array Updated WP_Query arguments
	 */
	function($args, $request) {
		// var_dump($args);
		// var_dump($request['recipes/ingredients_operator']);
		// exit;

		// Si mon paramètre custom de la REST API recipes/ingredients_operator est défini et que j'ai bien un filtre sur mes taxonomies
		if (
			isset( $request[ 'recipes/ingredients_operator' ] ) &&
			! empty($args['tax_query'])
		) {
			// J'essaye de modifier le filtre pour la taxonomy ingredient

			// Je préparer la variable qui va accueillir l'index du filter de la taxonomy ingredient
			$ingredient_index = null;

			// Je boucle sur chaque filtre de taxonomy afin de retrouver l'index qui concerne la taxonomy ingredient
			foreach ($args['tax_query'] as $taxonomy_query_index => $taxonomy_query) {
				if ( $taxonomy_query['taxonomy'] === 'ingredient' ) {
					// Si je trouve le filtre de ma taxonomy ingredient, je stocke son index dans la variable $ingredient_index
					$ingredient_index = $taxonomy_query_index;
				}
			}

			// Si après ma boucle, j'ai bien trouvé le filtre pour la taxonomy ingredient
			if ( isset($ingredient_index)) {
				// Je modifie le filtre afin de prendre de compte le paramètre custom recipes/ingredients_operator que l'on veut gérer
				$args['tax_query'][$ingredient_index]['operator'] = $request['recipes/ingredients_operator'];
			}
		}

		// Je retourne le tableau d'args de WP_Query (éventuellement) modifié
		return $args;
	},
	10,
	2 // Je veux les deux arguments gérés par le hook
);

/**
 * Sets the post updated messages for the `ingredient` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `ingredient` taxonomy.
 */
function ingredient_updated_messages( $messages ) {

	$messages['ingredient'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Ingredient added.', 'ocooking' ),
		2 => __( 'Ingredient deleted.', 'ocooking' ),
		3 => __( 'Ingredient updated.', 'ocooking' ),
		4 => __( 'Ingredient not added.', 'ocooking' ),
		5 => __( 'Ingredient not updated.', 'ocooking' ),
		6 => __( 'Ingredients deleted.', 'ocooking' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'ingredient_updated_messages' );
