@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'PDP Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
	@if(!empty($spasArr))
		{{--*/ $clsact = ''; /*--}}
		<!-- Restaurant slider starts here -->
		<section class="sliderSection restaurantSliderSec">
		  <div id="restaurantSlider" class="carousel" data-ride="carousel">
			<div class="carousel-inner"> 
				@if(array_key_exists('dataslider',$spasArr[0]))
					{{--*/ $clsact = ($clsact=='') ? 'active' : ''; /*--}}
				  <div class="item {{$clsact}}" style="background:url('{{$spasArr[0]->dataslider}}') center center no-repeat; background-size:cover;">
					<div class="carousel-caption">
					  <h1>{{$spasArr[0]->title}}</h1>
					  <p>{{$spasArr[0]->usp_text}}</p>
					  <button type="button" class="button viewGalleryBtn">View Gallery</button>
					</div>
				  </div>
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

	@if(!empty($spasArr[0]))
		@if(array_key_exists('datagallery',$spasArr[0]))
			<section id="restaurant1" class="hotelSliderSection">
				<div class="container-fluid">
					<div class="hotelSliderwrapper">
						<div class="owl-carousel hotelSlider1 owl-theme">
							@if(!empty($spasArr[0]->datagallery))
								@foreach($spasArr[0]->datagallery as $resdatagallery)
									<div class="item">
										<div class="sliderimage">
											<img src="{{$spasArr[0]->datagallerypath.$resdatagallery->file_name}}" alt="image" class="img-responsive"/>
										</div>
										<div class="hotelSliderContentImage">
											<div class="hotelSliderContent">
												<h1><span>Restaurant</span></h1>
												<h2>{{$spasArr[0]->title}}</h2>
												<div class="mCustomScrollbar" data-mcs-theme="minimal-dark">
													<p> {{$spasArr[0]->desciription}}</p>
													@if(array_key_exists('datamenu',$spasArr[0]))
														<div class="foodemenu">
															<p>View Menus:<br/>
															@if(!empty($spasArr[0]->datamenu))
																@foreach($spasArr[0]->datamenu as $resdatamenu)
																	<a href="{{$spasArr[0]->datamenupath.$resdatamenu->file_name}}" target="_self" download="{{$resdatamenu->file_name}}">{{$resdatamenu->file_display_name}}</a>
																@endforeach
															@endif
															</p>
														</div>
													@endif
												</div>
												<p class="text-center"><a href="javascript:void(0)">Reservation</a> | <a class="contactUsPopup contactPopupOne" href="javascript:void(0);">Contact Us</a></p>
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
				  <!-- <div class="arrowsIcons">
					<a class="scrollpage" href="#restaurantSlider"><img src="images/arrow-up-icon.png" alt="icon"></a>
					<a class="scrollpage" href="#emotionSection"><img src="images/arrow-down-icon.png" alt="icon"></a>
				</div> -->
			</section>
		@endif
	@endif


	<!-- Emotion starts here -->
	<!-- Emotion starts here -->
	<section id="emotionSection" class="emotionSection">
		<div class="owl-carousel emotionSlider owl-theme">
			<div class="item">
				<img src="images/18155648145-44473422980.jpg" alt="image">
			</div>
			<div class="item">
				<img src="images/19404604410-57248710302.jpg" alt="image">
			</div>
		</div>

	  <div class="arrowsIcons">
		<a class="scrollpage" href="#restaurant1"><img src="images/arrow-up-icon.png" alt="icon"></a>
		<a class="scrollpage" href="#restaurant2"><img src="images/arrow-down-icon.png" alt="icon"></a>
	</div>
	</section>

	<!-- Video Section starts here -->
	<section id="video" class="videoSection">
		<!-- <iframe src="https://www.youtube.com/embed/yAoLSRbwxL8" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
		<video id="videoPoster" controls poster="images/video-poster.jpg">
		  <source src="images/dummy-video.mp4" type="video/mp4">
		  <source src="images/dummy-video.wemb" type="video/wemb">
		</video>
		<!-- <div class="arrowsIcons">
			<a class="scrollpage" href="#restaurant1"><img src="images/arrow-up-icon.png" alt="icon"></a>
			<a class="scrollpage" href="#restaurant2"><img src="images/arrow-down-icon.png" alt="icon"></a>
		</div> -->
	</section>
	<!-- Video Section END here -->


	<!-- Greenry Section here -->
	<div id="seasonal-events" class="greenrysection">
		<div class="content-circle contentCirsclePopupBtn">
			<h2>Request</h2>
			<h3>A Table</h3>
			<p>Lorem ipsum dolor sit amet, mei omnium iudicabit cu. Eruditi urbanitas persequeris in has, mel te prodesset conceptam. Id quando deterruisset est. Quaestio scripserit nec eu. An argumentum temporibus usu, ne mei aeterno imperdiet, case aeque id vis.</p>
		</div>
		<div class="arrowsIcons">
			<a class="scrollpage" href="#seasonal-events"><img src="images/arrow-up-icon.png" alt="icon"></a>
			<a class="scrollpage" href="#instagram-gallery"><img src="images/arrow-down-icon.png" alt="icon"></a>
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
	<div class="HamYardHotelSection">
	  <div class="container">
		 <div id="HamYardHotelSlider" class="carousel slide HamYardHotelSlider" data-ride="carousel">
			<div class="carousel-inner">
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel1-design-locations1.jpg);" class="item active">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>TERRACE SUITE</h2>
				   <p>A spectacular two bedroom fifth floor suite at 145sqm or 1560sqf. The vast living/dining room has high ceilings with full floor-to-ceiling windows and a terrace with views of the courtyard and London skyline. The spacious living room has a powder room, writing desk and a sleek designed Boffi kitchen...</p>
				 </div>
			   </div>
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel5-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>
			   
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel6-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>
			   
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel2-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>
			   
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel7-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>
			   
			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel4-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>

			   <div style="background-image: url(images/DeluxRooms-Ham-Yard-hotel3-design-locations1.jpg);" class="item">
				 <div class="carousalCaption">
				   <h3>Experience Ham Yard Hotel</h3>
				   <h2>DELUXE TWO BEDROOM SUITE</h2>
				   <p>Individually designed by Kit Kemp, the Deluxe Junior Suites approx. (52sqm or 559sqf) have a king or twin bed. The junior suite is equipped with a writing desk, sitting area, flat screen television, wireless internet, two line telephones with voice mail, personal electronic safe and a fully stocked ...</p>
				 </div>
			   </div>
			</div>
			  <div class="HamYardHotelSliderOptions">
			   
				<div class="terraceSuitindicator">
				  <div class="terraceSuitarrow">
					<div class="terraceSuitCounter">
					  <p> </p>
					  <div class="num"></div>
					</div>
					<a class="left left1 carousel-control" href="#HamYardHotelSlider" data-slide="prev">
					  <img src="images/editorial-left-arrow.png" alt="icon">
					</a>
					<a class="right carousel-control" href="#HamYardHotelSlider" data-slide="next">
					  <img src="images/editorial-right-arrow.png" alt="icon">
					</a>
				  </div>
				  <ol class="carousel-indicators">
				  <li data-target="#HamYardHotelSlider" data-slide-to="0" class="active"><img src="images/DeluxRooms-Ham-Yard-hotel1-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="1"><img src="images/DeluxRooms-Ham-Yard-hotel5-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="2"><img src="images/DeluxRooms-Ham-Yard-hotel6-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="3"><img src="images/DeluxRooms-Ham-Yard-hotel2-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="4"><img src="images/DeluxRooms-Ham-Yard-hotel7-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="5"><img src="images/DeluxRooms-Ham-Yard-hotel4-design-locations1.jpg" alt="Image"></li>
				  <li data-target="#HamYardHotelSlider" data-slide-to="6"><img src="images/DeluxRooms-Ham-Yard-hotel3-design-locations1.jpg" alt="Image"></li>
				</ol>
				<div class="showMoreSec"><button type="button" class="btn buttonDefault">SHOW MORE</button></div>
			  </div>
			</div>
		  </div>
	  </div>
	</div>
	<!-- terrace suit slider sec -->
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
	</div>

	<div id="get-directions">
		<div id="map"></div>
	</div>
@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@show

{{-- For Include style files --}}
@section('head')
    @parent
	<link href="{{ asset('themes/emporium/css/restaurant-css.css') }}" rel="stylesheet">
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    
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
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection