<div>
    <a href="#" class="close_btn">x</a>
    <div class="bg-overlay-book">
        <div class="container">
        	<ul class="nav nav-tabs">
        	  <li class="active"><a data-toggle="tab" href="#hotel">Voyage</a></li>
        	  <li><a data-toggle="tab" href="#yacht">Yacht</a></li>
        	  <li><a data-toggle="tab" href="#private-jet">Private Jet</a></li>
        	</ul>
        </div>	
    </div>

<div class="forms-box-tct">
	 <div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="hotel">
    		   <div class="text-box">
    				<div class="row">
                            <?php /* <div class="col-xs-12">
                                <div class="hotelPopupHeadings text-center">
                                    <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                                    <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its
                                        cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                </div>
                            </div> 
							
							
                            <div class="container">
                                <div class="row">
                                	<div class="col-sm-4">
                                		<div class="lnk-txt text-center">
                                			<p>Join the words leading luxury club</p>
                                			<a href="#">Enjoy exclusive members only benefits</a>
                                		</div>
                                	</div>
                                	<!--end of colom -->
        
                                	<div class="col-sm-4">
                                		<div class="lnk-txt text-center">
                                			<p>Spa Treatment</p>
                                			<a href="#">Book</a>
                                		</div>
                                	</div>
                                	<!--end of colom -->
        
                                	<div class="col-sm-4">
                                		<div class="lnk-txt text-center">
                                			<p>View or Modify Reservation</p>
                                			<a href="#">login to Emporium-Voyage</a>
                                		</div>
                                	</div>
                                	<!--end of colom -->
                                </div>
                            </div>
                            */ ?>
							
							
				<div class="col-md-12">							
					<div class="tabs-custom-id-145">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item active in">
								<a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hotel</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Safari</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Spa & Wellness.</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-expereince-tab" data-toggle="pill" href="#pills-expereince" role="tab" aria-controls="pills-expereince" aria-selected="false">Islands</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade active in" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

								<div class="products-item-list hotelPopupHeadings-form">
    								<div class="hotelPopupHeadings-header-title">
    								    <div class="col-xs-12">
                                            <div class="hotelPopupHeadings text-center">
                                                <h2>Emporium Voyage is your ideal, vogue vacation planner!</h2>
                                                <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                                <p></p>
                                            </div>
                                        </div> 	
    								</div>							
								</div>
							</div>

							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<div class="products-item-list hotelPopupHeadings-form">
    								<div class="hotelPopupHeadings-header-title">
                                        <div class="hotelPopupHeadings text-center">
        									<h2>Connoisseurs of Luxury Lifestyle</h2>
        									<p>From plush accommodations that redefine camping and tents to private game drives and exclusive experiences, Emporium Safari will tailor a memorable trip for you as per your demands.</p>
                                        </div>
									</div>									
								</div>
							</div>

							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<div class="products-item-list hotelPopupHeadings-form">
    								<div class="hotelPopupHeadings-header-title">
                                        <div class="hotelPopupHeadings text-center">
        									<h2>Connoisseurs of Luxury Lifestyle</h2>
        									<p>Indulgent to the core, Emporium Spa & Wellness has a curated list of the most acclaimed spas and wellness centers around the world that will unveil a world of luxury unconceivable before.</p>
                                        </div>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-expereince" role="tabpanel" aria-labelledby="pills-expereince-tab">
								<div class="products-item-list hotelPopupHeadings-form">
    								<div class="hotelPopupHeadings-header-title">
                                        <div class="hotelPopupHeadings text-center">
        									<h2>Connoisseurs of Luxury Lifestyle</h2>
        									<p>From the Caribbean to the South Pacific, Emporium Islands is a customized, one-of-a-kind extravagance that gives you a wholesome experience; soaking in the sun beside palm trees perched on the golden sands or out on a unique adventure beside the azure blue waters, everything is possible.</p>
                                        </div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <form class="global-search-form" action="{{URL::to('globalavailability')}}" method="post">
                <div class="col-md-12">
                    <div class="global-search-box">
                        <div class="form-group search-nm">                                        
                            <div class="mobile-leftsearch">
                                <div class="mobile-leftsearch-error" data-action="global-search-error"></div>
                                <label class="lbl-search-txt">Where do you want to go?</label>
                                <input title="Search" type="text" class="form-control" placeholder="Enter your Hotel or select one or more destinations." data-action="global-search"/>                                    
                            </div>
                            <div id="globalfiltersearchpopup" data-option="global-search" style="display:none;">
                                <ul>
                                    <!--<li>
                                        <a class="searchresultdata cursor" data-action="global-search-our-collections">
                                            <i class="iconsheet icon-collections"></i> <span>Our Collection (0)</span>
                                        </a>
                        
                                        <ul class="searchmenulist" data-option="global-search-our-collection-option-list"></ul>
                                    </li> -->
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
                                    
                                    <!--<li>
                                        <a class="searchresultdata cursor" data-action="global-search-experiences">
                                            <i class="iconsheet icon-destinations"></i> <span>Experiences (0)</span>
                                        </a>
                        
                                        <ul class="searchmenulist" data-option="global-search-experience-option-list"></ul> 
                                    </li>
                                    
                                    <li>
                                        <a class="searchresultdata cursor" data-action="global-search-destination-channels">
                                            <i class="iconsheet icon-destinations"></i> <span>Channel (0)</span>
                                        </a>
                        
                                        <ul class="searchmenulist" data-option="global-search-dest-channel-option-list"></ul> 
                                    </li> -->
                                </ul>
                            </div>
						</div>            								
							
                        	
                        <div class="col-md-12 padding-0">
                            <label class="lbl-search-txt">When do you want to go?</label> 
                        </div>	
                        <div class="border-01 margin-bot-30">  
                                                                                                
                            <div class="col-md-9 global-search t-date-box">
                                                                 	
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
                                
                            </div>
                            <div class="col-md-3 margin-top-10">
                                <div class="col-md-12">
                                    <h3 class="alternate-heading">Flexible search sequence : 5 Days</h3>
                                </div>
                                <div class="col-md-8">                                    
                                    <div class="checkbox">
                                      <label><input type="checkbox" value="" >Alternative Dates</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control alternate-txt-box" type="number" value="5" name="ss">
                                </div>
                            </div>
                            
                        </div>	
                        <div class="col-md-12 padding-0">
                            <label class="lbl-search-txt">Who will be travelling</label> 
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
                                        <!--<div class="right">
                                            <i class="down"></i>
                                        </div>-->
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
                            	
                         </div>
    									
						<div class="col-md-12 border-style-02">
							<div class="text-center hotelBookNowButton">
                                <input type="hidden" name="sitename" value="voyage" id="sitename" />                                
                                
                                <input type="hidden" name="hid_our_collections" id="hid_our_collections" />
                                <input type="hidden" name="hid_our_hotels" id="hid_our_hotels" />
                                <input type="hidden" name="hid_our_destinations" id="hid_our_destinations" />
                                <input type="hidden" name="hid_our_experiences" id="hid_our_experiences" />
                                <input type="hidden" name="hid_our_channels" id="hid_our_channels" />
                                
                                <button type="submit" class="btn">Check Availability</button>
								<div class="hotelCancelBooking text-center">
                                    <a href="javascript:void(0);">View, Modify or Cancel your Booking</a>
                                </div>    									
                            </div>
						</div>
                           
						
					</div>
                </div>
                </form>
                							
            </div>
        </div>
        <!-- end of text box -->
    </div>

	<div role="tabpanel" class="tab-pane" id="yacht">
		<div class="container">
			<div class="text-box">
				<div class="row">
                    <div class="col-xs-12">
                        <div class="hotelPopupHeadings text-center">
                            <h2>Emporium Yacht is your ideal, vogue vacation planner!</h2>
                            <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its
                                cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                	<div class="col-sm-4">
                		<div class="lnk-txt text-center">
                			<p>Join the words leading luxury club</p>
                			<a href="#">Enjoy exclusive members only benefits</a>
                		</div>
                	</div>
                	<!--end of colom -->

                	<div class="col-sm-4">
                		<div class="lnk-txt text-center">
                			<p>Spa Treatment</p>
                			<a href="#">Book</a>
                		</div>
                	</div>
                	<!--end of colom -->

                	<div class="col-sm-4">
                		<div class="lnk-txt text-center">
                			<p>View or Modify Reservation</p>
                			<a href="#">login to Emporium Yachts</a>
                		</div>
                	</div>
                	<!--end of colom -->
                </div>
            </div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group search-nm">								   
						<input type="text" class="form-control" placeholder="Type a yacht name">		    
					</div>
				</div>
			</div>
            <!-- end of text box -->

            <div  id="aero-book">

               	<!--end of input search yacht form  -->
               	<div  id="select-yacht">
               		<div class="row">
               			<div class="col-sm-6">
                            <label>Price</label>                   				
                            <div class="row">                   					
                                <div class="col-xs-4">
                                	<div class="form-group drop-dw">	                   					
                                		<div class="dropdown">
                                		    <button id="dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                		    	50,000
                                		    <span class="caret"></span>
                                		  </button>
                                		    <ul class="dropdown-menu" id="dropdownList">
                                		      <li><a>No Min</a></li>
                                		      <li><a>50,000</a></li>
                                		      <li><a>100,000</a></li>
                                		    </ul>
                                		  </div>								    		    
                                	</div>
                                </div>
                                <!--end of price tag  -->

    				  		    <div class="col-xs-4">
                       				<div class="form-group drop-dw">	                   					
                       					<div class="dropdown">
    									    <button id="max-price-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    									    	50,000
    									    <span class="caret"></span>
    									  </button>
    									    <ul class="dropdown-menu" id="max-price-dropdownList">
    									      <li><a>50,000</a></li>
    									      <li><a>100,000</a></li>
    									      <li><a>150,000</a></li>
    									      <li><a>200,000</a></li>
    									      <li><a>250,000</a></li>
    									      <li><a>No-max</a></li>
    									    </ul>
    									  </div>								    		    
    				  				</div>
    				  			</div>
                                <!--end of price tag  -->
        				  		<div class="col-xs-4">
                           				<div class="form-group drop-dw">	                   					
                           					<div class="dropdown">
        									    <button id="euro-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        									    	Euro
        									    <span class="caret"></span>
        									  </button>
        									    <ul class="dropdown-menu" id="euro-dropdownList">
        									      <li><a>Euro</a></li>
        									      <li><a>USD</a></li>										      
        									    </ul>
        									  </div>								    		    
        				  				</div>
        				  			</div>
				  		        </div>		
                                <!--end of price tag  -->				  	
                   			</div>
                            <!-- end of price half section -->

                   <div class="col-sm-6">
                   	<label for="from-place">Length (m)</label>
                        <div class="row">					  		
               				<div class="col-xs-4">
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="lenth-min-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	30
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="lenth-min-dropdownList">
									      <li><a>No Min</a></li>
									      <li><a>30</a></li>
									      <li><a>40</a></li>
									      <li><a>50</a></li>
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>
                            <!--end of price tag  -->

				  		    <div class="col-xs-4">
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="max-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">50<span class="caret"></span>
                                        </button>
									    <ul class="dropdown-menu" id="max-dropdown-dropdownList">
									      <li><a>50</a></li>
									      <li><a>60</a></li>
									      <li><a>70</a></li>
									      <li><a>80</a></li>
									      <li><a>No max</a></li>
									    </ul>
                                    </div>								    		    
				  				</div>
				  			</div>
                            <!--end of price tag  -->
				  		    <div class="col-xs-4">
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="ft-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">M<span class="caret"></span>
                                        </button>
									    <ul class="dropdown-menu" id="ft-dropdownList">
									      <li><a>M</a></li>
									      <li><a>FT</a></li>										      
									    </ul>
                                    </div>								    		    
				  				</div>
				  			</div>
				  		</div>		
                        <!--end of lenth -->
                    </div>
      		    </div>
                <!--end of price  row-->				

			    <div class="row">
                    <div class="col-sm-6">
               			<label>Destination</label>                   				
           				<div class="row">                   					
               				<div class="col-xs-12">
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="destination-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	Any
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="destination-loc">
									      <li><a>Any</a></li>
									      <li><a> Antarctica </a></li>
									      <li><a>Caribbean & Bahamas </a></li>
									      <li><a>Central & South America</a></li>
									      <li><a>Croatian Charter Licence</a></li>
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>
			  		    </div>
                        <!--end of destination  -->
				  	<div class="row">					  		
				  		<div class="col-xs-6">
				  			<label>Guest</label>
               				<div class="form-group drop-dw">	                   					
               					<div class="dropdown">
								    <button id="guest-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    	Any
								    <span class="caret"></span>
								  </button>
								    <ul class="dropdown-menu" id="guest-dropdownList">
								      <li><a>6+</a></li>
								      <li><a>8+</a></li>
								      <li><a>10+</a></li>
								      <li><a>12</a></li>
								      <li><a>12+</a></li>
								    </ul>
								  </div>								    		    
			  				</div>
			  			</div>
				  	    <!--end of price tag  -->
				  		<div class="col-xs-6">
				  			<label>Type</label>
               				<div class="form-group drop-dw">	                   					
               					<div class="dropdown">
								    <button id="type-yacht-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    	Any
								    <span class="caret"></span>
								  </button>
								    <ul class="dropdown-menu" id="type-yacht-dropdownList">
								      <li><a>Any</a></li>
								      <li><a>Motor</a></li>
								      <li><a>Sail</a></li>
								    </ul>
								  </div>								    		    
			  				</div>
			  			</div>
			  		</div>		
				  	<!--end of price tag  -->				  	
    			</div>
                <!-- end of price half section -->

                <div class="col-sm-6">	                   	
				  	<div class="row">					  		
               				<div class="col-xs-12">
               					<label>Builder</label>
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="builder-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	Any
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="builder-dropdownList">
									      <li><a>Any</a></li>
									      <li><a> AB Yachts </a></li>
									      <li><a> Alloy Yachts </a></li>
									      <li><a> Amels </a></li>

									      <li><a> Astilleros de Mallorca</a></li>
									      <li><a>  Baglietto  </a></li>
									      <li><a>  Benetti  </a></li>

									      <li><a>  Brodrene Lothe A/S </a></li>		      

									        
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>
				  	<!--end of price tag  -->

				  		<div class="col-xs-12">
				  			<label>Year</label>
                   				<div class="form-group drop-dw">	                   					
                   					<div class="dropdown">
									    <button id="year-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	Any
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="year-dropdownList">
									    <li><a>Any</a></li>
									      <li><a> up to 2 years </a></li>
									      <li><a> up to 5 years </a></li>
									      <li><a > up to 10 years </a></li>
									      <li><a > over 10 years </a></li>										      
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>
				  	         <!--end of year  -->					  		
				  		</div>		
                        <!--end of lenth -->
                   </div>
                </div>
                <!--end of destinaition row-->

                <div class="row">
               			<div class="col-sm-6">                   			                 				
               			    <div class="row">
               			    	<div class="col-xs-12">
               			    			<div class="form-group drop-dw">
                   				<label>Category</label>	                   					
                   					<div class="dropdown">
									    <button id="category-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	 Charter Yachts 
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="category-dropdownList">
									      <li><a> Charter Yachts </a></li>
									      <li><a> Adventure Further </a></li>
									      <li><a> antarctica </a></li>
									      <li><a> BEST IN CLASS </a></li>
									      <li><a>  caribbean and bahamas  </a></li>
									      <li><a> Classic Yachts </a></li>										      
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>                   			    		
               			    	</div>
               			    </div>		                   	
                   <!-- end of Category half section -->

                   <div class="col-sm-6">				  	
				  		<div class="row">
				  		<div class="col-xs-12">
                   				<div class="form-group drop-dw">
                   				<label>Sort by</label>	                   					
                   					<div class="dropdown">
									    <button id="sort-by-dropdown-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    	 Length (m) 
									    <span class="caret"></span>
									  </button>
									    <ul class="dropdown-menu" id="sort-by-dropdownList">
									      <li><a href="#"> Length (m) </a></li>
									      <li><a href="#">Name</a></li>
									      <li><a href="#">Price</a></li>
									    </ul>
									  </div>								    		    
				  				</div>
				  			</div>
				  		</div>		
				  	<!--end of lenth -->
                   </div>
               		</div>
			<!--end of category row-->

			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">						   
					    <input type="submit" class="form-control-submit btn btn-large" value="Compare">    
				  	</div>
				</div>
				<!--end of compare button  -->

				<div class="col-sm-4">
					<div class="form-group text-center">						   
					    <h3>49 Yacht</h3>  
				  	</div>
				</div>

				<div class="col-sm-4">
					<div  class="row">
						<div class="col-sm-6">
							<div class="form-group">						   
							    <input type="submit" class="form-control-submit btn btn-large" value="Reset">    
						  	</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">						   
							    <input type="submit" class="form-control-submit btn btn-large" value="Reset">    
						  	</div>
						</div> 	 	
				  </div>
				</div>

				<!-- end of search text -->

			</div>


               	</div>	
               	<!--end of input search yacht form  -->
               	</div>
               </div>

		
	</div>

    	<div role="tabpanel" class="tab-pane" id="private-jet">
    		<div class="container">
    		<!-- Nav tabs -->
<div class="text-box">
    				<div class="row">
                            <div class="col-xs-12">
                                <div class="hotelPopupHeadings text-center">
                                    <h2>Emporium Jet is your ideal, vogue vacation planner!</h2>
                                    <p>With over 300 posh properties, elite spas and exquisite yachts huddled in its
                                        cocoon, Emporium Voyage ensure the ultimate luxury experience</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-sm-4">
                        		<div class="lnk-txt text-center">
                        			<p>Join the words leading luxury club</p>
                        			<a href="#">Enjoy exclusive members only benefits</a>
                        		</div>
                        	</div>
                        	<!--end of colom -->

                        	<div class="col-sm-4">
                        		<div class="lnk-txt text-center">
                        			<p>Spa Treatment</p>
                        			<a href="#">Book</a>
                        		</div>
                        	</div>
                        	<!--end of colom -->

                        	<div class="col-sm-4">
                        		<div class="lnk-txt text-center">
                        			<p>View or Modify Reservation</p>
                        			<a href="#">login to Emporium Jet</a>
                        		</div>
                        	</div>
                        	<!--end of colom -->
							
							
							
                        </div>
                    </div>
					                   		<div class="row">
                   			<div class="col-sm-12">
                   				<div class="form-group search-nm">								   
								    <input type="text" class="form-control" placeholder="Type a yacht name">		    
				  				</div>
                   			</div>
                   		</div>


  <div  id="aero-book">
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Return</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">One Way</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Multiple Destinations</a></li>    
	  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="form-box-wrap">
    		<div class="row">
    			<div class="col-md-5 no-pad">
    				<div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">From</label>
					    <input type="text" class="form-control"  placeholder="From">
					    <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a>
				  	</div>
				  </div>
				  <!-- end of from -->

				  <div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">To</label>
					    <input type="text" class="form-control" placeholder="To">
					    <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a>
				  	</div>
				  </div>
				  <!-- end of from -->
				  	
			  </div>
			  <!-- end of col -->


	<div class="col-md-5 no-pad">
	    				<div class="col-sm-6 no-pad">
			    		<div class="form-group">
						    <div class="col-xs-12 departr"><label for="from-place"> Departure date and time</label></div>
						    <div class="col-xs-7">
						    	<div class="form-group">
						    		<input type='text' class="form-control" id='datetimepicker1' placeholder="DD/MM/YY" />
						    	</div>
							</div>
							<div class="col-xs-5">
						    	<div class="form-group">					                	
					                    <input type='text' class="form-control" id='datetimepicker2' placeholder="12:00AM" />	                   
				                </div>
							</div>
							<div class="clearfix"></div>
					  	</div>
					  </div>
					  <!-- end of from -->
					  <div class="col-sm-6 no-pad">
			    		<div class="form-group">
						    <div class="col-xs-12"><label for="from-place">Return date and time</label></div>
						    <div class="col-xs-7">
						    	<div class="form-group">
						    		<input type='text' class="form-control" id='datetimepicker4' placeholder="DD/MM/YY" />
						    	</div>
							</div>
							<div class="col-xs-5">
						    	<div class="form-group">					                	
					                    <input type='text' class="form-control" id='datetimepicker3' placeholder="12:00AM" />	                   
				                </div>
							</div>
							<div class="clearfix"></div>
					  	</div>
					  	</div>
					  </div>
					  <!-- end of from -->

					  <div class="col-md-2">
						  	<div class="form-group">
						    <label for="from-place">Passengers</label>						    
						    <div class="pass-nmbers form-control">
						    	<div class="value-button" id="decrease"  onclick="decreaseValue()" value="Decrease Value">-</div>
								  <input type="number" id="number" value="1"/>
								  <div class="value-button pos-right" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
						    </div>						    
					  		</div>
					  	</div>
					   <!-- end of coloms -->							  					  	
				  </div>
				  <!-- end of row -->
				   <!-- start get qoute button section -->
				  <div class="row">
				  	<div class="col-sm-12">
				  		<div class="form-group text-center">						   
						    <input type="submit" class="form-control-submit btn btn-large" value="GET QUOTES" />    
					  	</div>
					  </div>	
				  </div>
				  <!-- end get qoute button section -->

				</div>
			<!--end of forms -->
	    	</div>
	   
    <div role="tabpanel" class="tab-pane" id="profile">
    		<div class="form-box-wrap">
    		<div class="row">
    			<div class="col-md-5 no-pad">
    				<div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">From</label>
					    <input type="text" class="form-control"  placeholder="From">
					    <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a>
				  	</div>
				  </div>
				  <!-- end of from -->

				  <div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">To</label>
					    <input type="text" class="form-control" placeholder="To">
					    <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a>
				  	</div>
				  </div>
				  <!-- end of from -->
				  	
			  </div>
			  <!-- end of col -->


	<div class="col-md-5 no-pad">
	    				<div class="col-sm-6 no-pad">
			    		<div class="form-group">
						    <div class="col-xs-12 departr"><label for="from-place"> Departure date and time</label></div>
						    <div class="col-xs-7">
						    	<div class="form-group">
						    		<input type='text' class="form-control" id='datetimepicker5' placeholder="DD/MM/YY" />
						    	</div>
							</div>
							<div class="col-xs-5">
						    	<div class="form-group">					                	
					                    <input type='text' class="form-control" id='datetimepicker6' placeholder="12:00AM" />	                   
				                </div>
							</div>
							<div class="clearfix"></div>
					  	</div>
					  </div>
					  <!-- end of from -->
					  <div class="col-sm-6 no-pad">
			    		<div class="form-group">
						    <div class="col-xs-12"><label for="from-place">Return date and time</label></div>
						    <div class="col-xs-7">
						    	<div class="form-group">
						    		<input type='text' class="form-control" id='datetimepicker7' placeholder="DD/MM/YY" />
						    	</div>
							</div>
							<div class="col-xs-5">
						    	<div class="form-group">					                	
					                    <input type='text' class="form-control" id='datetimepicker8' placeholder="12:00AM" />	                   
				                </div>
							</div>
							<div class="clearfix"></div>
					  	</div>
					  	</div>
					  </div>
					  <!-- end of from -->

					  <div class="col-md-2">
						  	<div class="form-group">
						    <label for="from-place">Passengers</label>						    
						    <div class="pass-nmbers form-control">
						    	<div class="value-button" id="decrease"  onclick="decreaseValue1()" value="Decrease Value">-</div>
								  <input type="number" id="number2" value="1"/>
								  <div class="value-button pos-right" id="increase" onclick="increaseValue1()" value="Increase Value">+</div>
						    </div>						    
					  		</div>
					  	</div>
					   <!-- end of coloms -->							  					  	
				  </div>
				  <!-- end of row -->
				   <!-- start get qoute button section -->
				  <div class="row">
				  	<div class="col-sm-12">
				  		<div class="form-group text-center">						   
						    <input type="submit" class="form-control-submit btn btn-large" value="GET QUOTES" />    
					  	</div>
					  </div>	
				  </div>
				  <!-- end get qoute button section -->

				</div>
			<!--end of forms -->
    </div>

     <!--   <div id="messages"> -->
    	<div role="tabpanel" class="tab-pane" id="messages">
<div class="form-box-wrap">
    		<div class="row" id="content">
    			<div class="col-md-5 no-pad">
    				<div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">From</label>
					    <input type="text" class="form-control"  placeholder="From">
					   <!--  <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a> -->
				  	</div>
				  </div>
				  <!-- end of from -->

				  <div class="col-sm-6">
		    		<div class="form-group">
					    <label for="from-place">To</label>
					    <input type="text" class="form-control" placeholder="To">
					    <!-- <a data-toggle="modal" data-target="#map-popup">Find Nearest Airport</a> -->
				  	</div>
				  </div>
				  <!-- end of from -->
				  	
			  </div>
			  <!-- end of col -->


            <div class="col-md-5 no-pad">
            <div class="col-sm-6 no-pad">
                <div class="form-group">
                    <div class="col-xs-12 departr"><label for="from-place"> Departure date and time</label></div>
                    <div class="col-xs-7">
                    	<div class="form-group">
                    		<input type='text' class="form-control" id='datetimepicker5' placeholder="DD/MM/YY" />
                    	</div>
                	</div>
                	<div class="col-xs-5">
                    	<div class="form-group">					                	
                                <input type='text' class="form-control" id='datetimepicker6' placeholder="12:00AM" />	                   
                        </div>
                	</div>
                	<div class="clearfix"></div>
                </div>
            </div>
            <!-- end of from -->
            <div class="col-sm-6 no-pad">
                <div class="form-group">
                    <div class="col-xs-12"><label for="from-place">Return date and time</label></div>
                    <div class="col-xs-7">
                    	<div class="form-group">
                    		<input type='text' class="form-control" id='datetimepicker7' placeholder="DD/MM/YY" />
                    	</div>
                    </div>
                    <div class="col-xs-5">
                    	<div class="form-group">					                	
                                <input type='text' class="form-control" id='datetimepicker8' placeholder="12:00AM" />	                   
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            </div>
					  <!-- end of from -->

					  <div class="col-md-2">
						  	<div class="form-group">
						    <label for="from-place">Passengers</label>						    
						    <div class="pass-nmbers form-control">
						    	<div class="value-button" id="decrease"  onclick="decreaseValue2()" value="Decrease Value">-</div>
								  <input type="number" id="number3" value="1"/>
								  <div class="value-button pos-right" id="increase" onclick="increaseValue2()" value="Increase Value">+</div>
						    </div>						    
					  		</div>
					  	</div>
					   <!-- end of coloms -->							  					  	
				  </div>
				  <!-- end of row -->
				   <!-- start get qoute button section -->
				  <div class="row">
				  	<div class="col-sm-12">
				  		<div class="form-group text-center">
				  		<input type="button" class="form-control-submit btn btn-large" value="Add section" onclick="addRow()">						   
						    <input type="submit" class="form-control-submit btn btn-large" value="GET QUOTES"    
					  	</div>
					  </div>	
				  </div>
				</div>  <!-- end get qoute button section -->

				</div>
    	</div>
    	<!--end of jet tab content section  -->
    </div>	

</div>
		

  

<!-- <input type="button" value="Add section" onclick="addRow()"> -->
    </div>   
  </div>

</div>
</div>
</div>


<div id="map-popup" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
                <input type="text" class="form-control" id="Search" placeholder="Please enter your city, street, landmark or postcode">
            </div>
            <div class="modal-body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14718.391975189259!2d75.88243084999999!3d22.74317875!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1536131496758" width="570" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>