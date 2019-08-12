<div class="global-search-wrapper" style="background: url('https://emporium-voyage.com/uploads/slider_images/1560607636-73359818.jpg'); ">
    <a href="#" class="close_btn">x</a>
    
    <header>
        <div class="logo-box">        
            @if(defined('CNF_FRONTEND_LOGO'))
                @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                    <a href="{{url('/')}}" class="logo-bx">
                        <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                    </a>
                @else
                    <a href="{{url('/')}}" class="logo-bx">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>      
                    </a>
                @endif
            @else
                <a href="{{url('/')}}" class="logo-bx">
                    <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>      
                </a>
            @endif
        </div> 
    </header>
    <section class="gs-search-form">
        <form class="global-search-form" action="{{URL::to('globalavailability')}}" method="post">
            <div class="col-md-12">
                <div class="global-search-box">
                    <div class="form-group search-nm">                                        
                        <div class="mobile-leftsearch">
                            <div class="mobile-leftsearch-error" data-action="global-search-error"></div>
                            <label class="lbl-search-txt">Where to?</label> 
                            <input title="Search" type="text" class="form-control" placeholder="Enter your Hotel or select one or more destinations." data-action="global-search"/>                                    
                        </div>
                        <div id="globalfiltersearchpopup" data-option="global-search" style="display:none;">
                            <ul>
                                
                                <li>
                                    <a class="searchresultdata cursor" data-action="global-search-collections">
                                        <i class="iconsheet icon-collections"></i> <span>Collection (0)</span>
                                    </a>
                    
                                    <ul class="searchmenulist" data-option="global-search-collection-option-list"></ul>
                                </li>
                    
                                <li>
                                    <a class="searchresultdata cursor" data-action="global-search-destinations">
                                        <i class="iconsheet icon-destinations"></i> <span>Destination (0)</span>
                                    </a>
                    
                                    <ul class="searchmenulist" data-option="global-search-dest-option-list"></ul> 
                                </li>                                        
                                
                            </ul>
                        </div>
                        <?php /* <div class="search-value">                                    
                            <?php
                                $search_hotel_values = '';
                                $sess_hotel ="";
                                if(\Session::has('hotels')){ 
                                    $sess_hotel = \Session::get('hotels');
                                }
                                $search_dest_values = '';
                                $sess_dest='';
                                if(\Session::has('destinations')){ 
                                    $sess_dest = \Session::get('destinations');                                            
                                }
                                //echo $search_dest_values;
                                $search_txt = '';
                                if(strlen(trim($sess_hotel))>0 || strlen(trim($sess_dest))>0){
                                    $search_txt = "Your search returned the following results :";
                                }
                                if(strlen(trim($sess_hotel))>0){
                                    $search_txt .= "<br>";
                                    $search_txt .= "Hotel(s):".$sess_hotel;    
                                }
                                if(strlen(trim($sess_dest))>0){
                                    $search_txt .= "<br>";
                                    $search_txt .= "Destination(s) :".$sess_dest;    
                                }                                        
                                echo $search_txt;
                            
                        </div> */ ?>
                        <div class="main-hotel-dest-sel-dv">
                            <div class="">Your search returned the following results :</div> 
                            <div class="sidebar-hotel-dest">Hotel(s):<span class="selected-hotels"></span></div>
                            <div class="sidebar-hotel-dest">Destination(s):<span class="selected-destinations"></span></div>   
                        </div>
                        <div class="info">*Info->You can search one or more hotel or destinations by selecting above</div>
                        <div class="info">*Search multiple destination by adding a comma ( , ) for example New York, London to return multiple city results.</div>
    				</div>            								
    					
                    	
                    <div class="">
                        <label class="lbl-search-txt">When?</label> 
                    </div>	
                    <div class="border-01 margin-bot-30">  
                                                                                            
                        <!--<div class="col-md-12 global-search t-date-box">
                                                             	
                                <div id="t-global-picker" class="t-datepicker">
                                    <div class="t-date-divide">
                                        <h3>Arrival</h3>                                            
                                        <div class="t-check-in"></div>
                                    </div>
                                    <div class="t-date-divide"> 
                                        <h3>Departure</h3>                                           
                                        <div class="t-check-out"></div>
                                    </div>
                                </div>                                             
                            
                        </div>-->
                        <!--<ul class="dates" id="search-by-date">
                            <li>
                                <div class="heading">Arrival</div>
                                <input id="date-range-arrive" size="20" name="arrive" value="{{ date('d.m.Y') }}">
                            </li>
                            <li>
                                <div class="heading">Departure</div>
                                <input id="date-range-destination" size="20" name="destination" value="{{ date('d.m.Y') }}">
                            </li>
                        </ul>-->
                        <div class="globaldatepickerrange">
                            <div class="globaldpheading">From-to</div>
                            <input type="text" name="daterange" value="" />
                            <input type="hidden" name="gl_arrive" /> 
                            <input type="hidden" name="gl_departure" />                                    
                        </div>
                        <div class="col-md-12 global-error min-stay-error" style="display: none;"></div>
                        <!--<div class="col-md-3 margin-top-10">
                            <div class="col-md-12">
                                <h3 class="alternate-heading">Flexible search sequence : 5 Days</h3>
                            </div>
                            <div class="col-md-8">                                    
                                <div class="checkbox">
                                  <label><input type="checkbox" name="alternate_dates" value="" >Alternative Dates</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control alternate-txt-box" type="number" value="5" name="numberofdate">
                            </div>
                        </div>-->
                        
                    </div>	
                    <div class="">
                        <label class="lbl-search-txt">Who?</label> 
                    </div>	
                    <div class="border-01">	
                    	<div class="col-md-12">                                
                    	    <div class="adult-room">
                                
                                @if(!empty(Session::get('booking_rooms'))) 
                                    {{--*/ $rooms = Session::get('booking_rooms') /*--}}
                                @else
                                    {{--*/ $rooms = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('booking_adults'))) 
                                    {{--*/ $adult = Session::get('booking_adults') /*--}} 
                                @else
                                    {{--*/ $adult = 2 /*--}} 
                                @endif
                                @if(!empty(Session::get('booking_children'))) 
                                    {{--*/ $child = Session::get('booking_children') /*--}} 
                                @else
                                    {{--*/ $child = 0 /*--}} 
                                @endif
                                
                                @if(!empty(Session::get('travellerType')))
                                    <?php                                             
                                        $travellerType = Session::get('travellerType');                                            
                                        if($travellerType==0){ $strdisable='disabled="disabled"'; $active = 'active'; }
                                        else if($travellerType==1){ $strdisable='disabled="disabled"'; }
                                        else if($travellerType==2){ $strdisable=''; }
                                        else if($travellerType==3){ $strdisable=''; }
                                        else if($travellerType==4){ $strdisable=''; }
                                    ?>
                                @else
                                    {{--*/ $travellerType = 1; $strdisable='disabled="disabled"'; /*--}} 
                                @endif          
                                 
                                
                                
                                @if(!empty(Session::get('tr_2_rooms'))) 
                                    {{--*/ $tr_2_rooms = Session::get('tr_2_rooms') /*--}}
                                @else
                                    {{--*/ $tr_2_rooms = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_2_adults'))) 
                                    {{--*/ $tr_2_adults = Session::get('tr_2_adults') /*--}}
                                @else
                                    {{--*/ $tr_2_adults = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_2_child'))) 
                                    {{--*/ $tr_2_child = Session::get('tr_2_child') /*--}}
                                @else
                                    {{--*/ $tr_2_child = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_3_rooms'))) 
                                    {{--*/ $tr_3_rooms = Session::get('tr_3_rooms') /*--}}
                                @else
                                    {{--*/ $tr_3_rooms = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_3_adults'))) 
                                    {{--*/ $tr_3_adults = Session::get('tr_3_adults') /*--}}
                                @else
                                    {{--*/ $tr_3_adults = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_3_child'))) 
                                    {{--*/ $tr_3_child = Session::get('tr_3_child') /*--}}
                                @else
                                    {{--*/ $tr_3_child = 1 /*--}} 
                                @endif
                                
                                @if(!empty(Session::get('tr_4_rooms'))) 
                                    {{--*/ $tr_4_rooms = Session::get('tr_4_rooms') /*--}}
                                @else
                                    {{--*/ $tr_4_rooms = 1 /*--}} 
                                @endif
                                @if(!empty(Session::get('tr_4_adults'))) 
                                    {{--*/ $tr_4_adults = Session::get('tr_4_adults') /*--}}
                                @else
                                    {{--*/ $tr_4_adults = 1 /*--}} 
                                @endif                                    
                                
                                @if(!empty(Session::get('child_2_ages'))) 
                                    {{--*/ $child_2_ages = Session::get('child_2_ages') /*--}}
                                @else
                                    {{--*/ $child_2_ages = array(); /*--}} 
                                @endif
                                
                                @if(!empty(Session::get('child_3_ages'))) 
                                    {{--*/ $child_3_ages = Session::get('child_3_ages') /*--}}
                                @else
                                    {{--*/ $child_3_ages = array(); /*--}} 
                                @endif
                                        
                                <input type="hidden" name="booking_rooms" id="hid_room" value="{{$rooms}}" />
                                <input type="hidden" name="booking_adults" id="hid_adult" value="{{$adult}}" />
                                <input type="hidden" name="booking_children" id="hid_children" value="{{$child}}" {{$strdisable}} />
                                <input type="hidden" name="travellerType" id="hid_traveller_type" value="{{$travellerType}}" />
                                <input type="hidden" name="childrenAge" id="hid_children_age" value="" />
                                
                                <div id="down-arrow" style="cursor: pointer;">    
                                    <div class="left">
                                        <span class="number-of-adult">
                                            @if($child > 0)
                                                {{$adult}} adult, {{ $child == 1 ? $child." child" : $child." children"}}
                                            @else
                                                {{$adult}} adult
                                            @endif    
                                            <br /> {{$rooms}} room                                    
                                        </span>
                                    
                                    </div>                                            
                                </div>
                    	    </div>
                            <div class="chooseadultroom" style="display: none;">
                                <div class="column-1 width-100">
                                    <div class="tbl">
                                        <div class="rw">
                                            <div class="col-55"><a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==0 ? 'active' : '') : ''}}" id="traveller-type-0" data-id='0'>Solo traveler</a></div>
                                            <div class="col-45 txt-small">
                                                1 room, 1 adult                            
                                            </div>
                                        </div>
                                        <div class="rw">
                                            <div class="col-55"><a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==1 ? 'active' : '') : 'active'}}" id="traveller-type-1" data-id='1'>Couple/Pair</a></div>
                                            <div class="col-45 txt-small">1 room, 2 adults</div>
                                        </div>
                                        <div class="rw">
                                            <div class="col-55">
                                                <a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==2 ? 'active' : '') : ''}}"  id="traveller-type-2" data-id='2' data-room='{{$tr_2_rooms}}' data-adult='{{$tr_2_adults}}' data-child='{{$tr_2_child}}'>
                                                    <span class="span-left"><span>Family travelers</span></span>
                                                    <span class="span-right"><i class="right traveller-type-arrow tta-2"></i></span>
                                                </a>
                                                <input type="hidden" name="tr_2_rooms" id="tr_2_rooms" value="{{$tr_2_rooms}}" />
                                                <input type="hidden" name="tr_2_adults" id="tr_2_adults" value="{{$tr_2_adults}}" />
                                                <input type="hidden" name="tr_2_child" id="tr_2_child" value="{{$tr_2_child}}" /> 
                                            </div>
                                            <div class="col-45"> 
                                                <span class="traveller-type-room-adult ttra-2" style="display: none;">1 room, 1 adult</span>
                                            </div>
                                        </div>
                                        <div class="rw">
                                            <div class="col-55">
                                                <a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==3 ? 'active' : '') : ''}}" id="traveller-type-3" data-id='3' data-room='{{$tr_3_rooms}}' data-adult='{{$tr_3_adults}}' data-child='{{$tr_3_child}}'>
                                                    <span class="span-left"><span>Group travelers</span></span>
                                                    <span class="span-right"><i class="right traveller-type-arrow tta-3"></i></span>
                                                </a>
                                                <input type="hidden" name="tr_3_rooms" id="tr_3_rooms" value="{{$tr_3_rooms}}" />
                                                <input type="hidden" name="tr_3_adults" id="tr_3_adults" value="{{$tr_3_adults}}" />
                                                <input type="hidden" name="tr_3_child" id="tr_3_child" value="{{$tr_3_child}}" /> 
                                            </div>
                                            <div class="col-45">
                                                <span class="traveller-type-room-adult ttra-3" style="display: none;">1 room, 1 adult</span>               
                                            </div>
                                        </div>
                                        <div class="rw">
                                            <div class="col-55">
                                                <a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==4 ? 'active' : '') : ''}}" id="traveller-type-4" data-id='4' data-room='{{$tr_4_rooms}}' data-adult='{{$tr_4_adults}}'>
                                                    <span class="span-left"><span>Business / Leisure travelers</span></span>
                                                    <span class="span-right"><i class="right traveller-type-arrow tta-4"></i></span>
                                                </a>
                                                <input type="hidden" name="tr_4_rooms" id="tr_4_rooms" value="{{$tr_4_rooms}}" />
                                                <input type="hidden" name="tr_4_adults" id="tr_4_adults" value="{{$tr_4_adults}}" />      
                                            </div>
                                            <div class="col-45">
                                                <span class="traveller-type-room-adult ttra-4" style="display: none;">1 room, 1 adult</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="column-2" style="display: none;">
                                    <div class="tbl">
                                        <div class="rw">
                                            <div class="col-20 minus-room">                            
                                                -
                                            </div>
                                            <div class="col-60 minus-plus-room">1 Room</div>
                                            <div class="col-20 plus-room">+</div>
                                        </div>
                                        <div class="rw">
                                            <div class="col-20 minus-adult">
                                                -
                                            </div>
                                            <div class="col-60 minus-plus-adult">1 Adult</div>
                                            <div class="col-20 plus-adult">+</div>
                                        </div>
                                        <div class="rw child-minus-plus">
                                            <div class="col-20 minus-child">
                                                -
                                            </div>
                                            <div class="col-60 minus-plus-child">0 children</div>
                                            <div class="col-20 plus-child">+</div>
                                        </div>                                    
                                    </div>
                                    <div class="tbl traveller-type-2-child-age" style="display: none;">  
                                         {{--*/ $sr_2 = 1; /*--}}                                  
                                         @if(!empty($child_2_ages))
                                            @for($k=0; count($child_2_ages) > $k; $k++)
                                                <div class="col-30">
                                                    <div class="lable">child {{$k}}</div>
                                                    <select name="tr_2_ca_{{$k}}" class="child-age">
                                                        @for($j=0; $j<=14; $j++)
                                                            <option value="{{$j}}" {{$child_2_ages[$k]==$j ? " selected='selected'" :""}}>{{$j}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                {{--*/ $sr_2++ /*--}}
                                            @endfor
                                         @endif              
                                    </div>
                                    <div class="tbl traveller-type-3-child-age" style="display: none;">
                                        {{--*/ $sr_3 = 1; /*--}}
                                        @if(!empty($child_3_ages))
                                            @for($k=0; count($child_3_ages) > $k; $k++)
                                                <div class="col-30">
                                                    <div class="lable">child {{$sr_3}}</div>
                                                    <select name="tr_3_ca_{{$sr_3}}" class="child-age">
                                                        @for($j=0; $j<=14; $j++)
                                                            <option value="{{$j}}" {{$child_3_ages[$k]==$j ? " selected='selected'" :""}}>{{$j}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                {{--*/ $sr_3++ /*--}}
                                            @endfor
                                        @endif        
                                    </div>
                                </div>
                            </div>        
                    	</div>
                        	
                     </div>
    								
    				<div class=" border-style-02">
    					<div class="text-center hotelBookNowButton">
                            <input type="hidden" name="hote_or_dest_has_value" />
                            
                            <input type="hidden" name="sitename" value="voyage" id="sitename" />                             
                            
                            <input type="hidden" name="hid_our_collections" id="hid_our_collections" />
                            <input type="hidden" name="hid_our_hotels" id="hid_our_hotels" />
                            <input type="hidden" name="hid_our_destinations" id="hid_our_destinations" />
                            <input type="hidden" name="hid_our_experiences" id="hid_our_experiences" />
                            <input type="hidden" name="hid_our_channels" id="hid_our_channels" />
                            
                            <button type="submit" class="btn">Check Availability</button>
    						<div class="hotelCancelBooking text-center">
                                <a href="javascript:void(0);" class="viewModifyCancel">View, Modify or Cancel your Booking</a>
                            </div>    									
                        </div>
    				</div>
                       
    				
    			</div>
            </div>
        </form>
    </section>
</div>
