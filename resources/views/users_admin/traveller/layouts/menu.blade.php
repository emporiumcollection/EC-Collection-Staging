<?php $sidebar = SiteHelpers::menus('sidebar') ;?>
<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn" style="display: none;">
	<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light " style="display: none;">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light" data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                <a href="{{ URL::to('dashboard')}}" class="m-menu__link"><i class="m-menu__link-icon fa fa-dashboard"></i> <span class="m-menu__link-text">Dashboard</span></a>
            </li>
        </ul>
	</div>
	<!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->