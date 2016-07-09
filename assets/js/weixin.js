/*

 微信公众号关注二维码
                
 注意，如果放置了微信公众号的按钮，在设置时必须将 url设置为'http://wx.qq.com';
 Version: 1.0.0
  Author: www.wordpressleaf.com
 Website: http://www.wordpressleaf.com
    Docs: http://www.wordpressleaf.com
    Repo: http://www.wordpressleaf.com
  Issues: http://www.wordpressleaf.com

 */


jQuery(document).ready(function() {

  //二维码图片地址
  var imgurl='http://www.wordpressleaf.com/wp-content/themes/wordpressleaf/assets/images/weixin.png';

	var main = jQuery('<div></div>'); //创建一个父DIV
	main.attr('id', 'leaf_weixin_share'); //给父DIV设置ID
	main.addClass('weixin_share'); //添加CSS样式

	var leaf_weixin_modal = jQuery('<div></div>'); //创建一个子DIV
	leaf_weixin_modal.attr('id', 'leaf_weixin_modal'); //给子DIV设置ID
	leaf_weixin_modal.removeClass();
	leaf_weixin_modal.addClass('weixin_modal');
	leaf_weixin_modal.appendTo(main);

	var leaf_modal_header = jQuery('<div></div>'); //创建一个子DIV
	leaf_modal_header.attr('id', 'leaf_modal_header'); //给子DIV设置ID
	leaf_modal_header.removeClass();
	leaf_modal_header.addClass('modal_header');
	leaf_modal_header.appendTo(leaf_weixin_modal);


	var leaf_modal_header_a = jQuery('<a  id="leaf_weixin_close" class="weixin_close"  href="#">×</a>'); //创建一个关闭的A标签
	leaf_modal_header_a.appendTo(leaf_modal_header);

	var leaf_modal_header_h3 = jQuery('<h3 id="leaf_weixin_h3" >关注微信公众号</h3>'); //创建一个h3
	leaf_modal_header_h3.appendTo(leaf_modal_header);


	var leaf_modal_body = jQuery('<div></div>'); //创建一个子DIV
	leaf_modal_body.attr('id', 'leaf_modal_body'); //给子DIV设置ID
	leaf_modal_body.removeClass();
	leaf_modal_body.addClass('modal_body');
	leaf_modal_body.appendTo(leaf_weixin_modal);
  

	var leaf_modal_body_p = jQuery('<p id="leaf_webchat"><img src="'+imgurl+'" width="220" height="220" alt="二维码加载失败..." ></p>'); //创建一个p
	leaf_modal_body_p.appendTo(leaf_modal_body);


	var leaf_modal_footer = jQuery('<div></div>'); //创建一个子DIV
	leaf_modal_footer.attr('id', 'leaf_modal_footer'); //给子DIV设置ID
	leaf_modal_footer.removeClass();
	leaf_modal_footer.addClass('modal_footer');
	leaf_modal_footer.appendTo(leaf_weixin_modal);

	var leaf_modal_footer_div = jQuery('<div id="jiathis_weixin_tip" class="weixin_tip">打开微信，使用 “扫一扫” 即可关注。（这个二维码测试用，您可以扫描向我捐助，谢谢。）</div>'); //创建一个div
	leaf_modal_footer_div.appendTo(leaf_modal_footer);

	main.appendTo('body'); //将父DIV添加到BODY中
	main.hide();

	jQuery('#leaf_modal_header #leaf_weixin_close').click(function (e) {
		e.preventDefault();
		jQuery('#leaf_weixin_share').hide() ;

	});



	jQuery('#menu-social-items a').on('click',function(e){
		thisurl= jQuery(this).attr('href');
		if (thisurl == 'http://wx.qq.com'){
			e.preventDefault();
			//判断弹出窗口是否存在
			if(jQuery('#leaf_weixin_share').is(":hidden") ){

				//隐藏则显示
				jQuery('#leaf_weixin_share').show() ;


			}else{

				//显示则隐藏
				jQuery('#leaf_weixin_share').hide() ;
			}
		}
	});




});
