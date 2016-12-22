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
	<ul class="rrssb-buttons rrssb-1">
		<li class="rrssb-twitter" >
			<a rel="nofollow" href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-twitter"></i>
				</span>
				<span class="rrssb-text">Twitter</span>
			</a>
		</li>
		<li class="rrssb-facebook" >
			<a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-facebook-square"></i>
				</span>
				<span class="rrssb-text">Facebook</span>
			</a>
		</li>
		<li class="rrssb-googleplus">
			<a rel="nofollow" href="https://plus.google.com/share?url=<?php echo $url; ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-google-plus"></i>
				</span>
				<span class="rrssb-text">Google+</span>
			</a></li>
			<li class="rrssb-pinterest" >
				<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo $thumbnail; ?>&amp;description=<?php echo $desc; ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-pinterest"></i>
					</span>
					<span class="rrssb-text">Pinterest</span>
				</a>
			</li>
			<li class="rrssb-tumblr" >
				<a rel="nofollow" href="http://tumblr.com/share/link?url=<?php echo $url; ?>&amp;name=<?php echo $title; ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-tumblr"></i>
					</span>
					<span class="rrssb-text">Tumblr</span>
				</a>
			</li>
			<li class="rrssb-linkedin small" >
				<a rel="nofollow" href="http://www.linkedin.com/shareArticle?url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $desc; ?>&amp;mini=true" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-linkedin"></i>
					</span>
					<span class="rrssb-text">Linkedin</span>
				</a>
			</li>
			<li class="rrssb-reddit small" >
				<a rel="nofollow" href="http://www.reddit.com/submit?url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;text=<?php echo $desc; ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-reddit"></i>
					</span>
					<span class="rrssb-text">Reddit</span>
				</a>
			</li>
			<li class="rrssb-email small" >
				<a rel="nofollow" href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>">
					<span class="rrssb-icon">
						<i class="fa fa-envelope"></i>
					</span>
					<span class="rrssb-text">Email</span>
				</a>
			</li>
		</ul>
</div>

