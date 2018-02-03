<html>
    <head>
        <title>Design Locations</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Styles Include-->
        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}">
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/detail-page.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/stick-nav-arrows.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/custom_ps.css')}}" rel="stylesheet" type="text/css"/>

        <!--Scripts Includes-->
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <!--<script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>-->
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/animate.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/uikit.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slideshow.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/js/typeahead.bundle.js')}}" type="text/javascript"></script>
        <style>
            .af-search-input.bh-search-input.typeahead {
                height: auto;
            }
            .footer > .container {
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
                        <div class="container-fluid logo-padding-left editorial-logo-align">
                            <div class="col-md-12-">
                                <p><a class="logo-d" href="{{URL::to('')}}">D</a></p>
                            </div>
                            <div class="col-md-12-">
                                <h2 class="menu-text-align">Home</h2>
                            </div>
                            <div class="col-md-12- menu">
                                <a href="#"><img class="menu-button" src="http://webtestingserver.net/TemplatesHtml/design-locations/assets/images/menu.png" alt=""/></a>
                                <ul style="display: none;">
                                    <li>
                                        <a href="">Get Inspired</a>
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
                    <div class="clearfix"></div>
                    
                    <div class="col-md-10 col-sm-9">
                        <!--HTML Slider Start Here-->
                        <div class="bh-slideshow-thumbnail-split" data-uk-slideshow="{animation: 'slice-up', autoplay: false}">
                            <?php
                            $slides = array();
                            if($row->image_pos_1 != '') {
                                $slides[] = array('image' => $row->image_pos_1,
                                                    'title' => $row->title_pos_1,
                                                    'description' => $row->description_pos_1,
                                                    'date' => $row->updated
                                                );
                            }
                            if($row->image_pos_2 != '') {
                                $slides[] = array('image' => $row->image_pos_2,
                                                    'title' => $row->title_pos_6,
                                                    'description' => $row->description_pos_6,
                                                    'date' => $row->updated
                                                );
                            }
                            if($row->image_pos_3 != '') {
                                $slides[] = array('image' => $row->image_pos_3,
                                                    'title' => $row->title_pos_7,
                                                    'description' => '',
                                                    'date' => $row->updated
                                                );
                            }
                            if($row->image_pos_4 != '') {
                                $slides[] = array('image' => $row->image_pos_4,
                                                    'title' => '',
                                                    'description' => '',
                                                    'date' => $row->updated
                                                );
                            }
                            if($row->image_pos_5 != '') {
                                $slides[] = array('image' => $row->image_pos_5,
                                                    'title' => '',
                                                    'description' => '',
                                                    'date' => $row->updated
                                                );
                            }
                            if($row->image_pos_6 != '') {
                                $slides[] = array('image' => $row->image_pos_6,
                                                    'title' => '',
                                                    'description' => '',
                                                    'date' => $row->updated
                                                );
                            }
                            if (!empty($slides)) {
                                echo '<ul style="height: 650px;" class="uk-slideshow uk-overlay-active ">';
                                foreach ($slides as $slide) {
                                    ?>
                                    <li style="height: 650px;" class="uk-active  video-silder-outer-align" aria-hidden="true">
                                        <div style="background-image: url({{ URL::to('uploads/article_imgs/'.$slide['image'])}});" class="uk-cover-background uk-position-cover"></div>
                                        <canvas style="width: 100%; height: 100%; opacity: 0;"></canvas>
                                        <div class="bh-slideshow-thumbnail-split-preview ai-uk-animation uk-animation-fade  uk-overlay-panel uk-overlay-right uk-overlay-background uk-overlay-fade uk-width-2-5 uk-width-xxlarge-1-3 uk-flex uk-flex-middle uk-flex-center uk-visible-large">
                                            <div>
                                                <ul class="bh-slideshow-thumbnail-split-preview-meta uk-subnav uk-subnav-line">
                                                    <li>
                                                        <span>{{date('M d, Y', strtotime($slide['date']))}}</span>
                                                    </li>
                                                </ul>
                                                <h3 class="bh-slideshow-thumbnail-split-preview-title">
                                                    <a href="javascript:void(0);">{{$slide['title']}}</a>
                                                </h3>
                                                <div class="bh-slideshow-thumbnail-split-preview-content"><?php echo html_entity_decode($slide['description']); ?></div>
                                                <a class="uk-margin-top uk-button uk-button-primary" href="javascript:void(0);">Read more <i class="zmdi zmdi-long-arrow-right uk-margin-small-left"></i></a>
                                            </div>
                                            <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                                            <a href="" class="bh-slideshow-slidenav uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                                        </div>
                                    </li>
                                    <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                        <!--HTML Slider End Here-->

                        <div class="header container-fluid">
                            <div class="container">
                                <div class="row">
                                    <div class="header-navigation-container col-md-12">
                                        <div class="row">
                                            <div class="col-md-0"></div>
                                            <div class="col-md-3 col-sm-2 hamburger-menu-left-align"></div>
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
                                                                    <?php
                                                                    $grid_menus = SiteHelpers::menus('content');
                                                                    if (!empty($grid_menus)) {
                                                                        foreach ($grid_menus as $gmenu) {
                                                                            ?>
                                                                            <li class="active">
                                                                                <a href="<?php echo ($gmenu['menu_type'] == 'external') ? URL::to($gmenu['url']) : URL::to($gmenu['module']); ?>" >
                                                                                    <?php
                                                                                    if (CNF_MULTILANG == 1 && isset($gmenu['menu_lang']['title'][Session::get('lang')])) {
                                                                                        echo $gmenu['menu_lang']['title'][Session::get('lang')];
                                                                                    } else {
                                                                                        echo $gmenu['menu_name'];
                                                                                    }
                                                                                    ?>
                                                                                </a>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </nav>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <div class="row">
                                                    <div class="filter-grid-page-side-bar">
                                                        <div class="filters-gird-page-side-bar-filter-align">
                                                            <div class="design-locations-logo">
                                                                <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>
                                                            </div>
                                                            <form style="margin: 0px;" action="{{URL::to('content-grid-shuffle')}}">
                                                                <div class="design-locations-logo filters-page-serch-bar-align shop-page-sidebar-outer">
                                                                    <input class="af-search-input bh-search-input typeahead" placeholder="SEARCH" name="af_search" type="text">
                                                                </div>
                                                            </form>
                                                            <div class="panel-group" id="accordion">
                                                                <!--Categories-->
                                                                <div class="panel panel-default custom-post-panel">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                                        <div class="panel-heading custom-heading">CATEGORIES</div>
                                                                    </a>
                                                                    <div id="collapse1" class="panel-collapse collapse">
                                                                        <div class="panel-body custom-panel-body">
                                                                            <div class="dl-filter">
                                                                                <form>
                                                                                    <?php
                                                                                    if (!empty($categories)) {
                                                                                        foreach ($categories as $category) {
                                                                                            echo '<div class="form-group post-filter-inputs ">
                                                                                                    <label><a href="'.URL::to('content-grid-shuffle').'?af_category='.$category->cat_id.'">' . $category->cat_name . '</a></label>
                                                                                                </div>';
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--Categories End Here-->
                                                            </div>
                                                            <section class="regular slider">
                                                                <div class="slick-cstm-width">
                                                                    <div class="side-bar-why-book-with-us">
                                                                        <div class="book-with-us-tittles">
                                                                            <h2>Why book with us?</h2>
                                                                        </div>
                                                                        <ul class="side-bar-book-with-us-list">
                                                                            <li>
                                                                                <h3>Handpicked Selection of Hotels.</h3>
                                                                                <p>Over 200 destination at the best rate</p>
                                                                            </li>
                                                                            <li>
                                                                                <h3>Upgrade & Late Check-out</h3>
                                                                                <p>At any hotel, upon Availability</p>
                                                                            </li>
                                                                            <li>
                                                                                <h3>Upto 50% off at New Hotels</h3>
                                                                                <p>Exclusive community invitations</p>
                                                                            </li>
                                                                            <li>
                                                                                <h3>Free WiFi</h3>
                                                                                <p>Guaranteed at all Hotels</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                @if(!empty($sidebargridAds))
                                                                @foreach($sidebargridAds as $slides)
                                                                <div class="slick-cstm-width">
                                                                    <a href="http://{{$slides->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$slides->adv_img)}}"></a>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sticky-header-offset"></div>

                        <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
                        <div class="">
                            <div class="row">
                                <div class="section-padding">
                                    <div>
                                        <div class="post-sub-titles">
                                            <h2 class="main-sub-title">{{$row->title_pos_1}}</h2>
                                            <h2 class="sub-tittle-des"><?php echo strip_tags($row->description_detail_1); ?> - <span>{{$category->cat_title}}</span></h2>
                                        </div>
                                    </div>
                                    <div class="post-content" data-aos="fade-right">
                                        <div class="about-project">
                                            <h3>About this project</h3>
                                            <?php echo html_entity_decode($row->description_pos_3); ?>
                                        </div>
                                        <div class="double-image-sec">
                                            <div class="left-image floating"  >
                                                <img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$row->image_pos_7)}}" alt=""/>
                                            </div>
                                            <div class="right-image floating"  >
                                                <img data-aos="fade-right" class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$row->image_pos_8)}}" alt=""/>
                                                <?php echo html_entity_decode($row->title_pos_6); ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="description-text">
                                            <?php echo html_entity_decode($row->description_pos_6); ?>
                                        </div>
                                        <div class="below-post-image" data-aos="fade-right">
                                            <img class="img-responsive" src="{{ URL::to('uploads/article_imgs/'.$row->image_pos_9)}}" alt=""/>
                                        </div>
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
                                                <p class="footer-nav-menu-harding footer-res-margin-align">About Design Locations</p>
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
        <script src="{{URL::to('')}}../dist/aos.js"></script>
        <script>
            AOS.init({
                easing: 'ease-in-out-sine'
            });
        </script>
        <script>
            $(document).ready(function () {
                
                var substringMatcher = function(strs) {
                    return function findMatches(q, cb) {
                        var matches, substringRegex;

                        // an array that will be populated with substring matches
                        matches = [];

                        // regex used to determine if a string contains the substring `q`
                        substrRegex = new RegExp(q, 'i');

                        // iterate through the pool of strings and for any string that
                        // contains the substring `q`, add it to the `matches` array
                        $.each(strs, function(i, str) {
                          if (substrRegex.test(str)) {
                            matches.push(str);
                          }
                        });

                        cb(matches);
                    };
                };
                
                var suggestions = [{!! TagsFinder::article_suggestions() !!}];
                $('.af-search-input.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                },
                {
                    name: 'states',
                    source: substringMatcher(suggestions)
                });

                $('.af-search-input').on('typeahead:selected', function (e, datum) {
                    var propname = $(this);
                    $.ajax({
                        url: "{{URL::to('get-article-by-title')}}",
                        type: "post",
                        data: 'title=' + propname.val(),
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'error') {
                                $(".af_search").val( +propname.val() );
                                $(".af_start").val('0');
                                $(".af_editors_choice_start").val('0');
                                af_load_more_articles(true);
                                return;
                            } else {
                                window.location.href = "{{URL::to('article')}}/" + data.article.id;
                            }
                        }
                    });

                });
                
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
                if (document.getElementById("mySidenavpost").style.width == "400px") {
                    return closeNavpost();
                }
                return openNavpost();
            }
            function openNavpost() {
                if ($(window).width() >= 768) {
                    document.getElementById("mySidenavpost").style.width = "400px";
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
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>
</html>