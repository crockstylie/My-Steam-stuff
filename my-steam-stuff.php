<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://crock.fr
 * @since             1.0.0
 * @package           My_Steam_Stuff
 *
 * @wordpress-plugin
 * Plugin Name:       My Steam stuff
 * Plugin URI:        http://crock.fr
 * Description:       C'est un plugin pour jouer avec l'API Steam dans un site WordPress
 * Version:           1.0.0
 * Author:            Crock
 * Author URI:        http://crock.fr/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       my-steam-stuff
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MY_STEAM_STUFF_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-my-steam-stuff-activator.php
 */
function activate_my_steam_stuff() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-steam-stuff-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-my-steam-stuff-deactivator.php
 */
function deactivate_my_steam_stuff() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-my-steam-stuff-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_steam_stuff' );
register_deactivation_hook( __FILE__, 'deactivate_my_steam_stuff' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-my-steam-stuff.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_my_steam_stuff() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_my_steam_stuff();
