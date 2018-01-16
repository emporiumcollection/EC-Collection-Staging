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
		<li><a href="{{ URL::to('packages?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'packages/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Packages</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Title" class=" control-label col-md-4 text-left"> Package Title <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('package_title', $row['package_title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
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
									<label for="Package Image" class=" control-label col-md-4 text-left"> Package Image </label>
									<div class="col-md-6">
									  <input  type='file' name='package_image' id='package_image' @if($row['package_image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['package_image'],'/uploads/packages/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Price Type" class=" control-label col-md-4 text-left"> Package Price Type </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='package_price_type' value ='0'  @if($row['package_price_type'] == '0') checked="checked" @endif > Price </label>
					<label class='radio radio-inline'>
					<input type='radio' name='package_price_type' value ='1'  @if($row['package_price_type'] == '1') checked="checked" @endif > On Request </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Price" class=" control-label col-md-4 text-left"> Package Price </label>
									<div class="col-md-6">
									  {!! Form::text('package_price', $row['package_price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Package Duration Type" class=" control-label col-md-4 text-left"> Package Duration Type </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='package_duration_type' value ='Days'  @if($row['package_duration_type'] == 'Days') checked="checked" @endif > Days </label>
					<label class='radio radio-inline'>
					<input type='radio' name='package_duration_type' value ='Months'  @if($row['package_duration_type'] == 'Months') checked="checked" @endif > Months </label>
					<label class='radio radio-inline'>
					<input type='radio' name='package_duration_type' value ='Year'  @if($row['package_duration_type'] == 'Year') checked="checked" @endif > Year </label> 
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
									<label for="Package Status" class=" control-label col-md-4 text-left"> Package Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='package_status' value ='0' required @if($row['package_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='package_status' value ='1' required @if($row['package_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('packages?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop