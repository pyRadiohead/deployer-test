<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       internet-cossacks.com
 * @since      1.0.0
 *
 * @package    Multisite_Anchors_Settings
 * @subpackage Multisite_Anchors_Settings/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Multisite_Anchors_Settings
 * @subpackage Multisite_Anchors_Settings/includes
 * @author     Yurii Kovalenko <ethingwillbefine@gmail.com>
 */
class Multisite_Anchors_Settings_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'multisite-anchors-settings',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
