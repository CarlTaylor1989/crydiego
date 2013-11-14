/*
====================================================================================================
@name			jQuery Muse
@version		1.0.0
@author			Pavel Richter / Grand Pixels
@author-uri		http://grandpixels.com
@copyright		2013 Pavel Richter / Grand Pixels
====================================================================================================
*/

/*
====================================================================================================
Init Tiles Layout
----------------------------------------------------------------------------------------------------
@name			jQuery Isotope
@since			1.0.0
@file			javascripts/jquery.isotope.min.js
----------------------------------------------------------------------------------------------------
*/

jQuery(window).load(function() {
	"use strict";
	
	jQuery(function(){

		var $container = jQuery('.grid-tiles'),
			$container_sidebar = jQuery('.grid-tiles-sidebar');
	
		var $containerProxy = $container.clone().empty().css({ visibility: 'hidden' }),
			$containerProxy_sidebar = $container_sidebar.clone().empty().css({ visibility: 'hidden' });
		
		$container.after($containerProxy);
		$container_sidebar.after($containerProxy_sidebar);

		var colNumber = 7,
            colNumber_sidebar = 6;
      
		jQuery(window).smartresize(function() {
			
			if ((jQuery(window).width() > 1680)) {
				
				colNumber = 7;
				colNumber_sidebar = 6;
				$container.find('.tile').css('width', '14.28%');
				$container.find('.tile.width-double').css('width', '28.57%');
				$container_sidebar.find('.tile').css('width', '16.66%');
				$container_sidebar.find('.tile.width-double').css('width', '33.33%');
				
			} else if ((jQuery(window).width() > 1440) && (jQuery(window).width() <= 1680)) {
				
				colNumber = 6;
				colNumber_sidebar = 5;
				$container.find('.tile').css('width', '16.66%');
				$container.find('.tile.width-double').css('width', '33.33%');
				$container_sidebar.find('.tile').css('width', '20%');
				$container_sidebar.find('.tile.width-double').css('width', '40%');
				
			} else if ((jQuery(window).width() > 1280) && (jQuery(window).width() <= 1440)) {
				
				colNumber = 5;
				colNumber_sidebar = 4;
				$container.find('.tile').css('width', '20%');
				$container.find('.tile.width-double').css('width', '40%');
				$container_sidebar.find('.tile').css('width', '25%');
				$container_sidebar.find('.tile.width-double').css('width', '50%');
				
			} else if ((jQuery(window).width() > 1024) && (jQuery(window).width() <= 1280)) {
				
				colNumber = 4;
				colNumber_sidebar = 3;
				$container.find('.tile').css('width', '25%');
				$container.find('.tile.width-double').css('width', '50%');
				$container_sidebar.find('.tile').css('width', '33.33%');
				$container_sidebar.find('.tile.width-double').css('width', '66.66%');
				
			} else if ((jQuery(window).width() > 768) && (jQuery(window).width() <= 1024)) {
				
				colNumber = 3;
				colNumber_sidebar = 2;
				$container.find('.tile').css('width', '33.33%');
				$container.find('.tile.width-double').css('width', '66.66%');
				$container_sidebar.find('.tile').css('width', '50%');
				$container_sidebar.find('.tile.width-double').css('width', '100%');
				
			} else if ((jQuery(window).width() > 480) && (jQuery(window).width() <= 768)) {
				
				colNumber = 2;
				colNumber_sidebar = 2;
				$container.find('.tile').css('width', '50%');
				$container.find('.tile.width-double').css('width', '100%');
				$container_sidebar.find('.tile').css('width', '50%');
				$container_sidebar.find('.tile.width-double').css('width', '100%');
				
			} else if (jQuery(window).width() <= 480) {
				
				colNumber = 1;
				colNumber_sidebar = 1;
				$container.find('.tile').css('width', '100%');
				$container.find('.tile.width-double').css('width', '100%');
				$container_sidebar.find('.tile').css('width', '100%');
				$container_sidebar.find('.tile.width-double').css('width', '100%');
				
			}
			
			var colWidth = Math.floor($containerProxy.width() / colNumber),
				colWidth_sidebar = Math.floor($containerProxy_sidebar.width() / colNumber_sidebar);
			
			
			// Isotope
			$container.css({
				width: colWidth * colNumber
			}).isotope({
				resizable: false,
				masonry: {
					columnWidth: colWidth
				}
			});
			
			// Isotope + sidebar							
			$container_sidebar.css({
				width: colWidth_sidebar * colNumber_sidebar
			}).isotope({
				resizable: false,
				masonry: {
					columnWidth: colWidth_sidebar
				}
			});
			
		}).smartresize();

	});
	
});

/*
====================================================================================================
Init Offcanvas Navigation
----------------------------------------------------------------------------------------------------
@name			jQuery Muse
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";

	var events = 'click.fndtn';

	// Watch for clicks to show the sidebar
	var $selector = jQuery('.navigation-mobile-button a');
    
	if ($selector.length > 0) {

		jQuery('.navigation-mobile-button a').on(events, function(e) {
			e.preventDefault();
			jQuery('body').toggleClass('mobile-active');
		});

	}
	
});

/*
====================================================================================================
Init Tabs
----------------------------------------------------------------------------------------------------
@name			jQuery UI
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	jQuery(".tabs").tabs();
		
});

/*
====================================================================================================
Init Back to Top Button
----------------------------------------------------------------------------------------------------
@name			jQuery Muse
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? "touchstart" : "click";

	jQuery(window).scroll(function() {
		
		if(jQuery(this).scrollTop() !== 0) {
			jQuery('.back-to-top').fadeIn();	
		} else {
			jQuery('.back-to-top').fadeOut();
		}
		
	});
	
	jQuery('.back-to-top').bind(event, function() {
		
		jQuery('body,html').animate({
			scrollTop: 0
		}, 800);
		
	});

});

/*
====================================================================================================
Init Lightbox
----------------------------------------------------------------------------------------------------
@name			jQuery touchTouch
@since			1.0.0
@file			javascripts/jquery.touchtouch.js
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";

	jQuery('.lightbox a').touchTouch();

});

/*
====================================================================================================
Init Modal Search
----------------------------------------------------------------------------------------------------
@name			jQuery Muse
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? "touchstart" : "click";

	jQuery(".modal-search-button").bind(event, function() {
		jQuery(".modal-search").fadeIn().css('display', 'table');
	});
	
	jQuery(".modal-search-close").bind(event, function() {
		jQuery(".modal-search").fadeOut();
	});
	
	jQuery(document).keyup(function(e) {
		if (e.keyCode === 27) {
			jQuery(".modal-search").fadeOut();  
		}
	});
	

});

/*
====================================================================================================
Alerts Function
----------------------------------------------------------------------------------------------------
@name			jQuery Muse
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

jQuery(document).ready(function() {
	"use strict";
	
	var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? "touchstart" : "click";
	
	jQuery(".alert .close").bind(event, function() {
		jQuery(this).closest(".alert").fadeOut();
	});

});

/*
====================================================================================================
IE7, IE8 Javascripts
----------------------------------------------------------------------------------------------------
@name			jQuery Muse
@since			1.0.0
----------------------------------------------------------------------------------------------------
*/

/* Image Overlay */
jQuery(document).ready(function() {
	"use strict";

	jQuery('.ie7 a.image-overlay,.ie8 a.image-overlay').hover(
		function() { 
			jQuery(this).find('span').stop(false,true).fadeIn(400); 
		},
		function() { 
			jQuery(this).find('span').stop(false,true).fadeOut(200); 
		}
	);

});