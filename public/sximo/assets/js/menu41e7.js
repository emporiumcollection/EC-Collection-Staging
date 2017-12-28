(function($) {
	
	// Behavior for menu
	Drupal.behaviors.menu = {
		attach : function(context, settings) {
			
			/**
			 * Navigation
			 */
			
			var menuOp = false;
			var timeoutFunction;
			
			var isMobile = {
			    Android: function() {
			        return navigator.userAgent.match(/Android/i);
			    },
			    BlackBerry: function() {
			        return navigator.userAgent.match(/BlackBerry/i);
			    },
			    iOS: function() {
			        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			    },
			    Opera: function() {
			        return navigator.userAgent.match(/Opera Mini/i);
			    },
			    Windows: function() {
			        return navigator.userAgent.match(/IEMobile/i);
			    },
			    any: function() {
			        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			    }
			};
			
			function init()
			{
				//add class "close" to menu toggle
				$("#block-ledunfly-menu-link").addClass('close');
				
				if(!isMobile.any()){
					//menu btn mouse events
					$('ul.menu li.menu-depth-1 > a').bind("mouseover", function(event) {
						clearTimeout(timeoutFunction);
						closeSubmenu(); 
						if($(this).parent().children('ul').length > 0 && $(this).parent().children('ul').css('display') == 'none'){showSubmenu($(this).parent().children('ul'), 0);}
					});
					$('ul.menu li.menu-depth-1 > a').bind("mouseout", function(event) {
						if(!isActiveSubmenu($(this).parent().children('ul')) ){
							timeoutFunction = setTimeout(function(){closeSubmenu(); openActiveSubmenu(0)}, 2000);
						}						
					});
					$('ul.menu li.menu-depth-2 > a').bind("mouseover", function(event) {
						clearTimeout(timeoutFunction);
					});
					$('ul.menu li.menu-depth-2 > a').bind("mouseout", function(event) {
						timeoutFunction = setTimeout(function(){closeSubmenu(); openActiveSubmenu(0)}, 2000);
					});
					
					
				}
				
				//menu toggle and menu open/close animation
				$("#block-ledunfly-menu-link").click(function(e) {
					openMenu();
				 	$(this).toggleClass('open');
					$(this).toggleClass('close');
				});
				//Close menu by clicking outside of it
				$(".content-column").click(function(e) {
					if(menuOp){
						openMenu();
						$("#block-ledunfly-menu-link").toggleClass('open');
						$("#block-ledunfly-menu-link").toggleClass('close');
					}
				});
			}
			
			function openMenu(){
				if(!menuOp){
					
					//disableScrolling();
					closeSubmenu();
					openActiveSubmenu(1);
					
					//Open menu
					$('#block-system-main-menu').css({width:730});
					$('#block-system-main-menu .block-inner').css({'display':'block'});
					TweenMax.to( $('#block-system-main-menu .block-inner'), 1.2, {marginLeft:0, ease:Expo.easeInOut});
					TweenMax.fromTo( $('#block-system-main-menu .block-menu-text'), 1, {autoAlpha:0, immediateRender:true}, {autoAlpha:1, ease:Expo.easeInOut, delay:.5});
					
					//Animate menu item level 1
					var countItemLevel1 = 1;
					$( 'ul.menu li.menu-depth-1' ).each(function( index ) {
				    	TweenMax.fromTo( $(this), .8, {autoAlpha:0, marginLeft:-30, immediateRender:true}, {autoAlpha:1, marginLeft:0, ease:Expo.easeOut, delay:.5+(0.1*countItemLevel1)});
			        	countItemLevel1++;
			        });
					menuOp = true;
				} else {
					
					//unableScrolling();
					
					//Close menu
					TweenMax.to( $('#block-system-main-menu .block-inner'), 1.2, {marginLeft:-810, ease:Expo.easeInOut, onComplete:function(){
						$('#block-system-main-menu .block-inner').css({'display':'none'});
						$('#block-system-main-menu').css({width:0});
					}});
					menuOp = false;
				}
			}
			
			function isActiveSubmenu(targetSub){
				var isActive = false;
				targetSub.children('li').children('a').each(function( index ) {
			    	if($(this).hasClass('active')){
			    		isActive = true;
			    	} 
			    });
		        return isActive;
		    }
			
			function openActiveSubmenu(delay){
				//Active menu is level 1
				$( 'ul.menu li a' ).each(function( index ) {
			    	if($(this).hasClass('active')) {
			    		showSubmenu($(this).parent().find('ul'), delay);
			    		return;
			    	}
			    });
		        //Active menu is level 2
				$( 'ul.menu li ul li a' ).each(function( index ) {
			    	if($(this).hasClass('active')) {showSubmenu($(this).parent().parent(), delay);}
		        });
			}
			
			function showSubmenu(targetSub, delay){
				//Animate menu level 2
				if(targetSub.css('display') == 'none'){
					targetSub.css({'display':'block'});
					TweenMax.fromTo(targetSub, .5, {autoAlpha:0, marginLeft:250, immediateRender:true}, {autoAlpha:1, marginLeft:320, ease:Expo.easeOut, delay:delay+.1});
					
					//Animate menu item level 2
					var countItemLevel2 = 1;
					targetSub.children('li').each(function( index ) {
						TweenMax.fromTo( $(this), .5, {autoAlpha:0, marginLeft:-15, immediateRender:true}, {autoAlpha:1, marginLeft:0, ease:Expo.easeOut, delay:delay+(0.05*countItemLevel2)});
					    countItemLevel2++;
					});
				}
				
			}
			function closeSubmenu(){
				//Hide all submenu
				$( 'ul.menu li' ).each(function( index ) {
			    	if($(this).children('ul').length > 0) $(this).children('ul').css({'display':'none'});
		        });
			}
			
			function disableScrolling(){
				$('html').css({
				    'overflow': 'hidden',
				});
			}
			function unableScrolling(){
				$('html').css({
				    'overflow': 'auto',
				});
			}
			
			/**
			 * Switcher language : init click on block title to show available language
			 */
			
			var narrowSize = 740;
			
			$('#block-locale-language .block-title').click(function(e){
				var itemLanguageCount = $('#block-locale-language li:not(.active)').length;
				var margin = 0;
				
				if ($('#block-locale-language').hasClass('open')){ //close switcher
					$('#block-locale-language').removeClass('open');
					// Animate language item
					$('#block-locale-language li:not(.active)').each(function(e){
						var target = $(this);
						TweenMax.to($(this), .5, {autoAlpha:1, bottom:0, ease:Expo.easeOut, onComplete:function(){target.css('visibility', 'hidden');}});
						itemLanguageCount--;
					});
				}else{ // open switcher
					$('#block-locale-language').addClass('open');
					// Animate language item
					$('#block-locale-language li:not(.active)').each(function(e){
						margin = parseInt(itemLanguageCount * $('#block-locale-language').width()) + 'px';
						TweenMax.fromTo($(this), .5, {autoAlpha:1, bottom:0, immediateRender:true}, {autoAlpha:1, bottom:margin, ease:Expo.easeOut});
						itemLanguageCount--;
					});
					
				}
			});
			
			
			
			
			/**************** INIT *****************/
			$(window).load(function(){
				init();
				// Switcher language : set active language value in the block title
	     		var activeLanguage = $('#block-locale-language li.active a.active').text();
	      		$('#block-locale-language .block-title').text(activeLanguage);
	      		$('#block-locale-language').css({'display':'block', 'visibility':'hidden'});
	      		TweenMax.to($('#block-locale-language'), .5, {autoAlpha:1, bottom:0, ease:Expo.easeOut});
			});
		}
	}
})(jQuery);