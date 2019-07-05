@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage Luxury Hotel Collection')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage Luxury Hotel Collection')
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
					{{--*/ $adscatid = ($destination_category > 0) ? $destination_category : 'Hotel'; $sliderads = CommonHelper::getSliderAds('grid_slider', $adscatid) /*--}}
					@if(!empty($sliderads['leftsidebarads']))
						@foreach($sliderads['leftsidebarads'] as $ads)
							<div class="item" style="background-image:url({{URL::to('uploads/users/advertisement/'.$ads->adv_img)}});">
								<div class="carousel-caption">
									<h6>Advertisement</h6>
									<h2>
										@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a>
										@else
											{{$ads->adv_title}}
										@endif
									</h2>
									<p>@if($ads->adv_link!='#' && $ads->adv_link!='')
											<a onclick="return !window.open(this.href, '{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}', 'width=900,height=500,left=100, top=100, scrollbars, resizable')" href="{{ ((strpos($ads->adv_link, 'http://') || strpos($ads->adv_link, 'https://')) === false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_desc}}</a>
										@else
											{{$ads->adv_desc}}
										@endif


									</p>
								</div>
							</div>
						@endforeach
					@endif
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
    
    <?php if(!empty($search_for)){ ?>
    <section class="search-tab {{ $search_for=='experience' ? 'tab-show' : 'tab-hide' }}">
        <?php 
            $sel_collection = '';
            $sel_experience = '';
            if($req_for=="luxury_experience"){
               $sel_experience = 'active';     
            }else{
               $sel_collection = 'active'; 
            } 
        ?>
        <ul class="nav nav-tabs">
            <?php /* <li class="{{$sel_collection}}"><a href="#ourCollection" data-toggle="tab">Our Collections</a></li> */ ?>
            <li class=""><a href="#tab-Home" data-toggle="tab">Home</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Destination <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_destinations))                  
                    @foreach($dd_destinations as $dd_des)
                        <li><a href="{{URL::to('luxury_destinations')}}/{{$dd_des->category_alias}}">{{$dd_des->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li> 
            <li class="{{$sel_experience}}"><a href="#experiences" data-toggle="tab">Experiences</a></li>   
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li> 
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>                       
        </ul>
        <div class="tab-content">
            {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
            <div class="search-breadcrum">
                <ul class="s-breadcrumb">
                    <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                    <li>{{!empty($sel_exp) ? $sel_exp : ''}}</li>
                </ul>
            </div>
            
            <div id="experiences" class="tab-pane {{$sel_experience}} experinces">
                <select name="experience" id="experience">  
                    @if(!empty($experiences))                  
                        @foreach($experiences as $exp)
                            <option value="{{$exp->category_alias}}" <?php echo ($sel_exp==$exp->category_alias) ? 'selected="selected"' : '' ?>>{{$exp->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach 
                    @endif
                </select>
                                
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('luxury_experience')}}/{{$sel_exp}}/{{$coll->category_alias}}" >{{$coll->category_name}} </a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                <div class="load_ajax">

                </div>           
            </div>
            
            
            <input type="hidden" name="m_type" id="m_type" value="{{@!empty($m_type) ? $m_type : ''}}" />
        </div>
    </section>
    
    <section class="search-tab {{ $search_for=='destinations' ? 'tab-show' : 'tab-hide' }}">        
        <ul class="nav nav-tabs" id="main_tab">    
            <li class=""><a href="#tab-Home" data-toggle="tab">Home</a></li>        
            <li class="active" id="tb_destination"><a href="#tab-destination" data-toggle="tab">Destination</a></li>
            <li class="dropdown active" style="display: none;" id="tbd_destination">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Destination <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_destinations))                  
                    @foreach($dd_destinations as $dd_des)
                        <li><a href="{{URL::to('luxury_destinations')}}/{{$dd_des->category_alias}}">{{$dd_des->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>  
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Experience <span class="caret"></span></a>                
                <ul class="dropdown-menu">                  
                  @if(!empty($experiences))                  
                    @foreach($experiences as $exp)
                        <li><a href="{{URL::to('luxury_experience')}}/{{$exp->category_alias}}">{{$exp->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li> 
            <li class="tb_channel"><a href="#tab-channel" data-toggle="tab">Channel</a></li>
            <li class="dropdown active tbd_Channel" style="display: none;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>              
            <li class="tb_Social"><a href="#tab-social" data-toggle="tab">Social</a></li>
            <li class="dropdown active tbd_Social" style="display: none;">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>                                
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>  
            <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Channel <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_channels))                  
                    @foreach($dd_channels as $dd_chnl)
                        <li><a href="{{URL::to('social-youtube')}}/{{$dd_chnl->category_alias}}">{{$dd_chnl->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social <span class="caret"></span></a>
                <ul class="dropdown-menu">                  
                  @if(!empty($dd_social))                  
                    @foreach($dd_social as $dd_soc)
                        <li><a href="{{URL::to('social-instagram')}}/{{$dd_soc->category_alias}}">{{$dd_soc->category_name}}</a></li>
                    @endforeach 
                  @endif
                </ul>
            </li>-->            
        </ul>
        <div class="tab-content">
            
            
            
            {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}                
            
            <div id="tab-destination" class="tab-pane active destinatin">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb destination-breadcrumb">
                        @if(!empty($bc_dest))
                            <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'luxury_destinations'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="EGloader" href="{{URL::to($path)}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="dd-destination" id="dd-destination">
                    <option>{{$catname}}</option>     
                    @if(!empty($destinations))               
                        @foreach($destinations as $dest)
                            <option value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0">&lt; Back to Destination</option>
                    @endif
                </select>
                              
                @if(!empty($collections))
                {{--*/ $i=1; $j=1; $k=1; $l=1; $arr_key=''; /*--}}
                <ul class="nav nav-tabs">
                    @foreach($collections as $coll)                        
                        <li class="<?php echo ($m_type==$coll->category_alias) ? 'active' : '' ?> dest-collection" data-name="{{$coll->category_alias}}"><a href="{{URL::to('/')}}" >{{$coll->category_name}}</a></li>
                        {{--*/ $k++;  /*--}}    
                    @endforeach                            
                </ul>                  
                @endif
                
                <div class="load_ajax">

                </div>
                           
            </div>
            <div id="tab-channel" class="tab-pane">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb youtube-breadcrumb">
                        @if(!empty($bc_dest))
                            <li><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'social-youtube'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="yt-bread" data-alias="{{$sin_bc->category_alias}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="youtube_channel" id="youtube_channel">
                    <option>{{$catname}}</option>     
                    @if(!empty($youtube_channels))               
                        @foreach($youtube_channels as $dest)
                            <option value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0">&lt; Back to Channel</option>
                    @endif
                </select>
                              
                <div class="dv-youtube-channel">
        			
        		</div>
                           
            </div>
            <div id="tab-social" class="tab-pane">
                <div class="search-breadcrum">
                    <ul class="s-breadcrumb social-breadcrumb">
                        @if(!empty($bc_dest))
                            <li class="instagram"><a href="{{URL::to('/')}}">{{CNF_APPNAME}}</a></li>
                            <?php $path = 'social-instagram'; ?>
                            @foreach($bc_dest as $sin_bc)
                                <?php $path = $path.'/'.$sin_bc->category_alias; ?>
                                <li><a class="insta-bread" data-alias="{{$sin_bc->category_alias}}">{{$sin_bc->category_name}}</a></li>
                            @endforeach                        
                        @endif
                    </ul>
                </div>
                <select name="instagram_channel" id="instagram_channel">
                    <option>{{$catname}}</option>     
                    @if(!empty($instagram_channels))               
                        @foreach($instagram_channels as $dest)
                            <option value="{{$dest->category_alias}}" <?php echo ($dest_cat==$dest->category_alias) ? 'selected="selected"' : '' ?>>{{$dest->category_name}}</option>   
                            {{--*/ $i++;  /*--}}
                        @endforeach
                    @endif 
                    @if(!empty($parent_cat)) 
                        <option value="-1">&lt; Back to {{$parent_cat->category_name}}</option>
                    @else
                        <option value="0"> &gt; Back to Social</option>
                    @endif
                </select>    
                <div>
                    
        			<section id="instagran" class="sections-instagram">
                        <div class="full-width">
                            <div  class="dv-instagram-channel"></div>
                        </div>
                    </section>
                    
        		</div>
                           
            </div>
            
            <input type="hidden" name="" id="" value="" />
            
            <input type="hidden" name="dest_cat" id="dest_cat" value="{{@!empty($dest_cat)? $dest_cat : ''}}" />
            <input type="hidden" name="dest_url" id="dest_url" value="{{@!empty($dest_url)? $dest_url : ''}}" />
        </div>
    </section>
<?php } ?> 
<input type="hidden" name="sel_exp" id="sel_exp" value="{{!empty($sel_exp) ? $sel_exp : ''}}" />   
<input type="hidden" name="dest_collection" id="dest_collection" value="{{!empty($m_type) ? $m_type : ''}}" /> 
<input type="hidden" name="req_for" id="req_for" value="{{@!empty($req_for)? $req_for : ''}}" />


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
    <link href="{{ asset('themes/emporium/css/rad-photos-swap.css') }}" rel="stylesheet">

@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
    
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<!-- instagram -->
	<script src="{{ asset('lib/yottie/jquery.yottie.bundled.js')}}"></script>
	<script src="{{ asset('sximo/instajs/instashow/elfsight-instagram-feed.js')}}"></script>
	  <?php /*<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>*/ ?>
      <script src="{{ asset('themes/emporium/js/masonry.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/imagesloaded.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{ asset('themes/emporium/js/rad-photos-swap.js')}}"></script>
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
{{-- For custom style  --}}
@section('custom_css')
    @parent
    
            <style>
                
                <!-- Start Modal popup -->
                #showMemberLoginPopup .modal-dialog{
                    width: 700px !important;
                }
                #showMemberLoginPopup .modal-header{
                    border: 0px;        
                    padding:0px !important;
                }
                #showMemberLoginPopup .modal-content{
                    background: #252525 !important;        
                    min-height: 300px;
                }
                #showMemberLoginPopup .modal-content .popup-title{
                    color: #fff !important;
                    padding: 0px;
                    margin-top: 0px;
                    font-family: DomaineDisplay;
                }
                #showMemberLoginPopup .modal-content p{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .modal-content h6{
                    color: #fff !important;        
                }
                #showMemberLoginPopup .btnMembershipTypeJoin{
                    margin-top: 25px;
                    float: none;
                    width: 90%;
                    /*margin: 0px auto;*/
                    text-align: center;
                    display: block;
                    cursor: pointer;
                }
                .btnMembershipTypeBack {
                    border: 1px solid #fff;
                    border-radius: 0px;
                    color: #fff;
                    font-size: 12px;
                    padding: 12px 20px;
                    text-transform: uppercase;
                    /*margin-left: 10px;*/
                    float: left;
                    text-decoration: none;
                    /*margin-top: 93px;*/
                    margin-top: 25px;
                    cursor: pointer;
                }
                .btnMembershipTypeBack:hover, .btnMembershipTypeBack:focus {
                    color:#fff;
                }
                .modal-backdrop{background-color:#252525 !important}
                .modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}
                .modal-backdrop.in{filter:alpha(opacity=95);opacity:.95}
                
                .calendar-left-box{
                    margin: 10px 0px;
                }
                .calendar-left-box .season-search{
                    background: #aba00b;
                    color: #fff;
                    border-radius: 0px;
                    text-transform: uppercase;
                    margin-top: 2px;
                    margin-left: -7px;
                }
                .calendar-left-box .pad-0{
                    padding: 0px;
                }
                .t-datepicker-box .t-check-in, .t-datepicker-box .t-check-out {
                    width: 97% !important;
                }
                
                
                @media (max-width:1199px){
                    #showMemberLoginPopup .modal-dialog{
                        width:auto !important;
                    }
                    .btnMembershipTypeBack{
                        width: 100%;
                        text-align: center;
                    }
                }
                <!-- End Modal popup -->
            </style> 
                   
@endsection
{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
        var noImg = "{{ URL::to('sximo/images/noimg.jpg') }}";
        $(window).on('load', function(e){
            //load images after load full page
                $('img.rad-img').photoLoadAfterPageLoad(noImg);
            //End
    	});
        /*window.onYottieReady = function() {
            @if($channel_url!='')
                $('.dv-youtube-channel').html('');
                $('.dv-youtube-channel').yottie({                                
                    channel: '{{$channel_url}}',
                    width: 'auto',
                    lang: 'en',
                    header: {
                        layout: 'accent'
                    },
                    content: {
                        columns: 4,
                        rows: 2
                    },
                    video: {
                        layout: 'cinema'
                    }
                });
            @endif
        };*/
		$(document).ready(function () {
		  //load images after load full page
          //$('img.rad-img').photoLoadAfterPageLoad(noImg);
          //End
          
          
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
            
            $(".collection").click(function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                
                var cat = $("#sel_exp").val();
                var coll_type = 'experiences';
                //var token = $("input[name='_token']").val();
                //console.log(data_name);
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        console.log(response.type);
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/dedicated-collection';
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');  
                            }
                        }else{
                            window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
            
            $(".dest-collection").click(function(e){
                e.preventDefault();
                //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var d_name = $(this).attr('data-name');
                var cat =  $("#sel_exp").val(); console.log(cat);               
                var coll_type = 'destinations';
                var req_for = $("#req_for").val();
                var cobj = $(this);
                //var token = $("input[name='_token']").val();
                //console.log(data_name);
                $.ajax({
                    url:'{{URL::to("propcollection/")}}',
                    dataType:'json',
                    data: {d_name:d_name, coll_type:coll_type, cat:cat},
                    type: 'post',
                    success: function(response){
                        //console.log(response.type);
                        if(response.type=='dedicated-collection'){                            
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("2")>0){
                                //window.location.href = '{{URL::to('luxury_destinations')}}/'+cat+'/dedicated-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('dedicated-collection', cat, 1, req_for);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('dedicated-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');
                            }  
                        }else if(response.type=='bespoke-collection'){
                            var mem_types = response.mem_types;                            
                            if(mem_types.indexOf("3")>0){
                                //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/bespoke-collection';
                                //cat = $("#dd-destination").val();
                                getPropertyByCollection('bespoke-collection', cat, 1, req_for);
                                $(".dest-collection").removeClass('active');
                                cobj.addClass('active');
                                $("#dest_collection").val('bespoke-collection');
                            }else{
                                show_modal_content(response.type);  
                                $("#showMemberLoginPopup").modal({backdrop: 'static', keyboard: false}, 'show');                               
                            }
                        }else{
                            //cat = $("#dd-destination").val();
                            getPropertyByCollection('lifestyle-collection', cat, 1, req_for);
                            $(".dest-collection").removeClass('active');
                            cobj.addClass('active');
                            $("#dest_collection").val('lifestyle-collection'); 
                            //window.location.href = '{{URL::to('luxury_experience')}}/'+cat+'/lifestyle-collection';
                        }
                    }
                });    
            });
            
            var mtype = $("#dest_collection").val();
            var req_for = $("#req_for").val();
            var _cat = '';
            if(req_for=="luxury_experience"){
                _cat =  $("#sel_exp").val();    
            }else if(req_for=="luxury_destinations"){
                //_cat = $("#dd-destination").val();
                _cat =  $("#sel_exp").val();
            }           
            getPropertyByCollection(mtype, _cat, 1, req_for);
            
            //$('#main_tab').tabs("option", "active", 3);
              
            //var current_index = $("#main_tab").tabs("option","active");
            //$("#tab-channel").tabs('load',current_index);
            /*$tabs = $("#main_tab").tabs({
                select: function(event, ui) {
                    $('a', ui.tab).click(function() {
                        $(ui.panel).load(this.href);
                        return true;
                    });
                }
            });*/
            
		});
		
		var pageCounter = 2;
		var pagehgt = 1200;
		var it_scroll = false;
		var totalPage = '';
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
        
        
        
        function getPropertyByCollection(coll_type, cat, page, req_for){ console.log("hello");
            $.ajax({
                url:'{{URL::to("propertybycollection/")}}',
                //dataType:'html',
                dataType:'json',
                data: {coll_type:coll_type, cat:cat, page:page, req_for:req_for},
                type: 'post',
                beforeSend: function(){
                    $(".load_ajax").html('<div style="margin:0px auto; width:100%;"><img src="'+BaseURL+'/images/ajax-loader.gif" width="50%" /></div>');
                },
                success: function(data){ 
                    
                    listpagestructure(data);
                    
                    /*$("#load_ajax").html('');
                    $("#load_ajax").html(data);
                    $grid = $('.grid').masonry({
                      // options...
                    }); 
                    $grid.imagesLoaded().progress( function() {
                      $grid.masonry('layout');
                    });
                    $('img.rad-img').photoLoadAfterPageLoad(noImg);*/
                }
            });
        }
        
        function listpagestructure(data){                    
            //console.log(data.data.active_page,data);
            var _html = '';
            var jsonobj = data.data;
            if($.isEmptyObject(jsonobj)){
                
            }else{ 
                var editorPropertiesArr = jsonobj.editorPropertiesArr;
                /*var prop_packages = jsonobj.prop_packages;
                if(typeof prop_packages !== undefined ){ console.log(prop_packages);
                    $.each(prop_packages, function(key, value){
                        console.log("#span-"+key+"-collection");
                        $(".span-"+key+"-collection").html("("+value.length+")");        
                    });    
                }*/                                
                if (typeof editorPropertiesArr !== undefined && editorPropertiesArr.length > 0){
                     _html += '<div class="col-md-12 col-sm-12 col-xs-12">';
                        _html += '<div class="row">'
                            _html += '<h4 class="gridheading">'+ editorPropertiesArr.length +' <span class="newfont"> Editor\'s choice</span> Hotels Found for '+jsonobj.slug+' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="slider multiple-items">'; 
                            $.each(editorPropertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
             				    ?>
                    					_url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                    				}
                    			?>
                                _html += '<div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12">';
                                        _html += '<a  href="'+_url+'" >';
                                            _html += '<img src="{{ URL::to('sximo/images/transparent.png') }}" data-src="{{ URL::to('propertysliderimagebyid/')}}'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" data-ajax-link="{{ URL::to('ajax-rproperty-images')}}'+value['id']+'/3" />';
                                        _html += '</a>';
                                    _html += '</div>';
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 slidertext">';
                                        _html += '<h6 class="cat-links">';                                      
                                        _html += '</h6>';
                                
                                        _html += '<h5 class="entry-title">';
                                            _html += '<a href="'+_url+'" rel="bookmark" tabindex="0" style="outline: none;">'+value['property_name']+'</a>';
                                        _html += '</h5>';
                                        _html += '<p><a  href="'+_url+'" >'+value['property_usp']+'</a></p>';
                                        _html += '<a class="remoreslider" href="'+_url+'"><span class="newfont"> Discover</span></a>';
                                    _html += '</div>';
                                _html += '</div>';
                                
                            });
                            _html += '</div>'; 
                        _html += '</div>';       
                    _html += '</div>';  
                }
                _html += '<div class="col-md-12 col-sm-12 col-xs-12 misonrysection">'
                     _html += '<div class="row">';
                        var featurePropertiesArr = jsonobj.featurePropertiesArr;
                        var i=1; 
                        if(typeof featurePropertiesArr !== undefined && featurePropertiesArr.length > 0){                            
                            _html += '<h4 class="gridheading"> '+ featurePropertiesArr.length +' <span class="newfont"> Featured </span> Hotels Found for '+ jsonobj.slug +' '+ jsonobj.dateslug +'</h4>';
                            _html += '<div class="grid">';
                                $.each(featurePropertiesArr, function(key, value){ 
                                    var property_slug = value['property_slug'];                                    
                                    
                                    var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                    
                                    <?php                    				
                    				if(Request::has("departure") || Request::has("arrive"))
                    				{
                 				    ?>
                   					    _url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                    <?php
                     				}
                        			?>
                                    var femotional_gallery = [];
                                    var emotional_gallery = jsonobj.emotional_gallery;
                                    if(typeof emotional_gallery !== undefined){
                                        if(i==1 && emotional_gallery.length > 0){
                                            for(j=0; j<9; j++){
                                                if(emotional_gallery.length > 0){
                                                    femotional_gallery.push(emotional_gallery.shift());    
                                                }
                                            }
                                        }        
                                    }
                                    i++;
                                    _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">'; 
                                        _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
                                                _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                         	      _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertysliderimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'" />';
                                                _html += '</a>';
                                                _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+' -- Featured  </a>';
                                                        _html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+  value['property_usp'] +'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'"  title="Discover" ><span class="newfont"> Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    _html += '</div>';
                                    
                                    if(femotional_gallery.length > 0){
                                        var images_arr = [];
                                        $.each(femotional_gallery, function(key, value){                                            
                                            var _img = {src: value['imgsrc']+value['file_name']}; 
                                            images_arr.push(_img);
                                        }); 
                                        //console.log(images_arr);
                                        var img_str = '';
                                        _html += '<div class="col-md-6 col-sm-6 col-xs-12 biggrid">';
                                            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="javascript:false;">';
                                        	           _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="'+images_arr[0]['src']+'" data-imagessrc="'+img_str+'" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />';
                                                    _html += '</a>';
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title"></h5>';
                                                        _html += '<p></p>';
                                                    _html += '</div>';
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }                                    
                                           
                                });
                            _html += '</div>';
                        }
                     
                
                        _html += '<div class="clearfix"></div>';
                        propertiesArr = jsonobj.propertiesArr;
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){
                            _html += '<h4 class="gridheading">'+ jsonobj.total_record +'<span class="newfont"> Luxury Hotel(s)</span> Found for '+jsonobj.slug+' '+jsonobj.dateslug +'</h4>';
                        }
            
                        _html += '<div class="grid">';  
                        if(typeof propertiesArr!==undefined && propertiesArr.length > 0 ){  
                            var rw = 1;
                            
                            $.each(propertiesArr, function(key, value){
                                var property_slug = value['property_slug'];
                                var _url = BaseURL +"/"+ property_slug.replace(/-+$/g,"");
                                <?php                    				
                				if(Request::has("departure") || Request::has("arrive"))
                				{
             				    ?>
               					    _url+='?arrive='+{{Request::input("arrive")}}+'&departure='+{{Request::input("departure")}};
                                <?php
                 				}
                    			?>
                                if(rw%19==0){
                                    var mresultads = jsonobj.resultads;
                                    if(typeof mresultads !== undefined){
                                    var resultads = jsonobj.resultads.resultads;
                                    
                                    if(typeof resultads !== undefined && resultads != null){
                                    
                                        _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
                				            _html += '<div class="row">';
                                                _html += '<div class="gridinner">';
                                                    _html += '<a href="#" >'
                                					   _html += '<img src="{{URL::to('uploads/users/advertisement/')}}/'+resultads['adv_img']+'" class="img-responsive" >';
                                                    _html += '</a>';
                                                    
                                                    _html += '<div class="gridtext">';
                                                        _html += '<h5 class="entry-title">';
                                                            var advUrl = resultads['adv_link'];
                                                            if(advUrl.indexOf("http") < 0){
                                                                advUrl = "http://" + advUrl;        
                                                            }
                                                            _html += '<a href="'+advUrl+'" rel="bookmark" style="">'+resultads['adv_title']+'</a>';
                                                            _html += '<a href="#">Advertisement</a>';
                                                        _html += '</h5>';
                                                        _html += '<a class="read-more-link" href="'+advUrl+'">'+resultads['adv_title']+'</a>';
                          						    _html += '</div>';
                                                    
                                                _html += '</div>';
                                            _html += '</div>';
                                        _html += '</div>';
                                    }
                                    }
                                }else{
                                
                                    _html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
            				            _html += '<div class="row">';
                                            _html += '<div class="gridinner">';
            				           	        _html += '<div class="image">';                							           		    
                                                    _html += '<a href="'+_url+'" title="'+value['property_name']+'">';
                                                        _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="{{ URL::to('propertyimagebyid')}}/'+value['id']+'" class="img-responsive rad-img" alt="'+value['property_name']+'" title="'+value['property_name']+'"  />';
                                                    _html += '</a>';
                                                _html += '</div>';
            				                    _html += '<div class="gridtext">';
                                                    _html += '<h5 class="entry-title">';
                                                        _html += '<a href="'+_url+'" rel="bookmark" style="">'+value['property_name']+'</a>';
                                                        _html += '<a href="'+_url+'"><i class="fa fa-shopping-cart"></i></a>';
                                                    _html += '</h5>';
                                                    _html += '<p>'+value['property_usp']+'</p>';
                                                    _html += '<a class="read-more-link" href="'+_url+'" title="discover"><span class="newfontsimple">Discover</span></a>';
                                                _html += '</div>';
                                            _html += '</div>';
            				            _html += '</div>';
                                    _html += '</div>';
                                }
                                rw++;
                                
                                /*_html += '<div class="col-md-4 col-sm-4 col-xs-12 grid-item">';
        				            _html += '<div class="row">';
                                        _html += '<div class="gridinner">';
                  						    _html += '<div class="image">';                							           		    
                                                _html += '<a href="javascript:false;">';
                                                _html += '<img src="{{ URL::to('themes/emporium/images/emporium-voyage-logo-white-loader.svg') }}" data-src="" data-imagessrc="" class="img-responsive rad-img" alt="Emotional Gallery" title="Emotional Gallery" data-rad-auto-run="true" data-rad-effect-type="fade"  />';
                                                _html += '</a>';
        				                    _html += '</div>';
        				                    _html += '<div class="gridtext">';
                                                _html += '<h5 class="entry-title"></h5>';
                                                _html += '<p></p>';
                        					_html += '</div>';
                        				_html += '</div>';
                        			_html += '</div>';
                        		_html += '</div>';*/
                                        
                            });    
                        }
                        _html += '</div>';
                    _html += '</div>';
                _html += '</div>';
                
                _html += '<div class="col-md-12 col-xs-12 col-xs-12 text-center">';
                    _html += '<div class="row">';
                        var total_pages = jsonobj.total_pages;
                        if(total_pages>1){
                    		_html += '<ul class="pagination">';
                    			for(i=1; i<=total_pages; i++){
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
                                    var act = (i==jsonobj.active_page) ? 'active' : '';
                    				_html += '<li class="'+act+' paging"><a href="{{ $url.'page='}}'+i+'" data-page="'+i+'">'+i+'</a></li>';
                    			}    
                    		_html += '</ul>';
                		}
                	_html += '</div>';
                _html += '</div>';
                
                /*_html += '<!-- Instagram Gallery Section -->';
                var destination_category = jsonobj.destination_category;
            	if(typeof destination_category !== undefined && destination_category > 0){
                    var destination_category_instagram = jsonobj.destination_category_instagram;
            		if(destination_category_instagram != ''){
            			_html += '<section id="instagram-section">';
            				_html += '<div class="col-sm-12 text-center">';
            					_html += '<h2 class="heading">{{$slug}}</h2>';
            				_html += '</div>';
            				_html += '<section id="instagran" class="sections-instagram">';
            					_html += '<div class="full-width">';
            						_html += '<div data-is data-is-api="{{ url('runInsta')}}" data-is-source="'+destination_category_instagram+'" data-is-rows="2" data-is-limit="0" data-is-columns="5" ></div>';
            					_html += '</div>';
            				_html += '</section>';
            			_html += '</section>';
            		}
            	}*/
            }
            $(".load_ajax").html('');
            $(".load_ajax").html(_html);
            $grid = $('.grid').masonry({
              // options...
            }); 
            $grid.imagesLoaded().progress( function() {
              $grid.masonry('layout');
            });
            $('img.rad-img').photoLoadAfterPageLoad(noImg);
        }
        
        $(document).on('click', '.paging a', function(e){
           e.preventDefault();
           //var _link = $(this).attr('href');
           //console.log("hello", _link);
           var cat = $("#sel_exp").val();                
           var coll_type = $("#dest_collection").val();
           var page = $(this).attr('data-page');
           var req_for = $("#req_for").val();
           getPropertyByCollection(coll_type, cat, page, req_for); 
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
        
        
        
        function show_modal_content(memtype){
            $.ajax({
                url:'{{URL::to("membershiptype/popup")}}',
                type: "POST",
                data: {memtype:memtype},
                dataType: "json",
                success: function (data, textStatus, jqXHR) {
                    var popupHtml = '';
                    if (data.status == 'success') {
                        var obj = data.mem_package;
                        popupHtml += '<div class="row">';
                        
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<img class="img-responsive object-fit-size" src="{{URL::to("uploads/category_imgs")}}/'+obj.category_image+'" style="width: 100%;">';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6">';
                                popupHtml += '<h2 class="popup-title">'+obj.category_name+'</h2>';
                                popupHtml += '<p>'+(obj.category_description).replace(/\n/g,"<br>")+'</p>';
                                //popupHtml += '<h6>{!! isset($currency->content)?$currency->content:"&euro;" !!}'+obj.package_price+'</h6>';
                                
                                str_mem = '';
                                str_mem2 = '';
                                if(memtype=="dedicated-collection"){
                                    str_mem = 'Dedicated';
                                    str_mem2 = 'dedicated';
                                }else if(memtype=="bespoke-collection"){
                                    str_mem = 'Bespoke';
                                    str_mem2 = 'bespoke';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}?type='+str_mem2+'">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';
                                
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">';
                                popupHtml += '<a class="btnMembershipTypeBack" href="#" data-dismiss="modal" aria-hidden="true">Back</a>';
                            popupHtml += '</div>';
                            popupHtml += '<div class="col-sm-6 col-md-6 col-lg-6  col-xs-12">';
                                /*str_mem = '';
                                if(memtype=="dedicated-membership"){
                                    str_mem = 'Dedicated';
                                }else if(memtype=="bespoke-membership"){
                                    str_mem = 'Bespoke';
                                }
                                popupHtml += '<a class="btnMembershipTypeJoin" href="{{URL::to("memberships")}}">View Membership Benefits</a>';
                                popupHtml += '<a class="btnMembershipTypeJoin" id="loginasa">Login as a '+str_mem+' Member</a>';*/
                            popupHtml += '</div>';
                        popupHtml += '</div>';
                    }
                    $(".mem-modal-popup").html(popupHtml);
                }
            });
        }
        
        $(document).on('change', '#experience', function () {  
            /*var expr = $(this).val();
            window.location.href = '{{URL::to("luxury_experience")}}/'+expr;*/
            var expr = $(this).val();            
            var url = '{{URL::to("luxury_experience")}}/'+expr;
            $("#menu_url").val(url);
            
            var destination = expr; 
            
            var datObj = {};
            datObj.url = url;
        	datObj.destination = destination;
            
        	var params = $.extend({}, doAjax_params_default);
        	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
        	params['data'] = datObj;
        	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
        	doAjax(params);
        });
        $(document).on('change', '#dd-destination', function (e) {  
            /*var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            window.location.href = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;*/
            var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            console.log(dest_url);
            if(dest == -1){
                
                var arr_durl = dest_url.split('/');                
                var back_url = '';
                if(arr_durl.length > 0){                    
                    arr_durl.pop();
                    dest = arr_durl[arr_durl.length - 1];                     
                }                 
                $.each(arr_durl, function(key, value){
                     back_url = back_url+'/'+value;   
                });
                                
                var url = "{{URL::to('luxury_destinations')}}"+back_url;
                $("#menu_url").val(url);
                
                var destination = dest;
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params); 
                
            }else if(dest == 0){
                e.preventDefault();
                console.log(dest);
                $("#tb_destination").css('display', 'none');    
                $("#tbd_destination").css('display', '');
            }else{
                var url = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;
                $("#menu_url").val(url);
                
                var destination = dest; 
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params);
                 
            }
           
           
        });

        function changeBreadcrumbDropdown(catt){
            $.ajax({
                url:'{{URL::to("getDropdownBreadcrumb/")}}',
                //dataType:'html',
                dataType:'json',
                data: {cat:catt},
                type: 'post',
                beforeSend: function(){
                    
                },
                success: function(data){ 
                    console.log(data);
                    //console.log(data.youtube_channels);  
                    var objytchannels = data.youtube_channels; 
                    $("#youtube_channel").empty();
                    $("#youtube_channel").append('<option>'+data.catname+'</option>');
                    $.each(objytchannels, function(key, vlaue){
                        $("#youtube_channel").append(
                            $('<option></option>').val(vlaue['category_alias']).html(vlaue['category_name'])
                        );
                    });
                    var objParentCat = data.parent_cat;
                    if(typeof objParentCat != undefined && objParentCat!=null){
                        $("#youtube_channel").append('<option value="-1">'+data.parent_cat['category_name']+'</option>');
                    }else{
                        $("#youtube_channel").append('<option value="-1">&lt; Back to Channel</option>');    
                    } 
                    
                    var objinstachannels = data.instagram_channels; 
                    $("#instagram_channel").empty();
                    $("#instagram_channel").append('<option>'+data.catname+'</option>');
                    $.each(objinstachannels, function(key, vlaue){
                        $("#instagram_channel").append(
                            $('<option></option>').val(vlaue['category_alias']).html(vlaue['category_name'])
                        );
                    });  
                    var objParentCat = data.parent_cat;
                    if(typeof objParentCat != undefined && objParentCat!=null){
                        $("#instagram_channel").append('<option value="-1">'+data.parent_cat['category_name']+'</option>');
                    }else{
                        $("#instagram_channel").append('<option value="-1">&lt; Back to Social</option>');    
                    } 
                    
                    var objdestinations = data.destinations; 
                    $("#dd-destination").empty();
                    $("#dd-destination").append('<option>'+data.catname+'</option>');
                    $.each(objdestinations, function(key, vlaue){
                        $("#dd-destination").append(
                            $('<option></option>').val(vlaue['category_alias']).html(vlaue['category_name'])
                        );
                    });
                    var objParentCat = data.parent_cat;
                    if(typeof objParentCat != undefined && objParentCat!=null){
                        $("#dd-destination").append('<option value="-1">'+data.parent_cat['category_name']+'</option>');
                    }else{
                        $("#dd-destination").append('<option value="-1">&lt; Back to Destination</option>');    
                    }  
                    
                    var breadcrumb = data.dest_url;
                    console.log(breadcrumb);
                    $(".destination-breadcrumb").empty();
                    $(".destination-breadcrumb").append('<li><a href="'+BaseURL+'">{{CNF_APPNAME}}</a></li>');
                    var destpath = 'luxury_destinations';
                    $.each(breadcrumb, function(key, vlaue){
                        destpath = destpath+"/"+vlaue['category_alias'];
                        $(".destination-breadcrumb").append('<li><a href="'+BaseURL+'/'+destpath+'">'+vlaue['category_name']+'</a></li>');
                    });
                    
                    
                    $(".youtube-breadcrumb").empty();
                    $(".youtube-breadcrumb").append('<li><a href="'+BaseURL+'">{{CNF_APPNAME}}</a></li>');
                    var ytpath = 'social-youtube';
                    $.each(breadcrumb, function(key, vlaue){
                        ytpath = ytpath+"/"+vlaue['category_alias'];
                        $(".youtube-breadcrumb").append('<li><a class="yt-bread" data-alias="'+vlaue['category_alias']+'" href="#">'+vlaue['category_name']+'</a></li>');
                    }); 
                       
                    $(".social-breadcrumb").empty();
                    $(".social-breadcrumb").append('<li><a href="'+BaseURL+'">{{CNF_APPNAME}}</a></li>');
                    var instpath = 'social-instagram';
                    $.each(breadcrumb, function(key, vlaue){
                        instpath = instpath+"/"+vlaue['category_alias'];
                        $(".social-breadcrumb").append('<li><a class="insta-bread" data-alias="'+vlaue['category_alias']+'" href="#">'+vlaue['category_name']+'</a></li>');
                    }); 
                                  
                }
            });            
        }
        
        $(document).on('click', '.yt-bread', function(e){
            e.preventDefault();
            var dest = $(this).attr('data-alias');
            getDefaultChannel(dest)
            changeBreadcrumbDropdown(dest);         
        });
        $(document).on('click', '.insta-bread', function(e){
            e.preventDefault();
            var dest = $(this).attr('data-alias');
            getDefaultInstagram(dest);
            changeBreadcrumbDropdown(dest);      
        });
        
        $(document).on('change', '#youtube_channel', function (e) { 
            var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            console.log(dest, dest_url);
            if(dest == -1){
                
                var arr_durl = dest_url.split('/');                
                var back_url = '';
                if(arr_durl.length > 0){                    
                    arr_durl.pop();
                    dest = arr_durl[arr_durl.length - 1];                     
                }                 
                $.each(arr_durl, function(key, value){
                     back_url = back_url+'/'+value;   
                });
                getDefaultChannel(dest)
                changeBreadcrumbDropdown(dest);                
                /*var url = "{{URL::to('social-youtube')}}"+back_url;
                $("#menu_url").val(url);
                
                var destination = dest;
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params);*/ 
                
            }else if(dest == 0){
                e.preventDefault();                
                $(".tb_channel").css('display', 'none');    
                $(".tbd_Channel").css('display', '');
                $(".tbd_Channel").addClass('active');
                $("#tb_destination").css('display', 'none');    
                $("#tbd_destination").css('display', '');
                $("#tbd_destination").removeClass('active');
                $(".tb_Social").css('display', 'none');    
                $(".tbd_Social").css('display', '');
                $(".tbd_Social").removeClass('active');
            }else{
                getDefaultChannel(dest)
                changeBreadcrumbDropdown(dest);
            }
            
            /*var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            window.location.href = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;*/
            /*var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            console.log(dest_url);
            if(dest == -1){
                
                var arr_durl = dest_url.split('/');                
                var back_url = '';
                if(arr_durl.length > 0){                    
                    arr_durl.pop();
                    dest = arr_durl[arr_durl.length - 1];                     
                }                 
                $.each(arr_durl, function(key, value){
                     back_url = back_url+'/'+value;   
                });
                                
                var url = "{{URL::to('social-youtube')}}"+back_url;
                $("#menu_url").val(url);
                
                var destination = dest;
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params); 
                
            }else if(dest == 0){
                e.preventDefault();
                console.log(dest);
                $("#tb_destination").css('display', 'none');    
                $("#tbd_destination").css('display', '');
            }else{
                var url = "{{URL::to('social-youtube')}}"+"/"+dest_url+"/"+dest;
                $("#menu_url").val(url);
                
                var destination = dest; 
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params); 
            }*/
           
           
        });
        
        $(document).on('change', '#instagram_channel', function (e) {  
            /*var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            window.location.href = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;*/
            var dest = $(this).val();
            var dest_url = $("#dest_url").val();
            console.log(dest_url);
            if(dest == -1){
                
                var arr_durl = dest_url.split('/');                
                var back_url = '';
                if(arr_durl.length > 0){                    
                    arr_durl.pop();
                    dest = arr_durl[arr_durl.length - 1];                     
                }                 
                $.each(arr_durl, function(key, value){
                     back_url = back_url+'/'+value;   
                });
                console.log("hello");
                getDefaultInstagram(dest);
                changeBreadcrumbDropdown(dest);                
                /*var url = "{{URL::to('luxury_destinations')}}"+back_url;
                $("#menu_url").val(url);
                
                var destination = dest;
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params);*/ 
                
            }else if(dest == 0){
                e.preventDefault(); 
                /*console.log(dest);
                $(".tb_social").css('display', 'none');    
                $(".tbd_social").css('display', '');*/
                $(".tb_channel").css('display', 'none');    
                $(".tbd_Channel").css('display', '');
                $(".tbd_Channel").removeClass('active');
                $("#tb_destination").css('display', 'none');    
                $("#tbd_destination").css('display', '');
                $("#tbd_destination").removeClass('active');
                $(".tb_Social").css('display', 'none');    
                $(".tbd_Social").css('display', '');
                $(".tbd_Social").addClass('active');
            }else{
                /*var url = "{{URL::to('luxury_destinations')}}"+"/"+dest_url+"/"+dest;
                $("#menu_url").val(url);
                
                var destination = dest; 
                var datObj = {};
                datObj.url = url;
            	datObj.destination = destination;
                
            	var params = $.extend({}, doAjax_params_default);
            	params['url'] = BaseURL + '/destination/emotional-gallery-loader';
            	params['data'] = datObj;
            	params['successCallbackFunction'] = renderEmotionalGalleryLoader;
            	doAjax(params);*/ 
                getDefaultInstagram(dest);
                changeBreadcrumbDropdown(dest);
                
                
            }
           
           
        });
        
        $(document).on('click', '[href="#tab-destination"]', function(e){
            var mtype = $("#dest_collection").val();
            var req_for = $("#req_for").val();
            var _cat = '';
            if(req_for=="luxury_experience"){
                _cat =  $("#dd-destination").val();    
            }else if(req_for=="luxury_destinations"){                
                _cat =  $("#dd-destination").val();
            }           
            getPropertyByCollection(mtype, _cat, 1, req_for);
        });
        
        $(document).on('click', '[href="#tab-channel"]', function(){
            var dest = $('#youtube_channel').val();
            getDefaultChannel(dest);
        });
        
        $(document).on('click', '[href="#tab-social"]', function(){
            var dest = $('#instagram_channel').val(); console.log(dest);
            getDefaultInstagram(dest);
        });
        
        function getDefaultInstagram(catt){            
            $.ajax({
                url:'{{URL::to("getinstagramchannel/")}}',
                //dataType:'html',
                dataType:'json',
                data: {cat:catt},
                type: 'post',
                beforeSend: function(){
                    
                },
                success: function(data){ 
                    
                    console.log(data.channel_url); console.log("hell");   
                    $(".dv-instagram-channel").html('<div class="insta_pic"></div>');
                    //$(".dv-youtube-channel").html('<div data-yt data-yt-channel="'+data.channel_url+'" data-yt-content-columns="4"  data-yt-content-rows="3"></div>')                    
                    $('.insta_pic').eappsInstagramFeed({
                        api: '{{ url("runInsta")}}',
                        source: data.channel_url,                        
                        columns: 5,
                        rows: 2                        
                    });
                }
            });
        }
        
        function getDefaultChannel(catt){            
            $.ajax({
                url:'{{URL::to("getyoutubechannel/")}}',
                //dataType:'html',
                dataType:'json',
                data: {cat:catt},
                type: 'post',
                beforeSend: function(){
                    
                },
                success: function(data){ 
                    
                    console.log(data.channel_url);   
                    $(".dv-youtube-channel").html('<div class="yt-rvideos"></div>');
                    //$(".dv-youtube-channel").html('<div data-yt data-yt-channel="'+data.channel_url+'" data-yt-content-columns="4"  data-yt-content-rows="3"></div>')                    
                        $('.yt-rvideos').yottie({                                
                            channel: data.channel_url,
                            content: {
                                columns: 4,
                                rows: 2
                            },
                        });
                }
            });
        }
        
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection
