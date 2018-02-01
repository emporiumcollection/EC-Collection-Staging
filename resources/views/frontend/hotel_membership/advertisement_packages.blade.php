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


@section('script')
	<script>
        $(".editorial-image-slider-previous-btn").click(function (event) {
            event.preventDefault();

            var index = $(this).parent().parent().find(".image-slider li.active").index();
            $(this).parent().parent().find(".image-slider li.active").removeClass("active");
            if (index == 0) {
                var lindex = $(this).parent().parent().find(".image-slider li:last-child").index() + 1;
                $(this).parent().parent().find(".image-slider li:nth-child(" + lindex + ")").addClass("active");
                $(this).parent().parent().find(".images-count").html(lindex + " / " + $(this).parent().parent().find(".image-slider li").length);
            } else
            {
                var rlindex = index;
                $(this).parent().parent().find(".image-slider li:eq(" + rlindex + ")").addClass("active");
                $(this).parent().parent().find(".images-count").html(index + " / " + $(this).parent().parent().find(".image-slider li").length);
            }


        });

        $(".editorial-image-slider-next-btn").click(function (event) {
            event.preventDefault();

            var index = $(this).parent().parent().find(".image-slider li.active").index();
            if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
                index = -1;
            }
            $(this).parent().parent().find(".image-slider li.active").removeClass("active");
            $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 1) + ")").addClass("active");

            $(this).parent().parent().find(".images-count").html((+index + 1) + " / " + $(this).parent().parent().find(".image-slider li").length);

        });

        setInterval(function () {
            var index = $(".auto-slider ul.image-slider > li.active").index();
            if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
                index = -1;
            }

            $(".auto-slider ul.image-slider > li.active").removeClass("active");
            $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 1) + ")").addClass("active");
            $(".auto-slider .images-count").html((+index + 1) + " / " + $(".auto-slider ul.image-slider > li").length);

        }, 40000);
		
		$(document).on('click', '.open-show_more-page', function () {
            $('.single-right-text-product').html('');
            $('.rmimgp').html('');
            $.ajax({
                url: "{{ URL::to('fetchadvertisementpackagedetails')}}" + '/' + $(this).attr('rel'),
                type: "get",
                success: function (data) {
                    $('.rmimgp').html('<div class="right-text-section"></div>');
                    var imagesPro = '';
                    imagesPro += '<div class="text-section">';
                    imagesPro += '<h2>' + data.pdata.space_title + '</h2>';
                    
                    imagesPro += '</div>';
                    imagesPro += '<div class="book-btn-sec">';
                    imagesPro += '<div class="hotel-book-price">Price on request</div>';
					imagesPro += '<a href="#"><div class="hotel-book-now">Get in touch</div></a>';
                    imagesPro += '</div>';
                    imagesPro += '</div>';
                    $('#popupopn .single-right-text-product').html(imagesPro);
                    $('.show_more-page').css("width", "100%");
                }
            });
            return false;
        });
    </script>
@endsection