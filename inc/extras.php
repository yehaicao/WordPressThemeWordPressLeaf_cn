<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Codilight_Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function codilight_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'codilight_lite_body_classes' );

if ( ! function_exists( 'codilight_lite_excerpt' ) ) :
/**
 * Get the except content limit by characters.
 *
 * @param string $characters
 * @return string
 */
function codilight_lite_excerpt( $characters ){
	//$characters = 70;
	 
	//获取文章摘要
	$excerpt = get_the_excerpt();
	//如果摘要小于10个字符 读取文章内容 
	if ((mb_strlen($excerpt,'utf-8') < 10)) $excerpt = get_the_content();
	
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = mb_substr($excerpt, 0, $characters);
	//$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = $excerpt.'...';
	return '<div class="ft-excerpt">'. $excerpt .'</div>';
}
endif;

if ( ! function_exists( 'codilight_lite_sidebar_position' ) ) :
/**
 * The site default sidebar position.
 *
 * @param string $characters
 * @return string
 */
function codilight_lite_sidebar_position(){
	$layout_sidebar = get_theme_mod( 'layout_sidebar', 'right' );
	echo $layout_sidebar . '-sidebar';
}
endif;

/**
 * Add a count class to category counter number.
 *
 * @param string $characters
 * @return string
 */
add_filter('wp_list_categories', 'codilight_lite_cat_count_inline');
function codilight_lite_cat_count_inline($links) {
	$links = str_replace('</a> (', '</a><span class="cat-count">', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

if ( ! function_exists( 'codilight_lite_link_to_menu_editor' ) ) :
/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
function codilight_lite_link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'edit_theme_options' ) )
    {
        return;
    }

    // see wp-includes/nav-menu-template.php for available arguments
    extract( $args );

    $link = $link_before
        . '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $before . esc_html__( '添加一个菜单', 'codilight-lite' ) . $after . '</a></li>'
        . $link_after;

    // We have a list
    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }

    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ( $echo )
    {
        echo $output;
    }

    return $output;
}
endif;
