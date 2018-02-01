@extends('frontend.layouts.ev.customer')
@section('content')

<div class="col-md-10 no-padding">
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