<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              internet-cossacks.com
 * @since             1.0.0
 * @package           Multisite_Anchors_Settings
 *
 * @wordpress-plugin
 * Plugin Name:       Multisite anchors settings
 * Plugin URI:        internet-cossacks.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Yurii Kovalenko
 * Author URI:        internet-cossacks.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       multisite-anchors-settings
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
define( 'MULTISITE_ANCHORS_SETTINGS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-multisite-anchors-settings-activator.php
 */
function activate_multisite_anchors_settings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multisite-anchors-settings-activator.php';
	Multisite_Anchors_Settings_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-multisite-anchors-settings-deactivator.php
 */
function deactivate_multisite_anchors_settings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-multisite-anchors-settings-deactivator.php';
	Multisite_Anchors_Settings_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_multisite_anchors_settings' );
register_deactivation_hook( __FILE__, 'deactivate_multisite_anchors_settings' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-multisite-anchors-settings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_multisite_anchors_settings() {

	$plugin = new Multisite_Anchors_Settings();
	$plugin->run();

}
run_multisite_anchors_settings();
