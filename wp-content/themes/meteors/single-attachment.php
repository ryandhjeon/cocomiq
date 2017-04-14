<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
					
<?php

global $more; $more = false; # some wordpress wtf logic

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
	$image_id = $post->ID;
								
	$image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
?>
						
<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper full">
	
		<?php
	    	if(!empty($image_thumb))
	    	{
	    ?>
	    
	    <div class="post_img">
	    	<img src="<?php echo esc_url($image_thumb[0]); ?>" alt="" class="" style="width:<?php echo esc_attr($image_thumb[1]); ?>px;height:<?php echo esc_attr($image_thumb[2]); ?>px;"/>
	    </div>
	    
	    <?php
	    	}
	    ?>
	    
	    <div class="post_header full">
	    	<div class="gallery_a_title">
	    		<h5><?php the_title(); ?></h5><span class="caption"><?php the_content(); ?></span>	
	    	</div>
	    </div>
	    
	</div>

</div>
<!-- End each blog post -->

<div class="fullwidth_comment_wrapper">
	<?php comments_template( '' ); ?>
</div>

<?php wp_link_pages(); ?>

<?php endwhile; endif; ?>
    	
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

<br class="clear"/><br/>
<?php get_footer(); ?>