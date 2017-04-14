<?php
/**
 * The main template file for display single post portfolio.
 *
 * @package WordPress
*/

if(isset($post->ID))
{
    $current_page_id = $post->ID;
}

get_header(); 
?>

<?php
	//Check if use page builder
	$ppb_form_data_order = '';
	$ppb_form_item_arr = array();
	$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);
?>

<?php
	if(!empty($ppb_enable))
	{
?>
<div class="ppb_wrapper <?php if(!empty($pp_page_bg)) { ?>hasbg<?php } ?> <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar<?php } ?>">
<?php
		tg_apply_builder($current_page_id, 'portfolios');
?>
</div>
<?php
	}
	else
	{
?>
<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">

	    		<?php
	    		
	    		if(empty($portfolio_gallery_id))
	    		{
	    			//Get Portfolio content type
	    			$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	    			
	    			switch($portfolio_type)
	    			{
						case 'Image':
						default:
						
		    			$image_thumb = '';
									
						if(has_post_thumbnail(get_the_ID(), 'large'))
						{
						    $image_id = get_post_thumbnail_id($post->ID);
						    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
						    $image_desc = get_post_field('post_content', $image_id);
						}
		    		?>
		    		
		    		<?php
				    	if(!empty($image_thumb))
				    	{
				    ?>
				    
				    <div class="post_img">
				    	<img src="<?php echo esc_url($image_thumb[0]); ?>" alt="" class=""/>
				    </div>
				    <br class="clear"/><br/>
				    
				    <?php
				    	}
			    	break;
			    	
			    	case 'Youtube Video':
			    		$portfolio_video_id = get_post_meta($post->ID, 'portfolio_video_id', true);
			    		
			    		if(!empty($portfolio_video_id))
						{
							echo do_shortcode('[tg_youtube video_id="'.$portfolio_video_id.'" width="960"]');
							echo '<br/>';
						}
			    ?>
			    
			    <?php
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$portfolio_video_id = get_post_meta($post->ID, 'portfolio_video_id', true);
			    		
			    		if(!empty($portfolio_video_id))
						{
							echo do_shortcode('[tg_vimeo video_id="'.$portfolio_video_id.'" width="960"]');
							echo '<br/>';
						}
			    ?>
			    <?php
			    	break;
			    	
					} //End switch
				}
			    ?>
	    	
	    		<?php
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}
		    	?>
		    </div>
		    
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 
		    	
<?php
} // End if not using content builder
?>
		    
		    <?php
		    	$pp_portfolio_next_prev = get_option('pp_portfolio_next_prev');
		    	
		    	if(!empty($pp_portfolio_next_prev))
		    	{
		    
			    $args = array(
			    	'before'           => '<p>' . __('Pages:', THEMEDOMAIN),
			    	'after'            => '</p>',
			    	'link_before'      => '',
			    	'link_after'       => '',
			    	'next_or_number'   => 'number',
			    	'nextpagelink'     => __('Next page', THEMEDOMAIN),
			    	'previouspagelink' => __('Previous page', THEMEDOMAIN),
			    	'pagelink'         => '%',
			    	'echo'             => 1
			    );
			    wp_link_pages($args);
			?>
			<?php
			    	//Get Previous and Next Post
			    	$prev_post = get_previous_post();
			    	
			    	//If previous post is empty then get last post
			    	if(empty($prev_post))
			    	{
				    	$args = array(
						    'numberposts' => 1,
						    'order' => 'ASC',
						    'orderby' => 'menu_order',
						    'post_type' => array('portfolios'),
						);
						$prev_post = get_posts($args);
						
				    	$prev_post_bak = $prev_post[0];
				    	unset($prev_post);
				    	$prev_post = $prev_post_bak;
			    	}
			    	
			    	$next_post = get_next_post();
			    	
			    	//If next post is empty then get first post
			    	if(empty($next_post))
			    	{
				    	$args = array(
						    'numberposts' => 1,
						    'order' => 'DESC',
						    'orderby' => 'menu_order',
						    'post_type' => array('portfolios'),
						);
						$next_post = get_posts($args);
				    	
				    	$next_post_bak = $next_post[0];
				    	unset($next_post);
				    	$next_post = $next_post_bak;
			    	}
			?>
			<div class="portfolio_next_prev_wrapper">
			   <?php
			       //Get Previous Post
			       if (!empty($prev_post)): 
			       
			       	$prev_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'gallery_next_prev', true);
			       	
			       	if(isset($prev_image_thumb[0]) && !empty($prev_image_thumb[0]))
			       	{
			   ?>
			       <div class="portfolio_prev">
				       <div class="effect">
				       		<img src="<?php echo esc_attr($prev_image_thumb[0]); ?>" alt=""/>
				       		<div class="caption">
				       			<div>
					       			<h4><?php echo $prev_post->post_title; ?></h4>
					       			<p><?php echo $prev_post->post_excerpt; ?></p>
					       			<a href="<?php echo get_permalink($prev_post->ID); ?>"></a>
				       			</div>
				       		</div>
				       </div>
			       </div>
			   <?php 
			   		}
			   		endif; ?>
			   <?php
			       //Get Next Post
			       if (!empty($next_post)): 
				   
				   $next_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'gallery_next_prev', true);
				   
				   if(isset($next_image_thumb[0]) && !empty($next_image_thumb[0]))
			       {
			   ?>
			   		<div class="portfolio_next">
				       <div class="effect">
				       		<img src="<?php echo esc_attr($next_image_thumb[0]); ?>" alt=""/>
				       		<div class="caption">
				       			<div>
					       			<h4><?php echo $next_post->post_title; ?></h4>
					       			<p><?php echo $next_post->post_excerpt; ?></p>
					       			<a href="<?php echo get_permalink($next_post->ID); ?>"></a>
				       			</div>
				       		</div>
				       </div>
			       </div>
			   <?php 
			   		}
			   		endif; ?>
			</div>
			<?php
			    
			    //If has previous or next post then add line break
			    if(!empty($prev_post) OR !empty($next_post))
			    {
			        echo '<br class="clear"/>';
			    }
			    
			} //End if display previous and next portfolios
			?>

<?php
	//Check if display social sharing
    $pp_portfolio_social_sharing = get_option('pp_portfolio_social_sharing');
    
    if(!empty($pp_portfolio_social_sharing))
    {
    	global $share_id;
    	global $share_class;
    	$share_id = 'share_post_'.$post->ID;
    	$share_class = 'inline';
?>
<div class="post_share_bubble">
    <?php		
    	//Get Social Share
    	get_template_part("/templates/template-share-blog");
    ?>
    <a href="javascript:;" class="post_share" data-share="<?php echo esc_attr($share_id); ?>" data-parent="post-<?php the_ID(); ?>"><i class="fa fa-share-alt"></i></a>
</div>
<?php
    }
?>

<?php get_footer(); ?>