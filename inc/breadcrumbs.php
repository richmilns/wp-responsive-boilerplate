<?php
echo wprb_get_current_template_comment(__FILE__);
// support Yoast SEO plugin for breadcrumbs
if ( function_exists('yoast_breadcrumb') and (!is_home() and !is_front_page()) ):
	yoast_breadcrumb('<p class="breadcrumbs">','</p>');
endif;
echo wprb_get_current_template_comment(__FILE__, true);
