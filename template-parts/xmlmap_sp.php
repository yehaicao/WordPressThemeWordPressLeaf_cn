<?php
require('./wp-blog-header.php');
header("Content-type: text/xml");
header('HTTP/1.1 200 OK');
$posts_to_show = 1000;  //限制最大生成1000篇
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
?>
<!-- generated-on=<?php echo get_lastpostdate('blog'); ?> -->
 <url>
 <loc><?php echo 'http://'.$_SERVER['HTTP_HOST']; ?></loc>
 <lastmod><?php $ltime = get_lastpostmodified(GMT);$ltime = gmdate('Y-m-d\TH:i:s+00:00', strtotime($ltime)); echo $ltime; ?></lastmod>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
        <data>
         <display>
           <html5_url><?php echo 'http://'.$_SERVER['HTTP_HOST']; ?></html5_url>
         </display>
         </data>
  </url>
<?php
/* 文章页面 */
header("Content-type: text/xml");
$myposts = get_posts( "numberposts=" . $posts_to_show );
foreach( $myposts as $post ) { ?>
  <url>
      <loc><?php the_permalink(); ?></loc>
      <lastmod><?php the_time('c') ?></lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.6</priority>
       <data>
         <display>
           <html5_url><?php the_permalink(); ?></html5_url>
         </display>
         </data>
    </url>
<?php } /* 文章循环结束 */ ?>
<?php
/* 单页面 */ 
$mypages = get_pages();
if(count($mypages) > 0) {
    foreach($mypages as $page) { ?>
    <url>
      <loc><?php echo get_page_link($page->ID); ?></loc>
      <lastmod><?php echo str_replace(" ","T",get_page($page->ID)->post_modified); ?></lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.6</priority>
      <data>
         <display>
           <html5_url><?php echo get_page_link($page->ID); ?></html5_url>
         </display>
         </data>
  </url>
<?php }} /* 单页面循环结束 */ ?> 
<?php
/* 博客分类 */ 
$terms = get_terms('category', 'orderby=name&hide_empty=0' );
$count = count($terms);
if($count > 0){
foreach ($terms as $term) { ?>
    <url>
      <loc><?php echo get_term_link($term, $term->slug); ?></loc>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
      <data>
         <display>
           <html5_url><?php echo get_term_link($term, $term->slug); ?></html5_url>
         </display>
      </data>
  </url>
<?php }} /* 分类循环结束 */?> 
</urlset>