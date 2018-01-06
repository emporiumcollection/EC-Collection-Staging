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


});
/* ===================================
END READY
====================================== */