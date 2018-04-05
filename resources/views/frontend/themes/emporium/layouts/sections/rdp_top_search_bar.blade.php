<header id="header">
	<div class="logo-wrapper">
		<a href="{{URL::to('')}}"><img src="{{ asset('themes/emporium/images/logo.png')}}" alt="Emporium Voyage"/></a>
	</div>

	<div class="header-content">
		<div class="col-lg-12 header-search">
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="form-group">
						<select name="search_by_type" data-action="search_by_type"  class="form-control">
							<option value="">SELECT TYPE</option>
							<option value="restaurant">Restaurant</option>
							<option value="bar">Bar</option>
							<option value="spa">Spa</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="form-group">
						<select name="search_by_city" data-action="search_by_city" class="form-control">
							<option value="">SEARCH BY CITY</option>
							<option>CITY 01</option>
							<option>CITY 02</option>
						</select>
					</div>
				</div>
				<div class="col-sm-2 col-md-2">
					<div class="form-group">
						<select name="search_by_name" data-action="search_by_name" class="form-control">
							<option value="">- SELECT -</option>
						</select>
					</div>
				</div>
				<div class="col-sm-2 col-md-2">
					<div class="form-group">
						<<?php  $currencyList=(CommonHelper::getCurrencyList()); ?>
						<select name='currencyOption' class="form-control">
							<option value="EUR">Currency</option>
							@foreach($currencyList as $currencyCode => $currencyName)

								<option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
							</option>

							@endforeach

						</select>
					</div>
				</div>
				<div class="col-sm-2 col-md-2"><button class="btn yellowbtn" data-action="make-reservation">MAKE RESERVATION</button></div>
			</div>
		</div>
	</div>
	<div class="menu" id="menu">                       
        <a href="javascript:void(0)" id="close" onclick="trigger"></a>
		<ul class="nav navbar-nav">
			<li><a href="https://www.emporium-voyage.com/membership_hotel">Become a Member Hotel</a></li>
			<li><a href="terms-and-conditions.html">Terms and Conditions</a></li>
			<li><a href="https://www.emporium-voyage.com/Impressum">Imprint</a></li>
		</ul>
                        
        <div class="tilt-container">
			<img src="{{ asset('images/emporium-voyage-company-menu.jpg') }}" alt="" class="background">
		</div>                
    </div>
</header>