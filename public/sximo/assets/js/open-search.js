/**
 * @author SE Mohit
 * @date 20 Dec 2016
 */

//Search Page Js
$(document).ready(function () {

    $(".open-search-html").css("width", $(window).width());
    $(".close-btn").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("search-page-opend");
        $(".search-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-search-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("search-page-opend");
        $(".search-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Search Page End Js

//Choose Experience Js
$(document).ready(function () {

    $(".open-experience-html").css("width", $(window).width());
    $(".close-btn-experience").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("experience-page-opend");
        $(".experience-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-experience-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("experience-page-opend");
        $(".experience-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Choose Experience  End Js
//Destination Page Js
$(document).ready(function () {

    $(".open-destination-html").css("width", $(window).width());
    $(".close-btn-destination").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("destination-page-opend");
        $(".destination-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-destination-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("destination-page-opend");
        $(".destination-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Destination Page End Js
//Personalized Page Js
$(document).ready(function () {

    $(".open-personalized-html").css("width", $(window).width());
    $(".close-btn-personalized").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("personalized-page-opend");
        $(".personalized-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-personalized-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("personalized-page-opend");
        $(".personalized-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Personalized Page End Js
//About Page Js
$(document).ready(function () {

    $(".open-about-html").css("width", $(window).width());
    $(".close-btn-about").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("about-page-opend");
        $(".about-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-about-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("about-page-opend");
        $(".about-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//About Page Js End Here
//Date Page Js
$(document).ready(function () {

    $(".open-date-html").css("width", $(window).width());
    $(".close-btn-date").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("date-page-opend");
        $(".date-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-date-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("date-page-opend");
        $(".date-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//show Page Js End Here
//Date Page Js
$(document).ready(function () {

    $(".open-hotel-html").css("width", $(window).width());
    $(".close-btn-hotel").click(function (event) {
        event.preventDefault();
        $(this).removeClass("opend");
        $("body").removeClass("hotel-page-opend");
        $(".hotel-page").animate({
            width: "0px"
        }, 800, function () {});

    });
    $(".open-hotel-page").click(function (event) {
        event.preventDefault();

        !$(this).hasClass("opend");
        $(this).addClass("opend");
        $("body").addClass("hotel-page-opend");
        $(".hotel-page").animate({
            width: "100%"
        }, 800, function () {});


    });
});
//Date Page End Here Js