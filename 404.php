<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Leaf ,Codilight_Lite
 */

get_header(); ?>
	<div id="content" class="site-content container no-sidebar">
		<div class="content-inside">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( '哇哇哇…… 遇到 404 错误', 'codilight-lite' ); ?></h1>
							<h3 class="page-subtitle"><?php esc_html_e( '对不起，你希望访问的页面不存在。', 'codilight-lite' ); ?></h3>
						</header><!-- .page-header -->

						<div class="page-content">
							<div class="search404">
								<p><?php esc_html_e( '也许尝试搜索？', 'codilight-lite' ); ?></p>
								<?php get_search_form(); ?>
							</div>

							<div class="latest-posts-404">
								<h4><?php esc_html_e( '最新的文章', 'codilight-lite' ); ?></h4>
								<?php
								$custom_query = new WP_Query( apply_filters( 'page_404_latest_posts_args', array(
									'post_type'           => 'post',
									'posts_per_page'      => 6,
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true
								) ) );
								$count        = 0;
								if ( $custom_query->have_posts() ) :
									echo '<div class="block1 block1_grid">';
									echo '<div class="row">';
										while ( $custom_query->have_posts() ) : $custom_query->the_post();
										$count++;
										?>
										<article <?php post_class( 'col-md-4 col-sm-12' ); ?>>
										    <div class="entry-thumb">
										        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
													<?php
													if ( has_post_thumbnail( ) ) {
														the_post_thumbnail( 'codilight_lite_block_2_medium' );
													} else {
														echo '<img alt="'. esc_html( get_the_title() ) .'" src="'. esc_url( get_template_directory_uri() . '/assets/images/blank325_170.png' ) .'">';
													}
													?>
												</a>
												<?php
										        $category = get_the_category();
										        if ( $category[0] ) {
										            echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
										        }
										        ?>
										    </div>
										    <div class="entry-detail">
										        <header class="entry-header">
										    		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										    		<?php if ( 'post' === get_post_type() ) codilight_lite_meta_1();?>
										    	</header><!-- .entry-header -->

										    	<div class="entry-excerpt">
										    		<?php echo codilight_lite_excerpt(120); ?>
										    	</div><!-- .entry-content -->
										    </div>
										</article><!-- #post-## -->
										<?php
										if ( $count % 3 == 0 ) {
											echo '</div>';
											echo '<div class="row">';
										}
										endwhile;
									echo '</div>';
									echo '</div>';
								endif;
								wp_reset_postdata(); // reset the query
								?>
							</div>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->

				</main><!-- #main -->
			</div><!-- #primary -->

<?php get_footer(); ?>
