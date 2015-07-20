<?php
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content woocommerce-wrapper">';
get_template_part('inc/breadcrumbs');
woocommerce_content();
echo '</main>';
get_footer();
