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
                                    <h3>{{$category->category_name}}</h3>
                                    <img height="150" src="{{$category_image->imgsrc.$category_image->file_name}}" />
                                    <div>{{($currency->content!='') ? $currency->content : '$'}} {{$category->price}}</div>
                                </div>
                                <legend>User Details</legend>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Full Name </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="{{$user_info->title.' '.$user_info->first_name.' '.$user_info->last_name}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Birthday </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="<?php echo date('d M, Y', strtotime($user_info->birthday)) ?>" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Land Line </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="{{$user_info->landline_code.'-'.$user_info->landline_number}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Mobile </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="{{$user_info->mobile_code.'-'.$user_info->mobile_number}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Email </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="{{$user_info->email}}" type="text">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group  " >
                                    <label class=" control-label col-md-4 text-left"> Preferred means of communication </label>
                                    <div class="col-md-6">
                                        <input class="form-control" readonly="" value="{{$user_info->prefer_communication_with}}" type="text">
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
                                        <input name="organizing_transfers" value="Yes" {{($row->organizing_transfers == 'Yes')? 'checked' : ''}} type="radio"> Yes
                                        <input name="organizing_transfers" value="No" {{($row->organizing_transfers == 'No')? 'checked' : ''}}  type="radio"> No
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Booking Status</label>
                                    <div class="col-md-6">
                                        <input name="booking_status" value="0" {{($row->booking_status == '0')? 'checked' : ''}}  type="radio"> Pending
                                        <input name="booking_status" value="1" {{($row->booking_status == '1')? 'checked' : ''}} type="radio"> Confirm
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <div id="preferences" class="tab-pane m-t">
                                <input placeholder="" name="booking_preference_id" value="{{$preferences->booking_preference_id}}" type="hidden">
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Already Stayed</label>
                                    <div class="col-md-6">
                                        <input name="already_stayed" value="Yes" {{($preferences->already_stayed == 'Yes')? 'checked' : ''}} type="radio"> Yes
                                        <input name="already_stayed" value="No" {{($preferences->already_stayed == 'No')? 'checked' : ''}}  type="radio"> No
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Arrival Time</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="arrival_time" value="{{date('H:i', strtotime($preferences->arrival_time))}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Family</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">First Name</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="first_name" value="{{$preferences->first_name}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Last Name</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="last_name" value="{{$preferences->last_name}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Relationship</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="relationship" value="{{$preferences->relationship}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Purpose of stay</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Purpose of Stay</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="purpose_of_stay" value="{{$preferences->purpose_of_stay}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Stay details</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="stay_details" value="{{$preferences->stay_details}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Villa Preferences</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Desired Room Temperature</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="desired_room_temperature" value="{{$preferences->desired_room_temperature}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Smoking Preference</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="smoking_preference" value="{{$preferences->smoking_preference}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Rollaway Bed</label>
                                    <div class="col-md-6">
                                        <input name="rollaway_bed" value="Yes" {{($preferences->rollaway_bed == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Crib</label>
                                    <div class="col-md-6">
                                        <input name="crib" value="Yes" {{($preferences->crib == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Wheelchair Accessible</label>
                                    <div class="col-md-6">
                                        <input name="wheelchair_accessible" value="Yes" {{($preferences->wheelchair_accessible == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Generally am size</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="generally_am_size" value="{{$preferences->generally_am_size}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Bedding Preferences</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pillow Firmness</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="pillow_firmness" value="{{$preferences->pillow_firmness}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pillow Type</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="pillow_type" value="{{$preferences->pillow_type}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Bed Style</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="bed_style" value="{{$preferences->bed_style}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Cultural Interests</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Art</label>
                                    <div class="col-md-6">
                                        <input name="art" value="Yes" {{($preferences->art == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Architecture & Interior Design</label>
                                    <div class="col-md-6">
                                        <input name="architecture_interior_design" value="Yes" {{($preferences->architecture_interior_design == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Cigars</label>
                                    <div class="col-md-6">
                                        <input name="cigars" value="Yes" {{($preferences->cigars == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Dance</label>
                                    <div class="col-md-6">
                                        <input name="dance" value="Yes" {{($preferences->dance == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fashion</label>
                                    <div class="col-md-6">
                                        <input name="fashion" value="Yes" {{($preferences->fashion == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Gastronomy</label>
                                    <div class="col-md-6">
                                        <input name="gastronomy" value="Yes" {{($preferences->gastronomy == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Literature</label>
                                    <div class="col-md-6">
                                        <input name="literature" value="Yes" {{($preferences->literature == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Music</label>
                                    <div class="col-md-6">
                                        <input name="music" value="Yes" {{($preferences->music == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Nature</label>
                                    <div class="col-md-6">
                                        <input name="nature" value="Yes" {{($preferences->nature == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Photography</label>
                                    <div class="col-md-6">
                                        <input name="photography" value="Yes" {{($preferences->photography == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Science</label>
                                    <div class="col-md-6">
                                        <input name="science" value="Yes" {{($preferences->science == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Technology</label>
                                    <div class="col-md-6">
                                        <input name="technology" value="Yes" {{($preferences->technology == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Travel</label>
                                    <div class="col-md-6">
                                        <input name="travel" value="Yes" {{($preferences->travel == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Watches</label>
                                    <div class="col-md-6">
                                        <input name="watches" value="Yes" {{($preferences->watches == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Wines Spirits</label>
                                    <div class="col-md-6">
                                        <input name="wines_spirits" value="Yes" {{($preferences->wines_spirits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Other Interests</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="other_interests" value="{{$preferences->other_interests}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Sports</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Snorkeling</label>
                                    <div class="col-md-6">
                                        <input name="snorkeling" value="Yes" {{($preferences->snorkeling == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diving</label>
                                    <div class="col-md-6">
                                        <input name="diving" value="Yes" {{($preferences->diving == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Sailing</label>
                                    <div class="col-md-6">
                                        <input name="sailing" value="Yes" {{($preferences->sailing == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Tennis</label>
                                    <div class="col-md-6">
                                        <input name="tennis" value="Yes" {{($preferences->tennis == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Golf</label>
                                    <div class="col-md-6">
                                        <input name="golf" value="Yes" {{($preferences->golf == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Motorized water sports</label>
                                    <div class="col-md-6">
                                        <input name="motorized_water_sports" value="Yes" {{($preferences->motorized_water_sports == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Wellbeing</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Spa Treatments</label>
                                    <div class="col-md-6">
                                        <input name="spa_treatments" value="Yes" {{($preferences->spa_treatments == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Hair Treatments</label>
                                    <div class="col-md-6">
                                        <input name="hair_treatments" value="Yes" {{($preferences->hair_treatments == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fitness</label>
                                    <div class="col-md-6">
                                        <input name="fitness" value="Yes" {{($preferences->fitness == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pool</label>
                                    <div class="col-md-6">
                                        <input name="pool" value="Yes" {{($preferences->pool == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Yoga</label>
                                    <div class="col-md-6">
                                        <input name="yoga" value="Yes" {{($preferences->yoga == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pilates</label>
                                    <div class="col-md-6">
                                        <input name="pilates" value="Yes" {{($preferences->pilates == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Meditation</label>
                                    <div class="col-md-6">
                                        <input name="meditation" value="Yes" {{($preferences->meditation == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Prefer Language</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="prefer_language" value="{{$preferences->prefer_language}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Dietary regime</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Vegetarian</label>
                                    <div class="col-md-6">
                                        <input name="vegetarian" value="Yes" {{($preferences->vegetarian == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Halal</label>
                                    <div class="col-md-6">
                                        <input name="halal" value="Yes" {{($preferences->halal == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Kosher</label>
                                    <div class="col-md-6">
                                        <input name="kosher" value="Yes" {{($preferences->kosher == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Gluten Free</label>
                                    <div class="col-md-6">
                                        <input name="gluten_free" value="Yes" {{($preferences->gluten_free == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Ovo-Lactarian</label>
                                    <div class="col-md-6">
                                        <input name="ovo_lactarian" value="Yes" {{($preferences->ovo_lactarian == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Food Allergies</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="food_allergies" value="{{$preferences->food_allergies}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Known Allergies</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="known_allergies" value="{{$preferences->known_allergies}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Snacks</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Savory Snacks</label>
                                    <div class="col-md-6">
                                        <input name="savory_snacks" value="Yes" {{($preferences->savory_snacks == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Any Sweet Snacks</label>
                                    <div class="col-md-6">
                                        <input name="any_sweet_snacks" value="Yes" {{($preferences->any_sweet_snacks == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Chocolate Based Pastries</label>
                                    <div class="col-md-6">
                                        <input name="chocolate_based_pastries" value="Yes" {{($preferences->chocolate_based_pastries == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Fruit Based Pastries</label>
                                    <div class="col-md-6">
                                        <input name="fruit_based_pastries" value="Yes" {{($preferences->fruit_based_pastries == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Fruits</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Seasonal Fruits</label>
                                    <div class="col-md-6">
                                        <input name="seasonal_fruits" value="Yes" {{($preferences->seasonal_fruits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Exotic Fruits</label>
                                    <div class="col-md-6">
                                        <input name="exotic_fruits" value="Yes" {{($preferences->exotic_fruits == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Dried Fruits And Nuts</label>
                                    <div class="col-md-6">
                                        <input name="dried_fruits_and_nuts" value="Yes" {{($preferences->dried_fruits_and_nuts == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Hot beverages</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Espresso</label>
                                    <div class="col-md-6">
                                        <input name="espresso" value="Yes" {{($preferences->espresso == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Cafe au lait</label>
                                    <div class="col-md-6">
                                        <input name="cafe_au_lait" value="Yes" {{($preferences->cafe_au_lait == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Tea</label>
                                    <div class="col-md-6">
                                        <input name="tea" value="Yes" {{($preferences->tea == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Herbal Tea</label>
                                    <div class="col-md-6">
                                        <input name="herbal_tea" value="Yes" {{($preferences->herbal_tea == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Hot Chocolate</label>
                                    <div class="col-md-6">
                                        <input name="hot_chocolate" value="Yes" {{($preferences->hot_chocolate == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <legend>Sodas</legend>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Coca</label>
                                    <div class="col-md-6">
                                        <input name="coca" value="Yes" {{($preferences->coca == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diet Coke</label>
                                    <div class="col-md-6">
                                        <input name="diet_coke" value="Yes" {{($preferences->diet_coke == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Pepsi</label>
                                    <div class="col-md-6">
                                        <input name="pepsi" value="Yes" {{($preferences->pepsi == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Diet Pepsi</label>
                                    <div class="col-md-6">
                                        <input name="diet_pepsi" value="Yes" {{($preferences->diet_pepsi == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Orange Soda</label>
                                    <div class="col-md-6">
                                        <input name="orange_soda" value="Yes" {{($preferences->orange_soda == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Lemon Soda</label>
                                    <div class="col-md-6">
                                        <input name="lemon_soda" value="Yes" {{($preferences->lemon_soda == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Served With Lemon</label>
                                    <div class="col-md-6">
                                        <input name="served_with_lemon" value="Yes" {{($preferences->served_with_lemon == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Served With Ice Cubes</label>
                                    <div class="col-md-6">
                                        <input name="served_with_ice_cubes" value="Yes" {{($preferences->served_with_ice_cubes == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Still Water</label>
                                    <div class="col-md-6">
                                        <input name="still_water" value="Yes" {{($preferences->still_water == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Sparkling Water</label>
                                    <div class="col-md-6">
                                        <input name="sparkling_water" value="Yes" {{($preferences->sparkling_water == 'Yes')? 'checked' : ''}} type="checkbox">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Preferred Aperitif</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="preferred_aperitif" value="{{$preferences->preferred_aperitif}}" type="text"> 
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-left">Upcoming Visit Remarks</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="" name="upcoming_visit_remarks" value="{{$preferences->upcoming_visit_remarks}}" type="text"> 
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