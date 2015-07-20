<?php
/**
 * Template Name: Page With Sidebar
 */
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content">';
echo '<div class="content-sidebar-wrapper">';
echo '<div class="content-sidebar-inner-wrapper">';
echo '<div class="content-inner">';

get_template_part('inc/breadcrumbs');

while ( have_posts() ) : the_post();

	get_template_part( 'content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile;
echo '</div>';
// Sidebar
echo '<div class="sidebar">';
if(of_get_option('sidebar_show_sub_menu')):
	echo '<nav><h2>Read More</h2>';
	$walker = false;
	if(has_nav_menu('primary')):
		$walker = new WPRB_Current_Level_Menu_Walker();
	endif;
	wp_nav_menu(
		array(
			'theme_location'=>'primary',
			'walker'=>$walker
		)
	);
	echo '</nav>';
endif;
if ( is_active_sidebar( 'sidebar' ) ) :
	echo '<div id="Sidebar1" class="sidebar1 widget-area" role="complementary">';
	dynamic_sidebar( 'sidebar1' );
	echo '</div>';
endif;

echo '</div>';
echo '</div>';
echo '</div>';
echo '</main>';

get_footer();
