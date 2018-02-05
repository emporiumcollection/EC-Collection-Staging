
@extends('frontend.layouts.ev.customer')
@section('content')
<style>
#formerrors { color:#ffec0cf2;}
.input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
input[type=radio] + label>img {
  border: 1px dashed #444;
  width: 128px;
  height: 128px;
  transition: 500ms all;
}

input[type=radio]:checked + label>img {
  transform: 
    rotateZ(-2deg) 
    rotateX(2deg);
}


</style>
<section>

    <div>



  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">


                <form class="form-horizontal my-profile-main-form-align" name="basicInfo" id="basicInfo" method="post" action=" {{URL::to('customer/savewhoiam')}}">
					<div class="form-group profile-page-submit-radio-align">   
   
                     <div class="col-sm-12">
							<input type="radio" name="usertype" value="guests" id="usertypeGuest" class="input-hidden usertype" required="" />
							<label for="usertypeGuest">
								
							  <img 
							    src="{{ asset('sximo/assets/images/guest-icon.png')}}"	 
							    alt="I am Guest" />
							    <p>I am Guest</p>
							</label>


							<input type="radio" name="usertype" value="hotel" id="userTypeHotel" class="input-hidden usertype" required=""/>
							<label for="userTypeHotel">
							  <img 
							    src="{{ asset('sximo/assets/images/hotel-icon.png')}}"	
							    alt="I am Hotel" />
							     <p>I am Hotel</p>
							</label>

							<input type="radio" name="usertype" value="advertiser" id="userTypeAdvertiser" required="" class="input-hidden usertype" />
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
					<div id="guests">
						<div class="form-group">
							<label class="control-label col-sm-2">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="{{$guestUserData->first_name}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="{{ $guestUserData->last_name }}" required="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Phone</label>
							<div class="col-sm-10">          
								<input type="text" name="txtPhoneNumber" value="{{$guestUserData->mobile_number}}" id="txtPhoneNumber" class="form-control dash-input-style" placeholder="+91-9876543210" required="">
							</div>
						</div>
						<div class="form-group profile-page-submit-radio-align">        
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label">Subscribe to our notifications and news to our latest hotels, spa's and offers <input type="checkbox" id="newsLetter" name="newsLetter"></label>
								</div>
							</div>
							<div class="col-sm-12" id="personalizeCheck">
								<div class="radio">
									<label class="radio-label">I require personalized service bookings in my account profile <input type="checkbox"  id="personalize" name="personalize" checked="checked"></label>
								</div>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-12">
								<input type="submit" class="btn btn-default dash-btn-style" value="Save Profile">
							</div>
						</div>
					</div>
					</form>
					<div id="formerrors"></div>
					
                
            </div>
        </div></div></div>

  </div>

</div>
   
   
</section>
    <!-- PARSLEY -->
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
</script>

<script>
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

@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection