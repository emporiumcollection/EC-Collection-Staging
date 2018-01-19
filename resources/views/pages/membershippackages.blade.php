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
        
        <!-- AIC -->
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-slide-nav.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/editorial-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/property.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/custom_ps.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/booking-form.css')}}" rel="stylesheet" type="text/css"/>
        <!-- AIC -->

        
        
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
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
            }
            .contact-aside li {
                padding: 6px 0px 6px 18px;
                margin: 0px 0px 1px 0px;
            }
            .contact-aside li a {
                margin-left: 11px;
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
            
            /* AIC */
            .image-slider-container .editorial-images-count {
                color: #fff !important;
                float: left !important;
                font-size: 33px !important;
                margin-left: 21% !important;
                margin-top: -167px !important;
                position: relative;
                width: 22% !important;
            }
        .slider-sec-side-text-bg {
	height: 580px;
	margin-top: -580px !important;
        }
        #align-to-top .slider-sec-side-text-bg .book-button.open-show_more-page.hotel-btn {
	background: #fff none repeat scroll 0 0;
	color: #000;
	font-size: 15px;
	margin-left: 0 !important;
	margin-top: 36px;
	max-height: 95px;
	min-height: 95px;
	opacity: 0.83;
	padding: 34px 27px;
	text-align: center;
	text-transform: uppercase;
	width: 174px;
    }
    .editorial-image-slider-previous-btn {
	margin-left: 472px !important;
    }
            
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
                        <li class="contact-list-item contact-phone"><a href="#"><i class="fa fa-phone asideIclass" aria-hidden="true"></i> +1 934 451 1317</a></li>
                        <li class="contact-list-item contact-email"><a href="#"><i class="fa fa-envelope asideIclass" aria-hidden="true"></i> riaan@emporium-voyage.com</a></li>
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
                                        <!--<span class="text-extra-dark-gray alt-font text-large font-weight-600 margin-25px-bottom display-block">Application form</span>-->
										<div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
										@if (!empty($packages))
											<ul class="image-slider">
												{{--*/ $k=1; $tottyp = count($packages); /*--}}
												@foreach($packages as $key=>$package)
												<li class="{{($k==1) ? 'active' : ''}}">
													<a href="#">
														<img class="img-responsive" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="height:580px; width: 100%;">
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
																			<div class="expeience-small-text">Package</div>
																			<div class="slider-side-text-tittle">{{$package->package_title}}</div>
																			<div class="slider-side-description-text">
																				{{(strlen($package->package_description) > 300) ? substr($package->package_description,0,300).'...':$package->package_description}}
																			</div>
																		</div>
																		<div>
																			<a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
																			@if (\Auth::check() == true)
																				<a href="{{URL::to('choosepackage/'.$package->id)}}" style="margin-left:100px;" >Buy Now</a>
																			@else
																				<a href="{{URL::to('user/login')}}" style="margin-left:100px;" >Buy Now</a>
																			@endif
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
												{{--*/ $k++; /*--}}
												
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
										@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
					
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
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/bootstrap.min.js')}}"></script>
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
			
			$(document).on('click', '.open-show_more-page', function () {
                $('.show_more-page').css("background-image", "");
                $('.single-right-text-product').html('');
                $('.rmimgp').html('');
                $.ajax({
                    url: "{{ URL::to('getpackagedetails')}}" + '/' + $(this).attr('rel'),
                    type: "get",
                    success: function (data) {
                        var rimg = "{{ URL::to('uploads/packages/')}}/" + data.pdata.package_image;
                        $('.rmimgp').html('<div class="right-text-section"></div>');
                        $('.show_more-page').css("background-image", "url('" + rimg + "')");
                        var imagesPro = '';
                        imagesPro += '<div class="text-section">';
                        imagesPro += '<h2>' + data.pdata.package_title + '</h2>';
                        imagesPro += '<p>' + data.pdata.package_description + '</p>';
                        imagesPro += '</div>';
                        imagesPro += '<div class="book-btn-sec">';
                        if (data.pdata.package_price_type != 1)
                        {
                            imagesPro += '<div class="hotel-book-price">';
                            imagesPro += (data.currency.content != '') ? data.currency.content : '$';
                            imagesPro += data.pdata.package_price;
                            imagesPro += '</div">';
                        }
                        imagesPro += '<a href="#"><div class="hotel-book-now">Book Now</div></a>';
                        imagesPro += '</div>';
                        imagesPro += '<div class="inner-pop-up-book-btn">';
                        imagesPro += '<a href="#">Book</a>';
                        imagesPro += '</div>';
                        imagesPro += '</div>';
                        $('.single-right-text-product').html(imagesPro);
                        $('.show_more-page').css("width", "100%");
                    }
                });
                return false;
            });
			
			
        </script>
        
        <!-- contact email aside -->
        
        <script>
    $(".editorial-image-slider-previous-btn").click(function ( event ) {
        event.preventDefault();
        
        var index = $(this).parent().parent().find(".image-slider li.active").index();
		$(this).parent().parent().find(".image-slider li.active").removeClass("active");
        if (index == 0) {
			var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() +1;
            $(this).parent().parent().find(".image-slider li:nth-child("+lindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
        }
		else
		{
			var rlindex = index - 1;
			$(this).parent().parent().find(".image-slider li:eq("+rlindex+")").addClass("active");
			$(this).parent().parent().find(".images-count").html( index + " / " + $(this).parent().parent().find(".image-slider li").length);
		}
		
        
    });
    
    $(".editorial-image-slider-next-btn").click(function ( event ) {
        event.preventDefault();

        var index = $(this).parent().parent().find(".image-slider li.active").index();
        if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
            index = -1;
        }
        $(this).parent().parent().find(".image-slider li.active").removeClass("active");
        $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(this).parent().parent().find(".images-count").html( (+index + 2) + " / " + $(this).parent().parent().find(".image-slider li").length);
        
    });

    setInterval(function () {
        var index = $(".auto-slider ul.image-slider > li.active").index();
        if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
            index = -1;
        }

        $(".auto-slider ul.image-slider > li.active").removeClass("active");
        $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 2) + ")").addClass("active");
        $(".auto-slider .images-count").html((+index + 2) + " / " + $(".auto-slider ul.image-slider > li").length);

    }, 40000);
</script>
        
        
    </body>
</html>