@extends('frontend.layouts.ev.customer')
@section('content')

<div class="col-md-10 no-padding">
	<!-- start contact form section -->
        <!-- start page not found section -->
        <section id="home" class="no-padding parallax mobile-height wow fadeIn" data-stellar-background-ratio="0.5" style="background-image:url('http://placehold.it/1920x1100');">
            <div class="opacity-full bg-extra-dark-gray"></div>
            <div class="container position-relative full-screen">
                <div class="slider-typography text-center">
                    <div class="slider-text-middle-main">
                        <div class="slider-text-middle">
                            <div class="bg-black-opacity-light width-80 center-col sm-width-80">
                                <div class="padding-fifteen-all xs-padding-20px-all">
                                    <div class="a--cstm-thenk title-large text-white font-weight-600 display-block margin-30px-bottom xs-margin-10px-bottom">THANK YOU</div>
                                    <span class="ai-cstm-text-tank text-medium-gray width-80 display-block center-col text-large sm-width-100">Thank you for submitting your information, you will be contact soon by our customer service department.</span>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page not found section -->



	<!-- pop up -->
</div>
@endsection

@section('css')

	<link rel="stylesheet" href="{{ asset('sximo/assets/css/custom-ai.css')}}">

    <style>
.padding-fifteen-all {
    padding: 15%;
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