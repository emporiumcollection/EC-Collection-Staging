<form action="{{URL::to('search')}}" method="get" id="reservationForm" name="reservationform" class="reservation-form">
 <div class="row">
	<div class="col-sm-3 col-md-3">
	   <div class="form-group ui-widget" >
		  <input type="text" name="s" data-action="auto-suggestion" placeholder="ENTER YOUR HOTEL OR DESTINATION"/>
	   </div>
	</div>
	<div class="col-sm-4 col-md-4 calendarbox">
	   <div class="row">
            <div id="t-topbar-picker" class="col-xs-12 col-md-12 t-datepicker">
                <div class="t-check-in"></div>
                <div class="t-check-out"></div>
            </div>
	   </div>
	</div>
	<div class="col-sm-2 col-md-2">
	    <div class="form-group">
		    <input name="adult" type="number" placeholder="ADULT CHILDREN">
	    </div>

	</div>
	<div class="col-md-2">


		<?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
        <select name='currencyOption' class="form-control">
            <option value="EUR">Currency</option>
            @foreach($currencyList as $currencyCode => $currencyName)

                <option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
            </option>

            @endforeach

        </select>
	 
	</div>
	<div class="col-sm-1 col-md-1"><button class="btn yellowbtn" type="submit">SEARCH</button></div>
 </div>
</form>