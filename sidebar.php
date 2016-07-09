<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Codilight_Lite
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>


		

		
<div id="secondary" class="widget-area sidebar" role="complementary">		
		
<?php 
//if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-1')) : endif; 

if (is_single() && is_active_sidebar( 'widget_postsidebar' )){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')) : endif; 
}
else if (is_category() && is_active_sidebar( 'widget_catesidebar' )){
	
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_catesidebar')) : endif; 
  
}
else if (is_home()||is_front_page() && is_active_sidebar( 'widget_homesidebar' )){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_homesidebar')) : endif; 
}
else {
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-1')) : endif; 
}
?>		
</div><!-- #secondary -->		

