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
    <!--Begin::Section_portlet-->
        <div class="parent_hotel_name">
            <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h3 class="m-subheader__title m-subheader__title--separator">
							{{$hotel_name}}
						</h3>
					</div>
				</div>
			</div>
            
            <div class="row">
				<div class="col-sm-12 col-md-4 col-xl-4">
					<div class="col-md-12">
                    @if(!empty($blogs))
                    <div id="b2cblog_carousel" class="rad-carousel">
                         
                        <ol class="carousel-indicators">
                            @foreach($blogs as $key => $blog_row)
                            <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                            @endforeach
                        </ol>
                         
                        <!-- Carousel items -->
                        <div class="rad-carousel-inner">
                        @foreach($blogs as $key => $blog_row)    
                        <div class="item {{($key == 0)? 'active' : ''}}">
                        	<div class="row">
                            <div class="col-md-12">
                                <a href="{{$blog_row->external_link}}" class="thumbnail">                                
                                    <img src="{{url('/uploads/article_imgs/'.$blog_row->featured_image)}}" alt="{{$blog_row->title_pos_1}}" style="max-width:100%;">
                                </a>
                            </div>
                            <div class="col-md-12" style="margin: 10px 0px;">
                                <h2>{{$blog_row->title_pos_1}}</h2>
                            </div>                	  
                            <div class="col-md-12">
                                <p>{{str_limit(strip_tags($blog_row->description_pos_1), 100)}}</p>
                            </div>
                            <div class="col-md-12 m--align-right">
                                <a href="#">Read More</a>
                            </div>                              
                        	</div><!--.row-->
                        </div><!--.item-->
                        @endforeach 
                         
                        </div><!--.carousel-inner-->
                          <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                          <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
                    </div><!--.Carousel-->
                    @endif
                    </div>
                    
                    <!--begin:: Widgets/Announcements 2-->                    
				</div>
                
                <div class="col-sm-12 col-md-8 col-xl-8">
                   @if(!empty($pageslider))
                    <div id="b2cdash_carousel" class="carousel slide">
                         
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
                </div> 
                <div class="col-sm-12 col-md-4 col-xl-4">                    
                    <img src="{{URL::to('images/advert.png')}}" alt="Advertising" style="width: 100%; margin: 5px;" />
                </div>
                <div class="col-sm-12 col-md-8 col-xl-8">
                
                    <div class="row">
                        <div class="setting-box-advert">
                            <a href="{{ URL::to('properties') }}">
                                <i class="grid_icon flaticon-profile-1"></i>																	
                    			<span class="grid_link-text">
                    				Property Management
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="{{ URL::to('user/settings') }}">
                                <i class="grid_icon flaticon-settings-1"></i>																	
                    			<span class="grid_link-text">
                    				Reservation Management
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="{{ URL::to('container')}}">
                    			<i class="grid_icon flaticon-mail-1"></i>																	
                    			<span class="grid_link-text">
                    				Container
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="#" id="dash_communication">
                    			<i class="grid_icon flaticon-computer"></i>																	
                    			<span class="grid_link-text">
                    				Modules/Packages
                    			</span>
                    		</a>
                        </div>
                        
                        
                        <div class="setting-box-advert">
                            <a href="#">
                                <i class="grid_icon flaticon-profile-1"></i>																	
                    			<span class="grid_link-text">
                    				Arrivals/Departures
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="#">
                                <i class="grid_icon flaticon-settings-1"></i>																	
                    			<span class="grid_link-text">
                    				Cancelations
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="#">
                    			<i class="grid_icon flaticon-mail-1"></i>																	
                    			<span class="grid_link-text">
                    				Sales Reports
                    			</span>
                    		</a>
                        </div>
                        <div class="setting-box-advert">
                            <a href="#" id="dash_communication">
                    			<i class="grid_icon flaticon-computer"></i>																	
                    			<span class="grid_link-text">
                    				Quality Assurance
                    			</span>
                    		</a>
                        </div>
                        
                    </div>
                </div>                		
			</div>
            
        <!-- Second Row -->
			<?php /*<div class="row">
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
                				
			</div>*/ ?>
        </div>
    <!-- Third Row -->
        <?php /* <div class="parent_notifications">           
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
        </div> */ ?>
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
				<?php /* <div class="col-sm-12 col-md-4 col-xl-4">
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
				</div>	*/ ?>
                
                <div class="col-sm-12 col-md-8 col-xl-8">
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
                                <div class="arrival_departure">
                                    <select class="form-control" name="dd_arrival_departure" id="dd_arrival_departure">
                                        <option value="arrival">Arrival</option>
                                        <option value="departure">Departure</option>
                                    </select>
                                </div>
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active m_tab1_content" data-reportfor='today'>
											Today
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='month'>
											Month
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="m-widget11">
										<div class="table-responsive">
											<!--begin::Table-->
											<table class="table">
												<!--begin::Thead-->
												<thead>
													<tr>														
														<td>
															Guest Name
														</td>
														<td>
															Adult #
														</td>	
                                                        <td>
															Child #
														</td>													
														<td class="m--align-right">
															Date of Arrival
														</td>
                                                        <td class="m--align-right">
															Date of Departure
														</td>
													</tr>
												</thead>
												<!--end::Thead-->
<!--begin::Tbody-->
												<tbody id="table_data">
													
												</tbody>
												<!--end::Tbody-->
											</table>
											<!--end::Table-->
										</div>
										
									</div>
						</div>
					</div> 
					<!--end:: Widgets/Sale Reports-->
                    <?php /* <!--begin:: Widgets/Sale Reports-->
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
                                <div class="arrival_departure">
                                    <select class="form-control" name="dd_arrival_departure" id="dd_arrival_departure">
                                        <option value="arrival">Arrival</option>
                                        <option value="departure">Departure</option>
                                    </select>
                                </div>
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active m_tab1_content" data-toggle="tab" data-reportfor='today' href="#m_widget11_tab1_content" role="tab">
											Today
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link m_tab1_content" data-toggle="tab" data-reportfor='month' href="#m_widget11_tab2_content" role="tab">
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
					<!--end:: Widgets/Sale Reports--> */ ?>
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
                <!-- Calendar Start -->
                <div class="col-sm-12 col-md-12 col-xl-12">
                    
                        
                        <div class="sbox-content calendar"> 
        					{{--*/ $days_start = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y"))); 
        						   $days_end = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") + 20, date("Y")));
        					/*--}}
                            <div class="col-sm-12 col-md-12 col-lg-12">
        					<form id="cal-dates" method="POST">
        						<div class="controls">
        							<section>
        								<div class="control-group no-grow">
        									<button id="calendar-show-button" type="button" onclick="find_reservation_dates();"><i class="fa fa-repeat" style=""></i></button>
        								</div>
        
        								<div class="control-group">
        									<button onclick="dateOffset('prev');" type="button"><i class="fa fa-caret-left"></i></button>
        									<input id="cal-start" name="cal-start" type="text" class="date hasDatepicker" value="{{$days_start}}">
        									<input id="cal-end" name="cal-end" type="text" class="date hasDatepicker" value="{{$days_end}}">
        									<button onclick="dateOffset('next');" type="button"><i class="fa fa-caret-right"></i></button>
        								</div>
        							</section>
        							
        							<section>
        								<div class="control-group tools">
        									<button type="button" onclick="dateOffset('week');">Week</button>
        									<button type="button" onclick="dateOffset('month');">Month</button>
        								</div>
        							</section>
        
        							<section>
        								<div class="control-group">
        									<select name="cal-room-type" id="cal-room-type" onchange="find_reservation_dates();">
        										<option value="all">Show all</option>
        										@if(!empty($cat_types))
        											@foreach($cat_types as $typec)
        												<option value="{{$typec['data']->id}}">{{$typec['data']->category_name}}</option>
        											@endforeach
        										@endif
        									</select>
        
        									<select name="cal-coloring" onchange="find_reservation_dates();">
        										<option value="1">Color by Room</option>
        										<option value="2" selected="">Color by Source</option>
        									</select>
        								</div>
        							</section>
        
        							<section>
        								<div class="control-group tools">
        									<button type="button" onclick="calStartUnavail()" title="New Out of Order">
        										<img src="https://app.base7booking.com/images/icons/construction.png">
        									</button>
        									<button type="button" onclick="calStartPrice()" title="ADR">
        										<img src="https://app.base7booking.com/images/icons/money.png">
        									</button>
        									<button type="button" onclick="calSplit()" title="Split">
        										<img style="height: 16px" src="https://app.base7booking.com/images/icons/cut.png">
        									</button>
        									<button type="button" onclick="v1.openRestrictions()" title="Restrictions">
        										<img style="height: 16px" src="https://app.base7booking.com/images/restriction.png">
        									</button>
        									<button type="button" onclick="v1.openCustomPrice()" title="Custom Price">
        										<img style="height: 16px" src="https://app.base7booking.com/images/yield.png">
        									</button>
        								</div>
        							</section>
        
        							
        						</div>
        					</form>
                            </div>
                            <?php /* <div class="col-sm-12 col-md-12 col-lg-12">
                                <section>
    								<button type="button" class="b7 info new-reservation" title="New Reservation">New Reservation</button>
    							</section>
                            </div> */ ?>
                            <div class="col-sm-12 col-md-12 col-lg-12">
            					<div style="margin-left: 150px; ; height: 13px; border-bottom: none;"></div>
            					<div class="row no_border ">
            						<div class="cols first white_border_left"></div>
            						<div class="datcalendartop">
            							
            						</div>
            						<div class="clr"></div>
            					</div>
			               
            					<div id="catrooms">					
            						@if(!empty($cat_types))
            							@foreach($cat_types as $typec)
            								@if(array_key_exists('rooms', $typec))
            								{{--*/ $tp=20; /*--}}
            									@foreach($typec['rooms'] as $typeroom)
            										<div class="row first">
            											 <div class="cols first right_border_gray">
            												<span class="room_number">{{$typeroom->room_name}}</span> 
            												<span class="room_name">
            													<span class="room_title">{{$typec['data']->cat_short_name}} </span>
            													<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>
            												<div class="clr"></div>
            											</div>
            											 <div class="cols right_border_gray"></div>
            											 <div class="cols right_border_gray"></div>
            											 <div class="cols right_border_gray weekend_days"></div>
            											 <div class="cols right_border_gray weekend_days"></div>
            											 <div class="clr"></div>
            										</div>
            										{{--*/ $tp = $tp+20; /*--}}
            									@endforeach
            								@endif
            							@endforeach
            						@endif
            					</div>
			
            					<div class="row last empty_row">
            					</div>
            					<div class="row no_border ">
            						<div class="cols first white_border_left"></div>
            						<div class="datcalendarbottom">
            							
            						</div>
            						<div class="clr"></div>
            					</div>
            					<div class="separate_row">
            					</div>
            					
            					<!--<div class="row no_border">
            						<div class="cols first white_border_left" >Guset</div>
            						<div class="cols top_border_black bottom_border_black left_border_black ">0</div>
            						<div class="cols top_border_black bottom_border_black left_border_black">0</div>
            						<div class="cols top_border_black bottom_border_black left_border_black ">0</div>
            						<div class="cols top_border_black bottom_border_black left_border_black right_border_black  ">0</div>
            						<div class="clr"></div>
            					</div>
            					<div class="row no_border">
            						<div class="cols first white_border_left">Room Available</div>
            						<div class="cols bottom_border_black left_border_black ">7</div>
            						<div class="cols bottom_border_black left_border_black">7</div>
            						<div class="cols bottom_border_black left_border_black ">7</div>
            						<div class="cols bottom_border_black left_border_black right_border_black  ">7</div>
            						<div class="clr"></div>
            					</div> -->
		                    </div>
                        </div>
                    
                </div>
                <!-- Calendar End -->						
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
 <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="confirm_model" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Confirm
    				</h5>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
                        
                        <form class="m-form">
                        <div class="m-portlet__body" style="padding: 0px;">
                            <div class="form-group m--align-center">
                                Welcome back !You have not completed the hotel setup yet.
                            </div>
                            <div class="form-group m--align-center">
                                Please continue your Hotel Setup to start taking reservations.
                             </div>            
							 
                        </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-primary" id="yeshotelsetupbtn">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->  
 <!-- Reservation model -->
<div class="modal fade" id="reservationsmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
        <h5 class="modal-title" id="guesttitle">Booked Details</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  </div>
      
      <div class="modal-body">
        <div class="m-portlet m-portlet--full-height" style="padding: 0px; margin-bottom: 0px;">
            <form class="m-form">
                <div class="m-portlet__body" style="padding: 0px;">
                    <div id="bookingdetailbody">
		
	                </div>
                </div>
            </form>
        </div>
      </div>
      
	  
	</div>
  </div>
</div> 
<!-- End reservation model -->
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    <style>
    	.cursor{cursor:col-resize;}
    	.selectedCell{background:pink;}
        .BookedCell{background:pink; cursor: pointer; }
        .selectedCell span{ cursor: pointer; }
    	.optionbox {
    		-moz-user-select: none;
    		-webkit-user-select: none;
    		-ms-user-select: none;
    		padding: 8px;
    		cursor: pointer;
    		background-color: #eee;
    		border-radius: 3px;
    		border: 1px solid #dadada;
    		line-height: 18px;
    		display: inline-block;
    	}
        .m-content>div:nth-child(even) .row {
            background: none !important;
            padding: 10px 15px;
        }
    </style>
    <style>
    
    .carousel {
      position: relative;
    }
    
    .carousel-inner {
      position: relative;
      width: 100%;
      height:400px;
      overflow: hidden;
    }
    
    .carousel-inner > .item {      
      position: absolute;
      height:400px;
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
    
    .carousel-control2 {
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
    .carousel-control2.right {
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
    
    .rad-carousel{
        position: relative;
    }
    .rad-carousel-inner {      
      position: relative;
      height:400px;
      width: 100%;
      overflow: hidden;
    }
    
    .rad-carousel-inner > .item {
      position: absolute;
      height:400px;
      display: none;
      -webkit-transition: 0.6s ease-in-out left;
              transition: 0.6s ease-in-out left;
    }
    
    .rad-carousel-inner > .item > img,
    .rad-carousel-inner > .item > a > img {
      display: block;
      height: auto;
      max-width: 100%;
      line-height: 1;
    }
    
    .m-content>div:nth-child(even) .row{
        padding: 0px 0px !important;
    }
    .m-content>div:nth-child(even) .row {
        margin: 0px;
    }
    .rad-carousel .carousel-control{
        top: 25% !important;
    }
    </style>
@endsection

{{-- For custom style  --}}
@section('custom_js_script')
    @parent      
    <script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
    <script>
        $(document).ready(function(){
            <?php if($logged_user->i_agree == 0 || $logged_user->privacy_policy == 0 || $logged_user->cookie_policy == 0){ ?>
                    $("#agree_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php }else if($logged_user->new_user == 1){ ?>
                    window.location.href = "{{URL::to('whoiam')}}";
            <?php }/*else if($logged_user->hotel_setup_complete == 0){ ?>
                    $("#confirm_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php }*/ ?>
            
            $("#yeshotelsetupbtn").click(function(){
                <?php if($logged_user->property_info_setup == 0){ if($pid > 0){ ?>
                        
                        window.location.href = "{{URL::to('properties/update/'.$pid)}}";
                        
                <?php } }else{ ?>
                        window.location.href = "{{URL::to('properties_settings/'.$pid.'/types')}}";
                <?php } ?>
            });
            
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
                
                
                if(error){ 
                    
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
            
            // settings
              var $slider = $('#b2cdash_carousel .carousel-inner'); // class or id of carousel slider
              var $slide = '.item'; // could also use 'img' if you're not using a ul
              var $transition_time = 1000; // 1 second
              var $time_between_slides = 4000; // 4 seconds
            
              function slides(){
                return $slider.find($slide);
              }
            
              slides().fadeOut();
            
              // set active classes
              slides().first().addClass('active');
              slides().first().fadeIn($transition_time);
            
              // auto scroll 
              $interval = setInterval( 
                function(){
                if(slides().length > 1){
                  var $i = $slider.find($slide + '.active').index();
                                      
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);
            
                  if (slides().length == $i + 1) $i = -1; // loop to start
            
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                  }
                }
                , $transition_time +  $time_between_slides 
              );
            
            
            $("#b2cdash_carousel .left").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i - 1 >= 0){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);                  
                  slides().eq($i - 1).fadeIn($transition_time);
                  slides().eq($i - 1).addClass('active');
                }
            });
            
            $("#b2cdash_carousel .right").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i + 1 < slides().length){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                }
            });
            
            
            // settings
              var $slider2 = $('#b2cblog_carousel .rad-carousel-inner'); // class or id of carousel slider
              var $slide2 = '.item'; // could also use 'img' if you're not using a ul
              var $transition_time2 = 4000; // 1 second
              var $time_between_slides2 = 4000; // 4 seconds
            
              function slides2(){
                return $slider2.find($slide2);
              }
            
              slides2().fadeOut();
            
              // set active classes
              slides2().first().addClass('active');
              slides2().first().fadeIn($transition_time2);
            
              // auto scroll 
              $interval = setInterval( 
                function(){
                if(slides2().length > 1){
                  var $i = $slider2.find($slide2 + '.active').index();
                                      
                  slides2().eq($i).removeClass('active');
                  slides2().eq($i).fadeOut($transition_time);
            
                  if (slides2().length == $i + 1) $i = -1; // loop to start
            
                  slides2().eq($i + 1).fadeIn($transition_time2);
                  slides2().eq($i + 1).addClass('active');
                  }
                }
                , $transition_time2 +  $time_between_slides2
              );
            
            
            $("#b2cblog_carousel .left").click(function(){
                var $i = $slider2.find($slide2 + '.active').index();
                if($i - 1 >= 0){ 
                  slides2().eq($i).removeClass('active');
                  slides2().eq($i).fadeOut($transition_time2);                  
                  slides2().eq($i - 1).fadeIn($transition_time2);
                  slides2().eq($i - 1).addClass('active');
                }
            });
            
            $("#b2cblog_carousel .right").click(function(){
                var $i = $slider2.find($slide2 + '.active').index();
                if($i + 1 < slides2().length){ 
                  slides2().eq($i).removeClass('active');
                  slides2().eq($i).fadeOut($transition_time2);
                  slides2().eq($i + 1).fadeIn($transition_time2);
                  slides2().eq($i + 1).addClass('active');
                }
            });
            arrival_depart();
            $(".m_tab1_content").click(function(){
                $(".m_tab1_content").removeClass('active');
                $(this).addClass('active');
                arrival_depart();
            });
            function arrival_depart(){
                //$obj = $(".m_tab1_content.active");
                var reportfor = $(".m_tab1_content.active").attr('data-reportfor');
                var arrival_departure = $("#dd_arrival_departure").val();
                //console.log($obj);
                $.ajax({
                    url:"{{URL::to('user_arrival_departure')}}",
                    type:'POST',
                    dataType:'json',
                    data:{'reportfor':reportfor, 'arrival_departure':arrival_departure}, 
                    beforeSend: function() {
                      $("#table_data").html('<tr class="m--align-center"><td colspan="5"><div class="m-loader m-loader--brand"></div></td></tr>');
                    },                   
                    success:function(response){
                        var html = '';
                        $("#table_data").html('');
                        if(response.status == 'success'){
                            
                            var reservations = response.reservations;
                            if(reservations.length > 0){
                                $.each(reservations, function(key, val){
                                    console.log(val);
                                     
                                    html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td class="m--align-center">'+val.total_adults+'</td><td class="m--align-center">'+val.total_child+'</td><td class="m--align-right m--font-brand">'+val.checkin_date+'</td><td class="m--align-right m--font-brand">'+val.checkout_date+'</td></tr>';													
								});	
                                			
                            }else{
                                html += '<tr class="m--align-center"><td colspan="5">Currently no record found</td></tr>';													
								
                            }
                            $("#table_data").html(html);
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
            }
            
            
            
/*            $(document).on('click', '.btn', function (){
                var frmid = $(this).parents('form.add_new_reserve_setup').attr('id');
        		  $('#'+frmid).validate({
        			submitHandler: function (form) {
        				 save_reserve_forms_data(frmid);
        				 return false; // required to block normal submit since you used ajax
        			 }
        		 });
        	 });
        	 
        	 
        	 $(document).on('click', '#catrooms .scell', function (){ 
        		var clickcell = $(this); console.log(clickcell);
        		var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        		var cdate = clickcell.attr('data-date');
        		var cnum = clickcell.attr('data-cell-number');
        		var roomid = clickcell.parents('.row').attr('data-roomid');
        		var roomname = clickcell.parents('.row').attr('data-roomname');
        		var roomcat = clickcell.parents('.row').attr('data-roomcat');
        		var srartdateform = JSON.parse(cdate);
        		var chkin = srartdateform.year+'-'+srartdateform.month+'-'+srartdateform.date;
        		var enddate = startdate = chkindate = chkoutdate = '';
                
                clickcell.addClass('selectedCell');
                
        		if($('#startid').val()!='')
        		{
        			$('#endid').val(cnum);
        			if($('#startid').val()>cnum)
        			{
        				var startdateval = $('#chkin').val();
        				$('#chkin').val(chkin);
        				$('#chkout').val(startdateval);
        				chkindate = chkin;
        				chkoutdate = startdateval;
        				enddate = new Date(startdateval);
        				startdate = new Date(chkin);
        			}
        			else
        			{
        				$('#chkout').val(chkin);
        				var startdateval = $('#chkin').val();
        				chkindate = startdateval;
        				chkoutdate = chkin;
        				startdate = new Date(startdateval);
        				enddate = new Date(chkin);
        			}
        			var headingt = roomname+' '+roomcat+' / '+startdate.getDate()+' '+ monthNames[startdate.getMonth()]+' - '+enddate.getDate()+' '+ monthNames[enddate.getMonth()]+' '+enddate.getFullYear();
        			$('#myModalLabel').html(headingt);
        			
        			newclientForm(chkindate,chkoutdate,roomid);
        			$('#newreserve').modal('show');
        		}
        		else{
        			$('#startid').val(cnum);
        			$('#catrooms .row').removeClass('active');
        			clickcell.parents('.row').addClass('active');
        			$('#roomid').val(roomid);
        			$('#chkin').val(chkin);
        		}
        			
        		
        	 });
        	 
        	 $(document).on('mouseover', '#catrooms .active .scell', function (){
        		$( this ).addClass('selectedCell');
        	});*/
        	
        	$(document).on('click', '.new-reservation', function (){
        		$('.scell').addClass('cursor');
        		$('.scell').removeClass('selectedCell');
        	});
        	
        	find_reservation_dates();
            
            
        }); 
        
        function newclientForm(chkin,chkout,roomid)
    	{
    		if(chkin!='' && chkout!='' && roomid!='')
    		{
    			var clintfrm = '';
    			clintfrm += '<form class="m-form m-form--label-align-left- m-form--state- columns" id="addclient" method="post">';
    			clintfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			clintfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			clintfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			clintfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			clintfrm += '<input type="hidden" name="actionName" value="client">';
    			clintfrm += '<div class="modal-body">';
    			clintfrm += '<fieldset>';
    			clintfrm += '<div class="form-group m-form__group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Title</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<select name="title" style="width: 100%; padding:5px;">';
    			clintfrm += '<option></option>';
    			clintfrm += '<option value="Mr">Mr</option>';
    			clintfrm += '<option value="Ms">Ms</option>';
    			clintfrm += '<option value="Mrs">Mrs</option>';
    			clintfrm += '</select>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4"></div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<button type="button" class="b7 small info mbot float-right" onclick="open_searchClient_form(\'addclient\');"><i class="fa fa-search"></i> Search Client</button>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Company</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="company" class="form-control" type="text" value="" required="required">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Firstname</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="firstname" class="form-control" type="text" value="" required="required">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Lastname</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="lastname" class="form-control" type="text" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Email</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="email" class="form-control" type="email" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Cellphone</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="cellphone" class="form-control" type="text" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-7">';
    			clintfrm += '<label>Country</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="country" class="form-control" type="text" value="" >';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-12">';
    			clintfrm += '<label>Comment</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<textarea id="book-comment" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</fieldset>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="modal-footer">';
    			clintfrm += '<button type="submit" class="btn btn-primary" onclick="open_booking_form(\'addclient\');" >OK</button>';
    			clintfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			clintfrm += '</div>';
    			clintfrm += '</form>';
    			$('#reserforms').html(clintfrm);
    		}
    	}
    	
    	function open_searchClient_form(form_id)
    	{
    		if(form_id!='')
    		{
    			var chkin = $('#'+form_id+' input[name="chkin"]').val();
    			var chkout = $('#'+form_id+' input[name="chkout"]').val();
    			var roomid = $('#'+form_id+' input[name="roomid"]').val();
    			
    			var searchclientfrm = '';
    			searchclientfrm += '<form class="columns search_client_setup" id="searchClient" method="post">';
    			searchclientfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			searchclientfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			searchclientfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			searchclientfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			searchclientfrm += '<div class="modal-body">';
    			searchclientfrm += '<fieldset>';
    			searchclientfrm += '<div class="form-group row">';
    			searchclientfrm += '<div class="col-md-4">';
    			searchclientfrm += '<label>Search Clients</label>';
    			searchclientfrm += '<div class="field-input">';
    			searchclientfrm += '<input type="text" name="searchclient" value="" />';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</fieldset>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '<div class="modal-footer">';
    			searchclientfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
    			searchclientfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</form>';
    			$('#reserforms').html(searchclientfrm);
    		}
    	}
    	
    	function open_booking_form(form_id)
    	{
    		if(form_id!='')
    		{
    			var chkin = $('#'+form_id+' input[name="chkin"]').val();
    			var chkout = $('#'+form_id+' input[name="chkout"]').val();
    			var roomid = $('#'+form_id+' input[name="roomid"]').val();
    			var title = $('#'+form_id+' select[name="title"]').val();
    			var company = $('#'+form_id+' input[name="company"]').val();
    			var firstname = $('#'+form_id+' input[name="firstname"]').val();
    			var lastname = $('#'+form_id+' input[name="lastname"]').val();
    			var email = $('#'+form_id+' input[name="email"]').val();
    			var cellphone = $('#'+form_id+' input[name="cellphone"]').val();
    			var country = $('#'+form_id+' input[name="country"]').val();
    			var comment = $('#'+form_id+' textarea[name="comment"]').val();
    			var clientdata = { 'act':'new','title':title,'company':company,'firstname':firstname,'lastname':lastname,'email':email,'cellphone':cellphone,'country':country,'comment':comment };
    			
    			var reservfrm = '';
    			reservfrm += '<form class="columns add_new_reserve_setup" id="addreservation" method="post">';
    			reservfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			reservfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			reservfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			reservfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			reservfrm += '<input type="hidden" name="actionName" value="reserve">';
    			reservfrm += '<input type="hidden" name="clientData" value=\''+JSON.stringify(clientdata)+'\'>';
    			reservfrm += '<div class="modal-body">';
    			reservfrm += '<fieldset>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<label>Stay Type</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="staytype" class="form-control" style="width: 100%; padding:5px;" required="required">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="Business">Business</option>';
    			reservfrm += '<option value="Leisure">Leisure</option>';
    			reservfrm += '<option value="Residency">Residency</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<label>Source</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="source" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="Direct reservation">Direct reservation</option>';
    			reservfrm += '<option value="Email">Email</option>';
    			reservfrm += '<option value="Hotel Next Door">Hotel Next Door</option>';
    			reservfrm += '<option value="Hotel Website">Hotel Website</option>';
    			reservfrm += '<option value="Recommended">Recommended</option>';
    			reservfrm += '<option value="Return Customer">Return Customer</option>';
    			reservfrm += '<option value="Telephone">Telephone</option>';
    			reservfrm += '<option value="Tourist Office">Tourist Office</option>';
    			reservfrm += '<option value="Walk-In">Walk-In</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea id="book-comment" class="form-control" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="pre"> pre-reservation';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<hr>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Adults</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="adult" class="form-control" style="width: 100%; padding:5px;" required="required">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '<option value="2">2</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Junior</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="junior" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Baby</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="baby" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Guests Names</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<input type="text" class="form-control" value="" name="guest_list" required="required">';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Check-in Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea class="form-control" name="chkin_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Check-out Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea class="form-control" name="chkout_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-2">';
    			reservfrm += '<div class="field-input">';
    			reservfrm += 'Options:';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="option1"> Upper level rooms';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="option2"> Baby cot';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<hr>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<label>Price</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<input type="text" class="form-control" value="95.00" name="price">';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<label>Mode</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="price_mode" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="daily">Daily</option>';
    			reservfrm += '<option value="weekly">Weekly</option>';
    			reservfrm += '<option value="monthly">Monthly</option>';
    			reservfrm += '<option value="fixed">Fixed</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Board</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="board" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="1">Breakfast</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</fieldset>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="modal-footer">';
    			reservfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
    			reservfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			reservfrm += '</div>';
    			reservfrm += '</form>';
    			$('#reserforms').html(reservfrm);
    		}
    	}
    
    	function save_reserve_forms_data(formid)
    	{
    		if(formid!='')
    		{
    			$.ajax({
    			  url: "{{ URL::to('add_new_reservation')}}",
    			  type: "post",
    			  data: $('#'+formid).serializeArray(),
    			  dataType: "json",
    			  success: function(data){
    				var html = '';
    				if(data.status=='error')
    				{
    					alert('error');
    				}
    				else
    				{
    					html += '<div class="modal-body">';
    					html += '<h2>Reservation Submitted Successfully!</h2>';
    					html += '</div>';
    					html += '<div class="modal-footer">';
    					html += '<button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>';
    					html += '</div>';
    					$('#reserforms').html(html);
    				}
    			  }
    			});
    		}
    	}
    	
    	function dateOffset(act)
    	{
    		var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
    		var current_date = new Date(cal_start);
    		var end_date = new Date(cal_end);
    		var d = m = '';
    		if(act=='prev')
    		{
    			current_date.setDate(current_date.getDate()-1);
    			d = ("0" + current_date.getDate()).slice(-2);
    			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(current_date.getFullYear() + '-' + m + '-' + d);
    			
    			current_date.setDate(current_date.getDate()-25);
    			d = ("0" + current_date.getDate()).slice(-2);
    			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(current_date.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='next')
    		{
    			end_date.setDate(end_date.getDate()+1);
    			d = ("0" + end_date.getDate()).slice(-2);
    			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(end_date.getFullYear() + '-' + m + '-' + d);
    			
    			end_date.setDate(end_date.getDate()+25);
    			d = ("0" + end_date.getDate()).slice(-2);
    			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(end_date.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='week')
    		{
    			var start = start || 1;
    			var today = new Date();
    			var day = today.getDay() - start;
    			var date = today.getDate() - day;
    			var StartDate = new Date(today.setDate(date));
    			
    			d = ("0" + StartDate.getDate()).slice(-2);
    			m = ("0" + (StartDate.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(StartDate.getFullYear() + '-' + m + '-' + d);
    			
    			var EndDate = new Date(today.setDate(date + 6));
    			d = ("0" + EndDate.getDate()).slice(-2);
    			m = ("0" + (EndDate.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(EndDate.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='month')
    		{
    			var date = new Date();
    			var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    			d = ("0" + firstDay.getDate()).slice(-2);
    			m = ("0" + (firstDay.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(firstDay.getFullYear() + '-' + m + '-' + d);
    			
    			var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    			d = ("0" + lastDay.getDate()).slice(-2);
    			m = ("0" + (lastDay.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(lastDay.getFullYear() + '-' + m + '-' + d);
    		}
    		find_reservation_dates();
    	}
    	
    	function find_reservation_dates()
    	{
    		var cal_room_type = $('#cal-room-type').val();
            var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
            
    		$.ajax({
    		  url: "{{ URL::to('get_b2ccategory_rooms_reservations')}}",
    		  type: "post",
    		  data: 'caltype='+cal_room_type+'&pid={{$pid}}&calstart='+cal_start+'&calend='+cal_end,
    		  dataType: "json",
    		  success: function(data){
    			var html = '';
    			if(data.status=='error')
    			{
    				$('.page-content-wrapper #formerrors').html(data.errors);
    				$('#catrooms').html('');
    				window.scrollTo(0, 0);
    			}
    			else
    			{
    				$('.page-content-wrapper #formerrors').html('');
    				var cal_start = $('#cal-start').val();
    				var cal_end = $('#cal-end').val();
    				var current_date = new Date(cal_start);
    				var end_date = new Date(cal_end);
    				var end_date_time = end_date.getTime();
    				var today = new Date();
    				var tophtml = bothtml = roomhtml = dhtml = '';
    				var cellCount = 1;
    				while (current_date.getTime() <= end_date_time) {
    					var day = current_date.getDay();
    					var iweekend = dweekend = '';
    					var itoday = '';
    					if(day === 6 || day === 0)
    					{
    						iweekend = 'weekend';
    						dweekend = 'weekend_days';
    					}
    					if(today.getDate()==current_date.getDate() && today.getMonth()==current_date.getMonth() && today.getFullYear()==current_date.getFullYear())
    					{
    						itoday = 'today';
    					}
    					tophtml += '<div class="cols top_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    					
    					bothtml += '<div class="cols bottom_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    					
    					var d = ("0" + current_date.getDate()).slice(-2);
    					var m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    					var dateData = {'year':current_date.getFullYear(),'month':m,'date':d};
    						
    					
    					dhtml += '<div class="cols right_border_gray scell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\'></div>';
    					
    					current_date.setDate(current_date.getDate()+1);
    					cellCount++;
    				}
    				$('.datcalendartop').html(tophtml);
    				$('.datcalendarbottom').html(bothtml);
    				
    				$.each(data.cat_types, function(idx, tobj) { 
    				    //$.each(tobj.rooms, function(idx, obj) {
    						roomhtml += '<div class="row first row'+tobj.data.id+'" data-roomname="'+tobj.data.category_name+'" data-roomcat="'+tobj.data.category_name+'" data-roomid="'+tobj.data.id+'">';
    						roomhtml += '<div class="cols first right_border_gray">';
    						roomhtml += '<span class="room_number">'+tobj.data.category_name+'</span>'; 
    						roomhtml += '<span class="room_name">';
    						roomhtml += '<span class="room_title">'+tobj.data.cat_short_name+'</span>';
    						roomhtml += '<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>';
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    						roomhtml += get_room_reserved(tobj.reservation);
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    					//});
    					/*$.each(tobj.rooms, function(idx, obj) {
    						roomhtml += '<div class="row first row'+obj['room'].id+'" data-roomname="'+obj['room'].room_name+'" data-roomcat="'+tobj.data.category_name+'" data-roomid="'+obj['room'].id+'">';
    						roomhtml += '<div class="cols first right_border_gray">';
    						roomhtml += '<span class="room_number">'+obj['room'].room_name+'</span>'; 
    						roomhtml += '<span class="room_name">';
    						roomhtml += '<span class="room_title">'+tobj.data.cat_short_name+'</span>';
    						roomhtml += '<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>';
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    						roomhtml += get_room_reserved(obj['reservation']);
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    					}); */
    				});
    				$('#catrooms').html(roomhtml);
    			}
    		  }
    		});
    	}
        
        var bookedDetails = new Array();
        var bookedNumbersDetails = new Array();
        function isInArray(value, array) {
          return array.indexOf(value) > -1;
        }
        
        function clickonBooking(event,clickedDate){
            event.stopImmediatePropagation();
            event.stopPropagation();
            
            if(typeof bookedNumbersDetails[clickedDate] != 'undefined'){
                var bookingNums = bookedNumbersDetails[clickedDate];
                //console.log(bookingNums);
                $.ajax({
    			  url: "{{ URL::to('get_reservation_details')}}",
    			  type: "post",
    			  data: {'ids':bookingNums},
    			  dataType: "json",
    			  success: function(data){
    				var html = '';
    				if(data.status=='error')
    				{
    					
    				}
    				else
    				{
    					var resp = data.reservations;
                        var bookedhtml ='';
                        var $sr_no = 1;
                        $.each(resp, function(rdid, rdval){
                            if(typeof rdval.details != 'undefined'){
                                var detail = rdval.details;  
                                
                                bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px"></span></div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12 m--align-right"><button class="btn btn-primary btn-sm" id="confirmReservation" type="button" onclick="confirm_reservation('+detail.id+');">Confirm</button>&nbsp;<button class="btn btn-danger btn-sm" id="confirmRejected" type="button" onclick="rejected_reservation('+detail.id+');">Rejected</button></div>'; 
                                bookedhtml += '<div style="background: #eeeeee; padding: 5px 0px;">';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<div class="row">';
                                        
                                        bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<table>';
                                        $.each(rdval.rooms,function(reid,reval){                            
                                            bookedhtml += '<tr>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += 'Room'+$sr_no;
                                                bookedhtml += '</td>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += detail.category_name;
                                                bookedhtml += '</td>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += '<div class="col-sm-8 col-md-8"><select class="form-control" id="dd_rooms">';
                                                        bookedhtml += '<option value="0">Select</option>'
                                                        $.each(reval.available_rooms,function(arid,arval){
                                                            bookedhtml += '<option value="'+arval.id+'">'+arval.room_name+'</option>'
                                                        });
                                                    bookedhtml += '</select></div>';  
                                                bookedhtml += '</td>';
                                            bookedhtml += '</tr>';
                                            $sr_no++;
                                        });
                                        bookedhtml += '</table>';
                                        bookedhtml += '</div>';
                                        
                                            
                                            bookedhtml += '<div class="col-sm-4 col-md-4">'+detail.checkin_date+' <br />'+detail.checkout_date+'</div>';
                                        bookedhtml += '</div>';  
                                    bookedhtml += '</div>';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+detail.price+'</div>';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">Email</div>'; 
                                bookedhtml += '</div>';
                                
                                bookedhtml += '<div class="col-sm-12 col-md-12">Reservartion: '+detail.booking_number+' </div>'; 
                                bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<div class="row">';
                                            bookedhtml += '<div class="col-sm-8 col-md-8">'+detail.room_name+'</div>';  
                                            bookedhtml += '<div class="col-sm-4 col-md-4">'+detail.checkin_date+' <br />'+detail.checkout_date+'</div>';
                                        bookedhtml += '</div>';  
                                    bookedhtml += '</div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+detail.price+'</div>'; 
                                 
                                bookedhtml += '<div class="col-sm-12 col-md-12" style="font-size:11px;">created: '+detail.created_date+'</div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12"><hr /></div>';
                                              
                            }
                        });
                        
                        $("#bookingdetailbody").html(bookedhtml);
                        $("#reservationsmodal").modal('show');
                        
    				}
    			  }
    			});
            }
            
            return false;
        }
        
        function clickonBookingpopuphtml(contentArray){ 
            
            bookedhtml = '';
            $sr_no = 1;
            if(typeof bookedDetails[clickedDate] != 'undefined'){
                
                var arrBookedDet = bookedDetails[clickedDate];
                
                $.each(arrBookedDet,function(bid,bval){
                    //bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px">'+bval.data.guest_names+'</span></div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px"></span></div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12 m--align-right"><button class="btn btn-primary btn-sm" id="confirmReservation" type="button" onclick="confirm_reservation('+bval.id+');">Confirm</button>&nbsp;<button class="btn btn-danger btn-sm" id="confirmRejected" type="button" onclick="rejected_reservation('+bval.id+');">Rejected</button></div>'; 
                    bookedhtml += '<div style="background: #eeeeee; padding: 5px 0px;">';
                        bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<div class="row">';
                            
                            bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<table>';
                            $.each(bval.reserved_rooms,function(reid,reval){                            
                                bookedhtml += '<tr>';
                                    bookedhtml += '<td>';
                                        bookedhtml += 'Room'+$sr_no;
                                    bookedhtml += '</td>';
                                    bookedhtml += '<td>';
                                        bookedhtml += reval.category_name;
                                    bookedhtml += '</td>';
                                    bookedhtml += '<td>';
                                        bookedhtml += '<div class="col-sm-8 col-md-8"><select class="form-control" id="dd_rooms"><option value="0">Select</option></select></div>';  
                                    bookedhtml += '</td>';
                                bookedhtml += '</tr>';
                                $sr_no++;
                            });
                            bookedhtml += '</table>';
                            bookedhtml += '</div>';
                            
                                
                                bookedhtml += '<div class="col-sm-4 col-md-4">'+bval.checkin_date+' <br />'+bval.checkout_date+'</div>';
                            bookedhtml += '</div>';  
                        bookedhtml += '</div>';
                        bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+bval.price+'</div>';
                        bookedhtml += '<div class="col-sm-12 col-md-12">Email</div>'; 
                    bookedhtml += '</div>';
                    
                    bookedhtml += '<div class="col-sm-12 col-md-12">Reservartion: '+bval.booking_number+' </div>'; 
                    bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<div class="row">';
                                bookedhtml += '<div class="col-sm-8 col-md-8">'+bval.room_name+'</div>';  
                                bookedhtml += '<div class="col-sm-4 col-md-4">'+bval.checkin_date+' <br />'+bval.checkout_date+'</div>';
                            bookedhtml += '</div>';  
                        bookedhtml += '</div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+bval.price+'</div>'; 
                     
                    bookedhtml += '<div class="col-sm-12 col-md-12" style="font-size:11px;">created: '+bval.created_date+'</div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12"><hr /></div>';
                });
                $("#bookingdetailbody").html(bookedhtml);
                $("#reservationsmodal").modal('show');
            }
    
            return false;
        }
        
        function get_room_reserved(obj){ 
            var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
    		var current_date = new Date(cal_start);
    		var end_date = new Date(cal_end);
    		var end_date_time = end_date.getTime();
    		var today = new Date();
    		var tophtml = bothtml = roomhtml = dhtml = '';
    		var cellCount = 1;
            var bookedDates = new Array();
            //console.log(obj);
            //get booked dates tobj.reservation
            $.each(obj,function(tid,tval){ 
                var tchecIndate = new Date(tval.checkin_date);
                var tchecOutdate = new Date(tval.checkout_date);
                while (tchecIndate.getTime() <= tchecOutdate) {
                    var tttdate = tchecIndate.getFullYear()+'-'+(tchecIndate.getMonth() + 1)+'-'+tchecIndate.getDate();
                    if(!isInArray(tttdate,bookedDates)){bookedDates.push(tttdate);}
                    tchecIndate.setDate(tchecIndate.getDate()+1);
                    
                    if((typeof bookedDetails[tttdate]) == 'undefined'){ bookedDetails[tttdate] = new Array(); }
                    if((typeof bookedNumbersDetails[tttdate]) == 'undefined'){ bookedNumbersDetails[tttdate] = new Array(); }
                    if(!isInArray(tval.id,bookedNumbersDetails[tttdate])){bookedNumbersDetails[tttdate].push(tval.id); bookedDetails[tttdate].push(tval);}
                    //bookedDetails[tttdate].push(tval);
                }
            }); 
            //end
            console.log(bookedNumbersDetails,' final');
    		while (current_date.getTime() <= end_date_time) {
    			var day = current_date.getDay();
    			var iweekend = dweekend = '';
    			var itoday = '';
    			if(day === 6 || day === 0)
    			{
    				iweekend = 'weekend';
    				dweekend = 'weekend_days';
    			}
    			if(today.getDate()==current_date.getDate() && today.getMonth()==current_date.getMonth() && today.getFullYear()==current_date.getFullYear())
    			{
    				itoday = 'today';
    			}
    			tophtml += '<div class="cols top_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    			
    			bothtml += '<div class="cols bottom_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    			
    			var d = ("0" + current_date.getDate()).slice(-2);
    			var m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			var dateData = {'year':current_date.getFullYear(),'month':m,'date':d};
                
                var ttdate = current_date.getFullYear()+'-'+(current_date.getMonth() + 1)+'-'+current_date.getDate();
                //console.log(bookedDates,ttdate);
                    if(isInArray(ttdate,bookedDates)){
                        var totalReservations = 0;
                        var reservationIds = new Array();                    
                        var currentObj = bookedDetails[ttdate];
                        dhtml += '<div class="cols right_border_gray scell selectedCell BookedCell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\' onclick="return clickonBooking(event,\''+ttdate+'\');"><span>'+bookedDetails[ttdate].length+'</span></div>';                                        
                    }else{
                        dhtml += '<div class="cols right_border_gray scell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\'></div>';
                    }                 
                
    			current_date.setDate(current_date.getDate()+1);
    			cellCount++;
    	   }
           return dhtml;
        }
        function confirm_reservation(id){
            if(id!='')
    		{
    			$.ajax({
    			  url: "{{ URL::to('confirmreservation')}}",
    			  type: "post",
    			  data: {'id':id},
    			  dataType: "json",
    			  success: function(data){
    				var html = '';
    				if(data.status=='error')
    				{
    					alert('error');
    				}
    				else
    				{
    					html += '<div class="modal-body">';
    					html += '<h2>Reservation Submitted Successfully!</h2>';
    					html += '</div>';
    					html += '<div class="modal-footer">';
    					html += '<button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>';
    					html += '</div>';
    					$('#reserforms').html(html);
    				}
    			  }
    			});
    		}
        }
        
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
