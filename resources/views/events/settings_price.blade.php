@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<style>
 .priceinput { width : 100px; float:left;}
 .daysinput { width : 100px; float:left; margin:10px;}
 .daysinput input { width : 80px; float:left;}
 .iconmar { margin: 8px 0 0 5px; }
 .daysinput .iconmar { margin: 8px 0 0 5px; float:left; }
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
		
    @include('events/config_tab')
		
	<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="types">	
		<div class="sbox  "> 
			<div class="sbox-title">@if(!empty($event_data)) {{$event_data->title}} @endif <a href="{{URL::to('events/update/'.$pid)}}" class="tips btn btn-xs btn-primary pull-right" title="" data-original-title="Event Management"><i class="fa fa-edit"></i>&nbsp;Event Management</a></div>
				<div class="sbox-content"> 
					@if(!empty($room_prices))
						{{--*/ $p=1; /*--}}
						@foreach($room_prices as $cat)
							<form id="add_property_room_price_setup-{{$p}}" class="add_property_room_price_setup">
								<input type="hidden" name="property_id" value="{{$pid}}" >
								<input type="hidden" name="category_id" value="{{$cat['data']->id}}" >
								<input type="hidden" name="edit_room_price_id[]" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->id : '' }}" >
								<input type="hidden" name="seasonid[]" value="0" />
								<div class="row">
									<div class="col-lg-8">
										<h3>{{$cat['data']->name}}</h3>
									</div>
									<div class="col-lg-4 align-right">
										<div class="butt margin-top-10">
											<button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2">
										<label for="season">Season</label>
									</div>
									<div class="col-lg-10">
										<div class="row">
											<div class="col-lg-2">
												<label for="rack rate">Rack Rate</label>
											</div>
											<div class="col-lg-2">
												<label for="single price">Adult Price</label>
											</div>
											<div class="col-lg-2">
												<label for="extra (adult)">Junior Price</label>
											</div>
											<div class="col-lg-2">
												<!--<label for="extra (junior)">Extra (Junior)</label>-->
											</div>
											<div class="col-lg-2">
												<!--<label for="extra (baby)">Extra (Baby)</label>-->
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-2">
										<div style="background:#ccc; text-align:center; padding:40px 0;">Normal Price</div>
									</div>
									<div class="col-lg-10">
										<div class="row">
											<div class="col-lg-2">
												<input name="rack_rate[]" id="rack_rate" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->rack_rate : '' }}" data-rule-number="true" required="required" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="single_price[]" id="single_price" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? $cat['rooms_price'][0]->adult_rate : '' }}" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<input name="extra_adult[]" id="extra_adult" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->junior_rate>0) ? $cat['rooms_price'][0]->junior_rate : '' : '' }}" data-rule-number="true" /> 
												<i class="fa fa-times iconmar"></i>
											</div>
											<div class="col-lg-2">
												<?php /*<input name="extra_junior[]" id="extra_junior" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->extra_junior>0) ? $cat['rooms_price'][0]->extra_junior : '' : '' }}" data-rule-number="true"  />
												<i class="fa fa-times iconmar"></i> */?>
											</div>
											<div class="col-lg-2">
												<?php /*<input name="extra_baby[]" id="extra_baby" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->extra_baby>0) ? $cat['rooms_price'][0]->extra_baby : '' : '' }}" data-rule-number="true" /> 
												<i class="fa fa-times iconmar"></i> */?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="daysinput">
													<label for="monday_price">Monday</label>
													<input name="monday_price[]" id="monday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->monday_price>0) ? $cat['rooms_price'][0]->monday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="tuesday_price">Tuesday</label>
													<input name="tuesday_price[]" id="tuesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->tuesday_price>0) ? $cat['rooms_price'][0]->tuesday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="wednesday_price">Wednesday</label>
													<input name="wednesday_price[]" id="wednesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->wednesday_price>0) ? $cat['rooms_price'][0]->wednesday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="thursday_price">Thursday</label>
													<input name="thursday_price[]" id="thursday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->thursday_price>0) ? $cat['rooms_price'][0]->thursday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="friday_price">Friday</label>
													<input name="friday_price[]" id="friday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->friday_price>0) ? $cat['rooms_price'][0]->friday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="saturday_price">Saturday</label>
													<input name="saturday_price[]" id="saturday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->saturday_price>0) ? $cat['rooms_price'][0]->saturday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
												<div class="daysinput">
													<label for="sunday_price">Sunday</label>
													<input name="sunday_price[]" id="sunday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat)) ? ($cat['rooms_price'][0]->sunday_price>0) ? $cat['rooms_price'][0]->sunday_price : '' : '' }}" data-rule-number="true" />
													<i class="fa  fa-times iconmar"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								@if(!empty($Seasons))
									@foreach($Seasons as $season)
										<input type="hidden" name="seasonid[]" value="{{$season->id}}" />
										<input type="hidden" name="edit_room_price_id[]" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? $cat['rooms_price'][$season->id]->id : '' }}" >
										<div class="row">
											<div class="col-lg-2">
												<div style="background:#ccc; text-align:center; padding:40px 0;">{{$season->season_name}}</div>
											</div>
											<div class="col-lg-10">
												<div class="row">
													<div class="col-lg-2">
														<input name="rack_rate[]" id="rack_rate" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ?  $cat['rooms_price'][$season->id]->rack_rate : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="single_price[]" id="single_price" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? $cat['rooms_price'][$season->id]->single_price : '' }}" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_adult[]" id="extra_adult" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_adult>0) ? $cat['rooms_price'][$season->id]->extra_adult : '' : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_junior[]" id="extra_junior" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_junior>0) ? $cat['rooms_price'][$season->id]->extra_junior : '' : '' }}" data-rule-number="true"  /> 
														<i class="fa fa-times iconmar"></i>
													</div>
													<div class="col-lg-2">
														<input name="extra_baby[]" id="extra_baby" type="text" class="form-control input-sm priceinput" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->extra_baby>0) ? $cat['rooms_price'][$season->id]->extra_baby : '' : '' }}" data-rule-number="true" /> 
														<i class="fa fa-times iconmar"></i>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<div class="daysinput">
															<label for="monday_price">Monday</label>
															<input name="monday_price[]" id="monday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->monday_price>0) ? $cat['rooms_price'][$season->id]->monday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="tuesday_price">Tuesday</label>
															<input name="tuesday_price[]" id="tuesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->tuesday_price>0) ? $cat['rooms_price'][$season->id]->tuesday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="wednesday_price">Wednesday</label>
															<input name="wednesday_price[]" id="wednesday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->wednesday_price>0) ? $cat['rooms_price'][$season->id]->wednesday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="thursday_price">Thursday</label>
															<input name="thursday_price[]" id="thursday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->thursday_price>0) ? $cat['rooms_price'][$season->id]->thursday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="friday_price">Friday</label>
															<input name="friday_price[]" id="friday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->friday_price>0) ? $cat['rooms_price'][$season->id]->friday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="saturday_price">Saturday</label>
															<input name="saturday_price[]" id="saturday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->saturday_price>0) ? $cat['rooms_price'][$season->id]->saturday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
														<div class="daysinput">
															<label for="sunday_price">Sunday</label>
															<input name="sunday_price[]" id="sunday_price" type="text" class="form-control input-sm" value="{{ (array_key_exists('rooms_price', $cat) && array_key_exists($season->id, $cat['rooms_price'])) ? ($cat['rooms_price'][$season->id]->sunday_price>0) ? $cat['rooms_price'][$season->id]->sunday_price : '' : '' }}" data-rule-number="true" />
															<i class="fa  fa-times iconmar"></i>
														</div>
													</div>
												</div>
											</div>
										</div>										
									@endforeach
								@endif
							</form>
							<hr>
							{{--*/ $p++ /*--}}
						@endforeach
					@endif
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
			  url: "{{ URL::to('add_event_ticket_price')}}",
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
	
</script>
@stop