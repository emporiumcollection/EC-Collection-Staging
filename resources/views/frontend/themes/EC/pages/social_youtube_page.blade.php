@extends('frontend.themes.EC.layouts.main')
{{--  For Title --}}
@section('title', 'Youtube Channel')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
<div class="content-em1">
    <div class="content-em">
        <div class="container pt-5">
        	<div class="row mt-5">                
        		<div class="col-md-12 col-sm-12 col-xs-12">
        			@if($channel_url!='')
        				<div data-yt data-yt-channel="{{ $channel_url }}" data-yt-content-columns="4"  data-yt-content-rows="3" data-yt-key="AIzaSyAry0SsGLQVtzh61SGb2-OtBpAWtZh7zGo"></div>
        			@endif
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection