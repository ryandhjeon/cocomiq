<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if (!isset( $content_width ) ) $content_width = 1170;

if(session_id() == '') {
	session_start();
}
 
global $pp_homepage_style;
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.esc_attr($pp_homepage_style).'"'; } ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="format-detection" content="telephone=no">

<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo esc_url($pp_favicon); ?>" />
<?php
	}
?>

<?php
if(is_single())
{
	$image_id = get_post_thumbnail_id(get_the_ID());
	$fb_thumb = wp_get_attachment_image_src($image_id, 'gallery_grid', true);
	if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
	{
		$image_desc = get_post_field('post_content', $post->ID);
	?>
	<meta property="og:image" content="<?php echo esc_url($fb_thumb[0]); ?>"/>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>"/>
	<meta property="og:description" content="<?php echo strip_tags(strip_shortcodes($image_desc)); ?>"/>
	<?php
	}
}
?>

<?php
	/**
    *	Setup code before </head>
    **/
	$pp_before_head_code = get_option('pp_before_head_code');
	
	if(!empty($pp_before_head_code))
	{
		echo stripslashes($pp_before_head_code);
	}
	
	//Get shop columns
	global $shop_product_columns;
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
	<?php
		//Check if disable right click
		$pp_enable_right_click = get_option('pp_enable_right_click');
		
		//Check if disable image dragging
		$pp_enable_dragging = get_option('pp_enable_dragging');
		
		//Check if use reflection in flow gallery
		$pp_flow_enable_reflection = get_option('pp_flow_enable_reflection');
		
		//Check if use AJAX search
		$pp_ajax_search = get_option('pp_ajax_search');
		
		//Check if sticky menu
		$pp_menu_layout = get_option('pp_menu_layout');
		$pp_fixed_menu = '';
		if($pp_menu_layout == 'topmenu_fixed')
		{
			$pp_fixed_menu = 'true';
		}
		
		//Check if display top bar
		$pp_topbar = get_option('pp_topbar');
	?>
	<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo esc_attr($pp_flow_enable_reflection); ?>"/>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo esc_attr($pp_enable_right_click); ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo esc_attr($pp_enable_dragging); ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo esc_url(home_url()); ?>"/>
	<input type="hidden" id="pp_ajax_search" name="pp_ajax_search" value="<?php echo esc_attr($pp_ajax_search); ?>"/>
	<input type="hidden" id="pp_fixed_menu" name="pp_fixed_menu" value="<?php echo esc_attr($pp_fixed_menu); ?>"/>
	<input type="hidden" id="pp_menu_layout" name="pp_menu_layout" value="<?php echo esc_attr($pp_menu_layout); ?>"/>
	<input type="hidden" id="pp_topbar" name="pp_topbar" value="<?php echo esc_attr($pp_topbar); ?>"/>
	<input type="hidden" id="post_client_column" name="post_client_column" value="4"/>
	
	<?php
		//Check footer sidebar columns
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo esc_attr($pp_footer_style); ?>"/>
	
	<!-- Begin mobile menu -->
	<div class="mobile_menu_wrapper">
		<a id="close_mobile_menu" href="#"><i class="fa fa-times-circle"></i></a>
	    <?php 
	    	//Check if has custom menu
			if(is_object($post) && $post->post_type == 'page')
			{
			    $page_menu = get_post_meta($post->ID, 'page_menu', true);
			}	
			
			if(empty($page_menu))
			{
		    	if ( has_nav_menu( 'primary-menu' ) ) 
				{
				    //Get page nav
				    wp_nav_menu( 
				        	array( 
				        		'menu_id'			=> 'mobile_main_menu',
		    		    		'menu_class'		=> 'mobile_main_nav',
				        		'theme_location' 	=> 'primary-menu',
				        	) 
				    ); 
				}
			}
			else
			{
			 	if( $page_menu && is_nav_menu( $page_menu ) ) {  
			        wp_nav_menu( 
			            array(
			                'menu' => $page_menu,
			                'menu_id'			=> 'mobile_main_menu',
			            	'menu_class'		=> 'mobile_main_nav',
			            )
			        );
			    }
			}
	    ?>
	</div>
	<!-- End mobile menu -->

	<!-- Begin template wrapper -->
	<?php 
		//Get page ID
		if(is_object($post))
		{
		    $page = get_page($post->ID);
		}
		$current_page_id = '';
		
		if(isset($page->ID))
		{
		    $current_page_id = $page->ID;
		}
		elseif(is_home())
		{
		    $current_page_id = get_option('page_on_front');
		}
		
	    $page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
	?>
	<div id="wrapper" <?php if(!empty($page_menu_transparent)) { ?>class="hasbg"<?php } ?>>
	
		<?php
			//Get main menu layout
			$pp_menu_layout = get_option('pp_menu_layout');
			
			switch($pp_menu_layout)
			{
				case 'topmenu':
				case 'topmenu_fixed':
				default:
					get_template_part("/templates/template-topmenu");
				break;
				
				case 'leftmenu':
					get_template_part("/templates/template-leftmenu");
				break;
			}
		?>