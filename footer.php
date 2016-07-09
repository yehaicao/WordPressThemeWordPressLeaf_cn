<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leaf , Codilight_Lite
 */
?>
		</div> <!--#content-inside-->
	</div><!-- #content -->
	<div class="footer-shadow container">
		<div class="row">
			<div class="col-md-12">
				<img src="<?php echo get_template_directory_uri().'/assets/images/footer-shadow.png' ?>" alt="" />
			</div>
		</div>
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">

			<?php if ( has_nav_menu( 'footer' ) ): ?>
			<div class="footer-navigation">
				<?php wp_nav_menu( array('theme_location' => 'footer', 'container' => 'footer-menu', 'fallback_cb' => false ) ); ?>
			</div>
			<?php endif; ?>

			<div class="site-info">
				<p>
					<?php printf( esc_html__( '版权所有 &copy; %1$s %2$s 保留所有权利', 'codilight-lite' ), date('Y'), get_bloginfo( 'name' ) ); ?>
				</p>
				<?php printf( esc_html__( 'WordPressLeaf 主题 由 %1$s 荣誉出品', 'codilight-lite' ), '<a rel="nofollow" target="_blank" href="'. esc_url( 'http://www.wordpressleaf.com' ) .'">WordPress Leaf</a>' ); ?>
			</div><!-- .site-info -->

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
