<?php
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content">';
get_template_part('inc/breadcrumbs');
while ( have_posts() ) : the_post();
	get_template_part( 'content', 'page' );
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile;
echo '</main>';
get_footer();
