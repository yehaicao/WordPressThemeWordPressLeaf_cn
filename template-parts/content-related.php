<div class="entry-related-articles">
	<h3>或许您还喜欢这些文章</h3>
		<div class="related-articles row clearfix">


			<?php
			global $post;
			$num=6;//输出6篇文章
			//$post_tags = wp_get_post_tags($post->ID);
			$post_tags = wp_get_post_tags($post->ID);
			if ($post_tags) {
				foreach ($post_tags as $tag) {
					// 获取标签列表
					$tag_list[] .= $tag->term_id;
				}

				// 随机获取标签列表中的一个标签
				$post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];

				// 该方法使用 query_posts() 函数来调用相关文章，以下是参数列表



				$custom_query_args = array(
				'tag__in' => array($post_tag),
				'post_status'         => 'publish',
				'category__not_in' => array(NULL),  // 不包括的分类ID
				'post__not_in' => array($post->ID),
				'showposts' => $num,                           // 显示相关文章数量
				'ignore_sticky_posts' => 1 ,
				'orderby'             => 'rand'
				);
				$custom_query = new WP_Query(  $custom_query_args  );








				$pnum = 0;
				$count = 0; //用来计算换行
				if ($custom_query->have_posts()) {
					while ($custom_query->have_posts()) {
						$custom_query->the_post(); $count++ ?>
						<article <?php post_class( 'col-md-4 col-sm-12' ); ?>>

							<div class="related-thumb">
								<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
									<?php
									if ( has_post_thumbnail( ) ) {
										the_post_thumbnail( 'codilight_lite_block_2_medium' );
									} else {
										echo '<img alt="'. esc_html( get_the_title() ) .'" src="'. esc_url( get_template_directory_uri() . '/assets/images/blank250_170.png' ) .'">';
									}
									?>
								</a>
								<?php
								$category = get_the_category();
								if ( $category[0] ) {
									echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
								}
								?>



							</div>
							<div class="entry-detail">
								<header class="entry-header">

									<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>


								</header>
							</div>
						</article>





						<?php
						$pnum =$pnum+1;//每输出一篇加一
					if ( $count % 3 == 0 ) {
						echo '</div>';
						echo '<div class="related-articles row clearfix">';
					} //判断是否是3的倍数，否则换行

					}//循环结束






				}//如果标签内没有文章

				//wp_reset_query();
				wp_reset_postdata(); // reset the query
			}//如果没有标签


			$i=$num-$pnum; //计算还需要输出了多少篇文章

			if ($i!=0){

				global $post;
				$cats = wp_get_post_categories($post->ID);
				if ($cats) {




					$custom_query_args = array(
					'category__in' => array( $cats[0] ),
					'post_status'         => 'publish',
					'post__not_in' => array( $post->ID ),
					'showposts' => $i,
					'ignore_sticky_posts' => 1,
					'orderby'             => 'rand'
					);
					$custom_query = new WP_Query(  $custom_query_args  );





					if ($custom_query->have_posts()) {
						while ($custom_query->have_posts()) {
							$custom_query->the_post(); $count++ ?>

							<article <?php post_class( 'col-md-4 col-sm-12' ); ?>>
								<div class="related-thumb">
									<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
										<?php
										if ( has_post_thumbnail( ) ) {
											the_post_thumbnail( 'codilight_lite_block_2_medium' );
										} else {
											echo '<img alt="'. esc_html( get_the_title() ) .'" src="'. esc_url( get_template_directory_uri() . '/assets/images/blank250_170.png' ) .'">';
										}
										?>
									</a>
									<?php
									$category = get_the_category();
									if ( $category[0] ) {
										echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
									}
									?>



								</div>
								<div class="entry-detail">
									<header class="entry-header">

										<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>


									</header>
								</div>
							</article>


							<?php
							if ( $count % 3 == 0 ) {
						    echo '</div>';
						    echo '<div class="related-articles row clearfix">';
				     	} //判断是否是3的倍数，否则换行
							
							
						}//循环结束
					}//如果分类里没有其他的问题

					//wp_reset_query();
					wp_reset_postdata(); // reset the query
				}//如果没有分类






			}//如果标签没有输出6篇文章，开始输出分类文章




			?>






		</div>
	</div>