<?php
/**
 * Zillah-ti-blog functions and definitions
 *
 * @package themeisle-blog
 * @since 1.0.0
 */

define( 'ZILLAH-TI-BLOG_VERSION', '1.0.0' );


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'zillah_ti_blog_parent_css' ) ) :
	/**
	 * Enqueue parent style
	 *
	 * @since 1.0.0
	 */
	function zillah_ti_blog_parent_css() {
		wp_enqueue_style( 'zillah_ti_blog_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap-css' ) );
		if ( is_rtl() ) {
			wp_enqueue_style( 'zillah_ti_blog_parent_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css', array( 'bootstrap-css' ) );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'zillah_ti_blog_parent_css', 10 );

/**
 * Import options from Zillah
 *
 * @since 1.0.0
 */
function zillah_ti_blog_get_lite_options() {
	$zillah_mods = get_option( 'theme_mods_hestia' );
	if ( ! empty( $zillah_mods ) ) {
		foreach ( $zillah_mods as $zillah_mod_k => $zillah_mod_v ) {
			set_theme_mod( $zillah_mod_k, $zillah_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'zillah_ti_blog_get_lite_options' );

/**
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function zillah_ti_blog_theme_setup() {
	load_child_theme_textdomain( 'zillah-ti-blog', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'zillah_ti_blog_theme_setup' );