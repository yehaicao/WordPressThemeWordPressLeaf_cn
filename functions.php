<?php
/**
*  Leaf  functions and definitions.
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package Leaf , Codilight_Lite
*/

if ( ! function_exists( 'codilight_lite_setup' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/
function codilight_lite_setup() {
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on Codilight Lite, use a find and replace
	* to change 'codilight-lite' to the name of your theme in all the template files.
	*/
	load_theme_textdomain( 'codilight-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'codilight_lite_block_small', 90, 60, true ); // Archive List Posts
	add_image_size( 'codilight_lite_block_1_medium', 250, 170, true ); // Archive List Posts
	add_image_size( 'codilight_lite_block_2_medium', 325, 170, true ); // Archive Grid Posts
	add_image_size( 'codilight_lite_single_medium', 700, 350, true ); // Archive Grid Posts

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	'primary' => esc_html__( '主菜单', 'codilight-lite' ),
	'footer' => esc_html__( '底部菜单', 'codilight-lite' ),
	'social' => esc_html__( '社交菜单', 'codilight-lite' ),
	'social_post' => esc_html__( '文章关注菜单', 'codilight-lite' ),
	) );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'codilight_lite_custom_background_args', array(
	'default-color' => 'f9f9f9',
	'default-image' => '',
	) ) );

	/*
	* This theme styles the visual editor to resemble the theme style.
	*/
if (get_option('leaf_google') ){ 
	add_editor_style( 'assets/css/editor-style.css');
  }else{
  add_editor_style( array( 'assets/css/editor-style.css', codilight_lite_fonts_url() ) );
  }
}
endif; // codilight_lite_setup
add_action( 'after_setup_theme', 'codilight_lite_setup' );

/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*/
function codilight_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'codilight_lite_content_width', 700 );
}
add_action( 'after_setup_theme', 'codilight_lite_content_width', 0 );

/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function codilight_lite_widgets_init() {
	register_sidebar( array(
	'name'          => esc_html__( '默认侧边栏', 'codilight-lite' ),
	'id'            => 'sidebar-1',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );

	//Homepage Sidebar

	register_sidebar( array(
	'name'          => esc_html__( '首页侧边栏', 'codilight-lite' ),
	'id'            => 'widget_homesidebar',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );

	//Post Sidebar
	register_sidebar( array(
	'name'          => esc_html__( '文章侧边栏', 'codilight-lite' ),
	'id'            => 'widget_postsidebar',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );

	//Category Sidebar
	register_sidebar( array(
	'name'          => esc_html__( '分类侧边栏', 'codilight-lite' ),
	'id'            => 'widget_catesidebar',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );

	// Homepage Template
	register_sidebar( array(
	'name'          => esc_html__( '首页第一个位置', 'codilight-lite' ),
	'id'            => 'home-1',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
	'name'          => esc_html__( '首页第二个位置', 'codilight-lite' ),
	'id'            => 'home-2',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
	'name'          => esc_html__( '首页第三个位置', 'codilight-lite' ),
	'id'            => 'home-3',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
	'name'          => esc_html__( '首页第四个位置', 'codilight-lite' ),
	'id'            => 'home-4',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
	'name'          => esc_html__( '首页第五个位置', 'codilight-lite' ),
	'id'            => 'home-5',
	'description'   => '',
	'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title"><span>',
	'after_title'   => '</span></h2>',
	) );

}
add_action( 'widgets_init', 'codilight_lite_widgets_init' );

/**
* Enqueue scripts and styles.
*/
function codilight_lite_scripts() {

	// Styles
	if (!get_option('leaf_google') ){ 
	wp_enqueue_style( 'codilight-lite-google-fonts', codilight_lite_fonts_url(), array(), null );
  }
	wp_enqueue_style( 'codilight-lite-fontawesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), '4.4.0' );
	wp_enqueue_style( 'codilight-lite-style', get_stylesheet_uri() );

	wp_enqueue_style( 'codilight-lite-prettify', get_template_directory_uri() .'/assets/google-code-prettify/prettify.css', array(), '20160531' );


	// Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'codilight-lite-libs-js', get_template_directory_uri() . '/assets/js/libs.js', array(), '20120206', true );
	wp_enqueue_script( 'codilight-lite-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '20120206', true );
	wp_enqueue_script( 'codilight-lite-rrssb', get_template_directory_uri() . '/assets/js/rrssb.js', array(), '20160206',true);
	wp_enqueue_script( 'codilight-lite-cnrrssb', get_template_directory_uri() . '/assets/js/cnrrssb.js', array(), '20160606',true);
	wp_enqueue_script( 'codilight-lite-weixin', get_template_directory_uri() . '/assets/js/weixin.js', array(), '20160613',true);
	wp_enqueue_script( 'codilight-lite-prettify', get_template_directory_uri() . '/assets/google-code-prettify/prettify.js?', array(), '20120531');





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codilight_lite_scripts' );


if ( ! function_exists( 'codilight_lite_fonts_url' )  ) :
/**
* Register default Google fonts
*/
function codilight_lite_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by merriweather, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$merriweather = _x( 'on', 'Open Sans font: on or off', 'codilight-lite' );

	/* Translators: If there are characters in your language that are not
	* supported by Raleway, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$raleway = _x( 'on', 'Raleway font: on or off', 'codilight-lite' );

	if ( 'off' !== $raleway || 'off' !== $merriweather ) {
		$font_families = array();

		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:300,400,500,600';
		}

		if ( 'off' !== $merriweather ) {
			$font_families[] = 'Merriweather';
		}

		$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

if ( ! function_exists( 'codilight_lite_admin_scripts' ) ) :
/**
* Enqueue scripts for admin page only: Theme info page
*/
function codilight_lite_admin_scripts( $hook ) {
	if ( $hook === 'widgets.php' || $hook === 'appearance_page_ft_codilight_lite' || $hook === 'appearance_page_leaf_slug' ) {
		wp_enqueue_style('codilight-lite-admin-css', get_template_directory_uri() . '/assets/css/admin.css');
	}
}
endif;
add_action('admin_enqueue_scripts', 'codilight_lite_admin_scripts');


/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Custom functions that act independently of the theme templates.
*/
require get_template_directory() . '/inc/extras.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

/**
* Custom theme widgets.
*/
require get_template_directory() . '/inc/widgets/block_1_widget.php';
require get_template_directory() . '/inc/widgets/block_2_widget.php';
require get_template_directory() . '/inc/widgets/block_3_widget.php';
require get_template_directory() . '/inc/widgets/block_4_widget.php';
require get_template_directory() . '/inc/widgets/block_5_widget.php';
require get_template_directory() . '/inc/widgets/block_6_widget.php';
require get_template_directory() . '/inc/widgets/block_7_widget.php';
require get_template_directory() . '/inc/widgets/block_8_widget.php';
/**
* Add theme info page
*/
require get_template_directory() . '/inc/dashboard.php';


//使用自己的获取值函数
if (!function_exists('leaf_get_option')) :
function leaf_get_option($e){
		return stripslashes(get_option($e));
	}
endif;


/***
*WordPress Leaf汉化@添加编辑器快捷按钮
*/

if ( ! function_exists( 'my_quicktags' ) ) :
function my_quicktags() {
	wp_enqueue_script(
	'my_quicktags',
	get_stylesheet_directory_uri().'/assets/js/my_quicktags.js',
	array('quicktags')
	);
};
endif;
add_action('admin_print_scripts', 'my_quicktags');

/**
* WordPress Leaf汉化@添加面包屑导航
* http://www.wpdaxue.com/wordpress-add-a-breadcrumb.html
*/

if ( ! function_exists( 'cmp_breadcrumbs' ) ) :
function cmp_breadcrumbs() {
	$delimiter = '>'; // 分隔符
	$before = ''; // 在当前链接前插入
	//	$before = '<span class="current">'; // 在当前链接前插入

	$after = ''; // 在当前链接后插入
	//	$after = '</span>'; // 在当前链接后插入

	if ( !is_home() && !is_front_page() || is_paged() ) {
		//echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__( 'You are here:' , 'codilight-lite' );

		global $post;
		$homeLink = home_url('/');
		//echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( 'Home' , 'codilight-lite' ) . '</a> ' . $delimiter . ' ';
		echo  '<a itemprop="breadcrumb" href="' . $homeLink . '">' . __( '首页' , 'codilight-lite' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) { // 分类 存档
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0){
		$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
		echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
		}
		echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) { // 天 存档
		echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) { // 月 存档
		echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) { // 年 存档
		echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) { // 文章
		if ( get_post_type() != 'post' ) { // 自定义文章类型
		$post_type = get_post_type_object(get_post_type());
		$slug = $post_type->rewrite;
		echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
		echo $before . get_the_title() . $after;
		} else { // 文章 post
		$cat = get_the_category(); $cat = $cat[0];
		$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
		echo $before . get_the_title() . $after;
		}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
		$post_type = get_post_type_object(get_post_type());
		echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) { // 附件
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
		echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) { // 页面
		echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { // 父级页面
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		$page = get_page($parent_id);
		$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
		echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { // 搜索结果
		echo $before ;
		printf( __( '搜索结果: %s', 'codilight-lite' ),  get_search_query() );
		echo  $after;
		} elseif ( is_tag() ) { //标签 存档
		echo $before ;
		printf( __( '标签: %s', 'codilight-lite' ), single_tag_title( '', false ) );
		echo  $after;
		} elseif ( is_author() ) { // 作者存档
		global $author;
		$userdata = get_userdata($author);
		echo $before ;
		printf( __( '作者存档: %s', 'codilight-lite' ),  $userdata->display_name );
		echo  $after;
		} elseif ( is_404() ) { // 404 页面
		echo $before;
		_e( '页面没有找到 404 错误', 'codilight-lite' );
		echo  $after;
		}
		if ( get_query_var('paged') ) { // 分页
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
		echo sprintf( __( '( 第 %s 页 )', 'codilight-lite' ), get_query_var('paged') );
		}
		//echo '</div>';
		}
		}
endif;
		
		
		
/**
*恢复链接管理
*/

add_filter( 'pre_option_link_manager_enabled', '__return_true' );



		
/*@分页功能用在站点地图*/

if ( ! function_exists( 'pagination' ) ) :

function pagination($paged,$pages){
		// $paged 表示当前页
		//$pages 表示最大页

		if(empty($paged))$paged = 1;
		$prev = $paged - 1;
		$next = $paged + 1;
		$range = 2; // only edit this if you want to show more page-links
		$showitems = ($range * 2)+1;

		if(1 != $pages){
		echo '<div class="ft-paginate">';
		echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? '<a href="'.get_pagenum_link(1).'">最前</a>':'';
		echo ($paged > 1 && $showitems < $pages)? '<a href="'.get_pagenum_link($prev).'">上一页</a>':'';
		for ($i=1; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				echo ($paged == $i)? '<span class="current">'.$i.'</span>':'<a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a>';
			}
		}
		echo ($paged < $pages && $showitems < $pages) ? '<a href="'.get_pagenum_link($next).'">下一页</a>' :'';
		echo ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) ? '<a href="'.get_pagenum_link($pages).'">最后</a>':'';
		echo '</div>';
		}

		}
endif;
		
/*		
//国内谷歌字体虽然现在在大部分时间里都可以链接上，但也会出现无法访问的情况，导致网站打开慢，所以移除掉。*/
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
        wp_enqueue_style('open-sans','');
    }
endif;  

if (get_option('leaf_google') ){ 
add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
add_action('login_init', 'remove_wp_open_sans');
add_action('init','remove_wp_open_sans');
}




/*
*将缓存默认头像设置为本站的默认头像
*/
if (!function_exists('leaf_avatar_default')) :
function leaf_avatar_default(){ 
  return get_bloginfo('template_directory').'/assets/images/default.png';
}
endif;



/*
www.wordpressleaf.com评论头像缓存 
请在网站跟目录下建立名字为avatar的文件夹，
它的访问地址类似于：www.wordressleaf.com/avatar/
如果因为网络问题读取不到你的头像，它会随机从100张头像中选取一张。
*/



if (!function_exists('leaf_avatar')) :

function leaf_avatar($avatar) {
	$avatar = strtr($avatar, array('0.gravatar.com' => 'secure.gravatar.com','1.gravatar.com' => 'secure.gravatar.com','2.gravatar.com' => 'secure.gravatar.com','www.gravatar.com' => 'secure.gravatar.com'));
	$tmp = strpos($avatar, 'http');
	$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
	$tmp = strpos($g, 'avatar/') + 7;
	$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
	$w = get_bloginfo('wpurl');
  
  if (empty($f))$f='wwwwordpressleafcomdefault';
  
	$e = ABSPATH .'avatar/'. $f .'.png';

	$t = 1209600;
	if ( !is_file($e) || (time() - filemtime($e)) > $t )
	{
		$uri = 'http://secure.gravatar.com/avatar/' . $f . '?d=404';
		$headers = @get_headers($uri);
		if (preg_match("|200|", $headers[0])) {
			copy(htmlspecialchars_decode($g), $e);
		}
		else
		{
			copy(get_bloginfo('template_directory').'/assets/images/tx/'.strval(rand(1,100)).'.png', $e);
		}
	}

	else
	{
		if( empty($f))
		{
			$avatar = strtr($avatar, array($g => get_bloginfo('template_directory').'/assets/images/tx/'.strval(rand(1,100)).'.png'));
		}
		else
		{
			$avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
		}
	}
	if ( filesize($e) < 500 )
	copy(get_bloginfo('template_directory').'/assets/images/tx/'.strval(rand(1,100)).'.png', $e);
	return $avatar;
}
endif;


if (leaf_get_option('leaf_head_img')){
add_filter('get_avatar','leaf_avatar');
}



/**
*评论的时间显示方式‘xx以前’
**/

if (!function_exists('timeago')) :
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
endif;



/**
*标题分隔符修改成 “|”
*https://developer.wordpress.org/reference/hooks/document_title_separator/
*新的 WordPress 网页标题设置方法
*/

if (!function_exists('Bing_title_separator_to_line')) :
function Bing_title_separator_to_line(){
	     
        return '|';//自定义标题分隔符
}

endif;



if (leaf_get_option('leaf_sep')){
	
	//如果已经开启替换
add_filter( 'document_title_separator', 'Bing_title_separator_to_line' );
}







/**
*将首页替换成自己定义的标题
*新的 WordPress 网页标题设置方法
*/
if (!function_exists('Bing_pre_get_document_title')) :
function Bing_pre_get_document_title(){
	
	 if( is_home()||is_front_page() ) $title = leaf_get_option('leaf_title');
        return $title;//自定义标题内容
}
endif;
add_filter( 'pre_get_document_title', 'Bing_pre_get_document_title' );
	
	
//关键字
if (!function_exists('leaf_keywords')) :
function leaf_keywords() {
	global $s, $post;
	$keywords = '';
	if ( is_single() ) {
		if ( get_the_tags( $post->ID ) ) {
			foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
		}
		foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
		$keywords = substr_replace( $keywords , '' , -2);
	} elseif ( is_home()||is_front_page()  )    { $keywords = leaf_get_option('leaf_keywords');
	} elseif ( is_tag() )      { $keywords = single_tag_title('', false);
	} elseif ( is_category() ) { $keywords = single_cat_title('', false);
	} elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
	} else { $keywords = trim( wp_title('', false) );
	}
	if ( $keywords ) {
		echo "<meta name=\"keywords\" content=\"$keywords\">\n";
	}
}
endif;



//关键字
add_action('wp_head','leaf_keywords');   



//页面描述

if (!function_exists('leaf_description')) :
function leaf_description() {
	global $s, $post,$title;
	$description = '';
	$blog_name = get_bloginfo('name');

	
	if ( is_single()) {
				
		$description=strip_tags(codilight_lite_excerpt(80));
		
		if ( !( $description ) ) $description = $blog_name . "|" . trim( wp_title('', false) );
		
		
	} elseif ( is_home()||is_front_page()  )    { $description = leaf_get_option('leaf_description'); // 首頁要自己加
	} elseif ( is_tag() )      { $description = $blog_name.':关于标签' . "'" . single_tag_title('', false) . "'的相关文章列表";
	} elseif ( is_category() ) { $description = trim(strip_tags(category_description()))?trim(strip_tags(category_description())):$blog_name.':关于分类' . "'" . single_cat_title('', false) . "'的相关文章列表";
	} elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
	} elseif ( is_search() )   { $description = $blog_name . ": '关于" . esc_html( $s, 1 ) . "' 的搜索結果";
		} else { 
			$description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
			
			
		}
		$description = mb_substr( $description, 0, 160, 'utf-8' );
		
		echo "<meta name=\"description\" content=\"$description\">\n";
		}
endif;		

//页面描述 
add_action('wp_head','leaf_description'); 







/*加载高级设置菜单，对SEO、头像缓存等功能进行设置。*/	
require get_template_directory() . '/inc/leaf-option.php';




/*出站链接加上nofollow,站内的url跳转链接也加上nofollow*/

if (leaf_get_option('leaf_nofollow')){
add_filter( 'the_content', 'cn_nf_url_parse_one');
}

if (!function_exists('cn_nf_url_parse_one')) :
function cn_nf_url_parse_one( $content ) {
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
		if( !empty($matches) ) {
			$srcUrl = get_option('siteurl');

			$srcUrlgo = get_option('siteurl').'/url/';
			for ($i=0; $i < count($matches); $i++)
			{
				$tag = $matches[$i][0];
				$tag2 = $matches[$i][0];
				$url = $matches[$i][0];
				$noFollow = '';
				$pattern = '/target\s*=\s*"\s*_blank\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
				$noFollow .= ' target="_blank" ';
				$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
				$noFollow .= ' rel="nofollow" ';

				//对大小写不敏感
				$pos = stripos($url,$srcUrl);
				$posgo = stripos($url,$srcUrlgo);
				if ( $pos === false || $posgo==true) {
					$tag = rtrim ($tag,'>');
					$tag .= $noFollow.'>';
					$content = str_replace($tag2,$tag,$content);
				}


			}
		}
	}
	$content = str_replace(']]>', ']]>', $content);
	return $content;
}
endif;


//移除自动保存和修订版本

add_action('wp_print_scripts','leaf_disable_autosave' );
remove_action('pre_post_update','wp_save_post_revision' );
//移除自动保存
function leaf_disable_autosave() {
  wp_deregister_script('autosave');
}


//阻止站内文章Pingback 

add_action('pre_ping','leaf_noself_ping');  

function leaf_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}


// 同时删除head和feed中的WP版本号
function leaf_remove_wp_version() {
  return '';
}
add_filter('the_generator', 'leaf_remove_wp_version');

// 隐藏js/css附加的WP版本号
function leaf_remove_wp_version_strings( $src ) {
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
    // 用WP版本号 + 7.6来替代js/css附加的版本号
    // 既隐藏了WordPress版本号，也不会影响缓存
    $src = str_replace($wp_version, $wp_version + 7.6, $src);
  }
  return $src;
}
add_filter( 'script_loader_src', 'leaf_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'leaf_remove_wp_version_strings' );

/**
 * Disable the emoji's 禁止emoji表情，适用于4.2版以上版本
 */
 function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 }
 add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 */
 function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
 }
 
 
//wordpress 4.4 禁用REST API/移除wp-json链接的方法
//1.禁用REST API
 
add_filter('rest_enabled', '_return_false'); 
add_filter('rest_jsonp_enabled', '_return_false');
//2.移除wp-json链接
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );



//增加下载和演示短代码。包括网盘下载、github下载、本地下载、演示。你可以方便的在后台使用。
//短代码支持参数传递，href：地址，leaf：图标，内容。图标请用字体图标中的名字。
function  demo_function($atts, $content = null) {
  extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'leaf',
	   ),$atts));
	
	
	$content = trim($content) ? trim($content) : '演示';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'leaf';
	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}


function  download_local_function($atts, $content = null) {
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'cloud-download',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : '本地';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'cloud-download';

	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}


function  download_baidu_function($atts, $content = null) {
	
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'paw',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : '网盘';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'paw';	

	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}
	
function  download_github_function($atts, $content = null) {
	
	extract(shortcode_atts(array(
	   'href' => 'http://www.wordpressleaf.com',
	   'leaf' => 'github',
	   ),$atts));
	
	$content = trim($content) ? trim($content) : 'github';
	$href = trim($href) ? trim($href) :  'http://www.wordpressleaf.com';
  $leaf = trim($leaf) ? trim($leaf) :  'github';	
	
	$return_string='<a rel="nofollow" target="_blank" class="leafdl" href="'.$href.'"><i class="fa fa-'.$leaf.'"></i>  '.$content.'</a>';
	
	return $return_string;
	}	
	
	
function	register_shortcodes() {
	   add_shortcode ('download_baidu' ,'download_baidu_function');
	   add_shortcode ('download_github' ,'download_github_function');
	   add_shortcode ('download_local' ,'download_local_function');
	   add_shortcode ('leaf_demo' ,'demo_function');
	   
	}
	
add_action('init','register_shortcodes');


//保护后台登录，除了这个地址其他的都不能登陆: http://www.wordpressleaf.com/wp-login.php?love=wordpress，请使用私人的代码，并牢牢记住。
if (leaf_get_option('leaf_admin')){
add_action('login_enqueue_scripts','login_protection');  
}
function login_protection(){  
	  
	  $leaf_admin_addr = trim(leaf_get_option('leaf_admin_addr')) ? trim(leaf_get_option('leaf_admin_addr')) : 'wordpressleaf';
	  
    if($_GET['love'] != $leaf_admin_addr)header('Location: '.home_url('/'));  
}

//改变标签云的数量等参数
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
	$newargs = array(
		'number'      => 20,     //显示个数
		'orderby'     => 'count',//排序字段，可以是name或count
		'order'       => 'ASC', //升序或降序，ASC或DESC
		'exclude'     => null,   //结果中排除某些标签
		'include'     => null,  //结果中只包含这些标签
	);
	$return = array_merge( $args, $newargs);
	return $return;
}





