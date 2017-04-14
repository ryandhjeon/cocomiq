jQuery(document).ready(function(){ 
	"use strict";
	
	//Desktop menu
	jQuery('#menu_wrapper div .nav li a').on( 'click', function(event){
		var linkURL = jQuery(this).attr('href');
	
		if(linkURL.slice(0,1)=='#')
		{
			event.preventDefault();
			var sectionID = jQuery(this).attr('href').substr(1);
			
			if(jQuery('#pp_menu_layout').val() != 'leftmenu')
			{
				var topBarHeight = jQuery('.top_bar').height();
			}
			else
			{
				var topBarHeight = 0;
			}
			
			if(sectionID=='top')
			{
				jQuery('body,html').animate({scrollTop:0},1200);
			}
			else
			{
				jQuery('body,html').animate({
				    scrollTop: parseInt(jQuery('#'+sectionID).offset().top-topBarHeight)
				}, 1200);
			}
			
			jQuery('#menu_wrapper div .nav li').removeClass('current-menu-item');
			jQuery(this).parent('li').addClass('current-menu-item');
		}
		else
		{
			return true;
		}
	});
	
	jQuery('#menu_wrapper div .nav li a').each(function () {
		var sectionElement = jQuery(this).attr('href');
		
		if(jQuery('#pp_menu_layout').val() != 'leftmenu')
		{
			var topBarHeight = jQuery('.top_bar').height();
		}
		else
		{
			var topBarHeight = 0;
		}
	
		jQuery(sectionElement).waypoint(function(direction) {
			jQuery('#menu_wrapper div .nav li a').each(function(){
				if(jQuery(this).attr('href')==sectionElement)
				{
					jQuery('#menu_wrapper div .nav li').removeClass('current-menu-item');
					jQuery(this).parent('li').addClass('current-menu-item');
				}
			})
		}, { offset: topBarHeight });
	});
	
	//Mobile menu
	jQuery('.mobile_main_nav li a').on( 'click', function(event){
		var linkURL = jQuery(this).attr('href');
	
		if(linkURL.slice(0,1)=='#')
		{
			event.preventDefault();
			var sectionID = jQuery(this).attr('href').substr(1);
			
			if(jQuery('#pp_menu_layout').val() != 'leftmenu')
			{
				var topBarHeight = jQuery('.top_bar').height();
			}
			else
			{
				var topBarHeight = 0;
			}
			
			if(sectionID=='top')
			{
				setTimeout(function() {
					jQuery('body,html').animate({scrollTop:0},1200);
				}, 600);
			}
			else
			{
				setTimeout(function() {
					jQuery('body,html').animate({
					    scrollTop: parseInt(jQuery('#'+sectionID).offset().top-topBarHeight)
					}, 1200);
				}, 600);
			}
			
			jQuery('#close_mobile_menu').trigger('click');
		}
		else
		{
			return true;
		}
	});
	
	jQuery('.mobile_main_nav li a').each(function () {
		var sectionElement = jQuery(this).attr('href');
		
		if(jQuery('#pp_menu_layout').val() != 'leftmenu')
		{
			var topBarHeight = jQuery('.top_bar').height();
		}
		else
		{
			var topBarHeight = 0;
		}
	
		jQuery(sectionElement).waypoint(function(direction) {
			jQuery('.mobile_main_nav li a').each(function(){
				if(jQuery(this).attr('href')==sectionElement)
				{
					jQuery('.mobile_main_nav li').removeClass('current-menu-item');
					jQuery(this).parent('li').addClass('current-menu-item');
				}
			})
		}, { offset: topBarHeight });
	});
});