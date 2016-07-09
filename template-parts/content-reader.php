<?php
/**
* Template part for displaying page content in page.php.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Codilight_Lite
* @package www.wordperssleaf.com Leaf theme
*/

function readers_wall( $outer='1',$timer='100',$limit='60' ){
	global $wpdb;
	$counts = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $timer month ) and user_id='0' and comment_author != '".$outer."' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $limit");
	foreach ($counts as $count) {
		$c_url = $count->comment_author_url;
		if (!$c_url) $c_url = 'javascript:;';
		$find = array("0.gravatar.com","1.gravatar.com");
  	$type .= '<a id="duzhe" target="_blank" rel="external nofollow" href="'. $c_url . '" title="['.$count->comment_author.']近期评论'. $count->cnt . '次">'.str_replace($find, 'secure.gravatar.com',get_avatar( $count->comment_author_email, $size = '64' , leaf_avatar_default() )).'<span>'.$count->comment_author.'</span></a>';
	}
	echo $type;
};

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		

         <?php the_content(); ?>


		       <div class="readers">
			     	<?php readers_wall(); ?>
          </div>
					
					
					<?php
					wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codilight-lite' ),
					'after'  => '</div>',
					) );
					?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						

					<div class="entry-share">
						网站最后更新时间: <?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-m-d G:i:s', strtotime($last[0]->MAX_m));echo $last; ?><br /><br />
						</div>

					<?php
					edit_post_link(
					sprintf(
					/* translators: %s: Name of current post */
					esc_html__( '编辑 %s', 'codilight-lite' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
					);
					?>
					</footer><!-- .entry-footer -->
					</article><!-- #post-## -->


