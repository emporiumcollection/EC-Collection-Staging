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
        $("#globalfiltersearchpopup").css('display', 'none');
        $('.gs-searchbar-main-collection').css('display', 'none');
        $(".gs-main-collection").css('display', 'none');
    });
    
    $(document).on('click', '#down-arrow', function (e) { 
        $(".chooseadultroom").toggle();
        $('.gs-searchbar-main-collection').css('display', 'none');
        e.stopPropagation();
    });
    $(document).on('click', '.who', function (e) { 
        $(".chooseadultroom").toggle();
        $('.gs-searchbar-main-collection').css('display', 'none');
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
        $(".cstm_search").toggle();
        /*hideAllOption();
        var data = {};
        data.main_title = 'Search availability';
        data.sub_title = 'Home';
        data.id = 0;
        putDataOnLeft(data);
        openSearchByDate();
*/

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
   
   $(document).on('click', '[data-action="gobal-search"]', function () {
        //$(".cstm_search").toggle();
        window.location.reload(BaseURL);
        $('[data-action="global-search"]').focus();   
   }); 
   $(document).on('keyup', '[data-action="gobal-search"]', function () {
        //$(".cstm_search").toggle();
        window.location.reload(BaseURL);
        /*$('[data-action="gobal-search-error"]').html('');
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
        }*/
   });

    $(document).on('click', '[data-action="gobal-search-button"]', function () {
        //$(".cstm_search").toggle();
        window.location.reload(BaseURL);
        $('[data-action="global-search"]').focus();
        /*if ($('[data-action="gobal-search"]').val() == '') {
            $('[data-action="gobal-search-error"]').html('Please enter your search term');
            $('[data-option="gobal-search"]').slideUp(300);
        } else {
			var fvalue = $('[data-action="gobal-search"]').val();
			if(fvalue.length > 2)
			{
				globalSearch($('[data-action="gobal-search"]').val());
				$('[data-action="gobal-search-error"]').html('');
			}
        }*/
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

function check_room_adult_bytype(type){ console.log(type);
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
        var room = $("#traveller-type-"+type).attr('data-room'); console.log(room);
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
        console.log(room_adult);
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

function renderEmotionalGalleryLoader(dataObj){  
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
        
        //_html +='<div class="loader-text">';
        //    //_html +='<span>Loading collection </span><img src="'+BaseURL+'/images/loader.gif" />';
        //    _html +='<span>Loading '+obj[0].display_name+' </span>';
        //_html +='</div>';
        
        _html +='<div class="loader-logo-title">';
            _html +='<h3>'+obj[0].title+'</h3>';
            _html +='<p>'+obj[0].description+'.</p>';
             //_html +='<div class="loader-text">';                
                _html +='<span>Loading '+obj[0].display_name+' </span>';
            //_html +='</div>';
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
    var sitename = $("#sitename").val();
    $('[data-action="global-search-error"]').html('');
    if ($(this).val() == '') {
        $('[data-action="global-clear-search"]').hide();
        $('[data-option="global-search"]').slideUp(300);
    } else {
        $('[data-action="global-clear-search"]').show();
		var fvalue = $(this).val();
		
		if(fvalue.length > 2)
		{ console.log($(this).val());
			globalSearchForAll($(this).val(), sitename);
            
            $('input[name="hote_or_dest_has_value"]').val(1);
		}else{
		    $('input[name="hote_or_dest_has_value"]').val('');  
		}
    }
});

/*$(document).on('keyup', '[data-action="global-search"]', function () {
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
});*/

    /*
* For Global Search function
*/
function globalSearchForAll(searcValue, sitename) {

    var datObj = {};
    datObj.keyword = searcValue;
    datObj.sitename = sitename;
    var params = $.extend({}, doAjax_params_default);
    params['url'] = BaseURL + '/destination/global-search';
    params['data'] = datObj;
    params['successCallbackFunction'] = function (data) {
        
        if(data.data.sitename!=undefined){
            var sitenm = data.data.sitename;
            if(sitenm=='voyage'){
                BaseURL1 = 'https://emporium-voyage.com';
            }else if(sitenm=='safari'){
                BaseURL1 = 'https://emporium-safari.com';
            }else if(sitenm=='spa'){
                BaseURL1 = 'https://emporium-spa.com';
            }else if(sitenm=='islands'){
                BaseURL1 = 'https://emporium-islands.com';
            }
        }
        $('[data-action="global-search-our-collections"] span').html('Our Collection (0)');
        $('[data-action="global-search-collections"] span').html('Our Hotel (0)');
        $('[data-action="global-search-destinations"] span').html('Our Destination (0)');
        $('[data-action="global-search-experiences"] span').html('Our Experience (0)');
        $('[data-action="global-search-destination-channels"] span').html('Our Channel (0)');
        
        $('[data-option="global-search-our-collection-option-list"]').html('');
        $('[data-option="global-search-collection-option-list"]').html('');
        $('[data-option="global-search-dest-option-list"]').html('');
        $('[data-option="global-search-experience-option-list"]').html('');
        $('[data-option="global-search-dest-channel-option-list"]').html('');       
        
        if (data.data.our_collection == undefined) {
            $('[data-action="global-search-our-collections"] span').html('Our Collection (0)');
        }else{
            var html ='';
            var collString = (data.data.our_collection.length > 1) ? "Our Collections" : "Our Collection";
            $('[data-action="global-search-our-collections"] span').html(collString + ' ('+data.data.our_collection.length+')');
            $(data.data.our_collection).each(function (i, val) {
                var  linkMenu = BaseURL1+'/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                
                
                var cname = searcValue;
                var arr_str = cname.split(',');
                $.each(arr_str, function(key, value){
                    
                });
                
                cat_name = val.category_name; 
                var regExp = new RegExp("##" + cname + "##", 'g');
                cat_name = cat_name.replace(regExp,'<span style="text-decoration:underline;">'+cname+'</span>');               
                
                
                html += '<li class="our-collections" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourCollections[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-our-collection-option-list"]').html(html);
            //$('[data-action="global-search-our-collections"]').parent().show();
        }
        if (data.data.collection == undefined) {
            $('[data-action="global-search-collections"] span').html('Our Hotel (0)');
        }else{
            console.log(data.data.collection);
            //console.log(html);
            var html ='';
            var collString = (data.data.collection.length > 1) ? "Our Hotels" : "Our Hotel";
            $('[data-action="global-search-collections"] span').html(collString + ' ('+data.data.collection.length+')');
            $(data.data.collection).each(function (i, val) {
                var  linkMenu = BaseURL1+'/'+val.property_slug;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
                
                var cat_name = val.property_name;
                var cname = searcValue;
                var arr_str = cname.split(',');
                $.each(arr_str, function(key, value){
                    if($.trim(value)!=''){
                        var regExp = new RegExp("" + $.trim(value) + "", 'gi');
                        cat_name = cat_name.replace(regExp,'<span style="text-decoration:underline;">'+$.trim(value)+'</span>');
                    }
                });
                var h_cat_name = val.property_name;
                var r_h_cat_name = h_cat_name.replace(/ /gi, '-');
                html += '<li class="our-hotels our-hotels-'+r_h_cat_name+'" data-name="'+ val.property_name +'">' + cat_name + '<input type="checkbox" name="ourHotels[]" value="'+ val.property_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-collection-option-list"]').html(html);
            //$('[data-action="global-collections"]').parent().show();
        }
        if (data.data.dest == undefined) {
            $('[data-action="global-search-destinations"] span').html('Our Destination (0)');
        }else {
            var html ='';
            var destString = (data.data.dest.length > 1) ? "Our Destinations" : "Our Destination";
            $('[data-action="global-search-destinations"] span').html(destString + ' ('+data.data.dest.length+')');
            $(data.data.dest).each(function (i, val) {
                var  linkMenu = BaseURL1+'/luxury_destinations/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                
                var cat_name = val.category_name;
                var cname = searcValue;
                var arr_str = cname.split(',');
                $.each(arr_str, function(key, value){ 
                    if($.trim(value)!=''){
                        var regExp = new RegExp("" + $.trim(value) + "", 'gi');
                        cat_name = cat_name.replace(regExp,'<span style="text-decoration:underline;">'+$.trim(value)+'</span>');
                    }
                });
                var h_cat_name = val.category_name;
                var r_h_cat_name = h_cat_name.replace(/ /gi, '-');
                html += '<li class="our-destinations our-destinations-'+r_h_cat_name+'" data-name="'+ val.category_name +'">' + cat_name + ' (' + val.p_name + ')<input type="checkbox" name="ourDestinations[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-dest-option-list"]').html(html);
            //$('[data-action="global-destinations"]').parent().show();
        }
        
        if (data.data.experiences == undefined) { 
            $('[data-action="global-search-experiences"] span').html('Our Experience (0)');
        } else { 
            var html ='';
            var restroString = (data.data.experiences.length > 1) ? "Our Experiences" : "Our Experience";
            $('[data-action="global-search-experiences"] span').html(restroString + ' ('+data.data.experiences.length+')');
            $(data.data.experiences).each(function (i, val) {
                var  linkMenu = BaseURL1+'/luxury_experience/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-experiences" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourExperiences[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-experience-option-list"]').html(html);
            //$('[data-action="global-restaurant"]').parent().show();
        }
        if (data.data.dest == undefined) {
            $('[data-action="global-search-destination-channels"] span').html('Our Channel (0)');
        } else {
            var html ='';
            var barString = (data.data.dest.length > 1) ? "Our Channels" : "Our Channel";
            $('[data-action="global-search-destination-channels"] span').html(barString + ' ('+data.data.dest.length+')');
            $(data.data.dest).each(function (i, val) {
                var  linkMenu = BaseURL1+'/social-youtube/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-channels" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourChannels[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-dest-channel-option-list"]').html(html);
            //$('[data-action="global-bar"]').parent().show();
        }
    };
    doAjax(params);
    $('[data-option="global-search"]').slideDown(300);
}

/*
* For Global Search function
*/
/*function globalSearchForAll(searcValue) {
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
}*/


/****** Global search all function *******/
$(document).on('click', '.close_btn', function () {
    $(".cstm_search").hide();
});
$(document).on('click', '.whengo', function(e){  
    e.preventDefault();
    $(".questions .global-search").toggle();
    
});
/****** End global search all function *******/
$(document).on('click', "#pills-home-tab", function(){
    $("#sitename").val('voyage');
    $("#globalfiltersearchpopup").css('display', 'none'); 
    $('[data-action="global-search"]').val('');     
});
$(document).on('click', "#pills-profile-tab", function(){
    $("#sitename").val('safari');   
    $("#globalfiltersearchpopup").css('display', 'none');
    $('[data-action="global-search"]').val('');     
});
$(document).on('click', "#pills-contact-tab", function(){
    $("#sitename").val('spa');
    $("#globalfiltersearchpopup").css('display', 'none'); 
    $('[data-action="global-search"]').val('');        
});
$(document).on('click', "#pills-expereince-tab", function(){
    $("#sitename").val('islands');
    $("#globalfiltersearchpopup").css('display', 'none');
    $('[data-action="global-search"]').val('');          
});

$(document).on('click', '.our-collections', function(){         
    if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('input[type="radio"]').attr('checked', false);
    }else{
        $(this).addClass('active');
        $(this).find('input[type="radio"]').attr('checked', true);
    }
});
var arrhotels = [];
var _hid_our_hotels = $('#hid_our_hotels').val();
if(_hid_our_hotels!=''){
    var _spl_hotel= _hid_our_hotels.split(',');
    if(_spl_hotel.length > 0){
        for(i=0; i<_spl_hotel.length; i++){
            arrhotels.push(_spl_hotel[i]);        
        }
    }
}
//console.log(arrhotels);
$(document).on('click', '.our-hotels', function(e){     
     if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('input[type="checkbox"]').attr('checked', false);
        var _hotel = $(this).find('input[type="checkbox"]').val();        
        arrhotels.splice($.inArray(_hotel, arrhotels), 1);        
     }else{            
        $(this).addClass('active');
        $(this).find('input[type="checkbox"]').attr('checked', true);
        var _hotel = $(this).find('input[type="checkbox"]').val();        
        arrhotels.push(_hotel);        
     }
     //console.log(arrhotels);
     $(".selected-hotels").html('');
     $('#hid_our_hotels').val(arrhotels);
     var sel_hotel = $('#hid_our_hotels').val();     
     $str_htl = '';
     if($.isArray(sel_hotel)){ }  
     var spl_hotel = sel_hotel.split(',');
     if(spl_hotel.length > 0){
        for(i=0; i<spl_hotel.length; i++){
            if(spl_hotel[i]!=''){
                $str_htl += '<span class="selected-hotels">'+spl_hotel[i]+'<span class="remove removehotel" data-name="'+spl_hotel[i]+'">x</span></span>';
            }        
        }
     }
     $(".selected-hotels").html($str_htl); 
     e.stopPropagation();  
});
var arrdestinations = [];
var _hid_our_destinations = $('#hid_our_destinations').val();
if(_hid_our_destinations!=''){
    var _spl_destinations = _hid_our_destinations.split(',');
    if(_spl_destinations.length > 0){
        for(i=0; i<_spl_destinations.length; i++){
            arrdestinations.push(_spl_destinations[i]);        
        }
    }
}
$(document).on('click', '.our-destinations', function(e){         
     if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('input[type="checkbox"]').attr('checked', false);
        var _dest = $(this).find('input[type="checkbox"]').val();        
        arrdestinations.splice($.inArray(_dest, arrdestinations), 1);     
     }else{
        $(this).addClass('active');
        $(this).find('input[type="checkbox"]').attr('checked', true);        
        var _dest = $(this).find('input[type="checkbox"]').val();        
        arrdestinations.push(_dest); 
     }
     //console.log(arrhotels);
     $('#hid_our_destinations').val(arrdestinations);
     var sel_dest = $('#hid_our_destinations').val();
     console.log(sel_dest);
     str_dest = '';
     if($.isArray(sel_dest)){ }  
     var spl_dest = sel_dest.split(',');
     if(spl_dest.length > 0){
        for(i=0; i<spl_dest.length; i++){
            str_dest += '<span class="selected-destinations">'+spl_dest[i]+'<span class="remove removedestination" data-name="'+spl_dest[i]+'">x</span></span>';        
        }
     }
     $(".selected-destinations").html(str_dest);  
     e.stopPropagation(); 
});

$(document).on('click', '.our-experiences', function(){         
     if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('input[type="radio"]').attr('checked', false);
     }else{
        $(this).addClass('active');
        $(this).find('input[type="radio"]').attr('checked', true);
     }
});

$(document).on('click', '.our-channels', function(){         
     if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('input[type="radio"]').attr('checked', false);
     }else{
        $(this).addClass('active');
        $(this).find('input[type="radio"]').attr('checked', true);
     }
});
$(document).on('click', '.t-check-in', function(){
   $("#globalfiltersearchpopup").css('display', 'none'); 
});
$(document).on('click', '[data-action="global-search"]', function (e) {
    var hote_or_dest_has_value = $('input[name="hote_or_dest_has_value"]').val();
    if(hote_or_dest_has_value==1){
        $("#globalfiltersearchpopup").css('display', ''); 
    } 
    $(".chooseadultroom").css('display', 'none');
    //$("#globalfiltersearchpopup").css('display', 'none');
    $('.gs-searchbar-main-collection').css('display', 'none');
    $(".gs-main-collection").css('display', 'none');
    e.stopPropagation();
});
$(document).on('submit', '.global-search-form', function(){
    
    var site_name = $("#sitename").val();
    var arrive = $('input[name="gl_arrive"]').val();
    var departure = $('input[name="gl_departure"]').val();
    
    var jarrive = new Date(arrive);
    var jdeparture = new Date(departure);    
    var date_diff = jdeparture - jarrive;
    var millisecondsPerDay = 1000 * 60 * 60 * 24;
    var days = Math.floor(date_diff/millisecondsPerDay);
    console.log(days);
    //console.log(date_diff);
    //console.log()
    //console.log(jarrive);
    //console.log(jdeparture);
    //console.log(arrive);
    //console.log(departure);
    if(site_name=="safari"){
        if(days>=2){ 
            //$('.global-search-form').submit();        
        }else{
            $(".min-stay-error").html('');
            $(".min-stay-error").css('display', '');
            $(".min-stay-error").html("Please select min two days stay");
            return false; 
            //alert("Please select min two days stay");    
        }        
    }else if(site_name=="islands"){
        if(days>=3){ 
            //$('.global-search-form').submit();        
        }else{
            $(".min-stay-error").html('');
            $(".min-stay-error").css('display', '');
            $(".min-stay-error").html("Please select min three days stay");
            return false; 
            //alert("Please select min two days stay");    
        }               
    }
           
});
$(document).on('click', '.removehotel', function(){
    var name = $(this).attr('data-name');
    
    var sel_hotel = $('#hid_our_hotels').val();
     
     $str_htl = '';
     if($.isArray(sel_hotel)){ }  
     var spl_hotel = sel_hotel.split(',');
     
     spl_hotel.splice($.inArray(name, spl_hotel), 1); 
     arrhotels.splice($.inArray(name, arrhotels), 1); 
     $('#hid_our_hotels').val(spl_hotel);
     if(spl_hotel.length > 0){
        for(i=0; i<spl_hotel.length; i++){
            $str_htl += '<span class="selected-hotels">'+spl_hotel[i]+'<span class="remove removehotel" data-name="'+spl_hotel[i]+'">x</span></span>';        
        }
     }
     $(".selected-hotels").html($str_htl);   
     var r_name = name.replace(/ /gi, '-');
     
     $(".our-hotels-"+r_name).removeClass('active');    
});
$(document).on('click', '.removedestination', function(){
    var name = $(this).attr('data-name');
    
    var sel_dest = $('#hid_our_destinations').val();
     
     str_dest = '';
     if($.isArray(sel_dest)){ }  
     var spl_dest = sel_dest.split(',');
     
     spl_dest.splice($.inArray(name, spl_dest), 1); 
     arrdestinations.splice($.inArray(name, arrdestinations), 1); 
     $('#hid_our_destinations').val(spl_dest);
     if(spl_dest.length > 0){
        for(i=0; i<spl_dest.length; i++){
            str_dest += '<span class="selected-destinations">'+spl_dest[i]+'<span class="remove removedestination" data-name="'+spl_dest[i]+'">x</span></span>';        
        }
     }
     $(".selected-destinations").html(str_dest);   
     var r_name = name.replace(/ /gi, '-');
     
     $(".our-destinations-"+r_name).removeClass('active');    
});

$(document).on('click', '.viewModifyCancel', function(){
    $(".clicktologin").trigger("click");
});
$(document).on('click', '.sidebar-availability', function(){
    //$(".cstm_search").toggle();
    window.location.reload(BaseURL);
    $(".t-check-in").trigger('click');
});
$(document).on('click', '.sidebar-dest-remove', function(){
    var nm = $(this).attr('data-name');
    $(".right-"+nm).css('display', 'none');
    $(this).css('display', 'none');
    //console.log(nm); 
});
$(document).on('click', '.top-menu-login', function(){    
    $(".clicktologin").trigger("click");    
});
$(document).on('click', '.gs-top-what-collection', function(e){
    $(".gs-main-collection").toggle();
    $(".gs-main-user-collection").css('display', 'none');
    $(".chooseadultroom").css('display', 'none');
    $("#globalfiltersearchpopup").css('display', 'none');
    $('.gs-searchbar-main-collection').css('display', 'none');
    //$(".gs-main-collection").css('display', 'none');
      
    e.stopPropagation();
});
$(document).on('click', '.top-menu-user', function(e){
    $(".gs-main-user-collection").toggle();    
    $(".gs-main-collection").css('display', 'none');      
    $(".chooseadultroom").css('display', 'none');
    $("#globalfiltersearchpopup").css('display', 'none');
    $('.gs-searchbar-main-collection').css('display', 'none');
    //$(".gs-main-collection").css('display', 'none');
      
    e.stopPropagation();
});
$(document).on('click', '.collection', function(e){ console.log("hello");
    $('.gs-searchbar-main-collection').toggle(); 
    
    $(".chooseadultroom").css('display', 'none');
    $("#globalfiltersearchpopup").css('display', 'none');
    //$('.gs-searchbar-main-collection').css('display', 'none');
    $(".gs-main-collection").css('display', 'none');
        
    e.stopPropagation();
});
$(document).on('click', '.sidebar-hotel-remove', function(){
    var nm = $(this).attr('data-name');    
});
$(document).on('click', '.gs-top-bar-collection', function(e){
    $(".gs-searchbar-main-collection").toggle();  
    e.stopPropagation();      
});
$(document).on('click', '.when-coll', function(e){
    
    e.stopImmediatePropagation();    
});
$(document).on('click', '.gs-lnk-destination', function(e){
    //$( this ).toggleClass( "highlight" );
    $(".homerightmenu").addClass("me-right");
    $(".mobilemenu").addClass("me-left");
    $(".menu-bx").addClass( "is-nav-active"); 
    $(".Home .logo-box").addClass( "remove-h-logo");
    $('[data-action="select-destination"]').trigger('click');
    e.stopPropagation(); 
});
$(document).on('click', '.gs-lnk-experience', function(e){
    //$( this ).toggleClass( "highlight" );
    $(".homerightmenu").addClass("me-right");
    $(".mobilemenu").addClass("me-left");
    $(".menu-bx").addClass( "is-nav-active"); 
    $(".Home .logo-box").addClass( "remove-h-logo");
    $('[data-action="select-experience"]').trigger('click');
    e.stopPropagation(); 
});