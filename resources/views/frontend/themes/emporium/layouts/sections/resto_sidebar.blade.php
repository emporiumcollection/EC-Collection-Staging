
<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader">
                <a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/design-location-logo.png') }}" alt="Emporium Voyage" class="img-responsive"/></a>
                <a href="{{URL::to($pagetitle)}}" class="homelinknav backtodestinationnav"><i class="fa fa-angle-left"></i> BACK TO HOTEL</a>
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
                @if(!empty($resturantArr))
				{{--*/ $r=1; /*--}}
				  @foreach($resturantArr as $resturant)
					<li><a href="#restaurant{{$r}}" class="closenavlink scrollpage">{{$resturant->title}}</a></li>
					{{--*/ $r++; /*--}}
				  @endforeach
				@endif
				
				@if(!empty($barsArr))
				{{--*/ $b=1; /*--}}
				  @foreach($barsArr as $bar)
					<li><a href="#bar{{$b}}" class="closenavlink scrollpage">{{$bar->title}}</a></li>
					{{--*/ $b++; /*--}}
				  @endforeach
				@endif
				
				@if(!empty($spasArr))
				{{--*/ $s=1; /*--}}
				  @foreach($spasArr as $spa)
					<li><a href="#spa{{$s}}" class="closenavlink scrollpage">{{$spa->title}}</a></li>
					{{--*/ $s++; /*--}}
				  @endforeach
				@endif

                <li><a href="#video" class="closenavlink scrollpage">VIDEO</a></li>
                <li><a href="#seasonal-events" class="closenavlink scrollpage">SEASONAL EVENTS</a></li>
                <li><a href="#instagram-gallery" class="closenavlink scrollpage">SPECIAL OCCASIONS</a></li>
                <li><a href="#get-directions" class="closenavlink scrollpage">GET DIRECTIONS</a></li>
                <li><a href="{{URL::to($pagetitle)}}" class="yellowbtn">VISIT HOTEL</a></li>
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
              </div>
            </div>    
        </div>
       
    </div>
</div>
