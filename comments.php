<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leaf , Codilight_Lite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title h3">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 人吐嘈', '%1$s 人吐嘈', get_comments_number(), 'comments title', 'codilight-lite' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( '评论导航', 'codilight-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '较老的评论', 'codilight-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( '较新的评论', 'codilight-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'codilight_lite_comment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( '评论导航', 'codilight-lite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( '较老的评论', 'codilight-lite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( '较新的评论', 'codilight-lite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( '抱歉，该页面评论已关闭。', 'codilight-lite' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
