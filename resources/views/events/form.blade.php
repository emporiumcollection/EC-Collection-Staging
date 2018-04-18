@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('events?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'events/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Events</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
									<div class="col-md-6">
									  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Alias" class=" control-label col-md-4 text-left"> Alias </label>
									<div class="col-md-6">
									  {!! Form::text('alias', $row['alias'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Desciription" class=" control-label col-md-4 text-left"> Desciription </label>
									<div class="col-md-6">
									  <textarea name='desciription' rows='5' id='desciription' class='form-control '  
				           >{{ $row['desciription'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
									<div class="col-md-6">
									  {!! Form::text('video', $row['video'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
									<div class="col-md-6">
									  {!! Form::text('video_type', $row['video_type'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Video Link Type" class=" control-label col-md-4 text-left"> Video Link Type </label>
									<div class="col-md-6">
									  {!! Form::text('video_link_type', $row['video_link_type'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
									<div class="col-md-6">
									  {!! Form::text('video_link', $row['video_link'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Designer" class=" control-label col-md-4 text-left"> Designer </label>
									<div class="col-md-6">
									  {!! Form::text('designer', $row['designer'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Url" class=" control-label col-md-4 text-left"> Url </label>
									<div class="col-md-6">
									  {!! Form::text('url', $row['url'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Usp Text" class=" control-label col-md-4 text-left"> Usp Text </label>
									<div class="col-md-6">
									  <textarea name='usp_text' rows='5' id='usp_text' class='form-control '  
				           >{{ $row['usp_text'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Usp Person" class=" control-label col-md-4 text-left"> Usp Person </label>
									<div class="col-md-6">
									  <textarea name='usp_person' rows='5' id='usp_person' class='form-control '  
				           >{{ $row['usp_person'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Manager Text" class=" control-label col-md-4 text-left"> Manager Text </label>
									<div class="col-md-6">
									  <textarea name='manager_text' rows='5' id='manager_text' class='form-control '  
				           >{{ $row['manager_text'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Opening Hrs" class=" control-label col-md-4 text-left"> Opening Hrs </label>
									<div class="col-md-6">
									  <textarea name='opening_hrs' rows='5' id='opening_hrs' class='form-control '  
				           >{{ $row['opening_hrs'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Phonenumber" class=" control-label col-md-4 text-left"> Phonenumber </label>
									<div class="col-md-6">
									  {!! Form::text('phonenumber', $row['phonenumber'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Meta Keyword" class=" control-label col-md-4 text-left"> Meta Keyword </label>
									<div class="col-md-6">
									  {!! Form::text('meta_keyword', $row['meta_keyword'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Meta Description" class=" control-label col-md-4 text-left"> Meta Description </label>
									<div class="col-md-6">
									  <textarea name='meta_description' rows='5' id='meta_description' class='form-control '  
				           >{{ $row['meta_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Id" class=" control-label col-md-4 text-left"> Category Id </label>
									<div class="col-md-6">
									  {!! Form::text('category_id', $row['category_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@if($group!=1 && $group!=2)
								  <div class="form-group  " >
									<label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
									<div class="col-md-6">
									  <select name='property_id' rows='5' id='property_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
									<div class="col-md-6">
									  <select name='user_id' rows='5' id='user_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								@else
								  <div class="form-group  " >
									<label for="Property Id" class=" control-label col-md-4 text-left"> Property Id </label>
									<div class="col-md-6">
									  <select name='property_id' class='select2' >
										@if(!empty($proprty))
											@foreach($proprty as $prps)
												<option value="{{$prps->id}}" {{ ($prps->id==$row['property_id']) ? 'selected="selected"' : '' }}>	
													{{$prps->property_name}}
												</option>
											@endforeach
										@endif
									  </select> 
									 </div> 
									 <div class="col-md-2">
									 	<input type="hidden" name="user_id" value="1" />
									 </div>
								  </div>
								@endif
								  <div class="form-group  " >
									<label for="Reservation Contact" class=" control-label col-md-4 text-left"> Reservation Contact </label>
									<div class="col-md-6">
									  {!! Form::text('reservation_contact', $row['reservation_contact'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Reservation Email" class=" control-label col-md-4 text-left"> Reservation Email </label>
									<div class="col-md-6">
									  {!! Form::text('reservation_email', $row['reservation_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Event Type" class=" control-label col-md-4 text-left"> Event Type </label>
									<div class="col-md-6">
									  
					<?php $event_type = explode(',',$row['event_type']);
					$event_type_opt = array( 'Event' => 'Event' ,  'Occasion' => 'Occasion' , ); ?>
					<select name='event_type' rows='5'   class='select2 '  > 
						<?php 
						foreach($event_type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['event_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Website" class=" control-label col-md-4 text-left"> Website </label>
									<div class="col-md-6">
									  {!! Form::text('website', $row['website'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Location" class=" control-label col-md-4 text-left"> Location </label>
									<div class="col-md-6">
									  {!! Form::text('location', $row['location'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
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
					<button type="button" onclick="location.href='{{ URL::to('events?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#property_id").jCombo("{{ URL::to('events/comboselect?filter=tb_properties:id:property_name|property_slug') }}",
		{  selected_value : '{{ $row["property_id"] }}' });
		
		$("#user_id").jCombo("{{ URL::to('events/comboselect?filter=tb_users:id:username|id') }}",
		{  selected_value : '{{ $row["user_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop