<?php
echo wprb_get_current_template_comment(__FILE__);
if(!is_search()) {
	the_content();
} else {
	$classes = implode(' ', get_post_class(array('post'), get_the_ID()));
	echo '<article class="' . $classes . '">';
	echo '<header><h3><a href="' . get_the_permalink() . '">';
	echo the_title();
	echo '</a></h3></header>';
	the_excerpt();
	echo '</article>';
}
