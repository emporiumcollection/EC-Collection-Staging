<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content=" @yield('robots')">
    <meta name="keywords" content=" {{ CNF_APPNAME }}, @yield('meta_keywords') ">
    <meta name="description" content=" {{ CNF_APPNAME }} - @yield('meta_description') ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> {{ CNF_APPNAME }} - @yield('meta_title') </title>
    
    
    
    
    @yield('meta_link_sitemap')
    
    <meta property="og:url" content="@yield('og_url')" />
    <meta property="og:title" content="@yield('og_title')" />
    <meta property="og:description" content="@yield('og_description')" />
    <meta property="og:type" content="@yield('og_type')" />
    <!--<meta property="og:image" content="@yield('og_image')" />
    <meta property="og:image:width" content="@yield('og_image_width')" />
    <meta property="og:image:height" content="@yield('og_image_height')" /> -->
    @yield('og_image')
    <meta property="og:site_name" content="@yield('og_sitename')" />
    <meta property="og:locale" content="@yield('og_locale')" />
    
    <meta property="article:section" content="@yield('article_section')" />
    @yield('article_tags')
    
    <meta property="twitter:url" content="@yield('twitter_url')" />
    <meta property="twitter:title" content="@yield('twitter_title')" />
    <meta property="twitter:description" content="@yield('twitter_description')" />
    @yield('twitter_image')
    <meta property="twitter:domain" content="@yield('twitter_domain')" />
    <meta property="twitter:card" content="@yield('twitter_card')" />
    <meta property="twitter:creator" content="@yield('twitter_creator')" />
    <meta property="twitter:site" content="@yield('twitter_site')" />
    <script type="application/ld+json">
    @yield('jsonld')
    </script> 
    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- Web Application Manifest -->
    <link rel="manifest" href="manifest.json">

    
    <!-- Favicon Start -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/favicon/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/favicon/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/favicon/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/favicon/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/favicon/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/favicon/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/images/favicon/android-icon-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/favicon/favicon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('assets/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/ms-icon-144x144.png') }}" />
    <meta name="theme-color" content="#ffffff" />
    <!-- Favicon END -->
    
    <link rel="stylesheet" href="{{ asset('themes/EC/css/styles.css') }}">
    
    <!-- tilt css include -->
    <!-- end of tilt css include -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    {{--For Include and Add Files in Head --}}     
    @section('head')
        @parent        
    @show

    {{--For Custom Styles --}}
    @section('custom_css')
        @parent
        
    @show
@if(defined('CNF_GOOGLE_ANALYTIC_KEY'))
    @if(CNF_GOOGLE_ANALYTIC_KEY != '')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ CNF_GOOGLE_ANALYTIC_KEY }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', '{{ CNF_GOOGLE_ANALYTIC_KEY }}');
    </script>
    @endif
@endif

@if(defined('CNF_HUBSPOT_SCRIPT'))
    @if(CNF_HUBSPOT_SCRIPT != '')
    <!-- Start of HubSpot Embed Code -->
    {!! CNF_HUBSPOT_SCRIPT !!}
    <!-- End of HubSpot Embed Code -->
    @endif
@endif
</head>
<body>
    @section('header')
        @parent
        @include('frontend.themes.EC.layouts.sections.main_header')
    @show
    
    @section('leftsidebar')
        @parent
        @include('frontend.themes.EC.layouts.sections.main_sidebar')
    @show
    
    @yield('content')
    
    @section('footer')
        @parent
        @include('frontend.themes.EC.layouts.sections.footer')
    @show
    
{{-- Site Base URL --}}

<script type="text/javascript">var BaseURL = '{{ url() }}'; </script> 

<script type="text/javascript" src="{{ asset('themes/EC/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/jqueryui/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/daterangepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/jquery.mousewheel.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/simpleLightbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/mediaelement-and-player.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/jquery.rangecalendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/fullcalendar/core/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/fullcalendar/daygrid/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/wow.min.js') }}"></script>

<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lg-thumbnail.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lg-share.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/rellax.min.js') }}"></script>

<script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>

<script type="text/javascript" src="{{ asset('themes/EC/js/all.js') }}"></script>
@section('custom_js')
    @parent

@endsection
<script>
    
    $(document).on('click', ".dest-collection", function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                var active_cat = $("input[name='activeDestination']").val();
                var cat = $("input[name='activeDestination']").val();          
                var coll_type = 'destinations';
                var req_for = '';
                var cobj = $(this);
                
                console.log(d_name+"/"+cat+"/"+coll_type+"/"+req_for+"/"+cobj);
                
                //var token = $("input[name='_token']").val();
                
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                //window.location.href = '{{URL::to('luxury_destinations')}}/'+cat+'/dedicated-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('dedicated-collection', cat, 1, req_for);
                                $(".dest-collection").find('a').removeClass('active');
                                cobj.find('a').addClass('active');
                                $("#dest_collection").val('dedicated-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('bespoke-collection', cat, 1, req_for);
                                $(".dest-collection").find('a').removeClass('active');
                                cobj.find('a').addClass('active');
                                $("#dest_collection").val('bespoke-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');                               
                            }
                        }else{
                            //cat = $("#dd-destination").val();
                            getPropertyByCollection('lifestyle-collection', cat, 1, req_for);
                            $(".dest-collection").find('a').removeClass('active');
                            cobj.find('a').addClass('active');
                            $("#dest_collection").val('lifestyle-collection'); 
                            //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
    
    $(".suites-slider").slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
    });
    $('.slider-detail').slick({
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      prevArrow: $('.prev'),
      nextArrow: $('.next'),
    });
    $('video').mediaelementplayer({
      enableAutosize: true,
      alwaysShowControls: true,
      defaultVideoWidth: 480,
      defaultVideoHeight: 270,
      videoWidth: -1,
      videoHeight: -1,
      audioWidth: 400,
      audioHeight: 30,
    });

    $('.prev').click(function () {
      $('video').trigger('pause');
    });
    $('.next').click(function () {
      $('video').trigger('pause');
    });
        
    $("#cal1").rangeCalendar({
        minRangeWidth : 1,
        maxRangeWidth: 30,
        startRangeWidth : 1, 
        start : "0",
        changeRangeCallback: rangeChanged,
    });
    var arriveDt = new Date();               
    var depDt = new Date();
           
    @if(!empty($arrive_date))                      
      var arriveDt1 = '{{$arrive_date}}';                
    @endif
            
    @if(!empty($departure_date))                
      var  depDt1 = '{{$departure_date}}';           
    @endif
    
    var _day = '';
    var _month = '';
    var _year = '';    
    var sp_arr = arriveDt1.split('-');
    if(sp_arr.length > 2){
        _year = sp_arr[0];
        _month = sp_arr[2];
        _day = sp_arr[1];
    }    
    var newArrDt = new Date(_year, _month, _day);
        
    var _dday = '';
    var _dmonth = '';
    var _dyear = '';
    var sp_darr = depDt1.split('-');
    if(sp_darr.length > 2){
        _dyear = sp_darr[0];
        _dmonth = sp_darr[2];
        _dday = sp_darr[1];
    }
    var newDepDt = new Date(_dyear, _dmonth, _dday);    
    
    var defStartDay = moment(newArrDt).format('DD');
    var defStartMonth = moment(newArrDt).format('MMM');
    var defEndDay = moment(newDepDt).format('DD');
    var defEndMonth = moment(newDepDt).format('MMM');    
    $(".cal-f .cal-date").html(defStartDay +' '+ defStartMonth+' - '+ defEndDay +' '+ defEndMonth);
       
    function rangeChanged(target,range){ 
        var startDay = moment(range.start).format('DD');
        var startMonth = moment(range.start).format('MMM');
        var endDay = moment(range.end).format('DD');
        var endMonth = moment(range.end).format('MMM');
        $(".cal-f .cal-date").html(startDay +' '+ startMonth+' - '+ endDay +' '+ endMonth);
    }
    
    $(document).ready(function(){
        var active_cat = $("input[name='activeDestination']").val();
        console.log(active_cat);
        getDestinationPage(active_cat, '');    
    });
    
    $(document).on('click', '.experiences', function(){ 
        var active_cat = $("input[name='activeDestination']").val();
        var active_exp = $(this).attr('data-exp');
        getDestinationPage(active_cat, active_exp); console.log(active_cat+', '+active_exp);             
    });
    
    function getDestinationPage(item, active_exp){            
        var mtype = $("input[name='m_type']").val();                    
        var _cat = item;                      
        getPropertyByCollection(mtype, _cat, 1, '', active_exp);  
        
        //changeBreadcrumbDropdown(_cat);  
        
        //$('#gs_sb_navhead').addClass('navheadimage');
        //$('#gs_sb_criteria').addClass('sdestination');                      
    }
    
    function getPropertyByCollection(coll_type, cat, page, req_for, active_exp){ console.log(coll_type+', '+cat+', '+page+', '+req_for);
        $.ajax({
            url:'{{URL::to("propertysearchlistbycollection/")}}',
            //dataType:'html',
            dataType:'json',
            data: {'coll_type':coll_type, 'cat':cat, 'page':page, 'req_for':req_for, 'active_exp':active_exp},
            type: 'post',
            beforeSend: function(){
                //$(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
            },
            success: function(data){
                var youtube_url = BaseURL + '/social-youtube/'+data.data.category_alias;
                $("#youtube_video").attr('href', youtube_url);
                /*$(".collection-tabs").css('display', ''); 
                $("#channel_url").css('display', 'none');
                $("#social_url").css('display', 'none');
                var channel_url = data.data.channel_url;
                if(channel_url!=null){
                    $("#channel_url").css('display', '');
                    $("#channel_url").attr('data-url', channel_url);       
                }
                var social_url = data.data.social_url;
                if(social_url!=null){
                    $("#social_url").css('display', '');
                    $("#social_url").attr('data-url', social_url);    
                } */                  
                
                /*var datObj = {};
				datObj.catID = data.data.dest_id;
				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/destination/destinatinos-ajax';
				params['data'] = datObj;
				params['successCallbackFunction'] = renderSearchDestination;
				doAjax(params);*/ 
                
                listpagestructure(data);                    
            }
        });
    }
    function listpagestructure(data){                    
            
        var _html = '';
        var jsonobj = data.data;
        if($.isEmptyObject(jsonobj)){
                
        }else{            
            var cat_image = jsonobj.category_image;
            var gs_side_image_path = BaseURL+'/uploads/category_imgs/'+cat_image;
            if(cat_image==''){
                gs_side_image_path = BaseURL+'/themes/emporium/images/mountain-image.jpg';   
            }
            $(".gs-sidebar-criteria-image").html('');
            $(".gs-sidebar-criteria-image").html('<img src="'+gs_side_image_path+'" alt="" class="mCS_img_loaded desaturate">');
            
            var cat_insta_tag = jsonobj.category_instagram_tag;
            var cat_nm = jsonobj.category_name;
            $(".destinationTitle").html('');
            $(".destinationTitle").html(cat_nm+"<br><span class='hashTag'>"+cat_insta_tag+"</span>");
            
            
            var editorPropertiesArr = jsonobj.editorPropertiesArr;
                                            
            if (typeof editorPropertiesArr !== undefined && editorPropertiesArr.length > 0){                 
                    
                    $(editorPropertiesArr).each(function(_key, _val){
                    
                        //_html += '<a href="'+_val['property_slug']+'" class="dtl-link">';
                        _html += '<div class="row">';
                            _html += '<div class="col-8 ">';
                                //_html += '<div class="content-img" style="background: url("http://localhost:8181/emporium-staging-forge/public/themes/EC/images/aaabf028325021.5637326997cb1.jpg") no-repeat center center;" id="ecp-bg-img-'+_val['id']+'"></div>';
                                
                                
                                _html += '<div class="content-img">';
                                    _html += '<a href="suite.html" class="dtl-link">';
                                      _html += '<img id="ecp-bg-img-'+_val['id']+'" alt="">';
                                    _html += '</a>';
                                    _html += '<div class="my-dropdown">';
                                      _html += '<div class="btn-group dropleft">';
                                        _html += '<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ico ico-diamon diamon-label"></i></a>';
                                        _html += '<div class="dropdown-menu">';
                                          _html += '<a href="#" class="dropdown-item">Add to collection</a>';
                                          _html += '<a href="#" class="dropdown-item btn-sidebar create-collection" data-sidebar="#myCollection">Create new collection</a>';
                                        _html += '</div>';
                                      _html += '</div>';                    
                                    _html += '</div>';
                                _html += '</div>';
                                
                                                       
                            _html += '</div>';
                            
                            _html += '<div class="col-4 ">';
                                _html += '<h3 class="title-font-2 title-line is-small  fadeInUp "><b>editors choice hotel</b></h3>';  
                                _html += '<p class="font-2 mt-4 ">';
                                    _html += '<i>';
                                        _html += _val['property_usp'];
                                    _html += '</i>';
                                _html += '</p>';
                            _html += '</div>';
                        _html += '</div>';
                        //_html += '</a>';
                        
                        _html += '<div class="row relax-offset" data-rellax-speed="2">';
                            _html += '<div class="col-4 ">';
                                _html += '<div class="title-offset mt-5 ">';
                                    _html += '<h3 class="title-second title-line mb-0">'+_val['property_name']+'</h3>';
                                    //_html += '<h4 class="title-font-2 title-third">experience</h4>';
                                _html += '</div>';
                            _html += '</div>';
                            _html += '<div class="col-8 ">';
                                _html += '<div class="img-offset hotel-page-list suite-ontouch ">';
                                    _html += '<div class="img-offset-slide offsets---190" id="ecp-img-slk-'+_val['id']+'">';
                                        
                                        var _ecid = _val['id'];
                                        $.ajax({
                                            url:'{{URL::to("propertyimagesbypid/")}}',                            
                                            dataType:'json',
                                            data: {'propid':_ecid},
                                            type: 'get',                                            
                                            beforeSend: function(){
                                                //$(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                                            },
                                            success: function(data){
                                                var _ecpimg = '';
                                                var _ecpbg = '';
                                                $(data).each(function(_key, _value){
                                                    _ecpimg += '<div><a href="'+_value['property_slug']+'"><img src="'+_value+'" class="img-fluid" alt=""></a></div>';                                                           _ecpbg = _value;      
                                                });
                                                $("#ecp-img-slk-"+_val['id']).html(_ecpimg);
                                                $("#ecp-bg-img-"+_val['id']).css('background-image', 'url(' + _ecpbg + ')')
                                                
                                            }
                                        }).done(function(){           
                                            $("#ecp-img-slk-"+_val['id']).slick({
                                                slidesToShow: 1,
                                                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                                                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                                            });  
                                        });
                                        
                                    _html += '</div>';
                                    
                                    
                                    
                                    _html += '<div class="hotel-meta full-width">';
                                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="reviews" data-id="'+_val['property_slug']+'" data-sidebar="#reviews">Reviews</a>';
                                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="quickinfo" data-id="'+_val['property_slug']+'" data-sidebar="#quickinfo">Quick info</a>';
                                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="gallery" data-id="'+_val['property_slug']+'" data-sidebar="#gallery">Gallery</a>';
                                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="suites" data-id="'+_val['property_slug']+'" data-sidebar="#suiteside">Suite(s)</a>';
                                        _html += '<div class="hotel-prices hotel-price-detail d-flex">';
                                            _html += '<div class="row align-items-center justify-content-center">';
                                              _html += '<h3 class="mb-0"><span class="title-font-2 mr-1">From</span> <span class="color-primary">EUR '+parseInt(_val["prc"])+' </span></h3>';
                                              _html += '<div class="ml-2"><span class="pernight"></span></div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    _html += '</div>';
                                    
                                    
                                    
                                _html += '</div>';
                            _html += '</div>';
                        _html += '</div>';
                        _html += '<div class="line-separate "></div>';
                      });        
                 
            }
            
            var featurePropertiesArr = jsonobj.featurePropertiesArr;
            console.log(featurePropertiesArr);
            var i=1; 
            if(typeof featurePropertiesArr !== undefined && featurePropertiesArr.length > 0){                         
                
                var fp1 = featurePropertiesArr[0];
                var fp2 = featurePropertiesArr[1];
                console.log(fp1);
                console.log(fp2);
                if(typeof fp1 !== 'undefined'){                
                _html += '<div class="row">';
                    _html += '<div class="col-7 ">';
                    _html += '<div class="inner-wrapper hotel-page-list suite-ontouch no-opacity">';
                      _html += '<div class="img-offset-slide" id="fp-img-slk-'+fp1['id']+'">';
                        var _fpid = fp1['id'];
                        $.ajax({
                            url:'{{URL::to("propertyimagesbypid/")}}',                            
                            dataType:'json',
                            data: {'propid':_fpid},
                            type: 'get',                            
                            beforeSend: function(){
                                //$(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                            },
                            success: function(data){
                                var _fpimg = '';
                                $(data).each(function(_key, _value){
                                    _fpimg += '<div><a href="'+fp1['property_slug']+'"><img src="'+_value+'" class="img-fluid" alt=""></a></div>';        
                                });
                                $("#fp-img-slk-"+fp1['id']).html(_fpimg);                                
                            }
                        }).done(function(){           
                            $("#fp-img-slk-"+fp1['id']).slick({
                                slidesToShow: 1,
                                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                            });  
                        });
                                                
                      _html += '</div>';
                      
                      
                      
                      _html += '<div class="hotel-meta full-width">';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="reviews" data-id="'+fp1['property_slug']+'" data-sidebar="#reviews">Reviews</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="quickinfo" data-id="'+fp1['property_slug']+'" data-sidebar="#quickinfo">Quick info</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="gallery" data-id="'+fp1['property_slug']+'" data-sidebar="#gallery">Gallery</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="suites" data-id="'+fp1['property_slug']+'" data-sidebar="#suiteside">Suite(s)</a>';
                        _html += '<div class="hotel-prices hotel-price-detail d-flex">';
                            _html += '<div class="row align-items-center justify-content-center">';
                              _html += '<h3 class="mb-0"><span class="title-font-2 mr-1">From</span> <span class="color-primary">EUR '+ parseInt(fp1["prc"])+' </span></h3>';
                              _html += '<div class="ml-2"><span class="pernight"></span></div>';
                            _html += '</div>';
                        _html += '</div>';
                      _html += '</div>';
                      
                  _html += '</div>';    
                      
                      
                      
                      _html += '<div class="title-offset mt-5 relax-offset" data-rellax-speed="2" data-rellax-percentage="0.1">';
                        _html += '<h3 class="title-second title-line mb-0">'+fp1["property_name"]+'</h3>';
                        //_html += '<h4 class="title-font-2 title-third">experience</h4>';
                      _html += '</div>';
        
                    _html += '</div>';
                    _html += '<div class="col-5 ">';
                      _html += '<div class="fetaruer py-5 pl-5 pr-0">';
                        _html += '<h3 class="title-3 title-i ">- featured hotel -</h3>';
                        _html += '<p class="font-2 ">';
                          _html += '<i>';
                            _html += fp1["property_usp"];                    
                          _html += '</i>';
                        _html += '</p>';
                      _html += '</div>';
                    _html += '</div>';
              _html += '</div>';
              
              }  
              if(typeof fp2 !== 'undefined'){   
              //_html += '<a href="'+fp2['property_slug']+'" class="dtl-link">';
                _html += '<div class="row mt-5">';
                  _html += '<div class="col-5 ">';
                    _html += '<div class="fetaruer py-5 pl-0 pr-5 ">';
                      _html += '<h3 class="title-3 title-i text-right">- featured hotel -</h3>';
                      _html += '<p class="font-2 text-right">';
                        _html += '<i>';
                          _html += fp2["property_usp"];                      
                        _html += '</i>';
                      _html += '</p>';
                    _html += '</div>';
                  _html += '</div>';
                  _html += '<div class="col-7 ">';
                  _html += '<div class="inner-wrapper hotel-page-list suite-ontouch no-opacity">';
                    _html += '<div class="img-offset-slide" id="fp-img-slk-'+fp2['id']+'">';
                    
                        var _fpid2 = fp2['id'];
                        $.ajax({
                            url:'{{URL::to("propertyimagesbypid/")}}',                            
                            dataType:'json',
                            data: {'propid':_fpid2},
                            type: 'get',                            
                            beforeSend: function(){
                                //$(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                            },
                            success: function(data){
                                var _fpimg2 = '';
                                $(data).each(function(_key, _value){
                                    _fpimg2 += '<div><img src="'+_value+'" class="w-100" alt=""></div>';        
                                });
                                $("#fp-img-slk-"+fp2['id']).html(_fpimg2);                                
                            }
                        }).done(function(){           
                            $("#fp-img-slk-"+fp2['id']).slick({
                                slidesToShow: 1,
                                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                            });  
                        });
                    
                    
                    _html += '</div>';
                    
                    
                    _html += '<div class="hotel-meta full-width">';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="reviews" data-id="'+fp2['property_slug']+'" data-sidebar="#reviews">Reviews</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="quickinfo" data-id="'+fp2['property_slug']+'" data-sidebar="#quickinfo">Quick info</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="gallery" data-id="'+fp2['property_slug']+'" data-sidebar="#gallery">Gallery</a>';
                        _html += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="suites" data-id="'+fp2['property_slug']+'" data-sidebar="#suiteside">Suite(s)</a>';
                        _html += '<div class="hotel-prices hotel-price-detail d-flex">';
                            _html += '<div class="row align-items-center justify-content-center">';
                              _html += '<h3 class="mb-0"><span class="title-font-2 mr-1">From</span> <span class="color-primary">EUR '+parseInt(fp2["prc"])+' </span></h3>';
                              _html += '<div class="ml-2"><span class="pernight"></span></div>';
                            _html += '</div>';
                        _html += '</div>';
                    _html += '</div>';
                    
                    
                  _html += '</div>';
                    _html += '<div class="title-offset mt-5 relax-offset" data-rellax-speed="2" data-rellax-percentage="0.1">';
                      _html += '<h3 class="title-second title-line mb-0">'+fp2["property_name"]+'</h3>';
                      //_html += '<h4 class="title-font-2 title-third">experience</h4>';
                    _html += '</div>';
                  _html += '</div>';
                _html += '</div>';
              //_html += '</a>';
              
              /*$('.img-offset-slide').slick({
                slidesToShow: 1,
                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
              });*/
              }
            
          }
          
          var _html_prop = '';
          _html_prop += '<div class="row">';
            //_html_prop += '<div class="col-3"></div>';
            //_html_prop += '<div class="col-9">';
            //  _html_prop += '<div class="row">';
          
                var propertiesArr = jsonobj.propertiesArr;                      
                if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){  
                    var rw = 1;                        
                    $.each(propertiesArr, function(key, value){
                        
                        var _pid = value['id'];
                        
                        _html_prop += '<div class="col-6 mb-5 ">';
                        
                        _html_prop += '<div class="inner-wrapper hotel-page-list suite-ontouch no-opacity">';
                        
                        _html_prop += '<div class="pr-lst result-grid" id="grid-img-'+value['id']+'">';
                        
                        $.ajax({
                            url:'{{URL::to("propertyimagesbypid/")}}',
                            //dataType:'html',
                            dataType:'json',
                            data: {'propid':_pid},
                            type: 'get',                            
                            beforeSend: function(){
                                //$(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                            },
                            success: function(data){
                                var _hp = '';
                                $(data).each(function(_key, _value){
                                    _hp += '<div><img src="'+_value+'" class="w-100" alt=""></div>';        
                                });
                                $("#grid-img-"+value['id']).html(_hp);
                            }
                        }).done(function(){           
                            $("#grid-img-"+value['id']).slick({
                                slidesToShow: 1,
                                prevArrow: '<button class="slide-arrow prev-arrow"><i class="ico ico-back"></i></button>',
                                nextArrow: '<button class="slide-arrow next-arrow"><i class="ico ico-next"></i></button>'
                            });  
                        });                     
                        _html_prop += '</div>'
                        
                        
                        //_html_prop += '<a href="#" class="dtl-link">';
                        //    _html_prop += '<i class="ico ico-diamon diamon-label fav-button"></i>';
                        //_html_prop += '</a>';
                        
                        
                        _html_prop += '<div class="my-dropdown">';
                              _html_prop += '<div class="btn-group dropleft">';
                                _html_prop += '<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ico ico-diamon diamon-label"></i></a>';
                                _html_prop += '<div class="dropdown-menu">';
                                  _html_prop += '<a href="#" class="dropdown-item">Add to collection</a>';
                                  _html_prop += '<a href="#" class="dropdown-item btn-sidebar create-collection" data-sidebar="#myCollection">Create new collection</a>';
                                _html_prop += '</div>';
                              _html_prop += '</div>';
        
                        _html_prop += '</div>';
                        
                        
                        _html_prop += '<div class="hotel-meta full-width is-small">';
                        
                        
                            _html_prop += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="reviews" data-id="'+value['property_slug']+'" data-sidebar="#reviews">Reviews</a>';
                            _html_prop += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="quickinfo" data-id="'+value['property_slug']+'" data-sidebar="#quickinfo">Quick info</a>';
                            _html_prop += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="gallery" data-id="'+value['property_slug']+'" data-sidebar="#gallery">Gallery</a>';
                            _html_prop += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-for="suites" data-id="'+value['property_slug']+'" data-sidebar="#suiteside">Suite(s)</a>';
                        
                        
                          //_html_prop += '<a href="#" class="view bg-btn-gl-001 btn-sidebar" data-id="'+value['property_slug']+'" data-sidebar="#gallery">';
                          //  _html_prop += 'View Gallery';
                          //_html_prop += '</a>';
                          _html_prop += '<div class="hotel-prices hotel-price-detail d-flex">';
                            _html_prop += '<div class="row align-items-center justify-content-center">';
                              _html_prop += '<h3 class="mb-0">'+value['prc']+'</h3>';
                              _html_prop += '<div class="ml-1">';
                                _html_prop += '<i class="ico ico-info-green pointer" type="button" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="view-deal" data-target="#price-detail"></i>';
                              _html_prop += '</div>';
                              _html_prop += '<div class="ml-2">';
                                _html_prop += '<span class="pernight"></span>';
                              _html_prop += '</div>';
                            _html_prop += '</div>';
                            //_html_prop += '<p><i><b>Includes breakfast</b></i></p>';
                          _html_prop += '</div>';
                        _html_prop += '</div>';
                        
                        
                        _html_prop += '</div>';
                          _html_prop += '<a href="'+value['property_slug']+'">';
                            _html_prop += '<div class="title-offset mt-5 ">';
                              _html_prop += '<h3 class="title-second title-line mb-0">'+value['property_name']+'</h3>';
                              //_html_prop += '<div class="title-font-2 title-third">Night from $'+value['prc']+'</div>';
                            _html_prop += '</div>';
                          _html_prop += '</a>';
                    _html_prop += '</div>';              
          
                    });
                }
              //_html_prop += '</div>';
            //_html_prop += '</div>';
          _html_prop += '</div>';
             
            
           
            
            _html += '<div class="col-md-12 col-xs-12 col-xs-12 text-center">';
                _html += '<div class="row">';
                    var total_pages = jsonobj.total_pages;
                    if(total_pages>1){
                		_html += '<ul class="pagination">';
                			for(i=1; i<=total_pages; i++){
                				<?php
                					$url=Request::url().'?';
                					$queryStrings=Request::query();
                					if(isset($queryStrings['page']))
                					{
                						unset($queryStrings['page']);
                					}
                					foreach($queryStrings as $keyQuery=>$querystring):
                						$url.=$keyQuery.'='.$querystring.'&';
                					endforeach;
                				?>
                                var act = (i==jsonobj.active_page) ? 'active' : '';
                				_html += '<li class="'+act+' paging"><a href="{{ $url.'page='}}'+i+'" data-page="'+i+'">'+i+'</a></li>';
                			}    
                		_html += '</ul>';
            		}
            	_html += '</div>';
            _html += '</div>';                
            
        }
        $(".load_ajax").html('');
        $(".load_ajax").html(_html);
        
        $(".load_property_ajax").html('');
        $(".load_property_ajax").html(_html_prop);
        
        var rellax = new Rellax('.relax-offset');
        /*$grid = $('.grid').masonry({
          // options...
        }); 
        $grid.imagesLoaded().progress( function() {
          $grid.masonry('layout');
        });
        $('img.rad-img').photoLoadAfterPageLoad(noImg);*/
    }
    
    
    
var rellax = new Rellax('.relax-offset');



</script>

</body>
</html>
