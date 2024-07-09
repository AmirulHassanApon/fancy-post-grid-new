<?php
/**
 * Include public styles
 */
function fpg_public_styles() {

    $fpg_version = defined( 'FPG_VERSION' ) ? FPG_VERSION : '1.0.0'; // Define version number
    $settings_options = get_option( 'fpg_settings_option' );
    
        
    wp_enqueue_style( 'fpg-bootstrap', plugins_url('/assets/css/fpg_bootstrap.css', __FILE__), array(), $fpg_version, 'all' );
    wp_enqueue_style( 'font-awesome', plugins_url('/assets/css/all.min.css', __FILE__), array(), $fpg_version, 'all' );
    // wp_enqueue_style( 'fpg-owl-carousel', plugins_url('/assets/css/owl.carousel.css', __FILE__), array(), $fpg_version, 'all' );
    // wp_enqueue_style( 'flexslider', plugins_url('/assets/css/flexslider.css', __FILE__), array(), $fpg_version, 'all' );      
    wp_enqueue_style( 'fancy-post-grid-main', plugins_url('/assets/css/fancy-post-grid.css', __FILE__), array(), $fpg_version, 'all' );
    wp_enqueue_style('remixicon', plugins_url('/assets/css/remixicon.css',__FILE__), array(), $fpg_version, 'all');
    wp_enqueue_style('swiper', plugins_url('/assets/css/swiper-bundle.min.css',__FILE__), array(), $fpg_version, 'all');
    wp_enqueue_style('rs-layout', plugins_url('/assets/css/rs-layout.css',__FILE__), array(), $fpg_version, 'all');
    wp_enqueue_style('custom-style', plugins_url('/assets/css/style.css',__FILE__), array(), $fpg_version, 'all');

}
add_action( 'wp_enqueue_scripts', 'fpg_public_styles' );

/**
 * Include public scripts
 */
function fpg_public_scripts(){
    $fpg_version = defined( 'FPG_VERSION' ) ? FPG_VERSION : '1.0.0'; // Define version number

    wp_enqueue_script( 'jquery-min', plugins_url('/assets/js/jquery.min.js', __FILE__) , array('jquery'), $fpg_version, true );
    wp_enqueue_script('swiper-bundle-fpg', plugins_url('/assets/js/swiper-bundle.min.js', __FILE__), array(), $fpg_version, true);
    wp_enqueue_script('fpg-main-js', plugins_url('/assets/js/main.js', __FILE__), array('swiper-bundle-fpg'), $fpg_version, true);

}
add_action( 'wp_enqueue_scripts', 'fpg_public_scripts' );