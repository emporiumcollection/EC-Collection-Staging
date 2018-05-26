"use strict";
var lastScroll = 0;

//check for browser os
var isMobile = false;
var isiPhoneiPad = false;
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    isMobile = true;
}

if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    isiPhoneiPad = true;
}

function SetMegamenuPosition() {
    if ($(window).width() > 991) {
        setTimeout(function () {
            var totalHeight = $('nav.navbar').outerHeight();
            $('.mega-menu').css({ top: totalHeight });
            if ($('.navbar-brand-top').length === 0)
                $('.dropdown.simple-dropdown > .dropdown-menu').css({ top: totalHeight });
        }, 200);
    } else {
        $('.mega-menu').css('top', '');
        $('.dropdown.simple-dropdown > .dropdown-menu').css('top', '');
    }
}

function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
}

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

//swiper button position in auto height slider
function setButtonPosition() {
    if ($(window).width() > 767 && $(".swiper-auto-height-container").length > 0) {
        var leftPosition = parseInt($('.swiper-auto-height-container .swiper-slide').css('padding-left'));
        var bottomPosition = parseInt($('.swiper-auto-height-container .swiper-slide').css('padding-bottom'));
        var bannerWidth = parseInt($('.swiper-auto-height-container .slide-banner').outerWidth());
        $('.navigation-area').css({ 'left': bannerWidth + leftPosition + 'px', 'bottom': bottomPosition + 'px' });
    } else if ($(".swiper-auto-height-container").length > 0) {
        $('.navigation-area').css({ 'left': '', 'bottom': '' });
    }
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

/* ===================================
START READY
====================================== */
$(document).ready(function () {
    "use strict";
    
    // Active class to current menu for only html
    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    var $hash = window.location.hash.substring(1);

    if ($hash) {
        $hash = "#" + $hash;
        pgurl = pgurl.replace($hash, "");
    } else {
        pgurl = pgurl.replace("#", "");
    }
    /* ===================================
    swiper slider
    ====================================== */
    var swiperFull = new Swiper('.swiper-full-screen', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        autoplay: 5000,
        slidesPerView: 1,
        keyboardControl: true,
        preventClicks: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    var swiperAutoFade = new Swiper('.swiper-auto-fade', {
        pagination: '.swiper-pagination',
        loop: true,
        autoplay: 5000,
        slidesPerView: 1,
        paginationClickable: true,
        keyboardControl: true,
        preventClicks: false,
        effect: 'fade',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    var swiperSecond = new Swiper('.swiper-slider-second', {
        pagination: '.swiper-pagination-second',
        slidesPerView: 1,
        paginationClickable: true,
        keyboardControl: true,
        preventClicks: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    var swiperThird = new Swiper('.swiper-slider-third', {
        pagination: '.swiper-pagination-third',
        slidesPerView: 1,
        paginationClickable: true,
        keyboardControl: true,
        preventClicks: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    var swiperNumber = new Swiper('.swiper-number-pagination', {
        pagination: '.swiper-number',
        paginationClickable: true,
        autoplay: 4000,
        preventClicks: false,
        autoplayDisableOnInteraction: false,
        paginationBulletRender: function (swiper, index, className) {
            return '<span class="' + className + '">' + pad((index + 1)) + '</span>';
        }
    });

    var swiperVerticalPagination = new Swiper('.swiper-vertical-pagination', {
        pagination: '.swiper-pagination-white',
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        preventClicks: false,
        mousewheelControl: true
    });

    var swiperClients = new Swiper('.swiper-slider-clients', {
        pagination: null,
        slidesPerView: 4,
        paginationClickable: true,
        autoplay: 3000,
        preventClicks: false,
        autoplayDisableOnInteraction: false,
        breakpoints: {
            480: {
                slidesPerView: 1
            },
            650: {
                slidesPerView: 2
            },
            850: {
                slidesPerView: 3
            }
        }
    });

    var swiperThreeSlides = new Swiper('.swiper-three-slides', {
        pagination: '.swiper-pagination-three-slides',
        paginationClickable: true,
        slidesPerView: 3,
        keyboardControl: true,
        mousewheelControl: false,
        preventClicks: false,
        nextButton: '.second-swiper-button-next',
        prevButton: '.second-swiper-button-prev',
        breakpoints: {
            480: {
                slidesPerView: 1
            },
            767: {
                slidesPerView: 2
            },
            850: {
                slidesPerView: 2
            }
        }
    });

    var swiperFourSlides = new Swiper('.swiper-four-slides', {
        pagination: '.swiper-pagination-four-slides',
        autoplay: 3000,
        slidesPerView: 4,
        paginationClickable: true,
        keyboardControl: true,
        mousewheelControl: false,
        preventClicks: false,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        breakpoints: {
            850: {
                slidesPerView: 2
            },
            650: {
                slidesPerView: 2
            },
            480: {
                slidesPerView: 1
            }
        }
    });

    var swiperDemoHeaderStyle = new Swiper('.swiper-demo-header-style', {
        pagination: '.swiper-pagination-demo-header-style',
        loop: true,
        autoplay: 3000,
        slidesPerView: 4,
        paginationClickable: true,
        keyboardControl: true,
        mousewheelControl: false,
        preventClicks: true,
        slidesPerGroup: 4,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        breakpoints: {
            1199: {
                slidesPerGroup: 2,
                slidesPerView: 2
            },
            767: {
                slidesPerGroup: 1,
                slidesPerView: 1
            }
        }
    });

    var swiperAutoSlideIndex = 0;
    var swiperAutoSlide = new Swiper('.swiper-auto-width', {
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

    var swiperMultipurpose = new Swiper('.swiper-bottom-scrollbar-full', {
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

    var swiperAutoHieght = new Swiper('.swiper-auto-height-container', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        effect: 'fade',
        loop: true,
        preventClicks: false,
        autoHeight: true
    });

    var swiperMultyRow = new Swiper('.swiper-multy-row-container', {
        nextButton: '.swiper-portfolio-next',
        prevButton: '.swiper-portfolio-prev',
        slidesPerView: 4,
        spaceBetween: 15,
        scrollbarSnapOnRelease: true,
        autoplay: 3000,
        autoplayDisableOnInteraction: true,
        breakpoints: {
            991: {
                slidesPerView: 2
            },
            767: {
                slidesPerView: 1
            }
        }
    });

    var swiperBlog = new Swiper('.swiper-blog', {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 15,
        scrollbarSnapOnRelease: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: true,
        preventClicks: false,
        loop: true,
        loopedSlides: 3
    });

    var swiperPresentation = new Swiper('.swiper-presentation', {
        slidesPerView: 4,
        centeredSlides: true,
        spaceBetween: 30,
        scrollbarSnapOnRelease: true,
        autoplay: 3000,
        autoplayDisableOnInteraction: true,
        preventClicks: true,
        loop: true,
        loopedSlides: 6,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        breakpoints: {
            991: {
                spaceBetween: 15,
                slidesPerView: 2
            },
            767: {
                slidesPerView: 1
            }
        }
    });

    //swiper resize for IE
    if (isIE()) {
        setTimeout(function () {
            $(document).imagesLoaded(function () {
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
            });
        }, 300);
    }

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

    var scrollAnimationTime = 1200, scrollAnimation = 'easeInOutExpo';
    $(document).on('click.smoothscroll', 'a.scrollto', function (event) {
        event.preventDefault();
        var target = this.hash;
        if ($(target).length != 0) {
            $('html, body').stop()
                    .animate({
                        'scrollTop': $(target)
                                .offset()
                                .top
                    }, scrollAnimationTime, scrollAnimation, function () {
                        window.location.hash = target;
                    });
        }
    });

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


    SetResizeContent();

    var $allNonRatinaImages = $("img:not([data-at2x])");
    $allNonRatinaImages.attr('data-no-retina', '');

    /*==============================================================*/
    //demo button  - START CODE
    /*==============================================================*/

//    var $buythemediv = '<div class="buy-theme alt-font sm-display-none"><a href="https://themeforest.net/item/pofo-creative-agency-corporate-and-portfolio-multipurpose-template/20645944?ref=themezaa" target="_blank"><i class="ti-shopping-cart"></i><span>Buy Theme</span></a></div><div class="all-demo alt-font sm-display-none"><a href="mailto:info@themezaa.com?subject=POFO – Creative Agency, Corporate and Portfolio Multi-purpose Template - Quick Question"><i class="ti-email"></i><span>Quick Question?</span></a></div>';
//    $('body').append($buythemediv);

    /*==============================================================*/
    //demo button  - END CODE
    /*==============================================================*/

});
/* ===================================
END READY
====================================== */


/* ===================================
START Page Load
====================================== */
$(window).load(function () {
    var hash = window.location.hash.substr(1);
    if (hash != "") {
        setTimeout(function () {
            $(window).imagesLoaded(function () {
                var scrollAnimationTime = 1200,
                        scrollAnimation = 'easeInOutExpo';
                var target = '#' + hash;
                if ($(target).length > 0) {

                    $('html, body').stop()
                            .animate({
                                'scrollTop': $(target).offset().top
                            }, scrollAnimationTime, scrollAnimation, function () {
                                window.location.hash = target;
                            });
                }
            });
        }, 500);
    }
});
/* ===================================
END Page Load
====================================== */