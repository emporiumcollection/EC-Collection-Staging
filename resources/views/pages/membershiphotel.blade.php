<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- title -->
        <title>Membership Page</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <!-- animation -->
        <link href="{{ asset('sximo/assets/css/landing-page-styles.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>


        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/animate.css')}}" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/bootstrap.min.css')}}" />
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/font-awesome.min.css')}}" />
        <!-- swiper carousel -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
        <!-- style -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
        <!-- Custom style -->
        <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
        <!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
        <style>
            .right-menus ul li a {
                background-color: #1E2023;
                border-bottom: 1px solid #414246;
                color: #fff;
                display: block;
                font-size: 12px !important;
                padding: 25px 0 25px 21px;
                text-transform: uppercase;
                background: rgba(37,37,37,1.0);
            }
            header.haside {
                right: 0 !important;
                position: fixed;
                top: 0;
                width: 65px;
                left: unset !important;
            }
            .next-hotel-show-pannel {
                right: 66px;
                position: absolute;
                top: 0;
                width: 250px;
                left:unset;
            }
            /* AIC Harman email sidebar css */
            .post-filter-inputs:hover, .post-filter-inputs:active, .post-filter-inputs:focus {
                background-color: #89837B;
                border-left: 4px solid #a1a39c;
                color: #fff !important;
                transition: all 0.3s ease 0s;
            }
            .site-aside {
                position: fixed;
                top: 0;
                right: 0;
                height: 100%;
                overflow-x: visible;
                z-index: 1028;
            }
            .contact-aside {
                border-radius: 0px;
                transition: .5s;
                position: fixed;
                top: 127px;
                left: calc(100% - 65px);
                width: 340px;
                background: #272727;
                color: #fff;
                font-size: 15px;
                right: 0;
            }
            .contact-aside ul {
                padding: 7px 0px 0px 0px;
                list-style: none;
                margin-bottom: 10px;
            }
            .contact-aside li {
                padding: 6px 0px 6px 25px;
                margin: 0px 0px 1px 0px;
            }
            .contact-aside li a {
                margin-left: 10px;
                font-size: 13px;
                color: #ABA07C;
            }
            .contact-aside [class*="icon-"] {
                display: inline-block;
                width: 24px;
                text-align: center;
                margin-right: 4px;
                float: right;
            }
            .contact-aside li + li {
                border-top: 1px solid #4A4A4A;
            }
            .contact-aside .icon-mail {
                position: relative;
                top: 2px;
            }
            .contact-aside.active {
                left: calc(100% - 290px);
                background: #1e2023 !important;
                color: #fff !important;
            }
            .heading-stying {
                font-size: 12px !important;
            }
            .asideIclass {
                float: left;
                margin-top: 3px;
                margin-right: 13px;
                margin-left: 8px;
                color: #ABA07C;
            }
            .neww-footer .container {
                width: auto;
            }
			#formerrors { color:#ff0000;}
        </style>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".regular").slick({
                    dots: false,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    prevArrow: false,
                    nextArrow: false,
                    autoplay: true,
                    autoplaySpeed: 3000
                });
            });
        </script>
    </head>
    <body>
        <!-- Start slider section -->
        <div class="container-fluid">
            <header class="haside">

                <div class="logo-padding-left editorial-logo-align">
                    <!--<div>
                            <a href="#" title="Add to Favorites" class="book-button" onclick="add_to_lightbox(41688, 58);"><i class="fa fa-plus " aria-hidden="true" ></i> Add</a>
                    </div>-->
                    <div class="go-back-button-container">
                        <button class="go-back-button" onclick="goBack()">Go Back</button>
                        <div class="previous-page-screen-short-container">
                        </div>
                    </div>
                </div>
                <div class="hotel-next-previous-outer">
                    <div class="previous-btn previous-next-pannel"> 
                        <img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-left-arrow.png" alt="">
                        <a href="http://www.emporium-voyage.com/luxury-hotel-luxury-vander-urbani-resort">
                            <div class="next-hotel-show-pannel">
                                <img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4567_27731137764-82283525500.jpg" alt="">
                                <div class="next-hotel-tittle">
                                    <h2>VANDER URBANI RESORT</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="hotel-next-previous-outer">
                    <div class="next-hotel-btn previous-next-pannel"> 
                        <img class="img-responsive next-hotel-arrow" src="http://www.emporium-voyage.com/sximo/assets/images/editorial-right-arrow.png" alt="">
                        <a href="http://www.emporium-voyage.com/luxury-hotel-hotel-zoo-berlin-">
                            <div class="next-hotel-show-pannel">
                                <img class="img-responsive" src="http://www.emporium-voyage.com/uploads/property_imgs_thumbs/front_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg" alt="">
                                <div class="next-hotel-tittle">
                                    <h2>Hotel Zoo Berlin </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </header>
            <!-- AIC Harman email phone sidebar add start -->

            <aside class="site-aside">
                <div class="contact-aside">
                    <ul class="contact-aside-list">
                        <li class="contact-list-item contact-phone"><a href="tel:+1 934 451 1317"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +1 934 451 1317</a></li>
                        <li class="contact-list-item contact-email"><a href="mailto:riaan@emporium-voyage.com"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> riaan@emporium-voyage.com</a></li>
                    </ul>
                </div>
            </aside>

            <!-- AIC Harman email phone sidebar add end-->
            <div class="row">
                <div class="col-md-2">
                    <div class="right-menus right-menu-sidebar">
                        <div class="hotels-logo">
                            <img alt="" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" class="img-responsive">
                        </div>
                        <div class="panel-group new-sidebar-sk" id="accordion">
							{{--*/ $page_menus = SiteHelpers::menus('business') /*--}}
							@if(!empty($page_menus))
							@foreach ($page_menus as $pmenu)
								<div class="panel panel-default custom-post-panel">
									<a @if(count($pmenu['childs']) > 0) data-toggle="collapse" data-parent="#accordion" href="#webpage{{$pmenu['menu_id']}}" @else @if($pmenu['menu_type'] =='external') href="{{ URL::to($pmenu['url'])}}" @else href="{{ URL::to($pmenu['module'])}}" @endif @endif class="heading-stying collapsed">
										<div class="panel-heading custom-heading">
											@if(CNF_MULTILANG ==1 && isset($pmenu['menu_lang']['title'][Session::get('lang')]))
												{{ $pmenu['menu_lang']['title'][Session::get('lang')] }}
											@else
												{{$pmenu['menu_name']}}
											@endif
										</div>
									</a>
									@if(count($pmenu['childs']) > 0)
										<div id="webpage{{$pmenu['menu_id']}}" class="panel-collapse  collapse">
											<div class="panel-body custom-panel-body">
												<div class="dl-filter">
													@foreach ($pmenu['childs'] as $pmenu2)
														<div class="form-group post-filter-inputs">
															<label>
																<a @if($pmenu2['menu_type'] =='external') href="{{ URL::to($pmenu2['url'])}}" @else href="{{ URL::to($pmenu2['module'])}}" @endif>
																	@if(CNF_MULTILANG ==1 && isset($pmenu2['menu_lang']['title'][Session::get('lang')]))
																		{{ $pmenu2['menu_lang']['title'][Session::get('lang')] }}
																	@else
																		{{$pmenu2['menu_name']}}
																	@endif
																</a>
															</label>
														</div>
													@endforeach
												</div>
											</div>
										</div>
									@endif
								</div>
							@endforeach
							@endif
                        </div>
                        <section class="regular slider">
                            <div class="slick-cstm-width">
								<div class="side-bar-why-book-with-us">
									<div class="book-with-us-tittles">
										<h2>Why book with us?</h2>
									</div>
									<ul class="side-bar-book-with-us-list">
										@if(!empty($whybookwithus))
											@foreach($whybookwithus as $withus)
												<li>
													<h3>{{$withus->title}}</h3>
													<p>{{$withus->sub_title}}</p>
												</li>
											@endforeach
										@endif
									</ul>
								</div>
							</div>
							@if(!empty($landingads))
							@foreach($landingads as $lnads)
							<div class="slick-cstm-width">
								<a href="{{ (strpos($lnads->adv_link, 'http://') !== false) ? $lnads->adv_link : 'http://'.$lnads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$lnads->adv_img)}}"></a>
							</div>
							@endforeach
							@endif
                        </section>
                    </div>
                </div>
                <div class="col-md-10 no-padding">
					@if(!empty($pageslider))
						<section class="wow fadeIn no-padding cstmaiclass">
							<div class="swiper-auto-height-container position-relative width-100">
								<div class="swiper-wrapper overflow-hidden">
									@foreach($pageslider as $key => $slider_row)
										<!-- start slider item -->
										<div class="swiper-slide padding-100px-all cover-background position-relative xs-padding-20px-all" style="background-image:url({{url()}}/uploads/slider_images/{{$slider_row->slider_img}})">
											<div class="position-relative width-55 md-width-60 sm-width-85 xs-width-100 display-inline-block slide-banner last-paragraph-no-margin">
												<div class="padding-80px-all bg-black-opacity sm-padding-40px-all xs-padding-30px-all xs-text-center xs-width-100">
													<h3 class="alt-font text-white sm-width-100">{{$slider_row->slider_title}}</h3>
													<p class="sm-width-100 lorem-para">{{$slider_row->slider_description}}</p>
													<a href="{{$slider_row->slider_link}}" class="margin-35px-top sm-margin-15px-top btn btn-white">Explore services</a>
												</div> 
											</div>
										</div>
										<!-- end slider item -->
									@endforeach
								</div>

								<div class="navigation-area">
									<div class="swiper-button-next swiper-next-style4 bg-primary text-white"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
									<div class="swiper-button-prev swiper-prev-style4"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
								</div>
								<div class="scroll-button">
									<a href="#align-to-top" class="align-to-top-arrow"><img src="http://www.emporium-voyage.com/sximo/assets/images/scroll-down.png" class="down-arrow-align animate-arrow" alt=""> </a>
								</div>
							</div>
						</section>
					@endif
                    <!-- end slider section -->
                    <!-- start contact form section -->
                    <section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                        <div class="container-fluid">
                            <div class="row equalize sm-equalize-auto">
                                
                                <div class="col-md-12 sm-clear-both wow fadeInLeft no-padding">
                                    <div class="padding-ten-half-all bg-light-gray md-padding-seven-all xs-padding-30px-all height-100">
                                        <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                                        <!--<span class="text-extra-dark-gray alt-font text-large font-weight-600 margin-25px-bottom display-block">Application form</span>--> 
										<div id="formerrors"></div>
                                        <form id="contact-form" action="{{URL::to('frontend_hotelpost')}}" method="post">
                                            <div class="col-md-12 sm-clear-both">
                                                <div id="success-contact-form" class="no-margin-lr"></div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Name</label>
                                                    <input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Status</label>
                                                    <select name="hotelinfo_status" class="bg-white medium-input">
                                                        <option value="">Select Status</option>
                                                        <option value="">Open</option>
                                                        <option value="">Construction phase</option>
                                                        <option value="">Planning phase</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Type</label>
                                                    <select name="hotelinfo_type" class="bg-white medium-input">
                                                        <option value="">Hotel Type</option>
                                                        <option value="">Alternative</option>
                                                        <option value="">Beach Resort</option>
                                                        <option value="">Resort</option>
                                                        <option value="">City</option>
                                                        <option value="">Mountain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Building</label>
                                                    <select name="hotelinfo_building" class="bg-white medium-input">
                                                        <option value="">Hotel Building</option>
                                                        <option value="">New Construction</option>
                                                        <option value="">Existing Building</option>
                                                        <option value="">Conversion</option>
                                                    </select>
                                                </div> 
                                                <div class="col-md-12 col-sm-12 no-padding">
                                                    <label>*Hotel Opening Date</label>
                                                    <input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="hotelinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>*Hotel Website</label>
                                                    <input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-left">
                                                    <label>*Days open for business</label>
                                                    <input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label>Avg. Daily Rate</label>
                                                    <input type="text" name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-right">
                                                    <label>Avg. Occupancy</label>
                                                    <input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Number of Rooms</label>
                                                    <input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Number of Suites</label>
                                                    <input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input">
                                                </div>
                                                <div class="row padding-row">
                                                    <div class="col-md-6 col-sm-12 no-padding-left">
                                                        <label>F & B Outlets</label>
                                                        <select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input">
                                                            <option value="">-</option>
                                                            <option value="Restaurant">Restaurant</option>
                                                            <option value="Bar">Bar</option>
                                                            <option value="Beach Bar">Beach Bar</option>
                                                            <option value="Club">Club</option>
                                                            <option value="Lobby/Lounge">Lobby/Lounge</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 no-padding-right">
                                                        <label>Guest Facilities</label>
                                                        <select name="hotelfac_guest_fac" multiple="" class="bg-white medium-input">
                                                            <option value="">-</option>
                                                            <option value="">Gym</option>
                                                            <option value="">Indoor Pool</option>
                                                            <option value="">Outdoor Pool</option>
                                                            <option value="">Spa</option>
                                                            <option value="">Business Center</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Meeting Area</label>
                                                    <input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Meeting Facilities</label>
                                                    <select name="hotelfac_meeting_fac" class="bg-white medium-input">
                                                        <option>Please select</option>
                                                        <option>YES</option>
                                                        <option>NO</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>Comments/Other Facilities</label>
                                                    <textarea name="hotelfac_comments" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Concept</label>
                                                    <textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Architecture & Design</label>
                                                    <textarea name="hoteldesc_architecture_design" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Architect Name</label>
                                                    <input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Architect Website</label>
                                                    <input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Interior Designer Name</label>
                                                    <input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Interior Designer Website</label>
                                                    <input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Local Integration</label>
                                                    <textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand</label>
                                                    <textarea name="hoteldesc_brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Brand Agency Name</label>
                                                    <input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand Agency Website</label>
                                                    <input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>Brand Linkedin Profile</label>
                                                    <input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>Brand Instagram Profile</label>
                                                    <input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
                                                <h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
												<div class="col-md-12 col-sm-12 no-padding">
                                                    <label>Signup Type</label>
                                                    <select name="hotel_signup_type" id="hotel_signup_type" class="bg-white medium-input">
                                                        <option>Please select</option>
                                                        <option value="company">Company</option>
                                                        <option value="advertiser">Advertiser</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 col-sm-12 no-padding entity">
                                                    <label>*Entity Name</label>
                                                    <input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="clear"></div>
                                                <div class="headingmimiform">
                                                    <h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*First Name</label>
                                                    <input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Last Name</label>
                                                    <input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Company Name</label>
                                                    <input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Job Title</label>
                                                    <input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <label>*Email Address</label>
                                                    <input type="email" name="hotel_contactprsn_email" placeholder="Email*" class="bg-white medium-input">
                                                </div>
												<div class="col-md-6 no-padding-right">
                                                    <label>*Username</label>
                                                    <input type="email" name="hotel_contactprsn_username" placeholder="Username*" class="bg-white medium-input">
                                                </div>
												<div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Password</label>
                                                    <input type="password" name="hotel_contactprsn_password" placeholder="Password*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Confirm Password</label>
                                                    <input type="password" name="hotel_contactprsn_password_confirmation" placeholder="Confirm password*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Phone</label>
                                                    <input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Mobile</label>
                                                    <input type="text" name="hotel_contactprsn_mobile" placeholder="Mobile*" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row fooetr-form">
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <span><input class="checkbox" type="checkbox" name="hotel_contactprsn_agree" value="1">I agree with the <a href="#">Terms and Conditions</a></span>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right text-align-right">
                                                    <button id="contact-us-button" type="button" class="btn btn-white" onclick="submit_hotelinfo_form();" style="width: 200px">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <style>
                        .footer
                        {
                            background-color: #f0f0f0 !important;
                        }
                    </style>
                    <div class="neww-footer">
                        @include('layouts/elliot/ai_footer_social')
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact form section -->    
        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- fit video  -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/jquery.fitvids.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/main.js')}}"></script>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/memform/js/slick.js')}}" type="text/javascript"></script>
        <script>
                            $(document).ready(function () {
                                $("a").on('click', function (event) {
                                    if (this.hash !== "") {
                                        event.preventDefault();
                                        var hash = this.hash;
                                        $('html, body').animate({
                                            scrollTop: $(hash).offset().top
                                        }, 800, function () {
                                            window.location.hash = hash;
                                        });
                                    }
                                });
                            });
                            $('a[href*="#"]')
                                    // Remove links that don't actually link to anything
                                    .not('[href="#"]')
                                    .not('[href="#0"]')
                                    .click(function (event) {
                                        // On-page links
                                        if (
                                                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                                                &&
                                                location.hostname == this.hostname
                                                ) {
                                            // Figure out element to scroll to
                                            var target = $(this.hash);
                                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                                            // Does a scroll target exist?
                                            if (target.length) {
                                                // Only prevent default if animation is actually gonna happen
                                                event.preventDefault();
                                                $('html, body').animate({
                                                    scrollTop: target.offset().top
                                                }, 1000, function () {
                                                    // Callback after animation
                                                    // Must change focus!
                                                    var $target = $(target);
                                                    $target.focus();
                                                    if ($target.is(":focus")) { // Checking if the target was focused
                                                        return false;
                                                    } else {
                                                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                                        $target.focus(); // Set focus again
                                                    }
                                                    ;
                                                });
                                            }
                                        }
                                    });
        </script>
        <script type="text/javascript">
            $(document).on('ready', function () {
                $(".regular").slick({
                    dots: false,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    prevArrow: false,
                    nextArrow: false,
                    autoplay: true,
                    autoplaySpeed: 3000
                });
				
				$(document).on('change', '#hotel_signup_type', function () {
					var typ = $(this).val();
					if(typ=='company')
					{
						$('.entity').hide();
					}
					else
					{
						$('.entity').show();
					}
				});
            });
        </script>
        <!-- contact email aside -->
        <script>
            $('.contact-aside').hover(
                    function () {
                        $(this).addClass('active')
                    },
                    function () {
                        $(this).removeClass('active')
                    }
            );
			
			function submit_hotelinfo_form()
			{
				$.ajax({
                    url: "{{ URL::to('frontend_hotelpost')}}",
                    type: "post",
                    data: $('#contact-form').serializeArray(),
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'error')
                        {
							var html = '';
							html +='<ul class="parsley-error-list">';
							$.each(data.errors, function(idx, obj) {
								html +='<li>'+obj+'</li>';
							});
							html +='</ul>';
							$('#formerrors').html(html);
							window.scrollTo(0, 600);
                        } 
						else
                        {
                            var htmli = '';
							htmli +='<div class="alert alert-success fade in block-inner">';
							htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
							htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
							$('#formerrors').html(htmli);
							 window.scrollTo(0, 600); 
							 setTimeout(function(){
								  window.location.href= "{{URL::to('membership_packages')}}";
								}, 3000);
                        }
                    }
                });
			}
        </script>
                <script>
            $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
            
        </script>
        <!-- contact email aside -->
    </body>
</html>