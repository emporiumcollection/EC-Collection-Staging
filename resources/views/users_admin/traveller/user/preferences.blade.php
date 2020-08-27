@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Account  <small> My Preferences </small>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> My Preferences </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        @if(Session::has('message'))	  
    		   {!! Session::get('message') !!}
    	@endif
        
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
		<div class="col-xl-3 col-lg-4 bg-gray">
            
                <div class="row margin-top">
                    <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                        <h2>My Preferences</h2>
                    </div>
                </div>
            
		</div>
		<div class="col-xl-9 col-lg-8">
            <div class="row">
                
                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad" id="img_personal_preferences">
                    <div class="b2c-banner-text">Personal Preferences</div>
                    <img src="{{URL::to('images/personal_preferences.jpg')}}" style="width: 100%;" />
                </div>
                               
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h2> Preferences </h2>
                    <p class="p-text">In this section you manage personal preferences.</p>
                </div>
            
            <div class="col-xl-12 col-lg-12"> 
                <div class="m-portlet m-portlet--full-height bg-color">
                    <div class="m-portlet__body m--padding-20">
                        <div class="m-form__section m-form__section--first">
                                                    
                <form action="{{URL::to('personalized-service/save')}}" method="POST">
                        <input type="hidden" name="ps_id" value="{{@isset($preferences->ps_id) ? $preferences->ps_id : ''}}" />                    
                        <div class="personalized-pefrences pref-top-pad">
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">Where do you want to travel?</h2>
                                <p class="sub-des-heading">You can specify one or more destinations</p>
                            </div>
                            
    			            <div class="col-xl-12 col-lg-12">
                               <div class="choosen-input-align">
                                    <?php
                                        $dest_array= array();
                                        if(isset($preferences->destinations)){
                                            $dest_array = explode(',', $preferences->destinations);
                                        }
                                    ?>
                                    <select name="destinations[]" data-placeholder="Ex: London, Berlin, Cape Town, or New York" class="form-control chosen-select-default chosen-select-input-style" multiple tabindex="4" id="destinationSelect">
                                        <?php                                                        
                                        if(!empty($destinations)) {
                                            foreach ($destinations as $destination) {
                                                
                                                $selected = in_array($destination['id'], $dest_array) ? "selected='selected'" : ""; 
                                                
                                                echo '<option value="'.$destination['id'].'" '.$selected.' >'.$destination['name'].'</option>'.PHP_EOL;                                                                
                                            }
                                        }
                                        ?>
                                    </select>
                                
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <div class="wrong-selection-pannel">
                                    <p class="sub-des-heading wrong-selected-text">Select the destinations you prefer to travel to.</p>
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-right pref-top-pad">
                                <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="personalized-pefrences m--hide pref-top-pad">
                        <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                            <h2 class="black-heading-big">What inspires you?</h2>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                            <div class="row inspiration" id="inspiration">
                            <?php
                                $insp_array= array();
                                if(isset($preferences->inspirations)){
                                    $insp_array = explode(',', $preferences->inspirations);
                                }
                            ?>
                            <?php
                            if(!empty($inspirations)) {
                                foreach ($inspirations as $inspiration) {
                                    $checked = in_array($inspiration->id, $insp_array) ? "checked='checked'" : ""; 
                                    $active = in_array($inspiration->id, $insp_array) ? "active" : "";
                                    ?>
                                    <div class="col-md-3 col-sm-6">
                                        
                                                <label for="inspiration_{{$inspiration->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$inspiration->category_image)}}');" class="personalized-service-checkbox-label <?php echo $active; ?>">
                                                    <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$inspiration->category_name}}
                                                </label>
                                                <input id="inspiration_{{$inspiration->id}}" class="personalized-service-checkbox-input" name="inspirations[]" value="{{$inspiration->id}}" type="checkbox" <?php echo $checked; ?>>
                                            
                                    </div>
                                    <?php
                                }
                            }
                            ?> 
                            </div>                                                                   
                        </div>
                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left">                   
                                    <input type="button" name="previous" data-prev-id="holiday-destination" holiday-destination class="previous btn btn-default" value="Previous" />
                                </div>
                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right">
                                    <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="personalized-pefrences m--hide pref-top-pad">
                        <div class="row" id="experience">
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">What would you like to experience</h2>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <div class="row exprerience">
                                    <?php
                                        $exp_array= array();
                                        if(isset($preferences->experiences)){
                                            $exp_array = explode(',', $preferences->experiences);
                                        }
                                    ?>
                                    <?php
                                    if(!empty($experiences)) {
                                        foreach ($experiences as $experience) {
                                            $checked = in_array($experience->id, $exp_array) ? "checked='checked'" : ""; 
                                            $active = in_array($experience->id, $exp_array) ? "active" : "";
                                            ?>
                                            <div class="col-md-3 col-sm-6">
                                                
                                                    <div class="form-group ps-fields-align">
                                                        <label for="experience_{{$experience->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$experience->category_image)}}');" class="personalized-service-checkbox-label <?php echo $active; ?>">
                                                            <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$experience->category_name}}
                                                        </label>
                                                        <input id="experience_{{$experience->id}}" class="personalized-service-checkbox-input" name="experiences[]" value="{{$experience->id}}" type="checkbox" <?php echo $checked; ?>>
                                                    </div>
                                                
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                        <input type="button" name="previous" data-prev-id="travel-style"  class="previous btn btn-default" value="Previous" />                           
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                        <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                    </div>                                                                        
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="personalized-pefrences m--hide pref-top-pad">
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">What is particularly important to you?</h2>
                                <p class="sub-des-heading">Tell us what you value - the more detailed the better.</p>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                <textarea class="form-control ps-text-area-style" name="note" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon." id="preferences_note">{{@isset($preferences->note) ? $preferences->note : ''}}</textarea>
                            </div> 
                            
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 help-hover-icon">
                                <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                            </div>
                        
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                        <input type="button" name="previous" data-prev-id="travel-style" class="previous btn btn-default" value="Previous" />
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                        <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="personalized-pefrences m--hide pref-top-pad">
                        <div class="row">                                                                
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">How many people travel?</h2>
                            </div>
                        </div>   
                        <div class="row m--align-center pref-botoom-pad">
                            <div class="col-md-6 col-sm-6">
                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Adults</p>
                                <p class="smalldes-label">18* Years</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="ps-adults-handle-counter ps-handle-counter">
                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                    <input class="spinner-input" name="adults" type="text" value="{{@isset($preferences->adults) ? $preferences->adults : 2}}" id="adults">
                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m--align-center pref-botoom-pad">
                            <div class="col-md-6 col-sm-6">
                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Youth</p>
                                <p class="smalldes-label">12-17 Years</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="ps-youth-handle-counter ps-handle-counter">
                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                    <input class="spinner-input" name="youth" type="text" value="{{@isset($preferences->youth) ? $preferences->youth : 0}}" id="youth">
                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                </div>
                            </div>                                                                    
                        </div>
                        <div class="row m--align-center pref-botoom-pad">
                            <div class="col-md-6 col-sm-6">
                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Children</p>
                                <p class="smalldes-label">2-11 Years</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="ps-children-handle-counter ps-handle-counter">
                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                    <input class="spinner-input" name="children" type="text" value="{{@isset($preferences->children) ? $preferences->children : 0}}" id="children">
                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m--align-center pref-botoom-pad"> 
                            <div class="col-md-6 col-sm-6">
                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Toddlers</p>
                                <p class="smalldes-label">under 2 Years</p>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="ps-toddlers-handle-counter ps-handle-counter">
                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                    <input class="spinner-input" name="toddlers" type="text" value="{{@isset($preferences->toddlers) ? $preferences->toddlers : 0}}" id="toddlers">
                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                    <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                </div>
                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                    <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personalized-pefrences m--hide pref-top-pad">
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">When do you normally travel?</h2>
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                
                                <div id="calendar-pick" >
                                    <div id="daterangepicker-inline-container2" class="daterangepicker-inline"></div>
                                    <input type="text" id="datetime_preferences" class="form-control">
                                    <input type="hidden" value="{{@isset($preferences->earliest_arrival) ? $preferences->earliest_arrival : ''}}" name="preferences_arrive" id="hid_preferences_arrive">
                                        <input type="hidden" value="{{@isset($preferences->late_check_out) ? $preferences->late_check_out : ''}}" name="preferences_late_check_out" id="hid_preferences_late_check_out">  
                                    <div class="clearfix"></div>
                                </div> 
                                <div class="form-group">
    	<h2 class="black-heading-big">How long do you normally like to travel?</h2>
                                    <select class="form-control ps-input-style ps-input-width" name="stay_time" id="stay_time">
                                        <option value="1-2 Weeks" {{@isset($preferences->stay_time) ? $preferences->stay_time=='1-2 Weeks' ? "selected='selected'" : "" : ""}}>1-2 Weeks</option>
                                        <option value="2-3 Weeks" {{@isset($preferences->stay_time) ? $preferences->stay_time=='2-3 Weeks' ? "selected='selected'" : "" : ""}}>2-3 Weeks</option>
                                        <option value="3-4 Weeks" {{@isset($preferences->stay_time) ? $preferences->stay_time=='3-4 Weeks' ? "selected='selected'" : "" : ""}}>3-4 Weeks</option>
                                        <option value="4-5 Weeks" {{@isset($preferences->stay_time) ? $preferences->stay_time=='4-5 Weeks' ? "selected='selected'" : "" : ""}}>4-5 Weeks</option>
                                    </select>
                                </div>
                                <div class="form-group pref-left-pad-10"> 
                                    <div class="m-checkbox-list"> 
    									<label class="m-checkbox m-checkbox--state-primary">
    										<input type="checkbox" name="agree" id="agree" value="1" {{@isset($preferences->data_policy) ? $preferences->data_policy==1 ? "checked='checked'" : "" : ""}} />
    										I Agree to the Emporium-Voyage Privacy & Data Protection Policy
    										<span></span>
    									</label>
    								</div>
                                    <div class="error" id="error" style="display: none;">
                                        Please agree to the Privacy & Data Protection Policy.
                                    </div>
                                    <span class="m-form__help">
    									 I agree that my personal data will be collected and stored and used electronically to help the reservation agents with specialized offers pertaining to my travel preferences. 
    Note: You may revoke your consent at any time by e-mail to info@emporium-voyage.com or from your settings section in your account admin.
    								</span>                                                                            
                                </div>
                                <div class="form-group pref-left-pad-10">
                                    <div class="m-checkbox-list">
    									<label class="m-checkbox m-checkbox--state-primary">
    										<input type="checkbox" name="privacy_policy" id="privacy_policy" value="1" {{@isset($preferences->privacy_policy) ? $preferences->privacy_policy==1 ? "checked='checked'" : "" : ""}} />
    										<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Emporium-Voyage Privacy Policy</a>
    										<span></span>
    									</label>
                                    </div>
                                    <div class="error" id="privacy_policy_error" style="display: none;">
                                        Please check privacy policy checkbox.
                                    </div>
                                    <span class="m-form__help">
    									I have read and agree to the Emporium-Voyage Privacy Policy.
    								</span>
                                 </div>            
    							 <div class="form-group pref-left-pad-10">
                                    <div class="m-checkbox-list">
                                    	<label class="m-checkbox m-checkbox--state-primary">
    										<input type="checkbox" name="cookie_policy" id="cookie_policy" value="1" {{@isset($preferences->cookies_policy) ? $preferences->cookies_policy==1 ? "checked='checked'" : "" : ""}} />
    										<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
    										<span></span>
    									</label>
                                    </div>
                                    <div class="error" id="cookie_policy_error" style="display: none;">
                                        Please check cookie policy checkbox.
                                    </div>
                                    <span class="m-form__help">
    									I have read and agree to the Emporium-Voyage Cookie Policy
    								</span>
                                 </div>
                            </div>
                            <div class="help-hover-icon">
                                <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season." data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                            </div>
                            
                            
                            
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                        <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                        <button class="btn btn-default" id="preferences_submit_btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="personalized-pefrences m--hide  pref-top-pad">
                        <div class="row">                                            
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                <img src="{{URL::to('images/thank-you.gif')}}" style="width: 100%;" />
                            </div> 
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center m--padding-20">
                                <h2 class="black-heading-big">Thank You</h2>
                            </div> 
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                            </div> 
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                   
                            </div>                                                                                                                                       
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                        <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                    </div>
                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                        <a href="{{Url::to('dashboard')}}" class="btn btn-primary">Go to Dashboard</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                                                                                
                </form> 
                        </div>
                    </div>
                </div>            
                                           
            
            </div>            
            </div>
		</div>
	</div>
    
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .bg-color{
            background: #fff;
        }
        .p-text{
            font-size: 13px;
            font-weight: 300;
            font-family: Poppins;
        }
    </style>
@endsection

@section('custom_js_script')
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
<script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        
        $('#tab_info').click(function(){
            $("#img_my_profile").css('display', 'none');
            $("#img_personal_information").css('display', '');  
            $("#img_personal_preferences").css('display', 'none');
            $("#img_change_password").css('display', 'none');                
        });
        $('#tab_change_pass').click(function(){
            $("#img_my_profile").css('display', 'none');
            $("#img_personal_information").css('display', 'none');  
            $("#img_personal_preferences").css('display', 'none'); 
            $("#img_change_password").css('display', '');      
        });
        $('#tab_preferences').click(function(){
            $("#img_my_profile").css('display', 'none');
            $("#img_personal_information").css('display', 'none');  
            $("#img_personal_preferences").css('display', ''); 
            $("#img_change_password").css('display', 'none');      
        });
        
        $("#left-personal-info").click(function(){
            $('#myprofile [href="#info"]').trigger('click');  
            $("#img_my_profile").css('display', 'none');
            $("#img_personal_information").css('display', '');  
            $("#img_personal_preferences").css('display', 'none'); 
            $("#img_change_password").css('display', 'none');      
        });
        $("#left-personal-preferences").click(function(){
            $('#myprofile [href="#preferences"]').trigger('click'); 
            $("#img_my_profile").css('display', 'none');
            $("#img_personal_information").css('display', 'none');  
            $("#img_personal_preferences").css('display', '');  
            $("#img_change_password").css('display', 'none');    
        });
        // Multi Tab Form
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;

        $(".next").click(function () {                    
            current_fs = $(this).closest( ".personalized-pefrences" );
            next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
            current_fs.addClass('m--hide');                    
        });

        $(".previous").click(function () {                    
            current_fs = $(this).closest( ".personalized-pefrences" );
            next_fs = $(current_fs).prev(".personalized-pefrences").removeClass('m--hide');                    
            current_fs.addClass('m--hide');     
        });

        $(".submit").click(function () {
            return false;
        });
        
        var t_chk_v = $("#hid_preferences_arrive").val();
        var t_chk_out_v = $("#hid_preferences_late_check_out").val();
        var chk_date = ''; 
        if(t_chk_v != '' && t_chk_v != '1970-01-01'){
            var dt = new Date(t_chk_v);
            var t_chk_v_year = dt.getFullYear(); 
            var t_chk_v_month = dt.getMonth(); 
            var t_chk_v_day = dt.getDate(); 
            chk_date = new Date(t_chk_v_year,t_chk_v_month,t_chk_v_day)
        }
        var chk_out_date = ''; 
        if(t_chk_out_v != '' && t_chk_out_v != '1970-01-01'){
            var dt_out = new Date(t_chk_out_v);
            var t_chk_v_out_year = dt_out.getFullYear(); 
            var t_chk_v_out_month = dt_out.getMonth(); 
            var t_chk_v_out_day = dt_out.getDate(); 
            chk_out_date = new Date(t_chk_v_out_year,t_chk_v_out_month,t_chk_v_out_day);
        }
        
        
/*        $('#t-preferences-picker').tDatePicker({
            'numCalendar':'1',
            'autoClose':true,
            'durationArrowTop':'200',
            'formatDate':'dd-mm-yyyy',
            'titleCheckIn':'Earliest Arrival',
            'titleCheckOut':'Late Check Out',
            'inputNameCheckIn':'preferences_arrive',
            'inputNameCheckOut':'preferences_late_check_out',
            'titleDateRange':'days',
            'titleDateRanges':'days',
            'iconDate':'<i class="fa fa-calendar"></i>',
            'limitDateRanges':'365',
            'dateCheckIn':chk_date,
            'dateCheckOut':chk_out_date,
            //'dateCheckIn':'@if(isset($_GET['preferences_arrive']) && $_GET['preferences_arrive']!=''){{$_GET['preferences_arrive']}}@else{{'null'}}@endif',
            //'dateCheckOut':'@if(isset($_GET['preferences_late_check_out']) && $_GET['preferences_late_check_out']!=''){{$_GET['preferences_late_check_out']}}@else{{'null'}}@endif'
        });*/
        
        /*$('#datetime_preferences').daterangepicker({
            opens: 'right',
            autoApply: true,
            autoUpdateInput: true,
            startDate: chk_date, 
            endDate: chk_out_date                
        }, function(start, end, label) {
            $('input[name="datetime_preferences"]').val(start.format('MM/DD/YYYY') + ' - ' +end.format('MM/DD/YYYY'));
            $('input[name="preferences_arrive"]').val(start.format('YYYY-MM-DD'));
            $('input[name="preferences_late_check_out"]').val(end.format('YYYY-MM-DD'));            
            //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });*/
        
        $('#datetime_preferences').daterangepicker();
        /*var picker2 = $('#datetime_preferences').daterangepicker({ //console.log("hello");
            //parentEl: "#daterangepicker-inline-container2",
            autoApply: true,
            autoUpdateInput: true,
            startDate: chk_date, 
            endDate: chk_out_date,  
            locale:{
                cancelLabel: 'Clear',
            }
        });
        
        picker2.on('apply.daterangepicker', function(ev, picker2) {
            $('.onrange').html(picker2.startDate.format('DD-MM-YYYY') + ' -> ' + picker2.endDate.format('DD-MM-YYYY'));
            $('.include-form').fadeIn("fast");
        });*/
        //picker2.data('daterangepicker').hide = function () {};
        //picker2.data('daterangepicker').show();
        
        $('.personalized-service-checkbox-label').click(function (e) {
            $(this).toggleClass('active').siblings().removeClass('active');
        });
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
        //Input Spinner
        var options = {
            minimum: 1,
            maximize: 10,
            onMinimum: function (e) {
                console.log('reached minimum: ' + e);
            },
            onMaximize: function (e) {
                console.log('reached maximize' + e);
            }
        };
        
        $('.ps-adults-handle-counter').handleCounter({minimum:1, maximize: 100});
        $('.ps-youth-handle-counter').handleCounter({minimum:0, maximize: 100});
        $('.ps-children-handle-counter').handleCounter({minimum:0, maximize: 100});
        $('.ps-toddlers-handle-counter').handleCounter({minimum:0, maximize: 100});
        
        
    });
</script>
        
    
<script>
$(document).ready(function(){
    
       $.validator.addMethod("pwcheck",
            function(value) {
                return /[A-Z]/.test(value) // has a lowercase letter                        
       }); 
       $.validator.addMethod("specialcheck",
            function(value) {
                return /[^a-zA-Z\d]/.test(value) // has a lowercase letter                        
       });  
          
       $("#frm_changepass").validate({
            //== Validate only visible fields
            //ignore: ":hidden",
            
            //== Validation rules
            rules: {                 
                password: {
                    required: true,
                    minlength: 8,
                    pwcheck: true,
                    specialcheck: true,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
    
            //== Validation messages
            messages: {
                password: {
                    pwcheck: "Must be one uppercase character",
                    specialcheck: "Must be one special character",
                }/*, 
                password: {
                    required: "Last name field is required"
                }*/
            },
            
            //== Display error  
            invalidHandler: function(event, validator) {
                
            },
    
            //== Submit valid form
            submitHandler: function (form) {
                var fdata = $( form ).serialize();
                $.ajax({
                    url:"{{URL::to('changepassword')}}",
                    type:'POST',
                    dataType:'json',                    
                    data:fdata,
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);                                
                            $("#frm_changepass")[0].reset();
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });    
   
    
    
   $("#remove_account").click(function(){
      if(confirm('Are you sure you wish to permanently remove your account. This action cannot be reversed. All your reservation & account information will be removed')){
          $.ajax({
        	  url: "{{ URL::to('user/removeaccount')}}",
        	  type: "post",
        	  dataType: "json",
        	  success: function(response){
        		if(response.status == 'success'){
                    toastr.success(response.message);
                    window.location.href = "{{Url::to('/')}}";
                }
              }
           });
       }
   }); 
    
    
   $("#contractacceptbtn").click(function(e){
        e.preventDefault();
        
        if($('[name="accept_contract"]').is(":checked") === false){ $('[name="accept_contract"]').closest('label').trigger('click'); }
        $("#contractclosebtn").trigger('click');
   });
   
    $("#preferences_submit_btn").click(function(e){ 
        e.preventDefault();
        
        var destinations=[];
        var i = 0;
        $('#destinationSelect :selected').each(function(){
             destinations[i]=$(this).val();
             i++;
        });
        
        var insperations=[];
        var j = 0;
        $('#inspiration .personalized-service-checkbox-input:checked').each(function () {
           insperations[j] = $(this).val();
           j++;
        }); 
        
        var experiences=[];
        var k = 0;
        $('#experience .personalized-service-checkbox-input:checked').each(function () {
           experiences[k] = $(this).val();
           k++;
        }); 
        
        var note = $("#preferences_note").val();
        
        var error = true;
        if($("#agree").is(":checked")){
            $("#error").css("display", "none");
            error = false;
        }else{
            error = true;
            $("#error").css("display", "");
        }
        if($("#privacy_policy").is(":checked")){
            $("#privacy_policy_error").css("display", "none");
            error = false;
        }else{
            error = true;
            $("#privacy_policy_error").css("display", "");
        }
        if($("#cookie_policy").is(":checked")){
            $("#cookie_policy_error").css("display", "none");
            error = false;
        }else{
            error = true;
            $("#cookie_policy_error").css("display", "");
        }
                
        if(error){ console.log("error");
            //$("#error").css("display", "");
        }else{                    
            $("#error").css("display", "none");
            var fdata = new FormData();  
            fdata.append("ps_id", $("input[name=ps_id]").val());               
            fdata.append("_token",$("input[name=_token]").val());
            fdata.append("form_wizard",$("input[name=form_wizard_2]").val()); 
            
            fdata.append("destinations", destinations); 
            fdata.append("inspirations", insperations);
            fdata.append("experiences", experiences);
            fdata.append("note", note);
            fdata.append("adults",$("input[name=adults]").val());
            fdata.append("youth",$("input[name=youth]").val());
            fdata.append("children",$("input[name=children]").val());
            fdata.append("toddlers",$("input[name=toddlers]").val());
            
            
            fdata.append("earliest_arrival",$("input[name=preferences_arrive]").val());
            fdata.append("late_check_out",$("input[name=preferences_late_check_out]").val());
                    
            fdata.append("stay_time",$('#stay_time :selected').val());
            
            fdata.append("data_policy",$("input[name=agree]:checked").val());
            fdata.append("privacy_policy",$("input[name=privacy_policy]:checked").val());
            fdata.append("cookies_policy",$("input[name=cookie_policy]:checked").val());
            
            $.ajax({
                url:"{{URL::to('personalized-service/ajax_save')}}",
                type:'POST',
                dataType:'json',
                contentType: false,
                processData: false,
                data:fdata,
                headers: {
                    'Access-Control-Allow-Origin': '*'
                },
                success:function(response){
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        current_fs = $("#preferences_submit_btn").closest( ".personalized-pefrences" );
                        next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
                        current_fs.addClass('m--hide');
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            }); 
        }
   });
});

$('input[type="checkbox"][id="copyadd"]').on('ifChecked', function(){
	$('#billing_address').val($('#shipping_address').val());
	$('#billing_address2').val($('#shipping_address2').val());
	$('#billing_city').val($('#shipping_city').val());
	$('#billing_postal_code').val($('#shipping_postal_code').val());
	$('#billing_country').val($('#shipping_country').val());
});

function fillProfile(obj)
{
	var custid = $(obj).val();
	$.ajax({
	  url: "{{ URL::to('getUserprofile')}}",
	  type: "post",
	  data: "customer="+custid,
	  dataType: "json",
	  success: function(data){
		if(data!='error')
		{
			$('#company_phone').val(data.phone);
			$('#company_email').val(data.email);
			$('#company_postal_code').val(data.zip);
			$('#comapny_address').val(data.street);
			$('#company_name').val(data.shoptitle);
			$('#company_city').val(data.city);
		}
	  }
	});
}

function deleteAds(ads_id, formid)
{
	if(ads_id!='')
	{
		var confirmd = confirm("{{ Lang::get('core.ads_delete_confirm_msg') }}");
		if(confirmd==true)
		{
			$.ajax({
			  url: "{{ URL::to('deleteUserAds')}}",
			  type: "post",
			  data: "adsId="+ads_id,
			  dataType: "json",
			  success: function(data){
				if(data!='error')
				{
					$('#'+formid)[0].reset();
				}
				else{
					alert('No Advertisement Found');
				}
			  }
			});
		}
	}
}
</script>
@stop
