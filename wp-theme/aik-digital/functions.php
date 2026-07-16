<?php
/**
 * aik digital theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AIK_THEME_VERSION', '1.0.0' );
define( 'AIK_THEME_DIR', get_template_directory() );
define( 'AIK_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function aik_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'align-wide' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'aik-digital' ),
		)
	);
}
add_action( 'after_setup_theme', 'aik_setup' );

/**
 * Assets — enqueued in the same order as the original static markup so
 * behaviour (GSAP preloader, AOS, Swiper, footer accordion, search drawer)
 * keeps working unmodified.
 */
function aik_enqueue_assets() {
	add_editor_style();

	wp_enqueue_style( 'aik-google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap', array(), null );
	wp_enqueue_style( 'aik-main', AIK_THEME_URI . '/css/main.css', array(), AIK_THEME_VERSION );
	wp_enqueue_style( 'aik-style', AIK_THEME_URI . '/css/style.css', array( 'aik-main' ), AIK_THEME_VERSION );

	// The theme ships its own jQuery build (matching the original static site);
	// drop WP's bundled copy on the front end to avoid loading it twice.
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', AIK_THEME_URI . '/js/jquery.js', array(), AIK_THEME_VERSION, true );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'aik-jquery-migrate', AIK_THEME_URI . '/js/jquery-migrate.js', array( 'jquery' ), AIK_THEME_VERSION, true );
	wp_enqueue_script( 'aik-vendor', AIK_THEME_URI . '/js/vendor.js', array( 'jquery' ), AIK_THEME_VERSION, true );
	wp_enqueue_script( 'aik-custom', AIK_THEME_URI . '/js/custom.js', array( 'aik-vendor' ), AIK_THEME_VERSION, true );
	wp_enqueue_script( 'aik-app', AIK_THEME_URI . '/js/app.js', array( 'aik-custom' ), AIK_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'aik_enqueue_assets' );

/**
 * ACF: local JSON storage so field groups ship with the theme and
 * auto-import on activation instead of needing to be rebuilt by hand.
 */
add_filter(
	'acf/settings/save_json',
	function () {
		return AIK_THEME_DIR . '/acf-json';
	}
);
add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		unset( $paths[0] );
		$paths[] = AIK_THEME_DIR . '/acf-json';
		return $paths;
	}
);

/**
 * ACF Options Page — site-wide footer/header content instead of hardcoding
 * it, so it's not duplicated as a Flexible Content layout on every page.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Theme Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'aik-theme-settings',
			'capability' => 'edit_theme_options',
			'icon_url'   => 'dashicons-admin-generic',
		)
	);
}

require_once AIK_THEME_DIR . '/inc/post-types.php';
require_once AIK_THEME_DIR . '/inc/nav-menu-fallback.php';
require_once AIK_THEME_DIR . '/inc/flexible-content.php';
require_once AIK_THEME_DIR . '/inc/forms.php';
