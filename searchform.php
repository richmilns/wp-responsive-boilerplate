<?php
echo wprb_get_current_template_comment(__FILE__);
echo '<form role="search" method="get" class="search-form search-form-compact search-form-with-icon" action="' . home_url( '/' ) . '">';
echo '<input type="search" class="search-field" placeholder="' . esc_attr_x( "Search...", "placeholder" ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '">';
echo '</form>';
echo wprb_get_current_template_comment(__FILE__, true);
