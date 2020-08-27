@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Youtube Channel')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')

	<div class="row margin-top-90">
        <div class="col-md-12 col-sm-12 col-xs-12">
            
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			@if($channel_url!='')
				<div data-yt data-yt-channel="{{ $channel_url }}" data-yt-content-columns="4"  data-yt-content-rows="3" data-yt-key="AIzaSyAry0SsGLQVtzh61SGb2-OtBpAWtZh7zGo"></div>
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
    @include('frontend.themes.emporium.layouts.sections.social_youtube_sidebar')
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
	<script>
		$(document).ready(function () {
			// Open Left Navigation For Destinations on Page Load
			@if(Request::segment(1)=='social-youtube')
				var datObj = {};
				datObj.catID = '{{$catid}}';
				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/destination/destinatinos-ajax';
				params['data'] = datObj;
				params['successCallbackFunction'] = renderDestinationSocialYoutube;
				doAjax(params);
			@endif
		});
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection