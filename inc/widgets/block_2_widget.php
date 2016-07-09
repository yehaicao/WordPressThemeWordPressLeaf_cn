<?php
/**
 * Block 1 - Slider Widget
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Block_2_Slider");'));

// The widget class
class Codilight_Lite_Widget_Block_2_Slider extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'block2_widget', 'description' => esc_html__( "首页上使用的滑动幻灯片小工具。", 'codilight-lite') );
		parent::__construct('ft_block2', esc_html__('FT Block 2 - 滑动幻灯片', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_block2';

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
			$cache = wp_cache_get( 'widget_block2', 'widget' );
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
		//wp_reset_postdata();
    //wp_reset_query();
		// Get values from the widget settings.
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$featured_categories = ( ! empty( $instance['featured_categories'] ) ) ? $instance['featured_categories'] : '';
		$ignore_sticky 		 = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 0;
		$orderby			 = ( ! empty( $instance['orderby'] ) ) ? $instance['orderby'] : 'comment_count';
		$number_posts        = ( !empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 5;
		if ( ! $number_posts ) $number_posts = 5;
		

     
	  $r = new WP_Query( apply_filters( 'widget_block2_posts_args', array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts,
			'category__in'        => $featured_categories,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'order' 			  => 'DESC',
			'meta_key'    		  => '_thumbnail_id',
			'orderby'             => $orderby,
			'post__in' => get_option('sticky_posts'),
			'ignore_sticky_posts' => $ignore_sticky
    ) ) );



		if ($r->have_posts()) : ?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		$slider_class = 'block_slider_'.uniqid();
		$slick_rtl = 'false';
		if ( is_rtl() ){
			$slick_rtl = 'true';
		}
		?>

		<div class="block2_widget_content block_slider1 <?php echo $slider_class; ?>">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<?php //if ( ! has_post_thumbnail() ) continue; ?>
			<article class="slider-item">
				<div class="slider-thumb">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'codilight_lite_single_medium' ); ?>
					</a>
				</div>
				<div class="slider-content">
					<span class="meta-category">
						<?php
						$category = get_the_category();
						if ( $category[0] ) {
							echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
						}
						?>
					</span>
					<h2 class="h3 slider-title">
						<a href="<?php the_permalink(); ?>">
							<?php get_the_title() ? the_title() : the_ID(); ?>
						</a>
					</h2>
					<div class="slider-meta"><?php codilight_lite_meta_1(); ?></div>
				</div>
			</article>
			<?php endwhile; ?>
		</div> <!-- .block_slider1 -->
		<script type="text/javascript">
			jQuery(document).ready(function(){
				"use strict";
				jQuery(".<?php echo $slider_class; ?>").slick({
					rtl: <?php echo $slick_rtl; ?>,
					slidesToShow: 1,
					slidesToScroll: 1,
					draggable: true,
					dots : true,
					arrows : false
				});
			});
		</script>

		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
    //wp_reset_query();
		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_block2', $cache, 'widget' );
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
			'featured_categories' 	=> '',
			'number_posts' 			=> '',
			'orderby' 				=> '',
		) );

		$instance['title']               = strip_tags( $new_instance['title'] );
		//$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) ? strip_tags($new_instance['ignore_sticky']) : 0;
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['featured_categories'] = $new_instance['featured_categories'];
		$instance['number_posts']        = $new_instance['number_posts'];
		$instance['orderby'] 		     = $new_instance['orderby'];

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_block2', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title'               => '',
			'featured_categories' => '',
			'ignore_sticky'		  => 0,
			'number_posts'        => 5,
			'orderby'             => 'comment_count'
		);
		$instance            = wp_parse_args( (array) $instance, $defaults );
		$featured_categories = (array)$instance['featured_categories'];
		$orderby         	 = array( 'date', 'comment_count', 'rand' );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小工具标题：', 'codilight-lite') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<?php $categories = get_categories(); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'featured_categories' ); ?>"><?php esc_html_e('多选分类（默认所有）：', 'codilight-lite') ?></label>
			<select class="widefat" multiple="multiple" name="<?php echo $this->get_field_name( 'featured_categories' );?>[]" id="<?php echo $this->get_field_id( 'featured_categories' );?>">
				<?php foreach ( $categories as $category ) { ?>
					<option value="<?php echo $category->term_id; ?>" <?php echo in_array( $category->term_id, $featured_categories ) ? 'selected="selected" ' : '';?>><?php echo $category->name . " (". $category->count . ")"; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php esc_html_e('显示文章数量：', 'codilight-lite') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' ); ?>" value="<?php echo $instance['number_posts']; ?>" />
			<small><?php echo esc_html_e( '这个窗口小工具只显示有特色图片的文章。', 'codilight-lite' ); ?></small>
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
		<p>
			<?php wp_kses( _e('<strong>如何设置：</strong>你可以访问<a target=\"_blank\" href=\"http://www.wordpressleaf.com/\">WordPress Leaf</a>来获取支持。', 'codilight-lite' ), array( 'strong' => array(), 'a' => array( 'href' => array() ) ) ); ?><br />
		</p>
<?php
	}
}
