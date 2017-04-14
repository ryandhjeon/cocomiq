<?php
function portfolio_content_create_meta_box() {

	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'content_metabox', 'Content Builder Option', 'portfolio_content_new_meta_box', 'portfolios', 'normal', 'high' );
	}

} 

function portfolio_content_new_meta_box() {
	global $post, $page_postmetas;
	require_once (get_template_directory() . "/lib/contentbuilder_portfolio.shortcode.lib.php");
	
	$ppb_enable = get_post_meta($post->ID, 'ppb_enable');
?>
	<br/>
	
	<strong><?php _e( 'Enable Content Builder', THEMEDOMAIN ); ?></strong>
	<hr class="pp_widget_hr">
	<div class="pp_widget_description"><?php _e( 'To build this page using content builder, please enable this option.', THEMEDOMAIN ); ?></div><br/>
	<input type="checkbox" class="iphone_checkboxes" name="ppb_enable" id="ppb_enable" value="1" <?php if(!empty($ppb_enable)) { ?>checked<?php } ?> />
	
	<?php if(!empty($ppb_enable)) { ?>
	<script>
		jQuery(document).ready(function(){
			jQuery('#postdivrich').hide();
		});
	</script>
	<?php } ?>
	
	<br class="clear"/>
	<input type="hidden" name="ppb_post_type" id="ppb_post_type" value="portfolios"/>
	<input type="hidden" name="ppb_options" id="ppb_options" value=""/>
	<input type="hidden" name="ppb_options_title" id="ppb_options_title" value=""/>
	<ul id="ppb_module_wrapper">
	<?php
		foreach($ppb_shortcodes as $key => $ppb_shortcode)		
		{
			if(isset($ppb_shortcode['icon']) && !empty($ppb_shortcode['icon']))
			{
	?>
	<li data-module="<?php echo $key; ?>" data-title="<?php echo $ppb_shortcode['title']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/builder/<?php echo $ppb_shortcode['icon']; ?>" alt="" title="<?php echo $ppb_shortcode['title']; ?>" class="builder_thumb"/>
		<span class="builder_title"><?php echo $ppb_shortcode['title']; ?></span>
	</li>
	<?php
			}
		}
	?>
	</ul>
	<a id="ppb_sortable_add_button" class="button button-primary" style="margin-left:3px;float:left;"><?php _e( 'Add', THEMEDOMAIN ); ?></a>
	<input type="hidden" id="ppb_inline_current" name="ppb_inline_current" value=""/>
	<input type="hidden" id="ppb_form_data_order" name="ppb_form_data_order" value=""/>

	<?php
		//Get builder item
		$ppb_form_data_order = get_post_meta($post->ID, 'ppb_form_data_order');
		$ppb_form_item_arr = array();
		
		if(isset($ppb_form_data_order[0]))
		{
			$ppb_form_item_arr = explode(',', $ppb_form_data_order[0]);
		}
	?>
	
	<ul id="content_builder_sort" class="ppb_sortable <?php if(!isset($ppb_form_item_arr[0]) OR empty($ppb_form_item_arr[0])) { ?>empty<?php } ?>" rel="content_builder_sort_data"> 
	<?php
		
		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
			foreach($ppb_form_item_arr as $key => $ppb_form_item)
			{
				if(isset($ppb_form_item[0]))
				{
					$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
					$ppb_form_item_size = get_post_meta($post->ID, $ppb_form_item.'_size');
					$ppb_form_item_data_obj = json_decode($ppb_form_item_data[0]);
					$ppb_shortocde_title = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode]['title'];
					$ppb_shortocde_icon = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode]['icon'];
					
					if($ppb_form_item_data_obj->shortcode!='ppb_divider')
					{
						$obj_title_name = $ppb_form_item_data_obj->shortcode.'_title';
						
						if(property_exists($ppb_form_item_data_obj, $obj_title_name))
						{
							$obj_title_name = $ppb_form_item_data_obj->$obj_title_name;
						}
						else
						{
							$obj_title_name = '';
						}
					}
					else
					{
						$obj_title_name = '<span class="shortcode_title" style="margin-left:-5px">Paragraph Break</span>';
						$ppb_shortocde_title = '';
					}
	?>
			<li id="<?php echo $ppb_form_item; ?>" class="ui-state-default <?php echo $ppb_form_item_size[0]; ?> <?php echo $ppb_form_item_data_obj->shortcode; ?>" data-current-size="<?php echo $ppb_form_item_size[0]; ?>">
				<div class="thumb"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/builder/<?php echo $ppb_shortocde_icon; ?>" alt=""/></div>
				<div class="title"><span class="shortcode_title"><?php echo $ppb_shortocde_title; ?></span>&nbsp;<?php echo urldecode($obj_title_name); ?></div>
				<a href="javascript:;" class="ppb_remove">x</a>
				<a data-rel="<?php echo $ppb_form_item; ?>" href="<?php echo admin_url('admin-ajax.php?action=pp_ppb&ppb_post_type=portfolios&shortcode='.$ppb_form_item_data_obj->shortcode.'&rel='.$ppb_form_item.'&width=800&height=900'); ?>" class="ppb_edit"></a>
				<input type="hidden" class="ppb_setting_columns" value="<?php echo $ppb_form_item_size[0]; ?>"/>
				
				
			</li>
	<?php
				}
			}
		}
	?>
	</ul>
	<br class="clear"/><br/><br/>
	
	<strong><?php _e( 'Import Page Content Builder', THEMEDOMAIN ); ?></strong>
	<hr class="pp_widget_hr">
	<div class="pp_widget_description"><?php _e( 'Choose the import file. *Note: Your current content builder content will be overwritten by imported data', THEMEDOMAIN ); ?></div><br/>
	
	<input type="file" id="ppb_import_current_file" name="ppb_import_current_file" value="0" size="25"/>
	<input type="hidden" id="ppb_import_current" name="ppb_import_current"/>
	<input type="submit" id="ppb_import_current_button" class="button" value="Import"/>
	
	<br class="clear"/><br/><br/>
	
	<strong><?php _e( 'Export Current Page Content Builder', THEMEDOMAIN ); ?></strong>
	<hr class="pp_widget_hr">
	<div class="pp_widget_description"><?php _e( 'Click to export current content builder data. *Note: Please make sure you save all changes and no "unsaved" module', THEMEDOMAIN ); ?></div><br/>
	
	<input type="hidden" id="ppb_export_current" name="ppb_export_current"/>
	<input type="submit" id="ppb_export_current_button" name="ppb_export_current_button" class="button" value="Export"/>
	
	<br class="clear"/><br/>
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
	<?php
		foreach($ppb_form_item_arr as $key => $ppb_form_item)
		{
			if(!empty($ppb_form_item))
			{
				$ppb_form_item_data = get_post_meta($post->ID, $ppb_form_item.'_data');
	?>
				jQuery('#<?php echo $ppb_form_item; ?>').data('ppb_setting', '<?php echo addslashes($ppb_form_item_data[0]); ?>');
	<?php
			}
		}
	?>
	});
	</script>
	
<?php

}

//init

add_action('admin_menu', 'portfolio_content_create_meta_box'); 
?>