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
			
			<!--begin:: Widgets/Sale Reports-->
			<div class="m-portlet m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								My Reservations
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
												<td class="m-widget11__app">
													Guest
												</td>
												<td class="m-widget11__sales">
													Number
												</td>
												<td class="m-widget11__price">
													Price
												</td>
												<td class="m-widget11__total m--align-right">
													
												</td>
											</tr>
										</thead>
										<!--end::Thead-->
<!--begin::Tbody-->
										<tbody>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
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
												<td class="m-widget11__app">
													Guest
												</td>
												<td class="m-widget11__sales">
													Number
												</td>
												<td class="m-widget11__price">
													Price
												</td>
												<td class="m-widget11__total m--align-right">
													
												</td>
											</tr>
										</thead>
										<!--end::Thead-->
<!--begin::Tbody-->
										<tbody>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
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
            
            
            <!--begin:: Widgets/Sale Reports-->
			<div class="m-portlet m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Event Reservations
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
												<td class="m-widget11__app">
													Guest
												</td>
												<td class="m-widget11__sales">
													Number
												</td>
												<td class="m-widget11__price">
													Price
												</td>
												<td class="m-widget11__total m--align-right">
													
												</td>
											</tr>
										</thead>
										<!--end::Thead-->
<!--begin::Tbody-->
										<tbody>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
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
												<td class="m-widget11__app">
													Guest
												</td>
												<td class="m-widget11__sales">
													Number
												</td>
												<td class="m-widget11__price">
													Price
												</td>
												<td class="m-widget11__total m--align-right">
													
												</td>
											</tr>
										</thead>
										<!--end::Thead-->
<!--begin::Tbody-->
										<tbody>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														John
													</span>
												</td>
												<td>
													3
												</td>
												<td>
													$63
												</td>
												<td class="m--align-right m--font-brand">
													View
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
	</div>
</div>

<!-- Second Row -->
<div class="parent_my preferences">           
    <div class="m-subheader" style="padding: 0px; margin-bottom: 20px;">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					My preferences
				</h3>
			</div>
		</div>
	</div> 
   
    <div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
            <!--begin:: Widgets/User Progress -->
			<div class="m-portlet m-portlet--full-height ">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								My preferences
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
				    <div class="table-responsive">
									<!--begin::Table-->
									<table class="table">
										<!--begin::Thead-->
										<thead>
											<tr>
												<td class="m-widget11__app">
													Property Name
												</td>
												<td class="m-widget11__sales">
													Property City
												</td>
												<td class="m-widget11__price">
													Website
												</td>
												<td class="m-widget11__total m--align-right">
													Email
												</td>
											</tr>
										</thead>
										<!--end::Thead-->
<!--begin::Tbody-->
										<tbody>
											<tr>												
												<td>
													<span class="m-widget11__title">
														The Mark
													</span>
												</td>
												<td>
													New York
												</td>
												<td>
												    www.themarkhotel.com/
												</td>
												<td class="m--align-right m--font-brand">
													riaan@number7even.com
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														The Mark
													</span>
												</td>
												<td>
													New York
												</td>
												<td>
												    www.themarkhotel.com/
												</td>
												<td class="m--align-right m--font-brand">
													riaan@number7even.com
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														The Mark
													</span>
												</td>
												<td>
													New York
												</td>
												<td>
												    www.themarkhotel.com/
												</td>
												<td class="m--align-right m--font-brand">
													riaan@number7even.com
												</td>
											</tr>
											<tr>												
												<td>
													<span class="m-widget11__title">
														The Mark
													</span>
												</td>
												<td>
													New York
												</td>
												<td>
												    www.themarkhotel.com/
												</td>
												<td class="m--align-right m--font-brand">
													riaan@number7even.com
												</td>
											</tr>
										</tbody>
										<!--end::Tbody-->
									</table>
									<!--end::Table-->		
                      </div>				
				</div>
			</div>
			<!--end:: Widgets/User Progress -->
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
					Refer Friend
				</h3>
			</div>
		</div>
	</div> 
    
	<div class="row">
		<div class="col-sm-12 col-md-6 col-xl-6">
            <!--begin:: Widgets/New Users-->
																<div class="m-portlet m-portlet--full-height ">
																	<div class="m-portlet__head">
																		<div class="m-portlet__head-caption">
																			<div class="m-portlet__head-title">
																				<h3 class="m-portlet__head-text">
																					Refer Friend
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
																								Follow
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
        <div class="col-sm-12 col-md-6 col-xl-6">
            <!--begin:: Widgets/New Users-->
																<div class="m-portlet m-portlet--full-height ">
																	<div class="m-portlet__head">
																		<div class="m-portlet__head-caption">
																			<div class="m-portlet__head-title">
																				<h3 class="m-portlet__head-text">
																					My shortlist's
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
																								Follow
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
    </div>
</div>

<!-- End Third Row -->

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