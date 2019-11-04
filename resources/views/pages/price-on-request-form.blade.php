<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Price On Request Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        {{-- <link href="{{ asset('sximo/assets/css/daterangepicker.min.css')}}" rel="stylesheet" type="text/css"/> --}}
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/book-now-page-style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/m-popup.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jasor-slider.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/crousal-book-form.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/booking-form.css')}}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('sximo/assets/css/ai_bookingform_responsive.css')}}" />
        
        <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
        
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        
        <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
        
        <script src="{{ asset('sximo/assets/js/moment.min.js')}}" type="text/javascript"></script>
        {{-- <script src="{{ asset('sximo/assets/js/jquery.daterangepicker.min.js')}}" type="text/javascript"></script> --}}
        
        <script src="{{ asset('sximo/assets/js/book-now-page-style.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/m-popup.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jasor.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jssor.slider-22.2.10.mini.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/gen_validatorv4.js')}}" type="text/javascript"></script>

        <style>
            .draggable-room-node {
                background-color: #fff;
                width: 151px;
            }
            #ai-custom-villa-booking-Carousel .carousel-inner {
                overflow: visible;
            }
            #ai-custom-villa-booking-Carousel .carousel-inner.overflow-hidden {
                overflow: hidden;
            }
            .compare-villa-box-inner-text.droppable {
                height: 598px;
                padding: 10px;
            }
            .description {
                display: none;
            }
            .compare-villa-box-inner-text.droppable .description {
                display: block;
            }
            .your-contact-detail-form .display-inline-block > div.text-danger {
                color: #a94442;
            }
            .date-picker-wrapper.no-shortcuts.no-gap.two-months {
                top: 585px !important;
            }
            .font-italic{
                font-style: italic;
            }
        </style>
        @if(defined('CNF_GOOGLE_ANALYTIC_KEY'))
            @if(CNF_GOOGLE_ANALYTIC_KEY != '')
        		<!-- Global site tag (gtag.js) - Google Analytics -->
        		<script async src="https://www.googletagmanager.com/gtag/js?id={{ CNF_GOOGLE_ANALYTIC_KEY }}"></script>
        		<script>
        		  window.dataLayer = window.dataLayer || [];
        		  function gtag(){dataLayer.push(arguments);}
        		  gtag('js', new Date());
        
        		  gtag('config', '{{ CNF_GOOGLE_ANALYTIC_KEY }}');
        		</script>
            @endif
        @endif
    </head>
    <body>
              
        <script>
            $(function () {
                $(".draggable").draggable({
                    disabled: true,
                    revert: false,
                    helper: "clone"
                });
                $(".droppable").droppable({
                    drop: function (event, ui) {
                        $(this).html('<span onclick="$(this).parent().empty();">&times;</span>');
                        $(this).append($(ui.draggable).clone());
                    }
                });
                $('#ai-custom-villa-booking-Carousel').on('slide.bs.carousel', function () {
                    $(this).find('.carousel-inner').addClass("overflow-hidden");
                });
                $('#ai-custom-villa-booking-Carousel').on('slid.bs.carousel', function () {
                    $(this).find('.carousel-inner').removeClass("overflow-hidden");
                });
            });
        </script>
        <?php 
        $bg_img = '';
        if(!empty($propertyDetail['propimage'][0]->file_name)){
            $bg_img = $propertyDetail['propimage'][0]->imgsrc.$propertyDetail['propimage'][0]->file_name;
        } 
        ?>
        <div class="" style="background-attachment: fixed; background-image: url('<?php echo $bg_img; ?>'); background-repeat: no-repeat; background-size: cover; min-height: 100vh;">
            <div class="container">
                <div class="form-custom-width">
                      <a href="{{ redirect()->back()->getTargetUrl() }}" class="arrowlefttop radarrow rad-left rad-top"><img src="{{ asset('themes/emporium/images/editorial-left-arrow.png')}}" alt="Icon" /></a>
                      <a href="{{ redirect()->back()->getTargetUrl() }}" class="timestop radarrow rad-right rad-top">&times;</a>
                    {{-- <a href="#"><img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" alt="" class="img-responsive new-book-form-hotel-logo" style="width: 50%;" /></a> --}}
                      <a href="#"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="" class="img-responsive new-book-form-hotel-logo" style="width: 50%;" /></a>
                    <form id="frontend_booking" action="javascript:save_reserve_forms_data('frontend_booking');" >
                        <!--<form id="frontend_booking">-->
                        <div id="booking-form-accordion" class="panel-group booking-form-villa">
                            <input type="hidden" name="property" id="property" value="{{$propertyDetail['data']->id}}" />
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click0" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse1">YOUR STAY</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <h2 class="form-field-tittle">Your {{$member_type}} stay summary</h2>
                                        <div class="booking-form-all-fields">
                                            <div>
                                                <ul class="booking-form-dates" id="two-inputs">
                                                        <li>
                                                            <div class="booking-form-heading">Arrival Date</div>
                                                            <div>
                                                                {{date('d M Y', strtotime($book_arrive_date))}}
                                                                <input type="hidden" id="date-range-arrive" size="20" name="booking_arrive" value="{{ ($book_arrive_date!='') ? $book_arrive_date : date('d.m.Y') }}">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="booking-form-heading">Departure Date</div>
                                                            <div>
                                                                {{date('d M Y', strtotime($book_departure))}}
                                                                <input type="hidden" id="date-range-destination" size="20" name="booking_destination" value="{{ ($book_departure!='') ? $book_departure : '' }}">
                                                            </div>
                                                        </li>
                                                    
                                                        <?php /* <ul class="booking-form-dates" id="two-inputs">
                                                            <li>
                                                                <div class="booking-form-heading">Arrival Date</div>
                                                                <input  id="date-range-arrive" size="20" name="booking_arrive" value="{{ ($arrive_date!='') ? $arrive_date : date('d.m.Y') }}">
                                                            </li>
                                                            <li>
                                                                <div class="booking-form-heading">Departure Date</div>
                                                                <input  id="date-range-destination" size="20" name="booking_destination" value="{{ ($departure!='') ? $departure : '' }}">
                                                            </li>
                                                        </ul>  */ ?>
                                                        
                                                        <li>
                                                            <?php
                                                            $number_of_nights = '';
                                                            if($arrive_date != '' && $departure != '') {
                                                                $date1 = date_create(date('Y-m-d H:i:s', strtotime($departure)));
                                                                $date2 = date_create(date('Y-m-d H:i:s', strtotime($arrive_date)));
                                                                $diff = date_diff($date1, $date2);
                                                                $number_of_nights = $diff->format("%a");
                                                                //$number_of_nights;
                                                            }
                                                            ?>
                                                            <div class="booking-form-heading">#Nights(s)</div>
                                                            {{$number_of_nights}}
                                                            <input type="hidden" id="number_of_nights" min="0" name="number_of_nights"  value="{{$number_of_nights}}">
                                                        </li>
                                                        
                                                    
                                                </ul>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        <div class="booking-form-all-fields-row-2" id="add_suites">
                                        {{--*/ $total_amt = 0 /*--}}
                                        
                                        @if(!empty($obj_item))
                                            <table class="table">
                                            @foreach($obj_item as $si) 
                                                {{--*/ $total_amt = 0; /*--}}                                               
                                                <tr>
                                                    <td width="40%"><img src="{{$si['img_url']}}" class="img-responsive"  /></td>
                                                    <td>
                                                        {{$si['cat_id']->category_name}}
                                                        <input type="hidden" name="booking_Room_type[]" value="{{$si['cat_id']->id}}" />
                                                        <br />
                                                        #Room(s): {{ $si['avail_room'] ? $si['avail_room'] : 1}}
                                                        <input type="hidden" name="booking_Rooms[]" value="{{$si['avail_room']}}" />
                                                        <br />
                                                        Price: {{$si['price']}}
                                                        <input type="hidden" name="booking_Room_price[]" value="{{$si['price']}}" />
                                                        <br />
                                                        Guests: {{ $si['avail_adult'] > 1 ? $si['avail_adult']." adults" : $si['avail_adult']." adults"}} 
                                                                <input type="hidden" name="booking_adults[]" value="{{$si['avail_adult']}}" />
                                                                {{ $si['avail_child'] == 1 ? $si['avail_child']." child" : $si['avail_child']." children" }}
                                                                <input type="hidden" name="booking_children[]" value="{{$si['avail_child']}}" />
                                                                <br />
                                                                @if(!empty($si['avail_ages']))
                                                                    {{--*/ $sr = 1; /*--}}
                                                                    @foreach($si['avail_ages'] as $si_age)
                                                                        child{{$sr}} age: {{$si_age}} 
                                                                        <input type="hidden" name="child_{{$si['cat_id']->id}}[]" id="child_{{$si['cat_id']->id}}_{{$sr}}" value="{{$si_age}}" />
                                                                        <br />
                                                                    {{--*/ $sr++; /*--}}        
                                                                    @endforeach    
                                                                @endif
                                                    </td>
                                                                                                          
                                                </tr>
                                                
                                            @endforeach
                                                
                                            </table>
                                        @endif    
                                        </div> 
                                        <!--                                        <div id="accordion-speical-code">
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading">
                                                                                            <h4 class="panel-title">
                                                                                                <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special1">Special Code</a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapse-special1" class="panel-collapse collapse">
                                                                                            <div class="panel-body">
                                                                                                <input class="custom-booking-input-field"  type="text">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="panel panel-default">
                                                                                        <div class="panel-heading">
                                                                                            <h4 class="panel-title">
                                                                                                <a  data-toggle="collapse" data-parent="#accordion-speical-code" href="#collapse-special2">Special Offer</a>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div id="collapse-special2" class="panel-collapse collapse">
                                                                                            <div class="panel-body">
                                                                                                Design Location Special Offer
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                        <input type="button" class="step-first validate-btn" value="BOOK YOUR STAY">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="click1" data-prevent-click="0" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse2">YOUR SUITE</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        
                                        <!-- Compare Villa -->
                                        <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:400px;overflow:hidden;visibility:hidden;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides" class="custom-thum-style" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
                                                @if(!empty($propertyDetail['propimage']))
                                                @foreach($propertyDetail['propimage'] as $propimage):
                                                @
                                                <div>
                                                    <img class="img-responsive" src="{{$propimage->imgsrc.$propimage->file_name}}" alt=""/>
                                                    <div data-u="thumb">
                                                        <img src="{{$propimage->imgsrc.$propimage->file_name}}" alt=""/>
                                                        <div class="title_back"></div>
                                                        <div class="title">
                                                            {{$propimage->file_title}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach;
                                                @endif
                                            </div>
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort16" style="position:absolute;left:0px;bottom:0px;width:600px;height:100px;" data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div data-u="thumbnailtemplate" class="t"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
                                            <!-- Bullet Navigator -->
                                            <div data-u="navigator" class="jssorb03" style="bottom:116px;right:16px;">
                                                <!-- bullet navigator item prototype -->
                                                <div data-u="prototype" style="width:21px;height:21px;">
                                                    <div data-u="numbertemplate"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Jssor Slider -->
                                        <div class="below-slider-text">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <h4>{{$propertyDetail['data']->property_name}}</h4>
                                                    <p>{{$propertyDetail['data']->about_property}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{$propertyDetail['data']->rooms_suites_desciription}}                                               
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="villa-see-more-details-btn">
                                            <a class ="villa-see-more-toggle" href="javascript:void(0);">See more details</a>
                                            <div class="clearfix"></div>
                                            <p>{{$propertyDetail['data']->architecture_desciription}}</p>                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="button" class="step-2 margin-top-25 validate-btn" value="SUBMIT YOUR ROOM">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="0" class="click3" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse4">YOUR CONTACT DETAILS</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        
                                            <div class="your-contact-detail-form">
                                                
                                                    <h3 class="">Your Contact Details</h3>
                                                    <div class="margin-top-10 display-inline-block">
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Title *</div>
                                                            <select name="title" class="select-width-88 booking-form-select-inputs-style">
                                                                <option value="0"></option>
                                                                <option <?php echo isset($curr_user) ? ($curr_user->title=='Mr' ? 'selected="selected"' : '') : ''; ?> value="Mr">Mr.</option>
                                                                <option <?php echo isset($curr_user) ? ($curr_user->title=='Mrs' ? 'selected="selected"' : '') : ''; ?> value="Mrs">Mrs.</option>
                                                                <option <?php echo isset($curr_user) ? ($curr_user->title=='Miss' ? 'selected="selected"' : '') : ''; ?> value="Miss">Miss</option>
                                                            </select>
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">Last name *</div>
                                                            <input name="last_name" value="<?php echo isset($curr_user) ? $curr_user->last_name : ''; ?>" class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                        <div class="display-inline-block">
                                                            <div class="single-label-width">First Name *</div>
                                                            <input name="first_name" value="<?php echo isset($curr_user) ? $curr_user->first_name : ''; ?>" class="default-input-style margin-right-26" type="text">
                                                        </div>
                                                    </div>
                                                    
                                                    <!--<div class="fields-end-border"></div>-->
                                                    <div>                                                        
                                                        <div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Land Line *</div>
                                                                            <input name="landline_code" value="<?php echo isset($curr_user) ? $curr_user->landline_code : ''; ?>" class="default-input-style margin-right-15 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input name="landline_number" value="<?php echo isset($curr_user) ? $curr_user->landline_number : ''; ?>" class="default-input-style  select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="row">
                                                                    <div class="margin-top-10 display-inline-block">
                                                                        <div class="display-inline-block">
                                                                            <div class="">Mobile *</div>
                                                                            <input name="mobile_code" value="<?php echo isset($curr_user) ? $curr_user->mobile_code : ''; ?>" class="default-input-style margin-right-10 width-68" type="text">
                                                                        </div>
                                                                        <div class="display-inline-block">
                                                                            <input name="mobile_number" value="<?php echo isset($curr_user) ? $curr_user->mobile_number : ''; ?>" class="default-input-style   select-width-200" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="margin-top-10 display-inline-block">
                                                            <div class="display-inline-block">
                                                                <div class="">Email **</div>
                                                                <input name="email" value="<?php echo isset($curr_user) ? $curr_user->email : ''; ?>" class="default-input-style margin-right-10 width-285" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="margin-top-25 display-inline-block">
                                                            <div class="margin-bottom-10">Your preferred means of communication</div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Mailing Address" type="radio">
                                                                <label>Mailing Address</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" checked="" value="Email" type="radio">
                                                                <label>Email</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Land Line" type="radio">
                                                                <label>Land Line</label>
                                                            </div>
                                                            <div class="display-inline-block">
                                                                <input name="prefer_communication_with" value="Mobile" type="radio">
                                                                <label>Mobile</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="partition-border-bottom"></div>
                                                    
                                                    
                                                <input type="button" class="step-4 margin-top-25 validate-btn" value="SUBMIT CONTACT DETAILS">
                                            
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-prevent-click="0" class="click4" data-toggle="collapse" data-parent="#booking-form-accordion" href="#collapse5">CONFIRMATION</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <!--Terms and conditions-->
                                            <div class="margin-top-25 terms-conditiond-sec">
                                                <h4 class="margin-bottom-15">Terms And Conditions</h4>
                                                <input class="our_term_n_conditions_check_box" name="term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    I have read the <a href="{{Url::to('privacy-policy')}}">Privacy Policy</a>. <span class="font-italic">I agree that my personal data will be collected and stored electronically and used electronically to make this reservation with emporium-voyage and the respective partner hotel.</span>  <?php /* <a data-toggle="modal" data-target="#our_term_n_conditions_modal" href="#">emporium-voyage</a> */ ?> 
                                                    <br />
                                                    <span class="font-italic">Note: You may revoke your consent at any time by e-mail to <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a> or from your settings section in your account admin.</span>
                                                </label>
                                                <div id="our_term_n_conditions_modal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" onclick="javascript:$('.our_term_n_conditions_check_box').prop('checked', true);" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">Terms And Conditions</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                					<div class="col-md-12">
                                                						<h1>TERMS AND CONDITIONS</h1>	
                                                						<p><strong>GENERAL TERMS AND CONDITIONS</strong></p><br>
                                                						<p><strong>A. SCOPE OF APPLICATION</strong></p>
                                                						<p>These Terms and Conditions apply to the use of the the Emporium-Collection website and all bookings of hotels via the reservation system of Emporium-Collection, Eisolzriederstrasse 12, 80999 München</p>
                                                						<br>
                                                						<p><strong>B.GENERAL USE OF THE EMPORIUM_COLLECTION WEBSITE</strong></p>
                                                						<p>On the Emporium-Collection websites you can search for the availability and rates of hotels and rooms of your choice at dates defined by you for a specific number of travellers. Emporium-Collection reserves the right to discontinue it's websites at any time.</p><br>
                                                <br>
                                                						
                                                						<p><strong>B.1. HOTEL CONTENT AND CATEGORIES</strong><br></p>All information about a hotel and the descriptions of a hotel are based on the hotel's own assessment. All content about a hotel that is displayed on the Emporium-Collection websites is provided to Emporium-Collection by the respective hotel and Emporium-Collection acts as content provider for the hotel only and is thus not responsible for content, any omissions or typographical errors referring to a hotel. As far as displayed on the Emporium-Collection websites the internationally used hotel classification into stars offers noncommittal information about the hotel's standard, in consideration of self-assessment by the hotel which was provided by the hotel.<p></p><br>
                                                <br>
                                                						
                                                						<p><strong>B.2. PRICES AND TAXES</strong></p><br>
                                                All prices displayed on the Emporium-Collection websites are current, day prices, shown in the name of the individual hotel and are valid for all bookings made via the reservation system of Emporium-Collection as described below in section C. All prices have been provided by the hotel and Emporium-Collection acts as content provider for the hotel only and is thus not responsible for any errors of prices referring to a hotel<p></p><br>
                                                
                                                <p>For Germany, prices displayed on the Emporium-Collection websites always include service charges and VAT. For other countries regulations and rules regarding taxes differ. Please note, that a visitor's tax might apply in certain locations. In some countries, a local tax and/or a service charge is levied on the travel price or room rate. The amount of this tax changes all the time and can’t generally be estimated but requires specific information like the exact period of stay, number of people staying etc. to be calculated. Thus any information regarding such taxes is always noncommittal, as long as you do not enter specific travel dates. When you make a booking as per below Section C. the applicable taxes will in any case be displayed.
                                                </p><br>
                                                
                                                <p>Complimentary room upgrades and late check-outs as part of the Emporium-Collection Community benefits are subject to availability. Hotels reserve the right to discontinue the offer at anytime. </p><br>
                                                
                                                <p>Obvious errors and mistakes (including misprints) are not binding.
                                                </p><br>
                                                <br>
                                                						<p><strong>C. REGISTRATION</strong></p>
                                                						<p>You can register on the Emporium-Collection website. If you voluntarily provide personal data as part of such registration, it will be used to pre-fill the personal details form upon making a booking, and/or be used to provide you with more refined topics in our communications, should you have opted in to any of our newsletters. You can cancel your registration with Design-Loctions at any time. Please send an according e-mail to legal@Emporium-Collection.biz</p>
                                                						  <br>
                                                						
                                                						<p><strong>D.  AUTO LOG IN</strong></p>
                                                						<p>You may choose to stay logged in on our website. We will then will store your login information in a cookie, i.e. a small text file, on your computer so that you do not have to authenticate upon return to our website but will be automatically logged in ("auto log in"). The cookie and thereby the auto log in expires automatically after 60 days. Further information about other cookies is available in our privacy policy..</p>
                                                						<br>
                                                						
                                                						<p><strong>E.  ACCOMMODATION CONTRACT AND PAYMENT </strong></p>
                                                						<p>If you make a booking through Emporium-Collection reservation system the accommodation contract comes into effect between you and the hotel of your choice. You pay the confirmed price directly in the hotel. Any claims and obligations out of the accommodation contract only exist between you and the chosen Hotel. Emporium-Collection does not enter into the contract with you about the accommodation. Rates available and any booking made via the Emporium-Collection reservation system can’t be combined with other offers or promotions, Unless specifically offered on our Booking Page, such can include Spa Bookings</p><br>
                                                						
                                                						<p>Bookings take place according to the best and currently Emporium-Collection day price in each case. This price is submitted directly by the hotel for the arrival date chosen, and is shown in the name of the hotel. Available Design-Location's last-minute, seasonal, weekend or special prices will be considered automatically during the booking. Please be advised converted rates using the website currency converter are based on an estimation of that days exchange rate.</p>
                                                						
                                                						<p><strong>E.1. MAKING A BOOKING </strong></p>
                                                						<p>If you want to make a booking after your availability search, you will have to fill in personal details about you and your credit card details. The credit card details are required to guarantee your booking, the charges will be made by the hotel. If you are logged in to your account the personal details will be pre-filled. By clicking the button “CONFIRM REGISTRATION. Charged upon arrival” you make a binding offer to book the selected room. Prior to making the booking, i.e. prior to clicking the button, you can identify any errors in the data you have provided directly on the website and correct them by clicking “edit” next to the hotel and room description.</p><br>
                                                						
                                                						<p>Every booking offer you make will be forwarded to the corresponding hotel and any messages from the hotel to you, particularly the confirmation of your booking will be forwarded to you via Emporium-Collection as carrier of the message. Emporium-Collection shall have a relationship with you and the hotel only as an independent third party and shall not be a partner, trustee, representative or sub-contractor either for you or the hotel. Also, the hotel shall not be a sub-contractor or vicarious agent of Emporium-Collection. As soon as you receive the booking confirmation from the hotel via the Emporium-Collection reservation system, you have entered into a contract with the hotel and the booking is binding. You will receive a customer booking reference number together with the confirmation of your booking. The use of the Emporium-Collection reservation system is free of charge for you. Bookings are not transferable to any other person and can not be transferred or exchanged for cash or credit.</p>
                                                						<br>
                                                						
                                                						<p><strong>E.2. CANCELATIONS </strong></p>
                                                						<p>You do not have a statutory right of withdrawal from a booking as per Sec. 312 g para 2 no. 9 of the German Civil Code (BGB).</p><br>
                                                						<p>However, a hotel may voluntarily offer a right to cancel or change a booking for selected offers in the Emporium-Collection reservation system. Any such right will be displayed in the order form before you make your order. Where a hotel voluntarily grants such right to cancel or to change a booking in the Emporium-Collection reservation system, any such changes and cancellations have to be carried out via the Emporium-Collection online system or via the Emporium-Collection reservation number (see www.Emporium-Collection.com) to be fully effective. In case of a change or cancellation carried out directly at the hotel, Emporium-Collection cannot provide any information concerning possible discrepancies concerning the date of the cancellation or the fact of cancellation as such</p><br>
                                                						
                                                						<p><strong>E.3. STORING AND ACCESSIBILITY OF THE CONTRACT </strong></p>
                                                						<p>We will store your booking information and the terms and conditions applicable to the booking (collectively referred to as contract�). The current version of our terms and conditions is available for you at http://emporium-voyage.com/terms-and-conditions We also store older version of our terms and conditions. You can access your booking information also after the booking via your Emporium-Collection account.
                                                						
                                                						</p><p><strong>F. LIABILITY</strong></p>
                                                						<p>- In case of intent or gross negligence on part of Emporium-Collection or by its agents or vicarious agents in performance Emporium-Collection shall be liable according to the provisions of applicable law. The same applies in case of breach of an essential contractual obligation (an obligation that must be fulfilled to enable the correct execution of the agreement and which the customer may usually trust and may trust that it will be fulfilled); however, to the extent such breach was unintentionally Emporium-Collection liability shall be limited to typical damages foreseeable under the contract.</p><br>
                                                						
                                                						<p>- Emporium-Collection liability for culpable damage to life, body or health as well as our liability under the Product Liability Act shall remain unaffected.</p>
                                                						
                                                						<p>- Any liability not expressly provided for above shall be disclaimed. Particularly Emporium-Collection disclaims any liability for the reproduction of this website through a third party website or access to this website obtained through a third party website or any user's home page, which reproduction misstates or omits any of the information or limitations and conditions on the room rates and products offered through this website</p><br>
                                                					 
                                                						
                                                						<p><strong>G. INTELLECTUAL PROPERTY</strong></p>
                                                						<p>All trademarks (including, but not limited to, the Emporium-Collection trade mark, reproductions of Emporium-Collection logo), copyright, database rights and other intellectual property rights in the materials on this website (as well as the organisation and layout of this website) together with the underlying software code are owned either directly by Emporium-Collection or by its licensors. Without Emporium-Collection prior written permission, you may not copy, modify, alter, publish, broadcast, distribute, sell or transfer any material on this website or the underlying software code whether in whole or in part. However, the contents of this website may be downloaded, printed or copied for your personal non-commercial use. The Emporium-Collection logo is a registered trademark and is the property of Emporium-Collection and may not be used or reproduced without Emporium-Collection express written permission.</p><br>
                                                						
                                                						<p>Data transfer into other data carriers, even part of it, or it's use for a different purpose to the one designated here, is only permitted with the explicit permission of Emporium-Collection, except where explicitly permitted by applicable law.</p><br>
                                                						
                                                						<p><strong>H. GOVERNING LAW AND PLACE OF JURISDICTION</strong></p>
                                                						<p>All legal relation between you and Emporium-Collection shall exclusively be governed by the laws of the Federal Republic of Germany. If you act as a consumer and have entered into a contract while residing in another country, the application of mandatory law of such country shall not be affected by the previous sentence</p><br>
                                                						
                                                						<p>If you are a trader or an entity of public law, the competent courts in Munich shall have jurisdiction for all disputes. Emporium-Collection shall, however, also be entitled to sue you at your general venue.</p><br>
                                                						
                                                						<p><strong>I. MISCELLANEOUS</strong></p>
                                                						<p>The invalidity or unenforceability of any of these Terms and Conditions shall not affect, impair or invalidate any of the remaining terms and conditions.</p><br>
                                                						
                                                						<p>The website is owned and operated by Emporium-Collection.The website can be used, registrations and bookings can be made and in the English language. </p><br>
                                                						
                                                						<p>Plattform of The European Commission for online dispute resolution: www.ec.europa.eu/consumers/odr</p><br>
                                                						
                                                						
                                                						
                                                												<p><strong>Last Update: April 2017</strong></p>
                                                					</div>
                                                				</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <?php if(!empty($hotel_terms_n_conditions) && trim($hotel_terms_n_conditions->terms_n_conditions) != ''): ?>
                                                <input class="hotel_term_n_conditions_check_box" name="hotel_term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    I agree to my personal data being stored and used to make this reservation <a data-toggle="modal" data-target="#hotel_term_n_conditions_modal" href="#">emporium-voyage</a>
                                                </label>
                                                <div id="hotel_term_n_conditions_modal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" onclick="javascript:$('.hotel_term_n_conditions_check_box').prop('checked', true);" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">{{$propertyDetail['data']->property_name}} Terms And Conditions</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $hotel_terms_n_conditions->terms_n_conditions; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <div class="clearfix"></div>
                                                <input class="hotel_offer_personal_preferences_check_box" name="hotel_offer_personal_preferences" value="On" type="checkbox">
                                                <label>
                                                    <span class="font-italic">I agree to receive booking confirmations via email or phone and acknowledge that i can change my communication methods from my personal account preferences.</span>
                                                </label>
                                                <div class="clearfix"></div>
                                                <input class="emporium_voyage_term_n_conditions_check_box" name="emporium_voyage_term_n_conditions" value="On" type="checkbox">
                                                <label>
                                                    <span class="font-italic">I agree to the emporium-voyage&trade;  <a href="{{Url::to('terms-and-conditions')}}">terms and conditions</a> pertaining to the reservation.</span>
                                                </label>
                                                
                                            </div>
                                            <!--Terms and conditions-->
                                            <div class="partition-border-bottom"></div>
                                            <div class="validations">
                                                <div id="frontend_booking_term_n_conditions_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_emporium_voyage_term_n_conditions_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_hotel_offer_personal_preferences_errorloc" class="error_strings text-danger"></div>
                                                
                                                <div id="frontend_booking_booking_arrive_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_booking_destination_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_number_of_nights_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_title_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_first_name_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_last_name_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_landline_code_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_landline_number_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_mobile_code_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_mobile_number_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_email_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_password_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_confirm_password_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_card_type_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_card_number_errorloc" class="error_strings text-danger"></div>
                                                <!--<div id="frontend_booking_expiry_month_errorloc" class="error_strings text-danger"></div>
                                                <div id="frontend_booking_expiry_year_errorloc" class="error_strings text-danger"></div>-->
                                            </div>
                                            <!--Terms and conditions-->
                                            <input type="submit" class="step-5 margin-top-25 validate-btn" value="SUBMIT CONFIRMATION">
                                        </div>
                                        <div class="form-group">
                                            <div id="emailmsg" style="color: green;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        
        
        <!-- Modal Popup Start -->
        
        <div class="modal fade" id="alert_model" tabindex="-1" role="dialog" style="display: none;">
        	<div class="modal-dialog modal-lg" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="contractModalLabel">
        					Message 
        				</h5>    				
        			</div>
        			<div class="modal-body"> 
                        <p>
                            Sorry for inconvenience,
                            <br />
                            Currently no rooms available in this hotel for this time period. Please check availability on other dates.
                            <br />
                            Thanks
                        </p>                    				
        			</div>
        			<div class="modal-footer">    				
                        <a href="{{ URL::previous() }}" class="btn btn-primary" id="backbtn">Back</a>
        			</div>
        		</div>
        	</div>
        </div>
        
        <!-- Modal Popup End -->
        <!-- Modal Popup Start -->
        
        <div class="modal fade" id="error_model" tabindex="-1" role="dialog" style="display: none;">
        	<div class="modal-dialog modal-lg" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="contractModalLabel">
        					Error 
        				</h5>   
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>			
        			</div>
        			<div class="modal-body"> 
                        <div id="error_modal_html">
                        
                        </div>                  				
        			</div>
        			<div class="modal-footer">    				
                        <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
        			</div>
        		</div>
        	</div>
        </div>
        
        <!-- Modal Popup End -->
        
        <style>
            .booking-form-dates .t-check-in,.t-check-out{
                width: 100% !important;
            }
            .booking-form-dates .t-dates{                
                border: 1px solid #b3b3b3 !important;
                background: #fff !important;
                color: #000 !important;
            }
            #number_of_nights{
                height: 37px !important;
            }
        </style>
        <script>
            $(document).ready(function () {
                
                @if(empty($propertyDetail['typedata'])){
                    $("#alert_model").modal({backdrop: 'static', keyboard: false}, 'show');
                }
                @endif
                
                var arrive_date = '{{$book_arrive_date}}';
                var departure = '{{$book_departure}}';
                
                var chk_date = ''; 
                if(arrive_date != '' && arrive_date != '1970-01-01' && arrive_date != 'null'){
                    
                    var dt = new Date(arrive_date);
                    var t_chk_v_year = dt.getFullYear(); 
                    var t_chk_v_month = dt.getMonth(); 
                    var t_chk_v_day = dt.getDate(); 
                    chk_date = new Date(t_chk_v_year,t_chk_v_month,t_chk_v_day)
                }
                var chk_out_date = ''; 
                if(departure != '' && departure != '1970-01-01' && departure != 'null'){
                    var dt_out = new Date(departure);
                    var t_chk_v_out_year = dt_out.getFullYear(); 
                    var t_chk_v_out_month = dt_out.getMonth(); 
                    var t_chk_v_out_day = dt_out.getDate(); 
                    chk_out_date = new Date(t_chk_v_out_year,t_chk_v_out_month,t_chk_v_out_day);
                }
                
                
                $('#t-middel-picker').tDatePicker({
                    'numCalendar':'2',
                    'autoClose':true,
                    'durationArrowTop':'200',
                    'formatDate':'mm-dd-yyyy',
                    'titleCheckIn':'Arrival',
                    'titleCheckOut':'Departure',
                    'inputNameCheckIn':'booking_arrive',
                    'inputNameCheckOut':'booking_destination',
                    'titleDateRange':'days',
                    'titleDateRanges':'days',
                    'iconDate':'<i class="fa fa-calendar"></i>',
                    'limitDateRanges':'365',
                    'dateCheckIn':chk_date,
                    'dateCheckOut':chk_out_date,
                }).on('afterCheckOut',function(e, dateCO) {
                    s1 = dateCO[0];
                    s2 = dateCO[1];
                    var start = new Date(moment(s1).format('YYYY-MM-DD'));
                    var end = new Date(moment(s2).format('YYYY-MM-DD'));
                    var diff = new Date(end - start);
                    var days = diff/1000/60/60/24;
                    $('#number_of_nights').val(days + 1);   
                    
                    $(".click1").data("prevent-click", "1");
                                     
                });
/*                $('#two-inputs').dateRangePicker({
                    selectForward: (Boolean),
                    stickyMonths: (Boolean),
                    startDate: "<?php echo date('Y-m-d'); ?>",
                    format: 'YYYY-MM-DD',
                    autoClose: "true",
                    separator: ' to ',
                    getValue: function () {
                        if ($('#date-range-destination').val() && $('#date-range-arrive').val())
                            return $('#date-range-destination').val() + ' to ' + $('#date-range-arrive').val();
                        else
                            return '';
                    },
                    setValue: function (s, s1, s2) {
                        var start = new Date(moment(s1).format('YYYY-MM-DD'));
                        var end = new Date(moment(s2).format('YYYY-MM-DD'));
                        var diff = new Date(end - start);
                        var days = diff/1000/60/60/24;
                        $('#number_of_nights').val(days + 1);
                        $('#date-range-arrive').val(moment(s1).format('DD.MM.YYYY'));
                        $('#date-range-destination').val(moment(s2).format('DD.MM.YYYY'));
                    }
                }).bind('datepicker-first-date-selected', function (event, obj) {
                    $("#date-range-destination").val('');
                }); */
            });
        </script>
        <script>
            $(document).ready(function () {
                $("header .menu > a").click(function (event) { console.log("hh");
                    event.preventDefault();
                    $(this).parent().find("ul").toggle("slow");
                });                
                $(".pre-show-btn").click(function () {
                    $(".preferences-hide-area").stop().toggle(1000);
                });
                $(".specify-preferences-tooggle").click(function () {
                    $(".specify-preferences-list-hide").toggle(1000);
                });
                $(".villa-see-more-list").hide(1000);
                $('.villa-see-more-toggle').click(function () {
                    var link = $(this);
                    $('.villa-see-more-list').slideToggle('slow', function () {
                        if ($(this).is(':visible')) {
                            link.text('Hide Details');
                        } else {
                            link.text('Show Details');
                        }
                    });
                });
                $(".secondry-class-list").hide(1000);
                $('.secondry-address-toggle').click(function () {
                    $(".secondry-class-list").toggle(1000);
                });

                $(".your-contact-detail-sec-show-hide").hide(1000);
                $(".guest-reserve-radio-btn").click(function () {
                    $(".your-contact-detail-sec-show-hide").show(1000);
                    $(".guest-contact-detail-sec").show(1000);
                });
                $(".reserving-for-my-self-radio-btn").click(function () {
                    $(".your-contact-detail-sec-show-hide").show(1000);
                    $(".guest-contact-detail-sec").hide(1000);
                });
                $('.btnNext').click(function () {
                    $('.nav-tabs > .active').next('li').find('a').trigger('click');
                });

                $('.btnPrevious').click(function () {
                    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
                });
                $(".compare-villa-show-btn").click(function () {
                    $(".draggable").draggable({
                        disabled: false
                    });
                    $(".compare-villa-show-hide").show(1000);
                    $(".compare-villa-show-btn").hide(1000);
                    $("#jssor_1").hide(1000);
                    $(".below-slider-text").hide(1000);
                });
                $(".compare-villa-close-btn").click(function () {
                    $(".draggable").draggable({
                        disabled: true
                    });
                    $(".compare-villa-show-hide").hide(1000);
                    $(".compare-villa-show-btn").show(1000);
                    $("#jssor_1").show(1000);
                    $(".below-slider-text").show(1000);
                });
                $(".step-first").click(function (event) {                    
                    $(".click1").data("prevent-click", "0");
                    $(".click1").trigger("click");
                });

                $(".click1").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-2").click(function (event) { 
                    $(".click3").data("prevent-click", "0");
                    $(".click3").trigger("click");
                });

                $(".click2").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-3").click(function (event) {
                    event.preventDefault();
                    $(".click3").data("prevent-click", "0");
                    $(".click3").trigger("click");
                });

                $(".click3").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });

                $(".step-4").click(function (event) {
                    event.preventDefault();                    
                    $(".click4").trigger("click");
                });

                $(".click4").click(function (event) {
                    if ($(this).data('prevent-click') == '1') {
                        event.stopPropagation();
                        event.preventDefault();
                        alert("Complete all fields above to continue");
                    }
                });
            });
            var FormStuff = {
                init: function () {
                    this.applyConditionalRequired();
                    this.bindUIActions();
                },
                bindUIActions: function () {
                    $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
                },
                applyConditionalRequired: function () {
                    $(".require-if-active").each(function () {
                        var el = $(this);
                        if ($(el.data("require-pair")).is(":checked")) {
                            el.prop("required", true);
                        } else {
                            el.prop("required", false);
                        }
                    });
                }
            };
            FormStuff.init();
            
            function radRemoveRooms(rrobj){
                if(((typeof $(rrobj).closest('.parent-rad-div').html()) != undefined) && ((typeof $(rrobj).closest('.parent-rad-div').html()) != 'undefined')){
                    $(rrobj).closest('.parent-rad-div').remove();
                }
                
                return false;
            }
            
            $(document).ready(function () {
                $(document).on('click', ".add-new-room-btn", function (event) {
                    event.preventDefault();                    
                    
                    var pid = $("#property").val();
                    var booking_arrive = $('input[name="booking_arrive"]').val();
                    var booking_destination = $('input[name="booking_destination"]').val();
                    var roomType = $('input[name="roomType"]:checked').val();
                    var cthis = $(this);
                    $.ajax({
                        url:"{{ URL::to('traveller/checkcategoryavailability')}}",
                        dataType:'json',
                        type:'get',
                        data:{pid:pid, booking_arrive:booking_arrive, booking_destination:booking_destination, roomType:roomType},
                        success:function(response){
                            
                            var html = '<div class="parent-rad-div"><div class="input-field1">';
                            html += 'SUITE  <a href="#" class="rad-booking-trash-icon" onclick="return radRemoveRooms(this);"><i class="fa fa-trash"></i></a>';
                            html += '</div>';
                            
                            html += '<div class="input-field_more_room2">';
                            html += '<div class="booking-form-heading">Type</div>';
                            html += '<select name="booking_Room_type[]" class="booking-form-select-inputs-style booking_Room_type">';
                            html += '<option value="0"></option>';
                            if(response.length > 0){
                                for(i=0; i<response.length; i++){
                                    console.log(response[i].id);
                                    html += '<option value="'+response[i].id+'">'+response[i].category_name+'</option>';                             
                                }
                            }                    
                            html += '</select>';
                            html += '</div>';
                            
                            html += '<div class="input-field_more_room2">';
                            html += '<div class="booking-form-heading">#Adults(s)</div>';
                            html += '<select name="booking_adults[]" class="booking-form-select-inputs-style booking_adults">';                    
                            html += '<option>1</option>';
                            html += '<option>2</option>';
                            html += '<option>3</option>';
                            html += '<option>4</option>';
                            html += '<option>5</option>';
                            html += '<option>6</option>';
                            html += '</select>';
                            html += '</div>';
                            
                            html += '<div class="input-field_more_room2">';
                            html += '<div class="booking-form-heading">#Children</div>';
                            html += '<select name="booking_children[]" class="booking-form-select-inputs-style booking_children">';
                            html += '<option>0</option>';
                            html += '<option>1</option>';
                            html += '<option>2</option>';
                            html += '</select>';
                            html += '</div>';
                            html += '<div class="clearfix"></div></div>';
                            cthis.before(html);
                        }
                    });
                    
                });
                
                $(".click-preferences-panel-btn-1").change(function() {
                    $(".preferences-panel-btn-1").trigger("click");
                });
                $(".click-preferences-panel-btn-2").blur(function() {
                    $(".preferences-panel-btn-2").trigger("click");
                });
                $(".click-preferences-panel-btn-3").change(function() {
                    $(".preferences-panel-btn-3").trigger("click");
                });
                $(".click-preferences-panel-btn-4").change(function() {
                    $(".preferences-panel-btn-4").trigger("click");
                });
                $(".click-preferences-panel-btn-5").change(function() {
                    if($(this).val() == 'Other') {
                        $(".prefer_language_other").show();
                    }
                    else {
                        $(".prefer_language_other").hide();
                        $(".preferences-panel-btn-5").trigger("click");
                    }
                });
                $(".prefer_language_other").blur(function() {
                    $(".preferences-panel-btn-5").trigger("click");
                });
                $(".lf-submit-btn").click(function( event ) {
                    event.preventDefault();
                    if($("#lf-email").val() == '') {
                        $("#lf-email-alert-msg").html("Please enter email");
                    }
                    else {
                        $("#lf-email-alert-msg").html("");
                    }
                    if($("#lf-password").val() == '') {
                        $("#lf-password-alert-msg").html("Please enter password");
                    }
                    else {
                        $("#lf-password-alert-msg").html("");
                    }
                    if($("#lf-email").val() != '' && $("#lf-password").val() != '') {
                        $.ajax({
                            url: "{{ URL::to('_ajax_login')}}",
                            data: "email=" + $("#lf-email").val() + "&password=" + $("#lf-password").val(),
                            type: "POST",
                            success: function (data, textStatus, jqXHR) {
                                
                                if(data == 'already_logged_in') {
                                    $(".login-form-alert-message").html("You are already logged in.");
                                    $(".login-form-container").fadeOut(3000);
                                }
                                else if(data == 'user_not_active') {
                                    $(".login-form-alert-message").html("Your Account is not active.");
                                }
                                else if(data == 'account_is_blocked') {
                                    $(".login-form-alert-message").html("Your Account is BLocked.");
                                }
                                else if(data == 'logged_in') {
                                    $(".login-form-alert-message").html("You are logged in successfully.");
                                    $(".login-form-container").fadeOut(3000);
                                }
                                else if(data == 'invalid_details') {
                                    $(".login-form-alert-message").html("Your username/password combination was incorrect.");
                                }
                                else {
                                    $(".login-form-alert-message").html("An error occured please try again.");
                                }
                            },
                            error: function () {
                                $(".login-form-alert-message").html("An error occured please try again.");
                            }
                        });
                    }
                });
                /*$(".number_of_children").change(function (){
                    $(".step-first").trigger("click");
                });*/
            });

            function save_reserve_forms_data(formid) {
                if (formid != '') {
                    $.ajax({
                        url: "{{ URL::to('price_on_request')}}",
                        type: "post",
                        data: $('#' + formid).serializeArray(),
                        dataType: "json",
                        success: function (data) {
                            var html = '';
                            $("#emailmsg").html('');
                            if (data.status == 'error') {
                                alert('error');
                            } else {
                                $("#emailmsg").html('Mail Send Successfully');
                                //window.location.href = "{{ URL::to('bookings')}}";
                            }
                        }
                    });
                }
            }
            $(document).ready(function () {
                var frmvalidator = new Validator("frontend_booking");
                frmvalidator.EnableOnPageErrorDisplay();
                frmvalidator.EnableMsgsTogether();
                
                frmvalidator.addValidation("term_n_conditions", "shouldselchk=On", "You must agree with our terms and conditions.");
                
                frmvalidator.addValidation("emporium_voyage_term_n_conditions", "shouldselchk=On", "You must agree to emporium-voyage.");
                frmvalidator.addValidation("hotel_offer_personal_preferences", "shouldselchk=On", "You must agree to personal preferences.");
                
                //frmvalidator.addValidation("hotel_term_n_conditions", "shouldselchk=On", "You must agree with hotel terms and conditions.");
                //frmvalidator.addValidation("booking_arrive2", "req", "Please enter arrival date.");
                frmvalidator.addValidation("booking_arrive", "req", "Please enter arrival date.");
                frmvalidator.addValidation("booking_destination", "req", "Please enter departure date.");
                frmvalidator.addValidation("number_of_nights", "dontselect=0", "Please select number of nights.");
                frmvalidator.addValidation("title", "dontselect=0", "Please select title.");
                frmvalidator.addValidation("first_name", "req", "Please enter first name.");
                frmvalidator.addValidation("last_name", "req", "Please enter last name.");
                frmvalidator.addValidation("landline_code", "req", "Please enter landline code.");
                frmvalidator.addValidation("landline_number", "req", "Please enter landline number.");
                frmvalidator.addValidation("mobile_code", "req", "Please enter mobile code.");
                frmvalidator.addValidation("mobile_number", "req", "Please enter mobile number.");
                frmvalidator.addValidation("email", "req", "Please enter email address.");
                frmvalidator.addValidation("email", "email", "Please enter valid email address.");
                //frmvalidator.addValidation("card_number", "req", "Please enter card number.");
                //frmvalidator.addValidation("card_type", "dontselect=0", "Please select card type.");
                //frmvalidator.addValidation("expiry_month", "dontselect=0", "Please select expiry month.");
                //frmvalidator.addValidation("expiry_year", "dontselect=0", "Please select expiry year.");
                <?php if($is_logged_in == 'false'): ?>
                //frmvalidator.addValidation("password", "req", "Please enter password.");
                //frmvalidator.addValidation("confirm_password", "eqelmnt=password", "Password doesn't matach.");
                <?php endif; ?>
            });
        </script>
        <!--include('layouts/elliot/ai_booking-page')-->
    </body>
</html>