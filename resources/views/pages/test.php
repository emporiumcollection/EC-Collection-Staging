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
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m_slider.css')}}" rel="stylesheet" type="text/css"/>
        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <header >
                    <div class="container-fluid logo-padding-left editorial-logo-align">
                        <div class="col-md-12-">
                            <p><a class="logo-d" href="{{url()}}">D</a></p>
                        </div>
                        <div class="col-md-12-">
                            <h2 class="menu-text-align">Editorial</h2>
                        </div>
                        <div class="col-md-12- menu">
                            <a href="#"><img class="menu-button" src="{{ asset('sximo/assets/images/menu.png')}}" alt=""/></a>
                            <ul style="display: none;">
                                <li>
                                    <a href="{{url()}}/home">Get Inspired</a>
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
                <!--Slider start here-->
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                    <div class="m_slider">
                        <ul>
                            <li class="active">
                                <div class="image editorial-image">
                                    <img src="{{ asset('sximo/assets/images/editorial-banner.png')}}" alt=""/>
                                </div> 


                                <div class="editorial-text">
                                    <div class="editor-picks-small-text">EDITOR'S PICKS</div>
                                    <div class="description-bold-text">Beller's Equal seating personifies minimalism - 1</div>
                                    <div class="banner-text-border-bottom"></div>
                                    <div><a href="#" class="banner-border-bottom-text">Explore the hotel</a></div>
                                    <!--end slide -->
                                </div>
                            </li>
                            <li class="">
                                <div class="image editorial-image">
                                    <img src="{{ asset('sximo/assets/images/editorial-banner.png')}}" alt=""/>
                                </div>


                                <div class="editorial-text">
                                    <div class="editor-picks-small-text">EDITOR'S PICKS</div>
                                    <div class="description-bold-text">Beller's Equal seating personifies minimalism - 2</div>
                                    <div class="banner-text-border-bottom"></div>
                                    <div><a href="#" class="banner-border-bottom-text">Explore the hotel</a></div>
                                    <!--end slide -->

                                </div>



                            </li>
                        </ul>
                        <div class="editorial-arrows-container arrows-container">
                            <a class="editorial-previous-arrow previous-arrow" href="#">
                                <img class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
                            </a>
                            <a class="editorial-next-arrow next-arrow" href="#">
                                <img  class="banner-arrow-bg" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
                            </a>
                            <div><a href="#align-to-top"><img src="{{ asset('sximo/assets/images/arrow1.gif')}}" class="down-arrow-align animate-arrow" alt=""/> </a>
                            </div>
                        </div>
                    </div>
                    <!--Slider end here-->
                    <div class="" id="align-to-top">
                        <div class="banner-below-section-bg">
                            <div class="container">
                                <img class="architecture-sec-top-img" src="{{ asset('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>
                            </div>
                            <div class="col-md-12 ">
                                <div class=" bottom-sec-bg container">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="small-box-bg">
                                            <div>
                                                <p class="small-box-text">
                                                    They know the price of everything and value of nothing.
                                                </p> 
                                            </div>
                                            <div><img class="arcgitecture-sec-testinomilas-align" src="{{ asset('sximo/assets/images/comma.png')}}" alt=""/></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <div class="architecture-sec-heading">
                                            <h1>Architecture & Design</h1>
                                            <p>
                                                The Grisons architect Peter Zumthor didn’t just the thermal baths - he
                                                created a masterpiece out of 60,000 quartzite slabs. A homepage to
                                                Vals and the archive natural setting of the 7132 Hotel.
                                                An architectural milestone that was classified as a listed building shortly after, 
                                                the thermal baths attract those in search of relaxation as well as architecture enthusiasts
                                                from all over the world.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--next sec-->
                    <div class="container h-sec-responsive-bg width-auto">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-2 col-sm-2">

                            </div>
                            <div class="col-md-10 col-sm-10">
                                <div class="every-good-sec-bg">
                                    <div class="col-md-2 col-sm-2">
                                        <div class="h-sec-side-line-align">
                                            <div>EVERY GOOD</div>
                                            <div>ARTIST PAINTS</div>
                                            <div>WHAT HE IS</div>
                                            <div class="h-sec-title-border-bottom"></div>
                                        </div>
                                        <div class="h-sec-below-text">
                                            <div>
                                                <span class="text-color">To succeed</span> in your mission, you must have single-minded devoation
                                                to your goal.
                                            </div>
                                            <div class="written-by-text">
                                                -Le corbusier
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <img class="h-image-align img-responsive" src="{{ asset('sximo/assets/images/h.png')}}" alt=""/>
                                    </div>
                                    <div class="col-md-4 col-sm-4 h-side-text h-sec-margin-top">
                                        <p>
                                            Hey Tony! I like things you to do! Hey Tony! if I could I would be
                                            you! You're my one and only tiger, with my one and only taste!
                                            You know how to take a breakfast and make it mmm great! Frosted
                                            Flakes! They're more than good, they're great!
                                        </p>
                                        <p> 
                                            We've got a gorilla for sale. Magilla Gorilla for sale.
                                            Won't you buy him. take him and try him, gorilla you can 
                                            call your own, a gorilla who'll be with ya when you're all
                                            alone? How much is that gorilla in the window? 
                                            Take our advice, at any price, a goilla like Magilla is
                                            mighty nice. Gorilla, Magilla Gorilla for sale.
                                        </p> 
                                        <p>Mister Trouble never hangs around when he hearts this
                                            mighty sound: "Here I come to save the day!" That
                                            means that Mighty Mouse is on his
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Next-section-->
                    <div class="spa-sec-bg">
                        <div class="container spa-sec-margin-bottom width-auto">
                            <div class="col-md-12">
                                <div class="col-md-5">
                                    <div>
                                        <img class="spa-first-sec-img-align img-responsive" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS.png')}}" alt=""/>
                                    </div>
                                    <div class="spa-side-description-bg">
                                        <h1>SPA & WELLNESS</h1>
                                        <p>Personal style is constructed by all of the stories that make us who we are.</p>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="col-md-6 col-sm-6">
                                            <a href="#" class="spa-sec-book-an-appoinment-btn">Book an Spa appointment > </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p class="spa-first-side-btn-text">We make user interface better than Barack Obama. 
                                                To succeed in your mission, you must have dedication to your
                                            </p>
                                            <div class="spa-first-sec-sign">Jhon Colin</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <img class="spa-and-wellness-side-sec-img-align img-responsive" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS-2.png')}}" alt=""/>
                                    <div class="col-md-8 col-sm-8">
                                        <img class="spa-manager-image-align img-responsive" src="{{ asset('sximo/assets/images/Spa-Manager.png')}}" alt=""/>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="spa-manager-title-text">Our Products are from the House, Clarin's Our entire range includes......</p>
                                        <div class="spa-manager-sign" >Spa Manager</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <!--Next Section-->
                    <div class="container width-auto">
                        <div class="image-slider-container image-slider-margin-align auto-slider">
                            <ul class="image-slider">
                                <li class="active">
                                    <a href="#">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/SUPERIOR-ROOM.png')}}" alt=""/>
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
                                                            <div class="expeience-small-text">Experience</div>
                                                            <div class="slider-side-text-tittle">SUPERIOR</div>
                                                            <div class="slider-side-text-tittle">ROOMS</div>
                                                            <div class="slider-side-description-text">
                                                                It's exactly what I've been looking for. It's 
                                                                exactly ehat I've been liiking for. I made 
                                                                back the it's exactly ehat I've been looking for.
                                                                I made back the it's exactly ehat I've been looking for.
                                                                I made back the
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <img class="slider-next-image-btn img-responsive" src="{{ asset('sximo/assets/images/BUTTON-BG.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <a href="#">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/SUPERIOR-ROOM.png')}}" alt=""/>
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
                                                            <div class="expeience-small-text">Experience</div>
                                                            <div class="slider-side-text-tittle">SUPERIOR</div>
                                                            <div class="slider-side-text-tittle">ROOMS 2</div>
                                                            <div class="slider-side-description-text">
                                                                It's exactly what I've been looking for. It's 
                                                                exactly ehat I've been liiking for. I made 
                                                                back the it's exactly ehat I've been looking for.
                                                                I made back the it's exactly ehat I've been looking for.
                                                                I made back the
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <img class="slider-next-image-btn img-responsive" src="{{ asset('sximo/assets/images/BUTTON-BG.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="">
                                    <a href="#">
                                        <img class="img-responsive" src="{{ asset('sximo/assets/images/SUPERIOR-ROOM.png')}}" alt=""/>
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
                                                            <div class="expeience-small-text">Experience</div>
                                                            <div class="slider-side-text-tittle">SUPERIOR</div>
                                                            <div class="slider-side-text-tittle">ROOMS 3</div>
                                                            <div class="slider-side-description-text">
                                                                It's exactly what I've been looking for. It's 
                                                                exactly ehat I've been liiking for. I made 
                                                                back the it's exactly ehat I've been looking for.
                                                                I made back the it's exactly ehat I've been looking for.
                                                                I made back the
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <img class="slider-next-image-btn img-responsive" src="{{ asset('sximo/assets/images/BUTTON-BG.png')}}" alt=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class=" editorial-images-count images-count">1 / 3</div>
                            <div class="editorial-image-slider-btns image-slider-btns">
                                <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
                                    <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt=""/>
                                </a>
                                <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
                                    <img src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt=""/>
                                </a>
                            </div> 
                        </div>
                    </div>
                    <!--Next Section-->
                    <div class="video-section-bg width-auto">
                        <div class="container width-auto">
                            <div class="video-sec-background-image">
                                <a href="#"> <img class="video-play-icon" src="{{ asset('sximo/assets/images/PLAY-ICON.png')}}" alt=""/></a>
                                <div class="video-below-text-margin-align">
                                    <div class="video-sec-small-text">
                                        Get Inspired 
                                    </div>
                                    <div class="video-sec-description-text">
                                        There is no age defined for creativity. You look more beautiful and young doing 
                                        your work that you love consistently....<span class="video-sedcription-text-color">Stay creative, 
                                            Stay young</span>
                                    </div>
                                    <div class="video-sec-bottom-text">
                                        We make user interface better than Barack Obama. See few testimonials from our <a href="#" class="happy-customers-btn">Happy Customers</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--Book Now page-->
                    <div class="editorial-book-now-page width-auto">

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
                    <div class="hotel-property-section-bg width-auto">
                        <!--Featured hotel popup start-->
                        <div class="container width-auto">
                            <div id="featured-hotel-popup" class="">
                                <div class="popup-inner">
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
                        </div>
                    </div>
                    <!--Featured hotel popup end-->
                    <script>
                        jQuery(function () {
                            jQuery('a').click(function () {
                                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                                    var target = jQuery(this.hash);
                                    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                                    if (target.length) {
                                        jQuery('html, body').animate({
                                            scrollTop: (target.offset().top)
                                        }, 1000);
                                        return false;
                                    }
                                }
                            });
                        });
                    </script>
                    <div class="editorial-custom-footer-style">
                       @include('layouts/elliot/ai_footer_social')
                    </div>
                    </div>
                </div>
                    