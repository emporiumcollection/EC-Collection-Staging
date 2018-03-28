@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')

    @if(!empty($propertyDetail))
        @if (array_key_exists('propimage', $propertyDetail))
            @if(!empty($propertyDetail['propimage']))
                <!-- Restaurant slider starts here -->
                <section class="luxuryHotelSlider">
                    <div id="myCarousel" class="carousel" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($propertyDetail['propimage'] as $propimg)
                                {{--*/ $thactualsize = getimagesize($propertyDetail['propimage_containerpath'].$propimg->file_name); /*--}}
                                @if($thactualsize[0]>$thactualsize[1])
                                    <div class="item {{($propertyDetail['propimage'][0]==$propimg) ? 'active' : ''}}">
                                        <img src="{{$propertyDetail['propimage_thumbpath'].$propimg->file_name}}"
                                             alt="{{$propertyDetail['data']->property_name}}">
                                        <div class="carousel-caption">
                                            <h1>{{$propertyDetail['data']->property_name}}</h1>
                                            <p>{{ $propertyDetail['data']->property_usp }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                        </a>
                    </div>
                    <span class="scrollNextDivHotel"><a href="#hotelInfo">Scroll Down</a></span>
                </section>
            @endif
        @endif


        <!-- HAM YARD HOTEL -->
        <section id="hotelInfo" class="HamYardHotelSection">
            <div class="HamYardHotelInner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <h2>{{$propertyDetail['data']->detail_section1_title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section1_description_box1) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rightPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section1_description_box2) !!}</p>
                                <a class="viewRooms scrollpage" href="#roomsSuit">View Rooms</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HAM YARD HOTEL -->
        <section class="HamYardHotelSection">
            <div class="HamYardHotelInner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <h2>{!! nl2br($propertyDetail['data']->detail_section2_title) !!}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leftPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section2_description_box1)!!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rightPaddingSec">
                                <p>{!! nl2br($propertyDetail['data']->detail_section2_description_box2) !!}</p>
                                <div class="image-showcase-below-big-text">{{$propertyDetail['data']->assign_detail_city}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if (array_key_exists('typedata', $propertyDetail))
            <!-- hotel slider 1 -->
            @foreach($propertyDetail['typedata'] as $type)
                @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                    {{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); $divd2 = round($totimg/2); /*--}}
                    <section id="roomsSuit" class="roomSuitSlider">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6 noPadding">
                                    <div id="left{{$type->id}}" class="carousel slide leftSlider terraceSuiteSlider"
                                         data-ride="carousel">
                                        <div class="carousel-inner">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)
                                                <div class="item {{ ($rimg1==0) ? 'active' : '' }}">
                                                    <a href="javascript:void(0);" class="galleryImgBtn">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                                                </div>
                                            @endfor

                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                                <div class="item">
                                                    <a href="javascript:void(0);" class="galleryImgBtn">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="left carousel-control left01" href="#left{{$type->id}}"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#left{{$type->id}}" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3 noPadding">
                                    <div class="sliderContent">
                                        <h3>{{$type->category_name}}</h3>
                                        <p>{{(strlen($type->room_desc) > 100) ? substr($type->room_desc,0,100).'...':$type->room_desc}}</p>
                                        <button class="btn btn-default moreButtonPopup" type="button">More</button>
                                        <button class="btn btn-default" type="button">Book Now</button>
                                        @if($type->price!='')
                                            <button class="btn btn-default"
                                                    type="button"> {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}} </button>
                                        @endif
                                        <div class="sliderArrow">
                                            <a href="javascript:void(0);" class="prevClick"><i
                                                        class="fa fa-angle-left"></i></a>
                                            <a href="javascript:void(0);" class="nextClick"><i
                                                        class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 noPadding hidden-xs">
                                    <div id="right{{$type->id}}" class="carousel slide rightSlider terraceSuiteSlider"
                                         data-ride="carousel">
                                        <div class="carousel-inner">
                                            @for($rimg1=0; $rimg1 < $divd2; $rimg1++)
                                                <div class="item {{ ($rimg1==1) ? 'active' : '' }}">
                                                    <a href="javascript:void(0);" class="galleryImgBtn">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
                                                </div>
                                            @endfor

                                            @for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
                                                <div class="item">
                                                    <a href="javascript:void(0);" class="galleryImgBtn">
                                                        <img src="{{ asset('themes/emporium/images/photo-camera.png') }}"
                                                             alt="Icon">
                                                    </a>
                                                    <img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}"
                                                         alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
                                                </div>
                                            @endfor
                                        </div>
                                        <a class="left carousel-control left01" href="#right{{$type->id}}"
                                           data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#right{{$type->id}}" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach
        @endif

        <!-- Design and Architecture section -->
        @if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
            <section id="design-architecture">
                <div class="container">
                    <figure class="design-image">
                        @if($propertyDetail['data']->architecture_image!='')
                            <img src="{{url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image)}}"
                                 alt="Design & Architecture" class="img-responsive"/>
                        @else
                            <img class="architecture-sec-top-img" src="{{url('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>
                        @endif
                    </figure>
                    <div class="content-box">
                        <div class="quote-small-box">
                            <p>{{$propertyDetail['data']->architecture_title}}</p>
                        </div>
                        <h2>Architecture & Design</h2>
                        <p>{{$propertyDetail['data']->architecture_desciription}}</p>
                    </div>
                </div>
            </section>
        @endif
        <!-- Design and Architecture section End -->

        @if (array_key_exists('typedata', $propertyDetail))
            <!-- terrace suit slider sec -->
            <div class="HamYardHotelSection">
                <div class="container">
                    <div id="HamYardHotelSlider" class="carousel slide HamYardHotelSlider" data-ride="carousel">
                        <div class="carousel-inner">
                            {{--*/ $k=1; /*--}}
                            @foreach($propertyDetail['typedata'] as $key=>$type)
                                @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                    <div style="background-image: url('{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}');"
                                         class="item {{($k==1) ? 'active' : ''}}">
                                        <div class="carousalCaption">
                                            <h3>Experience {{$propertyDetail['data']->property_name}}</h3>
                                            <h2>{{$type->category_name}}</h2>
                                            <p>{{(strlen($type->room_desc) > 300) ? substr($type->room_desc,0,300).'...':$type->room_desc}}</p>
                                        </div>
                                    </div>
                                    {{--*/ $k++; /*--}}
                                @endif
                            @endforeach
                        </div>
                        <div class="HamYardHotelSliderOptions">
                            <div class="terraceSuitindicator">
                                <div class="terraceSuitarrow">
                                    <div class="terraceSuitCounter">
                                        <p></p>
                                        <div class="num"></div>
                                    </div>
                                    <a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">
                                        <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}"
                                             alt="icon">
                                    </a>
                                    <a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">
                                        <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}"
                                             alt="icon">
                                    </a>
                                </div>
                                <ol class="carousel-indicators">
                                    {{--*/ $kn=0; /*--}}
                                    @foreach($propertyDetail['typedata'] as $key=>$type)
                                        @if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                                            <li data-target="#HamYardHotelSlider" data-slide-to="{{$kn}}"
                                                class="{{($kn==0) ? 'active' : ''}}"><img
                                                        src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}"
                                                        alt="Image"></li>
                                            {{--*/ $kn++; /*--}}
                                        @endif
                                    @endforeach
                                </ol>
                                <div class="showMoreSec">
                                    <button type="button" class="btn buttonDefault">SHOW MORE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- terrace suit slider sec end -->

        @if($propertyDetail['data']->video_title!='')
            <!-- Video Section starts here -->
            <section id="video" class="videoSection">
            @if($propertyDetail['data']->video_type=="upload")
                {{--*/  $videolink = url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_video);
                $video_banner = ($propertyDetail['data']->video_image!='')? url('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_image): url('sximo/images/mp4.png');
                /*--}}
                <!-- <iframe src="https://www.youtube.com/embed/yAoLSRbwxL8" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                    <video id="videoPoster" controls poster="{{$video_banner}}">
                        <source src="{{$videolink}}" type="video/mp4">
                    </video>
                @elseif($propertyDetail['data']->video_type=="link")
                    {{--*/ $vlink = explode('/',$propertyDetail['data']->video_link); $vimeoid = end($vlink); /*--}}
                    @if($propertyDetail['data']->video_link_type=="youtube")
                        {{--*/  $videolink = "https://www.youtube.com/embed/".$vimeoid; /*--}}
                        <iframe src="{{$videolink}}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @elseif($propertyDetail['data']->video_link_type=="vimeo")
                        {{--*/  $videolink = "https://player.vimeo.com/video/".$vimeoid; /*--}}
                        <iframe src="{{$videolink}}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    @endif

                @endif
            </section>
            <!-- Video Section END here -->
        @endif


        <section id="bookHotel" class="hotelSearchDateSection">
            <div class="HamYardHotelInner">
                <div class="hotelSearchDateInnerContent text-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="hotelPopupHeadings">
                                    <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                                    <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its
                                        cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                </div>
                            </div>
                        </div>
                        <form class="detail-page-booking-form"
                              action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
                            <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}"/>
                            <input type="hidden" name="roomType" id="roomType" value=""/>
                            <div class="row">
                                <ul class="hotelBorderList">
                                    <li>
                                        <h3>Arrival</h3>
                                        <div class="form-group">
                                            <input name="arrive" id="reservationdate1" class="form-control datefield reservationdate" type="text" readonly required>
                                            <div class="input-group-icon"><i class="fa fa-calander"></i></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h3>Departure</h3>
                                        <div class="form-group">
                                            <input name="departure" id="reservationdate1" class="form-control datefield reservationdate" type="text" readonly required>
                                            <div class="input-group-icon"><i class="fa fa-calander"></i></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h3>Adults</h3>
                                        <select name="booking_adults">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </li>
                                    <li>
                                        <h3>Children</h3>
                                        <select name="booking_children">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </li>
                                </ul>
                                <div class="text-center hotelBookNowButton">
                                    <button type="submit" class="btn">BOOK NOW</button>
                                </div>
                                <div class="hotelCancelBooking text-center">
                                    <a href="javascript:void(0);">View, Modify or Cancel your Booking</a>
                                </div>
                                <ul class="hotelBookingFooter">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Join the worlds leading luxury club</span>
                                            <h6>Enjoy exclusive members only benefits</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>View or Modify Reserveration</span>
                                            <h6>Login to Hotel PMS</h6>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Spa Treatment</span>
                                            <h6>Book</h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                    </form>
                </div>
            </div>
            </div>
        </section>

        @if($propertyDetail['data']->assign_detail_city!='')
            @if(!empty($relatedgridpropertiesArr))
                <section id="luxury-hotel-selection">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2 class="heading">VIEW OUR SELECTION OF LUXURY HOTELS
                                    IN {{$propertyDetail['data']->assign_detail_city}}</h2>
                            </div>
                        </div>
                        <div class="row">
                            @if($relatedgridpropertiesArr)
                                {{--*/ $rw = 1;	$node_no = 1; $ads_node = 0; /*--}}
                                @foreach($relatedgridpropertiesArr as $props)
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                        <div class="hotel-card">
                                            <figure>
                                                @if(array_key_exists('image', $props))
                                                    <img src="{{url('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}"
                                                         alt="Emporium"/>
                                                @endif
                                                <a href="{{url($props['data']->property_slug)}}"
                                                   class="content-overlay">
                                                    <h5>{{$props['data']->property_name}}</h5>
                                                    <p>From
                                                        € {{$props['data']->price}} {{(isset($props['data']->category_name)) ? '| '.$props['data']->category_name : '' }}</p>
                                                </a>
                                            </figure>
                                            <div class="title">
                                                <h3>
                                                    <a href="{{url($props['data']->property_slug)}}">{{$props['data']->property_name}}</a>
                                                </h3>
                                                <a href="{{url($props['data']->property_slug)}}" class="cartlink"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @if($rw%4==0)
                        </div>
                        <div class="row">
                            @endif
                            {{--*/ $rw++; $node_no++; /*--}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        @endif
        <!-- Selection of Luxury Hotels end -->
        <!-- Instagram Gallery Section -->
        @if($propertyDetail['data']->social_instagram!='')
            <section id="instagram-section">
                <div class="col-sm-12 text-center">
                    <h2 class="heading">GET SOCIAL</h2>
                </div>
                <section id="instagran" class="sections-instagram">
                    <div class="full-width">
                        <div data-is data-is-api="{{ url('runInsta')}}"
                             data-is-source="{{(!empty($propertyDetail) && $propertyDetail['data']->social_instagram!='')? $propertyDetail['data']->social_instagram : '@socialdesignlocations777' }}"
                             data-is-rows="2" data-is-columns="5"></div>
                    </div>
                </section>
            </section>
        @endif
		
		<!-- gallery Img Popup -->
		<div class="galleryImgPopup fullWidthPopup">
		  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
		  <div class="searchDateInnerContent text-center">
			<div class="container-fluid">
			  <div class="row">
				  <div class="col-xs-12 text-center">
					  <div class="gallyPopupHeader">
						  <a href="index.html"><img src="images/design-location-logo.png" alt="Emporium Voyage" class="img-responsive mCS_img_loaded"></a>
					  </div>
				  </div>
				  <div class="col-md-2 col-sm-3">
					  <div class="galleryPopupLeftSide">
						  <h1><a href="javascript:void(0);">New Hotel</a></h1>
						  <div class="popupHotelDetail text-center">
							  <h3>Hotel Zoo Berlin</h3>
							  <p>New York City</p>
							  <p>United States</p>
							  <a class="btn" href="javascript:void(0);">View Hotel</a>
						  </div>
						  <a class="bootomViewNextBtn" href="javascript:void(0);">View All Hotel DOI</a>
					  </div>
				  </div>
				  <div class="col-md-10 col-sm-9">
					  <div class="row">
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-5.jpg" alt="Image">
							  </div>
						  </div>
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-6.jpg" alt="Image">
							  </div>
						  </div>
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-7.jpg" alt="Image">
							  </div>
						  </div>
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-8.jpg" alt="Image">
							  </div>
						  </div>
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-9.jpg" alt="Image">
							  </div>
						  </div>
						  <div class="col-sm-4 col-xs-6">
							  <div class="popupHetelImage">
								  <img src="images/ham-yard-hotel-london-united-kingdom-11.jpg" alt="Image">
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
			</div>
		  </div>
		</div>

		<!-- Show More Popup -->
		<div class="showMorePopup fullWidthPopup">
		  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
			<div class="container-fluid">
			  <div class="row">
				  <div class="col-sm-4 col-md-6">
					  
				  </div>
				  <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
					<div class="showMoreContent">
					  <h1>TERRACE SUITE</h1>
					  <ul>
						<li>• 145sqm (1560sqft) </li>
						<li>• Two King Beds </li>
						<li>• Roof Top View </li>
						<li>• Top Floor with terrace </li>
						<li>• Open plan lounge, dining area and kitchen </li>
						<li>• Individual Design </li>
						<li>• Complimentary Wifi </li>
						<li>• Air Conditioning </li>
						<li>• LCD TV and DVD </li>
						<li>• Writing desk </li>
						<li>• Shower and Bathtub </li>
						<li>• Rik Rak by Kit Kemp Bathroom Amenities </li>
						<li>• Bluetooth Bose Units </li>
						<li>• Sleeps 5 with extra bed</li>
					  </ul>
					  <p>A spectacular two bedroom fifth floor suite at 145sqm or 1560sqf. The vast living/dining room has high ceilings with full floor-to-ceiling windows and a terrace with views of the courtyard and London skyline. The spacious living room has a powder room, writing desk and a sleek designed Boffi kitchen. There are two spacious bedrooms each with a king beds and the en-suite bathrooms have a walk-in shower, large central bath and flat screen TV. Each of the bedrooms have a king bed with the en-suite bathroom that is beautifully designed with 2 basins, a bath tub and a separate shower with exclusive Rik Rak bath products designed by Kit Kemp. One rollaway allowed to sleep 5.</p>
					  <div class="shoMoreButtonSection">
						<h2>€4141</h2>
						<a href="javascript:void(0);" class="button">BOOK Now</a>
					  </div>
					</div>
				  </div>
			  </div>
			</div>
		</div>
    @endif

@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')
    @include('frontend.themes.emporium.layouts.sections.pdp_right_iconbar')
@show

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    @include('frontend.themes.emporium.layouts.sections.pdp_top_search_bar')
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.pdp_sidebar')
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    @if(!empty($propertyDetail))
        @if( array_key_exists('propimage', $propertyDetail))
            <style>
                .HamYardHotelInner {
                    background-image: url('{{ $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][1]->file_name}}');
                }
            </style>
        @endif
    @endif
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.runtime.min.js"></script>
	<link rel="stylesheet" href="{{ asset('sximo/instajs/instashow/jquery.instashow.css')}}">
	<script src="{{ asset('sximo/instajs/instashow/jquery.instashow.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection