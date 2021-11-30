<?php

function add_administrator_role_capabilities() {
	$administrator_role = get_role( 'administrator' );

	$capabilities = [
		'edit_recipe' => true,
		'read_recipe' => true,
		'delete_recipe' => true,
		'edit_recipes' => true,
		'edit_others_recipes' => true,
		'delete_recipes' => true,
		'publish_recipes' => true,
		'read_private_recipes' => true,
		'delete_private_recipes' => true,
		'delete_published_recipes' => true,
		'delete_others_recipes' => true,
		'edit_private_recipes' => true,
		'edit_published_recipes' => true,
		'create_recipes' => true,
		'manage_ingredients' => true,
		'edit_ingredients' => true,
		'delete_ingredients' => true,
		'assign_ingredients' => true,
		'manage_types' => true,
		'edit_types' => true,
		'delete_types' => true,
		'assign_types' => true,
		'upload_files' => true
	];

	foreach( $capabilities as $cap => $grant ) {
		$administrator_role->add_cap( $cap, $grant );
	}
}

function remove_administrator_role_capabilities() {
	$administrator_role = get_role( 'administrator' );

	$capabilities = [
		'edit_recipe',
		'read_recipe',
		'delete_recipe',
		'edit_recipes',
		'edit_others_recipes',
		'delete_recipes',
		'publish_recipes',
		'read_private_recipes',
		'delete_private_recipes',
		'delete_published_recipes',
		'delete_others_recipes',
		'edit_private_recipes',
		'edit_published_recipes',
		'create_recipes',
		'manage_ingredients',
		'edit_ingredients',
		'delete_ingredients',
		'assign_ingredients',
		'manage_types',
		'edit_types',
		'delete_types',
		'assign_types',
		'upload_files'
	];

	foreach( $capabilities as $cap ) {
		$administrator_role->remove_cap( $cap );
	}
}
