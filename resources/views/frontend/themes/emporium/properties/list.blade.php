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
					<img src="images/editorial-left-arrow.png" alt="Icon"/>
				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<img src="images/editorial-right-arrow.png" alt="Icon"/>
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
				<div class="row">
					@foreach($propertiesArr as $props)
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
										<p>From € {{$props->price}} {{(isset($props->category_name))? '| '.$props->category_name : ''}}</p>
									</a>
									<div class="pricelabel">From EUR {{$props->price}} / night</div>
								</figure>
								<div class="title">
									<h3><a href="{{URL::to($props->property_slug)}}">{{ $props->property_name}}</a></h3>
									<a href="{{URL::to($props->property_slug)}}" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
								</div>
							</div>
						</div>
						@if($rw%3==0)
							</div>
							<div class="row">
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
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection