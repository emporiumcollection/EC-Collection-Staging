<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- title -->
        <title>Membership Page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <!-- animation -->
        <link href="{{ asset('sximo/assets/css/landing-page-styles.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/animate.css')}}" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/bootstrap.min.css')}}" />
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/font-awesome.min.css')}}" />
        <!-- swiper carousel -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
        <!-- style -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
        <!-- Custom style -->
        <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
        <!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
        <style>
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
                top: 127px;
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
                        <li class="contact-list-item contact-phone"><a href="#"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +1 934 451 1317</a></li>
                        <li class="contact-list-item contact-email"><a href="#"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> riaan@emporium-voyage.com</a></li>
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
                        <ul>
                            <li>
                                <a href="#" class="book-button open-search-page">Search Our Collection</a>
                            </li>
                            <li>
                                <a href="#" class="book-button open-date-page">Search By Date</a>
                            </li>
                            <li>
                                <a href="#" class="book-button open-destination-page">Select Your Destination</a>
                            </li>
                            <li>
                                <a href="#" class="book-button open-experience-page">Select Your Experience</a>
                            </li>
                            <!--<li>
                                    <a href="#" class="book-button open-about-page">About</a>
                            </li>
                            <li>
                                    <a href="#" class="book-button open-personalized-page">Personalized Service</a>
                            </li>-->
                        </ul>
                        <section class="regular slider">
                            <div class="slick-cstm-width">
                                <a href="http://www.bocadolobo.com/en/landing-page/de-market/" tabindex="-1"><img src="http://www.emporium-voyage.com/uploads/users/advertisement/1.png"></a>
                            </div>
                            <div class="slick-cstm-width">
                                <div class="side-bar-why-book-with-us">
                                    <div class="book-with-us-tittles">
                                        <h2>Why book with us?</h2>
                                    </div>
                                    <ul class="side-bar-book-with-us-list">
                                        <li>
                                            <h3>Handpicked Selection of Hotels</h3>
                                            <p>from selected luxury destinations worldwide</p>
                                        </li>
                                        <li>
                                            <h3>Upgrade and Late Checkout</h3>
                                            <p>At any Hotel upon Avilability</p>
                                        </li>
                                        <li>
                                            <h3>Preferred Guest Discounts at New Hotels</h3>
                                            <p>join our members club</p>
                                        </li>
                                        <li>
                                            <h3>Free Wifi</h3>
                                            <p>Guaranteed at all our Partner Hotels</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="slick-cstm-width">
                                <a href="http://www.bocadolobo.com/en/landing-page/de-market/" tabindex="-1"><img src="http://www.emporium-voyage.com/uploads/users/advertisement/1.png"></a>
                            </div>
                            <div class="slick-cstm-width">
                                <div class="side-bar-why-book-with-us">
                                    <div class="book-with-us-tittles">
                                        <h2>Why book with us?</h2>
                                    </div>
                                    <ul class="side-bar-book-with-us-list">
                                        <li>
                                            <h3>Handpicked Selection of Hotels</h3>
                                            <p>from selected luxury destinations worldwide</p>
                                        </li>
                                        <li>
                                            <h3>Upgrade and Late Checkout</h3>
                                            <p>At any Hotel upon Avilability</p>
                                        </li>
                                        <li>
                                            <h3>Preferred Guest Discounts at New Hotels</h3>
                                            <p>join our members club</p>
                                        </li>
                                        <li>
                                            <h3>Free Wifi</h3>
                                            <p>Guaranteed at all our Partner Hotels</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-md-10 no-padding">
                    <section class="wow fadeIn no-padding cstmaiclass">
                        <div class="swiper-auto-height-container position-relative width-100">
                            <div class="swiper-wrapper overflow-hidden">
                                <!-- start slider item -->
                                <div class="swiper-slide padding-100px-all cover-background position-relative xs-padding-20px-all" style="background-image:url(http://placehold.it/1920x1100)">
                                    <div class="position-relative width-55 md-width-60 sm-width-85 xs-width-100 display-inline-block slide-banner last-paragraph-no-margin">
                                        <div class="padding-80px-all bg-black-opacity sm-padding-40px-all xs-padding-30px-all xs-text-center xs-width-100">
                                            <h3 class="alt-font text-white sm-width-100">A digital studio crafting beautiful experiences.</h3>
                                            <p class="sm-width-100 lorem-para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                            <a href="services-classic.html" class="margin-35px-top sm-margin-15px-top btn btn-white">Explore services</a>
                                        </div> 
                                    </div>
                                </div>
                                <!-- end slider item -->
                                <!-- start slider item -->
                                <div class="swiper-slide padding-100px-all cover-background position-relative xs-padding-20px-all" style="background-image:url(http://placehold.it/1920x1697)">
                                    <div class="position-relative width-55 md-width-60 sm-width-85 xs-width-100 display-inline-block slide-banner last-paragraph-no-margin"> 
                                        <div class="padding-80px-all bg-black-opacity sm-padding-40px-all xs-padding-30px-all xs-text-center xs-width-100">
                                            <h3 class="alt-font text-white sm-width-100">A digital studio crafting beautiful experiences.</h3>
                                            <p class="sm-width-100 lorem-para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                            <a href="services-classic.html" class="margin-35px-top sm-margin-15px-top btn btn-white">Explore services</a>
                                        </div>  
                                    </div>
                                </div>
                                <!-- end slider item -->
                                <!-- start slider item -->
                                <div class="swiper-slide padding-100px-all cover-background position-relative xs-padding-20px-all" style="background-image:url(http://placehold.it/1920x1526)">
                                    <div class="position-relative width-55 md-width-60 sm-width-85 xs-width-100 display-inline-block slide-banner last-paragraph-no-margin">
                                        <div class="padding-80px-all bg-black-opacity sm-padding-40px-all xs-padding-30px-all xs-text-center xs-width-100">
                                            <h3 class="alt-font text-white sm-width-100">A digital studio crafting beautiful experiences.</h3>
                                            <p class="sm-width-100 lorem-para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                            <a href="services-classic.html" class="margin-35px-top sm-margin-15px-top btn btn-white">Explore services</a>
                                        </div>     
                                    </div>
                                </div>
                                <!-- end slider item -->
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
                    <!-- end slider section -->
                    <!-- start contact form section -->
                    <section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                        <div class="container-fluid">
                            <div class="row equalize sm-equalize-auto">
                                <div class="col-md-12 sm-clear-both wow fadeInLeft no-padding">
                                    <div class="padding-ten-half-all bg-light-gray md-padding-seven-all xs-padding-30px-all height-100">
                                        <!--<span class="text-extra-dark-gray alt-font text-large font-weight-600 margin-25px-bottom display-block">Application form</span>--> 
                                        <form id="contact-form" action="javascript:void(0)" method="post">
                                            <div class="col-md-12 sm-clear-both">
                                                <div id="success-contact-form" class="no-margin-lr"></div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Name</label>
                                                    <input type="text" name="name" id="name" placeholder="Hotel Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Status</label>
                                                    <select class="bg-white medium-input">
                                                        <option value="">Select Status</option>
                                                        <option value="">Open</option>
                                                        <option value="">Construction phase</option>
                                                        <option value="">Planning phase</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Type</label>
                                                    <select class="bg-white medium-input">
                                                        <option value="">Hotel Type</option>
                                                        <option value="">Alternative</option>
                                                        <option value="">Beach Resort</option>
                                                        <option value="">Resort</option>
                                                        <option value="">City</option>
                                                        <option value="">Mountain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Building</label>
                                                    <select class="bg-white medium-input">
                                                        <option value="">Hotel Building</option>
                                                        <option value="">New Construction</option>
                                                        <option value="">Existing Building</option>
                                                        <option value="">Conversion</option>
                                                    </select>
                                                </div> 
                                                <div class="col-md-12 col-sm-12 no-padding">
                                                    <label>*Hotel Opening Date</label>
                                                    <input type="date" name="Hotel Opening Date" placeholder="Hotel Opening Date*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="Street & Number" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="City" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="Country" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="postal" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>*Hotel Website</label>
                                                    <input type="text" name="website" placeholder="Hotel Website*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-left">
                                                    <label>*Days open for business</label>
                                                    <input type="text" name="Days open for business" placeholder="Days open for business*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label>Avg. Daily Rate</label>
                                                    <input type="text" name="Avg. Daily Rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-right">
                                                    <label>Avg. Occupancy</label>
                                                    <input type="text" name="Avg. Occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Number of Rooms</label>
                                                    <input type="text" name="Number of Rooms" placeholder="Number of Rooms*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Number of Suites</label>
                                                    <input type="text" name="Number of Suites" placeholder="Number of Suites*" class="bg-white medium-input">
                                                </div>
                                                <div class="row padding-row">
                                                    <div class="col-md-6 col-sm-12 no-padding-left">
                                                        <label>F & B Outlets</label>
                                                        <select multiple="" class="bg-white medium-input">
                                                            <option value="">-</option>
                                                            <option value="Restaurant">Restaurant</option>
                                                            <option value="Bar">Bar</option>
                                                            <option value="Beach Bar">Beach Bar</option>
                                                            <option value="Club">Club</option>
                                                            <option value="Lobby/Lounge">Lobby/Lounge</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 no-padding-right">
                                                        <label>Guest Facilities</label>
                                                        <select multiple="" class="bg-white medium-input">
                                                            <option value="">-</option>
                                                            <option value="">Gym</option>
                                                            <option value="">Indoor Pool</option>
                                                            <option value="">Outdoor Pool</option>
                                                            <option value="">Spa</option>
                                                            <option value="">Business Center</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Meeting Area</label>
                                                    <input type="text" name="Number of Suites" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Meeting Facilities</label>
                                                    <select class="bg-white medium-input">
                                                        <option>Please select</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>Comments/Other Facilities</label>
                                                    <textarea name="comment" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Concept</label>
                                                    <textarea name="Concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Architecture & Design</label>
                                                    <textarea name="architecture" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Architect Name</label>
                                                    <input type="text" name="Architect Name" placeholder="Architect Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Architect Website</label>
                                                    <input type="text" name="Architect Website" placeholder="Architect Website" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Interior Designer Name</label>
                                                    <input type="text" name="Interior" placeholder="Interior Designer Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Interior Designer Website</label>
                                                    <input type="text" name="Designer Website" placeholder="Interior Designer Website" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Local Integration</label>
                                                    <textarea name="Integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand</label>
                                                    <textarea name="Brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Brand Agency Name</label>
                                                    <input type="text" name="Agency" placeholder="Brand Agency Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand Agency Website</label>
                                                    <input type="text" name="Agency Website" placeholder="Brand Agency Website" class=" bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Brand Linkedin Profile</label>
                                                    <input type="text" name="Agency" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand Instagram Profile</label>
                                                    <input type="text" placeholder="Brand Instagram Profile" class=" bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
                                                <h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>*Entity Name</label>
                                                    <input type="text" name="Entity" placeholder="Entity Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="Street" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="City2" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="Country2" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="PostalCode" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="clear"></div>
                                                <div class="headingmimiform">
                                                    <h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*First Name</label>
                                                    <input type="text" name="firstname" placeholder="First Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Last Name</label>
                                                    <input type="text" name="lastname" placeholder="Last Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Company Name</label>
                                                    <input type="text" name="copnyname" placeholder="Company Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Job Title</label>
                                                    <input type="text" name="jobtile" placeholder="Job Title*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>*Email Address</label>
                                                    <input type="email" name="email" placeholder="Email*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Phone</label>
                                                    <input type="text" name="phone" placeholder="Phone*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Mobile</label>
                                                    <input type="text" name="mobile" placeholder="Mobile*" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row fooetr-form">
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <span><input class="checkbox" type="checkbox" name="terms" value="terms">I agree with the <a href="#">Terms and Conditions</a></span>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right text-align-right">
                                                    <button id="contact-us-button" type="submit" class="btn btn-white" style="width: 200px">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- end contact form section -->    
        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- fit video  -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.fitvids.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/main.js')}}"></script>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/memform/js/slick.js')}}" type="text/javascript"></script>
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
            )
        </script>
        <!-- contact email aside -->
    </body>
</html>