"use strict";
var lastScroll = 0;

function isIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
    {
        return true;
    } else  // If another browser, return 0
    {
        return false;
    }
}


$(window).on("scroll", init_scroll_navigate);
function init_scroll_navigate() {
    /*==============================================================
    One Page Main JS - START CODE
    =============================================================*/
    var menu_links = $(".navbar-nav li a");
    var scrollPos = $(document).scrollTop();
    menu_links.each(function () {
        var currLink = $(this);
        if (currLink.attr("href").indexOf("#") > -1 && $(currLink.attr("href")).length > 0) {
            var refElement = $(currLink.attr("href"));
            if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                menu_links.removeClass("active");
                currLink.addClass("active");
            } else {
                currLink.removeClass("active");
            }
        }
    });
    /*==============================================================
    One Page Main JS - END CODE
    =============================================================*/

}

/*==============================================================
parallax text - START CODE
==============================================================*/
function parallax_text() {
    var window_width = $(window).width();
    if (window_width > 1024) {
        if ($('.swiper-auto-width .swiper-slide').length !== 0) {
            $(document).on("mousemove", ".swiper-auto-width .swiper-slide", function (e) {
                var positionX = e.clientX;
                var positionY = e.clientY;
                positionX = Math.round(positionX / 10) - 80;
                positionY = Math.round(positionY / 10) - 40;
                $(this).find('.parallax-text').css({ 'transform': 'translate(' + positionX + 'px,' + positionY + 'px)', 'transition-duration': '0s' });
            });

            $(document).on("mouseout", ".swiper-auto-width .swiper-slide", function (e) {
                $('.parallax-text').css({ 'transform': 'translate(0,0)', 'transition-duration': '0.5s' });
            });
        }
    }
}
/*==============================================================*/
//parallax text - END CODE
/*==============================================================*/

/*==============================================================*/
//Search - START CODE
/*==============================================================*/
function ScrollStop() {
    return false;
}
function ScrollStart() {
    return true;
}

/* ===================================
START READY
====================================== */
$(document).ready(function () {
    "use strict";

    /* ===================================
    swiper slider
    ====================================== */



    //swiper resize for IE
    

    $(window).resize(function () {
        setTimeout(function () {
            if ($(".swiper-full-screen").length > 0)
                swiperFull.onResize()
            if ($(".swiper-auto-fade").length > 0)
                swiperAutoFade.onResize()
            if ($(".swiper-number-pagination").length > 0)
                swiperNumber.onResize()
            if ($(".swiper-slider-clients").length > 0)
                swiperClients.onResize()
            if ($(".swiper-slider-second").length > 0)
                swiperSecond.onResize()
            if ($(".swiper-slider-third").length > 0)
                swiperThird.onResize()
            if ($(".swiper-three-slides").length > 0)
                swiperThreeSlides.onResize()
            if ($(".swiper-four-slides").length > 0)
                swiperFourSlides.onResize()
            if ($(".swiper-vertical-pagination").length > 0)
                swiperVerticalPagination.onResize()
            if ($(".swiper-auto-height-container").length > 0)
                swiperAutoHieght.onResize()
            if ($(".swiper-multy-row-container").length > 0)
                swiperMultyRow.onResize()
            if ($(".swiper-blog").length > 0)
                swiperBlog.onResize()
            if ($(".swiper-swiperPresentation").length > 0)
                swiperPresentation.onResize()
            if ($(".swiper-demo-header-style").length > 0)
                swiperDemoHeaderStyle.onResize()
        }, 500);

        setTimeout(function () {
            //destroy swiper
            var window_width = $(window).width();
            if (window_width < 768) {
                if ($(".swiper-bottom-scrollbar-full").length > 0) {
                    if (swiperMultipurpose) {
                        swiperMultipurpose.detachEvents();
                        swiperMultipurpose.destroy(true, true);
                        swiperMultipurpose = undefined;
                    }

                    swiperMultipurpose = new Swiper('.swiper-bottom-scrollbar-full', {
                        scrollbar: '.swiper-scrollbar',
                        scrollbarHide: false,
                        scrollbarDraggable: true,
                        slidesPerView: 'auto',
                        scrollbarSnapOnRelease: true,
                        grabCursor: true,
                        preventClicks: false,
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev',
                        mousewheelControl: true,
                        spaceBetween: 30,
                        keyboardControl: true,
                        speed: 1000,
                        breakpoints: {
                            767: {
                                direction: 'vertical',
                                //slidesPerView: 1,
                                scrollbarHide: true,
                                spaceBetween: 0,
                                pagination: false,
                                autoHeight: true
                            }
                        }
                    });
                }
            } else {
                if ($(".swiper-bottom-scrollbar-full").length > 0) {
                    if (swiperMultipurpose) {
                        swiperMultipurpose.detachEvents();
                        swiperMultipurpose.destroy(true, true);
                        swiperMultipurpose = undefined;
                    }
                    swiperMultipurpose = new Swiper('.swiper-bottom-scrollbar-full', {
                        scrollbar: '.swiper-scrollbar',
                        scrollbarHide: false,
                        scrollbarDraggable: true,
                        slidesPerView: 'auto',
                        scrollbarSnapOnRelease: true,
                        grabCursor: true,
                        preventClicks: false,
                        nextButton: '.swiper-button-next',
                        prevButton: '.swiper-button-prev',
                        mousewheelControl: true,
                        spaceBetween: 30,
                        keyboardControl: true,
                        speed: 1000
                    });
                }
            }
        }, 500);

        if ($(".swiper-auto-width").length > 0 && swiperAutoSlide) {
            swiperAutoSlide.detachEvents();
            swiperAutoSlide.destroy(true);
            swiperAutoSlide = undefined;
            $(".swiper-auto-width .swiper-wrapper").css("transform", "").css("transition-duration", "");
            $(".swiper-auto-width .swiper-slide").css("margin-right", "");

            setTimeout(function () {
                swiperAutoSlide = new Swiper('.swiper-auto-width', {
                    scrollbar: '.swiper-scrollbar',
                    scrollbarHide: false,
                    scrollbarDraggable: true,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: 80,
                    preventClicks: false,
                    scrollbarSnapOnRelease: true,
                    nextButton: '.swiper-next-style2',
                    prevButton: '.swiper-prev-style2',
                    mousewheelControl: true,
                    speed: 1000,
                    keyboardControl: true,
                    breakpoints: {
                        1199: {
                            spaceBetween: 60
                        },
                        960: {
                            spaceBetween: 30
                        },
                        767: {
                            spaceBetween: 15
                        }
                    },
                    onSlideChangeEnd: function (swiper) {
                        swiperAutoSlideIndex = swiper.activeIndex;
                    }
                });

                swiperAutoSlide.slideTo(swiperAutoSlideIndex, 1000, false);
            }, 1000);
        }
    });

    /*==============================================================
    smooth scroll
    ==============================================================*/



   

    // Inner links
    


    /*==============================================================
    portfolio filter
    ==============================================================*/
    var $portfolio_filter = $('.portfolio-grid');
    $portfolio_filter.imagesLoaded(function () {
        $portfolio_filter.isotope({
            layoutMode: 'masonry',
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
        $portfolio_filter.isotope();
    });
   

    /*==============================================================
    lightbox gallery
    ==============================================================*/


    /*==============================================================
    wow animation - on scroll
    ==============================================================*/
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true
    });
    $(window).imagesLoaded(function () {
        wow.init();
    });
    /*==============================================================
    counter
    ==============================================================*/



    /*==============================================================*/
    //revolution Start 
    /*==============================================================*/
    /* ================================
    home-creative-studio
    ================================*/
    if ($("#rev_slider_151_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_151_1");
    } else {
        $("#rev_slider_151_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "revolution/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "vertical",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "uranus",
                    enable: true,
                    hide_onmobile: false,
                    hide_over: 479,
                    hide_onleave: false,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 0,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 0,
                        v_offset: 0
                    }
                }
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            lazyType: "none",
            scrolleffect: {
                blur: "on",
                maxblur: "20",
                on_slidebg: "on",
                direction: "top",
                multiplicator: "2",
                multiplicator_layers: "2",
                tilt: "10",
                disable_on_mobile: "off"
            },
            parallax: {
                type: "scroll",
                origo: "slidercenter",
                speed: 400,
                levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55]
            },
            shadow: 0,
            spinner: "spinner3",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            fullScreenAutoWidth: "off",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "0px",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false
            }
        });
    }
    /* ================================
    home-classic-web-agency
    ================================*/
    if ($("#rev_slider_1174_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1174_1");
    } else {
        $("#rev_slider_1174_1").show().revolution({
            sliderType: "hero",
            jsFileLocation: "revolution/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            lazyType: "none",
            parallax: {
                type: "scroll",
                origo: "slidercenter",
                speed: 400,
                levels: [10, 15, 20, 25, 30, 35, 40, -10, -15, -20, -25, -30, -35, -40, -45, 55]
            },
            shadow: 0,
            spinner: "off",
            autoHeight: "off",
            fullScreenAutoWidth: "off",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            disableProgressBar: "on",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                disableFocusListener: false
            }
        });
    }

    /* ================================
    home-classic-corporate
    ================================*/
    if ($("#rev_slider_1078_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1078_1");
    } else {
        $("#rev_slider_1078_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "revolution/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "on",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                }
                ,
                arrows: {
                    style: "zeus",
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 600,
                    hide_onleave: true,
                    hide_delay: 200,
                    hide_delay_mobile: 1200,
                    tmp: '<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 30,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 30,
                        v_offset: 0
                    }
                }
                ,
                bullets: {
                    enable: true,
                    hide_onmobile: false,
                    hide_under: 300,
                    style: "hermes",
                    hide_onleave: false,
                    hide_delay: 200,
                    hide_delay_mobile: 1200,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 30,
                    space: 8,
                    tmp: '<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
                }
            },
            viewPort: {
                enable: true,
                outof: "pause",
                visible_area: "80%",
                presize: false
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [600, 600, 500, 400],
            lazyType: "none",
            parallax: {
                type: "mouse",
                origo: "slidercenter",
                speed: 2000,
                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 46, 47, 48, 49, 50, 55]
            },
            shadow: 0,
            spinner: "off",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false
            }
        });
    }
    /*==============================================================*/
    //revolution End 
    /*==============================================================*/

});
/* ===================================
END READY
====================================== */


/* ===================================
START Page Load
====================================== */

/* ===================================
END Page Load
====================================== */