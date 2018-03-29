@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}
@section('content')
	<!-- start Slider form section -->

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
                  <button type="button" class="button viewGalleryBtn">Contact us</button>
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
      <span class="scrollNextDiv"><a class="scrollpage" href="#membershpipStepSec">Scroll Down</a></span>
    @endif
    </section>
    <!-- End Slider form section -->
    <section id="membershpipStepSec" class="membershpipStepSec">
    <div class="container-fluid">
    <div class="row">
        <div class="col-xs-3">
            <div class="stepNumber active">
                <span>1</span>
                <p>STEP 1</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>2</span>
                <p>STEP 2</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>3</span>
                <p>STEP 3</p>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="stepNumber">
                <span>4</span>
                <p>STEP 4</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="hotelInfoSection">
                 <div class="col-md-12 sm-clear-both">
                        <div id="success-contact-form" class="no-margin-lr"></div>
                </div>
                                      
                <form id="hotel-form" action="{{URL::to('frontend_hotelpost')}}" method="post">
                    <div class="row">
                    <h1>Hotel Information</h1>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Hotel Name</label>
                                <input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Hotel Status</label>
                                 <select name="hotelinfo_status" class="form-control" required="">
                                                    <option value="">Select Status</option>
                                                    <option value="Open">Open</option>
                                                    <option value="Construction phase">Construction phase</option>
                                                    <option value="Planning phase">Planning phase</option>
                                                </select>
                              
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Hotel Type</label>
                                 <select name="hotelinfo_type" class="form-control" required="">
                                                    <option value="">Hotel Type</option>
                                                    <option value="Alternative">Alternative</option>
                                                    <option value="Beach Resort">Beach Resort</option>
                                                    <option value="Resort">Resort</option>
                                                    <option value="City">City</option>
                                                    <option value="Mountain">Mountain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Hotel Building</label>
                               <select name="hotelinfo_building" class="form-control" required="">
                                <option value="Hotel Building">Hotel Building</option>
                                <option value="New Construction">New Construction</option>
                                <option value="Existing Building">Existing Building</option>
                                <option value="Conversion">Conversion</option>
                            </select>
                            </div>
                        </div> 
                        <div class="col-md-12 col-sm-12 no-padding">
                            <div class="form-group">
                                <label>*Hotel Opening Date</label>
                                  <input type="date" name="hotelinfo_opening_date" placeholder="Hotel Opening Date*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Street &amp; Number</label>
                                 <input type="text" name="hotelinfo_address" placeholder="Street &amp; Number*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*City</label>
                                 <input type="text" name="hotelinfo_city" placeholder="City*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Country</label>
                                 <input type="text" name="hotelinfo_country" placeholder="Country*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Postal Code</label>
                                <input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="form-control" required="">
                            </div>
                        </div>


                        <div class="col-md-12 sm-clear-both no-padding">
                            <div class="form-group">
                                <label>*Hotel Website</label>
                                <input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Days open for business</label>
                                <input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Avg. Daily Rate</label>
                                <input class="form-control" type="text" placeholder="Avg. Daily Rate*">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Avg. Occupancy</label>
                                <input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="form-control" required="">
                            </div>
                        </div>
                    </div>


                
                    <div class="row">
                        <h1>Hotel Facilities</h1>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Number of Rooms</label>
                                <input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Number of Suites</label>
                                <input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="form-control" required="">
                            </div>
                        </div>
                            <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>F &amp; B Outlets</label>
                                <select name="hotelfac_fb_outlets[]" multiple="" class="form-control" >
                                                        <option value="">-</option>
                                                        <option value="Restaurant">Restaurant</option>
                                                        <option value="Bar">Bar</option>
                                                        <option value="Beach Bar">Beach Bar</option>
                                                        <option value="Club">Club</option>
                                                        <option value="Lobby/Lounge">Lobby/Lounge</option>
                                                    </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-12 no-padding-right">
                                <div class="form-group">
                                    <label>Guest Facilities</label>
                                     <select name="hotelfac_guest_fac[]" multiple="" class="form-control">
                                                        <option value="">-</option>
                                                        <option value="Gym">Gym</option>
                                                        <option value="Indoor Pool">Indoor Pool</option>
                                                        <option value="Outdoor Pool"></option>
                                                        <option value="Spa">Spa</option>
                                                        <option value="Business Center">Business Center</option>
                                                    </select>
                                </div>
                            </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Meeting Area</label>
                                <input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Meeting Facilities</label>
                                 <select name="hotelfac_meeting_fac" class="form-control">
                                                    <option>Please select</option>
                                                    <option>YES</option>
                                                    <option>NO</option>
                                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 sm-clear-both no-padding">
                            <div class="form-group">
                                <label>Comments/Other Facilities</label>
                                <textarea name="hotelfac_comments"  placeholder="Comments/Other Facilities" rows="5" class="form-control"></textarea>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h1>Hotel Description</h1>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Hotel Concept</label>
                                 <textarea name="hoteldesc_concept" placeholder="*Hotel Concept" rows="5" class="form-control" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Architecture &amp; Design</label>
                                <textarea name="hoteldesc_architecture_design"  placeholder="*Architecture & Design" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Architect Name</label>
                                <input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Architect Website</label>
                                <input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Interior Designer Name</label>
                                
                                <input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Interior Designer Website</label>
                                <input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Local Integration</label>
                                <textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Brand</label>
                               <textarea name="hoteldesc_brand"  placeholder="Brand" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Brand Agency Name</label>
                               <input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Brand Agency Website</label>
                                <input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>Brand Linkedin Profile</label>
                                <input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>Brand Instagram Profile</label>
                                 <input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h1>Contact Information</h1>
                        <h2>Property Owning Entity:</h2>
                        
                        <div class="col-md-12 col-sm-12 no-padding entity">
                            <div class="form-group">
                                <label>*Entity Name</label>
                                <input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Street &amp; Number</label>
                               <input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*City</label>
                                <input type="text" name="hotel_contactinfo_city" placeholder="City*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Country</label>
                               <input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Postal Code</label>
                                 <input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="headingmimiform">
                            <h2>Contact Person:</h2>  
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*First Name</label>
                                <input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Last Name</label>
                                <input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Company Name</label>
                                <input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right">
                            <div class="form-group">
                                <label>*Job Title</label>
                                <input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="form-control" required="">
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <div class="form-group">
                                <label>*Phone</label>
                                <input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row fooetr-form">
                        <div class="col-md-6 col-sm-12 no-padding-left">
                            <span> <input class="checkbox" type="checkbox" name="hotel_contactprsn_agree" id="termConditionInput"  value="1" required=""><label for="termConditionInput">I agree with the</label> <a href="#">Terms and Conditions</a></span>
                        </div>
                        <div class="col-md-6 col-sm-12 no-padding-right text-align-right">

                       
                            <input type="submit"  type="submit" value="Submit" id="contact-us-button" class="btn btn-white pull-right" style="width: 200px">
                        </div>
                    </div>
                </form>

             <div id="formerrors"></div>
                                   
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
<style>
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
                    url: "{{ URL::to('hotel/membership')}}",
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
                            window.location.href= "{{URL::to('hotel/package')}}";
                        }
                    }
                });
            }
        });
         </script>    
@endsection

{{-- For footer --}}
@section('footer')
    @parent
@endsection