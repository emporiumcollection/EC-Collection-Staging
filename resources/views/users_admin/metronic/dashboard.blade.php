@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Dashboard
@stop
    
@section('subheader_search')
    <?php /* <div class="m-subheader-search">
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
    </div> */ ?>
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
    @if(!empty($pageslider))
    <section class="sliderSection termConditionSlider">
        <div id="restaurantSlider" class="carousel" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach($pageslider as $key => $slider_row)
                  <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
                    <div class="carousel-caption">
                      <a href="#">
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
    @endif
    <div class="m--clearfix" style="clear: both;"><br /></div>
    <!--Begin::Section_portlet-->
    <div class="m-portlet">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			    <div class="row">
					<div class="col-sm-12 col-md-4 col-xl-4">
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
														Complete your profile
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
														Subscribe to Membership Packages
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
														Add your Hotel(s) 
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
														Add your Rooms & Seasons
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
														Add your Rates
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
														Add your Restaurant's, Bar & Spa
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
														Add your Events & Special Occassions
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
														Review the Quality Assurance Guidelines
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
														Like Emporium Voyage
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
														Invite Guest to Elite Members Club
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
														Review Hotel Marketing Packages
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
														Add your Restaurant's, Bar & Spa
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
					<div class="col-sm-12 col-md-4 col-xl-4">
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
				<!--End::Section-->
                
		</div>
	</div>
	<div class="m-portlet">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
				<div class="col-xl-6">
					<!--begin:: Widgets/Stats2-1 -->
					<div class="m-widget1">
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Dashboard & Profile
									</h3>									
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Stats2-1 -->
				</div>
				<div class="col-xl-6">
					<!--begin:: Widgets/Daily Sales-->
					<div class="m-widget14">
						<div class="m-widget14__header m--margin-bottom-30">
							<h3 class="m-widget14__title">
								Membership & Support Services
							</h3>
						</div>						
					</div>
					<!--end:: Widgets/Daily Sales-->
				</div>				
			</div>
		</div>
  </div>
  <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
				<div class="col-xl-12">
					<!--begin:: Widgets/Activity-->
					<div class="m-portlet m-portlet--bordered-semi m-portlet--widget-fit m-portlet--full-height m-portlet--skin-light  m-portlet--rounded-force">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text m--font-light">
										Activity
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
												<i class="flaticon-truck m--font-brand"></i>
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
			</div>
		</div>
  </div>
  <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
				<div class="col-xl-12">
					<!--begin:: Widgets/Stats2-1 -->
					<div class="m-widget1">
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										 Sales & Marketing
									</h3>									
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Stats2-1 -->
				</div>							
			</div>
		</div>
  </div>
  <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
				<div class="col-xl-12">
					<!--begin:: Widgets/Stats2-1 -->
					<div class="m-widget1">
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										 Quality Assurance
									</h3>									
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Stats2-1 -->
				</div>							
			</div>
		</div>
	</div>
	<!--End::Section_portlet-->
    
    <!--Begin::Section-->
	<?php /* <div class="row">
		<div class="col-xl-12">
			<div class="m-portlet m-portlet--mobile ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Exclusive Datatable Plugin
							</h3>
						</div>
					</div>
					<div class="m-portlet__head-tools">
						<ul class="m-portlet__nav">
							<li class="m-portlet__nav-item">
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
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
																Quick Actions
															</span>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
																	Create Post
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-chat-1"></i>
																<span class="m-nav__link-text">
																	Send Messages
																</span>
															</a>
														</li>
														<li class="m-nav__item">
															<a href="" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-multimedia-2"></i>
																<span class="m-nav__link-text">
																	Upload File
																</span>
															</a>
														</li>
														<li class="m-nav__section">
															<span class="m-nav__section-text">
																Useful Links
															</span>
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
														<li class="m-nav__separator m-nav__separator--fit m--hide"></li>
														<li class="m-nav__item m--hide">
															<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																Submit
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="m-portlet__body">
					<!--begin: Datatable -->
					<div class="m_datatable" id="m_datatable_latest_orders"></div>
					<!--end: Datatable -->
				</div>
			</div>
		</div>		
	</div>
	<!--End::Section--> */ ?>
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="{{ asset('metronic/assets/demo/demo6/base/bootstrap.css') }}" rel="stylesheet">    
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
        padding-top: 1.00rem !important;
    }
    </style>
@endsection
{{-- For custom style  --}}
@section('custom_js_script')
    @parent
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>    
    <script src="{{ asset('metronic/assets/demo/demo6/base/bootstrap.js') }}"></script>  
    <script src="{{ asset('themes/emporium/js/owl.carousel.js') }}"></script>  
@endsection