<?php
/**
 * Template Name: Portfolio Classic Fullwidth
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

get_header();
?>

<?php
	global $page_content_class;
	$page_content_class = 'fullwidth';

    //Include custom header feature
	get_template_part("/templates/template-header");
?>

<!-- Begin content -->
<?php
	//Get number of portfolios per page
	$pp_portfolio_items_page = get_option('pp_portfolio_items_page');
	if(empty($pp_portfolio_items_page))
	{
		$pp_portfolio_items_page = 9;
	}
	
	//Get all portfolio items for paging
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page='.$pp_portfolio_items_page;
	if(!empty($term))
	{
	    $query_string .= '&posts_per_page=-1&portfoliosets='.$term;
	}
	else
	{
		$query_string .= '&posts_per_page='.$pp_portfolio_items_page;
	}
	query_posts($query_string);
?>

<?php  
//Get all sets and sorting option
$pp_filterable_enable = get_option('pp_filterable_enable');
if(!empty($pp_filterable_enable))
{
$pp_portfolio_set_sort = get_option('pp_portfolio_set_sort');

$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby='.$pp_portfolio_set_sort);
    
if(!empty($sets_arr) && empty($term))
{
?>
	<div class="portfolio_filter_dropdown">
		<div class="portfolio_filter_dropdown_title">
			<a><span><?php echo _e( 'Sort Portfolio', THEMEDOMAIN ); ?></span></a>
		</div>
		
		<div class="portfolio_filter_dropdown_select">
			<ul id="portfolio_filters" class="portfolio_select">
				<li class="icon arrow"></li>
				<li class="all-projects active">
		    		<a class="active" href="javascript:;" data-filter="*"><?php echo _e( 'All', THEMEDOMAIN ); ?></a>
		    	</li>
		    	<?php
		    		foreach($sets_arr as $key => $set_item)
		    		{
		    	?>
		    	<li class="cat-item <?php echo esc_attr($set_item->slug); ?>" data-type="<?php echo esc_attr($set_item->slug); ?>" style="clear:none">
		    		<a data-filter=".<?php echo esc_attr($set_item->slug); ?>" href="javascript:;" title="<?php echo esc_attr($set_item->name); ?>"><?php echo $set_item->name; ?></a>
		    	</li>
		    	<?php
		    		}
		    	?>
			</ul>
		</div>
	</div>
<?php
}

} //End if enable filterable
?>
    
<div class="inner">

	<div class="inner_wrapper">
	
	<?php
	    if(!empty($post->post_content) && empty($term))
	    {
	?>
	    <div class="standard_wrapper"><?php echo tg_apply_content($post->post_content); ?></div><br class="clear"/>
	<?php
	    }
	    elseif(!empty($term))
	    { 
	    	$ob_term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	?>
	    <div class="standard_wrapper"><h2 class="ppb_title"><?php echo $ob_term->name ?></h2><?php echo $ob_term->description; ?></div><br class="clear"/><br/>
	<?php
	    }
	?>
	
	<div id="page_main_content" class="sidebar_content full_width nopadding">
	
	<div id="portfolio_filter_wrapper" class="three_cols gallery portfolio-content section content clearfix">
	
	<?php
		$key = 0;
		if (have_posts()) : while (have_posts()) : the_post();
			$key++;
			$image_url = '';
			$portfolio_ID = get_the_ID();
					
			if(has_post_thumbnail($portfolio_ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'large', true);
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_grid', true);
			}
			
			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($portfolio_ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
			
			$portfolio_item_set = '';
			$portfolio_item_sets = wp_get_object_terms($portfolio_ID, 'portfoliosets');
			
			if(is_array($portfolio_item_sets))
			{
			    foreach($portfolio_item_sets as $set)
			    {
			    	$portfolio_item_set.= $set->slug.' ';
			    }
			}
	?>
	<div class="element classic3_cols <?php echo esc_attr($portfolio_item_set); ?>">
	
		<div class="one_third gallery3 filterable gallery_type static animated<?php echo $key+1; ?>" data-id="post-<?php echo $key+1; ?>">
		<?php 
				if(!empty($image_url[0]))
				{
			?>		
				<?php
						$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
						$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
						
						switch($portfolio_type)
						{
						case 'External Link':
							$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
					?>
					<a target="_blank" href="<?php echo esc_url($portfolio_link_url); ?>">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt=""/>
		            </a>
					
					<?php
						break;
						//end external link
						
						case 'Portfolio Content':
        				default:
        			?>
        			<a href="<?php echo esc_url(get_permalink($portfolio_ID)); ?>">
        				<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" />
		            </a>
	                
	                <?php
						break;
						//end portfolio content
        				
        				case 'Image':
					?>
					<a data-title="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_url($image_url[0]); ?>" class="fancy-gallery">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" />
	                </a>
					
					<?php
						break;
						//end image
						
						case 'Youtube Video':
					?>
					
					<a title="<?php echo esc_attr(get_the_title()); ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" />
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" class="video-container">
			    	        
			    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end youtube
					
					case 'Vimeo Video':
					?>
					<a title="<?php echo esc_attr(get_the_title()); ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" />
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" class="video-container">
			    	    
			    	        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end vimeo
						
					case 'Self-Hosted Video':
					
						//Get video URL
						$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
						$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					?>
					<a title="<?php echo esc_attr(get_the_title()); ?>" href="#video_self_<?php echo $key; ?>" class="lightbox_vimeo">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="" />
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_self_<?php echo $key; ?>" class="video-container">
			    	    
			    	        <div id="self_hosted_vid_<?php echo $key; ?>"></div>
			    	        <?php do_shortcode('[jwplayer id="self_hosted_vid_'.$key.'" file="'.$portfolio_mp4_url.'" image="'.$preview_image[0].'" width="900" height="488"]'); ?>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end self-hosted
					?>
					
					<?php
						}
						//end switch
					?>
			<?php
				}		
			?>			
		</div>
	
		<br class="clear"/>
		<div id="portfolio_desc_<?php echo esc_attr($portfolio_ID); ?>" class="portfolio_desc portfolio3 filterable">
            <h5><?php echo get_the_title(); ?></h5>
            <div class="post_detail"><?php echo get_the_excerpt(); ?></div>
        </div>
	</div>
	<?php
		endwhile; endif;
	?>
	</div>
	
	<?php
	    if($wp_query->max_num_pages > 1)
	    {
	    	if (function_exists("wpapi_pagination")) 
	    	{
	?>
			<br class="clear"/><br/><br/>
			<div class="standard_wrapper">
	<?php
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
		</div>
	<?php
	     }
	?>
	
	</div>

</div>
</div>
<br class="clear"/><br/><br/><br/>
</div>
<?php get_footer(); ?>