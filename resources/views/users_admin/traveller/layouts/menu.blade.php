                <?php $sidebar = SiteHelpers::menus('sidebar') ;?>
                <!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
					<!-- BEGIN: Aside Menu -->
                	<div 
                		id="m_ver_menu" 
                		class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " 
                		data-menu-vertical="true"
                		 m-menu-scrollable="1" m-menu-dropdown-timeout="500"  
                		>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                            
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                                <a href="{{ URL::to('dashboard')}}" class="m-menu__link"><i class="m-menu__link-icon fa fa-dashboard"></i> <span class="m-menu__link-text">Dashboard & Profile</span></a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu m-menu__item" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                    <a href="#" class="m-menu__link  m-menu__toggle ">                                    
                                        <i class="m-menu__link-icon icon-calendar"></i>
                                        <span class="m-menu__link-text">
                        						Reservation & Distribution
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                  
                                    <div class="m-menu__submenu " m-hidden-height="80" style="">
                                        <span class="m-menu__arrow"></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                                    <a href="{{ URL::to('properties')}}" class="m-menu__link">                           
                                                        <i class="m-menu__link-icon fa fa-home"></i>
                                                        <span class="m-menu__link-text">Property Management System</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                                    <a href="#" class="m-menu__link">
                                                        
                                                        <i class="m-menu__link-icon fa fa-plane"></i>
                                                        <span class="m-menu__link-text">
                                                            Reservation Management System
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>                                            
                                        </div>
                                                                    
                             </li> 
                            
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                                <a href="#" class="m-menu__link"><i class="m-menu__link-icon fa fa-flask"></i> <span class="m-menu__link-text">Sales & Marketing</span></a>
                            </li>
                            
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                                <a href="{{ URL::to('hotel/package')}}" class="m-menu__link"><i class="m-menu__link-icon fa fa-shopping-bag"></i> <span class="m-menu__link-text">Membership & Support Services</span></a>
                            </li>
                            
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                                <a href="#" class="m-menu__link"><i class="m-menu__link-icon fa fa-thumbs-up"></i> <span class="m-menu__link-text">Quality Assurance</span></a>
                            </li>
                            
                            
                           <?php /* @foreach ($sidebar as $menu)
                                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                                    <a  
                                    @if($menu['menu_type'] =='external')
                                        href="{{ $menu['url'] }}" 
                                    @else
                                        href="{{ URL::to($menu['module'])}}" 
                                    @endif
                                     
                                    class="m-menu__link @if(count($menu['childs']) > 0 ) m-menu__toggle @endif">
                                    
                                        <i class="m-menu__link-icon {{$menu['menu_icons']}}"></i>
                                        <span class="m-menu__link-text">
                                            @if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
                        						{{ $menu['menu_lang']['title'][Session::get('lang')] }}
                        					@else
                        						{{$menu['menu_name']}}
                        					@endif
                                        </span>
                                        @if(count($menu['childs']) > 0 ) <i class="m-menu__ver-arrow la la-angle-right"></i> @endif
                                    </a>
                                    
                                    @if(count($menu['childs']) > 0 )
                                        <div class="m-menu__submenu ">
                                            <span class="m-menu__arrow"></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
        											<span class="m-menu__link">
        												<span class="m-menu__link-text">
        													@if(CNF_MULTILANG ==1 && isset($menu['menu_lang']['title'][Session::get('lang')]))
                                        						{{ $menu['menu_lang']['title'][Session::get('lang')] }}
                                        					@else
                                        						{{$menu['menu_name']}}
                                        					@endif
        												</span>
        											</span>
        										</li>
                                                
                                                @foreach ($menu['childs'] as $menu2)
                                                <li class="m-menu__item " aria-haspopup="true"  m-menu-link-redirect="1" >
                                                    <a  
                                                        @if($menu2['menu_type'] =='external')
                                                            href="{{ $menu2['url'] }}" 
                                                        @else
                                                            href="{{ URL::to($menu2['module'])}}" 
                                                        @endif
                                                         
                                                        class="m-menu__link">
                                                        
                                                        <i class="m-menu__link-icon {{$menu2['menu_icons']}}"></i>
                                                        <span class="m-menu__link-text">
                                                            @if(CNF_MULTILANG ==1 && isset($menu2['menu_lang']['title'][Session::get('lang')]))
                                                                {{ $menu2['menu_lang']['title'][Session::get('lang')] }}
                                                            @else
                                                                {{$menu2['menu_name']}}
                                                            @endif
                                                        </span>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>                                            
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                            */ ?>
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->