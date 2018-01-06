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
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav_1.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m_slider.css')}}" rel="stylesheet" type="text/css"/>

        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav_1.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/active-nav.js')}}" type="text/javascript"></script>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110391807-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-110391807-1');
		</script>
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
                            <div class="row">
                                <button class="go-back-button" onclick="goBack()">Go Back</button>
                            </div>
                        </div>
                    </header>
                    <div class="header container-fluid">

                        <!--Slider start here-->
                        <div class="row">
                            <div class="m_slider">
                                <ul>
                                    <li class="active">
                                        <div class="image">
                                            <img src="{{ asset('sximo/assets/images/banner.png')}}" alt=""/>
                                        </div>
                                        <div class="text">
                                            <div class="small-text">EDITOR'S PICKS</div>
                                            <div class="bold-text">Beller's Equal seating</div>
                                            <div class="bold-text">personifies minimalism - 1</div>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="image">
                                            <img src="{{ asset('sximo/assets/images/banner.png')}}" alt=""/>
                                        </div>
                                        <div class="text">
                                            <div class="small-text">EDITOR'S PICKS</div>
                                            <div class="bold-text">Beller's Equal seating</div>
                                            <div class="bold-text">personifies minimalism - 2</div>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="image">
                                            <img src="{{ asset('sximo/assets/images/banner.png')}}" alt=""/>
                                        </div>
                                        <div class="text">
                                            <div class="small-text">EDITOR'S PICKS</div>
                                            <div class="bold-text">Beller's Equal seating</div>
                                            <div class="bold-text">personifies minimalism - 3</div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="arrows-container">
                                    <a class="previous-arrow" href="#">
                                        <img src="{{ asset('sximo/assets/images/left-arrow_1.png')}}" alt=""/>
                                    </a>
                                    <a class="next-arrow" href="#">
                                        <img src="{{ asset('sximo/assets/images/right-arrow_1.png')}}" alt=""/>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--Slider end here-->

                        <div class="row">
                            <div class="header-navigation-container col-md-12">
                                <div class="col-md-1"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    @include('layouts/elliot/ai_navigation')
                                </div>
                                <div class="col-md-2">
                                    <div class="row- res-margin-align">
                                        <div id="mySidenav" class="sidenav">
                                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                            <a href="{{url()}}/filters-grid">HOTELS</a>
                                            <a href="{{url()}}/filters-grid">EXPERIENCE</a>
                                            <!--<a href="{{url()}}/content-grid-shuffle">MAGAZINE</a>-->
                                            <a href="{{url()}}/filters-grid">VILLAS</a>
                                            <a href="{{url()}}/filters-grid">YACHTS</a>
                                        </div>
                                        <span class="hamburger-menu"  onclick="openNav()"><img src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                                    </div>
                                </div>
                                <a class="book-now trigger-booking" href="#">Book your stay</a>
                            </div>
                        </div>
                    </div>

                    <div class="sticky-header-offset"></div>