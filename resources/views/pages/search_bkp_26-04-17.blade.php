<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> {{ $pageTitle}} | {{ CNF_APPNAME }}</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

        <!--Style Includes-->

        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet">
        <link href="{{ asset('sximo/assets/css/test-res.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>

        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery2.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/uikit.js')}}"></script>

        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/active-nav.js')}}" type="text/javascript"></script>

        <!--Filters Grid Page-->
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>

        <style>
            .FltRgt { 
                float:right; cursor:pointer; 
            }
            .FltLft {
                float:left;
            }
            .MrgTop5 {
                margin-top:5px !important; 
            }
            .carticon {
                float:right; margin-left:5px;
            }
        </style>
        <style>
            .sidenavpost .bh-search-input
            {
                padding-left: 0px !important;
            }

            .sidenavpost .tt-menu
            {
                left: 0% !important;
                color:#fff !important;
            }

            .sidenavpost a
            {
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn
            {
                font-size: 36px !important;
            }
        </style>
    </head>
    <body id="main">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
                        <div class="container-fluid logo-padding-left editorial-logo-align">
                            <div class="col-md-12-">
                                <p><a class="logo-d" href="{{url()}}">D</a></p>
                            </div>
                            <div class="col-md-12-">
                                <h2 class="menu-text-align">Home</h2>
                            </div>
                            <div class="col-md-12- menu">
                                <a href="#"><img class="menu-button" src="{{ asset('sximo/assets/images/menu.png')}}" alt=""/></a>
                                <ul style="display: none;">
                                    <li>
                                        <a href="home.html">Get Inspired</a>
                                    </li>
                                    <li>
                                        <a href="#" class="trigger-click-on-book-now">By Date</a>
                                    </li>
                                    <li>
                                        <a href="#">Personalized Service</a>
                                    </li>
                                    <li>
                                        <a href="#">About</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12-">
                                <div class="row">
                                    <a href="#" class="book-button open-book-now-page">BOOK</a>
                                </div>
                            </div>
                            <div class="row">
                                <button class="go-back-button" onclick="goBack()">Go Back</button>
                            </div>
                        </div>
                    </header>
                    <div class="filter-page-main-align">
                        <div class="col-md-10 col-sm-9">
                            <div class="row">
                                <script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
                                <div class="header container-fluid">
                                    <div class="col-md-12">
                                        <div class="header-logo">
                                            <a href="{{url()}}">
                                                <img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Design Locations"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="header-navigation-container col-md-12">
                                                <div class="row">
                                                    <div class="col-md-0"></div>
                                                    <div class="col-md-3 col-sm-2 header-text-align">
                                                    </div>
                                                    <div class="col-md-7 col-sm-8">
                                                        @include('layouts/elliot/ai_navigation')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sticky-header-offset"></div>
                                <!--Main Page Start here--><div class="col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="row">
                                        <div class="locator clear">
                                            <p class="searchcount"> {{$ttlcount}} Hotel(s) Found for {{$keyword}} </p>
                                        </div>
                                    </div>

                                    <div id="cityfilters"></div>

                                    <div id="listproperties">
                                        <div class="row">
                                            @if($propertiesArr)
                                            {{--*/ $rw = 1 /*--}}
                                            @foreach($propertiesArr as $props)
                                            <div class="productData col-xs-12 col-sm-6 col-md-4 col-lg-3 margin-bottom-10">
                                                <div class="wrapperforliineedforlightboxremoval">
                                                    <div class="cat_product_medium1">
                                                        <div class="pictureBox gridPicture">
															 @if($props['data']->price!='')
																<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
																	From EUR {{$props['data']->price}} / night 
																</a>
															@endif
                                                            @if(array_key_exists('image', $props))
                                                            <a title="{{$props['image']->file_name}}" class="picture_link detail_view" rel="{{$props['data']->id}}" href="#">

                                                                <img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">


                                                            </a>
                                                            @else
                                                            <img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">
                                                            @endif
                                                        </div>
                                                        <div class="listDetails">
                                                            <div class="photographBox">
                                                                <h2>
                                                                    <a title="{{$props['data']->property_name}}" class="photograph FltLft" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
                                                                        {{$props['data']->property_name}}
                                                                    </a>
                                                                    <span class="FltRgt">
                                                                        <i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" @if(array_key_exists('image', $props)) onclick="add_to_lightbox({{$props['image']->file_id}}, {{$props['data']->id}});" @endif ></i>

                                                                        <a class="carticon" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>
                                                                    </span>
                                                                </h2>

                                                            </div>

                                                            <div class="entire_story MrgTop5">
                                                                <a class="textButton arrowButton detail_view MrgTop5" rel="{{$props['data']->id}}" href="#">
                                                                    Quick View 
                                                                </a>

                                                                <a class="textButton arrowButton MrgTop5" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
                                                                    Detail View 
                                                                </a>
                                                            </div>

                                                            <div class="showOnHover">
                                                                <div class="hover_request">
                                                                </div>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($rw%4==0)
                                        </div>
                                        <div class="row">
                                            @endif
                                            {{--*/ $rw++ /*--}}
                                            @endforeach
                                            {{--*/ $totpage = $propertiesArr->appends($pager)->lastPage(); $newpage = $currentPage + 2; $prevnewpage = $newpage - 2; /*--}}
                                            @endif
                                        </div>
                                    </div>
                                    <div id="brgrid"></div>
                                    <input type="hidden" id="nxtpg" value="{{$newpage}}">
                                    <input type="hidden" id="ttlpg" value="{{$totpage}}">
                                </div>

                            </div>
                        </div>
                    </div>
                    <script>
$(document).ready(function(){
$(document).on('click', '.top-bar-filters li.select-all', function (){
if ($(this).hasClass("active")) {
$('.top-bar-filters li').addClass("active");
$(this).removeClass("active");
}
else {
$('.top-bar-filters li').removeClass("active");
$(this).addClass("active");
}
});
$(document).on('click', '.top-bar-filters li', function (){
if (!$(this).hasClass("select-all")) {
$(this).toggleClass("active");
$('.top-bar-filters li.select-all').removeClass("active");
}
});
$(document).on('click', '.clear-all-filters a', function (event){
event.preventDefault();
$('.top-bar-filters li').removeClass("active");
$('.top-bar-filters li.select-all').addClass("active");
});
var scrollTimer, lastScrollFireTime = 0;
$(window).scroll(function () {
var minScrollTime = 4000;
var now = new Date().getTime();
var totlpgs = $('#ttlpg').val();
var nxtpg = $('#nxtpg').val();
if (nxtpg <= totlpgs)
{
if (!scrollTimer) {
var element_position = $('#brgrid').offset().top + $('#brgrid').outerHeight() - window.innerHeight;
var y_scroll_pos = $(window).scrollTop() + 100;
if ((y_scroll_pos >= element_position)) {
var it_scroll = true;
scrollDownloadData(it_scroll);
//console.log(y_scroll_pos + ' / ' +element_position);
}
scrollTimer = setTimeout(function() {
scrollTimer = null;
lastScrollFireTime = new Date().getTime();
var it_scroll = true;
scrollDownloadData(it_scroll);
//console.log(y_scroll_pos + ' / ' +element_position);
}, minScrollTime);
}
}
});
});
function scrollDownloadData(it_scroll)
{
var nxtpg = $('#nxtpg').val();
var offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
var sIndex = $('#listrecrds').val();
var queryStrng = '';
var destnarea = $('#selDestn').val();
if (destnarea != '')
{
var dest_area = destnarea.split("#:");
queryStrng = '&dest=' + dest_area[0] + '&area=' + dest_area[1];
}

if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
//$(".LoaderImage").css("display", "block");

$.ajax({
url: "{{ URL::to('filter_search_destionation')}}",
        type: "post",
        data: 's={{$keyword}}&page=' + nxtpg + queryStrng,
        dataType: "json",
        success: function(data){
        var html = chtml = '';
        if (data.status == 'error')
        {
        if (it_scroll == false)
        {
        $('#listproperties').html(data.errors);
        }
        else
        {
        ('#listproperties').append(data.errors);
        }
        isDataAvailable = false;
        }
        else
        {
        html += '<div class="row">';
        var p = 1;
        $.each($.parseJSON(data.properties), function(idx, obj) {
        html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
        html += '<div class="wrapperforliineedforlightboxremoval">';
        html += '<div class="cat_product_medium1">';
        html += '<div class="pictureBox gridPicture">';
		if (obj.pdata.price != '')
        {
        html += '<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / night </a>';
        }
        if (obj.hasOwnProperty("image")) {
        html += '<a title="' + obj.image.file_name + '" class="picture_link detail_view" rel="' + obj.pdata.id + '" href="#">';
        var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
        html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
        html += '</a>';
        } else{
        var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
        html += '<img class="img-responsive" src="' + pimg + '" alt="">';
        }

        html += '</div>';
        html += '<div class="listDetails">';
        html += '<div class="photographBox">';
        html += '<h2>';
        var detail_link = "{{URL::to('our-collection/')}}/" + obj.pdata.property_slug;
        html += '<a title="' + obj.pdata.property_name + '" class="photograph FltLft" rel="' + obj.pdata.id + '" href="' + detail_link + '">';
        html += obj.pdata.property_name;
        html += '</a>';
        html += '<span class="FltRgt">';
        if (obj.hasOwnProperty("image")) {
        html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox(' + obj.image.file_id + ',' + obj.pdata.id + ');" ></i>';
        }
        else{
        html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
        }
        html += '<a class="carticon" href="' + detail_link + '"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
        html += '</span>';
        html += '</h2>';
        html += '</div>';
        html += '<div class="entire_story MrgTop5">';
        html += '<a class="textButton arrowButton detail_view MrgTop5" rel="' + obj.pdata.id + '" href="#">Quick View</a>';
        html += '<a class="textButton arrowButton MrgTop5" rel="' + obj.pdata.id + '" href="' + detail_link + '">Detail View </a>';
        
        html += '</div>';
        html += '<div class="showOnHover">';
        html += '<div class="hover_request">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        if (p % 4 == 0)
        {
        html += '</div>';
        html += '<div class="row">';
        }
        p++;
        });
        html += '</div>';
        if (it_scroll == false)
        {
        $('#listproperties').html(html);
        }
        else{
        $('#listproperties').append(html);
        }
        if (destnarea != '')
        {
        if (dest_area[1] == 'country' || dest_area[1] == 'region'){
        $('#cityfilters').html('');
        }
        var ttp = p - 1;
        if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {
        chtml += '<div class="row">';
        chtml += '<div class="col-md-12">';
        chtml += '<div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>';
        chtml += '<ul class="top-bar-filters">';
        chtml += '<li class="active select-all">';
        chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + dest_area[0] + '\',\'city\');">';
        chtml += '<div class="filter-bg">';
        chtml += '<div class="right-text">(' + ttp + ')</div>';
        chtml += '<div class="clearfix"></div>';
        chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
        chtml += '<div class="top-filter-name">All Properties</div>';
        chtml += '</div>';
        chtml += '</a>';
        chtml += '</li>';
        $.each($.parseJSON(data.cities), function(idx, cobj) {
        var cimg = "{{URL::to('uploads/category_imgs/')}}/" + cobj.category_image;
        chtml += '<li>';
        chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + cobj.id + '\',\'city\');">';
        chtml += '<div class="filter-bg" style="background-image: url(\'' + cimg + '\');">';
        chtml += '<div class="right-text">(' + cobj.totalproperty + ')</div>';
        chtml += '<div class="clearfix"></div>';
        chtml += '<div><i class="fa fa-home" aria-hidden="true"></i></div>';
        chtml += '<div class="top-filter-name">' + cobj.category_name + '</div>';
        chtml += '</div>';
        chtml += '</a>';
        chtml += '</li>';
        });
        chtml += '</ul>';
        chtml += '</div>';
        chtml += '</div>';
        $('#cityfilters').html(chtml);
        }

        var searchcountdispl = data.ttl + ' Hotel(s) Found for ' + data.searchdestname;
        $('.searchcount').html(searchcountdispl);
        }

        sIndex = parseInt(sIndex) + offSet;
        $('#listrecrds').val(sIndex);
        $('#nxtpg').val(parseInt(nxtpg) + 1);
        $('#ttlpg').val(data.ttlpages);
        isPreviousEventComplete = true;
        }
        },
        error: function (error) {
        alert(error);
        }
});
}
}
                    </script>
					<script>
						function filter_destination(destn, area)
						{
						if (destn != '' && destn > 0)
						{
						$('#selDestn').val(destn + '#:' + area);
						$('#listrecrds').val(0);
						$('#nxtpg').val('1');
						var it_scroll = false;
						scrollDownloadData(it_scroll);
						$('#listrecrds').val(21);
						}
						}
					</script>
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="filter-grid-page-side-bar">
                                <div class="filters-gird-page-side-bar-filter-align">
                                    <div class="design-locations-logo">
                                        <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                    </div>
                                    <div class="design-locations-logo filters-page-serch-bar-align">
                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead search-navbar" name="s" id="search-navbar" placeholder="SEARCH" type="text">
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Filter BY Price
                                                </div>
                                            </a>
                                            <div id="filter-by-price" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div class="filter-by-price">
                                                            <div id="slider-range" class="filter-slider"></div>
                                                            <p>  
                                                                <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#book-your-destination" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Book Your Destination
                                                </div>
                                            </a>
                                            <div id="book-your-destination" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div>
                                                            <form class="filter-menu-booking">
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Arrive</label>
                                                                    <input id="filter-date-mobile" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="25-02-2017" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Depart</label>
                                                                    <input id="filter-date-mobile-departure" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="date" value="30-03-2017" type="text">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Experience
                                                </div>
                                            </a>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <form>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Beach Hotels')}}">Go Design Locations</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Green Properties')}}">Go Green Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Go Urban Hotels')}}">Go Urban Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Infinity Pools')}}">Go Infinity Pools</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Spa & Wellness Hotels')}}">Go Spa & Wellness Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Mountain  & Ski  Resorts')}}">Go Mountains and Skin Resorts</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Yoga Hotels')}}">Discover Yoga Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Culinary Delights')}}">Discover culinary Delight Hotels</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Family Friendly')}}">Discover Family Friendly Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Unusual Adventure Hotels')}}">Unusual Adventure Hotels</a></label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="selDestn" value="">
                                        <input type="hidden" id="listrecrds" value="21">
                                        @if(!empty($ourmaindesitnation))
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#maindestinations" class="heading-stying {{($continent!='') ? '' : 'collapsed' }}">
                                                <div class="panel-heading custom-heading">
                                                    Destinations
                                                </div>
                                            </a>
                                            <div id="maindestinations" class="panel-collapse collapse {{($continent!='') ? 'in' : '' }}">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <!--First Parent-->
                                                        @foreach($ourmaindesitnation as $mndest)
                                                        <div class="node post-filter-inputs">
                                                            <a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$mndest->id}}', 'continent');">{{$mndest->category_name}}</a>
                                                            @if(array_key_exists('childs',$mndest))
                                                            @foreach($mndest->childs as $cddest)
                                                            <div class="node" style="{{($continent==$mndest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
                                                                <a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$cddest->id}}', 'region');">{{$cddest->category_name}}</a>
                                                                @if(array_key_exists('subchild',$cddest))
                                                                @foreach($cddest->subchild as $sbdest)
                                                                <div class="node" style="{{($region==$cddest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
                                                                    <a class="node-btn" href="javascript:void(0)" onclick="filter_destination('{{$sbdest->id}}', 'country');">{{$sbdest->category_name}}</a>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div> 
                                    <div class="filter-footer">
                                        <div><a href="#" >View All Locations On Map</a></div>
                                        <div><a href="#"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <script>
                        $(document).ready(function () {
                        $(".social-share").click(function (event) {
                        event.preventDefault();
                        $(this).find("ul").toggle();
                        $(this).toggleClass("open");
                        });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                        $("header .menu > a").click(function (event) {
                        event.preventDefault();
                        $(this).parent().find("ul").toggle("slow");
                        });
                        $(".trigger-click-on-book-now").click(function (event) {
                        event.preventDefault();
                        $(".open-book-now-page").trigger("click");
                        });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                        $(window).scroll(function () {
                        if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                        } else {
                        $('#back-to-top').fadeOut();
                        }
                        });
                        $("#back-to-top").click(function (event) {
                        event.preventDefault();
                        $("html, body").animate({scrollTop: 0}, "slow");
                        });
                        $(".trigger-click-on-video-pop-up").click(function (event) {
                        event.preventDefault();
                        $(".open-video-pop-up").trigger("click");
                        });
                        });
                    </script>
                    <script>
                        $('#two-inputs').dateRangePicker(
                        {
                        selectForward: (Boolean),
                                stickyMonths: (Boolean),
                                startDate: "12-01-2017",
                                format: ' DD.MM.YYYY',
                                separator: ' to ',
                                getValue: function ()
                                {
                                if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                                        return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                                else
                                        return '';
                                },
                                setValue: function (s, s1, s2)
                                {
                                $('#date-range-arrive').val(s1);
                                $('#date-range-destination').val(s2);
                                }
                        }
                        ).bind('datepicker-first-date-selected', function (event, obj) {
                        $("#date-range-destination").val('');
                        });
                    </script>
                    <script>
                        /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
                        var acc = document.getElementsByClassName("accordion");
                        var i;
                        for (i = 0; i < acc.length; i++) {
                        acc[i].onclick = function () {
                        this.classList.toggle("active");
                        this.nextElementSibling.classList.toggle("show");
                        }
                        }
                    </script>
                    <script>
                        function toogleNavpost() {
                        if (document.getElementById("mySidenavpost").style.width == "400px") {
                        return closeNavpost();
                        }
                        return openNavpost();
                        }
                        function openNavpost() {
                        if ($(window).width() >= 768) {
                        document.getElementById("mySidenavpost").style.width = "400px";
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        else{
                        document.getElementById("mySidenavpost").style.width = "100%";
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        }
                        function closeNavpost() {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        window.onload = function () {
                        if ($(window).width() >= 768) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        }, 10000);
                        };
                        if ($(window).width() <= 767) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        document.getElementById("main").style.marginRight = "250px";
                        }

                        $(document).on('click', function (event) {
                        if ($(window).width() <= 767) {
                        if ($(event.target).has('.filter-width').length) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        document.getElementById("main").style.marginRight = "0";
                        }
                        }
                        });
                    </script>
                    <script>
                        $(".node-btn").click(function(){
                        $(this).parent().find("> .node").toggle();
                        $(this).parent().find("> .node").css({"padding-left": "10px", "margin-top": "5px", "text-transform": "inherit"});
                        $(this).parent().find("> .node > a").css({"text-transform": "none"});
                        });
                    </script>
                    <script>
                        $(function () {
                        $('#filter-date-mobile').combodate();
                        });
                        $('#filter-date-mobile').combodate({
                        minYear: 2016,
                                maxYear: 2017,
                        });
                        $(function () {
                        $('#filter-date-mobile-departure').combodate();
                        });
                        $('#filter-date-mobile-departure').combodate({
                        minYear: 2016,
                                maxYear: 2017,
                        });
                    </script>
                    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
                    <div class="editorial-custom-footer-style grid-page-footer-align">
                        @include('layouts/elliot/ai_footer')
                    </div>
                    @include('layouts/elliot/ai_lightbox_popups')
