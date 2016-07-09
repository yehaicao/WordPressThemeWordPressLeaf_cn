<div class="entry-author clear">
	<div class="entry-author-avatar">
		<a class="vcard" rel="nofollow" href="<?php echo esc_url(home_url('/donate') ); ?>">
			<img alt="捐赠本站" src="<?php echo get_template_directory_uri().'/assets/images/weixin.png'; ?>" srcset="" class="avatar avatar-90 photo" height="90" width="90">
		</a>
	</div>
	<div class="author-right">
		<div class="entry-author-byline clear">
		<a class="vcard" rel="nofollow" href="<?php echo esc_url(home_url('/donate') ); ?>"> 捐赠本站 </a>

			
			
    <?php  wp_nav_menu( array('theme_location'=> 'social_post',  
                              'container'       => 'div', //最外层容器标签名
                              'container_class' => 'menu', //最外层容器class名
                              'container_id'    => 'menu-social',//最外层容器id值
                              'menu_class'      => 'menu-items', //ul标签class
                              'menu_id'         => 'menu-social-items',//ul标签id
                              'link_before'     => '<span class="screen-reader-text">',//显示在导航链接名之后
                              'link_after'      => '</span>'//显示在导航链接名之前
                              )); 
     ?>
			
	</div>
	<div class="entry-author-bio">
		<p>如果您觉得这篇文章或者我分享的主题对你有帮助，请支持我继续更新网站和主题 ！您可以点击<a rel="nofollow" href="<?php echo esc_url(home_url('/donate') ); ?>">这里</a>捐赠，或者使用微信扫描左边的二维码进行捐赠。</p>
	</div>
</div>
</div>