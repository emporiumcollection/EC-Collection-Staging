    <!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="keywords" content="@yield('meta_keywords') ">
			<meta name="description" content="@yield('meta_description') ">

			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			<title> @yield('title') | {{ CNF_APPNAME }}</title>
			<!-- Bootstrap -->
			<link href="{{ asset('themes/emporium/css/bootstrap.min.css') }}" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/owl.carousel.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/font-stylesheet.css') }}" rel="stylesheet">
			<link rel="stylesheet" href="{{ asset('themes/emporium/css/jquery.mCustomScrollbar.css') }}">

			<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->

			@section('head')
			@parent
			<link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
			@show

			<link href="{{ asset('themes/emporium/css/style.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/responsive.css') }}" rel="stylesheet">

			@section('custom_css')
			@parent
			@show

	   </head>
	   <body>
		  <div class="sidefixednav">
			 <ul>
				<!--<li class="hamburguricon">
				   <div class="block-content togglenav content">
					  <span></span>
					  <span> </span>
					  <span></span>
					  </div>
				   </li>-->
				<li class="loginSignPopupButton">
				   <a href="javascript:void(0)" class="clicktologin" style="display:none;"><i class="fa fa-lock"></i></a>
				   <a href="javascript:void(0)" class="login-user"><i class="fa fa-user"></i></a>
				   <ul class="user-setting">
					  <li><a href="javascript:void(0)">Profile</a></li>
					  <li><a href="javascript:void(0)">Change Possword</a></li>
					  <li><a href="javascript:void(0)">Logout</a></li>
				   </ul>
				</li>
				<li class="calander"><a href="javascript:void(0)"><i class="fa fa-calendar"></i></a></li>
			 </ul>
		  </div>
		  <div class="homerightmenu contactfixed">
			 <ul>
				<li><a href="tel:+19344511317"><i class="fa fa-phone"></i> +1 934 451 1317</a></li>
				<li><a href="mailto: reservations@emporium-voyage.com"><i class="fa fa-envelope"></i> reservations@emporium-voyage.com</a></li>
			 </ul>
		  </div>

		   @section('sidebar')
			@parent
             <div class="mobilemenu">
                 <div class="block-content togglenav content active mobilenavclosebtn">
                    <span></span>
                    <span> </span>
                    <span></span>
                 </div>
                 <div class="mobilemenu-inner">
                    <div class="mobilemainnav openmobilemenu">
                       <div class="mobilenavheader"><a href="index.html"><img src="{{ asset('themes/emporium/images/design-location-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/></a></div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control" id="search"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                             <div id="filtersearchpopup" style="display:none;">
                                <ul>
                                   <li>
                                      <a class="searchresultdata" href="javascript:void(0)" id="destinationsresult"><i class="iconsheet icon-destinations"></i> Destinations <span>(3)</span></a>
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
                          <li><a href="javascript:void(0)" class="searchourcollectonlink">SEARCH OUR COLLECTION</a></li>
                          <li><a href="javascript:void(0)" id="searchbydate">SEARCH BY DATE</a></li>
                          <li><a href="javascript:void(0)" id="selectdestination">SELECT YOUR DESTINATION</a></li>
                          <li><a href="javascript:void(0)" id="selectexperience">SELECT YOUR EXPERIENCE</a></li>
                          <li><a href="javascript:void(0)">PERSONALIZED SERVICE</a></li>
                          <li><a href="javascript:void(0)" id="companynav">COMPANY</a></li>
                       </ul>
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
                       <div class="bottomlink">Already have an account? <a class="loginSecForMob" href="javascript:void(0)">Login</a><br/>or<br/>Don't have Emporium Voyage account <a class="registerSecForMob" href="javascript:void(0)">Register here</a></div>
                    </div>
                    <div class="destinationresultnav">
                       <div class="mobilenavheader">
                          <h3>DESTINATIONS</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li><a href="https://www.emporium-voyage.com/membership_hotel">Berlin</a></li>
                          <li><a href="javascript:void(0)">London</a></li>
                          <li><a href="javascript:void(0)">Maldives</a></li>
                       </ul>
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
                    <div class="searchourcollectonnav">
                       <div class="mobilenavheader">
                          <h3>SEARCH OUR COLLECTION</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">HOTELS</div>
                                </a>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">YACHTS</div>
                                </a>
                             </div>
                          </li>
                       </ul>
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
                    <div class="searchbydatenav">
                       <div class="mobilenavheader">
                          <h3>SEARCH BY DATE</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
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
                                   <select class="calenderselectbox" name="day">
                                      <option>10</option>
                                      <option>11</option>
                                      <option>12</option>
                                      <option>13</option>
                                      <option>14</option>
                                   </select>
                                </li>
                                <li>
                                   <label>MONTH</label>
                                   <select class="calenderselectbox" name="month">
                                      <option>JANUARY</option>
                                      <option>FEBRUARY</option>
                                      <option>MARCH</option>
                                      <option>APRIL</option>
                                      <option>MAY</option>
                                   </select>
                                </li>
                                <li>
                                   <label>YEAR</label>
                                   <select class="calenderselectbox" name="year">
                                      <option>2018</option>
                                      <option>2019</option>
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
                                   <select class="calenderselectbox" name="day">
                                      <option>10</option>
                                      <option>11</option>
                                      <option>12</option>
                                      <option>13</option>
                                      <option>14</option>
                                   </select>
                                </li>
                                <li>
                                   <label>MONTH</label>
                                   <select class="calenderselectbox" name="month">
                                      <option>JANUARY</option>
                                      <option>FEBRUARY</option>
                                      <option>MARCH</option>
                                      <option>APRIL</option>
                                      <option>MAY</option>
                                   </select>
                                </li>
                                <li>
                                   <label>YEAR</label>
                                   <select class="calenderselectbox" name="year">
                                      <option>2018</option>
                                      <option>2019</option>
                                   </select>
                                </li>
                             </ul>
                             <button class="searchButton btn" type="button">Search</button>
                             <div class="clearfix"></div>
                          </li>
                       </ul>
                       <div class="bottomlink text-center">View, Modify or Cancel your Booking<br/> <a href="javascript:void(0)" class="loginSecForMob">Login</a></div>
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
                    <div class="selectdestinationnav">
                       <div class="mobilenavheader">
                          <h3>SEARCH YOUR DESTINATION</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li>
                             <p>From the posh, sun-soaked beaches along the Indian Ocean to the epoch heights of the Himalayas, Emporium-Voyage is your ideal, vogue vacation planner!</p>
                          </li>
                          <li><a href="javascript:void(0)" id="selectafrica">AFRICA</a></li>
                          <li><a href="javascript:void(0)">ASIA</a></li>
                          <li><a href="javascript:void(0)">EUROP</a></li>
                          <li><a href="javascript:void(0)">CARRIBEAN ISLANDS</a></li>
                          <li><a href="javascript:void(0)">INDIAN OCEAN</a></li>
                          <li><a href="javascript:void(0)">OCEANIA</a></li>
                          <li><a href="javascript:void(0)">THE AMERICAS</a></li>
                       </ul>
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
                    <div class="selectafricanav">
                       <div class="mobilenavheader">
                          <h3>HOME</h3>
                          <a href="javascript:void(0)" class="homelinknav backtodestinationnav"><i class="fa fa-angle-left"></i> BACK TO DESTINATION</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <img src="images/mountain-image.jpg" alt=""/>
                                <div class="headingoverlay">AFRICA</div>
                             </div>
                          </li>
                          <li>
                             <ul class="mobilesublinks">
                                <li><a href="javascript:void(0)" id="selectafricanavchild">SOUTHERN AFRICA</a></li>
                                <li><a href="javascript:void(0)">NORTHERN AFRICA</a></li>
                                <li><a href="javascript:void(0)">EASTERN AFRICA</a></li>
                             </ul>
                          </li>
                       </ul>
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
                    <div class="selectafricanavchild">
                       <div class="mobilenavheader">
                          <h3>HOME</h3>
                          <a href="javascript:void(0)" class="homelinknav backtoselectafricanav"><i class="fa fa-angle-left"></i> BACK TO DESTINATION</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <img src="images/mountain-image.jpg" alt=""/>
                                <div class="headingoverlay">SOUTHERN AFRICA</div>
                             </div>
                          </li>
                          <li>
                             <ul class="mobilesublinks">
                                <li><a href="javascript:void(0)">GAUTENG</a></li>
                             </ul>
                          </li>
                       </ul>
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
                    <div class="selectexperiencenav">
                       <div class="mobilenavheader">
                          <h3>SELECT YOUR EXPERIENCE</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">BEACH HOTELS</div>
                                </a>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">GREEN HOTELS</div>
                                </a>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">URAN HOTELS</div>
                                </a>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">SPA HOTELS</div>
                                </a>
                             </div>
                          </li>
                          <li>
                             <div class="navheadimage">
                                <a href="javascript:void(0)">
                                   <img src="images/mountain-image.jpg" alt=""/>
                                   <div class="headingoverlay">INFINITY POOL</div>
                                </a>
                             </div>
                          </li>
                       </ul>
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
                    <div class="companynav">
                       <div class="mobilenavheader">
                          <h3>COMPANY</h3>
                          <a href="javascript:void(0)" class="homelinknav backtohomelink"><i class="fa fa-angle-left"></i> HOME</a>
                       </div>
                       <ul class="mobilemenulist">
                          <li>
                             <div class="mobile-leftsearch">
                                <input type="text" class="form-control"/>
                                <button type="button"><i class="fa fa-search"></i></button>
                             </div>
                          </li>
                          <li><a href="https://www.emporium-voyage.com/membership_hotel">Become a Member Hotel</a></li>
                          <li><a href="terms-and-conditions.html">Terms and Conditions</a></li>
                          <li><a href="https://www.emporium-voyage.com/Impressum">Imprint</a></li>
                       </ul>
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
              </div>
           @show
		  <div class="page-container">

			 <header id="header">
				<!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
				<div class="logo-wrapper">
				   <a href="{{url('/')}}"><img src="{{ asset('themes/emporium/images/design-location-logo.png') }}" alt="Emporium Voyage"/></a>
				</div>
				<div class="header-content">
				   <div class="col-lg-12 header-search">
						  @include('frontend.themes.emporium.layouts.sections.top_search_bar')

				   </div>
				</div>
			 </header>
			  @yield('content')
              @section('sidebar')
                  @parent
                 @include('frontend.themes.emporium.layouts.sections.footer')
              @show
		  </div>


		@include('frontend.themes.emporium.layouts.sections.login')
		@include('frontend.themes.emporium.layouts.sections.cookie')
		  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
		  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		  <script src="{{ asset('themes/emporium/js/jquery.min.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/bootstrap.min.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/owl.carousel.js') }}"></script>
		  <!-- custom scrollbar plugin -->
		  <script src="{{ asset('themes/emporium/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
		  @section('javascript')
			@parent
		  <!-- Date Picker js -->
		  <script src="{{ asset('themes/emporium/js/moment.min.js') }}"></script>

		  <script src="{{ asset('themes/emporium/js/daterangepicker.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/single-date.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/custom.js') }}"></script>
		  @show
		  @section('custom_js')
			@parent
		  <script type="text/javascript">
			 $(document).ready(function () {
				 $(".cookie-bar-hide-btn").click(function () {
					 $(".bootom-cookie-bar-outer").hide();
				 });

				 $(".cookie-bar-hide-btn").click(function () {
					 $(".bootom-cookie-bar-outer").hide();
				 });
					 checkCookie();
				 });
				 function setCookie(cname, cvalue, exdays) {
					 var d = new Date();
					 d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
					 var expires = "expires=" + d.toUTCString();
					 document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
				 }

				 function checkCookie() {
					 var username = getCookie("cookie-bar");
					 if (username == "") {
						 setCookie('cookie-bar', '1', 1);
						 $(".bootom-cookie-bar-outer").show();
					 }
				 }
				 function getCookie(cname) {
					 var name = cname + "=";
					 var decodedCookie = decodeURIComponent(document.cookie);
					 var ca = decodedCookie.split(';');
					 for (var i = 0; i < ca.length; i++) {
						 var c = ca[i];
						 while (c.charAt(0) == ' ') {
							 c = c.substring(1);
						 }
						 if (c.indexOf(name) == 0) {
							 return c.substring(name.length, c.length);
						 }
					 }
					 return "";
				 }
		  </script>
		  @show
	   </body>
	</html>