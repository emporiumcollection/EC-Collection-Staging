/**
 * @author SE Manu Mahesh
 * @date 10 Dec 2016
 */

$(document).ready(function (){
    $(".testimoniales-container .btns a").click(function ( event ) {
        event.preventDefault();

        var index = $(this).data("index");

        $(this).parent().parent().find("ul li.active").removeClass("active");
        $(this).parent().parent().find("ul li:nth-child(" + index + ")").addClass("active");

    });
    setInterval(function () {
        var index = +$(".testimoniales-container ul li.active").index();

        if (index == $(".testimoniales-container ul li:last-child").index()) {
            index = -1;
        }

        $(".testimoniales-container ul li.active").removeClass("active");
        $(".testimoniales-container ul li:nth-child(" + (+index + 2) + ")").addClass("active");
    }, 10000);
});