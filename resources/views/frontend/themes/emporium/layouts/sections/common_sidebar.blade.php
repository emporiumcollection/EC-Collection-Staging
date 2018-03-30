<div class="mobilemenu">
	<div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
    	<div class="mobilemainnav openmobilemenu">
	    	<div class="mobilenavheader">
            	<a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/logo.png') }}" alt="Emporium Voyage" class="img-responsive"/></a>
            </div>
            <ul class="mobilemenulist">
            	<li>
                	<div class="mobile-leftsearch">
                    	<input type="text" class="form-control" id="search"/>
                        <button type="button"><i class="fa fa-search"></i></button>
                    </div>
                    <div id="filtersearchpopup" style="display:none;">
                    	<ul>
                        	<li>
                            	<a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-destinations"></i> Destinations <span>(3)</span></a>
                            </li>
                            <li>
                            	<a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-collections"></i> Collections <span>(11)</span></a>
                            </li>
                            <li>
                            	<a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-restaurant"></i> Restaurant <span>(5)</span></a>
                            </li>
                            <li>
                            	<a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-bar"></i> Bar <span>(2)</span></a>
                            </li>
                            <li>
                            	<a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-spa"></i> Spa <span>(2)</span></a>
                            </li>
                        </ul>
                    </div>
               </li>
			   {{--*/ $page_menus = SiteHelpers::menus('business') /*--}}
               @if(!empty($page_menus))
				   @foreach ($page_menus as $pmenu)
						<li>
							<a @if($pmenu['menu_type'] =='external') href="{{ URL::to($pmenu['url'])}}" @else href="{{ URL::to($pmenu['module'])}}" @endif id="companynav{{$pmenu['menu_id']}}">
								@if(CNF_MULTILANG ==1 && isset($pmenu['menu_lang']['title'][Session::get('lang')]))
									{{ $pmenu['menu_lang']['title'][Session::get('lang')] }}
								@else
									{{$pmenu['menu_name']}}
								@endif
							</a>
						</li>
					@endforeach
                @endif
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