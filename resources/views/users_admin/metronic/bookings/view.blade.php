@extends('users_admin.traveller.layouts.app')

@section('page_name')
    My Reservations
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
        <a href="{{ Url::to('traveller/bookings') }}" class="m-nav__link"> 
            <span class="m-nav__link-text"> My Reservations </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> DL-<?php echo date('d.m.y', strtotime($row->created_date)); ?>-{{ $row->id }} </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row"> <?php //echo "<pre />"; print_r($row); ?>
    <div class="col-sm-12 col-md-12 m--align-right"><a href="{{Url::to('traveller/bookings')}}">Back to Reservation</a></div>
    <div class="col-sm-12 col-md-12">
        <div class="m-portlet m-portlet--full-height">
    		
    		<div class="m-portlet__body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h4>DL-<?php echo date('d.m.y', strtotime($row->created_date)); ?>-{{ $row->id }}</h4>
                    </div>
                </div>
    			<!--begin::Section-->
    			<div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
    				<!--begin::Item-->
    				<div class="m-accordion__item">
    					<div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_1_head" data-toggle="collapse" href="#m_accordion_1_item_1_body" aria-expanded="false">
    						<span class="m-accordion__item-icon">
    							
    						</span>
    						<span class="m-accordion__item-title">
    							YOUR STAY
    						</span>
    						<span class="m-accordion__item-mode"></span>
    					</div>
    					<div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body" role="tabpanel" aria-labelledby="m_accordion_1_item_1_head" data-parent="#m_accordion_1" style="">
    						<div class="m-accordion__item-content">    							
                                <div class="col-sm-12 col-md-12">
                                    <table>
        								<tr><td>Arrival Date:</td><td>{{ $row->checkin_date }}</td></tr>
                                        <tr><td>Departure Date:</td><td>{{ $row->checkout_date }}</td></tr>
                                        <tr><td>Number of Nights(s):</td><td>{{ $row->number_of_nights }}</td></tr>
                                        <tr><td colspan="2"><hr /></td></tr>
                                        <tr><td colspan="2"><h5>ROOMS</h5></td></tr>
                                        {{--*/ $total_price = 0; $reservation_price = $row->price;  /*--}}
                                        @foreach($row->reserved_rooms as $rooms)
                                            <tr><td>Number of adults(s):</td><td>{{ $rooms->booking_adults }}</td></tr>
                                            <tr><td>Number of Children:</td><td>{{ $rooms->booking_children }}</td></tr>
                                            {{--*/ $total_price += ($row->number_of_nights * $reservation_price);  /*--}}
                                        @endforeach
                                        {{--*/ 
                                            $room_type_id= $row->type_id;
                                            $commission_due = $total_price * ($row->props->commission / 100);
                                            $grand_total = $commission_due + $total_price;  
                                            $book_again = 'book-property/'.$row->props->property_slug.'?property='.$row->props->id.'&roomType='.$room_type_id.'&arrive=&departure=&booking_adults=1&booking_children=0';
                                        /*--}}
                                    </table>                                 
                                </div>
    						</div>
    					</div>
    				</div>
    				<!--end::Item--> 
    <!--begin::Item-->
    				<div class="m-accordion__item">
    					<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_2_head" data-toggle="collapse" href="#m_accordion_1_item_2_body" aria-expanded="    false">
    						<span class="m-accordion__item-icon">
    							
    						</span>
    						<span class="m-accordion__item-title">
    							YOUR ROOM
    						</span>
    						<span class="m-accordion__item-mode"></span>
    					</div>
    					<div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body" role="tabpanel" aria-labelledby="m_accordion_1_item_2_head" data-parent="#m_accordion_1">
    						<div class="m-accordion__item-content">
    							<div class="col-sm-12 col-md-12">
                                    {{--*/ $img = $row->category_image->imgsrc."/".$row->category_image->file_name;  /*--}}
                                       <img src="{{$img}}" style="height: 200px;" />
                                       <br />
                                       Room Type: {{ $row->category->category_name }}
                                       <br />
                                       Price:  {{ $row->category->price }}
                                       <br />
                                       {{ $row->category->room_desc }}
                                </div>
    						</div>
    					</div>
    				</div>
    				<!--end::Item--> 
    <!--begin::Item-->
    				<div class="m-accordion__item">
    					<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="    false">
    						<span class="m-accordion__item-icon">
    							
    						</span>
    						<span class="m-accordion__item-title">
    							YOUR PREFERENCES
    						</span>
    						<span class="m-accordion__item-mode"></span>
    					</div>
    					<div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body" role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_1">
    						<div class="m-accordion__item-content">
    							<h5>YOUR WISHES</h5>
                                <p>Kindly specify any preferences or special requests you may have in order to help us best prepare for your coming stay with us.</p>
                                <div class="col-sm-12 col-md-12">
                                    Have you already stayed in one of our rooms/suites? {{ $row->preferences->already_stayed }}
                                    <br />
                                    Family Name: {{ $row->preferences->first_name }} {{ $row->preferences->last_name }}
                                    <br />
                                    Expected arrival time: {{ $row->preferences->arrival_time }}
                                    <hr />
                                </div>
                                
                                <div class="col-sm-12 col-md-12">
                                    Relationship: {{ $row->preferences->relationship }} 
                                    <hr />
                                </div>
                                <div class="col-sm-12 col-md-12">Purpose of stay: {{ $row->preferences->purpose_of_stay }} </div>
                                <div class="col-sm-12 col-md-12">                                    
                                    Do you want to provide us with further details regarding your stay?: {{ $row->preferences->stay_details }}
                                    <hr /> 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <h5>{{ $row->category->category_name }} preferences</h5>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    Desired room temperature: {{ $row->preferences->desired_room_temperature }} 
                                    <br/> Smoking preference: {{ $row->preferences->smoking_preference }} 
                                    <br/> Rollaway bed: {{ $row->preferences->rollaway_bed }} 
                                    <br/> Crib: {{ $row->preferences->crib }} 
                                    <br/> Wheelchair accessible: {{ $row->preferences->wheelchair_accessible }} 
                                    <br/> Generally I am size: {{ $row->preferences->generally_am_size }}
                                    <hr /> 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <h5>Bedding preferences</h5>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    Pillow firmness: {{ $row->preferences->pillow_firmness }} 
                                    <br/> Pillow type: {{ $row->preferences->pillow_type }} 
                                    <br/> Bed style: {{ $row->preferences->bed_style }} 
                                    <br/> Generally I sleep on the: {{ $row->preferences->generally_sleep_on }}
                                    <hr />
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <h5>Lifestyle preferences</h5>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    
                                    {{--*/ 
                                        $cultural_interests_list = '';
                                        if($row->preferences->art == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Art"; } else { $cultural_interests_list.=", Art"; }  }
                                        if($row->preferences->architecture_interior_design == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Architecture & Interior Design"; } else { $cultural_interests_list.=", Architecture & Interior Design"; }  }
                                        if($row->preferences->cigars == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Cigars"; } else { $cultural_interests_list.=", Cigars"; }  }
                                        if($row->preferences->dance == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Dance"; } else { $cultural_interests_list.=", Dance"; }  }
                                        if($row->preferences->fashion == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Fashion"; } else { $cultural_interests_list.=", Fashion"; }  }
                                        if($row->preferences->gastronomy == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Gastronomy"; } else { $cultural_interests_list.=", Gastronomy"; }  }
                                        if($row->preferences->literature == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Literature"; } else { $cultural_interests_list.=", Literature"; }  }
                                        if($row->preferences->music == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Music"; } else { $cultural_interests_list.=", Music"; }  }
                                        if($row->preferences->nature == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Nature"; } else { $cultural_interests_list.=", Nature"; }  }
                                        if($row->preferences->photography == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Photography"; } else { $cultural_interests_list.=", Photography"; }  }
                                        if($row->preferences->technology == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Technology"; } else { $cultural_interests_list.=", Technology"; }  }
                                        if($row->preferences->travel == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Travel"; } else { $cultural_interests_list.=", Travel"; }  }
                                        if($row->preferences->watches == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Watches"; } else { $cultural_interests_list.=", Watches"; }  }
                                        if($row->preferences->wines_spirits == 'Yes'){ if($cultural_interests_list == ''){ $cultural_interests_list.="Wines & Spirits"; } else { $cultural_interests_list.=", Wines & Spirits"; }  }
                                    /*--}}
                                    
                                    Cultural Interests: {{ $cultural_interests_list }}<br /> 
                                    Other, please specify : {{ $row->preferences->other_interests }} <br />
                                    
                                    {{--*/ 
                                        $sports_list = '';
                                        
                                        if($row->preferences->snorkeling == 'Yes'){ if($sports_list == ''){ $sports_list.="Snorkeling"; } else { $sports_list.=", Snorkeling"; }  }
                                        if($row->preferences->diving == 'Yes'){ if($sports_list == ''){ $sports_list.="Diving"; } else { $sports_list.=", Diving"; }  }
                                        if($row->preferences->sailing == 'Yes'){ if($sports_list == ''){ $sports_list.="Sailing"; } else { $sports_list.=", Sailing"; }  }
                                        if($row->preferences->tennis == 'Yes'){ if($sports_list == ''){ $sports_list.="Tennis"; } else { $sports_list.=", Tennis"; }  }
                                        if($row->preferences->golf == 'Yes'){ if($sports_list == ''){ $sports_list.="Golf"; } else { $sports_list.=", Golf"; }}
                                        
                                        if($row->preferences->motorized_water_sports == 'Yes'){ if($sports_list == ''){ $sports_list.="Motorized water sports"; } else { $sports_list.=", Motorized water sports"; }}
                                        
                                    /*--}}
                                    Sports : {{ $sports_list }}                                    
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    {{--*/ 
                                        $wellbeing_list = '';
                                        
                                        if($row->preferences->spa_treatments == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Spa treatments"; } else { $wellbeing_list.=", Spa treatments"; }  }
                                        if($row->preferences->hair_treatments == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Hair treatments"; } else { $wellbeing_list.=", Hair treatments"; }  }
                                        if($row->preferences->fitness == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Fitness"; } else { $wellbeing_list.=", Fitness"; }  }
                                        if($row->preferences->pool == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Pool"; } else { $wellbeing_list.=", Pool"; }  }
                                        if($row->preferences->yoga == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Yoga"; } else { $wellbeing_list.=", Yoga"; }}                                        
                                        if($row->preferences->pilates == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Pilates"; } else { $wellbeing_list.=", Pilates"; }}
                                        if($row->preferences->meditation == 'Yes'){ if($wellbeing_list == ''){ $wellbeing_list.="Meditation"; } else { $wellbeing_list.=", Meditation"; }}
                                        
                                    /*--}}
                                    Wellbeing: {{ $wellbeing_list }}
                                </div>
                                  
                                <div class="col-sm-12 col-md-12">
                                    I would prefer my in-room language settings to be: {{ $row->preferences->prefer_language }}
                                    <hr />
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <h5>Eating & Drinking preferences</h5>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    {{--*/ 
                                        $dietary_regime_list = '';
                                        
                                        if($row->preferences->spa_treatments == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Spa treatments"; } else { $dietary_regime_list.=", Spa treatments"; }  }
                                        if($row->preferences->hair_treatments == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Hair treatments"; } else { $dietary_regime_list.=", Hair treatments"; }  }
                                        if($row->preferences->fitness == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Fitness"; } else { $dietary_regime_list.=", Fitness"; }  }
                                        if($row->preferences->pool == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Pool"; } else { $dietary_regime_list.=", Pool"; }  }
                                        if($row->preferences->yoga == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Yoga"; } else { $dietary_regime_list.=", Yoga"; }}                                        
                                        if($row->preferences->pilates == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Pilates"; } else { $dietary_regime_list.=", Pilates"; }}
                                        if($row->preferences->meditation == 'Yes'){ if($dietary_regime_list == ''){ $dietary_regime_list.="Meditation"; } else { $dietary_regime_list.=", Meditation"; }}
                                        
                                    /*--}}
                                    Dietary regime:{{ $dietary_regime_list }} 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    Favourite dishes: {{ $row->preferences->favourite_dishes }} 
                                    <br/> Food allergies: {{ $row->preferences->food_allergies }} 
                                    <br/> Known allergies: {{ $row->preferences->known_allergies }}
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    {{--*/ 
                                        $snacks_list = '';
                                        
                                        if($row->preferences->savory_snacks == 'Yes'){ if($snacks_list == ''){ $snacks_list.="savory_snacks"; } else { $snacks_list.=", savory_snacks"; }  }
                                        if($row->preferences->any_sweet_snacks == 'Yes'){ if($snacks_list == ''){ $snacks_list.="any_sweet_snacks"; } else { $snacks_list.=", any_sweet_snacks"; }}                                        
                                        if($row->preferences->chocolate_based_pastries == 'Yes'){ if($snacks_list == ''){ $snacks_list.="chocolate_based_pastries"; } else { $snacks_list.=", chocolate_based_pastries"; }  }
                                        if($row->preferences->fruit_based_pastries == 'Yes'){ if($snacks_list == ''){ $snacks_list.="fruit_based_pastries"; } else { $snacks_list.=", fruit_based_pastries"; }  }
                                        
                                    /*--}}
                                    Snacks:{{ $snacks_list }} 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    {{--*/ 
                                        $fruits_list = '';
                                       
                                        if($row->preferences->seasonal_fruits == 'Yes'){ if($fruits_list == ''){ $fruits_list.="seasonal_fruits"; } else { $fruits_list.=", seasonal_fruits"; }  }
                                        
                                        if($row->preferences->exotic_fruits == 'Yes'){ if($fruits_list == ''){ $fruits_list.="exotic_fruits"; } else { $fruits_list.=", exotic_fruits"; }}
                                        if($row->preferences->dried_fruits_and_nuts == 'Yes'){ if($fruits_list == ''){ $fruits_list.="dried_fruits_and_nuts"; } else { $fruits_list.=", dried_fruits_and_nuts"; }}
                                        
                                    /*--}}
                                    Fruits:{{ $fruits_list }} 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    {{--*/ 
                                        $hot_beverages_list = '';
                                       
                                        if($row->preferences->espresso == 'Yes'){ if($hot_beverages_list == ''){ $hot_beverages_list.="Espresso"; } else { $hot_beverages_list.=", Espresso"; }  }
                                        
                                        if($row->preferences->cafe_au_lait == 'Yes'){ if($hot_beverages_list == ''){ $hot_beverages_list.="Cafe au lait"; } else { $hot_beverages_list.=", Cafe au lait"; }}
                                        if($row->preferences->tea == 'Yes'){ if($hot_beverages_list == ''){ $hot_beverages_list.="Tea"; } else { $hot_beverages_list.=", Tea"; }}
                                        if($row->preferences->herbal_tea == 'Yes'){ if($hot_beverages_list == ''){ $hot_beverages_list.="Herbal tea"; } else { $hot_beverages_list.=", Herbal tea"; }  }
                                        
                                        if($row->preferences->hot_chocolate == 'Yes'){ if($hot_beverages_list == ''){ $hot_beverages_list.="Hot chocolate"; } else { $hot_beverages_list.=", Hot chocolate"; }}                                        
                                        
                                    /*--}}
                                    Hot beverages:{{ $hot_beverages_list }} 
                                </div>
                                <div class="col-sm-12 col-md-12">                                    
                                    {{--*/ 
                                        $sodas_list = '';
                                       
                                        if($row->preferences->coca == 'Yes'){ if($sodas_list == ''){ $sodas_list.="coca"; } else { $sodas_list.=", coca"; }  }
                                        
                                        if($row->preferences->sparkling_water == 'Yes'){ if($sodas_list == ''){ $sodas_list.="sparkling_water"; } else { $sodas_list.=", sparkling_water"; }}
                                        if($row->preferences->still_water == 'Yes'){ if($sodas_list == ''){ $sodas_list.="still_water"; } else { $sodas_list.=", still_water"; }}
                                        if($row->preferences->diet_coke == 'Yes'){ if($sodas_list == ''){ $sodas_list.="diet_coke"; } else { $sodas_list.=", diet_coke"; }  }
                                        
                                        if($row->preferences->pepsi == 'Yes'){ if($sodas_list == ''){ $sodas_list.="pepsi"; } else { $sodas_list.=", pepsi"; }}  
                                        
                                        if($row->preferences->diet_pepsi == 'Yes'){ if($sodas_list == ''){ $sodas_list.="diet_pepsi"; } else { $sodas_list.=", diet_pepsi"; }}
                                        if($row->preferences->orange_soda == 'Yes'){ if($sodas_list == ''){ $sodas_list.="orange_soda"; } else { $sodas_list.=", orange_soda"; }  }
                                        
                                        if($row->preferences->lemon_soda == 'Yes'){ if($sodas_list == ''){ $sodas_list.="lemon_soda"; } else { $sodas_list.=", lemon_soda"; }}                            
                                        if($row->preferences->served_with_lemon == 'Yes'){ if($sodas_list == ''){ $sodas_list.="served_with_lemon"; } else { $sodas_list.=", served_with_lemon"; }}  
                                        
                                        if($row->preferences->served_with_ice_cubes == 'Yes'){ if($sodas_list == ''){ $sodas_list.="served_with_ice_cubes"; } else { $sodas_list.=", served_with_ice_cubes"; }}
                                        
                                    /*--}}
                                    Sodas:{{ $sodas_list }} 
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    Preferred aperitif: {{ $row->preferences->preferred_aperitif }} <br />
                                    Other remarks for our upcoming visit: {{ $row->preferences->upcoming_visit_remarks }} 
                                </div>
    						</div>
    					</div>
    				</div>
                    
                    <div class="m-accordion__item">
    					<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_4_head" data-toggle="collapse" href="#m_accordion_1_item_4_body" aria-expanded="    false">
    						<span class="m-accordion__item-icon">
    							
    						</span>
    						<span class="m-accordion__item-title">
    							YOUR CONTACT DETAILS
    						</span>
    						<span class="m-accordion__item-mode"></span>
    					</div>
    					<div class="m-accordion__item-body collapse" id="m_accordion_1_item_4_body" role="tabpanel" aria-labelledby="m_accordion_1_item_4_head" data-parent="#m_accordion_1">
    						<div class="m-accordion__item-content">
    							<h5>YOUR CONTACT DETAILS</h5>                                
                                Name: {{ $row->user_info->title }} {{ $row->user_info->first_name }} {{ $row->user_info->last_name }}
                                <br/> Birthday: {{ $row->user_info->birthday }}
                                <br/> Land Line: {{ $row->user_info->landline_code }} {{ $row->user_info->landline_number }}
                                <br/> Mobile : {{ $row->user_info->mobile_code }} {{ $row->user_info->mobile_number }}
                                <br/> Email  : {{ $row->user_info->email }}
                                <p>Your preferred means of communication: {{ $row->user_info->prefer_communication_with }}</p>
                                
                                <h5>Your Guest Details</h5>  
                                {{--*/ 
                                    $guest_title = ''; if($row->guest_title!='0'){ $guest_title = $row->guest_title; }  
                                    $g_dob = '';  if($row->guest_birthday!='0000-00-00'){ $g_dob = $row->guest_birthday; }  
                                /*--}}                              
                                Name: {{ $guest_title }} {{ $row->guest_names }}
                                <br/> Birthday: {{ $g_dob }}
                                <br/> Land Line: {{ $row->guest_landline_code }}  {{ $row->guest_landline_number }}
                                <br/> Mobile : {{ $row->guest_mobile_code }}  {{ $row->guest_mobile_number }}
                                <br/> Email  : {{ $row->guest_email }}
                                
                                <p>No Booking or credit card fees. Your credit card is needed to guarantee your booking. All charges will be made by the hotel.</p>
                                <h5>Your credit card details</h5>                                
                                Type of card: {{ $row->user_info->card_type }}
                                <br/> Credit card number: {{ $row->user_info->card_number }}
                                <br/> Expiry date : {{ $row->user_info->expiry_month }} {{ $row->user_info->expiry_year }}
                                <p>This credit card will be charged applicable deposit fees as described in Terms & Conditions and may be used in the event of late cancellation or no-show.</p>
                                
    						</div>
    					</div>
    				</div>
                    
                    <div class="m-accordion__item">
    					<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_5_head" data-toggle="collapse" href="#m_accordion_1_item_5_body" aria-expanded="    false">
    						<span class="m-accordion__item-icon">
    							
    						</span>
    						<span class="m-accordion__item-title">
    							CONFIRMATION
    						</span>
    						<span class="m-accordion__item-mode"></span>
    					</div>
    					<div class="m-accordion__item-body collapse" id="m_accordion_1_item_5_body" role="tabpanel" aria-labelledby="m_accordion_1_item_5_head" data-parent="#m_accordion_1">
    						<div class="m-accordion__item-content">
                                <table class="table">
                                    <tr>
                                        <th>Room Details</th><th>Price</th><th>Night</th><th class="m--align-right">Total</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $row->category->category_name }}</td><td>{{$row->price}}</td><td>{{$row->number_of_nights}}</td><td class="m--align-right">{{ number_format($total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" rowspan="3" width="60%"><img src="{{$img}}" style="height: 200px;" /></td><th>Sub total</th><td class="m--align-right">{{ number_format($total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Commission due</th><td class="m--align-right">{{ number_format($commission_due, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th><td class="m--align-right">{{ number_format($grand_total, 2) }}</td>
                                    </tr>
                                </table>
    							<!--<p>
                                    I have read the <a href="{{Url::to('privacy-policy')}}">Privacy Policy</a>. <span class="font-italic">I agree that my personal data will be collected and stored electronically and used electronically to make this reservation with emporium-voyage and the respective partner hotel.</span>  
                                                    <br />
                                                    <span class="font-italic">Note: You may revoke your consent at any time by e-mail to <a href="mailto:info@emporium-voyage.com">info@emporium-voyage.com</a> or from your settings section in your account admin.</span>
                                                
                                </p>
                                <p>
                                    <span class="font-italic">I agree to receive booking confirmations via email or phone and acknowledge that i can change my communication methods from my personal account preferences.</span>
                                </p>
                                <p>
                                    <span class="font-italic">I agree to the emporium-voyage&trade;  <a href="{{Url::to('terms-and-conditions')}}">terms and conditions</a> pertaining to the reservation.</span>
                                </p> -->
                                <div class="col-sm-12 c0p-md-12 m--align-right">
                                    <a href="{{ Url::to($book_again) }}" class="btn btn-default">Book Again</a>
                                </div>
    						</div>
    					</div>
    				</div>
                    
    				<!--end::Item-->
    			</div>
    			<!--end::Section-->
    		</div>
    	</div>
    </div>
    <!-- <div class="col-sm-12 col-md-12">
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
    </div>   -->          
</div>            
@stop