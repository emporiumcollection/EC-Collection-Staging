@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage, Luxury Hotel Booking, Luxury 5 Star Hotels')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Page's Content Part --}}
@section('content')
<div class="logo-box">
    {{-- <a href="{{url('/')}}" class="logo-bx">
          <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
    </a> --}}
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


<div class="custom-menu">
    <ul class="cstm_menu">
        @if(Session::get('uid')>0)
        <li class="main-li">
            <a href="#" class="top-menu-user"><img src="{{URL::to('images/Who-collection.png')}}" /><span class="top-menu-text">My Account</span></a>
            <ul class="gs-main-user-collection gs-main-left" style="display: none;">
                {{--*/ $is_demo6 = trim(\CommonHelper::isHotelDashBoard()); /*--}}
                @if(Session::get('gid')==5)                   
                    @if(\Session::get('prop_slug'))
                    <li class="gs-dd-user-collection">
						<a href="{{URL::to('/')}}/{{\Session::get('prop_slug')}}">My Hotel</a>
					</li>
                    @endif
					<li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/profile')}}">{{ Lang::get('profile.my-profile') }}</a>
					</li>
					
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('hotel/bookings')}}">My Reservations</a>
					</li>
                    
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/profile')}}" >{{ Lang::get('profile.my-company') }}</a>
					</li>
					
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/profile')}}">{{ Lang::get('profile.my-users') }}</a>
					</li>
                    
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('press')}}">Press</a>
					</li>
                @elseif(Session::get('gid')==3) 
                    @if(!\CommonHelper::checkDeactivatedUser())
					<li  class="gs-dd-user-collection">
						<a href="{{ URL::to('user/profile')}}">
						  My Profile
						</a>
					</li>
                    
                    <li  class="gs-dd-user-collection">
						<a href="{{ URL::to('user/preferences')}}">
						  My Preferences
						</a>
					</li>	                                                                
                    																
                    <li  class="gs-dd-user-collection">
						<a href="{{ URL::to('traveller/bookings')}}">
						  My Reservations
						</a>
					</li>
					<li  class="gs-dd-user-collection">
						<a href="{{ URL::to('user/companion')}}">
				            My Companions								
						</a>
					</li>
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/invite')}}">							
				            Invite Guests / Invite Guest System
						</a>
					</li>
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/settings')}}">
				            Account Settings
						</a>
					</li> 
                    
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('user/security')}}">							
				            Security &amp; Privacy								
						</a>
					</li> 
                    
                    <li class="gs-dd-user-collection">
						<a href="{{ URL::to('traveller/invoices')}}">							
				            Billings & Contracts								
						</a>
					</li>
                    @endif 	
					  
                @else
                    <li class="gs-dd-user-collection"><a href="{{ URL::to('customer/profile')}}">Profile</a></li>
                    <li class="gs-dd-user-collection"><a href="{{ URL::to('customer/profile?#resetPassword')}}">Change Password</a></li>
                @endif
                
                <?php /* <li><a href="{{ URL::to('customer/profile?#resetPassword')}}">Change Possword</a></li> */ ?>
                <li class="gs-dd-user-collection"><a href="{{ URL::to('customer/logout')}}">Logout</a></li>
            </ul>
        </li>
        @else    
        <li class="main-li"><a href="#" class="top-menu-login"><img src="{{URL::to('images/Who-collection.png')}}" /><span class="top-menu-text">Account</span> </a></li>
        @endif
        <li class="main-li">
            <a href="#" class="gs-top-what-collection"><img src="{{URL::to('images/What-collection.png')}}" /><span class="top-menu-text">Collection</span></a>
            <ul class="gs-main-collection gs-main-right" style="display: none;">                
                <li class="gs-dd-collection active" data-value="voyage"><a href="https://emporium-voyage.com">Hotel</a></li>
                <li class="gs-dd-collection" data-value="safari"><a href="https://emporium-safari.com">Safari</a></li>
                <li class="gs-dd-collection" data-value="spa"><a href="https://emporium-spa.com">Spa & Wellness</a></li>
                <li class="gs-dd-collection" data-value="islands"><a href="https://emporium-islands.com">Islands</a></li>
            </ul>
        </li>       
    </ul>
</div>


<div class="u-inline-block menu-bx unlog">
    <button class="c-header__btn-sound t-btn u-inline-block u-valign-middle u-vacuum log_in-btn">
        <div class="u-inline-block u-valign-middle u-marg-r-sm u-hide@sm" style="display: none;">
            <div class="c-header__btn-sound__bar u-relative u-inline-block"></div>
            <div class="c-header__btn-sound__bar u-relative u-inline-block"></div>
            <div class="c-header__btn-sound__bar u-relative u-inline-block"></div>
            <div class="c-header__btn-sound__bar u-relative u-inline-block"></div>
            <div class="c-header__btn-sound__bar u-relative u-inline-block"></div>
        </div>

        <span class="t-text--xs t-text--ls-xxs t-text--black u-inline-block u-uppercase u-valign-middle log-hover">
            <span class="log-hide">Login</span> 
            <span class="hover-dsp">Join</span>
        </span>
    </button>
    <button class="c-header__btn-menu t-btn u-relative u-inline-block u-valign-middle u-vacuum">
        <div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div>
        <div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div>
        <div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div> 
        <div class="c-header__btn-menu__bar u-absolute u-pos-center u-inline-block"></div>
        <div class="c-header__btn-menu__bar u-absolute u-pos-center u-inline-block"></div> 
        <div class="c-header__btn-menu__circle u-absolute u-shape-circle"></div> 
        <div class="c-header__btn-menu__content u-absolute u-pos-tl u-backface-hidden u-hide@sm">
            <p class="c-header__btn-menu__content__label t-text--xs t-text--ls-xxs t-text--black u-absolute u-pos-tl u-uppercase u-force-inline">
                <span class="c-header__btn-menu__content__label__word u-inline-block">Open</span> 
                <span class="c-header__btn-menu__content__label__word u-inline-block">Menu</span>
            </p> 
            <p class="c-header__btn-menu__content__label t-text--xs t-text--ls-xxs t-text--black u-absolute u-pos-tl u-uppercase u-force-inline">
                <span class="c-header__btn-menu__content__label__word u-inline-block">Close</span> 
                <span class="c-header__btn-menu__content__label__word u-inline-block">Menu</span>
            </p>
        </div>
    </button>
</div>

    <?php /* <div class="home-search-bar">
        <div class="home-search-bar-inner global-search-main">
            <span class="search-input">
            <input type="text" name="input-global-search" class="form-control" placeholder="where to?" /> 
            </span>
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <!--<button type="button"><i class="fa fa-search"></i></button> --> 
        </div>   
     </div>
    */ ?>
<form action="{{URL::to('globalavailability')}}" method="post" class="gs-form">
    <div class="gs-home-search-bar">
    
        <div class="col-width collection">
            <div class="gs-table common-height "> 
                <!--<div class="gs-table-inner"> -->              
                    <span class="gs-col search-icon"><img src="{{URL::to('images/What-collection.png')}}" /></span>
                    <span class="gs-col search-input">
                        <a class="gs-searchbar-collection">Collection</a>
                        
                        <!--<select name="sitename">
                            <option value="voyage">Collection</option>
                            <option value="voyage">Hotel</option>
                            <option value="safari">Safari</option>
                            <option value="spa">Spa & Wellness</option>
                            <option value="islands">Islands</option>
                        </select>--> 
                    </span>
                <!--</div> -->               
            </div>
            <ul class="gs-searchbar-main-collection" style="display: none;">                
                <li class="gs-searchbar-dd-collection active" data-value="voyage"><a href="https://emporium-voyage.com">Hotel</a></li>
                <li class="gs-searchbar-dd-collection" data-value="safari"><a href="https://emporium-safari.com">Safari</a></li>
                <li class="gs-searchbar-dd-collection" data-value="spa"><a href="https://emporium-spa.com">Spa & Wellness</a></li>
                <li class="gs-searchbar-dd-collection" data-value="islands"><a href="https://emporium-islands.com">Islands</a></li>
            </ul>
        </div>
        <div class="col-width where gs-margin-left">
            <div class="gs-table common-height"> 
                <!--<div class="gs-table-inner"> -->              
                    <span class="gs-col search-icon"><img src="{{URL::to('images/Where-collection.png')}}" /></span>
                    <span class="gs-col search-input">
                        <input title="Search" type="text" placeholder="Where to?" data-action="global-search"/> 
                    </span>
                <!--</div> -->               
            </div>
            <div id="globalfiltersearchpopup" data-option="global-search" style="display:none;">
                <div class="gs-notes">                    
                    <div class="info">*Search multiple destinations by entering a comma. For example New York, London. </div>
                    <div class="info">*Info->Select multiple hotels or destinations.</div>
                </div>
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
        </div>
        <div class="col-width when">            
            <div class="gs-table"> 
                
                    <span class="gs-col search-icon when-coll"><img src="{{URL::to('images/When-collection.png')}}" /></span>  
                    <div class="search-input common-height">              
                        <div class="globaldatepickerrange">
                            <!--<div class="globaldpheading">From-to</div>-->
                            <input type="text" name="daterange" value="When?" />
                            <input type="hidden" name="gl_arrive" /> 
                            <input type="hidden" name="gl_departure" />                                    
                        </div>
                    </div>
                             
            </div>
        </div>
        <div class="col-width who">
            <div class="gs-table ">
                
                    <span class="gs-col search-icon"><img src="{{URL::to('images/Who-collection.png')}}" /></span>  
                   	                              
        	    <div class="search-input adult-room">
                    
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
                            <span class="number-of-adult"> Who?
                                {{--@if($child > 0)
                                    {{$adult}} adult, {{ $child == 1 ? $child." child" : $child." children"}}
                                @else
                                    {{$adult}} adult
                                @endif    
                                <br /> {{$rooms}} room --}}                                    
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
        <div class="btn-search">
            <div class="gs-table ">
                <input type="hidden" name="hote_or_dest_has_value" />                                    
                <input type="hidden" name="sitename" value="voyage" id="sitename" />                                    
                <input type="hidden" name="hid_our_collections" id="hid_our_collections" />
                <input type="hidden" name="hid_our_hotels" id="hid_our_hotels" />
                <input type="hidden" name="hid_our_destinations" id="hid_our_destinations" />
                <input type="hidden" name="hid_our_experiences" id="hid_our_experiences" />
                <input type="hidden" name="hid_our_channels" id="hid_our_channels" />
                <div class="gs-col btn-search-icon">
                    <button type="submit"><i class="fa fa-search fa-3x"></i></button>
                </div>
                <!--<span class="gs-col search-input">
                    <button name="">Search</button>
                </span>-->                
            </div>
        </div>
        <div class="col-width-bot col-width-mob"></div>
        <div class="col-width-bot"></div>
        <div class="col-width-bot"></div>
        <div class="col-width-bot">
            <div class="">
                Alternatively search by:<br />
                <a href="#" class="gs-lnk-destination">Destination</a> or <a href="#" class="gs-lnk-experience">Experience</a>
            </div>
        </div>
        
        <!--<div class="home-search-bar-inner global-search-main">
            <span class="search-input">
            <input type="text" name="input-global-search" class="form-control" placeholder="where to?" /> 
            </span>
            <span class="search-icon"><i class="fa fa-search"></i></span>            
        </div> -->   
     </div>
</form>    
    <!-- slider starts here -->
         <section class="sliderSection" id="home_sld">
            @if(!empty($slider))
              <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner wrapper">
                    @foreach($slider as $key => $slider_row)
                      <div class="card item {{($key == 0)? 'active' : ''}}" data-tilt>
          <!--<a href="{{$slider_row->slider_link}}"><div class="image-overaly-bg"></div></a>
          <a href="{{$slider_row->slider_link}}"><div class="image-overaly-bg bg-dark"></div></a>
                         <a href="{{$slider_row->slider_link}}">-->
                         <a href="{{$slider_row->slider_link}}"><div class="image-overaly-bg"></div></a>
                         <a href="{{$slider_row->slider_link}}"><div class="image-overaly-bg bg-dark"></div></a>
                         <a href="{{$slider_row->slider_link}}"><img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt=""/></a>
                         
                         
                         <div class="carousel-caption item-front">
                            <div class="head-sec">
                                <?php /*<div class="round-crcle">
                                    <button class="c-slide__icon-more t-btn u-inline-block u-absolute u-pos-t u-marg-l-xxs u-valign-top u-shape-circle u-marg-t-xs u-marg-t-0@sm" style="left: 20px; transform: translateX(7.14446e-25px) translateY(5.59666e-25px) scale(1) translateZ(0px);"><div class="c-slide__icon-more__container u-absolute u-pos-center"><div class="c-slide__icon-more__bar u-absolute u-bg--white"></div><div class="c-slide__icon-more__bar u-absolute u-bg--white"></div></div> <img src="{{ asset('themes/emporium/images/gradient-circle.svg')}}" class="c-slide__icon-more__gradient o-wrapper--panel u-fit"></button> 
                                </div>*/ ?>
                                <h1><a href="{{$slider_row->slider_link}}">{{$slider_row->slider_title}}</a></h1>
                            </div>
                            <div class="cnt-box slider-cnt-box">
                                <p><a href="{{$slider_row->slider_link}}" style="color:white;">{{$slider_row->slider_description}}</a></p>
                            </div>
                            
                         </div>
                        
                    </div>
                    @endforeach
          {{--*/ $sliderads = CommonHelper::getSliderAds('landing_slider', 'Hotel') /*--}}
          @if(!empty($sliderads['leftsidebarads']))
            @foreach($sliderads['leftsidebarads'] as $ads)
              <div class="item">
                <a><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}" alt="" /></a>
                <div class="carousel-caption">
                  <div class="round-crcle"></div>
                           <div class="cnt-box slider-cnt-box">
                  <h1><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a></h1>
                  <p><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}" style="color:white;">{{$ads->adv_desc}} </a></p>
                </div>
              </div>
              </div>
            @endforeach
          @endif
                 </div>
                 <!-- Left and right controls -->


<!-- arrow animation -->
 <footer class="first-arw c-slideshow__footer u-absolute u-pos-bl u-fit-w u-pad-x-w1of12"><a href="#myCarousel" data-slide="prev" class="c-slideshow__control c-slideshow__control--left t-link u-absolute u-pos-bl u-pad-t-sm u-pad-b-xs u-marg-l-w1of13 u-marg-b-vh1of12 u-rtl u-vacuum router-link-active hide-frst"><div><div class="c-slideshow__control__line--before u-bg--white u-inline-block u-valign-middle u-hide@sm"></div> <span class="c-slideshow__control__label t-text--xs t-text--ls-md t-text--black u-inline-block u-valign-middle u-marg-l-lg u-uppercase u-marg-l-md@md u-block@sm u-marg-b-xs@sm u-marg-l-0@sm">Prev</span> <div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle"></div>
  <img src="{{ asset('themes/emporium/images/arrow-x-left-end.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />

</div></a> 

@if(!auth()->check())

<div class="log_in-btn c-slideshow__control__bottom u-cursor-pointer u-absolute u-pos-bl u-marg-b-vh1of12 u-marg-l-w5of12 u-vacuum u-marg-l-0@sm u-align-center@sm u-w3of12@sm hide-frst"><div class="c-slideshow__control__bottom__border u-absolute u-pos-tl u-w1of2 u-fit-h u-hide@sm "><div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-bl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-h u-bg--white"></div></div> <div class="c-slideshow__control__bottom__border u-absolute u-pos-tr u-w1of2 u-fit-h u-hide@sm"><div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-bl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tr u-fit-h u-bg--white"></div></div> <span class="c-slideshow__control__bottom__label t-text--xs t-text--ls-md t-text--black u-relative u-inline-block u-valign-middle u-marg-r-md u-uppercase u-force-3d u-marg-r-0@sm u-marg-b-xs@sm">Join the Club</span> <div class="c-slideshow__control__bottom__container u-absolute u-pos-r u-pos-y-center u-marg-r-md u-inline-block u-valign-middle u-force-3d u-overflow-h u-relative@sm u-block@sm u-marg-x-auto@sm"><div class="c-slideshow__control__bottom__arrow u-absolute"><div class="c-slideshow__control__bottom__line u-bg--white"></div>

<img src="{{ asset('themes/emporium/images/arrow-y-top-end.svg')}}" alt="" class="c-slideshow__control__bottom__arrow__icon t-icon--arrow-y" />

</div>

<img src="{{ asset('themes/emporium/images/arrow-y-top-end.svg')}}" alt="" class="c-slideshow__control__bottom__icon t-icon--arrow-y u-absolute u-pos-bl" />

</div></div> 

@endif

<a href="#myCarousel" data-slide="next" class="c-slideshow__control c-slideshow__control--right t-link u-absolute u-vacuum u-pos-br u-pad-t-sm u-pad-b-xs u-marg-r-w1of13 u-marg-b-vh1of12 u-align-right"><div><div class="c-slideshow__control__line--before u-bg--white u-inline-block u-valign-middle u-hide@sm"></div> <span class="c-slideshow__control__label t-text--xs t-text--ls-md t-text--black u-relative u-inline-block u-valign-middle u-marg-r-lg u-uppercase u-marg-r-md@md u-block@sm u-align-right@sm u-marg-b-xs@sm u-marg-r-0@sm"><span class="c-slideshow__control__label__word u-absolute u-pos-tr u-force-inline u-inline-block u-inline-block nxt-pg">Next</span>
  <span class="c-slideshow__control__label__word">Scroll explore</span>
  <span class="frst-scn">Ultra Luxury by invitation only</span>
</span> <div class="u-relative u-inline-block u-valign-middle u-overflow-h"><div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle"></div>


  <img src="{{ asset('themes/emporium/images/arrow-x-right-end.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />


  <div class="c-slideshow__control__discover__container__panel__mask-in o-wrapper--panel u-fit u-overflow-h"><div class="c-slideshow__control__discover__container__panel__mask-out o-wrapper--panel u-fit u-overflow-h"><div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle u-bg--gray-dark"></div>


  <img src="{{ asset('themes/emporium/images/arrow-x-right-end-gray.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />

</div></div></div></div></a></footer>
<!-- end of ARRow -->

              </div>
            @endif
            <div class="sliderFooter">
                {{--*/ $landing_menus = SiteHelpers::menus('landing') /*--}}
               @if(!empty($landing_menus))
                 <ul>
                  @foreach ($landing_menus as $fmenu)
                    <li>
                        <a @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}" @endif >
                          @if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                              {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                          @else
                              {{$fmenu['menu_name']}}
                          @endif
                        </a>
                    </li>
                  @endforeach
          <li><a href="javascript:void(0);" class="termAndConditionBtn">Contact us</a></li>
                 </ul>
                @ENDIF
            </div>
         </section>

         <div class="pop-hetel">

         </div>

    @include('frontend.themes.emporium.layouts.sections.contactus_popup')
    
    
    
@endsection

{{--For Right Side Icons --}}
      @section('right_side_iconbar')

      @include('frontend.themes.emporium.layouts.sections.home_right_iconbar')
      @endsection

{{-- For Include style files --}}
@section('head')
    @parent
  <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
  
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
  <script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
  <script>
     window.ParsleyConfig = {
      errorsWrapper: '<div></div>',
      errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
      errorClass: 'has-error',
      successClass: 'has-success'
    };

    $(function () {
      $('#conatctform').parsley().on('field:validated', function() {
      var ok = $('.parsley-error').length === 0;
      $('.bs-callout-info').toggleClass('hidden', !ok);
      $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
      submit_contact_request();
      return false; // Don't submit form for this demo
      });
      $(".close_btn").click(function(){
        $(".cstm_search").hide();
      });
    });

    function submit_contact_request()
    {
      $.ajax({
          url: "{{ URL::to('save_query')}}",
          type: "post",
          data: $('#conatctform').serialize(),
          dataType: "json",
          success: function(data){
          var html = '';
          if(data.status=='error')
          {
            html +='<ul class="parsley-error-list">';
            $.each(data.errors, function(idx, obj) {
              html +='<li>'+obj+'</li>';
            });
            html +='</ul>';
            $('#formerrors').html(html);
          }
          else{
            var htmli = '';
            htmli +='<div class="alert alert-success fade in block-inner">';
            htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
            htmli +='<i class="icon-checkmark-circle"></i> Contact Form Submitted Successfully </div>';
            $('#formerrors').html(htmli);
            $('#conatctform')[0].reset();
          }
          }
      });
    }
    $(document).on('submit', '.gs-form', function(){        
        var flag = true;
        var dest = $("#hid_our_destinations").val();
        var hotl = $("#hid_our_hotels").val();
        if(dest=='' && hotl==''){ 
            $(".gs-message").html('');
            $(".gs-message").html('Please search hotel or destination and select any of them');
            $("#showGSPopup").modal();
            flag = false;        
        }
        return flag;    
    });    
    /*$(document).ready(function(){
        var chk_date = new Date(); 
            
        var chk_out_date = new Date();
        
        @if(!empty(Session::get("arrive")))
            chk_date = '{{Session::get("arrive")}}';
        @else 
            chk_date = chk_date;            
        @endif
        
        @if(!empty(Session::get("departure")))
            chk_out_date = '{{Session::get("departure")}}'; 
        @else  
            chk_out_date = chk_out_date;
        @endif
        
        $('#t-global-picker').tDatePicker({
            'numCalendar':'2',
            'autoClose':true,
            'durationArrowTop':'200',
            'formatDate':'mm-dd-yyyy',
            'titleCheckIn':'Arrival',
            'titleCheckOut':'Departure',
            'inputNameCheckIn':'arrive',
            'inputNameCheckOut':'departure',
            'titleDateRange':'days',
            'titleDateRanges':'days',
            'iconDate':'<i class="fa fa-calendar"></i>',
            'limitDateRanges':'365',
            'dateCheckIn':chk_date,
            'dateCheckOut':chk_out_date,            
        });
        $(document).on('click', '.global-search-main', function(){
            $(".cstm_search").toggle();    
        });        
    });*/    
    
    /*$("#pills-home-tab").click(function(){
        $("#sitename").val('voyage');
        $("#globalfiltersearchpopup").css('display', 'none'); 
        $('[data-action="global-search"]').val('');     
    });
    $("#pills-profile-tab").click(function(){
        $("#sitename").val('safari');   
        $("#globalfiltersearchpopup").css('display', 'none');
        $('[data-action="global-search"]').val('');     
    });
    $("#pills-contact-tab").click(function(){
        $("#sitename").val('spa');
        $("#globalfiltersearchpopup").css('display', 'none'); 
        $('[data-action="global-search"]').val('');        
    });
    $("#pills-expereince-tab").click(function(){
        $("#sitename").val('islands');
        $("#globalfiltersearchpopup").css('display', 'none');
        $('[data-action="global-search"]').val('');          
    });*/
    
    /*$(document).on('keyup', '[data-action="global-search"]', function () { 
        var sitename = $("#sitename").val();
        $('[data-action="global-search-error"]').html('');
        if ($(this).val() == '') {
            $('[data-action="global-clear-search"]').hide();
            $('[data-option="global-search"]').slideUp(300);
        } else {
            $('[data-action="global-clear-search"]').show();
    		var fvalue = $(this).val();
    		
    		if(fvalue.length > 2)
    		{
    			globalSearchForAll($(this).val(), sitename);
    		}
        }
    });*/
    
    /*$(document).on('click', '.our-collections', function(){         
         if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="radio"]').attr('checked', false);
         }else{
            $(this).addClass('active');
            $(this).find('input[type="radio"]').attr('checked', true);
         }
    });
    
    $(document).on('click', '.our-hotels', function(){         
         if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="checkbox"]').attr('checked', false);
         }else{            
            $(this).addClass('active');
            $(this).find('input[type="checkbox"]').attr('checked', true);
         }
    });
    
    $(document).on('click', '.our-destinations', function(){         
         if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="checkbox"]').attr('checked', false);
         }else{
            $(this).addClass('active');
            $(this).find('input[type="checkbox"]').attr('checked', true);
         }
    });
    
    $(document).on('click', '.our-experiences', function(){         
         if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="radio"]').attr('checked', false);
         }else{
            $(this).addClass('active');
            $(this).find('input[type="radio"]').attr('checked', true);
         }
    });
    
    $(document).on('click', '.our-channels', function(){         
         if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="radio"]').attr('checked', false);
         }else{
            $(this).addClass('active');
            $(this).find('input[type="radio"]').attr('checked', true);
         }
    });*/
    
    
    function fun_add_remove_hotel_arr(){
        
    }
    
    
    /*
* For Global Search function
*/
/*function globalSearchForAll(searcValue, sitename) {

    var datObj = {};
    datObj.keyword = searcValue;
    datObj.sitename = sitename;
    var params = $.extend({}, doAjax_params_default);
    params['url'] = BaseURL + '/destination/global-search';
    params['data'] = datObj;
    params['successCallbackFunction'] = function (data) {
        
        if(data.data.sitename!=undefined){
            var sitenm = data.data.sitename;
            if(sitenm=='voyage'){
                BaseURL1 = 'https://emporium-voyage.com';
            }else if(sitenm=='safari'){
                BaseURL1 = 'https://emporium-safari.com';
            }else if(sitenm=='spa'){
                BaseURL1 = 'https://emporium-spa.com';
            }else if(sitenm=='islands'){
                BaseURL1 = 'https://emporium-islands.com';
            }
        }
        $('[data-action="global-search-our-collections"] span').html('Our Collection (0)');
        $('[data-action="global-search-collections"] span').html('Our Hotel (0)');
        $('[data-action="global-search-destinations"] span').html('Our Destination (0)');
        $('[data-action="global-search-experiences"] span').html('Our Experience (0)');
        $('[data-action="global-search-destination-channels"] span').html('Our Channel (0)');
        
        $('[data-option="global-search-our-collection-option-list"]').html('');
        $('[data-option="global-search-collection-option-list"]').html('');
        $('[data-option="global-search-dest-option-list"]').html('');
        $('[data-option="global-search-experience-option-list"]').html('');
        $('[data-option="global-search-dest-channel-option-list"]').html('');       
        
        if (data.data.our_collection == undefined) {
            $('[data-action="global-search-our-collections"] span').html('Our Collection (0)');
        }else{
            var html ='';
            var collString = (data.data.our_collection.length > 1) ? "Our Collections" : "Our Collection";
            $('[data-action="global-search-our-collections"] span').html(collString + ' ('+data.data.our_collection.length+')');
            $(data.data.our_collection).each(function (i, val) {
                var  linkMenu = BaseURL1+'/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-collections" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourCollections[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-our-collection-option-list"]').html(html);
            //$('[data-action="global-search-our-collections"]').parent().show();
        }
        if (data.data.collection == undefined) {
            $('[data-action="global-search-collections"] span').html('Our Hotel (0)');
        }else{
            var html ='';
            var collString = (data.data.collection.length > 1) ? "Our Hotels" : "Our Hotel";
            $('[data-action="global-search-collections"] span').html(collString + ' ('+data.data.collection.length+')');
            $(data.data.collection).each(function (i, val) {
                var  linkMenu = BaseURL1+'/'+val.property_slug;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.property_name + '</a></li>';
                html += '<li class="our-hotels" data-name="'+ val.property_name +'">' + val.property_name + '<input type="checkbox" name="ourHotels[]" value="'+ val.property_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-collection-option-list"]').html(html);
            //$('[data-action="global-collections"]').parent().show();
        }
        if (data.data.dest == undefined) {
            $('[data-action="global-search-destinations"] span').html('Our Destination (0)');
        }else {
            var html ='';
            var destString = (data.data.dest.length > 1) ? "Our Destinations" : "Our Destination";
            $('[data-action="global-search-destinations"] span').html(destString + ' ('+data.data.dest.length+')');
            $(data.data.dest).each(function (i, val) {
                var  linkMenu = BaseURL1+'/luxury_destinations/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-destinations" data-name="'+ val.category_name +'">' + val.category_name + ' (' + val.p_name + ')<input type="checkbox" name="ourDestinations[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-dest-option-list"]').html(html);
            //$('[data-action="global-destinations"]').parent().show();
        }
        
        if (data.data.experiences == undefined) { 
            $('[data-action="global-search-experiences"] span').html('Our Experience (0)');
        } else { 
            var html ='';
            var restroString = (data.data.experiences.length > 1) ? "Our Experiences" : "Our Experience";
            $('[data-action="global-search-experiences"] span').html(restroString + ' ('+data.data.experiences.length+')');
            $(data.data.experiences).each(function (i, val) {
                var  linkMenu = BaseURL1+'/luxury_experience/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-experiences" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourExperiences[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-experience-option-list"]').html(html);
            //$('[data-action="global-restaurant"]').parent().show();
        }
        if (data.data.dest == undefined) {
            $('[data-action="global-search-destination-channels"] span').html('Our Channel (0)');
        } else {
            var html ='';
            var barString = (data.data.dest.length > 1) ? "Our Channels" : "Our Channel";
            $('[data-action="global-search-destination-channels"] span').html(barString + ' ('+data.data.dest.length+')');
            $(data.data.dest).each(function (i, val) {
                var  linkMenu = BaseURL1+'/social-youtube/'+val.category_alias;
                //html += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
                html += '<li class="our-channels" data-name="'+ val.category_name +'">' + val.category_name + '<input type="radio" name="ourChannels[]" value="'+ val.category_name +'" class="invisible"></li>';
            });
            $('[data-option="global-search-dest-channel-option-list"]').html(html);
            //$('[data-action="global-bar"]').parent().show();
        }
    };
    doAjax(params);
    $('[data-option="global-search"]').slideDown(300);
}*/
  </script>
@endsection

{{-- For footer --}}
@section('footer')

@endsection
