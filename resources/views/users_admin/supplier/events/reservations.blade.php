@extends('users_admin.supplier.layouts.app')

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
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('reservations')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Reservation Management System </span> 
        </a> 
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Reservation Management System</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        The Emporium Collection Reservations maintains an extensive reservation and service center. Our office offers 24/7 support, reachable via toll-free lines.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
    </div>     
    <div class="col-md-12 col-xs-12 m--align-right padding-30"> 
        <a href="{{ URL::to('downloadrequirementsheet/Emporium-Voyage-Reservation-Management-System-help.pdf')}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Documentation</a>
    </div>
    <div class="col-sm-12 col-md-4 col-xl-4">
        <!--begin:: Widgets/Adwords Stats-->
		<div class="m-portlet m-portlet--full-height m-portlet--skin-light m-portlet--fit bg-gray">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Sales Stats
						</h3>
					</div>
				</div>
				
			</div>
			<div class="m-portlet__body">
				<div class="m-widget21" style="min-height: 420px">
					<div class="row">
						<div class="col col-sm-12 col-md-6 col-xl-6">
							<div class="m-widget21__item m--pull-right">
								<span class="m-widget21__icon">
									<a href="#" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="fa flaticon-alert-2 m--font-light"></i>
									</a>
								</span>
								<div class="m-widget21__info">
									<span class="m-widget21__title">
										Sales
									</span>
									
								</div>
							</div>
						</div>
						<div class="col col-sm-12 col-md-6 col-xl-6 m--align-left">
							<div class="m-widget21__item m--pull-left">
								<span class="m-widget21__icon">
									<a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="fa flaticon-coins m--font-light m--font-light"></i>
									</a>
								</span>
								<div class="m-widget21__info">
									<span class="m-widget21__title">
										Commission Paid
									</span>
									
								</div>
							</div>
						</div>
					</div>
					<div class="m-widget21__chart m-portlet-fit--sides" style="height:310px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
						<canvas id="m_chart_adwords_stats" width="502" height="310" class="chartjs-render-monitor" style="display: block; width: 502px; height: 310px;"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!--end:: Widgets/Adwords Stats-->
    </div>         
    <div class="col-sm-12 col-md-8 col-xl-8">
        <!--begin:: Widgets/Sale Reports-->
		<div class="m-portlet m-portlet--full-height ">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Guest Arrivals | Departures
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
                    <div class="arrival_departure">
                        <select class="form-control" name="dd_arrival_departure" id="dd_arrival_departure">
                            <option value="arrival">Arrival</option>
                            <option value="departure">Departure</option>
                            <option value="cancel">Cancelations</option>
                        </select>
                    </div>
					<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm">
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link active m_tab1_content" data-reportfor='today'>
								Today
							</a>
						</li>
						<li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link m_tab1_content" data-reportfor='month'>
								Month
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="m-widget11">
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table">
									<!--begin::Thead-->
									<thead>
										<tr>														
											<td>
												Guest Name
											</td>
											<td>
												Adult #
											</td>	
                                            <td>
												Child #
											</td>													
											<td class="m--align-right">
												Date of Arrival
											</td>
                                            <td class="m--align-right">
												Date of Departure
											</td>
										</tr>
									</thead>
									<!--end::Thead-->
<!--begin::Tbody-->
									<tbody id="table_data">
										
									</tbody>
									<!--end::Tbody-->
								</table>
								<!--end::Table-->
							</div>
							
						</div>
			</div>
		</div> 
		<!--end:: Widgets/Sale Reports-->
    </div>
    
    
    <!-- Calendar Start -->
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Reservations</h2>
    </div> 
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        Our reservation system to processes reservations and service requests for our members as each office adheres to the same call criteria so a guest will receive the same level of service excellence.
    </div>
    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <hr />
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
									<img src="{{URL::to('images/construction.png')}}">
								</button>
								<button type="button" onclick="calStartPrice()" title="ADR">
									<img src="{{URL::to('images/money.png')}}">
								</button>
								<button type="button" onclick="calSplit()" title="Split">
									<img style="height: 16px" src="{{URL::to('images/cut.png')}}">
								</button>
								<button type="button" onclick="v1.openRestrictions()" title="Restrictions">
									<img style="height: 16px" src="{{URL::to('images/restriction.png')}}">
								</button>
								<button type="button" onclick="v1.openCustomPrice()" title="Custom Price">
									<img style="height: 16px" src="{{URL::to('images/yield.png')}}">
								</button>
							</div>
						</section>

						
					</div>
				</form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                    <section>
						<button type="button" class="btn btn-primary" title="New Reservation">New Reservation</button>
					</section>
                </div>
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
			
</div>
@stop

{{-- For custom style  --}}
@section('style')
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    @parent    
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
<script src="{{ asset('metronic/assets/app/js/app.js ') }}"></script>
<script>
        $(document).ready(function(){ 
            
            $(".hasDatepicker").datepicker( {
                todayHighlight:!0, orientation:"bottom left", format:"yyyy-mm-dd", templates: {
                    leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
                }
            });
            
            $("#cal-start").change(function(){
                var cal_start = $(this).val();
                
                cal_start = new Date(cal_start);
                
                
                cal_start.setDate(cal_start.getDate());
     			d = ("0" + cal_start.getDate()).slice(-2);
        		m = ("0" + (cal_start.getMonth() + 1)).slice(-2);
        		$('#cal-start').val(cal_start.getFullYear() + '-' + m + '-' + d);
                
                cal_start.setDate(cal_start.getDate()+27);
     			d = ("0" + cal_start.getDate()).slice(-2);
        		m = ("0" + (cal_start.getMonth() + 1)).slice(-2);
        		$('#cal-end').val(cal_start.getFullYear() + '-' + m + '-' + d);
                //console.log($('#cal-end').val());
                
                
        		find_reservation_dates();
            });
            
            arrival_depart();
            $(".m_tab1_content").click(function(){
                $(".m_tab1_content").removeClass('active');
                $(this).addClass('active');
                arrival_depart();
            });
            function arrival_depart(){
                //$obj = $(".m_tab1_content.active");
                var reportfor = $(".m_tab1_content.active").attr('data-reportfor');
                var arrival_departure = $("#dd_arrival_departure").val();
                //console.log($obj);
                $.ajax({
                    url:"{{URL::to('user_arrival_departure')}}",
                    type:'POST',
                    dataType:'json',
                    data:{'reportfor':reportfor, 'arrival_departure':arrival_departure}, 
                    beforeSend: function() {
                      $("#table_data").html('<tr class="m--align-center"><td colspan="5"><div class="m-loader m-loader--brand"></div></td></tr>');
                    },                   
                    success:function(response){
                        var html = '';
                        $("#table_data").html('');
                        if(response.status == 'success'){
                            
                            var reservations = response.reservations;
                            if(reservations.length > 0){
                                $.each(reservations, function(key, val){
                                    console.log(val);
                                     
                                    html += '<tr><td>'+val.first_name+' '+val.last_name+'</td><td class="m--align-center">'+val.total_adults+'</td><td class="m--align-center">'+val.total_child+'</td><td class="m--align-right m--font-brand">'+val.checkin_date+'</td><td class="m--align-right m--font-brand">'+val.checkout_date+'</td></tr>';													
								});	
                                			
                            }else{
                                html += '<tr class="m--align-center"><td colspan="5">Currently no record found</td></tr>';													
								
                            }
                            $("#table_data").html(html);
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
            }
        	
        	find_reservation_dates();
            
            
        });

        function newclientForm(chkin,chkout,roomid)
    	{
    		if(chkin!='' && chkout!='' && roomid!='')
    		{
    			var clintfrm = '';
    			clintfrm += '<form class="m-form m-form--label-align-left- m-form--state- columns" id="addclient" method="post">';
    			clintfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			clintfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			clintfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			clintfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			clintfrm += '<input type="hidden" name="actionName" value="client">';
    			clintfrm += '<div class="modal-body">';
    			clintfrm += '<fieldset>';
    			clintfrm += '<div class="form-group m-form__group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Title</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<select name="title" style="width: 100%; padding:5px;">';
    			clintfrm += '<option></option>';
    			clintfrm += '<option value="Mr">Mr</option>';
    			clintfrm += '<option value="Ms">Ms</option>';
    			clintfrm += '<option value="Mrs">Mrs</option>';
    			clintfrm += '</select>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4"></div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<button type="button" class="b7 small info mbot float-right" onclick="open_searchClient_form(\'addclient\');"><i class="fa fa-search"></i> Search Client</button>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Company</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="company" class="form-control" type="text" value="" required="required">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Firstname</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="firstname" class="form-control" type="text" value="" required="required">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Lastname</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="lastname" class="form-control" type="text" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Email</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="email" class="form-control" type="email" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="col-md-4">';
    			clintfrm += '<label>Cellphone</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="cellphone" class="form-control" type="text" value="">';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-7">';
    			clintfrm += '<label>Country</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<input name="country" class="form-control" type="text" value="" >';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="form-group row">';
    			clintfrm += '<div class="col-md-12">';
    			clintfrm += '<label>Comment</label>';
    			clintfrm += '<div class="field-input">';
    			clintfrm += '<textarea id="book-comment" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</div>';
    			clintfrm += '</fieldset>';
    			clintfrm += '</div>';
    			clintfrm += '<div class="modal-footer">';
    			clintfrm += '<button type="submit" class="btn btn-primary" onclick="open_booking_form(\'addclient\');" >OK</button>';
    			clintfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			clintfrm += '</div>';
    			clintfrm += '</form>';
    			$('#reserforms').html(clintfrm);
    		}
    	}
    	
    	function open_searchClient_form(form_id)
    	{
    		if(form_id!='')
    		{
    			var chkin = $('#'+form_id+' input[name="chkin"]').val();
    			var chkout = $('#'+form_id+' input[name="chkout"]').val();
    			var roomid = $('#'+form_id+' input[name="roomid"]').val();
    			
    			var searchclientfrm = '';
    			searchclientfrm += '<form class="columns search_client_setup" id="searchClient" method="post">';
    			searchclientfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			searchclientfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			searchclientfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			searchclientfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			searchclientfrm += '<div class="modal-body">';
    			searchclientfrm += '<fieldset>';
    			searchclientfrm += '<div class="form-group row">';
    			searchclientfrm += '<div class="col-md-4">';
    			searchclientfrm += '<label>Search Clients</label>';
    			searchclientfrm += '<div class="field-input">';
    			searchclientfrm += '<input type="text" name="searchclient" value="" />';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</fieldset>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '<div class="modal-footer">';
    			searchclientfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
    			searchclientfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			searchclientfrm += '</div>';
    			searchclientfrm += '</form>';
    			$('#reserforms').html(searchclientfrm);
    		}
    	}
    	
    	function open_booking_form(form_id)
    	{
    		if(form_id!='')
    		{
    			var chkin = $('#'+form_id+' input[name="chkin"]').val();
    			var chkout = $('#'+form_id+' input[name="chkout"]').val();
    			var roomid = $('#'+form_id+' input[name="roomid"]').val();
    			var title = $('#'+form_id+' select[name="title"]').val();
    			var company = $('#'+form_id+' input[name="company"]').val();
    			var firstname = $('#'+form_id+' input[name="firstname"]').val();
    			var lastname = $('#'+form_id+' input[name="lastname"]').val();
    			var email = $('#'+form_id+' input[name="email"]').val();
    			var cellphone = $('#'+form_id+' input[name="cellphone"]').val();
    			var country = $('#'+form_id+' input[name="country"]').val();
    			var comment = $('#'+form_id+' textarea[name="comment"]').val();
    			var clientdata = { 'act':'new','title':title,'company':company,'firstname':firstname,'lastname':lastname,'email':email,'cellphone':cellphone,'country':country,'comment':comment };
    			
    			var reservfrm = '';
    			reservfrm += '<form class="columns add_new_reserve_setup" id="addreservation" method="post">';
    			reservfrm += '<input type="hidden" name="chkin" id="chkin" value="'+chkin+'">';
    			reservfrm += '<input type="hidden" name="chkout" id="chkout" value="'+chkout+'">';
    			reservfrm += '<input type="hidden" name="roomid" id="roomid" value="'+roomid+'">';
    			reservfrm += '<input type="hidden" name="property_id" value="{{$pid}}">';
    			reservfrm += '<input type="hidden" name="actionName" value="reserve">';
    			reservfrm += '<input type="hidden" name="clientData" value=\''+JSON.stringify(clientdata)+'\'>';
    			reservfrm += '<div class="modal-body">';
    			reservfrm += '<fieldset>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<label>Stay Type</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="staytype" class="form-control" style="width: 100%; padding:5px;" required="required">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="Business">Business</option>';
    			reservfrm += '<option value="Leisure">Leisure</option>';
    			reservfrm += '<option value="Residency">Residency</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<label>Source</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="source" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="Direct reservation">Direct reservation</option>';
    			reservfrm += '<option value="Email">Email</option>';
    			reservfrm += '<option value="Hotel Next Door">Hotel Next Door</option>';
    			reservfrm += '<option value="Hotel Website">Hotel Website</option>';
    			reservfrm += '<option value="Recommended">Recommended</option>';
    			reservfrm += '<option value="Return Customer">Return Customer</option>';
    			reservfrm += '<option value="Telephone">Telephone</option>';
    			reservfrm += '<option value="Tourist Office">Tourist Office</option>';
    			reservfrm += '<option value="Walk-In">Walk-In</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea id="book-comment" class="form-control" name="comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="pre"> pre-reservation';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<hr>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Adults</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="adult" class="form-control" style="width: 100%; padding:5px;" required="required">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '<option value="2">2</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Junior</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="junior" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<label>Baby</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="baby" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="0">0</option>';
    			reservfrm += '<option value="1">1</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Guests Names</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<input type="text" class="form-control" value="" name="guest_list" required="required">';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Check-in Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea class="form-control" name="chkin_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Check-out Comment</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<textarea class="form-control" name="chkout_comment" style="width: 100%; height: 60px; box-sizing: border-box"></textarea>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-2">';
    			reservfrm += '<div class="field-input">';
    			reservfrm += 'Options:';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-4">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="option1"> Upper level rooms';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<div class="field-input optionbox">';
    			reservfrm += '<input type="checkbox" name="option2"> Baby cot';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="row">';
    			reservfrm += '<div class="col-md-12">';
    			reservfrm += '<hr>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<label>Price</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<input type="text" class="form-control" value="95.00" name="price">';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="col-md-3">';
    			reservfrm += '<label>Mode</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="price_mode" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option value="daily">Daily</option>';
    			reservfrm += '<option value="weekly">Weekly</option>';
    			reservfrm += '<option value="monthly">Monthly</option>';
    			reservfrm += '<option value="fixed">Fixed</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="form-group row">';
    			reservfrm += '<div class="col-md-6">';
    			reservfrm += '<label>Board</label>';
    			reservfrm += '<div class="field-input">';
    			reservfrm += '<select name="board" class="form-control" style="width: 100%; padding:5px;">';
    			reservfrm += '<option></option>';
    			reservfrm += '<option value="1">Breakfast</option>';
    			reservfrm += '</select>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</div>';
    			reservfrm += '</fieldset>';
    			reservfrm += '</div>';
    			reservfrm += '<div class="modal-footer">';
    			reservfrm += '<button type="submit" class="btn btn-primary" >OK</button>';
    			reservfrm += '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
    			reservfrm += '</div>';
    			reservfrm += '</form>';
    			$('#reserforms').html(reservfrm);
    		}
    	}
    
    	function save_reserve_forms_data(formid)
    	{
    		if(formid!='')
    		{
    			$.ajax({
    			  url: "{{ URL::to('add_new_reservation')}}",
    			  type: "post",
    			  data: $('#'+formid).serializeArray(),
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
            //console.log(bookedNumbersDetails,' final');
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
</script>

@stop