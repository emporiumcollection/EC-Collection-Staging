<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- title -->
        <title>Membership Page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <!-- animation -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/animate.css')}}" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/bootstrap.min.css')}}" />
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" />
        <!-- style -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
        <!-- Custom style -->
        <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
        <!-- AIC -->
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-slide-nav.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/custom_ps.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/booking-form.css')}}" rel="stylesheet" type="text/css"/>
        <!-- AIC -->
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
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
        <style>
            .image-slider-margin-align {
                margin-bottom: 0;
                margin-top: 0;
            }
            header.haside {
                z-index: 1;
            }
            img.img-responsive.object-fit-size {
                object-fit: cover;
            }
            .book-now-page.mobile-show-hide {
                display: none;
            }
            .book-now-page.desktop-show-hide {
                display: none;
            }
            .slider-sec-side-text-bg {
                margin-top: -103%;
            }
            .right-menus ul li a {
                background-color: #1E2023;
                border-bottom: 1px solid #414246;
                color: #fff;
                display: block;
                font-size: 12px !important;
                padding: 25px 0 25px 21px;
                text-transform: uppercase;
                background: rgba(37,37,37,1.0);
            }
            .hotel-book-now {
                background: #ABA07C;
                color: #000;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }
            .editorial-image-slider-previous-btn {
                margin-left: 35% !important;
            }
            .image-slider-container .editorial-image-slider-btns {
                margin-top: -100px !important;
            }
            header.haside {
                right: 0 !important;
                position: fixed;
                top: 0;
                width: 65px;
                left: unset !important;
            }
            .next-hotel-show-pannel {
                right: 66px;
                position: absolute;
                top: 0;
                width: 250px;
                left:unset;
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
                border-radius: 0px;
                transition: .5s;
                position: fixed;
                top: 124px;
                left: calc(100% - 65px);
                width: 340px;
                background: #272727;
                color: #fff;
                font-size: 15px;
                right: 0;
            }
            .contact-aside ul {
                padding: 7px 0px 0px 0px;
                list-style: none;
            }
            .contact-aside li {
                padding: 6px 0px 6px 18px;
                margin: 0px 0px 1px 0px;
            }
            .contact-aside li a {
                margin-left: 11px;
                font-size: 13px;
                color: #ABA07C;
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
                color: #ABA07C;
                font-size: 16px;
            }
            .neww-footer .container {
                width: auto;
            }
            #formerrors { color:#ff0000;}

            /*AIC model */

            .book-button.open-show_more-page.hotel-btn {
                background: #ABA07C none repeat scroll 0 0;
                color: #fff;
                font-size: 15px;
                margin-left: 0 !important;
                margin-top: 52px;
                max-height: 95px;
                min-height: 95px;
                opacity: 0.83;
                padding: 34px 27px;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
            }

            .VegasModelDialog {
                width: 100%;
                margin: 4px auto;
            }

            .vegasModelFade {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 1050;
                display: none;
                overflow: hidden;
                -webkit-overflow-scrolling: touch;
                outline: 0;
                background-color: black;
                opacity: 0.8;
                height: 100%;
                overflow-x: hidden;
                overflow-y: hidden;
            }

            .vegasModelContent {
                background: rgba(0, 0, 0, 0.92) none repeat scroll 0 0;
                opacity: 1;
                min-height: 63em;
                border-radius: 0px;
                float: left;
            }

            .vegasModelHeader {
                border-bottom: none;
            }

            .vegasModelFooter {
                border-top: none;
            }

            .SlickVegasWidth {

                width: 18.5%;
            }

            .vegasGallery1 {
                min-height: 500px;
                padding: 0px 0px 0px 0px !important;
                float: left;
                width: 81.333%;
            }

            .Vegasregular {
                width: 100%;
                margin: 0 auto;
                float: left;
                visibility: visible;
            }

            .VegasCloseButton {
                color: #ABA07C;
                opacity: 1;
                font-size: 50px;
                box-shadow: none;
                text-shadow: none;
            }

            .VegasCloseButton:hover {
                color: #ABA07C;
                opacity: 1;
                font-size: 50px;
                box-shadow: none;
                text-shadow: none;
            }

            .VegasPopLogo {
                width: 20%;
                margin: 0 auto;
                padding-top: 100px;
                text-align: center;
                display: block;
            }

            .VegasDetailInner {
                padding: 20px;
                padding-top: 0px;
            }

            .grid-item {
                height: auto;
            }

            .vogasThumbnail img {
                width: 100%;
            }

            .vogasThumbnail {
                padding: 0px;
                background: none;
                border: none;
            }
            .Sidenavimg {
                width: auto;
                min-width: 200px;
            }

            /* AIC alider */

            .slider-sec-side-text-bg {
                margin-top: -580px;
            }
            .image-slider-btns-bg {
                background-color: #252525;
                color: #fff;
                float: right;
                margin-top: -157px;
                opacity: 0.85;
                padding: 49px 11px;
                width: 35%;
            }


        </style>
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
    </head>
    <body>
        <!-- Start slider section -->
        <div class="container-fluid">
            <header class="haside">

                <div class="logo-padding-left editorial-logo-align">
                    <!--<div>
                            <a href="#" title="Add to Favorites" class="book-button" onclick="add_to_lightbox(41688, 58);"><i class="fa fa-plus " aria-hidden="true" ></i> Add</a>
                    </div>-->
                    <div class="go-back-button-container">
                        <button class="go-back-button" onclick="goBack()">Go Back</button>
                        <div class="previous-page-screen-short-container">
                        </div>
                    </div>
                </div>
                <div class="hotel-next-previous-outer">
                    <div class="previous-btn previous-next-pannel"> 
                        <img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-left-arrow.png" alt="">
                        <a href="http://www.emporium-voyage.com/luxury-hotel-luxury-vander-urbani-resort">
                            <div class="next-hotel-show-pannel">
                                <img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4567_27731137764-82283525500.jpg" alt="">
                                <div class="next-hotel-tittle">
                                    <h2>VANDER URBANI RESORT</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="hotel-next-previous-outer">
                    <div class="next-hotel-btn previous-next-pannel"> 
                        <img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-right-arrow.png" alt="">
                        <a href="http://www.emporium-voyage.com/luxury-hotel-hotel-zoo-berlin-">
                            <div class="next-hotel-show-pannel">
                                <img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg" alt="">
                                <div class="next-hotel-tittle">
                                    <h2>Hotel Zoo Berlin </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </header>
            <!-- AIC Harman email phone sidebar add start -->

            <aside class="site-aside">
                <div class="contact-aside">
                    <ul class="contact-aside-list">
                        <li class="contact-list-item contact-phone"><a href="tel:+1 934 451 1317"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +1 934 451 1317</a></li>
                        <li class="contact-list-item contact-email"><a href="mailto: reservation@emporium-voyage.com"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> riaan@emporium-voyage.com</a></li>
                    </ul>
                </div>
            </aside>

            <!-- AIC Harman email phone sidebar add end-->
            <div class="row">
                <div class="col-md-2">
                    <div class="right-menus right-menu-sidebar">
                        <div class="hotels-logo">
                            <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive">
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
                                <div id="webpage{{$pmenu['menu_id']}}" class="panel-collapse  collapse">
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
                                    @if(!empty($whybookwithus))
                                    @foreach($whybookwithus as $withus)
                                    <li>
                                        <h3>{{$withus->title}}</h3>
                                        <p>{{$withus->sub_title}}</p>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @if(!empty($landingads))
                        @foreach($landingads as $lnads)
                        <div class="slick-cstm-width">
                            <a href="{{ (strpos($lnads->adv_link, 'http://') !== false) ? $lnads->adv_link : 'http://'.$lnads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$lnads->adv_img)}}"></a>
                        </div>
                        @endforeach
                        @endif
                    </section>
                </div>
            </div>
            <div class="col-md-10 no-padding">
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
                            <a href="#align-to-top" class="align-to-top-arrow"><img src="http://www.emporium-voyage.com/sximo/assets/images/scroll-down.png" class="down-arrow-align animate-arrow" alt=""> </a>
                        </div>
                    </div>
                </section>
                @endif
                <!-- end slider section -->
                <!-- start contact form section -->
                <section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                    <div class="container-fluid">
                        <div class="row equalize sm-equalize-auto">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
							@if (!empty($packages))
								<ul class="image-slider">
									{{--*/ $k=1; $tottyp = count($packages); /*--}}
									@foreach($packages as $key=>$package)
									<li class="{{($k==1) ? 'active' : ''}}">
                                        <a href="#">
                                            <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="height:580px; width: 100%;">
                                        </a>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="image-slider-btns-bg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="slider-sec-side-text-bg">
                                                            <div class="slider-side-sec-alignment">
                                                                <div class="expeience-small-text">Packages</div>
                                                                <div class="slider-side-text-tittle">{{$package->package_title}}</div>
                                                                <div class="slider-side-description-text">
                                                                    {{(strlen($package->package_description) > 300) ? substr($package->package_description,0,300).'...':$package->package_description}}
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img class="slider-next-image-btn img-responsive" src="http://www.emporium-voyage.com/uploads/properties_subtab_imgs/69726129-32146277.jpg" alt="">
                                                                <a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn ClickButton">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
									{{--*/ $k++; /*--}}
												
									@endforeach

                                </ul>
                                <div class="clearfix"></div>
                                <div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
                                <div class="editorial-image-slider-btns image-slider-btns">
                                    <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt="">
                                    </a>
                                    <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt="">
                                    </a>
                                </div>
								@endif
                            </div>
                        </div>
                    </div>
                </section>

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
                                        <div class="text-section"><h2>JUNIOR SUITE BEACHFRONT</h2>
                                            <p>• 81sqm (872sqft)
                                                <br>• Double bed
                                                <br>• Beach view
                                                <br>• Terrace
                                                <br>• Complimentary WiFi
                                                <br>• Air conditioning
                                                <br>• Shower and bathtub</p>
                                            <p>Covering 81 sq. metres, the 44 Junior Suites are among the most generously proportioned in Mauritius. Designed to blend modernity with practicality, they're housed in attractive villa buildings with four suites per villa. Like all guest accommodation at Shanti Maurice, the suites are equipped with plasma TVs, DVD players and broadband Internet access. The ground floor suites have direct access to the beach, as well as an outdoor rain shower, while the suites on the first floor have large balconies overlooking the Indian Ocean. As well as large bedrooms and bathrooms, each Junior Suite has a separate dressing room with an open closet and dressing table.</p>
                                        </div>
                                        <div class="book-btn-sec">
                                            <div class="hotel-book-price">Show More<a href="#"><div class="hotel-book-now">Buy Now</div></a>
                                            </div>
                                            <div class="inner-pop-up-book-btn">
                                                <a href="#" onclick="choose_room_type(1966);">Book</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>


                <!-- pop up -->

                <div class="modal fade vegasModelFade in" id="myModal" role="dialog">
                    <div class="modal-dialog VegasModelDialog">

                        <!-- Modal content-->
                        <div class="modal-content vegasModelContent">
                            <div class="modal-header vegasModelHeader">
                                <button type="button" class="close VegasCloseButton" data-dismiss="modal">×</button>
                                <a href="#" id="frontpage-layer-bj-header-logo"> <img class="VegasPopLogo" alt="" src="data:image/png;base64,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" data-pagespeed-url-hash="2747997174" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-2 SlickVegasWidth">
                                    <section class="Vegasregular slider slick-initialized slick-slider">
                                        <div aria-live="polite" class="slick-list draggable"><div class="slick-track" style="width: 0px; transform: translate3d(0px, 0px, 0px); opacity: 1;" role="listbox"><div class="slick-cstm-width slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 0px;" tabindex="-1" role="option">
                                                    <div class="side-nav-next-hotel-img Sidenavimg">
                                                        <div class="side-next-and-perivious-hotel-arrow">
                                                            <div class="arrows-commom  next-arrow">
                                                                <a href="http://www.emporium-voyage.com/luxury-hotel-the-mira-hong-kong" tabindex="0">
                                                                    <span>New Hotels</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="new-hotel-image" style="background-image:url(http://www.emporium-voyage.com/uploads/property_imgs_thumbs/xfront_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg.pagespeed.ic.nY-effTxow.jpg)">
                                                            <div class="new-hotels-image-tittle">
                                                                <h2 class="new-hotel-name">Hotel Zoo Berlin </h2>
                                                                <div class=" new-hotel-add">
                                                                    <p>New York City</p>
                                                                    <p>United States</p>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="new-hotel-view-more-btn">
                                                                <a class="" href="http://www.emporium-voyage.com/hotel-zoo-berlin-" tabindex="0">
                                                                    View Hotel
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <a class="bootom-view-next-btn" href="http://www.emporium-voyage.com/luxury-hotel-the-mira-hong-kong" tabindex="0">
                                                            Visit All Hotels DOI
                                                        </a>
                                                    </div>
                                                </div></div></div>

                                    </section>

                                </div>
                                <div id="frontpage-layer-bj-content" class="col-md-10 vegasGallery1">
                                    <div class="frontpage-detail-content-top">
                                        <div class="frontpage-detail-content-top-link">
                                            <div class="frontpage-detail-content-top-link"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row masonry-grid vegasgalleryimg"><div class="col-md-6 col-lg-4 masonry-column">  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/41767802254-78148460470.jpg"></a>  </div>  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/45103475203-77197756287.jpg"></a>  </div>  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/46301073746-59684422322.jpg"></a>  </div> </div><div class="col-md-6 col-lg-4 masonry-column">  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/33058154168-34094477237.jpg"></a>  </div>  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/35361925388-86451894872.jpg"></a>  </div>  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/16323879650-11779554560.jpg"></a>  </div> </div><div class="col-md-6 col-lg-4 masonry-column">  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/69281205576-51989796012.jpg"></a>  </div>  <div>	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="http://www.emporium-voyage.com/uploads/container_user_files/locations/hotel-zoo-berlin/restrurants-gallery-images/18040249289-17359995303.jpg"></a>  </div> </div></div>
                                </div>
                            </div><!--
                          <div class="modal-footer vegasModelFooter">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>-->
                        </div>

                    </div>
                </div>

                <!-- popup end -->


                <style>
                    .footer
                    {
                        background-color: #f0f0f0 !important;
                    }
                </style>
                <div class="neww-footer">
                    @include('layouts/elliot/ai_footer_social')
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form section -->    
    <!-- javascript libraries -->
<!--    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.js')}}"></script>
    <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
     swiper carousel 
    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>
     fit video  
    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.fitvids.js')}}"></script>
    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/main.js')}}"></script>
    <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('sximo/assets/js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('sximo/assets/memform/js/slick.js')}}" type="text/javascript"></script>-->
    <script>
        $(document).ready(function () {
            $("a").on('click', function (event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {
                        window.location.hash = hash;
                    });
                }
            });
        });
        $('a[href*="#"]')
                // Remove links that don't actually link to anything
                .not('[href="#"]')
                .not('[href="#0"]')
                .click(function (event) {
                    // On-page links
                    if (
                            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                            &&
                            location.hostname == this.hostname
                            ) {
                        // Figure out element to scroll to
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        // Does a scroll target exist?
                        if (target.length) {
                            // Only prevent default if animation is actually gonna happen
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: target.offset().top
                            }, 1000, function () {
                                // Callback after animation
                                // Must change focus!
                                var $target = $(target);
                                $target.focus();
                                if ($target.is(":focus")) { // Checking if the target was focused
                                    return false;
                                } else {
                                    $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                    $target.focus(); // Set focus again
                                }
                                ;
                            });
                        }
                    }
                });
    </script>

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
    <!-- contact email aside -->
    <script>
        $('.contact-aside').hover(
                function () {
                    $(this).addClass('active')
                },
                function () {
                    $(this).removeClass('active')
                }
        );
<!-- Please remove .open-show_more-page- hifen ->
        $(document).on('click', '.open-show_more-page', function () {
            $('.show_more-page').css("background-image", "");
            $('.single-right-text-product').html('');
            $('.rmimgp').html('');
            $.ajax({
                url: "{{ URL::to('fetchpackagedetails')}}" + '/' + $(this).attr('rel'),
                type: "get",
                success: function (data) {
                    var rimg = "{{ URL::to('uploads/packages/')}}/" + data.pdata.package_image;
                    $('.rmimgp').html('<div class="right-text-section"></div>');
                    $('.show_more-page').css("background-image", "url('" + rimg + "')");
                    var imagesPro = '';
                    imagesPro += '<div class="text-section">';
                    imagesPro += '<h2>' + data.pdata.package_title + '</h2>';
                    imagesPro += '<p>' + data.pdata.package_description + '</p>';
                    imagesPro += '</div>';
                    imagesPro += '<div class="book-btn-sec">';
                    if (data.pdata.package_price_type != 1)
                    {
                        imagesPro += '<div class="hotel-book-price">';
                        imagesPro += (data.currency.content != '') ? data.currency.content : '$';
                        imagesPro += data.pdata.package_price;
                        imagesPro += '</div">';
                    }
                    imagesPro += '<a href="#"><div class="hotel-book-now">Book Now</div></a>';
                    imagesPro += '</div>';
                    imagesPro += '<div class="inner-pop-up-book-btn">';
                    imagesPro += '<a href="#">Book</a>';
                    imagesPro += '</div>';
                    imagesPro += '</div>';
                    $('.single-right-text-product').html(imagesPro);
                    $('.show_more-page').css("width", "100%");
                }
            });
            return false;
        });


    </script>

    <!-- contact email aside -->

    <script>
        $(".editorial-image-slider-previous-btn").click(function (event) {
            event.preventDefault();

            var index = $(this).parent().parent().find(".image-slider li.active").index();
            $(this).parent().parent().find(".image-slider li.active").removeClass("active");
            if (index == 0) {
                var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() + 1;
                $(this).parent().parent().find(".image-slider li:nth-child(" + lindex + ")").addClass("active");
                $(this).parent().parent().find(".images-count").html(lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
            } else
            {
                var rlindex = index;
                $(this).parent().parent().find(".image-slider li:eq(" + rlindex + ")").addClass("active");
                $(this).parent().parent().find(".images-count").html(index + " / " + $(this).parent().parent().find(".image-slider li").length);
            }


        });

        $(".editorial-image-slider-next-btn").click(function (event) {
            event.preventDefault();

            var index = $(this).parent().parent().find(".image-slider li.active").index();
            if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
                index = -1;
            }
            $(this).parent().parent().find(".image-slider li.active").removeClass("active");
            $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 1) + ")").addClass("active");

            $(this).parent().parent().find(".images-count").html((+index + 1) + " / " + $(this).parent().parent().find(".image-slider li").length);

        });

        setInterval(function () {
            var index = $(".auto-slider ul.image-slider > li.active").index();
            if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
                index = -1;
            }

            $(".auto-slider ul.image-slider > li.active").removeClass("active");
            $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 1) + ")").addClass("active");
            $(".auto-slider .images-count").html((+index + 1) + " / " + $(".auto-slider ul.image-slider > li").length);

        }, 40000);
    </script>


</body>
</html>