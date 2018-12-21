@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> My Reservations </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Search Result</h2>
    </div>
    <div class="col-sm-12 col-md-12 col-xl-12">
        
            
            <div class="sbox-content calendar"> 
				{{--*/ $days_start = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y"))); 
					   $days_end = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") + 20, date("Y")));
				/*--}}
                <div class="col-sm-12 col-md-12 col-lg-12">
				<form id="cal-dates" method="POST">
					<div class="controls">
						<section>
							<div class="control-group no-grow">
								<button id="calendar-show-button" type="button" onclick="find_reservation_dates();"><i class="fa fa-repeat" style=""></i></button>
							</div>

							<div class="control-group">
								<button onclick="dateOffset('prev');" type="button"><i class="fa fa-caret-left"></i></button>
								<input id="cal-start" name="cal-start" type="text" class="date hasDatepicker" value="{{$days_start}}">
								<input id="cal-end" name="cal-end" type="text" class="date hasDatepicker" value="{{$days_end}}">
								<button onclick="dateOffset('next');" type="button"><i class="fa fa-caret-right"></i></button>
							</div>
						</section>
						
						<section>
							<div class="control-group tools">
								<button type="button" onclick="dateOffset('week');">Week</button>
								<button type="button" onclick="dateOffset('month');">Month</button>
							</div>
						</section>

						<section>
							<div class="control-group">
								<select name="cal-room-type" id="cal-room-type" onchange="find_reservation_dates();">
									<option value="all">Show all</option>
									@if(!empty($cat_types))
										@foreach($cat_types as $typec)
											<option value="{{$typec['data']->id}}">{{$typec['data']->category_name}}</option>
										@endforeach
									@endif
								</select>

								<select name="cal-coloring" onchange="find_reservation_dates();">
									<option value="1">Color by Room</option>
									<option value="2" selected="">Color by Source</option>
								</select>
							</div>
						</section>

						<section>
							<div class="control-group tools">
								<button type="button" onclick="calStartUnavail()" title="New Out of Order">
									<img src="https://app.base7booking.com/images/icons/construction.png">
								</button>
								<button type="button" onclick="calStartPrice()" title="ADR">
									<img src="https://app.base7booking.com/images/icons/money.png">
								</button>
								<button type="button" onclick="calSplit()" title="Split">
									<img style="height: 16px" src="https://app.base7booking.com/images/icons/cut.png">
								</button>
								<button type="button" onclick="v1.openRestrictions()" title="Restrictions">
									<img style="height: 16px" src="https://app.base7booking.com/images/restriction.png">
								</button>
								<button type="button" onclick="v1.openCustomPrice()" title="Custom Price">
									<img style="height: 16px" src="https://app.base7booking.com/images/yield.png">
								</button>
							</div>
						</section>

						
					</div>
				</form>
                </div>
                <?php /* <div class="col-sm-12 col-md-12 col-lg-12">
                    <section>
						<button type="button" class="b7 info new-reservation" title="New Reservation">New Reservation</button>
					</section>
                </div> */ ?>
                <div class="col-sm-12 col-md-12 col-lg-12">
					<div style="margin-left: 150px; ; height: 13px; border-bottom: none;"></div>
					<div class="row no_border ">
						<div class="cols first white_border_left"></div>
						<div class="datcalendartop">
							
						</div>
						<div class="clr"></div>
					</div>
               
					<div id="catrooms">					
						@if(!empty($cat_types))
							@foreach($cat_types as $typec)
								@if(array_key_exists('rooms', $typec))
								{{--*/ $tp=20; /*--}}
									@foreach($typec['rooms'] as $typeroom)
										<div class="row first">
											 <div class="cols first right_border_gray">
												<span class="room_number">{{$typeroom->room_name}}</span> 
												<span class="room_name">
													<span class="room_title">{{$typec['data']->cat_short_name}} </span>
													<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>
												<div class="clr"></div>
											</div>
											 <div class="cols right_border_gray"></div>
											 <div class="cols right_border_gray"></div>
											 <div class="cols right_border_gray weekend_days"></div>
											 <div class="cols right_border_gray weekend_days"></div>
											 <div class="clr"></div>
										</div>
										{{--*/ $tp = $tp+20; /*--}}
									@endforeach
								@endif
							@endforeach
						@endif
					</div>

					<div class="row last empty_row">
					</div>
					<div class="row no_border ">
						<div class="cols first white_border_left"></div>
						<div class="datcalendarbottom">
							
						</div>
						<div class="clr"></div>
					</div>
					<div class="separate_row">
					</div>
					
                </div>
            </div>
        
    </div>
    <!-- Calendar End -->	
    <?php /* <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <div class="m-portlet__body">
            <div class="m-widget11">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_2">
					<thead>
						<tr>
							<th>
								Booking number
							</th>
							<th>
								Guest Name
							</th>
							<th class="m--align-center">
								Adult #
							</th>
							<th>
								Child #
							</th>
							<th>
								Date of Arrival
							</th>
							<th>
								Date of Departure
							</th>										
							<th>
								Actions
							</th> 
						</tr>
					</thead>
				</table>
            </div>
        </div>
    </div> */ ?>
</div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent   
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    <!--<link href="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />-->
    <style>
    	.cursor{cursor:col-resize;}
    	.selectedCell{background:pink;}
        .BookedCell{background:pink; cursor: pointer; }
        .selectedCell span{ cursor: pointer; }
    	.optionbox {
    		-moz-user-select: none;
    		-webkit-user-select: none;
    		-ms-user-select: none;
    		padding: 8px;
    		cursor: pointer;
    		background-color: #eee;
    		border-radius: 3px;
    		border: 1px solid #dadada;
    		line-height: 18px;
    		display: inline-block;
    	}
        .m-content>div:nth-child(even) .row {
            background: none !important;
            padding: 10px 15px;
        }
    </style>   
@endsection

@section('custom_js_script')    
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<!--<script src="{{ asset('metronic/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>-->
<script>
    var base_url = "{{URL::to('/')}}";
    $(document).ready(function(){    
        find_reservation_dates();
    });
    function dateOffset(act)
    	{
    		var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
    		var current_date = new Date(cal_start);
    		var end_date = new Date(cal_end);
    		var d = m = '';
    		if(act=='prev')
    		{
    			current_date.setDate(current_date.getDate()-1);
    			d = ("0" + current_date.getDate()).slice(-2);
    			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(current_date.getFullYear() + '-' + m + '-' + d);
    			
    			current_date.setDate(current_date.getDate()-25);
    			d = ("0" + current_date.getDate()).slice(-2);
    			m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(current_date.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='next')
    		{
    			end_date.setDate(end_date.getDate()+1);
    			d = ("0" + end_date.getDate()).slice(-2);
    			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(end_date.getFullYear() + '-' + m + '-' + d);
    			
    			end_date.setDate(end_date.getDate()+25);
    			d = ("0" + end_date.getDate()).slice(-2);
    			m = ("0" + (end_date.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(end_date.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='week')
    		{
    			var start = start || 1;
    			var today = new Date();
    			var day = today.getDay() - start;
    			var date = today.getDate() - day;
    			var StartDate = new Date(today.setDate(date));
    			
    			d = ("0" + StartDate.getDate()).slice(-2);
    			m = ("0" + (StartDate.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(StartDate.getFullYear() + '-' + m + '-' + d);
    			
    			var EndDate = new Date(today.setDate(date + 6));
    			d = ("0" + EndDate.getDate()).slice(-2);
    			m = ("0" + (EndDate.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(EndDate.getFullYear() + '-' + m + '-' + d);
    		}
    		else if(act=='month')
    		{
    			var date = new Date();
    			var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    			d = ("0" + firstDay.getDate()).slice(-2);
    			m = ("0" + (firstDay.getMonth() + 1)).slice(-2);
    			$('#cal-start').val(firstDay.getFullYear() + '-' + m + '-' + d);
    			
    			var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    			d = ("0" + lastDay.getDate()).slice(-2);
    			m = ("0" + (lastDay.getMonth() + 1)).slice(-2);
    			$('#cal-end').val(lastDay.getFullYear() + '-' + m + '-' + d);
    		}
    		find_reservation_dates();
    	}
    	
    	function find_reservation_dates()
    	{
    		var cal_room_type = $('#cal-room-type').val();
            var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
            
    		$.ajax({
    		  url: "{{ URL::to('get_b2ccategory_rooms_reservations')}}",
    		  type: "post",
    		  data: 'caltype='+cal_room_type+'&pid={{$pid}}&calstart='+cal_start+'&calend='+cal_end,
    		  dataType: "json",
    		  success: function(data){
    			var html = '';
    			if(data.status=='error')
    			{
    				$('.page-content-wrapper #formerrors').html(data.errors);
    				$('#catrooms').html('');
    				window.scrollTo(0, 0);
    			}
    			else
    			{
    				$('.page-content-wrapper #formerrors').html('');
    				var cal_start = $('#cal-start').val();
    				var cal_end = $('#cal-end').val();
    				var current_date = new Date(cal_start);
    				var end_date = new Date(cal_end);
    				var end_date_time = end_date.getTime();
    				var today = new Date();
    				var tophtml = bothtml = roomhtml = dhtml = '';
    				var cellCount = 1;
    				while (current_date.getTime() <= end_date_time) {
    					var day = current_date.getDay();
    					var iweekend = dweekend = '';
    					var itoday = '';
    					if(day === 6 || day === 0)
    					{
    						iweekend = 'weekend';
    						dweekend = 'weekend_days';
    					}
    					if(today.getDate()==current_date.getDate() && today.getMonth()==current_date.getMonth() && today.getFullYear()==current_date.getFullYear())
    					{
    						itoday = 'today';
    					}
    					tophtml += '<div class="cols top_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    					
    					bothtml += '<div class="cols bottom_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    					
    					var d = ("0" + current_date.getDate()).slice(-2);
    					var m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    					var dateData = {'year':current_date.getFullYear(),'month':m,'date':d};
    						
    					
    					dhtml += '<div class="cols right_border_gray scell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\'></div>';
    					
    					current_date.setDate(current_date.getDate()+1);
    					cellCount++;
    				}
    				$('.datcalendartop').html(tophtml);
    				$('.datcalendarbottom').html(bothtml);
    				
    				$.each(data.cat_types, function(idx, tobj) { 
    				    //$.each(tobj.rooms, function(idx, obj) {
    						roomhtml += '<div class="row first row'+tobj.data.id+'" data-roomname="'+tobj.data.category_name+'" data-roomcat="'+tobj.data.category_name+'" data-roomid="'+tobj.data.id+'">';
    						roomhtml += '<div class="cols first right_border_gray">';
    						roomhtml += '<span class="room_number">'+tobj.data.category_name+'</span>'; 
    						roomhtml += '<span class="room_name">';
    						roomhtml += '<span class="room_title">'+tobj.data.cat_short_name+'</span>';
    						roomhtml += '<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>';
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    						roomhtml += get_room_reserved(tobj.reservation);
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    					//});
    					/*$.each(tobj.rooms, function(idx, obj) {
    						roomhtml += '<div class="row first row'+obj['room'].id+'" data-roomname="'+obj['room'].room_name+'" data-roomcat="'+tobj.data.category_name+'" data-roomid="'+obj['room'].id+'">';
    						roomhtml += '<div class="cols first right_border_gray">';
    						roomhtml += '<span class="room_number">'+obj['room'].room_name+'</span>'; 
    						roomhtml += '<span class="room_name">';
    						roomhtml += '<span class="room_title">'+tobj.data.cat_short_name+'</span>';
    						roomhtml += '<img  class="status_red" src="https://app.base7booking.com/images/icons/broom.png" > </span>';
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    						roomhtml += get_room_reserved(obj['reservation']);
    						roomhtml += '<div class="clr"></div>';
    						roomhtml += '</div>';
    					}); */
    				});
    				$('#catrooms').html(roomhtml);
    			}
    		  }
    		});
    	}
        
        var bookedDetails = new Array();
        var bookedNumbersDetails = new Array();
        function isInArray(value, array) {
          return array.indexOf(value) > -1;
        }
        
        function clickonBooking(event,clickedDate){
            event.stopImmediatePropagation();
            event.stopPropagation();
            
            if(typeof bookedNumbersDetails[clickedDate] != 'undefined'){
                var bookingNums = bookedNumbersDetails[clickedDate];
                //console.log(bookingNums);
                $.ajax({
    			  url: "{{ URL::to('get_reservation_details')}}",
    			  type: "post",
    			  data: {'ids':bookingNums},
    			  dataType: "json",
    			  success: function(data){
    				var html = '';
    				if(data.status=='error')
    				{
    					
    				}
    				else
    				{
    					var resp = data.reservations;
                        var bookedhtml ='';
                        var $sr_no = 1;
                        $.each(resp, function(rdid, rdval){
                            if(typeof rdval.details != 'undefined'){
                                var detail = rdval.details;  
                                
                                bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px"></span></div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12 m--align-right"><button class="btn btn-primary btn-sm" id="confirmReservation" type="button" onclick="confirm_reservation('+detail.id+');">Confirm</button>&nbsp;<button class="btn btn-danger btn-sm" id="confirmRejected" type="button" onclick="rejected_reservation('+detail.id+');">Rejected</button></div>'; 
                                bookedhtml += '<div style="background: #eeeeee; padding: 5px 0px;">';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<div class="row">';
                                        
                                        bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<table>';
                                        $.each(rdval.rooms,function(reid,reval){                            
                                            bookedhtml += '<tr>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += 'Room'+$sr_no;
                                                bookedhtml += '</td>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += detail.category_name;
                                                bookedhtml += '</td>';
                                                bookedhtml += '<td>';
                                                    bookedhtml += '<div class="col-sm-8 col-md-8"><select class="form-control" id="dd_rooms">';
                                                        bookedhtml += '<option value="0">Select</option>'
                                                        $.each(reval.available_rooms,function(arid,arval){
                                                            bookedhtml += '<option value="'+arval.id+'">'+arval.room_name+'</option>'
                                                        });
                                                    bookedhtml += '</select></div>';  
                                                bookedhtml += '</td>';
                                            bookedhtml += '</tr>';
                                            $sr_no++;
                                        });
                                        bookedhtml += '</table>';
                                        bookedhtml += '</div>';
                                        
                                            
                                            bookedhtml += '<div class="col-sm-4 col-md-4">'+detail.checkin_date+' <br />'+detail.checkout_date+'</div>';
                                        bookedhtml += '</div>';  
                                    bookedhtml += '</div>';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+detail.price+'</div>';
                                    bookedhtml += '<div class="col-sm-12 col-md-12">Email</div>'; 
                                bookedhtml += '</div>';
                                
                                bookedhtml += '<div class="col-sm-12 col-md-12">Reservartion: '+detail.booking_number+' </div>'; 
                                bookedhtml += '<div class="col-sm-12 col-md-12">';
                                        bookedhtml += '<div class="row">';
                                            bookedhtml += '<div class="col-sm-8 col-md-8">'+detail.room_name+'</div>';  
                                            bookedhtml += '<div class="col-sm-4 col-md-4">'+detail.checkin_date+' <br />'+detail.checkout_date+'</div>';
                                        bookedhtml += '</div>';  
                                    bookedhtml += '</div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+detail.price+'</div>'; 
                                 
                                bookedhtml += '<div class="col-sm-12 col-md-12" style="font-size:11px;">created: '+detail.created_date+'</div>';
                                bookedhtml += '<div class="col-sm-12 col-md-12"><hr /></div>';
                                              
                            }
                        });
                        
                        $("#bookingdetailbody").html(bookedhtml);
                        $("#reservationsmodal").modal('show');
                        
    				}
    			  }
    			});
            }
            
            return false;
        }
        
        function clickonBookingpopuphtml(contentArray){ 
            
            bookedhtml = '';
            $sr_no = 1;
            if(typeof bookedDetails[clickedDate] != 'undefined'){
                
                var arrBookedDet = bookedDetails[clickedDate];
                
                $.each(arrBookedDet,function(bid,bval){
                    //bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px">'+bval.data.guest_names+'</span></div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12"><i class="flaticon-user-ok"></i><span style="font-size:16px"></span></div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12 m--align-right"><button class="btn btn-primary btn-sm" id="confirmReservation" type="button" onclick="confirm_reservation('+bval.id+');">Confirm</button>&nbsp;<button class="btn btn-danger btn-sm" id="confirmRejected" type="button" onclick="rejected_reservation('+bval.id+');">Rejected</button></div>'; 
                    bookedhtml += '<div style="background: #eeeeee; padding: 5px 0px;">';
                        bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<div class="row">';
                            
                            bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<table>';
                            $.each(bval.reserved_rooms,function(reid,reval){                            
                                bookedhtml += '<tr>';
                                    bookedhtml += '<td>';
                                        bookedhtml += 'Room'+$sr_no;
                                    bookedhtml += '</td>';
                                    bookedhtml += '<td>';
                                        bookedhtml += reval.category_name;
                                    bookedhtml += '</td>';
                                    bookedhtml += '<td>';
                                        bookedhtml += '<div class="col-sm-8 col-md-8"><select class="form-control" id="dd_rooms"><option value="0">Select</option></select></div>';  
                                    bookedhtml += '</td>';
                                bookedhtml += '</tr>';
                                $sr_no++;
                            });
                            bookedhtml += '</table>';
                            bookedhtml += '</div>';
                            
                                
                                bookedhtml += '<div class="col-sm-4 col-md-4">'+bval.checkin_date+' <br />'+bval.checkout_date+'</div>';
                            bookedhtml += '</div>';  
                        bookedhtml += '</div>';
                        bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+bval.price+'</div>';
                        bookedhtml += '<div class="col-sm-12 col-md-12">Email</div>'; 
                    bookedhtml += '</div>';
                    
                    bookedhtml += '<div class="col-sm-12 col-md-12">Reservartion: '+bval.booking_number+' </div>'; 
                    bookedhtml += '<div class="col-sm-12 col-md-12">';
                            bookedhtml += '<div class="row">';
                                bookedhtml += '<div class="col-sm-8 col-md-8">'+bval.room_name+'</div>';  
                                bookedhtml += '<div class="col-sm-4 col-md-4">'+bval.checkin_date+' <br />'+bval.checkout_date+'</div>';
                            bookedhtml += '</div>';  
                        bookedhtml += '</div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12">{{($currency->content!='') ? $currency->content : "$"}}'+bval.price+'</div>'; 
                     
                    bookedhtml += '<div class="col-sm-12 col-md-12" style="font-size:11px;">created: '+bval.created_date+'</div>';
                    bookedhtml += '<div class="col-sm-12 col-md-12"><hr /></div>';
                });
                $("#bookingdetailbody").html(bookedhtml);
                $("#reservationsmodal").modal('show');
            }
    
            return false;
        }
        
        function get_room_reserved(obj){ 
            var cal_start = $('#cal-start').val();
    		var cal_end = $('#cal-end').val();
    		var current_date = new Date(cal_start);
    		var end_date = new Date(cal_end);
    		var end_date_time = end_date.getTime();
    		var today = new Date();
    		var tophtml = bothtml = roomhtml = dhtml = '';
    		var cellCount = 1;
            var bookedDates = new Array();
            //console.log(obj);
            //get booked dates tobj.reservation
            $.each(obj,function(tid,tval){ 
                var tchecIndate = new Date(tval.checkin_date);
                var tchecOutdate = new Date(tval.checkout_date);
                while (tchecIndate.getTime() <= tchecOutdate) {
                    var tttdate = tchecIndate.getFullYear()+'-'+(tchecIndate.getMonth() + 1)+'-'+tchecIndate.getDate();
                    if(!isInArray(tttdate,bookedDates)){bookedDates.push(tttdate);}
                    tchecIndate.setDate(tchecIndate.getDate()+1);
                    
                    if((typeof bookedDetails[tttdate]) == 'undefined'){ bookedDetails[tttdate] = new Array(); }
                    if((typeof bookedNumbersDetails[tttdate]) == 'undefined'){ bookedNumbersDetails[tttdate] = new Array(); }
                    if(!isInArray(tval.id,bookedNumbersDetails[tttdate])){bookedNumbersDetails[tttdate].push(tval.id); bookedDetails[tttdate].push(tval);}
                    //bookedDetails[tttdate].push(tval);
                }
            }); 
            //end
            console.log(bookedNumbersDetails,' final');
    		while (current_date.getTime() <= end_date_time) {
    			var day = current_date.getDay();
    			var iweekend = dweekend = '';
    			var itoday = '';
    			if(day === 6 || day === 0)
    			{
    				iweekend = 'weekend';
    				dweekend = 'weekend_days';
    			}
    			if(today.getDate()==current_date.getDate() && today.getMonth()==current_date.getMonth() && today.getFullYear()==current_date.getFullYear())
    			{
    				itoday = 'today';
    			}
    			tophtml += '<div class="cols top_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    			
    			bothtml += '<div class="cols bottom_border_black left_border_black '+iweekend+' '+itoday+'">'+current_date.getDate()+'</div>';
    			
    			var d = ("0" + current_date.getDate()).slice(-2);
    			var m = ("0" + (current_date.getMonth() + 1)).slice(-2);
    			var dateData = {'year':current_date.getFullYear(),'month':m,'date':d};
                
                var ttdate = current_date.getFullYear()+'-'+(current_date.getMonth() + 1)+'-'+current_date.getDate();
                //console.log(bookedDates,ttdate);
                    if(isInArray(ttdate,bookedDates)){
                        var totalReservations = 0;
                        var reservationIds = new Array();                    
                        var currentObj = bookedDetails[ttdate];
                        dhtml += '<div class="cols right_border_gray scell selectedCell BookedCell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\' onclick="return clickonBooking(event,\''+ttdate+'\');"><span>'+bookedDetails[ttdate].length+'</span></div>';                                        
                    }else{
                        dhtml += '<div class="cols right_border_gray scell '+dweekend+'" data-cell-number="'+cellCount+'" data-date=\''+JSON.stringify(dateData)+'\'></div>';
                    }                 
                
    			current_date.setDate(current_date.getDate()+1);
    			cellCount++;
    	   }
           return dhtml;
        }
        function confirm_reservation(id){
            if(id!='')
    		{
    			$.ajax({
    			  url: "{{ URL::to('confirmreservation')}}",
    			  type: "post",
    			  data: {'id':id},
    			  dataType: "json",
    			  success: function(data){
    				var html = '';
    				if(data.status=='error')
    				{
    					alert('error');
    				}
    				else
    				{
    					html += '<div class="modal-body">';
    					html += '<h2>Reservation Submitted Successfully!</h2>';
    					html += '</div>';
    					html += '<div class="modal-footer">';
    					html += '<button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>';
    					html += '</div>';
    					$('#reserforms').html(html);
    				}
    			  }
    			});
    		}
        }
    /*var DatatablesDataSourceAjaxClient= {
        init:function(skeyword, arrive, departure) { 
            $("#m_table_2").DataTable( {
                responsive:!0,
                destroy:true,
                ajax: {
                    url:"{{URL::to('searchbookingresult')}}", 
                    type:"POST", 
                    data: {
                        skeyword:skeyword, 
                        arrive:arrive,
                        departure:departure,
                        pagination: {
                            perpage: 1
                        }
                    }
                }
                , columns:[ {
                    data: "booking_number"
                }
                , {
                    data: "first_name"
                }
                , {
                    data: "total_adults"
                }
                , {
                    data: "total_child"
                }
                , {
                    data: "checkin_date"
                }
                , {
                    data: "checkout_date"
                }                
                , {
                    data: "Actions"
                }
                ], columnDefs:[
                 {  className: 'm--align-center', targets: [0,2,3] },
                 {  className: 'm--align-right', targets: [4,5] },
                 
                 {
                    targets:-1, title:"Actions", orderable:!1, render:function(a, t, e, n) { 
                        return'\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n<i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" href="'+base_url+'/bookingshow/'+e.id+'"><i class="la la-edit"></i> View</a>\n</div>\n</span>\n<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">\n<i class="la la-edit"></i>\n</a>'
                    }
                }, {
                    targets:1, render:function(a, t, e, n) {                        
                        return e.first_name+" "+e.last_name;
                    }
                }                
                ]
            }
            )
        }
    };
    
    $(document).ready(function() {
        var skeyword = '<?php echo $_GET['s'] ?>';
        var arrive = '<?php echo $_GET['from'] ?>';
        var departure = '<?php echo $_GET['to'] ?>';        
        DatatablesDataSourceAjaxClient.init(skeyword, arrive, departure);           
    }); */
    
</script>	
@stop