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
			'primary'  => __( 'Primary Menu (Personal)', 'aik-digital' ),
			'business' => __( 'Business Menu', 'aik-digital' ),
		)
	);
}
add_action( 'after_setup_theme', 'aik_setup' );

/**
 * Assets — enqueued in the same order as the original static markup so
 * behaviour (GSAP preloader, AOS, Swiper, footer accordion, search drawer)
 * keeps working unmodified.
 */
/**
 * filemtime() of a theme-relative asset, e.g. '/css/style.css' — used as
 * the enqueue version instead of the static AIK_THEME_VERSION for files
 * that get edited often. AIK_THEME_VERSION never changes between deploys,
 * so the enqueued URL (?ver=1.0.0) was identical before and after every
 * CSS/JS edit — nothing (browser cache, Cloudways' server-side cache) had
 * any reason to treat it as a new file, so edits could silently keep
 * serving the old cached copy after upload. filemtime() changes the moment
 * the file itself changes, forcing a fresh fetch every time. Falls back to
 * AIK_THEME_VERSION if the file can't be read (safe default, matches the
 * old behavior instead of erroring).
 */
function aik_asset_version( $relative_path ) {
	$file = AIK_THEME_DIR . $relative_path;
	$mtime = file_exists( $file ) ? filemtime( $file ) : false;
	return $mtime ? $mtime : AIK_THEME_VERSION;
}

function aik_enqueue_assets() {
	add_editor_style();

	wp_enqueue_style( 'aik-google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap', array(), null );
		wp_enqueue_style( 'aik-google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&family=Outfit:wght@100..900&display=swap', array(), null );
	wp_enqueue_style( 'aik-main', AIK_THEME_URI . '/css/main.css', array(), aik_asset_version( '/css/main.css' ) );
	wp_enqueue_style( 'aik-style', AIK_THEME_URI . '/css/style.css', array( 'aik-main' ), aik_asset_version( '/css/style.css' ) );
	wp_enqueue_style( 'aik-responsive', AIK_THEME_URI . '/css/responsive.css', array( 'aik-main', 'aik-style' ), aik_asset_version( '/css/responsive.css' ) );

	// The theme ships its own jQuery build (matching the original static site);
	// drop WP's bundled copy on the front end to avoid loading it twice.
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', AIK_THEME_URI . '/js/jquery.js', array(), AIK_THEME_VERSION, true );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'aik-jquery-migrate', AIK_THEME_URI . '/js/jquery-migrate.js', array( 'jquery' ), AIK_THEME_VERSION, true );
	wp_enqueue_script( 'aik-vendor', AIK_THEME_URI . '/js/vendor.js', array( 'jquery' ), AIK_THEME_VERSION, true );
	wp_enqueue_script( 'aik-custom', AIK_THEME_URI . '/js/custom.js', array( 'aik-vendor' ), aik_asset_version( '/js/custom.js' ), true );
	wp_enqueue_script( 'aik-app', AIK_THEME_URI . '/js/app.js', array( 'aik-custom' ), aik_asset_version( '/js/app.js' ), true );
	wp_enqueue_script( 'aik-lang', AIK_THEME_URI . '/js/lang.js', array(), aik_asset_version( '/js/lang.js' ), true );
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
require_once AIK_THEME_DIR . '/inc/leads-export.php';
require_once AIK_THEME_DIR . '/inc/nav-menu-fallback.php';
require_once AIK_THEME_DIR . '/inc/flexible-content.php';
require_once AIK_THEME_DIR . '/inc/recaptcha.php';
require_once AIK_THEME_DIR . '/inc/forms.php';
require_once AIK_THEME_DIR . '/inc/search.php';
