<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.roxet.net
 * @since             1.0.0
 * @package           Monitor_String
 *
 * @wordpress-plugin
 * Plugin Name:       monitor-string
 * Plugin URI:        http://www.gitub.com/jasondewitt/monitor-string
 * Description:       Adds a random string to the footer of your WP theme for all your uptime monitor string matching needs.
 * Version:           1.0.0
 * Author:            Jason DeWitt
 * Author URI:        http://www.roxet.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       monitor-string
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-monitor-string-activator.php
 */
function activate_monitor_string() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-monitor-string-activator.php';
	Monitor_String_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-monitor-string-deactivator.php
 */
function deactivate_monitor_string() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-monitor-string-deactivator.php';
	Monitor_String_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_monitor_string' );
register_deactivation_hook( __FILE__, 'deactivate_monitor_string' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-monitor-string.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_monitor_string() {

	$plugin = new Monitor_String();
	$plugin->run();

}
run_monitor_string();
