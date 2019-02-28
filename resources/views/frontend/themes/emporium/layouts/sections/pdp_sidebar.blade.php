
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

            <ul class="mobilemenulist">
                <li><a href="#hotelInfo" class="closenavlink scrollpage">HOTEL INFO</a></li>
				@if (array_key_exists('typedata', $propertyDetail))
					<li><a href="#roomsSuit" class="closenavlink scrollpage">ROOMS & SUITES</a></li>
				@endif
				
				@if($propertyDetail['data']->architecture_title!='' && $propertyDetail['data']->architecture_desciription!='')
					<li><a href="#design-architecture" class="closenavlink scrollpage">DESIGN & ARCHITECTURE</a></li>
				@endif
				
				<?php /*
				@if($propertyDetail['data']->restaurant_ids!='' || $propertyDetail['data']->spa_ids!='' || $propertyDetail['data']->bar_ids!='')
					<li><a href="{{URL::to($propertyDetail['data']->property_slug.'/restaurant')}}">RESTAURANT & BAR</a></li>
				@endif 
				*/ ?>
				
				@if($propertyDetail['data']->video_title!='')
					<li><a href="#video" class="closenavlink scrollpage">VIDEO</a></li>
				@endif
				
                <li><a href="#bookHotel" class="yellowbtn scrollpage closenavlink">BOOK {{$propertyDetail['data']->property_name}} </a></li>
            </ul>
            @if (!Auth::check())

                <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob"
                                                                         href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
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
                {{--*/ $sidebarads = CommonHelper::getDetailpageSidebarAds('detail', $propertyDetail['data']->property_category_id); /*--}}
                @if(!empty($sidebarads['leftsidebarads']))
                    @foreach($sidebarads['leftsidebarads'] as $ads)
                        <div class="item">
                            <a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}"><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}"></a>
                        </div>
                    @endforeach
                @endif
              </div>
            </div>
            
        </div>
      
    </div>
</div>
