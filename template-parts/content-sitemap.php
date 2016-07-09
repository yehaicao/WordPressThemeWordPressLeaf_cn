<?php
/**
* Template part for displaying page content in page.php.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Codilight_Lite
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div id="content">
			<h3>最新文章</h3>
				<ul>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$posts_per_page=25;
					$custom_query_args = array(
					'post_type'           => 'post',
					'posts_per_page' => $posts_per_page,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
					'order'               => 'DESC',
					'orderby'             => 'date',
					'paged'=>$paged,
					);
					$custom_query = new WP_Query( $custom_query_args );


          
					$total_pages = $custom_query->max_num_pages;  //总共多少页
					$current_page = max(1, get_query_var('paged')); //当前第几页
					
					

					if ( $custom_query->have_posts() ) :


					while ( $custom_query->have_posts() ) : $custom_query->the_post();

					?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></li>

					<?php
					endwhile;


					echo '</ul>';





					wp_reset_postdata(); // reset the query
					endif;


					if ( $total_pages == $current_page){

						?>



					</div>
					<div id="content">
						<h3>分类目录<h3>

							<ul>
								<?php wp_list_categories('title_li='); ?>
							</ul>
						</div>
						<div id="content">
							<h3>单页面</h3>
							<?php wp_page_menu( $args ); ?>
						</div>

				<?php
					}//判断是否是最后一页，是最后一页输出分类和页面

					
					pagination($current_page,$total_pages);//分页函数 
					?>

					<?php the_content(); ?>
					<?php
					wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'codilight-lite' ),
					'after'  => '</div>',
					) );
					?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						
						<div class="entry-share">
					
					访问网站首页: <strong><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></strong> <br />
					
					</div>
					<div class="entry-share">
						查看<strong><a href="sitemap.xml" target="_blank">SiteMap.xml</a></strong> 网站最后更新时间: <?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-m-d G:i:s', strtotime($last[0]->MAX_m));echo $last; ?><br /><br />
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


