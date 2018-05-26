@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')


	@if(!empty($resturantArr) || !empty($barsArr) || !empty($spasArr))
		{{--*/ $checkslid = false; /*--}}
		<!-- Restaurant slider starts here -->
		<section class="sliderSection restaurantSliderSec">
		  <div id="restaurantSlider" class="carousel" data-ride="carousel">
			<div class="carousel-inner">
			  @if(!empty($resturantArr))
				  @foreach($resturantArr as $resturant)
					@if(array_key_exists('dataslider',$resturant))
						{{--*/ $clsact = ''; /*--}}
						@if($checkslid==false) {{--*/ $clsact = 'active'; $checkslid=true; /*--}} @endif
					  <div class="item {{$clsact}}" style="background:url('{{$resturant->dataslider}}') center center no-repeat; background-size:cover;">
						<div class="carousel-caption">
						  <h1>{{$resturant->title}}</h1>
						  <p>{{$resturant->usp_text}}</p>
						  <button type="button" class="button viewGalleryBtn">View Gallery</button>
						</div>
					  </div>
					@endif
				  @endforeach
			  @endif
			  
			  @if(!empty($barsArr))
				  @foreach($barsArr as $bars)
					@if(array_key_exists('dataslider',$bars))
						{{--*/ $clsact = ''; /*--}}
						@if($checkslid==false) {{--*/ $clsact = 'active'; $checkslid=true; /*--}} @endif
					  <div class="item {{$clsact}}" style="background:url('{{$bars->dataslider}}') center center no-repeat; background-size:cover;">
						<div class="carousel-caption">
						  <h1>{{$bars->title}}</h1>
						  <p>{{$bars->usp_text}}</p>
						  <button type="button" class="button viewGalleryBtn">View Gallery</button>
						</div>
					  </div>
					@endif
				  @endforeach
			  @endif
			  
			  @if(!empty($spasArr))
				  @foreach($spasArr as $spas)
					@if(array_key_exists('dataslider',$spas))
						{{--*/ $clsact = ''; /*--}}
						@if($checkslid==false) {{--*/ $clsact = 'active'; $checkslid=true; /*--}} @endif
					  <div class="item {{$clsact}}" style="background:url('{{$spas->dataslider}}') center center no-repeat; background-size:cover;">
						<div class="carousel-caption">
						  <h1>{{$spas->title}}</h1>
						  <p>{{$spas->usp_text}}</p>
						  <button type="button" class="button viewGalleryBtn">View Gallery</button>
						</div>
					  </div>
					@endif
				  @endforeach
			  @endif 

			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
			  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
			</a>
			<a class="right carousel-control" href="#restaurantSlider" data-slide="next">
			  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
			</a>
		  </div>
		  <span class="scrollNextDiv"><a class="scrollpage" href="#restaurant1">Scroll Down</a></span>
		</section>
	@endif

	@if(!empty($resturantArr[0]))
		@if(array_key_exists('datagallery',$resturantArr[0]))
			<section id="restaurant1" class="hotelSliderSection">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider1 owl-theme">
							@if(!empty($resturantArr[0]->datagallery))
								@foreach($resturantArr[0]->datagallery as $resdatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$resturantArr[0]->datagallerypath.$resdatagallery->file_name}}" alt="image" class="img-responsive"/>
										</div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Restaurant</span></h1>
												<h2>{{$resturantArr[0]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$resturantArr[0]->description}}</p>
													@if(array_key_exists('datamenu',$resturantArr[0]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($resturantArr[0]->datamenu))
																@foreach($resturantArr[0]->datamenu as $resdatamenu)
																	<a href="{{$resturantArr[0]->datamenupath.$resdatamenu->file_name}}" target="_self" download="{{$resdatamenu->file_name}}">{{$resdatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<p class="text-center"><a href="javascript:void(0)">Reservation</a> | <a data-action="contactform-restaurant" rel="restro" rel2="{{$resturantArr[0]->id}}" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<!-- contact form popup section -->
				<div id="contactPopupSection" class="custom_modal modal fade" role="dialog">
				  <div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
					  <div class="cstm_heading modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h1 class="modal-title">Planet Restaurant</h1>
						<p>Lorem ipsum dolor sit amet.</p>
						<p>Lorem ipsum dolor sit amet.</p>
					  </div>
					  <div class="modal-body">
						<div id="formerrors"></div>
						<form id="reserve_resto_table_form">
						<div class="row">
							<div class="col-md-4">
								 <div class="form-field">
								 	<input class="con-type" type="hidden" name="reservetype" value="" />
									 <select data-action="restoid" id="restoid" name="restoid">
										 <option value="0">Please select</option>
										 @if(!empty($resturantArr))
											  @foreach($resturantArr as $resturant)
												<option value="{{$resturant->id}}" rel="restro">{{$resturant->title}}</option>
											  @endforeach
										  @endif
										  @if(!empty($barsArr))
											  @foreach($barsArr as $bar)
												<option value="{{$bar->id}}" rel="bar">{{$bar->title}}</option>
											  @endforeach
										  @endif
										  @if(!empty($spasArr))
											  @foreach($spasArr as $spa)
												<option value="{{$spa->id}}" rel="spa">{{$spa->title}}</option>
											  @endforeach
										  @endif
									 </select>
								 </div> 
							</div>
							<div class="col-md-4">
								 <div class="form-field">
								  <input type="text" name="firstname" placeholder="First name*">
								 </div> 
							  </div>
						<div class="col-md-4">
						 <div class="form-field">
						  <input type="text" name="lastname" placeholder="Last name*">
						 </div> 
					  </div>
					</div><!--row -->
					 <div class="row">
					  <div class="col-md-4">
						 <div class="form-field">
							<input type="email" name="emailaddress" placeholder="Email*">
						 </div> 
					  </div>
					   <div class="col-md-4">
						 <div class="form-field row">
							<div class="col-xs-4"><input type="number" name="telephone_code" placeholder="0"></div> 
							<div class="col-xs-8"><input type="number" name="telephone_number" placeholder="Telephone"></div> 
				  
						 </div> 
					  </div>
						<div class="col-md-4">
						 <div class="form-field row">
						   <div class="col-xs-4"><input type="number" name="telephone_code2" placeholder="0"></div> 
							<div class="col-xs-8"><input type="number" name="telephone_number2" placeholder="Telephone"></div> 
						 </div> 
					  </div>
					</div><!--row -->
					<div class="row">
					  <div class="col-md-4">
						 <div class="form-field row">
							<label>Preferred date</label>
							<div class="col-xs-4">
								 <select>
								 <option name="reserve_day">DD</option>
								 @for($arvDay=1;$arvDay<=31;$arvDay++)
									 <option value="{{(strlen($arvDay)>1)?$arvDay:'0'.$arvDay}}">{{$arvDay}}</option>
								 @endfor
							 </select>
							</div> 
							 <div class="col-xs-4">
								 <select name="reserve_month">
								 @for($arvMonth=1; $arvMonth<=12; ++$arvMonth)
									<option  value="{{(strlen($arvMonth)>1)?$arvMonth:'0'.$arvMonth}}">{{ date('F', mktime(0, 0, 0, $arvMonth, 1)) }}</option>
								@endfor
							 </select>
							</div> 
							 <div class="col-xs-4">
								 <select name="reserve_year">
								 {{--*/ $arvYearRange = range(date('Y'), date('Y', strtotime('+5 years'))) /*--}}
								@foreach($arvYearRange as $arvYear)
									<option value="{{$arvYear}}">{{$arvYear}}</option>
								@endforeach
							 </select>
							</div> 
							
						 </div> 
					  </div>
					   <div class="col-md-4">
						  <div class="form-field row">
							<label>Preferred time</label>
							<div class="col-xs-6">
								<select name="reserve_hour">
									@for($arvhour=0;$arvhour<=23;$arvhour++)
									 <option value="{{$arvhour}}">{{$arvhour}}</option>
								 @endfor
								</select>
							</div> 
							 <div class="col-xs-6">
								 <select name="reserve_minute">
									@for($arvmint=0;$arvmint<=59;$arvmint++)
									 <option value="{{$arvmint}}">{{$arvmint}}</option>
								 @endfor
								</select>
							</div> 
						   
							
						 </div> 
					  </div>
						<div class="col-md-4">
						 <div class="form-field number-guest">
						<input type="number" name="totalguest" placeholder="Number of guest"> 
						
						 </div> 
					  </div>
					</div><!--row -->
					<div class="row">
						<div class="col-md-12">
						   <div class="form-field areafield">
							   <textarea name="query" placeholder="How can we help"></textarea>
						   </div> 
						</div>
					</div><!-- row-->

					<div class="row">
						<div class="col-md-12 term-check">
							<input name="agree" type="checkbox" id="signup-hotel-cipriani-restaurant">
							<label for="signup-hotel-cipriani-restaurant">By ticking this box, you give your consent to be contacted about the Emporium Voyage offers, events and updates. You may opt out of receiving our updates at any time, either by using an unsubscribe link. To find out more see our <a target="_blank" href="javascript:void(0);">privacy policy</a> and full <a target="_blank" href="terms-and-conditions.html">terms and conditions</a>.</label>
						   <div class="btn-outer">
							 <button type="submit" class="submit-btn" onclick="submit_resto_book_request();">Submit</button>
						   </div>
						</div>
					</div>
					</form>
					  </div>
					
					  </div>
					
					</div>

				  </div>
			
			</section>
		@endif
	@endif


	@if(!empty($inspireArray))
		<!-- Emotion starts here -->
		<section id="emotionSection" class="emotionSection">
			<div class="owl-carousel emotionSlider owl-theme">
				@foreach($inspireArray as $inspire)
					<div class="item">
						<img src="{{$inspirefolderpath.$inspire->file_name}}" alt="image">
					</div>
				@endforeach
			</div>

			<div class="arrowsIcons">
				<a class="scrollpage" href="#restaurant1"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
				<a class="scrollpage" href="#restaurant2"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
			</div>
		</section>
	@endif

	@if(!empty($resturantArr[1]))
		@if(array_key_exists('datagallery',$resturantArr[1]))
			<!-- Restaurant slider 2 starts here -->
			<section id="restaurant2" class="hotelSliderSection rightSideSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider2 owl-theme">
							@if(!empty($resturantArr[1]->datagallery))
								@foreach($resturantArr[1]->datagallery as $resdatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$resturantArr[1]->datagallerypath.$resdatagallery->file_name}}" alt="image" class="img-responsive"/>
										 </div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Restaurant</span></h1>
												<h2>{{$resturantArr[1]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$resturantArr[1]->description}}</p>
													@if(array_key_exists('datamenu',$resturantArr[1]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($resturantArr[1]->datamenu))
																@foreach($resturantArr[1]->datamenu as $resdatamenu)
																	<a href="{{$resturantArr[1]->datamenupath.$resdatamenu->file_name}}" target="_self" download="{{$resdatamenu->file_name}}">{{$resdatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Restaurant</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Restaurant</a> | <a rel="restro" rel2="{{$resturantArr[1]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="arrowsIcons">
					<a class="scrollpage" href="#restaurant2"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
					<a class="scrollpage" href="#video"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
				</div>
			</section>
		@endif
	@endif

	<!-- Video Section starts here 
	<section id="video" class="videoSection">
		<!-- <iframe src="https://www.youtube.com/embed/yAoLSRbwxL8" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
		<video id="videoPoster" controls poster="images/video-poster.jpg">
		  <source src="images/dummy-video.mp4" type="video/mp4">
		  <source src="images/dummy-video.wemb" type="video/wemb">
		</video>
		<!-- <div class="arrowsIcons">
			<a class="scrollpage" href="#restaurant1"><img src="images/arrow-up-icon.png" alt="icon"></a>
			<a class="scrollpage" href="#restaurant2"><img src="images/arrow-down-icon.png" alt="icon"></a>
		</div> 
	</section>
	<!-- Video Section END here -->
	
	@if($propertiesArr['data']->social_youtube!='')
		<div data-yt data-yt-channel="{{ $propertiesArr['data']->social_youtube }}" data-yt-content-columns="4"  data-yt-content-rows="1"></div>
	@endif

	@if(!empty($resturantArr[2]))
		@if(array_key_exists('datagallery',$resturantArr[2]))
			<!-- Restaurant slider 3 starts here -->
			<section id="restaurant3" class="hotelSliderSection fullWidthSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider1 owl-theme">
							@if(!empty($resturantArr[2]->datagallery))
								@foreach($resturantArr[2]->datagallery as $resdatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$resturantArr[2]->datagallerypath.$resdatagallery->file_name}}" alt="image" class="img-responsive"/>
										 </div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Restaurant</span></h1>
												<h2>{{$resturantArr[2]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$resturantArr[2]->description}}</p>
									
													@if(array_key_exists('datamenu',$resturantArr[2]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($resturantArr[2]->datamenu))
																@foreach($resturantArr[2]->datamenu as $resdatamenu)
																	<a href="{{$resturantArr[2]->datamenupath.$resdatamenu->file_name}}" target="_self" download="{{$resdatamenu->file_name}}">{{$resdatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Restaurant</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Restaurant</a> | <a rel="restro" rel2="{{$resturantArr[2]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</section>
		@endif
	@endif

	@if(!empty($barsArr[0]))
		@if(array_key_exists('datagallery',$barsArr[0]))
			<!-- BAR SECTION starts here -->
			<section id="bar1" class="hotelSliderSection rightSideSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider2 owl-theme">
							@if(!empty($barsArr[0]->datagallery))
								@foreach($barsArr[0]->datagallery as $bardatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$barsArr[0]->datagallerypath.$bardatagallery->file_name}}" alt="image" class="img-responsive"/>
										</div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Bar</span></h1>
												<h2>{{$barsArr[0]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$barsArr[0]->description}}</p>
													@if(array_key_exists('datamenu',$barsArr[0]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($barsArr[0]->datamenu))
																@foreach($barsArr[0]->datamenu as $bardatamenu)
																	<a href="{{$barsArr[0]->datamenupath.$bardatamenu->file_name}}" target="_self" download="{{$bardatamenu->file_name}}">{{$bardatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Bar</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Bar</a> | <a rel="bar" rel2="{{$barsArr[0]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif	
						</div>
					</div>
				</div>
				<div class="arrowsIcons">
					<a class="scrollpage" href="#restaurant3"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
					<a class="scrollpage" href="#seasonal-events"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
				</div>
			</section>
		@endif
	@endif
	
	@if(!empty($barsArr[1]))
		@if(array_key_exists('datagallery',$barsArr[1]))
			<!-- Restaurant slider 2 starts here -->
			<section id="bar2" class="hotelSliderSection rightSideSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider2 owl-theme">
							@if(!empty($barsArr[1]->datagallery))
								@foreach($barsArr[1]->datagallery as $bardatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$barsArr[1]->datagallerypath.$bardatagallery->file_name}}" alt="image" class="img-responsive"/>
										 </div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Bar</span></h1>
												<h2>{{$barsArr[1]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$barsArr[1]->description}}</p>
													@if(array_key_exists('datamenu',$barsArr[1]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($barsArr[1]->datamenu))
																@foreach($barsArr[1]->datamenu as $bardatamenu)
																	<a href="{{$barsArr[1]->datamenupath.$bardatamenu->file_name}}" target="_self" download="{{$bardatamenu->file_name}}">{{$bardatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Bar</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Bar</a> | <a rel="bar" rel2="{{$barsArr[1]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="arrowsIcons">
					<a class="scrollpage" href="#restaurant2"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
					<a class="scrollpage" href="#video"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
				</div>
			</section>
		@endif
	@endif
	
	@if(!empty($barsArr[2]))
		@if(array_key_exists('datagallery',$barsArr[2]))
			<!-- Restaurant slider 3 starts here -->
			<section id="bar3" class="hotelSliderSection fullWidthSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider1 owl-theme">
							@if(!empty($barsArr[2]->datagallery))
								@foreach($barsArr[2]->datagallery as $bardatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$barsArr[2]->datagallerypath.$bardatagallery->file_name}}" alt="image" class="img-responsive"/>
										 </div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Bar</span></h1>
												<h2>{{$barsArr[2]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$barsArr[2]->description}}</p>
									
													@if(array_key_exists('datamenu',$barsArr[2]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($barsArr[2]->datamenu))
																@foreach($barsArr[2]->datamenu as $bardatamenu)
																	<a href="{{$barsArr[2]->datamenupath.$bardatamenu->file_name}}" target="_self" download="{{$bardatamenu->file_name}}">{{$bardatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Bar</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Bar</a> | <a rel="bar" rel2="{{$barsArr[2]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</section>
		@endif
	@endif
	
	@if(!empty($spasArr[0]))
		@if(array_key_exists('datagallery',$spasArr[0]))
			<!-- BAR SECTION starts here -->
			<section id="spa1" class="hotelSliderSection rightSideSlider">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider2 owl-theme">
							@if(!empty($spasArr[0]->datagallery))
								@foreach($spasArr[0]->datagallery as $spadatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$spasArr[0]->datagallerypath.$spadatagallery->file_name}}" alt="image" class="img-responsive"/>
										</div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Spa</span></h1>
												<h2>{{$spasArr[0]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$spasArr[0]->description}}</p>
													@if(array_key_exists('datamenu',$spasArr[0]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($spasArr[0]->datamenu))
																@foreach($spasArr[0]->datamenu as $spadatamenu)
																	<a href="{{$spasArr[0]->datamenupath.$spadatamenu->file_name}}" target="_self" download="{{$spadatamenu->file_name}}">{{$spadatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<!--<p class="text-center"><a href="javascript:void(0)">Spa</a> / <a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>-->
												<p class="text-center"><a href="javascript:void(0)">Spa</a> | <a rel="spa" rel2="{{$spasArr[0]->id}}" data-action="contactform-restaurant" class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
											</div>
										</div>
									</div>
								@endforeach
							@endif	
						</div>
					</div>
				</div>
				<div class="arrowsIcons">
					<a class="scrollpage" href="#restaurant3"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
					<a class="scrollpage" href="#seasonal-events"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
				</div>
			</section>
		@endif
	@endif

	<!-- Greenry Section here -->
	<div id="seasonal-events-top" class="greenrysection">
	<!-- <div class="content-circle contentCirsclePopupBtn"> -->
	<div rel="" data-action="contactform-restaurant" class="content-circle contactPopupOne">
        <h2>Request</h2>
        <h3>A Table</h3>
        <p>Lorem ipsum dolor sit amet, mei omnium iudicabit cu. Eruditi urbanitas persequeris in has, mel te prodesset conceptam. Id quando deterruisset est. Quaestio scripserit nec eu. An argumentum temporibus usu, ne mei aeterno imperdiet, case aeque id vis.</p>
    </div>
		<div class="arrowsIcons">
			<a class="scrollpage" href="#seasonal-events"><img src="{{ asset('themes/emporium/images/arrow-up-icon.png') }}" alt="icon"></a>
			<a class="scrollpage" href="#instagram-gallery"><img src="{{ asset('themes/emporium/images/arrow-down-icon.png') }}" alt="icon"></a>
		</div>

	<div id="contentCirsclePopup" class="custom_modal modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="cstm_heading modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h1 class="modal-title">Planet Restaurant</h1>
			<p>Lorem ipsum dolor sit amet.</p>
			<p>Lorem ipsum dolor sit amet.</p>
		  </div>
		  <div class="modal-body">
			<div class="row">
		  <div class="col-md-4">
			 <div class="form-field">
				 <select>
					 <option>Please select</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
			 </div> 
		  </div>
		   <div class="col-md-4">
			 <div class="form-field">
			  <input type="text" placeholder="First name*">
			 </div> 
		  </div>
			<div class="col-md-4">
			 <div class="form-field">
			  <input type="text" placeholder="Last name*">
			 </div> 
		  </div>
		</div><!--row -->
		 <div class="row">
		  <div class="col-md-4">
			 <div class="form-field">
				<input type="email" placeholder="Email*">
			 </div> 
		  </div>
		   <div class="col-md-4">
			 <div class="form-field row">
				<div class="col-xs-4"><input type="number" placeholder="0"></div> 
				<div class="col-xs-8"><input type="number" placeholder="Telephone"></div> 
	  
			 </div> 
		  </div>
			<div class="col-md-4">
			 <div class="form-field row">
			   <div class="col-xs-4"><input type="number" placeholder="0"></div> 
				<div class="col-xs-8"><input type="number" placeholder="Telephone"></div> 
			 </div> 
		  </div>
		</div><!--row -->
		<div class="row">
		  <div class="col-md-4">
			 <div class="form-field row">
				<label>Preferred date</label>
				<div class="col-xs-4">
					 <select>
					 <option>DD</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
				</div> 
				 <div class="col-xs-4">
					 <select>
					 <option>MM</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
				</div> 
				 <div class="col-xs-4">
					 <select>
					 <option>YYYY</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
				</div> 
				
			 </div> 
		  </div>
		   <div class="col-md-4">
			  <div class="form-field row">
				<label>Preferred time</label>
				<div class="col-xs-6">
					 <select>
					 <option>DD</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
				</div> 
				 <div class="col-xs-6">
					 <select>
					 <option>MM</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
					 <option>dummy text</option>
				 </select>
				</div> 
			   
				
			 </div> 
		  </div>
			<div class="col-md-4">
			 <div class="form-field number-guest">
			<input type="number" placeholder="Number of guest"> 
			
			 </div> 
		  </div>
		</div><!--row -->
		<div class="row">
			<div class="col-md-12">
			   <div class="form-field areafield">
				   <textarea placeholder="How can we help"></textarea>
			   </div> 
			</div>
		</div><!-- row-->

		<div class="row">
			<div class="col-md-12 term-check">
				<input type="checkbox" id="signup-hotel-cipriani-restaurant">
				<label for="signup-hotel-cipriani-restaurant">By ticking this box, you give your consent to be contacted about the Emporium Voyage offers, events and updates. You may opt out of receiving our updates at any time, either by using an unsubscribe link. To find out more see our <a target="_blank" href="javascript:void(0);">privacy policy</a> and full <a target="_blank" href="terms-and-conditions.html">terms and conditions</a>.</label>
			   <div class="btn-outer">
				 <button type="submit" class="submit-btn">Submit</button>
			   </div>
			</div>
		</div>
		  </div>
		
		  </div>
		
		</div>

	  </div>
	</div>
	<!-- Instagram Gallery Section -->
	<!-- terrace suit slider sec -->
<div id="seasonal-events" style="background-color:#f7f7f7;" class="col-md-12">

@if (!empty($eventsArray))

<div class="HamYardHotelSection">
  <div>
     <div id="HamYardHotelEventslider" class="carousel slide HamYardHotelSlider" data-ride="carousel">
        <div class="carousel-inner" id="eventPackageSlider">
   	


			{{--*/ $k=0; $tottyp = count($eventsArray); /*--}}
           @foreach($eventsArray as $key=>$package)
           <div  id="{{ $package->event_id }}" style="background-image: url({{URL::to('uploads/event_package_images/'.$package->package_image)}});" @if($k==0) class="item active" @else class="item" @endif>
             <div class="carousalCaption">

				<h2>Event:{{$package->title}}</h2>
				<p>Event Details:{{$package->desciription}}</p>
				<p>USP:{{$package->usp_text}}</p>
				<p>Contact:{{$package->reservation_email}}</p>
               
             </div>
           </div>

           {{--*/ $k++; /*--}}
                                      
        @endforeach
       
       		 </div>



          <div class="HamYardHotelSliderOptions">
           
            <div class="terraceSuitindicator">
              <div class="terraceSuitarrow">
                <div class="terraceSuitCounter">
                  <p> </p>
                  <div class="num"></div>
                </div>
                <a class="left left1 carousel-control" href="#HamYardHotelEventslider" data-slide="prev">
                  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="icon">
                </a>
                <a class="right carousel-control" href="#HamYardHotelEventslider" data-slide="next">
                  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="icon">
                </a>
              </div>
              <ol class="carousel-indicators" id="eventSliderNav">
            {{--*/ $klist=0; $tottyp = count($eventsArray); /*--}}
             @foreach($eventsArray as $key=>$package)
              <li data-target="#HamYardHotelEventslider" data-slide-to="{{$klist}}" @if($klist==0) class="active" @endif rel="{{ $package->event_id }}"><img src="{{URL::to('uploads/event_package_images/'.$package->package_image)}}" alt="Image"></li>             

              {{--*/ $klist++; /*--}}
                                                
            @endforeach
            </ol>

             <div class="showMoreSec" rel="125"><button type="button" class="btn buttonDefault" >SHOW MORE</button></div>
      
          </div>
        </div>

       
      </div>
  </div>
</div>
@endif

  
		
</div>		


	<!-- terrace suit slider sec 
	<div id="instagram-gallery" class="instagram-gallery owl-carousel">
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-01.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-02.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-03.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-04.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-05.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-06.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-01.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-02.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-03.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-04.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-05.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-06.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-01.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-02.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-03.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-04.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-05.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-06.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-01.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-02.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-03.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-04.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>
		<div class="item">
			<div class="instagram-box">
				<figure><img src="images/instagram-img-05.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
			<div class="instagram-box">
				<figure><img src="images/instagram-img-06.jpg" alt="" /></figure>
				<a href="javascript:void(0)" class="hover-detail">
					<p>Eu mea deleniti expetendis. Sea ei partem fuisset. Per modus summo necessitatibus cum.</p>
				</a>
			</div>
		</div>


		<div class="arrowsIcons">
			<a class="scrollpage" href="#seasonal-events"><img src="images/arrow-up-icon.png" alt="icon"></a>
			<a class="scrollpage" href="#get-directions"><img src="images/arrow-down-icon.png" alt="icon"></a>
		</div>
	</div>-->

	<div id="get-directions">
		<div id="map"></div>
	</div>




<!-- div used to show popup -->
<div class="showMorePopup fullWidthPopup">
  <a href="javascript:void(0);" class="loginPopupCloseButton">×</a>
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-4 col-md-6">
              
          </div>
          <div class="col-md-6 col-sm-8 col-xs-12 noPadding">
            <div class="showMoreContent">
              <h1></h1>
              
              <p></p>
              <div class="shoMoreButtonSection">
                <h2>€4141</h2>
                <a href="javascript:void(0);" class="button">BOOK Now</a>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
<!-- div used to show popup -->

@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
	<link href="{{ asset('themes/emporium/css/restaurant-css.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
 	<link 	href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
    
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    @include('frontend.themes.emporium.layouts.sections.rdp_top_search_bar')
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.resto_sidebar')
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
	
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
		 window.ParsleyConfig = {
			errorsWrapper: '<div></div>',
			errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
			errorClass: 'has-error',
			successClass: 'has-success'
		};

		$(function () {
			$('#reserve_resto_table_form').parsley().on('field:validated', function() {
			var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
			})
			.on('form:submit', function() {
			submit_resto_book_request();
			return false; // Don't submit form for this demo
			});
		});
		
		function submit_resto_book_request()
		{
			$.ajax({
				  url: "{{ URL::to('reserve_resto_table_request')}}",
				  type: "post",
				  data: $('#reserve_resto_table_form').serialize(),
				  dataType: "json",
				  success: function(data){
					var html = '';
					if(data.status=='error')
					{
						html +='<ul class="parsley-error-list">';
						$.each(data.errors, function(idx, obj) {
							html +='<li>'+obj+'</li>';
						});
						html +='</ul>';
						$('#formerrors').html(html);
					}
					else{
						var htmli = '';
						htmli +='<div class="alert alert-success fade in block-inner">';
						htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
						htmli +='<i class="icon-checkmark-circle"></i> Restaurant Table Booking Request Submitted Successfully </div>';
						$('#formerrors').html(htmli);
						$('#reserve_resto_table_form')[0].reset();
					}
				  }
			});
		}





		$(document).on('click', '.showMoreSec, .moreButtonPopup', function () {
			$('.showMorePopup').css("background-image", "");
			$('.showMoreContent').html('');			
			//$('#eventSliderNav').find(".active").attr("rel");
			var params = $.extend({}, doAjax_params_default);
			params['url'] = BaseURL + '/getEventPackages/'+ $('#eventSliderNav').find(".active").attr("rel");
			params['successCallbackFunction'] = renderPackagDetails;
			doAjax(params);

		});
		
		function renderPackagDetails(data) {
			

			var packageDetailsHtml = '';

		if(data.status=="success"){
			$(data.records).each(function( i, val ) {
				if(i==0){

				var rimg ="/uploads/event_package_images/"+val.package_image;
				$('.showMorePopup').css("background-image", "url('" + rimg + "')");	
					
				packageDetailsHtml += '<h1>Event: ' + val.title + '</h1>';
				packageDetailsHtml += '<p> Event Description: ' + val.desciription.replace(/\n/g, "<br />") + '</p>';

				}
		
	

				packageDetailsHtml += '<h1> Package::' + val.package_title + '</h1>';
				packageDetailsHtml += '<p>' + val.package_description.replace(/\n/g, "<br />") + '</p>';
				packageDetailsHtml += '<p>' + val.package_duration + '</p>';

				packageDetailsHtml += '<div class="shoMoreButtonSection">';
				if (val.package_price != '')
				{
					packageDetailsHtml += '<h2>';
					packageDetailsHtml += '$';
					packageDetailsHtml += val.package_price;
					packageDetailsHtml += '</h2>';
				}
				packageDetailsHtml += '<a href="javascript:void(0);" class="button">Book</a>';
				packageDetailsHtml += '</div>';
				

		  });

		}
		$('.showMoreContent').html(packageDetailsHtml);
		$('.showMorePopup').addClass('openPopup');
		}
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection