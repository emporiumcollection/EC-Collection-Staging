@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Social Wall')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			{{--*/ $twitterArr = array(); $facebookArr = array(); $googleArr = array(); $youtubeArr = array(); $pinterestArr = array(); $vimeoArr = array(); /*--}}	
			@if(!empty($socialpropertiesArr))
								
				@if($socialpropertiesArr->social_twitter!='')
					{{--*/ $twitterArr[] = $socialpropertiesArr->social_twitter; /*--}}
				@endif
				@if($socialpropertiesArr->social_facebook!='')
					{{--*/ $facebookArr[] = $socialpropertiesArr->social_facebook; /*--}}
				@endif
				@if($socialpropertiesArr->social_google!='')
					{{--*/ $googleArr[] = $socialpropertiesArr->social_google; /*--}}
				@endif
				@if($socialpropertiesArr->social_youtube!='')
					{{--*/ $youtubeArr[] = $socialpropertiesArr->social_youtube; /*--}}
				@endif
				@if($socialpropertiesArr->social_pinterest!='')
					{{--*/ $pinterestArr[] = $socialpropertiesArr->social_pinterest; /*--}}
				@endif
				
				@if($socialpropertiesArr->social_vimeo!='')
					{{--*/ $vimeoArr[] = $socialpropertiesArr->social_vimeo; /*--}}
				@endif
				
				<p style="text-align:center; color:#ABA07C;">You are viewing the social activity of : {{$socialpropertiesArr->property_name}}</p>
			@endif
			<div id="social-stream"></div>
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
    @include('frontend.themes.emporium.layouts.sections.social_stream_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
	
	<link rel="stylesheet" type="text/css" href="{{ asset('sximo/jquery_social_stream/css/dcsns_wall.css')}}" media="all" />
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/inc/js/jquery.plugins.js')}}"></script>
	<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/inc/js/jquery.site.js')}}"></script>
	<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/js/jquery.social.stream.wall.1.8.js')}}"></script>
	<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/js/jquery.social.stream.1.6.1.min.js')}}"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#social-stream').dcSocialStream({
				feeds: {
					twitter: {
						id: '{{implode(",",$twitterArr)}}',
						url:'{{ URL::to("sximo/jquery_social_stream/twitter.php")}}'
					},
					facebook: {
						id: '{{implode(",",$facebookArr)}}',
						out: 'intro,thumb,text,user,share',
						url:'{{ URL::to("sximo/jquery_social_stream/facebook.php")}}'
					},
					google: {
						id: '{{implode(",",$googleArr)}}'
					},
					vimeo: {
						id: '{{implode(",",$vimeoArr)}}'
					},
					youtube: {
						id: '{{implode(",",$youtubeArr)}}',
						thumb: 'medium',
						out: 'intro,thumb,title,user,share'
					},
					pinterest: {
						id: '{{implode(",",$pinterestArr)}}',
						url:'{{ URL::to("sximo/jquery_social_stream/rss.php")}}'
					}
				},
				rotate: {
					delay: 0
				},
				twitterId: 'designchemical',
				control: false,
				filter: true,
				wall: true,
				center: true,
				cache: true,
				max: '5',
				limit: 5,
				iconPath: 'images/dcsns-dark/',
				imagePath: 'images/dcsns-dark/',
				style: {
					layout: 'modern',
					colour: 'light'
				},
			});
						 
		});
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection