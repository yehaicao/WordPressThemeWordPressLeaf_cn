<?php 
$url=urlencode(esc_url( get_permalink() )); 
$title=urlencode(get_the_title());
if ( has_post_thumbnail( ) ) {
    $thumbnail=urlencode(get_the_post_thumbnail_url($post->ID,'codilight_lite_single_medium'));
}else{
	  $thumbnail='';
}
$desc=urlencode(strip_tags(codilight_lite_excerpt(60)));
?>

<div class="entry-share">
	<ul class="cnrrssb-buttons cnrrssb-1">
		<li class="cnrrssb-weibo" >
			<a target="_blank" rel="nofollow" href="http://v.t.sina.com.cn/share/share.php?appkey=3036462609&url=<?php echo $url; ?>&title=<?php echo $title; ?>&pic=<?php echo $thumbnail; ?>&searchPic=true" class="popup">
				<span class="cnrrssb-icon">
					<i class="fa fa-weibo"></i>
				</span>
				<span class="cnrrssb-text">新浪微博</span>
			</a>
		</li>
		<li class="cnrrssb-qqstar"  >
			<a target="_blank" rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $url; ?>&title=<?php echo $title; ?>&desc=&summary=<?php echo $desc; ?>&pics=<?php echo $thumbnail;?>&site=" class="popup">
				<span class="cnrrssb-icon">
					<i class="fa fa-star"></i>
				</span>
				<span class="cnrrssb-text">QQ空间</span>
			</a>
		</li>
		<li class="cnrrssb-ttweibo">
			<a target="_blank" rel="nofollow" href="http://share.v.t.qq.com/index.php?c=share&a=index&title=<?php echo $title; ?>&url=<?php echo $url; ?>&appkey=801497376&pic=<?php echo $thumbnail; ?>&site=" class="popup">
				<span class="cnrrssb-icon">
					<i class="fa fa-tencent-weibo"></i>
				</span>
				<span class="cnrrssb-text">腾讯微博</span>
			</a></li>
			<li class="cnrrssb-qq" >
				<a target="_blank" rel="nofollow" href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo $url; ?>&title=<?php echo $title; ?>&desc=&summary=<?php echo $desc; ?>&pics=<?php echo $thumbnail; ?>&site=baidu">
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
				<a target="_blank" rel="nofollow" href="http://widget.renren.com/dialog/share?resourceUrl=<?php echo $url; ?>&srcUrl=<?php echo $url; ?>&title=<?php echo $title; ?>&pic=<?php echo $thumbnail;  ?>&description=<?php echo $desc; ?>" class="popup">
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
				<a target="_blank" rel="nofollow" href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>">
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