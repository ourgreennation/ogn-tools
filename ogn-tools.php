<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://davidlaietta.com
 * @since             1.0.0
 * @package           Ogn_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       Our Green Nation Tools
 * Plugin URI:        https://ourgreennation.org
 * Description:       This plugin handles custom functionality for Our Green Nation Users and Post Types
 * Version:           1.0.0
 * Author:            David Laietta
 * Author URI:        http://davidlaietta.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ogn-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ogn-tools-activator.php
 */
function activate_ogn_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ogn-tools-activator.php';
	Ogn_Tools_Activator::activate();
	Ogn_Tools_Activator::add_ogn_contributor_role();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ogn-tools-deactivator.php
 */
function deactivate_ogn_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ogn-tools-deactivator.php';
	Ogn_Tools_Deactivator::deactivate();
	// Ogn_Tools_Deactivator::remove_ogn_contributor_role();
}

register_activation_hook( __FILE__, 'activate_ogn_tools' );
register_deactivation_hook( __FILE__, 'deactivate_ogn_tools' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ogn-tools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ogn_tools() {

	$plugin = new Ogn_Tools();
	$plugin->run();

}
run_ogn_tools();
