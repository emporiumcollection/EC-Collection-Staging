                        <!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
                                        <?php /* <ul class="m-topbar__nav m-nav m-nav--inline"> */ ?>
										<?php /* <li class="
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
										</li> */ ?>
										<?php /* <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
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
                                            @if(!\CommonHelper::checkDeactivatedUser())
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
																		<a href="{{ URL::to('user/profile')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-profile-1"></i>
																			<span class="m-nav-grid__text">
																				My Profile
																			</span>
																		</a>
                                                                        <a href="{{ URL::to('user/preferences')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-interface-6"></i>
																			<span class="m-nav-grid__text">
																				My Preferences
																			</span>
																		</a>
																		
																	</div>
																	<div class="m-nav-grid__row">
																		<a href="{{ URL::to('user/settings')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-settings-1"></i>
																			<span class="m-nav-grid__text">
																				Account Settings
																			</span>
																		</a>
                                                                        <a href="{{ URL::to('user/invite')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-mail-1"></i>
																			<span class="m-nav-grid__text">
																				Guest Invitations
																			</span>
																		</a>
																		
																	</div>
                                                                    <div class="m-nav-grid__row">
																		<a href="#" class="m-nav-grid__item" id="top_menu_communication">
																			<i class="m-nav-grid__icon flaticon-computer"></i>
																			<span class="m-nav-grid__text">
																				Communication
																			</span>
																		</a>
                                                                        <a href="{{ URL::to('user/companion')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-users"></i>
																			<span class="m-nav-grid__text">
																				Companions
																			</span>
																		</a>
																	</div>
                                                                    <div class="m-nav-grid__row">
																		<a href="{{URL::to('user/security')}}" class="m-nav-grid__item" id="top_menu_communication">
																			<i class="m-nav-grid__icon flaticon-lock-1"></i>
																			<span class="m-nav-grid__text">
																				Security &amp; Privacy
																			</span>
																		</a>
                                                                        <a href="{{ URL::to('traveller/invoices')}}" class="m-nav-grid__item">
																			<i class="m-nav-grid__icon flaticon-diagram"></i>
																			<span class="m-nav-grid__text">
																				Billings & Contracts
																			</span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
                                            @endif
										</li> */ ?>
										<li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" >
											<a href="" class="m-nav__link profile-menu">
												<span class="m-topbar__userpic">
                                                    {!! SiteHelpers::avatarProfile(80,80,'m--img-rounded m--marginless m--img-centered') !!}
												</span>
												<!--<span class="m-nav__link-icon m-topbar__usericon">
													<span class="m-nav__link-icon-wrapper">
														<i class="flaticon-user-ok"></i>
													</span>
												</span>-->
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
                                                                @if(!\CommonHelper::checkDeactivatedUser())
																<li class="m-nav__item">
																	<a href="{{ URL::to('user/profile')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				My Profile
																			</span>
																		</span>
																	</a>
																</li>
                                                                
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/preferences')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-interface-6"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				My Preferences
																			</span>
																		</span>
																	</a>
																</li>	                                                                
                                                                																
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('traveller/bookings')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-book"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				My Reservations
																			</span>
																		</span>
																	</a>
																</li>
																<li class="m-nav__item">
																	<a href="{{ URL::to('user/companion')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-user-add"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				 My Companions
																			</span>
																		</span>
																	</a>
																</li>
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/invite')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-suitcase"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				  Invite Guests / Invite Guest System
																			</span>
																		</span>
																	</a>
																</li>
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/settings')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-settings"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				  Account Settings
																			</span>
																		</span>
																	</a>
																</li> 
                                                                
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('user/security')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lock-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				  Security &amp; Privacy
																			</span>
																		</span>
																	</a>
																</li> 
                                                                
                                                                <li class="m-nav__item">
																	<a href="{{ URL::to('traveller/invoices')}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-diagram"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				  Billings & Contracts
																			</span>
																		</span>
																	</a>
																</li> 
                                                               
																<li class="m-nav__separator m-nav__separator--fit"></li>
                                                                @endif 	
																<li class="m-nav__item">
																	<a href="{{ URL::to('user/logout')}}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"> {{ Lang::get('core.m_logout') }} </a>
																</li>
															</ul>
														</div>
													</div>
                                                    
												</div>
											</div>
										</li>
                                        @if(!\CommonHelper::checkDeactivatedUser())
										<li id="m_quick_sidebar_toggle" class="m-nav__item">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon m-nav__link-icon-alt">
													<span class="m-nav__link-icon-wrapper">
														<i class="ico ico-club"></i>
													</span>
												</span>
											</a>
										</li>
                                        @endif
									</ul>
								</div>
                                
                                
                                
                                <div class="tbl-row">
                                
                                <div class="d-flex justify-content-end align-items-center">
                                  <div class="mr-3">
                                    <div class="dropdown">
                                      <a href="#" class="text-dark" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>-</span> EN
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(34px, 19px, 0px);">
                                        <a class="dropdown-item" href="#">EN</a>
                                        <a class="dropdown-item" href="#">GE</a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="humburger-menu">
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                  </div>
                                  <div class="menu">
                                    <a href="#" class="close-menu">
                                      <svg fill="currentColor" focusable="false" height="40px" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Close</title>
                                        <path d="M10.586 12L3.793 5.206a1 1 0 1 1 1.413-1.413L12 10.586l6.794-6.793a1 1 0 1 1 1.413 1.413L13.414 12l6.793 6.794a1 1 0 1 1-1.413 1.413L12 13.414l-6.794 6.793a1 1 0 1 1-1.413-1.413L10.586 12z">
                                        </path>
                                      </svg>
                                    </a>
                                    <div class="container h-100 d-flex align-items-center">
                                      <div class="row w-100">
                                        <div class="col-4">
                                          <ul class="nav flex-column nav-sidebar" data-wow-delay=".3s">
                                            <li class="nav-item">
                                              <a class="nav-link active" href="#">Boutique</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Design</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Lifestyle</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Beach</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Cullinary</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Urban</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="#">Infinity</a>
                                            </li>
                                          </ul>
                        
                                          <div class="menu-media">
                                            <a href="#" class="nav-sos"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#" class="nav-sos"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#" class="nav-sos"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="row">
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="row">
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="pmenu">
                                    <a href="#" class="close-profile-menu">
                                      <svg fill="currentColor" focusable="false" height="40px" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Close</title>
                                        <path d="M10.586 12L3.793 5.206a1 1 0 1 1 1.413-1.413L12 10.586l6.794-6.793a1 1 0 1 1 1.413 1.413L13.414 12l6.793 6.794a1 1 0 1 1-1.413 1.413L12 13.414l-6.794 6.793a1 1 0 1 1-1.413-1.413L10.586 12z">
                                        </path>
                                      </svg>
                                    </a>
                                    <div class="container h-100 d-flex align-items-center">
                                      <div class="row w-100">
                                        <div class="col-4">
                                          <ul class="nav flex-column nav-sidebar" data-wow-delay=".3s">
                                            <li class="nav-item">
                                              <a class="nav-link active" href="{{ URL::to('user/profile')}}">My Profile</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/preferences')}}">My Preferences</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('traveller/bookings')}}">My Reservations</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/settings')}}">Account Settings</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/invite')}}">Guest Invitations</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/companion')}}">Companions</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/security')}}">Security &amp; Privacy</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('traveller/invoices')}}">Billings & Contracts</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" href="{{ URL::to('user/logout')}}">Log Out</a>
                                            </li>
                                          </ul>
                        
                                          <div class="menu-media">
                                            <a href="#" class="nav-sos"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#" class="nav-sos"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#" class="nav-sos"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="row">
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="row">
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="col-6">
                                              <ul class="nav flex-column">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Active <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#">Link <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
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
							<!-- END: Topbar -->