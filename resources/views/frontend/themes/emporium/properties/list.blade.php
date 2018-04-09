@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'List Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
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
								<h6>{{$slug}}</h6>
								<h2><a href="{{$slider_row->slider_link}}">{{$slider_row->slider_title}}</a></h2>
								<p>{{$slider_row->slider_description}}</p>
							</div>
						</div>
					@endforeach
				</div>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon"/>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon"/>
				</a>
			</div>
		@endif
    </section>
    {{-- Search Result --}}
    <section id="luxury-hotel-selection" class="search-result">
        <div class="container-fluid">
			@if($propertiesArr)
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2 class="heading">{{$total_record}} Hotel(s) Found for {{$slug}}</h2>
					</div>
				</div>
				{{--*/ $rw = 1 /*--}}
				<div class="row" data-option="property-grid-list">
					@foreach($propertiesArr as $props)
						@if($rw%20==0)
							{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $resultads = CommonHelper::getGridResultAds('grid_results', $adscatid) /*--}}
							@if(!empty($resultads['resultads']))
								<div class="col-sm-6 col-md-6 col-lg-4">
									<div class="hotel-card">
										<figure>
											<img src="{{URL::to('uploads/users/advertisement/'.$resultads['resultads']->adv_img)}}" />
											<a href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}" class="content-overlay">
												<h5>{{ $resultads['resultads']->adv_title}}</h5>
											</a>
										</figure>
										<div class="title">
											<h3><a href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}">{{ $resultads['resultads']->adv_title}}</a></h3>
										</div>
									</div>
								</div>
							@endif
						@else
							<div class="col-sm-6 col-md-6 col-lg-4">
								<div class="hotel-card">
									<figure>
										{{--*/ $propertyImage = CustomQuery::getPropertyImage($props->id); /*--}}

										@if(!empty($propertyImage) && count($propertyImage)>0)
											
											@if(isset($propertyImage))
												<img alt="{{ $propertyImage->file_name }}" src="{{$propertyImage->img_src}}" />
											@endif
										@endif
										
										<a href="{{URL::to($props->property_slug)}}" class="content-overlay">
											<h5>{{ $props->property_name}}</h5>
										</a>
									</figure>
									<div class="title">
										<h3><a href="{{URL::to($props->property_slug)}}">{{ $props->property_name}}</a></h3>
										<a href="{{URL::to($props->property_slug)}}" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
									</div>
								</div>
							</div>
						@endif
						@if($rw%3==0)

						@endif
						{{--*/ $rw++ /*--}}
					@endforeach	
				</div>
			@endif
        </div>
    </section>
    {{--  Search Result end --}}



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
    @include('frontend.themes.emporium.layouts.sections.grid_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/pdpage-css.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/search-result.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
		$(document).ready(function () {
			$(document).on('change', '#myRange', function () {
				var datObj = window.location.search;
				datObj =  datObj+'?filter_max_price=' + $(this).val();
				window.history.pushState("object or string", "Title", datObj);
				priceFilterAjax();
			});
		});
		
		var pageCounter = 2;
		var it_scroll = false;
		var totalPage = '{{$total_pages}}';
		$(window).scroll(function () {

			if (pageCounter > totalPage) {
				return false;
			} else {
				it_scroll = true;
				scrollDataAjax(it_scroll, pageCounter);

			}
			pageCounter++;

		});
		function scrollDataAjax(it_scroll, pageCounter){
			if(it_scroll==true) {
				var str = window.location.search;
				if(str.match(/filter_max_price/g))
				{
					var datObj = window.location.search+'&page='+pageCounter;
				}
				else
				{
					var datObj = window.location.search+'?page='+pageCounter;
				}
                    datObj =  datObj+'&s={{$slug}}';


				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/search-property-ajax'+datObj;
				params['successCallbackFunction'] = renderPropertyList;
				doAjax(params);
			}
		}

		function renderPropertyList(data){
			$.each(data.properties, function (idx, obj) {
				if(idx==20)
				{
					var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
					dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
					dataGridHtml +='</a>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					$('[data-option="property-grid-list"]').append(dataGridHtml);
				}
				else
				{
					var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					//var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + obj.img_src + '" />';
					dataGridHtml +='<a href="'+obj.property_slug+'" class="content-overlay">';
					dataGridHtml +='<h5>'+obj.property_name+'</h5>';
					if(obj.category_name!=undefined && obj.category_name!=""){
						dataGridHtml +='<p>From € '+obj.price+' '+obj.category_name+'</p>';
					}else {
						dataGridHtml +='<p>From € '+obj.price+'</p>';
					}

					dataGridHtml +='</a>';
					dataGridHtml +='<div class="pricelabel">From EUR '+obj.price+' / night</div>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+BaseURL+'/'+obj.property_slug+'">'+obj.property_name+'</a></h3>';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="cartlink"><i class="fa fa-shopping-cart"></i></a>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					$('[data-option="property-grid-list"]').append(dataGridHtml);
				}
			});
		}
		
		function priceFilterAjax(){
			
				var datObj = window.location.search;
                    datObj =  datObj+'&s={{$slug}}';
					
				var params = $.extend({}, doAjax_params_default);
				params['url'] = BaseURL + '/search-property-ajax'+datObj;
				params['successCallbackFunction'] = renderPropertyListPriceFilter;
				doAjax(params);
			
		}
		
		function renderPropertyListPriceFilter(data){
			$('[data-option="property-grid-list"]').html('');
			var dataGridHtml = '';
			$.each(data.properties, function (idx, obj) {
				if(idx==20)
				{
					dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
					dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
					dataGridHtml +='</a>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
				}
				else
				{
					dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					//var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + obj.img_src + '" />';
					dataGridHtml +='<a href="'+obj.property_slug+'" class="content-overlay">';
					dataGridHtml +='<h5>'+obj.property_name+'</h5>';
					if(obj.category_name!=undefined && obj.category_name!=""){
						dataGridHtml +='<p>From € '+obj.price+' '+obj.category_name+'</p>';
					}else {
						dataGridHtml +='<p>From € '+obj.price+'</p>';
					}

					dataGridHtml +='</a>';
					dataGridHtml +='<div class="pricelabel">From EUR '+obj.price+' / night</div>';
					dataGridHtml +='</figure>';
					dataGridHtml +='<div class="title">';
					dataGridHtml +='<h3><a href="'+BaseURL+'/'+obj.property_slug+'">'+obj.property_name+'</a></h3>';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="cartlink"><i class="fa fa-shopping-cart"></i></a>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
					dataGridHtml +='</div>';
				}
			});
			$('[data-option="property-grid-list"]').html(dataGridHtml);
		}
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection