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