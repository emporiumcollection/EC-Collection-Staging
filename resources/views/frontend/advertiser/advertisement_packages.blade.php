@extends('frontend.layouts.ev.customer')
@section('content')

<div class="col-md-10 no-padding">
	<!-- start contact form section -->
	<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
		<div class="container-fluid">
			<div class="stepwizard">
				<div class="stepwizard-row setup-panel">
					<div class="stepwizard-step">
						<a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
						<p>Step 1</p>
					</div>
					<div class="stepwizard-step">
						<a type="button" class="btn btn-default btn-circle cursor">2</a>
						<p>Step 2</p>
					</div>
					
				</div>
			</div>
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
													<div class="expeience-small-text harman">Advertisement Packages</div>
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

@section('css')
<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">
	<style>
		.image-slider-margin-align {
			margin-bottom: 0;
			margin-top: 0;
		}
		header.haside {
			z-index: 1;
		}
		img.img-responsive.object-fit-size {
			object-fit: cover;
		}
		.book-now-page.mobile-show-hide {
			display: none;
		}
		.book-now-page.desktop-show-hide {
			display: none;
		}
		.slider-sec-side-text-bg {
			margin-top: -103%;
		}
		.hotels-logo {
			background: #252525 none repeat scroll 0 0;
		}
		.right-menus ul li a {
			border-bottom: 1px solid #414246;
		}
		.new-sidebar-sk .panel-heading.custom-heading {
			border-bottom: 1px solid #414246;
		}
		.heading-stying {
			font-size: 12px !important;
		}
		.new-sidebar-sk .panel-heading.custom-heading:hover {
			background-color: #89837B !important;
		}
		.right-menus ul li a {
			background-color: #1E2023;
			border-bottom: 1px solid #414246;
			color: #fff;
			display: block;
			font-size: 12px !important;
			padding: 25px 0 25px 21px;
			text-transform: uppercase;
			background: rgba(37,37,37,1.0);
		}
		.hotel-book-now {
			background: #ABA07C;
			color: #000;
			font-size: 25px;
			height: 71px;
			margin: 0px 0px 10px 3px;
			opacity: 1;
			overflow-wrap: break-word;
			padding: 27px 5px;
			position: absolute;
			text-align: center;
			text-transform: uppercase;
			width: 174px;
			z-index: 99;
			float: left;
		}
		.editorial-image-slider-previous-btn {
			margin-left: 35% !important;
		}
		.image-slider-container .editorial-image-slider-btns {
			margin-top: -100px !important;
		}
		header.haside {
			right: 0 !important;
			position: fixed;
			top: 0;
			width: 65px;
			left: unset !important;
		}
		.next-hotel-show-pannel {
			right: 66px;
			position: absolute;
			top: 0;
			width: 250px;
			left:unset;
		}
		/* AIC Harman email sidebar css */

		.site-aside {
			position: fixed;
			top: 0;
			right: 0;
			height: 100%;
			overflow-x: visible;
			z-index: 1028;
		}
		.contact-aside {
			border-radius: 0px;
			transition: .5s;
			position: fixed;
			top: 124px;
			left: calc(100% - 65px);
			width: 340px;
			background: #272727;
			color: #fff;
			font-size: 15px;
			right: 0;
		}
		.contact-aside ul {
			padding: 7px 0px 0px 0px;
			list-style: none;
		}
		.contact-aside li {
			padding: 6px 0px 6px 18px;
			margin: 0px 0px 1px 0px;
		}
		.contact-aside li a {
			margin-left: 11px;
			font-size: 13px;
			color: #ABA07C;
		}
		.contact-aside [class*="icon-"] {
			display: inline-block;
			width: 24px;
			text-align: center;
			margin-right: 4px;
			float: right;
		}
		.contact-aside li + li {
			border-top: 1px solid #4A4A4A;
		}
		.contact-aside .icon-mail {
			position: relative;
			top: 2px;
		}
		.contact-aside.active {
			left: calc(100% - 290px);
			background: #1e2023 !important;
			color: #fff !important;
		}

		.asideIclass {
			float: left;
			margin-top: 3px;
			margin-right: 13px;
			margin-left: 8px;
			color: #ABA07C;
			font-size: 16px;
		}
		.neww-footer .container {
			width: auto;
		}
		#formerrors { color:#ff0000;}

		/*AIC model */

		.book-button.open-show_more-page.hotel-btn {
			background: #ABA07C none repeat scroll 0 0;
			color: #fff;
			font-size: 15px;
			margin-left: 0 !important;
			margin-top: 52px;
			max-height: 95px;
			min-height: 95px;
			opacity: 0.83;
			padding: 34px 27px;
			text-align: center;
			text-transform: uppercase;
			width: 174px;
		}

		.VegasModelDialog {
			width: 100%;
			margin: 4px auto;
		}

		.vegasModelFade {
			position: fixed;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			z-index: 1050;
			display: none;
			overflow: hidden;
			-webkit-overflow-scrolling: touch;
			outline: 0;
			background-color: black;
			opacity: 0.8;
			height: 100%;
			overflow-x: hidden;
			overflow-y: hidden;
		}

		.vegasModelContent {
			background: rgba(0, 0, 0, 0.92) none repeat scroll 0 0;
			opacity: 1;
			min-height: 63em;
			border-radius: 0px;
			float: left;
		}

		.vegasModelHeader {
			border-bottom: none;
		}

		.vegasModelFooter {
			border-top: none;
		}

		.SlickVegasWidth {

			width: 18.5%;
		}

		.vegasGallery1 {
			min-height: 500px;
			padding: 0px 0px 0px 0px !important;
			float: left;
			width: 81.333%;
		}

		.Vegasregular {
			width: 100%;
			margin: 0 auto;
			float: left;
			visibility: visible;
		}

		.VegasCloseButton {
			color: #ABA07C;
			opacity: 1;
			font-size: 50px;
			box-shadow: none;
			text-shadow: none;
		}

		.VegasCloseButton:hover {
			color: #ABA07C;
			opacity: 1;
			font-size: 50px;
			box-shadow: none;
			text-shadow: none;
		}

		.VegasPopLogo {
			width: 20%;
			margin: 0 auto;
			padding-top: 100px;
			text-align: center;
			display: block;
		}

		.VegasDetailInner {
			padding: 20px;
			padding-top: 0px;
		}

		.grid-item {
			height: auto;
		}

		.vogasThumbnail img {
			width: 100%;
		}

		.vogasThumbnail {
			padding: 0px;
			background: none;
			border: none;
		}
		.Sidenavimg {
			width: auto;
			min-width: 200px;
		}

		/* AIC alider */

		.slider-sec-side-text-bg {
			margin-top: -580px;
		}
		.image-slider-btns-bg {
			background-color: #252525;
			color: #fff;
			float: right;
			margin-top: -157px;
			opacity: 0.85;
			padding: 49px 11px;
			width: 35%;
		}


	</style>
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