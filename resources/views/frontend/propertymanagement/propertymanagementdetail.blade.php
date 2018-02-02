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
     <div role="tabpanel" class="tab-pane active" id="profile"> 
	 
	 <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
				<div id="formerrors"></div>
                <form id="hotel-form" action="{{URL::to('frontend_hotelpost')}}" method="post">
					<div class="col-md-12 sm-clear-both">
						<div id="success-contact-form" class="no-margin-lr"></div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Name</label>
							<input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Hotel Status</label>
							<select name="hotelinfo_status" class="bg-white medium-input" required="">
								<option value="">Select Status</option>
								<option value="Open">Open</option>
								<option value="Construction phase">Construction phase</option>
								<option value="Planning phase">Planning phase</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Type</label>
							<select name="hotelinfo_type" class="bg-white medium-input" required="">
								<option value="">Hotel Type</option>
								<option value="Alternative">Alternative</option>
								<option value="Beach Resort">Beach Resort</option>
								<option value="Resort">Resort</option>
								<option value="City">City</option>
								<option value="Mountain">Mountain</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Hotel Building</label>
							<select name="hotelinfo_building" class="bg-white medium-input" required="">
								<option value="">Hotel Building</option>
								<option value="New Construction">New Construction</option>
								<option value="Existing Building">Existing Building</option>
								<option value="Conversion">Conversion</option>
							</select>
						</div> 
						<div class="col-md-12 col-sm-12 no-padding">
							<label>*Hotel Opening Date</label>
							<input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Street & Number</label>
							<input type="text" name="hotelinfo_address" placeholder="Street & Number*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*City</label>
							<input type="text" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Country</label>
							<input type="text" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Postal Code</label>
							<input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-12 sm-clear-both no-padding">
							<label>*Hotel Website</label>
							<input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12 no-padding-left">
							<label>*Days open for business</label>
							<input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12">
							<label>Avg. Daily Rate</label>
							<input type="text" name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12 no-padding-right">
							<label>Avg. Occupancy</label>
							<input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input" required="">
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
						<div class="col-md-6 col-sm-12 no-padding-left" >
							<label>*Number of Rooms</label>
							<input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Number of Suites</label>
							<input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input" required="">
						</div>
						<div class="row padding-row">
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>F & B Outlets</label>
								<select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input" >
									<option value="">-</option>
									<option value="Restaurant">Restaurant</option>
									<option value="Bar">Bar</option>
									<option value="Beach Bar">Beach Bar</option>
									<option value="Club">Club</option>
									<option value="Lobby/Lounge">Lobby/Lounge</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Guest Facilities</label>
								<select name="hotelfac_guest_fac" multiple="" class="bg-white medium-input">
									<option value="">-</option>
									<option value="">Gym</option>
									<option value="">Indoor Pool</option>
									<option value="">Outdoor Pool</option>
									<option value="">Spa</option>
									<option value="">Business Center</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Meeting Area</label>
							<input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Meeting Facilities</label>
							<select name="hotelfac_meeting_fac" class="bg-white medium-input">
								<option>Please select</option>
								<option>YES</option>
								<option>NO</option>
							</select>
						</div>
						<div class="col-md-12 sm-clear-both no-padding">
							<label>Comments/Other Facilities</label>
							<textarea name="hotelfac_comments" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea"></textarea>
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Concept</label>
							<textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea" required=""></textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Architecture & Design</label>
							<textarea name="hoteldesc_architecture_design" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea"></textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Architect Name</label>
							<input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Architect Website</label>
							<input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Interior Designer Name</label>
							<input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Interior Designer Website</label>
							<input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Local Integration</label>
							<textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea"></textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand</label>
							<textarea name="hoteldesc_brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea"></textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Brand Agency Name</label>
							<input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand Agency Website</label>
							<input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Brand Linkedin Profile</label>
							<input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand Instagram Profile</label>
							<input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" bg-white medium-input">
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
						<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
						
						<div class="col-md-12 col-sm-12 no-padding entity">
							<label>*Entity Name</label>
							<input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Street & Number</label>
							<input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*City</label>
							<input type="text" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Country</label>
							<input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Postal Code</label>
							<input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input" required="">
						</div>
						<div class="clear"></div>
						<div class="headingmimiform">
							<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*First Name</label>
							<input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Last Name</label>
							<input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Company Name</label>
							<input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Job Title</label>
							<input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input" required="">
						</div>
						
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Phone</label>
							<input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input" required="">
						</div>
					</div>
					<div class="row fooetr-form">
						<div class="col-md-6 col-sm-12 no-padding-left">
							<span><input class="checkbox" type="checkbox" name="hotel_contactprsn_agree" value="1" required="">I agree with the <a href="#">Terms and Conditions</a></span>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right text-align-right">
							<input id="contact-us-button" type="submit" value="Submit" class="btn btn-white"  style="width: 200px" >
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
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">
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