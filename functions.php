<?php
define('WPRB_BASE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
require_once WPRB_BASE_PATH . 'inc' . DIRECTORY_SEPARATOR . 'comment-walkers.php';
require_once WPRB_BASE_PATH . 'inc' . DIRECTORY_SEPARATOR . 'menu-walkers.php';
// *********************************************** VARIABLES */
/**
 * Unique ID for this theme
 */
define('WPRB_THEME_ID', 'wprb');
// *********************************************** OPTIONS FRAMEWORK */
/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
// add_action( 'optionsframework_custom_scripts', 'wprb_optionsframework_custom_scripts' );
// function wprb_optionsframework_custom_scripts() {}

// *********************************************** WP ADMIN BACK END ACTIONS */
/**
 * Add a link to Theme Options in admin toolbar
 */
add_action( 'admin_bar_menu', 'wprb_add_toolbar_items', 100 );
function wprb_add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id' => 'theme-options-wprb',
		'capability' => 'edit_theme_options',
		'title' => 'Theme Options',
		'href' => get_admin_url(null, 'themes.php?page=options-framework'),
		'meta' => array(
			'title' => __('Theme Options', WPRB_THEME_ID),
		),
	));
}

/**
 * Changes the login logo for the Wordpress login screen
 */
add_action( 'login_head', 'wprb_custom_login_logo' );
function wprb_custom_login_logo() {
	// check to see if we have an option
	if($image = of_get_option('login_logo')) {
		// override the WP CSS
		echo sprintf('<style type="text/css"> .login h1 a { background-image:url(%s); background-size:auto 100%%; width:100%%; background-position:center center; }</style>',
			$image
		);
	}
}

// *********************************************** FRONT END ACTIONS */

/**
 * Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
 */
add_action( 'after_setup_theme', 'wprb_setup' );
function wprb_setup() {
	load_theme_textdomain( WPRB_THEME_ID, get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	// add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	// html5 output for common template elements
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	// add_theme_support( 'post-formats', array( 'gallery', 'image', 'video' ) );
	// custom menu support
	add_theme_support( 'menus' );
	register_nav_menus(
		array(
			'primary' => __('Primary Menu', WPRB_THEME_ID),
		)
	);
	// featured images
	add_theme_support( 'post-thumbnails', array( 'post' ) );
}

/**
 * Widgets support
 */
add_action( 'widgets_init', 'wprb_widgets_init' );
function wprb_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar 1',
		'id'            => 'sidebar1',
		'before_widget' => '<nav>',
		'after_widget'  => '</nav>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}

/**
 * Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
 */
add_action( 'wp_enqueue_scripts', 'wprb_scripts_styles' );
function wprb_scripts_styles() {
	global $wp_styles;

	// Load Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (!is_admin()) {
		// Example: jQuery from CDNJS
		// wp_deregister_script('jquery');
		// wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, null);
		// wp_enqueue_script('jquery');
		// fancybox 2 support from CDNJS
		// wp_enqueue_script( 'fancybox215', '//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js');

		if ($fontAwesome = of_get_option('font_awesome_enabled')):
			wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', false, '4.3.0', 'all' );
		endif;

		if ($googleFonts = of_get_option('google_fonts')):
			$googleFonts = implode('|', explode(PHP_EOL, $googleFonts));
			if(!empty($googleFonts)) {
				wp_enqueue_style( WPRB_THEME_ID . '-google-fonts', '//fonts.googleapis.com/css?family=' . str_replace(' ', '+', $googleFonts), false, null, 'all' );
			}
		endif;

		if ($pictureFill = of_get_option('picturefill_enabled')):
			wp_enqueue_script( 'picturefill', 'https://cdnjs.cloudflare.com/ajax/libs/picturefill/2.3.1/picturefill.min.js', false, '2.3.1', false);
		endif;

		// Theme specific JS example:
		// wp_enqueue_script( WPRB_THEME_ID, get_template_directory_uri() . '/js/site-min.js', false, '1.0.0', true);
	}

}

/**
 * WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
 */
add_filter( 'wp_title', 'wprb_wp_title', 10, 2 );
function wprb_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', WPRB_THEME_ID ), max( $paged, $page ) );
	}

	return $title;
}

/**
 * Re-usable helper function to output the name of the current template file at the start of each page / post / taxonomy template
 */
function wprb_get_current_template_comment($file, $closing=false){
	$closing = ($closing === true) ? '/' : null;
	return '<!-- ' . $closing . '' . str_replace('.php', '', basename($file)) . ' -->' . PHP_EOL;
}

/**
 * Declaring support for WooCommerce
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
