@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Dashboard
@stop
    
@section('subheader_search')
    <div class="m-subheader-search">
        <h2 class="m-subheader-search__title">
    		Recent Bookings
    		<span class="m-subheader-search__desc">
    			Onling Bookings Management
    		</span>
    	</h2>
    	<form class="m-form">
    		<div class="m-grid m-grid--ver-desktop m-grid--desktop">
    			<div class="m-grid__item m-grid__item--middle">
    				<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-large m-input-icon--right">
    					<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="Booking Number">
    					<span class="m-input-icon__icon m-input-icon__icon--right">
    						<span>
    							<i class="la la-puzzle-piece"></i>
    						</span>
    					</span>
    				</div>
    				<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
    					<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="From">
    					<span class="m-input-icon__icon m-input-icon__icon--right">
    						<span>
    							<i class="la la-calendar-check-o"></i>
    						</span>
    					</span>
    				</div>
    				<div class="m-input-icon m-input-icon--fixed m-input-icon--fixed-md m-input-icon--right">
    					<input type="text" class="form-control form-control-lg m-input m-input--pill" placeholder="To">
    					<span class="m-input-icon__icon m-input-icon__icon--right">
    						<span>
    							<i class="la la-calendar-check-o"></i>
    						</span>
    					</span>
    				</div>
    			</div>
    			<div class="m-grid__item m-grid__item--middle">
    				<div class="m--margin-top-20 m--visible-tablet-and-mobile"></div>
    				<button type="button" class="btn m-btn--pill m-subheader-search__submit-btn">
    					Search Bookings
    				</button>
    				<a href="#" class="m-subheader-search__link m-link">
    					Advance Search
    				</a>
    			</div>
    		</div>
    	</form>
    </div>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
@stop

@section('content')    
<div class="parent_hotel_name">
    <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					Discerning Traveller | {{ Session::get('fid') }}
				</h3>
			</div>
		</div>
	</div>

    <!-- Second Row -->
	<div class="row">
		<div class="col-sm-12 col-md-4 col-xl-4">
			
            
            <!--begin:: Widgets/Announcements 2-->
			<div class="m-portlet m--bg-danger m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								{{ Session::get('fid') }}
							</h3>
						</div>
					</div>							
				</div>
				<div class="m-portlet__body">
					<!--begin::Widget 7-->
					<div class="m-widget7 m-widget7--skin-dark">								
						<div class="m-widget7__user">
							<div class="m-widget7__user-img">
								<img class="m-widget7__img" src="{{asset('metronic/assets/app/media/img/users/emp.png')}}" alt="">
							</div>
							<div class="m-widget7__info">
								<span class="m-widget7__username">
									Hotel Name
								</span>
							</div>
						</div>
                        <div class="m-widget7__desc">
							Welcome to the emporium Voyage World. 
Emporium Voyage is a prestige organisation seeking to serve your every need. Navigate through your dashboard and connect with your account execitive with any questions you may have.
						</div>
						<div class="m-widget7__button">
							<a class="m-btn m-btn--pill btn btn-accent" href="{{URL::to('user/profile')}}" role="button">
								GO TO MY PROFILE
							</a>
						</div>
					</div>
					<!--end::Widget 7-->
				</div>
			</div>
			<!--end:: Widgets/Announcements 2-->
		
            
            
		</div>
        <div class="col-sm-12 col-md-8 col-xl-8">
            @if(!empty($pageslider))
            <div id="Carousel" class="carousel slide">
                 
                <ol class="carousel-indicators">
                    @foreach($pageslider as $key => $slider_row)
                    <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                    @endforeach
                </ol>
                 
                <!-- Carousel items -->
                <div class="carousel-inner">
                @foreach($pageslider as $key => $slider_row)    
                <div class="item {{($key == 0)? 'active' : ''}}">
                	<div class="row">
                	  <div class="col-md-12">
                        <a href="{{$slider_row->slider_link}}" class="thumbnail">                            
                            <div class="b2c-banner-text">{{$slider_row->slider_title}}</div>
                            <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}" style="max-width:100%;">
                        </a>
                      </div>                	  
                	</div><!--.row-->
                </div><!--.item-->
                @endforeach 
                 
                </div><!--.carousel-inner-->
                  <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
            </div><!--.Carousel-->
            @endif
            <?php /* @if(!empty($pageslider))
                <section class="sliderSection termConditionSlider">
                    <div id="restaurantSlider" class="carousel" data-ride="carousel">
                    <!-- Indicators -->
                    <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($pageslider as $key => $slider_row)
                              <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
                                <div class="carousel-caption">
                                  <a href="{{$slider_row->slider_link}}">
                                  <h1>{{$slider_row->slider_title}}</h1>
                                  <h4>{{$slider_row->slider_description}}</h4>    
                                  </a>                  
                                </div>
                              </div>
                            @endforeach
                        </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
                      <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                    </a>
                    <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
                      <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                    </a>
                    </div>
                    <span class="scrollNextDiv"><a class="scrollpage" href="#membershpipStepSec">Scroll Down</a></span>
                </section>
            @endif */ ?>
        </div>
	               
                				
	</div>
</div>

<!-- Second Row -->
<div class="parent_my preferences">           
    <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					My Reservations
				</h3>
			</div>
		</div>
	</div> 
   
    <div class="row">
		
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
        		<div class="m-portlet__head m-portlet__head--fit">
        			<div class="m-portlet__head-caption">
        				<div class="m-portlet__head-title">
        					<h3 class="m-portlet__head-text m--font-light">
        						My Reservations
        					</h3>
        				</div>
        			</div>
        			<div class="m-portlet__head-tools">
        				<ul class="m-portlet__nav">
        					<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
        						<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light a_white">
        							2018
        						</a>
        						<div class="m-dropdown__wrapper" style="display: none;">
        							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        							<div class="m-dropdown__inner">
        								<div class="m-dropdown__body">
        									<div class="m-dropdown__content">
        										<ul class="m-nav">
        											<li class="m-nav__section m-nav__section--first">
        												<span class="m-nav__section-text">
        													Reports
        												</span>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-share"></i>
        													<span class="m-nav__link-text">
        														Activity
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-chat-1"></i>
        													<span class="m-nav__link-text">
        														Messages
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-info"></i>
        													<span class="m-nav__link-text">
        														FAQ
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
        													<span class="m-nav__link-text">
        														Support
        													</span>
        												</a>
        											</li>
        										</ul>
        									</div>
        								</div>
        							</div>
        						</div>
        					</li>
        				</ul>
        			</div>
        		</div>
        		<div class="m-portlet__body">
        			<div class="m-widget28">
        				<div class="m-widget28__pic m-portlet-fit--sides"></div>
        				<div class="m-widget28__container">
        					<!-- begin::Nav pills -->
        					<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link active a_white" data-toggle="pill" href="#menu11">
        								<img src="{{Url::to('images/hotel_reservation.jpg')}}" class="dash-res-img" /> 
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link a_white" data-toggle="pill" href="#menu21">
        								<span class="day_size_big">15</span> Aug 2018
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link a_white" data-toggle="pill" href="#menu31">
        								<span class="day_size_big">25</span> Aug 2018
        							</a>
        						</li>
        					</ul>
        					<!-- end::Nav pills --> 
                            <!-- begin::Tab Content -->
        					<div class="m-widget28__tab tab-content">
        						<div id="menu11" class="m-widget28__tab-container tab-pane active">
        							<div class="m-widget28__tab-items">
                                        <div class="m-widget28__tab-item">
        									<span>
        									</span>
        									<span>
        										<i class="flaticon-cart"></i> Book Again
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Name
        									</span>
        									<span>
        										Studio Munich / Room Name
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Booking Confirmation Number
        									</span>
        									<span>
        										D330-1234562546
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Total Charges
        									</span>
        									<span>
        										USD 1,250.000
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Hotel Terms
        									</span>
        									<span>
        										Show hotel terms 
        									</span>
                                            
                                            <a href="#" id="show_more">Show More</a>
        								</div>
        							</div>
        						</div>
        					</div>
        					<!-- end::Tab Content -->
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--head-overlay m-portlet--full-height   m-portlet--rounded-force">
        		<div class="m-portlet__head m-portlet__head--fit">
        			<div class="m-portlet__head-caption">
        				<div class="m-portlet__head-title">
        					<h3 class="m-portlet__head-text m--font-light">
        						Event Reservations
        					</h3>
        				</div>
        			</div>
        			<div class="m-portlet__head-tools">
        				<ul class="m-portlet__nav">
        					<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
        						<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill m-btn btn-outline-light m-btn--hover-light">
        							2018
        						</a>
        						<div class="m-dropdown__wrapper" style="display: none;">
        							<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
        							<div class="m-dropdown__inner">
        								<div class="m-dropdown__body">
        									<div class="m-dropdown__content">
        										<ul class="m-nav">
        											<li class="m-nav__section m-nav__section--first">
        												<span class="m-nav__section-text">
        													Reports
        												</span>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-share"></i>
        													<span class="m-nav__link-text">
        														Activity
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-chat-1"></i>
        													<span class="m-nav__link-text">
        														Messages
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-info"></i>
        													<span class="m-nav__link-text">
        														FAQ
        													</span>
        												</a>
        											</li>
        											<li class="m-nav__item">
        												<a href="" class="m-nav__link">
        													<i class="m-nav__link-icon flaticon-lifebuoy"></i>
        													<span class="m-nav__link-text">
        														Support
        													</span>
        												</a>
        											</li>
        										</ul>
        									</div>
        								</div>
        							</div>
        						</div>
        					</li>
        				</ul>
        			</div>
        		</div>
        		<div class="m-portlet__body">
        			<div class="m-widget28">
        				<div class="m-widget28__pic m-portlet-fit--sides"></div>
        				<div class="m-widget28__container">
        					<!-- begin::Nav pills -->
        					<ul class="m-widget28__nav-items nav nav-pills nav-fill" role="tablist">
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link active" data-toggle="pill" href="#menu11">
        								<img src="{{Url::to('images/event_reservation.jpg')}}" class="dash-res-img" /> 
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link" data-toggle="pill" href="#menu21">
        								<span class="day_size_big">15</span> Aug 2018
        							</a>
        						</li>
        						<li class="m-widget28__nav-item nav-item">
        							<a class="nav-link" data-toggle="pill" href="#menu31">
        								<span class="day_size_big">25</span> Aug 2018
        							</a>
        						</li>
        					</ul>
        					<!-- end::Nav pills --> 
                            <!-- begin::Tab Content -->
        					<div class="m-widget28__tab tab-content">
        						<div id="menu11" class="m-widget28__tab-container tab-pane active">
        							<div class="m-widget28__tab-items">
                                        <div class="m-widget28__tab-item">
        									<span>
        									</span>
        									<span>
        										<i class="flaticon-cart"></i> Book Again
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Event Name
        									</span>
        									<span>
        										Studio Munich / Room Name
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Booking Confirmation Number
        									</span>
        									<span>
        										D330-1234562546
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Total Charges
        									</span>
        									<span>
        										USD 1,250.000
        									</span>
        								</div>
        								<div class="m-widget28__tab-item">
        									<span>
        										Event Terms
        									</span>
        									<span>
        										Show Event Terms 
        									</span>
                                            
                                            <a href="#" id="show_more_event_terms">Show More</a>
        								</div>
        							</div>
        						</div>
        					</div>
        					<!-- end::Tab Content -->
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text m--font-light">
								My Preferences
							</h3>
						</div>
					</div>
					<div class="m-portlet__head-tools" style="display: none;">
						<ul class="m-portlet__nav">
							<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
								<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
									<i class="fa fa-genderless m--font-light"></i>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav">
													<li class="m-nav__section m-nav__section--first">
														<span class="m-nav__section-text">
															Quick Actions
														</span>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-share"></i>
															<span class="m-nav__link-text">
																Activity
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Messages
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-info"></i>
															<span class="m-nav__link-text">
																FAQ
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Support
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
															Cancel
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="m-portlet__body">
					<div class="m-widget17">
						<div class="m-widget17__visual m-widget17__visual--chart m-portlet-fit--top m-portlet-fit--sides m--bg-danger">
							<div class="m-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
								<canvas id="m_chart_activities" width="325" height="216" class="chartjs-render-monitor" style="display: block; width: 325px; height: 216px;"></canvas>
							</div>
						</div>
						<div class="m-widget17__stats">
							<div class="m-widget17__items m-widget17__items-col1">
								<div class="m-widget17__item">
									<span class="m-widget17__icon">
										
									</span>
									<span class="m-widget17__subtitle">
										Preferences 1
									</span>
									<span class="m-widget17__desc">
										<a href="#">View</a> <a href="#">Edit</a>
									</span>
								</div>
								<div class="m-widget17__item">
									<span class="m-widget17__icon">
										
									</span>
									<span class="m-widget17__subtitle">
										Preferences 3
									</span>
									<span class="m-widget17__desc">
										<a href="#">View</a> <a href="#">Edit</a>
									</span>
								</div>
							</div>
							<div class="m-widget17__items m-widget17__items-col2">
								<div class="m-widget17__item">
									<span class="m-widget17__icon">
										
									</span>
									<span class="m-widget17__subtitle">
										Preferences 2
									</span>
									<span class="m-widget17__desc">
									    <a href="#">View</a> <a href="#">Edit</a>	
									</span>
								</div>
								<div class="m-widget17__item">
									<span class="m-widget17__icon">
										
									</span>
									<span class="m-widget17__subtitle">                                        
										<i class="flaticon-plus"></i>
									</span>
									<span class="m-widget17__desc">
										Add Prefernces
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
        
    </div>
</div>
<!-- End Row -->    

<!-- Third Row -->   

<div class="parent_reservation_ans_distribution">
   <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					My Settings
				</h3>
			</div>
		</div>
	</div> 
    
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
            
            <div class="row">
                <div class="setting-box">
                    <a href="{{ URL::to('user/profile') }}">																	
            			<span class="m-nav__link-text">
            				My Profile
            			</span>
            		</a>
                </div>
                <div class="setting-box">
                    <a href="{{ URL::to('user/settings') }}">																	
            			<span class="m-nav__link-text">
            				Account Settings
            			</span>
            		</a>
                </div>
                <div class="setting-box">
                    <a href="{{ URL::to('user/invite')}}">
            			<i class="m-nav__link-icon"></i>
            			<span class="m-nav__link-text">
            				Guest Invitations
            			</span>
            		</a>
                </div>
                <div class="setting-box">
                    <a href="#" id="dash_communication">
            			<i class="m-nav__link-icon"></i>
            			<span class="m-nav__link-text">
            				Communication
            			</span>
            		</a>
                </div>
                <div class="setting-box">
                    <a href="{{ URL::to('user/companion')}}">
            			<i class="m-nav__link-icon"></i>
            			<span class="m-nav__link-text">
            				Companions
            			</span>
            		</a>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<!-- End Third Row -->

@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    
    <style>
    .carousel {
  position: relative;
}

.carousel-inner {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.carousel-inner > .item {
  position: relative;
  display: none;
  -webkit-transition: 0.6s ease-in-out left;
          transition: 0.6s ease-in-out left;
}

.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
  display: block;
  height: auto;
  max-width: 100%;
  line-height: 1;
}

.carousel-inner > .active,
.carousel-inner > .next,
.carousel-inner > .prev {
  display: block;
}

.carousel-inner > .active {
  left: 0;
}

.carousel-inner > .next,
.carousel-inner > .prev {
  position: absolute;
  top: 0;
  width: 100%;
}

.carousel-inner > .next {
  left: 100%;
}

.carousel-inner > .prev {
  left: -100%;
}

.carousel-inner > .next.left,
.carousel-inner > .prev.right {
  left: 0;
}

.carousel-inner > .active.left {
  left: -100%;
}

.carousel-inner > .active.right {
  left: 100%;
}

.carousel-control {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 15%;
  font-size: 20px;
  color: #ffffff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.carousel-control.left {
  background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.0001)));
  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.5) 0), color-stop(rgba(0, 0, 0, 0.0001) 100%));
  background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
}

.carousel-control.right {
  right: 0;
  left: auto;
  background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.0001)), to(rgba(0, 0, 0, 0.5)));
  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.0001) 0), color-stop(rgba(0, 0, 0, 0.5) 100%));
  background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
}

.carousel-control:hover,
.carousel-control:focus {
  color: #ffffff;
  text-decoration: none;
  opacity: 0.9;
  filter: alpha(opacity=90);
}

.carousel-control .icon-prev,
.carousel-control .icon-next,
.carousel-control .glyphicon-chevron-left,
.carousel-control .glyphicon-chevron-right {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 5;
  display: inline-block;
}

.carousel-control .icon-prev,
.carousel-control .icon-next {
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  font-family: serif;
}

.carousel-control .icon-prev:before {
  content: '\2039';
}

.carousel-control .icon-next:before {
  content: '\203a';
}

.carousel-indicators {
  position: absolute;
  bottom: 10px;
  left: 50%;
  z-index: 15;
  width: 60%;
  padding-left: 0;
  margin-left: -30%;
  text-align: center;
  list-style: none;
}

.carousel-indicators li {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 1px;
  text-indent: -999px;
  cursor: pointer;
  border: 1px solid #ffffff;
  border-radius: 10px;
}

.carousel-indicators .active {
  width: 12px;
  height: 12px;
  margin: 0;
  background-color: #ffffff;
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 20px;
  padding-bottom: 20px;
  color: #ffffff;
  text-align: center;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
}

.carousel-caption .btn {
  text-shadow: none;
}

@media screen and (min-width: 768px) {
  .carousel-control .icon-prev,
  .carousel-control .icon-next {
    width: 30px;
    height: 30px;
    margin-top: -15px;
    margin-left: -15px;
    font-size: 30px;
  }
  .carousel-caption {
    right: 20%;
    left: 20%;
    padding-bottom: 30px;
  }
  .carousel-indicators {
    bottom: 20px;
  }
}
    .carousel-control {
        position: absolute;
    }
    .scrollNextDiv {
        position: absolute;
        bottom: 60px;
        left: 61%;
        text-decoration: none;
        text-transform: uppercase;
        animation-fill-mode: none;
        animation-duration: unset;                
    }
    .carousel-caption a{
        text-decoration: none;
    }
    .carousel-caption a{
        text-decoration: none;
    }
    .carousel-caption a h4{        
        color: #ABA07C;
    }
    .m-widget2 .m-widget2__item .m-widget2__desc{
        vertical-align: middle !important;
    }
    .m-task-link{ text-decoration: none; color: #575962;}
    .m-task-link:hover{ text-decoration: none; color: #575962;}
    
    .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
        margin-top: 0rem;
    }
    .m-widget7 .m-widget7__user{
        margin-bottom: 2rem;
    }
    .m-widget7 .m-widget7__desc{
        margin-top: 2rem;
        margin-bottom: 3em;
    }
    .m-subheader-search{
        margin-top: 20px;
    }
    .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
        width: 4.9rem;
    }
    .m-nav-grid>.m-nav-grid__row>.m-nav-grid__item{
        padding: .75rem .75rem;
    }
    
.carousel {
    margin-bottom: 0;
    /*padding: 0 40px 30px 40px;*/
}
/* The controlsy */
.carousel-control {
	left: 30px;
    height: 40px;
	width: 40px;
    background: none repeat scroll 0 0 #222222;
    border: 4px solid #FFFFFF;
    border-radius: 23px 23px 23px 23px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}
.carousel-control.right {
	right: 30px;
}
/* The indicators */
.carousel-indicators {
	right: 50%;
	top: auto;
	bottom: -10px;
	margin-right: -19px;
    display: none;
}
/* The colour of the indicators */
.carousel-indicators li {
	background: #cecece;
}
.carousel-indicators .active {
background: #428bca;
}
    </style>
@endsection

{{-- For custom style  --}}
@section('custom_js_script')
    @parent      
    <script>
        $(document).ready(function(){
           $("#dash_communication").click(function(){
                $(".m-topbar__nav #m_quick_sidebar_toggle").trigger('click');
                $('#m_quick_sidebar_tabs [href="#m_quick_sidebar_tabs_messenger"]').trigger('click');
           });
           $('#Carousel').carousel({
        interval: 5000
    }) 
        });
    </script>
@endsection
@section('script')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/radar.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/tools/polarScatter/polarScatter.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
	<script src="//www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    <script src="{{ asset('metronic/assets/app/js/charts.js') }}"></script>    
@stop