                        <!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
                                        <ul class="m-topbar__nav m-nav m-nav--inline">
										<li class="
	m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" 
	m-dropdown-toggle="click" id="m_quicksearch" m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
                                                    <span class="m-nav__link-icon-wrapper">
													   <i class="flaticon-search-1"></i>
                                                    </span>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner ">
													<div class="m-dropdown__header">
														<form  class="m-list-search__form">
															<div class="m-list-search__form-wrapper">
																<span class="m-list-search__form-input-wrapper">
																	<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
																</span>
																<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
																	<i class="la la-remove"></i>
																</span>
															</div>
														</form>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
															<div class="m-dropdown__content"></div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
											<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-music-2"></i>
													</span>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center">
														<span class="m-dropdown__header-title">
															User Notifications
														</span>
														<span class="m-dropdown__header-subtitle">
															
														</span>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
																		Alerts
																	</a>
																</li>
                                                                @if(CNF_MULTILANG ==1)
																<li class="nav-item m-tabs__item">
																	<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
																		Languages
																	</a>
																</li>
                                                                @endif
															</ul>
															<div class="tab-content">
																<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items notif-value" code="{{ url()}}">
																				<div class="m-list-timeline__item" style="display: none;">
																					<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																					<span class="m-list-timeline__text">
																						12 new users registered
																					</span>
																					<span class="m-list-timeline__time">
																						Just now
																					</span>
																				</div>
																				<div class="m-list-timeline__item">
																					<span class="m-list-timeline__text text-center">
																						<a href="{{ url('notification') }}"><strong>View All Notification</strong> <i class="fa fa-angle-right"></i></a>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
                                                                
                                                                @if(CNF_MULTILANG ==1)
																<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
																	<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
																		<div class="m-list-timeline m-list-timeline--skin-light">
																			<div class="m-list-timeline__items">
                                                                                @foreach(SiteHelpers::langOption() as $lang)
                                                                                    <div class="m-list-timeline__item">
    																					<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
    																					<a href="{{ URL::to('home/lang/'.$lang['folder'])}}" class="m-list-timeline__text"><i class="icon-flag"></i> {{  $lang['name'] }}</a>
    																				</div>
                                                                                @endforeach
																			</div>
																		</div>
																	</div>
																</div>
                                                                @endif
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-share"></i>
													</span>
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center">
														<span class="m-dropdown__header-title">
															Quick Actions
														</span>
														<span class="m-dropdown__header-subtitle">
															Shortcuts
														</span>
													</div>
													<div class="m-dropdown__body m-dropdown__body--paddingless">
														<div class="m-dropdown__content">
															<div class="m-scrollable" data-scrollable="false" data-height="380" data-mobile-height="200">
																<div class="m-nav-grid m-nav-grid--skin-light">
																	<div class="m-nav-grid__row">
																		<a href="{{ URL::to('dashboard')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-dashboard"></i>
																			<span class="m-nav-grid__text">
																				Property Management
																			</span>
																		</a>
																		<a href="{{ URL::to('')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-imac"></i>
																			<span class="m-nav-grid__text">
																				Reservation Management
																			</span>
																		</a>
																	</div>
																	<div class="m-nav-grid__row">
																		<a href="{{ URL::to('core/elfinder')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-folder-4"></i>
																			<span class="m-nav-grid__text">
																				Sales Reports
																			</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-clipboard"></i>
																			<span class="m-nav-grid__text">
																				View Modules
																			</span>
																		</a>
																	</div>
                                                                    <div class="m-nav-grid__row">
																		<a href="{{ URL::to('core/elfinder')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-folder-4"></i>
																			<span class="m-nav-grid__text">
																				Cancelations
																			</span>
																		</a>
																		<a href="#" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-clipboard"></i>
																			<span class="m-nav-grid__text">
																				Arrivals & Departures
																			</span>
																		</a>
																	</div>
                                                                    <div class="m-nav-grid__row">
																		<a href="{{ URL::to('core/elfinder')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-folder-4"></i>
																			<span class="m-nav-grid__text">
																				Advertising
																			</span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</li>
										<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" onclick="return false;" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic m--hide">
                                                    {!! SiteHelpers::avatarProfile(80,80,'m--img-rounded m--marginless m--img-centered') !!}
												</span>
												<span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-user-ok"></i>
													</span>
												</span>
												<span class="m-topbar__username m--hide">
													{{ Session::get('fid') }}
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center">
														<div class="m-card-user m-card-user--skin-light">
															<div class="m-card-user__pic">
                                                                {!! SiteHelpers::avatarProfile(80,80,'m--img-rounded m--marginless') !!}
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{ Session::get('fid') }}
																</span>
																<a href="#" onclick="return false;" class="m-card-user__email m--font-weight-300 m-link">
																	{{ Session::get('eid') }}
																</a>
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
																</li>
																<li class="m-nav__item">
																	<a href="{{ URL::to('user/profile')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				{{ Lang::get('profile.my-profile') }}
																			</span>
																		</span>
																	</a>
																</li>
																
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('hotel/bookings')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				My Reservations
																			</span>
																		</span>
																	</a>
																</li>
                                                                
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/profile')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-suitcase"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				{{ Lang::get('profile.my-company') }}
																			</span>
																		</span>
																	</a>
																</li>
																
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/profile')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-user"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				{{ Lang::get('profile.my-users') }}
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__separator m-nav__separator--fit"></li>
                                                                
																<li class="m-nav__item">
																	<a href="{{ URL::to('user/logout')}}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"> {{ Lang::get('core.m_logout') }} </a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
                                        
										<li id="m_quick_sidebar_toggle" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon m-nav__link-icon-alt">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-grid-menu"></i>
													</span>
												</span>
											</a>
										</li>
                                        
									</ul>
								</div>
							</div>
							<!-- END: Topbar -->