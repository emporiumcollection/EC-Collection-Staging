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
								<img src="{{$propertyDetail['propimage_thumbpath'].$propimg->file_name}}" alt="{{$propertyDetail['data']->property_name}}">
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
	<setion id="hotelInfo" class="HamYardHotelSection">
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
	</setion>
	<!-- HAM YARD HOTEL -->
	<setion class="HamYardHotelSection">
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
	</setion>

	@if (array_key_exists('typedata', $propertyDetail))
		<!-- hotel slider 1 -->
		@foreach($propertyDetail['typedata'] as $type)
			@if (array_key_exists($type->id, $propertyDetail['roomimgs']))
			{{--*/ $totimg = count($propertyDetail['roomimgs'][$type->id]['imgs']); $divd2 = round($totimg/2); /*--}}
				<section id="roomsSuit" class="roomSuitSlider">
				  <div class="container-fluid">
					<div class="row">
					  <div class="col-sm-6 noPadding">
						<div id="terraceSuiteSlider1" class="carousel slide leftSlider terraceSuiteSlider" data-ride="carousel">
						<div class="carousel-inner">
							@for($rimg1=0; $rimg1 < $divd2; $rimg1++)
								<div class="item {{ ($rimg1==0) ? 'active' : '' }}">
									<a href="javascript:void(0);" class="galleryImgBtn">
										<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">
									</a>
									 <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
							   </div>
							@endfor
							
							@for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
								<div class="item">
									<a href="javascript:void(0);" class="galleryImgBtn">
										<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">
									</a>
									<img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
								</div>
							@endfor
						</div>
						<a class="left carousel-control left01" href="#terraceSuiteSlider1" data-slide="prev">
						  <span class="glyphicon glyphicon-chevron-left"></span>
						  <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#terraceSuiteSlider1" data-slide="next">
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
							<button class="btn btn-default" type="button"> {{($currency->content!='') ? $currency->content : '$'}} {{$type->price}} </button>
						@endif
						  <div class="sliderArrow">
							<a href="javascript:void(0);" class="prevClick"><i class="fa fa-angle-left"></i></a>
							<a href="javascript:void(0);" class="nextClick"><i class="fa fa-angle-right"></i></a>
						  </div>
						</div>
					  </div>
					  <div class="col-sm-3 noPadding hidden-xs">
						<div id="terraceSuiteSlider11" class="carousel slide rightSlider terraceSuiteSlider" data-ride="carousel">
						<div class="carousel-inner">
							@for($rimg1=0; $rimg1 < $divd2; $rimg1++)
								<div class="item {{ ($rimg1==1) ? 'active' : '' }}">
									<a href="javascript:void(0);" class="galleryImgBtn">
										<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">
									</a>
									 <img src="{{$propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg1]->file_name}}">
							   </div>
							@endfor
							
							@for($rimg2=$rimg1; $rimg2 < $totimg; $rimg2++)
								<div class="item">
									<a href="javascript:void(0);" class="galleryImgBtn">
										<img src="{{ asset('themes/emporium/images/photo-camera.png') }}" alt="Icon">
									</a>
									<img src="{{ $propertyDetail['roomimgs'][$type->id]['imgsrc'].$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name }}" alt="{{$propertyDetail['roomimgs'][$type->id]['imgs'][$rimg2]->file_name}}">
								</div>
							@endfor
						</div>
						<a class="left carousel-control left01" href="#terraceSuiteSlider11" data-slide="prev">
						  <span class="glyphicon glyphicon-chevron-left"></span>
						  <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#terraceSuiteSlider11" data-slide="next">
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
						<img src="{{URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->architecture_image)}}" alt="Design & Architecture" class="img-responsive"/>
					@else
						<img class="architecture-sec-top-img" src="{{URL::to('sximo/assets/images/Architecture-&-Design.png')}}" alt=""/>
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
							<div style="background-image: url('{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}');" class="item {{($k==1) ? 'active' : ''}}">
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
								<p> </p>
								<div class="num"></div>
							</div>
							<a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">
							  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="icon">
							</a>
							<a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">
							  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="icon">
							</a>
						</div>
						<ol class="carousel-indicators">
							{{--*/ $kn=0; /*--}}
							@foreach($propertyDetail['typedata'] as $key=>$type)
								@if (array_key_exists($type->id, $propertyDetail['roomimgs']))
									<li data-target="#HamYardHotelSlider" data-slide-to="{{$kn}}" class="{{($k==0) ? 'active' : ''}}"><img src="{{$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgsrc'].$propertyDetail['roomimgs'][$propertyDetail['typedata'][$key]->id]['imgs'][0]->file_name}}" alt="Image"></li>
									{{--*/ $kn++; /*--}}
								@endif
							@endforeach
						</ol>
						<div class="showMoreSec"><button type="button" class="btn buttonDefault">SHOW MORE</button></div>
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
				{{--*/  $videolink = URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_video);
				$video_banner = ($propertyDetail['data']->video_image!='')? URL::to('uploads/properties_subtab_imgs/'.$propertyDetail['data']->video_image): URL::to('sximo/images/mp4.png');
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


	<setion id="bookHotel" class="hotelSearchDateSection">
		<div class="HamYardHotelInner">
			<div class="hotelSearchDateInnerContent text-center">
				<div class="container-fluid">
			  <div class="row">
				<div class="col-xs-12">
				  <div class="hotelPopupHeadings">
					  <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
					  <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
				  </div>
				</div>
			  </div>
			  <form class="detail-page-booking-form" action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" method="get">
				<input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}" />
				<input type="hidden" name="roomType" id="roomType" value="" />
			  <div class="row">
				<ul class="hotelBorderList">
				  <li>
					<h3>Arrival</h3>
					<div class="form-group">
					<input name="arrive" id="reservationdate1" class="form-control datefield" type="text" readonly required>
					<div class="input-group-icon"><i class="fa fa-calander"></i></div>
				</div>  
				  </li>
				  <li>
					<h3>Departure</h3>
					<div class="form-group">
					<input name="departure" id="reservationdate1" class="form-control datefield" type="text" readonly required>
					<div class="input-group-icon"><i class="fa fa-calander"></i></div>
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
				<div class="text-center hotelBookNowButton"><button type="submit" class="btn">BOOK NOW</button></div>
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
			</div>
			</form>
		  </div>
			</div>
		</div>
	</setion>

	@if($propertyDetail['data']->assign_detail_city!='')
		@if(!empty($relatedgridpropertiesArr))
			<section id="luxury-hotel-selection">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2 class="heading">VIEW OUR SELECTION OF LUXURY HOTELS IN {{$propertyDetail['data']->assign_detail_city}}</h2>
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
												<img src="{{URL::to('uploads/property_imgs_thumbs/front_property_'.$props['image']->folder_id.'_'.$props['image']->file_name)}}" alt="Emporium"/>
											@endif
											<a href="{{URL::to($props['data']->property_slug)}}" class="content-overlay">
												<h5>{{$props['data']->property_name}}</h5>
												<p>From € {{$props['data']->price}} {{(isset($props['data']->category_name)) ? '| '.$props['data']->category_name : '' }}</p>
											</a>
										</figure>
										<div class="title">
											<h3><a href="{{URL::to($props['data']->property_slug)}}">{{$props['data']->property_name}}</a></h3>
											<a href="{{URL::to($props['data']->property_slug)}}" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
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
	<section id="instagram-section">
		<div class="col-sm-12 text-center">
			<h2 class="heading">GET SOCIAL</h2>
		</div>
		<section id ="instagran" class="sections-instagram">
			<div class="full-width">
				<div data-is data-is-api="{{ URL::to('runInsta')}}" data-is-source="{{(!empty($propertyDetail) && $propertyDetail['data']->social_instagram!='')? $propertyDetail['data']->social_instagram : '@socialdesignlocations777' }}" data-is-rows="2" data-is-columns="5"></div>
			</div>
		</section>
	</section>

	@endif

@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
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
				.HamYardHotelInner { background-image: url('{{ $propertyDetail['propimage_thumbpath'].$propertyDetail['propimage'][1]->file_name}}'); }
			</style>
		@endif
	@endif
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection