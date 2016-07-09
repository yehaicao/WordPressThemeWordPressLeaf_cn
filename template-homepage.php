<?php
/*
Template Name: Homepage
*/
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

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

get_header(); ?>

	<div id="content" class="site-content container <?php echo codilight_lite_sidebar_position(); ?>">

		<div class="content-inside">
			<div id="primary" class="content-area">

				<?php if ( $paged < 2 ) { ?>
				<?php if ( is_active_sidebar( 'home-1' ) ) { ?>
				<div class="home-sidebar home-sidebar-1-1">
					<?php dynamic_sidebar( 'home-1' ); ?>
				</div>
				<?php } ?>
				<?php } ?>

				<main id="main" class="site-main" role="main">

					<?php if ( $paged < 2 ) { ?>
					<div class="home-sidebar home-sidebar-2-3">
						<div class="row">
							<div class="col-md-6">
								<?php if ( is_active_sidebar( 'home-2' ) ) { ?>
								<div class="home-sidebar home-sidebar-2">
									<?php dynamic_sidebar( 'home-2' ); ?>
								</div>
								<?php } ?>
							</div>
							<div class="col-md-6">
								<?php if ( is_active_sidebar( 'home-3' ) ) { ?>
								<div class="home-sidebar home-sidebar-3">
									<?php dynamic_sidebar( 'home-3' ); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>

				</main><!-- #main -->

				<?php if ( is_active_sidebar( 'home-4' ) ) { ?>
				<div class="home-sidebar home-sidebar-4">
					<?php dynamic_sidebar( 'home-4' ); ?>
				</div>
				<?php } ?>

			</div><!-- #primary -->

			<?php get_sidebar(); ?>
			
			<div class="clear"></div>

			<?php if ( is_active_sidebar( 'home-5' ) ) { ?>
			<div class="home-sidebar home-sidebar-6">
			
					<?php dynamic_sidebar( 'home-5' ); ?>
					
			</div>
			<?php } ?>
			
			
			<?php get_template_part( 'template-parts/content-links' ); // 调用友情链接
		 ?> 
		
			

<?php get_footer(); ?>
