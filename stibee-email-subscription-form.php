<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://stibee.com
 * @since             1.0.1
 * @package           Wp_Stibee
 *
 * @wordpress-plugin
 * Plugin Name:       스티비 구독 폼
 * Plugin URI:        https://stibee.com
 * Description:       이메일 마케팅 서비스 스티비의 구독 및 주소록 연동 기능을 제공합니다.
 * Version:           1.0.1
 * Author:            Stibee
 * Author URI:        https://stibee.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-stibee
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-stibee-activator.php
 */
function activate_Wp_Stibee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-stibee-activator.php';
	Wp_Stibee_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-stibee-deactivator.php
 */
function deactivate_Wp_Stibee() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-stibee-deactivator.php';
	Wp_Stibee_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wp_Stibee' );
register_deactivation_hook( __FILE__, 'deactivate_Wp_Stibee' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-stibee.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Wp_Stibee() {

	$plugin = new Wp_Stibee();
	$plugin->run();

}
run_Wp_Stibee();
