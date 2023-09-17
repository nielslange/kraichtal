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

// Add support for featured images on pages.
function kraichtal_featured_images_support() {
	add_theme_support(
		'post-thumbnails',
		array( 'post', 'page' )
	);
}
add_action( 'after_setup_theme', 'kraichtal_featured_images_support' );

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
	wp_enqueue_style( 'kraichtal-lightbox2-style', get_template_directory_uri() . '/assets/vendors/lightbox2/css/lightbox.min.css', array() );
}
add_action( 'wp_enqueue_scripts', 'kraichtal_register_styles' );

/**
 * Register and enqueue styles.
 *
 * @return void
 */
function kraichtal_register_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_script( 'kraichtal-menu-script', get_template_directory_uri() . '/assets/js/menu.js', array(), time(), true );

	/**
	 * Load Lightbox only on gallery page.
	 */
	if ( 'page-gallery.php' === basename( get_page_template() ) ) {
		wp_enqueue_script( 'kraichtal-lightbox2-library', get_template_directory_uri() . '/assets/vendors/lightbox2/js/lightbox-plus-jquery.min.js', array(), time(), true );
		wp_enqueue_script( 'kraichtal-lightbox2-settings', get_template_directory_uri() . '/assets/js/lightbox.js', array( 'kraichtal-lightbox2-library' ), time(), true );
	}
}
add_action( 'wp_enqueue_scripts', 'kraichtal_register_scripts' );

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
 * Hide page editor on homepage and gallery pages.
 *
 * @return void
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/cpt.php';

function hide_editor() {
	$post_id = $_GET['post'] ?? null;
	if ( ! isset( $post_id ) ) {
		return;
	}

	$page_slug     = get_the_title( $post_id );
	$page_template = get_post_meta( $post_id, '_wp_page_template', true );

	if ( 'Home' === $page_slug || 'page-gallery.php' === $page_template ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'admin_init', 'hide_editor' );
