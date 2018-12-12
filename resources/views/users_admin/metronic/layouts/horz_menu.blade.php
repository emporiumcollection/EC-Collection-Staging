<?php $hotelmenu = SiteHelpers::menus('hotel'); ?>
<!-- BEGIN: Horizontal Menu -->
<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
	<i class="la la-close"></i>
</button>
<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light">
	<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
		<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
			<a  href="javascript:;" class="m-menu__link m-menu__toggle">
				<i class="m-menu__link-icon fa fa-bars m--font-light gray-color"></i>
				<span class="m-menu__link-text">
					Menu
				</span>
				<i class="m-menu__hor-arrow la la-angle-down"></i>
				<i class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
            @if(!empty($hotelmenu))
			<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
				<span class="m-menu__arrow m-menu__arrow--adjust"></span>
				<ul class="m-menu__subnav">
                    {{--*/ $m=1; /*--}}                    
                    @foreach($hotelmenu as $si_menu)
                        @if(!empty($si_menu['childs']))                            
                            <li class="m-menu__item  m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="{{$m}}" aria-haspopup="true">
                               <a  href="javascript:;" class="m-menu__link m-menu__toggle">
        							<i class="m-menu__link-icon {{$si_menu['menu_icons']}}"></i>
        							<span class="m-menu__link-text">
        								@if(CNF_MULTILANG ==1 && isset($si_menu['menu_lang']['title'][Session::get('lang')]))
                    						{{ $si_menu['menu_lang']['title'][Session::get('lang')] }}
                    					@else
                    						{{$si_menu['menu_name']}}
                    					@endif
        							</span>
        							<i class="m-menu__hor-arrow la la-angle-right"></i>
        							<i class="m-menu__ver-arrow la la-angle-right"></i>
        						</a>
        						<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
        							<span class="m-menu__arrow "></span>
        							<ul class="m-menu__subnav">
                                        @foreach ($si_menu['childs'] as $menu2)
        								<li class="m-menu__item "  m-menu-link-redirect="{{$m}}" aria-haspopup="true">
       									    <a @if($menu2['menu_type'] =='external')
                                                href="{{ $menu2['url'] }}" 
                					        @else
             						            href="{{ URL::to($menu2['module'])}}" 
                					        @endif" class="m-menu__link ">
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
        					</li>
                        @else
                            <li class="m-menu__item "  aria-haspopup="true">
        						<a @if($si_menu['menu_type'] =='external')
        						      href="{{ $si_menu['url'] }}" 
        					       @else
        						      href="{{ URL::to($si_menu['module'])}}" 
        					       @endif" class="m-menu__link ">
        							<i class="m-menu__link-icon {{$si_menu['menu_icons']}}"></i>
        							<span class="m-menu__link-text">
        								@if(CNF_MULTILANG ==1 && isset($si_menu['menu_lang']['title'][Session::get('lang')]))
                    						{{ $si_menu['menu_lang']['title'][Session::get('lang')] }}
                    					@else
                    						{{$si_menu['menu_name']}}
                    					@endif                               
        							</span>
        						</a>
        					</li>
                        @endif  
                    {{--*/ $m++;  /*--}}  						
                    @endforeach					
				</ul>
			</div>
            @endif
		</li>		
	</ul>
</div>
<!-- END: Horizontal Menu -->	
