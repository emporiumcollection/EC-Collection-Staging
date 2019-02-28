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
            <div class="mobilenavheader hide" data-option="child-global">
                <h3 data-option-title="global"></h3>
                <a class="homelinknav backtohomelink cursor" data-option-action="back"
                   data-option-action-type="home" data-id="0"><i class="fa fa-angle-left"></i> <span>HOME</span></a>
            </div>
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


    @if(Auth::check() &&  (Auth::User()->group_id==5 || Auth::User()->group_id==7)   )

    {{--*/ $intranet_menus = SiteHelpers::menus('intranet') /*--}}
               @if(!empty($intranet_menus))
                   @foreach ($intranet_menus as $pmenu)
                        <li>
                            <a @if($pmenu['menu_type'] =='external') href="{{ URL::to($pmenu['url'])}}" @else href="{{ URL::to($pmenu['module'])}}" @endif id="intranetNav{{$pmenu['menu_id']}}" data-toggle="collapse" data-target="#subIntranetNav{{$pmenu['menu_id']}}">
                                @if(CNF_MULTILANG ==1 && isset($pmenu['menu_lang']['title'][Session::get('lang')]))
                                    {{ $pmenu['menu_lang']['title'][Session::get('lang')] }}
                                @else
                                    {{$pmenu['menu_name']}}
                                @endif
                            </a>

                            @if(count($pmenu['childs']) > 0)
                                <div id="subIntranetNav{{$pmenu['menu_id']}}" class="collapse">
                                    <ul class="mobilesublinks" >
                                        @foreach ($pmenu['childs'] as $fmenu2)
                                            <li>
                                                <a @if($fmenu2['menu_type'] =='external') href="{{ URL::to($fmenu2['url'])}}" @else href="{{ URL::to($fmenu2['module'])}}" @endif>
                                                    @if(CNF_MULTILANG ==1 && isset($fmenu2['menu_lang']['title'][Session::get('lang')]))
                                                        {{ $fmenu2['menu_lang']['title'][Session::get('lang')] }}
                                                    @else
                                                        {{$fmenu2['menu_name']}}
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                @endif


                @else

                {{--*/ $page_menus = SiteHelpers::menus('business') /*--}}
               @if(!empty($page_menus))
                   @foreach ($page_menus as $pmenu)
                        <li>
                            <a class="cursor menu_item" @if($pmenu['menu_type'] =='external') @if($pmenu['url'] == "#" || $pmenu['url'] == '') data-action="select-menu" data-position="business" data-id="{{ $pmenu['menu_id'] }}" @else href="{{ URL::to($pmenu['url'])}}" @endif @else href="{{ URL::to($pmenu['module'])}}" @endif id="companynav{{$pmenu['menu_id']}}">
                                @if(CNF_MULTILANG ==1 && isset($pmenu['menu_lang']['title'][Session::get('lang')]))
                                    {{ $pmenu['menu_lang']['title'][Session::get('lang')] }}
                                @else
                                    {{$pmenu['menu_name']}}
                                @endif
                            </a>
                            @if($pmenu['menu_type'] =='external') @if($pmenu['url'] != "#" || $pmenu['url'] != '') <i class="fa fa-angle-right"></i> @endif @endif
                        </li>
                    @endforeach
                @endif
            @endif

            </ul>
            <ul class="mobilemenulist hide" data-option="selected-option-list">
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
							</ul>
						@endif
                    </div>
                </div>
				{{--*/ $sidebarads = CommonHelper::getSidebarAds('landing', 'Hotel') /*--}}
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