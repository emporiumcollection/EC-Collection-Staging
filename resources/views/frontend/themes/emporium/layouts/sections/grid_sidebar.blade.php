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
                        <input type="text" class="form-control" data-action="gobal-search"/>
                        <button type="button"><i class="fa fa-search"></i></button>
                    </div>
                    <div id="filtersearchpopup" data-option="gobal-search" style="display:none;">
                        <ul>
                            <li>
                                <a class="searchresultdata cursor" data-action="gobal-destinations">
                                    <i class="iconsheet icon-destinations"></i> Destinations <span>(0)</span>
                                </a>
                            </li>
                            <li>
                                <a class="searchresultdata cursor" data-action="gobal-collections">
                                    <i class="iconsheet icon-collections"></i> Collections <span>(0)</span>
                                </a>
                            </li>
                            <li>
                                <a class="searchresultdata cursor" data-action="gobal-restaurant">
                                    <i class="iconsheet icon-restaurant"></i> Restaurant <span>(0)</span>
                                </a>
                            </li>
                            <li>
                                <a class="searchresultdata cursor" data-action="gobal-bar">
                                    <i class="iconsheet icon-bar"></i> Bar <span>(0)</span>
                                </a>
                            </li>
                            <li>
                                <a class="searchresultdata cursor" data-action="gobal-spa">
                                    <i class="iconsheet icon-spa"></i> Spa <span>(0)</span>
                                </a>
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
                <li><a class="cursor" data-action="select-filter">FILTER BY PRICE</a></li>
                <li><a class="cursor" data-action="select-collection">SEARCH OUR COLLECTION</a></li>
                <li><a class="cursor" data-action="search-by-date">SEARCH BY DATE</a></li>
                <li><a class="cursor" data-action="select-destination" data-id="0">SELECT YOUR DESTINATION</a></li>
                <li><a class="cursor" data-action="select-experience" >SELECT YOUR EXPERIENCE</a></li>
                <!--li><a href="javascript:void(0)" >PERSONALIZED SERVICE</a></li-->
                <li><a class="cursor" data-action="company">COMPANY</a></li>
            </ul>
            <ul class="mobilemenulist hide" data-option="search-our-collection">
                {{--*/ $colection_menus = SiteHelpers::menus('top') /*--}}
				@if(!empty($colection_menus))
					@foreach ($colection_menus as $cmenu)
						<li>
							<div class="navheadimage">
								<a @if($cmenu['menu_type'] =='external') href="{{ URL::to($cmenu['url'])}}" @else href="{{ URL::to($cmenu['module'])}}" @endif>
									@if($cmenu['image']!='')
										<img src="{{ URL::to('uploads/menu_imgs/'.$cmenu['image']) }}" alt=""/>
									@else
										<img src="{{ asset('themes/emporium/images/mountain-image.jpg') }}" alt=""/>
									@endif
									<div class="headingoverlay">
										@if(CNF_MULTILANG ==1 && isset($cmenu['menu_lang']['title'][Session::get('lang')]))
										  {{ $cmenu['menu_lang']['title'][Session::get('lang')] }}
										@else
										  {{$cmenu['menu_name']}}
										@endif
									</div>
								</a>
							</div>
						</li>
					@endforeach
				@endif
            </ul>
            <ul class="mobilemenulist hide" data-option="selected-option-list">
            </ul>
            {{-- For Gobal Search List --}}
            <ul class="mobilemenulist hide" data-option="dest-option-list">
            </ul>
            <ul class="mobilemenulist hide" data-option="collection-option-list">
            </ul>
            <ul class="mobilemenulist hide" data-option="resto-option-list">
            </ul>
            <ul class="mobilemenulist hide" data-option="bar-option-list">
            </ul>
            <ul class="mobilemenulist hide" data-option="spa-option-list">
            </ul>
            {{-- End  Gobal Search List --}}
            @if (!Auth::check())

                <div class="bottomlink" data-option="global">Members? <a class="loginSecForMob"
                                                                         href="javascript:void(0)">Login</a><br/>or<br/>Become a Member <a class="registerSecForMob" href="javascript:void(0)">Register here</a>
                </div>
            @endif
            <div class="hide"  data-option="search-by-date">
                <form action="{{url('search')}}" method="get">
                    <input type="hidden" name="action" value="bydate">
                    {{--*/
                            $setDateArvStr = date('j-n-Y');
                            $setDateDepStr = date('j-n-Y',strtotime('+1 day'));
                            $setDateArvArr = explode('-',$setDateArvStr);
                            $setDateDepArr = explode('-',$setDateDepStr);
                            $setDateDefaultArv = date('d-m-Y');
                            $setDateDefaultDep = date('d-m-Y',strtotime('+1 day'));
                    /*--}}
                    @if(isset($_GET['action']) && $_GET['action']=='bydate' )
                        @if(isset($_GET['arrive']) && $_GET['arrive']!='')
                            {{--*/
                                $setDateArvStr = date('j-n-Y',strtotime($_GET['arrive']));
                                $setDateArvArr = explode('-',$setDateArvStr);
                               $setDateDefaultArv = date('d-m-Y',strtotime($_GET['arrive']));

                            /*--}}
                        @endif
                        @if(isset($_GET['departure']) && $_GET['departure']!='')
                            {{--*/

                               $setDateDepStr = date('j-n-Y',strtotime($_GET['departure']));
                               $setDateDepArr = explode('-',$setDateDepStr);
                               $setDateDefaultDep = date('d-m-Y',strtotime($_GET['departure']));
                            /*--}}
                        @endif
                    @endif
                    <input name="arrive" type="hidden" value="{{$setDateDefaultArv}}">
                    <input name="departure" type="hidden" value="{{$setDateDefaultDep}}">
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
                Booking<br/> @if (!Auth::check())<a href="javascript:void(0)" class="loginSecForMob">Login</a>@endif</div>
            <div class="hide" data-option="select-filter">
                <div class="rangeslidercontainer">
                      <div class="slidecontainer">
                            <input type="range" min="1" max="6000" value="0" class="slider" id="myRange">
                            <div class="sliderlegend">Hight - Low</div>
                            <select name="currencyOption" class="form-control">
                                  <option value="EUR">Currency</option>
                                  <option value="AED" title="AED-د.إ">AED-د.إ
                                  </option>
                                  <option value="AFN" title="AFN-Af">AFN-Af
                                  </option>
                                  <option value="ALL" title="ALL-Lek">ALL-Lek
                                  </option>
                                  <option value="AMD" title="AMD-">AMD-
                                  </option>
                                  <option value="ANG" title="ANG-ƒ">ANG-ƒ
                                  </option>
                                  <option value="AOA" title="AOA-Kz">AOA-Kz
                                  </option>
                                  <option value="ARS" title="ARS-$">ARS-$
                                  </option>
                                  <option value="AUD" title="AUD-$">AUD-$
                                  </option>
                                  <option value="AWG" title="AWG-ƒ">AWG-ƒ
                                  </option>
                                  <option value="AZN" title="AZN-ман">AZN-ман
                                  </option>
                                  <option value="BAM" title="BAM-KM">BAM-KM
                                  </option>
                                  <option value="BBD" title="BBD-$">BBD-$
                                  </option>
                                  <option value="BDT" title="BDT-৳">BDT-৳
                                  </option>
                                  <option value="BGN" title="BGN-лв">BGN-лв
                                  </option>
                                  <option value="BHD" title="BHD-.د.ب">BHD-.د.ب
                                  </option>
                                  <option value="BIF" title="BIF-FBu">BIF-FBu
                                  </option>
                                  <option value="BMD" title="BMD-$">BMD-$
                                  </option>
                                  <option value="BND" title="BND-$">BND-$
                                  </option>
                                  <option value="BOB" title="BOB-$b">BOB-$b
                                  </option>
                                  <option value="BRL" title="BRL-R$">BRL-R$
                                  </option>
                                  <option value="BSD" title="BSD-$">BSD-$
                                  </option>
                                  <option value="BTC" title="BTC-">BTC-
                                  </option>
                                  <option value="BTN" title="BTN-Nu.">BTN-Nu.
                                  </option>
                                  <option value="BWP" title="BWP-P">BWP-P
                                  </option>
                                  <option value="BYN" title="BYN-">BYN-
                                  </option>
                                  <option value="BZD" title="BZD-BZ$">BZD-BZ$
                                  </option>
                                  <option value="CAD" title="CAD-$">CAD-$
                                  </option>
                                  <option value="CDF" title="CDF-FC">CDF-FC
                                  </option>
                                  <option value="CHF" title="CHF-CHF">CHF-CHF
                                  </option>
                                  <option value="CLF" title="CLF-">CLF-
                                  </option>
                                  <option value="CLP" title="CLP-$">CLP-$
                                  </option>
                                  <option value="CNH" title="CNH-">CNH-
                                  </option>
                                  <option value="CNY" title="CNY-¥">CNY-¥
                                  </option>
                                  <option value="COP" title="COP-$">COP-$
                                  </option>
                                  <option value="CRC" title="CRC-₡">CRC-₡
                                  </option>
                                  <option value="CUC" title="CUC-">CUC-
                                  </option>
                                  <option value="CUP" title="CUP-⃌">CUP-⃌
                                  </option>
                                  <option value="CVE" title="CVE-$">CVE-$
                                  </option>
                                  <option value="CZK" title="CZK-Kč">CZK-Kč
                                  </option>
                                  <option value="DJF" title="DJF-Fdj">DJF-Fdj
                                  </option>
                                  <option value="DKK" title="DKK-kr">DKK-kr
                                  </option>
                                  <option value="DOP" title="DOP-RD$">DOP-RD$
                                  </option>
                                  <option value="DZD" title="DZD-دج">DZD-دج
                                  </option>
                                  <option value="EGP" title="EGP-£">EGP-£
                                  </option>
                                  <option value="ERN" title="ERN-">ERN-
                                  </option>
                                  <option value="ETB" title="ETB-Br">ETB-Br
                                  </option>
                                  <option value="EUR" title="EUR-€">EUR-€
                                  </option>
                                  <option value="FJD" title="FJD-$">FJD-$
                                  </option>
                                  <option value="FKP" title="FKP-£">FKP-£
                                  </option>
                                  <option value="GBP" title="GBP-£">GBP-£
                                  </option>
                                  <option value="GEL" title="GEL-ლ">GEL-ლ
                                  </option>
                                  <option value="GGP" title="GGP-">GGP-
                                  </option>
                                  <option value="GHS" title="GHS-¢">GHS-¢
                                  </option>
                                  <option value="GIP" title="GIP-£">GIP-£
                                  </option>
                                  <option value="GMD" title="GMD-D">GMD-D
                                  </option>
                                  <option value="GNF" title="GNF-FG">GNF-FG
                                  </option>
                                  <option value="GTQ" title="GTQ-Q">GTQ-Q
                                  </option>
                                  <option value="GYD" title="GYD-$">GYD-$
                                  </option>
                                  <option value="HKD" title="HKD-$">HKD-$
                                  </option>
                                  <option value="HNL" title="HNL-L">HNL-L
                                  </option>
                                  <option value="HRK" title="HRK-kn">HRK-kn
                                  </option>
                                  <option value="HTG" title="HTG-G">HTG-G
                                  </option>
                                  <option value="HUF" title="HUF-Ft">HUF-Ft
                                  </option>
                                  <option value="IDR" title="IDR-Rp">IDR-Rp
                                  </option>
                                  <option value="ILS" title="ILS-₪">ILS-₪
                                  </option>
                                  <option value="IMP" title="IMP-">IMP-
                                  </option>
                                  <option value="INR" title="INR-₹">INR-₹
                                  </option>
                                  <option value="IQD" title="IQD-ع.د">IQD-ع.د
                                  </option>
                                  <option value="IRR" title="IRR-﷼">IRR-﷼
                                  </option>
                                  <option value="ISK" title="ISK-kr">ISK-kr
                                  </option>
                                  <option value="JEP" title="JEP-£">JEP-£
                                  </option>
                                  <option value="JMD" title="JMD-J$">JMD-J$
                                  </option>
                                  <option value="JOD" title="JOD-JD">JOD-JD
                                  </option>
                                  <option value="JPY" title="JPY-¥">JPY-¥
                                  </option>
                                  <option value="KES" title="KES-KSh">KES-KSh
                                  </option>
                                  <option value="KGS" title="KGS-лв">KGS-лв
                                  </option>
                                  <option value="KHR" title="KHR-៛">KHR-៛
                                  </option>
                                  <option value="KMF" title="KMF-CF">KMF-CF
                                  </option>
                                  <option value="KPW" title="KPW-₩">KPW-₩
                                  </option>
                                  <option value="KRW" title="KRW-₩">KRW-₩
                                  </option>
                                  <option value="KWD" title="KWD-د.ك">KWD-د.ك
                                  </option>
                                  <option value="KYD" title="KYD-$">KYD-$
                                  </option>
                                  <option value="KZT" title="KZT-лв">KZT-лв
                                  </option>
                                  <option value="LAK" title="LAK-₭">LAK-₭
                                  </option>
                                  <option value="LBP" title="LBP-£">LBP-£
                                  </option>
                                  <option value="LKR" title="LKR-₨">LKR-₨
                                  </option>
                                  <option value="LRD" title="LRD-$">LRD-$
                                  </option>
                                  <option value="LSL" title="LSL-L">LSL-L
                                  </option>
                                  <option value="LYD" title="LYD-ل.د">LYD-ل.د
                                  </option>
                                  <option value="MAD" title="MAD-د.م.">MAD-د.م.
                                  </option>
                                  <option value="MDL" title="MDL-L">MDL-L
                                  </option>
                                  <option value="MGA" title="MGA-Ar">MGA-Ar
                                  </option>
                                  <option value="MKD" title="MKD-ден">MKD-ден
                                  </option>
                                  <option value="MMK" title="MMK-K">MMK-K
                                  </option>
                                  <option value="MNT" title="MNT-₮">MNT-₮
                                  </option>
                                  <option value="MOP" title="MOP-MOP$">MOP-MOP$
                                  </option>
                                  <option value="MRO" title="MRO-UM">MRO-UM
                                  </option>
                                  <option value="MRU" title="MRU-">MRU-
                                  </option>
                                  <option value="MUR" title="MUR-₨">MUR-₨
                                  </option>
                                  <option value="MVR" title="MVR-.ރ">MVR-.ރ
                                  </option>
                                  <option value="MWK" title="MWK-MK">MWK-MK
                                  </option>
                                  <option value="MXN" title="MXN-$">MXN-$
                                  </option>
                                  <option value="MYR" title="MYR-RM">MYR-RM
                                  </option>
                                  <option value="MZN" title="MZN-MT">MZN-MT
                                  </option>
                                  <option value="NAD" title="NAD-$">NAD-$
                                  </option>
                                  <option value="NGN" title="NGN-₦">NGN-₦
                                  </option>
                                  <option value="NIO" title="NIO-C$">NIO-C$
                                  </option>
                                  <option value="NOK" title="NOK-kr">NOK-kr
                                  </option>
                                  <option value="NPR" title="NPR-₨">NPR-₨
                                  </option>
                                  <option value="NZD" title="NZD-$">NZD-$
                                  </option>
                                  <option value="OMR" title="OMR-﷼">OMR-﷼
                                  </option>
                                  <option value="PAB" title="PAB-B/.">PAB-B/.
                                  </option>
                                  <option value="PEN" title="PEN-S/.">PEN-S/.
                                  </option>
                                  <option value="PGK" title="PGK-K">PGK-K
                                  </option>
                                  <option value="PHP" title="PHP-₱">PHP-₱
                                  </option>
                                  <option value="PKR" title="PKR-₨">PKR-₨
                                  </option>
                                  <option value="PLN" title="PLN-zł">PLN-zł
                                  </option>
                                  <option value="PYG" title="PYG-Gs">PYG-Gs
                                  </option>
                                  <option value="QAR" title="QAR-﷼">QAR-﷼
                                  </option>
                                  <option value="RON" title="RON-lei">RON-lei
                                  </option>
                                  <option value="RSD" title="RSD-Дин.">RSD-Дин.
                                  </option>
                                  <option value="RUB" title="RUB-руб">RUB-руб
                                  </option>
                                  <option value="RWF" title="RWF-ر.س">RWF-ر.س
                                  </option>
                                  <option value="SAR" title="SAR-﷼">SAR-﷼
                                  </option>
                                  <option value="SBD" title="SBD-$">SBD-$
                                  </option>
                                  <option value="SCR" title="SCR-₨">SCR-₨
                                  </option>
                                  <option value="SDG" title="SDG-£">SDG-£
                                  </option>
                                  <option value="SEK" title="SEK-kr">SEK-kr
                                  </option>
                                  <option value="SGD" title="SGD-$">SGD-$
                                  </option>
                                  <option value="SHP" title="SHP-£">SHP-£
                                  </option>
                                  <option value="SLL" title="SLL-Le">SLL-Le
                                  </option>
                                  <option value="SOS" title="SOS-S">SOS-S
                                  </option>
                                  <option value="SRD" title="SRD-$">SRD-$
                                  </option>
                                  <option value="SSP" title="SSP-">SSP-
                                  </option>
                                  <option value="STD" title="STD-Db">STD-Db
                                  </option>
                                  <option value="STN" title="STN-">STN-
                                  </option>
                                  <option value="SVC" title="SVC-$">SVC-$
                                  </option>
                                  <option value="SYP" title="SYP-£">SYP-£
                                  </option>
                                  <option value="SZL" title="SZL-L">SZL-L
                                  </option>
                                  <option value="THB" title="THB-฿">THB-฿
                                  </option>
                                  <option value="TJS" title="TJS-TJS">TJS-TJS
                                  </option>
                                  <option value="TMT" title="TMT-m">TMT-m
                                  </option>
                                  <option value="TND" title="TND-د.ت">TND-د.ت
                                  </option>
                                  <option value="TOP" title="TOP-T$">TOP-T$
                                  </option>
                                  <option value="TRY" title="TRY-₤">TRY-₤
                                  </option>
                                  <option value="TTD" title="TTD-$">TTD-$
                                  </option>
                                  <option value="TWD" title="TWD-NT$">TWD-NT$
                                  </option>
                                  <option value="TZS" title="TZS-">TZS-
                                  </option>
                                  <option value="UAH" title="UAH-₴">UAH-₴
                                  </option>
                                  <option value="UGX" title="UGX-USh">UGX-USh
                                  </option>
                                  <option value="USD" title="USD-$">USD-$
                                  </option>
                                  <option value="UYU" title="UYU-$U">UYU-$U
                                  </option>
                                  <option value="UZS" title="UZS-лв">UZS-лв
                                  </option>
                                  <option value="VEF" title="VEF-Bs">VEF-Bs
                                  </option>
                                  <option value="VND" title="VND-₫">VND-₫
                                  </option>
                                  <option value="VUV" title="VUV-VT">VUV-VT
                                  </option>
                                  <option value="WST" title="WST-WS$">WST-WS$
                                  </option>
                                  <option value="XAF" title="XAF-FCFA">XAF-FCFA
                                  </option>
                                  <option value="XAG" title="XAG-">XAG-
                                  </option>
                                  <option value="XAU" title="XAU-">XAU-
                                  </option>
                                  <option value="XCD" title="XCD-$">XCD-$
                                  </option>
                                  <option value="XDR" title="XDR-">XDR-
                                  </option>
                                  <option value="XOF" title="XOF-">XOF-
                                  </option>
                                  <option value="XPD" title="XPD-">XPD-
                                  </option>
                                  <option value="XPF" title="XPF-F">XPF-F
                                  </option>
                                  <option value="XPT" title="XPT-">XPT-
                                  </option>
                                  <option value="YER" title="YER-﷼">YER-﷼
                                  </option>
                                  <option value="ZAR" title="ZAR-R">ZAR-R
                                  </option>
                                  <option value="ZMW" title="ZMW-">ZMW-
                                  </option>
                                  <option value="ZWL" title="ZWL-Z$">ZWL-Z$
                                  </option>
                            </select>
                            <p>$<span id="pricevalue">1</span> - $0</p>
                            <div class="clearfix"></div>
                      </div>
                </div>
            </div>     

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
                {{--*/ $sidebarads = CommonHelper::getSidebarAds('grid_sidebar', 'Hotel') /*--}}
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