<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> @yield('title') | {{ CNF_APPNAME }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">
    <!--Style Includes-->
    <!-- AIC css add -->
    <link href="{{ asset('sximo/assets/css/menu41e7.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/responsive.custom41e7.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/style-ai.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/homepage41e7.css')}}" rel="stylesheet" type="text/css"/>
    <!-- AIc css end-->
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
    <link href="{{ asset('sximo/assets/css/Hamburg-menu.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
    <!--Filters Grid Page-->
    <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/cities-filter.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/intlTelInput.css')}}" rel="stylesheet" type="text/css"/>
    @yield('css')
    <style>
        
        /* hamburg menu pop up css */

        .EVhamburgService {
            padding: 19px;
        }

        .EVpopService {
            width: 100%;
            top: 0px;
            background: transparent;
        }

        .EVcenterPOP {
            border: none;
            display: table-footer-group;
            margin: 0;
        }
        
        .block-content.content {
            width: 35px;
            float: right;
            height: 30px;
            margin-top: 0px;
            margin-right: 0px;
        }
      
        .detailfaLock {
            margin-right: 50px;
        }
        
        .block-content.content span:nth-child(1) {
            top: 12px;
            left: 62%;
        }
        .block-content.content span:nth-child(2) {
            top: 18px;
            left: 62%;
        }
        .block-content.content span:nth-child(3) {
            top: 24px;
            left: 62%;
        }
        
        /* hamburg menu css */
        
        /* Active filter */
        #maindestinations .node-btn.active {
            border-bottom: 1px solid #fff;
        }
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
        .uk-slideshow:first-child .ai-uk-animation .bh-slideshow-thumbnail-split-preview {
            animation-duration: 0.8s;
            display: none;
        }
        .bh-slideshow-thumbnail-split-preview::after {
            background: transparent none repeat scroll 0 0;
        }
   
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
        
        #cityfilters .slick-slide {
            height: auto;
                background: #1e2023;
        }
        .row.go-back-button-container{margin-left: 0; margin-right: 0;}
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
            padding: 100px 10px 20px;
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
            max-height: 240px !important;
            min-height: 240px !important;
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
        .video-bg {
            height: 100%;
            width: 100%;
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
                    .ai_active_filter .node-btn {
                        text-decoration: underline;
                    }
                    
                    
        .FloatFilter {
            float: right;
        }
        
        
        
        .site-aside {
                position: fixed;
                top: 0;
                right: 0;
                height: 100%;
                overflow-x: visible;
                z-index: 1028;
        }
        .contact-aside {
            border-radius: 0px;
            transition: .5s;
            position: fixed;
            top: 102px;
            left: calc(100% - 62px);
            width: 340px;
            background: #272727;
            color: #fff;
            font-size: 15px;
            right: 0;
        }
        .contact-aside ul {
            padding: 7px 0px 0px 0px;;
            list-style: none;
        }
        .contact-aside li {
            padding: 6px 0px 6px 25px;
            margin: 0px 0px 1px 0px;
        }
        .contact-aside li a {
                margin-left: 0px;
                font-size: 13px;
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
            margin-right: 25px;
            margin-left: 8px;
            color: #ABA07C;
            font-size: 16px;
        }
        .contact-aside li a i {
            margin-right: 25px;
        }

        .emporium-voyage-Menu {
            color: #c7ab84;
            margin-top: 3px;
            margin-left: 30px;
            opacity: 1;
            box-shadow: none;
            font-size: 20px;
        }

        #block-system-main-menu .block-inner {
            background: rgba(37, 37, 37, 0.9);
        }

        .close {
            font-size: 21px;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow:0px;
            opacity: 1;
        }
        header {
            position: fixed;
            top: 64px;
            z-index: 9999;
            right: 0;
            /*  left: 95.20%;*/
            width: 62px;
        }

        /* go back buttons */

        .show-login-forms-btn {
            display: inline-block;
            padding: 0px 20px;
            text-align: center;
            margin-top: 7px;
            vertical-align: text-top;
            width: 0%;
        }
        .post-filter-inputs:hover, .post-filter-inputs:active, .post-filter-inputs:focus {
            background-color: #dadad5;
            border-left: 4px solid #a1a39c;
            color: black !important;
            transition: all 0.3s ease 0s;
        }

    
  
    </style>
    <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery2.js')}}"></script>
    <script type="text/javascript" src="{{ asset('sximo/assets/js/uikit.js')}}"></script>
    <!--AIC sidebar js -->
    <!--        <script src="{{ asset('sximo/assets/js/jquery_1.js')}}" type="text/javascript"></script>
    <script src="{{ asset('sximo/assets/js/custm.js')}}" type="text/javascript"></script>
    <script src="{{ asset('sximo/assets/js/TweenMax.min41e7.js')}}" type="text/javascript"></script>
    <script src="{{ asset('sximo/assets/js/menu41e7.js')}}" type="text/javascript"></script>-->
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
    <script src="{{ asset('sximo/assets/js/html2canvas.js')}}" type="text/javascript"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110391807-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-110391807-1');
    </script>

</head>
<body id="main" class="hotel">
    <div class="wrapper">
        <div class="container-fluid responsiveFluid">
            <div class="row">
                <header>
                    <!-- back and lock button -->
                    <div class="logo-padding-left editorial-logo-align">
                        
                    </div>
                    
                    <!-- start sidebar -->
                        
                    <div class="region region-sidebar-first sidebar">
                        <div class="region-inner clearfix">
                            <div id="block-ledunfly-menu-link" class="block block-ledunfly no-title odd first block-count-4 block-region-sidebar-first block-menu-link" >
                                <div class="block-inner clearfix"> </div>
                            </div>
                            <div id="block-system-main-menu" class="block block-system block-menu no-title odd block-count-6 block-region-sidebar-first block-main-menu" role="navigation">
                                <div class="block-inner clearfix">
                                    <div class="block-content content" class="block-content content">
                                        <!-- Start Popup Menu -->
                                        <?php 
                                            $popup      = SiteHelpers::menus( 'popup' ,'all'); 
                                             
                                        ?>
                                        <ul class="menusk clearfix">
                                            @foreach ($popup as $keyMenu=>$menu)
                                                  <li class="{{($keyMenu==0)?'first':''}} {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="menusk1 clearfix">
                                                            @foreach ($menu['childs'] as $keyMenu2=>$menu2)
                                                             <li class="{{($keyMenu2==0)?'first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="menusk1 clearfix">
                                                                    @foreach($menu2['childs'] as $keyMenu3=>$menu3)
                                                                        <li class="{{($keyMenu3==0)?'first':''}} leaf menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                            <!-- Start Popup 2 Menu -->   
                                            <?php 
                                                 
                                                $popup2 = SiteHelpers::menus( 'popup_2' ,'all'); 
                                            ?> 
                                            @foreach ($popup2 as $key2Menu=>$menu)
                                                  <li class="leaf little {{($key2Menu==0)?'little-first':''}}  {{(count($menu['childs']) > 0)?'expanded':''}}  menu-depth-1 menu-item-{{$menu['menu_id']}}">
                                                    <a href="<?php echo ($menu['menu_type'] =='external')? URL::to($menu['url']) : URL::to($menu['module']); ?>">{{$menu['menu_name']}}</a>
                                                    @if(count($menu['childs']) > 0)
                                                        <ul class="menusk1 clearfix">
                                                            @foreach ($menu['childs'] as $key2Menu2=>$menu2)
                                                             <li class="leaf little {{($key2Menu2==0)?'little-first':''}} {{(count($menu2['childs']) > 0)?'expanded':''}}  leaf menu-depth-2 menu-item-{{$menu['menu_id']}}">
                                                                    <a href="<?php echo ($menu2['menu_type'] =='external')? URL::to($menu2['url']) : URL::to($menu2['module']); ?>">{{$menu2['menu_name']}}</a>
                                                                @if(count($menu2['childs']) > 0)
                                                                <ul class="menusk1 clearfix">
                                                                    @foreach($menu2['childs'] as $key2Menu3=>$menu3)
                                                                        <li class="leaf little {{($key2Menu3==0)?'little-first':''}} menu-depth-3 menu-item-{{$menu['menu_id']}}">
                                                                            <a href="<?php echo ($menu3['menu_type'] =='external')? URL::to($menu3['url']) : URL::to($menu3['module']); ?>">{{$menu3['menu_name']}}</a>
                                                                        </li>   
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </li>                           
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                        </ul>   
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                        
                    <!-- end sidebar -->
                    
                    <div class="container-fluid logo-padding-left editorial-logo-align">
                       
                        <div class="row go-back-button-container">
                            @if(isset($_GET['ref']) && $_GET['ref']!='' )
                                <button class="go-back-button" id="back_button_page">Go Back</button> 
                                
                            @else
                                <button class="go-back-button" onclick="goBack()">Go Back</button>
                            @endif
                            <div class="previous-page-screen-short-container"></div>
                        </div>
                        <!-- AIC Harman email phone sidebar add start -->
                                    
                                    <aside class="site-aside">
                                        <div class="contact-aside">
                                            <ul class="contact-aside-list">
                                                <li class="contact-list-item contact-phone"><a href="#"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +1 934 451 1317</a></li>
                                                <li class="contact-list-item contact-email"><a href="#"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> reservations@emporium-voyage.com</a></li>
                                            </ul>
                                        </div>
                                    </aside>
                                    
                                    <!-- AIC Harman email phone sidebar add end-->
                    </div>
                        
                    @include('layouts/elliot/ai_login_sign_up_pop_up')
                        
                </header>
                <div class="filter-page-main-align">
                    <div class="col-md-10 col-sm-12 FloatFilter pull-right">
                        <div class="row">
                            <!-- AIC Harman top bar adding -->
                            <section class="book-form-top-bar hidden-md hidden-lg visible-xs visible-sm">
                                <div>
                                    <div class="booking-form-bar-top ResponsiveTopbar">
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
                                            <div class="col-md-1" style="width: 5.333%;">
                                                <div class="row">
                                                    <div class="form-group padding-right-12">
                                                        <button class="top-booking-bar-btn" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-1">
                                                <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn"><i class="fa fa-lock detailfaLock" aria-hidden="true" ></i></a>
                                                <a data-popup-id="ev-primary-navigation" href="#" class="video-popup-btn"><!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
                                                    <div class="block-content content">
                                                        <span></span>
                                                        <span> </span>
                                                        <span></span>
                                                    </div>
                                                </a>
                                             </div>
                                        </form>
                                    </div>
                                    
                                    
                                </div>
                            </section>
                            <!-- top bar end-->
                            
                            <!--script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
                            <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
                            <script src="{{ asset('sximo/assets/js/combodate.js')}}" type="text/javascript"--></script>
                            

                            <div class="sticky-header-offset"></div> 
                            
                            
                            <div class="container">
                                <div class="row">
                                    <div class="header-navigation-container col-md-12 hidden-xs hidden-sm">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                @include('layouts/elliot/ai_navigation')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Main Page Start here-->
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                @if(!empty($pageslider))
                                    <section class="wow fadeIn no-padding cstmaiclass">
                                        <div class="swiper-auto-height-container position-relative width-100">
                                            <div class="swiper-wrapper overflow-hidden">
                                                @foreach($pageslider as $key => $slider_row)
                                                    <!-- start slider item -->
                                                    <div class="swiper-slide padding-100px-all cover-background position-relative xs-padding-20px-all" style="background-image:url({{url()}}/uploads/slider_images/{{$slider_row->slider_img}})">
                                                        <div class="position-relative width-55 md-width-60 sm-width-85 xs-width-100 display-inline-block slide-banner last-paragraph-no-margin">
                                                            <div class="padding-80px-all bg-black-opacity sm-padding-40px-all xs-padding-30px-all xs-text-center xs-width-100">
                                                                <h3 class="alt-font text-white sm-width-100">{{$slider_row->slider_title}}</h3>
                                                                <p class="sm-width-100 lorem-para">{{$slider_row->slider_description}}</p>
                                                                <a href="{{$slider_row->slider_link}}" class="margin-35px-top sm-margin-15px-top btn btn-white">Explore services</a>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <!-- end slider item -->
                                                @endforeach
                                            </div>

                                            <div class="navigation-area">
                                                <div class="swiper-button-next swiper-next-style4 bg-primary text-white"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
                                                <div class="swiper-button-prev swiper-prev-style4"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
                                            </div>
                                            <div class="scroll-button">
                                                <a href="#align-to-top" class="align-to-top-arrow"><img src="{{assets('sximo/assets/images/scroll-down.png')}}" class="down-arrow-align animate-arrow" alt=""> </a>
                                            </div>
                                        </div>
                                    </section>
                                @endif
                                @yield('content')
                                
                                
                            </div>

                        </div>
                        
                    </div>

                </div>
                @include('layouts/elliot/hamburg_menu')
                <div class="col-md-2 col-sm-3 hidden-xs hidden-sm">
                    <div class="row">
                        <div class="filter-grid-page-side-bar">
                            <div class="filters-gird-page-side-bar-filter-align">
                                <div class="design-locations-logo">
                                    <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>
                                </div>
                                <div class="panel-group new-sidebar-sk" id="accordion">
                                    {{--*/ $page_menus = SiteHelpers::menus('business') /*--}}
                                    @if(!empty($page_menus))
                                    @foreach ($page_menus as $pmenu)
                                        <div class="panel panel-default custom-post-panel">
                                            <a @if(count($pmenu['childs']) > 0) data-toggle="collapse" data-parent="#accordion" href="#webpage{{$pmenu['menu_id']}}" @else @if($pmenu['menu_type'] =='external') href="{{ URL::to($pmenu['url'])}}" @else href="{{ URL::to($pmenu['module'])}}" @endif @endif class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    @if(CNF_MULTILANG ==1 && isset($pmenu['menu_lang']['title'][Session::get('lang')]))
                                                        {{ $pmenu['menu_lang']['title'][Session::get('lang')] }}
                                                    @else
                                                        {{$pmenu['menu_name']}}
                                                    @endif
                                                </div>
                                            </a>
                                            @if(count($pmenu['childs']) > 0)
                                                <div id="webpage2" class="panel-collapse  collapse">
                                                    <div class="panel-body custom-panel-body">
                                                        <div class="dl-filter">
                                                            @foreach ($pmenu['childs'] as $pmenu2)
                                                                <div class="form-group post-filter-inputs">
                                                                    <label>
                                                                        <a @if($pmenu2['menu_type'] =='external') href="{{ URL::to($pmenu2['url'])}}" @else href="{{ URL::to($pmenu2['module'])}}" @endif>
                                                                            @if(CNF_MULTILANG ==1 && isset($pmenu2['menu_lang']['title'][Session::get('lang')]))
                                                                                {{ $pmenu2['menu_lang']['title'][Session::get('lang')] }}
                                                                            @else
                                                                                {{$pmenu2['menu_name']}}
                                                                            @endif
                                                                        </a>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                                <section class="regular slider">
                                    <div class="slick-cstm-width">
                                        <div class="side-bar-why-book-with-us">
                                            <div class="book-with-us-tittles">
                                                <h2>Why book with us?</h2>
                                            </div>
                                            <ul class="side-bar-book-with-us-list">
                                                @if(!empty($data['whybookwithus']))
                                                    @foreach($data['whybookwithus'] as $withus)
                                                        <li>
                                                            <h3>{{$withus->title}}</h3>
                                                            <p>{{$withus->sub_title}}</p>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    @if(!empty($sidebargridAds))
                                        @foreach($sidebargridAds as $slides)
                                            <div class="slick-cstm-width">
                                                <a href="{{ (strpos($slides->adv_link, 'http://') !== false) ? $slides->adv_link : 'http://'.$slides->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$slides->adv_img)}}"></a>
                                            </div>
                                        @endforeach
                                    @endif
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <div class="clearfix"></div>
                
                <form action="{{url()}}" method="get" id="gridbookform">
                    <input type="hidden" name="property" id="bookformproperty" value="" />
                    <input type="hidden" name="roomType" id="roomType" value="" />
                    <input name="arrive" value="{{ date('d.m.Y') }}" type="hidden" />
                    <input name="destination" value="" type="hidden" />
                    <input name="booking_adults" value="1" type="hidden" />
                    <input name="booking_children" value="0" type="hidden" />
                </form>


                <div class="editorial-custom-footer-style grid-page-footer-align">
                    @include('frontend.layouts.ev.shared.footer')
                </div>
            </div>
        </div>
    </div>
                    
<script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
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
        

        $('.searchbox_landing').on('typeahead:selected', function (e, datum) {
            var propname = $(this);
            $.ajax({
                url: "{{ URL::to('find_property_by_name')}}",
                type: "post",
                data: 'pname=' + propname.val(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 'error')
                    {
                        propname.parents('.searchform-navbar').submit();
                        return;
                        propname.parents('.searchform-navbar').submit();
                    } else
                    {
                        var obj = JSON.parse(data.property);
                        window.location.href = "{{URL::to('')}}/" + obj.property_slug;
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
                    
    function submitgridbookform(propdt){
        if(propdt!='')
        {
            var pros = propdt.split("#*");
            $('#bookformproperty').val(pros[1]);
            $('#gridbookform').attr('action','{{url()}}/book-property/' +pros[0]);
            $('#gridbookform').submit();
        }
    }

    $(document).on('ready', function () {


        $('.top-nav-cities-filter').slick({
            slide: 'li',
            dots: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            cssEase: 'ease-out',
            variableWidth: false,
            autoplay:false,
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

        $(document).on('click', '.top-slick-filtes li.select-all', function () {
            if ($(this).hasClass("active")) {
                $('.top-slick-filtes li').addClass("active");
                $(this).removeClass("active");
            } else {
                $('.top-slick-filtes li').removeClass("active");
                $(this).addClass("active");
            }
        });

        $(document).on('click', '.top-slick-filtes li', function () {
            if (!$(this).hasClass("select-all")) {
                $(this).toggleClass("active");
                $('.top-slick-filtes li.select-all').removeClass("active");
            }
        });

        $(document).on('click', '.clear-all-filters a', function (event) {
            event.preventDefault();
            $('.top-slick-filtes li').removeClass("active");
            $('.top-slick-filtes li.select-all').addClass("active");
        });    

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

        /*$('#frontpage-layer-bj-detail').fadeIn('slow');
        $('#fixed_wrapper').hide();
        $('html').addClass('hidescroll');
        $('body').addClass('layerloaded');
        return false;*/
    
        $('.frontpage-layer-bj-header-close').click(function () {
            $('.frontpage-layer-bj').fadeOut('slow');
            $('#fixed_wrapper').show();
            $('html').removeClass('hidescroll');
        });
    
        $(".social-share").click(function (event) {
            event.preventDefault();
            $(this).find("ul").toggle();
            $(this).toggleClass("open");
        });
    
        $("header .menu > a").click(function (event) {
            event.preventDefault();
            $(this).parent().find("ul").toggle("slow");
        });
        $(".trigger-click-on-book-now").click(function (event) {
            event.preventDefault();
            $(".open-book-now-page").trigger("click");
        });

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
        $('.uk-slideshow:first-child .ai-uk-animation .bh-slideshow-thumbnail-split-preview').delay(3000).fadeIn(5000);
        $('.ai-uk-animation:first .bh-slideshow-thumbnail-split-preview').addClass('uk-animation-fade');
    

        if ($('#two-inputs').length > 0) {
            $('#two-inputs').dateRangePicker({
                    selectForward: (Boolean),
                    stickyMonths: (Boolean),
                    startDate: "12-01-2017",
                    format: ' DD.MM.YYYY',
                    separator: ' to ',
                    getValue: function (){
                        if ($('#date-range-destination').val() && $('#date-range-arrive').val()){
                                return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                        }else{
                                return '';
                        }
                    },
                    setValue: function (s, s1, s2){
                        $('#date-range-arrive').val(s1);
                        $('#date-range-destination').val(s2);
                    }
            }).bind('datepicker-first-date-selected', function (event, obj) {
                $("#date-range-destination").val('');
            });
        }
    });

    /* Toggle between adding and removing the "active" and "show" classes 
    when the user clicks on one of the "Section" buttons. The "active" 
    class is used to add a background color to the current button when 
    its belonging panel is open. The "show" class is used to open 
    the specific accordion panel */
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function () {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }

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
        }else{
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
    $(document).ready(function (){
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

        $(".node-btn").click(function(){
            $(this).parent().find("> .node").toggle();
            $(this).parent().find("> .node").css({"padding-left": "10px", "margin-top": "5px", "text-transform": "inherit"});
            $(this).parent().find("> .node > a").css({"text-transform": "none"});
        });

      
        

        <?php if(\Session::get('ai_previous_page')): ?>
            
                $(".go-back-button-container .previous-page-screen-short-container").html('<img src="{{URL()}}/sximo/previous_page_image/<?php echo \Session::get('ai_previous_page'); ?>">');
            
        <?php endif; ?>

        var scaleBy = 1;
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
        });
    });    
</script>
<script>
                    
    /*Top Bar Booking Start Here*/
    $('#top-bar-search-booking-form').dateRangePicker({
            selectForward: (Boolean),
            stickyMonths: (Boolean),
            startDate: "12-01-2017",
            format: 'DD.MM.YYYY',
            autoClose: "true",
            separator: ' to ',
            getValue: function ()
            {
                if ($('#top-bar-search-booking-form-destination').val() && $('#top-bar-search-booking-form-arrive').val())
                    return $('#top-bar-saerch-booking-form-destination').val() + ' to ' + $('#top-bar-saerch-booking-form-arrive').val();
                else
                    return '';
            },
            setValue: function (s, s1, s2)
            {
                $('#top-bar-search-booking-form-arrive').val(s1);
                $('#top-bar-search-booking-form-destination').val(s2);
            }
        }
    ).bind('datepicker-first-date-selected', function (event, obj) {
        $("#top-bar-search-booking-form-destination").val('');
    });
    /*Top Bar Booking End Here*/
                    


    $('.contact-aside').hover(
        function(){ $(this).addClass('active') },
        function(){ $(this).removeClass('active') }
    );

    $(document).ready(function(){
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
    });
</script>
@if(isset($_GET['ref']) && $_GET['ref']=='oc' )
    <?php $thumbnail = asset('sximo/assets/images/our_collection.png'); ?>
@elseif(isset($_GET['ref']) && $_GET['ref']=='syd' )
    <?php $thumbnail =  asset('sximo/assets/images/select_your_destination.png'); ?>
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
           // $("#back_button_page").tooltip({ content: '<img src="{{$thumbnail}}"/>' });
            $(document).on('click','#back_button_page',function(){
                location.href = "{{url('/')}}?ref={{$_GET['ref']}}";
                return fasle;
            });
        });
    </script>
@endif
@yield('script')
                                      
</body>
</html>