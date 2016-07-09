<?php
/**
* social - Slider Widget
* www.wordpressleaf.com
*/

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Social");'));

// The widget class
class Codilight_Lite_Widget_Social extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'social_widget', 'description' => esc_html__( "在侧边栏上放置社交关注按钮。WordPressLeaf出品。www.wordpressleaf.com", 'codilight-lite') );
		parent::__construct('ft_social', esc_html__('FT 关注 - WordPressLeaf出品', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_social';

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
		$cache = wp_cache_get( 'widget_social', 'widget' );
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


		$title               = ( ! empty( $instance['title'] ) ) ? $instance['title']                             : '';
		$title               = apply_filters( 'widget_title', $title, $instance, $this->id_base );


		if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
		echo $args['before_widget'];
		?>

		<div class="sidebar-social">
			
			
    <?php  wp_nav_menu( array('theme_location'=> 'social',  
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
		

		
		<?php
		echo $args['after_widget'];




		if ( ! $this->is_preview() ) {
		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_social', $cache, 'widget' );
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
		'title' 				=> ''

		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );

		return $instance;
		}

		/**
		* @access public
		*/
		public function remove_cache() {
		wp_cache_delete('widget_social', 'widget');
		}

		/**
		* @param array $instance
		*/
		public function form( $instance ) {

		// Set default value.
		$defaults = array(
		'title'               => ''

		);
		$instance            = wp_parse_args( (array) $instance, $defaults );


		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小部件标题：', 'codilight-lite') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>



		<?php
		}
		}
