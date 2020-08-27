<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title> {{ CNF_APPNAME }} </title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
        
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="{{ asset('metronic/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/assets/demo/demo6/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('metronic/assets/css/fonts/awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('metronic/assets/css/icons.min.css') }}" rel="stylesheet" /> 
        <link href="{{ asset('metronic/assets/demo/demo6/base/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('metronic/assets/demo/demo6/base/new_style.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('metronic/assets/demo/demo6/base/styles.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		
        <!-- Favicon Start -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/favicon/apple-icon-57x57.png') }}" />
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/favicon/apple-icon-60x60.png') }}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/favicon/apple-icon-72x72.png') }}" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/favicon/apple-icon-76x76.png') }}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/favicon/apple-icon-114x114.png') }}" />
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon/apple-icon-120x120.png') }}" />
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/favicon/apple-icon-144x144.png') }}" />
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon/apple-icon-152x152.png') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-icon-180x180.png') }}" />
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/images/favicon/android-icon-192x192.png') }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" />
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/favicon/favicon-96x96.png') }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" />
        <link rel="manifest" href="{{ asset('assets/images/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/ms-icon-144x144.png') }}" />
        <meta name="theme-color" content="#ffffff" />
        <!-- Favicon END -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
        <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
        <link href="{{ asset('themes/emporium/daterangepickernew/daterangepicker.css') }}" rel="stylesheet">
        @yield('style')
        <style>
            .toast-success {
              background-color: green;
            }
        </style>
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
            
            
                <div class="col-12">
                    <div class="dropdown top-menu-s">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Edition <span><b>Germany</b></span>
                      </a>
                    
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <div class="row">
                          <div class="col-3">
                            <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                          </div>
                          <div class="col-3">
                            <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                          </div>
                          <div class="col-3">
                            <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                          </div>
                          <div class="col-3">
                            <a class="dropdown-item" href="#">Action<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Another<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            <a class="dropdown-item" href="#">Something<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            
            
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop m-header-head pb-10">
						<!-- BEGIN: Brand -->
                        <div class="m-stack__item m-stack__item--fluid m-stack__item--bottom pl-60">
						    <div class="m-stack__item m-stack__item--bottom m-brand__tools">
								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
						<!-- BEGIN: Responsive Header Menu Toggler -->
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
                        <!-- BEGIN: Topbar Toggler -->
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
								<!-- BEGIN: Topbar Toggler -->
							</div>
                            
                            
                            
                            
                            <div class="m-stack__item m-stack__item--bottom pl-25">
                                <a href="#" class="mr-2 menu-nav" data-nav="#menu-main">
                                  <i class="ico ico-dash"></i>
                                </a>
                                <a href="#" class="menu-nav" data-nav="#search-field">
                                  <i class="ico ico-search mr-2"></i>
                                </a>
                                <a href="#" class="menu-nav"  data-nav="#when_container">
                                  <i class="ico ico-calendar calendar-menu"></i>
                                </a>
                                <a href="#" class="menu-nav"  data-nav="#who_container">
                                  <i class="ico ico-profile-pp pp-menu"></i>
                                </a>
                            </div>
                            
                            
                            
                            	
						</div>
                        
						<div class="m-stack__item m-brand  m-brand--skin-light ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="{{ URL::to('dashboard')}}" class="m-brand__logo-wrapper">
                                        <?php /*<img src="{{ asset('metronic/assets/demo/demo6/media/img/logo/logo.svg') }}" alt="{{ CNF_APPNAME }}" style="max-width: 76px;" /> */ ?>			       <img src="{{ asset('metronic/assets/demo/demo6/media/img/logo/logo.svg') }}" alt="{{ CNF_APPNAME }}" style="max-width: 175px;" />	
									</a>
									<h3 class="m-header__title" style="display: none;"> {{ CNF_APPNAME }} </h3>
								</div>
								
							</div>
						</div>                   
                        
                        
						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid" id="m_header_nav">
							<div class="m-header__title" style="display: none;">
								<h3 class="m-header__title-text"> Applications </h3>
							</div>
							
                            @include('users_admin/traveller/layouts/horz_menu')
                            @include('users_admin/traveller/layouts/top_menu')				            
                            
						</div>
					</div>
                    
                    <div id="menu-main" class="d-flex align-items-center pl-25 menu-main">
                      <ul class="nav nav-left">
                        <li class="nav-item">
                          <a class="nav-link @@activeLoc" href="location-page.html">
                            <i class="ico ico-place"></i>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            <i class="ico ico-video"></i>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            <i class="ico ico-instagram"></i>
                          </a>
                        </li>
                      </ul>
                      <ul class="nav nav-text">
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            Dining
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            Yachts
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            Jet
                          </a>
                        </li>
                      </ul>
                      <ul class="nav nav-right ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="favorite.html">
                            <i class="ico ico-diamon"></i>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            <i class="ico ico-mixer"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                    
                    
                    <div id="search-field" class="search-field pl-25 menu-main">
                      <div class="row">
                        <div class="col">
                          <div class="input-group align-items-center">
                            <div class="input-group-prepend">
                              <i class="ico ico-search"></i>
                            </div>
                            <input type="text" class="form-control form-control-em border-0 where" id="inlineFormInputGroup"
                              placeholder="Where">
                          </div>
                        </div>
                      </div>
                      <div class="wherepopup">
                        <div class="whereinner">
                          <ul class="nav flex-column">
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Hotels</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Map</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Private Jet</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Cuisine</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Channel</span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">
                                <span class="city-l">New York</span> <span class="cat-l">Experiences</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    
                    <div class="when-container pl-25 menu-main" id="when_container">
                        <div class="content-em">
                          <!--<div class="container-fluid is-lg-full-when pt-5">-->
                          <div class="container-fluid is-lg-full-when">
                            <div class="row">
                              <div class="col-6">
                                <div class="is-left-pad-when">
                                  <div class="title-with-icon">
                                    <i class="ico ico-calendar"></i> <h2>When</h2>
                                  </div>
                                  <div class="range-calendar" id="calendar-pick" >
                                    <div id="daterangepicker-inline-container" class="daterangepicker-inline"></div>
                                    <input type="hidden" id="daterangepicker-inline">
                                    <div class="clearfix"></div>
                                  </div>                             
                                  
                                </div>
                              </div>
                              <div class="col-6 pl-0 pr--md-0">
                                <div class="img-left-when">
                                  <img src="{{ asset('metronic/assets/demo/demo6/media/img/af407b90485625.5e186bd4ca52b.jpg') }}" alt="" />
                                </div>                            
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="who-container pl-25 menu-main" id="who_container">
                        <div class="content-em">
                          <!--<div class="container-fluid is-lg-full-who pt-5"> -->
                          <div class="container-fluid is-lg-full-who">
                            <div class="row">
                              <div class="col-6">
                                <div class="is-left-pad-who">
                                  <div class="title-with-icon">
                                    <i class="ico ico-profile-pp"></i> <h2>WHO</h2>
                                  </div>
                                  <div class="filter-container-fl filter-guest-2" id="guest-pick" style="display: block;">
                                    <div class="guest-pick-container">
                                        <div class="guest-pick-header">
                                            <div class="row align-items-center">
                                                <div class="col-9">
                                                    <p class="mb-0"><b>Rooms</b></p>
                                                </div>
                                                <div class="col-3">
                                                    <div class="row field-count-guest align-items-center">
                                                        <button type="button" class="min-room disable">-</button>
                                                        <div class="col text-center">
                                                            <span class="mr-1 room-val">1 </span>
                                                        </div>
                                                        <button type="button" class="plus-room mr-3">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="guest-pick-body">
                                            <div class="row list-eoom">
                                                <div class="col-12 col-ews mb-5" id="room-1">
                                                    <p><b>Room 1</b></p>
                                                    <div class="row align-items-center py-2">
                                                        <div class="col-7">
                                                            <p class="mb-0"><b>Adults</b></p>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="row field-count-guest align-items-center">
                                                                <button type="button" class="min">-</button>
                                                                <div class="col text-center">
                                                                    <span class="mr-1 adult-val">1 </span>
                                                                </div>
                                                                <button type="button" class="plus mr-3">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center py-2">
                                                        <div class="col-7">
                                                            <p class="mb-0"><b>Childrens</b></p>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="row field-count-guest align-items-center">
                                                                <button type="button" class="min">-</button>
                                                                <div class="col text-center">
                                                                    <span class="mr-1 child-val">1 </span>
                                                                </div>
                                                                <button type="button" class="plus mr-3">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="guest-pick-footer">
                                            <div class="text-right">
                                                <a href="main-page.html" class="confirm-room">Confirm my Room</a>
                                            </div>
                                        </div>
                                    </div>              
                                    
                                </div>
                         
                                </div>
                              </div>
                              <div class="col-6 pl-0 pr--md-0">
                                <div class="img-left-when">
                                  <img src="{{ asset('metronic/assets/demo/demo6/media/img/60c5a787075247-1.5dad757ad76ab.jpg') }}" alt="">
                                </div>
                              </div>
                            </div>                        
                          </div>
                        </div>
                      </div>
                        
				</div>
                
                
                
                
                
                
                
			</header>
			<!-- END: Header -->		
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				
                <!-- BEGIN: Left Aside -->
                @include('users_admin/traveller/layouts/menu')
                <!-- END: Left Aside -->
                
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
                    
					<!-- BEGIN: Subheader -->
					@include('users_admin/traveller/layouts/sub_header')
					<!-- END: Subheader -->
                    
                    <!-- BEGIN: Subheader_search -->
                    @yield('subheader_search')
					<!-- END: Subheader_search -->
					<div class="m-content">
						@yield('content')
					</div>
				</div>
			</div>
			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								<strong>Copyright</strong> &copy; 2014-{{ date('Y')}} . {{ CNF_COMNAME }}  
							</span>
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">								
								<li class="m-nav__item m-nav__item">
									<a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center" data-placement="left">
										<i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
        
        <!-- begin::Quick Sidebar -->
        
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_login_register" role="tab">
							Login/Register
						</a>
					</li>
                    <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
							Communication
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
							Settings
						</a>
					</li>
                    <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_filter" role="tab">
							Filter
						</a>
					</li>
                    <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_preferences" role="tab">
							Preferences
						</a>
					</li>
                    <?php /*<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_language" role="tab">
							Language
						</a>
					</li> 
                    <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_currency" role="tab">
							Currency
						</a>
					</li>  
					 <li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">
							Logs
						</a>
					</li> */ ?>
				</ul>
				<div class="tab-content">
                    <div class="tab-pane active" id="m_quick_sidebar_tabs_login_register" role="tabpanel">
					   <a href="{{ URL::to('user/logout')}}" class="btn btn-primary"><i class="fa fa-power-off"></i> Logout</a>	
					</div>
					<div class="tab-pane" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__messages m-scrollable">
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="{{ asset('metronic/assets/app/media/img/users/user3.jpg') }}" alt=""/>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Hi Bob. What time will be the meeting ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Hi Megan. It's at 2.30PM
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="{{ asset('metronic/assets/app/media/img/users/user3.jpg') }}" alt=""/>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Will the development team be joining ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes sure. I invited them as well
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">
									2:30PM
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="{{ asset('metronic/assets/app/media/img/users/user3.jpg') }}"  alt=""/>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. For the Coca-Cola Mobile App project as well ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes, sure.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Please also prepare the quotation for the Loop CRM project as well.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">
									3:15PM
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-no-pic m--bg-fill-danger">
											<span>
												M
											</span>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. I will prepare it.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Thanks Megan. I will see you later.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="{{ asset('metronic/assets/app/media/img/users/user3.jpg') }}"  alt=""/>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Sure. See you in the meeting soon.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="m-messenger__seperator"></div>
							<div class="m-messenger__form">
								<div class="m-messenger__form-controls">
									<input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
								</div>
								<div class="m-messenger__form-tools">
									<a href="" class="m-messenger__form-attachment">
										<i class="la la-paperclip"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
                                        
					<div class="tab-pane" id="m_quick_sidebar_tabs_settings" role="tabpanel">
						<div class="m-list-settings m-scrollable">
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">
									Translation
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Language
									</span>
                                    <span class="m-list-settings__item-control">
                                    <select class="form-control">
                                        <option value="english">English</option>
                                        <option value="German">German</option>
                                    </select>	
                                    </span>								
								</div>
                            </div>
                            
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">
									Currency
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										Currency
									</span>
                                    <span class="m-list-settings__item-control">
                                        <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
            							<select class="form-control" id="preferred_currency" name="preferred_currency">
                                            <option value="EUR">Currency</option>
                                            @foreach($currencyList as $currencyCode => $currencyName)
                                                
                                                <option value="{{ $currencyCode }}" title="{{ $currencyName }}" >{{ $currencyName }}</option>                                        
                                            @endforeach
                                        </select>
                                        <span class="m-form__help">Select the currency in which we display system wide prices.</span> 	
                                    </span>								
								</div>
                            </div>
                            
							<div class="m-list-settings__group">
                                <?php 
                                    $arr_m = array();
                                    $objm = \DB::table('tb_user_setting_messages')->where('user_id', \Auth::user()->id)->get(); 
                                    if(!empty($objm)){
                                        foreach($objm as $item){
                                            $arr_m[] = $item->message_by;    
                                        }    
                                    }
                                ?>
								<div class="m-list-settings__heading">
									{{ Lang::get('profile.messages') }}
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.email') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="message_email" value="1" class="st-messages" <?php echo (in_array(1, $arr_m)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.push-messages') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="message_push_messages" value="2" class="st-messages" <?php echo (in_array(2, $arr_m)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.sms') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="message_email" value="3" class="st-messages" <?php echo (in_array(3, $arr_m)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>								
							</div>
	                        
                            
                            
                            <div class="m-list-settings__group">
                                <?php 
                                    $arr_r = array();
                                    $objr = \DB::table('tb_user_setting_reminders')->where('user_id', \Auth::user()->id)->get(); 
                                    if(!empty($objr)){
                                        foreach($objr as $item){
                                            $arr_r[] = $item->remind_by;    
                                        }    
                                    }
                                ?>
								<div class="m-list-settings__heading">
									{{ Lang::get('profile.reminders') }}
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.email') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="reminder_email" value="1" class="st-reminder" <?php echo (in_array(1, $arr_r)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.push-messages') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="reminder_push_messages" value="2" class="st-reminder" <?php echo (in_array(2, $arr_r)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.sms') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="reminder_sms" value="3" class="st-reminder" <?php echo (in_array(3, $arr_r)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>	
                                <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.phone-call') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="reminder_phone" value="4" class="st-reminder" <?php echo (in_array(4, $arr_r)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>								
							</div>
                            
                            <div class="m-list-settings__group">
                                <?php 
                                    $arr_eo = array();
                                    $objeo = \DB::table('tb_user_setting_exclusive_offers')->where('user_id', \Auth::user()->id)->get(); 
                                    if(!empty($objeo)){
                                        foreach($objeo as $item){
                                            $arr_eo[] = $item->exclusive_offer_send_by;    
                                        }    
                                    }
                                ?>
								<div class="m-list-settings__heading">
									{{ Lang::get('profile.exclusive-offers') }}
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.email') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="exclusive_offer_email" value="1" class="st-exc-offer" <?php echo (in_array(1, $arr_eo)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.push-messages') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="exclusive_offer_push_messages" value="2" class="st-exc-offer" <?php echo (in_array(2, $arr_eo)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.sms') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="exclusive_offer_sms" value="3" class="st-exc-offer" <?php echo (in_array(3, $arr_eo)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>	
                                <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.phone-call') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="exclusive_offer_phone" value="4" class="st-exc-offer" <?php echo (in_array(4, $arr_eo)) ? 'checked="checked"' : ''; ?>>
												<span></span>
											</label>
										</span>
									</span>
								</div>								
							</div>
                            
                            <div class="m-list-settings__group">
                                <?php 
                                    $arr_cs = array();
                                    $objcs = \DB::table('tb_user_setting_customer_services')->where('user_id', \Auth::user()->id)->get(); 
                                    if(!empty($objcs)){
                                        foreach($objcs as $item){
                                            $arr_cs[] = $item->customer_services_by;    
                                        }    
                                    }
                                ?>
								<div class="m-list-settings__heading">
									{{ Lang::get('profile.customer-services') }}
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.email') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" <?php echo (in_array(1, $arr_cs)) ? 'checked="checked"' : ''; ?> name="customer_service_email" value="1" class="st-cust-service">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.push-messages') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" <?php echo (in_array(2, $arr_cs)) ? 'checked="checked"' : ''; ?> name="customer_service_push_message" value="2" class="st-cust-service">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.sms') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="customer_services_sms" <?php echo (in_array(3, $arr_cs)) ? 'checked="checked"' : ''; ?> value="sms" value="3" class="st-cust-service">
												<span></span>
											</label>
										</span>
									</span>
								</div>	
                                <div class="m-list-settings__item">
									<span class="m-list-settings__item-label">
										{{ Lang::get('profile.phone-call') }}
									</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="customer_services_phone" <?php echo (in_array(4, $arr_cs)) ? 'checked="checked"' : ''; ?> value="4" class="st-cust-service">
												<span></span>
											</label>
										</span>
									</span>
								</div>								
							</div>
                            
                            
                            
						</div>
					</div>
                    
                    <div class="tab-pane" id="m_quick_sidebar_tabs_filter" role="tabpanel">
					   	
					</div>
                    
                    <div class="tab-pane" id="m_quick_sidebar_tabs_preferences" role="tabpanel">
					   	
					</div>
                    
                    <?php /* <div class="tab-pane" id="m_quick_sidebar_tabs_language" role="tabpanel">
					   <select class="form-control" id="lang_translation">
                            <option value="English" <?php echo (Session::get('lang')=="en") ? 'selected="selected"' : ""; ?>>English</option>
                            <option value="Deutsch" <?php echo Session::get('lang')=="Deutsch" ? 'selected="selected"' : ""; ?>>German</option>
                        </select>	
					</div>
                    
                    <div class="tab-pane" id="m_quick_sidebar_tabs_currency" role="tabpanel">
					    <div class="col-sm-12 col-md-7">
                        <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
							<select class="form-control" id="preferred_currency" name="preferred_currency">
                                <option value="EUR">Currency</option>
                                @foreach($currencyList as $currencyCode => $currencyName)
                                    
                                    <option value="{{ $currencyCode }}" title="{{ $currencyName }}" >{{ $currencyName }}</option>                                        
                                @endforeach
                            </select>
                            <span class="m-form__help">Select the currency in which we display system wide prices.</span> 
						</div>	
					</div> */ ?>
                    
					<?php /* <div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
						<div class="m-list-timeline m-scrollable">
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									System Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
											<span class="m-badge m-badge--warning m-badge--wide">
												important
											</span>
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoice received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
											<span class="m-badge m-badge--success m-badge--wide">
												resolved
											</span>
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
											<span class="m-badge m-badge--danger m-badge--wide">
												pending
											</span>
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Applications Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
											<span class="m-badge m-badge--info m-badge--wide">
												urgent
											</span>
										</a>
										<span class="m-list-timeline__time">
											7 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoices received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
											<span class="m-badge m-badge--info m-badge--wide">
												pending
											</span>
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Server Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
										</a>
										<span class="m-list-timeline__time">
											7 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											12 new users registered
										</a>
										<span class="m-list-timeline__time">
											Just now
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											System shutdown
										</a>
										<span class="m-list-timeline__time">
											11 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">
											New invoice received
										</a>
										<span class="m-list-timeline__time">
											20 mins
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">
											Database overloaded 89%
										</a>
										<span class="m-list-timeline__time">
											1 hr
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											System error
										</a>
										<span class="m-list-timeline__time">
											2 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											Production server down
										</a>
										<span class="m-list-timeline__time">
											3 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">
											Production server up
										</a>
										<span class="m-list-timeline__time">
											5 hrs
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">
											New order received
										</a>
										<span class="m-list-timeline__time">
											1117 hrs
										</span>
									</div>
								</div>
							</div>
						</div>
					</div> */ ?>
				</div>
			</div>
		</div>
        
		<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->
        
    	<!--begin::Base Scripts -->
		<script src="{{ asset('metronic/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('metronic/assets/demo/demo6/base/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('themes/emporium/js/moment.min.js') }}"></script>
        <script src="{{ asset('themes/emporium/daterangepickernew/daterangepicker.js') }}"></script>
		<!--end::Base Scripts -->  
        
        @yield('script')
		@yield('custom_js_script')
        <script src="{{ asset('metronic/assets/demo/demo6/base/main.js') }}" type="text/javascript"></script>
        <!--begin::Page Snippets -->
		<script src="{{ asset('metronic/assets/app/js/dashboard.js') }}" type="text/javascript"></script>
        
        <script>
            $(document).ready(function(){
                $("#top_menu_communication").click(function(){
                    $(".m-topbar__nav #m_quick_sidebar_toggle").trigger('click');
                    $('#m_quick_sidebar_tabs [href="#m_quick_sidebar_tabs_messenger"]').trigger('click');
                }); 
                
            });
            
            var picker = $('#daterangepicker-inline').daterangepicker({
                parentEl: "#daterangepicker-inline-container",
                autoApply: true,
                autoUpdateInput: false,
                locale:{
                    cancelLabel: 'Clear',
                }
            });
            
            picker.on('apply.daterangepicker', function(ev, picker) {
                $('.onrange').html(picker.startDate.format('DD-MM-YYYY') + ' -> ' + picker.endDate.format('DD-MM-YYYY'));
                $('.include-form').fadeIn("fast");
            });
            picker.data('daterangepicker').hide = function () {};
            picker.data('daterangepicker').show();
            
            
            $(document).on("change", "#lang_translation", function(){
                var _lang = $("#lang_translation").val();
                window.location.href = "{{URL::to('/')}}/changelang/"+_lang;   
            });
            
            
            $(document).on("click", ".st-messages", function(){
               var _val = $(this).val();               
               if($(this).is(":checked")){                    
                    addUpdateSetting('messages', _val, 1); 
               }else{                    
                    addUpdateSetting('messages', _val, 0);
               } 
            });
            $(document).on("click", ".st-reminder", function(){
               var _val = $(this).val();               
               if($(this).is(":checked")){                    
                    addUpdateSetting('reminders', _val, 1); 
               }else{                    
                    addUpdateSetting('reminders', _val, 0);
               } 
            });
            $(document).on("click", ".st-exc-offer", function(){
               var _val = $(this).val();               
               if($(this).is(":checked")){                    
                    addUpdateSetting('exOffers', _val, 1); 
               }else{                    
                    addUpdateSetting('exOffers', _val, 0);
               } 
            });
            $(document).on("click", ".st-cust-service", function(){
               var _val = $(this).val();               
               if($(this).is(":checked")){                    
                    addUpdateSetting('custServices', _val, 1); 
               }else{                    
                    addUpdateSetting('custServices', _val, 0);
               } 
            });
            function addUpdateSetting(type, mkey, mval){
                
               $.ajax({
        		  url: "{{ URL::to('addUpdateUserSetting')}}",
        		  type: "post",
        		  data: {'type':type, 'mkey': mkey, 'mval': mval},
                  dataType: 'json',
        		  success: function(data){ 
        		      if(data.status="success"){
        		          toastr.success(data.message);                          
        		      }    
		          }
              });
                
            }
                       
        </script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
