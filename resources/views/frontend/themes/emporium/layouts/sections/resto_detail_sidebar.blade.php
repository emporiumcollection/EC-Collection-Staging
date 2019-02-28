
<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader">
				{{-- <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive"/></a> --}}
                @if(defined('CNF_FRONTEND_LOGO'))
                    @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                        <a href="{{url('/')}}">
                            <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                        </a>
                    @else
                        <a href="{{URL::to('/')}}">
                            <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive"/>
                        </a>
                    @endif
                @else
                    <a href="{{URL::to('/')}}">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage" class="img-responsive"/>
                    </a>
                @endif
                @if(!empty($resturantArr[0])) <h3>{{$resturantArr[0]->title}}</h3> @endif
                <a href="{{URL::to('')}}" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> Home</a>
            </div>
            <ul class="mobilemenulist">
                {{-- Global Search Bar --}}
                @include('frontend.themes.emporium.layouts.sections.global-search-bar')
                {{-- End Global Search Bar --}}

                <li><a href="#restaurant1">INFO</a></li>
                @if($resturantArr[0]->video_type!='' || ($resturantArr[0]->part_of_hotel==1 && $resturantArr[0]->social_youtube!=''))
					<li><a href="#video" class="">VIDEO</a></li>
				@endif
               <!-- <li><a href="#get-directions">GET DIRECTIONS</a></li>-->
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
                    {{--*/ $sidebarads = CommonHelper::getSidebarAds('detail_restaurant_popup', 'Hotel') /*--}}
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
