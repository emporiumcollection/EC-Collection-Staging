<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>403</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/404.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header >
                        <div class="container-fluid logo-padding-left editorial-logo-align ">
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
                                        <a href="{{URL::to('luxurytravel/Hotel')}}">HOTELS</a>
                                    </li>
                                    <li>
                                        <a href="#">EXPERIENCE</a>
                                    </li>
                                    <li>
                                        <a href="#">MAGAZINE</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('luxurytravel/Villas')}}">VILLAS</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('luxurytravel/Yachts')}}">YACHTS</a>
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
                    <!--404 page start here-->
                    <div class="not-found-page-main-bg-align">
                        <div class="container">
                            <div class="not-found-page-sec-align">
                                <div class="page-not-found-tittles">
                                    <h2>4<span><i class="fa fa-frown-o" aria-hidden="true"></i></span>3</h2>
                                    <p>you do not have permission to view this page!</p>
                                </div>
                                <div class="newsletter-and-book-hotel-outer-align">
                                    <div class="col-md-6 col-sm-6 newsletter-side-sec-align">
                                        <div class="subscribe-to-newsletter">
                                            <p>Sign up to our newsletter to get the latest news</p>
                                            <form>
                                                <input type="text" class="not-found-page-newsletter-style" placeholder="Subscribe Here To Get Update....">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="page-not-found-book-hotel-sec">
                                            <p class="book-hotel-or-text">OR</p>
                                            <p class="book-hotel-des-line">Were You Looking For a Hotel?<span> <a href="#page-not-found-book-form" class="try-another-hotel-link">Try to book another one:</a></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--404 page end here-->
                    <div class="clearfix"></div>
                    <!--Book Now page-->
                    <div id="page-not-found-book-form" class="editorial-book-now-page book-page-404">

                        <div class="book-now-page-content-">
                            <div class="editoral-book-page-headings">
                                <h2>Book now & get our best rate!</h2>
                                <p>Exclusively for our hotel guests: Experience the 7132 Thermal Bath by night on Wednesday, Friday & Sunday</p>
                            </div>
                            <ul class="dates" id="editorial-book-now-inputs">
                                <li>
                                    <div class="editorail-heading">Arrive</div>
                                    <input id="date-range-editorial-arrive" class="datePicker- dateFrom-" value="01 Jan 2016" type="text" />
                                </li>
                                <li>
                                    <div class="heading">Departure</div>
                                    <input id="date-range-editorial-destination" class="datePicker- dateFrom-" value="01 Jan 2016" type="text" />
                                </li>
                            </ul>
                            <ul class="dates">
                                <li>
                                    <div class="heading">Adults</div>
                                    <select >
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
                            <div class="editorial-submit-btn">
                                <a href="#">BOOK NOW</a>
                            </div>
                            <div class="view-modify-cancel-booking">
                                <a href="#">View, Modify or Cancel your Booking</a>
                            </div>
                            <ul class="booking-page-footer-section editorial-book-align" >
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
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $("header .menu > a").click(function (event) {
                    event.preventDefault();
                    $(this).parent().find("ul").toggle("slow");
                });
            });
        </script>
        <script>
            $(document).on('click', '.try-another-hotel-link', function (event) {
                event.preventDefault();

                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).position().top
                }, 1000);
            });
        </script>
        <script>
            $('#editorial-book-now-inputs').dateRangePicker(
                    {
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
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
                            $('#date-range-editorial-arrive').val(s1);
                            $('#date-range-editorial-destination').val(s2);
                        }
                    }
            ).bind('datepicker-first-date-selected', function (event, obj) {
                $("#date-range-editorial-destination").val('');
            });
        </script>
        @include('layouts/elliot/ai_booking-page_404')
    </body>
</html>