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
        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>
        
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
        <script src="{{ asset('sximo/assets/js/uikit.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slideshow.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
        <style>
            .video-bg {
                height: 100%;
                width: 100%;
            }
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
                    <header >
                        <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn"><i class="fa fa-lock " aria-hidden="true" ></i></a>
                        <div class="logo-padding-left editorial-logo-align">
                            <div>
                                <a href="#" title="Add to Favorites" class="book-button"><i class="fa fa-plus " aria-hidden="true" ></i> Add</a>		
                            </div>
                            <div class="go-back-button-container">
                                <button class="go-back-button">Go Back</button>
                            </div>
                        </div>
                        <div class="hotel-next-previous-outer">
                            <div class="previous-btn previous-next-pannel"> 
                                <img class="img-responsive next-hotel-arrow" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
                                <a href="<?php echo (isset($prev_category->category_title))? URL::to('product-grid-shuffle').'/'.$prev_category->id.'/'.$prev_category->category_title : ''; ?>">
                                    <div class="next-hotel-show-pannel">
                                        <!--<img class="img-responsive" src="http://design-locations.biz/uploads/container_user_files/locations/miss-clara-by-nobis/property-images/Miss-Clara-by-Nobis-Stockholm-Sweden%20(10).jpg" alt="">-->
                                        <div class="next-hotel-tittle">
                                            <h2><?php echo (isset($prev_category->category_title))? $prev_category->category_title : ''; ?></h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="hotel-next-previous-outer">
                            <div class="next-hotel-btn previous-next-pannel"> 
                                <img class="img-responsive next-hotel-arrow" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
                                <a href="<?php echo (isset($next_category->category_title))? URL::to('product-grid-shuffle').'/'.$next_category->id.'/'.$next_category->category_title : ''; ?>">
                                    <div class="next-hotel-show-pannel">
                                        <!--<img class="img-responsive" src="http://design-locations.biz/uploads/container_user_files/locations/miss-clara-by-nobis/property-images/Miss-Clara-by-Nobis-Stockholm-Sweden%20(5).jpg" alt="">-->
                                        <div class="next-hotel-tittle">
                                            <h2><?php echo (isset($next_category->category_title))? $next_category->category_title : ''; ?></h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </header>

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
                    $(document).ready(function () {
                        /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
                        var acc = document.getElementsByClassName("accordion");
                        var i;

                        for (i = 0; i < acc.length; i++) {
                            acc[i].onclick = function () {
                                this.classList.toggle("active");
                                this.nextElementSibling.classList.toggle("show");
                            }
                        }
                    });
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