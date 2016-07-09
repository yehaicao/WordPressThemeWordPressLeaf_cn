<?php
/**
* Notice - Slider Widget
* www.wordpressleaf.com
*/

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Notice");'));

// The widget class
class Codilight_Lite_Widget_Notice extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'notice_widget', 'description' => esc_html__( "显示自己的公告消息。WordPressLeaf出品。www.wordpressleaf.com.", 'codilight-lite') );
		parent::__construct('ft_notice', esc_html__('FT 公告 - WordPressLeaf出品', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_notice';

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
		$cache = wp_cache_get( 'widget_notice', 'widget' );
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
		$more           = trim($instance['more']);
		$link           = esc_url($instance['link']);
    $notice           = trim(strip_tags($instance['notice']));

		
		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
		?>




		

    
    <div class="sidebar-notice">
    	
      <?php  if ($more) {   ?>		
    <div class="notice-title">
    	<a rel="nofollow" href="<?php echo $link; ?>" title="<?php echo $more; ?>">
    	<div  class="title">
    		<i class="fa fa-volume-up"></i>
    	
    		<?php echo $more; ?>
    		
    		
       </div>
       </a>
    </div>
    
    
  <?php 
      }
  
  if ($notice) {   ?>	
  	
  	
  	
    <div class="notice-content">
    		
    	<div class="muted">
    		<i class="fa fa-thumb-tack"></i>
    		<?php echo $notice; ?>
    	</div>

    	
    </div>
    
     <?php }?>	
    
    </div>
		

		
		<?php
		echo $args['after_widget'];




		if ( ! $this->is_preview() ) {
		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_notice', $cache, 'widget' );
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
		'title' 				=> ''	,
		'more'          =>'',
		'link'          =>'',
    'notice'        =>'',
		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['more']           = $new_instance['more'];
		$instance['link']           = esc_url($new_instance['link']);
		$instance['notice']         = strip_tags($new_instance['notice']);

		return $instance;
		}

		/**
		* @access public
		*/
		public function remove_cache() {
		wp_cache_delete('widget_notice', 'widget');
		}

		/**
		* @param array $instance
		*/
		public function form( $instance ) {

		// Set default value.
		$defaults = array(
		'title'               => '',
		'more'           =>'',
		'link'         =>'',
		'notice'      =>'',
     );
		

		
		$instance            = wp_parse_args( (array) $instance, $defaults );


		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小部件标题：', 'codilight-lite') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label>
				公告标题：
				<input style="width:100%;" id="<?php echo $this->get_field_id('more'); ?>" name="<?php echo $this->get_field_name('more'); ?>" type="text" value="<?php echo $instance['more']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				公告链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				公告内容：
				<textarea style="width:100%;" id="<?php echo $this->get_field_id('notice'); ?>" name="<?php echo $this->get_field_name('notice'); ?>" class="widfat"  cols="50" rows="10" /><?php echo $instance['notice']; ?></textarea>
			</label>
		</p>




		<?php
		}
		}



