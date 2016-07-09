<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Codilight_Lite
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( '没有发现', 'codilight-lite' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( '准备好发布你的第一篇文章了吗？<a href=\"%1$s\">从这里开始</a>。', 'codilight-lite' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( '对不起，没有找到能够匹配您的搜索词的内容。请尝试再次使用一些不同的关键字。', 'codilight-lite' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( '我们似乎不能找到你正在寻找的东西。也许搜索可以帮助你。', 'codilight-lite' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
