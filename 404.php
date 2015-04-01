<?php
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content" role="main">';
get_template_part('inc/breadcrumbs');
echo '<h1>' . __('Page Not Found', WPRB_THEME_ID) . '</h1>';
echo '<p>' . __('The page you requested could not be found. This may be because it has been deleted or moved to a new location.', WPRB_THEME_ID) . '</p>';
echo '</main>';
get_footer();
