<?php
echo wprb_get_current_template_comment(__FILE__);
$prevText = 'Previous Page';
$nextText = 'Next Page';
$classes = get_body_class();
if((is_archive() or is_category()) /*and (!in_array('tax-example_tax_name', $classes))*/):
	$prevText = 'Older Posts';
	$nextText = 'Newer Posts';
endif;
$prev = get_previous_posts_link(__('« ' . $prevText, WPRB_THEME_ID));
$next = get_next_posts_link(__($nextText .' »', WPRB_THEME_ID));
if($prev or $next):
	$prev = str_replace('<a ', '<a class="btn btn-blue" ', $prev);
	$next = str_replace('<a ', '<a class="btn btn-blue" ', $next);
	?>
<nav class="page-nav">
	<ul>
		<li><?php echo $prev ?></li>
		<li><?php echo $next ?></li>
	</ul>
</nav>
<?php
endif;
