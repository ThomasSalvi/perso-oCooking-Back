<?php
/**
 * Plugin Name:     oCooking
 * Description:     Plugin de configuration de la partie backend du projet oCooking
 * Author:          Ripley
 * Text Domain:     ocooking
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         oCooking
 */

// Your code starts here.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require plugin_dir_path( __FILE__ ) . 'post-types/recipe.php';

require plugin_dir_path( __FILE__ ) . 'roles/administrator.php';
require plugin_dir_path( __FILE__ ) . 'roles/clerk.php';
require plugin_dir_path( __FILE__ ) . 'roles/cook.php';

require plugin_dir_path( __FILE__ ) . 'taxonomies/type.php';
require plugin_dir_path( __FILE__ ) . 'taxonomies/ingredient.php';


register_activation_hook( __FILE__, function() {
	add_clerk_role();
	add_cook_role();
	add_administrator_role_capabilities();
} );

register_deactivation_hook( __FILE__, function() {
	remove_clerk_role();
	remove_cook_role();
	remove_administrator_role_capabilities();
} );
