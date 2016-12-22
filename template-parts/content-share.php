<div class="entry-share">
	<ul class="rrssb-buttons rrssb-1">
		<li class="rrssb-twitter" >
			<a rel="nofollow" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&amp;url=<?php echo esc_url( get_permalink() ); ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-twitter"></i>
				</span>
				<span class="rrssb-text">Twitter</span>
			</a>
		</li>
		<li class="rrssb-facebook" >
			<a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-facebook-square"></i>
				</span>
				<span class="rrssb-text">Facebook</span>
			</a>
		</li>
		<li class="rrssb-googleplus">
			<a rel="nofollow" href="https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>" class="popup">
				<span class="rrssb-icon">
					<i class="fa fa-google-plus"></i>
				</span>
				<span class="rrssb-text">Google+</span>
			</a></li>
			<li class="rrssb-pinterest" >
				<a rel="nofollow" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&amp;media=<?php if ( has_post_thumbnail( ) ) { the_post_thumbnail_url('codilight_lite_single_medium' );} ?>&amp;description=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-pinterest"></i>
					</span>
					<span class="rrssb-text">Pinterest</span>
				</a>
			</li>
			<li class="rrssb-tumblr" >
				<a rel="nofollow" href="http://tumblr.com/share/link?url=<?php echo esc_url( get_permalink() ); ?>&amp;name=<?php the_title(); ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-tumblr"></i>
					</span>
					<span class="rrssb-text">Tumblr</span>
				</a>
			</li>
			<li class="rrssb-linkedin small" >
				<a rel="nofollow" href="http://www.linkedin.com/shareArticle?url=<?php echo esc_url( get_permalink() ); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>&amp;mini=true" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-linkedin"></i>
					</span>
					<span class="rrssb-text">Linkedin</span>
				</a>
			</li>
			<li class="rrssb-reddit small" >
				<a rel="nofollow" href="http://www.reddit.com/submit?url=<?php echo esc_url( get_permalink() ); ?>&amp;title=<?php the_title(); ?>&amp;text=<?php echo strip_tags(codilight_lite_excerpt(60)); ?>" class="popup">
					<span class="rrssb-icon">
						<i class="fa fa-reddit"></i>
					</span>
					<span class="rrssb-text">Reddit</span>
				</a>
			</li>
			<li class="rrssb-email small" >
				<a rel="nofollow" href="mailto:?subject=<?php the_title(); ?>&body=<?php echo esc_url( get_permalink() ); ?>">
					<span class="rrssb-icon">
						<i class="fa fa-envelope"></i>
					</span>
					<span class="rrssb-text">Email</span>
				</a>
			</li>
		</ul>
</div>

