<?php
/**
 * Plugin Name: Elementor Travel Tabs Addon
 * Description: Elementor addon to add tourism details to page in a tab
 * Version:     1.0.0
 * Author:      Imokol Faith Ruth & Aurthur Kasirye
 * Plugin URI:  https://github.com/faithruth/wc-iphone-swapper
 * Author URI:  https://github.com/faithruth
 * Text Domain: elementor-travel-tabs-widget
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

defined( 'ABSPATH' ) || die( 'Unauthorized Access!' );

function ettw_enqueue_script($hook) {

	wp_register_style(
		'slick',
		'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'
	);
	wp_register_style(
		'slick-theme',
		'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'
	);

	wp_enqueue_style( 'jquery-ui-theme', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	wp_enqueue_style('tiny-slider', 'https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.css');

	wp_register_style(
		'elementor-tabs-style',
		plugins_url( '/assets/css/style.css', __FILE__ ),
		[],
		'1.0.0'
	);
	wp_enqueue_style('elementor-tabs-style');
	// Enqueue JS


	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('tiny-slider', 'https://cdn.jsdelivr.net/npm/tiny-slider@2.9.3/dist/tiny-slider.js', array('jquery'), null, true);
	wp_enqueue_script(
	'elementor-tabs-script',
		plugins_url( '/assets/js/script.js', __FILE__ ),
		[ 'jquery', 'jquery-ui-tabs', 'tiny-slider' ], // Dependencies
		'1.0.0',
		true // Enqueue in the footer
	);
}
add_action('elementor/frontend/after_register_scripts', 'ettw_enqueue_script');
add_action( 'elementor/editor/after_enqueue_styles', 'ettw_enqueue_script' );

function ettw_register_travel_tab_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/travel-tab.php' );
	$widgets_manager->register( new \Elementor_Travel_Tabs_Widget() );

	require_once( __DIR__ . '/widgets/pricing.php' );
	$widgets_manager->register( new \Elementor_Travel_Pricing_Widget() );

}
add_action( 'elementor/widgets/register', 'ettw_register_travel_tab_widget' );