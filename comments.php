<?php
echo wprb_get_current_template_comment(__FILE__);
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
<section class="comments content" id="comments">
	<h6><?php
		printf( _nx( 'One comment about &ldquo;%2$s&rdquo;', '%1$s comments about &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', WPRB_THEME_ID ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
	?></h6>
	<?php
		wp_list_comments( array(
			'walker'=>new WPRB_Comment_Walker(),
			'short_ping' => true,
			'avatar_size'=>0,
		) );
	?>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" class="comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', WPRB_THEME_ID ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', WPRB_THEME_ID ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', WPRB_THEME_ID ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // check for comment navigation ?>
</section>
<?php endif;

$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author'  => '<label for="author">' . __( 'Your Name', WPRB_THEME_ID ) . '*</label><input class="pure-input-1-3" id="author" placeholder="First &amp; Last Name" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" required>',
			'email'  => '<label for="email">' . __( 'Email Address', WPRB_THEME_ID ) . '*</label><input class="pure-input-1-3" id="email" placeholder="your-real-email@example.com" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required>',
			'url'  => '<label for="url">' . __( 'Website URL', WPRB_THEME_ID ) . '</label><input class="pure-input-1-3" id="url" placeholder="http://example.com" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" required>',
		)
	),
	'comment_field' => '<label for="comment">' . __( 'Your Comment', WPRB_THEME_ID ) . '*</label><textarea id="comment" name="comment" placeholder="Express your thoughts, idea or write a feedback by writing your reply here" class="pure-input-1-2" rows="8" required"></textarea>',
	'comment_notes_after' => '',
	'title_reply' => '<h6>Please Post Your Comments & Reviews</h6>'
);

ob_start();
comment_form($args);
$form = ob_get_clean();
$form = str_replace('class="submit"', 'class="btn btn-blue"', $form);
$form = str_replace('class="comment-respond"', 'class="comment-respond pure-form pure-form-stacked content"', $form);
echo $form;
