<div class="sidefixednav pdprightnav">
	<ul>
    	<li class="hamburguricon">
        	<div class="block-content togglenav content">
            <span></span>
            <span> </span>
            <span></span>
            </div>
        </li>
    	<li class="loginSignPopupButton">
            @if(Session::get('uid')>0)
                <a href="javascript:void(0)" class="login-user" style="display:block;"><i class="fa fa-user"></i></a>
                <ul class="user-setting">
                    <li><a href="{{ URL::to('customer/profile')}}">Profile</a></li>
                    <li><a href="{{ URL::to('customer/profile?#resetPassword')}}">Change Possword</a></li>
                    <li><a href="{{ URL::to('customer/logout')}}">Logout</a></li>
                </ul>
            @else
                <a href="javascript:void(0)" class="clicktologin"><i class="fa fa-lock"></i></a>
            @endif
        </li>
        <li class="calander"><a href="javascript:void(0)"><i class="fa fa-calendar"></i></a></li>
        <li><a href="javascript:void(0)"><img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt=""/></a></li>
        <li><a href="javascript:void(0)"><img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt=""/></a></li>
    </ul>
</div>
<div class="pdprightnav contactfixed">
    <ul>
        <li><a href="tel:+19344511317"><i class="fa fa-phone"></i> +1 934 451 1317</a></li>
        <li><a href="mailto: reservations@emporium-voyage.com"><i class="fa fa-envelope"></i> reservations@emporium-voyage.com</a></li>
    </ul>
</div>
<div class="pdprightnav backcontrol">
	<ul>
	    <li><a href="javascript:void(0)" onclick="window.history.back();">BACK</a></li>
    	<li><a href="javascript:void(0)" id="back-to-top">TOP</a></li>
    </ul>
</div>