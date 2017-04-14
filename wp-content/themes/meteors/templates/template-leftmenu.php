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
?>

<div class="header_style_wrapper">
<div class="top_bar">

    <div id="menu_wrapper">
    	
    	<!-- Begin logo -->	
    	<?php
    	    //get custom logo
    	    $pp_logo = get_option('pp_logo');
    	    $pp_retina_logo = get_option('pp_retina_logo');
    	    $pp_retina_logo_width = 0;
    	    $pp_retina_logo_height = 0;
    	    			
    	    if(empty($pp_logo) && empty($pp_retina_logo))
    	    {	
    	    	$pp_retina_logo = get_template_directory_uri().'/images/logo@2x.png';
    	    	$pp_retina_logo_width = 100;
    	    	$pp_retina_logo_height = 18;
    	    }

    	    if(!empty($pp_retina_logo))
    	    {	
    	    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
    	    	{
    	    		//Get image width and height
    	    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
    	    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
    	    		
    	    		$pp_retina_logo = $image_logo[0];
    	    		$pp_retina_logo_width = $image_logo[1]/2;
    	    		$pp_retina_logo_height = $image_logo[2]/2;
    	    	}
    	?>		
    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
    	    	<img src="<?php echo $pp_retina_logo; ?>" alt="" width="<?php echo $pp_retina_logo_width; ?>" height="<?php echo $pp_retina_logo_height; ?>"/>
    	    </a>
    	<?php
    	    }
    	    else //if not retina logo
    	    {
    	?>
    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo home_url(); ?>">
    	    	<img src="<?php echo $pp_logo?>" alt=""/>
    	    </a>
    	<?php
    	    }
    	?>
    	
    	<!-- End logo -->
    	
    	<a id="mobile_nav_icon"></a>
    	
        <!-- Begin main nav -->
        <div id="nav_wrapper">
        	<div class="nav_wrapper_inner">
        		<div id="menu_border_wrapper">
        			<?php 	
        				//Check if has custom menu
        				if(is_object($post) && $post->post_type == 'page')
    					{
    						$page_menu = get_post_meta($current_page_id, 'page_menu', true);
    					}
        			
        				if(empty($page_menu))
    					{
    						if ( has_nav_menu( 'primary-menu' ) ) 
    						{
    		    			    wp_nav_menu( 
    		    			        	array( 
    		    			        		'menu_id'			=> 'main_menu',
    		    			        		'menu_class'		=> 'nav',
    		    			        		'theme_location' 	=> 'primary-menu',
    		    			        		'walker' => new tg_walker(),
    		    			        	) 
    		    			    ); 
    		    			}
    		    			else
    		    			{
    			    			echo '<div class="notice">Please setup "Main Menu" using Wordpress Dashboard > Appearance > Menus</div>';
    		    			}
    	    			}
    	    			else
    				    {
    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
    						    wp_nav_menu( 
    						        array(
    						            'menu' => $page_menu,
    						            'walker' => new tg_walker(),
    						            'menu_id'			=> 'main_menu',
    		    			        	'menu_class'		=> 'nav',
    						        )
    						    );
    						}
    				    }
        			?>
        		</div>
        	</div>
        </div>
        
        <!-- End main nav -->
        
        <?php
        	//Display social icons
        	$pp_leftmenu_social = get_option('pp_leftmenu_social');
        	
        	//Check if open link in new window
    		$pp_topbar_social_link_blank = get_option('pp_topbar_social_link_blank');
        	if(!empty($pp_leftmenu_social))
        	{
        ?>
        	<br class="clear"/>
	        <div class="social_wrapper leftmenu">
	    	    <ul>
	    	    	<?php
	    	    		$pp_facebook_username = get_option('pp_facebook_username');
	    	    		
	    	    		if(!empty($pp_facebook_username))
	    	    		{
	    	    	?>
	    	    	<li class="facebook"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> href="<?php echo $pp_facebook_username; ?>"><i class="fa fa-facebook"/></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_twitter_username = get_option('pp_twitter_username');
	    	    		
	    	    		if(!empty($pp_twitter_username))
	    	    		{
	    	    	?>
	    	    	<li class="twitter"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><i class="fa fa-twitter"/></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_flickr_username = get_option('pp_flickr_username');
	    	    		
	    	    		if(!empty($pp_flickr_username))
	    	    		{
	    	    	?>
	    	    	<li class="flickr"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><i class="fa fa-flickr"/></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_youtube_username = get_option('pp_youtube_username');
	    	    		
	    	    		if(!empty($pp_youtube_username))
	    	    		{
	    	    	?>
	    	    	<li class="youtube"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Youtube" href="http://youtube.com/channel/<?php echo $pp_youtube_username; ?>"><i class="fa fa-youtube"/></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_vimeo_username = get_option('pp_vimeo_username');
	    	    		
	    	    		if(!empty($pp_vimeo_username))
	    	    		{
	    	    	?>
	    	    	<li class="vimeo"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><i class="fa fa-vimeo-square"></i></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_tumblr_username = get_option('pp_tumblr_username');
	    	    		
	    	    		if(!empty($pp_tumblr_username))
	    	    		{
	    	    	?>
	    	    	<li class="tumblr"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_google_username = get_option('pp_google_username');
	    	    		
	    	    		if(!empty($pp_google_username))
	    	    		{
	    	    	?>
	    	    	<li class="google"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo $pp_google_username; ?>"><i class="fa fa-google-plus"></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_dribbble_username = get_option('pp_dribbble_username');
	    	    		
	    	    		if(!empty($pp_dribbble_username))
	    	    		{
	    	    	?>
	    	    	<li class="dribbble"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><i class="fa fa-dribbble"></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	    		$pp_linkedin_username = get_option('pp_linkedin_username');
	    	    		
	    	    		if(!empty($pp_linkedin_username))
	    	    		{
	    	    	?>
	    	    	<li class="linkedin"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo $pp_linkedin_username; ?>"><i class="fa fa-linkedin"></i></a></li>
	    	    	<?php
	    	    		}
	    	    	?>
	    	    	<?php
	    	            $pp_pinterest_username = get_option('pp_pinterest_username');
	    	            
	    	            if(!empty($pp_pinterest_username))
	    	            {
	    	        ?>
	    	        <li class="pinterest"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>"><i class="fa fa-pinterest"></i></a></li>
	    	        <?php
	    	            }
	    	        ?>
	    	        <?php
	    	        	$pp_instagram_username = get_option('pp_instagram_username');
	    	        	
	    	        	if(!empty($pp_instagram_username))
	    	        	{
	    	        ?>
	    	        <li class="instagram"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>"><i class="fa fa-instagram"></i></a></li>
	    	        <?php
	    	        	}
	    	        ?>
	    	        <?php
	    	        	$pp_behance_username = get_option('pp_behance_username');
	    	        	
	    	        	if(!empty($pp_behance_username))
	    	        	{
	    	        ?>
	    	        <li class="behance"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Behance" href="http://behance.net/<?php echo $pp_behance_username; ?>"><i class="fa fa-behance-square"></i></a></li>
	    	        <?php
	    	        	}
	    	        ?>
	    	    </ul>
	    	</div>
        <?php
        	}
        ?>
        
        <?php
        	$pp_leftmenu_footer_text = get_option('pp_leftmenu_footer_text');
        	
        	if(!empty($pp_leftmenu_footer_text))
        	{
	        	echo '<div class="company_info">'.stripslashes($pp_leftmenu_footer_text).'</div>';
        	}
        ?>

        </div>
    </div>
</div>