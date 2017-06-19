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

        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>

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
        <link href="{{ asset('sximo/assets/css/cities-filter.css')}}" rel="stylesheet" type="text/css"/>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
           @if(isset($_GET['ref']) && $_GET['ref']=='oc' )
            <?php $thumbnail = asset('sximo/assets/images/our_collection.png'); ?>
           @endif
           @if(isset($_GET['ref']) && $_GET['ref']=='syd' )
            <?php $thumbnail =  asset('sximo/assets/images/select_your_destination.png'); ?>
           @endif
           @if(isset($_GET['ref']) && $_GET['ref']=='sye' )
             <?php $thumbnail = asset('sximo/assets/images/selec_your_exprince.png'); ?>
           @endif
           @if(isset($_GET['ref']) && $_GET['ref']=='sbd' )
            <?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
           @endif 
         @if(isset($_GET['ref']))
        <script>
            jQuery(document).ready(function($) {
                $("#back_button_page").tooltip({ content: '<img src="{{$thumbnail}}"/>' });
                $(document).on('click','#back_button_page',function(){
                    location.href = "{{url('/')}}?ref={{$_GET['ref']}}";
                    return fasle;
                });
            });
        </script>
        @endif
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
            .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }
            
            .slick-prev, .slick-next {
                color: #fff;
                height: auto;
                padding: 0;
                position: absolute;
                width: 20px;
            }
/*            .top-slick-filtes {
                width: 80%;
            }*/
            .slick-prev::before, .slick-next::before {
                color: #fff;
                font-size: 26px;
                font-weight: bold;
                line-height: 1;
                opacity: unset;
            }
            .top-nav-cities-filter .slick-prev, .slick-next {
                background-color: #322e2e;
                height: 100%;
                width: 80px;
            }
            .top-nav-cities-filter .slick-prev, .slick-next:hover, .top-nav-cities-filter .slick-prev, .slick-next:focus, .top-nav-cities-filter .slick-prev, .slick-next:active {
                background-color: #322e2e;
            }
/*            .top-slick-filtes .slick-next {
                right: -85px;
            }
            .top-slick-filtes .slick-prev {
                left: -85px;
            }
            .top-slick-filtes .slick-prev.slick-arrow.slick-disabled, .top-slick-filtes .slick-next.slick-arrow.slick-disabled  {
                background-color: #aaa9a9;
            }*/
            #cityfilters .slick-slide {
                height: auto;
            }
        </style>
    </head>
    <body id="main">
        
        
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
                        <div class="container-fluid logo-padding-left editorial-logo-align">
                           <!-- <div class="col-md-12-">
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
                            </div>-->
                            <div class="row">
                                @if(isset($_GET['ref']) && $_GET['ref']!='' )
                                    <button class="go-back-button" id="back_button_page">Go Back</button> 
                                    
                                @else
                                    <button class="go-back-button" onclick="goBack()">Go Back</button>
                                @endif       
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
                                    @if(empty($categoryslider))
										<div class="col-md-12">
											<div class="header-logo">
												<a href="{{url()}}">
													<img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Design Locations"/>
												</a>
											</div>
										</div>
									@endif
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
								
								@if(!empty($categoryslider))
									<div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: true}" style="margin-bottom:20px;margin-top:80px;">
										<ul style="" class="uk-slideshow uk-overlay-active">
											@foreach($categoryslider as $slides)
											<li style="" @if($categoryslider[0]==$slides) class="uk-active" @endif aria-hidden="true"><div style="background-image: url({{ URL::to('uploads/slider_images/'.$slides->slider_img)}});" class="uk-cover-background uk-position-cover"></div>
												<canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
												<div class="bh-slideshow-overlay uk-overlay-panel uk-overlay-fade uk-flex uk-flex-middle uk-flex-center">
													<div>
														<ul class="bh-slideshow-overlay-meta uk-subnav uk-subnav-line">
															<li>
																<span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
															</li>
														</ul>
														<h3 class="bh-slideshow-overlay-title">
															<a href="#">{{$slides->slider_title}}</a>
														</h3>
														<div class="bh-slideshow-overlay-content">{{$slides->slider_description}}</div>
														<a class="uk-margin-top uk-button uk-button-primary" href="http://{{$slides->slider_link}}" title="Do it yourself">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
													</div>
												</div>
												<div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
													<div>
														<ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
															<li>
																<span><a href="#" rel="category tag">{{$slides->slider_category}}</a></span>
															</li>
														</ul>
														<h3 class="bh-slideshow-thumbnail-split-preview-title">
															<a href="#">{{$slides->slider_title}}</a>
														</h3>
														<div class="bh-slideshow-thumbnail-split-preview-content">{{$slides->slider_description}}</div>
														<a class="uk-margin-top uk-button uk-button-primary" href="http://{{$slides->slider_link}}">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
													</div>
													<a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
													<a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
												</div>
											</li>
											@endforeach
										</ul>
									</div>
                                @endif
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
                                            {{--*/ $node_no = 1; $ads_node=0; /*--}}
                                            @foreach($propertiesArr as $props)
                                            @if($node_no%20==0)
												@if(!empty($reultsgridAds))
													@if(array_key_exists($ads_node,$reultsgridAds))
														<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">
															<div class="wrapperforliineedforlightboxremoval">
																<div class="cat_product_medium1">
																	<div class="pictureBox gridPicture">
																		<a title="{{$reultsgridAds[$ads_node]->adv_title}}" class="picture_link-" href="{{$reultsgridAds[$ads_node]->adv_link}}">
																		<h2 style="position:absolute; color:#fff;padding-left: 20px;">Advertiser</h2>
																			<img alt="{{$reultsgridAds[$ads_node]->adv_title}}" src="{{URL::to('uploads/users/advertisement/'.$reultsgridAds[$ads_node]->adv_img)}}" class="img-responsive" style="border: 2px solid #D3D6D2;padding: 3px 1px 3px 0px;">
																		</a>
																	</div>
																	<div class="listDetails">
																		<div class="photographBox">
																			<h2>
																				<a title="{{$reultsgridAds[$ads_node]->adv_title}}" class="photograph FltLft ai-filtreted-hotel-name" href="{{$reultsgridAds[$ads_node]->adv_link}}">
																					{{$reultsgridAds[$ads_node]->adv_title}}
																				</a> 
																			</h2>
																			
																		</div>
																		<div class="entire_story MrgTop5">
																			<p style="float: left;">{{$reultsgridAds[$ads_node]->adv_desc}}</p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													@endif
												@endif
												 {{--*/ $ads_node++; /*--}}
                                            @else
                                            <div class="productData col-xs-12 col-sm-6 col-md-4 col-lg-3 margin-bottom-10">
                                                <div class="wrapperforliineedforlightboxremoval">
                                                    <div class="cat_product_medium1">
                                                        <div class="pictureBox gridPicture">
                                                            @if($props['data']->price!='')
                                                            <?php /*<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
                                                                From EUR {{$props['data']->price}} / night 
                                                            </a> */ ?>
                                                            @endif
                                                            @if(array_key_exists('image', $props))
                                                            <a title="{{$props['image']->file_name}}" class="picture_link detail_view-" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">

                                                                <img alt="{{$props['image']->file_name}}" src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" class="img-responsive">


                                                            </a>
                                                            @else
                                                            <a class="picture_link detail_view-" rel="{{$props['data']->id}}" href="{{URL::to('our-collection/'.$props['data']->property_slug)}}">
                                                                <img class="img-responsive" src="{{URL::to('sximo/assets/images/img-1.jpg')}}" alt="">
                                                            </a>
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

                                            @endif
                                            {{--*/ $rw++ /*--}}
                                            {{--*/ $node_no++ /*--}}
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
                    <input class="ai_search_keywords" value="{{$keyword}}" type="hidden" />
                    <input class="ai-arrive-date-filter" value="<?php echo (isset($_REQUEST['arrive'])) ? date('d-m-Y', strtotime($_REQUEST['arrive'])) : date("d-m-Y"); ?>" type="hidden" />
                    <input class="ai-depart-date-filter" value="<?php echo (isset($_REQUEST['destination'])) ? date('d-m-Y', strtotime($_REQUEST['destination'])) : date("d-m-Y", strtotime("+ 1 day")); ?>" type="hidden" />
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
        if ( + nxtpg <= + totlpgs) {
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
        data: 's=' + $(".ai_search_keywords").val() + '&arrive=' + $(".ai-arrive-date-filter").val() + '&destination=' + $(".ai-depart-date-filter").val() + '&page=' + nxtpg + queryStrng + "&filter_min_price=" + $("#filter_min_price").val() + "&filter_max_price=" + $("#filter_max_price").val(),
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
        var node_no = 1;
        var total_rows = 0;
        $.each($.parseJSON(data.properties), function(idx, obj) {
        if (node_no % 20 == 0) {
        html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
        html += 'Advertisement Here';
        html += '</div>';
        }
        else {
        html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
        html += '<div class="wrapperforliineedforlightboxremoval">';
        html += '<div class="cat_product_medium1">';
        html += '<div class="pictureBox gridPicture">';
        if (obj.pdata.price != '')
        {
        html += '<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / night </a>';
        }
        if (obj.hasOwnProperty("image")) {
        html += '<a title="' + obj.image.file_name + '" class="picture_link detail_view-" rel="' + obj.pdata.id + '" href="{{URL::to('our-collection/')}}/' + obj.pdata.property_slug + '">';
        var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
        html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
        html += '</a>';
        } else{
            html += '<a class="picture_link detail_view-" rel="' + obj.pdata.id + '" href="{{URL::to('our-collection/')}}/' + obj.pdata.property_slug + '">';
        var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
        html += '<img class="img-responsive" src="' + pimg + '" alt="">';
        html += '</a>';
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
        }
        p++;
        node_no++;
        total_rows++;
        });
        $(".searchcount").html(total_rows + ' Hotel(s) Found for ' + $(".ai_search_keywords").val());
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
                chtml += '<div>';
                chtml += '<ul class="top-nav-cities-filter top-slick-filtes top-bar-filters-removed regular slider">';
                chtml += '<li class="active select-all">';
                chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + dest_area[0] + '\',\'city\');">';
                chtml += '<div class="filter-bg">';
                chtml += '<div class="right-text">(' + ttp + ')</div>';
                chtml += '<div class="clearfix"></div>';
                chtml += '<div class="top-filter-name">All Properties</div>';
                chtml += '</div>';
                chtml += '</a>';
                chtml += '<div style="display: none;" class="city-filter-node-overlay">';
                chtml += '<a class="city-filter-node-heading">Heading</a>';
                chtml += '<div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>';
                chtml += '</div>';
                chtml += '</li>';
                $.each($.parseJSON(data.cities), function(idx, cobj) {
                    var cimg = "{{URL::to('uploads/category_imgs/')}}/" + cobj.category_image;
                    chtml += '<li>';
                    chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + cobj.id + '\',\'city\');">';
                    chtml += '<div class="filter-bg" style="background-image: url(\'' + cimg + '\');">';
                    chtml += '<div class="right-text">(' + cobj.totalproperty + ')</div>';
                    chtml += '<div class="clearfix"></div>';
                    chtml += '<div class="top-filter-name">' + cobj.category_name + '</div>';
                    chtml += '</div>';
                    chtml += '</a>';
                    chtml += '<div style="display: none;" class="city-filter-node-overlay">';
                    chtml += '<a class="city-filter-node-heading">Heading</a>';
                    chtml += '<div class="city-filter-node-details">Testing testing testing testing testing testing testing</div>';
                    chtml += '</div>';
                    chtml += '</li>';
                });
                chtml += '</ul>';
                chtml += '</div>';
                chtml += '</div>';
                chtml += '</div>';
                chtml += '<script>';
                chtml += '$(\'.top-nav-cities-filter\').slick({';
                    chtml += 'slide: \'li\',';
                    chtml += 'dots: false,';
                    chtml += 'infinite: false,';
                    chtml += 'slidesToShow: 3,';
                    chtml += 'slidesToScroll: 1,';
                    chtml += 'cssEase: \'ease-out\',';
                    chtml += 'variableWidth: false,';
                    chtml += 'responsive: [';
                        chtml += '{';
                            chtml += 'breakpoint: 1024,';
                            chtml += 'settings: {';
                                chtml += 'slidesToShow: 3,';
                                chtml += 'slidesToScroll: 1,';
                            chtml += '}';
                        chtml += '},';
                        chtml += '{';
                            chtml += 'breakpoint: 600,';
                            chtml += 'settings: {';
                                chtml += 'slidesToShow: 2,';
                                chtml += 'slidesToScroll: 1';
                            chtml += '}';
                        chtml += '},';
                        chtml += '{';
                            chtml += 'breakpoint: 480,';
                            chtml += 'settings: {';
                                chtml += 'slidesToShow: 1,';
                                chtml += 'slidesToScroll: 1,';
                                chtml += 'arrows:false,';
                            chtml += '}';
                        chtml += '}';
                    chtml += ']';
                chtml += '});';
                chtml += '$(document).on(\'click\', \'.top-slick-filtes li.select-all\', function () {';
                    chtml += 'if ($(this).hasClass("active")) {';
                        chtml += '$(\'.top-slick-filtes li\').addClass("active");';
                        chtml += '$(this).removeClass("active");';
                    chtml += '} else {';
                        chtml += '$(\'.top-slick-filtes li\').removeClass("active");';
                        chtml += '$(this).addClass("active");';
                    chtml += '}';
                chtml += '});';
                chtml += '$(document).on(\'click\', \'.top-slick-filtes li\', function () {';
                    chtml += 'if (!$(this).hasClass("select-all")) {';
                        chtml += '$(this).toggleClass("active");';
                        chtml += '$(\'.top-slick-filtes li.select-all\').removeClass("active");';
                    chtml += '}';
                chtml += '});';
                chtml += '$(document).on(\'click\', \'.clear-all-filters a\', function (event) {';
                    chtml += 'event.preventDefault();';
                    chtml += '$(\'.top-slick-filtes li\').removeClass("active");';
                    chtml += '$(\'.top-slick-filtes li.select-all\').addClass("active");';
                chtml += '});';
                chtml += '<\/script>';
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
//        alert(error);
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

                        function filter_property() {
                        $('#filter_min_price').val('0');
                        $('#filter_max_price').val(6000 - +$("#slider-range").slider("value"));
                        $('#listrecrds').val(0);
                        $('#nxtpg').val('1');
                        var it_scroll = false;
                        scrollDownloadData(it_scroll);
                        $('#listrecrds').val(21);
                        }

                        function experience_property_filter( keywords ) {
                            $(".ai_search_keywords").val(keywords);
                            $('#listrecrds').val(0);
                            $('#listrecrds').val(0);
                            $('#nxtpg').val('1');
                            var it_scroll = false;
                            scrollDownloadData(it_scroll);
                            $('#listrecrds').val(21);
                            return false;
                        }

                        $(document).ready(function () {
                            $(".ai-ajax-searchform-navbar").submit(function ( event ){
                                event.preventDefault();
                                $("#search-navbar.ai-ajax-search-input").typeahead('close');
                                $(".ai_search_keywords").val($("#search-navbar.ai-ajax-search-input").val());
                                $('#listrecrds').val(0);
                                $('#listrecrds').val(0);
                                $('#nxtpg').val('1');
                                var it_scroll = false;
                                scrollDownloadData(it_scroll);
                                $('#listrecrds').val(21);
                            });
                            $(".ai-date-filters").submit(function ( event ){
                                event.preventDefault();
                                $(".ai-arrive-date-filter").val($(this).find(".ai-arrive-date").val());
                                $(".ai-depart-date-filter").val($(this).find(".ai-depart-date").val());
                                $('#listrecrds').val(0);
                                $('#listrecrds').val(0);
                                $('#nxtpg').val('1');
                                var it_scroll = false;
                                scrollDownloadData(it_scroll);
                                $('#listrecrds').val(21);
                            });
                        });
                    </script>
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="filter-grid-page-side-bar">
                                <div class="filters-gird-page-side-bar-filter-align">
                                    <div class="design-locations-logo">
                                        <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                    </div>
                                    <div class="design-locations-logo filters-page-serch-bar-align">
                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar ai-ajax-searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead search-navbar ai-ajax-search-input" name="s" id="search-navbar" placeholder="SEARCH" type="text">
                                            <input class="hidden" type="submit" value="Submit" />
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">Filter BY Price</div>
                                            </a>
                                            <div id="filter-by-price" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div class="filter-by-price">
                                                            <div id="slider-range" class="filter-slider"></div>
                                                            <p>
                                                                <span class="price-high-low-filter-text">High - Low</span>
                                                                <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                                <input id="filter_min_price" type="hidden" value="" />
                                                                <input id="filter_max_price" type="hidden" value="" />
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
                                                            <form class="filter-menu-booking ai-date-filters" action="{{url::to('search')}}">
                                                                <input name="s" value="<?php echo (isset($_REQUEST['s'])) ? $_REQUEST['s'] : '' ?>" type="hidden" />
                                                                <input name="adult" value="<?php echo (isset($_REQUEST['adult'])) ? $_REQUEST['adult'] : '1' ?>" type="hidden" />
                                                                <input name="childs" value="<?php echo (isset($_REQUEST['childs'])) ? $_REQUEST['childs'] : '0' ?>" type="hidden" />
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Arrive</label>
                                                                    <input id="filter-date-mobile" class="ai-arrive-date" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="arrive" value="<?php echo (isset($_REQUEST['arrive'])) ? date('d-m-Y', strtotime($_REQUEST['arrive'])) : date("d-m-Y"); ?>" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Depart</label>
                                                                    <input id="filter-date-mobile-departure" class="ai-depart-date" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="destination" value="<?php echo (isset($_REQUEST['destination'])) ? date('d-m-Y', strtotime($_REQUEST['destination'])) : date("d-m-Y", strtotime("+ 1 day")); ?>" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <input class="black-submit-btn" value="Search" type="submit">
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
                                                                <label><a onclick="experience_property_filter('Beach Hotels');" href="javascript:void(0);">Go Beach Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Green Properties');" href="javascript:void(0);">Go Green Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Go Urban Hotels');" href="javascript:void(0);">Go Urban Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Infinity Pools');" href="javascript:void(0);">Go Infinity Pools</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Spa & Wellness Hotels');" href="javascript:void(0);">Go Spa & Wellness Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Mountain Ski Resorts');" href="javascript:void(0);">Go Mountains and Skin Resorts</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Yoga Hotels');" href="javascript:void(0);">Discover Yoga Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Culinary Delights');" href="javascript:void(0);">Discover culinary Delight Hotels</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Family Friendly');" href="javascript:void(0);">Discover Family Friendly Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a onclick="experience_property_filter('Unusual Adventure Hotels');" href="javascript:void(0);">Unusual Adventure Hotels</a></label>
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
                                                            @if(array_key_exists('childs',$mndest) && !empty($mndest->childs))
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
                                    <section class="regular slider">
                                        <div class="slick-cstm-width">
                                            <div class="side-bar-why-book-with-us">
                                                <div class="book-with-us-tittles">
                                                    <h2>Why book with us?</h2>
                                                </div>
                                                <ul class="side-bar-book-with-us-list">
                                                    <li>
                                                        <h3>Handpicked Selection of Hotels.</h3>
                                                        <p>Over 200 destination at the best rate</p>
                                                    </li>
                                                    <li>
                                                        <h3>Upgrade & Late Check-out</h3>
                                                        <p>At any hotel, upon avialability</p>
                                                    </li>
                                                    <li>
                                                        <h3>Upto 50% off at New Hotels</h3>
                                                        <p>Exclusive community invitations</p>
                                                    </li>
                                                    <li>
                                                        <h3>Free WiFi</h3>
                                                        <p>Gurranted at all Hotels</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if(!empty($sidebargridAds))
											@foreach($sidebargridAds as $slides)
												<div class="slick-cstm-width">
													<a href="http://{{$slides->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$slides->adv_img)}}"></a>
												</div>
											@endforeach
                                        @endif
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
                    <script type="text/javascript">
						$(document).on('ready', function () {
							$(".regular").slick({
								dots: false,
								infinite: true,
								slidesToShow: 1,
								slidesToScroll: 1,
								prevArrow: false,
								nextArrow: false,
								autoplay: true,
								autoplaySpeed: 3000
							});
						});
                    </script>
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
                        if ($('#two-inputs').length > 0) {
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
                        }
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
                        if ($("#mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
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
