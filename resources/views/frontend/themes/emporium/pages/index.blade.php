@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage, Luxury Hotel Booking, Luxury 5 Star Hotels')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Page's Content Part --}}
@section('content')
    <!-- slider starts here -->
         <section class="sliderSection">
            @if(!empty($slider))
              <div id="myCarousel" class="carousel" data-ride="carousel">
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner">
                    @foreach($slider as $key => $slider_row)
                      <div class="item {{($key == 0)? 'active' : ''}}">
		      <div class="image-overaly-bg"></div>
                         <a href="{{$slider_row->slider_link}}"><img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}"></a>
                         <div class="carousel-caption">
                            <h1><a href="{{$slider_row->slider_link}}">{{$slider_row->slider_title}}</a></h1>
                            <p><a href="{{$slider_row->slider_link}}" style="color:white;">{{$slider_row->slider_description}}</a></p>
                         </div>
                      </div>
                    @endforeach
					{{--*/ $sliderads = CommonHelper::getSliderAds('landing_slider', 'Hotel') /*--}}
					@if(!empty($sliderads['leftsidebarads']))
						@foreach($sliderads['leftsidebarads'] as $ads)
							<div class="item">
								<a ><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}" alt="{{$ads->adv_title}}"></a>
								<div class="carousel-caption">
									<h1><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a></h1>
									<p><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}" style="color:white;">{{$ads->adv_desc}} </a></p>
								</div>
							</div>
						@endforeach
					@endif
                 </div>
                 <!-- Left and right controls -->
                 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                 <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                 </a>
                 <a class="right carousel-control" href="#myCarousel" data-slide="next">
                 <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                 </a>
              </div>
            @endif
            <div class="sliderFooter">
                {{--*/ $landing_menus = SiteHelpers::menus('landing') /*--}}
               @if(!empty($landing_menus))
                 <ul>
                  @foreach ($landing_menus as $fmenu)
                    <li>
                        <a @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}" @endif >
                          @if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                              {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                          @else
                              {{$fmenu['menu_name']}}
                          @endif
                        </a>
                    </li>
                  @endforeach
					<li><a href="javascript:void(0);" class="termAndConditionBtn">Contact us</a></li>
                 </ul>
                @ENDIF
            </div>
         </section>
		 
		@include('frontend.themes.emporium.layouts.sections.contactus_popup')
@endsection

{{--For Right Side Icons --}}
      @section('right_side_iconbar')
      
      @include('frontend.themes.emporium.layouts.sections.home_right_iconbar')
      @endsection

{{-- For Include style files --}}
@section('head')
    @parent
	<link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
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
			$('#conatctform').parsley().on('field:validated', function() {
			var ok = $('.parsley-error').length === 0;
			$('.bs-callout-info').toggleClass('hidden', !ok);
			$('.bs-callout-warning').toggleClass('hidden', ok);
			})
			.on('form:submit', function() {
			submit_contact_request();
			return false; // Don't submit form for this demo
			});
		});
		
		function submit_contact_request()
		{
			$.ajax({
				  url: "{{ URL::to('save_query')}}",
				  type: "post",
				  data: $('#conatctform').serialize(),
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
						htmli +='<i class="icon-checkmark-circle"></i> Contact Form Submitted Successfully </div>';
						$('#formerrors').html(htmli);
						$('#conatctform')[0].reset();
					}
				  }
			});
		}
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    
@endsection
