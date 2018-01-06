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
            <li class="active"> {{ Lang::get('core.detail') }} </li>
        </ul>
    </div>  
    <div class="page-content-wrapper m-t">   
        <div class="sbox animated fadeInRight">
            <div class="sbox-title"> 
                <a href="{{ URL::to('bookings?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
                @if($access['is_add'] ==1)
                <a href="{{ URL::to('bookings/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
                @endif 
            </div>
            <div class="sbox-content" style="background:#fff;"> 	
                <table class="table table-striped table-bordered" >
                    <tbody>	
                        <tr>
                            <td width='30%' class='label-view text-right'>Id</td>
                            <td>{{ $row->id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Checkin Date</td>
                            <td>{{ $row->checkin_date }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Checkout Date</td>
                            <td>{{ $row->checkout_date }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Arrival Time</td>
                            <td>{{ $row->arrival_time }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Room Id</td>
                            <td>{{ $row->room_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Property Id</td>
                            <td>{{ $row->property_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Client Id</td>
                            <td>{{ $row->client_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Stay Type</td>
                            <td>{{ $row->stay_type }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Already Stayed</td>
                            <td>{{ $row->already_stayed }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Source</td>
                            <td>{{ $row->source }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Comment</td>
                            <td>{{ $row->comment }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Pre Reserve</td>
                            <td>{{ $row->pre_reserve }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Number Of Nights</td>
                            <td>{{ $row->number_of_nights }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Adult</td>
                            <td>{{ $row->adult }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Junior</td>
                            <td>{{ $row->junior }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Baby</td>
                            <td>{{ $row->baby }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Title</td>
                            <td>{{ $row->guest_title }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Names</td>
                            <td>{{ $row->guest_names }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Birthday</td>
                            <td>{{ $row->guest_birthday }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Address</td>
                            <td>{{ $row->guest_address }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest City</td>
                            <td>{{ $row->guest_city }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Zip Code</td>
                            <td>{{ $row->guest_zip_code }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Country</td>
                            <td>{{ $row->guest_country }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Landline Code</td>
                            <td>{{ $row->guest_landline_code }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Landline Number</td>
                            <td>{{ $row->guest_landline_number }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Mobile Code</td>
                            <td>{{ $row->guest_mobile_code }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Mobile Number</td>
                            <td>{{ $row->guest_mobile_number }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Guest Email</td>
                            <td>{{ $row->guest_email }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Checkin Comment</td>
                            <td>{{ $row->checkin_comment }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Checkout Comment</td>
                            <td>{{ $row->checkout_comment }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Option1</td>
                            <td>{{ $row->option1 }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Option2</td>
                            <td>{{ $row->option2 }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Price</td>
                            <td>{{ $row->price }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Price Mode</td>
                            <td>{{ $row->price_mode }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Board</td>
                            <td>{{ $row->board }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Type Id</td>
                            <td>{{ $row->type_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Organizing Transfers</td>
                            <td>{{ $row->organizing_transfers }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Booking Status</td>
                            <td>{{ $row->booking_status }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Created Date</td>
                            <td>{{ $row->created_date }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Created By</td>
                            <td>{{ $row->created_by }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Updated Date</td>
                            <td>{{ $row->updated_date }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Updated By</td>
                            <td>{{ $row->updated_by }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Booking Preference Id</td>
                            <td>{{ $row->booking_preference_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Reservation Id</td>
                            <td>{{ $row->reservation_id }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Arrival Time</td>
                            <td>{{ $row->arrival_time }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Already Stayed</td>
                            <td>{{ $row->already_stayed }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>First Name</td>
                            <td>{{ $row->first_name }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Last Name</td>
                            <td>{{ $row->last_name }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Relationship</td>
                            <td>{{ $row->relationship }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Purpose Of Stay</td>
                            <td>{{ $row->purpose_of_stay }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Stay Details</td>
                            <td>{{ $row->stay_details }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Desired Room Temperature</td>
                            <td>{{ $row->desired_room_temperature }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Smoking Preference</td>
                            <td>{{ $row->smoking_preference }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Rollaway Bed</td>
                            <td>{{ $row->rollaway_bed }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Crib</td>
                            <td>{{ $row->crib }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Wheelchair Accessible</td>
                            <td>{{ $row->wheelchair_accessible }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Generally Am Size</td>
                            <td>{{ $row->generally_am_size }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Pillow Firmness</td>
                            <td>{{ $row->pillow_firmness }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Pillow Type</td>
                            <td>{{ $row->pillow_type }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Bed Style</td>
                            <td>{{ $row->bed_style }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Generally Sleep On</td>
                            <td>{{ $row->generally_sleep_on }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Art</td>
                            <td>{{ $row->art }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Architecture Interior Design</td>
                            <td>{{ $row->architecture_interior_design }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Cigars</td>
                            <td>{{ $row->cigars }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Dance</td>
                            <td>{{ $row->dance }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Fashion</td>
                            <td>{{ $row->fashion }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Gastronomy</td>
                            <td>{{ $row->gastronomy }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Literature</td>
                            <td>{{ $row->literature }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Other Interests</td>
                            <td>{{ $row->other_interests }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Music</td>
                            <td>{{ $row->music }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Nature</td>
                            <td>{{ $row->nature }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Photography</td>
                            <td>{{ $row->photography }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Science</td>
                            <td>{{ $row->science }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Technology</td>
                            <td>{{ $row->technology }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Travel</td>
                            <td>{{ $row->travel }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Watches</td>
                            <td>{{ $row->watches }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Wines Spirits</td>
                            <td>{{ $row->wines_spirits }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Snorkeling</td>
                            <td>{{ $row->snorkeling }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Diving</td>
                            <td>{{ $row->diving }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Sailing</td>
                            <td>{{ $row->sailing }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Tennis</td>
                            <td>{{ $row->tennis }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Golf</td>
                            <td>{{ $row->golf }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Motorized Water Sports</td>
                            <td>{{ $row->motorized_water_sports }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Spa Treatments</td>
                            <td>{{ $row->spa_treatments }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Hair Treatments</td>
                            <td>{{ $row->hair_treatments }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Fitness</td>
                            <td>{{ $row->fitness }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Yoga</td>
                            <td>{{ $row->yoga }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Pilates</td>
                            <td>{{ $row->pilates }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Meditation</td>
                            <td>{{ $row->meditation }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Prefer Language</td>
                            <td>{{ $row->prefer_language }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Vegetarian</td>
                            <td>{{ $row->vegetarian }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Halal</td>
                            <td>{{ $row->halal }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Kosher</td>
                            <td>{{ $row->kosher }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Gluten Free</td>
                            <td>{{ $row->gluten_free }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Ovo Lactarian</td>
                            <td>{{ $row->ovo_lactarian }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Favourite Dishes</td>
                            <td>{{ $row->favourite_dishes }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Food Allergies</td>
                            <td>{{ $row->food_allergies }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Known Allergies</td>
                            <td>{{ $row->known_allergies }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Savory Snacks</td>
                            <td>{{ $row->savory_snacks }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Any Sweet Snacks</td>
                            <td>{{ $row->any_sweet_snacks }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Chocolate Based Pastries</td>
                            <td>{{ $row->chocolate_based_pastries }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Fruit Based Pastries</td>
                            <td>{{ $row->fruit_based_pastries }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Seasonal Fruits</td>
                            <td>{{ $row->seasonal_fruits }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Exotic Fruits</td>
                            <td>{{ $row->exotic_fruits }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Dried Fruits And Nuts</td>
                            <td>{{ $row->dried_fruits_and_nuts }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Espresso</td>
                            <td>{{ $row->espresso }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Cafe Au Lait</td>
                            <td>{{ $row->cafe_au_lait }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Tea</td>
                            <td>{{ $row->tea }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Herbal Tea</td>
                            <td>{{ $row->herbal_tea }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Hot Chocolate</td>
                            <td>{{ $row->hot_chocolate }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Coca</td>
                            <td>{{ $row->coca }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Diet Coke</td>
                            <td>{{ $row->diet_coke }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Pepsi</td>
                            <td>{{ $row->pepsi }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Diet Pepsi</td>
                            <td>{{ $row->diet_pepsi }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Orange Soda</td>
                            <td>{{ $row->orange_soda }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Lemon Soda</td>
                            <td>{{ $row->lemon_soda }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Served With Lemon</td>
                            <td>{{ $row->served_with_lemon }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Served With Ice Cubes</td>
                            <td>{{ $row->served_with_ice_cubes }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Preferred Aperitif</td>
                            <td>{{ $row->preferred_aperitif }} </td>
                        </tr>
                        <tr>
                            <td width='30%' class='label-view text-right'>Upcoming Visit Remarks</td>
                            <td>{{ $row->upcoming_visit_remarks }} </td>
                        </tr>
                    </tbody>	
                </table>   
            </div>
        </div>	
    </div>
</div>
@stop