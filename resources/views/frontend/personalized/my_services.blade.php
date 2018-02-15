@extends('frontend.layouts.ev.personalised-service')
@section('title', 'Personalized Service')
@section('css')
<link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/css/ai_persnolizes_responsive.css')}}" />
@stop
@section('content')

<!-- buttons -->
<div class="col-md-12">
    <div class="col-md-4 hidden-md hidden-lg col-xs-4 col-sm-4">
        <span class="hamburger-menu editorial-res-side-nav-logo hidden-md hidden-lg visible-xs visible-sm" onclick="openNav()"><img src="https://www.emporium-voyage.com/sximo/assets/images/Hamburger-Menu_1.png" alt=""></span>
    </div>
    <div class="col-md-4 col-xs-4 col-sm-4">
        <a data-popup-id="login-forms-popup" href="#" class="video-popup-btn login_popup show-login-forms-btn hidden-md hidden-lg"><i class="fa fa-lock detailfaLock" aria-hidden="true" ></i></a>
    </div>
    <div class="col-md-4 col-xs-4 col-sm-4">
        <a data-popup-id="ev-primary-navigation" href="#" class="video-popup-btn hidden-md hidden-lg"><!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
            <div class="block-content content">
                <span></span>
                <span> </span>
                <span></span>
            </div>
        </a>
    </div>
</div>
<!-- buttons -->

<!-- left menu responsive start -->

<!-- content -->
<div class="col-md-12 hidden-md hidden-lg visible-xs visible-sm">    
    <div id="editorial-siden-nav-res" class="sidenav hidden-md hidden-lg visible-xs visible-sm" style="width: 0px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div class=" right-menus ">
            <div class="row-">
                <!--                            <div class="hotels-logo">
                                                <h3 class="title"><a href="https://www.emporium-voyage.com">The Dwell Hotel</a><hr class="star-light"></h3>
                
                                            </div>-->
                <ul>
                    <!--                                <li>
                                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="https://www.emporium-voyage.com/search">
                                                            <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input class="bh-search-input typeahead search-navbar search-box tt-hint" style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" readonly="" autocomplete="off" spellcheck="false" tabindex="-1" dir="ltr" type="text"><input class="bh-search-input typeahead search-navbar search-box tt-input" name="s" id="search-navbar" placeholder="Search" autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;" type="text"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: Geomanist-Regular; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizelegibility; text-transform: uppercase;"></pre><div class="tt-menu" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;"><div class="tt-dataset tt-dataset-states"></div></div></span>
                                                        </form>
                                                    </li>-->

                    <li>
                        <a href="#hotel"> HOTEL MEMBERSHIPS </a>
                    </li>

                    <li>
                        <a href="https://www.emporium-voyage.com/Terms-and-Conditions" data-hotel-option="deisgn_architecture">TERMS AND CONDITIONS</a>
                    </li>


                    <li>
                        <a href="https://www.emporium-voyage.com/Impressum" data-hotel-option="restaurant_bar">IMPRINT</a>
                    </li>

                </ul>
                <!-- slick space -->
                <!-- slick space -->
            </div>
        </div>
        <section class="regular slider hidden-md hidden-lg visible-xs visible-sm">
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
                <a href="http://www.bocadolobo.com/en/landing-page/de-market/"><img src="https://www.emporium-voyage.com/uploads/users/advertisement/1.png"></a>
            </div>
        </section>
    </div>
    <!-- slick -->

    <!-- slick end -->
</div>

<!-- content -->

<!-- left menu responsive end -->

<!-- booking for bar top -->

<!-- booking for bar top -->

<div class="wrapper">
    <div class="container-fluid responsiveFluid">
        <div class="row">
            <!--                 <div class="header-logo-image">
                                 <img class="img-responsive" src="assets/images/logo-design_1_1.Pampering" alt=""/>
                             </div>
                             <div class="top-progress-bar">
                                 <div class="progress-bar-inner"></div>
                             </div>-->
            <!--                    <div class="top-nav-align">
                                    <ul class="booking-navigation-menues">
                                        <li class="active">Holiday Destination</li>
                                        <li>Travel Style</li>
                                        <li>Details</li>
                                        <li>Contact Details</li>
                                    </ul>
                                </div>-->
     
            <!--Page content start here-->
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>Adults</th>
                                <th>Youth</th>
                                <th>Children</th>
                                <th>Toddlers</th>
                                <th>Earliest Arrival</th>
                                <th>Late Check Out</th>
                                <th>Stay Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($services)) {
                                foreach ($services as $service) {
                                    echo '<tr>
                                            <td>'.$service['adults'].'</td>
                                            <td>'.$service['youth'].'</td>
                                            <td>'.$service['children'].'</td>
                                            <td>'.$service['toddlers'].'</td>
                                            <td>'.$service['earliest_arrival'].'</td>
                                            <td>'.$service['late_check_out'].'</td>
                                            <td>'.$service['stay_time'].'</td>
                                            <td>
                                                <a href="" class="tips btn btn-xs btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="" class="tips btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>';
                                }
                            }
                            else {
                                echo '<tr><td colspan="8">No results found</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Page content end here-->
            
        </div>
    </div>
</div>
@stop
@section('script')

<script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- toggle responsive top bar-->
<script>
    $(".TopbarSearch").click(function () {
        $(".ResponsiveTopbar").toggle();
    });
</script>
<!-- toggle responsive top bar end-->

<!-- responsive left menu toggle -->
<script>
    function openNav() {
        document.getElementById("editorial-siden-nav-res").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("editorial-siden-nav-res").style.width = "0";
    }
</script>
<!-- responsive left menu toggle end -->
@stop