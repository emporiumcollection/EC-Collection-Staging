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
    <section id="search-result-slider" class="luxuryHotelSlider">
		 @if(!empty($slider))
			<div id="myCarousel" class="carousel" data-ride="carousel">
				<!-- Indicators -->
				{{--  Wrapper for slides --}}
				<div class="carousel-inner">
					@foreach($slider as $key => $slider_row)
						<div class="item {{($key == 0)? 'active' : ''}}" style="background-image:url({{url('uploads/slider_images/'.$slider_row->slider_img)}});">
							<div class="carousel-caption">
								<h6>Membership</h6>
								<h2>
									@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}">{{$slider_row->slider_title}}</a>
									@else
										{{$slider_row->slider_title}}
									@endif
								</h2>
								<p>@if($slider_row->slider_link!='#' && $slider_row->slider_link!='')
										<a onclick="return !window.open(this.href, '{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($slider_row->slider_link, 'http://') || strpos($slider_row->slider_link, 'https://')) === false) ? $slider_row->slider_link : 'http://'.$slider_row->slider_link }}" style="color:white;	">{{$slider_row->slider_description}}</a>
									@else
										{{$slider_row->slider_description}}
									@endif


								</p>
							</div>
						</div>
					@endforeach
					
				</div>
				@if(count($slider) > 1)
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon"/>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon"/>
					</a>
				@endif
			</div>
		@endif
    </section>


<div id="membership" class="membership-types">
    @if(!empty($packages))                        
        {{--*/ $k=1; /*--}} 
		<div id="mem-accordion" class="panel-group">
            @foreach($packages as $key=>$package)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="click0" data-toggle="collapse" data-parent="#mem-accordion" href="#collapse_{{$k}}">{{$package->package_title}}</a>
                    </h4>
                </div>
                <div id="collapse_{{$k}}" class="panel-collapse collapse <?php echo ($k==1) ? 'in' : '' ?>">
                    <div class="panel-body magin-top-30">
                        <div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                            @if($package->package_image!='')
                                <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                            @endif
                            </div>
                            <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                <div class="row">
                                    <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                        <p>{!! nl2br($package->package_description) !!}</p>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                            @if($package->package_price_type!=1)  
                                                <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                            @else
                                                <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>                
                                <div class="row" style="margin-top: 10px;">
                                                                                                                         
                                    <div class="col-lg-12 m--align-right">
                                        <div>                                                                        
                                            <a class="btnMembershipTypeJoin" href="javascript:void(0);">Join The Club</a>
                                        </div>
                                    </div>
                                   
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--*/ $k++;  /*--}}
            @endforeach				
        </div>
    @endif
</section>

@include('frontend.themes.emporium.layouts.sections.contactus_popup')

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
    <link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/search-result.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    <style>
        .membership-types {
            width: 100%;
            display: inline-block;
            padding: 70px 0px 70px 0px;
            background: #252525;            
        }
        .btnMembershipTypeJoin {
            border: 1px solid #fff;
            border-radius: 0px;
            color: #fff;
            font-size: 12px;
            padding: 12px 20px;
            text-transform: uppercase;
            margin-left: 10px;
            float: right;
            text-decoration: none;
            margin-top: 65px;
        }
        .btnMembershipTypeJoin:hover, .btnMembershipTypeJoin:focus {
            color: #fff;
        }
        #mem-accordion .panel-body{            
            border: 0px !important;
        }
        #mem-accordion .panel-body h6{
            color:#fff !important;
        }
        #mem-accordion .panel{
            background: transparent;
            color: #fff;
            border: 0px !important;
        } 
        #mem-accordion .panel-default>.panel-heading{
            background: transparent !important;
            color: #fff;
        }
        #mem-accordion .panel-heading{
            border-top: 1px solid #414246;
        }
        #mem-accordion .panel-group .panel-heading+.panel-collapse>.panel-body{
            border: 0px !important;
        }
        #mem-accordion .panel-default:last-child{
            border-bottom: 1px solid #414246 !important;
        }
        #mem-accordion .panel-group .panel+.panel {
            margin-top: 0px !important;
        }
        #mem-accordion .panel-title{
            margin-left: 20px;
        }
    </style>
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('themes/emporium/js/smooth-scroll.js') }}"></script>
	<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('themes/emporium/js/scroll.js') }}"></script>
	<script type="text/javascript">
	VanillaTilt.init(document.querySelector(".your-element"), {
		max: 25,
		speed: 400
	});
</script>

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
        $(document).ready(function(){
           $(".btnMembershipTypeJoin").click(function(e){
                e.preventDefault();
                $(".clicktologin").trigger("click");
                $(".signInPopupButton").trigger('click');
            }); 
        });
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection