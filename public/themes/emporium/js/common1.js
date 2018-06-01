(function($) { 'use strict';

	// Calculate clients viewport
	function viewport() {
		var e = window, a = 'inner';
		if(!('innerWidth' in window )) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}

	// Strech center aligned images

	var centerAlignedImages = function () {

		viewport();
		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		var body = $('body');


		if(body.hasClass('single-jetpack-portfolio') && !body.hasClass('page-template-template-portfolio')){

			var centerAlignImg = $('.content-area .aligncenter');

			if(centerAlignImg.length){

				$('#primary').imagesLoaded(function(){
					centerAlignImg.each(function(){
						var $this = $(this);
						var centerAlignImgWidth;
						var entryContentWidth = $('.entry-content').width();

						if($this.is('img')){
							centerAlignImgWidth = $this.attr('width');
							if (centerAlignImgWidth > 860) {
								centerAlignImgWidth = 860;
							}
						}
						else{
							centerAlignImgWidth = $this.find('img').attr('width');
							if (centerAlignImgWidth > 860) {
								centerAlignImgWidth = 860;
							}
							if(x > 1024){
								$this.css({width: centerAlignImgWidth});
							}
							else{
								$this.css({width: ''});
							}
						}


						if(x > 1024){
							if(centerAlignImgWidth > entryContentWidth){
								if(centerAlignImgWidth > 860){
									$this.css({marginLeft: -((860 - entryContentWidth) / 2)});
								}
								else{
									$this.css({marginLeft: -((centerAlignImgWidth - entryContentWidth) / 2)});
								}
								$this.css({
									'position': 'relative',
									'z-index': '2'
								});
							}
						}
						else{
							$this.css({marginLeft: ''});
						}
					});
				});

			}
		};
	};

	var pageHasHeroSlider = $('.hero-slider-wrapper').length;
	if (pageHasHeroSlider) {
		var heroSlider = $('.hero-slider-wrapper'),
			heroSliderHeight = heroSlider.outerHeight(),
			blackBg = $('.black-bg'),
			wScrollTop = 0;
	}

	var heroSliderHide = function () {
		setTimeout(function(){
			wScrollTop = $(window).scrollTop();

			if(wScrollTop > 0){
				heroSlider.css({opacity: (heroSliderHeight - wScrollTop) / heroSliderHeight});
				if (wScrollTop > heroSliderHeight) {
					heroSlider.css('display', 'none');
					blackBg.css('display', 'none');
				} else {
					heroSlider.css('display', 'block');
					blackBg.css('display', 'block');
				}
				$('.home .content-area').css('box-shadow','0px -30px 20px 0px rgba(0,0,0,.04)');
			} else {
				heroSlider.css('display', 'block');
				blackBg.css('display', 'block');

				heroSlider.css({opacity: .99});
				$('.home .content-area').css('box-shadow','none');
			}
		}, 200);
	};

	var body = $('body');

	var	wScrollTop = 0;

	if (body.hasClass('single-post')) {

		var siteMainHeight = 0,
			mainContentMarginTop = 0,
			entryHeaderHeight = 0,
			featuredContentHeight = 0,
			entryContentMarginTop = 0,
			relatedPostsHeight = 0;

		var singleFixedContent = $('.single .posts-navigation > div, .single .meta-author'),
			singlePostNavigation = 0,
			singleFixedContentHeight = -1;
	}

	var singleFixCalculate = function () {

		if (body.hasClass('single-post')) {

			singleFixedContent.each(function() {
				singleFixedContentHeight = Math.max(singleFixedContentHeight, $(this).outerHeight(true));
			});
			singleFixedContentHeight = parseInt(singleFixedContentHeight, 10);
			$('.entry-content').css('min-height', singleFixedContentHeight);

			singlePostNavigation = $('.single .posts-navigation > div').outerHeight(true);


			siteMainHeight = parseInt( $('.site-main').outerHeight(true), 10);

			mainContentMarginTop = parseInt( $('#content').css('margin-top'), 10);

			if ($('article .entry-header').length) {
				entryHeaderHeight = parseInt( $('article .entry-header').outerHeight(true), 10);
			}
			if ($('article .featured-content').length) {
				featuredContentHeight = parseInt( $('article .featured-content').outerHeight(true), 10);
			}
			if ($('#jp-relatedposts').length) {
				relatedPostsHeight = parseInt( $('#jp-relatedposts').outerHeight(false), 10);
			}

			entryContentMarginTop = parseInt( $('.entry-content').css('margin-top') ,10);

		}
	}

	viewport();
	var w=window,d=document,
	e=d.documentElement,
	g=d.getElementsByTagName('body')[0],
	x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
	y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

	var singleFixContent = function () {
		// on single post fix post-navigation and meta author box on top of page
		if (body.hasClass('single-post')) {

			var scrollSpacer = mainContentMarginTop + entryHeaderHeight + featuredContentHeight;

			wScrollTop = $(window).scrollTop();


			if ( (wScrollTop >= scrollSpacer) && (wScrollTop <= mainContentMarginTop + siteMainHeight - singleFixedContentHeight) ) {

				singleFixedContent.addClass('fixed').css('top', '0');

			} else if (wScrollTop >= mainContentMarginTop + siteMainHeight - singleFixedContentHeight) {

				singleFixedContent.removeClass('fixed').css('top', siteMainHeight - entryHeaderHeight - featuredContentHeight - singleFixedContentHeight);

				if ($('#jp-relatedposts').length) {
					relatedPostsHeight = parseInt( $('#jp-relatedposts').outerHeight(false), 10);
				}

				if (relatedPostsHeight !== 0) {
					if (wScrollTop <= mainContentMarginTop + siteMainHeight + relatedPostsHeight - singlePostNavigation) {
						$('.single .posts-navigation > div').addClass('fixed').css('top', '0');
					} else {
						$('.single .posts-navigation > div').css('top', siteMainHeight + relatedPostsHeight - entryHeaderHeight - featuredContentHeight - singlePostNavigation);
					}
				}

			} else {

				singleFixedContent.removeClass('fixed').css('top', '0');
			}
		};
	};

	var singleUnfixContent = function () {
		if (singleFixedContent) {
			singleFixedContent.removeClass('fixed').css('top', '0');
		}
	}

	// if main navigation is too wide for height of viewport turn it into hamburger
	var hamburger = function () {

		viewport();
		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		if (x > 1200) {
			var navUl = $('.main-navigation-center .nav-menu, .main-navigation-center .menu');
			var navFirstLevelLi = $('.main-navigation-center .nav-menu > li, .main-navigation-center .menu > li');
			var navUlWidth = 0,
				navLiWidth = 0;
			var siteNavigation = $('#site-navigation');

			navUlWidth = navUl.width() - 40;
			navFirstLevelLi.each(function() {
				navLiWidth += $(this).outerWidth(true);
			});

			if( (navUlWidth < navLiWidth) ){
				body.addClass("hamburger-menu");

				var secondLevelNavigation = $('.main-navigation .nav-menu > li > ul, .main-navigation .menu > li > ul');

				secondLevelNavigation.each(function(){
					$(this).css({'padding-top': 0});
				});
			}
			else{
				body.removeClass("hamburger-menu");

				// expand .primary-side when hovered on main nav items with children

				var primarySide = $('.primary-side');
				var sideWidth = 55,
					navExpandAmount = 210;

				$('.main-navigation .menu>li.menu-item-has-children, .main-navigation .menu>li.page-item-has-children, .main-navigation .menu>li.menu_item_has_children, .main-navigation .menu>li.page_item_has_children').hover(function () {

						if ( !primarySide.hasClass('first-lvl-open')) {
							primarySide.addClass('first-lvl-open');
						}

					}, function () {
						if ( primarySide.hasClass('first-lvl-open')) {
							primarySide.removeClass('first-lvl-open');
						}
				});

				// calculate padding top of second level navigation
				var secondLevelNavigation = $('.main-navigation .nav-menu > li > ul, .main-navigation .menu > li > ul');

				secondLevelNavigation.each(function(){
					var secondLevelNavigationPaddingTop = (navUlWidth - $(this).height()) / 2;
					$(this).css({'padding-top': secondLevelNavigationPaddingTop});
				});
			};
		} else {
			body.addClass("hamburger-menu");
		}
	};

	$(document).ready(function($){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body'),
			mainContent = $('#content'),
			toTopArrow = $('a.back-to-top');


		// Outline none on mousedown for focused elements

		body.on('mousedown', '*', function(e) {
			if(($(this).is(':focus') || $(this).is(e.target)) && $(this).css('outline-style') == 'none') {
				$(this).css('outline', 'none').on('blur', function() {
					$(this).off('blur').css('outline', '');
				});
			}
		});

		// Disable search submit if input empty
		$( '.search-submit' ).prop( 'disabled', true );
		$( '.search-field' ).keyup( function() {
			$('.search-submit').prop( 'disabled', this.value === "" ? true : false );
		});

		// Dropcaps

		if(body.hasClass('single') || body.hasClass('page')){

			var dropcap = $('span.dropcap');
			if(dropcap.length){
				dropcap.each(function(){
					var $this = $(this);
					$this.attr('data-dropcap', $this.text());
					$this.parent().css({
						"position" : "relative",
						"z-index" : 0
					});
				});
			}
		};

		// dropdown button

		var menuDropdownLink = $('.main-navigation .menu-item-has-children>a, .main-navigation .page_item_has_children>a');

		var dropDownArrow = $('<button class="dropdown-toggle"><span class="screen-reader-text">toggle child menu</span><span class="h-line"></span><span class="v-line"></span></button>');

		menuDropdownLink.after(dropDownArrow);


		// dropdown open on click

		var dropDownButton = $('button.dropdown-toggle');

		dropDownButton.on('click', function(e){
			e.preventDefault();
			var $this = $(this);
			$this.parent('li').toggleClass('toggle-on').find('.toggle-on').removeClass('toggle-on');
			$this.parent('li').siblings().removeClass('toggle-on');
		});

		$('.main-navigation .menu').on('mouseleave', function () {
			$(this).find('.toggle-on').removeClass('toggle-on');
		})

		// Forms

		var smallInput = $('.contact-form input[type="text"], .contact-form input[type="email"], .contact-form input[type="url"], .comment-form input[type="text"], .comment-form input[type="email"], .comment-form input[type="url"]');
		smallInput.parent().addClass('small-input');


		// Slider

		var featuredSlider;
		var direction;

		if(body.hasClass('rtl')){
			direction = true;
		}
		else{
			direction = false;
		}

		featuredSlider = $('.featured-slider');

		featuredSlider.slick({
			slide: 'article',
			infinite: true,
			fade: true,
			dots: true,
			arrows: false,
			speed: 500,
			centerMode: false,
			draggable: true,
			touchThreshold: 20,
			slidesToShow: 1,
			cssEase: 'cubic-bezier(0.28, 0.12, 0.22, 1)',
			rtl: direction
		});

		// show slider after init
		setTimeout(function(){
			featuredSlider.css({opacity: 1});
		}, 1000);

		// put img to parents background
		var slides = $('.last-post article, .featured-slider article');

		slides.each(function(){
			var featuredImg = $(this).find('img');
			if(featuredImg.length){
				var slideImgSrc = featuredImg.attr('src');
				featuredImg.css('display','none').wrap('<div class="image"></div>');
				$(this).find('.image').css({backgroundImage: 'url('+slideImgSrc+')'});
			}
		});


		// On Infinite Scroll Load

		var $container = $('.masonry');


		$(document.body).on('post-load', function(){
			// Reactivate masonry on post load
			var newEl = $container.children().not('article.post-loaded, .lines, span.infinite-loader, div.grid-sizer').addClass('post-loaded');

			newEl.hide();
			newEl.imagesLoaded(function () {

			// Reactivate masonry on post load

			$container.masonry('appended', newEl, true).masonry('layout');

			setTimeout(function(){
				newEl.each(function(i){
					var $this = $(this);

					if($this.find('iframe').length){
						var $iframe = $this.find('iframe');
						var $iframeSrc = $iframe.attr('src');

						$iframe.load($iframeSrc, function(){
							$container.masonry('layout');
						});
					}

					setTimeout(function(){
						newEl.eq(i).addClass('animate');
					}, 100 * (i+1));

					setTimeout(function(){
						$('#infinite-handle').addClass('animate');
					}, 100);
				});
			}, 150);

			// Checkbox and Radio buttons

			radio_checkbox_animation();

			});
		});

		// Checkbox and Radio buttons

		//if buttons are inside label
		function radio_checkbox_animation() {
			var checkBtn = $('label').find('input[type="checkbox"]');
			var checkLabel = checkBtn.parent('label');
			var radioBtn = $('label').find('input[type="radio"]');

			checkLabel.addClass('checkbox');

			checkLabel.click(function(){
				var $this = $(this);
				if($this.find('input').is(':checked')){
					$this.addClass('checked');
				}
				else{
					$this.removeClass('checked');
				}
			});

			var checkBtnAfter = $('label + input[type="checkbox"]');
			var checkLabelBefore = checkBtnAfter.prev('label');

			checkLabelBefore.click(function(){
				var $this = $(this);
				$this.toggleClass('checked');
			});

			var checkLabelAfter = $('input[type="checkbox"] + label');

			checkLabelAfter.click(function(){
				var $this = $(this);
				$this.toggleClass('checked');
			});

			radioBtn.change(function(){
				var $this = $(this);
				if($this.is(':checked')){
					$this.parent('label').siblings().removeClass('checked');
					$this.parent('label').addClass('checked');
				}
				else{
					$this.parent('label').removeClass('checked');
				}
			});
		}

		radio_checkbox_animation();

		// Sharedaddy

		function shareDaddy(){
			var shareTitle = $('.sd-sharing .sd-title');

			if(shareTitle.length){
				var shareWrap = shareTitle.closest('.sd-sharing-enabled');
				shareWrap.attr({'tabindex': '0'});
				shareTitle.on('click touchend', function(){
					$(this).closest('.sd-sharing-enabled').toggleClass('sd-open');
				});

				$(document).keyup(function(e) {
					if(shareWrap.find('a').is(':focus') && e.keyCode == 9){
						shareWrap.addClass('sd-open');
					}
					else if(!(shareWrap.find('a').is(':focus')) && e.keyCode == 9){
						shareWrap.removeClass('sd-open');
					}
				});
			}
		}

		shareDaddy();

		// Big search field

		var bigSearchWrap = $('div.search-wrap');
		var bigSearchButtons = $('div.search-button');
		var bigSearchField = bigSearchWrap.find('.search-field');
		var bigSearchTrigger = $('.big-search-trigger');
		var bigSearchCloseBtn = $('.big-search-close');
		var delayBigSearch = false;

		// close sidemenu modal on ESC

		var toggleBigSearch = function() {
			if(delayBigSearch) return;  // check if last action complete

			delayBigSearch = true;
			setTimeout(function(){delayBigSearch = false},500);

			if(body.hasClass('big-search-open')){
				body.removeClass('big-search-open');
				setTimeout(function(){
					$('.search-wrap').find('.search-field').blur();
				}, 50);
			} else {
				body.addClass('big-search-open');
				setTimeout(function(){
					$('.search-wrap').find('.search-field').focus();
				}, 200);
			};
		}


		bigSearchCloseBtn.on('touchend click', function(e){
			e.preventDefault();
			toggleBigSearch();
		});

		bigSearchTrigger.on('touchend click', function(e){
			e.preventDefault();
			e.stopPropagation();
			toggleBigSearch();
			if (x < 1200) {
				$('html, body').delay(100).animate({scrollTop: 0}, 200);
			}
		});

		bigSearchField.on('touchend click', function(e){
			e.stopPropagation();
		});

		$().on('touchend click', function(e){
			e.stopPropagation();
		});

		// open / close sidebar

		var sidebarToggle = $('.sidebar-toggle');
		var delaySidebar = false;

		var toggleSidebar = function() {
			if(delaySidebar) return;  // check if last action complete

			delaySidebar = true;
			setTimeout(function(){delaySidebar = false},500);


			if(body.hasClass('sidebar-open')){
				body.removeClass('sidebar-open');
			} else {
				body.addClass('sidebar-open');
			};
		}

		sidebarToggle.on('touchend click', function(e) {
			e.preventDefault();
			toggleSidebar();
		});

		$('.black-overlay').on('touchend click', function() {
			if (body.hasClass('sidebar-open')) {
				toggleSidebar();
			}
		});

		// close sidemenu modal on ESC

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				if (body.hasClass('big-search-open')) {
				toggleBigSearch();
				}
				if (body.hasClass('sidebar-open')) {
				toggleSidebar();
				}
				if ($('#site-navigation').hasClass('toggled')) {
					$('#site-navigation').removeClass('toggled');
					$('.menu-toggle, #site-navigation ul').setAttribute( 'aria-expanded', 'false' );
				}
			}
		});

		// Disable scroll if big search sidemenu is open

		// left: 37, up: 38, right: 39, down: 40,
		// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
		var keys = {37: 1, 38: 1, 39: 1, 40: 1, 32: 1, 33: 1, 34: 1, 35: 1, 36: 1};

		var preventDefault = function (e) {
			e = e || window.event;
				if (e.preventDefault)
					e.preventDefault();
				e.returnValue = false;
		};

		var preventDefaultForScrollKeys = function (e) {
			if (keys[e.keyCode]) {
				preventDefault(e);
				return false;
			}
		};


		if (body.hasClass('single')) {

			var $featuredImage = $('.featured-image');
			if ($featuredImage.length) {
				var imgAspect = $featuredImage.find('img').get(0).naturalWidth / $featuredImage.find('img').get(0).naturalHeight;
				if ( imgAspect <= 1 ) {
					$featuredImage.addClass('vertical-img');
				}
			}
		};

		hamburger();

	}); // End Document Ready

	$(window).load(function(){

		// Calculate clients viewport
		function viewport() {
			var e = window, a = 'inner';
			if(!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
		}

		var w=window,d=document,
		e=d.documentElement,
		g=d.getElementsByTagName('body')[0],
		x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body');

		// Masonry call

		var $container = $('.masonry');

		$container.imagesLoaded( function() {
			$container.masonry({
				columnWidth: '.grid-sizer',
				//stamp: '.sticky',
				itemSelector: '.masonry article',
				transitionDuration: 0
			}).masonry('layout');

			var masonryChild = $container.find('article.hentry , .lines , #infinite-handle');

			masonryChild.each(function(i){
				setTimeout(function(){
					masonryChild.eq(i).addClass('post-loaded animate');
				}, 100 * (i+1));
			});

			var masonryArticles = $container.find('article.hentry'),
				numberOfMasonryArticles = masonryArticles.length;

			if ( numberOfMasonryArticles < 5 ) {
				$('.lines span').filter(function( index ) {
					return index > numberOfMasonryArticles - 1;
				}).css( "display", "none" );
			}

		});

		// Preloader - show content

		var preload = function() {

			$('body').addClass('show');
		};

		preload();

		centerAlignedImages();

		if (x > 1200) {
			setTimeout(function(){
				singleFixCalculate();
				singleFixContent();
			}, 50)
		} else {
			singleUnfixContent();
		}

		if (pageHasHeroSlider && x > 1200) {
			heroSliderHide();
		}

		if (body.hasClass('fixed-site-header')) {
			wScrollTop = $(window).scrollTop();
			if (wScrollTop > y) {
				$('.site-header').addClass('compact');
			} else {
				$('.site-header').removeClass('compact');
			};
		}

	}); // End Window Load

	$(window).resize(function(){

		x=w.innerWidth||e.clientWidth||g.clientWidth; // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var body = $('body');
		centerAlignedImages();

		if (x > 1200) {
			singleFixCalculate();
			singleFixContent();
		} else {
			singleUnfixContent();
		}

		hamburger();

	});

	// Scroll event


	if (body.hasClass('single') ) {
		$(window).scroll(function(){
			if (x > 1200) {
				singleFixContent();
			} else {
				singleUnfixContent();
			}
		});
	};

	if (x > 1200) {
		$(window).scroll(function(){
			// drop opacity on home hero slider
			if (pageHasHeroSlider) {
				heroSliderHide();
			}
		});
	}
	$(window).scroll(function(){
		if (body.hasClass('fixed-site-header')) {
			wScrollTop = $(window).scrollTop();
			if (wScrollTop > y) {
				$('.site-header').addClass('compact');
			} else {
				$('.site-header').removeClass('compact');
			};
		}
	});

	// window unload

	$(window).on('beforeunload', function () {

		/*
		var body = $('body');

		body.removeClass('show');

		setTimeout(function() {
			return true;
		}, 150)
		*/

	});

})(jQuery);
