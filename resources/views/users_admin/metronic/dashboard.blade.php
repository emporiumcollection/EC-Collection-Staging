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
    <!--Begin::Section_portlet-->
    <div class="m-portlet">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			Space for slider            
		</div>
	</div>
	<?php /* <div class="m-portlet">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl">
				<div class="col-xl-4">
					<!--begin:: Widgets/Stats2-1 -->
					<div class="m-widget1">
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Member Profit
									</h3>
									<span class="m-widget1__desc">
										Awerage Weekly Profit
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-brand">
										+$17,800
									</span>
								</div>
							</div>
						</div>
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Orders
									</h3>
									<span class="m-widget1__desc">
										Weekly Customer Orders
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-danger">
										+1,800
									</span>
								</div>
							</div>
						</div>
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Issue Reports
									</h3>
									<span class="m-widget1__desc">
										System bugs and issues
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-success">
										-27,49%
									</span>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Stats2-1 -->
				</div>
				<div class="col-xl-4">
					<!--begin:: Widgets/Daily Sales-->
					<div class="m-widget14">
						<div class="m-widget14__header m--margin-bottom-30">
							<h3 class="m-widget14__title">
								Daily Sales
							</h3>
							<span class="m-widget14__desc">
								Check out each collumn for more details
							</span>
						</div>
						<div class="m-widget14__chart" style="height:120px;">
							<canvas  id="m_chart_daily_sales"></canvas>
						</div>
					</div>
					<!--end:: Widgets/Daily Sales-->
				</div>
				<div class="col-xl-4">
					<!--begin:: Widgets/Profit Share-->
					<div class="m-widget14">
						<div class="m-widget14__header">
							<h3 class="m-widget14__title">
								Profit Share
							</h3>
							<span class="m-widget14__desc">
								Profit Share between customers
							</span>
						</div>
						<div class="row  align-items-center">
							<div class="col">
								<div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
									<div class="m-widget14__stat">
										45
									</div>
								</div>
							</div>
							<div class="col">
								<div class="m-widget14__legends">
									<div class="m-widget14__legend">
										<span class="m-widget14__legend-bullet m--bg-accent"></span>
										<span class="m-widget14__legend-text">
											37% Sport Tickets
										</span>
									</div>
									<div class="m-widget14__legend">
										<span class="m-widget14__legend-bullet m--bg-warning"></span>
										<span class="m-widget14__legend-text">
											47% Business Events
										</span>
									</div>
									<div class="m-widget14__legend">
										<span class="m-widget14__legend-bullet m--bg-brand"></span>
										<span class="m-widget14__legend-text">
											19% Others
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Profit Share-->
				</div>
			</div>
		</div>
	</div> */ ?>
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
