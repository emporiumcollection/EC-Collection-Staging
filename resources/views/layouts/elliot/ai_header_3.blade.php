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
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property-res.css')}}" rel="stylesheet" type="text/css"/>
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
        <script src="{{ asset('sximo/assets/js/fliters.js')}}" type="text/javascript"></script>
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
    <body id="main">
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
                            <div class="m_slider custom-slider-style">
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
                            <div class="header-navigation-container container">
                                <div class="col-md-3 col-sm-2 header-text-align">
                                    <!-- <div class="hotel-select-breadcrumb">
                                         <span>Dream Collection </span>
                                         <p>Villa Orsula Dubrovnik</p>
                                     </div>-->
                                    <!--                                    <div>
                                                                            <div id="mySidenav" class="sidenav hamburger-menu-left-align">
                                                                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                                                                <a href="{{url()}}/filters-grid">HOTELS</a>
                                                                                <a href="{{url()}}/filters-grid">EXPERIENCE</a>
                                                                                <a href="{{url()}}/content-grid-shuffle">MAGAZINE</a>
                                                                                <a href="{{url()}}/filters-grid">VILLAS</a>
                                                                                <a href="{{url()}}/filters-grid">YACHTS</a>
                                                                            </div>
                                                                            <span class="left-hamburger-menu"  onclick="openNav()"><img class="hamburger-menu-align" src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                                                                        </div>-->
                                </div>
                                <div class="col-md-7 col-sm-8  res-left-nav-align">
                                    @include('layouts/elliot/ai_navigation')
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="row res-margin-align">
                                        <div id="mySidenavpost" class="sidenavpost">
                                            <div class="filter-width">
                                                <a href="javascript:void(0)" class="closebtn" onclick="closeNavpost()">&times;</a>
                                                <div class="design-locations-logo">
                                                    <a href="index.html"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                                </div>
                                                <div class="panel-group" id="accordion">
                                                    <div class="panel panel-default custom-post-panel">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                            <div class="panel-heading custom-heading">
                                                                Filter BY Price
                                                            </div>
                                                        </a>
                                                        <div id="collapse1" class="panel-collapse collapse">
                                                            <div class="panel-body custom-panel-body">
                                                                <div class="dl-filter">
                                                                    <div class="filter-by-price">
                                                                        <div id="slider-range" class="filter-slider"></div>
                                                                        <!--                                                                         <ul id="products"> 
                                                                                                                                                        <li data-price="10"> product - £10 </li>
                                                                                                                                                        <li data-price="50"> product - £50 </li>
                                                                                                                                                        <li data-price="100"> product - £100 </li>
                                                                                                                                                        <li data-price="150"> product - £150 </li>
                                                                                                                                                        <li data-price="200"> product - £200 </li>
                                                                                                                                                    </ul>-->
                                                                        <p>  
                                                                            <input class="friltered-price" type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" />
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default custom-post-panel">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="heading-stying collapsed">
                                                            <div class="panel-heading custom-heading">
                                                                Sort By
                                                            </div>
                                                        </a>
                                                        <div id="collapse2" class="panel-collapse collapse">
                                                            <div class="panel-body custom-panel-body">
                                                                <div class="dl-filter">
                                                                    <form>
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Default</label>
                                                                        </div>  
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Popularity</label>
                                                                        </div>  
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Average Rating</label>
                                                                        </div>  
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Newsness</label>
                                                                        </div>  
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Price: low to High</label>
                                                                        </div>  
                                                                        <div class="form-group post-filter-inputs">
                                                                            <label>Price: High to Low</label>
                                                                        </div>  
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="filter-footer">
                                                    <div><a href="#" >View All Locations On Map</a></div>
                                                    <div><a href="#"><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp;Clear All</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-drop-btn">
                                            <span style="font-size:14px;cursor:pointer" onclick="toogleNavpost()"><img src="{{ asset('sximo/assets/images/arrow-botom.gif')}}" alt=""/>Filter Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="book-now trigger-booking" href="#">Book your stay</a>
                            </div>
                        </div>
                    </div>

                    <div class="sticky-header-offset"></div>
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
                            if (document.getElementById("mySidenavpost").style.width == "342px") {
                                return closeNavpost();
                            }
                            return openNavpost();
                        }
                        function openNavpost() {
                            if ($(window).width() >= 768) {
                                document.getElementById("mySidenavpost").style.width = "342px";
                                document.getElementById("main").style.marginRight = "250px";
                            } else {
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
                                document.getElementById("mySidenavpost").style.width = "100%";
                                document.getElementById("main").style.marginRight = "250px";
                            }
                            setTimeout(function () {
                                if ($(window).width() >= 768) {
                                    document.getElementById("mySidenavpost").style.width = "0";
                                    document.getElementById("main").style.marginRight = "0";
                                    document.body.style.backgroundColor = "white";
                                    document.body.style.transition = "all 0.5s ease 0s";
                                }
                            }, 3000);

                        };

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
                    </script>