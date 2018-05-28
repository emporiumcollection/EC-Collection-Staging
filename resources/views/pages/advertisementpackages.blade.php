
@extends('frontend.layouts.ev.customer')
@section('content')

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
				<div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
				@if (!empty($packages))
					<ul class="image-slider">
						{{--*/ $k=1; $tottyp = count($packages); /*--}}
						@foreach($packages as $key=>$package)
						<li class="{{($k==1) ? 'active' : ''}}">
							<a href="#">
								<img class="img-responsive object-fit-size" src="http://www.emporium-voyage.com/uploads/properties_subtab_imgs/69726129-32146277.jpg" alt="{{$package->space_title}}" style="height:580px; width: 100%;">
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
													<div class="expeience-small-text">Advertisement Packages</div>
													<div class="slider-side-text-tittle">{{$package->space_title}}</div>
													<div class="slider-side-description-text">
														
													</div>
												</div>
												<div>
													<img class="slider-next-image-btn img-responsive" src="http://www.emporium-voyage.com/uploads/properties_subtab_imgs/69726129-32146277.jpg" alt="">
													<a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn ClickButton">Show More</a>
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
							<img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt="">
						</a>
						<a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
							<img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt="">
						</a>
					</div>
					@endif
				</div>
			</div>
		</div>
	</section>

	<div class="hotel-property-section-bg" id="popupopn">
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


	<!-- pop up -->
</div>
@endsection