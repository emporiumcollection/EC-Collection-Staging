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
		<li><a href="{{ URL::to('myusers?return='.$return) }}">{{ $pageTitle }}</a></li>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small>{{ $pageNote }}</small></h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'myusers/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-6">
						<fieldset><legend> Users</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Group / Level " class=" control-label col-md-4 text-left"> Group / Level  <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='group_id' rows='5' id='group_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Username" class=" control-label col-md-4 text-left"> Username <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('username', $row['username'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="First Name" class=" control-label col-md-4 text-left"> First Name <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('first_name', $row['first_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Last Name" class=" control-label col-md-4 text-left"> Last Name </label>
									<div class="col-md-6">
									  {!! Form::text('last_name', $row['last_name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='active' value ='0'  @if($row['active'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='active' value ='1'  @if($row['active'] == '1') checked="checked" @endif > Active </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <!--<div class="form-group  " >
									<label for="Avatar" class=" control-label col-md-4 text-left"> Avatar </label>
									<div class="col-md-6">
									  <input  type='file' name='avatar' id='avatar' @if($row['avatar'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['avatar'],'/uploads/users/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> -->					
								  <div class="form-group  " >
									<label for="Storage Space" class=" control-label col-md-4 text-left"> Storage Space(in MB) </label>
									<div class="col-md-6">
									  {!! Form::text('storage_space', $row['storage_space'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			<div class="col-md-6">
						<fieldset>
						<legend> 
							@if($row['id'] !='')
								{{ Lang::get('core.notepassword') }}
							@else
								Create Password
							@endif	
						</legend>
						<div class="form-group">
							<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.newpassword') }} </label>
							<div class="col-md-8">
							<input name="password" type="password" id="password" class="form-control input-sm" value=""
							@if($row['id'] =='')
								required
							@endif
							 /> 
							 </div> 
						</div>  
						  
						<div class="form-group">
							<label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.conewpassword') }} </label>
							<div class="col-md-8">
								<input name="password_confirmation" type="password" id="password_confirmation" class="form-control input-sm" value=""
								@if($row['id'] =='')
									required
								@endif		
								/>  
							 </div> 
						</div>
						
						<div class="form-group  " >
							<label for="commission ( in %)" class=" control-label col-md-4 text-left"> commission ( in %)</label>
							<div class="col-md-8">
							  {!! Form::text('commission', $row['commission'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 
						</div>
						
						<div class="form-group">
							<label for="currency" class=" control-label col-md-4"> Currency </label>
							<div class="col-md-8">
								<select class="form-control" name="currency">
									<option value="€" <?php if($row['currency']=='€') { echo 'selected="selected"'; } ?>>Euro (€)</option>
									<option value="£" <?php if($row['currency']=='£') { echo 'selected="selected"'; } ?>>Pound (£)</option>
									<option value="$" <?php if($row['currency']=='$') { echo 'selected="selected"'; } ?>>Dollar ($)</option>
								</select>
							 </div> 
						  </div>
						  
						  <div class="form-group  " >
							<label for="Contracts" class=" control-label col-md-4 text-left"> Contracts </label>
							<div class="col-md-8">
							  <input  type='file' name='contracts' id='contracts' style='width:150px !important;'  />
								<div>
									{!! SiteHelpers::showUploadedFile($row['contracts'],'/uploads/users/') !!}	
								</div>
							 </div> 
							 
						  </div> 
				
				</fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('myusers?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#group_id").jCombo("{{ URL::to('myusers/comboselect?filter=tb_groups:group_id:name') }}",
		{  selected_value : '{{ $row["group_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop