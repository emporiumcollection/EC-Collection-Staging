<form action="{{URL::to('search')}}" method="get" id="reservationForm" name="reservationform" class="reservation-form">
 <div class="row">
	<div class="col-sm-3 col-md-3">
	   <div class="form-group ui-widget" >
		  <input type="text" name="s" data-action="auto-suggestion" placeholder="ENTER YOUR HOTEL OR DESTINATION"/>
	   </div>
	</div>
	<div class="col-sm-4 col-md-4 calendarbox">
	   <div class="row">
            <div id="t-topbar-picker" class="col-xs-12 col-md-12 t-datepicker">
                <div class="t-check-in"></div>
                <div class="t-check-out"></div>
            </div>
	   </div>
	</div>
    <div class="col-sm-2 col-md-2">
	    <div class="form-group adult-room">
            
                    @if(!empty(Session::get('booking_rooms'))) 
                        {{--*/ $rooms = Session::get('booking_rooms') /*--}}
                    @else
                        {{--*/ $rooms = 1 /*--}} 
                    @endif
                    @if(!empty(Session::get('booking_adults'))) 
                        {{--*/ $adult = Session::get('booking_adults') /*--}} 
                    @else
                        {{--*/ $adult = 1 /*--}} 
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
                        {{--*/ $travellerType = 0; $strdisable='disabled="disabled"'; /*--}} 
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
                <div class="right">
                    <i class="down"></i>
                </div>
            </div>
	    </div>
        <div class="chooseadultroom" style="display: none;">
            <div class="column-1 width-100">
                <div class="tbl">
                    <div class="rw">
                        <div class="col-55"><a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==0 ? 'active' : '') : 'active'}}" id="traveller-type-0" data-id='0'>Solo traveler</a></div>
                        <div class="col-45 txt-small">
                            1 room, 1 adult                            
                        </div>
                    </div>
                    <div class="rw">
                        <div class="col-55"><a href="#" class="traveller-type {{!empty(Session::get('travellerType')) ? (Session::get('travellerType')==1 ? 'active' : '') : ''}}" id="traveller-type-1" data-id='1'>Couple/Pair</a></div>
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
                                <span class="span-left"><span>Business travelers</span></span>
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
	<!--<div class="col-sm-2 col-md-2">
	    <div class="form-group">
		    <input name="adult" type="number" placeholder="ADULT CHILDREN">
	    </div>

	</div>-->
	<div class="col-md-2">


		<?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
        <select name='currencyOption' class="form-control">
            <option value="EUR">Currency</option>
            @foreach($currencyList as $currencyCode => $currencyName)

                <option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
            </option>

            @endforeach

        </select>
	 
	</div>
	<div class="col-sm-1 col-md-1"><button class="btn yellowbtn" type="submit">SEARCH</button></div>
 </div>
</form>