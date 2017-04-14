jQuery.fn.center = function ()
{
    this.css("left", (jQuery(window).width() / 2) - (this.outerWidth() / 2));
    return this;
}

jQuery.fn.animateAuto = function(prop, speed, callback){
    var elem, height, width;
    return this.each(function(i, el){
        el = jQuery(el), elem = el.clone().css({"height":"auto"}).appendTo("body");
        
        if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)
        {
        	height = elem.height();
	        height = elem.css("auto"),
	        width = elem.css("width");
        }
        else
        {
	        height = elem.height();
	        height = height,
	        width = elem.css("width");
	    }
        elem.remove();
        
        if(prop === "height")
            el.animate({"height":height+15}, speed, callback);
        else if(prop === "max-height")
            el.animate({"max-height":height}, speed, callback);
        else if(prop === "width")
            el.animate({"width":width}, speed, callback);  
        else if(prop === "both")
            el.animate({"width":width,"height":height}, speed, callback);
    });  
}

jQuery.fn.setNav = function(){
	var calScreenWidth = jQuery(window).width();
	
	if(calScreenWidth >= 960)
	{
		jQuery('#menu_border_wrapper').css({display: 'block'});
		jQuery('#main_menu li ul').css({display: 'none', opacity: 1});
	
		jQuery('#main_menu li').each(function()
		{	
			var jQuerysublist = jQuery(this).find('ul:first');
			
			jQuery(this).hover(function()
			{	
				position = jQuery(this).position();
				
				if(jQuery(this).parents().attr('class') == 'sub-menu')
				{	
					jQuerysublist.stop().css({height:'auto'}).fadeIn(500);
				}
				else
				{
					jQuerysublist.stop().css({overflow: 'visible', height:'auto'}).fadeIn(500);
				}
			},
			function()
			{	
				jQuerysublist.stop().css({height:'auto'}).fadeOut(500);	
			});
	
		});
		
		jQuery('#menu_wrapper .nav ul li ul').css({display: 'none', opacity: 1});
	
		jQuery('#menu_wrapper .nav ul li').each(function()
		{
			
			var jQuerysublist = jQuery(this).find('ul:first');
			
			jQuery(this).hover(function()
			{	
				jQuerysublist.stop().css({height:'auto'}).fadeIn(500);	
			},
			function()
			{	
				jQuerysublist.stop().css({height:'auto'}).fadeOut(500);	
			});		
			
		});
	}
}

function adjustIframes()
{
  jQuery('iframe').each(function(){
  
    var
    $this       = jQuery(this),
    proportion  = $this.data( 'proportion' ),
    w           = $this.attr('width'),
    actual_w    = $this.width();
    
    if ( ! proportion )
    {
        proportion = $this.attr('height') / w;
        $this.data( 'proportion', proportion );
    }
  
    if ( actual_w != w )
    {
        $this.css( 'height', Math.round( actual_w * proportion ) + 'px !important' );
    }
  });
}

function is_touch_device() {
  try {
    document.createEvent("TouchEvent");
    return true;
  } catch (e) {
    return false;
  }
}