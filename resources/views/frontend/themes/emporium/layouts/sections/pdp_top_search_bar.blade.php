<header id="header">
	<div class="logo-wrapper">
		<a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/logo.png')}}" alt="Emporium Voyage"/></a>
	</div>

	<div class="header-content">
		<div class="col-lg-12 header-search">
			<form action="{{url().'/book-property/'.$propertyDetail['data']->property_slug}}" id="reservationForm" name="reservationform" class="reservation-form pdpreservation-form">
				<div class="row">
					<div class="col-sm-3 col-md-2">
						<div class="form-group">
							<label>I would like to</label>
							<select class="form-control">
								<option>Room</option>
								<option>SPA</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3 col-md-2">
						<div class="form-group">
							<label>at</label>
							<select name="property" class="form-control">
								<option value="{{$propertyDetail['data']->id}}">{{$propertyDetail['data']->property_name}}</option>
							</select>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 calendarbox">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>&nbsp;</label>
									<input name="arrive" id="reservationdate" class="form-control datefield" type="text" placeholder="Arrival" readonly required>
									<div class="input-group-icon"><i class="fa fa-calander"></i></div>
								</div>    
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>&nbsp;</label>
									<input name="destination" id="reservationdate1" class="form-control datefield" type="text" placeholder="Arrival" readonly required>
									<div class="input-group-icon"><i class="fa fa-calander"></i></div>
								</div>     
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-md-2">
						<div class="form-group">
							<label>&nbsp;</label>
							<select name="roomType" class="form-control">
								<option disabled="" selected>Select Room(s)</option>
								@if (array_key_exists('typedata', $propertyDetail))
									@foreach($propertyDetail['typedata'] as $type)
										@if (array_key_exists($type->id, $propertyDetail['roomimgs']))
											<option value="{{$type->id}}">{{$type->category_name}}</option>
										@endif
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-sm-3 col-md-2"><button class="btn yellowbtn">MAKE RESERVATION</button></div>
				</div>
			</form>
		</div>
		<div class="col-lg-1">
			<div class="login-control-head">
				<ul class="nav navbar-nav setting-nav">
					<li class="dropdown" style="display:none;">
						<a class="dropdown-toggle peers" data-toggle="dropdown" href="javascript:void(0)">
							<div class="peer mR-10"><img class="img-circle login-user-pic" src="images/login-pic.jpg" alt=""><span class=" fa fa-angle-down"></span></div>
						</a>
						<ul class="dropdown-menu">
							<li><a href="javascript:void(0)">John Doe</a></li>
							<li><a href="javascript:void(0)">Profile</a></li>
							<li><a href="javascript:void(0)">Setting</a></li>
							<li><a href="javascript:void(0)">Logout <i class="fa fa-sign-out pull-right"></i></a></li>
						</ul>
					</li>
					<li>
						<div class="block-content togglenav content">
							<span></span>
							<span> </span>
							<span></span>
						</div>
					</li>
				</ul>
			</div>
		</div> 
	</div>
	<div class="menu" id="menu">                       
		<a href="javascript:void(0)" id="close" onclick="trigger"></a>
		<ul class="nav navbar-nav">
			<li><a href="https://www.emporium-voyage.com/membership_hotel">Become a Member Hotel</a></li>
			<li><a href="https://www.emporium-voyage.com/Terms-and-Conditions">Terms and Conditions</a></li>
			<li><a href="https://www.emporium-voyage.com/Impressum">Imprint</a></li>
		</ul>
		<div class="tilt-container">
			<img src="images/emporium-voyage-company-menu.jpg" alt="" class="background">
		</div>
	</div>
</header>