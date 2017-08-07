/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function showProducts(minPrice, maxPrice) {
    $("#products li").hide().filter(function () {
        var price = parseInt($(this).data("price"), 10);
        return price >= minPrice && price <= maxPrice;
    }).show();
}

$(function () {
    var options = {
        range: "max",
        min: 0,
        max: 6000,
        values: 6000,
        slide: function (event, ui) {
            var min = ui.values[0],
                    max = ui.values[1];

            $("#amount").val("$" + max + " - $" + min);
            showProducts(min, max);
        },
        stop: function (event, ui) {
            filter_property();
        }
    }, min, max;

    $( "#slider-range" ).slider({
        range: "min",
        min: 0,
        max: 6000,
        value: 0,
        slide: function( event, ui ) {
            $("#amount").val("$" + (6000 - ui.value) + " - $0");
        },
        stop: function (event, ui) {
            filter_property();
        }
    });

//    $("#slider-range").slider(options);

    min = 0;
    max = 6000;

    $("#amount").val("$" + max + " - $" + min);

    showProducts(min, max);
});
