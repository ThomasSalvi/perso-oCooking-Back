<?php

function add_clerk_role() {
	add_role(
		'clerk',
		__( 'Clerk', 'ocooking' ),
		[
			'read' => false,
			'edit_recipe' => true,
			'read_recipe' => true,
			'delete_recipe' => true,
			'edit_recipes' => true,
			'edit_others_recipes' => false,
			'delete_recipes' => true,
			'publish_recipes' => false,
			'read_private_recipes' => false,
			'delete_private_recipes' => false,
			'delete_published_recipes' => true,
			'delete_others_recipes' => false,
			'edit_private_recipes' => false,
			'edit_published_recipes' => true,
			'create_recipes' => true,
			'manage_ingredients' => false,
			'edit_ingredients' => false,
			'delete_ingredients' => false,
			'assign_ingredients' => true,
			'manage_types' => false,
			'edit_types' => false,
			'delete_types' => false,
			'assign_types' => true,
			'upload_files' => true
		]
	);
}

function remove_clerk_role() {
	remove_role( 'clerk' );
}
