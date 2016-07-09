<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codilight_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header entry-header-single">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php codilight_lite_meta_1(); ?>
	</header><!-- .entry-header -->
	
		<?php get_template_part( 'template-parts/content-share' ); // 调用分享模板 	
	?>

	<?php if ( has_post_thumbnail() ) : ?>
	


	<div class="entry-thumb">
		<?php the_post_thumbnail( 'codilight_lite_single_medium' ); ?>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		
		<!--p>本文地址：<a rel="external nofollow" href="<?php esc_url(the_permalink()); ?>"><?php esc_url(the_permalink()); ?></a></p-->
		<p>转载请注明：《<a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a>》</p>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( '页面:', 'codilight-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php codilight_lite_entry_footer(); ?>
		
		<?php get_template_part( 'template-parts/content-cnshare' ); // 调用分享模板 	
	?>

		<?php
		$prev_link = get_previous_post_link( '%link', '%title', true );
		$next_link = get_next_post_link( '%link', '%title', true );
		?>
		<?php if ( $prev_link || $next_link ) : ?>
		<div class="post-navigation row">
			<div class="col-md-6">
				<?php if ( $prev_link ) { ?>
				<span><?php esc_html_e( '上一篇文章', 'codilight-lite' ) ?></span>
				<h2 class="h5"><?php echo $prev_link; ?></h2>
				<?php } ?>
			</div>
			<div class="col-md-6 post-navi-next">
				<?php if ( $next_link ) { ?>
				<span><?php esc_html_e( '下一篇文章', 'codilight-lite' ) ?></span>
				<h2 class="h5"><?php echo $next_link; ?></h2>
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>
		<?php get_template_part( 'template-parts/content-author' ); 	?>
    <?php get_template_part( 'template-parts/content', 'related' ); ?> 

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
