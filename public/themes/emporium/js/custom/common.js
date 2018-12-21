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
        data.main_title = 'Search availability';
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

    /*$(document).on('change', '[data-action="search_by_type"]', function () {
        var datObj = {};
        datObj.type = $('select[data-action="search_by_type"]').val();
        datObj.city = $('select[data-action="search_by_city"]').val();

        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/resturantspabar_by_typecity_ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderResturantSpaBarByTypeCity;
        doAjax(params);
    });*/

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

    if($('[data-action="auto-suggestion"]').length) {   
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
                //log("Selected: " + ui.item.label + " aka " + ui.item.id);

                if(ui.item.type == 'category') {
                    location.href=BaseURL + '/' + ui.item.id;
                } else if(ui.item.type == 'restro') {
                    location.href=BaseURL + '/restaurants/' + ui.item.id;
                } else if(ui.item.type == 'bar') {
                    location.href=BaseURL + '/bars/' + ui.item.id;
                } else if(ui.item.type == 'spa') {
                    location.href=BaseURL + '/spas/' + ui.item.id;
                } else {}
            }
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
            var destIcon = '';
            if(item.type == 'category') {
                destIcon = '<i class="iconsheet icon-collections"></i>';
            } else if(item.type == 'destination') {
                destIcon = '<i class="iconsheet icon-destinations"></i>';
            } else if(item.type == 'restro') {
                destIcon = '<i class="iconsheet icon-restaurant"></i>';
            } else if(item.type == 'bar') {
                destIcon = '<i class="iconsheet icon-bar"></i>';
            } else {
                destIcon = '<i class="iconsheet icon-spa"></i>';
            }

            return $('<li>')
            .append( destIcon + item.label )
            .appendTo( ul );
        };
    }
	
	if($('[data-action="auto-suggestion-rdp"]').length) {   
        $('[data-action="auto-suggestion-rdp"]').autocomplete({
            source: function (request, response) {
                var datObj = {};
                datObj.keyword = request.term;
                var params = $.extend({}, doAjax_params_default);
                params['url'] = BaseURL + '/destination/auto-suggestion-ajax-rdp';
                params['data'] = datObj;
                params['dataType'] = 'jsonp';
                params['successCallbackFunction'] = function (data) {
                    response(data);
                };
                doAjax(params);
            },
            minLength: 2,
            select: function (event, ui) {
                /*if(ui.item.type) {
                    location.href=BaseURL + '/' + ui.item.id;
                }*/
				$('#rdpCounId').val(ui.item.ids);
            }
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
			var destIcon = '';
            destIcon = '<i class="iconsheet icon-destinations"></i>';
			
            return $('<li>')
            .append( destIcon + item.label )
            .appendTo( ul );
        };
    }
    
    if($('[data-action="auto-suggestion-booking"]').length) {   
        $('[data-action="auto-suggestion-booking"]').autocomplete({
            source: function (request, response) {
                var datObj = {};
                datObj.keyword = request.term;
                var params = $.extend({}, doAjax_params_default);
                params['url'] = BaseURL + '/destination/auto-suggestion-ajax-booking';
                params['data'] = datObj;
                params['dataType'] = 'jsonp';
                params['successCallbackFunction'] = function (data) {
                    response(data);
                };
                doAjax(params);
            },
            minLength: 2,
            select: function (event, ui) {
                //log("Selected: " + ui.item.label + " aka " + ui.item.id);

                if(ui.item.type == 'category') {
                    location.href=BaseURL + '/' + ui.item.id;
                } else if(ui.item.type == 'restro') {
                    location.href=BaseURL + '/restaurants/' + ui.item.id;
                } else if(ui.item.type == 'bar') {
                    location.href=BaseURL + '/bars/' + ui.item.id;
                } else if(ui.item.type == 'spa') {
                    location.href=BaseURL + '/spas/' + ui.item.id;
                } else {}
            }
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
            var destIcon = '';
            if(item.type == 'category') {
                destIcon = '<i class="iconsheet icon-collections"></i>';
            } else if(item.type == 'destination') {
                destIcon = '<i class="iconsheet icon-destinations"></i>';
            } else if(item.type == 'restro') {
                destIcon = '<i class="iconsheet icon-restaurant"></i>';
            } else if(item.type == 'bar') {
                destIcon = '<i class="iconsheet icon-bar"></i>';
            } else {
                destIcon = '<i class="iconsheet icon-spa"></i>';
            }

            return $('<li>')
            .append( destIcon + item.label )
            .appendTo( ul );
        };
    }
    
   /*
   * For Global Search
   */

   $(document).on('click', '[data-action="clear-search"]', function () {
        $('[data-action="clear-search"]').hide();      
        $('[data-action="gobal-search"]').val('');
        $('[data-action="gobal-search-button"]').trigger( "click" );
   });

   $(document).on('keyup', '[data-action="gobal-search"]', function () {
        $('[data-action="gobal-search-error"]').html('');
        if ($(this).val() == '') {
            $('[data-action="clear-search"]').hide();
            $('[data-option="gobal-search"]').slideUp(300);
        } else {
            $('[data-action="clear-search"]').show();
			var fvalue = $(this).val();
			console.log(fvalue.length);
			if(fvalue.length > 2)
			{
				globalSearch($(this).val());
			}
        }
   });

    $(document).on('click', '[data-action="gobal-search-button"]', function () {
        if ($('[data-action="gobal-search"]').val() == '') {
            $('[data-action="gobal-search-error"]').html('Please enter your search term');
            $('[data-option="gobal-search"]').slideUp(300);
        } else {
			var fvalue = $('[data-action="gobal-search"]').val();
			if(fvalue.length > 2)
			{
				globalSearch($('[data-action="gobal-search"]').val());
				$('[data-action="gobal-search-error"]').html('');
			}
        }
    });

   /*
   * For Global Search function
   */
   function globalSearch(searcValue) {
       $('[data-action="gobal-destinations"]').parent().hide();
       $('[data-action="gobal-collections"]').parent().hide();
       $('[data-action="gobal-restaurant"]').parent().hide();
       $('[data-action="gobal-bar"]').parent().hide();
       $('[data-action="gobal-spa"]').parent().hide();

        var datObj = {};
        datObj.keyword = searcValue;
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/global-search-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = function (data) {
            $('[data-option="dest-option-list"]').html('');
            $('[data-option="collection-option-list"]').html('');
            $('[data-option="resto-option-list"]').html('');
            $('[data-option="spa-option-list"]').html('');
            $('[data-option="bar-option-list"]').html('');

            if(data.data.collection != undefined && data.data.collection.length > 0) {
                $('#filtersearchpopup ul li:nth-child(1) ul.mobilemenulist').css("display", "block");
            } else if(data.data.dest != undefined && data.data.dest.length > 0) {
                $('#filtersearchpopup ul li:nth-child(2) ul.mobilemenulist').css("display", "block");
            } else if(data.data.restro != undefined && data.data.restro.length > 0) {
                $('#filtersearchpopup ul li:nth-child(3) ul.mobilemenulist').css("display", "block");
            } else if(data.data.spa != undefined && data.data.spa.length > 0) {
                $('#filtersearchpopup ul li:nth-child(4) ul.mobilemenulist').css("display", "block");
            } else if(data.data.bar != undefined && data.data.bar.length > 0) {
                $('#filtersearchpopup ul li:nth-child(5) ul.mobilemenulist').css("display", "block");
            }

            if (data.data.dest == undefined) {
                $('[data-action="gobal-destinations"] span').html('Destination (0)');
            }else {
                var html ='';
                var destString = (data.data.dest.length > 1) ? "Destinations" : "Destination";
                $('[data-action="gobal-destinations"] span').html(destString + ' ('+data.data.dest.length+')');
                $(data.data.dest).each(function (i, val) {
                    var  linkMenu = BaseURL+'/luxury_destinations/'+val.category_alias;
                    html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                });
                $('[data-option="dest-option-list"]').html(html);
                $('[data-action="gobal-destinations"]').parent().show();
            }
            if (data.data.collection == undefined) {
                $('[data-action="gobal-collections"] span').html('Collection (0)');
            }else{
                var html ='';
                var collString = (data.data.collection.length > 1) ? "Collections" : "Collection";
                $('[data-action="gobal-collections"] span').html(collString + ' ('+data.data.collection.length+')');
                $(data.data.collection).each(function (i, val) {
                    var  linkMenu = BaseURL+'/'+val.property_slug;
                    html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
                });
                $('[data-option="collection-option-list"]').html(html);
                $('[data-action="gobal-collections"]').parent().show();
            }
            if (data.data.restro == undefined) {
                $('[data-action="gobal-restaurant"] span').html('Restaurant (0)');
            } else {
                var html ='';
                var restroString = (data.data.restro.length > 1) ? "Restaurants" : "Restaurant";
                $('[data-action="gobal-restaurant"] span').html(restroString + ' ('+data.data.restro.length+')');
                $(data.data.restro).each(function (i, val) {
                    var  linkMenu = BaseURL+'/restaurants/'+val.alias;
                    html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.title + '</a></li>';
                });
                $('[data-option="resto-option-list"]').html(html);
                $('[data-action="gobal-restaurant"]').parent().show();
            }
            if (data.data.bar == undefined) {
                $('[data-action="gobal-bar"] span').html('Bar (0)');
            } else {
                var html ='';
                var barString = (data.data.bar.length > 1) ? "Bars" : "Bar";
                $('[data-action="gobal-bar"] span').html(barString + ' ('+data.data.bar.length+')');
                $(data.data.bar).each(function (i, val) {
                    var  linkMenu = BaseURL+'/bars/'+val.alias;
                    html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.title + '</a></li>';
                });
                $('[data-option="bar-option-list"]').html(html);
                $('[data-action="gobal-bar"]').parent().show();
            }
            if (data.data.spa == undefined) {
                $('[data-action="gobal-spa"] span').html('Spa (0)');
            } else {
                var html ='';
                var spaString = (data.data.spa.length > 1) ? "Spas" : "Spa";
                $('[data-action="gobal-spa"] span').html(spaString + ' ('+data.data.spa.length+')');
                $(data.data.spa).each(function (i, val) {
                    var  linkMenu = BaseURL+'/spas/'+val.alias;
                    html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.title + '</a></li>';
                });
                $('[data-option="spa-option-list"]').html(html);
                $('[data-action="gobal-spa"]').parent().show();
            }
        };
        doAjax(params);
        $('[data-option="gobal-search"]').slideDown(300);
   }


   /*
   * For Show Gobal Collection
   */
   $(document).on('click', '[data-action="gobal-collections"]', function () {
        /*hideAllOption();
        var data = {};
        data.main_title = 'Collections';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="collection-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');*/
        //$(this).parent().children('[data-option="collection-option-list"]').removeClass('hide');
    });

    /*
    * For Show Gobal Destination
    */

    $(document).on('click', '[data-action="gobal-destinations"]', function () {
        /*hideAllOption();
        var data = {};
        data.main_title = 'Destinations';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="dest-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');*/
        //$(this).parent().children('[data-option="dest-option-list"]').removeClass('hide');
    });

    /*
    * For Show Gobal Resto
    */

    $(document).on('click', '[data-action="gobal-restaurant"]', function () {
        /*hideAllOption();
        var data = {};
        data.main_title = 'Restaurants';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="resto-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');*/
        //$(this).parent().children('[data-option="resto-option-list"]').removeClass('hide');

    });

    /*
    * For Show Gobal Spa
    */

    $(document).on('click', '[data-action="gobal-spa"]', function () {
        /*hideAllOption();
        var data = {};
        data.main_title = 'Spas';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="spa-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');*/
        //$(this).parent().children('[data-option="spa-option-list"]').removeClass('hide');
    });

    /*
    * For Show Gobal Bar
    */

    $(document).on('click', '[data-action="gobal-bar"]', function () {
        /*hideAllOption();
        var data = {};
        data.main_title = 'Bars';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        $('[data-option="bar-option-list"]').removeClass('hide');
        $('[data-option="child-global"]').removeClass('hide');*/
        //$(this).parent().children('[data-option="bar-option-list"]').removeClass('hide');

    });

    $(document).on('click', '.searchresultdata', function() {
        $(this).parent().children('.mobilemenulist').slideToggle(400);
        $(this).parent().siblings().children('.mobilemenulist').slideUp(400);
    });

});

/*function renderResturantSpaBarByTypeCity(dataObj) {
    var selectHtml = '<opyion value="">- Select -</option>';
    $(dataObj.records).each(function (i, val) {
        selectHtml += '<option value="' + val.id + '">' + val.title + '</option>';
    });

    $('[data-action="search_by_name"]').html(selectHtml);
}*/

function renderResturantSpaBarSearch(dataObj) {


}

/*
 * For Hide All Option on Left Side Bar
 */
function hideAllOption() {
    $('[data-option="home"]').addClass('hide');
    $('[data-option-type="logo"]').removeClass('hide');
    $('[data-option="global"]').addClass('hide');
    $('[data-option="child-global"]').addClass('hide');
    $('[data-option="selected-option-list"]').addClass('hide');
    $('[data-option="search-by-date"]').addClass('hide');
    $('[data-option="search-our-collection"]').addClass('hide');
    /*$('[data-option="dest-option-list"]').addClass('hide');
    $('[data-option="collection-option-list"]').addClass('hide');
    $('[data-option="resto-option-list"]').addClass('hide');
    $('[data-option="spa-option-list"]').addClass('hide');
    $('[data-option="bar-option-list"]').addClass('hide');*/
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
    data.main_title = 'Company & Info';
    data.sub_title = 'Home';
    data.id = 0;
    data.type = 'home';
    if (dataObj.current_menu != undefined) {
        data.main_title = '<a style="color:#fff;" href="'+ BaseURL +'">Home</a>';
        data.sub_title = dataObj.current_menu.menu_name;
        data.id = dataObj.current_menu.id;
    }
    var menuHtml = '';
    hideAllOption();
    putDataOnLeft(data);
    $(dataObj.menus).each(function (i, val) {
        if(val.menu_type == "external") {
            if(val.url == "#" || val.url == "") {
                menuHtml += '<li><a class="cursor menu_item" data-action="select-menu" data-position="' + val.position + '" data-id="' + val.menu_id + '">' + val.menu_name + '</a><i class="fa fa-angle-right"></i></li>';
            } else {
                menuHtml += '<li><a href="' + val.url + '" class="cursor menu_item">' + val.menu_name + '</a></li>';
            }
        } else {
            menuHtml += '<li><a href="' + BaseURL + '/' + val.module + '" class="cursor menu_item">' + val.menu_name + '</a></li>';
        }

    });

    $('[data-option="selected-option-list"]').html(menuHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');
}

$(document).on('click', '[data-action="agree-button"]', function () {
    $(".transferSecSecond").addClass("openTransferSec");
    $(".transferSecFirst").removeClass("openTransferSec");
    $(".transferSecThird").removeClass("openTransferSec");
});

$(document).on('click', '[data-action="send-email-button"]', function () {
    $(".transferSecThird").addClass("openTransferSec");
    $(".transferSecSecond").removeClass("openTransferSec");
    $(".transferSecSecond").removeClass("openTransferSec");
});

$(document).on('click', '[data-action="contactform-restaurant"]', function () {
    var contactType = $(this).attr("rel");
    var contactRel = $(this).attr("rel2");
	$('.con-type').val('');
    $('#restoid').val(0);
	if(contactType != ''){
		$('.con-type').val(contactType);
		$('#restoid').val(contactRel);
	}
});

$(document).on('change', '[data-action="restoid"]', function () {
	var contactType = $('option:selected', this).attr('rel');
    $('.con-type').val(contactType);
});

$(document).on('click', '.ui-menu-item', function() {
	var rdpType = $('[data-action="search_by_type"]').val();
	var rdpCountry = $('[data-action="auto-suggestion-rdp"]').val();
	if(rdpType!='' && rdpCountry!='')
	{
		var datObj = {};
		datObj.type = rdpType;
		datObj.city = rdpCountry;

		var params = $.extend({}, doAjax_params_default);
		params['url'] = BaseURL + '/destination/resturant-spa-bar-by-type-city-ajax';
		params['data'] = datObj;
		params['successCallbackFunction'] = renderRdp;
		doAjax(params);
	} else {
		$('[data-action="search_by_name"]').html("<option >-Select-</option>");
	}
});

$(document).on('change', '[data-action="search_by_type"]', function() {
	var rdpType = $(this).val();
	var rdpCountry = $('[data-action="auto-suggestion-rdp"]').val();
	
	if(rdpType!='' && rdpCountry!='')
	{
		var datObj = {};
		datObj.type = rdpType;
		datObj.city = rdpCountry;

		var params = $.extend({}, doAjax_params_default);
		params['url'] = BaseURL + '/destination/resturant-spa-bar-by-type-city-ajax';
		params['data'] = datObj;
		params['successCallbackFunction'] = renderRdp;
		doAjax(params);
	}
	else {
		$('[data-action="search_by_name"]').html("<option >-Select-</option>");
	}
});


function renderRdp(dataObj) {
        
	var Html = '<option>-Select-</option>';
	$('[data-action="search_by_name"]').html("<option>-Select-</option>");
    $(dataObj.records).each(function (i, val) {
        Html += '<option value="'+val.alias+'">'+val.title+'</option>';
		
    });
	$('[data-action="search_by_name"]').html(Html);
}

$(document).on('click', '[data-action="make-reservation"]', function () {
    var rdpType = $('[data-action="search_by_type"]').val();
	var rdpCountry = $('[data-action="search_by_name"]').val();
	if(rdpType != '' && rdpCountry != ''){
		window.location.href = BaseURL+'/'+rdpType+'/'+rdpCountry;
	}
});