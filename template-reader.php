<?php
/*
Template Name: Reader
description: template for www.wordpressleaf.com leaf theme 
*/
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Codilight_Lite
* @package www.wordperssleaf.com Leaf theme
*/

get_header(); ?>
<div id="content" class="site-content container <?php echo codilight_lite_sidebar_position(); ?>">
	<?php get_template_part( 'template-parts/content-breadcrumb' ); // 调用面包屑导航模板
	?>
	<div class="content-inside">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'reader' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
				?>

				<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
		<?php get_footer(); ?>
