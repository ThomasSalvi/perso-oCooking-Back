<?php
/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#configure-error-logging
 */
define( 'WP_DEBUG_LOG', true ); // Les erreurs seront ajoutées dans le fichier de log (dans le dossier content)
define( 'WP_DEBUG_DISPLAY', false ); // Les erreurs ne seront pas affichées directement dans le code HTML généré

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#wp_disable_fatal_error_handler
 */
define( 'WP_DISABLE_FATAL_ERROR_HANDLER', false );

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#script_debug
 */
define( 'SCRIPT_DEBUG', false );

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#disable-javascript-concatenation
 */
define( 'CONCATENATE_SCRIPTS', true );

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#cache
 */
define( 'WP_CACHE', true );

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#empty-trash
 */
define( 'EMPTY_TRASH_DAYS', 60 );

/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/#disable-post-revisions
 */
define( 'WP_POST_REVISIONS', 10 ); // Je limite le nombre de révisions max par article à 10
