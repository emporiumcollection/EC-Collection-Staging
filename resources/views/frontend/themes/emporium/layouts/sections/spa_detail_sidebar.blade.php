
<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="restaurantnav">
            <div class="mobilenavheader">
				<a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/design-location-logo.png') }}" alt="Emporium Voyage" class="img-responsive"/></a>
                @if(!empty($spasArr[0])) <h3>{{$spasArr[0]->title}}</h3> @endif
                <a href="{{URL::to('')}}" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> Home</a>
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
               <li><a href="#spa1">INFO</a></li>
               <li><a href="#video" class="">VIDEO</a></li>
               <li><a href="#seasonal-events">SEASONAL EVENTS</a></li>
               <li><a href="#instagram-gallery">SPECIAL OCCASIONS</a></li>
               <li><a href="#get-directions">GET DIRECTIONS</a></li>
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
