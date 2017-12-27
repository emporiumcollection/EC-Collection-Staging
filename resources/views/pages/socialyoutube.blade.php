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
        <link href="{{ asset('sximo/assets/css/test-res.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/sticky-nav.css')}}" rel="stylesheet" type="text/css"/> 
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/image-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick-theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/slick.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/theme.css')}}" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery2.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/uikit.js')}}"></script>

        <!--JS Includes-->

        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/sticky-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/active-nav.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/slick.js')}}" type="text/javascript"></script>
        <!--Filters Grid Page-->
        <link href="{{ asset('sximo/assets/css/footer-accordian.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filter-bar.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/ai_yachts-custom.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/cities-filter.css')}}" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		@if(isset($_GET['ref']) && $_GET['ref']=='oc' )
		<?php $thumbnail = asset('sximo/assets/images/our_collection.png'); ?>
	   @endif
	   @if(isset($_GET['ref']) && $_GET['ref']=='syd' )
		<?php $thumbnail =  asset('sximo/assets/images/select_your_destination.png'); ?>
	   @endif
	   @if(isset($_GET['ref']) && $_GET['ref']=='sye' )
		 <?php $thumbnail = asset('sximo/assets/images/selec_your_exprince.png'); ?>
	   @endif
	   @if(isset($_GET['ref']) && $_GET['ref']=='sbd' )
		<?php $thumbnail = asset('sximo/assets/images/search_by.png'); ?>
	   @endif 
		@if(isset($_GET['ref']))
		<script>
			jQuery(document).ready(function($) {
				$("#back_button_page").tooltip({ content: '<img src="{{$thumbnail}}"/>' });
				$(document).on('click','#back_button_page',function(){
					location.href = "{{url('/')}}?ref={{$_GET['ref']}}";
					return fasle;
				});
			});
		</script>
		@endif
		
		<script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>
		
        <style>
            .FltRgt { 
                float:right; cursor:pointer; 
            }
            .FltLft {
                float:left;
            }
            .MrgTop5 {
                margin-top:5px !important; 
            }
            .carticon {
                float:right; margin-left:5px;
            }
        </style>
        <style>
            .sidenavpost .bh-search-input
            {
                padding-left: 0px !important;
            }

            .sidenavpost .tt-menu
            {
                left: 0% !important;
                color:#fff !important;
            }

            .sidenavpost a
            {
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn
            {
                font-size: 36px !important;
            }
            #yachts-refine-search-filter input, .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }
            .filter-by-price > select {
                background-color: #dadad5;
                border: 1px solid #333;
                margin-right: 5px;
                width: calc(50% - 7px);
            }
            .filter-by-price > select option {
                padding: 10px 5px;
            }
            .filter-fw-select {
                background-color: #2e2e2e;
                border: 1px solid #5f5f5f;
                border-radius: 0;
                color: #fff;
                width: 100%;
            }
            .filter-fw-select > option {
                min-height: 26px;
                padding: 5px;
            }
            .current-page-heading {
                font-family: serif;
                font-size: 18px;
                font-style: italic;
            }
        </style>
        <style>
            .sidenavpost .bh-search-input
            {
                padding-left: 0px !important;
            }

            .sidenavpost .tt-menu
            {
                left: 0% !important;
                color:#fff !important;
            }

            .sidenavpost a
            {
                padding: 0 !important;
                font-size: 14px !important;
            }
            .sidenavpost .closebtn
            {
                font-size: 36px !important;
            }
            .black-submit-btn {
                background-color: transparent;
                border: 1px solid #505050;
                padding: 5px;
                text-align: center;
                width: 100%;
            }
            
            .slick-prev, .slick-next {
                color: #fff;
                height: auto;
                padding: 0;
                position: absolute;
                width: 20px;
            }
/*            .top-slick-filtes {
                width: 80%;
            }*/
            .slick-prev::before, .slick-next::before {
                color: #fff;
                font-size: 26px;
                font-weight: bold;
                line-height: 1;
                opacity: unset;
            }
            .top-nav-cities-filter .slick-prev, .slick-next {
                background-color: #322e2e;
                height: 100%;
                width: 80px;
            }
            .top-nav-cities-filter .slick-prev, .slick-next:hover, .top-nav-cities-filter .slick-prev, .slick-next:focus, .top-nav-cities-filter .slick-prev, .slick-next:active {
                background-color: #322e2e;
            }
/*            .top-slick-filtes .slick-next {
                right: -85px;
            }
            .top-slick-filtes .slick-prev {
                left: -85px;
            }
            .top-slick-filtes .slick-prev.slick-arrow.slick-disabled, .top-slick-filtes .slick-next.slick-arrow.slick-disabled  {
                background-color: #aaa9a9;
            }*/
            #cityfilters .slick-slide {
                height: auto;
            }
            .row.go-back-button-container{margin-left: 0; margin-right: 0;}
            .overlay-text {
                background: rgba(0, 0, 0, 0.68) none repeat scroll 0 0;
                bottom: 0;
                display: none;
                padding: 30px 10px;
                position: absolute;
                text-align: center;
                top: 0;
                width: 100%;
            }
            .overlay-text .yacts-tittle-text, .overlay-text-frezeed .yacts-tittle-text{
                font-family: serif;
                border-bottom: 3px solid #f3bc3a;
                color: #fff;
                display: inline-block;
                font-size: 20px;
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;
            }
            .yacths-des-text {
                color: #fff;
                font-size: 18px;
                margin: 0;
            }
            .yacths-des-text-align {
                margin-top: 20px;
            }
            .yacths-des-text span {
                padding: 0px 5px;
            }
            .cat_product_medium1:hover .overlay-text {
                display: block;
            }
            .cat_product_medium1:hover .overlay-text-frezeed {
                display: none;
            }
            .overlay-text-frezeed {
                background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0;
                bottom: 0;
                left: 0;
                padding-top: 88px;
                position: absolute;
                right: 0;
                text-align: center;
                top: 0;
            }
            .overlay-text-frezeed .yacts-tittle-text {
                border: medium none;
                font-size: 16px;
            }
            .overlay-text-frezeed .yacths-des-text.yacths-des-text-align {
                font-size: 14px;
                margin-top: 2px;
            }
            .cat_product_medium1:hover .gridPicture {
                transform: scale(1.06);
                transition: all 0.2s ease-out 0s;
            }
            .cat_product_medium1 {
                overflow: hidden;
            }
            
            /* Harman AIC menu css */
            
            .voyagemenuTop {
                    color: #6e6e6e !important;
                    border-bottom: 3px transparent solid !important;
                    padding: 0px 35px 15px 35px !important;
            }
            
            .vogasMenuUl {
                margin: 20px 0px 0px 70px;
                height: 0px;
            }
            
            .voyagemenuTop:hover {
                border-bottom: 3px #6E6E6E solid !important;
                padding: 0px 35px 15px 35px !important;
            }
            
            /* model search */

        #search {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);

            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;

            -webkit-transform: translate(0px, -100%) scale(0, 0);
            -moz-transform: translate(0px, -100%) scale(0, 0);
            -o-transform: translate(0px, -100%) scale(0, 0);
            -ms-transform: translate(0px, -100%) scale(0, 0);
            transform: translate(0px, -100%) scale(0, 0);

            opacity: 0;
        }

        #search.open {
            -webkit-transform: translate(0px, 0px) scale(1, 1);
            -moz-transform: translate(0px, 0px) scale(1, 1);
            -o-transform: translate(0px, 0px) scale(1, 1);
            -ms-transform: translate(0px, 0px) scale(1, 1);
            transform: translate(0px, 0px) scale(1, 1); 
            opacity: 1;
            z-index: 9999;
        }

        #search input[type="text"] {
            position: absolute;
            top: 50%;
            width: 100%;
            color: rgb(255, 255, 255);
            background: rgba(0, 0, 0, 0);
            font-size: 60px;
            font-weight: 300;
            text-align: center;
            border: 0px;
            margin: 0px auto;
            margin-top: -51px;
            padding-left: 30px;
            padding-right: 30px;
            outline: none;
        }
        #search .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: 61px;
            margin-left: -45px;
        }
        #search .close {
            position: fixed;
            top: 15px;
            right: 15px;
            color: #fff;
            background-color: black;
            border-color: #357ebd;
            opacity: 1;
            padding: 10px 17px;
            font-size: 27px;
        }

        .modelSearchi {
            color: #9f9f9f;
            font-size: 16px;
        }

        .popupa {
            margin-top: 16px !important;
            float: left;
            margin-left: 4px;
        }
        
        .popupa:hover {
            border: none !important;
        }
    
    /* Harman AIC css end */
            
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
                    <header>
                        <div class="container-fluid editorial-logo-align">
                             <div class="row">
                                @if(isset($_GET['ref']) && $_GET['ref']!='' )
                                    <button class="go-back-button" id="back_button_page">Go Back</button> 
                                    
                                @else
                                    <button class="go-back-button" onclick="goBack()">Go Back</button>
                                @endif       
                            </div>
                        </div>
                    </header>
                    <div class="filter-page-main-align">
                        <div class="col-md-10 col-sm-9">
                            <div class="row">
                                <!--div class="header container-fluid">
									<div class="col-md-12">
										<div class="header-logo">
											<a href="{{url()}}">
												<img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" class="img-responsive" alt="Emporium Yachts."/>
											</a>
										</div>
									</div>
                                </div-->
								<div class="header-navigation-container col-md-12">
									<div class="row">
                                                                            <!-- Harman AIC header mennu start  -->
                                                                                <nav class="navbar navbar-inverse">
                                                                                    <div class="container">
                                                                                      <!-- Brand and toggle get grouped for better mobile display -->
                                                                                      <div class="navbar-header">
                                                                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
                                                                                          <span class="sr-only">Toggle navigation</span>
                                                                                          <span class="icon-bar"></span>
                                                                                          <span class="icon-bar"></span>
                                                                                          <span class="icon-bar"></span>
                                                                                        </button>
<!--                                                                                        <a class="navbar-brand" href="#">Brand</a>-->
                                                                                      </div>

                                                                                      <!-- Collect the nav links, forms, and other content for toggling -->
                                                                                      <div class="collapse navbar-collapse collpsemenuVoyage" id="navbar-collapse-3">
                                                                                        <ul class="nav navbar-nav vogasMenuUl">
                                                                                            <li><a class="voyagemenuTop" href="#">UBERSICHT</a></li>
                                                                                          <li><a class="voyagemenuTop" href="#">VIDEOS</a></li>
                                                                                          <li><a class="voyagemenuTop" href="#">PLAYLISTS</a></li>
                                                                                          <li><a class="voyagemenuTop" href="#">KANALE</a></li>
                                                                                          <li><a class="voyagemenuTop" href="#">DISKUSSION</a></li>
                                                                                          <li><a class="voyagemenuTop" href="#">KANALINFO</a></li>
                                                                                          <li class="BlockLi">
                                                                                            <a class="popupa" href="#search">
                                                                                                <i class="fa fa-search modelSearchi" aria-hidden="true"></i>
                                                                                            </a>
                                                                                          </li>
                                                                                          <div id="search">
                                                                                            <button type="button" class="close"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                                                                <form>
                                                                                                    <input type="text" value="" placeholder="Search Here" />
                                                                                                    <!--                                <button type="submit" class="btn btn-primary popUpSubmit">Search</button>-->
                                                                                                </form>
                                                                                          </div>
                                                                                        </ul>
                                                                                      </div><!-- /.navbar-collapse -->
                                                                                    </div><!-- /.container -->
                                                                                  </nav><!-- /.navbar -->
                                                                            <!-- Harman AIC header mennu end  -->
										<div class="col-md-0"></div>
										<div class="col-md-3 col-sm-2 header-text-align">
										</div>
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
																	$social_destination = SiteHelpers::menus('social_destination');
																	if(!empty($social_destination)) {
																		foreach ($social_destination as $gmenu) {
																			?>
																			<li class="<?php echo (isset($type) && $type == $gmenu['menu_name'])? 'active' : ''; ?>">
																				<a href="<?php echo ($gmenu['menu_type'] =='external')? URL::to($gmenu['url']) : URL::to($gmenu['module']); ?>" >
																				<?php
																				if(CNF_MULTILANG ==1 && isset($gmenu['menu_lang']['title'][Session::get('lang')])) {
																					echo $gmenu['menu_lang']['title'][Session::get('lang')];
																				}
																				else {
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
									</div>
								</div>
                                <div class="sticky-header-offset"></div>
								
                                <div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
                                    <div id="listproperties">
                                        <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												@if($channel_url!='')
													<div data-yt data-yt-channel="{{ $channel_url }}" data-yt-content-columns="4"  data-yt-content-rows="3"></div>
												@endif
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="filter-grid-page-side-bar">
                                <div class="filters-gird-page-side-bar-filter-align">
                                    <div class="design-locations-logo">
                                        <a href="{{URL::to('')}}"> <img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}" alt=""></a>

                                    </div>
                                    <div class="design-locations-logo filters-page-serch-bar-align">
                                        <form autocomplete="off" method="get" id="searchform-navbar" class="searchform-navbar ai-ajax-searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead search-navbar ai-ajax-search-input" name="s" id="search-navbar" placeholder="SEARCH" type="text">
                                            <input class="yacht_keywords" type="hidden" />
                                            <input class="hidden" type="submit" />
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        @if(!empty($ourmaindesitnation))
											<div class="panel panel-default custom-post-panel">
												<a data-toggle="collapse" data-parent="#accordion" href="#maindestinations" class="heading-stying {{($continent!='') ? '' : 'collapsed' }}">
													<div class="panel-heading custom-heading">
														Destination Channels
													</div>
												</a>
												<div id="maindestinations" class="panel-collapse collapse {{($continent!='') ? 'in' : '' }}">
													<div class="panel-body custom-panel-body">
														<div class="dl-filter">
															<!--First Parent-->
															@foreach($ourmaindesitnation as $mndest)
															<div class="node post-filter-inputs">
																<a class="node-btn" href="{{URL::to('social-youtube?continent='.$mndest->category_name.'&scy='.$mndest->category_name)}}">{{$mndest->category_name}}</a>
																@if(array_key_exists('childs',$mndest) && !empty($mndest->childs))
																	@foreach($mndest->childs as $cddest)
																	<div class="node" style="{{($continent==$mndest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
																		<a class="node-btn" href="{{URL::to('social-youtube?continent='.$mndest->category_name.'&region='.$cddest->category_name.'&scy='.$cddest->category_name)}}">{{$cddest->category_name}}</a>
																		@if(array_key_exists('subchild',$cddest))
																			@foreach($cddest->subchild as $sbdest)
																			<div class="node" style="{{($region==$cddest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
																				<a class="node-btn" href="{{URL::to('social-youtube?continent='.$mndest->category_name.'&region='.$cddest->category_name.'&country='.$sbdest->category_name.'&scy='.$sbdest->category_name)}}">{{$sbdest->category_name}}</a>
																				@if(array_key_exists('citychild',$sbdest))
																					@foreach($sbdest->citychild as $ctydest)
																					<div class="node" style="{{($country==$sbdest->category_name) ? 'display: block; padding-left: 10px; margin-top: 5px; text-transform: inherit;' : '' }}">
																						<a class="node-btn" href="{{URL::to('social-youtube?continent='.$mndest->category_name.'&region='.$cddest->category_name.'&country='.$sbdest->category_name.'&scy='.$ctydest->category_name)}}">{{$ctydest->category_name}}</a>
																					</div>
																					@endforeach
																				@endif
																			</div>
																			@endforeach
																		@endif
																	</div>
																	@endforeach
																@endif
															</div>
															@endforeach
														</div>
													</div>
												</div>
											</div>
                                        @endif
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
                                                        <p>At any hotel, upon avialability</p>
                                                    </li>
                                                    <li>
                                                        <h3>Upto 50% off at New Hotels</h3>
                                                        <p>Exclusive community invitations</p>
                                                    </li>
                                                    <li>
                                                        <h3>Free WiFi</h3>
                                                        <p>Gurranted at all Hotels</p>
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
                    <div class="clearfix"></div>
                    
                     /*
             * search popup
             */
             <script>
            $(function () {
                $('a[href="#search"]').on('click', function (event) {
                    event.preventDefault();
                    $('#search').addClass('open');
                    $('#search > form > input[type="text"]').focus();
                });

                $('#search, #search button.close').on('click keyup', function (event) {
                    if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                        $(this).removeClass('open');
                    }
                });

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
                    <script>
                        $(document).ready(function () {
                        $(document).on('click', '.top-bar-filters li.select-all', function () {
                        if ($(this).hasClass("active")) {
                        $('.top-bar-filters li').addClass("active");
                        $(this).removeClass("active");
                        } else {
                        $('.top-bar-filters li').removeClass("active");
                        $(this).addClass("active");
                        }
                        });
                        $(document).on('click', '.top-bar-filters li', function () {
                        if (!$(this).hasClass("select-all")) {
                        $(this).toggleClass("active");
                        $('.top-bar-filters li.select-all').removeClass("active");
                        }
                        });
                        $(document).on('click', '.clear-all-filters a', function (event) {
                        event.preventDefault();
                        $('.top-bar-filters li').removeClass("active");
                        $('.top-bar-filters li.select-all').addClass("active");
                        });
                        $('.top-nav-cities-filter').slick({
                        slide: 'li',
                                dots: false,
                                infinite: false,
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                cssEase: 'ease-out',
                                variableWidth: false,
                                responsive: [
                                {
                                breakpoint: 1024,
                                        settings: {
                                        slidesToShow: 3,
                                                slidesToScroll: 1,
                                        }
                                },
                                {
                                breakpoint: 600,
                                        settings: {
                                        slidesToShow: 2,
                                                slidesToScroll: 1
                                        }
                                },
                                {
                                breakpoint: 480,
                                        settings: {
                                        slidesToShow: 1,
                                                slidesToScroll: 1,
                                                arrows:false,
                                        }
                                }
                                ]
                        });
                        
                        });
                        
                    </script>
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
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        if (document.getElementById("mySidenavpost").style.width == "400px") {
                        return closeNavpost();
                        }
                        }
                        return openNavpost();
                        }
                        function openNavpost() {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "400px";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        else{
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }
                        }
                        function closeNavpost() {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        window.onload = function () {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        setTimeout(function () {
                        if ($(window).width() >= 768) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        document.body.style.backgroundColor = "white";
                        document.body.style.transition = "all 0.5s ease 0s";
                        }
                        }, 10000);
                        };
                        if ($(window).width() <= 767) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "100%";
                        }
                        document.getElementById("main").style.marginRight = "250px";
                        }

                        $(document).on('click', function (event) {
                        if ($(window).width() <= 767) {
                        if ($(event.target).has('.filter-width').length) {
                        if (document.getElementById("mySidenavpost").lenght > 0) {
                        document.getElementById("mySidenavpost").style.width = "0";
                        }
                        document.getElementById("main").style.marginRight = "0";
                        }
                        }
                        });
                    </script>
                    <script>
                        $(".node-btn").click(function(){
                        $(this).parent().find("> .node").toggle();
                        $(this).parent().find("> .node").css({"padding-left": "10px", "margin-top": "5px", "text-transform": "inherit"});
                        $(this).parent().find("> .node > a").css({"text-transform": "none"});
                        });
                    </script>

                    <link href="{{ asset('sximo/assets/css/editorial.css')}}" rel="stylesheet" type="text/css"/>
                    <div class="editorial-custom-footer-style grid-page-footer-align">
                        @include('layouts/elliot/ai_footer_social')
                    </div>
