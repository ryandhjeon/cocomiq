<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/

$current_page_id = $post->ID;

if($post->post_type=='attachment')
{
	get_template_part("single-attachment");
	exit;
}

if($post_type == 'galleries')
{
	get_template_part("single-gallery");
	exit;
}
elseif($post_type == 'portfolios')
{
	//Get portfolio content type
	$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	
	switch($portfolio_type)
	{
		case "Vimeo Video":
			get_template_part("single-portfolio-vimeo");
			exit;
		break;
		
		case "Youtube Video":
			get_template_part("single-portfolio-youtube");
			exit;
		break;
		
		case "Self-Hosted Video":
			get_template_part("single-portfolio-self-hosted");
			exit;
		break;
		
		case "Portfolio Content":
		default:
			get_template_part("single-portfolio-f");
			exit;
		break;
	}
	exit;
}
else
{
	$post_layout = get_post_meta($post->ID, 'post_layout', true);
	
	switch($post_layout)
	{
		case "With Right Sidebar":
		default:
			get_template_part("single-post-r");
			exit;
		break;
		
		case "With Left Sidebar":
			get_template_part("single-post-l");
			exit;
		break;
		
		case "Fullwidth":
			get_template_part("single-post-f");
			exit;
		break;
	}
}
?>