<?php
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content" role="main">';
get_template_part('inc/breadcrumbs');
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$type = (get_post_type()) ? get_post_type() : 'post';
		if(is_page()) {
			$type = 'page';
		}
		get_template_part( 'content', $type );
	endwhile;
endif;
echo '</main>';
get_footer();

