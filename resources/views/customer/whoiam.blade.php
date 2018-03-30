@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')



<section class="sliderSection termConditionSlider">
	@if(!empty($pageslider))
	  <div id="restaurantSlider" class="carousel" data-ride="carousel">
		<!-- Indicators -->
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			@foreach($pageslider as $key => $slider_row)
			  <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
				<div class="carousel-caption">
				  <h1>{{$slider_row->slider_title}}</h1>
				  <p>{{$slider_row->slider_description}}</p>
				  <button type="button" class="button viewGalleryBtn termAndConditionBtn">Contact us</button>
				</div>
			  </div>
			@endforeach
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
		  <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
		</a>
		<a class="right carousel-control" href="#restaurantSlider" data-slide="next">
		  <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
		</a>
	  </div>
	  <span class="scrollNextDiv"><a class="scrollpage" href="#divWhoiam">Scroll Down</a></span>
	@endif
</section>

<section>

 <div id="divWhoiam" class="hotelInfoSection" style="background-color:#f7f7f7;">



  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> 
     	<div class="col-md-10">
        <div class="row">
            <div class="das-form-outer-align">


                <form class="form-horizontal my-profile-main-form-align" name="basicInfo" id="basicInfo" method="post" action=" {{URL::to('customer/savewhoiam')}}">
					<div class="form-group profile-page-submit-radio-align">   
   
                     <div class="col-sm-12">
							<input type="radio" name="usertype" value="guests" id="usertypeGuest" class="input input-hidden usertype" required="" />
							<label for="usertypeGuest">
								
							  <img 
							    src="{{ asset('sximo/assets/images/guest-icon.png')}}"	 
							    alt="I am Guest" />
							    <p>I am Guest</p>
							</label>


							<input type="radio" name="usertype" value="hotel" id="userTypeHotel" class="input input-hidden usertype" required=""/>
							<label for="userTypeHotel">
							  <img 
							    src="{{ asset('sximo/assets/images/hotel-icon.png')}}"	
							    alt="I am Hotel" />
							     <p>I am Hotel</p>
							</label>

							<input type="radio" name="usertype" value="advertiser" id="userTypeAdvertiser" required="" class=" input input-hidden usertype" />
							<label for="userTypeAdvertiser">
							  <img src="{{ asset('sximo/assets/images/advertiser-icon.png')}}"					    
							    alt="I am advertiser" />
							     <p>I am Advertiser</p>
							</label>
						</div>
                    </div>
                    <diV>

			      @if(Session::has('message'))	  
					   {!! Session::get('message') !!}
				@endif	
	<ul>
		@foreach($errors->all() as $error)
			<li class="alert alert-danger parsley">{{ $error }}</li>
		@endforeach
	</ul>
</diV>

<div class="row">
        <div class="col-md-12 row">
            <div class="hotelInfoSection">
					<div id="guests">
						<div class="form-group">
							<label class="col-sm-2">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="{{$guestUserData->first_name}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="{{ $guestUserData->last_name }}" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Phone</label>
							<div class="col-sm-10">          
								<input type="text" name="txtPhoneNumber" value="{{$guestUserData->mobile_number}}" id="txtPhoneNumber" class="form-control dash-input-style" placeholder="+91-9876543210" required="">
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-10">
								<label class="col-sm-2"><input type="checkbox" id="newsLetter" name="newsLetter"></label>
								<div class="radio">
									<label >Subscribe to our notifications and news to our latest hotels, spa's and offers </label>
								</div>
							</div>
							<div class="col-sm-10" id="personalizeCheck">
								<label class="col-sm-2">
								<input type="checkbox"  id="personalize" name="personalize" checked="checked">
							</label>
								<div class="radio">
									<label class="radsio-label" >I require personalized service bookings in my account profile</label>
								</div>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-12">
								<input type="submit" class="btn btn-white pull-right" value="Save Profile" >
							</div>
						</div>
					</div>
					</form>
					<div id="formerrors"></div>

					
			              </div>
			        </div>
			    </div>   
            </div>
        </div>
    </div>
</div>

  </div>

</div>
   
   
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
    @include('frontend.themes.emporium.layouts.sections.common_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent
    <link href="{{ asset('themes/emporium/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
	<link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
	 <link href="{{ asset('themes/emporium/css/membership-css.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
 @parent
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<style>
#formerrors { color:#ffec0cf2;}
.input-hidden {
  position: absolute;
  left: -9999px;
}

.input[type=radio]:checked + label>img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
.input[type=radio] + label>img {
  border: 1px dashed #444;
  width: 128px;
  height: 128px;
  transition: 500ms all;
}
.input[type=radio] + label>img,p {
  margin-left: 0px;
  margin-right: 20px;

  transition: 500ms all;
}

.input[type=radio]:checked + label>img {
  transform: 
    rotateZ(-0deg) 
    rotateX(0deg);
}

.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
.parsley-required{

    padding: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
    border: 1px solid transparent;
    border-radius: 2px;

    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;

}
</style>
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
	<script src="{{ asset('themes/emporium/js/smooth-scroll.js') }}"></script>
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
	  $('#basicInfo').parsley().on('field:validated', function() {
	    var ok = $('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  })
	  .on('form:submit', function() {
	    return true; // Don't submit form for this demo
	  });
	});

	 $(document).on('click', '.usertype', function () {
		

		 if($('#userTypeHotel').prop("checked")==true){

		 	 $('#personalizeCheck').hide();
		 	
		 }

		 if($('#usertypeGuest').prop("checked")==true){

		 	 $('#personalizeCheck').show();
		 	
		 }
		 if($('#userTypeAdvertiser').prop("checked")==true){

		 	 $('#personalizeCheck').hide();
		 	
		 }
		 var uservar = $(this).val();
		 
		 $('#'+uservar).show();
	 });

	 
</script>
	
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection



