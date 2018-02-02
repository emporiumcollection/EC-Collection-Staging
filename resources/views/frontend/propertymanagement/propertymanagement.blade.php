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

  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Account Settings</a></li>
	<li role="presentation"><a href="{{URL::to('hotel/propertymanagement/list')}}">Property Management</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
                <form class="form-horizontal my-profile-main-form-align">
					
					<div id="guests">
						<div class="form-group">
							<label class="control-label col-sm-2">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control dash-input-style" placeholder="Riaan">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control dash-input-style" placeholder="designlocations@gmail.com">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Phone</label>
							<div class="col-sm-10">          
								<input type="password" class="form-control dash-input-style" placeholder="+91-9876543210">
							</div>
						</div>
						<div class="form-group profile-page-submit-radio-align">        
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label"><input type="radio">Subscribe to our notifications and news to our latest hotels, spa's and offers</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="radio">
									<label class="radio-label"><input type="radio">I require personalized service bookings in my account profile</label>
								</div>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-12">
								<button type="submit" class="btn btn-default dash-btn-style">Save Profile</button>
							</div>
						</div>
					</div>
					</form>
				</div>
        </div></div>
	</div>
   
    
  </div>

</div>
   
   
</section>
    <!-- PARSLEY -->
    
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