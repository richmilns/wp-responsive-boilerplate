<!doctype html>
<!--[if IE 6]><html class="ie6 no-js no-svg no-flex" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie7 no-js no-svg no-flex" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie8 no-js no-svg no-flex" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie9 no-js no-svg no-flex" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!--><html class="no-js no-svg no-flex" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<script>
(function(H){
	// Detect JS
	H.className = H.className.replace(/\bno-js\b/,'js');
	// Detect SVG support
	if(!!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', "svg").createSVGRect) {
		H.className=H.className.replace(/\bno-svg\b/,'svg');
	}
	// Detect display:flex support
	if (('flexWrap' in H.style) || ('WebkitFlexWrap' in H.style) || ('msFlexWrap' in H.style)){
		H.className=H.className.replace(/\bno-flex\b/,'flex');
	}
})(document.documentElement)
</script>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="initial-scale=1, user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<?php
if ($metaAuthor = of_get_option('meta_author')):
	echo '<meta name="author" content="' . esc_attr($metaAuthor) . '">' . PHP_EOL;
endif;

if ($metaGoogle = of_get_option('meta_google_verification')):
	echo '<meta name="google-site-verification" content="' . esc_attr($metaGoogle) . '">' . PHP_EOL;
endif;

if (is_search()):
	// don't index search pages in Google
	echo '<meta name="robots" content="noindex, nofollow">' . PHP_EOL;
endif;
?>
<title><?php wp_title('|', true, 'right') ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- favicons & touch / misc icons - generate your own here http://realfavicongenerator.net/ - example: -->
<!-- <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/img/favicons/favicon.ico"> -->
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/lt-ie9.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<![endif]-->
<!--[if (!IE)|(IE 9)]><!-->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/css/styles.css">
<!--<![endif]-->
<?php
if ($customCss = of_get_option('custom_css')):
	echo '<style type="text/css">' . PHP_EOL . '/* Custom CSS from Theme Options */' . PHP_EOL . $customCss . PHP_EOL . '</style>' . PHP_EOL;
endif;

wp_head();

if($googleAnalyticsTrackingCode = of_get_option('google_analytics_tracking_code')):?>
<!-- Google Analytics Tracking Code -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo esc_attr($googleAnalyticsTrackingCode) ?>', '<?php echo site_url() ?>');
ga('send', 'pageview');
</script>
<!-- /Google Analytics Tracking Code -->
<?php
endif;?>
</head>

<?php
$defaultBodyClasses = 'month-'.strtolower(date('F')). ' year-'.date('Y');
if(!is_home() and !is_front_page()):
	$defaultBodyClasses .= ' inside-page';
endif;
?>

<body <?php body_class($defaultBodyClasses) ?>>
<header class="masthead">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php bloginfo( 'name' ); ?></a>
	<?php get_search_form(); ?>
</header>
<?php
wp_nav_menu(array(
	'theme_location' => 'primary',
	'container'=>'nav',
	'container_class'=> 'main-nav'
))
?>
