/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.S
 */


//Destination Page Js
$(document).ready(function () {

    $(".open-show_more-html").css("width", $(window).width());
    $(".close-btn-show_more").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("show_more-page-opend");
        $(".show_more-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-show_more-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("show_more-page-opend");
        $(".show_more-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Destination Page End Js
$(document).ready(function () {

    $(".open-cookie-bar-html").css("width", $(window).width());
    $(".close-btn-cookie-bar").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("cookie-bar-page-opend");
        $(".cookie-bar-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-cookie-bar-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("cookie-bar-page-opend");
        $(".cookie-bar-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});