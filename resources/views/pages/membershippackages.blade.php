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