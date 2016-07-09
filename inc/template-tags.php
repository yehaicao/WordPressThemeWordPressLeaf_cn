<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Codilight_Lite
 */

if ( ! function_exists( 'codilight_lite_posted_on' ) ) :
/**
 * Post meta information style 1
 */
function codilight_lite_meta_1() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'codilight-lite' ),
		'<span class="entry-date">' . $time_string . '</span>'
	);
	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'codilight-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div class="entry-meta entry-meta-1">';

		echo $byline.$posted_on;
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo '<i class="fa fa-comments-o"></i>';
			comments_popup_link( '0', '1', '%' );
			echo '</span>';
		}

	echo '</div>';
}
endif;


if ( ! function_exists( 'codilight_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function codilight_lite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '发布于 %s', 'post date', 'codilight-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'codilight-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'codilight_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function codilight_lite_entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$category_list = get_the_category_list();
		$tag_list      = get_the_tag_list( '<ul class="post-tags"><li>', "</li>\n<li>", '</li></ul>' );
		if ( $category_list != '' || $tag_list != '' ) {
			echo '<div class="entry-taxonomies">';
			if ( $category_list ) {
				echo '<div class="entry-categories">';
					echo '<span>'. esc_html__( '分类', 'codilight-lite' ) .'</span>';
					echo $category_list;
				echo '</div>';
			}

			if ( $tag_list ) {
				echo '<div class="entry-tags">';
					echo '<span>'. esc_html__( '标签', 'codilight-lite' ) .'</span>';
					echo $tag_list;
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
endif;

if ( ! function_exists( 'codilight_lite_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own codilight_lite_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function codilight_lite_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php esc_html_e( '自动引用通知：', 'codilight-lite' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '（编辑）', 'codilight-lite' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
            <?php echo get_avatar( $comment, 60 ); ?>
            <div class="comment-wrapper">
                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( '文章作者', 'codilight-lite' ) . '</span>' : ''
                        );
                        printf( '<a class="comment-time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( esc_html__( '%1$s', 'codilight-lite' ), get_comment_date() )
                        );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( '回复', 'codilight-lite' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( esc_html__( '编辑', 'codilight-lite' ), '<span class="edit-link">', '</span>' );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e( '您的评论正在等待审核。', 'codilight-lite' ); ?></p>
                <?php endif; ?>

                <div class="comment-content">
                    <?php comment_text(); ?>
                    <?php  ?>
                </div><!-- .comment-content -->
            </div><!--/comment-wrapper-->
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function codilight_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'codilight_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'codilight_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so codilight_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so codilight_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in codilight_lite_categorized_blog.
 */
function codilight_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'codilight_lite_categories' );
}
add_action( 'edit_category', 'codilight_lite_category_transient_flusher' );
add_action( 'save_post',     'codilight_lite_category_transient_flusher' );
