<?php

function add_cook_role() {
	add_role(
		'cook',
		__( 'Cook', 'ocooking' ),
		[
			'read' => true,
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
		]
	);
}

function remove_cook_role() {
	remove_role( 'cook' );
}
