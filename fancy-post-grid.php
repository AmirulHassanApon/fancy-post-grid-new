<?php
/**
 * Plugin Name:       Fancy Post Grid
 * Plugin URI:        https://plugins.rstheme.com/fancy-post-grid/
 * Description:       Fancy Post Grid plugin provides an elegant solution for displaying posts in a Grid and Slider layout. It is designed to be user and developer friendly, offering easy customization and usage. The plugin is fully responsive and mobile-friendly, ensuring a seamless browsing experience across all devices.
 * Version:           1.0.0
 * Author:            RSTheme
 * Author URI:        https://rstheme.com/
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fancy-post-grid
 * Domain Path:       /languages
 * Requires PHP: 	  7.0.0
 * Requires at least: 5.5
 */

/**
 * Defines constants
 */
define( 'FPG_VERSION', '1.0.0' );
define( 'FPG_FILE', __FILE__ );
define( 'FPG_PATH', plugin_dir_path( __FILE__ ) );
define( 'FPG_URL', plugins_url( '/', __FILE__ ) );
define( 'FPG_BASENAME', plugin_basename( __FILE__ ) );

$dir = plugin_dir_path( __FILE__ );

/**
 * Load Textdomain
 */
function fancy_post_grid_load_textdomain(){
	load_plugin_textdomain('fancy-post-grid', false, dirname(__FILE__)."/languages");
}
add_action('plugins_loaded', 'fancy_post_grid_load_textdomain');

/**
 * Include styles and scripts for public part
 */
include_once FPG_PATH . 'public/fpg-public.php';

/**
 * Include styles and scripts for admin part
 */
include_once FPG_PATH . 'admin/fpg-admin.php';

/**
 * Include file for admin
 */
include_once  FPG_PATH.'includes/template.php';
include_once  FPG_PATH.'includes/shortcode_generate.php';
include_once  FPG_PATH.'includes/metabox/fancy-post-gird-metabox.php';
include_once  FPG_PATH .'admin/settings/plugin-settings.php';


/**
 * Link to settings page from plugins admin page
 *
 */
function fpg_add_action_links ( $links ) {
    $setting_links = array(
        '<a href="' . admin_url( 'edit.php?post_type=wp-fpg&page=fpgsettings' ) . '">'.esc_html( "Settings", "fancy-post-grid" ).'</a>',
    );
    return array_merge( $links, $setting_links );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'fpg_add_action_links' );