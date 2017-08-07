/**
 * @author SE Manu Mahesh
 * @date 20 Dec 2016
 */


$(document).ready(function () {
    
    var OneDayPossible = $("input.datePicker.dateTo").hasClass("OneDayPossible");

    var today = new Date();
    var tomorrow = new Date();
    if (!OneDayPossible) {
        tomorrow.setDate(today.getDate() + 1);
    }
    
    $("input.datePicker.dateFrom").datepicker({
        dateFormat: "dd MM yy",
        minDate: today,
        onSelect: function (selectedDate, dPicker) {
            if ($(this).hasClass("dateFrom")) {
                var d = $(this).datepicker("getDate");
                if (OneDayPossible) {
                    d.setDate(d.getDate());

                } else {
                    d.setDate(d.getDate() + 1);
                }
                $(".dateTo").datepicker("setDate", d);
                $(".dateTo").datepicker("option", "minDate", d);
            }
        }
    });
    $("input.datePicker.dateTo").datepicker({
        dateFormat: "dd MM yy",
        minDate: tomorrow,
    });
    
    $(".book-now-page-content").css("width", $(window).width());
    $(".open-book-now-page").click(function (event) {
        event.preventDefault();

        if (!$(this).hasClass("opend")) {
            $(this).addClass("opend");
            $("body").addClass("book-now-page-opend");
            $(this).html("&times;");
            $(".book-now-page").animate({
                width: "100%"
            }, 800, function () {});
        } else {
            $(this).removeClass("opend");
            $("body").removeClass("book-now-page-opend");
            $(this).html("BOOK");
            $(".book-now-page").animate({
                width: "0px"
            }, 800, function () {});
        }

    });
});