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


function zillah_ti_blog_before_navigation() {
	if ( is_home() ) {
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'menu_id'         => 'social-icons-menu',
				'menu_class'      => 'social-navigation',
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'container_class' => 'header-social-icons',
				'fallback_cb'     => false,
			)
		);
	} else {
		zillah_ti_blog_brand();
	}
}

/**
 * Return the site brand
 *
 * @since Zillah 1.0
 */
function zillah_ti_blog_brand() {

	echo '<div class="header-logo-wrap">';

	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	} else {
		$zillah_logo_old = get_theme_mod( 'zillah_logo_old', false );
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home" itemprop="url">';
		echo '<img width="630" height="290" src="' . esc_url( $zillah_logo_old ) . '" class="custom-logo" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" itemprop="logo">';
		echo '</a>';
	}

	echo '</div>';
}

/**
 * Prints HTML with meta information for the category.
 */
function zillah_ti_blog_category() {

	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'zillah' ) );
	if ( $categories_list ) {
		printf(
			'<span class="cat-links"><span class="screen-reader-text">%1$s </span><span class="posted-in">%2$s</span> %3$s</span>',
			_x( 'Categories', 'Used before category names.', 'zillah' ),
			_x( 'Posted in:', 'Used before category names.', 'zillah-ti-blog' ),
			$categories_list
		);
	}
}

/**
 * Change default font family on body/content
 */
function zillah_ti_blog_add_fonts( $input_array ) {


	$new_font  = array(
		'font_family' => 'PT Serif',
		'type' => 'serif',
		'subset' => '400',
	);

	array_push( $input_array , $new_font );

	return $input_array;

}
add_filter( 'zillah_filter_body_fonts', 'zillah_ti_blog_add_fonts' );