<?php
//Get theme data
$theme_obj = wp_get_theme('meteors');

define("THEMENAME", $theme_obj['Name']);
define("THEMEDEMO", FALSE);
define("SHORTNAME", "pp");
define("SKINSHORTNAME", "ps");
define("THEMEVERSION", $theme_obj['Version']);
define("THEMEDOMAIN", THEMENAME.'Language');
define("THEMEDEMOURL", $theme_obj['ThemeURI']);
define("THEMEDATEFORMAT", get_option('date_format'));
define("THEMETIMEFORMAT", get_option('time_format'));

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(THEMENAME)."/");
define("THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(THEMENAME)."/");

//Define include fields from skin option
$pp_include_from_skin_arr = array(SHORTNAME.'_menu_font_color', SHORTNAME.'_menu_hover_font_color', SHORTNAME.'_menu_active_font_color', SHORTNAME.'_menu_bg_color', SHORTNAME.'_menu_border_color', SHORTNAME.'_menu_opacity_color', SHORTNAME.'_submenu_font_color', SHORTNAME.'_submenu_hover_font_color', SHORTNAME.'_submenu_bg_color', SHORTNAME.'_content_bg_color', SHORTNAME.'_font_color', SHORTNAME.'_link_color', SHORTNAME.'_hover_link_color', SHORTNAME.'_h1_font_color', SHORTNAME.'_tagline_font_color', SHORTNAME.'_hr_color', SHORTNAME.'_blog_date_bg', SHORTNAME.'_blog_date_color', SHORTNAME.'_blog_date_border', SHORTNAME.'_sidebar_font_color', SHORTNAME.'_sidebar_link_color', SHORTNAME.'_sidebar_hover_link_color', SHORTNAME.'_footer_bg_color', SHORTNAME.'_footer_font_color', SHORTNAME.'_footer_link_color', SHORTNAME.'_footer_hover_link_color', SHORTNAME.'_input_bg_color', SHORTNAME.'_input_font_color', SHORTNAME.'_input_border_color', SHORTNAME.'_input_focus_border_color', SHORTNAME.'_button_bg_color', SHORTNAME.'_button_font_color', SHORTNAME.'_button_border_color', SHORTNAME.'_footer_header_color');

/**
*	Defined all custom font elements
**/
$gg_fonts = array(SHORTNAME.'_menu_font', SHORTNAME.'_header_font', SHORTNAME.'_body_font', SHORTNAME.'_sidebar_title_font', SHORTNAME.'_button_font', SHORTNAME.'_post_meta_font');
global $gg_fonts;

load_theme_textdomain( THEMEDOMAIN, get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";

if ( is_readable($locale_file) )
{
	require_once($locale_file);
}

//If restore default theme settings
if(is_admin() && isset($_POST['pp_restore_flg']) && !empty($_POST['pp_restore_flg']) && $_GET["page"] == "functions.php")
{
	global $wpdb;
	
	//Inject SQL for default setting
	include_once(get_template_directory() . "/restore.php");
}

//If clear cache
if(is_admin() && isset($_POST['method']) && !empty($_POST['method']) && $_POST['method'] == 'clear_cache')
{
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = $upload_dir['basedir'].'/meteors';
	}

	if(file_exists($cache_dir."/combined.js"))
	{
		unlink($cache_dir."/combined.js");
	}
	
	if(file_exists($cache_dir."/combined.css"))
	{
		unlink($cache_dir."/combined.css");
	}
	
	exit;
}

//If import default settings
if(is_admin() && isset($_POST['pp_import_default']) && !empty($_POST['pp_import_default']))
{
	global $wpdb;
	$demo_style = 1;
	
	if(!isset($_POST['pp_import_demo']) OR empty($_POST['pp_import_demo']))
	{
		$_POST['pp_import_demo'] = 1;
	}
	else
	{
		$demo_style = $_POST['pp_import_demo'];
	}
	
	$default_json_settings = get_template_directory().'/cache/demos/'.$demo_style.'.json';

	if(file_exists($default_json_settings))
    {
    	$import_options_json = file_get_contents($default_json_settings);
		$import_options_arr = json_decode($import_options_json, true);
		
		if(!empty($import_options_arr) && is_array($import_options_arr))
		{	
			foreach($import_options_arr as $key => $import_option)
			{	
				$wpdb->query("DELETE FROM `".$wpdb->prefix."options` WHERE option_name = '".$key."'");
				
				$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_name`, `option_value`, `autoload`) VALUES('".$key."', '".$import_option."', 'yes');");
			}
		}
    }
	
	header("Location: admin.php?page=functions.php&saved=true");
	exit;
}

//If import settings
if(is_admin() && isset($_FILES['pp_import_current']["tmp_name"]) && !empty($_FILES['pp_import_current']["tmp_name"]))
{
	global $wpdb;
	
	$import_options_json = file_get_contents($_FILES["pp_import_current"]["tmp_name"]);
	$import_options_arr = json_decode($import_options_json, true);
	
	if(!empty($import_options_arr) && is_array($import_options_arr))
	{	
		foreach($import_options_arr as $key => $import_option)
		{	
			$wpdb->query("DELETE FROM `".$wpdb->prefix."options` WHERE option_name = '".$key."'");
			
			$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_name`, `option_value`, `autoload`) VALUES('".$key."', '".$import_option."', 'yes');");
		}
	}
	
	header("Location: admin.php?page=functions.php&saved=true");
	exit;
}

//If export settings
if(is_admin() && isset($_POST['pp_export_current']) && !empty($_POST['pp_export_current']))
{
	$json_file_name = THEMENAME.'Theme_Export_'.date('m-d-Y_hia');

	header('Content-disposition: attachment; filename='.$json_file_name.'.json');
	header('Content-type: application/json');
	
	/**
	*	Setup admin setting
	**/
	include_once (get_template_directory() . "/lib/admin.lib.php");

	$export_options_arr = array();
	
	if(isset($options) && !empty($options) && is_array($options))
	{
		foreach ($options as $value) 
		{
			if(isset($value['id']) && !empty($value['id']))
			{ 
				$export_options_arr[$value['id']] = get_option($value['id']);
			}
		}
	}

	echo json_encode($export_options_arr);
	
	exit;
}

//If delete sidebar
if(is_admin() && isset($_POST['sidebar_id']) && !empty($_POST['sidebar_id']))
{
	$current_sidebar = get_option('pp_sidebar');
	
	if(isset($current_sidebar[ $_POST['sidebar_id'] ]))
	{
		unset($current_sidebar[ $_POST['sidebar_id'] ]);
		update_option( "pp_sidebar", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete ggfont
if(is_admin() && isset($_POST['ggfont']) && !empty($_POST['ggfont']))
{
	$current_ggfont = get_option('pp_ggfont');
	
	if(isset($current_ggfont[ $_POST['ggfont'] ]))
	{
		unset($current_ggfont[ $_POST['ggfont'] ]);
		update_option( "pp_ggfont", $current_ggfont );
	}
	
	echo 1;
	exit;
}

//If delete image
if(is_admin() && isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_GET["page"]) && $_GET["page"] == "functions.php" )
{
	$current_val = get_option($_POST['field_id']);
	delete_option( $_POST['field_id'] );
	
	echo 1;
	exit;
}

if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'link', 'quote' ) );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'gallery_grid', 705, 705, true );
	add_image_size( 'gallery_masonry', 705, 9999, false );
	add_image_size( 'gallery_next_prev', 800, 450, true );
	add_image_size( 'blog', 700, 9999, false );
	add_image_size( 'blog_f', 960, 9999, false );
	add_image_size( 'related_post', 190, 140, true );
}

/**
*	Setup all theme's library
**/

//Get custom function
require_once (get_template_directory() . "/lib/custom.lib.php");

/**
*	Setup admin setting
**/
require_once (get_template_directory() . "/lib/admin.lib.php");
require_once (get_template_directory() . "/lib/menu.lib.php");
require_once (get_template_directory() . "/lib/twitter.lib.php");
require_once (get_template_directory() . "/lib/cssmin.lib.php");

require_once (get_template_directory() . "/lib/jsmin.lib.php");

/**
*	Setup Sidebar
**/
require_once (get_template_directory() . "/lib/sidebar.lib.php");


// Get Content Builder Module
require_once (get_template_directory() . "/lib/contentbuilder.lib.php");


//Get custom shortcode
require_once (get_template_directory() . "/lib/shortcode.lib.php");


// Setup theme custom widgets
require_once (get_template_directory() . "/lib/widgets.lib.php");


require_once (get_template_directory() . "/fields/page.fields.php");
require_once (get_template_directory() . "/fields/post.fields.php");
require_once (get_template_directory() . "/fields/gallery/tg-gallery.php");


//Check if has new update
include_once(get_template_directory() . '/modules/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

$pp_envato_username = get_option('pp_envato_username');
$pp_envato_api_key = get_option('pp_envato_api_key');
$upgrader = array();

if(!empty($pp_envato_username) && !empty($pp_envato_api_key))
{
	$upgrader = new Envato_WordPress_Theme_Upgrader( $pp_envato_username, $pp_envato_api_key );
	$upgrader_obj = $upgrader->check_for_theme_update();
	
	if($upgrader_obj->updated_themes_count > 0)
	{
		add_action('admin_notices', 'pp_admin_notice');

		function pp_admin_notice() {
			global $current_user ;
		        $user_id = $current_user->ID;
		        /* Check that the user hasn't already clicked to ignore the message */
			if ( ! get_user_meta($user_id, 'pp_ignore_notice') ) {
		        echo '<div class="updated"><p>'; 
		        printf(__(' There is update available for '.THEMENAME.' theme. Go to "Theme Setting > Auto update" tab to update the theme. | <a href="%1$s">Hide</a>'), '?pp_ignore_notice=0');
		        echo "</p></div>";
			}
		}
		
		add_action('admin_init', 'pp_nag_ignore');
		
		function pp_nag_ignore() {
			global $current_user;
		        $user_id = $current_user->ID;
		        /* If user clicks to ignore the notice, add that to their user meta */
		        if ( isset($_GET['pp_ignore_notice']) && '0' == $_GET['pp_ignore_notice'] ) {
		             add_user_meta($user_id, 'pp_ignore_notice', 'true', true);
			}
		}
	}
}

/**
*	Setup one click update theme function
**/
add_action('wp_ajax_pp_update_theme', 'pp_update_theme');
add_action('wp_ajax_nopriv_pp_update_theme', 'pp_update_theme');

function pp_update_theme() {
	if(is_admin())
	{
		include_once(get_template_directory() . '/modules/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');

		$pp_envato_username = get_option('pp_envato_username');
		$pp_envato_api_key = get_option('pp_envato_api_key');
		
		if(!empty($pp_envato_username) && !empty($pp_envato_api_key))
		{
			$upgrader = new Envato_WordPress_Theme_Upgrader( $pp_envato_username, $pp_envato_api_key );
			$upgrader_obj = $upgrader->check_for_theme_update();
			
			if($upgrader_obj->updated_themes_count > 0)
			{
				$result = $upgrader->upgrade_theme();
				echo $result->installation_feedback;
			}
			else
			{
				echo 'There is no theme update available';
			}
		}
		else
		{
			echo 'Please enter Envato username and API Key';
		}
	}
}


/**
*	Setup AJAX portfolio content builder function
**/
add_action('wp_ajax_pp_ppb', 'pp_ppb');
add_action('wp_ajax_nopriv_pp_ppb', 'pp_ppb');

function pp_ppb() {
	if(is_admin() && isset($_GET['shortcode']) && !empty($_GET['shortcode']))
	{
		if(isset($ppb_post_type) && $ppb_post_type == 'page')
		{
			require_once (get_template_directory() . "/lib/contentbuilder.shortcode.lib.php");
		}
		else if(isset($ppb_post_type) && $ppb_post_type == 'portfolios')
		{
			require_once (get_template_directory() . "/lib/contentbuilder_portfolio.shortcode.lib.php");
		}
		else
		{
			require_once (get_template_directory() . "/lib/contentbuilder.shortcode.lib.php");
		}
		//pp_debug($ppb_shortcodes);
		
		if(isset($ppb_shortcodes[$_GET['shortcode']]) && !empty($ppb_shortcodes[$_GET['shortcode']]))
		{
			$selected_shortcode = $_GET['shortcode'];
			$selected_shortcode_arr = $ppb_shortcodes[$_GET['shortcode']];
			//pp_debug($selected_shortcode_arr);
?>

			<div id="ppb_inline_<?php echo $selected_shortcode; ?>" data-shortcode="<?php echo $selected_shortcode; ?>" class="ppb_inline">
			<div class="wrap">
				<h2><?php echo $selected_shortcode_arr['title']; ?></h2>
				<a id="save_<?php echo $_GET['rel']; ?>" data-parent="ppb_inline_<?php echo $selected_shortcode; ?>" class="button-primary ppb_inline_save" href="#"><?php _e( 'Update', THEMEDOMAIN ); ?></a>
				<a class="button" href="javascript:;" onClick="jQuery.fancybox.close();">Cancel</a>
			</div>
			<br style="clear:both"/><br/><hr/><br/>
			<?php
				if(isset($selected_shortcode_arr['title']) && $selected_shortcode_arr['title']!='Divider')
				{
			?>
			<label for="<?php echo $selected_shortcode; ?>_title"><?php _e( 'Title', THEMEDOMAIN ); ?></label><span class="label_desc"><?php _e( 'Enter Title for this content', THEMEDOMAIN ); ?></span><br/>
			<input type="text" id="<?php echo $selected_shortcode; ?>_title" name="<?php echo $selected_shortcode; ?>_title" data-attr="title" value="Title" class="ppb_input"/>
			<br/><br/>
			<?php
				}
				else
				{
			?>
			<input type="hidden" id="<?php echo $selected_shortcode; ?>_title" name="<?php echo $selected_shortcode; ?>_title" data-attr="title" value="<?php echo $selected_shortcode_arr['title']; ?>" class="ppb_input"/>
			<?php
				}
			?>
			
			<?php
				foreach($selected_shortcode_arr['attr'] as $attr_name => $attr_item)
				{
					if(!isset($attr_item['title']))
					{
						$attr_title = ucfirst($attr_name);
					}
					else
					{
						$attr_title = $attr_item['title'];
					}
				
					if($attr_item['type']=='jslider')
					{
			?>
			<div style="position:relative">
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/><br/>
			<input name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" type="range" class="ppb_input" min="<?php echo $attr_item['min']; ?>" max="<?php echo $attr_item['max']; ?>" step="<?php echo $attr_item['step']; ?>" value="<?php echo $attr_item['std']; ?>" />
			
			<output for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" onforminput="value = foo.valueAsNumber;"></output>
			</div>
			<br/>
			<?php
					}
			
					if($attr_item['type']=='file')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<input name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" type="text"  class="ppb_input ppb_file" />
			<a id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>_button" name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>">Upload</a>
			<br/><br/>
			<?php
					}
					
					if($attr_item['type']=='select')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<select name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" class="ppb_input">
				<?php
						foreach($attr_item['options'] as $attr_key => $attr_item_option)
						{
				?>
						<option value="<?php echo $attr_key; ?>"><?php echo ucfirst($attr_item_option); ?></option>
				<?php
						}
				?>
			</select>
			<br class="clear"/><br/>
			<?php
					}
					
					if($attr_item['type']=='select_multiple')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<select name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" class="ppb_input" multiple="multiple">
				<?php
						foreach($attr_item['options'] as $attr_key => $attr_item_option)
						{
							if(!empty($attr_item_option))
							{
				?>
							<option value="<?php echo $attr_key; ?>"><?php echo ucfirst($attr_item_option); ?></option>
				<?php
							}
						}
				?>
			</select>
			<br class="clear"/><br/>
			<?php
					}
					
					if($attr_item['type']=='text')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<input name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" type="text" class="ppb_input" />
			<br/><br/>
			<?php
					}
					
					if($attr_item['type']=='colorpicker')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/><br/>
			<input name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" type="text" class="ppb_input color_picker" readonly />
			<div id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>').click()" style="background-color:<?php echo $attr_item['std']; ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png);margin-top:3px">&nbsp;</div>
			<br/><br/><br/>
			<?php
					}
					
					if($attr_item['type']=='textarea')
					{
			?>
			<label for="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>"><?php echo $attr_title; ?></label><span class="label_desc"><?php echo $attr_item['desc']; ?></span><br/>
			<textarea name="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" id="<?php echo $selected_shortcode; ?>_<?php echo $attr_name; ?>" cols="" rows="3" class="ppb_input"></textarea>
			<br/><br/>
			<?php
					}
				}
			?>
			
			<?php
				if(isset($selected_shortcode_arr['content']) && $selected_shortcode_arr['content'])
				{
			?>
					<label for="<?php echo $selected_shortcode; ?>_content"><?php _e( 'Content', THEMEDOMAIN ); ?></label><span class="label_desc"><?php _e( 'Enter text/HTML content to display in this', THEMEDOMAIN ); ?> "<?php echo $selected_shortcode_arr['title']; ?>"</span><br/>
					<textarea id="<?php echo $selected_shortcode; ?>_content" name="<?php echo $selected_shortcode; ?>_content" cols="" rows="7" class="ppb_input"></textarea>
			<?php
				}
			?>
		</div>
		<br/>
		
		<script>
		jQuery(document).ready(function(){
			var formfield = '';
	
			jQuery('.metabox_upload_btn').click(function() {
			    jQuery('.fancybox-overlay').css('visibility', 'hidden');
			    jQuery('.fancybox-wrap').css('visibility', 'hidden');
		     	formfield = jQuery(this).attr('rel');
			    
			    var send_attachment_bkp = wp.media.editor.send.attachment;
			    wp.media.editor.send.attachment = function(props, attachment) {
			     	jQuery('#'+formfield).attr('value', attachment.url);
			
			        wp.media.editor.send.attachment = send_attachment_bkp;
			        jQuery('.fancybox-overlay').css('visibility', 'visible');
			     	jQuery('.fancybox-wrap').css('visibility', 'visible');
			    }
			
			    wp.media.editor.open();
		     	return false;
		    });
		
			jQuery("#ppb_inline :input").each(function(){
				if(typeof jQuery(this).attr('id') != 'undefined')
				{
					 jQuery(this).attr('value', '');
				}
			});
			
			var currentItemData = jQuery('#<?php echo $_GET['rel']; ?>').data('ppb_setting');
			var currentItemOBJ = jQuery.parseJSON(currentItemData);
			
			jQuery.each(currentItemOBJ, function(index, value) { 
			  	if(typeof jQuery('#'+index) != 'undefined')
				{
					jQuery('#'+index).val(decodeURI(value));
					
					//If textarea then convert to visual editor
					if(jQuery('#'+index).is('textarea'))
					{
						jQuery('#'+index).wp_editor();
						jQuery('#'+index).val(decodeURI(value));
						//switchEditors.go(index, 'tmce');
					}
				}
			});
			
			jQuery('.color_picker').each(function()
			{	
			    var inputID = jQuery(this).attr('id');
			    
			    jQuery(this).ColorPicker({
			    	color: jQuery(this).val(),
			    	onShow: function (colpkr) {
			    		jQuery(colpkr).fadeIn(200);
			    		return false;
			    	},
			    	onHide: function (colpkr) {
			    		jQuery(colpkr).fadeOut(200);
			    		return false;
			    	},
			    	onChange: function (hsb, hex, rgb, el) {
			    		jQuery('#'+inputID).val('#' + hex);
			    		jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
			    	}
			    });	
			    
			    jQuery(this).css('width', '200px');
			    jQuery(this).css('float', 'left');
			});
			
			var el, newPoint, newPlace, offset;
 
			 jQuery("input[type='range']").change(function() {
			 
			   el = jQuery(this);
			   
			   width = el.width();
			   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
			   
			   el
			     .next("output")
			     .text(el.val());
			 })
			 .trigger('change');
			
			jQuery("#save_<?php echo $_GET['rel']; ?>").click(function(){
				tinyMCE.triggerSave();
			
			    var targetItem = jQuery('#ppb_inline_current').attr('value');
			    var parentInline = jQuery(this).attr('data-parent');
			    var currentItemData = jQuery('#'+targetItem).find('.ppb_setting_data').attr('value');
			    var currentShortcode = jQuery('#'+parentInline).attr('data-shortcode');
			    
			    var itemData = {};
			    itemData.id = targetItem;
			    itemData.shortcode = currentShortcode;
			    
			    jQuery("#"+parentInline+" :input.ppb_input").each(function(){
			     	if(typeof jQuery(this).attr('id') != 'undefined')
			     	{	
			    	 	itemData[jQuery(this).attr('id')] = encodeURI(jQuery(this).attr('value'));
			    	 	
				    	 if(jQuery(this).attr('data-attr') == 'title')
				    	 {
				    	  	jQuery('#'+targetItem).find('.title').html(decodeURI(jQuery(this).attr('value')));
				    	  	if(jQuery('#'+targetItem).find('.ppb_unsave').length==0)
				    	  	{
				    	  		jQuery('<a href="javascript:;" class="ppb_unsave">Unsaved</a>').insertAfter(jQuery('#'+targetItem).find('.title'));
				    	  	}
				    	 }
			     	}
			    });
			    
			    var currentItemDataJSON = JSON.stringify(itemData);
			    jQuery('#'+targetItem).data('ppb_setting', currentItemDataJSON);
			    
			    jQuery.fancybox.close();
			});
			
			jQuery.fancybox.hideLoading();
		});
		</script>
<?php
		}
	}
	
	die();
}

/**
*	Setup one click importer function
**/
add_action('wp_ajax_pp_import_demo_content', 'pp_import_demo_content');
add_action('wp_ajax_nopriv_pp_import_demo_content', 'pp_import_demo_content');

function pp_import_demo_content() {
	if(is_admin() && isset($_POST['demo']) && !empty($_POST['demo']))
	{
		global $wpdb; 

	    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	
	    // Load Importer API
	    require_once ABSPATH . 'wp-admin/includes/import.php';
	
	    if ( ! class_exists( 'WP_Importer' ) ) {
	        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	        if ( file_exists( $class_wp_importer ) )
	        {
	            require $class_wp_importer;
	        }
	    }
	
	    if ( ! class_exists( 'WP_Import' ) ) {
	        $class_wp_importer = get_template_directory() ."/modules/import/wordpress-importer.php";
	        if ( file_exists( $class_wp_importer ) )
	            require $class_wp_importer;
	    }
	
	
	    if ( class_exists( 'WP_Import' ) ) 
	    { 
	    	switch($_POST['demo'])
	    	{
		    	case 1:
		    	default:
		    		$import_filepath = get_template_directory() ."/cache/demos/1.xml" ;
		    		$page_on_front = 3297; //Demo 1 Homepage ID
		    		$oldurl = 'http://themes.themegoods2.com/meteors';
		    	break;
		    	
		    	case 2:
		    		$import_filepath = get_template_directory() ."/cache/demos/2.xml" ;
		    		$page_on_front = 3216; //Demo 2 Homepage ID
		    		$oldurl = 'http://themes.themegoods2.com/meteors2';
		    	break;
	    	}
			
			//Run and download demo contents
			$wp_import = new WP_Import();
	        $wp_import->fetch_attachments = true;
	        $wp_import->import($import_filepath);
	    }
	    
	    //Setup theme settings
	    $default_json_settings = get_template_directory().'/cache/demos/'.$_POST['demo'].'.json';

		if(file_exists($default_json_settings))
	    {
	    	$import_options_json = file_get_contents($default_json_settings);
			$import_options_arr = json_decode($import_options_json, true);
			
			if(!empty($import_options_arr) && is_array($import_options_arr))
			{	
				foreach($import_options_arr as $key => $import_option)
				{	
					$wpdb->query("DELETE FROM `".$wpdb->prefix."options` WHERE option_name = '".$key."'");
					
					$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_name`, `option_value`, `autoload`) VALUES('".$key."', '".$import_option."', 'yes');");
				}
			}
	    }
	    
	    //Setup default front page settings.
	    update_option('show_on_front', 'page');
	    update_option('page_on_front', $page_on_front);
	    
	    //Set default custom menu settings
	    $locations = get_theme_mod('nav_menu_locations');
		$locations['primary-menu'] = 25;
		$locations['footer-menu'] = 24;
		set_theme_mod( 'nav_menu_locations', $locations );
		
		//Change all URLs from demo URL to localhost
		$update_options = array ( 0 => 'content', 1 => 'excerpts', 2 => 'links', 3 => 'attachments', 4 => 'custom', 5 => 'guids', );
		$newurl = get_bloginfo('wpurl');
		VB_update_urls($update_options, $oldurl, $newurl);
	    
		exit();
	}
}

/**
*	Setup AJAX search function
**/
add_action('wp_ajax_pp_ajax_search', 'pp_ajax_search');
add_action('wp_ajax_nopriv_pp_ajax_search', 'pp_ajax_search');

function pp_ajax_search() {
	global $wpdb;
	
	if (strlen($_POST['s'])>0) {
		$limit=5;
		$s=strtolower(addslashes($_POST['s']));
		$querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE 1=1 AND ((lower($wpdb->posts.post_title) like '%$s%'))
			AND $wpdb->posts.post_type IN ('post', 'page', 'attachment', 'portfolios', 'galleries')
			AND (post_status = 'publish')
			ORDER BY $wpdb->posts.post_date DESC
			LIMIT $limit;
		 ";

	 	$pageposts = $wpdb->get_results($querystr, OBJECT);
	 	
	 	if(!empty($pageposts))
	 	{
			echo '<ul>';
	
	 		foreach($pageposts as $result_item) 
	 		{
	 			$post=$result_item;
	 			
	 			$post_type = get_post_type($post->ID);
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
	 			
				echo '<li>';
				echo '<div class="post_type_icon">';
				echo '<a href="'.get_permalink($post->ID).'"><i class="fa '.$post_type_class.'"></i></a>';
				echo '</div>';
				echo '<div class="ajax_post">';
				echo '<a href="'.get_permalink($post->ID).'"><strong>'.$post->post_title.'</strong><br/>';
				echo '<span class="post_detail">'.date('d M', strtotime($post->post_date)).'</span></a>';
				echo '</div>';
				echo '</li>';
			}
			
			echo '<li class="view_all"><a href="javascript:jQuery(\'#searchform\').submit()">'.__( 'View all results', THEMEDOMAIN ).'</a></li>';
	
			echo '</ul>';
		}

	}
	else 
	{
		echo '';
	}
	die();

}

/**
*	Setup contact form mailing function
**/
add_action('wp_ajax_pp_contact_mailer', 'pp_contact_mailer');
add_action('wp_ajax_nopriv_pp_contact_mailer', 'pp_contact_mailer');

function pp_contact_mailer() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	if (isset($_POST['your_name'])) {
	
		//Get your email address
		$contact_email = get_option('pp_contact_email');
		$pp_contact_thankyou = __( 'Thank you! We will get back to you as soon as possible', THEMEDOMAIN );
		
		/*
		|
		| Begin sending mail
		|
		*/
		
		$from_name = $_POST['your_name'];
		$from_email = $_POST['email'];
		
		//Get contact subject
		if(!isset($_POST['subject']))
		{
			$contact_subject = __( 'Email from contact form', THEMEDOMAIN );
		}
		else
		{
			$contact_subject = $_POST['subject'];
		}
		
		$headers = "";
	   	$headers.= 'From: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Reply-To: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Return-Path: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
		
		$message = 'Name: '.$from_name.PHP_EOL;
		$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
		$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
		
		if(isset($_POST['address']))
		{
			$message.= 'Address: '.$_POST['address'].PHP_EOL;
		}
		
		if(isset($_POST['phone']))
		{
			$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
		}
		
		if(isset($_POST['mobile']))
		{
			$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
		}
		
		if(isset($_POST['company']))
		{
			$message.= 'Company: '.$_POST['company'].PHP_EOL;
		}
		
		if(isset($_POST['country']))
		{
			$message.= 'Country: '.$_POST['country'].PHP_EOL;
		}
		    
		
		if(!empty($from_name) && !empty($from_email) && !empty($message))
		{
			wp_mail($contact_email, $contact_subject, $message, $headers);
			echo '<p>'.$pp_contact_thankyou.'</p>';
			
			die;
		}
		else
		{
			echo '<p>'.ERROR_MESSAGE.'</p>';
			
			die;
		}

	}
	else 
	{
		echo '<p>'.ERROR_MESSAGE.'</p>';
	}
	die();
}


function pp_add_admin() {
 
global $themename, $shortname, $options, $pp_include_from_skin_arr;

if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) 
		{
			if($value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
		}
		
		foreach ($options as $value) {
		
			if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] )) 
			{ 

				if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
				{
					//if sortable type
					if(is_admin() && $value['type'] == 'sortable')
					{
						$sortable_array = serialize($_REQUEST[ $value['id'] ]);
						
						$sortable_data = $_REQUEST[ $value['id'].'_sort_data'];
						$sortable_data_arr = explode(',', $sortable_data);
						$new_sortable_data = array();
						
						foreach($sortable_data_arr as $key => $sortable_data_item)
						{
							$sortable_data_item_arr = explode('_', $sortable_data_item);
							
							if(isset($sortable_data_item_arr[0]))
							{
								$new_sortable_data[] = $sortable_data_item_arr[0];
							}
						}
						
						update_option( $value['id'], $sortable_array );
						update_option( $value['id'].'_sort_data', serialize($new_sortable_data) );
					}
					elseif(is_admin() && $value['type'] == 'font')
					{
						if(!empty($_REQUEST[ $value['id'] ]))
						{
							update_option( $value['id'], $_REQUEST[ $value['id'] ] );
							update_option( $value['id'].'_value', $_REQUEST[ $value['id'].'_value' ] );
						}
						else
						{
							delete_option( $value['id'] );
							delete_option( $value['id'].'_value' );
						}
					}
					elseif(is_admin())
					{
						if($value['type']=='image')
						{
							update_option( $value['id'], esc_url($_REQUEST[ $value['id'] ])  );
						}
						elseif($value['type']=='textarea')
						{
							update_option( $value['id'], esc_textarea($_REQUEST[ $value['id'] ])  );
						}
						elseif($value['type']=='iphone_checkboxes' OR $value['type']=='jslider')
						{
							update_option( $value['id'], intval($_REQUEST[ $value['id'] ])  );
						}
					
						update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
					}
				}
				elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
				{
					if($value['id'] == SHORTNAME."_sidebar0")
					{
						//get last sidebar serialize array
						$current_sidebar = get_option(SHORTNAME."_sidebar");
						$current_sidebar[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
			
						update_option( SHORTNAME."_sidebar", $current_sidebar );
					}
					elseif($value['id'] == SHORTNAME."_ggfont0")
					{
						//get last ggfonts serialize array
						$current_ggfont = get_option(SHORTNAME."_ggfont");
						$current_ggfont[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
			
						update_option( SHORTNAME."_ggfont", $current_ggfont );
					}
				}
			} 
			else 
			{ 
				if(is_admin() && isset($value['id']))
				{
					delete_option( $value['id'] );
				}
			} 
		}
		
		if(isset($_POST['pp_save_skin_flg']) && !empty($_POST['pp_save_skin_flg']) && $_GET["page"] == "functions.php")
		{
			global $wpdb;
			$ppskin_id = SKINSHORTNAME."_".time();
			
			$wpdb->query("SELECT * FROM `".$wpdb->prefix."options` WHERE `option_name` LIKE '%pp_%'");
			$pp_settings_obj = $wpdb->last_result;
			$serilize_settings_arr = array();
			
			$serilize_settings_arr['id'] = $ppskin_id;
			$serilize_settings_arr['name'] = $_POST['pp_save_skin_name'];
			foreach ($pp_settings_obj as $pp_setting)
			{
				if(in_array($pp_setting->option_name, $pp_include_from_skin_arr))
				{
					$serilize_settings_arr['settings'][$pp_setting->option_name] = $pp_setting->option_value;
				}
			}
			
			add_option($ppskin_id, $serilize_settings_arr);
			header("Location: admin.php?page=functions.php&saved=true#pp_panel_skins");
			exit;
		}

		header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
	}  
} 
 
add_menu_page('Theme Setting', 'Theme Setting', 'administrator', basename(__FILE__), 'pp_admin', get_admin_url().'/images/generic.png');
}

function pp_enqueue_admin_page_scripts() {

$file_dir=get_template_directory_uri();
global $current_screen;
wp_enqueue_style('thickbox');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, THEMEVERSION, "all");

if(property_exists($current_screen, 'post_type') && $current_screen->post_type == 'page')
{
	wp_enqueue_style("jqueryui", $file_dir."/css/jqueryui/custom.css", false, THEMEVERSION, "all");
}

wp_enqueue_style("colorpicker_css", $file_dir."/functions/colorpicker/css/colorpicker.css", false, THEMEVERSION, "all");
wp_enqueue_style("fancybox", $file_dir."/js/fancybox/jquery.fancybox.admin.css", false, THEMEVERSION, "all");
wp_enqueue_style("icheck", $file_dir."/functions/skins/flat/green.css", false, THEMEVERSION, "all");

$pp_font = get_option('pp_font');
if(!empty($pp_font))
{
	wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic", false, "", "all");
}

wp_enqueue_script("jquery-ui-core");
wp_enqueue_script("jquery-ui-sortable");
wp_enqueue_script('jquery-ui-tabs');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');

$ap_vars = array(
    'url' => get_home_url(),
    'includes_url' => includes_url()
);

wp_register_script( 'ap_wpeditor_init', get_template_directory_uri() . '/functions/js-wp-editor.js', array( 'jquery' ), '1.1', true );
wp_localize_script( 'ap_wpeditor_init', 'ap_vars', $ap_vars );
wp_enqueue_script( 'ap_wpeditor_init' );

wp_enqueue_script("colorpicker_script", $file_dir."/functions/colorpicker/js/colorpicker.js", false, THEMEVERSION);
wp_enqueue_script("eye_script", $file_dir."/functions/colorpicker/js/eye.js", false, THEMEVERSION);
wp_enqueue_script("utils_script", $file_dir."/functions/colorpicker/js/utils.js", false, THEMEVERSION);
wp_enqueue_script("jquery.icheck.min", $file_dir."/functions/jquery.icheck.min.js", false, THEMEVERSION);
wp_enqueue_script("jslider_depend", $file_dir."/functions/jquery.dependClass.js", false, THEMEVERSION);
wp_enqueue_script("jslider", $file_dir."/functions/jquery.slider-min.js", false, THEMEVERSION);
wp_enqueue_script("fancybox", $file_dir."/js/fancybox/jquery.fancybox.admin.js", false);
wp_enqueue_script("hint", $file_dir."/js/hint.js", false, THEMEVERSION, true);

wp_register_script( "rm_script", $file_dir."/functions/rm_script.js", false, THEMEVERSION, true);
$params = array(
  'ajaxurl' => admin_url('admin-ajax.php'),
);
wp_localize_script( 'rm_script', 'tgAjax', $params );
wp_enqueue_script( 'rm_script' );

}

add_action('admin_enqueue_scripts',	'pp_enqueue_admin_page_scripts' );

function pp_enqueue_front_page_scripts() {

    //enqueue frontend css files
	$pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = $upload_dir['basedir'].'/meteors';
	}
	
	if(isset($upload_dir['baseurl']))
	{
		$cache_url = $upload_dir['baseurl'].'/meteors';
	}
	    
	if(!empty($pp_advance_combine_css))
	{
	    if(!file_exists($cache_dir."/combined.css"))
	    {
	    	$cssmin = new CSSMin();
	    	
	    	$css_arr = array(
	    	    get_template_directory().'/css/reset.css',
	    	    get_template_directory().'/css/wordpress.css',
	    	    get_template_directory().'/css/screen.css',
	    	    get_template_directory().'/css/magnific-popup.css',
	    	    get_template_directory().'/css/jqueryui/custom.css',
	    	    get_template_directory().'/js/mediaelement/mediaelementplayer.css',
	    	    get_template_directory().'/js/flexslider/flexslider.css',
	    	    get_template_directory().'/css/tooltipster.css',
	    	    get_template_directory().'/css/odometer-theme-minimal.css',
	    	    get_template_directory().'/css/animation.css'
	    	);
	    	
	    	//If using child theme
	    	$pp_child_theme = get_option('pp_child_theme');
	    	if(empty($pp_child_theme))
	    	{
	    		$css_arr[] = get_template_directory().'/css/screen.css';
	    	}
	    	else
	    	{
	    		$css_arr[] = get_template_directory().'/style.css';
	    	}
	    	
	    	$cssmin->addFiles($css_arr);
	    	
	    	// Set original CSS from all files
	    	$cssmin->setOriginalCSS();
	    	$cssmin->compressCSS();
	    	
	    	$css = $cssmin->printCompressedCSS();
	    	
	    	file_put_contents($cache_dir."/combined.css", $css);
	    }
	    
	    wp_enqueue_style("combined_css", $cache_url."/combined.css", false, THEMEVERSION);
	}
	else
	{
		wp_enqueue_style("reset-css", get_template_directory_uri()."/css/reset.css", false, THEMEVERSION);
		wp_enqueue_style("wordpress-css", get_template_directory_uri()."/css/wordpress.css", false, THEMEVERSION);
		wp_enqueue_style("screen.css", get_template_directory_uri().'/css/screen.css', false, THEMEVERSION, "all");
	    wp_enqueue_style("magnific-popup", get_template_directory_uri()."/css/magnific-popup.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("jquery-ui-css", get_template_directory_uri()."/css/jqueryui/custom.css", false, THEMEVERSION);
	    wp_enqueue_style("mediaelement", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("flexslider", get_template_directory_uri()."/js/flexslider/flexslider.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("odometer-theme", get_template_directory_uri()."/css/odometer-theme-minimal.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("animation.css", get_template_directory_uri()."/css/animation.css", false, THEMEVERSION, "all");
	}
	
	//Add Font Awesome Support
	wp_enqueue_style("fontawesome", get_template_directory_uri()."/css/font-awesome.min.css", false, THEMEVERSION, "all");
	
	//Check if enable responsive layout
	$pp_enable_responsive = get_option('pp_enable_responsive');
	
	if(!empty($pp_enable_responsive))
	{
		if(!empty($pp_advance_combine_css))
		{
			wp_enqueue_style('responsive', get_template_directory_uri()."/templates/responsive-css.php", false, "", "all");
		}
		else
		{
	    	wp_enqueue_style('responsive', get_template_directory_uri()."/css/grid.css", false, "", "all");
	    }
	}
	
	//Add custom colors and fonts
	if(isset($_GET['boxed']) && THEMEDEMO) 
	{
		wp_enqueue_style("custom_css", get_template_directory_uri()."/templates/custom-css.php?boxed=".$_GET['boxed'], false, THEMEVERSION, "all");
	}
	else
	{
		wp_enqueue_style("custom_css", get_template_directory_uri()."/templates/custom-css.php", false, THEMEVERSION, "all");
	}
	
	//If using child theme
	$pp_child_theme = get_option('pp_child_theme');
	if(!empty($pp_child_theme))
	{
	    wp_enqueue_style('child_theme', get_stylesheet_directory_uri()."/style.css", false, THEMEVERSION, "all");
	}
	
	//Get all Google Web font CSS
	global $gg_fonts;
	
	$gg_fonts_family = array();

	if(is_array($gg_fonts) && !empty($gg_fonts))
	{
		foreach($gg_fonts as $gg_font)
		{
			$gg_fonts_family[] = get_option($gg_font);
		}
	}
	
	$gg_fonts_family = array_unique($gg_fonts_family);

	foreach($gg_fonts_family as $key => $gg_fonts_family_value)
	{
		if(!empty($gg_fonts_family_value) && $gg_fonts_family_value != 'Helvetica' && $gg_fonts_family_value != 'Arial')
		{
			if(!is_ssl())
			{
				wp_enqueue_style('google_font'.$key, "http://fonts.googleapis.com/css?family=".$gg_fonts_family_value.":200,300,400,500,600,700,400italic&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
			}
			else
			{
				wp_enqueue_style('google_font'.$key, "https://fonts.googleapis.com/css?family=".$gg_fonts_family_value.":200,300,400,500,600,700,400italic&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
			}
		}
	}
	
	//Enqueue javascripts
	wp_enqueue_script("jquery");
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
		'jquery.stellar.js',
		'jquery.magnific-popup.js',
		'jquery.easing.js',
	    'waypoints.min.js',
	    'jquery.isotope.js',
	    'jquery.masory.js',
	    'jquery.tooltipster.min.js',
	    'custom_plugins.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists($cache_dir."/combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents($cache_dir."/combined.js", $js);
		}

		wp_enqueue_script("combined_js", $cache_url."/combined.js", false, THEMEVERSION, true);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_template_directory_uri()."/js/".$file, false, THEMEVERSION, true);
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'pp_enqueue_front_page_scripts' );


function pp_admin() {
 
global $themename, $shortname, $options;
$i=0;

$pp_font_family = get_option('pp_font_family');

if(function_exists( 'wp_enqueue_media' )){
    wp_enqueue_media();
}
?>

<style>
#pp_sample_text
{
	font-family: '<?php echo $pp_font_family; ?>';
}
</style>
	
	<div id="pp_loading"><span><?php _e( 'Updating...', THEMEDOMAIN ); ?></span></div>
	<div id="pp_success"><span><?php _e( 'Successfully<br/>Update', THEMEDOMAIN ); ?></span></div>
	
	<?php
		if(isset($_GET['saved']) == 'true')
		{
	?>
		<script>
			jQuery('#pp_success').show();
	            	
	        setTimeout(function() {
              jQuery('#pp_success').fadeOut();
            }, 2000);
		</script>
	<?php
		}
	?>
	
	<form id="pp_form" method="post" enctype="multipart/form-data">
	<div class="pp_wrap rm_wrap">
	
	<div class="header_wrap">
		<div style="float:left">
		<h2><?php _e( 'Theme Setting', THEMEDOMAIN ); ?><span class="pp_version">v<?php echo THEMEVERSION; ?></span></h2><br/>
		<a href="themes.themegoods2.com/meteors_doc">Online Documentation</a>&nbsp;|&nbsp;<a href="">Theme Support</a>
		</div>
		<div style="float:right;margin:32px 0 0 0">
			<!-- input id="save_ppskin" name="save_ppskin" class="button secondary_button" type="submit" value="Save as Skin" / -->
			<input id="save_ppsettings" name="save_ppsettings" class="button button-primary button-large" type="submit" value="<?php _e( 'Save All Changes', THEMEDOMAIN ); ?>" />
			<br/><br/>
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_general" />
			<input type="hidden" name="pp_save_skin_flg" id="pp_save_skin_flg" value="" />
			<input type="hidden" name="pp_save_skin_name" id="pp_save_skin_name" value="" />
		</div>
		<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
		<br style="clear:both"/><br/>
		
<?php
//Check if theme cache folder is writable
$upload_dir = wp_upload_dir();
$cache_dir = '';
$original_cache_dir = get_template_directory().'/cache';

if(isset($upload_dir['basedir']))
{
	$cache_dir = $upload_dir['basedir'].'/meteors';
}

if(!is_dir($cache_dir))
{
	mkdir($cache_dir);
	pp_recurse_copy($original_cache_dir, $cache_dir);
}

if(false)
{
?>

	<div id="message" class="error fade">
	<p style="line-height:1.5em"><strong>
		The path <?php echo $cache_dir; ?> is not writable, please login with your FTP account and make it writable (chmod 777) otherwise CSS and javascript compression feature won't work.
	</p></strong>
	</div>

<?php
}
?>

<?php
	//Check if theme has new update
?>

	</div>
	
	<div class="pp_wrap">
	<div id="pp_panel">
	<?php 
		foreach ($options as $value) {
			
			$active = '';
			
			if($value['type'] == 'section')
			{
				if($value['name'] == 'General')
				{
					$active = 'nav-tab-active';
				}
				echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.$active.'"><img src="'.get_template_directory_uri().'/functions/images/icon/'.$value['icon'].'" class="ver_mid"/>'.str_replace('-', ' ', $value['name']).'</a>';
			}
		}
	?>
	</h2>
	</div>

	<div class="rm_opts">
	
<?php 

// Get Google font list from cache
$pp_font_arr = array();

$font_cache_path = get_template_directory().'/cache/gg_fonts.cache';
$file = file_get_contents($font_cache_path, true);
$pp_font_arr = unserialize($file);

//Get installed Google font (if has)
$current_ggfont = get_option('pp_ggfont');

//Get default fonts
$pp_font_arr[] = array(
	'font-family' => 'font-family: "Helvetica"',
	'font-name' => 'Helvetica',
	'css-name' => urlencode('Helvetica'),
);

$pp_font_arr[] = array(
	'font-family' => 'font-family: "Helvetica Neue"',
	'font-name' => 'Helvetica Neue',
	'css-name' => urlencode('Helvetica Neue'),
);

$pp_font_arr[] = array(
    'font-family' => 'font-family: "Arial"',
    'font-name' => 'Arial',
    'css-name' => urlencode('Arial'),
);

$pp_font_arr[] = array(
    'font-family' => 'font-family: "Georgia"',
    'font-name' => 'Georgia',
    'css-name' => urlencode('Georgia'),
);

if(!empty($current_ggfont))
{
	foreach($current_ggfont as $ggfont)
	{
		$pp_font_arr[] = array(
			'font-family' => 'font-family: \''.$ggfont.'\'',
			'font-name' => $ggfont,
			'css-name' => urlencode($ggfont),
		);
	}
}

//Sort by font name
function cmp($a, $b)
{
    return strcmp($a["font-name"], $b["font-name"]);
}
usort($pp_font_arr, "cmp");

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?> <?php break;
 
case "close":
?>
	
	</div>
	</div>


	<?php break;
 
case "title":
?>
	<br />


<?php break;
 
case 'text':
	
	//if sidebar input then not show default value
	if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
	{
		$default_val = get_option( $value['id'] );
	}
	else
	{
		$default_val = '';	
	}
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ($default_val != "") { echo get_option( $value['id']) ; } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php
	if($value['id'] == SHORTNAME."_sidebar0")
	{
		$current_sidebar = get_option(SHORTNAME."_sidebar");
		
		if(!empty($current_sidebar))
		{
	?>
		<br class="clear"/><br/>
	 	<div class="pp_sortable_wrapper">
		<ul id="current_sidebar" class="rm_list">

	<?php
		foreach($current_sidebar as $sidebar)
		{
	?> 
			
			<li id="<?php echo $sidebar; ?>"><div class="title"><?php echo $sidebar; ?></div><a href="<?php echo $url; ?>" class="sidebar_del" rel="<?php echo $sidebar; ?>"><?php _e( 'Delete', THEMEDOMAIN ); ?></a><br style="clear:both"/></li>
	
	<?php
		}
	?>
	
		</ul>
		</div>
	
	<?php
		}
	}
	elseif($value['id'] == SHORTNAME."_ggfont0")
	{
	?>
		<?php _e( 'Below are fonts that already installed.', THEMEDOMAIN ); ?><br/>
		<select name="<?php echo SHORTNAME; ?>_sample_ggfont" id="<?php echo SHORTNAME; ?>_sample_ggfont">
		<?php 
			foreach ($pp_font_arr as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
			value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
		<?php } ?>
		</select> 
	<?php
		$current_ggfont = get_option(SHORTNAME."_ggfont");
		
		if(!empty($current_ggfont))
		{
	?>
		<br class="clear"/><br/>
	 	<div class="pp_sortable_wrapper">
		<ul id="current_ggfont" class="rm_list">

	<?php
	
		foreach($current_ggfont as $ggfont)
		{
	?> 
			
			<li id="<?php echo $ggfont; ?>"><div class="title"><?php echo $ggfont; ?></div><a href="<?php echo $url; ?>" class="ggfont_del" rel="<?php echo $ggfont; ?>"><?php _e( 'Delete', THEMEDOMAIN ); ?></a><br style="clear:both"/></li>
	
	<?php
		}
	?>
	
		</ul>
		</div>
	
	<?php
		}
	}
	?>

	</div>
	<?php
break;

case 'password':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>
	<?php
break;

break;

case 'image':
case 'music':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input id="<?php echo $value['id']; ?>" type="text" name="<?php echo $value['id']; ?>" value="<?php echo get_option($value['id']); ?>" style="width:200px" class="upload_text" readonly />
	<input id="<?php echo $value['id']; ?>_button" name="<?php echo $value['id']; ?>_button" type="button" value="Browse" class="upload_btn button" rel="<?php echo $value['id']; ?>" style="margin:5px 0 0 5px" />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<script>
	jQuery(document).ready(function() {
		jQuery('#<?php echo $value['id']; ?>_button').click(function() {
         	var send_attachment_bkp = wp.media.editor.send.attachment;
		    wp.media.editor.send.attachment = function(props, attachment) {
		    	formfield = jQuery('#<?php echo $value['id']; ?>').attr('name');
	         	jQuery('#'+formfield).attr('value', attachment.url);
		
		        wp.media.editor.send.attachment = send_attachment_bkp;
		    }
		
		    wp.media.editor.open();
        });
    });
	</script>
	
	<?php 
		$current_value = get_option( $value['id'] );
		
		if(!is_bool($current_value) && !empty($current_value))
		{
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		
			if($value['type']=='image')
			{
	?>
	
		<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;"><br/>
			<img src="<?php echo get_option($value['id']); ?>" style="max-width:500px"/><br/><br/>
			<a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>"><?php _e( 'Delete', THEMEDOMAIN ); ?></a>
		</div>
		<?php
			}
			else
			{
		?>
		<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;">
			<br/><a href="<?php echo get_option( $value['id'] ); ?>">
			<?php _e( 'Listen current music', THEMEDOMAIN ); ?></a>&nbsp;<a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>"><?php _e( 'Delete', THEMEDOMAIN ); ?></a>
		</div>
	<?php
			}
		}
	?>

	</div>
	<?php
break;

case 'jslider':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<div style="float:left;width:290px;margin-top:10px">
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text" class="jslider"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	</div>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<script>jQuery("#<?php echo $value['id']; ?>").slider({ from: <?php echo $value['from']; ?>, to: <?php echo $value['to']; ?>, step: <?php echo $value['step']; ?>, smooth: true, skin: "round_plastic" });</script>

	</div>
	<?php
break;

case 'colorpicker':
?>
	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text" 
		value="<?php if ( get_option( $value['id'] ) != "" ) { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker" readonly/>
	<div id="<?php echo $value['id']; ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo $value['id']; ?>').click()" style="background:<?php if (get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?> url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png) center no-repeat;">&nbsp;</div>
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	</div>
	
<?php
break;
 
case 'textarea':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_textarea"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<textarea name="<?php echo $value['id']; ?>"
		type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>

	<?php
break;
 
case 'select':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
			value="<?php echo $key; ?>"><?php echo $option; ?></option>
		<?php } ?>
	</select> <small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'font':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_font"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div id="<?php echo $value['id']; ?>_wrapper" style="float:left;font-size:11px;">
	<select class="pp_font" data-sample="<?php echo $value['id']; ?>_sample" data-value="<?php echo $value['id']; ?>_value" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>">
		<option value="" data-family="">---- <?php _e( 'Theme Default Font', THEMEDOMAIN ); ?> ----</option>
		<?php 
			foreach ($pp_font_arr as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
			value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
		<?php } ?>
	</select> 
	<input type="hidden" id="<?php echo $value['id']; ?>_value" name="<?php echo $value['id']; ?>_value" value="<?php echo get_option( $value['id'].'_value' ); ?>"/>
	<br/><br/><div id="<?php echo $value['id']; ?>_sample" class="pp_sample_text"><?php _e( 'Sample Text', THEMEDOMAIN ); ?></div>
	</div>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case 'radio':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/><br/>

	<div style="margin-top:5px;float:left;<?php if(!empty($value['desc'])) { ?>width:300px<?php } else { ?>width:500px<?php } ?>">
	<?php foreach ($value['options'] as $key => $option) { ?>
	<div style="float:left;<?php if(!empty($value['desc'])) { ?>margin:0 20px 20px 0<?php } ?>">
		<input style="float:left;" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" type="radio"
		<?php if (get_option( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
			value="<?php echo $key; ?>"/><?php echo $option; ?>
	</div>
	<?php } ?>
	</div>
	
	<?php if(!empty($value['desc'])) { ?>
		<small><?php echo $value['desc']; ?></small>
	<?php } ?>
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'sortable':
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div style="float:left;width:100%;">
	<?php 
	$sortable_array = array();
	if(get_option( $value['id'] ) != 1)
	{
		$sortable_array = unserialize(get_option( $value['id'] ));
	}
	
	$current = 1;
	
	if(!empty($value['options']))
	{
	?>
	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" class="pp_sortable_select">
	<?php
	foreach ($value['options'] as $key => $option) { 
		if($key > 0)
		{
	?>
	<option value="<?php echo $key; ?>" data-rel="<?php echo $value['id']; ?>_sort" title="<?php echo html_entity_decode($option); ?>"><?php echo html_entity_decode($option); ?></option>
	<?php }
	
			if($current>1 && ($current-1)%3 == 0)
			{
	?>
	
			<br style="clear:both"/>
	
	<?php		
			}
			
			$current++;
		}
	?>
	</select>
	<a class="button pp_sortable_button" data-rel="<?php echo $value['id']; ?>" class="button" style="margin-top:10px;display:inline-block">Add</a>
	<?php
	}
	?>
	 
	 <br style="clear:both"/><br/>
	 
	 <div class="pp_sortable_wrapper">
	 <ul id="<?php echo $value['id']; ?>_sort" class="pp_sortable" rel="<?php echo $value['id']; ?>_sort_data"> 
	 <?php
	 	$sortable_data_array = unserialize(get_option( $value['id'].'_sort_data' ));

	 	if(!empty($sortable_data_array))
	 	{
	 		foreach($sortable_data_array as $key => $sortable_data_item)
	 		{
		 		if(!empty($sortable_data_item))
		 		{
	 		
	 ?>
	 		<li id="<?php echo $sortable_data_item; ?>_sort" class="ui-state-default"><div class="title"><?php echo $value['options'][$sortable_data_item]; ?></div><a data-rel="<?php echo $value['id']; ?>_sort" href="javascript:;" class="remove">x</a><br style="clear:both"/></li> 	
	 <?php
	 			}
	 		}
	 	}
	 ?>
	 </ul>
	 
	 </div>
	 
	</div>
	
	<input type="hidden" id="<?php echo $value['id']; ?>_sort_data" name="<?php echo $value['id']; ?>_sort_data" value="" style="width:100%"/>
	<br style="clear:both"/><br/>
	
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case "checkbox":
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
<?php break; 

case "iphone_checkboxes":
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" class="iphone_checkboxes" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>

<?php break; 

case "html":
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<?php echo $value['html']; ?>

	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>

<?php break; 

case "shortcut":
?>

	<div id="<?php echo $value['id']; ?>_section" class="rm_input rm_shortcut">

	<ul class="pp_shortcut_wrapper">
	<?php 
		$count_shortcut = 1;
		foreach ($value['options'] as $key_shortcut => $option) { ?>
		<li><a href="#<?php echo $key_shortcut; ?>" <?php if($count_shortcut==1) { ?>class="active"<?php } ?>><?php echo $option; ?></a></li>
	<?php $count_shortcut++; } ?>
	</ul>

	<div class="clearfix"></div>
	</div>

<?php break; 
	
case "section":

$i++;

?>

	<div id="pp_panel_<?php echo strtolower($value['name']); ?>" class="rm_section">
	<div class="rm_title">
	<h3><img
		src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png"
		class="inactive" alt=""><?php echo $value['name']; ?></h3>
	<span class="submit"><input class="button-primary" name="save<?php echo $i; ?>" type="submit"
		value="Save changes" /> </span>
	<div class="clearfix"></div>
	</div>
	<div class="rm_options"><?php break;
 
}
}
?>
 	
 	<div class="clearfix"></div>
 	</form>
 	</div>
</div>


	<?php
}

add_action('admin_menu', 'pp_add_admin');

//Setup content builder
require_once (get_template_directory() . "/modules/content_builder.php");

require_once (get_template_directory() . '/modules/js-wp-editor.php' );

//Setup content builder for portfolio
require_once (get_template_directory() . "/modules/content_builder_portfolio.php");

// Setup shortcode generator
require_once (get_template_directory() . "/modules/shortcode_generator.php");

// Setup Twitter API
require_once (get_template_directory() . "/modules/twitteroauth.php");


function pp_tag_cloud_filter($args = array()) {
   $args['smallest'] = 13;
   $args['largest'] = 13;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'pp_tag_cloud_filter', 90);

//Control post excerpt length
function custom_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 200 );

/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
add_filter( 'comment_form_default_fields', 'wpse_62742_comment_placeholders' );
 
function wpse_62742_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input', '<input placeholder="'. __('Name', THEMEDOMAIN). '"',$fields['author']);
    $fields['email'] = str_replace('<input id="email" name="email" type="text"', '<input type="email" placeholder="'.__('Email', THEMEDOMAIN).'"  id="email" name="email"',$fields['email']);
    $fields['url'] = str_replace('<input id="url" name="url" type="text"', '<input placeholder="'.__('Website', THEMEDOMAIN).'" id="url" name="url" type="url"',$fields['url']);

    return $fields;
}

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

//Add upload form to page
if (is_admin()) {
  $current_admin_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);

  if ($current_admin_page == 'post' || $current_admin_page == 'post-new')
  {
 
    /** Need to force the form to have the correct enctype. */
    function add_post_enctype() {
      echo "<script type=\"text/javascript\">
        jQuery(document).ready(function(){
        jQuery('#post').attr('enctype','multipart/form-data');
        jQuery('#post').attr('encoding', 'multipart/form-data');
        });
        </script>";
    }
 
    add_action('admin_head', 'add_post_enctype');
  }
}


if(THEMEDEMO)
{
	function add_my_query_var( $link ) 
	{
		$arr_params = array();
	
		if(isset($_GET['boxed'])) 
		{
			$arr_params['boxed'] = $_GET['boxed'];
		}
		
		$link = add_query_arg( $arr_params, $link );
	    
	    return $link;
	}
	add_filter('category_link','add_my_query_var');
	add_filter('page_link','add_my_query_var');
	add_filter('post_link','add_my_query_var');
	add_filter('term_link','add_my_query_var');
	add_filter('tag_link','add_my_query_var');
	add_filter('category_link','add_my_query_var');
	add_filter('post_type_link','add_my_query_var');
	add_filter('attachment_link','add_my_query_var');
	add_filter('year_link','add_my_query_var');
	add_filter('month_link','add_my_query_var');
	add_filter('day_link','add_my_query_var');
	add_filter('search_link','add_my_query_var');
	
	add_filter('previous_post_link','add_my_query_var');
	add_filter('next_post_link','add_my_query_var');
}

if (isset($_GET['activated']) && $_GET['activated']){
	//Add default contact fields
	$pp_contact_form = get_option('pp_contact_form');
	if(empty($pp_contact_form))
	{
		add_option( 'pp_contact_form', 's:1:"3";' );
	}
	
	$pp_contact_form_sort_data = get_option('pp_contact_form_sort_data');
	if(empty($pp_contact_form_sort_data))
	{
		add_option( 'pp_contact_form_sort_data', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}' );
	}

	wp_redirect(admin_url("themes.php?page=functions.php&activate=true#pp_panel_demo-content"));
}
?>