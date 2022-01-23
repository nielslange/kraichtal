<?php
/**
 * Kraichtal functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage Kraichtal
 * @since 1.0.0
 */

/**
 * Load textdomain.
 *
 * @return void
 */
function kraichtal_theme_support() {
	load_theme_textdomain( 'kraichtal' );
}
add_action( 'after_setup_theme', 'load_theme_textdomain' );

/**
 * Add default posts and comments RSS feed links to head.
 *
 * @return void
 */
function kraichtal_feed_support() {
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'kraichtal_feed_support' );

/**
 * Add support for custom logo.
 *
 * @return void
 */
function kraichtal_logo_support() {
	$defaults = array(
		'height'      => 140,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'kraichtal_logo_support' );

/**
 * Add support for titles.
 *
 * @return void
 */
function kraichtal_title_support() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'kraichtal_title_support' );

/**
 * Add support for full and wide align images.
 *
 * @return void
 */
function kraichtal_align_support() {
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'kraichtal_align_support' );

/**
 * Add support for HTML5 elements.
 *
 * @return void
 */
function kraichtal_html5_support() {
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ),
	);
}
add_action( 'after_setup_theme', 'kraichtal_html5_support' );

/**
 * Register custom menus.
 *
 * @return void
 */
function kraichtal_register_menus() {
	$locations = array(
		'primary' => __( 'Primary Menu', 'kraichtal' ),
		'footer'  => __( 'Footer Menu', 'kraichtal' ),
	);
	register_nav_menus( $locations );
}
add_action( 'after_setup_theme', 'kraichtal_register_menus' );

/**
 * Register and enqueue styles.
 *
 * @return void
 */
function kraichtal_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'kraichtal-style', get_stylesheet_uri(), array() );
}
add_action( 'wp_enqueue_scripts', 'kraichtal_register_styles' );

/**
 * Include a skip to content link.
 *
 * @return void
 */
function kraichtal_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'kraichtal' ) . '</a>';
}
add_action( 'wp_body_open', 'kraichtal_skip_link', 5 );

/**
 * Include required files.
 *
 * @return void
 */
require get_template_directory() . '/inc/template-tags.php';
