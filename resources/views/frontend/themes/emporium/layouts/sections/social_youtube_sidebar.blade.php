<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader " data-option="home" data-option-type="logo">
                {{-- <a href="{{url('/')}}">
                    <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                </a> --}}
                @if(defined('CNF_FRONTEND_LOGO'))
                    @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                        <a href="{{url('/')}}">
                            <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                        </a>
                    @else
                        <a href="{{url('/')}}">
                            <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                        </a>
                    @endif
                @else
                    <a href="{{url('/')}}">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
                    </a>
                @endif
            </div>
            <!--<div class="mobilenavheader hide" data-option="child-global">
                <h3 data-option-title="global"></h3>
                <a  class="homelinknav backtohomelink cursor" data-option-action="back"
                   data-option-action-type="home" data-id="0"><i class="fa fa-angle-left"></i> <span>HOME</span></a>
            </div>-->
            <ul class="mobilemenulist common-search-bar" data-option="search-bar">
                {{-- Global Search Bar --}}
                @include('frontend.themes.emporium.layouts.sections.global-search-bar')
                {{-- End Global Search Bar--}}
                <li data-option="intro-text" class="hide">
                    <p></p>
                </li>
                <li class="hide" data-option="selected-thumb">
                    <div class="navheadimage">
                        <img data-option="selected-thumb-img" alt=""/>
                        <div class="headingoverlay" data-option="selected-thumb-text"></div>
                    </div>
                </li>
            </ul>
            <ul class="mobilemenulist" data-option="home">
                <!--<li><a class="cursor" data-action="select-destination-youtube" data-id="0">SELECT YOUR DESTINATION</a></li>
                <li><a class="cursor" data-action="select-menu" data-position="business" data-id="0">COMPANY</a></li>-->
                <li><a class="cursor" data-action="select-collection">SEARCH OUR COLLECTION</a></li>
                <li><a class="cursor" data-action="search-by-date">Search availability</a></li>
                <li><a class="cursor" data-action="select-destination" data-id="0">Search by destination</a></li>
                <li><a class="cursor" data-action="select-experience" >Search by Experience</a></li>
                <!--li><a href="javascript:void(0)" >PERSONALIZED SERVICE</a></li-->
                <!--<li><a class="cursor" data-action="company">COMPANY</a></li>-->
                <li><a class="cursor" data-action="select-destination-youtube">Search Destination Channel</a></li>
                <li><a class="cursor" data-action="select-menu" data-position="business" data-id="0">Company & Info</a></li>
                <li><a class="cursor EGloader" href="{{URL::to('memberships')}}" >Membership</a></li>
            </ul>
            <ul class="mobilemenulist hide socialyoutubemenu" data-option="selected-option-list">
            </ul>
            @if (!Auth::check())

            <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob"
                                                                                     href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
            </div>
            @endif
        </div>
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
                {{--*/ $sidebarads = CommonHelper::getSidebarAds('youtube_channel_page', $catid) /*--}}
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