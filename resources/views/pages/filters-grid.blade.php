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
        <!--link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet"-->
        
        <link href="../../../public/sximo/assets/css/style.min.css" rel="stylesheet" type="text/css"/>
        
        <link href="{{ asset('sximo/assets/css/test-res.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery2.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/uikit.js')}}"></script>

        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <!--script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script-->
        <script src="{{ asset('sximo/assets/js/html2canvas.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/active-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
        <!--Filters Grid Page-->
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/cities-filter.css')}}" rel="stylesheet" type="text/css"/>
		
		<link href="{{ asset('sximo/assets/newgrid/css/animate.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('sximo/assets/newgrid/css/style1.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('sximo/assets/newgrid/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
		<script src="{{ asset('sximo/assets/newgrid/js/skrollr.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/smooth-scroll.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/swiper.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/isotope.pkgd.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/main.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/wow.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/jquery.fitvids.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/skill.bars.jquery.js')}}" type="text/javascript"></script>
        
        @if(isset($_GET['ref']) && $_GET['ref']=='oc' )
        <?php $thumbnail = asset('sximo/assets/images/our_collection.png'); ?>
        @elseif(isset($_GET['ref']) && $_GET['ref']=='syd' )
        <?php $thumbnail = asset('sximo/assets/images/select_your_destination.png'); ?>
        @elseif(isset($_GET['ref']) && $_GET['ref']=='sye' )
        <?php $thumbnail = asset('sximo/assets/images/selec_your_exprince.png'); ?>
        @elseif(isset($_GET['ref']) && $_GET['ref']=='sbd' )
        <?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
        @else
        <?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
        @endif 
        @if(isset($_GET['ref']))
        <script>
jQuery(document).ready(function($) {
$("#back_button_page").tooltip({ content: '<img src="{{$thumbnail}}"/>' });
$(document).on('click', '#back_button_page', function(){
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
            #yachts-refine-search-filter input, .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }
            .filter-by-price > select {
                background-color: #dadad5;
                border: 1px solid #333;
                margin-right: 5px;
                width: calc(50% - 7px);
            }
            .filter-by-price > select option {
                padding: 10px 5px;
            }
            .filter-fw-select {
                background-color: #2e2e2e;
                border: 1px solid #5f5f5f;
                border-radius: 0;
                color: #fff;
                width: 100%;
            }
            .filter-fw-select > option {
                min-height: 26px;
                padding: 5px;
            }
            .current-page-heading {
                font-family: serif;
                font-size: 18px;
                font-style: italic;
                color: #000;
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
            .overlay-text {
                background: rgba(0, 0, 0, 0.68) none repeat scroll 0 0;
                bottom: 0;
                display: none;
                padding: 30px 10px;
                position: absolute;
                text-align: center;
                top: 0;
                width: 100%;
            }
            .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text{
                font-family: serif;
                border-bottom: 3px solid #f3bc3a;
                color: #fff;
                overflow-wrap: break-word;
                font-size: 20px;
                font-style: normal;
                font-style: italic;
            }
            .yacths-des-text {
                color: #fff;
                font-size: 18px;
                margin: 0;
            }
            .yacths-des-text-align {
                margin-top: 4px;
            }
            .yacths-des-text span {
                padding: 0px 5px;
            }
            .cat_product_medium1:hover .overlay-text {
                display: block;
            }
            .cat_product_medium1:hover .overlay-text-frezeed {
                display: none;
            }
            .overlay-text-frezeed {
                background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
                bottom: 0;
                left: 0;
                padding-top: 88px;
                position: absolute;
                right: 0;
                text-align: center;
                top: 0;
            }
            .overlay-text-frezeed .yacts-tittle-text {
                border: medium none;
                font-size: 16px;
            }
            .overlay-text-frezeed .yacths-des-text.yacths-des-text-align {
                font-size: 14px;
                margin-top: 2px;
            }
            .cat_product_medium1:hover .ai-grid-page-node-pic-box {
                transform: scale(1.06);
                transition: all 0.2s ease-out 0s;
            }
            .cat_product_medium1 {
                overflow: hidden;
            }
            .hotel .overlay-text-frezeed {
                display: none;
            }
            .hotel .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text {
                border-bottom: medium none;
                font-size: 17px;
            }
            .hotel .yacths-des-text {
                font-size: 14px;
            }
            .hotel .grid-box-main .yacts-overlay-text{
                display: none;
            }
            .yachts .grid-box-main .hotel-overlay-text{
                display: none;
            }
            .hotel .overlay-text {
                padding: 37px 10px 20px;
            }
            .cat_product_medium1 .pictureBox.gridPicture {
                position: relative !important;
            }
            .cat_product_medium1 .ai-grid-page-node-pic-box {
                position: relative !important;
            }
            .ai-grid-tiitles a {
                color: #000 !important;
                font-size: 18px;
            }
            .ai-view-hotels-tittle a {
                background: transparent url("../../../uploads/images/arrow_right_black.png") no-repeat scroll right 5px;
                clear: left;
                float: left;
                font-family: serif;
                font-size: 14px;
                padding: 0 7px 0 0;
            }
            .ai-view-hotels-tittle a {
                color: #9b9b9b;
            }
            .ai-grid-tiitles h2 {
                color: #000;
                font-family: serif;
                font-size: 17px;
                font-style: italic;
                height: auto;
                margin-bottom: 0;
                margin-top: 10px;
            }
            .ai-grid-tiitles h2:hover, .ai-grid-tiitles h2:focus, .ai-grid-tiitles h2:active {
                color: #000;
                font-family: serif;
                font-size: 17px;
                font-style: italic;
                height: auto;
                margin-bottom: 0;
                margin-top: 10px;
            }
            .productData {
                min-height: 250px;
            }
            .ai-grid-page-node-pic-box  img {
                max-height: 165px !important;
                min-height: 165px !important;
                object-fit: cover;
                object-position: 0 center;
                vertical-align: middle;
                width: 100%;
            }
            .ai-view-hotels-tittle a:hover, .ai-view-hotels-tittle a:focus, .ai-view-hotels-tittle a:active {
                color: #000 !important;
            }
            .cat_product_medium1:hover  .textButton.arrowButton.MrgTop5.ai-filter-hotel-price-style{
                display: none;
            }
            @media screen and (min-width: 1800px){
                .ai-grid-page-node-pic-box  img {
                    max-height: 250px !important;
                    min-height: 250px !important;
                }
            }

            img.propovericons {
                position: absolute;
                top: 5px;
                right: 10px;
                z-index: 100;
                max-height: 80px !important;
                width: 80px !important;
                min-height: 80px !important;
            }
            .node-btn.active {
                border-bottom: 2px solid;
            }
            
            /* AIC HK 30-12-2017*/
            .FloatFilter {
                float: right;
            }
            
            /* AIC Harman email sidebar css */
            
        .site-aside {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            overflow-x: visible;
            z-index: 1028;
    }
        .contact-aside {
            border-radius: 2px;
            transition: .5s;
            position: fixed;
            top: 63px;
            left: calc(100% - 43px);
            width: 291px;
            background: #272727;
            color: #fff;
            font-size: 15px;
            right: 0;
        }
        .contact-aside ul {
            padding: 7px 0;
            list-style: none;
        }
        .contact-aside li {
	padding: 6.333px 0px 6px 5px;
	margin: 0px 5px 1px 0px;
        }
        .contact-aside {
            color: #fff;
            font-size: 15px;
        }
        .contact-aside [class*="icon-"] {
            display: inline-block;
            width: 24px;
            text-align: center;
            margin-right: 4px;
            float: right;
        }
        .contact-aside li + li {
            border-top: 1px solid #4A4A4A;
        }
        .contact-aside .icon-mail {
            position: relative;
            top: 2px;
        }
        .contact-aside.active {
            left: calc(100% - 290px);
            background: #1e2023 !important;
            color: #fff !important;
        }
        
        .asideIclass {
            float: left;
            margin-top: 3px;
            margin-right: 13px;
            margin-left: 8px;
            color: #c7ab84;
        }
        
         /* sidebar css */
            
            
        </style>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110391807-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-110391807-1');
		</script>
    </head>
    <body id="main" class="here <?php echo (isset($slug)) ? strtolower($slug) : '' ?>">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
<!--                        <div class="container-fluid editorial-logo-align">
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
                            <div class="go-back-button-container">
                                @if(isset($_GET['ref']) && $_GET['ref']!='' )
                                <button class="go-back-button" id="back_button_page">Go Back</button> 

                                @else
                                <button class="go-back-button" onclick="goBack()">Go Back</button>
                                @endif
                                <div class="previous-page-screen-short-container"></div>
                            </div>
                        </div>-->
                    </header>
                    <!--AIC header -->
                    
                    
                    <!-- header end -->
                    <div class="filter-page-main-align">
                        <div class="col-md-10 col-sm-9 FloatFilter">
                            <div class="row">
                                <!-- AIC Harman top bar adding -->
                                <section class="book-form-top-bar">
                                    <div>
                                        <div class="booking-form-bar-top">
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar top-bar-search-form-align" action="{{URL::to('search')}}">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group would-like-input top-bar-search padding-right-12">
                                                            <input  class="form-control ai-custom-deafault-style bh-search-input typeahead search-box searchbox_landing" name="s" id="search-navbar" placeholder="Enter Your Hotel or Destination" type="text" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div id="top-bar-search-booking-form">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group padding-right-12">
                                                                        <input id="top-bar-search-booking-form-arrive" class="form-control ai-custom-deafault-style" name="arrive" type="text" placeholder="Arriving">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="form-group padding-right-12">
                                                                        <input id="top-bar-search-booking-form-destination" class="form-control ai-custom-deafault-style" name="destination" type="text" placeholder="Departing">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <div class="dropdown top-search-members-list">
                                                                <div class="top-search-members-inner-align">
                                                                    <div class="members-list ai-custom-deafault-style">
                                                                        <span id="adults-val">1</span>
                                                                        Adults,
                                                                        <span id="childern-val">0</span>
                                                                        Children
                                                                        <span class="right-down-arrow">
                                                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                                        </span>
                                                                    </div>
                                                                    <ul class="members-drop-list" style="display: none;">
                                                                        <li>
                                                                            <label>Adult</label>
                                                                            <input id="adult-input-value" name="adult" class="input-right" value="2" min="1" max="10" type="number">
                                                                        </li>
                                                                        <li>
                                                                            <label>Children</label>
                                                                            <input id="childerns-input-value" name="childs" class="input-right" value="0" min="0" max="10" type="number">
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">     
                                                         <?php  $currencyList=(CommonHelper::getCurrencyList()); ?>
                                                            <select name='currencyOption' class="form-control">
                                                                <option value="EUR">Currency</option>
                                                                @foreach($currencyList as $currencyCode => $currencyName)

                                                                    <option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
                                                                </option>

                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <button class="top-booking-bar-btn" type="submit">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- AIC Harman email phone sidebar add start -->
                                        
                                        <aside class="site-aside">
                                            <div class="contact-aside">
                                                <ul class="contact-aside-list">
                                                    <li class="contact-list-item contact-phone"><a href="tel:+49 172 8937230"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +49 172 8937230</a></li>
                                                    <li class="contact-list-item contact-email"><a href="mailto:bookings@emporium-voyage.com"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> bookings@emporium-voyage.com</a></li>
                                                </ul>
                                            </div>
                                        </aside>
                                        
                                        <!-- AIC Harman email phone sidebar add end-->
                                        
                                    </div>
                                </section>
                                <!-- top bar end-->
                                
                                <script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
                                <script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"></script>
                                <?php /* <div class="header container-fluid">
                                    @if(empty($categoryslider))
                                    <div class="col-md-12">
                                        <div class="header-logo">
                                            <a href="{{url()}}">
                                                <img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Emporium Yachts."/>
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
                               */ ?>
                                <div class="sticky-header-offset"></div>
                                <div style="display: none;" class="grid-page-category-slider-container">
                                    <div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: false}">
                                        <ul style="height: 650px;" class="uk-slideshow uk-overlay-active">
                                            <li style="height: 650px;" class="uk-active" aria-hidden="true"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
                                                <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
                                                <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                                                    <div>
                                                        <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                                                            <li>
                                                                <span>Beach Hotels</span>
                                                            </li>
                                                        </ul>
                                                        <h3 class="bh-slideshow-thumbnail-split-preview-title">
                                                            <a href="#">Beach Must show Here. </a>
                                                        </h3>
                                                        <div class="bh-slideshow-thumbnail-split-preview-content">Beach Must show Here. </div>
                                                        <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                                                    </div>
                                                    <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                                                    <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                                                </div>
                                            </li>
                                            <li style="height: 650px;" class="uk-active" aria-hidden="true"><div style="background-image: url({{ asset('sximo/assets/images/editorial-banner.png')}});" class="uk-cover-background uk-position-cover"></div>
                                                <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
                                                <div class="bh-slideshow-thumbnail-split-preview uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                                                    <div>
                                                        <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                                                            <li>
                                                                <span>Beach Hotels 2</span>
                                                            </li>
                                                        </ul>
                                                        <h3 class="bh-slideshow-thumbnail-split-preview-title">
                                                            <a href="#">Beach Must show Here. </a>
                                                        </h3>
                                                        <div class="bh-slideshow-thumbnail-split-preview-content">Beach Must show Here. </div>
                                                        <a class="uk-margin-top uk-button uk-button-primary" href="#">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                                                    </div>
                                                    <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                                                    <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Main Page Start here-->
                                @if($currentPage==0)
                                @if(!empty($categoryslider))
                                <!--<h2 class="current-page-heading" style="text-align:center;">Our Featured Members</h2>-->
                                <div class="bh-slideshow-thumbnail-split hidden-xs hidden-sm" data-uk-slideshow="{animation: 'slice-up', autoplay: true}" style="margin-top:40px;">
                                    <ul style="height: 620px;" class="uk-slideshow uk-overlay-active">
                                        @foreach($categoryslider as $slides)
                                        <li style="height: 620px;" @if($categoryslider[0]==$slides) class="uk-active" @endif aria-hidden="true"><div style="background-image: url({{ URL::to('uploads/slider_images/'.$slides->slider_img)}});" class="uk-cover-background uk-position-cover"></div>
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
                                @endif
                                <div class="container">
                                    <div class="row">
                                        <div class="header-navigation-container col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    @include('layouts/elliot/ai_navigation')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
                                    <div class="row">
                                        <div class="locator clear"></div>
                                    </div>
                                    <div id="cityfilters">
                                            @if(!empty($cities))

                                         <div class="row" style="padding-bottom: 8px;background: #f0f0f0;padding-top: 8px;margin-bottom: 15px;">
                                             <div class="col-md-6 col-xs-12 text-right">
                                                Filter By Luxury Destination
                                             </div>
                                             <div class="col-md-6 col-xs-12">
                                                <select onchange="filter_destination(this.value ,'city')">
                                                    @foreach($cities as $citieVal)
                                                    <option value="{{ $citieVal->id }}">{{ $citieVal->category_name.'('.$citieVal->totalproperty.')'}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                         </div>
                                         @endif
                                    </div>
                                    <h2 class="current-page-heading">Our Selection of <?php echo (isset($type)) ? $type : 'Premium Selected Suites'; ?></h2>
                                    

                                    <div id="listproperties">
                                        <div class="row no-margin">
											<div class="filter-content overflow-hidden margin-100px-top sm-margin-75px-top xs-margin-50px-top">
												<ul class="portfolio-grid work-4col hover-option2 gutter-small">
													<li class="grid-sizer"></li>
                                            <?php
                                            if($propertiesArr) {
                                                $rw = 1;
                                                $node_no = 1;
                                                $ads_node = 0;
                                                foreach($propertiesArr as $props) { ?>
									
													<li class="grid-item wow fadeInUp">
														<a href="{{URL::to($props['data']->property_slug)}}">
															<figure>
																<div class="portfolio-img bg-deep-pink">			@if(array_key_exists('image', $props))
																		<img alt="<?php echo $props['image']->file_name; ?>" src="<?php echo URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name); ?>">
																	@else
																		<img src="http://placehold.it/800x560" alt=""/>
																	@endif
																</div>
																<figcaption>
																	<div class="portfolio-hover-main text-left">
																		<div class="portfolio-hover-box vertical-align-bottom">
																			<div class="portfolio-hover-content position-relative last-paragraph-no-margin">
																				<span class="font-weight-600 line-height-normal alt-font text-white text-uppercase margin-one-half-bottom display-block">{{$props['data']->property_name}}</span>
																				<p class="text-white text-uppercase text-extra-small">From € {{$props['data']->price}} </p>
																			</div>
																		</div>
																	</div>
																</figcaption>
															</figure>
														</a>
														<div class="listDetails">
															<div class="photographBox ai-grid-tiitles">
																<h2>
																	<a title="{{$props['data']->property_name}}" class="photograph FltLft ai-filtreted-hotel-name" rel="2216" href="{{URL::to($props['data']->property_slug)}}">
																	{{$props['data']->property_name}}
																	</a>
																	<span class="FltRgt">
																		<a class="carticon" href="javascript:void(0)" onclick="submitgridbookform('{{$props['data']->property_slug}}#*{{$props['data']->id}}');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>
																	</span>
																</h2>
															</div>
															<div class="entire_story MrgTop5 ai-view-hotels-tittle">
																<a class="textButton arrowButton detail_view MrgTop5" rel="<?php echo $props['data']->id; ?>" href="#">
																	Quick View 
																</a>
															</div>
															<div class="showOnHover">
																<div class="hover_request">
																</div>   
															</div>
														</div>
													</li>
													<?php /*
                                                    if($node_no%20==0) {
                                                        if(!empty($reultsgridAds)) {
                                                            if(array_key_exists($ads_node,$reultsgridAds)) {
                                                                ?>
                                                                <div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">
                                                                    <div class="wrapperforliineedforlightboxremoval">
                                                                        <div class="cat_product_medium1">
                                                                            <div class="ai-grid-page-node-pic-box pictureBox gridPicture">
                                                                                <a title="<?php echo $reultsgridAds[$ads_node]->adv_title; ?>" class="picture_link-" href="<?php echo $reultsgridAds[$ads_node]->adv_link; ?>">
                                                                                    <h2 style="position:absolute; color:#fff;padding-left: 20px;">Advertiser</h2>
                                                                                    <img alt="<?php echo $reultsgridAds[$ads_node]->adv_title; ?>" src="<?php echo URL::to('uploads/users/advertisement/'.$reultsgridAds[$ads_node]->adv_img); ?>" class="img-responsive" style="border: 2px solid #D3D6D2;padding: 3px 1px 3px 0px;">
                                                                                </a>
                                                                            </div>
                                                                            <div class="listDetails">
                                                                                <div class="photographBox">
                                                                                    <h2>
                                                                                        <a title="<?php echo $reultsgridAds[$ads_node]->adv_title; ?>" class="photograph FltLft ai-filtreted-hotel-name" href="<?php echo $reultsgridAds[$ads_node]->adv_link; ?>">
                                                                                            {{$reultsgridAds[$ads_node]->adv_title}}
                                                                                        </a> 
                                                                                    </h2>
                                                                                </div>
                                                                                <div class="entire_story MrgTop5">
                                                                                    <p style="float: left;"><?php echo $reultsgridAds[$ads_node]->adv_desc; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        $ads_node++;
                                                    }
                                                    else {
                                                        ?>
                                                        <div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">
                                                            <div class="wrapperforliineedforlightboxremoval">
                                                                <div class="cat_product_medium1">
                                                                    <div class="ai-grid-page-node-pic-box pictureBox gridPicture grid-box-main" >
                                                                        <?php
                                                                        if($props['data']->price!='') {
                                                                            /* <a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="{{$props['data']->id}}" href="{{URL::to($props['data']->property_slug)}}">
                                                                          From EUR {{$props['data']->price}} / <?php echo (isset($slug) && strtolower($slug) == 'yachts')? 'week' : 'night' ?>
                                                                          </a> */
                                                                        /*}
                                                                        if(array_key_exists('image', $props)) {
                                                                            ?>
                                                                            @if($props['data']->editor_choice_property=='1')
                                                                                <img alt="editor_choice_property" class="propovericons" src="{{URL::to('sximo/images/editors-choice.png')}}">
                                                                            @elseif($props['data']->feature_property=='1')
                                                                                <img alt="editor_choice_property" class="propovericons" src="{{URL::to('sximo/images/featured-property.png')}}">
                                                                            @endif
                                                                        <a title="<?php echo $props['image']->file_name; ?>" class="picture_link-" href="<?php echo URL::to($props['data']->property_slug); ?>">
                                                                                <div class="overlay-text-frezeed">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>&euro;<?php echo $props['data']->price; ?> </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                                </div>
                                                                                <div class="overlay-text hotel-overlay-text">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>From &euro;<?php echo $props['data']->price; ?> </span><?php echo (isset($props['data']->category_name))? '|<span>'.$props['data']->category_name.'</span>' : ''; ?></p>
                                                                                </div>
                                                                                <div class="overlay-text yacts-overlay-text">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>&euro;<?php echo $props['data']->price; ?> </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                                    <p class="yacths-des-text">2015H</p>
                                                                                </div>
                                                                            <img alt="<?php echo $props['image']->file_name; ?>" src="<?php echo URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name); ?>" class="img-responsive">
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        else {
                                                                            ?>
                                                                        <div class="overlay-text-frezeed">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                                </div>
                                                                                <div class="overlay-text hotel-overlay-text">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>From &euro;<?php echo $props['data']->price; ?> </span>|<span>New York</span></p>
                                                                                </div>
                                                                                <div class="overlay-text yacts-overlay-text">
                                                                                    <h2 class="yacts-tittle-text"><?php echo $props['data']->property_name; ?></h2>
                                                                                    <p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>
                                                                                    <p class="yacths-des-text">2015H</p>
                                                                                </div>
                                                                        <?php
                                                                            echo '<img class="img-responsive" src="', URL::to('sximo/assets/images/img-1.jpg'), '" alt="">';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="listDetails">
                                                                        <div class="photographBox ai-grid-tiitles">
                                                                            <h2>
                                                                                <a title="<?php echo $props['data']->property_name; ?>" class="photograph FltLft ai-filtreted-hotel-name" rel="<?php echo $props['data']->id; ?>" href="<?php echo URL::to($props['data']->property_slug); ?>">
                                                                                    <?php echo $props['data']->property_name; ?>
                                                                                </a>
                                                                                <span class="FltRgt">
                                                                                    <!--<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" <?php // echo (array_key_exists('image', $props))? 'onclick="add_to_lightbox('.$props['image']->file_id.', '.$props['data']->id.');"' : ''; ?>></i>-->
                                                                                    <a class="carticon" href="javascript:void(0)" onclick="submitgridbookform('{{$props['data']->property_slug}}#*{{$props['data']->id}}');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>
                                                                                </span>
                                                                            </h2>
                                                                        </div>
                                                                        <div class="entire_story MrgTop5 ai-view-hotels-tittle">
                                                                            <a class="textButton arrowButton detail_view MrgTop5" rel="<?php echo $props['data']->id; ?>" href="#">
                                                                                Quick View 
                                                                            </a>
                                                                            <a class="textButton arrowButton MrgTop5" rel="<?php echo $props['data']->id; ?>" href="<?php echo URL::to($props['data']->property_slug); ?>">
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
                                                        <?php
                                                    }
                                                    if($rw%4==0) {
                                                        echo '</div><div class="row">';
                                                    }
                                                    $rw++;
                                                    $node_no++;
                                                    $totpage = $propertiesArr->appends($pager)->lastPage();
                                                    $newpage = $currentPage + 2;
                                                    $prevnewpage = $newpage - 2; */ ?>
													
													
                                                <?php }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="brgrid"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <input class="yacht_keywords" type="hidden" />
                                            <input class="hidden" type="submit" />
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <?php if (isset($slug) && strtolower($slug) == 'yachts'): ?>
                                            <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                    <div class="panel-heading custom-heading">Filter BY Price / Week</div>
                                                </a>
                                                <div id="filter-by-price" class="panel-collapse collapse">
                                                    <div class="panel-body custom-panel-body">
                                                        <div class="dl-filter">
                                                            <div class="filter-by-price">
                                                                <select onchange="$('#filter_min_price').val($(this).val()); filter_property();">
                                                                    <option value="0">No Min</option>
                                                                    <option value="200000">200,000</option>
                                                                    <option value="300000">300,000</option>
                                                                    <option value="400000">400,000</option>
                                                                    <option value="500000">500,000</option>
                                                                </select>
                                                                <select onchange="$('#filter_max_price').val($(this).val()); filter_property();">
                                                                    <option value="">No Max</option>
                                                                    <option value="200000">200,000</option>
                                                                    <option value="300000">300,000</option>
                                                                    <option value="400000">400,000</option>
                                                                    <option value="500000">500,000</option>
                                                                </select>
                                                                <input id="filter_min_price" type="hidden" value="0" />
                                                                <input id="filter_max_price" type="hidden" value="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#filter-by-price" class="heading-stying collapsed">
                                                    <div class="panel-heading custom-heading">Filter BY Price</div>
                                                </a>
                                                <div id="filter-by-price" class="panel-collapse collapse">
                                                    <div class="panel-body custom-panel-body">
                                                        <div class="dl-filter">
                                                            <div class="filter-by-price">
                                                                <div id="slider-range" class="filter-slider"></div>
                                                                <p class="filtered-text-align">
                                                                    <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                                    <input id="filter_min_price" type="hidden" value="" />
                                                                    <input id="filter_max_price" type="hidden" value="" />
                                                                </p>
                                                                <span class="price-high-low-filter-text">High - Low</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <!--Yachts Filters-->
                                        <?php if (isset($slug) && strtolower($slug) == 'yachts'): ?>
                                            <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#yachts-type-filter" class="heading-stying collapsed">
                                                    <div class="panel-heading custom-heading">
                                                        Yacht Type
                                                    </div>
                                                </a>
                                                <div id="yachts-type-filter" class="panel-collapse collapse <?php echo (isset($_GET['type'])) ? 'in' : ''; ?>">
                                                    <div class="panel-body custom-panel-body">
                                                        <div class="dl-filter">
                                                            <form>
                                                                <div class="form-group post-filter-inputs active">
                                                                    <label><a onclick="yachts_type_filter('Yachts for Charter');" href="javascript:void(0);">Yachts for Charter</a></label>
                                                                </div> 
                                                                <div class="form-group post-filter-inputs">
                                                                    <label><a onclick="yachts_type_filter('Sailing Yachts');" href="javascript:void(0);">Sailing Yachts</a></label>
                                                                </div> 
                                                                <div class="form-group post-filter-inputs">
                                                                    <label><a onclick="yachts_type_filter('Motor Yachts');" href="javascript:void(0);">Motor Yachts</a></label>
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label><a onclick="yachts_type_filter('Yachts for Sale');" href="javascript:void(0);">Yachts for Sale</a></label>
                                                                </div>
                                                                <input class="yacht_category" type="hidden" value="<?php echo $type; ?>" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default custom-post-panel">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#yachts-refine-search-filter" class="heading-stying collapsed">
                                                    <div class="panel-heading custom-heading">
                                                        Refine Search
                                                    </div>
                                                </a>
                                                <div id="yachts-refine-search-filter" class="panel-collapse collapse">
                                                    <div class="panel-body custom-panel-body">
                                                        <div class="dl-filter">
                                                            <div>
                                                                <form class="filter-refine-search-form filter-menu-booking" action="javascript:filter_property();void(0);">
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Year of Build</label>
                                                                        <select class="filter-fw-select" name="yacht_build_year">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_build_years)) {
                                                                                foreach ($yacht_build_years as $yacht_build_year) {
                                                                                    if (trim($yacht_build_year->yacht_build_year) != '') {
                                                                                        echo '<option value="' . $yacht_build_year->yacht_build_year . '">' . $yacht_build_year->yacht_build_year . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Guest</label>
                                                                        <select class="filter-fw-select" name="yachts_guest">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yachts_guests)) {
                                                                                foreach ($yachts_guests as $yachts_guest) {
                                                                                    if (trim($yachts_guest->yachts_guest) != '') {
                                                                                        echo '<option value="' . $yachts_guest->yachts_guest . '">' . $yachts_guest->yachts_guest . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Length</label>
                                                                        <select class="filter-fw-select" name="yacht_length">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_lengths)) {
                                                                                foreach ($yacht_lengths as $yacht_length) {
                                                                                    if (trim($yacht_length->yacht_length) != '') {
                                                                                        echo '<option value="' . $yacht_length->yacht_length . '">' . $yacht_length->yacht_length . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Builder</label>
                                                                        <select class="filter-fw-select" name="yacht_builder">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_builders)) {
                                                                                foreach ($yacht_builders as $yacht_builder) {
                                                                                    if (trim($yacht_builder->yacht_builder) != '') {
                                                                                        echo '<option value="' . $yacht_builder->yacht_builder . '">' . $yacht_builder->yacht_builder . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Beam</label>
                                                                        <select class="filter-fw-select" name="yacht_beam">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_beams)) {
                                                                                foreach ($yacht_beams as $yacht_beam) {
                                                                                    if (trim($yacht_beam->yacht_beam) != '') {
                                                                                        echo '<option value="' . $yacht_beam->yacht_beam . '">' . $yacht_beam->yacht_beam . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Draft</label>
                                                                        <select class="filter-fw-select" name="yacht_draft">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_drafts)) {
                                                                                foreach ($yacht_drafts as $yacht_draft) {
                                                                                    if (trim($yacht_draft->yacht_draft) != '') {
                                                                                        echo '<option value="' . $yacht_draft->yacht_draft . '">' . $yacht_draft->yacht_draft . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Cabins</label>
                                                                        <select class="filter-fw-select" name="yacht_cabins">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_cabins)) {
                                                                                foreach ($yacht_cabins as $yacht_cabin) {
                                                                                    if (trim($yacht_cabin->yacht_cabins) != '') {
                                                                                        echo '<option value="' . $yacht_cabin->yacht_cabins . '">' . $yacht_cabin->yacht_cabins . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <label>Crew</label>
                                                                        <select class="filter-fw-select" name="yacht_crew">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (!empty($yacht_crews)) {
                                                                                foreach ($yacht_crews as $yacht_crew) {
                                                                                    if (trim($yacht_crew->yacht_crew) != '') {
                                                                                        echo '<option value="' . $yacht_crew->yacht_crew . '">' . $yacht_crew->yacht_crew . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group post-filter-inputs">
                                                                        <input name="refine_search" value="Filter" type="submit">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="<?php echo (isset($slug) && strtolower($slug) == 'yachts') ? 'hidden' : ''; ?> panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#book-your-destination" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    SELECT YOUR DATES
                                                </div>
                                            </a>
                                            <div id="book-your-destination" class="panel-collapse collapse">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <div>
                                                            <form class="filter-menu-booking" action="{{url::to('search')}}">
                                                                <input name="s" value="" type="hidden" />
                                                                <input name="adult" value="1" type="hidden" />
                                                                <input name="childs" value="0" type="hidden" />
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Arrive</label>
                                                                    <input id="filter-date-mobile" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="arrive" value="<?php echo date("d-m-Y"); ?>" type="text">
                                                                </div>
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>Depart</label>
                                                                    <input id="filter-date-mobile-departure" data-format="DD-MM-YYYY" data-template="DD MMM YYYY" name="destination" value="<?php echo date("d-m-Y", strtotime("+ 1 day")); ?>" type="text">
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
                                        <div class="<?php echo (isset($slug) && strtolower($slug) == 'yachts') ? 'hidden' : ''; ?> panel panel-default custom-post-panel">
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
                                                                <label><a href="{{URL::to('search?s=Beach Hotels')}}">Luxury Beach Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs active">
                                                                <label><a href="{{URL::to('search?s=Green Properties')}}">Luxury Green Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Go Urban Hotels')}}">Luxury Urban Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Infinity Pools')}}">Luxury Infinity Pools</a></label>
                                                            </div>
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Spa and Wellness Hotels')}}">Luxury Spa and Wellness Hotels</a></label>
                                                            </div> 
                                                            <div class="form-group post-filter-inputs">
                                                                <label><a href="{{URL::to('search?s=Mountain Ski Resorts')}}">Luxury Mountains and Skin Resorts</a></label>
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
                                        <div class="<?php echo (isset($slug) && strtolower($slug) == 'yachts') ? 'hidden' : ''; ?> panel panel-default custom-post-panel">
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
                                                                <a class="node-btn active" href="javascript:void(0)" onclick="filter_destination('{{$cddest->id}}', 'region');">{{$cddest->category_name}}</a>
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
                                        <div><a href="<?php echo rtrim(URL::to("luxurytravel"), '/') . '/', (isset($slug)) ? $slug : 'Hotel'; ?>"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
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
                                                        <p>At any hotel, upon Availability</p>
                                                    </li>
                                                    <li>
                                                        <h3>Upto 50% off at New Hotels</h3>
                                                        <p>Exclusive community invitations</p>
                                                    </li>
                                                    <li>
                                                        <h3>Free WiFi</h3>
                                                        <p>Guaranteed at all Hotels</p>
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
					
					<div id="frontpage-layer-bj-detail" class="frontpage-layer-bj">
						<div id="frontpage-layer-bj-header-wrapper">
							<div id="frontpage-layer-bj-header">
								<a href="#" id="frontpage-layer-bj-header-logo"> <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive yachts-pop-up-logo"></a>
							</div>
							<span id="frontpage-layer-bj-header-close" class="frontpage-layer-bj-header-close"></span>
						</div>
						<div id="frontpage-layer-bj-content">
							<div class="frontpage-detail-content-top">
								<div class="frontpage-detail-content-top-link">
									<div class="frontpage-detail-content-top-link">

									</div>
								</div>
							</div>
							<div id="placepopupcontent">
							
							</div>
							
						</div>	
					</div>
					<form action="{{url()}}" method="get" id="gridbookform">
						<input type="hidden" name="property" id="bookformproperty" value="" />
                        <input type="hidden" name="roomType" id="roomType" value="" />
                        <input name="arrive" value="{{ date('d.m.Y') }}" type="hidden" />
						<input name="destination" value="" type="hidden" />
                        <input name="booking_adults" value="1" type="hidden" />
						<input name="booking_children" value="0" type="hidden" />
					</form>
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
						
						function submitgridbookform(propdt)
						{
							if(propdt!='')
							{
								var pros = propdt.split("#*");
								$('#bookformproperty').val(pros[1]);
								$('#gridbookform').attr('action','{{url()}}/book-property/' +pros[0]);
								$('#gridbookform').submit();
							}
						}
                    </script>
					<script>
						$(document).ready(function () {

						$('#quick_pager_header').mouseover(function () {
						$('.flyoutBox').show();
						});
						$('.flyoutBox').mouseover(function () {
						$('.flyoutBox').show();
						});
						$('#quick_pager_header').mouseout(function () {
						$('.flyoutBox').hide();
						});
						$('.flyoutBox').mouseout(function () {
						$('.flyoutBox').hide();
						});
						$(document).on('click', '.detail_view', function(){
						$('#frontpage-layer-bj').fadeOut('slow');
						$('#frontpage-detail-tile').html('');
						$.ajax({
						url: "{{ URL::to('getproperty')}}" + '/' + $(this).attr('rel'),
								type: "get",
								success: function(data){
								var imagesPro = '';
								imagesPro += '<div class="detail-tile-inner ai-haeding-bg-style">';
								imagesPro += '<h3 class="popup-property-title">' + data.data.property_name + '</h3>';
								imagesPro += '<p class="popup-property-desc" style="text-align:left; margin: 0 30px; font-size:14px;">' + data.data.about_property + '</p>';
								imagesPro += '</div>';
								imagesPro += '<ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail">';
								$(data.image).each(function(i, val){
								//console.log(val);
								imagesPro += '<li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible">';
								imagesPro += '<div class="detail-tile-inner">';
								imagesPro += '<img src="' + val.imgsrc + val.file_name + '"/>';
								/*imagesPro+='<a href="#" id="LearnMoreBtn1" onclick="add_to_lightbox('+val.id+','+data.data.id+');">Add to lightbox</a>';*/
								imagesPro += '</div>';
								imagesPro += '</li>';
								});
								imagesPro += '</ul>';
								var formlink = "{{url()}}/book-property/" + data.data.property_slug + "}}";
								imagesPro += '<div class="editorial-book-now-page sec-differentiate-line " id="book-now">';
								imagesPro += '<form class="detail-page-booking-form" action="'+formlink+'" method="get">';
								imagesPro += '<input type="hidden" name="property" id="property" value="' + data.data.id + '" />';
								imagesPro += '<input type="hidden" name="roomType" id="roomType" value="" />';
								imagesPro += '<div class="book-now-page-content-">';
								imagesPro += '<div class="editoral-book-page-headings">';
								imagesPro += '<h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>';
								imagesPro += '<p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>';
								imagesPro += '</div>';
								imagesPro += '<ul class="dates" id="editorial-book-now-inputs">';
								imagesPro += '<li>';
								imagesPro += '<div class="editorail-heading">Arrive</div>';
								imagesPro += '<input id="date-range-editorial-arrive" name="arrive" class="datePicker- dateFrom-" value="{{ date("d.m.Y") }}" type="text" />';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Departure</div>';
								imagesPro += '<input id="date-range-editorial-destination" name="destination" class="datePicker- dateFrom-" value="" type="text" />';
								imagesPro += '</li>';
								imagesPro += '</ul>';
								imagesPro += '<ul class="dates">';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Adults</div>';
								imagesPro += '<select name="booking_adults">';
								imagesPro += '<option>1</option>';
								imagesPro += '<option>2</option>';
								imagesPro += '<option>3</option>';
								imagesPro += '</select>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<div class="heading">Children</div>';
								imagesPro += '<select name="booking_children">';
								imagesPro += '<option>0</option>';
								imagesPro += '<option>1</option>';
								imagesPro += '<option>2</option>';
								imagesPro += '</select>';
								imagesPro += '</li>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</ul>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '<div class="editorial-submit-btn">';
								imagesPro += '<button type="submit">BOOK NOW</button>';
								imagesPro += '</div>';
								imagesPro += '<div class="view-modify-cancel-booking">';
								imagesPro += '<a href="#">View, Modify or Cancel your Booking</a>';
								imagesPro += '</div>';
								imagesPro += '<ul class="booking-page-footer-section editorial-book-align" >';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>Join the worlds leading luxury club</span>';
								imagesPro += '<h6 class="center">Enjoy exclusive members only benefits</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>Spa Treatment</span>';
								imagesPro += '<h6 class="center">Book</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<li>';
								imagesPro += '<a href="#" target="_blank">';
								imagesPro += '<span>View or Modify Reserveration</span>';
								imagesPro += '<h6 class="center">Login to Support Center</h6>';
								imagesPro += '</a>';
								imagesPro += '<div class="white-border-bottom"></div>';
								imagesPro += '</li>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</ul>';
								imagesPro += '<div class="clearfix"></div>';
								imagesPro += '</div>';
								imagesPro += '</form>';
								imagesPro += '</div>';
								$('#placepopupcontent').html(imagesPro);
								
									eval($('.dropdown').each(function () {
										var $dropdown = $(this);
										$(".members-list", $dropdown).click(function (e) {
											e.preventDefault();
											$div = $(".members-drop-list", $dropdown);
											$div.toggle();
											$(".members-drop-list").not($div).hide();
											return false;
										});
									}));

									eval($("#adult-input-value").change(function () {
										var adults = $(this).val();
										$('#adults-val').html(adults);
									}));

									eval($("#childerns-input-value").change(function () {
										var childerns = $(this).val();
										$('#childern-val').html(childerns);
									}));
									
									eval($('#book-hotel1').dateRangePicker({
										startDate: "2017-01-11",
										separator: ' to ',
										getValue: function () {
										if ($('#book-hotel1').val() && $('#book-hotel2').val())
											return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
										else
											return '';
										},
										setValue: function (s, s1, s2) {
											$('#book-hotel1').val(s1);
											$('#book-hotel2').val(s2);
										}
									}));
									eval($('#book-hotel2').dateRangePicker({
										startDate: "2017-01-11",
										separator: ' to ',
										getValue: function () {
										if ($('#book-hotel1').val() && $('#book-hotel2').val())
											return $('#book-hotel1').val() + ' to ' + $('#book-hotel2').val();
										else
											return '';
										},
										setValue: function (s, s1, s2) {
											$('#book-hotel1').val(s1);
											$('#book-hotel2').val(s2);
										}
									}));
								
								}
						});
						$('#frontpage-layer-bj-detail').fadeIn('slow');
						$('#fixed_wrapper').hide();
						$('html').addClass('hidescroll');
						$('body').addClass('layerloaded');
						return false;
						});
						$('.frontpage-layer-bj-header-close').click(function () {
						$('.frontpage-layer-bj').fadeOut('slow');
						$('#fixed_wrapper').show();
						$('html').removeClass('hidescroll');
						});
						});
					</script>
					
                    <script>
                        $(document).ready(function () {
                        $(document).on('click', '.top-bar-filters li.select-all', function () {
                        if ($(this).hasClass("active")) {
                        $('.top-bar-filters li').addClass("active");
                        $(this).removeClass("active");
                        } else {
                        $('.top-bar-filters li').removeClass("active");
                        $(this).addClass("active");
                        }
                        });
                        $(document).on('click', '.top-bar-filters li', function () {
                        if (!$(this).hasClass("select-all")) {
                        $(this).toggleClass("active");
                        $('.top-bar-filters li.select-all').removeClass("active");
                        }
                        });
                        $(document).on('click', '.clear-all-filters a', function (event) {
                        event.preventDefault();
                        $('.top-bar-filters li').removeClass("active");
                        $('.top-bar-filters li.select-all').addClass("active");
                        });
                        $('.top-nav-cities-filter').slick({
                        slide: 'li',
                                dots: false,
                                infinite: false,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                cssEase: 'ease-out',
                                variableWidth: false,
                                responsive: [
                                {
                                breakpoint: 1024,
                                        settings: {
                                        slidesToShow: 3,
                                                slidesToScroll: 1,
                                        }
                                },
                                {
                                breakpoint: 600,
                                        settings: {
                                        slidesToShow: 2,
                                                slidesToScroll: 1
                                        }
                                },
                                {
                                breakpoint: 480,
                                        settings: {
                                        slidesToShow: 1,
                                                slidesToScroll: 1,
                                                arrows:false,
                                        }
                                }
                                ]
                        });
                        var scrollTimer, lastScrollFireTime = 0;
                        $(window).scroll(function () {
                        var minScrollTime = 4000;
                        var now = new Date().getTime();
                        if (!scrollTimer) {
                        var element_position = $('#brgrid').offset().top + $('#brgrid').outerHeight() - window.innerHeight;
                        var y_scroll_pos = $(window).scrollTop() + 100;
                        if ((y_scroll_pos >= element_position)) {
                        var it_scroll = true;
                        scrollDownloadData(it_scroll);
                        }
                        scrollTimer = setTimeout(function () {
                        scrollTimer = null;
                        lastScrollFireTime = new Date().getTime();
                        var it_scroll = true;
                        scrollDownloadData(it_scroll);
                        }, minScrollTime);
                        }
                        });
                        });
                        function scrollDownloadData(it_scroll)
                        {
                        var offSet = 40, isPreviousEventComplete = true, isDataAvailable = true;
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
                        url: "{{ URL::to('filter_category_destionation')}}",
                                type: "post",
<?php if (isset($slug) && strtolower($slug) == 'yachts'): ?>
                            data: 'cat={{$pagecate}}&startIndex=' + sIndex + '&offset=' + offSet + queryStrng + "&yacht_category=" + $(".yacht_category").val() + "&yacht_keywords=" + $(".yacht_keywords").val() + "&filter_min_price=" + $("#filter_min_price").val() + "&filter_max_price=" + $("#filter_max_price").val() + '&refine_search=Filter&' + $(".filter-refine-search-form").serialize(),
<?php else: ?>
                            data: 'cat={{$pagecate}}&startIndex=' + sIndex + '&offset=' + offSet + queryStrng + "&filter_min_price=" + $("#filter_min_price").val() + "&filter_max_price=" + $("#filter_max_price").val(),
<?php endif; ?>
                        dataType: "json",
                                success: function (data) {

                                if(data.category_name != '') {
                                    $(".current-page-heading").html("Our Selection of Premium Selected Suites in " + data.category_name);
                                }
                                else {
                                    $(".current-page-heading").html("Our Selection of Premium Selected Suites");
                                }

                                var html = chtml = '';
                                if (data.status == 'error')
                                {
                                if (it_scroll == false)
                                {
                                $('#listproperties').html(data.errors);
                                } else
                                {
                                ('#listproperties').append(data.errors);
                                }
                                isDataAvailable = false;
                                } else
                                {
                                html += '<div class="row">';
                                var p = 1;
                                var node_no = 1;
                                $.each($.parseJSON(data.properties), function (idx, obj) {
                                if (node_no % 20 == 0) {
                                html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                                html += 'Advertisement Here';
                                html += '</div>';
                                }
                                else {
                                html += '<div class="productData col-xs-12 col-sm-6 col-md-3 col-lg-3 margin-bottom-10">';
                                html += '<div class="wrapperforliineedforlightboxremoval">';
                                html += '<div class="cat_product_medium1">';
                                html += '<div class="ai-grid-page-node-pic-box pictureBox gridPicture grid-box-main">';
                                if (obj.pdata.price != '')
                                {
                                if ($("#filter_min_price").val() != '' && $("#filter_max_price").val() != '') {
                                html += '<a class="textButton arrowButton MrgTop5 ai-filter-hotel-price-style" rel="' + obj.pdata.id + '" href="' + detail_link + '"> From EUR ' + obj.pdata.price + ' / <?php echo (isset($slug) && strtolower($slug) == 'yachts') ? 'week' : 'night' ?> </a>';
                                }
                                }
                                if (obj.hasOwnProperty("image")) {
                                    if(obj.pdata.editor_choice_property=='1'){
                                        var edtch = "{{URL::to('sximo/images/editors-choice.png')}}";
                                        html += '<img alt="editor_choice_property" class="propovericons" src="'+edtch+'">';
                                    }else if(obj.pdata.feature_property=='1'){
                                        var featp = "{{URL::to('sximo/images/featured-property.png')}}";
                                        html += '<img alt="editor_choice_property" class="propovericons" src="'+featp+'">';
                                    }
                                html += '<a title="' + obj.image.file_name + '" class="picture_link detail_view-" rel="' + obj.pdata.id + '" href="{{URL::to('')}}/' + obj.pdata.property_slug + '">';
                                var pimg = "{{URL::to('uploads/property_imgs_thumbs/')}}/front_property_" + obj.image.folder_id + "_" + obj.image.file_name;
                                html += '<div class="overlay-text-frezeed">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text hotel-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span>|<span>' + obj.pdata.category_name + '</span></p>';
                                html += '</div>';
                                html += '<div class="overlay-text yacts-overlay-text">';
                                html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;' + obj.pdata.price + ' </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                html += '<p class="yacths-des-text">2015H</p>';
                                html += '</div>';
                                html += '<img alt="' + obj.image.file_name + '" src="' + pimg + '" class="img-responsive">';
                                html += '</a>';
                                } else {
                                    var pimg = "{{URL::to('sximo/assets/images/img-1.jpg')}}";
                                    html += '<div class="overlay-text-frezeed">';
                                    html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                    html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                    html += '</div>';
                                    html += '<div class="overlay-text hotel-overlay-text">';
                                    html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                    html += '<p class="yacths-des-text yacths-des-text-align"><span>From &euro;' + obj.pdata.price + ' </span>|<span>New York</span></p>';
                                    html += '</div>';
                                    html += '<div class="overlay-text yacts-overlay-text">';
                                    html += '<h2 class="yacts-tittle-text">' + obj.pdata.property_name + '</h2>';
                                    html += '<p class="yacths-des-text yacths-des-text-align"><span>&euro;500 </span>|<span>37.7mm</span>|<span>10 Guests</span></p>';
                                    html += '<p class="yacths-des-text">2015H</p>';
                                    html += '</div>';
                                    html += '<img class="img-responsive" src="' + pimg + '" alt="">';
                                }

                                html += '</div>';
                                html += '<div class="listDetails">';
                                html += '<div class="photographBox ai-grid-tiitles">';
                                html += '<h2>';
                                var detail_link = "{{URL::to('')}}/" + obj.pdata.property_slug;
                                html += '<a title="' + obj.pdata.property_name + '" class="photograph FltLft ai-filtreted-hotel-name" rel="' + obj.pdata.id + '" href="' + detail_link + '">';
                                html += obj.pdata.property_name;
                                html += '</a>';
                                html += '<span class="FltRgt">';
                                if (obj.hasOwnProperty("image")) {
                                //html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" onclick="add_to_lightbox(' + obj.image.file_id + ',' + obj.pdata.id + ');" ></i>';
                                } else {
                                //html += '<i class="fa fa-camera-retro colorGrey" aria-hidden="true" title="Add to Itinerary" ></i>';
                                }
                                html += '<a class="carticon" href="javascript:void(0)" onclick="submitgridbookform(\'' + obj.pdata.property_slug + '#*' + obj.pdata.id + '\');"><i class="fa fa-shopping-cart colorGrey" aria-hidden="true" title="book this hotel"></i></a>';
                                html += '</span>';
                                html += '</h2>';
                                html += '</div>';
                                html += '<div class="entire_story MrgTop5">';
                                html += '<a class="textButton arrowButton detail_view MrgTop5" rel="' + detail_link + '" href="#">Quick View</a>';
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
                                });
                                html += '</div>';
                                if (it_scroll == false)
                                {
                                $('#listproperties').html(html);
                                } else {
                                $('#listproperties').append(html);
                                }
                                if (destnarea != '')
                                {
                                if (dest_area[1] == 'country' || dest_area[1] == 'region') {
                                $('#cityfilters').html('');
                                }
                                if (typeof $.parseJSON(data.cities) !== 'undefined' && $.parseJSON(data.cities).length > 0) {

                                    chtml += '<div class="row" style="padding-bottom: 8px;background: #f0f0f0;padding-top: 8px;margin-bottom: 15px;">';
                                    chtml += '<div class="col-md-6 col-xs-12 text-right">Filter By Luxury Destination</div>';
                                    chtml += '<div class="col-md-6 col-xs-12">';
                                    chtml += '<select onchange="filter_destination(this.value ,\'city\')">';
                                    $.each($.parseJSON(data.cities), function(idx, cobj) {
                                        chtml += '<option value="' + cobj.id + '">' + cobj.category_name + '(' + cobj.totalproperty + ')</option>';
                                    })
                                    chtml += '</select>';
                                    chtml += '</div>';
                                    chtml += '</div>';
                                /*var ttp = p - 1;
                                chtml += '<div class="row">';
                                chtml += '<div class="col-md-12">';
                                chtml += '<div class="clear-all-filters"><a href="javascript:void(0)"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear Filters</a></div>';
                                chtml += '<div>';
                                chtml += '<ul class="top-nav-cities-filter top-slick-filtes top-bar-filters-removed regular slider">';
                                chtml += '<li class="active select-all">';
                                chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + dest_area[0] + '\',\'city\');">';
                                chtml += '<div class="filter-bg">';
                                chtml += '<div class="clearfix"></div>';
                                chtml += '<div class="top-filter-name">All Properties</div>';
                                chtml += '</div>';
                                chtml += '</a>';
                                chtml += '</li>';
                                $.each($.parseJSON(data.cities), function (idx, cobj) {
                                var cimg = "{{URL::to('uploads/category_imgs/')}}/" + cobj.category_image;
                                chtml += '<li>';
                                chtml += '<a href="javascript:void(0)" onclick="filter_destination(\'' + cobj.id + '\',\'city\');">';
                                chtml += '<div class="filter-bg" style="background-image: url(\'' + cimg + '\');">';
                                chtml += '<div class="clearfix"></div>';
                                chtml += '<div class="top-filter-name">' + cobj.category_name + '</div>';
                                chtml += '</div>';
                                chtml += '</a>';
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
                                chtml += '<\/script>';*/
                                $('#cityfilters').html(chtml);
                                }
                                }

                                sIndex = parseInt(sIndex) + offSet;
                                $('#listrecrds').val(sIndex);
                                isPreviousEventComplete = true;
                                }
                                },
                                error: function (error) {
//                                alert(error);
                                }
                        });
                        }
                        }
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
                        /*$(document).ready(function (){
                            if($('#two-inputs').length > 0) {
                                $('#two-inputs').dateRangePicker({
                                    selectForward: (Boolean),
                                    stickyMonths: (Boolean),
                                    startDate: "12-01-2017",
                                    format: ' DD.MM.YYYY',
                                    separator: ' to ',
                                    getValue: function (){
                                        if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                                            return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                                        else
                                            return '';
                                    },
                                    setValue: function (s, s1, s2) {
                                        $('#date-range-arrive').val(s1);
                                        $('#date-range-destination').val(s2);
                                    }
                                }).bind('datepicker-first-date-selected', function (event, obj) {
                                    $("#date-range-destination").val('');
                                });
                            }
                        });*/
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
                        if ($("#mySidenavpost").length > 0) {
                        if (document.getElementById("mySidenavpost").style.width == "400px") {
                        return closeNavpost();
                        }
                        }
                        return openNavpost();
                        }
                        function openNavpost() {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "400px";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        else{
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        }
                        function closeNavpost() {
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        window.onload = function () {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        }, 10000);
                        };
                        if ($(window).width() <= 767) {
                        if ($("$mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }

                        $(document).on('click', function (event) {
                        if ($(window).width() <= 767) {
                        if ($(event.target).has('.filter-width').length) {
                        if ($("#mySidenavpost").length > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
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


                    <script>
<?php if (\Session::get('ai_previous_page')): ?>
                            $(document).ready(function (){
                            $(".go-back-button-container .previous-page-screen-short-container").html('<img src="{{URL()}}/sximo/previous_page_image/<?php echo \Session::get('ai_previous_page'); ?>">');
                            });
<?php endif; ?>
                        /*previous page screen short*/
                       /* var scaleBy = 1;
                        var w = 1600;
                        var h = 700;
                        var div = document.querySelector('body');
                        var canvas = document.createElement('canvas');
                        canvas.width = w * scaleBy;
                        canvas.height = h * scaleBy;
                        canvas.style.width = w + 'px';
                        canvas.style.height = h + 'px';
                        var context = canvas.getContext('2d');
                        context.scale(scaleBy, scaleBy);
                        html2canvas(div, {
                        canvas:canvas,
                                onrendered: function (canvas) {
                                theCanvas = canvas;
                                var imageData = canvas.toDataURL();
                                $.ajax({
                                url: "{{URL::to('save_previous_page_image')}}",
                                        type: "POST",
                                        data: "ai_previous_page=" + encodeURIComponent(imageData)
                                });
                                }
                        });*/
                        /*previous page screen short*/
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
<?php if (isset($slug) && strtolower($slug) == 'yachts'): ?>
<?php else: ?>
                            $('#filter_min_price').val('0');
                            $('#filter_max_price').val(6000 - + $("#slider-range").slider("value"));
<?php endif; ?>
                        $('#listrecrds').val(0);
                        $('#nxtpg').val('1');
                        var it_scroll = false;
                        scrollDownloadData(it_scroll);
                        $('#listrecrds').val(21);
                        }
                        $(document).ready(function (){
                        $(".filter-refine-search-form select").change(function () {
                        $(".filter-refine-search-form").trigger("submit");
                        });
                        $(".ai-ajax-searchform-navbar").submit(function (event){
                        event.preventDefault();
                        $("#search-navbar.ai-ajax-search-input").typeahead('close');
                        $(".yacht_keywords").val($("#search-navbar.ai-ajax-search-input").val());
                        /*if($(".yacht_keywords").val() != '') {
                         $(".current-page-heading").html('Our Selection of ' + $(".yacht_keywords").val());
                         }*/
                        filter_property();
                        });
                        });
                        function yachts_type_filter(keywords) {
                        $(".current-page-heading").html('Our Selection of ' + keywords);
                        $(".yacht_category").val(keywords)
                                filter_property();
                        }
                    </script>
                    <script>
                    /*Toggle Side Nav Start Here*/
                        eval($('.dropdown').each(function () {
                            var $dropdown = $(this);
                            $(".members-list", $dropdown).click(function (e) {
                                e.preventDefault();
                                $div = $(".members-drop-list", $dropdown);
                                $div.toggle();
                                $(".members-drop-list").not($div).hide();
                                return false;
                            });
                        }));
                    </script>
                <!-- contact email aside -->
                <script> 
                    $('.contact-aside').hover(
                        function(){ $(this).addClass('active') },
                        function(){ $(this).removeClass('active') }
                    )
                </script>
                    
                    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
                    <div class="editorial-custom-footer-style grid-page-footer-align">
                        @include('layouts/elliot/ai_footer_social')    
                    </div>
					
					<?php // @include('layouts/elliot/ai_lightbox_popups') ?>

    </body>
</html>