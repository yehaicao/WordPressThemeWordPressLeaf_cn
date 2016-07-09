<?php
$options = array('leaf_copy_right','leaf_keywords','leaf_description','leaf_head_img','leaf_title','leaf_sep','leaf_google','leaf_nofollow','leaf_admin','leaf_admin_addr');
foreach ($options as $value) { 
$option = trim(leaf_get_option($value));//获取选项   
if( $option == '' ){   
    //设置默认数据 
    if ($value == 'leaf_copy_right') update_option($value, '');//更新选项   
    if ($value == 'leaf_keywords') update_option($value, '');
    if ($value == 'leaf_description') update_option($value, '');
    if ($value == 'leaf_head_img') update_option($value, '0');
    if ($value == 'leaf_title') update_option($value, '');
    if ($value == 'leaf_sep') update_option($value, '0'); 
    if ($value == 'leaf_google') update_option($value, '0');     
    if ($value == 'leaf_nofollow') update_option($value, '0'); 
    if ($value == 'leaf_admin') update_option($value, '0'); 
    if ($value == 'leaf_admin_addr') update_option($value, 'wordpressleaf'); 
    
}
 
if(isset($_POST['option_save'])){   
    //处理数据   
    update_option($value, stripslashes($_POST[$value]));//更新选项   
}   
}  

function leafoption_function(){   
	  $theme_data = wp_get_theme();
    add_theme_page(sprintf( esc_html__( '%s 主题高级设置', 'codilight-lite' ), $theme_data->Name ), sprintf( esc_html__('%s高级设置', 'codilight-lite'), $theme_data->Name), 'edit_theme_options', 'leaf_slug','display_function');   
}
add_action('admin_menu', 'leafoption_function');

function display_function(){ 
	
	$theme_data = wp_get_theme(); 
	
	ob_start();
	
	?>  
	
	
		<div class="wrap about-wrap theme_info_wrapper">
		<h1><?php printf(esc_html__('欢迎使用 %1s - Version %2s', 'codilight-lite'), $theme_data->Name, $theme_data->Version ); ?></h1>
		<div class="about-text"><?php esc_html_e( 'WordPressLeaf主题是来自www.WordPressLeaf.com的一个杂志风格的主题。它是在Codilight Lite主题的基础上，结合国内的实际使用情况汉化加强而来。在高级设置页，你可以对首页关键字、描述、谷歌字体、头像缓存等进行设置。', 'codilight-lite' ) ?></div>
		<a target="_blank" href="<?php echo esc_url('http://www.wordpressleaf.com'); ?>" class="famethemes-badge wp-badge"><span><?php _e( 'WordPressLeaf', 'codilight-lite' ); ?></span></a>
		<h2 class="nav-tab-wrapper">
			<a href="?page=leaf_slug" class="nav-tab nav-tab-active"><?php echo $theme_data->Name.'主题高级设置'; ?></a>
		</h2>
		
		
		

  
  
  	<div class="theme_info">
		<div class="theme_info_column clearfix">
    <form method="post" name="leaf_form" id="leaf_form">   

    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('首页标题', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('如果要对首页设置特别的标题，请在此设置。例如：“WordPress Leaf | WordPress主题免费下载 | WordPress主题汉化 | WordPress主题开发 | WordPress主题安装”。请输入文字。 ', 'codilight-lite'); ?></p>
		<label>   
    <input name="leaf_title" size="100" value="<?php echo leaf_get_option('leaf_title'); ?>"/>   
     
    </label>  
    </div>
    </div>


    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('首页关键字', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('对首页关键字keywords标签进行定义。请输入文字，用“,” 隔开。例如：“Leaf主题,www.WordPressLeaf.com” ', 'codilight-lite'); ?></p>
		<label>   
    <input name="leaf_keywords" size="100" value="<?php echo leaf_get_option('leaf_keywords'); ?>"/>   
     
    </label>  
    </div>
    </div>



    
     
    <div class="">
    <div class="theme_info">
    <h3><?php esc_html_e('首页描述', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('对首页描述description标签进行定义。例如：“你可以在www.WordPressLeaf.com下载本主题。”。请输入文字。 ', 'codilight-lite'); ?></p>
		<label>   
    <input name="leaf_description" size="100" value="<?php echo leaf_get_option('leaf_description'); ?>"/>   
     
    </label>  
    </div>
    </div>
    

    
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('头像缓存', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('打勾表示开启。注意：请先在网站根目录下建立名为“avatar”的文件夹，例如“www.wordpressleaf.com/avatar/”。重要：在某些老的站点，更换Leaf主题开启头像缓存时，由于需要缓存的头像太多，可能会导致服务器卡死。', 'codilight-lite'); ?></p>
		<label>   
    
     <input type="checkbox" id="leaf_head_img" name="leaf_head_img" value="1" <?php if(leaf_get_option('leaf_head_img')) echo 'checked="checked"' ?>>
     <?php  
     esc_html_e('开启头像缓存。目前','codilight-lite')  ; 
     leaf_get_option('leaf_head_img')?esc_html_e('已开启。','codilight-lite'):esc_html_e('未开启。','codilight-lite'); 
     
     ?>
     
    </label>  
    </div>
    </div>
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('标题连接符替换', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('打勾表示将标题连接符由“-”替换为“|”。', 'codilight-lite'); ?></p>
		<label>   
    
     <input type="checkbox" id="leaf_sep" name="leaf_sep" value="1" <?php if(leaf_get_option('leaf_sep')) echo 'checked="checked"' ?>>
     <?php  
     esc_html_e('开启连接符替换。目前','codilight-lite')  ; 
     leaf_get_option('leaf_sep')?esc_html_e('已开启。','codilight-lite'):esc_html_e('未开启。','codilight-lite'); 
     
     ?>
     
    </label>  
    </div>
    </div>
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('谷歌字体', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('打勾表示将移除谷歌字体。', 'codilight-lite'); ?></p>
		<label>   
    
     <input type="checkbox" id="leaf_google" name="leaf_google" value="1" <?php if(leaf_get_option('leaf_google')) echo 'checked="checked"' ?>>
     <?php  
     esc_html_e('开启移除谷歌字体。目前','codilight-lite')  ; 
     leaf_get_option('leaf_google')?esc_html_e('已开启。','codilight-lite'):esc_html_e('未开启。','codilight-lite'); 
     
     ?>
     
    </label>  
    </div>
    </div>
    
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('文章内出站链接nofollow', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('打勾表示将文章内出站链接加上nofollow。这样做的目的是阻止权重流逝。', 'codilight-lite'); ?></p>
		<label>   
    
     <input type="checkbox" id="leaf_nofollow" name="leaf_nofollow" value="1" <?php if(leaf_get_option('leaf_nofollow')) echo 'checked="checked"' ?>>
     <?php  
     esc_html_e('开启nofollow。目前','codilight-lite')  ; 
     leaf_get_option('leaf_nofollow')?esc_html_e('已开启。','codilight-lite'):esc_html_e('未开启。','codilight-lite'); 
     
     ?>
     
    </label>  
    </div>
    </div>
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('后台登录地址隐藏', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('打勾表示将后台登录地址替换为：“http://yoursite/wp-login.php?love=wordpressleaf”。这样做的目的是防止有人恶意登录。', 'codilight-lite'); ?></p>
		<label>   
    
     <input type="checkbox" id="leaf_admin" name="leaf_admin" value="1" <?php if(leaf_get_option('leaf_admin')) echo 'checked="checked"' ?>>
     <?php  
     esc_html_e('开启后台地址隐藏。目前','codilight-lite')  ; 
     leaf_get_option('leaf_admin')?esc_html_e('已开启。','codilight-lite'):esc_html_e('未开启。','codilight-lite'); 
     
     ?>
    <p class="about"><?php esc_html_e('你可以修改链接的参数来提高安全性，例如：“wordpressleaf”。如果您不输入，那么开启后，默认后台登录地址为：“http://yoursite/wp-login.php?love=wordpressleaf”。', 'codilight-lite'); ?></p>
    <label>   
    <input name="leaf_admin_addr" size="40" value="<?php echo leaf_get_option('leaf_admin_addr'); ?>"/>   
    

    </label> 
    <p class="about">
     <?php  
     esc_html_e('目前您的后台地址为：','codilight-lite')  ; 
     
     $leaf_admin_addr = trim(leaf_get_option('leaf_admin_addr')) ? trim(leaf_get_option('leaf_admin_addr')) : 'wordpress';
    
     $admin_addr = leaf_get_option('leaf_admin') ? home_url('/wp-login.php?love='.$leaf_admin_addr) : home_url('/wp-login.php') ;
    echo $admin_addr;
     ?>
    </p> 
     
    </label>  
    </div>
    </div>
    
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('友情链接联系信息', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('友情链接联系信息会显示在首页底部位置。请输入文字。例如：“联系邮箱admin@wordpressleaf.com”。', 'codilight-lite'); ?></p>
    <label>   
    <input name="leaf_copy_right" size="40" value="<?php echo leaf_get_option('leaf_copy_right'); ?>"/>   
      
    </label>   
   
    </div>
    </div>
    
    <div class="theme_info">
    <div class="theme_link">
    <h3><?php esc_html_e('默认更改信息', 'codilight-lite'); ?></h3>
		<p class="about"><?php esc_html_e('本主题默认移除了文章修订版本功能、阻止站内文章Pingback、移除了前台页面WordPress版本号、禁用REST API/移除wp-json链接、 禁止emoji表情。如果你需要这些功能，那么请在functions.php中调整。如果你需要帮助，请访问我们的网站www.WordPressLeaf.com。', 'codilight-lite'); ?></p>
   
    </div>
    </div>
    
    
    <div class="theme_link">
    <p class="submit">   
        <input type="submit" name="option_save" value="<?php _e('保存设置', 'codilight-lite'); ?>" class="button button-primary" />   
    </p> 
    </div>
       
    </form>  
    </div>
    </div>
    </div>
<?php
ob_end_flush();

}
?>