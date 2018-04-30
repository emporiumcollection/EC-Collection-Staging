
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="form-group">
						<select name="search_by_type" data-action="search_by_type"  class="form-control">
							<option value="">SELECT TYPE</option>
							<option value="restaurants">Restaurant</option>
							<option value="bars">Bar</option>
							<option value="spas">Spa</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="form-group">
						<!--<select name="search_by_city" data-action="search_by_city" class="form-control">
							<option value="">SEARCH BY CITY</option>
							<option>CITY 01</option>
							<option>CITY 02</option>
						</select>-->
						<div class="form-group ui-widget">
							<input id="rdpCounId" type="hidden" name="rdpCounId" value="" />
							<input type="text" name="rdp" data-action="auto-suggestion-rdp" placeholder="SEARCH BY CITY"/>
						</div>
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
						<?php  $currencyList=(CommonHelper::getCurrencyList()); ?>
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
		