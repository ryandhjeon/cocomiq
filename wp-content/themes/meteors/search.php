<?php
/**
 * The main template file for display blog page.
 *
 * @package WordPress
*/

get_header(); 
?>

<?php
$page_sidebar = 'Search Sidebar';
?>

<!-- Begin content -->

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content full_width nopadding">

    			<div class="sidebar_content">
    			
    			<div class="search_form_wrapper">
	    			<h5><?php printf( __( 'Search Results for &quot;%s&quot;', '' ), '' . get_search_query() . '' ); ?></h5>
	    			<?php _e( "If you didn't find what you were looking for, try a new search.", THEMEDOMAIN ); ?><br/><br/>
	    			
	    			<form class="searchform" role="search" method="get" action="<?php echo home_url(); ?>">
						<input style="width:89%" type="text" class="field searchform-s" name="s" value="<?php the_search_query(); ?>" title="<?php _e( 'Type to search and hit enter...', THEMEDOMAIN ); ?>">
						<button type="submit" id="searchsubmit" class="button submit">
			                <i class="fa fa-search"></i>
			            </button>
					</form>
    			</div>
					
<?php
if (have_posts()) : while (have_posts()) : the_post();
?>

<!-- Begin each blog post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_wrapper">
	    
	    <div class="post_content_wrapper">
	    
			<div class="one">
				<?php
					$post_type = get_post_type();
					$post_type_class = 'fa-file-text-o';
					$post_type_title = '';
					
					switch($post_type)
					{
						case 'galleries':
							$post_type_class = 'fa-picture-o';
							$post_type_title = __( 'Gallery', THEMEDOMAIN );
						break;
						
						case 'page':
						default:
							$post_type_class = 'fa-file-text-o';
							$post_type_title = __( 'Page', THEMEDOMAIN );
						break;
						
						case 'portfolios':
							$post_type_class = 'fa-folder-open-o';
							$post_type_title = __( 'Portfolio', THEMEDOMAIN );
						break;
						
						case 'services':
							$post_type_class = 'fa-star';
							$post_type_title = __( 'Service', THEMEDOMAIN );
						break;
						
						case 'clients':
							$post_type_class = 'fa-user';
							$post_type_title = __( 'Client', THEMEDOMAIN );
						break;
					}
				?>
				<div class="post_type_icon">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr($post_type_title); ?>" class="tooltip">
						<i class="fa <?php echo esc_attr($post_type_class); ?>"></i>
					</a>
				</div>
			    <div class="post_header search">
			    	<h6><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
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
				    
				    <?php
				    	the_excerpt();
				    ?>
			    </div>
			</div>
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
		?>
				<br class="clear"/>
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
		     <?php
		     }
		?>
    	
    	<br class="clear"/><br/>	
    	</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar($page_sidebar); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    	</div>
    	
    </div>
    <!-- End main content -->
    </div>
	
</div>  
<br class="clear"/>
<?php get_footer(); ?>