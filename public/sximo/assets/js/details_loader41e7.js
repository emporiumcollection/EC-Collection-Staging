(function($) {
	/**
	/* 	UPDATE BY JP - 18.07.2016
	/*
	**/
	// Add loader and code necessary for all pages
	Drupal.behaviors.details_loader = {
		attach: function (context, settings){

			var backgroundColor = settings['details_loader']['background-color'];
			loader = $('<div id="loader"></div>');
			loader.append($('<div class="splash" style="background-color:'+backgroundColor+'"></div>'));
			loader.append($('<div class="loading"><div id="loader-logo-under"></div><div id="loader-logo-up"></div></div>'));

			//Var haveYetLoaded test if the page are alredy loaded. Usefull for ajax call.
			if(window.haveYetLoaded == "undefined"){
				$('body').prepend(loader);
			}

			/**
			 * Loader
			 */
			if (typeof window.loaded == "undefined") {
				window.loaded = function() {
					// no-op
					window.haveYetLoaded = true;
				};
			}
			if (typeof window.loadComplete == "undefined") {
				window.loadComplete = function() {
					$("html").addClass("loaded");
					$('body #page-wrapper').css({'visibility':'visible'});
					$("#loader").fadeOut( 500, function() {$('#loader').remove();});
					setTimeout(window.loaded, 50);
				};
			}
			if (typeof window.loadProgress == "undefined") {
				window.loadProgress = function(percentage) {
					percentage = parseInt(percentage);
					newWidth = 50*(percentage/100);
  					$('#loader-logo-up').css({width:newWidth});
				};
			}

			if (typeof $("body").queryLoader2 == "undefined") {
				window.loadComplete();
			} else {
				if(typeof window.haveYetLoaded == "undefined"){
					$("body").once().queryLoader2({
						onComplete : function() {
							window.loadComplete();
						},
						onProgress : function(percentage){
							window.scrollTo(0, 0); // to override iframe focus
							window.loadProgress(percentage);
						},
						barColor : backgroundColor,
						backgroundColor : backgroundColor,
						percentage : false,
						barHeight : 1,
						minimumTime : 0,
						fadeOutTime : 100
					});
				}else{
					window.loadComplete();
				}
			}
		}
	}

})(jQuery);
