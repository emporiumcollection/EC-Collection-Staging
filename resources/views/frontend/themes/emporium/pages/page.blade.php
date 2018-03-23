@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')

<!-- Restaurant slider starts here -->
<section class="sliderSection termConditionSlider">
	@if(!empty($pageslider))
	  <div id="restaurantSlider" class="carousel" data-ride="carousel">
		<!-- Indicators -->
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			@foreach($pageslider as $key => $slider_row)
			  <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
				<div class="carousel-caption">
				  <h1>{{$slider_row->slider_title}}</h1>
				  <p>{{$slider_row->slider_description}}</p>
				  <button type="button" class="button viewGalleryBtn">Contact us</button>
				</div>
			  </div>
			@endforeach
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
		  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
		</a>
		<a class="right carousel-control" href="#restaurantSlider" data-slide="next">
		  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
		</a>
	  </div>
	  <span class="scrollNextDiv"><a class="scrollpage" href="#termConditionSec">Scroll Down</a></span>
	@endif
</section>


<!-- Terms And Conditions starts-->
<div id="termConditionSec" class="termAndConditionSec">
   {!! nl2br($pagecontent) !!}
</div>
<!-- Terms And Conditions ends -->

@endsection

{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@show

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.common_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('themes/emporium/js/smooth-scroll.js') }}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection