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
				<div class="col-sm-12 col-md-4 col-xl-4">
					
                    
                    <!--begin:: Widgets/Announcements 2-->
					<div class="m-portlet m--bg-danger m-portlet--bordered-semi m-portlet--skin-dark m-portlet--full-height ">
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
										<img class="m-widget7__img" src="../../assets/app/media/img//users/100_5.jpg" alt="">
									</div>
									<div class="m-widget7__info">
										<span class="m-widget7__username">
											Nick Mana
										</span>
										<br>
										<span class="m-widget7__time">
											6 hours ago
										</span>
									</div>
								</div>
								<div class="m-widget7__button">
									<a class="m-btn m-btn--pill btn btn-accent" href="#" role="button">
										All Feeds
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
										Authors Profit
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
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
									<div class="m-widget4__img m-widget4__img--logo">
										<img src="assets/app/media/img/client-logos/logo5.png" alt="">
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Trump Themes
										</span>
										<br>
										<span class="m-widget4__sub">
											Make Metronic Great Again
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											+$2500
										</span>
									</span>
								</div>
								<div class="m-widget4__item">
									<div class="m-widget4__img m-widget4__img--logo">
										<img src="assets/app/media/img/client-logos/logo4.png" alt="">
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											StarBucks
										</span>
										<br>
										<span class="m-widget4__sub">
											Good Coffee & Snacks
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											-$290
										</span>
									</span>
								</div>
								<div class="m-widget4__item">
									<div class="m-widget4__img m-widget4__img--logo">
										<img src="assets/app/media/img/client-logos/logo3.png" alt="">
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											Phyton
										</span>
										<br>
										<span class="m-widget4__sub">
											A Programming Language
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											+$17
										</span>
									</span>
								</div>
								<div class="m-widget4__item">
									<div class="m-widget4__img m-widget4__img--logo">
										<img src="assets/app/media/img/client-logos/logo2.png" alt="">
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											GreenMakers
										</span>
										<br>
										<span class="m-widget4__sub">
											Make Green Great Again
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											-$2.50
										</span>
									</span>
								</div>
								<div class="m-widget4__item">
									<div class="m-widget4__img m-widget4__img--logo">
										<img src="assets/app/media/img/client-logos/logo1.png" alt="">
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											FlyThemes
										</span>
										<br>
										<span class="m-widget4__sub">
											A Let's Fly Fast Again Language
										</span>
									</div>
									<span class="m-widget4__ext">
										<span class="m-widget4__number m--font-brand">
											+$200
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
													Earnings
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
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
										<div class="m-widget30">
											<div class="m-widget_head">
												<div class="m-widget_head-owlcarousel-items owl-carousel">
													<div class="m-widget_head-owlcarousel-item carousel">
														<span>
															KeenThemes
														</span>
														<span>
															Admin Themes
														</span>
													</div>
													<div class="m-widget_head-owlcarousel-item carousel">
														<span>
															Creek State
														</span>
														<span>
															WP Experts
														</span>
													</div>
													<div class="m-widget_head-owlcarousel-item carousel">
														<span>
															Onteco
														</span>
														<span>
															Social Networks
														</span>
													</div>
												</div>
											</div>
											<div class="m-widget_body">
												<div class="m-widget_body-owlcarousel-items owl-carousel" id="m_widget_body_owlcarousel_items">
													<div class="m-widget_body-owlcarousel-item carousel">
														<div class="m-widget_body-items">
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_4.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Amy Black
																	</span>
																	<span>
																		A Programming Language
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$381
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_3.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Mike Green
																	</span>
																	<span>
																		Programming Language Definition
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$17
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_7.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jade Blue
																	</span>
																	<span>
																		Let's Fly Fast Again
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$200
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/300_9.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jimmy Grey
																	</span>
																	<span>
																		Good Coffee & Snacks
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		-$290
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget_body-owlcarousel-item carousel">
														<div class="m-widget_body-items">
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_3.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Mike Green
																	</span>
																	<span>
																		Programming Computers in Everyday
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$17
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_4.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Amy Black
																	</span>
																	<span>
																		A Programming Language
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$381
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_9.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jimmy Grey
																	</span>
																	<span>
																		Let's Fly Fast Again
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		-$290
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/300_7.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jade Blue
																	</span>
																	<span>
																		Good Coffee & Snacks
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$200
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="m-widget_body-owlcarousel-item carousel">
														<div class="m-widget_body-items">
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_7.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jade Blue
																	</span>
																	<span>
																		Good Coffee & Snacks
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$200
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_9.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Jimmy Grey
																	</span>
																	<span>
																		Programming Language Definition
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		-$290
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/100_4.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Amy Black
																	</span>
																	<span>
																		Let's Fly Fast Again
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$381
																	</span>
																</div>
															</div>
															<div class="m-widget_body-item">
																<div class="m-widget_body-item-pic">
																	<img src="assets/app/media/img/users/300_3.jpg" title="">
																</div>
																<div class="m-widget_body-item-desc">
																	<span>
																		Mike Green
																	</span>
																	<span>
																		A Programming Language
																	</span>
																</div>
																<div class="m-widget_body-item-price">
																	<span>
																		+$17
																	</span>
																</div>
															</div>
														</div>
													</div>
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
  </div>
  <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
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
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/New Users-->
					<div class="m-portlet m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Guest Arrivals
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
											Today
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget4_tab2_content" role="tab">
											Month
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="m-portlet__body">
							<div class="tab-content">
								<div class="tab-pane active" id="m_widget4_tab1_content">
									<!--begin::Widget 14-->
									<div class="m-widget4">
										<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_4.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Anna Strong
												</span>
												<br>
												<span class="m-widget4__sub">
													Visual Designer,Google Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#"  class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Date of Arivals
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_14.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Milano Esco
												</span>
												<br>
												<span class="m-widget4__sub">
													Product Designer, Apple Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_11.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Nick Bold
												</span>
												<br>
												<span class="m-widget4__sub">
													Web Developer, Facebook Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_1.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Wiltor Delton
												</span>
												<br>
												<span class="m-widget4__sub">
													Project Manager, Amazon Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 		
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_5.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Nick Stone
												</span>
												<br>
												<span class="m-widget4__sub">
													Visual Designer, Github Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#"  class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item-->
									</div>
									<!--end::Widget 14-->
								</div>
								<div class="tab-pane" id="m_widget4_tab2_content">
									<!--begin::Widget 14-->
									<div class="m-widget4">
										<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_2.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Kristika Bold
												</span>
												<br>
												<span class="m-widget4__sub">
													Product Designer,Apple Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#"  class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_13.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Ron Silk
												</span>
												<br>
												<span class="m-widget4__sub">
													Release Manager, Loop Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_9.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Nick Bold
												</span>
												<br>
												<span class="m-widget4__sub">
													Web Developer, Facebook Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_2.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Wiltor Delton
												</span>
												<br>
												<span class="m-widget4__sub">
													Project Manager, Amazon Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item--> 		
<!--end::Widget 14 Item--> 
<!--begin::Widget 14 Item-->
										<div class="m-widget4__item">
											<div class="m-widget4__img m-widget4__img--pic">
												<img src="../../assets/app/media/img/users/100_8.jpg" alt="">
											</div>
											<div class="m-widget4__info">
												<span class="m-widget4__title">
													Nick Bold
												</span>
												<br>
												<span class="m-widget4__sub">
													Web Developer, Facebook Inc
												</span>
											</div>
											<div class="m-widget4__ext">
												<a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
													Follow
												</a>
											</div>
										</div>
										<!--end::Widget 14 Item-->
									</div>
									<!--end::Widget 14-->
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/New Users-->
                </div>
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Adwords Stats-->
					<div class="m-portlet m-portlet--full-height m-portlet--skin-light m-portlet--fit ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										AdWords Stats
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="m-portlet__nav">
									<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
										<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
											Today
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
  </div>
  <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
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
                
                <div class="col-sm-12 col-md-4 col-xl-4">
                    <!--begin:: Widgets/Sale Reports-->
					<div class="m-portlet m-portlet--full-height ">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Sales Reports
									</h3>
								</div>
							</div>
							<div class="m-portlet__head-tools">
								<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget11_tab1_content" role="tab">
											Last Month
										</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget11_tab2_content" role="tab">
											All Time
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
														<td class="m-widget11__label">
															#
														</td>
														<td class="m-widget11__app">
															Application
														</td>
														<td class="m-widget11__sales">
															Sales
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
																Vertex 2.0
															</span>
															<span class="m-widget11__sub">
																Vertex To By Again
															</span>
														</td>
														<td>
															19,200
														</td>
														<td>
															$63
														</td>
														<td class="m--align-right m--font-brand">
															$14,740
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
																Metronic
															</span>
															<span class="m-widget11__sub">
																Powerful Admin Theme
															</span>
														</td>
														<td>
															24,310
														</td>
														<td>
															$39
														</td>
														<td class="m--align-right m--font-brand">
															$16,010
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
																Apex
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
														<td class="m--align-right m--font-brand">
															$37,200
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
																Cascades
															</span>
															<span class="m-widget11__sub">
																Design Tool
															</span>
														</td>
														<td>
															11,094
														</td>
														<td>
															$16
														</td>
														<td class="m--align-right m--font-brand">
															$8,520
														</td>
													</tr>
												</tbody>
												<!--end::Tbody-->
											</table>
											<!--end::Table-->
										</div>
										<div class="m-widget11__action m--align-right">
											<button type="button" class="btn m-btn--pill btn-outline-brand m-btn m-btn--custom">
												Import Report
											</button>
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
											Sales Growth
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
											Product Growth
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
											Community Growth
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Product Sales-->
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
    .m-task-link{ text-decoration: none; color: #575962;}
    .m-task-link:hover{ text-decoration: none; color: #575962;}
    </style>
@endsection
{{-- For custom style  --}}
@section('custom_js_script')
    @parent
      
    <script src="{{ asset('metronic/assets/demo/demo6/base/bootstrap.js') }}"></script> 
    <script> 
    $('.carousel').carousel();
    </script>
@endsection