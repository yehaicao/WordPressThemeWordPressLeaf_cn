<?php
/**
 * Block 2 : Advanded Post Widgets
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Block_3");'));

// The widget class
class Codilight_Lite_Widget_Block_3 extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'block3_widget', 'description' => esc_html__( "根据文章分类显示文章列表。", 'codilight-lite') );
		parent::__construct('ft_block3', esc_html__('FT Block 3', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_block3';

		add_action( 'save_post', array($this, 'remove_cache') );
		add_action( 'deleted_post', array($this, 'remove_cache') );
		add_action( 'switch_theme', array($this, 'remove_cache') );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		//extract( $args );
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_block3', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		ob_start();

		// Get values from the widget settings.
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$block_category      = ( ! empty( $instance['block_category'] ) ) ? $instance['block_category'] : '';
		$ignore_sticky 		 = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 1;
		$orderby			 = ( ! empty( $instance['orderby'] ) ) ? $instance['orderby'] : 'date';
		$number_posts        = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 4;
		if ( ! $number_posts ) $number_posts = 4;

		$r = new WP_Query( apply_filters( 'widget_block3_posts_args', array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts,
			'category__in'        => $block_category,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'orderby'             => $orderby,
			'ignore_sticky_posts' => $ignore_sticky,
		) ) );

		if ($r->have_posts()) : ?>
		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			if ( $block_category ) {
				echo $args['before_title'];
	            ?>
	            <a href="<?php echo esc_url( get_category_link( $block_category ) ); ?>"><?php echo esc_attr(get_cat_name( $block_category ) ); ?></a>
	            <?php
	            echo $args['after_title'];
			}
		}
		
		$ct        = 0;
		?>

		<div class="block3_widget_content">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			
			<?php if ($ct==0){ ?>
			<article class="block-item-large">
					    <div class="entry-thumb">
					        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
								<?php
								if ( has_post_thumbnail( ) ) {
									the_post_thumbnail( 'codilight_lite_block_2_medium' );
								} else {
									echo '<img alt="'. esc_html( get_the_title() ) .'" src="'. esc_url( get_template_directory_uri() . '/assets/images/blank325_170.png' ) .'">';
								}
								?>
							</a>
							<?php
					       /* $category = get_the_category();
					        if ( $category[0] ) {
					            echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
					        }*/
					        ?>
					    </div>
					    <div class="entry-detail">
					        <header class="entry-header">
					    		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					    		<?php if ( 'post' === get_post_type() ) codilight_lite_meta_1();?>
					    	</header><!-- .entry-header -->

					    	<div class="entry-excerpt">
					    		<?php echo codilight_lite_excerpt(60); ?>
					    	</div><!-- .entry-content -->
					    </div>
					</article><!-- #post-## -->
					
					<?php 	$ct++;}else{ ?>

			<article class="block-item">
				<div class="block-thumb">
					<a href="<?php the_permalink(); ?>">
						<?php //the_post_thumbnail( 'codilight_lite_block_small' ); ?>
                        <?php
            			if ( has_post_thumbnail( ) ) {
            				the_post_thumbnail( 'codilight_lite_block_small' );
            			} else {
            				echo '<img alt="'. esc_html( get_the_title() ) .'" src="'. esc_url( get_template_directory_uri() . '/assets/images/blank90_60.png' ) .'">';
            			}
            			?>
					</a>
				</div>
				<div class="block-content">
					<h2 class="h5 block-title">
						<a href="<?php the_permalink(); ?>">
							<?php get_the_title() ? the_title() : the_ID(); ?>
						</a>
					</h2>
					<div class="block-meta">
                        <span class="entry-date">
                            <?php echo sprintf( '<time class="entry-date published" datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
                        </span>
                    </div>
				</div>
			</article>

			<?php  } endwhile; ?>
		</div> <!-- .block2_widget_content -->


		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_block3', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$this->remove_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) ) delete_option('widget_recent_entries');

		$new_instance = wp_parse_args( $new_instance, array(
			'title' 				=> '',
			'ignore_sticky' 		=> '',
			'block_category' 	=> '',
			'number_posts' 			=> '',
			'orderby' 				=> '',
		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['block_category']      = absint( $new_instance['block_category'] );
		$instance['number_posts']        = absint( $new_instance['number_posts'] );
		$instance['orderby'] 		     = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_block3', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title'               => '',
			'block_category'      => '',
			'ignore_sticky'		  => 1,
			'number_posts'        => 4,
			'orderby'             => 'date'
		);
		$instance        = wp_parse_args( (array) $instance, $defaults );
		$block_category  = $instance['block_category'];
        $list_categories = get_categories();
		$orderby         = array('date', 'comment_count', 'rand');
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小工具标题：', 'codilight-lite') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'block_category' ); ?>"><?php esc_html_e('区块分类', 'codilight-lite') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'block_category' );?>" id="<?php echo $this->get_field_id( 'block_category' );?>">
				<?php foreach ( $list_categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo ( $category->term_id == $block_category ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e('显示文章数量：', 'codilight-lite') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" value="<?php echo $instance['number_posts']; ?>" />
		</p>
		<p>
		   <input id="<?php echo $this->get_field_id('ignore_sticky'); ?>" name="<?php echo $this->get_field_name('ignore_sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['ignore_sticky']); ?>/>
		   <label for="<?php echo $this->get_field_id('ignore_sticky'); ?>"><?php esc_html_e('忽略置顶帖', 'codilight-lite') ?></label>
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('排序：', 'codilight-lite') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'orderby' );?>" id="<?php echo $this->get_field_id( 'orderby' );?>">
				<?php for ( $i = 0; $i <= 2; $i++ ){ ?>
					<option value="<?php echo $orderby[$i]; ?>" <?php echo ($orderby[$i] == $instance['orderby']) ? 'selected="selected" ' : '';?>><?php echo $orderby[$i]; ?></option>
				<?php } ?>
			</select>
		</p>

<?php
	}
}
