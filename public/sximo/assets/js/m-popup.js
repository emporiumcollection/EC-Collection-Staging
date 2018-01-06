/**
 * @author SE Manu Mahesh
 * @date 09 Dec 2016
 */

$(document).ready(function () {
    $(".video-popup-btn").on("click", function (event) {
        event.preventDefault();
        var popup_id = $(this).data("popup-id");
        $("#" + popup_id).animate({
            width: "100%"
        }, 800, function () {});
        $("body").addClass("fixed");
    });
    $(".popup-close-btn").click(function (event) {
        event.preventDefault();
        $(this).parent().parent().animate({
            width: "0px"
        }, 800, function () {});
        $("body").removeClass("fixed");
    });

    $("#video-popup .previous-round-btn").click(function (event) {
        event.preventDefault();

        var index = $(".featured-vieos > li.active").data("index");
        if (index == 0) {
            index = +$(".featured-vieos > li:last-child").data("index") + 1;
        }

        $(".featured-vieos > li.active").removeClass("active");
        $(".featured-vieos > li:nth-child(" + index + ")").addClass("active");
        
        $(this).parent().find(".videos-count").html( index + " / " + $(this).parent().find(".featured-vieos > li").length);
        
    });

    $("#video-popup .next-round-btn").click(function (event) {
        event.preventDefault();

        var index = $(".featured-vieos > li.active").data("index");
        if (index == $(".featured-vieos > li:last-child").data("index")) {
            index = -1;
        }

        $(".featured-vieos > li.active").removeClass("active");
        $(".featured-vieos > li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(this).parent().find(".videos-count").html( (+index + 2) + " / " + $(this).parent().find(".featured-vieos > li").length);
        
    });

});