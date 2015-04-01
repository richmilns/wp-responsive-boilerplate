<?php
echo wprb_get_current_template_comment(__FILE__);
echo '<footer class="footer">';
echo '<p class="copyright" role="contentinfo">&copy; ' . date('Y') . ' ' . esc_html(of_get_option('copyright')) . '</p>';
echo '</footer>';
wp_footer();
echo '</body>';
echo '</html>';
