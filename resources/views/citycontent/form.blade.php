@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
.sf-viewport { margin-bottom:60px !important; }
</style>
<!-- Step Form Wizard plugin -->
<link rel="stylesheet" href="{{ asset('sximo/css/frontend_templete/step-form-wizard/css/step-form-wizard-all.css')}}" type="text/css" media="screen, projection">
<script src="{{ asset('sximo/js/frontend_templete/step-form-wizard/js/step-form-wizard.js')}}"></script>
<script>
        $(document).ready(function () {
            $("#wizard_example").stepFormWizard({
                theme: 'circle' // sea, sky, simple, circle, sun
            });
        })
    </script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('citycontent?return='.$return) }}">{{ $pageTitle }}</a></li>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'citycontent/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ', 'id' => 'wizard_example')) !!}
<div class="col-md-12">
						<fieldset><legend> Step 1</legend>
									
								  <div class="form-group  hidethis" >
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
									<label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
									<div class="col-md-6">
									  {!! Form::text('sub_title', $row['sub_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="Metakey" class=" control-label col-md-4 text-left"> Meta keyword </label>
									<div class="col-md-6">
									  <textarea name='metakey' rows='5' id='metakey' class='form-control '  
				           >{{ $row['metakey'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Metadesc" class=" control-label col-md-4 text-left"> Meta Description </label>
									<div class="col-md-6">
									  <textarea name='metadesc' rows='5' id='metadesc' class='form-control '  
				           >{{ $row['metadesc'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="Category" class=" control-label col-md-4 text-left"> Category </label>
									<div class="col-md-6">
									  
					<?php $category = explode(',',$row['category']);
					$category_opt = array( 'test' => 'Test' , ); ?>
					<select name='category' rows='5'   class='select2 '  > 
						<?php 
						foreach($category_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['category'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider" class=" control-label col-md-4 text-left"> Slider </label>
									<div class="col-md-6">
									  <select name='slider' rows='5' id='slider' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
									<div class="col-md-6">
									  <textarea name='description' rows='5' id='editor' class='form-control editor '  
						 >{{ $row['description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								</fieldset>  
								  <fieldset>
										<legend>Step 2</legend>				
								  					
								  
								 </fieldset>
				<fieldset>
					<legend>Upload Images</legend>	

								  <div class="form-group  " >
									<label for="Gallery Title" class=" control-label col-md-4 text-left"> Gallery Title </label>
									<div class="col-md-6">
									  {!! Form::text('gallery_title', $row['gallery_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Designers" class=" control-label col-md-4 text-left"> Designers </label>
									<div class="col-md-6">
									  <select name='designers[]' multiple rows='5' id='designers' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 	
							</fieldset>
				<fieldset>
					<legend>Step 4</legend>	  				
								  <div class="form-group  " >
									<label for="Experience" class=" control-label col-md-4 text-left"> Experience </label>
									<div class="col-md-6">
									  {!! Form::text('experience', $row['experience'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
									<div class="col-md-6">
									  {!! Form::text('instagram', $row['instagram'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Youtube" class=" control-label col-md-4 text-left"> Youtube </label>
									<div class="col-md-6">
									  {!! Form::text('youtube', $row['youtube'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<?php $status = explode(',',$row['status']);
					$status_opt = array( 'enable' => 'Enable' ,  'disable' => 'Disable' , ); ?>
					<select name='status' rows='5' required  class='select2 '  > 
						<?php 
						foreach($status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 

								</fieldset>
				<fieldset>
					<legend>Step 4</legend>  					
								  
								</fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('citycontent?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>	


<!-- open container Modal -->
<div class="modal fade" id="openContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">Select Image</h4>
		  </div>
		  <div class="modal-body">
			 <iframe id="iframe_id_123" src="{{URL::to('containeriframe').'/0/iframe'}}" style="height: 430px;width: 553px;border: none;"></iframe>
		  </div>
		  <div class="modal-footer">
			  <input type="hidden" name="boxid" id="boxid" value="">
			  <button type="button" class="btn btn-primary" onclick="selectimg();">ok</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>

	  </div>
  </div>
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#slider").jCombo("{{ URL::to('citycontent/comboselect?filter=tb_sliders:id:slider_title') }}",
		{  selected_value : '{{ $row["slider"] }}' });
		
		$("#designers").jCombo("{{ URL::to('citycontent/comboselect?filter=tb_designers::designer_name') }}",
		{  selected_value : '{{ $row["designers"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	function change_lang(lang)
	{
		if(lang=='dutch')
		{
			$('.ldutch').css('display', 'block');
			$('.leng').css('display', 'none');
		}
		else if(lang=='eng')
		{
			$('.ldutch').css('display', 'none');
			$('.leng').css('display', 'block');
		}
	}
	
	function sendmotId(boxid)
	{
		$('#boxid').val(boxid);
	}
	
	function selectimg(obj)
	{
		var bid = $('#boxid').val();
		var cat = $('#cat_id').val();
		var sList='';
		var sListid='';
		var highrespath='';
		sList = $(obj).attr('rel2');
		imgname = $(obj).attr('rel');
		imagepath = $(obj).attr('rel3');
		$('#box'+bid).val(imagepath);
		$('#boxspan'+bid).html(imgname);
		$('#openContainer').modal('hide');
	}
	
	</script>			 
@stop