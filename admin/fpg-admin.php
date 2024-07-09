<?php
/**
 * Include admin styles
 */
function fpg_admin_styles( $screen ) {

    $fpg_version = defined( 'FPG_VERSION' ) ? FPG_VERSION : '1.0.0'; // Define version number
    
    wp_enqueue_style( 'fancy_post_grid_jquery_ui', plugins_url('/assets/css/jquery-ui.css', __FILE__), array(), $fpg_version, 'all' );
	wp_enqueue_style( 'fancy_post_grid_main_admin', plugins_url('/assets/css/admin.css', __FILE__), array(), $fpg_version, 'all' );
	wp_enqueue_style( 'fpg_admin-font-awesome', plugins_url('/assets/css/all.min.css', __FILE__), array(), $fpg_version, 'all' );
	wp_enqueue_style( 'fpg-bootstrap-admin', plugins_url('/assets/css/fpg_bootstrap.css', __FILE__), array(), $fpg_version, 'all' );

}
add_action( 'admin_enqueue_scripts', 'fpg_admin_styles' );

/**
 * Include admin scripts
 */
function fpg_admin_script( $screen ){
	$fpg_version = defined( 'FPG_VERSION' ) ? FPG_VERSION : '1.0.0'; // Define version number

    wp_enqueue_style( 'wp-color-picker' );  	
    wp_enqueue_script( 'fpg-main', plugins_url('/assets/js/admin.js', __FILE__), array( 'jquery', 'jquery-ui-tabs', 'wp-color-picker' ), $fpg_version, true );
}
add_action( 'admin_enqueue_scripts', 'fpg_admin_script' );

