@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Page's Content Part --}}
@section('content')
 
   


@if(!empty($slider))
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="row">
    <div class="slider multiple-items">


@foreach($slider as $key => $slider_row)
      <div>
        <div class="col-md-6 col-sm-6 col-xs-12">
         <a  href="{{ $slider_row->slider_link }}" >
		          <img src="{{ url('uploads/slider_images/'.$slider_row->slider_img)}}" class="img-responsive">
		          {{-- url('uploads/slider_images/'.$slider_row->slider_img) --}}
    		  </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 slidertext">
          <h6 class="cat-links">
                        <a href="{{ $slider_row->slider_link }}" rel="category tag" tabindex="0" class="categoryname" style="outline: none;">{{$slug}}</a>
                    </h6>
                    <h5 class="entry-title">
                    <a href="{{ $slider_row->slider_link }}" rel="bookmark" tabindex="0" style="outline: none;"> {{$slider_row->slider_title}}</a>
                </h5>
             <p> <a  href="{{ $slider_row->slider_link }}" >    {{$slider_row->slider_description}}  </a></p>
             <a class="remoreslider" href="{{ $slider_row->slider_link }}">Read More</a>
        </div>
      </div>

@endforeach   


     </div>
    </div>
  </div>
@endif

  <div class="col-md-12 col-sm-12 col-xs-12 misonrysection">
  	@if($propertiesArr)
  	<h4 class="bannerbtm">{{$total_record}} Luxury Hotel(s) Found for {{$slug}} {{$dateslug}}</h4>
	@endif
    <div class="row">

 
@if($featurePropertiesArr)
			<div class="grid">
		@foreach($featurePropertiesArr as $props)
			
			<?php
				$url=URL::to($props->property_slug);
				if(Request::has("departure") || Request::has("arrive"))
				{
					$url.='?arrive='.Request::input("arrive")."&departure=".Request::input("departure");
				}


			?> 


    <div class="col-md-6 col-sm-6 col-xs-12 biggrid">
        <div class="row">
          <div class="gridinner">
            <a href="{{ $url }}" title="{{ $props->property_name}}">
          		  <img src="{{ URL::to('propertyimagebyid/'.$props->id)}}" class="img-responsive" alt="{{ $props->property_name}}" title="{{ $props->property_name}}">
               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
           	</a>
            <div class="gridtext">
              <h5 class="entry-title">
                  <a href="{{ $url}}" rel="bookmark" style="">{{ $props->property_name}}   </a>
                   <a href="{{ $url }}"><i class="fa fa-shopping-cart"></i></a>
              </h5>
               <p>  {{ $props->property_usp}}</p>
                  <a class="read-more-link" href="{{ $url }}"  title="Read More">Read More</a>
            </div>
          </div>
        </div>
      </div>
	@endforeach
</div>
@endif

      <div class="clearfix"></div>
    <div class="grid">
    


@if($propertiesArr)
{{--*/ $rw = 1 /*--}}
		@foreach($propertiesArr as $props)
			<?php
				$url=URL::to($props->property_slug);
				if(Request::has("departure") || Request::has("arrive"))
				{
					$url.='?arrive='.Request::input("arrive")."&departure=".Request::input("departure");
				}


			?> 
			@if($rw%19==0)
							{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $resultads = CommonHelper::getGridResultAds('grid_results', $adscatid) /*--}}
							@if(!empty($resultads['resultads']))
								 <div class="col-md-3 col-sm-3 col-xs-12 grid-item">
							        <div class="row">
							           <div class="gridinner">
							            <a href="#" >
							          		  <img src="{{URL::to('uploads/users/advertisement/'.$resultads['resultads']->adv_img)}}" class="img-responsive" >
							               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
							           	</a>
							            <div class="gridtext">
							              <h5 class="entry-title">
							                  <a href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}" rel="bookmark" style="">{{ $resultads['resultads']->adv_title}}   </a>
							                  <a href="#">Advertisement</a>
							              </h5>
							               
							                  <a class="read-more-link" href="{{ (strpos($resultads['resultads']->adv_link, 'http://') !== false) ? $resultads['resultads']->adv_link : 'http://'.$resultads['resultads']->adv_link }}">{{ $resultads['resultads']->adv_title}}</a>
							            </div>
							          </div>
							        </div>
							      </div>
							@endif
							@else
							      <div class="col-md-3 col-sm-3 col-xs-12 grid-item">
							        <div class="row">
							           <div class="gridinner">
							            <a href="{{URL::to($props->property_slug)}}" title="{{ $props->property_name}}">
							          		  <img src="{{ URL::to('propertyimagebyid/'.$props->id)}}" class="img-responsive" alt="{{ $props->property_name}}" title="{{ $props->property_name}}">
							               {{-- URL::to('propertyimagebyid/'.$props->id)--}}
							           	</a>
							            <div class="gridtext">
							              <h5 class="entry-title">
							                  <a href="{{URL::to($props->property_slug)}}" rel="bookmark" style="">{{ $props->property_name}}   </a>
							                  <a href="{{URL::to($props->property_slug)}}"><i class="fa fa-shopping-cart"></i></a>
							              </h5>
							               <p>  {{ $props->property_usp}}</p>
							                  <a class="read-more-link" href="{{URL::to($props->property_slug)}}" title="Read More">Read More</a>
							            </div>
							          </div>
							        </div>
							      </div>
							 @endif

      		{{--*/ $rw++ /*--}}
      @endforeach 
@endif

     
  </div>
  </div>
  <div class="col-md-12 col-xs-12 col-xs-12 text-center">
  @if($total_pages>1)
				<ul class="pagination">
	 				@for($i=1;$i<=$total_pages;$i++)
	 					<?php
							$url=Request::url().'?';
							$queryStrings=Request::query();
							if(isset($queryStrings['page']))
							{
								unset($queryStrings['page']);
							}
							foreach($queryStrings as $keyQuery=>$querystring):
								$url.=$keyQuery.'='.$querystring.'&';
							endforeach;
						?>
	 					 <li class="@if($i==$active_page) active @endif"><a href="{{ $url.'page='.$i }}">{{ $i }}</a></li>
	 				@endfor
	 
				</ul>
				@endif
				<div class="btmline"></div>
</div>
</div>
  









	<!-- Instagram Gallery Section -->
	@if($destination_category > 0)
		@if($destination_category_instagram != '')
			<section id="instagram-section">
				<div class="col-sm-12 text-center">
					<h2 class="heading">{{$slug}}</h2>
				</div>
				<section id="instagran" class="sections-instagram">
					<div class="full-width">
						<div data-is data-is-api="{{ url('runInsta')}}"
							 data-is-source="{{ $destination_category_instagram }}"
							 data-is-rows="2" data-is-limit="0" data-is-columns="5"></div>
					</div>
				</section>
			</section>
		@endif
	@endif

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
	<!-- instagram -->
	
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
	  <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/imagesloaded.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/slick.js')}}"></script>
   <script type="text/javascript">
   $('.multiple-items').slick({
    dots: true,
    arrows: false,
    autoplay: true,
    infinite: false,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    vertical: true,
    speed: 1000,
    autoplaySpeed:1000,
  });
  </script>
  <script type="text/javascript">
 // init Masonry
var $grid = $('.grid').masonry({
  // options...
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});
  </script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>

		@if((Request::has("arrive")))
		var todayDate = moment();
$('input[name="arrive"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY',
			daysOfWeek: [
				"SUN",
				"MON",
				"TUE",
				"WED",
				"THU",
				"FRI",
				"SAT"
			],
			monthNames: [
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December"
			],
			firstDay: 0
		},
		showDropdowns: true,
		singleDatePicker: true,
		startDate: '{{ Request::input("arrive")}}',
		minDate : todayDate
	});
@endif

		@if((Request::has("departure")))
		var todayDate = moment();
$('input[name="departure"]').daterangepicker({
		locale: {
			format: 'MM-DD-YYYY',
			daysOfWeek: [
				"SUN",
				"MON",
				"TUE",
				"WED",
				"THU",
				"FRI",
				"SAT"
			],
			monthNames: [
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December"
			],
			firstDay: 0
		},
		showDropdowns: true,
		singleDatePicker: true,
		startDate: '{{ Request::input("departure")}}',
		minDate : todayDate
	});
@endif
		$(document).ready(function () {
			$(document).on('change', '#myRange', function () {
				var datObj = window.location.search;
				if(datObj.match(/filter_max_price/g))
				{
					var str = datObj.split("?");
					datObj =  str[0]+'?filter_max_price=' + $(this).val();
				}
				else
				{
					datObj =  datObj+'?filter_max_price=' + $(this).val();
				}
				window.history.pushState("object or string", "Title", datObj);
				priceFilterAjax();
			});
			
			@if($dateslug!='')
				$('[data-action="search-by-date"]').trigger('click');
			@endif
		});
		
		var pageCounter = 2;
		var pagehgt = 1200;
		var it_scroll = false;
		var totalPage = '{{$total_pages}}';
		$(window).scroll(function () {
            if ($(window).scrollTop() < pagehgt) { return false; }

            if (pageCounter > totalPage) {
				return false;
			} else {
			//	it_scroll = true;
				//scrollDataAjax(it_scroll, pageCounter);
				//pagehgt = pagehgt + 1000;
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
				if(idx==19)
				{
					if(data.resultads)
					{
						var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
						dataGridHtml +='<div class="hotel-card">';
						dataGridHtml +='<figure>';
						var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
						dataGridHtml += '<img src="' + imgscr + '" />';
						dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
						dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
						dataGridHtml +='</a>';
						dataGridHtml +='<div class="pricelabel">Advertisement</div>';
						dataGridHtml +='</figure>';
						dataGridHtml +='<div class="title">';
						dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						$('[data-option="property-grid-list"]').append(dataGridHtml);
					}
				}
				else
				{
					var dataGridHtml ='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="content-overlay">';
					dataGridHtml +='<h5>'+obj.property_name+'</h5>';
					dataGridHtml +='</a>';
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
				if(idx==19)
				{
					if(data.resultads)
					{
						dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
						dataGridHtml +='<div class="hotel-card">';
						dataGridHtml +='<figure>';
						var imgscr = "{{URL::to('uploads/users/advertisement/')}}/" +data.resultads.adv_img;
						dataGridHtml += '<img src="' + imgscr + '" />';
						dataGridHtml +='<a href="'+data.resultads.adv_link+'" class="content-overlay">';
						dataGridHtml +='<h5>'+data.resultads.adv_title+'</h5>';
						dataGridHtml +='</a>';
						dataGridHtml +='<div class="pricelabel">Advertisement</div>';
						dataGridHtml +='</figure>';
						dataGridHtml +='<div class="title">';
						dataGridHtml +='<h3><a href="'+data.resultads.adv_link+'">'+data.resultads.adv_title+'</a></h3>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
						dataGridHtml +='</div>';
					}
				}
				else
				{
					dataGridHtml +='<div class="col-sm-6 col-md-6 col-lg-4">';
					dataGridHtml +='<div class="hotel-card">';
					dataGridHtml +='<figure>';
					var imgscr = BaseURL + '/propertyimagebyid/'+obj.id;
					dataGridHtml += '<img src="' + imgscr + '" />';
					dataGridHtml +='<a href="'+BaseURL+'/'+obj.property_slug+'" class="content-overlay">';
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
