<div class="entry-share">
	<ul class="cnrrssb-buttons cnrrssb-1">
		<li class="cnrrssb-weibo" >
			<a target="_blank" rel="nofollow" href="http://v.t.sina.com.cn/share/share.php?appkey=3036462609&url=<?php echo esc_url( get_permalink() ); ?>&title=<?php the_title(); ?>&pic=<?php if ( has_post_thumbnail( ) ) { the_post_thumbnail_url('codilight_lite_single_medium' );} ?>&searchPic=true" class="popup" >
				<span class="cnrrssb-icon">
					<i class="fa fa-weibo"></i>
				</span>
				<span class="cnrrssb-text">新浪微博</span>
			</a>
		</li>
		<li class="cnrrssb-qqstar"  >
			<a target="_blank" rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php the_title(); ?>&desc=&summary=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>&pics=<?php if ( has_post_thumbnail( ) ) { echo esc_url( the_post_thumbnail_url('codilight_lite_single_medium' ));} ?>&site=" class="popup">
				<span class="cnrrssb-icon">
					<i class="fa fa-star"></i>
				</span>
				<span class="cnrrssb-text">QQ空间</span>
			</a>
		</li>
		<li class="cnrrssb-ttweibo">
			<a target="_blank" rel="nofollow" href="http://share.v.t.qq.com/index.php?c=share&a=index&title=<?php the_title(); ?>&url=<?php echo esc_url( get_permalink() ); ?>&appkey=801497376&pic=<?php if ( has_post_thumbnail( ) ) { echo esc_url( the_post_thumbnail_url('codilight_lite_single_medium' ));} ?>&site=" class="popup">
				<span class="cnrrssb-icon">
					<i class="fa fa-tencent-weibo"></i>
				</span>
				<span class="cnrrssb-text">腾讯微博</span>
			</a></li>
			<li class="cnrrssb-qq" >
				<a target="_blank" rel="nofollow" href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo esc_url( get_permalink() ); ?>&title=<?php the_title(); ?>&desc=&summary=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>&pics=<?php if ( has_post_thumbnail( ) ) { echo esc_url( the_post_thumbnail_url('codilight_lite_single_medium' ));} ?>&site=baidu">
					<span class="cnrrssb-icon">
						<i class="fa fa-qq"></i>
					</span>
					<span class="cnrrssb-text">QQ好友</span>
				</a>
			</li>
			<li class="cnrrssb-weixin" >
				<a target="_blank" rel="nofollow" class="jiathis_button_weixin" href="javascript:void(0);" onclick="js_method()">
					<span class="cnrrssb-icon">
						<i class="fa fa-weixin"></i>
					</span>
					<span class="cnrrssb-text">微信</span>
				</a>
			</li>
			<li class="cnrrssb-renren small" >
				<a target="_blank" rel="nofollow" href="http://widget.renren.com/dialog/share?resourceUrl=<?php echo esc_url( get_permalink() ); ?>&srcUrl=<?php echo esc_url( get_permalink() ); ?>&title=<?php the_title(); ?>&pic=<?php if ( has_post_thumbnail( ) ) { the_post_thumbnail_url('codilight_lite_single_medium' );} ?>&description=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>" class="popup">
					<span class="cnrrssb-icon">
						<i class="fa fa-renren"></i>
					</span>
					<span class="cnrrssb-text">人人网</span>
				</a>
			</li>
			<li class="cnrrssb-reddit small" >
				<a target="_blank" rel="nofollow" class="jiathis" href="javascript:void(0);" onclick="js_method()" title="更多">
					<span class="cnrrssb-icon">
						<i class="fa fa-share-alt"></i>
					</span>
					<span class="cnrrssb-text">更多</span>
				</a>
			</li>
			<li class="cnrrssb-email small" >
				<a target="_blank" rel="nofollow" href="mailto:?subject=<?php the_title(); ?>&body=<?php echo esc_url( get_permalink() ); ?>">
					<span class="cnrrssb-icon">
						<i class="fa fa-envelope"></i>
					</span>
					<span class="cnrrssb-text">Email</span>
				</a>
			</li>
		</ul>
</div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1" charset="utf-8"></script>
<!-- JiaThis Button END -->