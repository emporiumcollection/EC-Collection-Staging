@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Instagram')
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
			<section id="instagran" class="sections-instagram">
                <div class="full-width">
                    <div data-is data-is-api="{{ url('runInsta')}}"
                         data-is-source="{{!empty($instagram_channel) ? $instagram_channel : '@firmdale_hotels' }}"
                         data-is-rows="2" data-is-limit="0" data-is-columns="5"></div>
                </div>
            </section>
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
    @include('frontend.themes.emporium.layouts.sections.social_instagram_sidebar')
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
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
		$(document).ready(function () {
			// Open Left Navigation For Destinations on Page Load
			@if(Request::segment(1)=='social-instagram')
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