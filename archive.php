<?php
get_header();
echo wprb_get_current_template_comment(__FILE__);
echo '<main class="content" role="main">';
get_template_part('inc/breadcrumbs');

if (have_posts()):

	// Hack. Set $post so that the_date() works.
	$post = $posts[0];

	if (is_category()):
		// If this is a category archive
		echo sprintf('<h2>%s &#8216;%s&#8217; %s</h2>',
			__('Archive for the', WPRB_THEME_ID),
			single_cat_title(null, false),
			 _e('Category', WPRB_THEME_ID)
		);

	elseif(is_tag()):
		// If this is a tag archive
		echo sprintf('<h2>%s &#8216;%s&#8217;</h2>',
			__('Posts Tagged', WPRB_THEME_ID),
			single_cat_title(null, false)
		);

	elseif(is_day()):
		// If this is a daily archive
		echo sprintf('<h2>%s %s</h2>',
			__('Archive for', WPRB_THEME_ID),
			get_the_time('F jS, Y')
		);

	elseif(is_month()):
		// If this is a monthly archive
		echo sprintf('<h2>%s %s</h2>',
			__('Archive for', WPRB_THEME_ID),
			get_the_time('F, Y')
		);

	elseif(is_year()):
		// If this is a yearly archive
		echo sprintf('<h2>%s %s</h2>',
			__('Archive for', WPRB_THEME_ID),
			get_the_time('Y')
		);

	elseif(is_author()):
		$currentAuthor = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		// If this is an author archive
		echo sprintf('<h2>%s %s</h2>',
			__('Posts by', WPRB_THEME_ID),
			$currentAuthor->nickname
		);

	elseif (isset($_GET['paged']) && !empty($_GET['paged'])):
		echo sprintf('<h2>%s</h2>',
			__('Blog Archive', WPRB_THEME_ID)
		);
	else:
		echo sprintf('<h2>%s</h2><p>%s</p>',
			__('Nothing Found', WPRB_THEME_ID),
			__('This part of the website is currently empty', WPRB_THEME_ID)
		);
	endif;

	while (have_posts()) : the_post();

		get_template_part('content', get_post_type());

	endwhile;

	get_template_part('inc/pagination');

endif;
echo '</main>';
get_footer();
