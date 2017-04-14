<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

get_header(); 
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content">
					
<?php

global $more; $more = false; 

$query_string ="post_type=post&paged=$paged";
query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();
	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	}
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
	    	<?php
			    //Get post featured content
			    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
			    
			    switch($post_ft_type)
			    {
			    	case 'Image':
			    	default:
			        	if(!empty($image_thumb))
			        	{
			        		$pp_menu_layout = get_option('pp_menu_layout');
			        		
			        		if($pp_menu_layout != 'leftmenu')
							{
								$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
							}
							else
							{
			        			$small_image_url = wp_get_attachment_image_src($image_id, 'large', true);
			        		}
			?>
			
			    	    <div class="post_img static">
			    	    	<a href="<?php the_permalink(); ?>">
			    	    		<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" class="" style="width:<?php echo esc_attr($small_image_url[1]); ?>px;height:<?php echo esc_attr($small_image_url[2]); ?>px;"/>
				            </a>
			    	    </div>
			
			<?php
			    		}
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$post_ft_vimeo = get_post_meta(get_the_ID(), 'post_ft_vimeo', true);
			?>
			    		<?php echo do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Youtube Video':
			    		$post_ft_youtube = get_post_meta(get_the_ID(), 'post_ft_youtube', true);
			?>
			    		<?php echo do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    	case 'Gallery':
			    		$post_ft_gallery = get_post_meta(get_the_ID(), 'post_ft_gallery', true);
			?>
			    		<?php echo do_shortcode('[tg_gallery_slider gallery_id="'.$post_ft_gallery.'" width="670" height="270"]'); ?>
			    		<br/>
			<?php
			    	break;
			    	
			    } //End switch
			?>
		    
		    <?php
		    	//Check post format
		    	$post_format = get_post_format(get_the_ID());
				
				switch($post_format)
				{
					case 'quote':
			?>
					
					<div class="post_quote_title">
					    <div class="post_detail">
					    	<?php echo get_the_time('d M'); ?>
					    	<?php
					    		//Get Post's Categories
					    		$post_categories = wp_get_post_categories($post->ID);
					    		if(!empty($post_categories))
					    		{
					    	?>
					    		<?php echo _e( 'In', THEMEDOMAIN ); ?>
					    	<?php
					    	    	foreach($post_categories as $c)
					    	    	{
					    	    		$cat = get_category( $c );
					    	?>
					    	    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>
					    	<?php
					    	    	}
					    	    }
					    	?>
					    </div>
					    <a href="<?php the_permalink(); ?>"><?php the_content(); ?></a>
					</div>
			<?php
					break;
					
					case 'link':
			?>
					
					<div class="post_quote_title">
					    <div class="post_detail">
					    	<?php echo get_the_time('d M'); ?>
					    	<?php
					    		//Get Post's Categories
					    		$post_categories = wp_get_post_categories($post->ID);
					    		if(!empty($post_categories))
					    		{
					    	?>
					    		<?php echo _e( 'In', THEMEDOMAIN ); ?>
					    	<?php
					    	    	foreach($post_categories as $c)
					    	    	{
					    	    		$cat = get_category( $c );
					    	?>
					    	    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>
					    	<?php
					    	    	}
					    	    }
					    	?>
					    </div>
					    <?php the_content(); ?>
					</div>
			<?php
					break;
					
					default:
		    ?>
		    
			    <div class="post_header">
			    	<div class="post_header_title">
			    		<div class="post_detail">
					    	<?php echo get_the_time('d M'); ?>
					    	<?php
					    		//Get Post's Categories
								$post_categories = wp_get_post_categories($post->ID);
								if(!empty($post_categories))
								{
							?>
								<?php echo _e( 'In', THEMEDOMAIN ); ?>
							<?php
							    	foreach($post_categories as $c)
							    	{
							    		$cat = get_category( $c );
							?>
							    	<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a>
							<?php
							    	}
							    }
							?>
						</div>
				    	<h5><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
			    	</div>
					
					<br class="clear"/>
				    
				    <?php
				    	$pp_blog_display_full = get_option('pp_blog_display_full');
				    	
				    	if(!empty($pp_blog_display_full))
				    	{
				    		the_content();
				    	}
				    	else
				    	{
				    		the_excerpt();
				    	}
				    ?>
				    <div class="post_button_wrapper">
				    	<a class="button readmore" href="<?php the_permalink(); ?>"><?php echo _e( 'Read More', THEMEDOMAIN ); ?></a>
				    </div>
			    </div>
		    <?php
		    		break;
		    	}
		    
				//Check if display social sharing
		    	$pp_blog_social_sharing = get_option('pp_blog_social_sharing');
		    	
		    	if(!empty($pp_blog_social_sharing))
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
			
	    </div>
	    
	</div>

</div>
<br class="clear"/>
<!-- End each blog post -->

<?php endwhile; endif; ?>

	    	<?php
	    	if($wp_query->max_num_pages > 1)
			{
				if (function_exists("wpapi_pagination")) 
				{
				    wpapi_pagination($wp_query->max_num_pages);
				}
				else
				{
				?>
				    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
				<?php
				}
			?>
			<div class="pagination_detail">
		     	<?php
		     		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		     	?>
		     	<?php _e( 'Page', THEMEDOMAIN ); ?> <?php echo $paged; ?> <?php _e( 'of', THEMEDOMAIN ); ?> <?php echo $wp_query->max_num_pages; ?>
		     </div>
		     <?php
		     }
		     ?>
    		
			</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar('Blog Sidebar'); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    		
    	</div>
    <!-- End main content -->

</div>  
<br class="clear"/><br/>
</div>
<?php get_footer(); ?>