<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header();

global $global_pp_topbar;

/**
*	Get current page id
**/

$current_page_id = $post->ID;

?>

<?php
//If display feat content
$pp_blog_feat_content = get_option('pp_blog_feat_content');

/**
*	Get current page id
**/

$current_page_id = $post->ID;
$post_gallery_id = '';
if(!empty($pp_blog_feat_content))
{
	$post_gallery_id = get_post_meta($current_page_id, 'post_gallery_id', true);
}
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg<?php } ?> <?php if(empty($page_menu_transparent)) { ?>notransparent<?php } ?> <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar<?php } ?>">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

    		<div class="sidebar_content left_sidebar">
					
<?php
if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(!empty($pp_blog_feat_content) && has_post_thumbnail(get_the_ID(), 'large'))
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
	    	if(!empty($pp_blog_feat_content) )
	    	{
			    //Get post featured content
			    $post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
			    
			    switch($post_ft_type)
			    {
			    	case 'Image':
			    	default:
			        	if(!empty($image_thumb))
			        	{
			        		$large_image_url = wp_get_attachment_image_src($image_id, 'original', true);
			        		$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
			?>
			
			    	    <div class="post_img static">
			    	    	<a href="<?php echo esc_url($large_image_url[0]); ?>" class="img_frame">
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
			} //End if
			?>
		    
		    <?php
		    	//Check post format
		    	$post_format = get_post_format(get_the_ID());
				
				switch($post_format)
				{
					case 'quote':
			?>
					
					<div class="post_header">
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
					</div>
			<?php
					break;
					
					case 'link':
			?>
					
					<div class="post_header">
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
				    	<h5><?php the_title(); ?></h5>
			    	</div>
					<br class="clear"/>
				    
				    <?php
				    	the_content();
						wp_link_pages();
				    ?>
				    
			    </div>
		    <?php
		    		break;
		    	}
		    ?>
			<br class="clear"/>
			<?php
			    $pp_blog_display_author = get_option('pp_blog_display_author');
			    
			    if($pp_blog_display_author)
			    {
			?>
			<div id="about_the_author">
			    <div class="gravatar"><?php echo get_avatar( get_the_author_meta('email'), '80' ); ?></div>
			    <div class="author_detail">
			     <?php echo _e( 'Written By', THEMEDOMAIN ); ?>&nbsp;<?php echo get_the_author_meta('user_nicename'); ?>
			     <?php echo _e( 'On', THEMEDOMAIN ); ?>&nbsp;<?php echo get_the_time(THEMEDATEFORMAT); ?>
			    </div>
			</div>
			
			<?php
			    }
			?>
			
			<?php
			 $pp_blog_display_tags = get_option('pp_blog_display_tags');
			
			    if(has_tag() && !empty($pp_blog_display_tags))
			    {
			?>
			    <div class="post_excerpt post_tag">
			    	<i class="fa fa-tags"></i>
			    	<?php the_tags('', ', ', '<br />'); ?>
			    </div>
			<?php
			    }
			?>
			
			<br class="clear"/><br/><hr/><br/><br/>
			
			<?php
			    $pp_blog_display_related = get_option('pp_blog_display_related');
			    
			    if($pp_blog_display_related)
			    {
			?>
			
			<?php
			//for use in the loop, list 9 post titles related to post's tags on current post
			$tags = wp_get_post_tags($post->ID);
			
			if ($tags) {
			
			    $tag_in = array();
			  	//Get all tags
			  	foreach($tags as $tags)
			  	{
			      	$tag_in[] = $tags->term_id;
			  	}
			
			  	$args=array(
			      	  'tag__in' => $tag_in,
			      	  'post__not_in' => array($post->ID),
			      	  'showposts' => 4,
			      	  'ignore_sticky_posts' => 1,
			      	  'orderby' => 'date',
			      	  'order' => 'DESC'
			  	 );
			  	$my_query = new WP_Query($args);
			  	$i_post = 1;
			  	
			  	if( $my_query->have_posts() ) {
			  	  	echo '<h5 class="related_post"><span>'.__( 'You might also like', THEMEDOMAIN ).'</span></h5><br class="clear"/>';
			 ?>
			 	<ul class="posts blog">
			    	 <?php
			    	 	global $have_related;
			    	    while ($my_query->have_posts()) : $my_query->the_post();
			    	    $have_related = TRUE; 
			    	 ?>
			    	    <li>
			    	    	<?php
			    	    		if(has_post_thumbnail($post->ID, 'thumbnail'))
			    				{
			    					$image_id = get_post_thumbnail_id($post->ID);
			    					$image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
			    	    	?>
			    	    	<div class="post_circle_thumb">
			    	    		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="post_ft" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php the_title(); ?>"/></a>
			    	    	</div>
			    	    	<?php
			    	    		}
			    	    	?>
			    	    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			    		</li>
			    	  <?php
			    	  		$i_post++;
			    			endwhile;
			    			    
			    			wp_reset_query();
			    	  ?>
			      
			  	</ul>
			<?php
			  	}
			}
			?>
			
			<?php
			    } //end if show related
			?>
			
			<?php
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
			
			    $pp_blog_next_prev = get_option('pp_blog_next_prev');
			    
			    if($pp_blog_next_prev)
			    {
			?>
			<?php
			    	//Get Previous and Next Post
			    	$prev_post = get_previous_post();
			    	$next_post = get_next_post();
			?>
			<div class="blog_next_prev_wrapper">
			   <div class="post_previous">
			      	<?php
			    	    //Get Previous Post
			    	    if (!empty($prev_post)): 
			    	    	$prev_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'thumbnail', true);
			    	    	if(isset($prev_image_thumb[0]))
			    	    	{
								$image_file_name = basename($prev_image_thumb[0]);
			    	    	}
			    	?>
			      		<span class="post_previous_icon"><i class="fa fa-angle-left"></i></span>
			      		<div class="post_previous_content">
			      			<h6><?php echo _e( 'Previous Article', THEMEDOMAIN ); ?></h6>
			      			<strong><a <?php if(isset($prev_image_thumb[0]) && $image_file_name!='default.png') { ?>class="post_prev_next_link" data-img="<?php echo esc_url($prev_image_thumb[0]); ?>"<?php } ?> href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a></strong>
			      		</div>
			      	<?php endif; ?>
			   </div>
			<span class="separated"></span>
			   <div class="post_next">
			   		<?php
			    	    //Get Next Post
			    	    if (!empty($next_post)): 
			    	    	$next_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail', true);
			    	    	if(isset($next_image_thumb[0]))
			    	    	{
								$image_file_name = basename($next_image_thumb[0]);
			    	    	}
			    	?>
			      		<span class="post_next_icon"><i class="fa fa-angle-right"></i></span>
			      		<div class="post_next_content">
			      			<h6><?php echo _e( 'Next Article', THEMEDOMAIN ); ?></h6>
			      			<strong><a <?php if(isset($prev_image_thumb[0]) && $image_file_name!='default.png') { ?>class="post_prev_next_link" data-img="<?php echo esc_url($next_image_thumb[0]); ?>"<?php } ?> href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a></strong>
			      		</div>
			      	<?php endif; ?>
			   </div>
			</div>
			<?php
			    	//If has previous or next post then add line break
			    	if(!empty($prev_post) OR !empty($next_post))
			    	{
			    		echo '<br/>';
			    	}
			?>
			<?php
			    }
			?>
			
	    </div>
	    
	    <br class="clear"/>
	    
	</div>

</div>
<!-- End each blog post -->

<?php
if (comments_open($post->ID)) 
{
?>
<div class="fullwidth_comment_wrapper sidebar">
	<?php comments_template( '', true ); ?>
</div>
<?php
}
?>

<?php endwhile; endif; ?>
						
    	</div>

    		<div class="sidebar_wrapper left_sidebar">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar('Single Post Sidebar'); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    
    </div>
    <!-- End main content -->
   
</div>

<?php
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

<br class="clear"/><br/><br/>
</div>
<?php get_footer(); ?>