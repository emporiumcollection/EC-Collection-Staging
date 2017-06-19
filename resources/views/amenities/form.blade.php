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
		<li><a href="{{ URL::to('amenities?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'amenities/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Amenities</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Parent Amenity" class=" control-label col-md-3 text-left"> Parent Amenity </label>
									<div class="col-md-7">
									  
									<?php $parent_amenity_id = explode(',',$row['parent_amenity_id']);
									$parent_category_id_opt = array( '0' => '-- Select category --' , ); ?>
									<select name='parent_amenity_id' rows='5'   class='select2 '  > 
										<option  value ="0">-- Select Category --</option> 
										@foreach($parent_amenity as $val)
										
											<option  value ="{{$val['id']}}" {{($row['parent_amenity_id'] == $val['id']) ? " selected='selected' " : '' }}>{{$val['name']}}</option> 						
										@endforeach						
										</select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-3 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  {!! Form::text('amenity_title', $row['amenity_title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-3 text-left"> Description <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  <textarea name='amenity_description' rows='5' id='editor' class='form-control editor '  
						required >{{ $row['amenity_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image" class=" control-label col-md-3 text-left"> Image </label>
									<div class="col-md-7">
									  <input  type='file' name='amenity_image' id='amenity_image' @if($row['amenity_image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['amenity_image'],'/uploads/amenity_image/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-3 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='amenity_status' value ='0' required @if($row['amenity_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='amenity_status' value ='1' required @if($row['amenity_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('amenities?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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