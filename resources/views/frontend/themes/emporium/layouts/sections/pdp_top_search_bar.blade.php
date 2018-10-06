
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
                            <div id="t-topbar-picker" class="col-xs-12 col-md-12 t-datepicker t-margin-top25">
                                <div class="t-check-in"></div>
                                <div class="t-check-out"></div>
                            </div>
						</div>
					</div>
                    {{--*/
                    $selectedRoom = 0;
                    $bigRoomPrice = 0;
                    if (array_key_exists('typedata', $propertyDetail))
                    {
                        foreach($propertyDetail['typedata'] as $type)
                        {
                            if (array_key_exists($type->id, $propertyDetail['roomimgs']))
                            {
                                $pp = (float) $type->price;
                                if($bigRoomPrice <= $pp){
                                    $bigRoomPrice = $pp;
                                    $selectedRoom = $type->id;
                                }
                            }
                        }
                    }
                    /*--}}
					<div class="col-sm-3 col-md-2">
						<div class="form-group">
							<label>&nbsp;</label>
							<select name="roomType" class="form-control"  required="required" title="Please Choose Room(s)"  oninvalid="this.setCustomValidity('Please Select Room(s)')"   oninput="this.setCustomValidity('')" >
								<option disabled="" value="" {{(($selectedRoom <= 0)?'selected="selected"':'')}}>Select Room(s)</option>
								@if (array_key_exists('typedata', $propertyDetail))
									@foreach($propertyDetail['typedata'] as $type)
										@if (array_key_exists($type->id, $propertyDetail['roomimgs']))
											<option value="{{$type->id}}" {{(($selectedRoom == $type->id)?'selected="selected"':'')}}>{{$type->category_name}}</option>
										@endif
									@endforeach
								@endif
							</select>
						</div>
					</div>
					<div class="col-sm-3 col-md-2"><button class="btn yellowbtn">MAKE RESERVATION</button></div>
				</div>
			</form>
		
