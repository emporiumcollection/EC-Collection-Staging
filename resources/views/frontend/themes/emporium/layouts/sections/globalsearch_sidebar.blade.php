
<div class="mobilemenu">
	<div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
    	<div class="mobilemainnav openmobilemenu">
	    	<div class="mobilenavheader">
                {{-- <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/></a> --}}
                @if(defined('CNF_FRONTEND_LOGO'))
                    @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                        <a href="{{url('/')}}">
                            <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                        </a>
                    @else
                        <a href="{{URL::to('/')}}">
                            <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                        </a>
                    @endif
                @else
                    <a href="{{URL::to('/')}}">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                    </a>
                @endif
            </div>
            <ul class="mobilemenulist">
                {{-- Global Search Bar --}}
                @include('frontend.themes.emporium.layouts.sections.global-search-bar')
                {{-- End Global Search Bar--}}
            </ul>

            {{-- For Gobal Search List --}}
            @include('frontend.themes.emporium.layouts.sections.global-search-list')
            {{-- End  Gobal Search List --}}
            
            <div class="sidebar-search-criteria">
                <div class="col-md-12 yellowbtn"><a href="javascript:void(0)" onclick="window.history.back();" class="font-white">Back to search</a></div>
                <div class="col-md-12 margin-top-10">Your search criteria :</div>
                {{-- */  $sidebar_hotels=[]; $sidebar_destinations=[];  /* --}}
                @if(!empty($allData))
                    @foreach($allData as $data) 
                        @if(count($data['ddSelected'])>0)                               
                            @foreach($data['ddSelected'] as $seldd)
                                @if($data['name']=='Hotel')
                                    {{-- */ $sidebar_hotels[] = $seldd; /* --}}        
                                @endif 
                                @if($data['name']=='Destination')
                                    {{-- */ $sidebar_destinations[] = $seldd; /* --}} 
                                @endif        
                            @endforeach                          
                        @endif
                    @endforeach                        
                @endif
                <div class="col-md-12">                    
                    @if($sidebar_hotels != '')                         
                        <ul class="sidebar-ul">
                            Hotels:
                            @foreach($sidebar_hotels as $s_hotel)
                                <li class="sidebar-li" >{{$s_hotel}} <a class="remove sidebar-hotel-remove" data-name="{{$s_hotel}}">x</a></li>    
                            @endforeach
                        </ul>
                    @endif    
                </div>
                <div class="col-md-12">
                    @if(!empty($sidebar_destinations))                        
                        <ul>
                            Destinations: 
                            @foreach($sidebar_destinations as $s_dest)
                                <li class="">{{$s_dest}}<a class="remove sidebar-dest-remove" data-name="{{$s_dest}}">x</a></li>    
                            @endforeach
                        </ul>
                    @endif  
                </div>
                <?php /*<div class="col-md-12">                    
                    @if($sidebar_hotels != '')
                        Hotels: {{implode(', ',$sidebar_hotels)}}
                    @endif    
                </div>
                <div class="col-md-12">
                    @if(!empty($sidebar_destinations))
                        Destinations: {{implode(', ', $sidebar_destinations)}}
                    @endif  
                </div> */ ?>
                <div class="col-md-12">
                    <a href="#" class="sidebar-availability"> Availability <br />From: {{$arrive_new}} <br />To: {{$departure_new}}</a>
                </div>
                <div class="col-md-12 margin-bot-30"></div>                 
            </div>
            
            <div class="main-acordian-search-sidebar">
                @if(!empty($allData))                                                        
                {{--*/ $k=1; $j=1; /*--}} 
    			<div id="search-sidebar-accordion" class="panel-group">
                    @foreach($allData as $si_data)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="click0 side-{{$si_data['name']}} <?php echo $k >1 ? 'collapsed' : ''; ?>" data-toggle="collapse" data-parent="#search-sidebar-accordion" href="#collapse_{{$k}}">{{$si_data['name']}}</a>
                            </h4>
                        </div>
                        <div id="collapse_{{$k}}" class="panel-collapse collapse <?php echo ($k==1) ? 'in' : '' ?>">
                            <div class="panel-body magin-top-30">
                                @if(!empty($si_data['ddSelected']))                                								
                                <div id="search-sidebar-accordion-{{$k}}" class="panel-group">
                                    @foreach($si_data['ddSelected'] as $si_dddata)
                                    {{-- */ $sidedd = str_replace(' ', '-', $si_dddata); /* --}}
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">                                            
                                                <a class="click0 side-{{$sidedd}} sd-{{$si_data['name']}}" data-name="{{$si_dddata}}" data-toggle="collapse" data-parent="#search-sidebar-accordion-{{$k}}" href="#collapse_{{$k}}_{{$j}}">{{$si_dddata}}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse_{{$k}}_{{$j}}" class="panel-collapse collapse <?php echo ($j==1) ? 'in' : '' ?>">
                                            <div class="panel-body magin-top-30">    								
                                                @if($si_data['name']=='Hotel')
                                                    <ul class="mobilemenulist sidemenumodulelist-{{$sidedd}}">
                                                        <li><a href="#hotelInfo" class="closenavlink scrollpage">HOTEL INFO</a></li>       				
                                       					<li><a href="#roomsSuit" class="closenavlink scrollpage">ROOMS & SUITES</a></li>
                                        				<li><a href="#design-architecture" class="closenavlink scrollpage">DESIGN & ARCHITECTURE</a></li>
                                       					<li><a href="#video" class="closenavlink scrollpage">VIDEO</a></li>
                                        				
                                                        <!--<li><a href="#bookHotel" class="yellowbtn scrollpage closenavlink">BOOK </a></li>-->                                                         
                                                    </ul>        
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{--*/ $j++;  /*--}}
                                    @endforeach				
                                </div>
                                @endif                                 
                            </div>
                        </div>
                    </div>
                    {{--*/ $k++;  /*--}}
                    @endforeach				
                </div>
                @endif
            </div>
            <ul class="mobilemenulist hide" data-option="selected-option-list">
            </ul>
            @if (!Auth::check())

                <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob" href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
                </div>
                
            @endif
            
            <div class="left-carousal">
            	<div id="owl-carousel" class="owl-carousel">
                
                <div class="item">
                	<div class="side-bar-why-book-with-us">
                    	<div class="book-with-us-tittles">
                            <h2>Why book with us?</h2>
                        </div>
                        {{--*/ $uspmod = CommonHelper::getUspMod() /*--}}
                        @if(!empty($uspmod['whybookwithus']))
                            <ul class="side-bar-book-with-us-list">
                                @foreach ($uspmod['whybookwithus'] as $usps)
                                    <li>
                                        <h3>{{$usps->title}}</h3>
                                        <p>{{$usps->sub_title}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <?php /* {{--/ $sidebarads = CommonHelper::getDetailpageSidebarAds('detail', $propertyDetail[0]['propertyDetail']['data']->property_category_id); /*--}}
                @if(!empty($sidebarads['leftsidebarads']))
                    @foreach($sidebarads['leftsidebarads'] as $ads)
                        <div class="item">
                            <a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}"></a>
                        </div>
                    @endforeach 
                @endif */ ?>
              </div>
            </div>
            
        </div>
      
    </div>
</div>
