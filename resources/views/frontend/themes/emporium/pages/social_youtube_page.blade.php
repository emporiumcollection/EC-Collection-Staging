@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			@if($channel_url!='')
				<div data-yt data-yt-channel="{{ $channel_url }}" data-yt-content-columns="4"  data-yt-content-rows="3"></div>
			@endif
		</div>
	</div>

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
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection