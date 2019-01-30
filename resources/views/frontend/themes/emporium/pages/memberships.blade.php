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
                <div id="collapse_{{$k}}" class="panel-collapse collapse <?php echo isset($mem_type) ? ($mem_type==$package->package_title ? 'in' : '') :($k==1) ? 'in' : '' ?>">
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
                                            <?php 
                                                $ttl = $package->package_title;
                                                $ttl = (str_replace(' ', '-', strtolower($ttl)));
                                            ?>                                        
                                            <a class="btnMembershipTypeJoin" href="javascript:void(0);" data-mtype="{{$ttl}}">Join The Club</a>
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
            width: 93%;
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
	
</script>

@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
	<script>
		 
        $(document).ready(function(){
            $(".btnMembershipTypeJoin").click(function(e){
                e.preventDefault();
                $(".clicktologin").trigger("click");
                $(".signInPopupButton").trigger('click');
                var mtype = $(this).attr('data-mtype');
                $(".styledSelect").text('Luxury Traveler');
                $(".user-type").val(3);
                $.ajax({
                        url: "{{URL::to('membershiptypes')}}",
                        type: "GET",
                        dataType: "json",                        
                        success: function (data, textStatus, jqXHR) {
                            if (data.status == 'success') {
                                user_ref = '<div class="reltv" id="dv-member-type"><select name="member_type" class="member-type mg-top" id="sel-member-type" style="margin-top:20px;">';
                                var obj = data.objmember;
                                $("#sel-member-type").empty();                                
                                $.each(obj, function(key, value){
                                    //console.log('key:'+key+':value:'+value.id); 
                                    var ttl = (value.package_title).trim();
                                    ttl = ttl.replace(' ', '-');
                                    ttl = ttl.toLowerCase();
                                    user_ref += "<option value='"+ttl+"'>"+value.package_title+"</option>";
                                });
                                user_ref += '</select></div>'; //console.log(user_ref);
                                $('.user_ref').css('margin-top', '20px');
                                $('.user_ref').html(user_ref);
                                
                                $('.member-type').each(function () {

                                    // Cache the number of options
                                    var $this = $(this),
                                        numberOfOptions = $(this).children('option').length;
                                
                                    // Hides the select element
                                    $this.addClass('s-hidden');
                                
                                    // Wrap the select element in a div
                                    $this.wrap('<div class="newselect"></div>');
                                
                                    // Insert a styled div to sit over the top of the hidden select element
                                    $this.after('<div class="styledSelect"></div>');
                                
                                    // Cache the styled div
                                    var $styledSelect = $this.next('div.styledSelect');
                                
                                    if(mtype!=''){
                                        var f_mtype = (mtype).trim();
                                        f_mtype = mtype.replace('-', ' ');
                                        $styledSelect.text(f_mtype);
                                        $(".member-type").val(mtype);
                                        if(mtype=='bespoke-membership'){
                                            
                                            var _nxt = $(".user_ref").next('#dv_referral');
                                            if(_nxt.length <= 0)
                                            {
                                                $("input[name='email']").parent('.form-group').removeClass('mg-top');
                                                user_referral = '<div class="form-group mg-top" id="dv_referral"> <input class="form-control" name="referral_code" type="text" placeholder="Enter Referral Code"> </div>';
                                                $(user_referral).insertAfter(".user_ref"); 
                                            } 
                                        }else{
                                            var _nxt = $(".user_ref").next('#dv_referral');
                                            $("input[name='email']").parent('.form-group').addClass('mg-top');
                                            if(_nxt.length >= 0)
                                            {
                                                $('#dv_referral').remove();
                                            }
                                        }
                                    }else{
                                        // Show the first select option in the styled div
                                        $styledSelect.text($this.children('option').eq(0).text());
                                    }
                                    
                                    // Insert an unordered list after the styled div and also cache the list
                                    var $list = $('<ul />', {
                                        'class': 'options newoptions'
                                    }).insertAfter($styledSelect);
                                
                                    // Insert a list item into the unordered list for each select option
                                    for (var i = 0; i < numberOfOptions; i++) {
                                        $('<li />', {
                                            text: $this.children('option').eq(i).text(),
                                            rel: $this.children('option').eq(i).val()
                                        }).appendTo($list);
                                    }
                                
                                    // Cache the list items
                                    var $listItems = $list.children('li');
                                
                                    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
                                    $styledSelect.click(function (e) {
                                        e.stopPropagation();
                                        $('div.styledSelect.active').each(function () {
                                            $(this).removeClass('active').next('ul.options').hide();
                                        });
                                        $(this).toggleClass('active').next('ul.options').toggle();
                                    });
                                    
                                    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
                                    // Updates the select element to have the value of the equivalent option
                                    $listItems.click(function (e) {
                                        e.stopPropagation();
                                        $styledSelect.text($(this).text()).removeClass('active');
                                        $this.val($(this).attr('rel'));
                                        //$list.hide();
                                        
                                        checkMembership($this.val());
                                        $list.hide();
                                        console.log("hh");
                                        / alert($this.val()); Uncomment this for demonstration! /
                                    });
                                
                                    // Hides the unordered list when clicking outside of it
                                    $(document).click(function () {
                                        $styledSelect.removeClass('active');
                                        $list.hide();
                                    });
                                    $list.hide();
                                });
                            }
                            else {
                                
                            }
                        }
                    });                    
            });             
        });
	</script>
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection