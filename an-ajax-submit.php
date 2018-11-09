<?php
/**
 * Plugin Name: An AJAX Submit form
 * Author: @pbrocks
 * Plugin URL: https://github.com/pbrocks/submit-ajax
 * Description: Demostrates how an AJAX form works using the shortcode [parse-ajax-form] built with WordPress. After activating this plugin, you can place this shortcode into any post or page to experiment with AJAX.
 */

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

include( 'inc/class-submit-ajax.php' );
include( 'inc/class-guten-jax.php' );

/**
 * Add a page to the dashboard menu.
 *
 * @since 1.0.0
 *
 * @return array
 */
add_action( 'admin_menu', 'gutenjax_dashboard' );
function gutenjax_dashboard() {
	$slug = preg_replace( '/_+/', '-', __FUNCTION__ );
	$label = ucwords( preg_replace( '/_+/', ' ', __FUNCTION__ ) );
	add_dashboard_page( __( $label, 'gutenjax-dashboard-menu' ), __( $label, 'gutenjax-dashboard-menu' ), 'manage_options', $slug . '.php', 'gutenjax_dashboard_page' );
}


/**
 * Debug Information
 *
 * @since 1.0.0
 *
 * @param bool $html Optional. Return as HTML or not
 *
 * @return string
 */
function gutenjax_dashboard_page() {
	echo '<div class="wrap">';
	echo '<h2>' . ucwords( preg_replace( '/_+/', ' ', __FUNCTION__ ) ) . '</h2>';
	$screen = get_current_screen();
	echo '<h4 style="color:rgba(250,128,114,.7);">Current Screen is <span style="color:rgba(250,128,114,1);">' . $screen->id . '</span></h4>';
	$my_theme = wp_get_theme();
	echo '<h4>Theme is ' . sprintf(
		__( '%1$s and is version %2$s', 'text-domain' ),
		$my_theme->get( 'Name' ),
		$my_theme->get( 'Version' )
	) . '</h4>';
	// Guten_JAX::guten_ajax_form();
	echo '<h4>Templates found in ' . get_template_directory() . '</h4>';
	echo do_shortcode( '[guten-jax-form]' );
	echo '<h4>Stylesheet found in ' . get_stylesheet_directory() . '</h4>';
	echo '</div>';
}