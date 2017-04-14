<?php header("Content-Type: text/css");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

$pp_advance_combine_css = get_option('pp_advance_combine_css');

if(!empty($pp_advance_combine_css))
{
	//Function for compressing the CSS as tightly as possible
	function compress($buffer) {
	    //Remove CSS comments
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    //Remove tabs, spaces, newlines, etc.
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
	}

	//This GZIPs the CSS for transmission to the user
	//making file size smaller and transfer rate quicker
	ob_start("ob_gzhandler");
	ob_start("compress");
}
?>

<?php
	//Check if hide portfolio navigation
	$pp_portfolio_single_nav = get_option('pp_portfolio_single_nav');
	if(empty($pp_portfolio_single_nav))
	{
?>
.portfolio_nav { display:none; }
<?php
	}
?>
<?php
	$pp_fixed_menu = get_option('pp_fixed_menu');
	
	if(!empty($pp_fixed_menu))
	{
		//Check if Wordpress admin bar is enabled
		$menu_top_value = 0;
		if(is_admin_bar_showing())
		{
			$menu_top_value = 30;
		}
?>
.top_bar.fixed
{
	position: fixed;
	animation-name: slideDown;
	-webkit-animation-name: slideDown;	
	animation-duration: 0.5s;	
	-webkit-animation-duration: 0.5s;
	z-index: 999;
	visibility: visible !important;
	top: <?php echo $menu_top_value; ?>px;
}

<?php
	$pp_menu_font = get_option('pp_menu_font');
	$pp_menu_font_diff = 16-$pp_menu_font;
?>
.top_bar.fixed #menu_wrapper div .nav
{
	margin-top: <?php echo $pp_menu_font_diff; ?>px;
}

.top_bar.fixed #searchform
{
	margin-top: <?php echo $pp_menu_font_diff-8; ?>px;
}

.top_bar.fixed .header_cart_wrapper
{
	margin-top: <?php echo $pp_menu_font_diff+5; ?>px;
}

.top_bar.fixed #menu_wrapper div .nav > li > a
{
	padding-bottom: 24px;
}

.top_bar.fixed .logo_wrapper img
{
	max-height: 40px;
	width: auto;
}
<?php
	}
	
	//Hack animation CSS for Safari
	$current_browser = getBrowser();

	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer')
	{
?>
#wrapper
{
	overflow-x: hidden;
}
.mobile_menu_wrapper
{
    display: none;
}
body.js_nav .mobile_menu_wrapper 
{
    display: block;
}
body.js_nav #wrapper, body.js_nav .footer_wrapper
{
	margin-left: 70%;
}
.gallery_type, .portfolio_type
{
	opacity: 1;
}
<?php
	}
?>

<?php
$pp_menu_font = get_option('pp_menu_font');

if(!empty($pp_menu_font))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .mobile_menu_wrapper { font-family: '<?php echo urldecode($pp_menu_font); ?>' !important; }		
<?php
}
?>

<?php
	$pp_menu_font_size = get_option('pp_menu_font_size');
	
	if(!empty($pp_menu_font_size))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-size:<?php echo $pp_menu_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_menu_font_spacing = get_option('pp_menu_font_spacing');
	
	if(is_numeric($pp_menu_font_spacing))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { letter-spacing:<?php echo $pp_menu_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_menu_font_weight = get_option('pp_menu_font_weight');
	
	if(is_numeric($pp_menu_font_weight))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-weight:<?php echo $pp_menu_font_weight; ?>; }
<?php
	}
?>

<?php
	$pp_submenu_font_size = get_option('pp_submenu_font_size');
	
	if(!empty($pp_submenu_font_size))
	{
		$sumenu_margin_top = -48+(15-$pp_submenu_font_size);
		$sumenu_margin_top_webkit = $sumenu_margin_top;
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-size:<?php echo $pp_submenu_font_size; ?>px; }
#menu_wrapper .nav ul li ul li ul, #menu_wrapper div .nav li ul li ul { margin-top: <?php echo $sumenu_margin_top; ?>px; }
@media screen and (-webkit-min-device-pixel-ratio:0) {
	#menu_wrapper .nav ul li ul li ul, #menu_wrapper div .nav li ul li ul
	{
		<?php echo $sumenu_margin_top_webkit; ?>px;
	}
}
<?php
	}	
?>

<?php
	$pp_menu_upper = get_option('pp_menu_upper');

	if(!empty($pp_menu_upper))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { text-transform: uppercase; }		
<?php
	}

	$pp_submenu_upper = get_option('pp_submenu_upper');

	if(!empty($pp_submenu_upper))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_page_title_align = get_option('pp_page_title_align');

	if(!empty($pp_page_title_align) && $pp_page_title_align == 'center')
	{
	
?>
#page_caption .page_title_wrapper
{
	text-align: center;
}
#page_caption:after
{
	border-top: 2px solid #333;
	position: absolute;
}
#page_caption h1, #crumbs
{
	float: none;
	margin: auto;
	display: inline;
}
<?php
	}
?>

<?php
	$pp_page_title_paddingtop = get_option('pp_page_title_paddingtop');
?>
#page_caption
{
	padding-top: <?php echo $pp_page_title_paddingtop; ?>px;
}

<?php
	$pp_page_title_paddingbottom = get_option('pp_page_title_paddingbottom');
?>
#page_caption
{
	padding-bottom: <?php echo $pp_page_title_paddingbottom; ?>px;
}

<?php
	$all_pp_title_padding = $pp_page_title_paddingtop + $pp_page_title_paddingbottom - 32;
	$hasbg_margin_top = 238 + $all_pp_title_padding;
?>
.ppb_wrapper.hasbg, #page_content_wrapper.hasbg
{
	margin-top: <?php echo $hasbg_margin_top; ?>px;
}

#page_content_wrapper.hasbg.withtopbar, .ppb_wrapper.hasbg.withtopbar
{
	margin-top: <?php echo $hasbg_margin_top-48; ?>px;
}

<?php
	$pp_page_title_bgcolor = get_option('pp_page_title_bgcolor');

	if(!empty($pp_page_title_bgcolor))
	{
	
?>
#page_caption
{
	background: <?php echo $pp_page_title_bgcolor; ?>;
}
<?php
	}
?>

<?php
	$pp_page_title_fontcolor = get_option('pp_page_title_fontcolor');

	if(!empty($pp_page_title_fontcolor))
	{
	
?>
#page_caption h1
{
	color: <?php echo $pp_page_title_fontcolor; ?>;
	border-color: <?php echo $pp_page_title_fontcolor; ?>;
}
<?php
	}
?>

<?php
	$pp_page_title_font_size = get_option('pp_page_title_font_size');
	
	if(!empty($pp_page_title_font_size))
	{
?>
#page_caption h1 { font-size:<?php echo $pp_page_title_font_size; ?>px; }
<?php
	}
	
	if($pp_page_title_font_size > 30)
	{
?>
#page_caption #crumbs.center { margin-top: -15px; }
<?php
	}
?>

<?php
	$pp_page_title_font_spacing = get_option('pp_page_title_font_spacing');
	
	if(is_numeric($pp_page_title_font_spacing))
	{
?>
#page_caption h1, h1.hasbg { letter-spacing:<?php echo $pp_page_title_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_page_title_upper = get_option('pp_page_title_upper');

	if(!empty($pp_page_title_upper))
	{
?>
#page_caption h1 { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_page_title_font_weight = get_option('pp_page_title_font_weight');

	if(is_numeric($pp_page_title_font_weight))
	{
?>
#page_caption h1 { font-weight: <?php echo $pp_page_title_font_weight;?>; }		
<?php
	}
?>

<?php
	$pp_page_title_opacity_color = get_option('pp_page_title_opacity_color');

	if(!empty($pp_page_title_opacity_color))
	{
	
?>
.parallax_overlay, .parallax_overlay_header
{
	background-color: rgba(0, 0, 0, <?php echo $pp_page_title_opacity_color/100; ?>);
}
<?php
	}
?>

<?php
	$pp_page_title_bg_font_size = get_option('pp_page_title_bg_font_size');
	
	if(!empty($pp_page_title_bg_font_size))
	{
		$pp_page_title_bg_margin_top = 140 + (50-$pp_page_title_bg_font_size);
?>
#page_caption.hasbg h1, h1.hasbg { font-size:<?php echo $pp_page_title_bg_font_size; ?>px; margin-top: <?php echo $pp_page_title_bg_margin_top; ?>px; }
<?php
	}
	
	if($pp_page_title_bg_font_size > 30)
	{
?>
#page_caption.hasbg #crumbs.center { margin-top: -15px; }
<?php
	}
?>

<?php
	$pp_page_title_trans_border = get_option('pp_page_title_trans_border');
	
	if(!empty($pp_page_title_trans_border))
	{
?>
.top_bar.hasbg { border-bottom: 1px solid rgba(256, 256, 256, 0.3); -webkit-background-clip: padding-box; background-clip: padding-box; }
<?php
	}
?>

<?php
	$pp_footer_totop_display = get_option('pp_footer_totop_display');

	if(empty($pp_footer_totop_display))
	{
	
?>
#toTop
{
	display: none !important;
}
<?php
	}
?>

<?php
	$pp_header_font = get_option('pp_header_font');
	
	if(!empty($pp_header_font))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #imageFlow .title, #contact_form label, .post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .post_date, .post_quote_title, .post_attribute, .comment_date, #post_more_wrapper h5, blockquote, #commentform label, label, #social_share_wrapper, .social_share_wrapper, .social_follow, .fancybox-title-outside-wrap strong, #searchform label { font-family: '<?php echo urldecode($pp_header_font); ?>'; }		

<?php
	}
?>

<?php
	$pp_header_font_color = get_option('pp_header_font_color');
	
	if(!empty($pp_header_font_color))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #contact_form label, .recent_post_detail, .thumb_content span, .testimonial_customer_position, .testimonial_customer_company, .post_date, .post_quote_title, #post_more_wrapper h5, blockquote, #commentform label, label, #social_share_wrapper, .social_share_wrapper, .social_follow, #social_share_wrapper a, .social_share_wrapper.shortcode a, .post_tag a, .post_previous_content a, .post_next_content a, .post_previous_icon, .post_next_icon, .post_img.animate div.thumb_content a { color: <?php echo $pp_header_font_color; ?>; }
	.ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next
{
	color: <?php echo $pp_header_font_color; ?>;
}

<?php
	}
?>

<?php
	$pp_header_font_weight = get_option('pp_header_font_weight');

	if(is_numeric($pp_header_font_weight))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #imageFlow .title, #contact_form label, .post_quote_title, #post_more_wrapper h5, #commentform label, label { font-weight: <?php echo $pp_header_font_weight; ?>; }		

<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
	body, .fancybox-title-outside-wrap { font-family: '<?php echo urldecode($pp_body_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_header_font_size = get_option('pp_ppb_header_font_size');
	
	if(!empty($pp_ppb_header_font_size))
	{
?>
h2.ppb_title { font-size:<?php echo $pp_ppb_header_font_size; ?>px; line-height:<?php echo $pp_ppb_header_font_size*1.25; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_header_font_spacing = get_option('pp_ppb_header_font_spacing');
	
	if(!empty($pp_ppb_header_font_spacing))
	{
?>
h2.ppb_title { letter-spacing:<?php echo $pp_ppb_header_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_header_font_weight = get_option('pp_ppb_header_font_weight');
	
	if(!empty($pp_ppb_header_font_weight))
	{
?>
h2.ppb_title { font-weight:<?php echo $pp_ppb_header_font_weight; ?>; }
<?php
	}
?>

<?php
	$pp_ppb_subtitle_font_size = get_option('pp_ppb_subtitle_font_size');
	
	if(!empty($pp_ppb_subtitle_font_size))
	{
?>
.ppb_subtitle { font-size:<?php echo $pp_ppb_subtitle_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_subtitle_font_spacing = get_option('pp_ppb_subtitle_font_spacing');
	
	if(!empty($pp_ppb_subtitle_font_spacing))
	{
?>
.ppb_subtitle { letter-spacing:<?php echo $pp_ppb_subtitle_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_header_upper = get_option('pp_ppb_header_upper');

	if(empty($pp_ppb_header_upper))
	{
?>
h2.ppb_title { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_post_title_upper = get_option('pp_post_title_upper');

	if(!empty($pp_post_title_upper))
	{
?>
.post_header h5, .post_quote_title, #post_more_wrapper .content h6, .post_header.grid h6 { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_ppb_subtitle_upper = get_option('pp_ppb_subtitle_upper');

	if(empty($pp_ppb_subtitle_upper))
	{
?>
.ppb_subtitle { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_post_title_bold = get_option('pp_post_title_bold');

	if(empty($pp_post_title_bold))
	{
?>
.post_header h5, .post_quote_title, #post_more_wrapper .content h6 { font-weight: normal; }		
<?php
	}
?>

<?php
	$pp_post_meta_font_color = get_option('pp_post_meta_font_color');

	if(!empty($pp_post_meta_font_color))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail a { color: <?php echo $pp_post_meta_font_color; ?>; }		
<?php
	}
?>

<?php
	$pp_post_meta_font = get_option('pp_post_meta_font');
	
	if(!empty($pp_post_meta_font))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .imageFlow_gallery_info_author, .post_attribute, .comment_date { font-family:'<?php echo urldecode($pp_post_meta_font); ?>' !important; }
<?php
	}
?>

<?php
	$pp_post_meta_font_size = get_option('pp_post_meta_font_size');
	
	if(!empty($pp_post_meta_font_size))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .imageFlow_gallery_info_author { font-size:<?php echo $pp_post_meta_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_post_meta_upper = get_option('pp_post_meta_upper');

	if(empty($pp_post_meta_upper))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .post_attribute, .comment_date, .imageFlow_gallery_info_author, .comment_date { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_post_meta_font_spacing = get_option('pp_post_meta_font_spacing');
	
	if(is_numeric($pp_post_meta_font_spacing))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .post_attribute, .comment_date, .imageFlow_gallery_info_author, .comment_date { letter-spacing:<?php echo $pp_post_meta_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_post_meta_font_weight = get_option('pp_post_meta_font_weight');
	
	if(!empty($pp_post_meta_font_weight))
	{
?>
.post_header .post_detail, .recent_post_detail, .post_detail, .thumb_content span, .page_caption_desc, .portfolio_desc .portfolio_excerpt, .testimonial_customer_position, .testimonial_customer_company, .imageFlow_gallery_info_author, .comment_date { font-weight:<?php echo $pp_post_meta_font_weight; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_font_size = get_option('pp_sidebar_title_font_size');
	
	if(!empty($pp_sidebar_title_font_size))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-size:<?php echo $pp_sidebar_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_gallery_hover = get_option('pp_gallery_hover');
	
	if(empty($pp_gallery_hover))
	{
?>
#photo_wall_wrapper .wall_entry.fade, .photo_wall_wrapper .wall_entry.fade { opacity: 1 !important; }
<?php
	}
?>

<?php
	$pp_sidebar_title_upper = get_option('pp_sidebar_title_upper');

	if(empty($pp_sidebar_title_upper))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_weight = get_option('pp_sidebar_title_weight');

	if(is_numeric($pp_sidebar_title_weight))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-weight: <?php echo $pp_sidebar_title_weight; ?>; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_spacing = get_option('pp_sidebar_title_spacing');

	if(is_numeric($pp_sidebar_title_spacing))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { letter-spacing: <?php echo $pp_sidebar_title_spacing; ?>px; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_font = get_option('pp_sidebar_title_font');
	
	if(!empty($pp_sidebar_title_font))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-family: '<?php echo urldecode($pp_sidebar_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .top_bar #searchform button i, #searchform label, .top_bar .header_cart_wrapper i { color: <?php echo $pp_menu_font_color; ?>; }
.top_bar.fixed #menu_wrapper .nav ul li a, .top_bar.fixed #menu_wrapper div .nav li a, .top_bar.fixed #searchform button i, .top_bar.fixed #searchform label, .top_bar.fixed .header_cart_wrapper i { color: <?php echo $pp_menu_font_color; ?> !important; }
#mobile_nav_icon { border-color: <?php echo $pp_menu_font_color; ?>; }
<?php
}
?>

<?php
//Check if display active BG
$pp_menu_active_border = get_option('pp_menu_active_border');
$pp_menu_hover_font_color = get_option('pp_menu_hover_font_color');

if(!empty($pp_menu_hover_font_color))
{
	if(!empty($pp_menu_active_border))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { padding-bottom: 33px; border-bottom: 2px solid transparent; }
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { border-bottom: 2px solid <?php echo $pp_menu_hover_font_color; ?>; color: <?php echo $pp_menu_hover_font_color; ?>;  }

.top_bar.fixed #menu_wrapper .nav ul li a.hover, .top_bar.fixed #menu_wrapper .nav ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li a.hover, .top_bar.fixed #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?> !important; }
<?php
	}
	else
	{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?>;  }

.top_bar.fixed #menu_wrapper .nav ul li a.hover, .top_bar.fixed #menu_wrapper .nav ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li a.hover, .top_bar.fixed #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?> !important; }
<?php
	}
}
?>

<?php
$pp_menu_active_font_color = get_option('pp_menu_active_font_color');

if(!empty($pp_menu_active_font_color))
{
	if(!empty($pp_menu_active_border))
	{
?>
#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { border-bottom: 2px solid <?php echo $pp_menu_active_font_color; ?>; color: <?php echo $pp_menu_active_font_color; ?>; }

.top_bar.fixed #menu_wrapper div .nav > li.current-menu-item > a, .top_bar.fixed #menu_wrapper div .nav > li.current-menu-parent > a, .top_bar.fixed #menu_wrapper div .nav > li.current-menu-ancestor > a { color: <?php echo $pp_menu_active_font_color; ?> !important;  }
<?php
	}
	else
	{
?>
#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { color: <?php echo $pp_menu_active_font_color; ?>;  }

.top_bar.fixed #menu_wrapper div .nav > li.current-menu-item > a, .top_bar.fixed #menu_wrapper div .nav > li.current-menu-parent > a, .top_bar.fixed #menu_wrapper div .nav > li.current-menu-ancestor > a { color: <?php echo $pp_menu_active_font_color; ?> !important;  }
<?php		
	}
}
?>

<?php
	$pp_menu_bg_color = get_option('pp_menu_bg_color');

	if(!empty($pp_menu_bg_color))
	{
	
?>
.top_bar, .top_bar.fixed
{
	background: <?php echo $pp_menu_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_menu_bg_color = get_option('pp_menu_bg_color');
	$ori_pp_menu_bg_color = $pp_menu_bg_color;
	
	if(!empty($pp_menu_bg_color))
	{
		$pp_menu_opacity_color = get_option('pp_menu_opacity_color');
		$pp_menu_opacity_color = $pp_menu_opacity_color/100;
		$pp_menu_bg_color = HexToRGB($pp_menu_bg_color);
	
?>
.top_bar, .top_bar.fixed
{
	background: <?php echo $ori_pp_menu_bg_color; ?>;
	background: rgb(<?php echo $pp_menu_bg_color['r']; ?>, <?php echo $pp_menu_bg_color['g']; ?>, <?php echo $pp_menu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
	background: rgba(<?php echo $pp_menu_bg_color['r']; ?>, <?php echo $pp_menu_bg_color['g']; ?>, <?php echo $pp_menu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
}
.top_bar.noopacity
{
	background: <?php echo $ori_pp_menu_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_menu_margin_top = get_option('pp_menu_margin_top');

	if(!empty($pp_menu_margin_top))
	{
		$pp_search_icon_margin_top = 20+($pp_menu_margin_top-30);
	
?>
#menu_wrapper .nav ul, #menu_wrapper div .nav
{
	margin-top: <?php echo $pp_menu_margin_top; ?>px;
}
.top_bar #searchform
{
	margin-top: <?php echo $pp_search_icon_margin_top; ?>px;
}
<?php
	}
?>

<?php
	$pp_menu_border_color = get_option('pp_menu_border_color');

	if(!empty($pp_menu_border_color))
	{
	
?>
.top_bar, .top_bar.fixed
{
	border-bottom: 1px solid <?php echo $pp_menu_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_submenu_font_color = get_option('pp_submenu_font_color');

if(!empty($pp_submenu_font_color))
{
?>
.top_bar.fixed #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_font_color; ?> !important;  }
<?php
}
?>

<?php
	$pp_submenu_hover_font_color = get_option('pp_submenu_hover_font_color');

	if(!empty($pp_submenu_hover_font_color))
	{
	
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover
{
	color: <?php echo $pp_submenu_hover_font_color; ?> !important;
}

.top_bar.fixed #menu_wrapper .nav ul li ul li a:hover, .top_bar.fixed #menu_wrapper .nav ul li ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li.current-menu-item ul li a:hover, .top_bar.fixed #menu_wrapper div .nav li.current-menu-parent ul li a:hover
{
	color: <?php echo $pp_submenu_hover_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_submenu_bg_color = get_option('pp_submenu_bg_color');
	
	if(!empty($pp_submenu_bg_color))
	{
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul, #autocomplete ul, .mobile_menu_wrapper, body.js_nav
{
	background: <?php echo $pp_submenu_bg_color; ?>;
}
#menu_wrapper .nav ul li ul:before, #menu_wrapper div .nav li ul:before, #autocomplete.visible:before
{
	border-color: <?php echo $pp_submenu_bg_color; ?> transparent;
}
<?php
	}
?>

<?php
	$pp_submenu_hover_bg_color = get_option('pp_submenu_hover_bg_color');

	if(!empty($pp_submenu_hover_bg_color))
	{
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover
{
	background-color: <?php echo $pp_submenu_hover_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_submenu_border_color = get_option('pp_submenu_border_color');

	if(!empty($pp_submenu_border_color))
	{
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul
{
	border-color: <?php echo $pp_submenu_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_submenu_font_weight = get_option('pp_submenu_font_weight');

	if(is_numeric($pp_submenu_font_weight))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-weight: <?php echo $pp_submenu_font_weight; ?>; }
<?php
	}
?>

<?php
	$pp_submenu_font_spacing = get_option('pp_submenu_font_spacing');

	if(is_numeric($pp_submenu_font_spacing))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { letter-spacing: <?php echo $pp_submenu_font_spacing; ?>px; }
<?php
	}
?>

<?php

//Calculate background color for fullscreen content
$ori_pp_content_bg_color = '#000000';
$pp_content_bg_color = HexToRGB('#000000');
?>
#imageFlow_gallery_info, #slidecaption
{
	background: <?php echo $ori_pp_content_bg_color; ?>;
	background: rgb(<?php echo $pp_content_bg_color['r']; ?>, <?php echo $pp_content_bg_color['g']; ?>, <?php echo $pp_content_bg_color['b']; ?>, 0.6);
	background: rgba(<?php echo $pp_content_bg_color['r']; ?>, <?php echo $pp_content_bg_color['g']; ?>, <?php echo $pp_content_bg_color['b']; ?>, 0.6);
}

<?php
$pp_font_color = get_option('pp_font_color');

if(!empty($pp_font_color))
{
?>
body { color: <?php echo $pp_font_color; ?>; }
.woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box, .portfolio_desc.team { color: <?php echo $pp_font_color; ?> !important; }
<?php
}
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a, h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong, h7 strong { color:<?php echo $pp_link_color; ?>; }
.woocommerce div.product form.cart .button.single_add_to_cart_button, ::selection { background-color:<?php echo $pp_link_color; ?> !important; }
blockquote { border-color: <?php echo $pp_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
?>

<?php
$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
.post_header h2, h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a, .post_quote_title a, .social_share_bubble a, .social_share_bubble a:hover, a.post_share, #toTop, a.post_share:hover, #toTop:hover
{
	color: <?php echo $pp_h1_font_color; ?>;
}
.portfolio_desc.team h5
{
	color: <?php echo $pp_h1_font_color; ?> !important;
}
<?php
}
?>

<?php
	$pp_hr_color = get_option('pp_hr_color');

	if(!empty($pp_hr_color))
	{
	
?>
#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, #page_content_wrapper .inner .sidebar_content, #page_caption, #page_content_wrapper .inner .sidebar_content.left_sidebar, .ajax_close, .ajax_next, .ajax_prev, .portfolio_next, .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_prev, .portfolio_next_prev_wrapper.video .portfolio_next, .separated, .blog_next_prev_wrapper, #post_more_wrapper h5, #ajax_portfolio_wrapper.hidding, #ajax_portfolio_wrapper.visible, .tabs.vertical .ui-tabs-panel
{
	border-color: <?php echo $pp_hr_color; ?>;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row, .ui-tabs li:first-child, .ui-tabs .ui-tabs-nav li, .ui-tabs.vertical .ui-tabs-nav li, .ui-tabs.vertical.right .ui-tabs-nav li.ui-state-active, .ui-tabs.vertical .ui-tabs-nav li:last-child
{
	border-color: <?php echo $pp_hr_color; ?> !important;
}
.count_separator span
{
	background: <?php echo $pp_hr_color; ?>;
}
.ui-tabs .ui-tabs-nav li
{
	border-bottom: 0 !important;
}
.tabs .ui-tabs-panel
{
	border: 1px solid <?php echo $pp_hr_color; ?>;
}
<?php
	}
?>

<?php
	$pp_sidebar_font_color = get_option('pp_sidebar_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper .sidebar .content { color:<?php echo $pp_sidebar_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_title_font_color = get_option('pp_sidebar_title_font_color');
	
	if(!empty($pp_sidebar_title_font_color))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { color:<?php echo $pp_sidebar_title_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_link_color = get_option('pp_sidebar_link_color');
	
	if(!empty($pp_sidebar_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a, #post_more_close i.fa, #page_content_wrapper .posts.blog li a { color:<?php echo $pp_sidebar_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_hover_link_color = get_option('pp_sidebar_hover_link_color');
	
	if(!empty($pp_sidebar_hover_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active { color:<?php echo $pp_sidebar_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_bg_color = get_option('pp_footer_bg_color');
	
	if(!empty($pp_footer_bg_color))
	{
?>
#footer { background:<?php echo $pp_footer_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_header_color = get_option('pp_footer_header_color');
	
	if(!empty($pp_footer_header_color))
	{
?>
#footer .sidebar_widget li h2.widgettitle { color:<?php echo $pp_footer_header_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_font_color = get_option('pp_footer_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#footer { color:<?php echo $pp_footer_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_link_color = get_option('pp_footer_link_color');
	
	if(!empty($pp_footer_link_color))
	{
?>
#footer a { color:<?php echo $pp_footer_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');
	
	if(!empty($pp_footer_hover_link_color))
	{
?>
#footer a:hover, #footer a:active { color:<?php echo $pp_footer_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_border_color = get_option('pp_footer_border_color');
	
	if(!empty($pp_footer_border_color))
	{
?>
.footer_bar, #footer { border-color:<?php echo $pp_footer_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_social_scheme = get_option('pp_footer_social_scheme');

	if(!empty($pp_footer_social_scheme))
	{
	
?>
.footer_bar_wrapper .social_wrapper ul li a
{
	color: <?php echo $pp_footer_social_scheme; ?> !important;
}
<?php
	}
?>

<?php
	$pp_footer_social_opacity = get_option('pp_footer_social_opacity');

	if(!empty($pp_footer_social_opacity))
	{
	
?>
.footer_bar_wrapper .social_wrapper ul li a
{
	opacity: <?php echo $pp_footer_social_opacity/100; ?>;
}
<?php
	}
?>

<?php
	$pp_copyright_bg_color = get_option('pp_copyright_bg_color');
	
	if(!empty($pp_footer_bg_color))
	{
?>
.footer_bar { background:<?php echo $pp_copyright_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_font_color = get_option('pp_copyright_font_color');
	
	if(!empty($pp_copyright_font_color))
	{
?>
#copyright { color:<?php echo $pp_copyright_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_link_color = get_option('pp_copyright_link_color');
	
	if(!empty($pp_copyright_link_color))
	{
?>
#copyright a { color:<?php echo $pp_copyright_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_hover_color = get_option('pp_copyright_hover_color');
	
	if(!empty($pp_copyright_hover_color))
	{
?>
#copyright a:hover, #copyright a:active { color:<?php echo $pp_copyright_hover_color; ?>; }
<?php
	}
?>

<?php
	$pp_input_bg_color = get_option('pp_input_bg_color');

	if(!empty($pp_input_bg_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	background: <?php echo $pp_input_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_font_color = get_option('pp_input_font_color');

	if(!empty($pp_input_font_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea, .top_bar #searchform input
{
	color: <?php echo $pp_input_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_border_color = get_option('pp_input_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea, .top_bar #searchform input
{
	border-color: <?php echo $pp_input_border_color; ?>;
}
.woocommerce table.cart td.actions .coupon .input-text#coupon_code
{
	border-color: <?php echo $pp_input_border_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_input_focus_border_color = get_option('pp_input_focus_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text]:focus, input[type=password]:focus, .woocommerce table.cart td.actions .coupon .input-text:focus, .woocommerce-page table.cart td.actions .coupon .input-text:focus, .woocommerce #content table.cart td.actions .coupon .input-text:focus, .woocommerce-page #content table.cart td.actions .coupon .input-text:focus, textarea:focus
{
	border-color: <?php echo $pp_input_focus_border_color; ?>;
	outline: 0;
}
<?php
	}
?>

<?php
	$pp_content_bg_color = get_option('pp_content_bg_color');

	if(!empty($pp_content_bg_color))
	{
	
?>
body, body.js_nav #wrapper
{
	background: <?php echo $pp_content_bg_color; ?>;
}
?>
.mobile_main_nav li.current-menu-item:after { border-right-color: <?php echo $pp_content_bg_color; ?> !important; }
<?php
	}
?>

<?php
	$pp_button_font = get_option('pp_button_font');
	
	if(!empty($pp_button_font))
	{
?>
input[type=submit], input[type=button], a.button, .button, .woocommerce .page_slider a.button, a.button.fullwidth, .woocommerce-page div.product form.cart .button{ font-family: '<?php echo urldecode($pp_button_font); ?>' !important; }
<?php
	}
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	color: <?php echo $pp_button_font_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	color: <?php echo $pp_button_font_color; ?> !important;
}
<?php
	}
	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	background: <?php echo $pp_button_bg_color; ?>;
	border-color: <?php echo $pp_button_bg_color; ?>;
}
#autocomplete li.view_all
{
	background: <?php echo $pp_button_bg_color; ?> !important;
	border-color: <?php echo $pp_button_bg_color; ?> !important;
	color: #fff;	
}
<?php
	}	
?>

<?php
	$pp_button_active_color = get_option('pp_button_active_color');
	
	if(!empty($pp_button_active_color))
	{
?>
input[type=button]:hover, input[type=submit]:hover, a.button:hover, .button:hover
{ 
	background: <?php echo $pp_button_active_color; ?> !important;
	border-color: <?php echo $pp_button_active_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_topbar_bg_color = get_option('pp_topbar_bg_color');

	if(!empty($pp_topbar_bg_color))
	{
	
?>
.above_top_bar
{
	background: <?php echo $pp_topbar_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_topbar_bg_color = get_option('pp_topbar_bg_color');
	$ori_pp_topbar_bg_color = $pp_topbar_bg_color;
	
	if(!empty($pp_topbar_bg_color))
	{
		$pp_topbar_opacity_color = get_option('pp_topbar_opacity_color');
		$pp_topbar_opacity_color = $pp_topbar_opacity_color/100;
		$pp_topbar_bg_color = HexToRGB($pp_topbar_bg_color);
	
?>
.above_top_bar
{
	background: <?php echo $ori_pp_topbar_bg_color; ?>;
	background: rgb(<?php echo $pp_topbar_bg_color['r']; ?>, <?php echo $pp_topbar_bg_color['g']; ?>, <?php echo $pp_topbar_bg_color['b']; ?>, <?php echo $pp_topbar_opacity_color; ?>);
	background: rgba(<?php echo $pp_topbar_bg_color['r']; ?>, <?php echo $pp_topbar_bg_color['g']; ?>, <?php echo $pp_topbar_bg_color['b']; ?>, <?php echo $pp_topbar_opacity_color; ?>);
}
<?php
	}
?>

<?php
	$pp_topbar_border_color = get_option('pp_topbar_border_color');

	if(!empty($pp_topbar_border_color))
	{
	
?>
.above_top_bar, .above_top_bar .top_contact_info span, .above_top_bar .top_contact_info, .above_top_bar .social_wrapper
{
	border-color: <?php echo $pp_topbar_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_topbar_font_color = get_option('pp_topbar_font_color');

	if(!empty($pp_topbar_font_color))
	{
	
?>
.above_top_bar, .above_top_bar a, .above_top_bar a:hover, .above_top_bar a:active
{
	color: <?php echo $pp_topbar_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_topbar_social_scheme = get_option('pp_topbar_social_scheme');

	if(!empty($pp_topbar_social_scheme))
	{
	
?>
.above_top_bar .social_wrapper ul li a, .above_top_bar .social_wrapper ul li a:hover
{
	color: <?php echo $pp_topbar_social_scheme; ?> !important;
}
<?php
	}
?>

<?php
	$pp_filterable_font_color = get_option('pp_filterable_font_color');

	if(!empty($pp_filterable_font_color))
	{
	
?>
.portfolio_filter_dropdown .portfolio_filter_dropdown_title a, .portfolio_filter_dropdown .portfolio_filter_dropdown_select ul.portfolio_select li a
{
	color: <?php echo $pp_filterable_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_info_bg_color = get_option('pp_portfolio_info_bg_color');

	if(!empty($pp_portfolio_info_bg_color))
	{
	
?>
.three_cols.gallery .element, .two_cols.gallery .element, .four_cols.gallery .element
{
	background: <?php echo $pp_portfolio_info_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_portfolio_header_font_color = get_option('pp_portfolio_header_font_color');

	if(!empty($pp_portfolio_header_font_color))
	{
	
?>
.portfolio_desc h5, .portfolio_desc h6
{
	color: <?php echo $pp_portfolio_header_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_title_upper = get_option('pp_portfolio_title_upper');
	
	if(!empty($pp_portfolio_title_upper))
	{
?>
div.thumb_content h3, div.thumb_content h4, div.thumb_content h5, div.thumb_content h6, .portfolio_desc h5, .portfolio_desc h6, .imageFlow_gallery_info_wrapper h1 { text-transform:uppercase; }
<?php
	}
?>

<?php
	$pp_portfolio_title_bold = get_option('pp_portfolio_title_bold');
	
	if(empty($pp_portfolio_title_bold))
	{
?>
.portfolio_desc h5, .portfolio_desc h6 { font-weight:normal !important; }
<?php
	}
?>

<?php
	$pp_portfolio_info_font_size = get_option('pp_portfolio_info_font_size');
	
	if(is_numeric($pp_portfolio_info_font_size))
	{
?>
.portfolio_desc .post_detail { font-size:<?php echo $pp_portfolio_info_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_portfolio_info_font_spacing = get_option('pp_portfolio_info_font_spacing');
	
	if(is_numeric($pp_portfolio_info_font_spacing))
	{
?>
.portfolio_desc .post_detail { letter-spacing:<?php echo $pp_portfolio_info_font_spacing; ?>px; }
<?php
	}
?>

<?php
	$pp_portfolio_info_font_weight = get_option('pp_portfolio_info_font_weight');
	
	if(is_numeric($pp_portfolio_info_font_weight))
	{
?>
.portfolio_desc .post_detail { font-weight:<?php echo $pp_portfolio_info_font_weight; ?>; }
<?php
	}
?>

<?php
	$pp_portfolio_info_font_color = get_option('pp_portfolio_info_font_color');

	if(!empty($pp_portfolio_info_font_color))
	{
	
?>
.portfolio_desc .post_detail
{
	color: <?php echo $pp_portfolio_info_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_grid_bg_color = get_option('pp_portfolio_grid_bg_color');

	if(!empty($pp_portfolio_grid_bg_color))
	{
	
?>
.three_cols.gallery .element .portfolio_title, .two_cols.gallery .element .portfolio_title, .four_cols.gallery .element .portfolio_title
{
	background: <?php echo $pp_portfolio_grid_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_portfolio_grid_header_font_color = get_option('pp_portfolio_grid_header_font_color');

	if(!empty($pp_portfolio_grid_header_font_color))
	{
	
?>
.three_cols.gallery .element .portfolio_title h5, .two_cols.gallery .element .portfolio_title h5, .four_cols.gallery .element .portfolio_title h5
{
	color: <?php echo $pp_portfolio_grid_header_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_grid_font_color = get_option('pp_portfolio_grid_font_color');

	if(!empty($pp_portfolio_grid_font_color))
	{
	
?>
.three_cols.gallery .element .portfolio_title .post_detail, .two_cols.gallery .element .portfolio_title .post_detail, .four_cols.gallery .element .portfolio_title .post_detail
{
	color: <?php echo $pp_portfolio_grid_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_service_icon1_font_color = get_option('pp_service_icon1_font_color');

	if(!empty($pp_service_icon1_font_color))
	{
	
?>
.service_icon i
{
	color: <?php echo $pp_service_icon1_font_color; ?>;
}
.service_wrapper.center .service_icon:hover
{
	background: <?php echo $pp_service_icon1_font_color; ?>;
	border-color: <?php echo $pp_service_icon1_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon2_bg_color = get_option('pp_service_icon2_bg_color');

	if(!empty($pp_service_icon2_bg_color))
	{
	
?>
.service_wrapper.center .service_icon
{
	background: <?php echo $pp_service_icon2_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon2_font_color = get_option('pp_service_icon2_font_color');

	if(!empty($pp_service_icon2_font_color))
	{
	
?>
.service_wrapper.center.boxed .service_icon i, .service_icon.vertical i
{
	color: <?php echo $pp_service_icon2_font_color; ?>;
}
<?php
	}
?>

<?php
	//Get content layout
	if(isset($_GET['boxed']) && !empty($_GET['boxed']))
	{
		$pp_layout = 'boxed';
	}
	else
	{
		$pp_layout = get_option('pp_layout');
	}
	
	//Check if not left menu layout
	$pp_menu_layout = get_option('pp_menu_layout');
	
	if($pp_layout=='boxed' && $pp_menu_layout != 'leftmenu')
	{
?>
#wrapper, .footer_bar { width: 1020px; margin: auto; float: none; }
body[data-style=fullscreen] #wrapper, body[data-style=flip] #wrapper, body[data-style=flow] #wrapper, body[data-style=fullscreen_video] #wrapper { width: 100%; }
.top_bar, .above_top_bar { width: 1020px; float: none; margin: auto; }

@media only screen and (min-width: 768px) and (max-width: 960px) {
	#wrapper, .footer_bar { width: 100%; }
}

@media only screen and (max-width: 767px) {
	#wrapper, .footer_bar { width: 100%; }
}

#wrapper { background: #fff; }
body { background: #d6d6d6; background-position: center center; }

	<?php
		if(isset($_SESSION['pp_boxed_bg_image']) && !empty($_SESSION['pp_boxed_bg_image']))
		{
			$pp_boxed_bg_image = $_SESSION['pp_boxed_bg_image'];
		}
		else
		{
			$pp_boxed_bg_image = get_option('pp_boxed_bg_image');
		}
	
		if(!empty($pp_boxed_bg_image))
		{
	?>
	body
	{
		background-image: url('<?php echo $pp_boxed_bg_image; ?>');
		background-size: contain;
	}
	<?php
		}
	?>
	
	<?php
		$pp_boxed_bg_image_cover = get_option('pp_boxed_bg_image_cover');
	
		if(!empty($pp_boxed_bg_image_cover))
		{
	?>
	body
	{
		background-size: cover !important;
		background-attachment:fixed;
	}
	<?php
		}
	?>
	
	<?php
		$pp_boxed_bg_image_repeat = get_option('pp_boxed_bg_image_repeat');
	
		if(empty($pp_boxed_bg_image_repeat))
		{
			$pp_boxed_bg_image_repeat = 'no-repeat';
		}
	?>
	body
	{
		background-repeat: <?php echo $pp_boxed_bg_image_repeat; ?>;
	}

	<?php
		$pp_boxed_bg_color = get_option('pp_boxed_bg_color');
	
		if(!empty($pp_boxed_bg_color))
		{
	?>
	body
	{
		background-color: <?php echo $pp_boxed_bg_color; ?>;
	}
	<?php
		}
	?>
	
<?php
	} //End if boxed layout
?>

<?php
	$pp_mobile_menu_bg_color = get_option('pp_mobile_menu_bg_color');

	if(!empty($pp_mobile_menu_bg_color))
	{
	
?>
.mobile_menu_wrapper, body.js_nav
{
	background: <?php echo $pp_mobile_menu_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_font_color = get_option('pp_mobile_menu_font_color');

	if(!empty($pp_mobile_menu_font_color))
	{
	
?>
.mobile_main_nav li a, #close_mobile_menu i
{
	color: <?php echo $pp_mobile_menu_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_hover_font_color = get_option('pp_mobile_menu_hover_font_color');

	if(!empty($pp_mobile_menu_hover_font_color))
	{
	
?>
.mobile_main_nav li a:hover, #close_mobile_menu:hover
{
	color: <?php echo $pp_mobile_menu_hover_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_hover_bg_color = get_option('pp_mobile_menu_hover_bg_color');

	if(!empty($pp_mobile_menu_hover_bg_color))
	{
	
?>
.mobile_main_nav li a:hover, #close_mobile_menu:hover
{
	background: <?php echo $pp_mobile_menu_hover_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_border_color = get_option('pp_mobile_menu_border_color');

	if(!empty($pp_mobile_menu_border_color))
	{
	
?>
.mobile_main_nav li
{
	border-color: <?php echo $pp_mobile_menu_border_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_upper = get_option('pp_mobile_menu_upper');

	if(empty($pp_mobile_menu_upper))
	{
	
?>
.mobile_menu_wrapper
{
	text-transform: none;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_bold = get_option('pp_mobile_menu_bold');

	if(empty($pp_mobile_menu_bold))
	{
	
?>
.mobile_menu_wrapper
{
	font-weight: normal;
}
<?php
	}
?>

<?php
	$pp_logo_margin_top = get_option('pp_logo_margin_top');

	if(!empty($pp_logo_margin_top))
	{
	
?>
.logo_wrapper
{
	margin-top: <?php echo $pp_logo_margin_top; ?>px;
}
.top_bar.fixed .logo_wrapper
{
	margin-top: <?php echo $pp_logo_margin_top*0.6; ?>px;
}
<?php
	}
?>

<?php
	$pp_accordion_header_bg_color = get_option('pp_accordion_header_bg_color');

	if(!empty($pp_accordion_header_bg_color))
	{
	
?>
.ui-accordion .ui-accordion-header
{
	background: <?php echo $pp_accordion_header_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_accordion_header_font_color = get_option('pp_accordion_header_font_color');

	if(!empty($pp_accordion_header_font_color))
	{
	
?>
.ui-accordion .ui-accordion-header a, .ui-accordion .ui-accordion-header .ui-icon:after
{
	color: <?php echo $pp_accordion_header_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_tab_active_bg_color = get_option('pp_tab_active_bg_color');

	if(!empty($pp_tab_active_bg_color))
	{
	
?>
.ui-tabs .ui-tabs-nav li.ui-state-active, .tabs .ui-tabs-panel
{
	background: <?php echo $pp_tab_active_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_tab_active_header_color = get_option('pp_tab_active_header_color');

	if(!empty($pp_tab_active_header_color))
	{
	
?>
.tabs .ui-state-active a
{
	color: <?php echo $pp_tab_active_header_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_tab_none_active_bg_color = get_option('pp_tab_none_active_bg_color');

	if(!empty($pp_tab_none_active_bg_color))
	{
	
?>
.ui-tabs .ui-tabs-nav li
{
	background: <?php echo $pp_tab_none_active_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_tab_active_header_color = get_option('pp_tab_active_header_color');

	if(!empty($pp_tab_active_header_color))
	{
	
?>
.ui-tabs .ui-tabs-nav li.ui-state-active a
{
	color: <?php echo $pp_tab_active_header_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_topbar = get_option('pp_topbar');

	if(!empty($pp_topbar))
	{
?>
#page_caption.hasbg h1, h1.hasbg { margin-top: 179px !important; }
<?php
	}
?>

<?php
	$pp_service_title_upper = get_option('pp_service_title_upper');
	
	if(!empty($pp_service_title_upper))
	{
?>
.service_wrapper .service_title h6, .service_wrapper .service_title h3, .icon_list li .service_title strong { text-transform:uppercase; }
<?php
	}
?>

<?php
	$pp_filterable_enable = get_option('pp_filterable_enable');
	
	if(empty($pp_filterable_enable))
	{
?>
#portfolio_filter_wrapper { padding-top: 0; }
<?php
	}
?>

<?php
	$pp_portfolio_fade_effect = get_option('pp_portfolio_fade_effect');
	
	if(empty($pp_portfolio_fade_effect))
	{
?>
.two_cols.gallery .element.fade, .three_cols.gallery .element.fade, .four_cols.gallery .element.fade, #photo_wall_wrapper .wall_entry.fade, .photo_wall_wrapper .wall_entry.fade { opacity: 1 !important; }
<?php
	}
?>

<?php
	$pp_mobile_logo_margin_top = get_option('pp_mobile_logo_margin_top');
	
	if(!empty($pp_mobile_logo_margin_top))
	{
?>
@media only screen and (max-width: 959px) {
	.logo_wrapper { margin-top: <?php echo $pp_mobile_logo_margin_top; ?>px !important; }
}
<?php
	}
?>

<?php
	//CSS for left menu layout
	$pp_menu_layout = get_option('pp_menu_layout');
	
	if($pp_menu_layout == 'leftmenu')
	{
?>
@media only screen and (min-width: 961px) {

#wrapper { padding-top: 0; }
body.error404 #wrapper { padding-top: 50px !important; }
.header_style_wrapper { width: 265px; min-height: 100%; height: 100%; -webkit-backface-visibility: hidden; }
.header_style_wrapper .top_bar { width: 100%; }
.top_bar { height: 100%; box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1); }
#menu_wrapper { width: 100%; }
#page_content_wrapper, .ppb_wrapper { width: calc(100% - 265px); margin-left: 265px; box-sizing: border-box; }
.logo_wrapper { width: 100%; text-align: center; }
#menu_wrapper .nav ul li, #menu_wrapper div .nav li, #menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a { width: 100%; box-sizing: border-box; }
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a { padding: 10px 60px 10px 60px; border-bottom: 1px solid <?php echo $pp_menu_border_color; ?>; }

<?php
	//Check if display border color for active menu item
	if(!empty($pp_menu_active_border))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li > a { padding: 10px 60px 7px 60px; border-right: 3px solid transparent; }
#menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li > a:hover, #menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { border-color: <?php echo $pp_menu_active_font_color; ?>; }
#menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li > a:hover, #menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { border-bottom: 1px solid <?php echo $pp_menu_border_color; ?>; }
<?php
	}
?>

#menu_wrapper .nav ul:not(.sub-menu) li:first-child a, #menu_wrapper div .nav > li:first-child > a { border-top: 1px solid <?php echo $pp_menu_border_color; ?>; }
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { margin: -43px 0 0 265px; }
#menu_wrapper .nav li.arrow > a:after, #menu_wrapper div .nav li.arrow > a:after { display: none; }
.top_bar { border-bottom: 0; border-right: 1px solid <?php echo $pp_menu_border_color; ?>; }
.social_wrapper.leftmenu { padding: 0 40px 0 50px; box-sizing: border-box; text-align: left; margin-top: 30px; }
.social_wrapper.leftmenu li { border-radius: 3px; }
.top_bar .company_info { padding: 0 60px 0 60px; box-sizing: border-box; margin-top: 30px; }
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { width: 100%; box-sizing: border-box; }
#page_content_wrapper .inner .inner_wrapper { padding: 0 30px 0 30px; box-sizing: border-box; }
#page_content_wrapper .inner .sidebar_content.full_width, .page_content_wrapper .inner .sidebar_content.full_width, #page_content_wrapper .inner .sidebar_content.full_width .sidebar_content, .page_content_wrapper .inner .sidebar_content.full_width .sidebar_content { width: 100%; }
#page_content_wrapper .inner .sidebar_content, .page_content_wrapper .inner .sidebar_content { width: 70%; margin-right: 0; }
#page_content_wrapper .inner .sidebar_content.left_sidebar, .page_content_wrapper .inner .sidebar_content.left_sidebar { padding-left: 0; }
#page_content_wrapper .inner .sidebar_wrapper, .page_content_wrapper .inner .sidebar_wrapper { width: 26%; margin-left: 4%; }
#page_content_wrapper .inner .sidebar_wrapper.left_sidebar { width: 26%; margin-right: 4%; margin-left: 0; }
.post_share_bubble { right: 0; left: 30px; }
.footer_bar { margin-left: 265px; width: auto; float: none; border-bottom: 0; }
.footer_bar_wrapper { width: auto; padding-left: 30px; padding-right: 30px; }
#footer { box-shadow: none; }
#footer ul.sidebar_widget { width: 100%; padding: 0 30px 0 30px; }
.one .page_content_wrapper { width: 100%; padding: 0 30px 0 30px; box-sizing: border-box; }
.one .page_content_wrapper.nopadding { padding: 0; }
.contact_form_wrapper textarea { width: 95.5% !important; }
#page_content_wrapper.fullwidth #portfolio_filter_wrapper.gallery, #page_content_wrapper.fullwidth .portfolio_filter_wrapper.gallery { margin: 0; width: calc(100% - 265px); }
#portfolio_filter_wrapper.gallery { width: 100%; }
.portfolio_filter_dropdown { float: left; margin-left: 30px; }
.page_content_wrapper .inner, .standard_wrapper, #page_content_wrapper .inner #portfolio_filter_wrapper.sidebar_content { width: 100%; }
.portfolio_next_prev_wrapper { width: calc(100% - 265px); margin-left: 265px; }
.portfolio_next_prev_wrapper .portfolio_prev, .portfolio_next_prev_wrapper .portfolio_next { height: 400px; }
#page_content_wrapper iframe, .page_content_wrapper iframe, #page_content_wrapper img, .page_content_wrapper img { max-width: 100%; }
#page_content_wrapper .inner .sidebar_content.full_width#blog_grid_wrapper, .page_content_wrapper .inner .sidebar_content.full_width.blog_grid_wrapper { width: 100%; }
body.page-template-blog_g-php .post.type-post, body.error404 .post.type-post, body.page-template-galleries-php .galleries.type-galleries, body.tax-gallerycat .galleries.type-galleries, .ppb_blog_posts .post.type-post, body.archive #blog_grid_wrapper .post.type-post { width: 30.6%; }
.post_wrapper.grid_layout .slider_wrapper { min-height: 150px; }
.page_content_wrapper.fullwidth #portfolio_filter_wrapper.gallery, #page_content_wrapper.fullwidth #portfolio_filter_wrapper.gallery, .page_content_wrapper.fullwidth .portfolio_filter_wrapper.gallery, #page_content_wrapper.fullwidth .portfolio_filter_wrapper.gallery { width: 100%; margin: 0; }
}

@media only screen and (max-width: 960px) {
	.social_wrapper.leftmenu, .company_info { display: none; }
}

@media only screen and (min-width: 768px) and (max-width: 1024px) {
	body.page-template-blog_g-php .post.type-post, body.error404 .post.type-post, body.page-template-galleries-php .galleries.type-galleries, body.tax-gallerycat .galleries.type-galleries, .ppb_blog_posts .post.type-post, body.archive #blog_grid_wrapper .post.type-post
	{
		width: 100%%;
	}
}
@media only screen and (min-width: 1024px) and (max-width: 1090px) {
	body.page-template-blog_g-php .post.type-post, body.error404 .post.type-post, body.page-template-galleries-php .galleries.type-galleries, body.tax-gallerycat .galleries.type-galleries, .ppb_blog_posts .post.type-post, body.archive #blog_grid_wrapper .post.type-post
	{
		width: 47%%;
	}
}
@media only screen and (min-width: 1600px) {
	body.page-template-blog_g-php .post.type-post, body.error404 .post.type-post, body.page-template-galleries-php .galleries.type-galleries, body.tax-gallerycat .galleries.type-galleries, .ppb_blog_posts .post.type-post, body.archive #blog_grid_wrapper .post.type-post
	{
		width: 31.6%%;
	}
}
@media only screen and (min-width: 2000px) {
	body.page-template-blog_g-php .post.type-post, body.error404 .post.type-post, body.page-template-galleries-php .galleries.type-galleries, body.tax-gallerycat .galleries.type-galleries, .ppb_blog_posts .post.type-post, body.archive #blog_grid_wrapper .post.type-post
	{
		width: 32%%;
	}
}
#blog_grid_wrapper.sidebar_content:not(.full_width) .post.type-post
{
	width: 100%;
}
#page_content_wrapper .inner #blog_grid_wrapper.sidebar_content { width: 70%; margin-right: 0; }


@media only screen and (max-width: 1019px) {
	.three_cols.gallery .element { width: 47%; }
}

#page_content_wrapper .inner .sidebar_content #commentform p.comment-form-author, #page_content_wrapper .inner .sidebar_content #commentform p.comment-form-email, #page_content_wrapper .inner .sidebar_content #commentform p.comment-form-url { width: 29.4%; }
#commentform p.comment-form-author, #commentform p.comment-form-email, #commentform p.comment-form-url { width: 30.6%; }
}

<?php
	}
?>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');

if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>