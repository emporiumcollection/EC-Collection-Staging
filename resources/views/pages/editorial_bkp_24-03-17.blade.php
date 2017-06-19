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
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}"></script>
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/testimoniales.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/image-slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m_slider.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/editorial-slide-nav.js')}}" type="text/javascript"></script>

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
        </style>
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
										<a href="#rooms">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS' }}</a>
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
                            <div class="side-nav-next-hotel-img">
                                    <div class="side-next-and-perivious-hotel-arrow">
<!--                                        <div class="arrows-commom">
                                            <a href="javascript:void(0);">
                                                <div>
                                                    <img alt="" src="http://design-locations.biz/sximo/assets/images/editorial-left-arrow.png">
                                                </div>
                                                <span> Previous hotel</span>
                                            </a>
                                        </div>-->
                                        <div class="arrows-commom  next-arrow">
                                            <a href="javascript:void(0);">
                                                <div>
                                                    <img alt="" src="http://design-locations.biz/sximo/assets/images/editorial-right-arrow.png">
                                                </div>
                                                <span>Next hotel</span>
                                            </a>
                                        </div>
                                    </div>
                                    <img class="img-responsive" src="http://design-locations.biz/uploads/container_user_files/locations/miss-clara-by-nobis/property-images/Miss-Clara-by-Nobis-Stockholm-Sweden (11).jpg" alt="">
                                     <div class="side-nav-next-hotel-text">Miss Clara by Nobis</div>
                                </div>
                        </div>
                    </div>
                </div>
                <span class="hamburger-menu editorial-res-side-nav-logo"  onclick="openNav()"><img src="{{ asset('sximo/assets/images/Hamburger-Menu.png')}}" alt=""/></span>
                <div class="clerafix"></div>
                <!--Slider start here-->
                @if(!empty($propertyDetail)) 
                <div class="row">
                    @if (array_key_exists('propimage', $propertyDetail))
                    <div class="m_slider editorial_m_slider">
                        @if(!empty($propertyDetail['propimage']))
                        <ul>
                            @foreach($propertyDetail['propimage'] as $propimg)
                            <li class="{{($propertyDetail['propimage'][0]==$propimg) ? 'active' : ''}}">
                                <div class="image editorial-image">
                                    <img src="{{ $propimg->imgsrc.$propimg->file_name }}" alt=""/>
                                </div>

                                <div class="editorial-text">
                                    <div class="editor-picks-small-text">{{$propertyDetail['data']->property_name}}</div>
                                    <div class="description-bold-text">{{ (strlen($propertyDetail['data']->about_property) > 100) ? substr($propertyDetail['data']->about_property,0,100) : $propertyDetail['data']->about_property }}</div>
                                    <!--end slide -->
                                </div>
                            </li>
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
						<!--Next Section-->
                        @if (array_key_exists('typedata', $propertyDetail))
							<div class="row- pub-page-sec-2" id="hotel">
								<section id="interna" class="container-fluid">

								</section>


								<section class="container-fluid">
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
													<a href="#" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
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
									
                                    @foreach($propertyDetail['typedata'] as $key=>$type)
                                    @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                    {{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]); /*--}}
                                    <li class="{{($propertyDetail['typedata'][0]==$type) ? 'active' : ''}}">
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
                                                                <div class="expeience-small-text">Experience</div>
                                                                <div class="slider-side-text-tittle">{{$type->category_name}}</div>
                                                                <div class="slider-side-description-text">
                                                                    {{(strlen($type->room_desc) > 300) ? substr($type->room_desc,0,300).'...':$type->room_desc}}
                                                                </div>
                                                            </div>
                                                            <div>
															@if(end($propertyDetail['typedata'])==$type)
                                                                <img class="slider-next-image-btn img-responsive" src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][0]->id][0]->imgsrc.$propertyDetail['roomimgs'][$propertyDetail['typedata'][0]->id][0]->file_name}}" alt=""/>
															@else
																<img class="slider-next-image-btn img-responsive" src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key+1]->id][0]->imgsrc.$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key+1]->id][0]->file_name}}" alt=""/>
															@endif
                                                                <a href="#" style="margin-left:100px;" rel="{{$type->id}}" class="book-button open-show_more-page hotel-btn">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
									
                                    @endforeach
                                </ul>
                                <div class=" editorial-images-count images-count">1 / {{$totimg}}</div>
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
                        <!--Hotels Section-->
                        <div id="dl_hotel_sec" class="dl_hotel-sec-bg">
                            <div class="container">
                                <div class="row">
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="col-md-6 col-sm-6 hotels-des-left-side">
                                                <div class="hotels-detail-heading-text">
                                                    <p>{{$propertyDetail['data']->detail_title1}}</p>
                                                </div>
                                                <div class="hotels-detail-description-text">
                                                    <p>
                                                        {{$propertyDetail['data']->detail_description1}}
                                                    </p>
                                                </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 hotels-showcase-right-side">
                                                <div class="hotels-image-showcase-des-text">
                                                    <p>
                                                        {{$propertyDetail['data']->detail_description2}}
                                                        <br>
<!--                                                        <span class="pull-right">Situated in Norrmalm</span>-->
                                                    </p>
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
			<!--Hotel Section Block Two-->
                        <div class="hotel-sec-block-two">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="hotel-block-two-left-sec-align">
                                            <h2>Miss clara by nobis</h2>
                                            <p>
                                                This family-friendly Greif Luxury Hotel Bolzano lodge is situated close to
                                                the airport, simply steps from Cathedral of Bolzano and Piazza Walther.
                                                Museo Archeologico dell’Alto Adige and Renon Cable Automotive are additionally
                                                inside 15 minutes. Together with a restaurant, this lodge has an outside pool
                                                and a health middle. Free buffet breakfast and free WiFi in public areas are
                                                additionally supplied.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="hotel-block-two-right-sec-align">
                                            <p>
                                                This family-friendly Greif Luxury Hotel Bolzano lodge is situated close to
                                                the airport, simply steps from Cathedral of Bolzano and Piazza Walther.
                                                Museo Archeologico dell’Alto Adige and Renon Cable Automotive are additionally
                                                inside 15 minutes. Together with a restaurant, this lodge has an outside pool
                                                and a health middle. Free buffet breakfast and free WiFi in public areas are
                                                additionally supplied.
                                            </p>
                                            <div class="hotel-block-two-btn-right">
                                                <a href="#">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
			<!--Hotel Section Block Two End Here-->
                        <!--next sec-->
                        @if($propertyDetail['data']->restaurant_title!='' && $propertyDetail['data']->restaurant_desciription!='')
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
                                                    <span class="text-color">To succeed</span> in your mission, you must have single-minded devoation
                                                    to your goal.
                                                </div>
                                                <div class="written-by-text">
                                                    -Le corbusier
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
                                            <p><a href="#" class="detail_view gallerysty" rel="{{$propertyDetail['data']->id}}" rel2="Restrurants Gallery Images"><i class="fa fa-file-image-o"></i> View Gallery</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--Next-section-->
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
                                            <p><a href="#" class="detail_view gallerysty" rel="{{$propertyDetail['data']->id}}" rel2="Spa Gallery Images"><i class="fa fa-file-image-o"></i> View Gallery</a></p>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6">
                                                <a href="#" class="spa-sec-book-an-appoinment-btn">Book an Spa appointment > </a>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <p class="spa-first-side-btn-text">{{$propertyDetail['data']->spa_usp_text}}
                                                </p>
                                                <div class="spa-first-sec-sign">{{$propertyDetail['data']->spa_usp_person}}</div>
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
                        <div class="editorial-book-now-page" id="book-now" style="margin-top: 60px;">

                            <div class="book-now-page-content-">
                                <div class="editoral-book-page-headings">
                                    <h2>Design Location is your ideal, vogue vacation planner!</h2>
                                    <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Design Locations ensure the ultimate luxury experience</p>
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
                                <!--<div class="btns">
                                           <div>
                                                   <a class="prev" href="#">
                                                           <img src="http://design-locations.biz/sximo/assets/images/left-arrow-white.png" alt=""/>
                                                   </a>
                                                   <a class="next" href="#">
                                                           <img src="http://design-locations.biz/sximo/assets/images/right-arrow-white.png" alt=""/>
                                                   </a>
                                                   <div class="clearfix"></div>
                                           </div>
                                           <span>NEXT HOTEL</span>
                                           <span class="border"></span>
                                   </div>-->
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
											<a href="#rooms">{{ ($propertyDetail['data']->property_type=='Yachts') ? 'CABINS' : 'ROOMS' }}</a>
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
                                <div class="side-nav-next-hotel-img">
                                    <div class="side-next-and-perivious-hotel-arrow">
<!--                                        <div class="arrows-commom">
                                            <a href="javascript:void(0);">
                                                <div>
                                                    <img alt="" src="http://design-locations.biz/sximo/assets/images/editorial-left-arrow.png">
                                                </div>
                                                <span> Previous hotel</span>
                                            </a>
                                        </div>-->
                                        <div class="arrows-commom  next-arrow">
                                            <a href="javascript:void(0);">
                                                <div>
                                                    <img alt="" src="http://design-locations.biz/sximo/assets/images/editorial-right-arrow.png">
                                                </div>
                                                <span>Next hotel</span>
                                            </a>
                                        </div>
                                    </div>
                                    <img class="img-responsive" src="http://design-locations.biz/uploads/container_user_files/locations/miss-clara-by-nobis/property-images/Miss-Clara-by-Nobis-Stockholm-Sweden (11).jpg" alt="">
                                     <div class="side-nav-next-hotel-text">Miss Clara by Nobis</div>
                                </div>
<!--                                <div class="next-hotel-side-sec-align">
                                    <div class="next-hotel-side-image">
                                        <img class="img-responsive" src="http://design-locations.biz/uploads/container_user_files/locations/miss-clara-by-nobis/property-images/Miss-Clara-by-Nobis-Stockholm-Sweden (11).jpg" alt="">
                                    </div>
                                    <div class="next-hotel-text">
                                        Miss Clara by Nobis
                                    </div>
                                </div>-->
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
                                scrollTop: (target.offset().top)
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
                $('.single-right-text-product').html('');
                $('.rmimgp').html('');
                $.ajax({
                    url: "{{ URL::to('getpropertytypedetail')}}" + '/' + $(this).attr('rel'),
                    type: "get",
                    success: function (data) {
                        var rimg = data.roomimgs.imgsrc + data.roomimgs.file_name;
//                        $('.rmimgp').html('<img class="img-responsive" src="' + rimg + '" alt="' + data.roomimgs.file_name + '" />');
                        $('.rmimgp').html('<div class="right-text-section"></div><div class="right-hotel-prive"><div class="hotel-book-price">$500</div></div>');
                        var imagesPro = '';
                        imagesPro += '<div class="text-section">';
                        imagesPro += '<h2>' + data.typedata.category_name + '</h2>';
                        imagesPro += '<p>' + data.amenities.amenities_eng.replace(/\n/g, "<br />") + '</p>';
                        imagesPro += '<p>' + data.typedata.room_desc + '</p>';
                        imagesPro += '</div>';
                        imagesPro += '<div class="book-btn-sec">';
                        imagesPro += '<div class="inner-pop-up-book-btn">';
                        imagesPro += '<a href="#">Book</a>';
                        imagesPro += '</div>';
                        imagesPro += '</div>';
                        $('.single-right-text-product').html(imagesPro);
                    }
                });
                return false;
            });
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
        <script>
            function openNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "0";
            }
        </script>