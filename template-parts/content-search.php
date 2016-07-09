<?php
/**
 * Template part for displaying posts with list style.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codilight_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail( ) ) { ?>
    <div class="entry-thumb">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
			<?php the_post_thumbnail( 'codilight_lite_block_1_medium' ); ?>
		</a>
    </div>
	<?php } ?>
    <div class="entry-detail<?php if ( ! has_post_thumbnail( ) ) echo ' no-thumbnail'; ?>">
        <header class="entry-header">
    		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    		<?php if ( 'post' === get_post_type() ) codilight_lite_meta_1();?>
    	</header><!-- .entry-header -->

    	<div class="entry-excerpt">
    		<?php echo codilight_lite_excerpt(80); ?>
    	</div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->
