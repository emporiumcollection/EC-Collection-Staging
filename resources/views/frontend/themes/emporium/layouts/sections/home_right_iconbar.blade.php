<div class="homerightmenu sidefixednav">
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
    </ul>
</div>
<div class="homerightmenu contactfixed">
    <ul>
        <li><a href="tel:+19344511317"><i class="fa fa-phone"></i> +1 934 451 1317</a></li>
        <li><a href="mailto: reservations@emporium-voyage.com"><i class="fa fa-envelope"></i> reservations@emporium-voyage.com</a></li>
    </ul>
</div>