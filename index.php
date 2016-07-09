<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codilight_Lite
 */

get_header(); ?>

	<div id="content" class="site-content container <?php echo codilight_lite_sidebar_position(); ?>">
		<div class="content-inside">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : $count = 0;?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
					<?php endif; ?>

					<?php
					$layout_frontpage_posts = get_theme_mod( 'layout_frontpage_posts', 'grid' );

					global $wp_query;
					$total_pages = $wp_query->max_num_pages;
					$current_page = max(1, get_query_var('paged'));

					if ( $layout_frontpage_posts == 'grid' ) {
						echo '<div class="block1 block1_grid">';
						echo '<div class="row">';
							while ( have_posts() ) : the_post();
							$count++;
								get_template_part( 'template-parts/content-grid' );
							if ( $count % 2 == 0 ) {
								echo '</div>';
								echo '<div class="row">';
							}
							endwhile;
						echo '</div>';
						echo '</div>';

						/**
						 * Show pagination if more than 1 page.
						 */
						if (  $wp_query->max_num_pages > 1 ) {
							echo '<div class="ft-paginate">';
							the_posts_pagination(array(
								'prev_next' => True,
								'prev_text' => '<i class="fa fa-angle-left"></i>',
								'next_text' => '<i class="fa fa-angle-right"></i>',
								'before_page_number' => '<span class="screen-reader-text">' . __('页面', 'codilight-lite') . ' </span>',
							));
							printf( '<span class="total-pages">'. esc_html__( '页面 %1$s / %2$s', 'codilight-lite' ) .'</span>', $current_page, $total_pages );
							echo '</div>';
						}

					} else {
						echo '<div class="block1 block1_list">';
							while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content-list' );
							endwhile;
							/**
							 * Show pagination if more than 1 page.
							 */
							if (  $wp_query->max_num_pages > 1 ) {
								echo '<div class="ft-paginate">';
								the_posts_pagination(array(
									'prev_next' => True,
									'prev_text' => '<i class="fa fa-angle-left"></i>',
									'next_text' => '<i class="fa fa-angle-right"></i>',
									'before_page_number' => '<span class="screen-reader-text">' . __('页面', 'codilight-lite') . ' </span>',
								));
								printf( '<span class="total-pages">'. esc_html__( '页面 %1$s / %2$s', 'codilight-lite' ) .'</span>', $current_page, $total_pages );
								echo '</div>';
							}

						echo '</div>';
					}
					?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
