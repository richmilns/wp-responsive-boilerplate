<?php
echo wprb_get_current_template_comment(__FILE__);
?>
<article id="article-<?php the_ID() ?>" class="<?php echo implode(' ', get_post_class(array('post'), get_the_ID())) ?>" itemscope itemtype="http://schema.org/BlogPosting">
	<header>
	<?php if(!is_single()): ?>
		<h3 class="post-headline" itemprop="name headline"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></h3>
	<?php else: ?>
		<h1 class="post-headline" itemprop="name headline"><?php the_title() ?></h1>
		<p>
			<?php
			$today = strtotime('00:00:00');
			$todayCheck = strtotime(get_the_time('Y-m-d 00:00:00'));
			if($today == $todayCheck):?>
			Posted today, <?php the_time('h:ia')?>
			<?php else: ?>
			Posted <?php the_time('jS F Y h:ia') ?>
			<?php endif; ?>
			by
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" itemprop="url" rel="author"><?php the_author_meta('display_name')?></a>
		</p>
	<?php endif; ?>
	</header>
	<?php
	if(has_post_thumbnail() and !is_search()): ?>
	<figure class="featured-image align-right featured-image-<?php echo (is_single()) ? 'm' : 's' ?>">
		<?php the_post_thumbnail()	?>
		<figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt ?></figcaption>
	</figure>
	<?php endif; ?>
	<section itemprop='description'>
		<?php
		if(is_search()):
			the_excerpt();
		else:
			the_content();
		endif;
		?>
	</section>
	<?php if(!is_single() and !is_search()): ?>
	<footer class="meta">
		<p>
		<?php if($post->comment_count > 0 or $post->comment_status != 'closed'): ?>
		<a class="comment-count" href="<?php the_permalink()?>#comments">
		<i class="fa fa-comment"></i>
		<?php
		$comments = get_comments_number();
		$commentsWording = __('Comments', WPRB_THEME_ID);
		if($comments == 1) {
			$commentsWording = __('Comment', WPRB_THEME_ID);
		}
		echo sprintf('<span itemprop="interactionCount">%d</span> %s', $comments, $commentsWording);
		?>
		</a>
		<?php endif; ?>
		<i class="fa fa-user"></i>
		<?php _e('By', WPRB_THEME_ID) ?>
		<span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			<span itemprop="name"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>" itemprop="url" rel="author"><?php the_author_meta('display_name')?></a></span>,
		</span>
		<?php if(has_category()): ?>
		<?php _e('published in', WPRB_THEME_ID) ?> <?php the_category(', ') ?> <?php _e('on', WPRB_THEME_ID) ?>
		<?php endif; ?>
		<time datetime="<?php the_time('c') ?>" itemprop="datePublished"><?php the_time('jS F Y')?></time>
		</p>
	</footer>
	<?php endif; ?>
</article>

