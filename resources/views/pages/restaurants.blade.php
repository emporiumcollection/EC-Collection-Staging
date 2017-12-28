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
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
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
                display: inline-block;
                font-size: 20px;
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;
            }
            .yacths-des-text {
                color: #fff;
                font-size: 18px;
                margin: 0;
            }
            .yacths-des-text-align {
                margin-top: 20px;
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
            .cat_product_medium1:hover .gridPicture {
                transform: scale(1.06);
                transition: all 0.2s ease-out 0s;
            }
            .cat_product_medium1 {
                overflow: hidden;
            }
        </style>
		
		<style>
            .detail-tile-inner img { max-width:100%; }
            .gallerysty { font-weight: bold;font-size: 15px;color: #000; }
            .hotel-name-first-letter { background-image: url({{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image)}}); }
            .editorial-book-now-page { background-image: url('{{( array_key_exists('propimage', $propertyDetail)) ? \ImageCache::make($propertyDetail['propimage_thumbpath_dir'].$propertyDetail['propimage'][0]->file_name,100,1000,null) : ''}}');  }
            .hotels-showcase-right-side { background-image: url('{{( array_key_exists('propimage', $propertyDetail)) ? \ImageCache::make($propertyDetail['propimage_thumbpath_dir'].$propertyDetail['propimage'][0]->file_name,100,1000,null) : ''}}'); }
            .hotel-sec-block-two { background-image: url('{{( array_key_exists('propimage', $propertyDetail)) ? \ImageCache::make($propertyDetail['propimage_thumbpath_dir'].$propertyDetail['propimage'][1]->file_name,100,1000,null) : ''}}'); }

            .hotels-detail-description-text > p { max-height:300px; }
            .hotels-detail-description-text > p {
                font-size: 15px;
                line-height: 30px;
                font-family: Geomanist-Light;
            }
            .hotels-image-showcase-des-text > p {
                font-size: 15px;
                line-height: 30px;
                margin-top: 40px;
                font-family: Geomanist-Light;
            }
            .hotel-block-two-right-sec-align > h2{
                color: #dbd4d7;
                font-family: ACaslonPro-Regular;
                font-size: 40px;
                font-weight: lighter;
                margin-top: -80px;
                text-transform: uppercase;
                opacity:0;
            }
            .hotel-block-two-right-sec-align > p { margin-top:0px; }
            .spa-sec-book-an-appoinment-btn { float: left !important; margin-left: 20px; }
            .spa-overlay-text span { padding-left:0px !important; }
            .restaurant-sec-main-bg-align {
                background-image: url("{{( array_key_exists('propimage', $propertyDetail)) ? $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][0]->file_name : ''}}");
            }
            .next-prevoius-navigation.left-arrow-align {
                display: none;
            }
            .next-prevoius-navigation.right-arrow-align {
                top: calc(35%);
            }
			.editorial-hotel-detail-page .go-back-button {
				top: 98px;
			}
			.book-button{    padding: 10px 18px}
			body.fixed {
				max-height: 100vh;
				max-width: 100%;
				overflow: hidden;
				position: unset;
			}
                        .image-slider-container ul li.active img {
                            width: auto;
                            height: auto;
                        }
                        
                        /* AIC Harman slider layer css add */
                        
                        .overlaySlider {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            z-index: 0;
                            background-color: #080d15;
                            opacity: .7;
                        }
                        
                        /* AIC Harman image side reduce */
                        
                        .architecture-sec-top-img {
                            display: table;
                            margin: 83px auto 0;
                            display: table;
                            margin: 83px auto 0;
                            margin-bottom: 0px;
                            margin-left: auto;
                            width: 0%;
                            height: 450px;
                            width: 75%;
                            margin: 0 auto;
                            margin-left: 224px;
                            margin-bottom: 65px;
                        }
                        
                        .editorial-page-booking-bar .booking-form-bar-top, .editorial-hotel-detail-page .editorial_m_slider ul li .editorial-text {
                            background-color: rgb(37,37,37);
                            opacity: .9;
                        }
                        
                        .hotel-next-previous-outer {
                            color: #fff;
                            font-size: 18px;
                            position: relative;
                            text-align: center;
                            width: 65px;
                            background: rgb(37,37,37);
                        }
                        
                        /* riaan */
                        
                        .ai-custom-deafault-style::-moz-placeholder {
                            color: #000;
                           }
                           
                        .editorial-hotel-detail-page .right-menus ul li a:hover {
                            background: #ada077;
                           }
                           .hotel-next-previous-outer {
                            background-color: ##252525;
                            color: #fff;
                            font-size: 18px;
                            position: relative;
                            text-align: center;
                            width: 65px;
                           }
                           .editorial-hotel-detail-page .right-menus ul li a[data-hotel-option="book_now"] {
                            background: #ada077;
                            color: #ffff;
                           }
                           
                           .editorial-page-booking-bar .top-booking-bar-btn, .editorial-hotel-detail-page .book-button, .editorial-hotel-detail-page .hotel-slider-price, .editorial-hotel-detail-page .spa-sec-book-an-appoinment-btn {
                            background-color: #ada077;
                            color: #fff;
                           }
                           .editorial-page-booking-bar .booking-form-bar-top, .editorial-hotel-detail-page .editorial_m_slider ul li .editorial-text {
                            background-color: rgba(37, 37, 37, 0.9);
                            opacity: .9;
                           }
                           .editorial-hotel-detail-page img.banner-arrow-bg {
                            background-color: rgb(37, 37, 37 0.5);
                           }
                           .overlaySlider {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            z-index: 0;
                            background-color: #000;
                            opacity: .2;
                           }
                           .editorial-hotel-detail-page .hotels-logo, .editorial-hotel-detail-page .right-menu-align li:nth-child(1), .editorial-hotel-detail-page .right-menus ul li a {
                                background: rgba(37, 37, 37, 1);
                                border-bottom: 1px solid rgba(211, 214, 210, 0.2);
                                padding: 15px 0 14px 28px;
                            }
                            .editorial-hotel-detail-page .right-menus ul li a:hover {
                                background: #ada077;
                                color: white;
                                opacity: 0.8;
                            }
                            .editorial-hotel-detail-page img.banner-arrow-bg {
                                background-color: rgb(37, 37, 37);
                                opacity: 0.8;
                            }
                            .hotel-sec-block-two {
                                background-blend-mode: multiply;
                                filter: brightness(.9);
                                /* background-image: url("http://www.design-locations.biz/uploads/container_user_files/locations/hotel-greif/property-images/Hotel-Greiff-%20South-Tyrol,%20Italy-design-locations.com8.jpeg"); */
                                background-position: center center;
                                background-repeat: no-repeat;
                                background-size: cover;
                                padding-bottom: 75px;
                                padding-top: 290px;
                                border-top: 4px solid #545454;
                                /* opacity: 0.6; */
                            }
                            
                            .hotels-des-left-side {
                                background: rgba(0,0,0,0.8);
                                color: #fff;
                                z-index: 0;
                                font-family: geomanist-regular;
                                padding: 20px 32px 264px 75px;
                            }
                            .editorial-hotel-detail-page button.go-back-button {
                                background-color: \\;
                                    background: #283D3E;
                                opacity: 1;
                                color: white;
                            }
                            
                            .editorial-page-booking-bar .top-booking-bar-btn, .editorial-hotel-detail-page .book-button, .editorial-hotel-detail-page .hotel-slider-price, .editorial-hotel-detail-page .spa-sec-book-an-appoinment-btn {
                                background-color: #8AE0C7;
                                color: black;
                            }
                            a:hover, a:focus, a:active {
                                text-decoration: none;
                                color: #8AE0C7;
                            }
                            .hotels-detail-heading-text > p {
                                color: white;
                                font-family: Oswald-Light;
                                font-size: 14px;
                                letter-spacing: 3px;
                                line-height: 19px;
                                text-transform: uppercase;
                            }
                            
                            .editorial-hotel-detail-page #align-to-top .book-button.open-show_more-page.hotel-btn {
                                background-color: #ABA07C;
                                opacity: 1;
                                color: white;
                            }
                            .editorial-page-booking-bar .top-booking-bar-btn, .editorial-hotel-detail-page .book-button, .editorial-hotel-detail-page .hotel-slider-price, .editorial-hotel-detail-page .spa-sec-book-an-appoinment-btn {
                                    background-color: #ABA07C;
                                    color: white;
                            }
                            .gallery.row .secondaria1 img {
                                    width: auto;
                                    position: absolute;
                                    top: 0%;
                                    left: 50%;
                                    -ms-transform: translateX(-50%);
                                    -webkit-transform: translateX(-50%);
                                    transform: translateX(-50%);
                                    opacity: 1;
                                    filter: brightness(.8);
                            }
                            .hotels-detail-description-text {
                                margin-top: 30px;
                            }
                            .hotels-image-showcase-des-text > p {
                                font-size: 15px;
                                line-height: 30px;
                                margin-top: 227px;
                            }
                            .hotel-block-two-right-sec-align > p {
                                color: white;
                                line-height: 30px;
                                margin-top: 100px;
                                font-size: 15px;
                                font-family: Geomanist-Regular;
                                opacity: 1;
                            }
                            .hotel-block-two-left-sec-align > p {
                                color: white;
                                line-height: 30px;
                                font-size: 15px;
                            }
                            .hotel-block-two-left-sec-align > p {
                                color: white;
                                line-height: 30px;
                                font-size: 15px;
                                font-family: Geomanist-Light;
                                padding-right: 0px;
                                font-size: 15px;
                                line-height: 30px;
                            }
                            .hotel-block-two-right-sec-align > p {
                                color: white;
                                line-height: 30px;
                                margin-top: 0px;
                                font-size: 15px;
                                font-family: Geomanist-Regular;
                                opacity: 1;
                                font-weight: 100;
                                font-family: Geomanist-Light;
                            }
                            
                            .restaurtant-bar-des-para-style {
                                color: #333;
                                font-size: 16px;
                                font-family: Geomanist-Light;
                                line-height: 20px;
                                padding: 28px 30px 23px 23px;
                                font-weight: 400;
                            }
                            
                            .restaurant-sec-description-pannel2 .restaurtant-bar-des-para-style {
                                background-color: #ada077;
                                padding: 24px 60px 40px 15px;
                                color: white;
                                margin-top: 44px;
                            }
                            
                            .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text {
                                font-family: serif;
                                border-bottom: 3px solid #f3bc3a;
                                color: #fff;
                                overflow-wrap: break-word;
                                font-size: 14px;
                                font-style: normal;
                                font-style: italic;
                            }
                            
                            .yacths-des-text {
                                color: #fff;
                                font-size: 14px;
                                margin: 0;
                            }
                            
                            .editorial-hotel-detail-page .footer {
                                background-color: #F7F7F4;
                            }
                            
                            .editorial-custom-footer-style .newsletter-style {
                                width: 45%;
                                margin-top: 8px;
                                color: white;
                                float: left;
                                background: #f7f7f4;
                                margin-right: 15px;
                                box-shadow: none;
                                border-radius: 0;
                                font-size: 11px;
                            }
                            
                            .bar-name-text-style {
                                color: #fff;
                                font-size: 13px;
                                letter-spacing: 5px;
                                text-transform: uppercase;
                            }
                            
                            .gallery .info1 p {
                                font-size: 14px;
                                font-weight: 600;
                                font-family: Geomanist-Light;
                                overflow: hidden;
                                position: relative;
                                top: -10px;
                            }
                            .ai_restaurant-name h2 {
                                color: #ABA07C;
                                font-size: 32px;
                                font-family: ACaslonPro-Regular;
                                margin: 0;
                                text-transform: uppercase;
                            }
                            .small-box-bg {
                                background-color: #283D3E;
                                float: left;
                                margin-bottom: 94px;
                                margin-left: -141px;
                                margin-top: -104px;
                                opacity: 1.0;
                                padding: 48px;
                                width: 100%;
                            }
                            .bottom-sec-bg {
                                background-color: rgb(228,220,212);
                                /* margin-left: 17.5%; */
                                margin-top: -6%;
                                position: relative;
                                width: 888px;
                            }
                            .expeience-small-text {
                                color: #fff;
                                font-family: 'Satisfy', cursive;
                            }
                            
                            .restaurant-sec-description-pannel2 .restaurtant-bar-des-para-style {
                                background-color: #ada077;
                                padding: 15px 60px 15px 15px;
                                color: white;
                            }
                            
                            .restaurant-owner-sign {
                                color: #ada077;
                                font-size: 21px;
                                font-family: ACaslonPro-Regular;
                                margin-bottom: 20px;
                                padding-left: 15px;
                                text-transform: lowercase;
                                line-height: 31px;
                                /* font-style: italic; */
                                text-align: left;
                                opacity: 0.8;
                            }
                            
                            .hotel-block-two-left-sec-align > h2 {
                                color: #dbd4d7;
                                font-family: ACaslonPro-Regular;
                                font-size: 32px;
                                font-weight: lighter;
                                margin-top: 0;
                                text-transform: uppercase;
                                width: 100%;
                                margin-left: 0px;
                                letter-spacing: 0px;
                            }
                            
                            .hotel-block-two-right-sec-align > p {
                                color: white;
                                line-height: 30px;
                                margin-top: 0px;
                                font-size: 15px;
                                font-family: Geomanist-light;
                                opacity: 1;
                            }
                            .hotel-block-two-right-sec-align > h2 {
                                color: #dbd4d7;
                                font-family: ACaslonPro-Regular;
                                font-size: 40px;
                                font-weight: lighter;
                                margin-top: -115px;
                                text-transform: uppercase;
                                opacity: 0;
                            }
                            
                            .hotels-detail-heading-text > p {
                                color: white;
                                font-size: 32px;
                                font-family: ACaslonPro-Regular;
                                letter-spacing: 3px;
                                line-height: 35px;
                                float: none;
                                width: 50%;
                                text-transform: uppercase;
                                height: auto;
                                background: rgba(0,0,0,0.8);
                                margin: 0;
                                padding: 8% 0% 0% 7%;
                            }
                            
                            .hotels-showcase-right-side {
                                background-blend-mode: multiply;
                                background-color: #2f2f2e;
                                background-position: center center;
                                background-repeat: no-repeat;
                                background-size: cover;
                                color: #fff;
                                font-family: Geomanist-Regular;
                                /* padding: 516px 49px 90px 30px; */
                                margin-top: -400px;
                            }
                            
                            .image-showcase-below-big-text {
                                color: #474749;
                                font-family: Raleway-ExtraLight;
                                font-size: 70px;
                                margin-left: -107px;
                                margin-top: 36px;
                                margin-top: 70px;
                                text-transform: uppercase;
                            }
                            
                            /* AIC Harman 27/12/2017 */
                            
                            .hotels-detail-heading-text {
                                width: 100%;
                                float: left;
                            }
                            
                            .gallery.row .principale1 img {
                                width: 100%;
                                position: absolute;
                                top: 0%;
                                background-color: black;
                                opacity: 0.9;
                            }
                            
                            .gallery.row .principale1 .foto1 {
                                width: 0%;
                                height: auto;
                                position: absolute;
                                top: 0vh;
                                background: black;
                                overflow: hidden;
                            }
                            
                            .architecture-sec-top-img {
                                display: table;
                                margin: 83px auto 0;
                                display: table;
                                margin: 83px auto 0;
                                margin-bottom: 0px;
                                margin-left: auto;
                                width: 0%;
                                height: auto;
                                width: 50%;
                                margin: 0 auto;
                                margin-left: 224px;
                                margin-bottom: 65px;
                            }
                            
                            .small-box-text {
                                color: #fff;
                                font-family: geomanist-light;
                                font-size: 26px;
                                margin-left: -5px;
                                line-height: 30px;
                            }
                            
                            .architecture-sec-heading > h1 {
                                font-family: geomanist-light;
                                font-size: 30px;
                                font-weight: lighter;
                                margin-top: 120px;
                                right: 30%;
                                left: 45px;
                            }
                            
                            .expeience-small-text {
                                color: #fff;
                                font-family: ACaslonPro-Regular;
                            }
                            
                            .slider-side-text-tittle {
                                color: #fff;
                                font-family: geomanist-light;
                                font-size: 32px;
                                line-height: 39px;
                            }
                            
                            .arrow-margin-right {
                                margin-right: 0px;
                            }
                            
                            .editorial-image-slider-previous-btn {
                                margin-left: 384px !important;
                            }
                            
                            .editorial-hotel-detail-page #align-to-top .book-button.open-show_more-page.hotel-btn {
                                background-color: #ABA07C;
                                opacity: 1;
                                color: white;
                                font-family: Geomanist-light;
                            }
                            
                            .editorial-page-booking-bar .top-booking-bar-btn, .editorial-hotel-detail-page .book-button, .editorial-hotel-detail-page .hotel-slider-price, .editorial-hotel-detail-page .spa-sec-book-an-appoinment-btn {
                                background-color: #ABA07C;
                                color: white;
                                font-family: Geomanist-light;
                            }
                            
                            .image-slider-container .editorial-images-count {
                                color: #fff !important;
                                float: left !important;
                                font-size: 33px !important;
                                margin-left: 22% !important;
                                margin-top: -145px !important;
                                position: relative;
                                width: 22% !important;
                            }
                            
                            .restaurant-sec-description-pannel1 p {
                                color: #fff;
                                font-family: Raleway-Light;
                                font-size: 22px;
                                line-height: 32px;
                                margin: 0;
                            }
                            
                            .restaorant-des-orange-text {
                                color: #EFE5BC;
                                margin-top: 25px;
                                font-family: ACaslonPro-Regular;
                                float: left;
                                font-style: italic;
                            }
                            
                            .restaurant-view-gallery-align .bar-view-gallery {
                                color: #fff;
                                font-size: 15px;
                                font-family: ACaslonPro-Regular;
                                font-style: italic;
                                text-decoration: none;
                            }
                            
                            .bar-info-text-haeding {
                                font-size: 18px;
                                text-transform: uppercase;
                                color: white;
                                font-family: ACaslonPro-Regular;
                                line-height: 26px;
                            }
                            
                            .bar-intro-text-bg {
                                background-color: #283D3E;
                                float: left;
                                padding-top: 60px;
                                color: black;
                                width: 100%;
                            }
                            
                            .bar-name-text-style {
                                color: #fff;
                                font-size: 13px;
                                letter-spacing: 11px;
                                text-transform: uppercase;
                                text-align: right;
                                font-family: Geomanist-light;
                            }
                            
                            .bar-des-text {
                                color: #fff;
                                font-size: 12px;
                                line-height: 24px;
                                margin: 0;
                                font-family: Geomanist-light;
                                text-transform: none;
                            }
                            
                            .img-width {
                                width: 100%;
                                background: rgba(0,0,0,0.8);
                                opacity: 0.8;
                            }
                            
                            .bar-bottom-des-pannel p {
                                color: #fff;
                                font-family: Geomanist-Light;
                                font-size: 14px;
                                line-height: 25px;
                            }
                            
                            .spa-owner-sign {
                                color: #ABA07C;
                                font-size: 14px;
                                font-family: ACaslonPro-Regular;
                                text-align: left;
                            }
                            
                            .spa-overlay-text span {
                                padding-left: 0px !important;
                                margin-top: 15px;
                                float: none;
                                font-family: Geomanist-light;
                                font-style: normal;
                            }

                            .spa-overlay-text span {
                                color: white;
                                font-size: 14px;
                                font-style: italic;
                                font-family: acaslonpro-regular;
                                font-weight: lighter;
                                margin-top: -10px !important;
                                display: block;
                            }
                            
                            .spa-overlay-text {
                                position: absolute;
                                top: 0px;
                                width: 645px;
                            }
                            
                            .spa-overlay-text blockquote {
                                background: #ABA07C;
                                border: medium none;
                                width: 518px;
                                font-family: ACaslonPro-Regular;
                                color: white;
                                font-size: 22px;
                                line-height: 39px;
                                /* font-family: Geomanist-light; */
                                margin: 0;
                                padding: 10px 10px 9px 15px;
                                text-transform: uppercase;
                                font-weight: bold;
                                margin-top: 0px;
                            }
                            
                            .spa-sec-para-style {
                                color: #b3b7ba;
                                font-size: 18px;
                                font-family: Geomanist-light;
                            }
                            
                            .spa-content-quote {
                                border: medium none;
                                color: #dee0e1;
                                font-family: acaslonpro-regular;
                                font-size: 18px;
                                /* font-style: italic; */
                                line-height: 25px;
                                margin-bottom: 0;
                                margin-top: 20px;
                                padding-left: 15px;
                                font-family: Geomanist-light;
                            }
                            
                            .view-gallery-border-left {
                                border-bottom: 2px solid #fff;
                                float: left;
                                padding-top: 26px;
                                width: 45px;
                            }
                            
                            .spa-sec-view-gallery .bar-view-gallery {
                                color: #fff;
                                font-family: acaslonpro-regular;
                                font-size: 15px;
                                font-style: italic;
                                text-decoration: none;
                                margin-top: 20px;
                                float: left;
                            }
                            
                            .content-quote-author {
                                color: #ABA07C;
                                font-size: 12px;
                                margin-top: 20px;
                                margin-bottom: 0px;
                                font-family: ACaslonPro-Regular;
                            }
                            
                            
                            h4.spa-bold-text {
                                font-size: 12px;
                                text-transform: lowercase;
                                font-family: Geomanist-light;
                                margin-bottom: 10px;
                            }
                            
                           .spa-sec-para-style {
                                color: #ABA07C;
                                font-size: 14px;
                                font-family: Geomanist-light;
                                text-transform: lowercase;
                            }
                            
                            a.spa-sec-book-an-appoinment-btn {
                                margin-top: 20px !important;
                            }
                            
                            .video-section-bg {
                                background: rgba(37, 37, 37, 1);
                            }
                            
                            .editoral-book-page-headings > h2 {
                                color: #fff;
                                display: inline-block;
                                font-family: geomanist-light;
                                font-size: 36px !important;
                                margin: 32px auto 0;
                                text-align: center;
                                text-transform: none;
                            }
                            
                            .editoral-book-page-headings > p {
                                color: #ABA07C;
                                font-family: Geomanist-Regular;
                                margin-top: 16px;
                            }
                            
                            .dates li input, .dates li select {
                                background-color: transparent;
                                background-image: url(../images/icon-dropdown.png);
                                background-position: center bottom;
                                background-repeat: no-repeat;
                                background-size: 15px auto;
                                text-align: center;
                                border: medium none;
                                font-size: 14px;
                                margin-top: 25px;
                                padding-bottom: 50px;
                                width: 117px;
                                margin-left: 0px;
                                -webkit-appearance: none;
                                -moz-appearance: none;
                                appearance: none;
                                -webkit-transition: border-color 150ms ease;
                                align-items: center;
                                padding-left: 16px;
                            }
                            
                            .dates .editorail-heading {
                                font-family: Geomanist-light;
                                font-size: 16px;
                                font-weight: bold;
                                text-align: center;
                                margin-left: 18px;
                                text-transform: uppercase;
                            }
                            .booking-page-footer-section h6 {
                                color: #fff;
                                font-weight: bold;
                                font-family: Geomanist-light;
                                margin-bottom: 32px;
                                text-transform: uppercase;
                            }
                            .booking-page-footer-section .white-border-bottom {
                                border-bottom: 2px solid #fff;
                                margin: 0 auto;
                                width: 35px;
                            }
                            
                            .hotels-logo h3.title a, .hotels-logo h3.title a:hover {
                                color: #fff;
                                text-transform: uppercase;
                                font-size: 14px;
                            }
                            
                            .editorial-hotel-detail-page hr.star-light {
                                padding: 0;
                                border: none;
                                border-top: solid 1px;
                                text-align: center;
                                text-transform: uppercase;
                                max-width: 100px;
                                margin: 4px auto 0;
                                border-radius: 10px;
                            }
                            
                            .booking-form-bar-top {
                                background-color: rgba(0, 0, 0, 0.85);
                                float: left;
                                opacity: unset !important;
                                padding-left: 100px !important;
                                padding-right: 8px !important;
                                padding-top: 9px !important;
                                position: absolute;
                                top: 0;
                                width: 100% !important;
                            }
                            
                            .booking-page-footer-section span {
                                color: #ABA07C;
                                display: block;
                                font-size: 17px;
                                margin-bottom: 0.3em;
                            }

                            
                            


                            
                            @import url('https://fonts.googleapis.com/css?family=Caveat');
                            @import url('https://fonts.googleapis.com/css?family=Satisfy');
                            @import url('https://fonts.googleapis.com/css?family=Zeyada');

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
    <body id="main">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
                        <div class="container-fluid logo-padding-left editorial-logo-align">
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
                                <div class="header container-fluid">
									<div class="col-md-12">
										<div class="header-logo">
											<a href="{{url()}}">
												<img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Emporium Voyage"/>
											</a>
										</div>
									</div>
                                </div>
								
                                <div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
                                    <div id="listproperties">
                                        <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												@if(!empty($propertiesArr))
												<div id="restaurant-sec" class="restaurant-sec-main-bg-align">
													<div class="container">
														<div class="restaurant-sec-pannel-main-align">
															<div class="ai_restaurant-name">
																<h2>{{$propertiesArr[0]->restaurant_title}}</h2>
																<span class="restaurant-sec-hotel-name-below-small-text">Get Inspired</span>
															</div>
															<div class="restaurant-sec-description-pannel1">
																<p>{{$propertiesArr[0]->restaurant_usp_text}}</p>
																<p class="restaurant-orange-creative-text-align"><span class="restaorant-des-orange-text">-{{$propertiesArr[0]->restaurant_usp_person}}</span></p>
															</div>
															<div class="clearfix"></div>
															<div class="restaurant-des-pannel-image1">
																@if($propertiesArr[0]->restaurant_image!='')
																<img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->restaurant_image),100,300,null)}}" alt=""/>  
																@endif
															</div>
															<div class="clearfix"></div>
															<div  class="restaurant-sec-main-align">
																<div class="col-md-4 col-sm-4">
																	<div class="row">
																		<div class="restaurant-sec-description-pannel2">
																			<p class="restaurtant-bar-des-para-style">{!! (strlen($propertiesArr[0]->restaurant_desciription) > 350) ? nl2br(e(substr($propertiesArr[0]->restaurant_desciription,0,350))).'...' : nl2br(e($propertiesArr[0]->restaurant_desciription)) !!}</p>
																			<div class="restaurant-owner-sign">{{$propertiesArr[0]->restaurant_usp_person}}</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-5 col-sm-5">
																	<div class="row restaurant-image-height-align">
																		<div class="restaurant-des-pannel-image2 restaurant-image-height-align">
																			@if($propertiesArr[0]->restaurant_image2!='')
																			<img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->restaurant_image2),100,500,null)}}" alt=""/>  
																			@else
																				@if($propertiesArr[0]->restaurant_image!='')
																				<img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->restaurant_image),100,500,null)}}" alt=""/>  
																				@endif
																			@endif
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3">
																	<div class="row">
																		@if($restaurant_gallery>0)
																			<div class="restaurant-view-gallery-align">
																				<span class="view-gallery-border-left"></span>
																				<a href="javascript:void(0);"   class="detail_view gallerysty bar-view-gallery" rel="{{$propertiesArr[0]->id}}" rel2="Restrurants Gallery Images">View Gallery</a>
																			</div>
																		@endif
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												@endif
											</div>
                                        </div>
                                    </div>
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
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Restaurants Hotel
                                                </div>
                                            </a>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <form>
															@if(!empty($propertiesArr))
																@foreach($propertiesArr as $property)
																	
																	<div class="form-group post-filter-inputs">
																		<label><a href="{{URL::to('')}}">{{$property->property_name}}</a></label>
																	</div>
																	
																@endforeach
															@endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        if (document.getElementById("mySidenavpost").style.width == "400px") {
                        return closeNavpost();
                        }
                        }
                        return openNavpost();
                        }
                        function openNavpost() {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "400px";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        else{
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        }
                        function closeNavpost() {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        window.onload = function () {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        }, 10000);
                        };
                        if ($(window).width() <= 767) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }

                        $(document).on('click', function (event) {
                        if ($(window).width() <= 767) {
                        if ($(event.target).has('.filter-width').length) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
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

                    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
                    <div class="editorial-custom-footer-style grid-page-footer-align">
                        @include('layouts/elliot/ai_footer_social')
                    </div>
