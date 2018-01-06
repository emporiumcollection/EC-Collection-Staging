/**
 * @author SE Manu Mahesh
 * @date 21 Dec 2016
 */

$(document).ready(function () {
    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();

        if (scroll > 694 && $("body .header").css('marginTop') != '-694px') {
            $("body .header").stop().animate({
                marginTop: "-694px"
            }, 1, function () {
                $("body").addClass("sticky-nav");
            });
        }

        if (scroll < 694 && $("body .header").css('marginTop') != '0px') {
            $("body .header").stop().animate({
                marginTop: "0px"
            }, 1, function () {
                $("body").removeClass("sticky-nav");
            });
        }

    });
});