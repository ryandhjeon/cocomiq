<?php

/*
	Begin creating admin options
*/

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$options = array (
 
//Begin admin header
array( 
		"name" => THEMENAME." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Website Identity</h2>Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => SHORTNAME."_favicon",
	"type" => "image",
	"std" => "",
),

array( "name" => "<h2>Global Image Settings</h2>Enable right click protection",
	"desc" => "Check this to disable right click",
	"id" => SHORTNAME."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable image dragging protection",
	"desc" => "Check this to disable dragging on all images",
	"id" => SHORTNAME."_enable_dragging",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Advanced Settings</h2>Tracking Code",
	"desc" => "Paste your Google Analytics code (or other) tracking code here. This code will be added into the footer of theme",
	"id" => SHORTNAME."_ga_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/head&gt;",
	"desc" => "This code will be added before &lt;/head&gt; tag",
	"id" => SHORTNAME."_before_head_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/body&gt;",
	"desc" => "This code will be added before &lt;/body&gt; tag",
	"id" => SHORTNAME."_before_body_code",
	"type" => "textarea",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "General"


//Begin tab "Header"
array( 	"name" => "Header",
		"type" => "section",
		"icon" => "layout-select-header.png",
),
array( "type" => "open"),

array( "name" => "<h2>Logo Settings</h2>Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => SHORTNAME."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Retina Logo",
	"desc" => "Retina Ready Image logo. It should be 2x size of normal logo",
	"id" => SHORTNAME."_retina_logo",
	"type" => "image",
	"std" => "",
),

array( "name" => "Transparent Logo",
	"desc" => "Image logo for transparent menu option",
	"id" => SHORTNAME."_logo_transparent",
	"type" => "image",
	"std" => "",
),
array( "name" => "Transparent Retina Logo",
	"desc" => "Retina Ready Image logo for transparent menu option. It should be 2x size of normal logo",
	"id" => SHORTNAME."_retina_logo_transparent",
	"type" => "image",
	"std" => "",
),
array( "name" => "Logo Margin Top (in pixels)",
	"desc" => "Select margin top value for logo",
	"id" => SHORTNAME."_logo_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "25",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),

array( "name" => "<h2>Main Menu Settings</h2>Main Menu Layout",
	"desc" => "Select layout for main menu",
	"id" => SHORTNAME."_menu_layout",
	"type" => "select",
	"options" => array(
		'topmenu' => 'Top Menu',
		'topmenu_fixed' => 'Top Fixed Menu',
		'leftmenu' => 'Left Menu',
	),
	"std" => "topmenu"
),
array( "name" => "Use border color for active menu item",
	"desc" => "check this to enable border color for active menu item",
	"id" => SHORTNAME."_menu_active_border",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Menu Font Family",
	"desc" => "Select main menu font family",
	"id" => SHORTNAME."_menu_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Menu font Size (in pixels)",
	"desc" => "Select main menu font size",
	"id" => SHORTNAME."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Menu font spacing (in pixels)",
	"desc" => "Select font spacing for main menu",
	"id" => SHORTNAME."_menu_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Menu font weight (in pixels)",
	"desc" => "Select font weight for main menu",
	"id" => SHORTNAME."_menu_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "600",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "Make Menu font uppercase",
	"desc" => "Check this to make main menu font uppercase",
	"id" => SHORTNAME."_menu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Menu Font Color",
	"desc" => "Select color for menu font",
	"id" => SHORTNAME."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Menu Hover State Color",
	"desc" => "Select color for menu in hover state",
	"id" => SHORTNAME."_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Menu Active State Color",
	"desc" => "Select color for menu in active state",
	"id" => SHORTNAME."_menu_active_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Menu Background Color",
	"desc" => "Select color for menu background",
	"id" => SHORTNAME."_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Border Color",
	"desc" => "Select color for menu bottom border",
	"id" => SHORTNAME."_menu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "Menu Background Opacity",
	"desc" => "Select opacity value for main menu background",
	"id" => SHORTNAME."_menu_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "95",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Menu Margin Top (in pixels)",
	"desc" => "Select margin top value for main menu",
	"id" => SHORTNAME."_menu_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),

array( "name" => "<h2>Sub Menu Settings</h2>Sub Menu font Size (in pixels)",
	"desc" => "Select sub menu font size",
	"id" => SHORTNAME."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Sub Menu font weight (in pixels)",
	"desc" => "Select font weight for sub menu",
	"id" => SHORTNAME."_submenu_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "400",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "Sub Menu font spacing (in pixels)",
	"desc" => "Select font spacing for sub menu",
	"id" => SHORTNAME."_submenu_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Make Sub Menu font uppercase",
	"desc" => "Check this to make sub menu font uppercase",
	"id" => SHORTNAME."_submenu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Sub Menu Font Color",
	"desc" => "Select color for submenu font",
	"id" => SHORTNAME."_submenu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Sub Menu Hover State Font Color",
	"desc" => "Select color for submenu in hover state",
	"id" => SHORTNAME."_submenu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sub Menu Background Color",
	"desc" => "Select color for submenu background",
	"id" => SHORTNAME."_submenu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Hover State Background Color",
	"desc" => "Select background color for submenu in hover state",
	"id" => SHORTNAME."_submenu_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f9f9f9"
),

array( "name" => "Sub Menu Border Color",
	"desc" => "Select color for sub menu border",
	"id" => SHORTNAME."_submenu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "<h2>Top Bar Settings (Top Menu Layout Only)</h2>Display Top Bar",
	"desc" => "Check this to display top bar",
	"id" => SHORTNAME."_topbar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Top Bar Colors Settings (Top Menu Layout Only)</h2>Top Bar Background Color",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_topbar_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f3f3f3"
),
array( "name" => "Top Bar Background Opacity",
	"desc" => "Select opacity value for top bar background",
	"id" => SHORTNAME."_topbar_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "95",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),
array( "name" => "Top Bar Border Color",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_topbar_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),
array( "name" => "Top Bar Font Color",
	"desc" => "Select color for the font",
	"id" => SHORTNAME."_topbar_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "<h2>Top Bar Info Settings (Top Menu Layout Only)</h2>Top Bar Phone Number",
    "desc" => "Enter phone number to display in contact info section of header",
    "id" => SHORTNAME."_topbar_phone",
    "type" => "text",
    "std" => ""
),

array( "name" => "Top Bar email address",
    "desc" => "Enter email address to display in contact info section of header",
    "id" => SHORTNAME."_topbar_email",
    "type" => "text",
    "std" => ""
),

array( "name" => "Top Bar contact page link URL",
    "desc" => "Enter email address to display in contact info section of header",
    "id" => SHORTNAME."_topbar_contact_url",
    "type" => "text",
    "std" => ""
),

array( "name" => "Top Bar Social Icons Color",
	"desc" => "Select color for header social icons",
	"id" => SHORTNAME."_topbar_social_scheme",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Open Header Social Icons link in new window",
	"desc" => "Check this to open header social icons link in new window",
	"id" => SHORTNAME."_topbar_social_link_blank",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Search Settings (Top Menu Layout Only)</h2>Use instant search",
	"desc" => "Select to enable AJAX instant search result",
	"id" => SHORTNAME."_ajax_search",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display search in header",
	"desc" => "Select to display search form in header next to the main menu",
	"id" => SHORTNAME."_ajax_search_header",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Left Menu Settings (Left Menu Layout Only)</h2>Display Social Icons Under Main Menu",
	"desc" => "Select to display social icons under main menu",
	"id" => SHORTNAME."_leftmenu_social",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Contact Info text",
	"desc" => "Enter contact, company etc. info. It displays under social icons",
	"id" => SHORTNAME."_leftmenu_footer_text",
	"type" => "textarea",
	"std" => ""
),

array( "type" => "close"),
//End first tab "Header"


//Begin first tab "Page Title"
array( 
		"name" => "Page-Title",
		"type" => "section",
		"icon" => "layout_edit.png",
),

array( "type" => "open"),

array( "name" => "<h2>Page Title Settings</h2>Page Title Text Alignment",
	"desc" => "Select text alignment for page title",
	"id" => SHORTNAME."_page_title_align",
	"type" => "select",
	"options" => array(
		'left' => 'Align Left',
		'center' => 'Align Center',
	),
	"std" => "left"
),
array( "name" => "Page Title font Size (in pixels)",
	"desc" => "Select page title font size",
	"id" => SHORTNAME."_page_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "21",
	"from" => 14,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Page Title font spacing (in pixels)",
	"desc" => "Select font spacing for page title",
	"id" => SHORTNAME."_page_title_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Page Title font weight (in pixels)",
	"desc" => "Select font weight for page title",
	"id" => SHORTNAME."_page_title_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "600",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "Make Page Title font uppercase",
	"desc" => "Check to make page title font uppercase",
	"id" => SHORTNAME."_page_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Page Title Padding Top (in pixels)",
	"desc" => "Select page title area padding top",
	"id" => SHORTNAME."_page_title_paddingtop",
	"type" => "jslider",
	"size" => "40px",
	"std" => "28",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),
array( "name" => "Page Title Padding Bottom (in pixels)",
	"desc" => "Select page title area padding bottom",
	"id" => SHORTNAME."_page_title_paddingbottom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "28",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),
array( "name" => "Page Title Background Color",
	"desc" => "Select color for page title background",
	"id" => SHORTNAME."_page_title_bgcolor",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Page Title Font Color",
	"desc" => "Select color for page title font",
	"id" => SHORTNAME."_page_title_fontcolor",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),
array( "name" => "<h2>Page Title With Background Image Settings</h2>Page Title Background Overlay Opacity",
	"desc" => "Select opacity value for page title background overlay",
	"id" => SHORTNAME."_page_title_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),
array( "name" => "Page Title With Background Image font Size (in pixels)",
	"desc" => "Select page title with background image font size",
	"id" => SHORTNAME."_page_title_bg_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "34",
	"from" => 14,
	"to" => 100,
	"step" => 1,
),

//End tab "Page Title"
array( "type" => "close"),


//Begin second tab "Sidebar"
array( 	"name" => "Sidebar",
		"type" => "section",
		"icon" => "application-sidebar-expand.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "name" => "<h2>Sidebar Font Settings</h2>Widget Title font size (in pixels)",
	"desc" => "Select sidebar widget title font size",
	"id" => SHORTNAME."_sidebar_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 13,
	"to" => 40,
	"step" => 1,
),
array( "name" => "Make Widget Title font uppercase",
	"desc" => "Check this to make sidebar widget title font uppercase",
	"id" => SHORTNAME."_sidebar_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Sidebar Widget Title font spacing (in pixels)",
	"desc" => "Select font spacing for sidebar widget title",
	"id" => SHORTNAME."_sidebar_title_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Sidebar Widget Title font weight (in pixels)",
	"desc" => "Select font weight for sidebar widget title",
	"id" => SHORTNAME."_sidebar_title_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "600",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "Widget Title Font",
	"desc" => "Select global font family for all sidebar widget's title",
	"id" => SHORTNAME."_sidebar_title_font",
	"type" => "font",
	"std" => ""
),

array( "name" => "<h2>Sidebar Content Colors Settings</h2>Sidebar Font Color",
	"desc" => "Select color for the font in sidebar",
	"id" => SHORTNAME."_sidebar_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Sidebar Widget Title Font Color",
	"desc" => "Select color for the widget title font in sidebar",
	"id" => SHORTNAME."_sidebar_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sidebar Link Color",
	"desc" => "Select color for the link in sidebar",
	"id" => SHORTNAME."_sidebar_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),

array( "name" => "Sidebar Hover Link Color",
	"desc" => "Select color for the hover font in sidebar",
	"id" => SHORTNAME."_sidebar_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#004e75"
),

array( "type" => "close"),
//End second tab "Sidebar"


//Begin fifth tab "Footer"
array( 	"name" => "Footer",
		"type" => "section",
		"icon" => "layout-select-footer.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Footer Widgets Area Settings</h2>Show Footer Sidebar",
	"desc" => "If you enable this option, you can add widgets to \"Footer Sidebar\" using Appearance > Widgets",
	"id" => SHORTNAME."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => SHORTNAME."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:70px;height:60px"><img src="'.get_template_directory_uri().'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:70px;height:60px"><img src="'.get_template_directory_uri().'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:70px;height:60px"><img src="'.get_template_directory_uri().'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:70px;height:60px"><img src="'.get_template_directory_uri().'/functions/images/4columns.png"/></div>',
	),
),
array( "name" => "<h2>Copyright, Footer Menu and Social Icons Settings</h2>Copyright text",
	"desc" => "Enter copyright text",
	"id" => SHORTNAME."_footer_text",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Copyright Right Area Content",
	"desc" => "Select content for copyright area right",
	"id" => SHORTNAME."_footer_right",
	"type" => "select",
	"options" => array(
		'social' => 'Social Icons',
		'menu' => 'Footer Menu',
	),
	"std" => "social"
),
array( "name" => "Display go to top button",
	"desc" => "Check this to display go to top button in footer",
	"id" => SHORTNAME."_footer_totop_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Footer Social Icons Settings</h2>Footer Social Icons Color Scheme",
	"desc" => "Select color style for footer social icons",
	"id" => SHORTNAME."_footer_social_scheme",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),
array( "name" => "Footer Social Icons Color Opacity",
	"desc" => "Select opacity value for footer social icons",
	"id" => SHORTNAME."_footer_social_opacity",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 10,
	"to" => 100,
	"step" => 10,
),
array( "name" => "Open Footer Social Icons link in new window",
	"desc" => "Check this to open footer social icons link in new window",
	"id" => SHORTNAME."_footer_social_link_blank",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Footer Content Colors Settings</h2>Footer Background Color",
	"desc" => "Select background color for footer area",
	"id" => SHORTNAME."_footer_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Footer Widget Header Font Color",
	"desc" => "Select color for the widget header font in footer",
	"id" => SHORTNAME."_footer_header_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Footer Font Color",
	"desc" => "Select color for the font in footer",
	"id" => SHORTNAME."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Footer Link Color",
	"desc" => "Select color for the link in footer",
	"id" => SHORTNAME."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),

array( "name" => "Footer Hover Link Color",
	"desc" => "Select color for the hover font in footer",
	"id" => SHORTNAME."_footer_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#004e75"
),

array( "name" => "Footer border Color",
	"desc" => "Select border color for footer",
	"id" => SHORTNAME."_footer_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "<h2>Copyright Bar Colors Settings</h2>Copyright Bar Background Color",
	"desc" => "Select background color for copyright bar",
	"id" => SHORTNAME."_copyright_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Copyright Bar Font Color",
	"desc" => "Select font color for copyright bar",
	"id" => SHORTNAME."_copyright_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Copyright Bar Link Color",
	"desc" => "Select link color for copyright bar",
	"id" => SHORTNAME."_copyright_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),

array( "name" => "Copyright Bar Hover Link Color",
	"desc" => "Select hover state link color for copyright bar",
	"id" => SHORTNAME."_copyright_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#004e75"
),

//End fifth tab "Footer"
array( "type" => "close"),

//Begin second tab "Mobile"
array( 	"name" => "Mobile",
		"type" => "section",
		"icon" => "phone.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Responsive Layout Settings</h2>Use responsive layout",
	"desc" => "Check this to enable responsive layout for tablet and mobile devices",
	"id" => SHORTNAME."_enable_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Mobile Menu Settings</h2>Mobile Menu Background Color",
	"desc" => "Select color for mobile menu background",
	"id" => SHORTNAME."_mobile_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Mobile Menu Font Color",
	"desc" => "Select color for mobile menu font",
	"id" => SHORTNAME."_mobile_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Mobile Menu Hover State Font Color",
	"desc" => "Select color for mobile menu in hover state",
	"id" => SHORTNAME."_mobile_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Mobile Menu Hover State Background Color",
	"desc" => "Select background color for mobile menu in hover state",
	"id" => SHORTNAME."_mobile_menu_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f9f9f9"
),

array( "name" => "Mobile Menu Border Color",
	"desc" => "Select color for mobile menu bottom border",
	"id" => SHORTNAME."_mobile_menu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "Make Mobile Menu font uppercase",
	"desc" => "Check this to display mobile menu font uppercase",
	"id" => SHORTNAME."_mobile_menu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Mobile Menu font bold",
	"desc" => "Check this to display mobile menu font bold",
	"id" => SHORTNAME."_mobile_menu_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Mobile Logo Settings</h2>Logo Margin Top (in pixels)",
	"desc" => "Select margin top value for logo",
	"id" => SHORTNAME."_mobile_logo_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Mobile"


//Begin first tab "Background"
array( 
		"name" => "Background",
		"type" => "section",
		"icon" => "paintcan.png",
),

array( "type" => "open"),

array( "name" => "<h2>Layout Settings</h2>Layout (Support only top menu layout)",
	"desc" => "Select main content layout style",
	"id" => SHORTNAME."_layout",
	"type" => "select",
	"options" => array(
		'wide' => 'Wide',
		'boxed' => 'Boxed',
	),
	"std" => "wide"
),

array( "name" => "<h2>Boxed Layout Background Settings</h2>Background Image For Outer Areas in Boxed Layout",
	"desc" => "Please upload or insert full image URL to use for background",
	"id" => SHORTNAME."_boxed_bg_image",
	"type" => "image",
	"std" => "",
),

array( "name" => "Use 100% Background Image",
	"desc" => "Check this option to have the background image display at 100% in width and height, scaled according to visitor screen resolution",
	"id" => SHORTNAME."_boxed_bg_image_cover",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Background Repeat",
	"desc" => "Select how background image repeat",
	"id" => SHORTNAME."_boxed_bg_image_repeat",
	"type" => "select",
	"options" => array(
		'no-repeat' => 'No Repeat',
		'repeat' => 'Repeat',
	),
	"std" => "no-repeat"
),

array( "name" => "Background Color",
	"desc" => "Select background color for boxed layout option",
	"id" => SHORTNAME."_boxed_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#d6d6d6"
),

array( "name" => "<h2>Main Content Background Settings</h2>Main Content Background Color",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_content_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f9f9f9"
),
	
array( "type" => "close"),
//End first tab "Background"


//Begin first tab "Typography"
array( 
		"name" => "Typography",
		"type" => "section",
		"icon" => "text_dropcaps.png",
),

array( "type" => "open"),

array( "name" => "<h2>Google Web Fonts Settings</h2>You can add additional Google Web Font.",
	"desc" => "Enter font name ex. Courgette <a href=\"http://www.google.com/webfonts\">Checkout Google Web Font Directory</a>",
	"id" => SHORTNAME."_ggfont0",
	"type" => "text",
	"std" => "",
),
array( "name" => "<h2>Header Font Settings</h2>Header Font",
	"desc" => "Select font style your header",
	"id" => SHORTNAME."_header_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Header Font Color",
	"desc" => "Select color for header tags",
	"id" => SHORTNAME."_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),
array( "name" => "Header font weight (in pixels)",
	"desc" => "Select font weight for header tags",
	"id" => SHORTNAME."_header_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "600",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "Select font size for H1 tag",
	"id" => SHORTNAME."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "30",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "Select font size for H2 tag",
	"id" => SHORTNAME."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "28",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "Select font size for H3 tag",
	"id" => SHORTNAME."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "Select font size for H4 tag",
	"id" => SHORTNAME."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "Select font size for H5 tag",
	"id" => SHORTNAME."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "Select font size for H6 tag",
	"id" => SHORTNAME."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "<h2>Body Font Settings</h2>Main Content Font",
	"desc" => "Select font style your main content",
	"id" => SHORTNAME."_body_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Main Content Font Size (in pixels)",
	"desc" => "Select font size your main content",
	"id" => SHORTNAME."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 20,
	"step" => 1,
),
array( "name" => "<h2>Content Builder Font Settings</h2>Content Builder Title font Size (in pixels)",
	"desc" => "Select font size for content builder title",
	"id" => SHORTNAME."_ppb_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 16,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Make Content Builder Title font uppercase",
	"desc" => "Check this to make content builder title font uppercase",
	"id" => SHORTNAME."_ppb_header_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Content Builder Title font spacing (in pixels)",
	"desc" => "Select font spacing for content builder title",
	"id" => SHORTNAME."_ppb_header_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Content Builder Title font weight (in pixels)",
	"desc" => "Select font weight for content builder title",
	"id" => SHORTNAME."_ppb_header_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "300",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
array( "name" => "Content Builder Sub Title font Size (in pixels)",
	"desc" => "Select font size for content builder sub title",
	"id" => SHORTNAME."_ppb_subtitle_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 11,
	"to" => 40,
	"step" => 1,
),
array( "name" => "Make Content Builder Sub Title font uppercase",
	"desc" => "Check this to make content builder sub title font uppercase",
	"id" => SHORTNAME."_ppb_subtitle_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Content Builder Sub Title font spacing (in pixels)",
	"desc" => "Select font spacing for content builder sub title",
	"id" => SHORTNAME."_ppb_subtitle_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "2",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "<h2>Content Meta Font Settings</h2>Post Meta font",
	"desc" => "Select font style for post meta",
	"id" => SHORTNAME."_post_meta_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Header Tagline, Post Meta font Size",
	"desc" => "Select font size for post meta",
	"id" => SHORTNAME."_post_meta_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "10",
	"from" => 10,
	"to" => 30,
	"step" => 1,
),
array( "name" => "Header Tagline, Post Meta font uppercase",
	"desc" => "Check this to make content builder header font uppercase",
	"id" => SHORTNAME."_post_meta_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Header Tagline, Post Meta font spacing (in pixels)",
	"desc" => "Select font spacing for content builder header",
	"id" => SHORTNAME."_post_meta_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "2",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Header Tagline, Post Meta font weight (in pixels)",
	"desc" => "Select font weight for content builder header",
	"id" => SHORTNAME."_post_meta_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "400",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),
	
array( "type" => "close"),
//End first tab "Typography"


//Begin first tab "Styling"
array( 
		"name" => "Styling",
		"type" => "section",
		"icon" => "palette.png",
),

array( "type" => "open"),

array( "name" => "<h2>Page Content Colors Settings</h2>Font Color",
	"desc" => "Select color for the font",
	"id" => SHORTNAME."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),
array( "name" => "Page Content Link and Highlight Color",
	"desc" => "Select color for the link",
	"id" => SHORTNAME."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),

array( "name" => "Page Content Hover Link Color",
	"desc" => "Select color for the hover background color",
	"id" => SHORTNAME."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#004e75"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Font Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => SHORTNAME."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Horizontal Line Color",
	"desc" => "Select color for default page horizontal line",
	"id" => SHORTNAME."_hr_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "<h2>Input Colors Settings</h2>Input and Textarea Background Color",
	"desc" => "Select color for input and textarea background",
	"id" => SHORTNAME."_input_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Input and Textarea Font Color",
	"desc" => "Select font color for input and textarea",
	"id" => SHORTNAME."_input_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "Input and Textarea Border Color",
	"desc" => "Select border color for input and textarea",
	"id" => SHORTNAME."_input_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e1e1e1"
),

array( "name" => "Input and Textarea On Focus State Color",
	"desc" => "Select color for input and textarea in focused state",
	"id" => SHORTNAME."_input_focus_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Button Colors Settings</h2>Button Font",
	"desc" => "Select font family for button",
	"id" => SHORTNAME."_button_font",
	"type" => "font",
	"std" => ""
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => SHORTNAME."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Background Color",
	"desc" => "Select background color for the button",
	"id" => SHORTNAME."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),

array( "name" => "Button Hover and Active State Color",
	"desc" => "Select color for the button background hover and active state",
	"id" => SHORTNAME."_button_active_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#004e75"
),

array( "type" => "close"),
//End first tab "Styling"


//Begin second tab "Shortcode"
array( 	"name" => "Shortcode",
		"type" => "section",
		"icon" => "color_swatch.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Service Shortcode Settings</h2>Service Align left Icon Color",
	"desc" => "Select color for service align left icon",
	"id" => SHORTNAME."_service_icon1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Service Align Center Icon Background Color",
	"desc" => "Select background color for service align center icon",
	"id" => SHORTNAME."_service_icon2_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f0f0f0"
),

array( "name" => "Service Align Center Icon Color",
	"desc" => "Select color for service align center icon",
	"id" => SHORTNAME."_service_icon2_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Make Service Title font uppercase",
	"desc" => "Check this to make service title font uppercase",
	"id" => SHORTNAME."_service_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Accordion Shortcode Settings</h2>Accordion Header Background Color",
	"desc" => "Select background color for accordion header",
	"id" => SHORTNAME."_accordion_header_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Accordion Header Font Color",
	"desc" => "Select font color for accordion header",
	"id" => SHORTNAME."_accordion_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Tab Shortcode Settings</h2>Active Tab Background Color",
	"desc" => "Select background color for active tab",
	"id" => SHORTNAME."_tab_active_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Active Tab Header Font Color",
	"desc" => "Select font color for active tab header",
	"id" => SHORTNAME."_tab_active_header_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Non-Active Tab Header Background Color",
	"desc" => "Select background color for non-active tab",
	"id" => SHORTNAME."_tab_none_active_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f0f0f0"
),

array( "name" => "Non-Active Tab Header Font Color",
	"desc" => "Select font color for non-active tab header",
	"id" => SHORTNAME."_tab_none_active_header_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#555555"
),

array( "type" => "close"),
//End second tab "Shortcode"


//Begin second tab "Gallery"
array( 	"name" => "Gallery",
		"type" => "section",
		"icon" => "pictures.png",
),
array( "type" => "open"),

array( "name" => "<h2>Global Gallery Settings</h2>Gallery Images Sorting",
	"desc" => "Select how you want to sort gallery images",
	"id" => SHORTNAME."_gallery_sort",
	"type" => "select",
	"options" => array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	),
	"std" => ""
),

array( "name" => "Display image caption in lightbox",
	"desc" => "Check if you want to display image caption under the image in lightbox mode",
	"id" => SHORTNAME."_lightbox_enable_caption",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable gallery image hover effect",
	"desc" => "Check if you want to display gallery image hover effect",
	"id" => SHORTNAME."_gallery_hover",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Gallery"


//Begin second tab "Portfolio"
array( 	"name" => "Portfolio",
		"type" => "section",
		"icon" => "folder-open-image.png",
),
array( "type" => "open"),

array( "name" => "<h2>Filterable Settings</h2>Enable Portfolio Filterable Feature",
	"desc" => "Check this option to enable filterable feature in portfolio pages",
	"id" => SHORTNAME."_filterable_enable",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Filterable options sorting",
	"desc" => "Select how you want to sort filterable portfolio category",
	"id" => SHORTNAME."_portfolio_set_sort",
	"type" => "select",
	"options" => array(
		'name' => 'By Name',
		'slug' => 'By Slug',
		'id' => 'By ID',
		'count' => 'By Number of Portfolios',
	),
	"std" => 'name'
),
array( "name" => "Filterable Bar Font Color",
	"desc" => "Select color for the filterable text",
	"id" => SHORTNAME."_filterable_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#444444"
),

array( "name" => "<h2>Portfolio Category Settings</h2>Portfolio Category Layout",
	"desc" => "Select page template for displaying portfolio category contents",
	"id" => SHORTNAME."_set_page_template",
	"type" => "select",
	"options" => array(
		'portfolio-classic-fullwidth' => 'Portfolio Classic Fullwidth',
		'portfolio-classic-masonry-fullwidth' => 'Portfolio Classic Masonry Fullwidth',
		'portfolio-grid-fullwidth' => 'Portfolio Grid Fullwidth',
		'portfolio-grid-masonry-fullwidth' => 'Portfolio Grid Masonry Fullwidth',
		'portfolio-classic-2' => 'Portfolio Classic 2 Columns',
		'portfolio-classic-3' => 'Portfolio Classic 3 Columns',
		'portfolio-classic-4' => 'Portfolio Classic 4 Columns',
		'portfolio-2-grid' => 'Portfolio Grid 2 Columns',
		'portfolio-3-grid' => 'Portfolio Grid 3 Columns',
		'portfolio-4-grid' => 'Portfolio Grid 4 Columns',
	),
	"std" => 1
),

array( "name" => "<h2>Portfolio Items Settings</h2>Portfolio page show at most",
	"desc" => "Enter number of portfolio items you want to display per page",
	"id" => SHORTNAME."_portfolio_items_page",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 100,
	"step" => 1,
),

array( "name" => "Make Portfolio Title font uppercase",
	"desc" => "Check to make portfolio title font uppercase",
	"id" => SHORTNAME."_portfolio_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Portfolio Title font bold",
	"desc" => "Check to make portfolio title font bold",
	"id" => SHORTNAME."_portfolio_title_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Portfolio Excerpt font Size (in pixels)",
	"desc" => "Select portfolio & gallery image excerpt font size",
	"id" => SHORTNAME."_portfolio_info_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "10",
	"from" => 10,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Portfolio Excerpt font spacing (in pixels)",
	"desc" => "Select font spacing for portfolio & gallery image excerpt",
	"id" => SHORTNAME."_portfolio_info_font_spacing",
	"type" => "jslider",
	"size" => "40px",
	"std" => "2",
	"from" => 0,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Portfolio Excerpt font weight (in pixels)",
	"desc" => "Select font weight for portfolio & gallery image excerpt",
	"id" => SHORTNAME."_portfolio_info_font_weight",
	"type" => "jslider",
	"size" => "40px",
	"std" => "500",
	"from" => 100,
	"to" => 900,
	"step" => 100,
),

array( "name" => "Enable Portfolio On Hover Fade Effect",
	"desc" => "Check to make enable fade out effect when move mouse over portfolio item",
	"id" => SHORTNAME."_portfolio_fade_effect",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Portfolio Classic Settings</h2>Portfolio Classic Info Background Color",
	"desc" => "Select background color for portfolio info",
	"id" => SHORTNAME."_portfolio_info_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Portfolio Classic Info Header Font Color",
	"desc" => "Select color for portfolio header text",
	"id" => SHORTNAME."_portfolio_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),
array( "name" => "Portfolio Classic Excerpt Font Color",
	"desc" => "Select color for portfolio excerpt text",
	"id" => SHORTNAME."_portfolio_info_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#777777"
),

array( "name" => "<h2>Portfolio Grid Settings</h2>Portfolio Grid Info Background Color",
	"desc" => "Select background color for portfolio grid",
	"id" => SHORTNAME."_portfolio_grid_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#001d2c"
),
array( "name" => "Portfolio Grid Info Header Font Color",
	"desc" => "Select color for portfolio header text",
	"id" => SHORTNAME."_portfolio_grid_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Portfolio Grid Excerpt Font Color",
	"desc" => "Select color for portfolio excerpt text",
	"id" => SHORTNAME."_portfolio_grid_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Single Portfolio Settings</h2>Display social media sharing",
	"desc" => "Check this option to display social media sharing in single portfolio page",
	"id" => SHORTNAME."_portfolio_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display next and previous portfolios on single page",
	"desc" => "Check this option to display next and previous portfolios in single portfolio page",
	"id" => SHORTNAME."_portfolio_next_prev",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Portfolio"


array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Blog Layout Settings</h2>Archive Page Layout",
	"desc" => "Select page layout for displaying archive page",
	"id" => SHORTNAME."_blog_archive_layout",
	"type" => "select",
	"options" => array(
		'blog_g' => 'Grid',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "Category Page Layout",
	"desc" => "Select page layout for displaying category page",
	"id" => SHORTNAME."_blog_category_layout",
	"type" => "select",
	"options" => array(
		'blog_g' => 'Grid',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "Tag Page Layout",
	"desc" => "Select page layout for displaying tag page",
	"id" => SHORTNAME."_blog_tag_layout",
	"type" => "select",
	"options" => array(
		'blog_g' => 'Grid',
		'blog_gs' => 'Grid + Right Siebar',
		'blog_gls' => 'Grid + Left Siebar',
		'blog_r' => 'Right Sidebar',
		'blog_l' => 'Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "<h2>Typography Settings</h2>Make Blog Post Title font uppercase",
	"desc" => "Check this to make blog post title font uppercase",
	"id" => SHORTNAME."_post_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Blog Post Title font bold",
	"desc" => "Check to make blog post title font bold",
	"id" => SHORTNAME."_post_title_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Blog Post Meta Font Color",
	"desc" => "Select color for the post meta",
	"id" => SHORTNAME."_post_meta_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#777777"
),
array( "name" => "<h2>Single Post Page Settings</h2>Display social media sharing",
	"desc" => "Check this option to display social media sharing in single post page",
	"id" => SHORTNAME."_blog_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display featured content",
	"desc" => "Check this to display featured content (image or gallery) in single post page",
	"id" => SHORTNAME."_blog_feat_content",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display tags on single post page",
	"desc" => "Check this option to display post's tags on single post page",
	"id" => SHORTNAME."_blog_display_tags",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Display about author module",
	"desc" => "Select to display about the author in single post page",
	"id" => SHORTNAME."_blog_display_author",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display next and previous posts",
	"desc" => "Check this option to display next and previous posts in single post page",
	"id" => SHORTNAME."_blog_next_prev",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display related posts module",
	"desc" => "Check this display related posts in single post page",
	"id" => SHORTNAME."_blog_display_related",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Other Settings</h2>Display full blog post content on blog page",
	"desc" => "Check this option to display post full content in blog page (excerpt blog grid layout)",
	"id" => SHORTNAME."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),


array( "type" => "close"),


//Begin fourth tab "Contact"
array( 	"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
),
array( "type" => "open"),
	

array( "name" => "<h2>Contact Form Settings</h2>Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => SHORTNAME."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),
array( "name" => "<h2>Google Map Setting</h2>Custom Google Map Style",
	"desc" => "Enter javascript style array of map. You can get sample one from <a href=\"https://snazzymaps.com\" target=\"_blank\">Snazzy Maps</a>",
	"id" => SHORTNAME."_googlemap_style",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "<h2>Captcha Settings</h2>Enable Captcha",
	"desc" => "If you enable this option, contact page will display captcha image to prevent possible spam",
	"id" => SHORTNAME."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1,
),
array( "type" => "close"),

//End fourth tab "Contact"

//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook age URL",
	"desc" => "Enter full Facebook page URL",
	"id" => SHORTNAME."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "Enter Twitter username",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Google Plus URL",
	"desc" => "Enter Google Plus URL",
	"id" => SHORTNAME."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "Enter Flickr username",
	"id" => SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Channel ID",
	"desc" => "Enter Youtube channel ID",
	"id" => SHORTNAME."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "Enter Vimeo username",
	"id" => SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "Enter Tumblr username",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "Enter Dribbble username",
	"id" => SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "Enter full Linkedin URL",
	"id" => SHORTNAME."_linkedin_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Pinterest Username",
	"desc" => "Enter Pinterest username",
	"id" => SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Instagram Username",
	"desc" => "Enter Instagram username",
	"id" => SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Behance Username",
	"desc" => "Enter Behance username",
	"id" => SHORTNAME."_behance_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Twitter API Settings</h2>Twitter Consumer Key <a href=\"http://support.themegoods.com/?knowledgebase=fix-twitter-widget\">See instructions</a>",
	"desc" => "Enter Twitter API Consumer Key",
	"id" => SHORTNAME."_twitter_consumer_key",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Secret",
	"desc" => "Enter Twitter API Consumer Secret",
	"id" => SHORTNAME."_twitter_consumer_secret",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Token",
	"desc" => "Enter Twitter API Consumer Token",
	"id" => SHORTNAME."_twitter_consumer_token",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Token Secret",
	"desc" => "Enter Twitter API Consumer Token Secret",
	"id" => SHORTNAME."_twitter_consumer_token_secret",
	"type" => "text",
	"std" => ""
),
array( "type" => "close"),

//End fifth tab "Social Profiles"


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "css.png",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "<h2>Child Theme Settings</h2>Enable Child Theme",
	"desc" => "Check this option if you want to use child theme and custom CSS in child theme style.css",
	"id" => SHORTNAME."_child_theme",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>CSS and Javascript Optimisation Settings</h2>Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time. <strong>NOTE: If you enable child theme CSS compression is not support</strong>",
	"id" => SHORTNAME."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Cache Settings</h2>Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close"),


//Begin second tab "Demo"
array( "name" => "Demo-Content",
	"type" => "section",
	"icon" => "database_add.png",
),

array( "type" => "open"),

array( "name" => "<h2>Import Demo Content</h2>",
	"desc" => "",
	"id" => SHORTNAME."_import_demo_content",
	"type" => "html",
	"html" => '<strong>*NOTE:</strong> If you import demo content. It will overwrite the existing data and settings. It\'s not included revolution slider and widgets settings so you have to configure that settings once it\'s done.<br/><br/>
	<ul id="import_demo_content" class="demo_list">
	    <li class="fullwidth" data-demo="1">
	    	<div class="item_content_wrapper">
	    		<div class="item_content">
	    			<div class="item_thumb"><img src="'.get_template_directory_uri().'/cache/demos/meteors1.jpg" alt=""/></div>
	    			<div class="item_content">
				    	<strong>Top Menu Demo</strong><br/>
				    	<a href="http://themes.themegoods2.com/meteors/">(See Sample)</a><br/><br/>
				    	<strong>What\'s Included?</strong>: posts, pages and custom post type contents, images, videos and theme settings
				    </div>
			    </div>
		    </div>
	    </li>
	    <li class="fullwidth" data-demo="2">
	    	<div class="item_content_wrapper">
	    		<div class="item_content">
	    			<div class="item_thumb"><img src="'.get_template_directory_uri().'/cache/demos/meteors2.jpg" alt=""/></div>
	    			<div class="item_content">
				    	<strong>Left Menu Demo</strong><br/>
				    	<a href="http://themes.themegoods2.com/meteors2/">(See Sample)</a><br/><br/>
				    	<strong>What\'s Included?</strong>: posts, pages and custom post type contents, images, videos and theme settings
				    </div>
			    </div>
		    </div>
	    </li>
	</ul>
	<input id="pp_import_content_button" name="pp_import_content_button" type="button" value="Import Selected" class="upload_btn button-primary"/>
	<input type="hidden" id="pp_import_demo_content" name="pp_import_demo_content" value=""/>
	<div class="import_message"><img src="'.get_template_directory_uri().'/functions/images/ajax-loader.gif" alt="" style="vertical-align: middle;"/><br/><br/>*Data is being imported please be patient, don\'t navigate away from this page</div>
	',
),
 
array( "type" => "close"),


//Begin second tab "Backup"
array( "name" => "Import-Export",
	"type" => "section",
	"icon" => "drive_disk.png",
),

array( "type" => "open"),

array( "name" => "<h2>Import Settings</h2> Import Demo Site Settings<br/>",
	"desc" => "",
	"id" => SHORTNAME."_import_demo",
	"type" => "html",
	"html" => '<strong>*NOTE:</strong> Demo setting is not sample content. It imports only theme admin panel settings including colors, font etc. You still have to add your own contents ex. pages, post, portfolios.<br/><br/>
	<ul id="import_demo" class="demo_list">
	    <li class="selected" data-demo="1">
	    	<div class="item_content_wrapper">
	    		<div class="item_content">
			    	<strong>Top Menu Demo</strong><br/>
			    	<a href="http://themes.themegoods2.com/meteors/">(See Sample)</a>
			    </div>
		    </div>
	    </li>
	    <li data-demo="2">
	    	<div class="item_content_wrapper">
	    		<div class="item_content">
			    	<strong>Left Menu Demo</strong><br/>
			    	<a href="http://themes.themegoods2.com/meteors2/">(See Sample)</a>
			    </div>
		    </div>
	    </li>
	</ul>
	<input id="pp_import_default_button" name="pp_import_default_button" type="submit" value="Import Selected" class="upload_btn button-primary"/>
	<input type="hidden" id="pp_import_demo" name="pp_import_demo" value="1"/>
	<input type="hidden" id="pp_import_default" name="pp_import_default" value=""/>
	',
),

array( "name" => "Import Setting from .json file<br/>",
	"desc" => "Choose theme export file (.json) from your computer and click \"Import\" button",
	"id" => SHORTNAME."_import_current",
	"type" => "html",
	"html" => '<input type="file" id="'.SHORTNAME.'_import_current" name="'.SHORTNAME.'_import_current"/><input type="submit" id="'.SHORTNAME.'_import_current_button" class="button" value="Import"/>',
),

array( "name" => "<h2>Export Settings</h2>",
	"desc" => "You can click below button to save current backup into .json file so you can import it back any time using restore form below.",
	"id" => SHORTNAME."_export_current",
	"type" => "html",
	"html" => '<input type="submit" id="'.SHORTNAME.'_export_current_button" class="button" value="Export Current Theme Settings"/><input type="hidden" id="'.SHORTNAME.'_export_current" name="'.SHORTNAME.'_export_current" value="0"/>',
),

array( "type" => "close"),


//Begin second tab "Auto update"
array( "name" => "Auto-update",
	"type" => "section",
	"icon" => "arrow_refresh.png",
),

array( "type" => "open"),

array( "name" => "<h2>Envato API Settings</h2>Envato Username",
	"desc" => "Enter you Envato username",
	"id" => SHORTNAME."_envato_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Envato API Key",
	"desc" => "Enter account API key. You can get it from Your account > Settings > API Keys",
	"id" => SHORTNAME."_envato_api_key",
	"type" => "text",
	"std" => ""
)
 
);

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
		$options[] = array( 
			"name" => "Update Theme<br/>",
			"desc" => "",
			"id" => SHORTNAME."_theme_go_update",
			"type" => "html",
			"html" => '
			Click to update '.THEMENAME.' theme to the latest version. If you made changes on any them code, please backup your changes first otherwise they will be overwritten by the update.<br/><br/>
			<a id="'.SHORTNAME.'_theme_go_update_bth" href="'.$api_url.'" class="button button-primary">Click here to update theme</a>
			<div class="update_message"><img src="'.get_template_directory_uri().'/functions/images/ajax-loader.gif" alt="" style="vertical-align: middle;"/><br/><br/>*Theme is being updated please be patient, don\'t navigate away from this page</div>',
		);
	}
}

$options[] = array( "type" => "close");
?>