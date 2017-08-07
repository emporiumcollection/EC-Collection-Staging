/**
 * @author SE Manu Mahesh
 * @date 21 Dec 2016
 */

$(document).ready(function () {
    
    $(".m_slider .arrows-container .previous-arrow").click(function (event) {
        event.preventDefault();

        var index = $(this).parent().parent().find("ul li.active").index();
        if (index == 0) {
            index = +$(this).parent().parent().find("ul li:last-child").index() + 1;
        }

        $(this).parent().parent().find("ul li.active").removeClass("active");
        $(this).parent().parent().find("ul li:nth-child(" + index + ")").addClass("active");

    });

    $(".m_slider .arrows-container .next-arrow").click(function (event) {
        event.preventDefault();

        var index = $(this).parent().parent().find("ul li.active").index();
        if (index == $(this).parent().parent().find("ul li:last-child").index()) {
            index = -1;
        }

        $(this).parent().parent().find("ul li.active").removeClass("active");
        $(this).parent().parent().find("ul li:nth-child(" + (+index + 2) + ")").addClass("active");

    });
    
    setInterval(function () {
        var index = $(".m_slider ul li.active").index();
        if (index == $(".m_slider ul li:last-child").index()) {
            index = -1;
        }

        $(".m_slider ul li.active").removeClass("active");
        $(".m_slider ul li:nth-child(" + (+index + 2) + ")").addClass("active");
    }, 10000);
    
});