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
                        <div class="container-fluid logo-padding-left editorial-logo-align">
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
                                <div class="col-md-12 col-sm-12 col-xs-12 yachts-main-bg">
                                    <div id="listproperties">
                                        <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												@if(!empty($propertiesArr))
												<div id="spa" class="spa-sec-outer-align">
													<div class="container">
														<div class="ai-spa-sec-inner">
															<div class="main-spa-sec-show-area">
																<div class="spa-overlay-text">
																	<blockquote><span id="spas_title"></span>{{$propertiesArr[0]->spa_title}} <br><span id="spas_managertext">{{$propertiesArr[0]->spa_manager_text}}</span></blockquote>

																</div>
																<div id="spas_image1">
																@if($propertiesArr[0]->spa_image1!='')
																<img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->spa_image1),100,1000,null)}}" alt=""/>
																@else
																<img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/SPA-&-WELLNESS.png'),100,1000,null)}}" alt=""/>
																@endif
																</div>
															</div>
															<div class="col-md-6 col-sm-6">
																<div class="row">
																	<div class="spa-left-pannel-align">
																		<p id="spas_desc" class="spa-sec-para-style spa-text-pannel1">{!!  nl2br(e($propertiesArr[0]->spa_desciription)) !!}</p>
																		<div id="spas_image2">
																		@if($propertiesArr[0]->spa_image2!='')
																		<img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->spa_image2),100,500,null)}}" alt=""/>
																		@else
																		<img class="img-responsive main-spa-img-align img-responsive" src="{{ImageCache::make(asset('sximo/assets/images/SPA-&-WELLNESS-2.png'),100,500,null)}}" alt=""/>
																		@endif
																		</div>
																		<div class="spa-left-des-pannel2" id="spas_opening">
																			@if($propertiesArr[0]->spa_opening_hours!='' && $propertiesArr[0]->spa_phone_number )
																			<h4 class="spa-bold-text">OPENING HOURS</h4>
																			<div class="spa-booking-des-text-align">
																				<p class="spa-sec-para-style">{!! nl2br(e($propertiesArr[0]->spa_opening_hours)) !!}</p>
																				<div class="spa-booking-info">
																					<p class="spa-sec-para-style">BOOKINGS:</p>
																					<p class="spa-sec-para-style">Phone: {{$propertiesArr[0]->spa_phone_number}}</p>
																					<p class="spa-sec-para-style"><a class="spa-booking-link" href="#">{{$propertiesArr[0]->spa_url}}</a></p>
																				</div>
																			</div>
																			@endif
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6">
																<div class="row">
																	<div class="spa-description-pannel2">
																		
																	<div id="spas_image3">
																	@if($propertiesArr[0]->spa_image3!='')
																		<img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->spa_image3),100,500,null)}}" alt=""/>
																		@else
																		<img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/Spa-Manager.png'),100,500,null)}}" alt=""/>
																		@endif
																		</div>
																		<div class="spa-products-tittles-align">
																			<div class="col-md-6 col-sm-6">
																				<div class="row" id="spas_image4">
																					@if($propertiesArr[0]->spa_image4!='')
																					<img class="img-responsive main-spa-img-align" src="{{ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$propertiesArr[0]->spa_image4),100,250,null)}}" alt=""/>
																					@else
																					<img class="img-responsive main-spa-img-align" src="{{ ImageCache::make(public_path('sximo/assets/images/Spa-Manager.png'),100,250,null)}}" alt=""/>
																					@endif
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-6">
																				<div class="row">
																					<blockquote class="spa-content-quote">
																						<span id="spas_usptext">{{$propertiesArr[0]->spa_usp_text}}</span>
																						<p class="content-quote-author" id="spas_uspperson">- {{$propertiesArr[0]->spa_usp_person}}</p>
																					</blockquote>
																					@if($propertiesArr[0]->spa_gallery>0)
																						<div class="spa-sec-view-gallery">
																							<span class="view-gallery-border-left"></span>
																							<a href="javascript:void(0);" id="spas_gallery_id" class="detail_view gallerysty bar-view-gallery " rel="{{$propertiesArr[0]->id}}" rel2="Spa Gallery Images">View Gallery</a>
																						</div>
																					@endif
																					<div class="clearfix"></div>
																					<a href="#book-now" class="spa-sec-book-an-appoinment-btn">Book Appointment</a>
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
                                        <form autocomplete="off" method="get" id="spassearchform-navbar" class="spassearchform-navbar ai-ajax-searchform-navbar" action="{{URL::to('search')}}">
                                            <input  class="bh-search-input typeahead spassearch-navbar ai-ajax-search-input" name="rs" id="spassearch-navbar" placeholder="SEARCH" type="text">
                                        </form>
                                    </div>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default custom-post-panel">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="heading-stying collapsed">
                                                <div class="panel-heading custom-heading">
                                                    Hotel Spas
                                                </div>
                                            </a>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body custom-panel-body">
                                                    <div class="dl-filter">
                                                        <form>
															@if(!empty($propertiesArr))
															{{--*/ $spasArr = (object) array(); $spasStr = ""; /*--}}
																@foreach($propertiesArr as $property)
																	{{--*/ 
																	$spasStr .= "'" . str_replace("'","",$property->spa_title) . "',";	$spasArr->spa_title = $property->spa_title; $spasArr->spa_desciription = $property->spa_desciription; $spasArr->spa_manager_text = $property->spa_manager_text; $spasArr->spa_opening_hours = $property->spa_opening_hours; $spasArr->spa_phone_number = $property->spa_phone_number; $spasArr->spa_url = $property->spa_url; $spasArr->spa_usp_person = $property->spa_usp_person; $spasArr->spa_usp_text = $property->spa_usp_text; $spasArr->id = $property->id; $spasArr->property_name = $property->property_name; $spasArr->property_slug = $property->property_slug; /*--}}
																	@if($property->spa_image1!='')
																		{{--*/ $spasArr->spa_image1 = ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$property->spa_image1),100,300,null);  /*--}}
																	@endif
																	
																	@if($property->spa_image2!='')
																		{{--*/ $spasArr->spa_image2 = ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$property->spa_image2),100,500,null) /*--}}
																	@endif
																	
																	@if($property->spa_image3!='')
																		{{--*/ $spasArr->spa_image3 = ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$property->spa_image3),100,500,null) /*--}}
																	@endif
																	
																	@if($property->spa_image4!='')
																		{{--*/ $spasArr->spa_image4 = ImageCache::make(public_path('uploads/properties_subtab_imgs/'.$property->spa_image4),100,500,null) /*--}}
																	@endif
																	<div class="form-group post-filter-inputs">
																		<label><a class="hotelanchordata" id="{{ str_replace('\'','',str_replace(' ','_',$property->spa_title)) }}" href="javascript:void(0);" data-jsondata="{{json_encode($spasArr)}}" data-gallerydata="{{$property->spa_gallery}}">{{$property->spa_title}}</a></label>
																	</div>
															
																@endforeach
															@endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        @if(!empty($sidebardetailAds))
											@foreach($sidebardetailAds as $slides)
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
					
					<div class="modal fade vegasModelFade" id="myModal" role="dialog">
					  <div class="modal-dialog VegasModelDialog">

						<!-- Modal content-->
						<div class="modal-content vegasModelContent">
						  <div class="modal-header vegasModelHeader">
							<button type="button" class="close VegasCloseButton" data-dismiss="modal">&times;</button>
							<a href="#" id="frontpage-layer-bj-header-logo"> <img class="VegasPopLogo" alt="" src="data:image/png;base64,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" class="img-responsive" data-pagespeed-url-hash="2747997174"></a>
							</div>
						  <div class="modal-body">
							  <div class="col-md-2 SlickVegasWidth">
								<section class="Vegasregular slider">
									<div class="slick-cstm-width">
									   <div class="side-nav-next-hotel-img Sidenavimg">
											<div class="side-next-and-perivious-hotel-arrow">
												<div class="arrows-commom  next-arrow">
													<a href="http://www.emporium-voyage.com/hotel-zoo-berlin-">
														<span>New Hotels</span>
													</a>
												</div>
											</div>
											
											<div class="new-hotel-image" style="background-image:url(http://www.emporium-voyage.com/uploads/property_imgs_thumbs/xfront_property_4505_Emporium-Voyage-Hotel-Zoo-Berlin00017.jpg.pagespeed.ic.nY-effTxow.jpg)">
																			<div class="new-hotels-image-tittle">
																					<h2 class="new-hotel-name">Hotel Zoo Berlin </h2>
																					<div class=" new-hotel-add">
																							<p>New York City</p>
																							<p>United States</p>
																					</div>
																			</div>
																			<div class="clearfix"></div>
																			<div class="new-hotel-view-more-btn">
																					<a class="" href="http://www.emporium-voyage.com/hotel-zoo-berlin-" tabindex="0">
																							View Hotel
																					</a>
																			</div>
																	</div>
											
											<a class="bootom-view-next-btn" href="http://www.emporium-voyage.com/hotel-zoo-berlin-">
												Visit All Hotels DOI
											</a>
										</div>
									</div>
									@if(!empty($sidebardetailAds))
									@foreach($sidebardetailAds as $adsdetail)
									<div class="slick-cstm-width">
										<a href="http://{{$adsdetail->adv_link}}"><img src="{{URL::to('uploads/users/advertisement/'.$adsdetail->adv_img)}}"></a>
									</div>
									@endforeach
									@endif					
								</section>

							</div>
							  <div id="frontpage-layer-bj-content" class="col-md-10 vegasGallery1">
									<div class="frontpage-detail-content-top">
										<div class="frontpage-detail-content-top-link">
											<div class="frontpage-detail-content-top-link"> 
											</div>
										</div>
									</div>
								<div class="row masonry-grid vegasgalleryimg">
									
								  </div>
								</div>
							</div>
						</div>

					  </div>
					</div>
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
							
							$(document).on('click', '.hotelanchordata', function () {
								var hotelobj = $(this).data('jsondata');
								$('#spas_title').html(hotelobj.spa_title);
								$('#spas_managertext').html(hotelobj.spa_manager_text);
								$('#spas_desc').html(hotelobj.spa_desciription);
								$('#spas_usptext').html(hotelobj.spa_usp_text);
								$('#spas_uspperson').html(hotelobj.spa_usp_person);
								$('#hotellink').attr("href","{{URL::to('')}}/"+hotelobj.property_slug);
								if(hotelobj.spa_image1!='')
								{
									$('#spas_image1').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image1+'" alt=""/>'); 
								}
								
								if(hotelobj.spa_image2!='')
								{
									$('#spas_image2').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image2+'" alt=""/>'); 
								}
								if(hotelobj.spa_image3!='')
								{
									$('#spas_image3').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image3+'" alt=""/>'); 
								}
								if(hotelobj.spa_image4!='')
								{
									$('#spas_image4').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image4+'" alt=""/>'); 
								}
								if(hotelobj.spa_opening_hours!='' && hotelobj.spa_phone_number!='')
								{
									var openhour = hotelobj.spa_opening_hours;
									var html3 = '';
									html3 += '<h4 class="spa-bold-text">OPENING HOURS</h4>';
									html3 += '<div class="spa-booking-des-text-align">';
									html3 += '<p class="spa-sec-para-style">'+openhour.replace("/\n/g","<br>")+'</p>';
									html3 += '<div class="spa-booking-info">';
									html3 += '<p class="spa-sec-para-style">BOOKINGS:</p>';
									html3 += '<p class="spa-sec-para-style">Phone: '+hotelobj.spa_phone_number+'</p>';
									html3 += '<p class="spa-sec-para-style"><a class="spa-booking-link" href="#">'+hotelobj.spa_url+'</a></p>';
									html3 += '</div></div>';
									$('#spas_opening').html(html3);
								}
								
								if($(this).data('gallerydata') > 0)
								{
									$('#spas_gallery_id').attr('rel',hotelobj.id);
									$('#spas_gallery_id').show();
								}
								else
								{
									$('#spas_gallery_id').hide();
								}
							});
							
							$(document).on('click', '.detail_view', function () {
								$.ajax({
									url: "{{ URL::to('getpropertygallery')}}" + '/' + $(this).attr('rel') + '/' + $(this).attr('rel2'),
									type: "get",
									success: function (data) {
										var imagesPro = '';
										var im=0;
										var di=1;
										var lngimg = Math.round((data.image.length)/3);
										imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
										$(data.image).each(function (i, val) {
											var clsact = '';
											
											imagesPro += '  <div>';
											imagesPro += '	<a href="#" class="thumbnail vogasThumbnail"><img class="img-responsive" src="' + val.imgsrc_cache + '"></a>';
											imagesPro += '  </div>';
											if(di==lngimg)
											{
												di=0;
												imagesPro += ' </div>';
												imagesPro += '<div class="col-md-6 col-lg-4 masonry-column">';
											}
											
											im++;
											di++;
										});
										imagesPro += ' </div>';
										$('#myModal .vegasgalleryimg').html(imagesPro);
										$('#myModal').modal('show');
									}
								});
								return false;
							});

							$(document).on('click', '.frontpage-layer-bj-header-close', function () {
								$('.frontpage-layer-bj').fadeOut('slow');
								$('html').removeClass('hidescroll');
							});
							
							$('.spassearch-navbar').on('typeahead:selected', function (e, datum) {
								var propname = $(this).val();
								var rname = propname.replace(' ', '_');
								var hotelobj = $('#'+rname).data('jsondata');
								$('#spas_title').html(hotelobj.spa_title);
								$('#spas_managertext').html(hotelobj.spa_manager_text);
								$('#spas_desc').html(hotelobj.spa_desciription);
								$('#spas_usptext').html(hotelobj.spa_usp_text);
								$('#spas_uspperson').html(hotelobj.spa_usp_person);
								$('#hotellink').attr("href","{{URL::to('')}}/"+hotelobj.property_slug);
								if(hotelobj.spa_image1!='')
								{
									$('#bars_image1').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image1+'" alt=""/>'); 
								}
								
								if(hotelobj.spa_image2!='')
								{
									$('#bars_image2').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image2+'" alt=""/>'); 
								}
								if(hotelobj.spa_image3!='')
								{
									$('#bars_image2').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image3+'" alt=""/>'); 
								}
								if(hotelobj.spa_image4!='')
								{
									$('#bars_image2').html('<img class="img-responsive img-width" src="'+hotelobj.spa_image4+'" alt=""/>'); 
								}
								if(hotelobj.spa_opening_hours!='' && hotelobj.spa_phone_number!='')
								{
									var openhour = hotelobj.spa_opening_hours;
									var html3 = '';
									html3 += '<h4 class="spa-bold-text">OPENING HOURS</h4>';
									html3 += '<div class="spa-booking-des-text-align">';
									html3 += '<p class="spa-sec-para-style">'+openhour.replace("/\n/g","<br>")+'</p>';
									html3 += '<div class="spa-booking-info">';
									html3 += '<p class="spa-sec-para-style">BOOKINGS:</p>';
									html3 += '<p class="spa-sec-para-style">Phone: '+hotelobj.spa_phone_number+'</p>';
									html3 += '<p class="spa-sec-para-style"><a class="spa-booking-link" href="#">'+hotelobj.spa_url+'</a></p>';
									html3 += '</div></div>';
									$('#spas_opening').html(html3);
								}
								
								if($('#'+rname).data('gallerydata') > 0)
								{
									$('#spas_gallery_id').attr('rel',hotelobj.id);
									$('#spas_gallery_id').show();
								}
								else
								{
									$('#spas_gallery_id').hide();
								}
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
<script>
	var substringSpas = function(strs) {
	  return function findRestrorants(q, cb) {
		var spas, substringRegex;
		spas = [];
		substrRegex = new RegExp(q, 'i');

		$.each(strs, function(i, str) {
		  if (substrRegex.test(str)) {
			spas.push(str);
		  }
		});

		cb(spas);
	  };
	};

	var spas = [{!! substr($spasStr, 0, -1) !!}];

	$('.spassearchform-navbar .typeahead').typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'spas',
	  source: substringSpas(spas)
	});
</script>