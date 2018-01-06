@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<style>

</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>
	  
    </div>
 	<div class="page-content-wrapper">
		<div id="formerrors"></div>
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
			
	<div class="block-content">
		<ul class="nav nav-tabs" >
			@if(!empty($tabss))
				@foreach($tabss as $key=>$val)
					<li  @if($key == $active) class="active" @endif><a href="{{URL::to('properties_settings/'.$pid.'/'.$key)}}"> {{ $val->tab_name }}  </a></li>
				@endforeach
			@endif
		</ul>
		
	<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="types">	
		<div class="sbox  "> 
			<div class="sbox-title">@if(!empty($property_data)) {{$property_data->property_name}} @endif <a href="{{URL::to('properties/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Property Management"><i class="fa fa-edit"></i>&nbsp;Property Management</a></div>
				<div class="sbox-content calendar v1"> 
					<form id="cal-dates" method="POST">
						<div class="controls">
							<section>
								<div class="control-group no-grow">
									<button id="calendar-show-button" type="button" onclick="find_reservation_dates();"><i class="fa fa-repeat" style=""></i></button>
								</div>

								<div class="control-group">
									<button onclick="dateOffset('cal-start', 'cal-end', -1); calRefresh();"><i class="fa fa-caret-left"></i></button>
									<input id="cal-start" name="cal-start" type="text" class="date hasDatepicker" value="2017-02-28">
									<input id="cal-end" name="cal-end" type="text" class="date hasDatepicker" value="2017-03-23">
									<button onclick="dateOffset('cal-start', 'cal-end', 1); calRefresh();"><i class="fa fa-caret-right"></i></button>
								</div>
							</section>
							
							<section>
								<div class="control-group tools">
									<button type="button" onclick="setDates('27.02.2017', '05.03.2017'); calRefresh();">Week</button>
									<button type="button" onclick="setDates('01.02.2017', '28.02.2017'); calRefresh();">Month</button>
								</div>
							</section>

							<section>
								<div class="control-group">
									<select name="cal-room-type" id="cal-room-type" onchange="calRefresh();">
										<option value="all">Show all</option>
										<option value="3">Double</option>
										<option value="2">Single</option>
									</select>

									<select name="cal-coloring" onchange="calRefresh();">
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

							<section>
								<button type="button" class="b7 info new-reservation" onclick="calStartBook(event)" title="New Reservation">New Reservation</button>
							</section>
						</div>
					</form>
					<div style="margin-left: 150px; ; height: 13px; border-bottom: none;"></div>
					<div id="datcalendar"></div>
					<div style="background:#fff;">
						<div id="cal-content" class="unselect" unselectable="on" style="z-index: 1; background: white; margin-left: 150px;">
							<div style="position: relative; height: 200px; border-right: 1px solid #555; border-bottom: 1px solid #555;" id="cal-body">
							{{--*/ $days_ago = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") - 5, date("Y"))); 
								   $days_after = date('Y-m-d', mktime(0, 0, 0, date("m") , date("d") + 20, date("Y")));
								   
							/*--}}
							
								<div class="column first" id="col0" style="left: 0%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;01&quot;,&quot;day&quot;:&quot;24&quot;}"></div>
								
								<div class="month-h" style="left: 0%;top: -13px;">	&nbsp;Feb 2017		</div>
								<div title="Friday" class="column-h" id="hcol0" style="left: 0%;">	24		</div>
								<div class="column wkend" id="col1" style="left: 3.8461538461538%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;01&quot;,&quot;day&quot;:&quot;25&quot;}"></div>
								<div title="Saturday" class="column-h wkend" id="hcol1" style="left: 3.8461538461538%;"> 25		</div>
								<div class="column wkend" id="col2" style="left: 7.6923076923077%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;01&quot;,&quot;day&quot;:&quot;26&quot;}"></div>
								<div title="Sunday" class="column-h wkend" id="hcol2" style="left: 7.6923076923077%;">
								26		</div>
									<div class="column" id="col3" style="left: 11.538461538462%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;01&quot;,&quot;day&quot;:&quot;27&quot;}"></div>
										<div title="Monday" class="column-h" id="hcol3" style="left: 11.538461538462%;">
								27		</div>
								<div class="column" id="col4" style="left: 15.384615384615%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;01&quot;,&quot;day&quot;:&quot;28&quot;}"></div>
								
								<div title="Tuesday" class="column-h" id="hcol4" style="left: 15.384615384615%;">
								28		</div>
								<div class="column today" id="col5" style="left: 19.230769230769%;" data-date="{&quot;year&quot;:&quot;2017&quot;,&quot;month&quot;:&quot;02&quot;,&quot;day&quot;:&quot;01&quot;}"></div>
								<div class="month-h" style="left: 19.230769230769%; top: -13px;">
								&nbsp;Mar 2017		</div>
								<div title="Wednesday" class="column-h today" id="hcol5" style="left: 19.230769230769%;">
								01		</div>
				
				
								@if(!empty($cat_types))
									@foreach($cat_types as $typec)
										@if(array_key_exists('rooms', $typec))
										{{--*/ $tp=20; /*--}}
											@foreach($typec['rooms'] as $typeroom)
												<!--<div id="row0" data-roomname="Double" data-roomid="4" data-bgcolor="#be3144" data-color="white" class="row first row4" style="top: {{$tp}}px; " data-roomnum="3">
													<div class="r-header">
														<div class="cal-room-name">
															<div class="cal-room-number v-middle" style="position: relative; max-width: 100px; overflow: hidden; text-overflow: '..';">	{{$typeroom->room_name}} </div>
															<div style="position: absolute; top: 0; left: 20px; width: 130px; text-align: right;">
																<div class="ib v-middle">{{$typec['data']->cat_short_name}}</div>
																<img id="room_status4" style="cursor: pointer; border-right: 2px solid transparent; background: #FF0000; padding: 1px 0" src="https://app.base7booking.com/images/icons/broom.png" onclick="statusMenu(event, 4)">
															</div>
														</div>
													</div>
												</div>-->
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
						</div>
					</div>
				</div>
			</div>	 
		</div>
	  </div>
	</div>	
</div>

<script>

$(document).ready(function () {
	
	$(document).on('click', '.btn', function (){
		 var frmid = $(this).parents('form.add_property_room_price_setup').attr('id');
		  $('#'+frmid).validate({
			submitHandler: function (form) {
				 save_rooms_price_tabdata(frmid);
				 return false; // required to block normal submit since you used ajax
			 }
		 });
	 });
});

	function save_rooms_price_tabdata(formid)
	{
		if(formid!='')
		{
			$.ajax({
			  url: "{{ URL::to('add_property_category_rooms_price')}}",
			  type: "post",
			  data: $('#'+formid).serializeArray(),
			  dataType: "json",
			  success: function(data){
				var html = '';
				if(data.status=='error')
				{
					html +='<ul class="parsley-error-list">';
					$.each(data.errors, function(idx, obj) {
						html +='<li>'+obj+'</li>';
					});
					html +='</ul>';
					$('.page-content-wrapper #formerrors').html(html);
					window.scrollTo(0, 0);
				}
				else
				{
					html +='<div class="alert alert-success fade in block-inner">';
					html +='<button data-dismiss="alert" class="close" type="button">×</button>';
					html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
					$('.page-content-wrapper #formerrors').html(html);
					window.scrollTo(0, 0);
				}
			  }
			});
		}
	}
	
	function find_reservation_dates()
	{
		var cal_start = $('#cal-start').val();
		var cal_end = $('#cal-end').val();
		
		var current_date = new Date("01/13/2013");
		var end_date = new Date("01/20/2013");
		var end_date_time = end_date.getTime();
		var html = '';
		while (current_date.getTime() <= end_date_time) {
			console.log(current_date.getDate());
			current_date.setDate(current_date.getDate()+1);
			
			html += '<div class="row no_border ">';
			html += '<div class="cols first white_border_left"></div>';
			html += '<div class="cols top_border_black left_border_black ">31</div>';
			html += '<div class="cols top_border_black left_border_black">01</div>';
			html += '<div class="cols top_border_black left_border_black weekend">02</div>';
			html += '<div class="cols top_border_black left_border_black right_border_black  weekend">21</div>';
			html += '<div class="clr"></div>';
			html += '</div>';
			html += '';
		}
	}
	
</script>

@stop