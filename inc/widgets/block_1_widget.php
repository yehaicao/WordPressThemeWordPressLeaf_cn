<?php
/**
 * Block 1 - Slider Widget
 */

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Block1");'));

// The widget class
class Codilight_Lite_Widget_Block1 extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'block1_widget', 'description' => esc_html__( "首页上以列表或网格样式的显示文章。", 'codilight-lite') );
		parent::__construct('ft_block1', esc_html__('FT Block 1 - 最近的帖子', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_block1';

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
			$cache = wp_cache_get( 'widget_block1', 'widget' );
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
		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title']                             : '';
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$layout			     = ( ! empty( $instance['layout'] ) ) ? $instance['layout']                           : 'grid';
		$featured_categories = ( ! empty( $instance['featured_categories'] ) ) ? $instance['featured_categories'] : '';
		$ignore_sticky 		 = isset($instance['ignore_sticky']) ? $instance['ignore_sticky'] : 0;
		$orderby			 = ( ! empty( $instance['orderby'] ) ) ? $instance['orderby']                         : 'date';
		$number_posts        = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] ) : 6;
		if ( ! $number_posts ) $number_posts = 6;
//
		$custom_query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $number_posts,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => $ignore_sticky,
			'category__in'        => $featured_categories,
			'order'               => 'DESC',
			'orderby'             => $orderby,
		);
		$custom_query = new WP_Query( apply_filters( 'widget_block1_posts_args', $custom_query_args ) );
	
		
		$count        = 0;
		if ( $custom_query->have_posts() ) :

			echo $args['before_widget'];
			if ( $title ) echo $args['before_title'] . $title . $args['after_title'];

			if ( $layout == 'grid' ) :
				echo '<div class="block1 block1_grid">';
				echo '<div class="row">';
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					$count++;
					?>
					<article <?php post_class( 'col-md-6 col-sm-12' ); ?>>
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
					        $category = get_the_category();
					        if ( $category[0] ) {
					            echo '<a class="entry-category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
					        }
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
					<?php
					if ( $count % 2 == 0 ) {
						echo '</div>';
						echo '<div class="row">';
					}
					endwhile;
				echo '</div>';
				echo '</div>';
			else :
				echo '<div class="block1 block1_list">';
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
					get_template_part( 'template-parts/content-list' );
					endwhile;
				echo '</div>';
			endif;


      echo $args['after_widget'];
      
			wp_reset_postdata(); // reset the query

		endif;
		?>

		<?php
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_block1', $cache, 'widget' );
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
			'layout' 				=> '',
			'featured_categories' 	=> '',
			'number_posts' 			=> '',
			'orderby' 				=> '',
		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['ignore_sticky']       = isset($new_instance['ignore_sticky']) && $new_instance['ignore_sticky'] ? 1 : 0;
		$instance['layout']              = sanitize_text_field( $new_instance['layout'] );
		$instance['featured_categories'] = isset( $new_instance['featured_categories'] ) ?  array_map( 'absint', ( array) $new_instance['featured_categories'] ) : false ;
		$instance['number_posts']        = absint( $new_instance['number_posts'] );
		$instance['orderby'] 		     = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}

	/**
	 * @access public
	 */
	public function remove_cache() {
		wp_cache_delete('widget_block1', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {

		// Set default value.
		$defaults = array(
			'title'               => '',
			'layout'			  => 'grid',
			'featured_categories' => '',
			'ignore_sticky'		  => 0,
			'number_posts'        => 6,
			'orderby'             => 'date'
		);
		$instance            = wp_parse_args( (array) $instance, $defaults );
		$featured_categories = (array)$instance['featured_categories'];
		$orderby 	         = array( 'date', 'comment_count', 'rand' );
		$layout              = array( 'list', 'grid' );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小工具标题：', 'codilight-lite') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php esc_html_e('文章分块布局：', 'codilight-lite') ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'layout' );?>" id="<?php echo $this->get_field_id( 'layout' );?>">
				<?php for ( $i = 0; $i <= 1; $i++ ){ ?>
					<option value="<?php echo $layout[$i]; ?>" <?php echo ($layout[$i] == $instance['layout']) ? 'selected="selected" ' : '';?>><?php echo $layout[$i]; ?></option>
				<?php } ?>
			</select>
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
