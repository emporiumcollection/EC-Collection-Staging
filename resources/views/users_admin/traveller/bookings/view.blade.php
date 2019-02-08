<div class="row">
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
                                        <tr><td colspan="2"><h5>Suites</h5></td></tr>
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
    							YOUR SUITE
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
                                    Have you already stayed in one of our suites? {{ $row->preferences->already_stayed }}
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
                                    Desired suite temperature: {{ $row->preferences->desired_room_temperature }} 
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
                                    I would prefer my in-suite language settings to be: {{ $row->preferences->prefer_language }}
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
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Suite Details</th><th>Price</th><th>Night</th><th class="m--align-right">Total</th>
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
        
</div>            