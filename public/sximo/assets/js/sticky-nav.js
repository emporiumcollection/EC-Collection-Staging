/**
 * @author SE Manu Mahesh
 * @date 09 Dec 2016
 */

$(document).ready(function () {


    $(window).scroll(function (event) {
        if ($(window).width() > 767) {
            var scroll = $(window).scrollTop();

            if (scroll > 188 && $("body .header").css('marginTop') != '-188px') {
                $("body .header").stop().animate({
                    marginTop: "-188px"
                }, 1, function () {
                    $("body").addClass("sticky-nav");
                });
            }

            if (scroll < 188 && $("body .header").css('marginTop') != '0px') {
                $("body .header").stop().animate({
                    marginTop: "0px"
                }, 1, function () {
                    $("body").removeClass("sticky-nav");
                });
            }
        }
    });

});