@extends('layouts.app')

@section('content')

<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
			<div class="tab-pane active use-padding" id="seasons">	
				<div class="sbox  "> 
					<div class="sbox-title">Seasons (<small> If seasons overlap, highest priority takes precedence. For seasons with identical priority, the one created last takes precedence. (10 > 1)</small>)</div>
					<div class="sbox-content seasonsdis"> 
						@if(!empty($Seasons))
						{{--*/ $c=1; /*--}}
							@foreach($Seasons as $season)
								<div class="seasonbox-{{$season->id}} margin-top-10">
									<form id="add_season-{{$season->id}}" class="add_season">
										<input type="hidden" name="edit_season_id" value="{{$season->id}}" >
										<div class="row">
											<div class="col-lg-9">
												<div class="row">
													<div class="form-group col-lg-4">
														<label for="Name">Name </label>
														<input name="season_name" id="season_name" type="text" class="form-control input-sm" value="{{$season->season_name}}" required="required" /> 
													</div> 
													<div class="form-group col-lg-2">
														<label for="Priority">Priority </label>
														<input name="season_priority" id="season_priority" type="text" class="form-control input-sm" value="{{$season->season_priority}}" /> 
													</div>
												</div>
												
											</div>
											<div class="col-lg-3 align-right">
												<div class="butt">
													<button type="button" class="btn btn-danger b-btn" onclick="delete_season_data({{$season->id}});"><i class="fa fa-trash-0"></i> Delete</button>
													<button type="submit" class="btn btn-success b-btn addseason"><i class="fa fa-save"></i> Save</button>
												</div>
											</div>
										</div>
									</form>
									<hr>
									<div class="datebox">
										@if(array_key_exists('dates',$season))
											@foreach($season->dates as $sdate)
												<form id="add_dates-{{$sdate->id}}" class="seasons_dates">
												<input type="hidden" name="edit_season_dates_id" value="{{$sdate->id}}">
													<div class="row">
														<div class="col-lg-4">
															<div class="row">
																<div class="form-group col-lg-6">
																	<label for="From Date">From Date</label>
																	<input name="season_from_date" id="season_from_date{{$sdate->id}}" type="text" class="form-control input-sm datepic" value="{{$sdate->season_from_date}}" required="required" /> 
																</div> 
																<div class="form-group col-lg-6">
																	<label for="To Date">To Date</label>
																	<input name="season_to_date" id="season_to_date{{$sdate->id}}" type="text" class="form-control input-sm datepic" value="{{$sdate->season_to_date}}" required="required" /> 
																</div>
															</div>
														</div>
														<div class="col-lg-3">
															<div class="butt margin-top-10">
																<button type="button" class="btn btn-danger b-btn" onclick="delete_season_dates_data({{$sdate->id}});"><i class="fa fa-trash-0"></i> Delete</button>
																<button type="submit" class="btn btn-success b-btn addseasonDates"><i class="fa fa-save"></i> Save</button>
															</div>
														</div>
													</div>
												</form>
											@endforeach
										@endif
									</div>
								</div>
								{{--*/ $c++; /*--}}
							@endforeach
						@endif
					</div>
				</div>	 
			</div>
		</div>
		
		<div class="tab-content m-t">
			<div class="tab-pane active use-padding" id="addseasons">	
				<div class="sbox  "> 
					<div class="sbox-title">Add Season</div>
					<div class="sbox-content"> 
						<form id="add_season" class="add_season">
						<input type="hidden" name="edit_season_id" value="">
						<input type="hidden" name="property_id" value="{{$pid}}" >
							<div class="row">
								<div class="col-lg-9">
									<div class="row">
										<div class="form-group col-lg-4">
											<label for="Name">Name </label>
											<input name="season_name" id="season_name" type="text" class="form-control input-sm" value="" required="required" /> 
										</div> 
										<div class="form-group col-lg-2">
											<label for="Priority">Priority </label>
											<input name="season_priority" id="season_priority" type="text" class="form-control input-sm" value="" /> 
										</div>
									</div>
								</div>
								<div class="col-lg-3 align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn addseason"><i class="fa fa-plus"></i> Add</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>	 
			</div>
		</div>

		<div class="tab-content m-t">
			<div class="tab-pane active use-padding" id="addDates">	
				<div class="sbox  "> 
					<div class="sbox-title">Add Season's Dates</div>
					<div class="sbox-content"> 
						<form id="add_dates" class="seasons_dates">
						<input type="hidden" name="edit_season_dates_id" value="">
							<div class="row">
								<div class="col-lg-9">
									<div class="row">
										<div class="form-group col-lg-3">
											<label for="From Date">From Date</label>
											<input name="season_from_date" id="season_from_date" type="text" class="form-control input-sm datepic" value="" required="required" /> 
										</div> 
										<div class="form-group col-lg-3">
											<label for="To Date">To Date</label>
											<input name="season_to_date" id="season_to_date" type="text" class="form-control input-sm datepic" value="" required="required" /> 
										</div>
										<div class="form-group col-lg-3">
											<label for="Season">Seasons </label>
											<select name="seasons" class="form-control input-sm" required="required">
												<option></option>
												@if(!empty($Seasons))
													@foreach($Seasons as $season)
														<option value="{{$season->id}}">{{$season->season_name}}</option>
													@endforeach
												@endif
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-3 align-right">
									<div class="butt">
										<button type="submit" class="btn btn-success b-btn addseasonDates"><i class="fa fa-plus"></i> Add</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>	 
			</div>
		</div>
		
	</div>	
</div>

<script>
$(document).ready(function () {
	
	$('.datepic').datepicker({
			numberOfMonths: 2,
			showButtonPanel: true,
			dateFormat: 'yy-mm-dd'
	});

    $(document).on('click', '.addseason', function (){
		 var frmid = $(this).parents('form.add_season').attr('id');
		$('#'+frmid).validate({
			submitHandler: function (form) {
				 save_addseason_data(frmid);
				 return false;
			}
		});
	});
	
	$(document).on('click', '.addseasonDates', function (){
		var sdfrmid = $(this).parents('form.seasons_dates').attr('id');
		$('#'+sdfrmid).validate({
			submitHandler: function (form) {
				 save_addseasondates_data(sdfrmid);
				 return false;
			}
		});
	});
});	

function save_addseason_data(formid)
{
	if(formid!='')
	{
		$.ajax({
		  url: "{{ URL::to('add_event_season_details')}}",
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
				if(data.type=='update')
				{
					html +='<div class="alert alert-success fade in block-inner">';
					html +='<button data-dismiss="alert" class="close" type="button">×</button>';
					html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
					$('.page-content-wrapper #formerrors').html(html);
					window.scrollTo(0, 0);
				}
				else
				{
					html +='<div class="seasonbox-'+data.season.id+' margin-top-10">';
					html +='<form id="add_season-'+data.season.id+'" class="seasons">';
					html +='<input type="hidden" name="edit_season_id" value="'+data.season.id+'">';
					html +='<div class="row">';
					html +='<div class="col-lg-9">';
					html +='<div class="row">';
					html +='<div class="form-group col-lg-4">';
					html +='<label for="Name">Name </label>';
					html +='<input name="season_name" id="season_name" type="text" class="form-control input-sm" value="'+data.season.season_name+'" required="required" />';
					html +='</div>'; 
					html +='<div class="form-group col-lg-2">';
					html +='<label for="Priority">Priority </label>';
					html +='<input name="season_priority" id="season_priority" type="text" class="form-control input-sm" value="'+data.season.season_priority+'" /> ';
					html +='</div>';
					html +='</div>';
					html +='</div>';
					html +='<div class="col-lg-3 align-right">';
					html +='<div class="butt">';
					html +='<button type="button" class="btn btn-danger b-btn" onclick="delete_season_data('+data.season.id+');"><i class="fa fa-trash-0"></i> Delete</button> <button type="submit" class="btn btn-success b-btn addseason"><i class="fa fa-save"></i> Save</button>';
					html +='</div>';
					html +='</div>';
					html +='</div>';
					html +='</form>';
					html +='<hr>';
					html +='<div class="datebox"></div>';
					html +='</div>';
					$('.seasonsdis').append(html);
					
					var htmli = '';
					htmli +='<div class="alert alert-success fade in block-inner">';
					htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
					htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
					$('.page-content-wrapper #formerrors').html(htmli);
					 window.scrollTo(0, 0);
				}
                add_season_drop();
			}
		  }
		});
	}
}
function add_season_drop(){
    $.ajax({
		  url: "{{ URL::to('get_event_seasons')}}",
		  type: "post",
		  data: {'pid':'{{$pid}}'},
		  dataType: "json",
		  success: function(data){
			/*var html = '';
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
			{*/
			     //$('select[name="seasons"]').
                 $('select[name="seasons"]').empty();
                 $.each(data, function (key, value){
                        $('select[name="seasons"]').append($("<option/>").val(value.id).text(value.season_name));
                 });
            /*}*/
         }
   });
}
function save_addseasondates_data(formid)
{
	if(formid!='')
	{
		$.ajax({
		  url: "{{ URL::to('add_event_season_dates_details')}}",
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
				if(data.type=='update')
				{
					html +='<div class="alert alert-success fade in block-inner">';
					html +='<button data-dismiss="alert" class="close" type="button">×</button>';
					html +='<i class="icon-checkmark-circle"></i> Record Updated Successfully </div>';
					$('.page-content-wrapper #formerrors').html(html);
					window.scrollTo(0, 0);
				}
				else
				{
					html +='<form id="add_dates-'+data.seasonDates.id+'" class="seasons_dates">';
					html +='<input type="hidden" name="edit_season_dates_id" value="'+data.seasonDates.id+'">';
					html +='<div class="row">';
					html +='<div class="col-lg-4">';
					html +='<div class="row">';
					html +='<div class="form-group col-lg-6">';
					html +='<label for="From Date">From Date</label>';
					html +='<input name="season_from_date" id="season_from_date'+data.seasonDates.id+'" type="text" class="form-control input-sm datepic" value="'+data.seasonDates.season_from_date+'" required="required" /> ';
					html +='</div> ';
					html +='<div class="form-group col-lg-6">';
					html +='<label for="To Date">To Date</label>';
					html +='<input name="season_to_date" id="season_to_date'+data.seasonDates.id+'" type="text" class="form-control input-sm datepic" value="'+data.seasonDates.season_to_date+'" required="required" /> ';
					html +='</div>';
					html +='</div>';
					html +='</div>';
					html +='<div class="col-lg-3">';
					html +='<div class="butt margin-top-10">';
					html +='<button type="button" class="btn btn-danger b-btn" onclick="delete_season_dates_data('+data.seasonDates.id+');"><i class="fa fa-trash-0"></i> Delete</button> <button type="submit" class="btn btn-success b-btn addseasonDates"><i class="fa fa-save"></i> Save</button>';
					html +='</div>';
					html +='</div>';
					html +='</div>';
					html +='</form>';
					$('.seasonbox-'+data.seasonDates.season_id+' .datebox').append(html);		
							
					var htmli = '';
					htmli +='<div class="alert alert-success fade in block-inner">';
					htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
					htmli +='<i class="icon-checkmark-circle"></i> Record Inserted Successfully </div>';
					$('.page-content-wrapper #formerrors').html(htmli);
					 window.scrollTo(0, 0);
				}
			}
		  }
		});
	}
}

function delete_season_data(seasonId)
{
	if(seasonId!='' && seasonId>0)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			$.ajax({
			  url: "{{ URL::to('delete_event_season_data')}}",
			  type: "post",
			  data: "season_Id="+seasonId,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{
						$('.seasonbox-'+seasonId).remove();
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
}

function delete_season_dates_data(dateId)
{
	if(dateId!='' && dateId>0)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			$.ajax({
			  url: "{{ URL::to('delete_event_season_dates_data')}}",
			  type: "post",
			  data: "date_Id="+dateId,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{
						$('#add_dates-'+dateId).remove();
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
}
</script>


@stop