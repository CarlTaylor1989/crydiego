/*
====================================================================================================
@name			jQuery loadImages
@version		1.0.0
@author			Krio
@author-uri		http://krio.me/jquery-image-loader-plugin
				http://github.com/jquery-image-loader-plugin
@license		GNU General Public License version 3.0
====================================================================================================
*/

(function($) {

	$.fn.loadImages = function(options) {
    	var opts = $.extend({}, $.fn.loadImages.defaults, options);
		var imagesToLoad = $(this).find("img")
									.css({opacity: 0, visibility: "hidden"})
									.addClass("loadImages");
		var imagesToLoadCount = imagesToLoad.size();

		var checkIfLoadedTimer = setInterval(function() {
			if(!imagesToLoadCount) {
				clearInterval(checkIfLoadedTimer);
				return;
			} else {
				imagesToLoad.filter(".loadImages").each(function() {
					if(this.complete) {
						fadeImageIn(this);
						imagesToLoadCount--;
					}
				});
			}
		}, opts.loadedCheckEvery);

		var fadeImageIn = function(imageToLoad) {
			$(imageToLoad).css({visibility: "visible"})
							.animate({opacity: 1}, 
								opts.imageEnterDelay, 
								removeImageClass(imageToLoad));
		};

		var removeImageClass = function(imageToRemoveClass) {
			$(imageToRemoveClass).removeClass("loadImages");
		};
	};

	$.fn.loadImages.defaults = {
		loadedCheckEvery: 350,
		imageEnterDelay: 900
	};

})(jQuery);