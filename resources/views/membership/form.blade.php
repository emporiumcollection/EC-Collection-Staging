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
		<li><a href="{{ URL::to('membership?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'membership/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Manage Membership</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Name" class=" control-label col-md-4 text-left"> Package Name <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('package_name', $row['package_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
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
									<label for="Package Duration" class=" control-label col-md-4 text-left"> Package Duration <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<?php $package_duration = explode(',',$row['package_duration']);
					$package_duration_opt = array( '' => '- Select duration -' ,  '1' => '1 Month' ,  '2' => '2 Months' ,  '3' => '3 Months' ,  '4' => '4 Months' ,  '5' => '5 Months' ,  '6' => '6 Months' ,  '7' => '7 Months' ,  '8' => '8 Months' ,  '9' => '9 Months' ,  '10' => '10 Months' ,  '11' => '11 Months' ,  '12' => '12 Months' , ); ?>
					<select name='package_duration' rows='5' required  class='select2 '  > 
						<?php 
						foreach($package_duration_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['package_duration'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Size ( in GB )" class=" control-label col-md-4 text-left"> Package Size ( in GB ) <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('package_size', $row['package_size'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Modules" class=" control-label col-md-4 text-left"> Package Modules <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='package_modules[]' multiple rows='5' id='package_modules' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='0'  @if($row['status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='status' value ='1'  @if($row['status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('membership?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#package_modules").jCombo("{{ URL::to('membership/comboselect?filter=tb_module:module_id:module_name') }}",
		{  selected_value : '{{ $row["package_modules"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop