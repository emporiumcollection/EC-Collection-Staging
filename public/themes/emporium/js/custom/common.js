$(document).ready(function () {
    /*
     * For Confirm for reading Confidential Data
     */
    checkCookie();

    $(document).on('click', '.cookie-bar-hide-btn', function () {
        $('.bootom-cookie-bar-outer').hide();
    });


    $(document).on('click', '.open-cookie-bar-page', function () {
        $(".cookie-bar-page").fadeIn();
    });


    $(document).on('click', '.close-btn-align', function () {
        $(".cookie-bar-page").fadeOut();
    });


    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', '[data-action="select-collection"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Search Our Collection';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openCollection();

    });

    /*
    * For Company of Left Sidebar
    */
    $(document).on('click', '[data-action="select-menu"]', function () {
        var datObj = {};
        datObj.menuID = $(this).attr('data-id');
        datObj.menu_pos = $(this).attr('data-position');

        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/menus-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderMenu;
        doAjax(params);


    });

    /*
     * For Select By Date of Left Sidebar
     */
    $(document).on('click', '[data-action="search-by-date"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Search By Date';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openSearchByDate();


    });

    /*
     * For Select By Date of Left Sidebar
     */
    $(document).on('click', '[data-option-action="back"][data-option-action-type="home"]', function () {
        hideAllOption();
        openAllHomeOption();
    });

    /*
     * For Select By Date of Left Sidebar
     */
    $(document).on('change', '[data-action="choose-date"]', function () {
        var arrival = $('select[data-option="arrival-day"]').val() + '-' + $('select[data-option="arrival-month"]').val() + '-' + $('select[data-option="arrival-year"]').val();
        var departure = $('select[data-option="departure-day"]').val() + '-' + $('select[data-option="departure-month"]').val() + '-' + $('select[data-option="departure-year"]').val();
        var arrive = '';
        $('input[name="arrive"]').val(arrival);
        $('input[name="departure"]').val(departure);
    });

    /*
     * For Select By Filter of Left Sidebar
     */
    $(document).on('click', '[data-action="select-filter"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Search By Filter';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openSearchByFilter();


    });

    $(document).on('change', '[data-action="search_by_type"]', function () {
        var datObj = {};
        datObj.type = $('select[data-action="search_by_type"]').val();
        datObj.city = $('select[data-action="search_by_city"]').val();

        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/resturantspabar_by_typecity_ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderResturantSpaBarByTypeCity;
        doAjax(params);
    });

    $(document).on('change', '[data-action="make-reservation"]', function () {
        var datObj = {};
        datObj.type = $('select[data-action="search_by_type"]').val();
        datObj.city = $('select[data-action="search_by_city"]').val();
        datObj.searchid = $('select[data-action="search_by_name"]').val();

        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/resturantspabarSearch_ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderResturantSpaBarSearch;
        doAjax(params);
    });

    /*
    *  For Auto suggestion list for Top Search Bar
    */


    $('[data-action="auto-suggestion"]').autocomplete({
        source: function (request, response) {
            var datObj = {};
            datObj.keyword = request.term;
            var params = $.extend({}, doAjax_params_default);
            params['url'] = BaseURL + '/destination/auto-suggestion-ajax';
            params['data'] = datObj;
            params['dataType'] = 'jsonp';
            params['successCallbackFunction'] = function (data) {
                response(data);
            };
            doAjax(params);
        },
        minLength: 2,
        select: function (event, ui) {
            console.log("Selected: " + ui.item.label + " aka " + ui.item.id);
        }
    });

    /*
    * For Global Search
    */
    $(document).on('keyup', '[data-action="gobal-search"]', function () {
        $('[data-option="dest-option-list"]').addClass('hide');
        $('[data-option="collection-option-list"]').addClass('hide');
        $('[data-option="resto-option-list"]').addClass('hide');
        $('[data-option="spa-option-list"]').addClass('hide');
        $('[data-option="bar-option-list"]').addClass('hide');

        if ($(this).val() == '') {
            $('[data-option="gobal-search"]').slideUp(300);
        } else {
            $('[data-action="gobal-destinations"]').parent().hide();
            $('[data-action="gobal-collections"]').parent().hide();
            $('[data-action="gobal-restaurant"]').parent().hide();
            $('[data-action="gobal-bar"]').parent().hide();
            $('[data-action="gobal-spa"]').parent().hide();
            var datObj = {};
            datObj.keyword = $(this).val();
            var params = $.extend({}, doAjax_params_default);
            params['url'] = BaseURL + '/destination/global-search-ajax';
            params['data'] = datObj;
            params['successCallbackFunction'] = function (data) {

                if (data.data.dest != undefined) {
                    var html ='';
                    $('[data-action="gobal-destinations"] span').html(data.data.dest.length);
                    $(data.data.dest).each(function (i, val) {
                        var  linkMenu = BaseURL+'/luxury_destinations/'+val.category_alias;
                        html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                    });
                    $('[data-option="dest-option-list"]').html(html);
                    $('[data-action="gobal-destinations"]').parent().show();
                }
                if (data.data.collection != undefined) {
                    $('[data-action="gobal-collections"] span').html(data.data.collection.length);
                    $(data.data.collection).each(function (i, val) {
                        var  linkMenu = BaseURL+'/'+val.property_slug;
                        html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
                    });
                    $('[data-option="collection-option-list"]').html(html);
                    $('[data-action="gobal-collections"]').parent().show();
                }
                if (data.data.restro != undefined) {
                    $('[data-action="gobal-restaurant"] span').html(data.data.restro.length);
                    $(data.data.resto).each(function (i, val) {
                        var  linkMenu = BaseURL+'/'+val.alias;
                        html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.title + '</a></li>';
                    });
                    $('[data-option="resto-option-list"]').html(html);
                    $('[data-action="gobal-restaurant"]').parent().show();
                }
                if (data.data.bar != undefined) {
                    $('[data-action="gobal-bar"] span').html(data.data.bar.length);
                    $(data.data.bar).each(function (i, val) {
                        var  linkMenu = BaseURL+'/'+val.alias;
                        html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.title + '</a></li>';
                    });
                    $('[data-option="bar-option-list"]').html(html);
                    $('[data-action="gobal-bar"]').parent().show();
                }
                if (data.data.spa != undefined) {
                    $('[data-action="gobal-spa"] span').html(data.data.spa.length);
                    $(data.data.spa).each(function (i, val) {
                        var  linkMenu = BaseURL+'/'+val.property_slug;
                        html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
                    });
                    $('[data-option="spa-option-list"]').html(html);
                    $('[data-action="gobal-spa"]').parent().show();
                }
            };
            doAjax(params);
            $('[data-option="gobal-search"]').slideDown(300);
        }
    });


    /*
    * For Show Gobal Collection
    */

    $(document).on('click', '[data-action="gobal-collections"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Collections';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="collection-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');

    });

    /*
    * For Show Gobal Destination
    */

    $(document).on('click', '[data-action="gobal-destinations"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Destinations';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="dest-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');

    });

    /*
    * For Show Gobal Resto
    */

    $(document).on('click', '[data-action="gobal-restaurant"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Restaurants';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="resto-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');

    });

    /*
    * For Show Gobal Spa
    */

    $(document).on('click', '[data-action="gobal-spa"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Spas';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="spa-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');

    });

    /*
    * For Show Gobal Bar
    */

    $(document).on('click', '[data-action="gobal-bar"]', function () {
        hideAllOption();
        var data = {};
        data.main_title = 'Bars';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="bar-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');

    });

});

function renderResturantSpaBarByTypeCity(dataObj) {

    var selectHtml = '<opyion value="">- Select -</option>';
    $(dataObj.records).each(function (i, val) {
        selectHtml += '<option value="' + val.id + '">' + val.title + '</option>';
    });

    $('[data-action="search_by_name"]').html(selectHtml);
}

function renderResturantSpaBarSearch(dataObj) {


}

/*
 * For Hide All Option on Left Side Bar
 */
function hideAllOption() {
    $('[data-option="home"]').addClass('hide');
    $('[data-option="global"]').addClass('hide');
    $('[data-option="child-global"]').addClass('hide');
    $('[data-option="selected-option-list"]').addClass('hide');
    $('[data-option="search-by-date"]').addClass('hide');
    $('[data-option="search-our-collection"]').addClass('hide');
    $('[data-option="dest-option-list"]').addClass('hide');
    $('[data-option="collection-option-list"]').addClass('hide');
    $('[data-option="resto-option-list"]').addClass('hide');
    $('[data-option="spa-option-list"]').addClass('hide');
    $('[data-option="bar-option-list"]').addClass('hide');
    $('[data-option="gobal-search"]').css('display','none');
}

/*
 * For Set and Check Cookies for Confidential Data
 */

//Set Cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//Check Cookie
function checkCookie() {

    var username = getCookie("cookie-bar");

    if (username == "") {
        setCookie('cookie-bar', '1', 1);
        $(".bootom-cookie-bar-outer").show();
    } else {
        $(".bootom-cookie-bar-outer").hide();
    }
}

//Get Cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/*
 * For put data dynamically
 */

function putDataOnLeft(data) {
    $('[data-option="child-global"] [data-option-title="global"]').html(data.main_title);
    $('[data-option="child-global"] [data-option-action="back"] span').html(data.sub_title);
    $('[data-option="child-global"] [data-option-action="back"]').attr('data-id', data.id);
    $('[data-option="child-global"] [data-option-action="back"]').attr('data-option-action-type', data.type);
}

/*
 * For open collection options
 */
function openCollection() {
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="search-our-collection"]').removeClass('hide');
}

/*
 * For open search-by-date options
 */
function openSearchByDate() {
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="search-by-date"]').removeClass('hide');
}

/*
 * For open all home options
 */
function openAllHomeOption() {
    $('[data-option="home"]').removeClass('hide');
    $('[data-option="global"]').removeClass('hide');
}

/*
 * For open search-by-date options
 */
function openSearchByFilter() {
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="select-filter"]').removeClass('hide');
}

/*
 * For Get Response of Menu Ajax
 */
function renderMenu(dataObj) {
    if (dataObj.menus == undefined) {
        location.href = dataObj.current_menu.url;
        return false;
    }

    var data = {};
    data.main_title = 'Company';
    data.sub_title = 'Home';
    data.id = 0;
    data.type = 'home';
    if (dataObj.current_menu != undefined) {
        data.main_title = 'Home';
        data.sub_title = dataObj.current_menu.menu_name;
        data.id = dataObj.current_menu.id;
    }
    var menuHtml = '';
    hideAllOption();
    putDataOnLeft(data);
    $(dataObj.menus).each(function (i, val) {
        menuHtml += '<li><a class="cursor menu_item" data-action="select-menu" data-position="' + val.position + '" data-id="' + val.id + '">' + val.menu_name + '</a>';
        menuHtml += '<a href="' + val.url + '" class="external-link"><i class="fa fa-external-link" aria-hidden="true"></i></a></li>';


    });

    $('[data-option="selected-option-list"]').html(menuHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');

}