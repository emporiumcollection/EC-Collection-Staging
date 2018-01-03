<!DOCTYPE html>
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
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/cs.gallery.row .principale1 imgs/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m_slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-room.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/mobile-room.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-slide-nav.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/landing-page-accordian-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/detail-page.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/stick-nav-arrows.css')}}" rel="stylesheet" type="text/css"/>
		 <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>
        <!--JS Includes-->
        <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/html2canvas.js')}}" type="text/javascript"></script>
        <script src="{{asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/editorial-slide-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.dotdotdot.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
		
		<!-- new grid css and js -->
		<link href="{{ asset('sximo/assets/newgrid/css/animate.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('sximo/assets/newgrid/css/style1.css')}}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('sximo/assets/newgrid/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
                <!--<script src="{{ asset('sximo/assets/newgrid/js/main.js')}}" type="text/javascript"></script>-->
		<script src="{{ asset('sximo/assets/newgrid/js/skrollr.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/smooth-scroll.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/swiper.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/isotope.pkgd.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/wow.min.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/jquery.fitvids.js')}}" type="text/javascript"></script>
		<script src="{{ asset('sximo/assets/newgrid/js/skill.bars.jquery.js')}}" type="text/javascript"></script>
        <script>
			jQuery(document).ready(function ($) {
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
			$(document).ready(function (){
				var load_rooms = true;
				$( window ).scroll(function() {
					if($(window).scrollTop() > 650 && load_rooms == true) {
						load_rooms = false;
						$("#style-rooms").html('<p id="style-rooms-loading" style="padding:50px; text-align:center;">Loading....</p>');
						$.ajax({
							url: "<?php echo URL(); ?>/our-collection-pages/<?php echo $slug; ?>/style_rooms",
							type: "GET",
							success: function (data, textStatus, jqXHR) {
								$('#style-rooms-loading').remove();
								$("#style-rooms").html(data);
								$.ajax({
									url: "<?php echo URL(); ?>/our-collection-pages/<?php echo $slug; ?>/deisgnarchitecture",
									type: "GET",
									success: function (data, textStatus, jqXHR) {
										$("#deisgnarchitecture").html(data);
									}
								});
								$.ajax({
									url: "<?php echo URL(); ?>/our-collection-pages/<?php echo $slug; ?>/rooms",
									type: "GET",
									success: function (data, textStatus, jqXHR) {
										$("#rooms").html(data);
									}
								});
							}
						});
					}
				});
				
				
			});
		</script>

        <!-- video js player -->
        <link href="{{ asset('sximo/videojsplayer/video-js.css')}}" rel="stylesheet">
        <script src="{{ asset('sximo/videojsplayer/ie8/videojs-ie8.min.js')}}"></script>
        <script src="{{ asset('sximo/videojsplayer/video.js')}}"></script>
		
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
                margin-top: 22px;
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
                                height: 564px;
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
                                margin-top: 24px;
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
							
							.editorial-custom-footer-style {
								float: right !important;
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
                                margin-top: -196px;
                            }
                            
                            .hotels-showcase-right-side {
                                background-image: url('http://www.emporium-voyage.com/uploads/container_user_files/locations/phum-baitang/property-images/Phum Baitang (3).jpg');
                                height: 760px;
                                margin-top: -196px;
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
                                width: 100% !important;
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
                                padding-top: 10px;
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
                                text-align: left;
                                text-transform: uppercase;
                                max-width: 100px;
                                margin: 4px;
                                border-radius: 10px;
                            }
                            
                            .booking-form-bar-top {
                                background-color: rgba(0, 0, 0, 0.85);
                                float: left;
                                opacity: unset !important;
                                padding-left: 15px !important;
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
                            
                            /* AIC 2-1-2018 color correction */
                            
                            .headings > h2 {
                                font-size: 36px;
                            }
                            .headings > p {
                                color: #c7ab84;
                                font-size: 16px;
                            }
                            
                            .spa-sec-view-gallery span {
                                margin-top: 16px;
                            }
                            
                            .emporium-voyage-Menu {
                                font-size: 20px;
                                color: #ABA07C;
                                top: 31px;
                                position: absolute;
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
    <body class="editorial-hotel-detail-page">
        <div class="wrapper">
            <div class="container-fluid">
                <header>
                
				<div class="logo-padding-left editorial-logo-align">
					<!--<div>
						<a href="#" title="Add to Favorites" class="book-button" onclick="add_to_lightbox({{( array_key_exists('propimage', $propertyDetail)) ? $propertyDetail['propimage'][0]->id : ''}}, {{$propertyDetail['data']->id}});"><i class="fa fa-plus " aria-hidden="true" ></i> Add</a>
					</div>-->
					<div class="go-back-button-container">
						<button class="go-back-button" onclick="goBack()">Go Back</button>
						<div class="previous-page-screen-short-container">
							<?php if(\Session::get('ai_previous_page')): ?>
								<img src="{{URL()}}/sximo/previous_page_image/<?php echo \Session::get('ai_previous_page'); ?>">
							<?php endif; ?>
						</div>
					</div>
				</div>
                @if(!empty($relatedproperties))
					@if(array_key_exists('0',$relatedproperties))
						<div class="hotel-next-previous-outer">
							<div class="previous-btn previous-next-pannel"> 
								  <img class="img-responsive next-hotel-arrow" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
								<a href="{{URL::to($relatedproperties[0]->property_slug)}}">
									<div class="next-hotel-show-pannel">
										<img class="img-responsive" src="{{ URL::to('uploads/property_imgs_thumbs/front_property_'.$relatedproperties[0]->folder_id.'_'.$relatedproperties[0]->file_name)}}" alt="">
										<div class="next-hotel-tittle">
											<h2>{{$relatedproperties[0]->property_name}}</h2>
										</div>
									</div>
								</a>
							</div>
						</div>
					@endif
					@if(array_key_exists('1',$relatedproperties))
						<div class="hotel-next-previous-outer">
							<div class="next-hotel-btn previous-next-pannel"> 
								<img class="img-responsive next-hotel-arrow" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
								<a href="{{URL::to($relatedproperties[1]->property_slug)}}">
									<div class="next-hotel-show-pannel">
										<img class="img-responsive" src="{{ URL::to('uploads/property_imgs_thumbs/front_property_'.$relatedproperties[1]->folder_id.'_'.$relatedproperties[1]->file_name)}}" alt="">
										<div class="next-hotel-tittle">
											<h2>{{$relatedproperties[1]->property_name}}</h2>
										</div>
									</div>
								</a>
							</div>
						</div>
					@endif
				@endif
                </header>
                <div id="editorial-siden-nav-res" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class=" right-menus ">
                        <div class="row-">
                            <div class="hotels-logo">
                                <h3 class="title"><a href="{{url('/')}}">{{$propertyDetail['data']->property_name}}</a><hr class="star-light"></h3>

                            </div>
                            <ul>
                                <li>
                                    <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                        <input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar" placeholder="Search" type="text">
                                    </form>
                                </li>

                                @if (array_key_exists('typedata', $propertyDetail))
                                <li>
                                    <a href="#hotel">@if($propertyDetail['data']->property_type=='Yachts') YACHT @elseif($propertyDetail['data']->property_type=='Villas') VILLA @else HOTEL @endif</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                                <li>
                                    <a href="#deisgnarchitecture" data-hotel-option="deisgn_architecture">DESIGN &amp; ARCHITECTURE</a>
                                </li>
                                @endif

                                @if (array_key_exists('typedata', $propertyDetail))
                                <li>
                                    <a  data-hotel-option="rooms_suites">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS & SUITES' }}</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                                <li>
                                    <a href="#spa_restaurant" data-hotel-option="restaurant_bar">RESTAURANT & BAR</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                                <li>
                                    <a href="#spa" data-hotel-option="spa_wellness">SPA & WELLNESS</a>
                                </li>
                                @endif
								
								@if($propertyDetail['data']->video_title!='')
                                <li>
                                    <a href="#video" data-hotel-option="video">VIDEO</a>
                                </li>
                                @endif
								
								<!--<li>
                                    <a href="#social" data-hotel-option="social">SOCIAL</a>
                                </li>-->
				
								@if(!empty($hotel_brochure))
									<li>
										<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$hotel_brochure_pdfsrc.$hotel_brochure->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="hotel_brochure"> Hotel Brochure </a>
									</li>
								@endif
								@if(!empty($restaurant_menu))
									<li>
										<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$restaurant_menu_pdfsrc.$restaurant_menu->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="restaurant_menu"> Restaurant Menu </a>
									</li>
								@endif
								@if(!empty($spa_brochure))
									<li>
										<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$spa_brochure_pdfsrc.$spa_brochure->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="spa_brochure"> Spa Brochure </a>
									</li>
								@endif

                                <li>
                                    <a href="#book-now" data-hotel-option="book_now">BOOK {{$propertyDetail['data']->property_name}} </a>
                                </li>
                            </ul>
                            <section class="regular slider">
								<div class="slick-cstm-width">
								   @if(!empty($relatedproperties))
									<div class="side-nav-next-hotel-img">
										<div class="side-next-and-perivious-hotel-arrow">
											<div class="arrows-commom  next-arrow">
												<a href="{{URL::to($relatedproperties[0]->property_slug)}}">
													<span>New Hotels</span>
												</a>
											</div>
										</div>
										{{--*/ $relatimg = URL::to('uploads/property_imgs_thumbs/front_property_'.$relatedproperties[0]->folder_id.'_'.$relatedproperties[0]->file_name); /*--}}
										<div class="new-hotel-image" style="background-image: url('{{$relatimg}}')">
											<div class="new-hotels-image-tittle">
												<h2 class="new-hotel-name">{{$relatedproperties[0]->property_name}}</h2>
												<div class=" new-hotel-add">
													<p>New York City</p>
													<p>United States</p>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="new-hotel-view-more-btn">
												<a class="" href="{{URL::to($relatedproperties[0]->property_slug)}}">
													View Hotel
												</a>
											</div>
										</div>
										<a class="bootom-view-next-btn" href="{{URL::to($relatedproperties[0]->property_slug)}}">
											Visit All Hotels DOI
										</a>
									</div>
									@endif
								</div>
								@if(!empty($sidebardetailAds))
								@foreach($sidebardetailAds as $adsdetail)
								<div class="slick-cstm-width">
									<a href="http://{{$adsdetail->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$adsdetail->adv_img)}}"></a>
								</div>
								@endforeach
								@endif
								
							</section>
                        </div>
                    </div>
                </div>
                <span class="hamburger-menu editorial-res-side-nav-logo"  onclick="openNav()"><img src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                <div class="clerafix"></div>
                <div class="editorial-page-booking-bar">
                    <section class="book-form-top-bar">
                        <div>
                            <form class="our-collection-top-booking-form" action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
                                <div class="booking-form-bar-top">
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group would-like-input padding-right-12">
                                                <label>I would like to</label>
                                                <select class="form-control ai-custom-deafault-style">
                                                    <option disabled selected>Book a Room</option>
                                                    <option>Book a Spa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label>at</label>
                                                <select name="property" class="form-control ai-custom-deafault-style">
                                                    <option value="{{$propertyDetail['data']->id}}">{{$propertyDetail['data']->property_name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="row">
                                            <div id="top-bar-booking-form">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <label class="align-with-label"></label>
                                                            <input id="top-bar-booking-form-arrive" name="arrive" class="form-control ai-custom-deafault-style" type="text" placeholder="Arriving">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <label class="align-with-label"></label>
                                                            <input id="top-bar-booking-form-destination" name="destination" class="form-control ai-custom-deafault-style" type="text" placeholder="Departing">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label class="align-with-label"></label>
                                                <select name="roomType" class="form-control ai-custom-deafault-style">
                                                    <option disabled="" selected>Select Room(s)</option>
                                                    @if (array_key_exists('typedata', $propertyDetail))
                                                    @foreach($propertyDetail['typedata'] as $type)
                                                    @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                                    <option value="{{$type->id}}">{{$type->category_name}}</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label class="align-with-label"></label>
                                                <div class="clearfix"></div>
                                                <button class="top-booking-bar-btn" type="submit">Book</button>
                                                <button class="top-booking-bar-btn click-share-btn">Share</button>
						<a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn"><i class="fa fa-lock " aria-hidden="true" ></i></a>
                                                <i class="fa fa-bars emporium-voyage-Menu" aria-hidden="true"></i>
                                                <!--<button  type="button" class="top-booking-bar-btn link-to-show active" onclick="hide_show_lightbox('show');">Favorites</button>
												<button type="button" class="top-booking-bar-btn link-to-hide" onclick="hide_show_lightbox('hide');" style="display:none;">Hide Favorites</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!--Yacht Specifications-->
                                    <?php if($propertyDetail['data']->property_type == 'Yachts'): ?>
                                    <div class="dropdown yacht-specifications-dropdown">
                                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Specifications<span class="caret yacts-specification-drop-arrow"></span></a>
                                         <div class="dropdown-menu yacht-specifications-dropdown-menu-list">
                                             <table class="table table-responsive">
                                                 <tbody>
                                                     <tr>
                                                         <td>Year Of build:</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_build_year; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Guests</td>
                                                         <td><?php echo $propertyDetail['data']->yachts_guest; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Length</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_length; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Beam</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_beam; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Draft</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_draft; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>GRT</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_grt; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Cabins</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_cabins; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Crew</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_crew; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>For Sale</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_for_sale; ?></td>
                                                     </tr>
                                                     <tr>
                                                         <td>For Charter</td>
                                                         <td><?php echo $propertyDetail['data']->yacht_for_charter; ?></td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!--Slider start here-->
                @if(!empty($propertyDetail)) 
                <div class="row">
                    @if (array_key_exists('propimage', $propertyDetail))
                    <div class="m_slider editorial_m_slider">
                        @if(!empty($propertyDetail['propimage']))
                        <ul>
                            @foreach($propertyDetail['propimage'] as $propimg)
                            {{--*/ $thactualsize = getimagesize($propertyDetail['propimage_containerpath'].$propimg->file_name); /*--}}
                            @if($thactualsize[0]>$thactualsize[1])
                            <li class="{{($propertyDetail['propimage'][0]==$propimg) ? 'active' : ''}}">
                                <div class="image editorial-image">
                                    <div class="overlaySlider"></div>
                                    <img src="{{ \ImageCache::make($propertyDetail['propimage_thumbpath_dir'].$propimg->file_name,100,1200,null) }}" alt=""/>
                                </div>

                                <div class="editorial-text">
                                    <div class="editor-picks-small-text">{{$propertyDetail['data']->property_name}}</div>
                                    <div class="description-bold-text">{{ $propertyDetail['data']->property_usp }}</div>
                                    <!--end slide -->
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                        <a href="#align-to-top" class="align-to-top-arrow"><img src="{{ asset('sximo/assets/images/scroll-down.png')}}" class="down-arrow-align animate-arrow" alt=""/> </a>
                            
                        <div class="editorial-arrows-container arrows-container">
                        	<a class="assign_detail_city">{{$propertyDetail['data']->assign_detail_city}}</a>
                            <a class="editorial-previous-arrow next-arrow" href="#">
                                <img class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
                            </a>
                            <a class="editorial-next-arrow previous-arrow" href="#">
                                <img  class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
                            </a>
                            
                        </div>
                    </div>
                    @endif
                    <!---Show Moare---->

                    <!--Slider end here-->
                    <div class="main-side" id="align-to-top">

                        <!--Hotel Section Block Two-->
                        <div id="hotel" class="hotel-sec-block-two srwerw">
                            <div class="container">
                                <div class="row">
                                    <div class="disply-left-right-align">
                                        <div class="col-md-6 disply-left-right-inner">
                                            <div class="hotel-block-two-left-sec-align">
                                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                                                <p>
                                                    {!! nl2br($propertyDetail['data']->detail_section1_description_box1) !!}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 disply-left-right-inner">
                                            <div class="hotel-block-two-right-sec-align">
                                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                                                <p>
                                                    {!! nl2br($propertyDetail['data']->detail_section1_description_box2) !!}
                                                </p>
                                                <div class="hotel-block-two-btn-right">
                                                    <a href="#style-rooms"  rel="" class="hotel-btn">View Rooms</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hotel Section Block Two End Here-->
                        <!--Hotels Section-->
                        <div id="dl_hotel_sec" class="dl_hotel-sec-bg">
                            <div class="">
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 col-sm-12 disply-left-right-align">
                                        <div class="hotels-detail-heading-text">
                                            <p>{!! nl2br($propertyDetail['data']->detail_section2_title) !!}</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 disply-left-right-inner hotels-des-left-side">
                                            <div class="hotels-detail-description-text">
                                                <p class="hotel-description-text">
                                                    {!! nl2br($propertyDetail['data']->detail_section2_description_box1)!!}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 disply-left-right-inner hotels-showcase-right-side">
                                            <div class="hotels-image-showcase-des-text">
                                                <p class="hotel-description-text">
                                                    {!! nl2br($propertyDetail['data']->detail_section2_description_box2) !!}
                                                    <br>
<!--                                                        <span class="pull-right">Situated in Norrmalm</span>-->
                                                </p>
                                            </div>
                                            <div class="hotel-block-two-btn-right">
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="image-showcase-below-big-text">
                                                {{$propertyDetail['data']->assign_detail_city}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hotels Section End-->
                        <!--Next Section-->
                        @if (array_key_exists('typedata', $propertyDetail))
                        <div class="row- pub-page-sec-2" >
                            <section id="interna" class="container-fluid">

                            </section>


                            <section id="style-rooms" class="container-fluid"></section>

                        </div>
                        @endif
                        <!--Next Section-->

                        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                        <div class="">
                            <div class="banner-below-section-bg" id="deisgnarchitecture">
                                Here
                            </div>
                        </div>
                        @endif

                        @if (array_key_exists('typedata', $propertyDetail))
                        <div class="container">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms"></div>
                        </div>
                        @endif

                        <div class="clearfix"></div>
                        <!--next sec-->
                        <div id="spa_restaurant">
                            @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                            <div id="restaurant-sec" class="restaurant-sec-main-bg-align">
                                <div class="container">
                                    <div class="restaurant-sec-pannel-main-align">
                                        <div class="ai_restaurant-name">
                                            <h2>{{$propertyDetail['data']->restaurant_title}}</h2>
                                            <span class="restaurant-sec-hotel-name-below-small-text">Get Inspired</span>
                                        </div>
                                        <div class="restaurant-sec-description-pannel1">
                                            <p>{{$propertyDetail['data']->restaurant_usp_text}}</p>
                                            <p class="restaurant-orange-creative-text-align"><span class="restaorant-des-orange-text">-{{$propertyDetail['data']->restaurant_usp_person}}</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="restaurant-des-pannel-image1">
                                            @if($propertyDetail['data']->restaurant_image!='')
                                            <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image),100,300,null)}}" alt=""/>  
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                        <div  class="restaurant-sec-main-align">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="row">
                                                    <div class="restaurant-sec-description-pannel2">
                                                        <p class="restaurtant-bar-des-para-style">{!! (strlen($propertyDetail['data']->restaurant_desciription) > 350) ? nl2br(e(substr($propertyDetail['data']->restaurant_desciription,0,350))).'...' : nl2br(e($propertyDetail['data']->restaurant_desciription)) !!}</p>
                                                        <div class="restaurant-owner-sign">{{$propertyDetail['data']->restaurant_usp_person}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="row restaurant-image-height-align">
                                                    <div class="restaurant-des-pannel-image2 restaurant-image-height-align">
                                                        @if($propertyDetail['data']->restaurant_image2!='')
                                                        <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image2),100,500,null)}}" alt=""/>  
                                                        @else
                                                            @if($propertyDetail['data']->restaurant_image!='')
                                                            <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image),100,500,null)}}" alt=""/>  
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
															<a href="javascript:void(0);"   class="detail_view gallerysty bar-view-gallery" rel="{{$propertyDetail['data']->id}}" rel2="Restrurants Gallery Images">View Gallery</a>
														</div>
													@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($propertyDetail['data']->restaurant2_title!='' && $propertyDetail['data']->restaurant2_desciription!='')
                            <div id="restaurant-sec" class="restaurant-sec-main-bg-align">
                                <div class="container">
                                    <div class="restaurant-sec-pannel-main-align">
                                        <div class="ai_restaurant-name">
                                            <h2>{{$propertyDetail['data']->restaurant2_title}}</h2>
                                            <span class="restaurant-sec-hotel-name-below-small-text">Get Inspired</span>
                                        </div>
                                        <div class="restaurant-sec-description-pannel1">
                                            <p>{{$propertyDetail['data']->restaurant2_usp_text}}</p>
                                            <p class="restaurant-orange-creative-text-align"><span class="restaorant-des-orange-text">-{{$propertyDetail['data']->restaurant2_usp_person}}</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="restaurant-des-pannel-image1">
                                            @if($propertyDetail['data']->restaurant2_image!='')
                                            <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant2_image),100,297,null)}}" alt=""/>  
                                            @endif  
                                        </div>
                                        <div class="clearfix"></div>
                                        <div  class="restaurant-sec-main-align">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="row">
                                                    <div class="restaurant-sec-description-pannel2">
                                                        <p class="restaurtant-bar-des-para-style">{!!(strlen($propertyDetail['data']->restaurant2_desciription) > 450) ? nl2br(e(substr($propertyDetail['data']->restaurant2_desciription,0,450))).'...':nl2br(e($propertyDetail['data']->restaurant2_desciription))!!}</p>
                                                        <div class="restaurant-owner-sign">{{$propertyDetail['data']->restaurant2_usp_person}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="row restaurant-image-height-align">
                                                    <div class="restaurant-des-pannel-image2 restaurant-image-height-align">
                                                        @if($propertyDetail['data']->restaurant2_image2!='')
                                                        <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant2_image2),100,500,null)}}" alt=""/>  
                                                        @endif 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="row">
													@if($restaurant_gallery>0)
														<div class="restaurant-view-gallery-align">
															<span class="view-gallery-border-left"></span>
															<a href="javascript:void(0);"   class="detail_view gallerysty bar-view-gallery" rel="{{$propertyDetail['data']->id}}" rel2="Restrurants Gallery Images">View Gallery</a>
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
                        @if($propertyDetail['data']->bar_title!='' && $propertyDetail['data']->bar_desciription!='')
                        <div id="hotel-bar-sec" class="hotels-bar-sec-align">
                            <div class="container">
                                <div class="bar-sec-inner-pannel">
                                    <div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="row">
                                                @if($propertyDetail['data']->bar_image!='')
                                                <img class="img-responsive img-width" src="{{ ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->bar_image),100,255,null)}}" alt=""/>  
                                                @endif
                                                <div class="hotel-bar-name-pannel">
                                                    <h2 class="bar-name-text-style">{{$propertyDetail['data']->bar_title}}</h2>
                                                    <div class="bar-name-border-bottom"></div>
                                                    <p class="bar-des-text">{{$propertyDetail['data']->bar_sub_title}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="bar-intro-text-bg">
                                                    <div class="bar- tiitles-main-align">
                                                        <h2 class="bar-info-text-haeding">{{$propertyDetail['data']->bar_usp_text}}</h2>
                                                        <p class="bar-info-text-style1">- {{$propertyDetail['data']->bar_usp_person}}</p>
                                                    </div>
                                                    <div class="red-pannel-text-align">
                                                        <div class="col-md-10 col-sm-6">
                                                            <div class="row">
                                                                <div class="bar-red-pannel-image">
                                                                    @if($propertyDetail['data']->bar_image2!='')
                                                                    <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->bar_image2),100,255,null)}}" alt=""/>  
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
																@if($bar_gallery>0)
																	<div class="view-gallery-pannel-align">
																		<span class="view-gallery-border-left"></span>
																		<a href="javascript:void(0);"   class="detail_view gallerysty bar-view-gallery " rel="{{$propertyDetail['data']->id}}" rel2="Bar Gallery Images">View Gallery</a>
																	</div>
																@endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="row">
                                                <div class="bar-image-rigth">
                                                    @if($propertyDetail['data']->bar_image3!='')
                                                    <img class="img-responsive img-width" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->bar_image3),100,255,null)}}" alt=""/>  
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="bar-bottom-des-pannel">
                                                    <p>{!! nl2br(e($propertyDetail['data']->bar_desciription)) !!}</p>
                                                    <div class="spa-owner-sign">{{$propertyDetail['data']->bar_usp_person}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                        <div id="spa" class="spa-sec-outer-align">
                            <div class="container">
                                <div class="ai-spa-sec-inner">
                                    <div class="main-spa-sec-show-area">
                                        <div class="spa-overlay-text">
                                            <blockquote>{{$propertyDetail['data']->spa_title}} <br><span>{{$propertyDetail['data']->spa_manager_text}}</span></blockquote>

                                        </div>
                                        @if($propertyDetail['data']->spa_image1!='')
                                        <img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image1),100,1000,null)}}" alt=""/>
                                        @else
                                        <img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/SPA-&-WELLNESS.png'),100,1000,null)}}" alt=""/>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="spa-left-pannel-align">
                                                <p class="spa-sec-para-style spa-text-pannel1">{!!  nl2br(e($propertyDetail['data']->spa_desciription)) !!}</p>

                                                @if($propertyDetail['data']->spa_image2!='')
                                                <img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image2),100,500,null)}}" alt=""/>
                                                @else
                                                <img class="img-responsive main-spa-img-align img-responsive" src="{{ImageCache::make(asset('sximo/assets/images/SPA-&-WELLNESS-2.png'),100,500,null)}}" alt=""/>
                                                @endif

                                                <div class="spa-left-des-pannel2">
                                                    @if($propertyDetail['data']->spa_opening_hours!='' && $propertyDetail['data']->spa_phone_number )
                                                    <h4 class="spa-bold-text">OPENING HOURS</h4>
                                                    <div class="spa-booking-des-text-align">
                                                        <p class="spa-sec-para-style">{!! nl2br(e($propertyDetail['data']->spa_opening_hours)) !!}</p>
                                                        <div class="spa-booking-info">
                                                            <p class="spa-sec-para-style">BOOKINGS:</p>
                                                            <p class="spa-sec-para-style">Phone: {{$propertyDetail['data']->spa_phone_number}}</p>
                                                            <p class="spa-sec-para-style"><a class="spa-booking-link" href="#">{{$propertyDetail['data']->spa_url}}</a></p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="spa-description-pannel2">
                                                @if($propertyDetail['data']->spa_image3!='')
                                                <img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image3),100,500,null)}}" alt=""/>
                                                @else
                                                <img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/Spa-Manager.png'),100,500,null)}}" alt=""/>
                                                @endif
                                                <div class="spa-products-tittles-align">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            @if($propertyDetail['data']->spa_image4!='')
                                                            <img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image4),100,250,null)}}" alt=""/>
                                                            @else
                                                            <img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/Spa-Manager.png'),100,250,null)}}" alt=""/>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <blockquote class="spa-content-quote">
                                                                {{$propertyDetail['data']->spa_usp_text}}
                                                                <p class="content-quote-author">- {{$propertyDetail['data']->spa_usp_person}}</p>
                                                            </blockquote>
															@if($spa_gallery>0)
																<div class="spa-sec-view-gallery">
																	<span class="view-gallery-border-left"></span>
																	<a href="javascript:void(0);"   class="detail_view gallerysty bar-view-gallery " rel="{{$propertyDetail['data']->id}}" rel2="Spa Gallery Images">View Gallery</a>
																</div>
															@endif
                                                            <div class="clearfix"></div>
                                                            <a href="#" class="spa-sec-book-an-appoinment-btn">Book Appointment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--Next-section-->
                        <!--Next Section-->
                        @if($propertyDetail['data']->video_title!='')
                        <div class="video-section-bg" id="video">
                            <div class="container">
                                <div class="video-sec-background-image">
									@if($propertyDetail['data']->video_type=="upload")
										{{--*/  $videolink = URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_video);
										$video_banner = ($propertyDetail['data']->video_image!='')? URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_image): URL::to('sximo/images/mp4.png');
										/*--}}
										<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered detVid"  controls="controls" preload="none" poster="{{$video_banner}}" data-setup="{ }" width="100%" height="500px">
											<source src="{{$videolink}}" type="video/mp4">
										</video>
									@elseif($propertyDetail['data']->video_type=="link")
										{{--*/ $vlink = explode('/',$propertyDetail['data']->video_link); $vimeoid = end($vlink); /*--}}
										@if($propertyDetail['data']->video_link_type=="youtube")
											{{--*/  $videolink = "https://www.youtube.com/embed/".$vimeoid; /*--}}
											<iframe width="100%" height="500px" src="https://www.youtube.com/embed/{{$vimeoid}}" frameborder="0" allowfullscreen></iframe>
										@elseif($propertyDetail['data']->video_link_type=="vimeo")
											{{--*/  $videolink = "https://player.vimeo.com/video/".$vimeoid; /*--}}
											<iframe width="100%" height="500px" src="{{$videolink}}" frameborder="0" allowfullscreen></iframe>
										@endif
										
									@endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
						
						<!--Book Now page-->
                        <div class="editorial-book-now-page sec-differentiate-line " id="book-now">
                            <form class="detail-page-booking-form" action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
                                <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}" />
                                <input type="hidden" name="roomType" id="roomType" value="" />
                                <div class="book-now-page-content-">
                                    <div class="editoral-book-page-headings">
                                        <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                                        <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                    </div>
                                    <ul class="dates" id="editorial-book-now-inputs">
                                        <li>
                                            <div class="editorail-heading">Arrive</div>
                                            <input id="date-range-editorial-arrive" name="arrive" class="datePicker- dateFrom-" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}" type="text" />
                                        </li>
                                        <li>
                                            <div class="heading">Departure</div>
                                            <input id="date-range-editorial-destination" name="destination" class="datePicker- dateFrom-" value="{{ ($destination_date!='') ? $destination_date : '' }}" type="text" />
                                        </li>
                                    </ul>
                                    <ul class="dates">
                                        <li>
                                            <div class="heading">Adults</div>
                                            <select name="booking_adults">
                                                <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                                                <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                                                <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>
                                            </select>
                                        </li>
                                        <li>
                                            <div class="heading">Children</div>
                                            <select name="booking_children">
                                                <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                                                <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                                                <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
                                            </select>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="editorial-submit-btn">
                                        <button type="submit">BOOK NOW</button>
                                    </div>
                                    <div class="view-modify-cancel-booking">
                                        <a href="#">View, Modify or Cancel your Booking</a>
                                    </div>
                                    <ul class="booking-page-footer-section editorial-book-align" >
                                        <li>
                                            <a href="#" target="_blank">
                                                <span>Join the worlds leading luxury club</span>
                                                <h6 class="center">Enjoy exclusive members only benefits</h6>
                                            </a>
                                            <div class="white-border-bottom"></div>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <span>Spa Treatment</span>
                                                <h6 class="center">Book</h6>
                                            </a>
                                            <div class="white-border-bottom"></div>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <span>View or Modify Reserveration</span>
                                                <h6 class="center">Login to Support Center</h6>
                                            </a>
                                            <div class="white-border-bottom"></div>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <div class="hotel-property-section-bg">
                            <div class="clearfix"></div>
                            <!--Show More Slide-->
                            <div class="show_more-page">
                                <div class="open-show_more-html">
                                    <div><a class="close-btn-show_more close-btn-align" href="#">&times;</a></div>
                                    <div class="container-">
                                        <div class="row-">
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-sm-6 rmimgp">

                                            </div>
                                            <div class="col-md-6 col-sm-6 single-right-text-product">

                                            </div>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Show More Slide End Here-->
                        <div class="col-md-2 right-menus right-menu-sidebar">
                            <div class="row">
                                <div class="right-menu-align">
                                    <div class="hotels-logo">
                                        <h3 class="title"><a href="{{url('/')}}">{{$propertyDetail['data']->property_name}}</a><hr class="star-light"></h3>
                                        
                                    </div>
                                    <ul>
                                        <li>
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                                <input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar" placeholder="Search" type="text">
                                            </form>
                                        </li>
                                        @if (array_key_exists('typedata', $propertyDetail))
                                        <li>
                                            <a href="#style-rooms" data-hotel-option="rooms_suites">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS & SUITES' }}</a>
                                        </li>
                                        @endif
                                        @if (array_key_exists('typedata', $propertyDetail))
                                        <li>
                                            <a href="#hotel">@if($propertyDetail['data']->property_type=='Yachts') YACHT INFO  @elseif($propertyDetail['data']->property_type=='Villas') VILLA INFO @else HOTEL INFO @endif</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                                        <li>
                                            <a href="#deisgnarchitecture" data-hotel-option="deisgn_architecture">DESIGN &amp; ARCHITECTURE</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                                        <li>
                                            <a href="#spa_restaurant" data-hotel-option="restaurant_bar">RESTAURANT & BAR</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                                        <li>
                                            <a href="#spa" data-hotel-option="spa_wellness">SPA & WELLNESS</a>
                                        </li>
                                        @endif
										
										@if($propertyDetail['data']->video_title!='')
										<li>
											<a href="#video" data-hotel-option="video">VIDEO</a>
										</li>
										@endif
										
										<!--<li>
											<a href="#social" data-hotel-option="social">SOCIAL</a>
										</li>-->

                                        @if(!empty($hotel_brochure))
											<li>
												<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$hotel_brochure_pdfsrc.$hotel_brochure->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="hotel_brochure"> Hotel Brochure </a>
											</li>
										@endif
										@if(!empty($restaurant_menu))
											<li>
												<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$restaurant_menu_pdfsrc.$restaurant_menu->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="restaurant_menu"> Restaurant Menu </a>
											</li>
										@endif
										@if(!empty($spa_brochure))
											<li>
												<a href="javascript:window.open('{{URL::to('propertyflipbook?pdfname='.$spa_brochure_pdfsrc.$spa_brochure->file_name)}}', 'Flipbook', 'width=1300,height=800');" data-hotel-option="spa_brochure"> Spa Brochure </a>
											</li>
										@endif
													
										<li>
                                            <a href="#book-now" data-hotel-option="book_now">BOOK {{$propertyDetail['data']->property_name}} </a>
                                        </li>
                                    </ul>
                                </div>
								<section class="regular slider">
                                        <div class="slick-cstm-width">
                                           @if(!empty($relatedproperties))
											<div class="side-nav-next-hotel-img">
												<div class="side-next-and-perivious-hotel-arrow">
													<div class="arrows-commom  next-arrow">
														<a href="{{URL::to($relatedproperties[0]->property_slug)}}">
															<span>New Hotels</span>
														</a>
													</div>
												</div>
												{{--*/ $relatimg = URL::to('uploads/property_imgs_thumbs/front_property_'.$relatedproperties[0]->folder_id.'_'.$relatedproperties[0]->file_name); /*--}}
												<div class="new-hotel-image" style="background-image: url('{{$relatimg}}')">
													<div class="new-hotels-image-tittle">
														<h2 class="new-hotel-name">{{$relatedproperties[0]->property_name}}</h2>
														<div class=" new-hotel-add">
															<p>New York City</p>
															<p>United States</p>
														</div>
													</div>
													<div class="clearfix"></div>
													<div class="new-hotel-view-more-btn">
														<a class="" href="{{URL::to($relatedproperties[0]->property_slug)}}">
															View Hotel
														</a>
													</div>
												</div>
												
												<a class="bootom-view-next-btn" href="{{URL::to($relatedproperties[0]->property_slug)}}">
													Visit All Hotels DOI
												</a>
											</div>
											@endif
                                        </div>
                                        @if(!empty($sidebardetailAds))
                                        @foreach($sidebardetailAds as $adsdetail)
                                        <div class="slick-cstm-width">
                                            <a href="http://{{$adsdetail->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$adsdetail->adv_img)}}"></a>
                                        </div>
                                        @endforeach
                                        @endif
                                        
                                    </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!--Featured hotel popup end-->
	<!--New Login Pop Up Start Here-->
        <div id="login-forms-popup" class="popup login-form-pop-main-align">
             <div class="popup-inner">
                 <a href="#" class="popup-close-btn">&times;</a>
                 <div class="popup-content">
                     <div class="content-area">
                         <a class="dl-pop-logo-align" href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}"></a>
                     </div>
                     <!--Login Forms Start Here-->
                     <div class="landing-page-lock-login-btn-outer-align">
                         <div class="login-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Login With</div>
                                             <div class="ps-big-form-heading">Your Account</div>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="input-group ps-form-group-outer">
                                                 <input class="form-control ps-login-form-input" placeholder="Password" type="password">
                                                 <span class="input-group-addon login-forgot-pass-align"><a class="ps-forms-small-heading-link forgot-pass-show-form-btn" href="javascript:void(0)">Forgot?</a></span>
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">  Log In</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="forgot-pass-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Forgot Your</div>
                                             <div class="ps-big-form-heading">Password</div>
                                             <p class="form-white-samml-des-text">Enter your email and you will get Instructions to reset your password</p>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">Submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="create-account-form-show-hide">
                             <div class="login-sign-up-sidebar-outer-align">
                                 <div class="your-account-heading-align">
                                     <div class="ps-login-signup-form-top-bar">
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="ps-forms-cross-icons">
                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col-md-6 col-sm-6">
                                             <div class="row">
                                                 <div class="right-need-help-icon">
                                                     <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div class="ps-form-main-pannel">
                                         <div class="ps-form-heading-outer-align">
                                             <div class="ps-big-form-heading">Create Your Account</div>
                                             <div class="ps-big-form-heading">Password</div>
                                         </div>
                                         <form class="ps-login-sign-form-pannel">
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="text" class="form-control ps-login-form-input" placeholder="Email Address">
                                             </div>
                                             <div class="form-group ps-form-group-outer">
                                                 <input type="password" class="form-control ps-login-form-input" placeholder="Password">
                                             </div>
                                             <div class="ps-login-sign-submit-btn">
                                                 <button type="submit">Submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="">
                             <div class="login-sign-up-sidebar-outer-align account-with-us-show-hide">
                                 <div class="your-account-heading-align">
                                     <h2>Your Account With Us</h2>
                                 </div>
                                 <div class="ps-login-sign-up-image">
                                     <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                                 </div>
                             </div>
                             <div class="clearfix"></div>
                             <div class="ps-login-sign-up-main-pannel">
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="row">
                                         <a class="ps-login-sign-up-common ps-sign-up-btn sign-up-show-form-btn" href="javascript:void(0)">Sign Up</a>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="row">
                                         <a class="ps-login-sign-up-common  login-show-form-btn" href="javascript:void(0)">Log In</a>
                                     </div>
                                 </div>
                                 <div class="sign-in-with-fb-tab">
                                     <a class="ps-login-sign-up-common" href="javascript:void(0)">Sign In With LinkedIn</a>
                                 </div>
                             </div>
                         </div>
                         <!--Login Forms End Here-->
                     </div>
                     <div class="clearfix"></div>
                 </div>
             </div>
         </div>
                     </div>
                     <div class="clearfix"></div>
                 </div>
             </div>
         </div>
        <!--New Login Pop Up End Here-->
		<div id="detail-page-gallery-popup" class="popup detail-page-room-pop-up-align">
			<div class="popup-inner">
				<a href="javascript:void(0);" class="popup-close-btn">CLOSE</a>
				<div class="popup-content res-gallery-sec-padding">
					<div class="image-slider-container">

						<div class="clearfix"></div>
						<ul class="image-slider post-page-sideshow galleryimg">
						   
						</ul>
						<div class="images-count"></div>
						<div class="image-slider-btns">
							<a class="image-slider-previous-btn gallery-res-previous-btn" href="#">
								<img src="{{asset('sximo/assets/images/left-round-arrow.png')}}" alt=""/>
							</a>
							<a class="image-slider-next-btn gallery-res-next-btn" href="#">
								<img src="{{asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
							</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
        
        <!--Gallery popup end-->
		
        <script>
			jQuery(function () {
                jQuery('a').click(function () {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var target = jQuery(this.hash);
                        target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            jQuery('html, body').animate({
                                scrollTop: (target.offset().top - 110)
                            }, 1000);
                            return false;
                        }
                    }
                });
            });
			
			$(document).on('click', '.detail_view', function () {
				$.ajax({
                    url: "{{ URL::to('getpropertygallery')}}" + '/' + $(this).attr('rel') + '/' + $(this).attr('rel2'),
                    type: "get",
                    success: function (data) {
                        var imagesPro = '';
						var im=0;
						var di=1;
						var lngimg = Math.round((data.image.length)/3);
						imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
						$(data.image).each(function (i, val) {
							var clsact = '';
							
							imagesPro += '  <div>';
							imagesPro += '	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="' + val.imgsrc_cache + '"></a>';
							imagesPro += '  </div>';
							if(di==lngimg)
							{
								di=0;
								imagesPro += ' </div>';
								imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
							}
							
							//imagesPro += '<li class="'+clsact+'"><img class="img-responsive" src="' + val.imgsrc_cache + '" alt=""/></li>';
							im++;
							di++;
                        });
						imagesPro += ' </div>';
                        $('#myModal .vegasgalleryimg').html(imagesPro);
						$('#myModal').modal('show');
						//$('#detail-page-gallery-popup .images-count').html('1/'+im);
						
						/*$(document).on('click', '.gallery-res-previous-btn', function ( event ) {
							event.preventDefault();
					
							var index = $(this).parent().parent().find(".image-slider li.active").index();
							$(this).parent().parent().find(".image-slider li.active").removeClass("active");
							if (index+1 == 0) {
								var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() +1;
								$(this).parent().parent().find(".image-slider li:nth-child("+lindex+")").addClass("active");
								$(this).parent().parent().find(".images-count").html( lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
							}
							else
							{
								var rlindex = index + 1;
								
								$(this).parent().parent().find(".image-slider li:eq("+index+")").addClass("active");
								$(this).parent().parent().find(".images-count").html( rlindex + " / " + $(this).parent().parent().find(".image-slider li").length);
							}
							
							
						});
						
						$(document).on('click', '.gallery-res-next-btn', function ( event ) {
							event.preventDefault();

							var index = $(this).parent().parent().find(".image-slider li.active").index();
							if (index == $(this).parent().parent().find(".image-slider li:last-child").index() + 1) {
								index = -2;
							}

							$(this).parent().parent().find(".image-slider li.active").removeClass("active");
							$(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 1) + ")").addClass("active");
							
							$(this).parent().parent().find(".images-count").html( (+index + 1) + " / " + $(this).parent().parent().find(".image-slider li").length);
							
						});*/
                    }
                });
                return false;
            });

            $(document).on('click', '.frontpage-layer-bj-header-close', function () {
                $('.frontpage-layer-bj').fadeOut('slow');
                $('html').removeClass('hidescroll');
            });

            $(document).on('click', '.open-show_more-page', function () {
                $('.show_more-page').css("background-image", "");
                $('.single-right-text-product').html('');
                $('.rmimgp').html('');
                $.ajax({
                    url: "{{ URL::to('getpropertytypedetail')}}" + '/' + $(this).attr('rel'),
                    type: "get",
                    success: function (data) {
                        var rimg = data.roomimgs.imgsrc_cache;
                        $('.rmimgp').html('<div class="right-text-section"></div>');
                        $('.show_more-page').css("background-image", "url('" + rimg + "')");
                        var imagesPro = '';
                        imagesPro += '<div class="text-section">';
                        imagesPro += '<h2>' + data.typedata.category_name + '</h2>';
                        imagesPro += '<p>' + data.amenities.amenities_eng.replace(/\n/g, "<br />") + '</p>';
                        imagesPro += '<p>' + data.typedata.room_desc + '</p>';
                        imagesPro += '</div>';
                        imagesPro += '<div class="book-btn-sec">';
                        if (data.typedata.price != '')
                        {
                            imagesPro += '<div class="hotel-book-price">';
                            imagesPro += (data.currency.content != '') ? data.currency.content : '$';
                            imagesPro += data.typedata.price;
                            imagesPro += '</div">';
                        }
                        imagesPro += '</div>';
                        imagesPro += '<div class="inner-pop-up-book-btn">';
                        imagesPro += '<a href="#" onclick="choose_room_type(' + data.typedata.id + ');">Book</a>';
                        imagesPro += '</div>';
                        imagesPro += '</div>';
                        $('.single-right-text-product').html(imagesPro);
                        $('.show_more-page').css("width", "100%");
                    }
                });
                return false;
            });

            function choose_room_type(type)
            {
                $('#roomType').val('');
                if (type != '' && type > 0)
                {
                    $('#roomType').val(type);
                    $(".detail-page-booking-form").trigger("submit");
                }
            }

            function save_reserve_forms_data(formid)
            {
                if (formid != '')
                {
                    var room = $('#roomType').val();
                    if (room != '')
                    {
                        $.ajax({
                            url: "{{ URL::to('add_new_booking')}}",
                            type: "post",
                            data: $('#' + formid).serializeArray(),
                            dataType: "json",
                            success: function (data) {
                                var html = '';
                                if (data.status == 'error')
                                {
                                    alert('error');
                                } else
                                {
                                    alert('done');
                                }
                            }
                        });
                    } else {
                        alert('Please select a room first');
                    }
                }
            }
        </script>
        <script src="{{ asset('sximo/assets/js/TweenMax.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/script.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/imagesloaded.js')}}" type="text/javascript"></script>
        <div class="editorial-custom-footer-style">
			@if(!isset($ps_main_page_name))
				<!--Sections-->
				<section id ="instagran" class="sections-instagram">
					<div class="full-width">
						<div data-is data-is-api="{{ URL::to('runInsta')}}" data-is-source="{{(!empty($propertyDetail) && $propertyDetail['data']->social_instagram!='')? $propertyDetail['data']->social_instagram : '@socialdesignlocations777' }}" data-is-rows="2" data-is-columns="6"></div>
					</div>
				</section>
				<!--Sections-->				@endif
				
				@if($propertyDetail['data']->assign_detail_city!='')
					@if(!empty($relatedgridpropertiesArr))
						<div class="container">
							<h2 class="bar-name-text-style" style="color:#000;">View our selection of Luxury Hotels in {{$propertyDetail['data']->assign_detail_city}}</h2>
							<div class="row no-margin">
											<div class="filter-content overflow-hidden margin-100px-top sm-margin-75px-top xs-margin-50px-top">
												<ul class="portfolio-grid work-4col hover-option2 gutter-small">
													<li class="grid-sizer"></li>
													<?php
													if($relatedgridpropertiesArr) {
														$rw = 1;
														$node_no = 1;
														$ads_node = 0;
														foreach($relatedgridpropertiesArr as $props) { ?>
														
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
										<?php
										/*if($rw%4==0) {
											echo '</div><div class="row">';
										}
										$rw++;
										$node_no++;*/
											}
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					@endif
				@endif
				<!--Footer-->
            @include('layouts/elliot/ai_footer_social')
        </div>

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
                <ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail">

                </ul>
            </div>	
        </div>
        <script>
            $(document).ready(function () {
                $(".our-collection-top-booking-form").submit(function (event) {
                    if($(this).find("select[name=roomType]").val() == 'null' || $(this).find("select[name=roomType]").val() == null) {
                        alert("Please select the room you wish to Book.");
                        event.preventDefault();
                    }
                });
                 /*Login form Scripts*/
                $(".sign-up-show-form-btn").click(function () {
                    $(".create-account-form-show-hide").show();
                    $(".account-with-us-show-hide").hide();
                    $(".login-form-show-hide").hide();
                    $(".forgot-pass-form-show-hide").hide();
                });
                $(".login-show-form-btn").click(function () {
                    $(".login-form-show-hide").show();
                    $(".account-with-us-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                    $(".forgot-pass-form-show-hide").hide();
                });
                $(".forgot-pass-show-form-btn").click(function () {
                    $(".forgot-pass-form-show-hide").show();
                    $(".login-form-show-hide").hide();
                    $(".account-with-us-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                });
                $(".show-account-with-us").click(function () {
                    $(".account-with-us-show-hide").show();
                    $(".forgot-pass-form-show-hide").hide();
                    $(".login-form-show-hide").hide();
                    $(".create-account-form-show-hide").hide();
                });
        </script>
        @include('layouts/elliot/ai_booking-form2')
        <!--Gallery popup start-->
        <script>
            $(document).ready(function () {
                $(".to-booking-nav-show-hide-btn").click(function () {
                    $(".booking-form-bar-top").toggle(1000);
                });
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
            /*previous page screen short*/
            /*var scaleBy = 1;
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
            $('#editorial-book-now-inputs').dateRangePicker(
				{
					selectForward: (Boolean),
					stickyMonths: (Boolean),
					startDate: "<?php echo date("d-m-Y") ?>",
					format: ' DD.MM.YYYY',
					separator: ' to ',
					getValue: function ()
					{
						if ($('#date-range-editorial-destination').val() && $('#date-range-editorial-arrive').val())
							return $('#date-range-editorial-destination').val() + ' to ' + $('#date-range-editorial-arrive').val();
						else
							return '';
					},
					setValue: function (s, s1, s2)
					{
					
						$('#top-bar-booking-form-arrive').val(s1);
						$('#top-bar-booking-form-destination').val(s2);
						
						$('#date-range-editorial-arrive').val(s1);
						$('#date-range-editorial-destination').val(s2);
						
						$('#date-range-arrive').val(s1);
						$('#date-range-departure').val(s2);
					}
				}
            ).bind('datepicker-first-date-selected', function (event, obj) {
                $("#date-range-editorial-destination").val('');
            });
            $('#top-bar-booking-form').dateRangePicker(
				{
					selectForward: (Boolean),
					stickyMonths: (Boolean),
					startDate: "<?php echo date("d-m-Y") ?>",
					format: ' DD.MM.YYYY',
					autoClose: "true",
					separator: ' to ',
					getValue: function ()
					{
						if ($('#top-bar-booking-form-destination').val() && $('#top-bar-booking-form-arrive').val())
							return $('#top-bar-booking-form-destination').val() + ' to ' + $('#top-bar-booking-form-arrive').val();
						else
							return '';
					},
					setValue: function (s, s1, s2)
					{
						$('#top-bar-booking-form-arrive').val(s1);
						$('#top-bar-booking-form-destination').val(s2);
						
						$('#date-range-editorial-arrive').val(s1);
						$('#date-range-editorial-destination').val(s2);
						
						$('#date-range-arrive').val(s1);
						$('#date-range-departure').val(s2);
					}
				}
            ).bind('datepicker-first-date-selected', function (event, obj) {
                $("#top-bar-booking-form-destination").val('');
            });
        </script>
        <script>
            function openNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "0";
            }
            $(function () {
                $('.slider-side-description-text').dotdotdot({
                    maxLength: 300,
                    ellipsis: '.......'
                });
            });
            $(function () {
                $('.hotel-description-text').dotdotdot({
                    maxLength: 300,
                    ellipsis: ' .......'
                });
            });
        </script>
        <script>
            $(".to-booking-nav-show-hide-btn").click(function () {
                $(".booking-form-bar-top").toggle(1000);
            });
        </script>
		@include('layouts/elliot/ai_lightbox_popups_detailpage')

             </body>
</html>
