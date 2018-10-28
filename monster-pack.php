<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/mark-mg
 * @since             1.0.2
 * @package           Monster_Pack
 *
 * @wordpress-plugin
 * Plugin Name:       Monster Pack
 * Plugin URI:        https://github.com/mark-mg/monster-pack
 * Description:       This plugin adds a custom css metabox to posts, pages, and custom post types to output css only on those posts or pages.
 * Version:           1.0.2
 * Author:            Mark Anthony Adriano
 * Author URI:        https://github.com/mark-mg
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       monster-pack
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} 


global $hero_prm, $cta_prm, $prd_prm;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-monster-pack-activator.php
 */
function activate_monster_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-monster-pack-activator.php';
	Monster_Pack_Activator::activate();
}
 
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-monster-pack-deactivator.php
 */
function deactivate_monster_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-monster-pack-deactivator.php';
	Monster_Pack_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_monster_pack' );
register_deactivation_hook( __FILE__, 'deactivate_monster_pack' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-monster-pack.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.2
 */
function run_monster_pack() {

	$plugin = new Monster_Pack();
	$plugin->run();

}
run_monster_pack();
