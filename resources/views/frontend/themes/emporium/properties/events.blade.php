@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Property Event Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')



SHow Events Here

	

	
	
@endsection


{{--For Right Side Icons --}}
@section('right_side_iconbar')

	@parent
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
	<link href="{{ asset('themes/emporium/css/restaurant-css.css') }}" rel="stylesheet">
@endsection


{{-- For Include Top Bar --}}
@section('top_search_bar')
    
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.resto_sidebar')
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
	
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
		 window.ParsleyConfig = {
			errorsWrapper: '<div></div>',
			errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
			errorClass: 'has-error',
			successClass: 'has-success'
		};

		$(function () {
			$('#reserve_resto_table_form').parsley().on('field:validated', function() {
			var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
			})
			.on('form:submit', function() {
			submit_resto_book_request();
			return false; // Don't submit form for this demo
			});
		});
		
		function submit_resto_book_request()
		{
			$.ajax({
				  url: "{{ URL::to('reserve_resto_table_request')}}",
				  type: "post",
				  data: $('#reserve_resto_table_form').serialize(),
				  dataType: "json",
				  success: function(data){
					var html = '';
					if(data.status=='error')
					{
						html +='<ul class="parsley-error-list">';
						$.each(data.errors, function(idx, obj) {
							html +='<li>'+obj+'</li>';
						});
						html +='</ul>';
						$('#formerrors').html(html);
					}
					else{
						var htmli = '';
						htmli +='<div class="alert alert-success fade in block-inner">';
						htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
						htmli +='<i class="icon-checkmark-circle"></i> Restaurant Table Booking Request Submitted Successfully </div>';
						$('#formerrors').html(htmli);
						$('#reserve_resto_table_form')[0].reset();
					}
				  }
			});
		}
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection