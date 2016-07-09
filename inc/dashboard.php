<?php
/**
 * Add theme dashboard page
 */

add_action('admin_menu', 'codilight_lite_theme_info');
function codilight_lite_theme_info() {
	$theme_data = wp_get_theme();
	add_theme_page( sprintf( esc_html__( '%s 主题仪表盘', 'codilight-lite' ), $theme_data->Name ), sprintf( esc_html__('%s一般设置', 'codilight-lite'), $theme_data->Name), 'edit_theme_options', 'ft_codilight_lite', 'codilight_lite_theme_info_page');
}

function codilight_lite_theme_info_page() {

	$theme_data = wp_get_theme(); ?>

	<div class="wrap about-wrap theme_info_wrapper">
		<h1><?php printf(esc_html__('欢迎使用 %1s - 版本 %2s', 'codilight-lite'), $theme_data->Name, $theme_data->Version ); ?></h1>
		<div class="about-text"><?php esc_html_e( 'WordPressLeaf是一个来自www.WordPressLeaf.com的新闻杂志风格的WordPress主题，可以通过一个完美的选项来创建任何杂志或者博客网站。', 'codilight-lite' ) ?></div>
		<a target="_blank" href="<?php echo esc_url('http://www.wordpressleaf.com'); ?>" class="famethemes-badge wp-badge"><span><?php _e( 'WordPressLeaf', 'codilight-lite' ); ?></span></a>
		<h2 class="nav-tab-wrapper">
			<a href="?page=ft_codilight_lite" class="nav-tab nav-tab-active"><?php echo $theme_data->Name; ?></a>
		</h2>

		<div class="theme_info">
			<div class="theme_info_column clearfix">
				<div class="theme_info_left">
					<div class="theme_link">
						<h3><?php esc_html_e( '主题定制器', 'codilight-lite' ); ?></h3>
						<p class="about"><?php printf(esc_html__('%s 支持主题定制器进行全部的主题设置。点击“开始自定义”开始自定义您的网站。', 'codilight-lite'), $theme_data->Name); ?></p>
						<p>
							<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary"><?php esc_html_e('开始自定义', 'codilight-lite'); ?></a>
						</p>
					</div>
					<div class="theme_link">
						<h3><?php esc_html_e( '主题文档', 'codilight-lite' ); ?></h3>
						<p class="about"><?php printf(esc_html__('安装和配置 %s 需要帮助？请看我们的文件说明。', 'codilight-lite'), $theme_data->Name); ?></p>
						<p>
							<a href="http://www.wordpressleaf.com" target="_blank" class="button button-secondary"><?php esc_html_e('在线文档', 'codilight-lite'); ?></a>
						</p>
					</div>
					<div class="theme_link">
						<h3><?php esc_html_e( '遇到困难, 需要帮助？', 'codilight-lite' ); ?></h3>
						<p class="about"><?php printf(esc_html__('%s WordPress主题是通过WordPressleaf.com获得免费主题支持。', 'codilight-lite'), $theme_data->Name); ?></p>
						<p>
							<a href="http://www.wordpressleaf.com" target="_blank" class="button button-secondary"><?php echo sprintf( esc_html('前往 %s 支持网站', 'codilight-lite'), $theme_data->Name); ?></a>
						</p>
					</div>
					<div class="theme_link">
						<h3><?php esc_html_e( 'Leaf主题高级设置', 'codilight-lite' ); ?></h3>
						<p class="about"><?php printf(esc_html__('%s 支持首页关键字、描述、谷歌字体、头像缓存等高级设置。点击“开始设置”来设置它们', 'codilight-lite'), $theme_data->Name); ?></p>
						<p>
							<a href="<?php echo esc_url( admin_url('themes.php?page=leaf_slug') ); ?>" class="button button-primary"><?php esc_html_e('开始设置', 'codilight-lite'); ?></a>
						</p>
					</div>
				</div>

				<div class="theme_info_right">
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php esc_attr_e( 'Theme Screenshot', 'codilight-lite' ); ?>" />
				</div>
			</div>
		</div>

	</div> <!-- END .theme_info -->

<?php
}
?>
