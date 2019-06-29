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
    
    $(document).on('click', function(e){
        $(".chooseadultroom").css('display', 'none');
    });
    
    $(document).on('click', '#down-arrow', function (e) {
        $(".chooseadultroom").toggle();
        e.stopPropagation();
    });
    
    /*$(document).on('click', '#pdp_check_availibility', function(e){
        e.preventDefault();
        $('.header-content').addClass('showsearch');
        var property = $("select[name='property']").val();
        var arrive = $("input[name='arrive']").val();
        var departure = $("input[name='departure']").val();
        var booking_rooms = $("input[name='booking_rooms']").val();
        var booking_adults = $("input[name='booking_adults']").val();
        var booking_children = $("input[name='booking_children']").val();
        var roomType = $("select[name='roomType']").val();
        
        $.ajax({
           url: BaseURL +'/pdproomavailability',
           type:'post',
           dataType:'json',
           data:{property:property, arrive:arrive, departure:departure, booking_rooms:booking_rooms, booking_adults:booking_adults, booking_children:booking_children, roomType:roomType},
           success: function(response){
                console.log(response);
                $("#raModal").modal('show'); 
           } 
        });     
    });
    
    $(document).on('hide.bs.modal','#raModal', function () {
        $('.header-content').addClass('showsearch');      
    });*/
    
    $(document).on('click', '.minus-room', function (e) {        
        $(".traveller-type").each(function(index, element){ 
            if($(this).hasClass('active')){ 
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id'); 
                if(room.length > 0){            
                    room = parseInt(room); 
                    if(room > 1){
                        room = room - 1;
                        $(this).attr('data-room', room);
                        check_room_adult_bytype(t_type);
                    }
                }
                
            }
        }); 
        e.stopPropagation();        
    });
    $(document).on('click', '.plus-room', function (e) { 
        $(".traveller-type").each(function(index, element){ 
            //var type_id = $(this).attr('data-id');
            if($(this).hasClass('active')){ 
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id'); 
                
                var room1 = $("#tr_"+t_type+"_rooms").val();
                var adult1 = $("#tr_"+t_type+"_adults").val();
                var child1 = $("#tr_"+t_type+"_child").val();
                
                if(room.length > 0){            
                    room = parseInt(room); 
                    if(room > 0){ 
                        room = room + 1;  
                        if(adult < room){
                            adult = parseInt(adult) + 1;
                            $(this).attr('data-adult', adult);
                        }                      
                        $(this).attr('data-room', room);
                        check_room_adult_bytype(t_type);
                    }
                }
                
            }
        });
        e.stopPropagation();
    });
    $(document).on('click', '.minus-adult', function (e) { 
        $(".traveller-type").each(function(index, element){ 
            if($(this).hasClass('active')){
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id'); 
                if(adult.length > 0){            
                    adult = parseInt(adult);
                    if(adult > 1 && adult > room){ 
                        adult = adult - 1;                        
                        $(this).attr('data-adult', adult);
                        check_room_adult_bytype(t_type);
                    }
                }
                
            }
        });
        e.stopPropagation();  
    });
    $(document).on('click', '.plus-adult', function (e) { 
        $(".traveller-type").each(function(index, element){ 
            if($(this).hasClass('active')){ 
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id'); 
                if(adult.length > 0){            
                    adult = parseInt(adult); 
                    if(adult > 0){ 
                        adult = adult + 1;
                        $(this).attr('data-adult', adult);
                        check_room_adult_bytype(t_type);
                    }
                }
                
            }
        }); 
        e.stopPropagation(); 
    });
    
    $(document).on('click', '.minus-child', function (e) { 
        $(".traveller-type").each(function(index, element){ 
            if($(this).hasClass('active')){
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id'); 
                var child = $(this).attr('data-child');
                if(child.length > 0){            
                    child = parseInt(child);
                    if(child > 0){ 
                        child = child - 1;
                        $(this).attr('data-child', child);
                        check_room_adult_bytype(t_type);
                    }
                }
                if(t_type==2){
                    remove_child(2);    
                }                
                if(t_type==3){
                    remove_child(3);
                }
            }
        }); 
        e.stopPropagation(); 
    });
    $(document).on('click', '.plus-child', function (e) { 
        $(".traveller-type").each(function(index, element){ 
            if($(this).hasClass('active')){ 
                var room = $(this).attr('data-room');
                var adult = $(this).attr('data-adult');
                var t_type = $(this).attr('data-id');
                var child = $(this).attr('data-child'); 
                if(child.length > 0){            
                    child = parseInt(child); 
                    if(child >= 0){ 
                        child = child + 1;
                        $(this).attr('data-child', child);
                        check_room_adult_bytype(t_type);
                    }
                }
                if(t_type==2){
                    add_child(2, child);
                }
                if(t_type==3){
                    add_child(3, child);
                }
            }
        });
        e.stopPropagation();  
    });
    
    $(document).on('click', '.traveller-type', function(e){ 
       var t_type = $(this).attr('data-id'); 
       var rooms = $(this).attr('data-room'); 
       var adults = $(this).attr('data-adult');
       $(".traveller-type").each(function(index, element){ 
            $('.traveller-type').removeClass('active');
       });
       $(this).addClass('active');
       
       $("input[name='travellerType']").val(t_type);
       if(t_type==0){
             $("input[name='booking_rooms']").val(1);
             $("input[name='booking_adults']").val(1); 
             $("input[name='booking_children']").attr('disabled', 'disabled'); 
             $(".child-minus-plus").css('display', 'none');
             $(".ttra-2").css('display', 'none');
             $(".tta-2").css('display', '');
             $(".ttra-3").css('display', 'none');
             $(".tta-3").css('display', '');
             $(".ttra-4").css('display', 'none');
             $(".tta-4").css('display', '');      
             
             $(".traveller-type-2-child-age").css('display', 'none'); 
             $(".traveller-type-3-child-age").css('display', 'none');     
             //$(".number-of-adult").val();
       }else if(t_type==1){
             $("input[name='booking_rooms']").val(1);
             $("input[name='booking_adults']").val(2);
             $("input[name='booking_children']").attr('disabled', 'disabled');
             $(".child-minus-plus").css('display', 'none');
             $(".ttra-2").css('display', 'none');
             $(".tta-2").css('display', '');
             $(".ttra-3").css('display', 'none');
             $(".tta-3").css('display', '');
             $(".ttra-4").css('display', 'none');
             $(".tta-4").css('display', '');
             
             $(".traveller-type-2-child-age").css('display', 'none'); 
             $(".traveller-type-3-child-age").css('display', 'none');
       }else if(t_type==2){
             $("input[name='booking_rooms']").val(rooms);
             $("input[name='booking_adults']").val(adults);
             $("input[name='booking_children']").val(0);
             $("input[name='booking_children']").removeAttr('disabled');
             $(".child-minus-plus").css('display', ''); 
             $(".ttra-2").css('display', '');
             $(".tta-2").css('display', 'none');
             $(".ttra-3").css('display', 'none');
             $(".tta-3").css('display', '');
             $(".ttra-4").css('display', 'none');
             $(".tta-4").css('display', '');
             
             $(".traveller-type-2-child-age").css('display', ''); 
             $(".traveller-type-3-child-age").css('display', 'none');
       }else if(t_type==3){
             $("input[name='booking_rooms']").val(rooms);
             $("input[name='booking_adults']").val(adults);
             $("input[name='booking_children']").val(0);
             $("input[name='booking_children']").removeAttr('disabled');
             $(".child-minus-plus").css('display', ''); 
             $(".ttra-3").css('display', '');
             $(".tta-3").css('display', 'none');
             
             $(".ttra-2").css('display', 'none');
             $(".tta-2").css('display', '');
             $(".ttra-4").css('display', 'none');
             $(".tta-4").css('display', '');
             
             $(".traveller-type-2-child-age").css('display', 'none'); 
             $(".traveller-type-3-child-age").css('display', '');
       }else if(t_type==4){
             $("input[name='booking_rooms']").val(rooms);
             $("input[name='booking_adults']").val(adults);
             $("input[name='booking_children']").css('display', 'none');
             $("input[name='booking_children']").attr('disabled', 'disabled');
             $(".child-minus-plus").css('display', 'none');
             $(".ttra-4").css('display', '');
             $(".tta-4").css('display', 'none');
             
             $(".ttra-2").css('display', 'none');
             $(".tta-2").css('display', '');
             $(".ttra-3").css('display', 'none');
             $(".tta-3").css('display', '');
             
             $(".traveller-type-2-child-age").css('display', 'none'); 
             $(".traveller-type-3-child-age").css('display', 'none');
       }
       check_room_adult_bytype(t_type);
       e.stopPropagation();
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
    
    /*
    * For Membership of Left Sidebar
    */
    $(document).on('click', '[data-action="select-membership"]', function () {
        
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/membership';        
        params['successCallbackFunction'] = renderMembership;
        doAjax(params);


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

function add_child(type, child_no){
    var _html = '';
    //_html += '<div class="rw ">';
        _html += '<div class="col-30">';
            _html += '<div class="lable">child '+child_no+'</div>';
                _html += '<select name="tr_'+type+'_ca_'+child_no+'" class="child-age">';
                for(i=0; i<=14; i++){
                     _html += '<option value='+i+'>'+i+'</option>';        
                }
                _html += '</select>';
            _html += '</div>';
        _html += '</div>';
    //_html += '</div>';
    
    $('.traveller-type-'+type+'-child-age').append(_html);
}
function remove_child(type){    
    $('.traveller-type-'+type+'-child-age .col-30:last').remove();
}

function check_room_adult_bytype(type){ 
    var room_adult = '';
    var room_val = '';
    var adult_val = '';
    var child_val = '';
    var rooms = ''; 
    var adults = '';
    var chld = '';
    $(".number-of-adult").html('');
    if(type==0){  
        $(".chooseadultroom .column-1").addClass('width-100');
        $(".chooseadultroom .column-1").removeClass('border-1');
        $(".chooseadultroom .column-2").css('display', 'none');
        
        room_adult = '1 adult <br>1 room';
        $(".number-of-adult").html(room_adult);    
        
        $("input[name='booking_rooms']").val(1);
        $("input[name='booking_adults']").val(1); 
                    
        
    }else if(type==1){
        $(".chooseadultroom .column-1").addClass('width-100');
        $(".chooseadultroom .column-1").removeClass('border-1');
        $(".chooseadultroom .column-2").css('display', 'none');
        room_adult = '2 adult <br>1 room'; 
        $(".number-of-adult").html(room_adult); 
        
        $("input[name='booking_rooms']").val(1);
        $("input[name='booking_adults']").val(2);
             
    }else{
        $(".chooseadultroom .column-1").removeClass('width-100');
        $(".chooseadultroom .column-1").addClass('border-1');
        $(".chooseadultroom .column-2").css('display', '');
        var room = $("#traveller-type-"+type).attr('data-room');
        var adult = $("#traveller-type-"+type).attr('data-adult');   
        var child = $("#traveller-type-"+type).attr('data-child');
        
        var room1 = $("#tr_"+type+"_rooms").val();
        var adult1 = $("#tr_"+type+"_adults").val();
        var child1 = $("#tr_"+type+"_child").val(); 
        
        $(".minus-plus-room").html('');
        $(".minus-plus-adult").html('');
        $(".minus-plus-child").html('');
             
        if(room!='' && room!=undefined){
            if(room > 1){
                room_val = room+" rooms";
                rooms = room+" rooms";
            }else{
                room_val = room+" room";
                rooms = room+" room";
            }
        }
        if(adult!='' && adult!=undefined){
            if(adult > 1){
                adult_val = adult+" adults";
                adults = adult+" adults";
            }else{
                adult_val = adult+" adult";
                adults = adult+" adult";
            }
        }
        if(child!='' && child!=undefined){
            if(child > 1){
                adult_val+= ", "+child+" children";
                chld = child+" children";
            }else{
                adult_val+= ", "+child+" child";
                chld = child+" child";
            }
        }
        room_adult = adult_val+"<br>"+room_val;
        $(".number-of-adult").html(room_adult);
        
        ttra_val = room_val+", "+adult_val;
        $(".ttra-"+type).html(ttra_val);
        
        $(".minus-plus-room").html(rooms);
        $(".minus-plus-adult").html(adults);
        $(".minus-plus-child").html(chld);
        
        $("input[name='booking_rooms']").val(room);
        $("input[name='booking_adults']").val(adult);
        $("input[name='booking_children']").val(child);
        
        $("#tr_"+type+"_rooms").val(room);
        $("#tr_"+type+"_adults").val(adult);
        $("#tr_"+type+"_child").val(child); 
        
        
    }
}
function check_room_adult(){
    var room_adult = '';
    var room_val = '';
    var adult_val = '';
    
    $(".traveller-type").each(function(index, element){ 
        if($('.traveller-type').hasClass('active'))
        {
            var room = $(this).attr('data-room');
            var adult = $(this).attr('data-adult');
            if(room.length > 0){
                if(room > 1){
                    room_val = room+" rooms";
                }else{
                    room_val = room+" room";
                }
            }
            if(adult.length > 0){
                if(adult > 1){
                    adult_val = adult+" adults";
                }else{
                    adult_val = adult+" adult";
                }
            }
        } 
    });
    room_adult = room_val+", "+adult_val;
    $(".number-of-adult").html(room_adult);    
}
function check_room_adult_old(){
    var room_adult = '';
    var room_val = '';
    var adult_val = '';
    $('.txt-small').html('');
    var room = $("#hid_room").val();
    var adult = $("#hid_adult").val();
    if(room.length > 0){
        if(room > 1){
            room_val = room+" rooms";
        }else{
            room_val = room+" room";
        }
    }
    if(adult.length > 0){
        if(adult > 1){
            adult_val = adult+" adults";
        }else{
            adult_val = adult+" adult";
        }
    }
    room_adult = room_val+", "+adult_val;
    
    $(".traveller-type").each(function(index, element){ 
        if($('.traveller-type').hasClass('active'))
        {
            var t_type = ($('.traveller-type').attr('data-id'));
                        
        } 
    });
    
    return room_adult;
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
    //putDataOnLeft(data);
    
    menuHtml += '<div class="sidebartopheader" data-option="child-global">';
    menuHtml += '<h3 data-option-title="global">'+data.main_title+'</h3>';
    menuHtml += '<a href="javascript:void(0)" class="homelinknav backtohomelink" data-option-action="back" data-option-action-type="'+data.type+'" data-id="'+data.id+'"><i class="fa fa-angle-left"></i> <span>'+data.sub_title+'</span></a>';
    menuHtml += '</div>';
        
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
function renderMembership(dataObj) {
    if (dataObj.membershiptypes == undefined) {
        location.href = dataObj.current_menu.url;
        return false;
    }

    var data = {};
    data.main_title = 'Membership';
    data.sub_title = 'Home';
    data.id = 0;
    data.type = 'home';
    
    var menuHtml = '';
    hideAllOption();
    putDataOnLeft(data);
    $(dataObj.membershiptypes).each(function (i, val) {
        menuHtml += '<li><a href="' + BaseURL + '/memberships" data-action="select-membership">' + val.package_title + '</a></li>';
    });

    $('[data-option="selected-option-list"]').html(menuHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');
}
$(document).on('click', '.child-age', function(e){
   e.stopPropagation(); 
});

$(document).on('click', '.EGloader', function(e){
    e.preventDefault();
    
    var url = $(this).attr('href');
    $("#menu_url").val(url);
    var items = url.split('/');
    var destination = items[items.length-1]; 
    
    var datObj = {};
    datObj.url = url;
	datObj.destination = destination;
    
	var params = $.extend({}, doAjax_params_default);
	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
	params['data'] = datObj;
	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
	doAjax(params);    
      
});

function renderEmotionalGalleryLoader(dataObj){  console.log(dataObj);   
    var obj = dataObj.emotionalloader;
    var _html = '';
    if(obj.length > 0){
        _html +='<img src="'+obj[0].imgsrc+'/'+obj[0].file_name+'" class="main-img" />';
        _html +='<div class="image-overaly-bg"></div>';   
        _html +='<div class="loader-logo">';        
            _html +='<a href="'+BaseURL+'">';
                _html +='<img src="'+BaseURL+'/'+obj[0].logourl+'" class="img-responsive"/>';     
            _html +='</a>';            
        _html +='</div>';
        
        _html +='<div class="loader-text">';
            //_html +='<span>Loading collection </span><img src="'+BaseURL+'/images/loader.gif" />';
            _html +='<span>Loading '+obj[0].display_name+' </span>';
        _html +='</div>';
        
        _html +='<div class="loader-logo-title">';
            _html +='<h3>'+obj[0].title+'</h3>';
            _html +='<p>'+obj[0].description+'.</p>';
        _html +='</div>';    
        $(".emotional-gellery-loader").css('display', '');
        $(".emotional-gellery-loader").html(_html);
        $(".cnt").css('display', 'none');
        setTimeout(function(){        
            window.location.href=obj[0].url;
        },1500); 
    }else{
        var url = $("#menu_url").val()
        window.location.href = url;
    }
}

$(document).on('keyup', '[data-action="global-search"]', function () {
    $('[data-action="gobal-search-error"]').html('');
    if ($(this).val() == '') {
        $('[data-action="clear-search"]').hide();
        $('[data-option="gobal-search"]').slideUp(300);
    } else {
        $('[data-action="clear-search"]').show();
		var fvalue = $(this).val();		
		if(fvalue.length > 2)
		{
			globalSearchForAll($(this).val()); 
		}
    }
});
/*
* For Global Search function
*/
function globalSearchForAll(searcValue) {
   $('[data-action="gobal-destinations"]').parent().hide();
   $('[data-action="gobal-collections"]').parent().hide();
   $('[data-action="gobal-restaurant"]').parent().hide();
   $('[data-action="gobal-bar"]').parent().hide();
   $('[data-action="gobal-spa"]').parent().hide();

    var datObj = {};
    datObj.keyword = searcValue;
    var params = $.extend({}, doAjax_params_default);
    params['url'] = BaseURL + '/destination/global-search';
    params['data'] = datObj;
    params['successCallbackFunction'] = function (data) {
        $('[data-option="dest-option-list"]').html('');
        $('[data-option="collection-option-list"]').html('');
        $('[data-option="resto-option-list"]').html('');
        $('[data-option="spa-option-list"]').html('');
        $('[data-option="bar-option-list"]').html('');

        if(data.data.collection != undefined && data.data.collection.length > 0) {
            $('#globalfiltersearchpopup ul li:nth-child(1) ul.mobilemenulist').css("display", "block");
        } else if(data.data.dest != undefined && data.data.dest.length > 0) {
            $('#globalfiltersearchpopup ul li:nth-child(2) ul.mobilemenulist').css("display", "block");
        } else if(data.data.restro != undefined && data.data.restro.length > 0) {
            $('#globalfiltersearchpopup ul li:nth-child(3) ul.mobilemenulist').css("display", "block");
        } else if(data.data.spa != undefined && data.data.spa.length > 0) {
            $('#globalfiltersearchpopup ul li:nth-child(4) ul.mobilemenulist').css("display", "block");
        } else if(data.data.bar != undefined && data.data.bar.length > 0) {
            $('#globalfiltersearchpopup ul li:nth-child(5) ul.mobilemenulist').css("display", "block");
        }

        if (data.data.dest == undefined) {
            $('[data-action="gobal-destinations"] span').html('Destination (0)');
        }else {
            var html ='';
            var destString = (data.data.dest.length > 1) ? "Destinations" : "Destination";
            $('[data-action="gobal-destinations"] span').html(destString + ' ('+data.data.dest.length+')');
            $(data.data.dest).each(function (i, val) {
                var  linkMenu = BaseURL+'/luxury_destinations/'+val.category_alias;
                html += '<li><a class="cursor search_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
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
                html += '<li><a class="cursor search_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
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
                html += '<li><a class="cursor search_item" href="'+linkMenu+'">' + val.title + '</a></li>';
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
                html += '<li><a class="cursor search_item" href="'+linkMenu+'">' + val.title + '</a></li>';
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
                html += '<li><a class="cursor search_item" href="'+linkMenu+'">' + val.title + '</a></li>';
            });
            $('[data-option="spa-option-list"]').html(html);
            $('[data-action="gobal-spa"]').parent().show();
        }
    };
    doAjax(params);
    $('[data-option="gobal-search"]').slideDown(300);
}


/****** Global search all function *******/
$(document).on('click', '.close_btn', function () {
    $(".cstm_search").hide();
});
$(document).on('click', '.whengo', function(e){  
    e.preventDefault();
    $(".questions .global-search").toggle();
    
});
/****** End global search all function *******/
