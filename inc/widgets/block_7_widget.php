<?php
/**
* Comment - Slider Widget
*www.wordpressleaf.com
*/

// Register the widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Codilight_Lite_Widget_Comment");'));

// The widget class
class Codilight_Lite_Widget_Comment extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'comment_widget', 'description' => esc_html__( "显示网友最新评论（头像+名称+评论）放置在侧边栏上。WordPressLeaf出品。www.wordpressleaf.com.", 'codilight-lite') );
		parent::__construct('ft_comment', esc_html__('FT 评论 - WordPressLeaf出品', 'codilight-lite'), $widget_ops);
		$this->alt_option_name = 'widget_comment';

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
		$cache = wp_cache_get( 'widget_comment', 'widget' );
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
		$limit          = $instance['limit'];
		$outer          = $instance['outer'];
		$outpost        = $instance['outpost'];
		$more           = $instance['more'];
		$link           = esc_url($instance['link']);


		
		echo $args['before_widget'];
		//if ( $title ) echo $args['before_title'] . $title . $args['after_title'];
		?>
		<?php



		$mo='';
		if( $more!='' && $link!='' ) $mo='<a rel="nofollow" class="btn" href="'.$link.'">'.$more.'</a>';
		
		if ( $title ) echo $args['before_title'] .$mo.$title. $args['after_title'];
		

    
    echo '<div class="sidebar-comment leaf_comment">';
    
    echo mod_newcomments( $limit,$outpost,$outer );
    
    
    echo '</div>';
		
    ?>
		
		<?php
		echo $args['after_widget'];




		if ( ! $this->is_preview() ) {
		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_comment', $cache, 'widget' );
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
		'limit'         =>'',
		'outer'         =>'',
		'outpost'       =>'',
		'more'          =>'',
		'link'          =>'',

		) );

		$instance['title']               = sanitize_text_field( $new_instance['title'] );
		$instance['limit']          = $new_instance['limit'] ;
		$instance['outer']          = $new_instance['outer'];
		$instance['outpost']        = $new_instance['outpost'];
		$instance['more']           = $new_instance['more'];
		$instance['link']           = esc_url($new_instance['link']);

		return $instance;
		}

		/**
		* @access public
		*/
		public function remove_cache() {
		wp_cache_delete('widget_comment', 'widget');
		}

		/**
		* @param array $instance
		*/
		public function form( $instance ) {

		// Set default value.
		$defaults = array(
		'title'               => '',
		'limit'               =>'',
		'outer'           =>'',
		'outpost'           =>'',
		'more'           =>'',
		'link'         =>'',
     );
		

		
		$instance            = wp_parse_args( (array) $instance, $defaults );


		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('小部件标题：', 'codilight-lite') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
    <p>
			<label>
				显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某用户ID(注意请随便输入一个数字否则将没有评论展示)：
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outpost'); ?>" name="<?php echo $this->get_field_name('outpost'); ?>" type="text" value="<?php echo $instance['outpost']; ?>" />
			</label>
		</p>
		<p>
			<label>
				More 显示文字：
				<input style="width:100%;" id="<?php echo $this->get_field_id('more'); ?>" name="<?php echo $this->get_field_name('more'); ?>" type="text" value="<?php echo $instance['more']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				More 链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
			</label>
		</p>


		<?php
		}
		}


function mod_newcomments( $limit,$outpost,$outer ){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='".$outpost."' AND user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
	foreach ( $comments as $comment ) {
		
	  echo '<article class="block-item">';
		 echo '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.$comment->post_title.'上的评论">';
		  echo '<div class="block-thumb">'.get_avatar( $comment->comment_author_email, $size = '48' , leaf_avatar_default()).'</div>';


		  echo '<div class="block-content">';
		   echo '<div class="muted"><i>'.mb_substr(strip_tags($comment->comment_author),0,8).'</i>'.timeago( $comment->comment_date_gmt ).'说：'.str_replace(' src=', ' data-original=', convert_smilies(mb_substr(strip_tags($comment->com_excerpt),0,26).'...')).'</div>';
		   
	  	echo '</div>';
		 echo '</a>';
		echo '</article>';
		
		
		
		
  }
	

};
