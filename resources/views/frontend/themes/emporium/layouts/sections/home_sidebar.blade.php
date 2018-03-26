<div class="mobilemenu">
    <div class="block-content togglenav content active mobilenavclosebtn">
        <span></span>
        <span> </span>
        <span></span>
    </div>
    <div class="mobilemenu-inner">
        <div class="mobilemainnav openmobilemenu">
            <div class="mobilenavheader " data-option="home"><a href="{{url('/')}}"><img
                            src="{{ asset('themes/emporium/images/logo.png')}}" alt="Emporium Voyage"
                            class="img-responsive"/></a></div>
            <div class="mobilenavheader hide" data-option="child-global">
                <h3 data-option-title="global"></h3>
                <a href="javascript:void(0)" class="homelinknav backtohomelink" data-option-action="back"
                   data-option-action-type="home" data-id="0"><i class="fa fa-angle-left"></i> <span>HOME</span></a>
            </div>
            <ul class="mobilemenulist common-search-bar" data-option="search-bar">
                <li>
                    <div class="mobile-leftsearch">
                        <input type="text" class="form-control" id="search"/>
                        <button type="button"><i class="fa fa-search"></i></button>
                    </div>
                    <div id="filtersearchpopup" style="display:none;">
                        <ul>
                            <li>
                                <a class="searchresultdata" href="javascript:void(0)" id="destinationsresult"><i
                                            class="iconsheet icon-destinations"></i> Destinations <span>(3)</span></a>
                            </li>
                            <li>
                                <a class="searchresultdata" href="javascript:void(0)"><i
                                            class="iconsheet icon-collections"></i> Collections <span>(11)</span></a>
                            </li>
                            <li>
                                <a class="searchresultdata" href="javascript:void(0)"><i
                                            class="iconsheet icon-restaurant"></i> Restaurant <span>(5)</span></a>
                            </li>
                            <li>
                                <a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-bar"></i>
                                    Bar <span>(2)</span></a>
                            </li>
                            <li>
                                <a class="searchresultdata" href="javascript:void(0)"><i class="iconsheet icon-spa"></i>
                                    Spa <span>(2)</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
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
                <li><a class="cursor" data-action="select-collection">SEARCH OUR COLLECTION</a></li>
                <li><a class="cursor" data-action="search-by-date">SEARCH BY DATE</a></li>
                <li><a class="cursor" data-action="select-destination" data-id="0">SELECT YOUR DESTINATION</a></li>
                <li><a class="cursor" data-action="select-experience" >SELECT YOUR EXPERIENCE</a></li>
                <!--li><a href="javascript:void(0)" >PERSONALIZED SERVICE</a></li-->
                <li><a class="cursor" data-action="select-menu" data-position="business" data-id="0">COMPANY</a></li>
            </ul>
            <ul class="mobilemenulist hide" data-option="search-our-collection">
                <li>
                    <div class="navheadimage"><a href="{{url('luxurytravel/Hotel')}}"><img
                                    src="{{ asset('themes/emporium/images/mountain-image.jpg') }}" alt=""/>
                            <div class="headingoverlay">HOTELS</div>
                        </a></div>
                </li>
                <li>
                    <div class="navheadimage"><a href="http://emporium-yachts.com/"><img
                                    src="{{ asset('themes/emporium/images/mountain-image.jpg') }}" alt=""/>
                            <div class="headingoverlay">YACHTS</div>
                        </a></div>
                </li>
            </ul>
            <ul class="mobilemenulist hide" data-option="selected-option-list">
            </ul>
            <div class="bottomlink" data-option="global">Already have an account? <a class="loginSecForMob"
                                                                                     href="javascript:void(0)">Login</a><br/>or<br/>Don't
                have Emporium Voyage account <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
            </div>
            <div class="hide" data-option="search-by-date">
                <form action="{{url('search')}}" method="get">
                    {{--*/
                            $setDateArvStr = date('j-n-Y');
                            $setDateDepStr = date('j-n-Y',strtotime('+1 day'));
                            $setDateArvArr = explode('-',$setDateArvStr);
                            $setDateDepArr = explode('-',$setDateDepStr);
                    /*--}}
                    <input name="arrive" type="hidden" value="{{date('d-m-Y')}}">
                    <input name="departure" type="hidden" value="{{date('d-m-Y', strtotime('+1 day'))}}">
                    <ul class="mobilemenulist">
                        <li>
                            <p>Emporium Voyage is your deal, vogue vacation planner!</p>
                        </li>
                        <li>
                            <ul class="calenderwrapper">
                                <li>
                                    <h4>ARRIVAL</h4>
                                </li>
                                <li>
                                    <label>DAY</label>
                                    <select class="calenderselectbox" data-option="arrival-day" data-action="choose-date">
                                        @for($arvDay=1;$arvDay<=31;$arvDay++)
                                            <option @if($setDateArvArr[0]==$arvDay) {{ 'selected' }} @endif value="{{(strlen($arvDay)>1)?$arvDay:'0'.$arvDay}}">{{$arvDay}}</option>
                                        @endfor

                                    </select>
                                </li>
                                <li>
                                    <label>MONTH</label>
                                    <select class="calenderselectbox" data-option="arrival-month" data-action="choose-date">
                                        @for($arvMonth=1; $arvMonth<=12; ++$arvMonth)
                                            <option  @if($setDateArvArr[2]==$arvMonth) {{ 'selected' }} @endif value="{{(strlen($arvMonth)>1)?$arvMonth:'0'.$arvMonth}}">{{ date('F', mktime(0, 0, 0, $arvMonth, 1)) }}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>YEAR</label>
                                    <select class="calenderselectbox" data-option="arrival-year" data-action="choose-date">
                                        {{--*/ $arvYearRange = range(date('Y'), date('Y', strtotime('+5 years'))) /*--}}
                                        @foreach($arvYearRange as $arvYear)
                                            <option  @if($setDateArvArr[2]==$arvYear) {{ 'selected' }} @endif value="{{$arvYear}}">{{$arvYear}}</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <ul class="calenderwrapper departure">
                                <li>
                                    <h4>DEPARTURE</h4>
                                </li>
                                <li>
                                    <label>DAY</label>
                                    <select class="calenderselectbox" data-option="departure-day" data-action="choose-date">
                                        @for($depDay=1;$depDay<=31;$depDay++)
                                            <option @if($setDateDepArr[0]==$depDay) {{ 'selected' }} @endif value="{{(strlen($depDay)>1)?$depDay:'0'.$depDay}}">{{$depDay}}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>MONTH</label>
                                    <select class="calenderselectbox" data-option="departure-month" data-action="choose-date">
                                        @for($depMonth=1; $depMonth<=12; ++$depMonth)
                                            <option @if($setDateDepArr[1]==$arvMonth) {{ 'selected' }} @endif value="{{(strlen($depMonth)>1)?$depMonth:'0'.$depMonth}}">{{ date('F', mktime(0, 0, 0, $depMonth, 1)) }}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>YEAR</label>
                                    <select class="calenderselectbox" data-option="departure-year" data-action="choose-date">
                                        {{--*/ $depYearRange = range(date('Y'), date('Y', strtotime('+5 years'))) /*--}}
                                        @foreach($depYearRange as $depYear)
                                            <option @if($setDateDepArr[2]==$depYear) {{ 'selected' }} @endif value="{{$depYear}}">{{$depYear}}</option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                            <button class="searchButton btn" type="submit">Search</button>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="bottomlink text-center hide" data-option="search-by-date">View, Modify or Cancel your
                Booking<br/> <a href="javascript:void(0)" class="loginSecForMob">Login</a></div>

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