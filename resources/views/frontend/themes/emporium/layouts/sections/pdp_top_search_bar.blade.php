
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
									<input name="arrive" id="reservationdate" class="form-control datefield reservationdate" type="text" placeholder="Arrival" readonly required>
									<div class="input-group-icon"><i class="fa fa-calander"></i></div>
								</div>    
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>&nbsp;</label>
									<input name="departure" id="reservationdate1" class="form-control datefield reservationdate" type="text" placeholder="Arrival" readonly required>
									<div class="input-group-icon"><i class="fa fa-calander"></i></div>
								</div>     
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-md-2">
						<div class="form-group">
							<label>&nbsp;</label>
							<select name="roomType" class="form-control"  required="required" title="Please Choose Room(s)"  oninvalid="this.setCustomValidity('Please Select Room(s)')">
								<option disabled="" value="" selected>Select Room(s)</option>
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
		
