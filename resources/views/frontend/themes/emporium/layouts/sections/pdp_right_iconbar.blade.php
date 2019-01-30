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
                    {{--*/ $is_demo6 = trim(\CommonHelper::isHotelDashBoard()); /*--}}
                    @if(strlen($is_demo6) > 0)
                        <li><a href="{{ URL::to('dashboard')}}">Dashboard</a></li>
                    @else
                        <li><a href="{{ URL::to('customer/profile')}}">Profile</a></li>
                    @endif
                    <li><a href="{{ URL::to('customer/profile?#resetPassword')}}">Change Possword</a></li>
                    <li><a href="{{ URL::to('customer/logout')}}">Logout</a></li>
                </ul>
            @else
                <a href="javascript:void(0)" class="clicktologin"><i class="fa fa-lock"></i></a>
            @endif
        </li>
        <li class="calander"><a href="javascript:void(0)"><i class="fa fa-calendar"></i></a></li>
		
		@if(!empty($relatedgridpropertiesArr))
			@if(array_key_exists('0',$relatedgridpropertiesArr))
				<li>
					<a href="{{url($relatedgridpropertiesArr[0]['data']->property_slug)}}"  class="showprevnextimage">
						<img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt=""/>
						<span class="nextprevshow" style="display: none; opacity: 1;">
							@if(array_key_exists('image', $relatedgridpropertiesArr[0]))
								<img src="{{url('uploads/property_imgs_thumbs/front_property_'.$relatedgridpropertiesArr[0]['image']->folder_id.'_'.$relatedgridpropertiesArr[0]['image']->file_name)}}" alt="{{$relatedgridpropertiesArr[0]['data']->property_name}}" width="200">
							@endif
						</span>
					</a>
				</li>
			@endif
			
			@if(array_key_exists('1',$relatedgridpropertiesArr))
				<li>
					<a href="{{url($relatedgridpropertiesArr[1]['data']->property_slug)}}" class="showprevnextimage">
						<img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt=""/>
						<span class="nextprevshow" style="display: none; opacity: 1;">
							@if(array_key_exists('image', $relatedgridpropertiesArr[1]))
								<img src="{{url('uploads/property_imgs_thumbs/front_property_'.$relatedgridpropertiesArr[1]['image']->folder_id.'_'.$relatedgridpropertiesArr[1]['image']->file_name)}}" alt="{{$relatedgridpropertiesArr[1]['data']->property_name}}" width="200">
							@endif
						</span>
					</a>
				</li>
			@endif
		@endif
		
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

<style>
	@if(!array_key_exists('1',$relatedgridpropertiesArr))
		.pdprightnav.contactfixed {
			top: 216px !important;
		}
		
		.backcontrol {
			top: 294px !important;
		}
	@endif
	
	@if(empty($relatedgridpropertiesArr))
		.pdprightnav.contactfixed {
			top: 175px !important;
		}
		
		.backcontrol {
			top: 254px !important;
		}
	@endif
	
</style>