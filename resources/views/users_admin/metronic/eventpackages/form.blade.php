@extends('users_admin.metronic.layouts.app')

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
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text  breadcrumb-end"> Property Management System </span> 
        </a> 
    </li>
@stop

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('eventpackages?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'eventpackages/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Event Packages</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Title" class=" control-label col-md-4 text-left"> Package Title </label>
									<div class="col-md-6">
									  {!! Form::text('package_title', $row['package_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Description" class=" control-label col-md-4 text-left"> Package Description </label>
									<div class="col-md-6">
									  <textarea name='package_description' rows='5' id='package_description' class='form-control '  
				           >{{ $row['package_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Image" class=" control-label col-md-4 text-left"> Package Image <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <input  type='file' name='package_image' id='package_image' @if($row['package_image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['package_image'],'/uploads/event_package_images/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Price" class=" control-label col-md-4 text-left"> Package Price <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('package_price', $row['package_price'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Duration Type" class=" control-label col-md-4 text-left"> Package Duration Type </label>
									<div class="col-md-6">
									  {!! Form::text('package_duration_type', $row['package_duration_type'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Duration" class=" control-label col-md-4 text-left"> Package Duration </label>
									<div class="col-md-6">
									  {!! Form::text('package_duration', $row['package_duration'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Status" class=" control-label col-md-4 text-left"> Package Status </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='package_status' value ='0'  @if($row['package_status'] == '0') checked="checked" @endif > In Active </label>
					<label class='radio radio-inline'>
					<input type='radio' name='package_status' value ='1'  @if($row['package_status'] == '1') checked="checked" @endif > Active </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@if($group!=1 && $group!=2)
								  <div class="form-group  " >
									<label for="Event Id" class=" control-label col-md-4 text-left"> Event Id </label>
									<div class="col-md-6">
									  <select name='event_id' class='select2' >
										@if(!empty($events))
											@foreach($events as $event)
												<option value="{{$event->id}}" {{ ($event->id==$row['event_id']) ? 'selected="selected"' : '' }}>	
													{{$event->title}}
												</option>
											@endforeach
										@endif
									  </select> 
									 </div> 
									 <div class="col-md-2">
									 	<input type="hidden" name="user_id" value="1" />
									 </div>
								  </div>
								  
								@else
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='user_id' rows='5' id='user_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Event Id" class=" control-label col-md-4 text-left"> Event Id <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='event_id' rows='5' id='event_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@endif
								  <div class="form-group  " >
									<label for="Created At" class=" control-label col-md-4 text-left"> Created At </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('created_at', $row['created_at'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Updated At" class=" control-label col-md-4 text-left"> Updated At </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('updated_at', $row['updated_at'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('eventpackages?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#user_id").jCombo("{{ URL::to('eventpackages/comboselect?filter=tb_users:id:username|email') }}",
		{  selected_value : '{{ $row["user_id"] }}' });
		
		$("#event_id").jCombo("{{ URL::to('eventpackages/comboselect?filter=tb_events:id:title|alias') }}",
		{  selected_value : '{{ $row["event_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop