<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> Test {{ $pageTitle}} | {{ CNF_APPNAME }}</title>
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


    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header >
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
                        </div>
                    </header>
                    <div class="header container-fluid">
                        <div class="col-md-12">
                            <div class="header-logo">
                                <a href="{{url()}}">
                                    <img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="EMPORIUM VOYAGE"/>
                                </a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="header-navigation-container col-md-12">
                                    <div class="row">
                                        <div class="col-md-0"></div>
                                        <div class="col-md-3 col-sm-2 header-text-align">
                                            <!-- <div class="hotel-select-breadcrumb">
                                                 <span>Dream Collection </span>
                                                 <p>Villa Orsula Dubrovnik</p>
                                             </div>-->
                                        </div>
                                        <div class="col-md-7 col-sm-8">
                                            <div class="header-navigation-menu">
                                                <nav class="navbar navbar-inverse">
                                                    <div class="container-fluid">
                                                        <div class="navbar-header">
                                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                            </button>
                                                        </div>
                                                        <div class="collapse navbar-collapse" id="myNavbar">
                                                            <ul class="nav navbar-nav">
                                                                <li class="active"><a href="#">HOTELS</a></li>

                                                                <li><a href="#">EXPERIENCE</a></li>
                                                                <!--<li><a href="content-grid-shuffle.html">MAGAZINE</a></li>-->
                                                                <li><a href="#">VILLAS</a></li>
                                                                <li><a href="#">YACHTS</a></li>
                                                                <li><a data-popup-id="search-page" class="video-popup-btn" href="#"><i class="fa fa-search"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="row res-margin-align">
                                                <div id="mySidenav" class="sidenav">
                                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                                    <a href="home.html">HOTELS</a>
                                                    <a href="editorial.html">EXPERIENCE</a>
                                                    <!--<a href="content-grid-shuffle.html">MAGAZINE</a>-->
                                                    <a href="#">VILLAS</a>
                                                    <a href="#">YACHTS</a>
                                                </div>
                                                <span class="hamburger-menu"  onclick="openNav()">&#9776;</span>
                                            </div>
                                        </div>
                                        <a class="book-now trigger-booking" href="#">Book your stay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sticky-header-offset"></div>

                    <!-- Start dinamyc page -->
                    @include($pages)
                    <!-- End dinamyc page -->

                    <!--Sections-->
                    <section id ="instagran" class="sections-instagram">
                        <div class="full-width">
                            <ul>
                                <li><img src="{{ asset('sximo/assets/images/insta-1.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-2.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-3.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-4.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-5.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-6.png')}}"/></li>
                                <li><img src="{{ asset('sximo/assets/images/insta-7.png')}}"/></li>
                            </ul>
                        </div>
                    </section>
                    <!--Sections-->	

                    <div class="container">
                        <div class="col-md-12 pre-footer-sec-align">
                            <p>Follow @Emporium-Voyage</p>
                            <p>Premium Lifestyle Portfolio World Wide<br/>Carefully created to ensure the ultimate luxury</p>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="footer">
                        <div class="container footer-padding-0">
                            <div class="col-md-12 col-sm-12 col-xs-12 footer-padding-0">
                                <div class="col-md-3 col-sm-3 col-xs-12 footer-sec-padding-left footer-padding-0">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="row">
                                            <div class="accordion res-design-footer">Company</div>
                                            <div class="panel">
                                                <ul class="footer-nav-menu footer-nav-menu-align">
                                                    <li><a href="#">Shop</a></li>
                                                    <li><a href="#">About</a></li>
                                                    <li><a href="#">Lookbook</a></li>
                                                    <li><a href="#">Blog</a></li>
                                                    <li><a href="#">Careers</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 footer-padding-0">
                                        <div class="accordion res-design-footer">Company</div>
                                        <div class="panel">
                                            <ul class="footer-nav-menu footer-nav-menu-align">
                                                <li><a href="#">Shop</a></li>
                                                <li><a href="#">About</a></li>
                                                <li><a href="#">Lookbook</a></li>
                                                <li><a href="#">Blog</a></li>
                                                <li><a href="#">Careers</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 footer-padding-0">
                                        <div class="accordion res-design-footer">Company</div>
                                        <div class="panel">
                                            <ul class="footer-nav-menu footer-nav-menu-align">
                                                <li><a href="#">Shop</a></li>
                                                <li><a href="#">About</a></li>
                                                <li><a href="#">Lookbook</a></li>
                                                <li><a href="#">Blog</a></li>
                                                <li><a href="#">Careers</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-12"></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="footer-nav-menu-harding footer-res-margin-align">About EMPORIUM VOYAGE</p>
                                    <p class="footer-about-us-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                        when an unknown printer took a galley of type and scrambled it to make a type.
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="footer-nav-menu-harding footer-res-margin-align">Newsletter</p>
                                    <p class="subscription-line">Subscribe and get 10% off on your next reservation</p>
                                    <form>
                                        <div class="res-form-align">
                                            <input type="text" placeholder="Email" class="newsletter-style">
                                            <input type="submit" value="Subscribe" class="nesletter-submit-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12 copy-right-sec">
                                <p><i class="fa fa-copyright" aria-hidden="true"></i> 2016 design locations All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Video popup start-->
        <div id="video-popup" class="popup">
            <div class="popup-inner">
                <a href="#" class="popup-close-btn">&times;</a>
                <div class="popup-content">
                    <h5>FEATURED VIDEOS</h5>

                    <a class="previous-round-btn res-previous-round-btn" href="#">
                        <img class="img-responsive" src="{{ asset('sximo/assets/images/left-round-arrow.png')}}" alt=""/>
                    </a>
                    <a class="next-round-btn res-next-btn" href="#">
                        <img class="img-responsive" src="{{ asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
                    </a>

                    <ul class="featured-vieos">
                        <li class="active" data-index="0">
                            <iframe src="https://www.youtube.com/embed/jDtEauKlksc" frameborder="0" allowfullscreen></iframe>
                            <h4>Making your way 1</h4>
                            <div class="comments">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <div class="text-uppercase text-muted">
                                        <small>2 THOUGHTS ON</small>
                                    </div>
                                    <h3 class="heading">Tatalab</h3>
                                    <ul>
                                        <li>
                                            <div class="col-md-1 col-sm-1">
                                                <div class="row">
                                                    <img class="img-responsive img-circle res-user-image-align" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-11 col-sm-11">
                                                <h5>Zeljko  Gudelj</h5>
                                                <div class="text-uppercase text-muted">
                                                    <small>April 28, 2013 at 12:01 pm</small>
                                                </div>
                                                <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <ul>
                                                <li>
                                                    <div class="col-md-1 col-sm-1">
                                                        <div class="row">
                                                            <img class="img-responsive img-circle res-user-image-align" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11 col-sm-11">
                                                        <h5>Zeljko  Gudelj</h5>
                                                        <div class="text-uppercase text-muted">
                                                            <small>April 28, 2013 at 12:01 pm</small>
                                                        </div>
                                                        <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li data-index="1">
                            <iframe src="https://www.youtube.com/embed/jDtEauKlksc" frameborder="0" allowfullscreen></iframe>
                            <h4>Making your way 2</h4>
                            <div class="comments">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <div class="text-uppercase text-muted">
                                        <small>2 THOUGHTS ON</small>
                                    </div>
                                    <h3 class="heading">Tatalab</h3>
                                    <ul>
                                        <li>
                                            <div class="col-md-1">
                                                <div class="row">
                                                    <img class="img-responsive img-circle" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-11">
                                                <h5>Zeljko  Gudelj</h5>
                                                <div class="text-uppercase text-muted">
                                                    <small>April 28, 2013 at 12:01 pm</small>
                                                </div>
                                                <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <ul>
                                                <li>
                                                    <div class="col-md-1">
                                                        <div class="row">
                                                            <img class="img-responsive img-circle" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <h5>Zeljko  Gudelj</h5>
                                                        <div class="text-uppercase text-muted">
                                                            <small>April 28, 2013 at 12:01 pm</small>
                                                        </div>
                                                        <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li data-index="2">
                            <iframe src="https://www.youtube.com/embed/jDtEauKlksc" frameborder="0" allowfullscreen></iframe>
                            <h4>Making your way 3</h4>
                            <div class="comments">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <div class="text-uppercase text-muted">
                                        <small>2 THOUGHTS ON</small>
                                    </div>
                                    <h3 class="heading">Tatalab</h3>
                                    <ul>
                                        <li>
                                            <div class="col-md-1">
                                                <div class="row">
                                                    <img class="img-responsive img-circle" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-11">
                                                <h5>Zeljko  Gudelj</h5>
                                                <div class="text-uppercase text-muted">
                                                    <small>April 28, 2013 at 12:01 pm</small>
                                                </div>
                                                <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <ul>
                                                <li>
                                                    <div class="col-md-1">
                                                        <div class="row">
                                                            <img class="img-responsive img-circle" src="{{ asset('sximo/assets/images/user-circle-thumb.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <h5>Zeljko  Gudelj</h5>
                                                        <div class="text-uppercase text-muted">
                                                            <small>April 28, 2013 at 12:01 pm</small>
                                                        </div>
                                                        <p>Aenean eu leo quam, Pellentesque ornare sem lacinia quam verenatis vestibulum. Viva-mus sagittis lacus vel auguel laoreet rutrum faucibus dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    </ul>
                    <div class="videos-count image-count">1 of 3</div>
                </div>
            </div>
        </div>
        <!--Video popup end-->

        <!--Featured hotel popup start-->
        <div id="featured-hotel-popup" class="popup">
            <div class="popup-inner">
                <a href="#" class="popup-close-btn">&times;</a>
                <div class="popup-content">
                    <h5>FEATURED PROPERTY</h5>
                    <div class="image-slider-container">
                        <ul class="image-slider">
                            <li class="active">
                                <div class="image-slider-container background-images">
                                    <ul class="image-slider">
                                        <li class="active">
                                            <img class="height-820 featured-hotels-pop-up-res-height img-responsive" src="{{ asset('sximo/assets/images/featured-hotel-1.jpg')}}" alt=""/>
                                        </li>
                                        <li>
                                            <img class="height-820 featured-hotels-pop-up-res-height img-responsive" src="{{ asset('sximo/assets/images/bg-1.jpg')}}" alt=""/>
                                        </li>
                                        <li>
                                            <img class="height-820 featured-hotels-pop-up-res-height img-responsive" src="{{ asset('sximo/assets/images/featured-hotel-1.jpg')}}" alt=""/>
                                        </li>
                                        <li>
                                            <img class="height-820 featured-hotels-pop-up-res-height img-responsive" src="{{ asset('sximo/assets/images/bg-3.jpeg')}}" alt=""/>
                                        </li>
                                    </ul>
                                    <div class="image-slider-btns res-round-arrow-align">
                                        <a class="image-slider-previous-btn" href="#">
                                            <img class="img-responsive" src="{{ asset('sximo/assets/images/left-round-arrow.png')}}" alt=""/>
                                        </a>
                                        <a class="image-slider-next-btn" href="#">
                                            <img class="img-responsive" src="{{ asset('sximo/assets/images/right-round-arrow.png')}}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="images-count">1 / 4</div>
                                </div>
                                <div class="col-md-4 col-sm-5 col-xs-12 room-details">
                                    <div class="top-heading">chaval blanc rooms</div>
                                    <div class="image-slider-container background-images">
                                        <ul class="image-slider">
                                            <li class="active">
                                                <img src="{{ asset('sximo/assets/images/chaval-blanc-rooms.jpg')}}" alt=""/>
                                            </li>
                                            <li>
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/featured-hotel-1.jpg')}}" alt=""/>
                                            </li>
                                        </ul>
                                        <div class="image-slider-btns">
                                            <a class="image-slider-previous-btn" href="#">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                                            </a>
                                            <a class="image-slider-next-btn" href="#">
                                                <img class="img-responsive" src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                                            </a>
                                        </div>
                                        <!--<div class="images-count">1 / 4</div>-->
                                    </div>
                                    <div class="clearfix"></div>
                                    <h3 class="title">cheval blanc</h3>
                                    <div class="underline"></div>
                                    <p>Normann Copenhagen is a Danish design company with the mission to create origanal, bold and eye-catching products in a simple and contemporary design that withstands the test of time.</p>
                                    <a class="room-btn" href="#">Experience Cheval Blanc</a>
                                </div>
                            </li>
                        </ul>
                        <div class="image-slider-btns bottom">
                            <a class="image-slider-previous-btn black-bg" href="#">
                                <div class="bold-text">FEATURED PROPERTY NAME</div>
                                <div class="text-gray">Spa Collection</div>
                            </a>
                            <a class="image-slider-next-btn black-bg" href="#">
                                <div class="bold-text">FEATURED PROPERTY NAME</div>
                                <div class="text-gray">Lifestyle Collection</div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--Featured hotel popup end-->

        <!--Gallery popup start-->
        <div id="gallery-popup" class="popup">
            <div class="popup-inner">
                <a href="#" class="popup-close-btn">&times;</a>
                <div class="popup-content res-gallery-sec-padding">
                    <div class="image-slider-container">
                        <div class="images-count">1 / 4</div>
                        <div class="popup_title">Fargfabriken Kunsthalle</div>
                        <div class="clearfix"></div>
                        <ul class="image-slider">
                            <li class="active">
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/gallery-image.png')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/gallery-image.png')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/gallery-image.png')}}" alt=""/></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/gallery-image.png')}}" alt=""/></a>
                            </li>
                        </ul>
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn gallery-res-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow-white.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn gallery-res-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow-white.png')}}" alt=""/>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--Gallery popup end-->

        <!--Product popup start-->
        <div id="product-popup" class="popup">
            <div class="popup-inner">
                <a href="#" class="popup-close-btn">&times;</a>
                <div class="popup-content">
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-1.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-4.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-7.png')}}" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-2.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-5.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-8.png')}}" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-3.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-6.png')}}" alt=""/>
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/product-9.png')}}" alt=""/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--Product popup end-->

        <!--Search popup start-->
        <div id="search-page" class="popup">
            <div class="popup-inner">
                <a href="#" class="popup-close-btn">&times;</a>
                <div class="popup-content">
                    <form>
                        <div class="">
                            <input type="text" />
                        </div>
                        <h1>Enter Keywords</h1>
                        <p>Press Enter / Return to being your search.</p>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--Search popup end-->

        <!--Social share start-->

        <div class="social-share">
            <a class="social-share-btn" href="#">FOLLOW</a>
            <ul style="display: none;">
                <li>
                    <a href="#">Twitter</a>
                </li>
                <li>
                    <a href="#">Instagram</a>
                </li>
                <li>
                    <a href="#">Facebook</a>
                </li>
                <li>
                    <a href="#">Pintrest</a>
                </li>
            </ul>
        </div>

        <!--Social share end-->

        <!--JS funcitons-->
        <!--HTML for book now page start here-->

        <div class="book-now-page">
            <div class="book-now-page-content">
                <div class="headings">
                    <h2>Book now & get our best rate!</h2>
                    <p>Exclusively for our hotel guests: Experience the 7132 Thermal Bath by night on Wednesday, Friday & Sunday</p>
                </div>
                <ul class="dates">
                    <li>
                        <div class="heading">Arrive</div>
                        <input id="date-range1" class="datePicker- dateFrom-" value="01 Jan 2016" type="text" />
                    </li>
                    <li>
                        <div class="heading">Departure</div>
                        <input id="date-range2" class="datePicker- dateFrom-" value="11 Jan 2017" type="text" />
                    </li>
                    <li>
                        <div class="heading">Adults</div>
                        <select>
                            <option>01</option>
                            <option selected="">02</option>
                            <option>03</option>
                        </select>
                    </li>
                    <li>
                        <div class="heading">Children</div>
                        <select>
                            <option>00</option>
                            <option>01</option>
                            <option>02</option>
                        </select>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
                <div class="submit-btn">
                    <a href="#">BOOK NOW</a>
                </div>
                <div class="view-modify-cancel-booking">
                    <a href="#">View, Modify or Cancel your Booking</a>
                </div>
                <ul class="booking-page-footer-section">
                    <li>
                        <a href="#" target="_blank">
                            <span>7132 SILVER Restaurant</span>
                            <h6 class="center">Reserve table</h6>
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
                            <span>Art of Alpine Luxury as a gift</span>
                            <h6 class="center">Voucher</h6>
                        </a>
                        <div class="white-border-bottom"></div>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" >Top</a>
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
            $('#date-range1').dateRangePicker(
                    {
                        startDate: "<?php echo date("Y-m-d") ?>",
                        separator: ' to ',
                        getValue: function ()
                        {
                            if ($('#date-range1').val() && $('#date-range2').val())
                                return $('#date-range1').val() + ' to ' + $('#date-range2').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2)
                        {
                            $('#date-range1').val(s1);
                            $('#date-range2').val(s2);
                        }
                    }
            );
            $('#date-range2').dateRangePicker(
                    {
                        startDate: "<?php echo date("Y-m-d") ?>",
                        separator: ' to ',
                        getValue: function ()
                        {
                            if ($('#date-range1').val() && $('#date-range2').val())
                                return $('#date-range1').val() + ' to ' + $('#date-range2').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2)
                        {
                            $('#date-range1').val(s1);
                            $('#date-range2').val(s2);
                        }
                    }
            );
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
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/slideshow.js')}}"></script>
        
    </body>
</html>