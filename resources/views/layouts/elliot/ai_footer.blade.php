                   @if(!isset($ps_main_page_name))
                    <!--Sections-->
                    <section id ="instagran" class="sections-instagram">
                        <div class="full-width">
							<div data-is data-is-api="{{ URL::to('runInsta')}}" data-is-source="{{(!empty($propertyDetail) && $propertyDetail['data']->social_instagram!='')? $propertyDetail['data']->social_instagram : '@socialdesignlocations777' }}" data-is-rows="1" data-is-columns="7"></div>
                        </div>
                    </section>
                    <!--Sections-->	
					@endif
					<!-- social start-->
					<section style="margin-top:20px;" id="social">
                        <div class="full-width">
							<div id="social-stream"></div>
                        </div>
                    </section>
						
						<!-- social end-->

                    <div class="container">
                        <div class="col-md-12 pre-footer-sec-align">
                            <p>Follow @Emporium-Voyage</p>
                            <p>Premium Lifestyle Portfolio World Wide<br/>Carefully created to ensure the ultimate luxury</p>
                        </div>
                    </div>
					
					
                    <!--Footer-->
                    <div class="footer">
                        <div class="container">
                            <div class="col-md-12 col-sm-12 col-xs-12 footer-padding-0">
                                <div class="col-md-5 col-sm-5 col-xs-12  footer-padding-0">
                                    {{--*/ $footer_menus = SiteHelpers::menus('footer') /*--}}
									@foreach ($footer_menus as $fmenu)
										<div class="col-md-4 col-sm-4 col-xs-12 {{($fmenu!=$footer_menus[0]) ? 'footer-padding-0' : ''}}">
											<div class="row-">
												<div class="accordion res-design-footer">
													@if(CNF_MULTILANG ==1 &&  isset($fmenu['menu_lang']['title'][Session::get('lang')]))
														{{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
													@else
														{{$fmenu['menu_name']}}
													@endif</div>
												<div class="panel">
												@if(count($fmenu['childs']) > 0)
													<ul class="footer-nav-menu footer-nav-menu-align">
														@foreach ($fmenu['childs'] as $fmenu2)
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
												@endif
												</div>
											</div>
										</div>
									@endforeach
                            
                                </div>
<!--                                <div class="col-md-1 col-sm-1 col-xs-12"></div>-->
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <p class="footer-nav-menu-harding footer-res-margin-align">About EMPORIUM VOYAGE</p>
                                    <p class="footer-about-us-des">{{$about_text->content}}
                                    </p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <p class="footer-nav-menu-harding footer-res-margin-align">Newsletter</p>
                                    <p class="subscription-line">Subscribe and get 10% off on your next reservation</p>
                                    <form action="http://just-emarketing.com/app/index.php/lists/fb5156qrasf4a/subscribe" method="post" accept-charset="utf-8" target="_blank">
										<div class="">
									
										<input type="text" class="form-control newsletter-style" name="EMAIL" placeholder="First Name" value="" required="">
										</div>

										<div class="">
										
										<input type="text" class="form-control newsletter-style" name="FNAME" placeholder="Last Name" value="">
										</div>

										<div class="">
										
										<input type="text" class="form-control newsletter-style" name="LNAME" placeholder="E-mail Adress" value="">
										</div>

										<div class="">
										<button type="submit" class="nesletter-submit-btn">Subscribe</button>
										</div>
										
									</form>
									
<!--									<p class="footer-nav-menu-harding footer-res-margin-align" style="margin-top: 25px;">Unsubscribe Newsletter</p>
									<form action="http://just-emarketing.com/app/index.php/lists/fb5156qrasf4a/unsubscribe" method="post" accept-charset="utf-8" target="_blank">

									<div class="">
										
										<input type="text" class="form-control newsletter-style" name="EMAIL" placeholder="Email Address" value="" required="">
									</div>
									
									<div class="">
										<button type="submit" class="nesletter-submit-btn" style="width: 35%;">Unsubscribe</button>
									</div>
									<div class="clearfix"> </div>

								</form>-->
                                </div>
                            </div>
                            <div class="col-md-12 copy-right-sec">
                                <p>{{$footer_text->content}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        @include('layouts/elliot/ai_featured-hotel-popup')
        @include('layouts/elliot/ai_gallery-popup')
        @include('layouts/elliot/ai_product-popup')
        @include('layouts/elliot/ai_search-page')

        <!--Social share start-->

<!--        <div style="position:relative;">
            <div class="social-share">
                <a class="trigger-click-on-share" href="#">SHARE</a>
                <div class="open-social-share">
                    <a class="social-share-btn" href="#">FOLLOW</a>
                    <ul style="display: none;">
                        <li>
                            <a href="#">Twitter</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <a href="#">Pintrest</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->

        <!--Social share end-->

        <!--JS funcitons-->
        <!--HTML for book now page start here-->

        @include('layouts/elliot/ai_booking-page')
        @include('layouts/elliot/ai_newsletter')
        @include('layouts/elliot/ai_cookie-bar')
        
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" >Top</a>
        <script>
            $(document).ready(function () {
                $(".open-social-share").click(function (event) {
                    event.preventDefault();
                    $(this).find("ul").toggle();
                    $(this).toggleClass("open");
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                $("#back-to-top").click(function (event) {
                    event.preventDefault();
                    $("html, body").animate({scrollTop: 0}, "slow");
                });
                $(".trigger-click-on-video-pop-up").click(function (event) {
                    event.preventDefault();
                    $(".open-video-pop-up").trigger("click");
                });
                $(".trigger-click-on-share").click(function (event) {
                    event.preventDefault();
                    $(".click-share-btn").trigger("click");
                });
            });
        </script>
        <script>
            /* Toggle between adding and removing the "active" and "show" classes when the user clicks on one of the "Section" buttons. The "active" class is used to add a background color to the current button when its belonging panel is open. The "show" class is used to open the specific accordion panel */
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].onclick = function () {
                    this.classList.toggle("active");
                    this.nextElementSibling.classList.toggle("show");
                }
            }
            
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
            function goBack() {
                window.history.back();
            }
        </script>
        <script type="text/javascript" src="{{ asset('sximo/assets/js/slideshow.min.js')}}"></script>
        
		
		<!-- instagram -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.runtime.min.js"></script>
		<link rel="stylesheet" href="{{ asset('sximo/instajs/instashow/jquery.instashow.css')}}">
		<script src="{{ asset('sximo/instajs/instashow/jquery.instashow.js')}}"></script>
		<!-- social stream js  -->
		<!--<link rel="stylesheet" type="text/css" href="{{ asset('sximo/jquery_social_stream/inc/layout.css')}}" media="all" />
		<link rel="stylesheet" type="text/css" href="{{ asset('sximo/jquery_social_stream/css/dcsns_wall.css')}}" media="all" />
		<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/inc/js/jquery.plugins.js')}}"></script>
		<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/inc/js/jquery.site.js')}}"></script>
		<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/js/jquery.social.stream.wall.1.8.js')}}"></script>
		<script type="text/javascript" src="{{ asset('sximo/jquery_social_stream/js/jquery.social.stream.1.6.1.min.js')}}"></script>-->
		<style>
			#instaShowGallery_1 .instashow-gallery-media-cover {
				background: rgba(0, 0, 0, 0.9) !important;
			}
			#instaShowPopup_1 .instashow-popup-media-info-author {
				color: #000 !important;
			}
			#instaShowPopup_1 a.instashow-popup-media-info-original {
				display: none;
			}
			#instaShowGallery_1 .instashow-gallery-control-arrow::before, #instaShowGallery_1 .instashow-gallery-control-arrow::after {
				background: #000;
			}
			
			.editorial-custom-footer-style .newsletter-style {
				width: 45%;
				margin-top: 8px;
				float: left;
				margin-right: 15px;
				box-shadow: none;
				border-radius: 0;
				font-size: 11px;
			}
			
			.form-control:focus {
				border-color: #7a7a7a;
			}
		</style>
		@if(!empty($propertyDetail))
		<script type="text/javascript">
			/*jQuery(document).ready(function($){
				$('#social-stream').dcSocialStream({
					feeds: {
						twitter: {
							id: "{{$propertyDetail['data']->social_twitter}}",
							url:"{{ URL::to('sximo/jquery_social_stream/twitter.php')}}"
						},
						facebook: {
							id: "{{$propertyDetail['data']->social_facebook}}",
							out: "intro,thumb,text,user,share",
							url: "{{ URL::to('sximo/jquery_social_stream/facebook.php')}}"
						},
						google: {
							id: "{{$propertyDetail['data']->social_google}}"
						},
						vimeo: {
							id: "{{$propertyDetail['data']->social_vimeo}}"
						},
						youtube: {
							id: "{{$propertyDetail['data']->social_youtube}}",
							thumb: "medium",
							out: "intro,thumb,title,user,share"
						},
						pinterest: {
							id: "{{$propertyDetail['data']->social_pinterest}}",
							url:"{{ URL::to('sximo/jquery_social_stream/rss.php')}}"
						}
					},
					rotate: {
						delay: 0
					},
					twitterId: 'designchemical',
					control: false,
					filter: true,
					wall: true,
					center: true,
					cache: false,
					max: 'limit',
					limit: 5,
					iconPath: 'images/dcsns-dark/',
					imagePath: 'images/dcsns-dark/',
					style: {
						layout: 'modern',
						colour: 'light'
					},
				});
							 
			});*/
		</script>
		@endif

