@extends('users_admin.metronic.layouts.app')

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
    
    <!--Begin::Section_portlet-->
        <div class="parent_hotel_name">
            <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							Hotel Name
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
										Hotel Name
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
				<div class="col-sm-12 col-md-4 col-xl-4">
					<!--begin:: Widgets/Authors Profit-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Quick Navigation
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools" style="display: none;">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
										<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
											All
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
							<div class="m-widget4">
								<div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Property Management
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="{{ URL::to('properties')}}">View</a>
										</span>
									</span>
								</div>
								<div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Reservation Management
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
								<div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Sales Reports
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
								<div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											View Modules
										</span>										
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
								<div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Cancelations
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
                                <div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Arrivals & Departures
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
                                
                                <div class="m-widget4__item">									
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Advertising
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											<a href="#">View</a>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Authors Profit-->
				</div>                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    
                    
                    
                    
                    
                    
                    
                    <!--begin:: Packages-->
								<div class="m-portlet  m-portlet--bordered-semi   m-portlet--full-height ">
									<div class="m-portlet__head m--padding-top-20">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Packages
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools" style="display: none;">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn  ">
														All
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
									<div class="m-portlet__body m-portlet__body--no-padding">
										<!--begin::Widget 30-->
                                        <?php
                                            $group_id = \Session::get('gid');
                                            $packages = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->get();
                                        ?>
										<div class="m-widget30">
											<div class="m-widget_head">
												<div class="m-widget_head-owlcarousel-items owl-carousel">
                                                    <?php if(count($packages) > 0){
                                                        foreach($packages as $package){
                                                    ?>
                                                            <div class="m-widget_head-owlcarousel-item carousel">
        														<span>
        															<?php echo $package->package_title; ?>
        														</span>														
        													</div>
                                                    <?php        
                                                            }
                                                        }
                                                    ?>
													
												</div>
											</div>
											<div class="m-widget_body">
												<div class="m-widget_body-owlcarousel-items owl-carousel" id="m_widget_body_owlcarousel_items">
													<?php 
                                                    if(count($packages) > 0){                                                        
                                                    ?>  
                                                    @foreach($packages as $key=>$package)                                                  
                                                    <div class="m-widget_body-owlcarousel-item carousel">
														<div class="m-widget_body-items">
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">	
                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
																</div>
																<div class="m-widget_body-item-desc ">
																	<span>
                                                                        {{$package->package_description}}
																	</span>																	
																</div>
															</div>																														
														</div>
													</div>
                                                    @endforeach
                                                    <?php                                                            
                                                    }
                                                    ?>
												</div>
											</div>
										</div>
										<!--end::Widget 30-->
									</div>
								</div>
								<!--end:: Packages-->
                    
                </div>
                				
			</div>
        </div>
    <!-- Third Row -->
        <div class="parent_notifications">           
            <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							Notifications
						</h3>
					</div>
				</div>
			</div> 
           
			    <div class="row">
					<div class="col-sm-12 col-md-8 col-xl-8">
                        <div class="row">
                        <div class="col-sm-12">
						<!--begin:: Widgets/Tasks -->
						<div class="m-portlet m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Tasks
										</h3>
									</div>
								</div>								
							</div>
							<div class="m-portlet__body">
								<div class="tab-content">
									<div class="tab-pane active" id="m_widget2_tab1_content">
										<div class="m-widget2">
											<div class="m-widget2__item m-widget2__item--primary">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="{{URL::to('user/profile')}}" class="m-task-link">Complete your profile</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
											<div class="m-widget2__item m-widget2__item--warning">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="{{URL::to('hotel/package')}}" class="m-task-link">Subscribe to Membership Packages</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
											<div class="m-widget2__item m-widget2__item--brand">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="{{URL::to('whoiam')}}" class="m-task-link">Add your Hotel(s)</a> 
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
											<div class="m-widget2__item m-widget2__item--success">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="{{URL::to('user/profile')}}" class="m-task-link">Add your Rooms & Seasons</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
											<div class="m-widget2__item m-widget2__item--danger">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="{{URL::to('user/profile')}}" class="m-task-link">Add your Rates</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
											<div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Add your Restaurant's, Bar & Spa</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
                                            
                                            
                                            
                                            <div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Add your Events & Special Occassions</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
                                            <div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Review the Quality Assurance Guidelines</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
                                            <div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Like Emporium Voyage</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
                                            <div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Invite Guest to Elite Members Club</a>
													</span>													
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>
                                            <div class="m-widget2__item m-widget2__item--info">
												<div class="m-widget2__checkbox">
													<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
														<input type="checkbox">
														<span></span>
													</label>
												</div>
												<div class="m-widget2__desc">
													<span class="m-widget2__text">
														<a href="#" class="m-task-link">Review Hotel Marketing Packages</a>
													</span>
												</div>
												<div class="m-widget2__actions">
													<div class="m-widget2__actions-nav">
														<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
															<a href="#" class="m-dropdown__toggle">
																<i class="la la-ellipsis-h"></i>
															</a>
															<div class="m-dropdown__wrapper">
																<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																<div class="m-dropdown__inner">
																	<div class="m-dropdown__body">
																		<div class="m-dropdown__content">
																			<ul class="m-nav">
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
														</div>
													</div>
												</div>
											</div>                                            
                                            
                                            
                                            
                                            
                                            
										</div>
									</div>
									<div class="tab-pane" id="m_widget2_tab2_content"></div>
									<div class="tab-pane" id="m_widget2_tab3_content"></div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Tasks -->
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-12">
                        
						<!--begin:: Widgets/Announcements 1-->
						<div class="m-portlet m--bg-accent m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Announcements
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
											<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
												<i class="la la-ellipsis-h m--font-light"></i>
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
								<!--begin::Widget 7-->
								<div class="m-widget7 m-widget7--skin-dark">
									<div class="m-widget7__desc">
										Lorem ipsum dolor sit amet,consectetuer edipiscing elit,sed diam nonummy euismod tinciduntut laoreet doloremagna
									</div>
									<div class="m-widget7__user">
										<div class="m-widget7__user-img">
											<img class="m-widget7__img" src="{{asset('metronic/assets/app/media/img/users/100_3.jpg')}}" alt="">
										</div>
										<div class="m-widget7__info">
											<span class="m-widget7__username">
												Dan Bold
											</span>
											<br>
											<span class="m-widget7__time">
												3 days ago
											</span>
										</div>
									</div>
									<div class="m-widget7__button">
										<a class="m-btn m-btn--pill btn btn-danger" href="#" role="button">
											All Feeds
										</a>
									</div>
								</div>
								<!--end::Widget 7-->
							</div>
						</div>
						<!--end:: Widgets/Announcements 1-->
					   </div>
                       </div>
                        
                        
                        
                        
                        
					</div>
					
                    <div class="col-sm-12 col-md-4 col-xl-4">
                        <!--begin:: Widgets/Blog-->
						<div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
							<div class="m-portlet__head m-portlet__head--fit">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-action">
										<button type="button" class="btn btn-sm m-btn--pill  btn-brand">
											Blog
										</button>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-widget19">
									<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
										<img src="{{asset('metronic/assets/app/media/img/blog/blog1.jpg')}}" alt="">
										<h3 class="m-widget19__title m--font-light">
											Introducing New Feature
										</h3>
										<div class="m-widget19__shadow"></div>
									</div>
									<div class="m-widget19__content">
										<div class="m-widget19__header">
											<div class="m-widget19__user-img">
												<img class="m-widget19__img" src="{{asset('metronic/assets/app/media/img/users/user1.jpg')}}" alt="">
											</div>
											<div class="m-widget19__info">
												<span class="m-widget19__username">
													Anna Krox
												</span>
												<br>
												<span class="m-widget19__time">
													UX/UI Designer, Google
												</span>
											</div>
											<div class="m-widget19__stats">
												<span class="m-widget19__number m--font-brand">
													18
												</span>
												<span class="m-widget19__comment">
													Comments
												</span>
											</div>
										</div>
										<div class="m-widget19__body">
											Lorem Ipsum is simply dummy text of the printing and typesetting industry scrambled it to make text of the printing and typesetting industry scrambled a type specimen book text of the dummy text of the printing printing and typesetting industry scrambled dummy text of the printing.
										</div>
									</div>
									<div class="m-widget19__action">
										<button type="button" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
											Read More
										</button>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Blog-->
                    </div>
                    
				</div>
        </div>
				<!--End::Section-->
                
		    <!-- End First Row -->   
	        
		<div class="parent_reservation_ans_distribution">
           <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							Reservation & Distribution
						</h3>
					</div>
				</div>
			</div> 
            
			<div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4">
					<!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text m--font-light">
										Reservation & Distribution
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
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
									<div class="m-widget17__chart" style="height:320px;">
										<canvas id="m_chart_activities"></canvas>
									</div>
								</div>
								<div class="m-widget17__stats">
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="fa fa-home m--font-brand"></i>
											</span>
											<span class="m-widget17__subtitle">
												Property Management
											</span>
											<span class="m-widget17__desc">
												15 New Paskages
											</span>
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-paper-plane m--font-info"></i>
											</span>
											<span class="m-widget17__subtitle">
												Container
											</span>
											<span class="m-widget17__desc">
												72 Support Cases
											</span>
										</div>
									</div>
									<div class="m-widget17__items m-widget17__items-col2">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-pie-chart m--font-success"></i>
											</span>
											<span class="m-widget17__subtitle">
												Reservation Management
											</span>
											<span class="m-widget17__desc">
												72 New Items
											</span>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Activity-->
				</div>	
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Sale Reports-->
					<div class="m-portlet m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Guest Arrivals | Departures
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
											Today
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
											Month
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="m-portlet__body">
							<!--Begin::Tab Content-->
							<div class="tab-content">
								<!--begin::tab 1 content-->
								<div class="tab-pane active" id="m_widget11_tab1_content">
									<!--begin::Widget 11-->
									<div class="m-widget11">
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table">
												<!--begin::Thead-->
												<thead>
													<tr>														
														<td class="m-widget11__app">
															Guest Name
														</td>
														<td class="m-widget11__sales">
															Guest #
														</td>														
														<td class="m-widget11__total m--align-right">
															Date of Arrival
														</td>
													</tr>
												</thead>
												<!--end::Thead-->
<!--begin::Tbody-->
												<tbody>
													<tr>
														<td>
															Room name booked $309/pn														
														</td>
														<td>
															#3
														</td>														
														<td class="m--align-right m--font-brand">
															10:10:2018
														</td>
													</tr>
													<tr>
														<td>
															Room name booked $309/pn														
														</td>
														<td>
															#3
														</td>														
														<td class="m--align-right m--font-brand">
															10:10:2018
														</td>
													</tr>
													<tr>
														<td>
															Room name booked $309/pn														
														</td>
														<td>
															#3
														</td>														
														<td class="m--align-right m--font-brand">
															10:10:2018
														</td>
													</tr>
													<tr>
														<td>
															Room name booked $309/pn														
														</td>
														<td>
															#3
														</td>														
														<td class="m--align-right m--font-brand">
															10:10:2018
														</td>
													</tr>
												</tbody>
												<!--end::Tbody-->
											</table>
											<!--end::Table-->
										</div>
										
									</div>
									<!--end::Widget 11-->
								</div>
								<!--end::tab 1 content-->
<!--begin::tab 2 content-->
								<div class="tab-pane" id="m_widget11_tab2_content">
									<!--begin::Widget 11-->
									<div class="m-widget11">
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table">
												<!--begin::Thead-->
												<thead>
													<tr>
														<td class="m-widget11__label">
															#
														</td>
														<td class="m-widget11__app">
															Application
														</td>
														<td class="m-widget11__sales">
															Sales
														</td>
														<td class="m-widget11__change">
															Change
														</td>
														<td class="m-widget11__price">
															Avg Price
														</td>
														<td class="m-widget11__total m--align-right">
															Total
														</td>
													</tr>
												</thead>
												<!--end::Thead-->
<!--begin::Tbody-->
												<tbody>
													<tr>
														<td>
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</td>
														<td>
															<span class="m-widget11__title">
																Loop
															</span>
															<span class="m-widget11__sub">
																CRM System
															</span>
														</td>
														<td>
															19,200
														</td>
														<td>
															$63
														</td>
														<td>
															$11,300
														</td>
														<td class="m--align-right m--font-brand">
															$34,740
														</td>
													</tr>
													<tr>
														<td>
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</td>
														<td>
															<span class="m-widget11__title">
																Selto
															</span>
															<span class="m-widget11__sub">
																Powerful Website Builder
															</span>
														</td>
														<td>
															24,310
														</td>
														<td>
															$39
														</td>
														<td>
															$14,700
														</td>
														<td class="m--align-right m--font-brand">
															$46,010
														</td>
													</tr>
													<tr>
														<td>
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</td>
														<td>
															<span class="m-widget11__title">
																Jippo
															</span>
															<span class="m-widget11__sub">
																The Best Selling App
															</span>
														</td>
														<td>
															9,076
														</td>
														<td>
															$105
														</td>
														<td>
															$8,400
														</td>
														<td class="m--align-right m--font-brand">
															$67,800
														</td>
													</tr>
													<tr>
														<td>
															<label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">
																<input type="checkbox">
																<span></span>
															</label>
														</td>
														<td>
															<span class="m-widget11__title">
																Verto
															</span>
															<span class="m-widget11__sub">
																Web Development Tool
															</span>
														</td>
														<td>
															11,094
														</td>
														<td>
															$16
														</td>
														<td>
															$12,500
														</td>
														<td class="m--align-right m--font-brand">
															$18,520
														</td>
													</tr>
												</tbody>
												<!--end::Tbody-->
											</table>
											<!--end::Table-->
										</div>
										<div class="m-widget11__action m--align-right">
											<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
												Generate Report
											</button>
										</div>
									</div>
									<!--end::Widget 11-->
								</div>
								<!--end::tab 2 content-->
<!--begin::tab 3 content-->
								<div class="tab-pane" id="m_widget11_tab3_content"></div>
								<!--end::tab 3 content-->
							</div>
							<!--End::Tab Content-->
						</div>
					</div>
					<!--end:: Widgets/Sale Reports-->
                </div>
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Adwords Stats-->
					<div class="m-portlet m-portlet--full-height m-portlet--skin-light m-portlet--fit ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Sales Stats
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
											Select Range
										</a>
										<div class="m-dropdown__wrapper" style="z-index: 101;">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 47px;"></span>
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
							<div class="m-widget21" style="min-height: 420px">
								<div class="row">
									<div class="col col-sm-12 col-md-6 col-xl-6">
										<div class="m-widget21__item m--pull-right">
											<span class="m-widget21__icon">
												<a href="#" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
													<i class="fa flaticon-alert-2 m--font-light"></i>
												</a>
											</span>
											<div class="m-widget21__info">
												<span class="m-widget21__title">
													Sales
												</span>
												<br>
												<span class="m-widget21__sub">
													IPO, Margins, Transactions
												</span>
											</div>
										</div>
									</div>
									<div class="col col-sm-12 col-md-6 col-xl-6 m--align-left">
										<div class="m-widget21__item m--pull-left">
											<span class="m-widget21__icon">
												<a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
													<i class="fa flaticon-coins m--font-light m--font-light"></i>
												</a>
											</span>
											<div class="m-widget21__info">
												<span class="m-widget21__title">
													Commission Paid
												</span>
												<br>
												<span class="m-widget21__sub">
													Expenses, Loses, Profits
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="m-widget21__chart m-portlet-fit--sides" style="height:310px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
									<canvas id="m_chart_adwords_stats" width="502" height="310" class="chartjs-render-monitor" style="display: block; width: 502px; height: 310px;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Adwords Stats-->
                </div>
                						
			</div>
		</div>
        <div class="parent_sales_and_marketing">
            <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							Sales & Marketing
						</h3>
					</div>
				</div>
			</div>
            
			<div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4">
					<!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text m--font-light">
										Sales & Marketing
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
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
									<div class="m-widget17__chart" style="height:320px;">
										<canvas id="m_chart_activities2"></canvas>
									</div>
								</div>
								<div class="m-widget17__stats">
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="fa fa-envelope m--font-brand"></i>
											</span>
											<span class="m-widget17__subtitle">
												Email-Marketing
											</span>
											<span class="m-widget17__desc">
												<a href="#">View</a>
											</span>
										</div>
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-paper-plane m--font-info"></i>
											</span>
											<span class="m-widget17__subtitle">
												Heatmap Tracking
											</span>
											<span class="m-widget17__desc">
												<a href="#">View</a>
											</span>
										</div>
									</div>
									<div class="m-widget17__items m-widget17__items-col2">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="flaticon-pie-chart m--font-success"></i>
											</span>
											<span class="m-widget17__subtitle">
												Social Content Distribution
											</span>
											<span class="m-widget17__desc">
												<a href="#">View</a>
											</span>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Activity-->
				</div>
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Product Sales-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Product Sales
										<span class="m-portlet__head-desc">
											Total Sales By Products
										</span>
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
											Filter
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 36.5px;"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav">
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
							<div class="m-widget25">
								<span class="m-widget25__price m--font-brand">
									$237,650
								</span>
								<span class="m-widget25__desc">
									Total Revenue This Month
								</span>
								<div class="m-widget25--progress">
									<div class="m-widget25__progress">
										<span class="m-widget25__progress-number">
											63%
										</span>
										<div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-danger" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="m-widget25__progress-sub">
											Rooms
										</span>
									</div>
									<div class="m-widget25__progress">
										<span class="m-widget25__progress-number">
											39%
										</span>
										<div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-accent" role="progressbar" style="width: 39%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="m-widget25__progress-sub">
											Events
										</span>
									</div>
									<div class="m-widget25__progress" >
										<span class="m-widget25__progress-number">
											54%
										</span>
										<div class="m--space-10"></div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-warning" role="progressbar" style="width: 54%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="m-widget25__progress-sub">
											Restuarant / Spa / Bar
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Product Sales-->
                </div>
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Adwords Stats-->
					<div class="m-portlet m-portlet--full-height m-portlet--skin-light m-portlet--fit ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Sales Stats
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
											Select Range
										</a>
										<div class="m-dropdown__wrapper" style="z-index: 101;">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 47px;"></span>
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
							<div class="m-widget21" style="min-height: 420px">
								<div class="row">
									<div class="col col-sm-12 col-md-6 col-xl-6">
										<div class="m-widget21__item m--pull-right">
											<span class="m-widget21__icon">
												<a href="#" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
													<i class="fa flaticon-alert-2 m--font-light"></i>
												</a>
											</span>
											<div class="m-widget21__info">
												<span class="m-widget21__title">
													Sales
												</span>
												<br>
												<span class="m-widget21__sub">
													IPO, Margins, Transactions
												</span>
											</div>
										</div>
									</div>
									<div class="col col-sm-12 col-md-6 col-xl-6 m--align-left">
										<div class="m-widget21__item m--pull-left">
											<span class="m-widget21__icon">
												<a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
													<i class="fa flaticon-coins m--font-light m--font-light"></i>
												</a>
											</span>
											<div class="m-widget21__info">
												<span class="m-widget21__title">
													Commission Paid
												</span>
												<br>
												<span class="m-widget21__sub">
													Expenses, Loses, Profits
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="m-widget21__chart m-portlet-fit--sides" style="height:310px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
									<canvas id="m_chart_adwords_stats3" width="502" height="310" class="chartjs-render-monitor" style="display: block; width: 502px; height: 310px;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Adwords Stats-->
                </div>
                							
			</div>
        </div>
        <div class="parent_quality_assurance">		
            <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							Quality Assurance
						</h3>
					</div>
				</div>
			</div>
         
            <div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4">
					<!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text m--font-light">
										Quality Assurance
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
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
									<div class="m-widget17__chart" style="height:320px;">
										<canvas id="m_chart_activities3"></canvas>
									</div>
								</div>
								<div class="m-widget17__stats">
									<div class="m-widget17__items m-widget17__items-col1">
										<div class="m-widget17__item">
											<span class="m-widget17__icon">
												<i class="fa fa-check-square m--font-brand"></i>
											</span>
											<span class="m-widget17__subtitle">
												Quality Assurance
											</span>
											<span class="m-widget17__desc">
												<a href="#">View QA Module</a>
											</span>
										</div>
										
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Activity-->
				</div>
                
                <div class="col-sm-12 col-md-8 col-xl-8">
                    <div class="m-portlet m-portlet--tab">
																	<div class="m-portlet__head">
																		<div class="m-portlet__head-caption">
																			<div class="m-portlet__head-title">
																				<span class="m-portlet__head-icon m--hide">
																					<i class="la la-gear"></i>
																				</span>
																				<h3 class="m-portlet__head-text">
																					Quality Assurance Program
																				</h3>
																			</div>
																		</div>
																	</div>
																	<div class="m-portlet__body">
																		<div id="m_amcharts_13" style="height: 500px;"></div>
																	</div>
																</div>
                    <!--begin:: Widgets/Support Cases-->
																<?php /* <div class="m-portlet  m-portlet--full-height ">
																	<div class="m-portlet__head">
																		<div class="m-portlet__head-caption">
																			<div class="m-portlet__head-title">
																				<h3 class="m-portlet__head-text">
																					Support Cases
																				</h3>
																			</div>
																		</div>
																		<div class="m-portlet__head-tools">
																			<ul class="m-portlet__nav">
																				<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
																					<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
																						<i class="la la-ellipsis-h m--font-brand"></i>
																					</a>
																					<div class="m-dropdown__wrapper">
																						<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
																						<div class="m-dropdown__inner">
																							<div class="m-dropdown__body">
																								<div class="m-dropdown__content">
																									<ul class="m-nav">
																										<li class="m-nav__section m-nav__section--first">
																											<span class="m-nav__section-text">
																												Select
																											</span>
																										</li>
																										<li class="m-nav__item">
																											<a href="" class="m-nav__link">
																												<i class="m-nav__link-icon flaticon-share"></i>
																												<span class="m-nav__link-text">
																													Q1
																												</span>
																											</a>
																										</li>
																										<li class="m-nav__item">
																											<a href="" class="m-nav__link">
																												<i class="m-nav__link-icon flaticon-chat-1"></i>
																												<span class="m-nav__link-text">
																													Q2
																												</span>
																											</a>
																										</li>
																										<li class="m-nav__item">
																											<a href="" class="m-nav__link">
																												<i class="m-nav__link-icon flaticon-info"></i>
																												<span class="m-nav__link-text">
																													Q3
																												</span>
																											</a>
																										</li>
																										<li class="m-nav__item">
																											<a href="" class="m-nav__link">
																												<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																												<span class="m-nav__link-text">
																												    Q4
																												</span>
																											</a>
																										</li>
																										<li class="m-nav__separator m-nav__separator--fit"></li>
																										<li class="m-nav__item">
																											<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																												Q5
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
																		<div class="m-widget16">
																			<div class="row">
																				<div class="col-md-5">
																					
																					<div class="m-widget16__body">
																						<!--begin::widget item-->
																						<div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Bedroom
																							</span>
																							<span class="m-widget16__price m--align-right m--font-brand">
																								20%
																							</span>
																						</div>
																						<!--end::widget item-->	
						<!--begin::widget item-->
																						<div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Bathroom
																							</span>
																							<span class="m-widget16__price m--align-right m--font-accent">
																								10%
																							</span>
																						</div>
																						<!--end::widget item-->
						<!--begin::widget item-->
																						<div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Exterior/Grounds
																							</span>
																							<span class="m-widget16__price m--align-right m--font-accent">
																								14%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Lobby
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								6%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Restaurants/Bars
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Guest Room Corridors
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Restrooms
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Elevators
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								
																							</span>
																						</div>
                                                                                        <!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								HE Employee - Behavioural Standards
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Fitness Center
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Swimming Pool/Beach
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Tennis/Squash Courts
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Steam Room/Sauna/Jacuzzi
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Changing Rooms
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
                                                                                        <div class="m-widget16__item">
																							<span class="m-widget16__date">
																								Other Fields
																							</span>
																							<span class="m-widget16__price m--align-right m--font-danger">
																								5%
																							</span>
																						</div>
																						<!--end::widget item-->
																						
																					</div>
																				</div>
																				<div class="col-md-7">
																					<div class="m-widget16__stats">
																						<div class="m-widget16__visual">
																							<div id="m_chart_support_tickets" style="height: 180px"></div>
																						</div>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end:: Widgets/Support Stats--> */ ?>
					
                </div>
                
                
                							
			</div>
  </div>   
			
		
	<!--End::Section_portlet-->
<!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="agree_model" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Privacy & Data Protection
    				</h5>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
                        
                        <form class="m-form">
                        <div class="m-portlet__body" style="padding: 0px;">
                            
                            <div class="col-sm-12 col-md-12">
                                <div class="b2c-banner-text">Welcome</div>
               					<img src="{{URL::to('images/hotel_pop_up_terms.jpg')}}" style="width: 100%;" />
                            </div>
                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                <h2 class="black-heading-big">Welcome to emporium-voyage</h2>
                            </div> 
                            <div class="col-sm-12 col-md-12">                                
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.</p>
                            </div>
                            <div>
                                <hr />
                            </div>
                            <div class="form-group pref-left-pad-10"> 
                                <div class="m-checkbox-list"> 
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="agree" id="agree" value="1" />
										I Agree to the Emporium-Voyage Privacy & Data Protection Policy
										<span></span>
									</label>
								</div>
                                <div class="error" id="error" style="display: none;">
                                    Please agree to the Privacy & Data Protection Policy.
                                </div>
                                <span class="m-form__help">
									 I agree that my personal data will be collected and stored and used electronically to help the reservation agents with specialized offers pertaining to my travel preferences. 
Note: You may revoke your consent at any time by e-mail to info@emporium-voyage.com or from your settings section in your account admin.
								</span>                                                                            
                            </div>
                            <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="privacy_policy" id="privacy_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Emporium-Voyage Privacy Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="privacy_policy_error" style="display: none;">
                                    Please check privacy policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Privacy Policy.
								</span>
                             </div>            
							 <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
                                	<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="cookie_policy" id="cookie_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="cookie_policy_error" style="display: none;">
                                    Please check cookie policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Cookie Policy
								</span>
                             </div>
                        </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-primary" id="contractacceptbtn">Accept</button>
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->
    
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <style>
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
    </style>
@endsection

{{-- For custom style  --}}
@section('custom_js_script')
    @parent      
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script>
        $(document).ready(function(){
            <?php if($logged_user->i_agree == 0 || $logged_user->privacy_policy == 0 || $logged_user->cookie_policy == 0){ ?>
                    $("#agree_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php }else if($logged_user->new_user == 1){ ?>
                    window.location.href = "{{URL::to('whoiam')}}";
            <?php } ?>
            
            $("#contractacceptbtn").click(function(){
                var error = true;
                var agree = 0;
                var privacy_policy = 0;
                var cookie_policy = 0;
                if($("#agree").is(":checked")){
                    agree = $("#agree").val();
                    $("#error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#error").css("display", "");
                }
                if($("#privacy_policy").is(":checked")){
                    privacy_policy = $("#privacy_policy").val();
                    $("#privacy_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#privacy_policy_error").css("display", "");
                }
                if($("#cookie_policy").is(":checked")){
                    cookie_policy = $("#cookie_policy").val();
                    $("#cookie_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#cookie_policy_error").css("display", "");
                }
                
                
                if(error){ console.log("error");
                    
                }else{
                    var fdata = new FormData();                
                    fdata.append("_token",$("input[name=_token]").val());                    
                    
                    fdata.append("agree", agree); 
                    fdata.append("privacy_policy", privacy_policy);
                    fdata.append("cookie_policy", cookie_policy);
                    
                    $.ajax({
                        url:"{{URL::to('user/iagree')}}",
                        type:'POST',
                        dataType:'json',
                        contentType: false,
                        processData: false,
                        data:fdata,
                        headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        success:function(response){
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                $("#agree_model").modal('hide');
                                window.location.href = "{{URL::to('whoiam')}}";
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
            
        }); 
    </script>
@endsection
@section('script')
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