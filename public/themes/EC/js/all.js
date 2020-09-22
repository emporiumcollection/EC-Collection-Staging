(function($) {

  $.fn.niceSelect = function(method) {
    
    // Methods
    if (typeof method == 'string') {      
      if (method == 'update') {
        this.each(function() {
          var $select = $(this);
          var $dropdown = $(this).next('.nice-select');
          var open = $dropdown.hasClass('open');
          
          if ($dropdown.length) {
            $dropdown.remove();
            create_nice_select($select);
            
            if (open) {
              $select.next().trigger('click');
            }
          }
        });
      } else if (method == 'destroy') {
        this.each(function() {
          var $select = $(this);
          var $dropdown = $(this).next('.nice-select');
          
          if ($dropdown.length) {
            $dropdown.remove();
            $select.css('display', '');
          }
        });
        if ($('.nice-select').length == 0) {
          $(document).off('.nice_select');
        }
      } else {
        console.log('Method "' + method + '" does not exist.');
      }
      return this;
    }
      
    // Hide native select
    this.hide();
    
    // Create custom markup
    this.each(function() {
      var $select = $(this);
      
      if (!$select.next().hasClass('nice-select')) {
        create_nice_select($select);
      }
    });
    
    function create_nice_select($select) {
      $select.after($('<div></div>')
        .addClass('nice-select')
        .addClass($select.attr('class') || '')
        .addClass($select.attr('disabled') ? 'disabled' : '')
        .attr('tabindex', $select.attr('disabled') ? null : '0')
        .html('<span class="current"></span><ul class="list"></ul>')
      );
        
      var $dropdown = $select.next();
      var $options = $select.find('option');
      var $selected = $select.find('option:selected');
      
      $dropdown.find('.current').html($selected.data('display') || $selected.text());
      
      $options.each(function(i) {
        var $option = $(this);
        var display = $option.data('display');

        $dropdown.find('ul').append($('<li></li>')
          .attr('data-value', $option.val())
          .attr('data-display', (display || null))
          .addClass('option' +
            ($option.is(':selected') ? ' selected' : '') +
            ($option.is(':disabled') ? ' disabled' : ''))
          .html($option.text())
        );
      });
    }
    
    /* Event listeners */
    
    // Unbind existing events in case that the plugin has been initialized before
    $(document).off('.nice_select');
    
    // Open/close
    $(document).on('click.nice_select', '.nice-select', function(event) {
      var $dropdown = $(this);
      
      $('.nice-select').not($dropdown).removeClass('open');
      $dropdown.toggleClass('open');
      
      if ($dropdown.hasClass('open')) {
        $dropdown.find('.option');  
        $dropdown.find('.focus').removeClass('focus');
        $dropdown.find('.selected').addClass('focus');
      } else {
        $dropdown.focus();
      }
    });
    
    // Close when clicking outside
    $(document).on('click.nice_select', function(event) {
      if ($(event.target).closest('.nice-select').length === 0) {
        $('.nice-select').removeClass('open').find('.option');  
      }
    });
    
    // Option click
    $(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function(event) {
      var $option = $(this);
      var $dropdown = $option.closest('.nice-select');
      
      $dropdown.find('.selected').removeClass('selected');
      $option.addClass('selected');
      
      var text = $option.data('display') || $option.text();
      $dropdown.find('.current').text(text);
      
      $dropdown.prev('select').val($option.data('value')).trigger('change');
    });

    // Keyboard events
    $(document).on('keydown.nice_select', '.nice-select', function(event) {    
      var $dropdown = $(this);
      var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));
      
      // Space or Enter
      if (event.keyCode == 32 || event.keyCode == 13) {
        if ($dropdown.hasClass('open')) {
          $focused_option.trigger('click');
        } else {
          $dropdown.trigger('click');
        }
        return false;
      // Down
      } else if (event.keyCode == 40) {
        if (!$dropdown.hasClass('open')) {
          $dropdown.trigger('click');
        } else {
          var $next = $focused_option.nextAll('.option:not(.disabled)').first();
          if ($next.length > 0) {
            $dropdown.find('.focus').removeClass('focus');
            $next.addClass('focus');
          }
        }
        return false;
      // Up
      } else if (event.keyCode == 38) {
        if (!$dropdown.hasClass('open')) {
          $dropdown.trigger('click');
        } else {
          var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
          if ($prev.length > 0) {
            $dropdown.find('.focus').removeClass('focus');
            $prev.addClass('focus');
          }
        }
        return false;
      // Esc
      } else if (event.keyCode == 27) {
        if ($dropdown.hasClass('open')) {
          $dropdown.trigger('click');
        }
      // Tab
      } else if (event.keyCode == 9) {
        if ($dropdown.hasClass('open')) {
          return false;
        }
      }
    });

    // Detect CSS pointer-events support, for IE <= 10. From Modernizr.
    var style = document.createElement('a').style;
    style.cssText = 'pointer-events:auto';
    if (style.pointerEvents !== 'auto') {
      $('html').addClass('no-csspointerevents');
    }
    
    return this;

  };

}(jQuery));

(function() {
  'use strict';
  $(this).scrollTop(0);
  var owl = $('.landing-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    items:1,
    autoplay: true,
    autoplayTimeout: 5000,
    mouseDrag: false,
    touchDrag: false,
    dots: true,
    dotsContainer: '#carousel-custom-dots',
    transitionStyle : "fade",
    animateOut: 'fadeOut',
          animateIn: 'fadeIn',
  });

  $('.owl-dots').on('click', 'li', function(e) {
    owl.trigger('to.owl.carousel', [$(this).index(), 300]);
  });

  $('.info-page-slide').owlCarousel({
    loop:false,
    nav:true,
    items:1,
    dots: false,
  });
  
  $('.amenities-slider').owlCarousel({
    loop:false,
    nav:true,
    items:2,
    dots: false,
    margin: 20,
  });
  $('.feature').owlCarousel({
    loop:false,
    nav:true,
    items:3,
    dots: false,
  });
  $('.feature-img-slide').owlCarousel({
    loop:false,
    nav:true,
    items:1,
    dots: false,
  });
  $('.lifestyle-slider').owlCarousel({
    loop:false,
    nav:true,
    items:1,
    dots: false,
    
  });

  $('.losl').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    console.log('beforeChange', currentSlide, nextSlide);
  });
  $('.losl').on('afterChange', function(event, slick, currentSlide){
    console.log('afterChange', currentSlide);
  });
      
  $('.feature-slide').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    items:1,
    dots: false,
  });
  $('.deal-slide').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    items:1,
    dots: true,
  });

  $('.fav-slider').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    items:8,
    dots: false,
    center: true,
    navText: ["<span class='prev-btn'><img src='images/ico-arrow.svg'></span>","<span class='next-btn'><img src='images/ico-arrow.svg'></span>"]
  });

  $('.hotel-cat').owlCarousel({
    loop:false,
    margin:15,
    nav:true,
    items:3,
    dots: false,
  });

  var $hh = $('.hotel-list-slide').owlCarousel({
    loop:true,
    margin:15,
    nav:true,
    items:1,
    dots: false,
  });

  $(".left-side").hover(function(){ 
    $(".right-side").css("opacity", "0.2");
    $(".left-side").css("opacity", "1");
  });

  $(".right-side").hover(function(){ 
    $(".left-side").css("opacity", "0.2");
    $(".right-side").css("opacity", "1");
    $(".main-right").css("opacity", "1");
  });


  $(".left-side").hover(function(){ 
    $(".right-side").css("opacity", "0.2");
    $(".left-side").css("opacity", "1");
  });

  $('#tabs .tab-link').click(function(e){
    e.preventDefault();
    $(".right-side").css("opacity", "1");
    $('#tabs .tab-link').removeClass('active');
    $(this).addClass('active');
    var t = $(this).attr('data-link');
    $('.tab-em').removeClass('active animated fadeIn');
    $(t).addClass('active animated fadeIn');
  });

  $('#tabs-nav .tab-link').click(function(e){
    e.preventDefault();
    $('#tabs-nav .tab-link').removeClass('active');
    $(this).addClass('active');
    var t = $(this).attr('data-link');
    $('.tab-em-nav').removeClass('active animated fadeIn');
    $(t).addClass('active animated fadeIn');
    $(".main-right").css("opacity", "0.2");
    $('.fav-slider-top').removeClass('active animated fadeIn');
    $('.content').css('height', 'calc(100vh - 111px)');
    $('.calendar-btn').removeClass('active');
  });
  $(document).on('click', '#tabs-nav .tab-link', function(){
    $(".left-side").css("opacity", "1");
  });

  $('.fullpage').click(function(e){
    e.preventDefault();
    var df = $(this).attr('data-fullpage');
    $(df).addClass('active animated fadeIn');

  });

  $('.close-fullpage').click(function(){
    $(this).closest('.fullpage-content').removeClass('active animated fadeIn');
  });
 
  $('.favoicon').click(function(){
    $(this).toggleClass('on');
  });

  $('.btn-favorite').click(function(e){
    e.preventDefault();
    $(this).closest('.favoicon').toggleClass('on');
  });

  $('.page-close').click(function(e){
    e.preventDefault();
    $('#tabs-nav .tab-link').removeClass('active');
    var t = $(this).attr('data-link');
    $('.tab-em-nav').removeClass('active animated fadeIn');
    $(t).addClass('active animated fadeIn');
    $('.calendar-btn').removeClass('active');
    $('.fav-slider-top').removeClass('active');
    $('.content').css('height', 'calc(100vh - 111px)');
  });

  $('.search').click(function(e){
    e.preventDefault();
    $('.search-left').addClass('active');
    $('.searchfield').addClass('active');
    $('.searchfield input').focus();
  });

  
  $('.search-filter').click(function(){
    var cls = $(this).closest('.header-main');
    var menuBtn = $(".menu-btn");
    cls.find('.logo-2').hide();
    cls.find('#tabs-nav a').not(menuBtn).hide();
    menuBtn.addClass('close-search close-search-filter');
    menuBtn.find('.ico').removeClass('ico-menu-b').addClass('ico-close');
    $('.filter-price').hide();
  });

  $('.header-main').on('click', '.close-search-filter', function(){
    var cls = $(this).closest('.header-main');
    var menuBtn = $(".menu-btn");
    cls.find('.logo-2').show();
    cls.find('#tabs-nav a').show();
    menuBtn.removeClass('close-search close-search-filter');
    menuBtn.find('.ico').removeClass('ico-close').addClass('ico-menu-b');
    $('.search-left').removeClass('active');
    $('.filter-price').show();
  });


  $('.search--092092').click(function(e){
    e.preventDefault();
    $('.search-ico-lst').toggleClass('show');
  });
  $('.close-search').click(function(e){
    e.preventDefault();
    $('.search-left').removeClass('active');
    $('.searchfield').removeClass('active');
  });

  $('.fav-btn').click(function(){
    $('.fav-slider-top').addClass('active animated fadeIn');
    $('.calendar-btn').addClass('active');
    $('.content').css('height', 'calc(100vh - 200px)');
    $hh.trigger('refresh.owl.carousel');
  });

  $('.search-fl').click(function(){
    $('.search-landing i').addClass('ico-search').removeClass('ico-search-w');
    $('.mc-fl i').addClass('ico-mic').removeClass('ico-mic-w');
    $('.menu-fl i').addClass('ico-menu-b').removeClass('ico-menu');
    $('.menu-fl-2 i').addClass('ico-user-single-2').removeClass('ico-user-single');
    $('.t-logo').addClass('logo-2').removeClass('logo');
    $('.header-w-search').addClass('bg-white');
  });
  $('.close-in').click(function(){
    $('.search-landing i').addClass('ico-search-w').removeClass('ico-search');
    $('.mc-fl i').addClass('ico-mic-w').removeClass('ico-mic');
    $('.menu-fl i').addClass('ico-menu').removeClass('ico-menu-b');
    $('.menu-fl-2 i').addClass('ico-user-single').removeClass('ico-user-single-2');

    $('.t-logo').addClass('logo').removeClass('logo-2');
    $('.header-w-search').removeClass('bg-white');

  });

  $('#tabs-nav .tab-compare').click(function(e){
    e.preventDefault();
    var t = $(this).attr('data-compare');
    $(t).addClass('active animated fadeIn');
  });

  $(document).on('keyup', '.where', function () {
    
        //var sitename = $("#sitename").val();
        var sitename = "voyage";
        $('[data-action="global-search-error"]').html('');
        
        if ($(this).val() == '') {
            $('.wherepopup').hide();
            $('.wherepopup').slideUp(300);
        } else {
            
                //console.log(BaseURL);                
                
        		var fvalue = $(this).val();
                //console.log(fvalue);
        		
        		if(fvalue.length > 2)
        		{     
                    //clearTimeout(timeout);
                    //timeout = setTimeout(function () {
            			globalSearchForAll(fvalue, sitename);                
                        //$('input[name="hote_or_dest_has_value"]').val(1);
                    //}, 500);
        		}else{
        		    //$('input[name="hote_or_dest_has_value"]').val('');  
        		}
            
            
            $('.wherepopup').show();
        }
 
  });
 
  
  function globalSearchForAll(searcValue, sitename) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: BaseURL + '/destination/global-search',
        type: "get",
        dataType: "json",
        data: {'keyword':searcValue, 'sitename':sitename, '_token':_token},
        success: function (data){ 
            
            if(data.status=='success'){                
                var obj = data.data;
                var voyage = obj.voyage;
                var spa = obj.spa;
                var safari = obj.safari;                
                var island = obj.island;
                
                var html_hotel = "";
                var html_destination = "";
                
                if(voyage.collection != undefined){
                    $(voyage.collection).each(function(key, val){                       
                       html_hotel += '<li class="nav-item"><a class="nav-link" href="#" data-type="hotel" data-collection="voyage"><span class="city-l">'+val.property_name+'</span> <span class="cat-l">Voyage</span></a></li>';
                    });
                }
                if(voyage.dest != undefined){
                    $(voyage.dest).each(function(key, val){                       
                       html_destination += '<li class="nav-item"><a class="nav-link" href="#" data-type="destination" data-collection="voyage"><span class="city-l">'+val.category_name+'</span> <span class="cat-l">Voyage</span></a></li>';
                    });
                }
                if(spa.collection != undefined){
                    $(spa.collection).each(function(key, val){                       
                       html_hotel += '<li class="nav-item"><a class="nav-link" href="#" data-type="hotel" data-collection="spa"><span class="city-l">'+val.property_name+'</span> <span class="cat-l">Spa</span></a></li>';
                    });
                }
                if(spa.dest != undefined){
                    $(spa.dest).each(function(key, val){                       
                       html_destination += '<li class="nav-item"><a class="nav-link" href="#" data-type="destination" data-collection="spa"><span class="city-l">'+val.category_name+'</span> <span class="cat-l">Spa</span></a></li>';
                    });
                }
                if(safari.collection != undefined){
                    $(safari.collection).each(function(key, val){                       
                       html_hotel += '<li class="nav-item"><a class="nav-link" href="#" data-type="hotel" data-collection="safari"><span class="city-l">'+val.property_name+'</span> <span class="cat-l">Safari</span></a></li>';
                    });
                }
                if(safari.dest != undefined){
                    $(safari.dest).each(function(key, val){                       
                       html_destination += '<li class="nav-item"><a class="nav-link" href="#" data-type="destination" data-collection="safari"><span class="city-l">'+val.category_name+'</span> <span class="cat-l">Safari</span></a></li>';
                    });
                }
                if(island.collection != undefined){
                    $(island.collection).each(function(key, val){                       
                       html_hotel += '<li class="nav-item"><a class="nav-link" href="#"  data-type="hotel" data-collection="islands"><span class="city-l">'+val.property_name+'</span> <span class="cat-l">Islands</span></a></li>';
                    });
                }
                if(island.dest != undefined){
                    $(island.dest).each(function(key, val){                       
                       html_destination += '<li class="nav-item"><a class="nav-link" data-type="destination"  data-collection="islands" href="#"><span class="city-l">'+val.category_name+'</span> <span class="cat-l">Islands</span></a></li>';
                    });
                }
                //} 
            }
            $('.wherepopup .where-destination').html(html_destination);
            $('.wherepopup .where-hotel').html(html_hotel);
            /*if (data.data.collection == undefined) {
                console.log("no record found");
            }else{
                console.log(data.data.collection);
                //console.log(html);
                var BaseURL1 = '';
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
                
                var html ='';
                //var collString = (data.data.collection.length > 1) ? "Our Hotels" : "Our Hotel";
                //$('[data-action="global-search-collections"] span').html(collString + ' ('+data.data.collection.length+')');
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
                    //html += '<li class="our-hotels our-hotels-'+r_h_cat_name+'" data-name="'+ val.property_name +'">' + cat_name + '<input type="checkbox" name="ourHotels[]" value="'+ val.property_name +'" class="invisible"></li>';
                    
                    html += '<li class="nav-item"><a class="nav-link" href="#"><span class="city-l">'+ val.property_name +'</span> <span class="cat-l">' + cat_name + '</span></a></li>';
                    
                });
                $('.wherepopup .whereul').html(html);
                //$('[data-action="global-collections"]').parent().show();
            } */                     
        }
    });
    
    /*var datObj = {};
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
    $('[data-option="global-search"]').slideDown(300);*/
}

  

  $('.wherepopup .nav-link').click(function(){
    var asd = $(this).find('.city-l').html();
    $('.where').val(asd);
    $(this).closest('.where-container').removeClass('show');
    $('.when-container').addClass('show');
    $('.wherepopup').hide();
  });
  
  $(document).on('click', '.wherepopup .nav-link', function(){
    var asd = $(this).find('.city-l').html();
    $('.where').val(asd);
    $(this).closest('.where-container').removeClass('show');
    $('.when-container').addClass('show');
    $('.wherepopup').hide(); 
    var _type = $(this).attr('data-type');
    var _collection = $(this).attr('data-collection');
    $("#sitename").val(_collection);
    $("#coll_type").val(_type);
    get_featured_prop(_type, _collection);
    $('.quick-prev-when1').slick({
                    slidesToShow: 1,
                    prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                });
  });
  
  function get_featured_prop(_type, _collection){
    var _token = $('meta[name="csrf-token"]').attr('content');
    //console.log(BaseURL);
    $.ajax({
        url: BaseURL + '/property/featuredproperties',
        type: "get",
        dataType: "json",
        data: {'type':_type, 'collection':_collection, '_token':_token},
        success: function (data){             
            if(data.status == "success"){          
                var obj1 = data.data[0];            
                var objproppath = obj1.thumb;
                var objpropimg = obj1.propimage;            
                var img1_path = objproppath +'/'+ objpropimg[0].file_name;
                var img2_path = objproppath +'/'+ objpropimg[1].file_name;
                //console.log(img1_path);
                $("#left-when-featured-img1").attr('src', img1_path);
                $("#left-when-featured-img2").attr('src', img2_path);            
                var objprop = obj1.objprop;
                $("#left-when-featured-text").html(objprop.property_usp);
                $(".when-hotel-name").html(objprop.property_name);
                var whensimage = '';
                for(var i=1; i<4; i++){
                    var ipath = objproppath +'/'+ objpropimg[i].file_name;
                    whensimage += '<div><img src="'+ipath+'" class="img-fluid" alt=""></div>'; 
                }  //console.log(whensimage);
                $(".when-quick-prev").html(whensimage);
                
                var obj2 = data.data[1];
                var objproppathwho = obj2.thumb;
                var objpropimgwho = obj2.propimage;
                var img2_path = objproppathwho +'/'+ objpropimgwho[0].file_name;
                $("#left-who-featured-img1").attr('src', img2_path);            
                var objprop2 = obj2.objprop;
                $("#left-who-featured-text").html(objprop2.property_usp);
                $(".who-hotel-name").html(objprop2.property_name);
                
                var whosimage = '';
                for(var i=1; i<4; i++){
                    var ipath2 = objproppathwho +'/'+ objpropimgwho[i].file_name;
                    whosimage += '<div><img src="'+ipath2+'" class="img-fluid" alt=""></div>'; 
                }  //console.log(whosimage);
                $(".who-quick-prev").html(whosimage);   
                
                $('.quick-prev-when1').slick('unslick');
                $('.quick-prev-when1').slick({
                    slidesToShow: 1,
                    prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                    nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                });      
            }
        }
    });
  }
  
  $(document).mouseup(function(event){
    var $trigger = $(".wherepopup");
    if($trigger !== event.target && !$trigger.has(event.target).length){
      $('.wherepopup').hide();
    }            
  });

  $('.step-3').click(function(){
    $(this).closest('.when-container').removeClass('show');

    $('.who-container').addClass('show');
  });

  $('.all-drop').click(function(e){
    e.preventDefault();
    $('.all-result').fadeIn();
  });

  $(document).mouseup(function(event){
    var $trigger = $(".all-result");
    if($trigger !== event.target && !$trigger.has(event.target).length){
      $('.all-result').fadeOut();
    }            
  });

  $('.field-count .plus').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
  });
  $('.field-count .min').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
      }
  });

  $(document).on('click', '.field-count-guest .plus', function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    var obj_adult = $(this).prev().find('.inp-adult');
    if(obj_adult.length > 0){
        var _adval = $(this).prev().find('.inp-adult').val();
        $(this).prev().find('.inp-adult').val(parseInt(_adval)+1)
//        console.log(_adval);
//        console.log('_adval');
    }
    var obj_child = $(this).prev().find('.inp-child');
    if(obj_child.length > 0){
        var _chval = $(this).prev().find('.inp-child').val();
        $(this).prev().find('.inp-child').val(parseInt(_chval)+1)
        //console.log(_chval);
        //console.log('_chval');
    }
    $(this).closest('.field-count-guest').find('.min').removeClass('disable');
  });
  $(document).on('click', '.field-count-guest .min', function () { console.log('min');
      if($(this).next().find('.mr-1').html() > 0){ console.log('min in');
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        
        var obj_adult = $(this).next().find('.inp-adult');
        if(obj_adult.length > 0){
            var _adval = $(this).next().find('.inp-adult').val();
            $(this).next().find('.inp-adult').val(parseInt(_adval)-1)
            //console.log(_adval);
            //console.log('_adval');
        }
        var obj_child = $(this).next().find('.inp-child');
        if(obj_child.length > 0){
            var _chval = $(this).next().find('.inp-child').val();
            $(this).next().find('.inp-child').val(parseInt(_chval)-1)
            //console.log(_chval);
            //console.log('_chval');
        }
        
      }
      if($(this).next().find('.mr-1').html() < 1){
        $(this).closest('.field-count-guest').find('.min').addClass('disable');
      }
  });
  $(document).mouseup(function(event){
    var $trigger = $(".dropped");
    if($trigger !== event.target && !$trigger.has(event.target).length){
      $('.dropped').removeClass('active');
    }            
  });
  $('.data-drop').click(function(e){
    e.preventDefault();
    $('.dropped').addClass('active');
  })

  $('.save-filter-guest').click(function(e){
    e.preventDefault();
    $('.dropped').removeClass('active');
    $('.dropdown-menu').removeClass('show');
  })

  $('.gallerylink').click(function(e){
    e.preventDefault();
    var g = $(this).attr('data-popup');
    $(g).addClass('active animated fadeIn');
  })

  $('.popup-close').click(function(e){
    e.preventDefault();
    $('.popup').removeClass('active animated fadeIn');
  })

  $('.page-closeslide').click(function(e){
    e.preventDefault();
    $(this).parent().removeClass('active');
  })

  $('select').niceSelect();

  $('.my-tooltip .ico').hover(function(){
    var dt = $(this).attr('data-tool');
    $(dt).toggleClass('active');    
  })
  $('.dropprice').click(function(e) {
    e.stopPropagation();
  });
  $('.list-prs .btn-prc-title').click(function(e){
    e.preventDefault();
    var pp = $(this).attr('data-price');    
    $(pp).toggleClass('active');
    $(this).find('.arrow-down').toggleClass('toup');
  })

  $('.filter-tag').on('click', '.close-tag', function(e){
    e.preventDefault();
    $(this).closest('.filter-tag').remove();
    console.log('clicked');
    
  })
  $('.popup-close').click(function(e){
    e.preventDefault();
    $(this).closest('.compare-row').removeClass('active animated fadeIn');
  })

  $('.header-main').on('click', '.oncl', function(){
    $('.filter-container-fl').hide();
    var filterEl = $(this).attr('data-filter');
    $(filterEl).show();
    $('.search-left').addClass('active');
    var cls = $(this).closest('.header-main');
    var menuBtn = $(".menu-btn");
    cls.find('.logo-2').hide();
    cls.find('#tabs-nav a').not(menuBtn).hide();
    menuBtn.addClass('close-search close-search-filter');
    menuBtn.find('.ico').removeClass('ico-menu-b').addClass('ico-close');
    $('.filter-price').hide();
  });

  
  $('.heading-collsp').click(function(){
    $(this).closest('.collsp').toggleClass('show');
  })
  

  $('.first-option .nav-link').click(function(e){
    e.preventDefault();
    $('.arrow--12').addClass('arrow-right');
    $('.nav-link').removeClass('active');
    $(this).removeClass('arrow-right').addClass('active');
    $('.guest-option').removeClass('option--selected');
    var er = $(this).attr('data-guest');
    $(er).addClass("option--selected");
    $('.rto').hide();
    $('.first-option').removeClass('active');
    $(this).closest('.first-option').addClass('active');
  });

  var family = $('[data-guest=".family-option"]');
  var familyInput = $('.family-option');
  var group = $('[data-guest=".group-option"]');
  var groupInput = $('.group-option');
  var bussiness = $('[data-guest=".bussiness-option"]');
  var bussinessInput = $('.bussiness-option');
  $('.field-count-search .plus-room').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    // family.find('.room-count').html(function(i, val) { return val*1+1 });
    family.find('.room-count').html(function(i, val) { return val*1+1 });
    $(familyInput).find('.room-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-room').removeClass('disable');   
  });
  $('.field-count-search .min-room').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        family.find('.room-count').html(function(i, val) { return val*1-1 });
        $(familyInput).find('.room-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 2){
        $(this).closest('.field-count-search').find('.min-room').addClass('disable');
      }
  });

  // ----------  

  $('.field-count-search .plus-adult').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    family.find('.adult-count').html(function(i, val) { return val*1+1 });
    $(familyInput).find('.adult-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-adult').removeClass('disable');   
    
  });
  $('.field-count-search .min-adult').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        family.find('.adult-count').html(function(i, val) { return val*1-1 });
        $(familyInput).find('.adult-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 2){
        $(this).closest('.field-count-search').find('.min-adult').addClass('disable');
      }
  });

  // ----------   

  $('.field-count-search .plus-child').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    family.find('.child-count').html(function(i, val) { return val*1+1 });
    family.find('.child-before').addClass('show');
    $(familyInput).find('.child-before').addClass('show');
    $(familyInput).find('.child-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-child').removeClass('disable');   
  });
  $('.field-count-search .min-child').click(function () {
      if($(this).next().find('.mr-1').html() > 0){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        $(familyInput).find('.child-count').html(function(i, val) { return val*1-1 });
        family.find('.child-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 1){
        $(this).closest('.field-count-search').find('.min-child').addClass('disable');
        family.find('.child-before').removeClass('show');
        $(familyInput).find('.child-before').removeClass('show');
        
      }
  });

  $('.field-count-search .plus-group-room').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    // family.find('.room-count').html(function(i, val) { return val*1+1 });
    group.find('.room-count').html(function(i, val) { return val*1+1 });
    $(groupInput).find('.room-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-group-room').removeClass('disable');   
  });
  $('.field-count-search .min-group-room').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        group.find('.room-count').html(function(i, val) { return val*1-1 });
        $(groupInput).find('.room-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 2){
        $(this).closest('.field-count-search').find('.min-group-room').addClass('disable');
      }
  });

  // ----------  

  $('.field-count-search .plus-group-adult').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    group.find('.adult-count').html(function(i, val) { return val*1+1 });
    $(groupInput).find('.adult-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-group-adult').removeClass('disable');   
    
  });
  $('.field-count-search .min-group-adult').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        group.find('.adult-count').html(function(i, val) { return val*1-1 });
        $(groupInput).find('.adult-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 2){
        $(this).closest('.field-count-search').find('.min-group-adult').addClass('disable');
      }
  });

  // ----------   

  $('.field-count-search .plus-group-child').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    group.find('.child-count').html(function(i, val) { return val*1+1 });
    group.find('.child-before').addClass('show');
    $(groupInput).find('.child-before').addClass('show');
    $(groupInput).find('.child-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.field-count-search').find('.min-group-child').removeClass('disable');   
  });
  $('.field-count-search .min-group-child').click(function () {
      if($(this).next().find('.mr-1').html() > 0){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        $(groupInput).find('.child-count').html(function(i, val) { return val*1-1 });
        group.find('.child-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 1){
        $(this).closest('.field-count-search').find('.min-group-child').addClass('disable');
        group.find('.child-before').removeClass('show');
        $(groupInput).find('.child-before').removeClass('show');
      }
  });


  $('.bussiness-option .field-count-search .plus-bussiness-room').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    bussiness.find('.room-count').html(function(i, val) { return val*1+1 });
    $(bussinessInput).find('.room-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.bussiness-option .field-count-search').find('.min-bussiness-room').removeClass('disable');   
    
  });
  $('.bussiness-option .field-count-search .min-bussiness-room').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        bussiness.find('.room-count').html(function(i, val) { return val*1-1 });
        $(bussinessInput).find('.room-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 1){
        $(this).closest('.bussiness-option .field-count-search').find('.min-bussiness-room').addClass('disable');
      }
  });

  // ----------   

  $('.bussiness-option .field-count-search .plus-bussiness-adult').click(function () {
    $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
    bussiness.find('.adult-count').html(function(i, val) { return val*1+1 });
    $(bussinessInput).find('.adult-count').html(function(i, val) { return val*1+1 });
    $(this).closest('.bussiness-option .field-count-search').find('.min-bussiness-adult').removeClass('disable');   
    
  });
  $('.bussiness-option .field-count-search .min-bussiness-adult').click(function () {
      if($(this).next().find('.mr-1').html() > 1){
        $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
        bussiness.find('.adult-count').html(function(i, val) { return val*1-1 });
        $(bussinessInput).find('.adult-count').html(function(i, val) { return val*1-1 });
      }
      if($(this).next().find('.mr-1').html() < 1){
        $(this).closest('.bussiness-option .field-count-search').find('.min-bussiness-adult').addClass('disable');
      }
  });

  $('.field-count-guest .plus-room').click(function(){
    if($(this).prev().find('.mr-1').html() != 4 ){
      $(this).prev().find('.mr-1').html(function(i, val) { return val*1+1 });
      $(this).closest('.field-count-guest').find('.min-room').removeClass('disable');
      var curr = $(".col-ews");
      //console.log(curr);
      var currLength = curr.length + 1;
      var temp = '<div class="col-6 col-ews mb-3" id="room-'+ currLength +'">'+
          '<p><b>Suite '+ currLength +'</b></p>'+
          '<div class="row align-items-center py-2">'+
              '<div class="col-7">'+
                  '<p class="mb-0"><b>Adults</b></p>'+
              '</div>'+
              '<div class="col-5">'+
                  '<div class="row field-count-guest align-items-center">'+
                      '<button type="button" class="min">-</button>'+
                      '<div class="col text-center">'+
                          '<span class="mr-1 adult-val" >1 </span>'+
                          '<input type="hidden" name="rooms[]"  />'+
                          '<input type="hidden" name="adult[]" class="inp-adult" value="1" />'+
                     '</div>'+
                      '<button type="button" class="plus mr-3">+</button>'+
                  '</div>'+
              '</div>'+
          '</div>'+
          '<div class="row align-items-center py-2">'+
              '<div class="col-7">'+
                  '<p class="mb-0"><b>Children</b></p>'+
              '</div>'+
              '<div class="col-5">'+
                  '<div class="row field-count-guest align-items-center">'+
                      '<button type="button" class="min">-</button>'+
                      '<div class="col text-center">'+
                          '<span class="mr-1 child-val">1 </span>'+
                          '<input type="hidden" name="child[]" class="inp-child" value="1" />'+
                      '</div>'+
                      '<button type="button" class="plus mr-3">+</button>'+
                  '</div>'+
              '</div>'+
          '</div>'+
      '</div>';
      $('.guest-pick-body').find('.col-ews').addClass('col-6').removeClass('col-12');
      $('.guest-pick-body .list-eoom').append(temp);
    }
    if($(this).prev().find('.mr-1').html() > 3 ){
      $(this).closest('.field-count-guest').find('.plus-room').addClass('disable');
    }
  });

  $('.field-count-guest ').on('click', '.min-room', function(){
    $(this).closest('.guest-pick-container').find('.col-ews').not(':first').last().remove();
    
    if($(this).next().find('.mr-1').html() > 1){
      $(this).next().find('.mr-1').html(function(i, val) { return val*1-1 });
    }
    if($(this).next().find('.mr-1').html() < 2){
      $(this).closest('.field-count-guest').find('.min-room').addClass('disable');
      $('.guest-pick-body').find('.col-ews').addClass('col-12').removeClass('col-6');

    }
    if($(this).prev().find('.mr-1').html() != 4 ){
      $(this).closest('.field-count-guest').find('.plus-room').removeClass('disable');
    }
  });

  // $(document).on('click', '.confirm-room', function(){
  //   console.log('confirm');
  //   var roomVal = $('.room-val').html();  
  //   var adultTotal = 0;
  //   $('.adult-val').each(function(){
  //     adultTotal += parseFloat($(this).html());
  //   });    
  //   var chiltTotal = 0;
  //   $('.child-val').each(function(){
  //     chiltTotal += parseFloat($(this).html());
  //   });    
  //   $('.opt-select').show();
  //   $('.rto').hide();
  //   $('.opt-select').find('.room-count').html(roomVal);
  //   $('.opt-select').find('.adult-count').html(adultTotal);
  //   $('.opt-select').find('.child-count').html(chiltTotal);
  //   $('.filter-guest').addClass('show');
  // });

  $(document).on('click', '.confirm-room-when', function(){
    var adultCount = 0;
    var childCount = 0;
    $('.adult-val').each(function(){
      adultCount += parseFloat($(this).html());
    });
    $('.child-val').each(function(){
      childCount += parseFloat($(this).html());
    });
    var totalGuest = parseFloat(adultCount + childCount);
    $('.guest-count').html(totalGuest);
    $('#whoF').collapse('hide');
    $('.quick-prev').slick({
      slidesToShow: 1,
      prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
      nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
    });
    
    $('.quick-prev-when1').slick({
      slidesToShow: 1,
      prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
      nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
    });
    
  });

  $(document).on('click', '.confirm-room-submit', function(e){
    e.preventDefault();
    $("#collection_search").submit();  
  });


  $('.whereinner').on('click', '.nav-link', function(e){
    e.preventDefault();
    var result = $(this).find('span').html();
    $('.where').val(result);
  })

 
  new WOW().init();
  
  $(document).ready(function() {

    if (window.XMLHttpRequest) {
    window.onscroll = function() {
        if ($('body').scrollTop() > 145 || $('html').scrollTop() > 145) {
            if ($(window).height() > 20) {
                $('.onstick').addClass('sidebarFixed');
            }
        }
        else {
            $('.onstick').removeClass('sidebarFixed');
        }
    };
    }
  });
  

  $('.humburger-menu').click(function(){
    $('.menu').addClass('show');
    $('body').addClass('noscrool');
  });
  $('.close-menu').click(function(){
    $('.menu').removeClass('show');
    $('body').removeClass('noscrool');
  });
  $('.menu-show').click(function(e){
    e.preventDefault();
    $('.menu-main').toggleClass('show');
  });

  $(document).on('click', '.tab-link', function (e) {
    e.preventDefault();
    var t = $(this).attr('data-link');
    $('.tab-em').removeClass('active')
    $(t).addClass('active animated fadeIn');
    $('.testi-slide').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      vertical: true,
      verticalSwiping: true,
      autoplaySpeed: 2000,
      centerMode: true,
    });
  });

  $('.result-grid').slick({
    slidesToShow: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
  });
  $('.img-offset-slide').slick({
    slidesToShow: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
  });

   
  
  var clHeight = $('#cityList').height();
  $('#dashF').on('hidden.bs.collapse', function () {
    $('.onstick').css({
      "position": "",
      "top": "219px"
    });
  });
  $('#dashF').on('shown.bs.collapse', function () {
    $('.onstick').css({
      'position': 'fixed',
      'top': '500px'
    });
  });
  $('#calcF').on('hidden.bs.collapse', function () {
    $('.onstick').css({
      "position": "",
      "top": "219px"
    });
  });
  $('#calcF').on('shown.bs.collapse', function () {
    $('.onstick').css({
      'position': 'fixed',
      'top': '395px'
    });
  });
  $('#whoF').on('hidden.bs.collapse', function () {
    $('.onstick').css({
      "position": "",
      "top": "219px"
    });
  });
  $('#whoF').on('shown.bs.collapse', function () {
    $('.onstick').css({
      'position': 'fixed',
      'top': '570px'
    });
  });

  var clHeight = $('#cityList').height();
  $('#cityList').on('shown.bs.collapse', function () {
    $('.onstick').css({
      'position': 'fixed',
      'top': clHeight+249
    });
  });

  $('#cityList').on('hidden.bs.collapse', function () {
    $('.onstick').css({
      "position": "",
      "top": "219px"
    });
  });

  $('#cityList').on('click', '.nav-link', function(){
    var ta = $(this).find('.city-name-nav').html();
    $('.city-f').html(ta);
  });

  $(document).on('click', function (e){
    var menu_opened = $('.clp').hasClass('show');
    if(!$(e.target).closest('.clp').length &&
        !$(e.target).is('.clp') &&
        menu_opened === true){
            $('.clp').collapse('hide');
            $('.onstick').css({
              "position": "",
              "top": "219px"
            });
    }
  });
  $('.login-side').click(function(e){
    e.preventDefault();
    $('.open-side').addClass('show');
    $('.auth-signin').addClass('active');
    // $('body').css('overflow', 'hidden');
  })
  $('.register-side').click(function(e){
    e.preventDefault();
    $('.open-side').addClass('show');
    $('.auth-signup').addClass('active');
    // $('body').css('overflow', 'hidden');

  })
  $('.auth-close').click(function(e){
    e.preventDefault();
    $('.open-side').removeClass('show');
    setTimeout(function() {
      $('.auth-content').removeClass('active');
    }, 800);
    // $('body').css('overflow', 'auto');

  })

  $('.btn-auth').click(function(){
    var dtm = $(this).attr('data-member');
    $('.auth-content').removeClass('active');
    $(dtm).addClass('active');
    $('.btn-auth').removeClass('active')
    $(this).addClass('active');
  });

  $('.sidebar-nav').click(function(e){
    e.preventDefault();
    $('.sidebar').addClass('show');
  });
  $('.sidebar-close').click(function(e){
    e.preventDefault();
    $('.sidebar').removeClass('show');
  });
  
  
  
  
  $(document).on('click', '.btn-sidebar', function(e){
    e.preventDefault();
    var dataClick = $(this).attr('data-sidebar');
    $(dataClick).addClass('show');
    $('body').css('overflow', 'hidden');
    
    var _type = $('.gal-tab.active').attr('data-type');
    var _slug = $(this).attr('data-id');
    
    var _for = $(this).attr('data-for');
    //console.log(_type);
    $("#hid_propid").val(_slug);
    if(_for=='reviews'){
        
    }else if(_for=='quickinfo'){
        $.ajax({
            url: BaseURL+'/quickinfo',        
            dataType:'json',
            data: {'propid':_slug},
            type: 'get',                            
            beforeSend: function(){
                
            },
            success: function(data){
                /*var _htmlinfo = '';
                var objinfo = data.prop_info;
                if(typeof objinfo != 'undefined'){
                    //_htmlinfo = objinfo.  
                    $(objinfo).each(function(key, value){
                        _htmlinfo += '<div class="col-4 mb-5"><div class="qv-list"><h4>'+value['title']+'</h4>'+value['description']+'</div> </div>';    
                    });
                    //$("#prop_info").html('');
                    //$("#prop_info").html(_htmlinfo);  
                }*/
                var objprop = data.prop_details;
                console.log(objprop);
                if(typeof objprop != 'undefined'){
                    var p_address = objprop.address;
                    if(p_address!=''){
                        $("#propinfo_address").css('display', '');
                        $("#propinfo_address_text").html('');
                        $("#propinfo_address_text").html(p_address);
                    }else{
                        $("#propinfo_address").css('display', 'none');
                    } 
                    var p_internetpublic = objprop.internetpublic;
                    var p_internetroom = objprop.internetroom;
                    $("#propinfo_internet").css('display', '');
                    $("#propinfo_internet").html('');
                    var p_internet = '';
                    p_internet += '<div class="qv-list">';
                        if(p_internetpublic){
                            var intp = p_internetpublic ? 'Free' : 'No';
                            p_internet += '<h4>Internet</h4><p class="mb-0"><b>Public areas :</b> '+intp+'</p>';
                        }
                        if(p_internetroom){
                            var intr = p_internetroom ? 'Free' : 'No';
                            p_internet += '<p class="mb-0"><b>In room :</b> '+intr+'</p>';
                        }
                    p_internet += '</div>';
                    $("#propinfo_internet").html();
                    
                                       
                }else{
                    $("#propinfo_address").css('display', 'none');
                }
                var objprop = data.prop_details;
                if(typeof objprop != 'undefined'){
                    var p_address = objprop.address;
                    $("#propinfo_address").css('display', '');
                    $("#propinfo_address_text").html('');
                    $("#propinfo_address_text").html(p_address);                    
                }else{
                    $("#propinfo_address").css('display', 'none');
                }
                
                
                
                var _htmlamt = '';
                var objamn = data.amneties;
                if(typeof objamn != 'undefined'){
                    //_htmlinfo = objinfo.  
                    $(objamn).each(function(key, value){                        
                        _htmlamt += '<div class="col-md-3 col-sm-6 mb-4"><p class="mb-0">'+value['amenity_title']+'</p></div>';  
                    });
                    $("#prop_amenties").html('');
                    $("#prop_amenties").html(_htmlamt);  
                }
                var _htmlusp = '';
                var objusp = data.prop_usp;
                if(typeof objusp != 'undefined'){
                    //_htmlinfo = objinfo.  
                    $(objusp).each(function(key, value){
                        var img_path = BaseURL + '/uploads/property_usp/'+value['image_path'];
                        _htmlusp += '<div class="col text-center"><div class="i-touch"><p><i class="ico"><img style="width:53px" src="'+img_path+'"></i></p><p>'+value['title']+'</p></div></div>';  
                    });
                    $("#prop_usp").html('');
                    $("#prop_usp").html(_htmlusp);  
                }
            }
        }).done(function(){           
              
        });    
    }else if(_for=='gallery'){
        $.ajax({
            url: BaseURL+'/galleryimages',        
            dataType:'json',
            data: {'propid':_slug, 'type':_type},
            type: 'get',                            
            beforeSend: function(){
                
            },
            success: function(data){
                var _html = '';
                if((data.imgs).length > 0){
                    $(data.imgs).each(function(key, value){
                       //console.log(key);
                       //console.log(value); 
                       _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                    });
                    $('#gallery_hotel').html('');
                    $('#gallery_hotel').html(_html);
                }else{
                    console.log("no");
                }
            }
        }).done(function(){           
              
        });
    }else if(_for=='suites'){
        $.ajax({
            url: BaseURL+'/suitesbyid',        
            dataType:'json',
            data: {'slug':_slug},
            type: 'get',                            
            beforeSend: function(){
                
            },
            success: function(data){
                var roomimgobj = data.propertyDetail.roomimgs;
                var sidebarobj = data.propertyDetail.typedata;
                var sidebar_html = '';
                var roomimg_html = '';
                var img_html = '';
                if(typeof sidebarobj != "undefined"){
                    $(sidebarobj).each(function(key, val){
                        //sidebar_html += '<li class="nav-item"><a class="nav-link nav-link-sub suite-details" data-id="'+val['id']+'" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">'+val['category_name']+'</a></li>';
                        sidebar_html += '<li class="nav-item"><a class="nav-link nav-link-sub" href="'+BaseURL+'/'+_slug+'/'+val['category_name']+'" >'+val['category_name']+'</a></li>'; 
                        //console.log(val['id']);
                        var _indx = $.inArray( val['id'], roomimgobj);
                        //console.log(roomimgobj[val['id']]);
                        if(typeof roomimgobj[val['id']]!='undefined'){
                            var imgpath = roomimgobj[val['id']]['imgsrc'];
                            var objimgs = roomimgobj[val['id']]['imgs'];
                            //$(objimgs).each(function(key, val){
                            //    img_html += '';       
                            //});
                            
                            roomimg_html += '';                        
                        
                            roomimg_html += '<div class="inner-wrapper hotel-page-list">';
                                roomimg_html += '<div class="pr-lst result-grid suite-imgs">';
                                    $(objimgs).each(function(key, val){
                                        roomimg_html += '<div><img src="'+imgpath+'/'+val['file_name']+'" class="w-100" alt=""></div>';       
                                    });
                                    /*roomimg_html += '<div>';
                                        roomimg_html += '<img src="images/29be6592342279.5e49609509d85.jpg" class="w-100" alt="">';
                                    roomimg_html += '</div>';
                                    roomimg_html += '<div>';
                                        roomimg_html += '<img src="images/29be6592342279.5e49609509d85.jpg" class="w-100" alt="">';
                                    roomimg_html += '</div>';
                                    roomimg_html += '<div>';
                                        roomimg_html += '<img src="images/29be6592342279.5e49609509d85.jpg" class="w-100" alt="">';
                                    roomimg_html += '</div>';*/
                                roomimg_html += '</div>';
                                roomimg_html += '<a href="#" class="dtl-link">';
                                    roomimg_html += '<i class="ico ico-diamon diamon-label fav-button"></i>';
                                roomimg_html += '</a>';
                                roomimg_html += '<div class="hotel-meta">';
                                    roomimg_html += '<a data-toggle="collapse" href="#view-detail" role="button" aria-expanded="false" aria-controls="view-deal" class="view more">VIEW DETAILS</a>';
                                    roomimg_html += '<div class="hotel-title">';
                                        roomimg_html += '<p class="mb-0">2 Bedrooms</p>';
                                        roomimg_html += '<p class="mb-0 inc">Includes</p>';
                                    roomimg_html += '</div>';
                                    roomimg_html += '<div class="hotel-prices hotel-price-detail">';
                                        roomimg_html += '<div class="row align-items-center justify-content-center">';
                                            roomimg_html += '<h3 class="mb-0">â‚¬ 1.299</h3>';
                                            roomimg_html += '<div class="ml-1">';
                                                roomimg_html += '<i class="ico ico-info-green pointer" type="button" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="view-deal" data-target="#price-detail"></i>';
                                            roomimg_html += '</div>';
                                            roomimg_html += '<div class="ml-2"><span class="pernight"></span></div>';
                                        roomimg_html += '</div>';
                                        roomimg_html += '<p><i><b>Includes breakfast</b></i></p>';
                                    roomimg_html += '</div>';
                                    roomimg_html += '<div class="action-hotel">';
                                        roomimg_html += '<a data-toggle="collapse" href="#view-deal" role="button" aria-expanded="false" aria-controls="view-deal">View Deals</a> | <a href="#">Add to Favorite</a> | <a href="#">Book this Suite</a>';
                                    roomimg_html += '</div>';
                                roomimg_html += '</div>';
                            roomimg_html += '</div>';
                            
                            
                            
                        } 
                    });
                    $("#suitesside-tab").html('');
                    $("#suitesside-tab").html(sidebar_html); 
                    $("#suiteslist").html('');
                    $("#suiteslist").html(roomimg_html);  
                    console.log(roomimg_html);
                    
                    
                   
                }
            }
        }).done(function(){           
            $('.suite-imgs').slick({
                slidesToShow: 1,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
            });  
        });
    }
     
    
  });
  
  $(document).on('click', '#restaurant_gallery-tab',function(){
    var _type = $(this).attr('data-type');
    var _slug = $("#hid_propid").val();
    
    $.ajax({
        url: BaseURL+'/galleryimages',        
        dataType:'json',
        data: {'propid':_slug, 'type':_type},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var sidebar = data.sidebar; 
            console.log(sidebar);
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_restaurant').html('');
                $('#gallery_restaurant').html(_html);
            }else{
                console.log("no");
            }
            if((data.sidebar).length > 0){
                _sidebar += '<li class="nav-item"><a class="nav-link" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">Restaurants</a></li>';
                $(data.sidebar).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _sidebar += '<li class="nav-item"><a class="nav-link res-sidebar" data-id="'+value['id']+'" data-type="res" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">'+value['title']+'</a></li>'
                });
                $('#restaurant-gal-side-tab').html('');
                $('#restaurant-gal-side-tab').html(_sidebar);
            }else{
                console.log("no");
            }
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click','.res-sidebar',function(){
    var id = $(this).attr('data-id');
    var type = 'res';
    $.ajax({
        url: BaseURL+'/restaurantimagebyid',        
        dataType:'json',
        data: {'rid':id},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var sidebar = data.sidebar; 
            console.log(sidebar);
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_restaurant').html('');
                $('#gallery_restaurant').html(_html);
            }else{
                console.log("no");
            }
            
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click', '#bars_gallery-tab',function(){
    var _type = $(this).attr('data-type');
    var _slug = $("#hid_propid").val();
    
    $.ajax({
        url: BaseURL+'/galleryimages',        
        dataType:'json',
        data: {'propid':_slug, 'type':_type},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_bars').html('');
                $('#gallery_bars').html(_html);
            }else{
                console.log("no");
            }
            if((data.sidebar).length > 0){
                _sidebar += '<li class="nav-item"><a class="nav-link" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">Restaurants</a></li>';
                $(data.sidebar).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _sidebar += '<li class="nav-item"><a class="nav-link bar-sidebar" data-id="'+value['id']+'" data-type="bar" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">'+value['title']+'</a></li>'
                });
                $('#bars-gal-side-tab').html('');
                $('#bars-gal-side-tab').html(_sidebar);
            }else{
                console.log("no");
            }
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click','.bar-sidebar',function(){
    var id = $(this).attr('data-id');
    var type = 'bar';
    $.ajax({
        url: BaseURL+'/restaurantimagebyid',        
        dataType:'json',
        data: {'rid':id},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var sidebar = data.sidebar; 
            console.log(sidebar);
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_restaurant').html('');
                $('#gallery_restaurant').html(_html);
            }else{
                console.log("no");
            }
            
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click','.spa-sidebar',function(){
    var id = $(this).attr('data-id');
    var type = 'spa';
    $.ajax({
        url: BaseURL+'/restaurantimagebyid',        
        dataType:'json',
        data: {'rid':id},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var sidebar = data.sidebar; 
            console.log(sidebar);
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_restaurant').html('');
                $('#gallery_restaurant').html(_html);
            }else{
                console.log("no");
            }
            
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click', '#spas_gallery-tab',function(){
    var _type = $(this).attr('data-type');
    var _slug = $("#hid_propid").val();
    
    $.ajax({
        url: BaseURL+'/galleryimages',        
        dataType:'json',
        data: {'propid':_slug, 'type':_type},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_spas').html('');
                $('#gallery_spas').html(_html);
            }else{
                console.log("no");
            }
            if((data.sidebar).length > 0){
                _sidebar += '<li class="nav-item"><a class="nav-link" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">Restaurants</a></li>';
                $(data.sidebar).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _sidebar += '<li class="nav-item"><a class="nav-link spa-sidebar" data-id="'+value['id']+'" data-type="spa" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">'+value['title']+'</a></li>'
                });
                $('#spas-gal-side-tab').html('');
                $('#spas-gal-side-tab').html(_sidebar);
            }else{
                console.log("no");
            }
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click', '#suite_gallery-tab',function(){
    var _type = $(this).attr('data-type');
    var _slug = $("#hid_propid").val();
    
    $.ajax({
        url: BaseURL+'/galleryimages',        
        dataType:'json',
        data: {'propid':_slug, 'type':_type},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_suite').html('');
                $('#gallery_suite').html(_html);
            }else{
                console.log("no");
            }
            if((data.sidebar).length > 0){
                _sidebar += '<li class="nav-item"><a class="nav-link" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">Restaurants</a></li>';
                $(data.sidebar).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _sidebar += '<li class="nav-item"><a class="nav-link sidebar-suite" data-id="'+value['id']+'" id="suiteslist-tab" data-toggle="pill" href="#suiteslist" role="tab" aria-controls="suiteslist" aria-selected="true">'+value['category_name']+'</a></li>'
                });
                $('#suite-gal-side-tab').html('');
                $('#suite-gal-side-tab').html(_sidebar);
            }else{
                console.log("no");
            }
        }
    }).done(function(){           
          
    });
  });
  
  $(document).on('click', '.sidebar-suite',function(){
    var cid = $(this).attr('data-id');
    var _slug = $("#hid_propid").val();
    
    $.ajax({
        url: BaseURL+'/suiteimagebyid',        
        dataType:'json',
        data: {'cid':cid},
        type: 'get',                            
        beforeSend: function(){
            
        },
        success: function(data){
            var _html = '';
            var _sidebar = '';
            console.log((data.imgs).length);
            if((data.imgs).length > 0){
                $(data.imgs).each(function(key, value){
                   //console.log(key);
                   //console.log(value); 
                   _html += '<a class="tile" href=""><img src="'+value['imgsrc']+value['file_name']+'" alt=""></a>'
                });
                $('#gallery_suite').html('');
                $('#gallery_suite').html(_html);
            }else{
                console.log("no");
            }
            
        }
    }).done(function(){           
          
    });
  });
  
  
  /*$(document).on('click', '.suite-details', function(){
        var cid = $(this).attr('data-id');
        var _slug = $("#hid_propid").val();
        console.log(cid);
        $.ajax({
            url: BaseURL+'/suitedetails',        
            dataType:'json',
            data: {'cid':cid, 'slug':_slug},
            type: 'get',                            
            beforeSend: function(){
                
            },
            success: function(data){
                console.log(data);                
            }
        }).done(function(){           
              
        });
  });*/
  
  
  $('.close-sidebar').click(function(e){
    e.preventDefault();
    $(this).closest('.sidebar-main').removeClass('show');
    $(this).closest('body').css('overflow', 'auto');
  });
  
  $('.suite-list').on('click', '.select-sd', function(e){
    e.preventDefault();
    $('.suite-board').removeClass('active');
    $('.suite-tumb').removeClass('hide');
    $(this).closest('.suite-list').find('.suite-board').addClass('active');
    $(this).closest('.suite-list').find('.suite-tumb').addClass('hide');
    $('.suite-list').css('opacity', '.3');
    $(this).closest('.suite-list').css('opacity', '1');
  });
  $('.suite-list').on('click', '.board-close', function(e){
    e.preventDefault();
    $('.suite-board').removeClass('active');
    $('.suite-tumb').removeClass('hide');
    $('.suite-list').css('opacity', '1');
  });

  lightGallery(document.getElementById('gallery_hotel'), {
    thumbnail: true,
    currentPagerPosition: 'middle',
    download: false,
    share: true,
    escKey: false,
    closable: false
  }); 
  lightGallery(document.getElementById('gallery_restaurant'), {
    thumbnail: true,
    currentPagerPosition: 'middle',
    download: false,
    share: true,
    closable: false
  }); 
  lightGallery(document.getElementById('gallery_bars'), {
    thumbnail: true,
    currentPagerPosition: 'middle',
    download: false,
    share: true,
    closable: false
  }); 
  lightGallery(document.getElementById('gallery_experience'), {
    thumbnail: true,
    currentPagerPosition: 'middle',
    download: false,
    share: true,
    closable: false
  }); 
  lightGallery(document.getElementById('gallery_suite'), {
    thumbnail: true,
    currentPagerPosition: 'middle',
    download: false,
    share: true,
    closable: false
  }); 
  $('.suite-propa').click(function(e){
    e.stopPropagation();
  })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
    $('.result-grid').slick('setPosition');
  })
  $('#transfers').on('shown.bs.collapse', function () {
    $('.result-grid').slick('setPosition');
  })
  $('#inroom-amenities').on('shown.bs.collapse', function () {
    $('.result-grid').slick('setPosition');
  })
  $('#spa-service').on('shown.bs.collapse', function () {
    $('.result-grid').slick('setPosition');
  })
  $('#experiences').on('shown.bs.collapse', function () {
    $('.result-grid').slick('setPosition');
  })
  
  $(document).on("scroll", function(){
      if($(document).scrollTop() > 100){
        $(".second-header").addClass("show");
      }
      else{
        $(".second-header").removeClass("show");
      }
    });
  
})();
