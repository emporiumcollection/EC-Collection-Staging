
@extends('frontend.layouts.ev.customer')
@section('content')
	<!-- start contact form section -->
                    <section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                        <div class="container-fluid">
                            <div class="row equalize sm-equalize-auto">
                                
                                <div class="col-md-12 sm-clear-both wow fadeInLeft no-padding">
                                    <div class="padding-ten-half-all bg-light-gray md-padding-seven-all xs-padding-30px-all height-100">
                                        <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-primary btn-circle cursor">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a  type="button" class="btn btn-default btn-circle cursor" disabled="disabled">3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                                        <!--<span class="text-extra-dark-gray alt-font text-large font-weight-600 margin-25px-bottom display-block">Application form</span>--> 
										<div id="formerrors"></div>
                                        <form id="contact-form" action="{{URL::to('frontend_hotelpost')}}" method="post">
                                            <div class="col-md-12 sm-clear-both">
                                                <div id="success-contact-form" class="no-margin-lr"></div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Information</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Name</label>
                                                    <input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Status</label>
                                                    <select name="hotelinfo_status" class="bg-white medium-input">
                                                        <option value="">Select Status</option>
                                                        <option value="">Open</option>
                                                        <option value="">Construction phase</option>
                                                        <option value="">Planning phase</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Hotel Type</label>
                                                    <select name="hotelinfo_type" class="bg-white medium-input">
                                                        <option value="">Hotel Type</option>
                                                        <option value="">Alternative</option>
                                                        <option value="">Beach Resort</option>
                                                        <option value="">Resort</option>
                                                        <option value="">City</option>
                                                        <option value="">Mountain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Hotel Building</label>
                                                    <select name="hotelinfo_building" class="bg-white medium-input">
                                                        <option value="">Hotel Building</option>
                                                        <option value="">New Construction</option>
                                                        <option value="">Existing Building</option>
                                                        <option value="">Conversion</option>
                                                    </select>
                                                </div> 
                                                <div class="col-md-12 col-sm-12 no-padding">
                                                    <label>*Hotel Opening Date</label>
                                                    <input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="hotelinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="hotelinfo_city" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="hotelinfo_country" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-12 sm-clear-both no-padding">
                                                    <label>*Hotel Website</label>
                                                    <input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-left">
                                                    <label>*Days open for business</label>
                                                    <input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <label>Avg. Daily Rate</label>
                                                    <input type="text" name="hotelinfo_avg_daily_rate" placeholder="Avg. Daily Rate*" value="EUR" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-4 col-sm-12 no-padding-right">
                                                    <label>Avg. Occupancy</label>
                                                    <input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Hotel Facilities</h5>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Number of Rooms</label>
                                                    <input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Number of Suites</label>
                                                    <input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="bg-white medium-input">
                                                </div>
                                                <div class="row padding-row">
                                                    <div class="col-md-6 col-sm-12 no-padding-left">
                                                        <label>F & B Outlets</label>
                                                        <select name="hotelfac_fb_outlets" multiple="" class="bg-white medium-input">
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
                                                    <textarea name="hoteldesc_concept" id="comment" placeholder="*Hotel Concept" rows="5" class="bg-white medium-textarea"></textarea>
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
												<div class="col-md-12 col-sm-12 no-padding">
                                                    <label>Signup Type</label>
                                                    <select name="hotel_signup_type" id="hotel_signup_type" class="bg-white medium-input">
                                                        <option>Please select</option>
                                                        <option value="company">Company</option>
                                                        <option value="advertiser">Advertiser</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 col-sm-12 no-padding entity">
                                                    <label>*Entity Name</label>
                                                    <input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Street & Number</label>
                                                    <input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*City</label>
                                                    <input type="text" name="hotel_contactinfo_city" placeholder="City*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Country</label>
                                                    <input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Postal Code</label>
                                                    <input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="bg-white medium-input">
                                                </div>
                                                <div class="clear"></div>
                                                <div class="headingmimiform">
                                                    <h6 class="ev-regural-sub-heading text-uppercase margin-20px-bottom font-weight-600 sm-width-100 xs-width-100 border-bottom skcstm">Contact Person:</h6>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*First Name</label>
                                                    <input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Last Name</label>
                                                    <input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Company Name</label>
                                                    <input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Job Title</label>
                                                    <input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <label>*Email Address</label>
                                                    <input type="email" name="hotel_contactprsn_email" placeholder="Email*" class="bg-white medium-input">
                                                </div>
												<div class="col-md-6 no-padding-right">
                                                    <label>*Username</label>
                                                    <input type="email" name="hotel_contactprsn_username" placeholder="Username*" class="bg-white medium-input">
                                                </div>
												<div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Password</label>
                                                    <input type="password" name="hotel_contactprsn_password" placeholder="Password*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Confirm Password</label>
                                                    <input type="password" name="hotel_contactprsn_password_confirmation" placeholder="Confirm password*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <label>*Phone</label>
                                                    <input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="bg-white medium-input">
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right">
                                                    <label>*Mobile</label>
                                                    <input type="text" name="hotel_contactprsn_mobile" placeholder="Mobile*" class="bg-white medium-input">
                                                </div>
                                            </div>
                                            <div class="row fooetr-form">
                                                <div class="col-md-6 col-sm-12 no-padding-left">
                                                    <span><input class="checkbox" type="checkbox" name="hotel_contactprsn_agree" value="1">I agree with the <a href="#">Terms and Conditions</a></span>
                                                </div>
                                                <div class="col-md-6 col-sm-12 no-padding-right text-align-right">
                                                    <button id="contact-us-button" type="button" class="btn btn-white" onclick="submit_hotelinfo_form();" style="width: 200px">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection