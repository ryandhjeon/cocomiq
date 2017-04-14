<?php
	/**
	*	Get Current page object
	**/
	$page = get_page($post->ID);
	
	/**
	*	Get current page id
	**/
	
	if(!isset($current_page_id) && isset($page->ID))
	{
	    $current_page_id = $page->ID;
	}

    //Get Page RevSlider
    $page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
?>

<?php
//Get page header display setting
$page_title = get_the_title();
$page_show_title = get_post_meta($current_page_id, 'page_show_title', true);

if(is_tag())
{
	$page_show_title = 1;
	$page_title = single_cat_title( '', false );
	$term = 'tag';
} 
elseif(is_category())
{
    $page_show_title = 1;
	$page_title = single_cat_title( '', false );
	$term = 'category';
}
elseif(is_archive())
{
	$page_show_title = 1;

	if ( is_day() ) : 
		$page_title = get_the_date(); 
    elseif ( is_month() ) : 
    	$page_title = get_the_date('F Y'); 
    elseif ( is_year() ) : 
    	$page_title = get_the_date('Y'); 
    else :
    	$page_title = __( 'Blog Archives', THEMEDOMAIN); 
    endif;
    
    $term = 'archive';
    
} 

if(!empty($term))
{
	$page_show_title = 0;
}

if(!empty($page_show_title))
{
	$pp_page_bg = '';
	//Get page featured image
	if(has_post_thumbnail($current_page_id, 'full') && empty($term))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        
        if(isset($image_thumb[0]) && !empty($image_thumb[0]))
        {
        	$pp_page_bg = $image_thumb[0];
        }
    }
    
    global $global_pp_topbar;
?>
<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?>class="hasbg parallax <?php if(empty($page_menu_transparent)) { ?>notransparent<?php } ?>" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo esc_url($pp_page_bg); ?>');"<?php } ?>>
	<div class="page_title_wrapper">
		<h1 <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>class ="withtopbar"<?php } ?>><?php echo $page_title; ?></h1>
		<?php 
			echo dimox_breadcrumbs(); 
		?>
	</div>
	<?php if(!empty($pp_page_bg)) { ?>
		<div class="parallax_overlay_header"></div>
	<?php } ?>
</div>
<?php
}
?>
<br class="clear"/>

<!-- Begin content -->
<?php
global $page_content_class;
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($page_content_class)) { echo $page_content_class; } ?>">