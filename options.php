<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return WPRB_THEME_ID;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace WPRB_THEME_ID
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {

	// branding tab
	$options[] = array(
		'name' => __('Branding', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Login Logo', WPRB_THEME_ID),
		'id' => 'login_logo',
		'desc' => __('Replace the Wordpress logo on the admin login screen', WPRB_THEME_ID),
		'type' => 'upload'
	);

	// Layout tab
	$options[] = array(
		'name' => __('Layout', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Show sub-menu in sidebar?', WPRB_THEME_ID),
		'desc' => __('Tick this box to show the automatic sub-menu on pages with a sidebar', WPRB_THEME_ID),
		'id' => 'sidebar_show_sub_menu',
		'type' => 'checkbox',
		'std' => '1',
	);

	// Fonts tab
	$options[] = array(
		'name' => __('Fonts', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Enable Icons by FontAwesome?', WPRB_THEME_ID),
		'desc' => __('Tick this box to load the FontAwesome icon font (4.3.0) from CDNJS', WPRB_THEME_ID),
		'id' => 'font_awesome_enabled',
		'type' => 'checkbox',
		'std' => '1',
	);

	$options[] = array(
		'name' => __('Install the following Google Fonts', WPRB_THEME_ID),
		'desc' => __('Enter one per line', WPRB_THEME_ID),
		'id' => 'google_fonts',
		'type' => 'textarea',
		'placeholder' => __('e.g. Open Sans:600,600italic,400italic', WPRB_THEME_ID),
	);

	// customise text tab
	$options[] = array(
		'name' => __('Customise Text', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Copyright', WPRB_THEME_ID),
		'id' => 'copyright',
		'type' => 'textarea',
	);

	// social tab
	$options[] = array(
		'name' => __('Social Links', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Facebook URL', WPRB_THEME_ID),
		'id' => 'social_fb_url',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Twitter URL', WPRB_THEME_ID),
		'id' => 'social_tw_url',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('LinkedIn URL', WPRB_THEME_ID),
		'id' => 'social_li_url',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Pinterest URL', WPRB_THEME_ID),
		'id' => 'social_pi_url',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('YouTube URL', WPRB_THEME_ID),
		'id' => 'social_yt_url',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Google+ URL', WPRB_THEME_ID),
		'id' => 'social_gp_url',
		'type' => 'text'
	);

	// advanced tab
	$options[] = array(
		'name' => __('Advanced', WPRB_THEME_ID),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Google Analytics Tracking Code', WPRB_THEME_ID),
		'id' => 'google_analytics_tracking_code',
		'type' => 'text',
		'placeholder'=>__('e.g. UA-XXXXXX-XX', WPRB_THEME_ID),
	);

	$options[] = array(
		'name' => __('Meta tag: Google Verification Code', WPRB_THEME_ID),
		'id' => 'meta_google_verification',
		'type' => 'text',
	);

	$options[] = array(
		'name' => __('Meta tag: Author', WPRB_THEME_ID),
		'id' => 'meta_author',
		'type' => 'text',
	);

	$options[] = array(
		'name' => __('Custom CSS', WPRB_THEME_ID),
		'id' => 'custom_css',
		'type' => 'textarea',
	);

	$options[] = array(
		'name' => __('Use PictureFill for supporting Responsive Images in older browsers?', WPRB_THEME_ID),
		'desc' => __('Tick this box to load the PictureFill javascript polyfill (2.3.1) from CDNJS', WPRB_THEME_ID),
		'id' => 'picturefill_enabled',
		'type' => 'checkbox',
		'std' => '1',
	);

	return $options;
}
