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
                <li><a class="cursor" data-action="company">COMPANY</a></li>
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
                                    <select class="calenderselectbox" name="arrival-day">
                                        @for($arvDay=1;$arvDay<=31;$arvDay++)
                                            <option>{{$arvDay}}</option>
                                        @endfor

                                    </select>
                                </li>
                                <li>
                                    <label>MONTH</label>
                                    <select class="calenderselectbox" name="arrival-month">
                                        @for($arvMonth=1; $arvMonth<=12; ++$arvMonth)
                                            <option value="{{$arvMonth}}">{{ date('F', mktime(0, 0, 0, $arvMonth, 1)) }}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>YEAR</label>
                                    <select class="calenderselectbox" name="arrival-year">
                                        {{--*/ $arvYearRange = range(date('Y'), date('Y', strtotime('+5 years'))) /*--}}
                                        @foreach($arvYearRange as $arvYear)
                                            <option>{{$arvYear}}</option>
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
                                    <select class="calenderselectbox" name="departure-day">
                                        @for($depDay=1;$depDay<=31;$depDay++)
                                            <option>{{$depDay}}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>MONTH</label>
                                    <select class="calenderselectbox" name="departure-month">
                                        @for($depMonth=1; $depMonth<=12; ++$depMonth)
                                            <option value="{{$depMonth}}">{{ date('F', mktime(0, 0, 0, $depMonth, 1)) }}</option>
                                        @endfor
                                    </select>
                                </li>
                                <li>
                                    <label>YEAR</label>
                                    <select class="calenderselectbox" name="departure-year">
                                        {{--*/ $depYearRange = range(date('Y'), date('Y', strtotime('+5 years'))) /*--}}
                                        @foreach($depYearRange as $depYear)
                                            <option>{{$depYear}}</option>
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
                        <ul class="side-bar-book-with-us-list">
                            <li>
                                <h3>Handpicked Selection of Hotels</h3>
                                <p>from selected luxury destinations worldwide</p>
                            </li>
                            <li>
                                <h3>Upgrade and Late Checkout</h3>
                                <p>At any Hotel upon Avilability</p>
                            </li>
                            <li>
                                <h3>Preferred Guest Discounts at New Hotels</h3>
                                <p>join our members club</p>
                            </li>
                            <li>
                                <h3>Free Wifi</h3>
                                <p>Guaranteed at all our Partner Hotels</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="item">
                    <a href="javascript:void(0)"><img src="images/left-side-banner.png"></a>
                </div>
            </div>
        </div>
    </div>
</div>