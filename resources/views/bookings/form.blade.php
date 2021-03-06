@extends('layouts.app')

@section('content')

<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('bookings?return='.$return) }}">{{ $pageTitle }}</a></li>
            <li class="active">{{ Lang::get('core.addedit') }} </li>
        </ul>

    </div>

    <div class="page-content-wrapper">
        <ul class="parsley-error-list">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="sbox animated fadeInRight">
            <div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
            <div class="sbox-content">

                {!! Form::open(array('url'=>'bookings/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                <div class="col-md-12">                    
                    <fieldset>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#booking_info" data-toggle="tab">Booking Info</a></li>
                            <li><a href="#preferences" data-toggle="tab">Preferences</a></li>
                            <li><a href="#_rooms" data-toggle="tab">Rooms</a></li>
                            <?php if($login_user->group_id == 5): ?>
                            <li><a href="#_credit_card_details" data-toggle="tab">Credit Card Details</a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content">
                            <div id="booking_info" class="tab-pane m-t active">
                                <div class="text-center">
                                    {{--*/ if(isset($category->category_name)){ /*--}}
                                    <h3>{{$category->category_name}}</h3>
                                    <img height="150" src="{{$category_image->imgsrc.$category_image->file_name}}" />
                                    <div>{{($currency->content!='') ? $currency->content : '$'}} {{$category->price}}</div>
                                    {{--*/ } /*--}}
                                </div>
                                <legend>User Details</legend>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Full Name </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $title = isset($user_info->title) ? $user_info->title : ''; 
                                            $first_name = isset($user_info->first_name) ? $user_info->first_name : '';
                                            $last_name = isset($user_info->last_name) ? $user_info->last_name : '';                                            
                                        /*--}}
                                        <input class="form-control" readonly="" value="{{$title.' '.$first_name.' '.$last_name}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Birthday </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $birthday = isset($user_info->birthday) ? date('d M, Y', strtotime($user_info->birthday)) : '';                           
                                        /*--}}
                                        <input class="form-control" readonly="" value="<?php echo $birthday ?>" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Land Line </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $landline_code = isset($user_info->landline_code) ? $user_info->landline_code : ''; 
                                            $landline_number = isset($user_info->landline_number) ? $user_info->landline_number : '';                          
                                        /*--}}
                                        <input class="form-control" readonly="" value="{{$landline_code.'-'.$landline_number}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Mobile </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $mobile_code = isset($user_info->mobile_code) ? $user_info->mobile_code : ''; 
                                            $mobile_number = isset($user_info->mobile_number) ? $user_info->mobile_number : '';                          
                                        /*--}}
                                        <input class="form-control" readonly="" value="{{$mobile_code.'-'.$mobile_number}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Email </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $email = isset($user_info->email) ? $user_info->email : '';        
                                        /*--}}
                                        <input class="form-control" readonly="" value="{{$email}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Preferred means of communication </label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $prefer_communication_with = isset($user_info->prefer_communication_with) ? $user_info->prefer_communication_with : '';        
                                        /*--}}
                                        <input class="form-control" readonly="" value="{{$prefer_communication_with}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Guest Details</legend>
                                <div class="form-group  " >
                                    <label for="Guest Title" class=" control-label col-md-4 text-left"> Guest Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_title', $row['guest_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Names" class=" control-label col-md-4 text-left"> Guest Names </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_names', $row['guest_names'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Birthday" class=" control-label col-md-4 text-left"> Guest Birthday </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_birthday', $row['guest_birthday'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group hidden" >
                                    <label for="Guest Address" class=" control-label col-md-4 text-left"> Guest Address </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_address', $row['guest_address'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group hidden" >
                                    <label for="Guest City" class=" control-label col-md-4 text-left"> Guest City </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_city', $row['guest_city'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group hidden" >
                                    <label for="Guest Zip Code" class=" control-label col-md-4 text-left"> Guest Zip Code </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_zip_code', $row['guest_zip_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group hidden" >
                                    <label for="Guest Country" class=" control-label col-md-4 text-left"> Guest Country </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_country', $row['guest_country'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Landline Code" class=" control-label col-md-4 text-left"> Guest Landline Code </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_landline_code', $row['guest_landline_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Landline Number" class=" control-label col-md-4 text-left"> Guest Landline Number </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_landline_number', $row['guest_landline_number'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Mobile Code" class=" control-label col-md-4 text-left"> Guest Mobile Code </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_mobile_code', $row['guest_mobile_code'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Mobile Number" class=" control-label col-md-4 text-left"> Guest Mobile Number </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_mobile_number', $row['guest_mobile_number'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Guest Email" class=" control-label col-md-4 text-left"> Guest Email </label>
                                    <div class="col-md-6">
                                        {!! Form::text('guest_email', $row['guest_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <legend>Booking Details</legend>
                                <div class="form-group hidden" >
                                    <label for="Id" class=" control-label col-md-4 text-left"> Id </label>
                                    <div class="col-md-6">
                                        {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2"></div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Checkin Date" class=" control-label col-md-4 text-left"> Checkin Date </label>
                                    <div class="col-md-6">
                                        {!! Form::text('checkin_date', $row['checkin_date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Checkout Date" class=" control-label col-md-4 text-left"> Checkout Date </label>
                                    <div class="col-md-6">
                                        {!! Form::text('checkout_date', $row['checkout_date'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  " >
                                    <label for="Number Of Nights" class=" control-label col-md-4 text-left"> Number Of Nights </label>
                                    <div class="col-md-6">
                                        {!! Form::text('number_of_nights', $row['number_of_nights'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  " >
                                    <label for="Price" class=" control-label col-md-4 text-left"> Price </label>
                                    <div class="col-md-6">
                                        {!! Form::text('price', $row['price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div> 					
                                <div class="form-group  " >
                                    <label for="Price Mode" class=" control-label col-md-4 text-left"> Price Mode </label>
                                    <div class="col-md-6">
                                        {!! Form::text('price_mode', $row['price_mode'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Organizing Transfers</label>
                                    <div class="col-md-6">                                        
                                        <input name="organizing_transfers" value="Yes" {{($row['organizing_transfers'] == 'Yes')? 'checked' : ''}} type="radio"> Yes
                                        <input name="organizing_transfers" value="No" {{($row['organizing_transfers'] == 'No')? 'checked' : ''}}  type="radio"> No
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Booking Status</label>
                                    <div class="col-md-6">
                                        <input name="booking_status" value="0" {{($row['booking_status'] == '0')? 'checked' : ''}}  type="radio"> Pending
                                        <input name="booking_status" value="1" {{($row['booking_status'] == '1')? 'checked' : ''}} type="radio"> Confirm
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <div id="preferences" class="tab-pane m-t">
                                {{--*/ 
                                            $booking_preference_id = isset($preferences->booking_preference_id) ? $preferences->booking_preference_id : '';
                                        /*--}}
                                <input placeholder="" name="booking_preference_id" value="{{$booking_preference_id}}" type="hidden">
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Already Stayed</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $already_stayed = isset($preferences->already_stayed) ? $preferences->already_stayed : '';
                                        /*--}}
                                        <input name="already_stayed" value="Yes" {{($already_stayed == 'Yes')? 'checked' : ''}} type="radio"> Yes
                                        <input name="already_stayed" value="No" {{($already_stayed == 'No')? 'checked' : ''}}  type="radio"> No
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Arrival Time</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $arrival_time = isset($preferences->arrival_time) ? date('H:i', strtotime($preferences->arrival_time)) : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="arrival_time" value="{{$arrival_time}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Family</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">First Name</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $first_name = isset($preferences->first_name) ? $preferences->first_name : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="first_name" value="{{$first_name}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Last Name</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $last_name = isset($preferences->last_name) ? $preferences->last_name : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="last_name" value="{{$last_name}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Relationship</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $relationship = isset($preferences->relationship) ? $preferences->relationship : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="relationship" value="{{$relationship}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Purpose of stay</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Purpose of Stay</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $purpose_of_stay = isset($preferences->purpose_of_stay) ? $preferences->purpose_of_stay : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="purpose_of_stay" value="{{$purpose_of_stay}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Stay details</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $stay_details = isset($preferences->stay_details) ? $preferences->stay_details : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="stay_details" value="{{$stay_details}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Villa Preferences</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Desired Room Temperature</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $desired_room_temperature = isset($preferences->desired_room_temperature) ? $preferences->desired_room_temperature : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="desired_room_temperature" value="{{$desired_room_temperature}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Smoking Preference</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $smoking_preference = isset($preferences->smoking_preference) ? $preferences->smoking_preference : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="smoking_preference" value="{{$smoking_preference}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Rollaway Bed</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $rollaway_bed = isset($preferences->rollaway_bed) ? $preferences->rollaway_bed : '';
                                        /*--}}
                                        <input name="rollaway_bed" value="Yes" {{($rollaway_bed == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Crib</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $crib = isset($preferences->crib) ? $preferences->crib : '';
                                        /*--}}
                                        <input name="crib" value="Yes" {{($crib == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Wheelchair Accessible</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $wheelchair_accessible = isset($preferences->wheelchair_accessible) ? $preferences->wheelchair_accessible : '';
                                        /*--}}
                                        <input name="wheelchair_accessible" value="Yes" {{($wheelchair_accessible == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Generally am size</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $generally_am_size = isset($preferences->generally_am_size) ? $preferences->generally_am_size : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="generally_am_size" value="{{$generally_am_size}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Bedding Preferences</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pillow Firmness</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="pillow_firmness" value="{{isset($preferences->pillow_firmness) ? $preferences->pillow_firmness : ''}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pillow Type</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $pillow_type = isset($preferences->pillow_type) ? $preferences->pillow_type : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="pillow_type" value="{{$pillow_type}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Bed Style</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $bed_style = isset($preferences->bed_style) ? $preferences->bed_style : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="bed_style" value="{{$bed_style}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Cultural Interests</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Art</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $art = isset($preferences->art) ? $preferences->art : '';
                                        /*--}}
                                        <input name="art" value="Yes" {{($art == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Architecture & Interior Design</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $architecture_interior_design = isset($preferences->architecture_interior_design) ? $preferences->architecture_interior_design : '';
                                        /*--}}
                                        <input name="architecture_interior_design" value="Yes" {{($architecture_interior_design == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Cigars</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $cigars = isset($preferences->cigars) ? $preferences->cigars : '';
                                        /*--}}
                                        <input name="cigars" value="Yes" {{($cigars == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Dance</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $dance = isset($preferences->dance) ? $preferences->dance : '';
                                        /*--}}
                                        <input name="dance" value="Yes" {{($dance == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fashion</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $fashion = isset($preferences->fashion) ? $preferences->fashion : '';
                                        /*--}}
                                        <input name="fashion" value="Yes" {{($fashion == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Gastronomy</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $gastronomy = isset($preferences->gastronomy) ? $preferences->gastronomy : '';
                                        /*--}}
                                        <input name="gastronomy" value="Yes" {{($gastronomy == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Literature</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $literature = isset($preferences->literature) ? $preferences->literature : '';
                                        /*--}}
                                        <input name="literature" value="Yes" {{($literature == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Music</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $music = isset($preferences->music) ? $preferences->music : '';
                                        /*--}}
                                        <input name="music" value="Yes" {{($music == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Nature</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $nature = isset($preferences->nature) ? $preferences->nature : '';
                                        /*--}}
                                        <input name="nature" value="Yes" {{($nature == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Photography</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $photography = isset($preferences->photography) ? $preferences->photography : '';
                                        /*--}}
                                        <input name="photography" value="Yes" {{($photography == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Science</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $science = isset($preferences->science) ? $preferences->science : '';
                                        /*--}}
                                        <input name="science" value="Yes" {{($science == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Technology</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $technology = isset($preferences->technology) ? $preferences->technology : '';
                                        /*--}}
                                        <input name="technology" value="Yes" {{($technology == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Travel</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $travel = isset($preferences->travel) ? $preferences->travel : '';
                                        /*--}}
                                        <input name="travel" value="Yes" {{($travel == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Watches</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $watches = isset($preferences->watches) ? $preferences->watches : '';
                                        /*--}}
                                        <input name="watches" value="Yes" {{($watches == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Wines Spirits</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $wines_spirits = isset($preferences->wines_spirits) ? $preferences->wines_spirits : '';
                                        /*--}}
                                        <input name="wines_spirits" value="Yes" {{($wines_spirits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Other Interests</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $other_interests = isset($preferences->other_interests) ? $preferences->other_interests : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="other_interests" value="{{$other_interests}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Sports</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Snorkeling</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $snorkeling = isset($preferences->snorkeling) ? $preferences->snorkeling : '';
                                        /*--}}
                                        <input name="snorkeling" value="Yes" {{($snorkeling == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diving</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $diving = isset($preferences->diving) ? $preferences->diving : '';
                                        /*--}}
                                        <input name="diving" value="Yes" {{($diving == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Sailing</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $sailing = isset($preferences->sailing) ? $preferences->sailing : '';
                                        /*--}}
                                        <input name="sailing" value="Yes" {{($sailing == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Tennis</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $tennis = isset($preferences->tennis) ? $preferences->tennis : '';
                                        /*--}}
                                        <input name="tennis" value="Yes" {{($tennis == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Golf</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $golf = isset($preferences->golf) ? $preferences->golf : '';
                                        /*--}}
                                        <input name="golf" value="Yes" {{($golf == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Motorized water sports</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $motorized_water_sports = isset($preferences->motorized_water_sports) ? $preferences->motorized_water_sports : '';
                                        /*--}}
                                        <input name="motorized_water_sports" value="Yes" {{($motorized_water_sports == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Wellbeing</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Spa Treatments</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $spa_treatments = isset($preferences->spa_treatments) ? $preferences->spa_treatments : '';
                                        /*--}}
                                        <input name="spa_treatments" value="Yes" {{($spa_treatments == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Hair Treatments</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $hair_treatments = isset($preferences->hair_treatments) ? $preferences->hair_treatments : '';
                                        /*--}}
                                        <input name="hair_treatments" value="Yes" {{($hair_treatments == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fitness</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $fitness = isset($preferences->fitness) ? $preferences->fitness : '';
                                        /*--}}
                                        <input name="fitness" value="Yes" {{($fitness == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pool</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $pool = isset($preferences->pool) ? $preferences->pool : '';
                                        /*--}}
                                        <input name="pool" value="Yes" {{($pool == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Yoga</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $yoga = isset($preferences->yoga) ? $preferences->yoga : '';
                                        /*--}}
                                        <input name="yoga" value="Yes" {{($yoga == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pilates</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $pilates = isset($preferences->pilates) ? $preferences->pilates : '';
                                        /*--}}
                                        <input name="pilates" value="Yes" {{($pilates == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Meditation</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $meditation = isset($preferences->meditation) ? $preferences->meditation : '';
                                        /*--}}
                                        <input name="meditation" value="Yes" {{($meditation == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Prefer Language</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $prefer_language = isset($preferences->prefer_language) ? $preferences->prefer_language : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="prefer_language" value="{{$prefer_language}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Dietary regime</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Vegetarian</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $vegetarian = isset($preferences->vegetarian) ? $preferences->vegetarian : '';
                                        /*--}}
                                        <input name="vegetarian" value="Yes" {{($vegetarian == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Halal</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $halal = isset($preferences->halal) ? $preferences->halal : '';
                                        /*--}}
                                        <input name="halal" value="Yes" {{($halal == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Kosher</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $kosher = isset($preferences->kosher) ? $preferences->kosher : '';
                                        /*--}}
                                        <input name="kosher" value="Yes" {{($kosher == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Gluten Free</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $gluten_free = isset($preferences->gluten_free) ? $preferences->gluten_free : '';
                                        /*--}}
                                        <input name="gluten_free" value="Yes" {{($gluten_free == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Ovo-Lactarian</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $ovo_lactarian = isset($preferences->ovo_lactarian) ? $preferences->ovo_lactarian : '';
                                        /*--}}
                                        <input name="ovo_lactarian" value="Yes" {{($ovo_lactarian == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Food Allergies</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $food_allergies = isset($preferences->food_allergies) ? $preferences->food_allergies : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="food_allergies" value="{{$food_allergies}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Known Allergies</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $known_allergies = isset($preferences->known_allergies) ? $preferences->known_allergies : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="known_allergies" value="{{$known_allergies}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Snacks</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Savory Snacks</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $savory_snacks = isset($preferences->savory_snacks) ? $preferences->savory_snacks : '';
                                        /*--}}
                                        <input name="savory_snacks" value="Yes" {{($savory_snacks == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Any Sweet Snacks</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $any_sweet_snacks = isset($preferences->any_sweet_snacks) ? $preferences->any_sweet_snacks : '';
                                        /*--}}
                                        <input name="any_sweet_snacks" value="Yes" {{($any_sweet_snacks == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Chocolate Based Pastries</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $chocolate_based_pastries = isset($preferences->chocolate_based_pastries) ? $preferences->chocolate_based_pastries : '';
                                        /*--}}
                                        <input name="chocolate_based_pastries" value="Yes" {{($chocolate_based_pastries == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fruit Based Pastries</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $fruit_based_pastries = isset($preferences->fruit_based_pastries) ? $preferences->fruit_based_pastries : '';
                                        /*--}}
                                        <input name="fruit_based_pastries" value="Yes" {{($fruit_based_pastries == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Fruits</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Seasonal Fruits</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $seasonal_fruits = isset($preferences->seasonal_fruits) ? $preferences->seasonal_fruits : '';
                                        /*--}}
                                        <input name="seasonal_fruits" value="Yes" {{($seasonal_fruits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Exotic Fruits</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $exotic_fruits = isset($preferences->exotic_fruits) ? $preferences->exotic_fruits : '';
                                        /*--}}
                                        <input name="exotic_fruits" value="Yes" {{($exotic_fruits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Dried Fruits And Nuts</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $dried_fruits_and_nuts = isset($preferences->dried_fruits_and_nuts) ? $preferences->dried_fruits_and_nuts : '';
                                        /*--}}
                                        <input name="dried_fruits_and_nuts" value="Yes" {{($dried_fruits_and_nuts == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Hot beverages</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Espresso</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $espresso = isset($preferences->espresso) ? $preferences->espresso : '';
                                        /*--}}
                                        <input name="espresso" value="Yes" {{($espresso == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Cafe au lait</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $cafe_au_lait = isset($preferences->cafe_au_lait) ? $preferences->cafe_au_lait : '';
                                        /*--}}
                                        <input name="cafe_au_lait" value="Yes" {{($cafe_au_lait == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Tea</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $tea = isset($preferences->tea) ? $preferences->tea : '';
                                        /*--}}
                                        <input name="tea" value="Yes" {{($tea == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Herbal Tea</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $herbal_tea = isset($preferences->herbal_tea) ? $preferences->herbal_tea : '';
                                        /*--}}
                                        <input name="herbal_tea" value="Yes" {{($herbal_tea == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Hot Chocolate</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $hot_chocolate = isset($preferences->hot_chocolate) ? $preferences->hot_chocolate : '';
                                        /*--}}
                                        <input name="hot_chocolate" value="Yes" {{($hot_chocolate == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Sodas</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Coca</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $coca = isset($preferences->coca) ? $preferences->coca : '';
                                        /*--}}
                                        <input name="coca" value="Yes" {{($coca == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diet Coke</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $diet_coke = isset($preferences->diet_coke) ? $preferences->diet_coke : '';
                                        /*--}}
                                        <input name="diet_coke" value="Yes" {{($diet_coke == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pepsi</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $pepsi = isset($preferences->pepsi) ? $preferences->pepsi : '';
                                        /*--}}
                                        <input name="pepsi" value="Yes" {{($pepsi == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diet Pepsi</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $diet_pepsi = isset($preferences->diet_pepsi) ? $preferences->diet_pepsi : '';
                                        /*--}}
                                        <input name="diet_pepsi" value="Yes" {{($diet_pepsi == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Orange Soda</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $orange_soda = isset($preferences->orange_soda) ? $preferences->orange_soda : '';
                                        /*--}}
                                        <input name="orange_soda" value="Yes" {{($orange_soda == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Lemon Soda</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $lemon_soda = isset($preferences->lemon_soda) ? $preferences->lemon_soda : '';
                                        /*--}}
                                        <input name="lemon_soda" value="Yes" {{($lemon_soda == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Served With Lemon</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $served_with_lemon = isset($preferences->served_with_lemon) ? $preferences->served_with_lemon : '';
                                        /*--}}
                                        <input name="served_with_lemon" value="Yes" {{($served_with_lemon == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Served With Ice Cubes</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $served_with_ice_cubes = isset($preferences->served_with_ice_cubes) ? $preferences->served_with_ice_cubes : '';
                                        /*--}}
                                        <input name="served_with_ice_cubes" value="Yes" {{($served_with_ice_cubes == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Still Water</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $still_water = isset($preferences->still_water) ? $preferences->still_water : '';
                                        /*--}}
                                        <input name="still_water" value="Yes" {{($still_water == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Sparkling Water</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $sparkling_water = isset($preferences->sparkling_water) ? $preferences->sparkling_water : '';
                                        /*--}}
                                        <input name="sparkling_water" value="Yes" {{($sparkling_water == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Preferred Aperitif</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $preferred_aperitif = isset($preferences->preferred_aperitif) ? $preferences->preferred_aperitif : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="preferred_aperitif" value="{{$preferred_aperitif}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Upcoming Visit Remarks</label>
                                    <div class="col-md-6">
                                        {{--*/ 
                                            $upcoming_visit_remarks = isset($preferences->upcoming_visit_remarks) ? $preferences->upcoming_visit_remarks : '';
                                        /*--}}
                                        <input class="form-control" placeholder="" name="upcoming_visit_remarks" value="{{$upcoming_visit_remarks}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <div id="_rooms" class="tab-pane m-t">
                                <?php
                                if(!empty($rooms)) {
                                    $room_no = 1;
                                    foreach ($rooms as $room) {
                                        ?>
                                        <legend>Room {{$room_no}}</legend>
                                        <input placeholder="" name="reserved_room_id[]" value="{{$room->reserved_room_id}}" type="hidden">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 text-left">Number of adults(s)</label>
                                            <div class="col-md-6">
                                                <input class="form-control" placeholder="" name="booking_adults[]" value="{{$room->booking_adults}}" type="text"> 
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 text-left">Number of Children</label>
                                            <div class="col-md-6">
                                                <input class="form-control" placeholder="" name="booking_children[]" value="{{$room->booking_children}}" type="text"> 
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <?php
                                        $room_no++;
                                    }
                                }else{
                                ?>    
                                    <legend>Room </legend>
                                    <input placeholder="" name="reserved_room_id[]" value="" type="hidden">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-left">Number of adults(s)</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="" name="booking_adults[]" value="" type="text"> 
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-left">Number of Children</label>
                                        <div class="col-md-6">
                                            <input class="form-control" placeholder="" name="booking_children[]" value="" type="text"> 
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>  
                                <?php  
                                }
                                ?>
                            </div>
                            <?php if($login_user->group_id == 5): ?>
                            <div id="_credit_card_details" class="tab-pane m-t">
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Card Type:</label>
                                    <div class="col-md-6"><?php echo base64_decode($user_info->card_type) ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Credit Card Number:</label>
                                    <div class="col-md-6"><?php echo base64_decode($user_info->card_number) ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Expiry Month:</label>
                                    <div class="col-md-6"><?php echo base64_decode($user_info->expiry_month) ?></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Expiry Year:</label>
                                    <div class="col-md-6"><?php echo base64_decode($user_info->expiry_year) ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                </div>
                <div style="clear:both"></div>
                <div class="form-group">
                    <label class="col-sm-4 text-right">&nbsp;</label>
                    <div class="col-sm-8">	
                        <button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
                        <button type="button" onclick="location.href ='{{ URL::to('bookings?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>		 
    </div>	
</div>			 
<script type="text/javascript">
    $(document).ready(function () {
        $('.removeCurrentFiles').on('click', function () {
            var removeUrl = $(this).attr('href');
            $.get(removeUrl, function (response) {});
            $(this).parent('div').empty();
            return false;
        });
    });
</script>		 
@stop