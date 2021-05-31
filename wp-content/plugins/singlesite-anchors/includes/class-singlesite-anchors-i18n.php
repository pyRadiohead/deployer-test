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
 * @package    Singlesite_Anchors
 * @subpackage Singlesite_Anchors/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Singlesite_Anchors
 * @subpackage Singlesite_Anchors/includes
 * @author     Yurii <ethingwillbefine@gmail.com>
 */
class Singlesite_Anchors_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'singlesite-anchors',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
