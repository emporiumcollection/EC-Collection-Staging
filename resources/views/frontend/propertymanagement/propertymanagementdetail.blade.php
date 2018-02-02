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
    <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Account Settings</a></li>
	<li role="presentation" class="active"><a href="{{URL::to('hotel/propertymanagement/list')}}">Property Management</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> 
	 
	 <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
				<div id="formerrors"></div>
                <form id="hotel-form" action="{{URL::to('hotel/propertymanagement/savepropertydetail')}}" method="post">
					<input type="hidden" name="propsid" value="{{(!empty($property)) ? $property->id : ''}}" />
					<div class="col-md-12 sm-clear-both">
						<div id="success-contact-form" class="no-margin-lr"></div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Name</label>
							<input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" value="{{(!empty($property)) ? $property->property_name : ''}}" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Hotel Status</label>
							<select name="hotelinfo_status" class="bg-white medium-input" required="">
								<option value="">Select Status</option>
								<option value="Open" {{(!empty($property)) ? ($property->hotelinfo_status=='Open') ? 'selected="selected"' : '' : ''}}>Open</option>
								<option value="Construction phase" {{(!empty($property)) ? ($property->hotelinfo_status=='Construction phase') ? 'selected="selected"' : '' : ''}}>Construction phase</option>
								<option value="Planning phase" {{(!empty($property)) ? ($property->hotelinfo_status=='Planning phase') ? 'selected="selected"' : '' : ''}}>Planning phase</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Type</label>
							<select name="hotelinfo_type" class="bg-white medium-input" required="">
								<option value="">Hotel Type</option>
								<option value="Alternative" {{(!empty($property)) ? ($property->hotelinfo_type=='Alternative') ? 'selected="selected"' : '' : ''}}>Alternative</option>
								<option value="Beach Resort" {{(!empty($property)) ? ($property->hotelinfo_type=='Beach Resort') ? 'selected="selected"' : '' : ''}}>Beach Resort</option>
								<option value="Resort" {{(!empty($property)) ? ($property->hotelinfo_type=='Resort') ? 'selected="selected"' : '' : ''}}>Resort</option>
								<option value="City" {{(!empty($property)) ? ($property->hotelinfo_type=='City') ? 'selected="selected"' : '' : ''}}>City</option>
								<option value="Mountain" {{(!empty($property)) ? ($property->hotelinfo_type=='Mountain') ? 'selected="selected"' : '' : ''}}>Mountain</option>
							</select>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Hotel Building</label>
							<select name="hotelinfo_building" class="bg-white medium-input" required="">
								<option value="Hotel Building" {{(!empty($property)) ? ($property->hotelinfo_building=='Hotel Building') ? 'selected="selected"' : '' : ''}}>Hotel Building</option>
								<option value="New Construction" {{(!empty($property)) ? ($property->hotelinfo_building=='New Construction') ? 'selected="selected"' : '' : ''}}>New Construction</option>
								<option value="Existing Building" {{(!empty($property)) ? ($property->hotelinfo_building=='Existing Building') ? 'selected="selected"' : '' : ''}}>Existing Building</option>
								<option value="Conversion" {{(!empty($property)) ? ($property->hotelinfo_building=='Conversion') ? 'selected="selected"' : '' : ''}}>Conversion</option>
							</select>
						</div> 
						<div class="col-md-12 col-sm-12 no-padding">
							<label>*Hotel Opening Date</label>
							<input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" value="{{(!empty($property)) ? $property->hotelinfo_opening_date : ''}}" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Street & Number</label>
							<input type="text" name="hotelinfo_address" placeholder="Street & Number*" value="{{(!empty($property)) ? $property->hotelinfo_address : ''}}" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*City</label>
							<input type="text" value="{{(!empty($property)) ? $property->city : ''}}" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Country</label>
							<input type="text" value="{{(!empty($property)) ? $property->country : ''}}" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Postal Code</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelinfo_postal : ''}}" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-12 sm-clear-both no-padding">
							<label>*Hotel Website</label>
							<input type="text" value="{{(!empty($property)) ? $property->website : ''}}" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12 no-padding-left">
							<label>*Days open for business</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelinfo_daysopen : ''}}" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12">
							<label>Avg. Daily Rate</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelinfo_avg_daily_rate : ''}}"  name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-4 col-sm-12 no-padding-right">
							<label>Avg. Occupancy</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelinfo_avg_occupancy : ''}}" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input" required="">
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
						<div class="col-md-6 col-sm-12 no-padding-left" >
							<label>*Number of Rooms</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelfac_num_rooms : ''}}" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Number of Suites</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelfac_num_suites : ''}}" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input" required="">
						</div>
						<div class="row padding-row">
							<div class="col-md-6 col-sm-12 no-padding-left">
								<label>F & B Outlets</label>
								<select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input" >
									<option value="">-</option>
									<option value="Restaurant" {{(!empty($property)) ? ($property->hotelfac_fb_outlets=='Restaurant') ? 'selected="selected"' : '' : ''}}>Restaurant</option>
									<option value="Bar" {{(!empty($property)) ? ($property->hotelfac_fb_outlets=='Bar') ? 'selected="selected"' : '' : ''}}>Bar</option>
									<option value="Beach Bar" {{(!empty($property)) ? ($property->hotelfac_fb_outlets=='Beach Bar') ? 'selected="selected"' : '' : ''}}>Beach Bar</option>
									<option value="Club" {{(!empty($property)) ? ($property->hotelfac_fb_outlets=='Club') ? 'selected="selected"' : '' : ''}}>Club</option>
									<option value="Lobby/Lounge" {{(!empty($property)) ? ($property->hotelfac_fb_outlets=='Lobby/Lounge') ? 'selected="selected"' : '' : ''}}>Lobby/Lounge</option>
								</select>
							</div>
							<div class="col-md-6 col-sm-12 no-padding-right">
								<label>Guest Facilities</label>
								<select name="hotelfac_guest_fac" multiple="" class="bg-white medium-input">
									<option value="">-</option>
									<option value="Gym" {{(!empty($property)) ? ($property->hotelfac_guest_fac=='Gym') ? 'selected="selected"' : '' : ''}}>Gym</option>
									<option value="Indoor Pool" {{(!empty($property)) ? ($property->hotelfac_guest_fac=='Indoor Pool') ? 'selected="selected"' : '' : ''}}>Indoor Pool</option>
									<option value="Outdoor Pool" {{(!empty($property)) ? ($property->hotelfac_guest_fac=='Outdoor Pool') ? 'selected="selected"' : '' : ''}}>Outdoor Pool</option>
									<option value="Spa" {{(!empty($property)) ? ($property->hotelfac_guest_fac=='Spa') ? 'selected="selected"' : '' : ''}}>Spa</option>
									<option value="Business Center" {{(!empty($property)) ? ($property->hotelfac_guest_fac=='Business Center') ? 'selected="selected"' : '' : ''}}>Business Center</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Meeting Area</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotelfac_meeting_area : ''}}" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Meeting Facilities</label>
							<select name="hotelfac_meeting_fac" class="bg-white medium-input">
								<option>Please select</option>
								<option value="YES" {{(!empty($property)) ? ($property->hotelfac_meeting_fac=='YES') ? 'selected="selected"' : '' : ''}}>YES</option>
								<option value="NO" {{(!empty($property)) ? ($property->hotelfac_meeting_fac=='NO') ? 'selected="selected"' : '' : ''}}>NO</option>
							</select>
						</div>
						<div class="col-md-12 sm-clear-both no-padding">
							<label>Comments/Other Facilities</label>
							<textarea name="hotelfac_comments" id="comment" placeholder="Comments/Other Facilities" rows="5" class="bg-white medium-textarea">{{(!empty($property)) ? $property->hotelfac_comments : ''}}</textarea>
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Description</h5>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Hotel Concept</label>
							<textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea" required="">{{(!empty($property)) ? $property->hoteldesc_concept : ''}}</textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Architecture & Design</label>
							<textarea name="hoteldesc_architecture_design" id="comment" placeholder="*Architecture & Design" rows="5" class="bg-white medium-textarea">{{(!empty($property)) ? $property->architecture_design_desciription : ''}}</textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Architect Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->architecture_design_title : ''}}" name="hoteldesc_architecture_name" placeholder="Architect Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Architect Website</label>
							<input type="text" value="{{(!empty($property)) ? $property->architecture_design_url : ''}}" name="hoteldesc_architecture_website" placeholder="Architect Website" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Interior Designer Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->architecture_designer_title : ''}}" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Interior Designer Website</label>
							<input type="text" value="{{(!empty($property)) ? $property->architecture_designer_url : ''}}" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Local Integration</label>
							<textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="bg-white medium-textarea">{{(!empty($property)) ? $property->hoteldesc_local_integration : ''}}</textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand</label>
							<textarea name="hoteldesc_brand" id="comment" placeholder="Brand" rows="5" class="bg-white medium-textarea">{{(!empty($property)) ? $property->hoteldesc_brand : ''}}</textarea>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Brand Agency Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->hoteldesc_brand_agency_name : ''}}" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand Agency Website</label>
							<input type="text" value="{{(!empty($property)) ? $property->hoteldesc_brand_agency_website : ''}}" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>Brand Linkedin Profile</label>
							<input type="text" value="{{(!empty($property)) ? $property->hoteldesc_brand_linkdin_profile : ''}}" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="bg-white medium-input">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>Brand Instagram Profile</label>
							<input type="text" value="{{(!empty($property)) ? $property->social_instagram : ''}}" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" bg-white medium-input">
						</div>
					</div>
					<div class="row">
						<h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Contact Information</h5>
						<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Property Owning Entity:</h6>
						
						<div class="col-md-12 col-sm-12 no-padding entity">
							<label>*Entity Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotel_contactinfo_name : ''}}"  name="hotel_contactinfo_name" placeholder="Entity Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Street & Number</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_address : ''}}" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*City</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_city : ''}}" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Country</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_country : ''}}" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Postal Code</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_postal_code : ''}}" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input" required="">
						</div>
						<div class="clear"></div>
						<div class="headingmimiform">
							<h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*First Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_name : ''}}" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Last Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_last_name : ''}}" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Company Name</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotel_contactprsn_companyname : ''}}" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input" required="">
						</div>
						<div class="col-md-6 col-sm-12 no-padding-right">
							<label>*Job Title</label>
							<input type="text" value="{{(!empty($property)) ? $property->hotel_contactprsn_jobtitle : ''}}" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input" required="">
						</div>
						
						<div class="col-md-6 col-sm-12 no-padding-left">
							<label>*Phone</label>
							<input type="text" value="{{(!empty($property)) ? $property->owner_phone_primary : ''}}" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input" required="">
						</div>
					</div>
					<div class="row fooetr-form">
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
<style>
.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
</style>
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
<script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
<script>
              window.ParsleyConfig = {
                    errorsWrapper: '<div></div>',
                    errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
                    errorClass: 'has-error',
                    successClass: 'has-success'
                };


            
        $(function () {
          $('#hotel-form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
          })
          .on('form:submit', function() {
            submit_hotelinfo_form();
            return false; // Don't submit form for this demo
          });


          function submit_hotelinfo_form()
            {
                $.ajax({
                    url: "{{ URL::to('hotel/propertymanagement/savepropertydetail')}}",
                    type: "post",
                    data: $('#hotel-form').serializeArray(),
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'error')
                        {
                            var html = '';
                            html +='<ul class="parsley-error-list">';
                            $.each(data.errors, function(idx, obj) {
                                html +='<li>'+obj+'</li>';
                            });
                            html +='</ul>';
                            $('#formerrors').html(html);
                            window.scrollTo(0, 600);
                        } 
                        else
                        {
                            var htmli = '';
                            htmli +='<div class="alert alert-success fade in block-inner">';
                            htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
                            htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
                            $('#formerrors').html(htmli);
                        }
                    }
                });
            }
        });
         </script> 
@endsection