<?php
class WPRB_Comment_Walker extends Walker_Comment {

	// init classwide variables
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	/** CONSTRUCTOR
	 * You'll have to use this if you plan to get to the top of the comments list, as
	 * start_lvl() only goes as high as 1 deep nested comments */
	function __construct() {

	}

	/** START_LVL
	 * Starts the list before the CHILD elements are added. */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		echo '</article><!-- begin child comments --><div class="comment-children">';
	}

	/** END_LVL
	 * Ends the children list of after the elements are added. */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		echo '</div><!-- end child comments -->';
	}

	/** START_EL */
	function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );?>
		<!-- begin comment # <?php comment_id() ?> -->
		<article <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
			<?php if( !$comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>
			<?php else: comment_text(); ?>
			<?php endif; ?>
			<footer>
				<p>
					<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
					<span class="comment-author-name"><?php echo get_comment_author_link(); ?></span>,
					<time datetime="<?php comment_date('Y-m-d H:i:s') ?>"><?php comment_date('jS M Y'); ?> at <?php comment_time(); ?></time>
					<?php edit_comment_link( 'Edit' ); ?> |
					<?php $reply_args = array(
					'depth' => $depth,
					'max_depth' => $args['max_depth'],
					'after' => ' | ' );
					comment_reply_link( array_merge( $args, $reply_args ) );?>
					<a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>">Permalink</a>

				</p>
			</footer>

	<?php }

	function end_el(&$output, $comment, $depth = 0, $args = array() ) {
		echo '</article><!-- end comment #' . get_comment_ID() . ' -->';
	}

	/** DESTRUCTOR
	 * I'm just using this since we needed to use the constructor to reach the top
	 * of the comments list, just seems to balance out nicely:) */
	function __destruct() {

	}
}
