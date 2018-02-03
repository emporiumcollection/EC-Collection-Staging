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
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property-res.css')}}" rel="stylesheet" type="text/css"/>
        
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
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
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-sm-1"></div>
                    <div class="col-md-8 col-sm-8 banner-section">
                        <div class="row">
                            <h3 class="main-title">HOTEL JOSEF</h3>
                            <div class="image-slider-container">
                                <ul class="image-slider">
                                    <li class="active">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/hotel-josef.jpg')}}" alt=""/>
                                        <div class="note">
                                            <div class="text">-- Brussels' former Dominican abbey exudes a feeling of dramatic intimacy with soaring ceilings, luxurious textiles, and original stone flooring</div>
                                        </div>
                                    </li>
                                </ul>
                                <!--<div class="images-count">1 / 4</div>-->
                                <div class="image-slider-btns">
                                    <a class="image-slider-previous-btn" href="#">
                                        <img src="{{ asset('sximo/assets/images/left-arrow-white.png')}}" alt=""/>
                                    </a>
                                    <a class="image-slider-next-btn" href="#">
                                        <img src="{{ asset('sximo/assets/images/right-arrow-white.png')}}" alt=""/>
                                    </a>
                                </div>
                                <div class="mouse-icon">
                                    <img class="img-responsive" src="{{ asset('sximo/assets/images/mouse-icon.png')}}" alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-8 right-menus property-side-nav">
                        <div class="row">
                            <nav role="navigation" class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <!-- Collection of nav links and other content for toggling -->
                                <div id="navbarCollapse" class="collapse navbar-collapse">
                                    <div class="hotels-logo">
                                        <img class="img-responsive" src="{{ asset('http://design-locations.biz/sximo/assets/images/design-location-logo.png')}}" alt=""/>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#">HOTEL & ROOMS</a>
                                        </li>
                                        <li>
                                            <a href="#">SPA & RESTAURANT</a>
                                        </li>
                                        <li>
                                            <a href="#">DESIGN & ARCHITECTURE</a>
                                        </li>
                                        <li>
                                            <a href="#">PACKAGES</a>
                                        </li>
                                        <li>
                                            <a href="#">BOOK HOTEL</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <!--<div class="btns">
                                <div>
                                    <a class="prev" href="#">
                                        <img src="{{ asset('sximo/assets/images/left-arrow-white.png')}}" alt=""/>
                                    </a>
                                    <a class="next" href="#">
                                        <img src="{{ asset('sximo/assets/images/right-arrow-white.png')}}" alt=""/>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                                <span>NEXT HOTEL</span>
                                <span class="border"></span>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="row pub-page-sec-2">
                    <div class="image-slider-container">
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                            <div class="images-count">1 / 4</div>
                        </div>
                        <ul class="image-slider">
                            <li class="active">
                                <div class="col-md-12 col-sm-12 sec-heading">
                                    <h3>SUPERIOR ROOM</h3>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/JUNIOR-SUITES.png')}}" alt=""/>
                                        <div class="note">
                                            <div class="text">-- Brussels' former Dominican abbey exudes a feeling of dramatic intimacy with soaring ceilings, luxurious textiles, and original stone flooring</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 center-image">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/icons_1.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 last-node">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/room.png')}}" alt=""/>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <div class="col-md-12 col-sm-12 sec-heading">
                                    <h3>SUPERIOR ROOM 2</h3>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/JUNIOR-SUITES.png')}}" alt=""/>
                                        <div class="note">
                                            <div class="text">-- Brussels' former Dominican abbey exudes a feeling of dramatic intimacy with soaring ceilings, luxurious textiles, and original stone flooring</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 center-image">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/icons_1.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 last-node">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/room.png')}}" alt=""/>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="image-slider-container">
                        <div class="image-slider-btns">
                            <a class="image-slider-previous-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/left-arrow.png')}}" alt=""/>
                            </a>
                            <a class="image-slider-next-btn" href="#">
                                <img src="{{ asset('sximo/assets/images/right-arrow.png')}}" alt=""/>
                            </a>
                            <div class="images-count">1 / 4</div>
                        </div>
                        <ul class="image-slider">
                            <li class="active">
                                <div class="col-md-12 col-sm-12 sec-heading">
                                    <h3>JUNIOR SUITES</h3>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/JUNIOR-SUITES.png')}}" alt=""/>
                                        <div class="note">
                                            <div class="text">-- Brussels' former Dominican abbey exudes a feeling of dramatic intimacy with soaring ceilings, luxurious textiles, and original stone flooring</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 center-image">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/icons_1.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 last-node">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/room.png')}}" alt=""/>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <div class="col-md-12 col-sm-12 sec-heading">
                                    <h3>JUNIOR SUITES</h3>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/JUNIOR-SUITES.png')}}" alt=""/>
                                        <div class="note">
                                            <div class="text">-- Brussels' former Dominican abbey exudes a feeling of dramatic intimacy with soaring ceilings, luxurious textiles, and original stone flooring -2</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 center-image">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/icons_1.png')}}" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 last-node">
                                    <div class="row">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/room.png')}}" alt=""/>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--HTML for book now page start here-->

        <div class="book-now-page">
            <div class="book-now-page-content">
                <div class="headings">
                    <h2>Book now & get our best rate!</h2>
                    <p>Exclusively for our hotel guests: Experience the 7132 Thermal Bath by night on Wednesday, Friday & Sunday</p>
                </div>
                <ul class="dates" id="two-inputs">
                    <li>
                        <div class="heading">Arrive</div>
                        <input id="date-range-arrive" size="20" value="12-01-2017">
                    </li>
                    <li>
                        <div class="heading">Departure</div>
                        <input id="date-range-destination" size="20" value="">
                    </li>
                </ul>
                <ul class="dates">
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
            });
        </script>
        <script>
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

        </script>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>