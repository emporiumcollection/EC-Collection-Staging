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
        <link href="{{ asset('sximo/assets/css/property.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-room.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/mobile-room.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-slide-nav.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/landing-page-accordian-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <!--JS Includes-->
        <link href="http://design-locations.biz/sximo/assets/css/ai_yachts-custom.css" rel="stylesheet" type="text/css"/>

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/editorial-slide-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.dotdotdot.min.js')}}" type="text/javascript"></script>

        <!-- video js player -->
        <link href="{{ asset('sximo/videojsplayer/video-js.css')}}" rel="stylesheet">
        <script src="{{ asset('sximo/videojsplayer/ie8/videojs-ie8.min.js')}}"></script>
        <script src="{{ asset('sximo/videojsplayer/video.js')}}"></script>
        <style>
            .detail-tile-inner img { max-width:100%; }
            .gallerysty { font-weight: bold;font-size: 15px;color: #000; }
            .hotel-name-first-letter { background-image: url({{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image)}}); }
            .editorial-book-now-page { background-image: url('{{$propertyDetail['propimage'][0]->imgsrc.$propertyDetail['propimage'][0]->file_name}}');  }
            .hotels-showcase-right-side { background-image: url('{{$propertyDetail['propimage'][0]->imgsrc.$propertyDetail['propimage'][0]->file_name}}'); }
            .hotel-sec-block-two { background-image: url('{{$propertyDetail['propimage'][1]->imgsrc.$propertyDetail['propimage'][1]->file_name}}'); }

            .hotels-detail-description-text > p { max-height:300px; }
            .hotel-block-two-right-sec-align > h2{
                color: #dbd4d7;
                font-family: ACaslonPro-Regular;
                font-size: 40px;
                font-weight: lighter;
                margin-top: 0;
                text-transform: uppercase;
                opacity:0;
            }
            .hotel-block-two-right-sec-align > p { margin-top:0px; }
        </style>
    </head>
    <body class="editorial-hotel-detail-page">
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
                <div id="editorial-siden-nav-res" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class=" right-menus ">
                        <div class="row-">
                            <div class="hotels-logo">
                                <a href="{{url('')}}"><img alt="" src="http://design-locations.biz/sximo/assets/images/design-location-logo.png" class="img-responsive"></a>
                            </div>
                            <ul>
                                <li>
                                    <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                        <input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar" placeholder="Search" type="text">
                                    </form>
                                </li>

                                @if (array_key_exists('typedata', $propertyDetail))
                                <li>
                                    <a href="#hotel">@if($propertyDetail['data']->property_type=='Yachts') YACHT @elseif($propertyDetail['data']->property_type=='Villas') VILLA @else HOTEL @endif</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                                <li>
                                    <a href="#deisgnarchitecture">DESIGN &amp; ARCHITECTURE</a>
                                </li>
                                @endif

                                @if (array_key_exists('typedata', $propertyDetail))
                                <li>
                                    <a href="#rooms">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS & SUITES' }}</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                                <li>
                                    <a href="#spa_restaurant">RESTAURANT</a>
                                </li>
                                @endif

                                @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                                <li>
                                    <a href="#spa">SPA</a>
                                </li>
                                @endif

                                <li>
                                    <a href="#book-now">BOOK @if($propertyDetail['data']->property_type=='Yachts') YACHT @elseif($propertyDetail['data']->property_type=='Villas') VILLA @else HOTEL @endif</a>
                                </li>
                                <li>
                                    <a href="#">PACKAGES</a>
                                </li>
                            </ul>
                            @if(!empty($relatedproperties))
                            <div class="side-nav-next-hotel-img">
                                <div class="side-next-and-perivious-hotel-arrow">
                                    <div class="arrows-commom  next-arrow">
                                        <a href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                            <span>New Hotels</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="new-hotel-image" style="background-image: url('{{$relatedproperties[0]['image']->imgsrc.$relatedproperties[0]['image']->file_name}}')">
                                    <div class="new-hotels-image-tittle">
                                        <h2 class="new-hotel-name">{{$relatedproperties[0]['rpdata']->property_name}}</h2>
                                        <div class=" new-hotel-add">
                                            <p>New York City</p>
                                            <p>United States</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="new-hotel-view-more-btn">
                                        <a class="" href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                            View Hotel
                                        </a>
                                    </div>
                                </div>
                                <!--<img class="img-responsive" src="{{$relatedproperties[0]['image']->imgsrc.$relatedproperties[0]['image']->file_name}}" alt="">-->
                                <a class="bootom-view-next-btn" href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                    Visit All Hotels DOI
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <span class="hamburger-menu editorial-res-side-nav-logo"  onclick="openNav()"><img src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                <div class="clerafix"></div>
                <div class="editorial-page-booking-bar">
                    <section class="book-form-top-bar">
                        <div>
                            <div class="to-booking-nav-show-hide-btn">
                                <img src="{{ asset('sximo/assets/images/arrow.png')}}" alt=""/>
                            </div>
                            <form>
                                <div class="booking-form-bar-top">
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group would-like-input padding-right-12">
                                                <label>I would like to</label>
                                                <select class="form-control ai-custom-deafault-style">
                                                    <option disabled selected>Book a Room</option>
                                                    <option>Book a Spa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label>at</label>
                                                <select class="form-control ai-custom-deafault-style">
                                                    <option>Miss Clara By Nobis</option>
                                                    <option>Hotel Gerif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="row">
                                            <div id="top-bar-booking-form">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <label class="align-with-label"></label>
                                                            <input id="top-bar-booking-form-arrive" class="form-control ai-custom-deafault-style" type="text" placeholder="Arriving">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group padding-right-12">
                                                            <label class="align-with-label"></label>
                                                            <input id="top-bar-booking-form-destination" class="form-control ai-custom-deafault-style" type="text" placeholder="Departing">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label class="align-with-label"></label>
                                                <select class="form-control ai-custom-deafault-style">
                                                    <option disabled="" selected>Rooms</option>
                                                    <option>One Bedroom Suite</option>
                                                    <option>Courtyard Suite</option>
                                                    <option>Deluxe Two Bedroom Suite</option>
                                                    <option>Copper Suite</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <div class="row">
                                            <div class="form-group padding-right-12">
                                                <label class="align-with-label"></label>
                                                <div class="clearfix"></div>
                                                <button class="top-booking-bar-btn" type="submit">Book</button>
                                                <button class="top-booking-bar-btn">Share</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="dropdown yacht-specifications-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Specifications<span class="caret yacts-specification-drop-arrow"></span></a>
                                        <div class="dropdown-menu yacht-specifications-dropdown-menu-list">
                                            <table class="table table-responsive">
                                                <tbody>
                                                    <tr>
                                                        <td>Year Of build:</td>
                                                        <td>2005</td>
                                                    </tr>
                                                    <tr>
                                                        <td>guests</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Length</td>
                                                        <td>200 ft.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cabins</td>
                                                        <td>6</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Crew</td>
                                                        <td>12</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!--Slider start here-->
                @if(!empty($propertyDetail)) 
                <div class="row">
                    @if (array_key_exists('propimage', $propertyDetail))
                    <div class="m_slider editorial_m_slider">
                        @if(!empty($propertyDetail['propimage']))
                        <ul>
                            @foreach($propertyDetail['propimage'] as $propimg)
                            {{--*/ $thactualsize = getimagesize($propimg->imgsrccon.$propimg->file_name); /*--}}
                            @if($thactualsize[0]>$thactualsize[1])
                            <li class="{{($propertyDetail['propimage'][0]==$propimg) ? 'active' : ''}}">
                                <div class="image editorial-image">
                                    <img src="{{ $propimg->imgsrc.$propimg->file_name }}" alt=""/>
                                </div>

                                <div class="editorial-text">
                                    <div class="editor-picks-small-text">{{$propertyDetail['data']->property_name}}</div>
                                    <div class="description-bold-text">{{ $propertyDetail['data']->property_usp }}</div>
                                    <!--end slide -->
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif

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
                    @endif
                    <!---Show Moare---->

                    <!--Slider end here-->
                    <div class="main-side" id="align-to-top">

                        <!--Hotel Section Block Two-->
                        <div id="hotel" class="hotel-sec-block-two">
                            <div class="container">
                                <div class="row">
                                    <div class="disply-left-right-align">
                                        <div class="col-md-6 disply-left-right-inner">
                                            <div class="hotel-block-two-left-sec-align">
                                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                                                <p>
                                                    {{$propertyDetail['data']->detail_section1_description_box1}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 disply-left-right-inner">
                                            <div class="hotel-block-two-right-sec-align">
                                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                                                <p>
                                                    {{$propertyDetail['data']->detail_section1_description_box2}}
                                                </p>
                                                <div class="hotel-block-two-btn-right">
                                                    <a href="#style-rooms"  rel="" class="hotel-btn">View Rooms</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hotel Section Block Two End Here-->
                        <!--Hotels Section-->
                        <div id="dl_hotel_sec" class="dl_hotel-sec-bg">
                            <div class="">
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 col-sm-12 disply-left-right-align">
                                        <div class="col-md-6 col-sm-6 disply-left-right-inner hotels-des-left-side">
                                            <div class="hotels-detail-heading-text">
                                                <p>{{$propertyDetail['data']->detail_section2_title}}</p>
                                            </div>
                                            <div class="hotels-detail-description-text">
                                                <p class="hotel-description-text">
                                                    {{$propertyDetail['data']->detail_section2_description_box1}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 disply-left-right-inner hotels-showcase-right-side">
                                            <div class="hotels-image-showcase-des-text">
                                                <p class="hotel-description-text">
                                                    {{$propertyDetail['data']->detail_section2_description_box2}}
                                                    <br>
<!--                                                        <span class="pull-right">Situated in Norrmalm</span>-->
                                                </p>
                                            </div>
                                            <div class="hotel-block-two-btn-right">
                                                <a href="#"  rel="" class="hotel-btn open-show_more-page">View More</a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="image-showcase-below-big-text">
                                                {{$propertyDetail['data']->assign_detail_city}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Hotels Section End-->
                        <!--Next Section-->
                        @if (array_key_exists('typedata', $propertyDetail))
                        <div class="row- pub-page-sec-2" id="hotel">
                            <section id="interna" class="container-fluid">

                            </section>


                            <section id="style-rooms" class="container-fluid">
                                <div class="row gallery">
                                    <!--                                    <div class="col-md-6">
                                                                                                                                                                                                    <div class="bianco logo">
                                                                                                                                                                                                        <a href="#" class="animate-link"><img type="image/svg+xml" src="http://design-locations.biz/sximo/assets/images/logo-design_1.png" alt="Hotel"></a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <div class="col-md-3 col-sm-0">
                                                                                                                                                                                                    <div style="height: 370.688px; opacity: 1; width: 100%;" class="rosa">
                                    <div class="scritta"><span style="top: 0px;">Hotel</span></div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <div class="col-md-3 col-sm-0">
                                                                                                                                                                                                    <div style="height: 370.688px; width: 100%;" class="nero"></div>
                                                                                                                                                                                    </div>-->
                                </div>
                                @foreach($propertyDetail['typedata'] as $type)
                                @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                {{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]); $divd2 = round($totimg/2); /*--}}
                                <div class="row gallery">
                                    <div class="col-md-6 col-sm-6">
                                        <div style="height: 370.688px; opacity: 1; width: 100%;" class="principale1 prc">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)

                                            <div style="height: 370.688px; width: 100%;" class="foto1 clio1" rel="clio" data-image="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}">
                                                <img style="height: 370.688px; width: 659px;" src="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}" rel="1" alt="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}">
                                            </div>
                                            @endfor
                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                            <div style="height: 370.688px;" class="foto2 clio2 " rel="clio" data-image="{{$propertyDetail['roomimgs'][$type->id][$rimg2]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg2]->file_name}}">
                                                <img style="height: 370.688px;" src="{{$propertyDetail['roomimgs'][$type->id][$rimg2]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg2]->file_name}}" rel="2" alt="{{$propertyDetail['roomimgs'][$type->id][$rimg2]->file_name}}">
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <div style="height: 390.688px; opacity: 1; width: 100%;" class="rosa">
                                            <div class="info1">
                                                <h2><span style="top: 0px;">{{$type->category_name}}</span></h2>
                                                <p>
                                                    {{(strlen($type->room_desc) > 100) ? substr($type->room_desc,0,100).'...':$type->room_desc}}
                                                </p>
                                                <div class="hotel-detail-slider-price-and-show-more">
                                                    <a href="#" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
                                                    @if($type->price!='')
                                                    <div class="hotel-slider-price">
                                                        {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="viewmore">
                                                    <div class="arrow-slider">
                                                        <div class="left">
                                                            <img style="right: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_left.svg')}}" class="freccetta_left" alt="Annie Collection">
                                                            <img style="right: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_left.svg')}}" class="cerchio_left" alt="Annie Collection">
                                                        </div>
                                                        <div class="right">
                                                            <img style="left: 0px; visibility: inherit; opacity: 1;" type="image/svg+xml" src="{{ asset('sximo/assets/images/freccetta_right.svg')}}" class="freccetta_right" alt="Annie Collection">
                                                            <img style="left: 0px; visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, 0, 0);" type="image/svg+xml" src="{{ asset('sximo/assets/images/cerchio_right.svg')}}" class="cerchio_right" alt="Annie Collection">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 editorial-room-slider-mobile-res">
                                        <div style="height: 370.688px; width: 100%;" class="nero"></div>
                                        <div style="height: 370.688px; opacity: 1; width: 100%;" class="secondaria1 sec next">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)

                                            <div style="height: 370.688px;" class="foto2 clio3" rel="clio" data-image="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}">
                                                <img style="height: 370.688px; width: 659px;" src="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}" rel="3" alt="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}">
                                            </div>
                                            @endfor
                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                            <div style="height: 370.688px; width: 100%;" class="foto1 clio4" rel="clio" data-image="{{$propertyDetail['roomimgs'][$type->id][$rimg2]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg2]->file_name}}">
                                                <img style="height: 370.688px;" src="{{$propertyDetail['roomimgs'][$type->id][$rimg2]->imgsrc.$propertyDetail['roomimgs'][$type->id][$rimg2]->file_name}}" rel="4" alt="{{$propertyDetail['roomimgs'][$type->id][$rimg1]->file_name}}">
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        @endif
                        <!--Next Section-->

                        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                        <div class="">
                            <div class="banner-below-section-bg" id="deisgnarchitecture">
                                <div class="container">
                                    @if($propertyDetail['data']->architecture_image!='')
                                    <img class="architecture-sec-top-img" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image)}}" alt=""/>
                                    @else
                                    <img class="architecture-sec-top-img" src="{{ asset('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>
                                    @endif
                                </div>
                                <div class="col-md-12 ">
                                    <div class=" bottom-sec-bg container">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="small-box-bg">
                                                <div>
                                                    <p class="small-box-text">
                                                        {{$propertyDetail['data']->architecture_title}}
                                                    </p> 
                                                </div>
                                                <div><img class="arcgitecture-sec-testinomilas-align" src="{{ asset('sximo/assets/images/comma.png')}}" alt=""/></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <div class="architecture-sec-heading">
                                                <h1>Architecture & Design</h1>
                                                <p>
                                                    {{$propertyDetail['data']->architecture_desciription}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
						
                        @if (array_key_exists('typedata', $propertyDetail))
                        <div class="container">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
                                <ul class="image-slider">
                                    {{--*/ $k=1; $tottyp = count($propertyDetail['roomimgs']); /*--}}
                                    @foreach($propertyDetail['typedata'] as $key=>$type)
                                    @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                    {{--*/ $nextkey = false; $totimg = count($propertyDetail['roomimgs'][$type->id]); /*--}}
                                    @if($k==1) {{--*/ $ftky = $type->id; $ftkey = $key; /*--}} @endif

                                    @if(end($propertyDetail['typedata'])!=$type)
                                    {{--*/ $nxtkey = $propertyDetail['typedata'][$key+1]->id; /*--}}
                                    @for($nk=2;$nextkey!=true;$nk++)
                                    @if (array_key_exists($nxtkey, $propertyDetail['roomimgs']))
                                    {{--*/ $nxtkey = $nxtkey; $nextkey=true; /*--}}
                                    @else
                                    {{--*/ $nxtkey = $propertyDetail['typedata'][$key+$nk]->id; /*--}}
                                    @endif
                                    @endfor
                                    @endif

                                    <li class="{{($propertyDetail['typedata'][$ftkey]==$type) ? 'active' : ''}}">
                                        <a href="#">
                                            <img class="img-responsive" src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id][0]->imgsrc.$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id][0]->file_name}}" alt="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id][0]->file_name}}" style="height:580px; width: 100%;">
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
                                                                <div class="expeience-small-text">Experience {{$propertyDetail['data']->property_name}}</div>
                                                                <div class="slider-side-text-tittle">{{$type->category_name}}</div>
                                                                <div class="slider-side-description-text">
                                                                    {{(strlen($type->room_desc) > 300) ? substr($type->room_desc,0,300).'...':$type->room_desc}}
                                                                </div>
                                                            </div>
                                                            <div>
                                                                @if(end($propertyDetail['typedata'])==$type)
                                                                <img class="slider-next-image-btn img-responsive" src="{{$propertyDetail['roomimgs'][$ftky][0]->imgsrc.$propertyDetail['roomimgs'][$ftky][0]->file_name}}" alt=""/>
                                                                @else
                                                                <img class="slider-next-image-btn img-responsive" src="{{$propertyDetail['roomimgs'][$nxtkey][0]->imgsrc.$propertyDetail['roomimgs'][$nxtkey][0]->file_name}}" alt=""/>
                                                                @endif
                                                                <a href="#" style="margin-left:100px;" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    {{--*/ $k++; /*--}}
                                    @endif
                                    @endforeach
                                </ul>
                                <div class="clearfix"></div>
                                <div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
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
                        @endif

                        <div class="clearfix"></div>
                        <!--next sec-->
                        @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                        <div class="restaurent-sec-align sec-differentiate-line">
                            <div class="container h-sec-responsive-bg">
                                <div class="col-md-12 col-sm-12" id="spa_restaurant">
                                    <div class="col-md-2 col-sm-2">

                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="every-good-sec-bg">
                                            <div class="col-md-2 col-sm-2">
                                                <div class="h-sec-side-line-align">
                                                    <div>{{$propertyDetail['data']->restaurant_title}}</div>
                                                    <div class="h-sec-title-border-bottom"></div>
                                                </div>
                                                <div class="h-sec-below-text">
                                                    <div>
                                                        {{$propertyDetail['data']->restaurant_usp_text}}
                                                    </div>
                                                    <div class="written-by-text">
                                                        -{{$propertyDetail['data']->restaurant_usp_person}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5 hotel-text-main-align">
                                                <h1 class="hotel-name-text-align"><span class="hotel-name-first-letter">{{substr($propertyDetail['data']->property_name, 0, 1)}}</span></h1>
                                                <!--                                            @if($propertyDetail['data']->restaurant_image!='')
                                                                                            <img class="architecture-sec-top-img" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->restaurant_image)}}" alt=""/>
                                                                                            @else
                                                                                            <img class="h-image-align img-responsive" src="{{ asset('sximo/assets/images/h.png')}}" alt=""/>
                                                                                            @endif-->

                                            </div>
                                            <div class="col-md-4 col-sm-4 h-side-text h-sec-margin-top">
                                                <p>
                                                    {{(strlen($propertyDetail['data']->restaurant_desciription) > 450) ? substr($propertyDetail['data']->restaurant_desciription,0,450).'...':$propertyDetail['data']->restaurant_desciription}}
                                                </p>
                                                @if(!empty($resgalleryArr))
                                                <p><a href="#" class="detail_view gallerysty" rel="{{$propertyDetail['data']->id}}" rel2="Restrurants Gallery Images"><i class="fa fa-file-image-o"></i> View Gallery</a></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                        <div id="restaurant-sec" class="restaurant-sec-main-bg-align">
                                <div class="container">
                                    <div class="restaurant-sec-pannel-main-align">
                                        <div class="ai_restaurant-name">
                                            <h2>{{$propertyDetail['data']->restaurant_title}}</h2>
                                            <span class="restaurant-sec-hotel-name-below-small-text">Get Inspired</span>
                                        </div>
                                        <div class="restaurant-sec-description-pannel1">
                                            <p>{{$propertyDetail['data']->restaurant_usp_text}}</p>
                                            <p class="restaurant-orange-creative-text-align"><span class="restaorant-des-orange-text">-{{$propertyDetail['data']->restaurant_usp_person}}</span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="restaurant-des-pannel-image1">
                                            <img class="img-responsive img-width" src="{{ $propimg->imgsrc.$propimg->file_name }}" alt=""/>  
                                        </div>
                                        <div class="clearfix"></div>
                                        <div  class="restaurant-sec-main-align">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="row">
                                                    <div class="restaurant-sec-description-pannel2">
                                                        <p class="restaurtant-bar-des-para-style">{{(strlen($propertyDetail['data']->restaurant_desciription) > 450) ? substr($propertyDetail['data']->restaurant_desciription,0,450).'...':$propertyDetail['data']->restaurant_desciription}}</p>
                                                        <div class="restaurant-owner-sign">Jhon Paul</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <div class="row restaurant-image-height-align">
                                                    <div class="restaurant-des-pannel-image2 restaurant-image-height-align">
                                                        <img class="img-responsive img-width" src="{{$propertyDetail['roomimgs'][$ftky][0]->imgsrc.$propertyDetail['roomimgs'][$ftky][0]->file_name}}" alt=""/> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="row">
                                                    <div class="restaurant-view-gallery-align">
                                                        <span class="view-gallery-border-left"></span>
                                                        <a href="#" class="detail_view gallerysty bar-view-gallery" rel="{{$propertyDetail['data']->id}}" rel2="Restrurants Gallery Images">View Gallery</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                        <div id="new-hotels-spa-sec" class="spa-sec-outer-align">
                                <div class="container">
                                    <div class="ai-spa-sec-inner">
                                        <div class="main-spa-sec-show-area">
                                            <div class="spa-overlay-text">
                                                <blockquote>{{$propertyDetail['data']->spa_title}}</blockquote>
                                                <span>{{$propertyDetail['data']->spa_manager_text}}</span>
                                            </div>
                                            @if($propertyDetail['data']->spa_image1!='')
                                            <img class="img-responsive main-spa-img-align" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image1)}}" alt=""/>
                                            @else
                                            <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS.png')}}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="spa-left-pannel-align">
                                                    <p class="spa-sec-para-style spa-text-pannel1">{{$propertyDetail['data']->spa_desciription}}</p>
                                                    @if($propertyDetail['data']->spa_image2!='')
                                                    <img class="img-responsive main-spa-img-align" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image2)}}" alt=""/>
                                                    @else
                                                    <img class="img-responsive main-spa-img-align img-responsive" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS-2.png')}}" alt=""/>
                                                    @endif
                                                    <div class="spa-left-des-pannel2">
                                                        <h4 class="spa-bold-text">OPENING HOURS</h4>
                                                        <div class="spa-booking-des-text-align">
                                                            <p class="spa-sec-para-style">For hotel guests the pool and sauna are open daily from 6am to 10pm.</p>
                                                            <p class="spa-sec-para-style">For Day SPA users, the use of the pool and sauna are only permitted with&nbsp;the booking of a treatment at these times:</p>
                                                            <p class="spa-sec-para-style">Monday to Thursday, from 10am to 9pm.<br>Friday to Sunday, from 10am to 8pm.</p>
                                                            <p class="spa-sec-para-style spa-bold-text">We need to inform you that our pool and sauna will be closed for the yearly maintenance work from 31<sup>st</sup> of July-18th of August 2017. We really apologize for the upcoming inconvenience.</strong></p>
                                                            <div class="spa-booking-info">
                                                                <p class="spa-sec-para-style">BOOKINGS:</p>
                                                                <p class="spa-sec-para-style">Phone: +49 30 311 722-160</p>
                                                                <p class="spa-sec-para-style"><a class="spa-booking-link" href="#">http://design-locations.biz</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <div class="spa-description-pannel2">
                                                    @if($propertyDetail['data']->spa_image3!='')
                                                    <img class="img-responsive main-spa-img-align" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image3)}}" alt=""/>
                                                    @else
                                                    <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/Spa-Manager.png')}}" alt=""/>
                                                    @endif
                                                    <div class="spa-products-tittles-align">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                @if($propertyDetail['data']->spa_image3!='')
                                                                <img class="img-responsive main-spa-img-align" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image3)}}" alt=""/>
                                                                @else
                                                                <img class="img-responsive main-spa-img-align" src="{{ asset('sximo/assets/images/Spa-Manager.png')}}" alt=""/>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <blockquote class="spa-content-quote">
                                                                    -{{$propertyDetail['data']->spa_usp_person}}
                                                                    <p class="content-quote-author">Susanne Kaufmann</p>
                                                                </blockquote>
                                                                <a href="#" class="spa-sec-book-an-appoinment-btn">Book Appointment</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!--Next-section-->
                        <div id="hotel-bar-sec" class="hotels-bar-sec-align">
                                <div class="container">
                                    <div class="bar-sec-inner-pannel">
                                        <div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="row">
                                                    <img class="img-responsive img-width" src="{{ $propimg->imgsrc.$propimg->file_name }}" alt=""/>
                                                    <div class="hotel-bar-name-pannel">
                                                        <h2 class="bar-name-text-style">Bar Name</h2>
                                                        <div class="bar-name-border-bottom"></div>
                                                        <p class="bar-des-text">The Coolest Bar in Berlin</p>
                                                        <p class="bar-des-text">Right Now</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="bar-intro-text-bg">
                                                        <div class="bar- tiitles-main-align">
                                                            <h2 class="bar-info-text-haeding">Miss Clara By Nobiss</h2>
                                                            <p class="bar-info-text-style1">No one looks back on their own life and remembers the nights got 
                                                            plenty of sleep</p>
                                                        </div>
                                                        <div class="red-pannel-text-align">
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="bar-red-pannel-image">
                                                                        <img class="img-responsive img-width" src="{{ $propimg->imgsrc.$propimg->file_name }}" alt=""/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="view-gallery-pannel-align">
                                                                        <span class="view-gallery-border-left"></span>
                                                                        <a href="#" class="detail_view gallerysty bar-view-gallery" rel="{{$propertyDetail['data']->id}}" rel2="Spa Gallery Images">View Gallery</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <div class="row">
                                                    <div class="bar-image-rigth">
                                                        <img class="img-responsive img-width" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image)}}" alt=""/>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="bar-bottom-des-pannel">
                                                        <p>Some drinks are adaptions of forgotten 1920s and -30s cocktails.
                                                            Sprits include unsual whiskies and cognacs not otherwise available
                                                            in the German cpaita;. In the wine gallery.</p>
                                                        <div class="spa-owner-sign">Jhon Paul</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                        <div class="spa-sec-bg">
                            <div class="container spa-sec-margin-bottom" id="spa">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <div>
                                            @if($propertyDetail['data']->spa_image1!='')
                                            <img class="architecture-sec-top-img" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image1)}}" alt=""/>
                                            @else
                                            <img class="spa-first-sec-img-align img-responsive" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS.png')}}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="spa-side-description-bg">
                                            <h1>{{$propertyDetail['data']->spa_title}}</h1>
                                            <p>{{$propertyDetail['data']->spa_desciription}}</p>
                                            @if(!empty($spagalleryArr))
                                            <p><a href="#" class="detail_view gallerysty" rel="{{$propertyDetail['data']->id}}" rel2="Spa Gallery Images"><i class="fa fa-file-image-o"></i> View Gallery</a></p>
                                            @endif
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="">
                                                <p class="spa-first-side-btn-text">{{$propertyDetail['data']->spa_usp_text}}
                                                </p>
                                                <div class="spa-first-sec-sign">-{{$propertyDetail['data']->spa_usp_person}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        @if($propertyDetail['data']->spa_image2!='')
                                        <img class="architecture-sec-top-img" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image2)}}" alt=""/>
                                        @else
                                        <img class="spa-and-wellness-side-sec-img-align img-responsive" src="{{ asset('sximo/assets/images/SPA-&-WELLNESS-2.png')}}" alt=""/>
                                        @endif

                                        <div class="col-md-8 col-sm-8">
                                            @if($propertyDetail['data']->spa_image3!='')
                                            <img class="architecture-sec-top-img" src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->spa_image3)}}" alt=""/>
                                            @else
                                            <img class="spa-manager-image-align img-responsive" src="{{ asset('sximo/assets/images/Spa-Manager.png')}}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <p class="spa-manager-title-text">{{$propertyDetail['data']->spa_manager_text}}</p>
                                            <div class="spa-manager-sign" >Spa Manager</div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="spa-bootom-text-block-bottom">
                                                <p class="">
                                                    will be possible to take SPA luxury there. Philosophically and
                                                    ecologically. Everything
                                                    will be possible to take SPA luxury there. Philosophically and
                                                    ecologically. Everything
                                                    will be possible to take SPA luxury there. Philosophically and
                                                    ecologically. Everything
                                                    will be possible to take SPA luxury there. Philosophically and
                                                    ecologically. Everything
                                                    will be possible to take SPA luxury there. Philosophically and
                                                    ecologically. Everything
                                                </p>
                                                <a href="#" class="spa-sec-book-an-appoinment-btn">Book Appointment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endif



                        <!--Next Section-->
                        @if($propertyDetail['data']->video_video!='')
                        <div class="video-section-bg">
                            <div class="container">
                                <div class="video-sec-background-image">
                                    {{--*/  $videolink = URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_video); 
													$video_banner = ($propertyDetail['data']->video_image!='')? URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_image): URL::to('sximo/images/mp4.png');
											/*--}}
                                    <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"  controls="controls" preload="none" poster="{{$video_banner}}" data-setup="{ }" width="219px" height="161px">
                                        <source src="{{$videolink}}" type="video/mp4">
                                    </video>
                                    <div class="video-below-text-margin-align">
                                        <div class="video-sec-small-text">
                                            {{$propertyDetail['data']->video_title}}
                                        </div>
                                        <div class="video-sec-description-text">
                                            {{$propertyDetail['data']->video_desciription}}
                                        </div>
                                        <div class="video-sec-bottom-text">
                                            {{$propertyDetail['data']->video_sub_title}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                        <!--Book Now page-->
                        <div class="editorial-book-now-page sec-differentiate-line " id="book-now">
                            <!--<form id="frontend_booking" method="post">-->
                            <form action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
                                <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}" />
                                <input type="hidden" name="roomType" id="roomType" value="" />
                                <div class="book-now-page-content-">
                                    <div class="editoral-book-page-headings">
                                        <h2>Design Location is your ideal, vogue vacation planner!</h2>
                                        <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Design Locations ensure the ultimate luxury experience</p>
                                    </div>
                                    <ul class="dates" id="editorial-book-now-inputs">
                                        <li>
                                            <div class="editorail-heading">Arrive</div>
                                            <input id="date-range-editorial-arrive" name="arrive" class="datePicker- dateFrom-" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}" type="text" />
                                        </li>
                                        <li>
                                            <div class="heading">Departure</div>
                                            <input id="date-range-editorial-destination" name="destination" class="datePicker- dateFrom-" value="{{ ($destination_date!='') ? $destination_date : '' }}" type="text" />
                                        </li>
                                    </ul>
                                    <ul class="dates">
                                        <li>
                                            <div class="heading">Adults</div>
                                            <select name="booking_adults">
                                                <option {{ ($adults!='' && $adults==1) ? 'selected' : '' }}>1</option>
                                                <option {{ ($adults!='' && $adults==2) ? 'selected' : '' }}>2</option>
                                                <option {{ ($adults!='' && $adults==3) ? 'selected' : '' }}>3</option>
                                            </select>
                                        </li>
                                        <li>
                                            <div class="heading">Children</div>
                                            <select name="booking_children">
                                                <option {{ ($childs!='' && $childs==0) ? 'selected' : '' }}>0</option>
                                                <option {{ ($childs!='' && $childs==1) ? 'selected' : '' }}>1</option>
                                                <option {{ ($childs!='' && $childs==2) ? 'selected' : '' }}>2</option>
                                            </select>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="clearfix"></div>
                                    <div class="editorial-submit-btn">
                                        <button type="submit">BOOK NOW</button>
                                        <!--<a data-popup-id="booking-form-pop-up" class="booking-form-pop-up-btn" href="#" onclick="save_reserve_forms_data('frontend_booking');">BOOK NOW</a>-->
                                    </div>
                                    <div class="view-modify-cancel-booking">
                                        <a href="#">View, Modify or Cancel your Booking</a>
                                    </div>
                                    <ul class="booking-page-footer-section editorial-book-align" >
                                        <li>
                                            <a href="#" target="_blank">
                                                <span>Join the worlds leading luxury club</span>
                                                <h6 class="center">Enjoy exclusive members only benefits</h6>
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
                                                <span>View or Modify Reserveration</span>
                                                <h6 class="center">Login to Support Center</h6>
                                            </a>
                                            <div class="white-border-bottom"></div>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <div class="hotel-property-section-bg">
                            <div class="clearfix"></div>
                            <!--Show More Slide-->
                            <div class="show_more-page">
                                <div class="open-show_more-html">
                                    <div><a class="close-btn-show_more close-btn-align" href="#">&times;</a></div>
                                    <div class="container-">
                                        <div class="row-">
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-sm-6 rmimgp">

                                            </div>
                                            <div class="col-md-6 col-sm-6 single-right-text-product">

                                            </div>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Show More Slide End Here-->
                        <div class="col-md-2 right-menus right-menu-sidebar">
                            <div class="row">
                                <div class="right-menu-align">
                                    <div class="hotels-logo">
                                        <a href="{{url('')}}"> <img alt="" src="http://design-locations.biz/sximo/assets/images/design-location-logo.png" class="img-responsive"></a>
                                    </div>
                                    <ul>
                                        <li>
                                            <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar" action="{{URL::to('search')}}">
                                                <input  class="bh-search-input typeahead search-navbar search-box" name="s" id="search-navbar" placeholder="Search" type="text">
                                            </form>
                                        </li>
                                        @if (array_key_exists('typedata', $propertyDetail))
                                        <li>
                                            <a href="#hotel">@if($propertyDetail['data']->property_type=='Yachts') YACHT @elseif($propertyDetail['data']->property_type=='Villas') VILLA @else HOTEL @endif</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
                                        <li>
                                            <a href="#deisgnarchitecture">DESIGN &amp; ARCHITECTURE</a>
                                        </li>
                                        @endif

                                        @if (array_key_exists('typedata', $propertyDetail))
                                        <li>
                                            <a href="#rooms">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS & SUITES' }}</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
                                        <li>
                                            <a href="#spa_restaurant">RESTAURANT</a>
                                        </li>
                                        @endif

                                        @if($propertyDetail['data']->spa_title!='' && $propertyDetail['data']->spa_desciription!='')
                                        <li>
                                            <a href="#spa">SPA</a>
                                        </li>
                                        @endif

                                        <li>
                                            <a href="#book-now">BOOK @if($propertyDetail['data']->property_type=='Yachts') YACHT @elseif($propertyDetail['data']->property_type=='Villas') VILLA @else HOTEL @endif </a>
                                        </li>
                                        <li>
                                            <a href="#">PACKAGES</a>
                                        </li>
                                    </ul>
                                </div>
                                @if(!empty($relatedproperties))
                                <div class="side-nav-next-hotel-img">
                                    <div class="side-next-and-perivious-hotel-arrow">
                                        <div class="arrows-commom  next-arrow">
                                            <a href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                                <span>New Hotels</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="new-hotel-image" style="background-image: url('{{$relatedproperties[0]['image']->imgsrc.$relatedproperties[0]['image']->file_name}}')">
                                        <div class="new-hotels-image-tittle">
                                            <h2 class="new-hotel-name">{{$relatedproperties[0]['rpdata']->property_name}}</h2>
                                            <div class=" new-hotel-add">
                                                <p>New York City</p>
                                                <p>United States</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="new-hotel-view-more-btn">
                                            <a class="" href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                                View Hotel
                                            </a>
                                        </div>
                                    </div>
                                    <!--<img class="img-responsive" src="{{$relatedproperties[0]['image']->imgsrc.$relatedproperties[0]['image']->file_name}}" alt="">-->
                                    <a class="bootom-view-next-btn" href="{{URL::to('our-collection/'.$relatedproperties[0]['rpdata']->property_slug)}}">
                                        Visit All Hotels DOI
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                                scrollTop: (target.offset().top - 110)
                            }, 1000);
                            return false;
                        }
                    }
                });
            });

            $(document).on('click', '.detail_view', function () {
                $('#frontpage-layer-bj').fadeOut('slow');
                $('#frontpage-detail-tile').html('');
                $.ajax({
                    url: "{{ URL::to('getpropertygallery')}}" + '/' + $(this).attr('rel') + '/' + $(this).attr('rel2'),
                    type: "get",
                    success: function (data) {
                        var imagesPro = '';
                        $(data.image).each(function (i, val) {
                            imagesPro += '<li class="detail-tile col-sm-6 col-xs-12 col-md-6 col-lg-4" style="visibility:visible">';
                            imagesPro += '<div class="detail-tile-inner">';
                            imagesPro += '<img src="' + val.imgsrc + val.file_name + '"/>';
                            imagesPro += '</div>';
                            imagesPro += '</li>';
                        });
                        $('#frontpage-detail-tiles-detail').html(imagesPro);
                    }
                });
                $('#frontpage-layer-bj-detail').fadeIn('slow');
                $('html').addClass('hidescroll');
                $('body').addClass('layerloaded');
                return false;
            });

            $(document).on('click', '.frontpage-layer-bj-header-close', function () {
                $('.frontpage-layer-bj').fadeOut('slow');
                $('html').removeClass('hidescroll');
            });

            $(document).on('click', '.open-show_more-page', function () {
                $('.show_more-page').css("background-image", "");
                $('.single-right-text-product').html('');
                $('.rmimgp').html('');
                $.ajax({
                    url: "{{ URL::to('getpropertytypedetail')}}" + '/' + $(this).attr('rel'),
                    type: "get",
                    success: function (data) {
                        var rimg = data.roomimgs.imgsrc + data.roomimgs.file_name;
//                      $('.rmimgp').html('<img class="img-responsive" src="' + rimg + '" alt="' + data.roomimgs.file_name + '" />');
                        $('.rmimgp').html('<div class="right-text-section"></div>');
                        //console.log(rimg);
                        $('.show_more-page').css("background-image", "url('" + rimg + "')");
                        var imagesPro = '';
                        imagesPro += '<div class="text-section">';
                        imagesPro += '<h2>' + data.typedata.category_name + '</h2>';
                        imagesPro += '<p>' + data.amenities.amenities_eng.replace(/\n/g, "<br />") + '</p>';
                        imagesPro += '<p>' + data.typedata.room_desc + '</p>';
                        imagesPro += '</div>';
                        imagesPro += '<div class="book-btn-sec">';
                        if (data.typedata.price != '')
                        {
                            imagesPro += '<div class="hotel-book-price">';
                            imagesPro += (data.currency.content != '') ? data.currency.content : '$';
                            imagesPro += data.typedata.price;
                            imagesPro += '</div">';
                        }
                        imagesPro += '</div>';
                        imagesPro += '<div class="inner-pop-up-book-btn">';
                        imagesPro += '<a href="#" onclick="choose_room_type(' + data.typedata.id + ');">Book</a>';
                        imagesPro += '</div>';
                        imagesPro += '</div>';
                        $('.single-right-text-product').html(imagesPro);
                    }
                });
                return false;
            });

            function choose_room_type(type)
            {
                $('#roomType').val('');
                if (type != '' && type > 0)
                {
                    $('#roomType').val(type);
                }
            }

            function save_reserve_forms_data(formid)
            {
                if (formid != '')
                {
                    var room = $('#roomType').val();
                    if (room != '')
                    {
                        $.ajax({
                            url: "{{ URL::to('add_new_booking')}}",
                            type: "post",
                            data: $('#' + formid).serializeArray(),
                            dataType: "json",
                            success: function (data) {
                                var html = '';
                                if (data.status == 'error')
                                {
                                    alert('error');
                                } else
                                {
                                    alert('done');
                                }
                            }
                        });
                    } else {
                        alert('Please select a room first');
                    }
                }
            }
        </script>
        <script src="{{ asset('sximo/assets/js/TweenMax.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/script.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/imagesloaded.js')}}" type="text/javascript"></script>
<!--                    <script src="{{ asset('sximo/assets/js/privacy-cookie.js')}}" type="text/javascript"></script>-->
        <div class="editorial-custom-footer-style">
            @include('layouts/elliot/ai_footer')
        </div>

        <div id="frontpage-layer-bj-detail" class="frontpage-layer-bj">
            <div id="frontpage-layer-bj-header-wrapper">
                <div id="frontpage-layer-bj-header">
                    <a href="#" id="frontpage-layer-bj-header-logo"> <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive yachts-pop-up-logo"></a>
                </div>
                <span id="frontpage-layer-bj-header-close" class="frontpage-layer-bj-header-close"></span>
            </div>
            <div id="frontpage-layer-bj-content">
                <div class="frontpage-detail-content-top">
                    <div class="frontpage-detail-content-top-link">
                        <div class="frontpage-detail-content-top-link">

                        </div>
                    </div>
                </div>
                <ul class="clearfix frontpage-detail-tiles" id="frontpage-detail-tiles-detail">

                </ul>
            </div>	
        </div>
        @include('layouts/elliot/ai_booking-form2')
        <script>
            $(document).ready(function () {
                $(".to-booking-nav-show-hide-btn").click(function () {
                   $(".booking-form-bar-top").toggle(1000);
               });
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
            $('#top-bar-booking-form').dateRangePicker(
                    {
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
                        format: ' DD.MM.YYYY',
                        autoClose: "true",
                        separator: ' to ',
                        getValue: function ()
                        {
                            if ($('#top-bar-booking-form-destination').val() && $('#top-bar-booking-form-arrive').val())
                                return $('#top-bar-booking-form-destination').val() + ' to ' + $('#top-bar-booking-form-arrive').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2)
                        {
                            $('#top-bar-booking-form-arrive').val(s1);
                            $('#top-bar-booking-form-destination').val(s2);
                        }
                    }
            ).bind('datepicker-first-date-selected', function (event, obj) {
                $("#top-bar-booking-form-destination").val('');
            });
        </script>
        <script>
            function openNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "0";
            }
            $(function () {
                $('.slider-side-description-text').dotdotdot({
                    maxLength: 300,
                    ellipsis: '.......'
                });
            });
            $(function () {
                $('.hotel-description-text').dotdotdot({
                    maxLength: 300,
                    ellipsis: ' .......'
                });
            });
        </script>
        <script>
            $(".to-booking-nav-show-hide-btn").click(function () {
                $(".booking-form-bar-top").toggle(1000);
            });
        </script>