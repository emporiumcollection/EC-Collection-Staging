@extends('layouts.app')

@section('content')
<!-- Step Form Wizard plugin -->
<link rel="stylesheet" href="{{ asset('sximo/css/frontend_templete/step-form-wizard/css/step-form-wizard-all.css')}}" type="text/css" media="screen, projection">
<script src="{{ asset('sximo/js/frontend_templete/step-form-wizard/js/step-form-wizard.js')}}"></script>
<script>
	$(document).ready(function () {
		$("#wizard_example").stepFormWizard({
			theme: 'circle' // sea, sky, simple, circle, sun
		});
	})
	$(window).load(function () {
		/* only if you want use mcustom scrollbar */
		$(".sf-step").mCustomScrollbar({
			theme: "dark-3",
			scrollButtons: {
				enable: true
			}
		});
	});
</script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('postprojects?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'postprojects/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ', 'id' => 'wizard_example')) !!}
				<div class="col-md-12">
					<fieldset>
					<legend>Basic information</legend>
					<div class="form-group hidethis " style="display:none;">
						<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
						<div class="col-md-6">
							{!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					 					
					<div class="form-group  " >
						<label for="Image Position 1" class=" control-label col-md-4 text-left"> Image Position 1 </label>
						<div class="col-md-3">
							<input  type='file' name='image_pos_1' id='image_pos_1' @if($row['image_pos_1'] =='') class='required' @endif style='width:150px !important;'  />
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_1'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div> 
						 <div class="col-md-3">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(1);">Choose from container</a>
							<input type="hidden" name="container_image_pos_1" id="box1" value="">
							<span id="boxspan1"></span>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Title Position 1" class=" control-label col-md-4 text-left"> Title Position 1 <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  {!! Form::text('title_pos_1', $row['title_pos_1'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Description Position 1" class=" control-label col-md-4 text-left"> Description Position 1 <span class="asterix"> * </span></label>
						<div class="col-md-6">
						  <textarea name='description_pos_1' rows='5' id='description_pos_1' class='form-control '  
			 required  >{{ $row['description_pos_1'] }}</textarea> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
				</fieldset>
				
				<fieldset>
					<legend>Upload Images</legend>
					<div class="form-group  " >
						<label for="Photography" class=" control-label col-md-4 text-left"> Photography </label>
						<div class="col-md-6">
						  {!! Form::text('image_credit', $row['image_credit'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					<div class="form-group  " >
						<label for="Image Position 2" class=" control-label col-md-4 text-left"> Image Position 2 </label>
						<div class="col-md-3">
							<input  type='file' name='image_pos_2' id='image_pos_2' @if($row['image_pos_2'] =='') class='required' @endif style='width:150px !important;'  />
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_2'],'/uploads/article_imgs/') !!}
							
							</div>
						</div> 
						<div class="col-md-3">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(2);">Choose from container</a>
							<input type="hidden" name="container_image_pos_2" id="box2" value="">
							<span id="boxspan2"></span>
						 </div> 
						<div class="col-md-2">
							
						</div>
					</div> 					
					<div class="form-group  " >
						<label for="Image Position 3" class=" control-label col-md-4 text-left"> Image Position 3 </label>
						<div class="col-md-3">
							<input  type='file' name='image_pos_3' id='image_pos_3' @if($row['image_pos_3'] =='') class='required' @endif style='width:150px !important;'  />
							<div >
							{!! SiteHelpers::showUploadedFile($row['image_pos_3'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div>
						 <div class="col-md-3">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(3);">Choose from container</a>
							<input type="hidden" name="container_image_pos_3" id="box3" value="">
							<span id="boxspan3"></span>
						 </div>
						 <div class="col-md-2">
							
						 </div>
					</div> 
					
					<div class="form-group  " >
						<label for="Image Position 4" class=" control-label col-md-4 text-left"> Image Position 4 </label>
						<div class="col-md-3">
							<input  type='file' name='image_pos_4' id='image_pos_4' @if($row['image_pos_4'] =='') class='required' @endif style='width:150px !important;'  />
							<div>
							{!! SiteHelpers::showUploadedFile($row['image_pos_4'],'/uploads/article_imgs/') !!}
							
							</div>
						 </div>
						<div class="col-md-3">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(4);">Choose from container</a>
							<input type="hidden" name="container_image_pos_4" id="box4" value="">
							<span id="boxspan4"></span>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div>
					
					<div class="form-group  " >
						<label for="Pdf File" class=" control-label col-md-4 text-left"> Pdf File </label>
						<div class="col-md-3">
						  <input  type='file' name='pdf_file' id='pdf_file' @if($row['pdf_file'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['pdf_file'],'/uploads/project_imgs/') !!}
						
						</div>					
		 
						 </div> 
						 <div class="col-md-3">
							<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(5);">Choose from container</a>
							<input type="hidden" name="container_pdf_file" id="box5" value="">
							<span id="boxspan5"></span>
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					  </div> 
				</fieldset>
				<fieldset>
					<legend>Final step</legend>
					<div class="form-group  " >
						<label for="Description Position 3" class=" control-label col-md-4 text-left"> Description Position 3 </label>
						<div class="col-md-6">
						  <textarea name='description_pos_3' rows='5' id='description_pos_3' class='form-control' >{{ $row['description_pos_3'] }}</textarea> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 
					
					<div class="form-group  " >
						<label for="Title Position 4" class=" control-label col-md-4 text-left"> Title Position 4 </label>
						<div class="col-md-6">
						  {!! Form::text('title_pos_4', $row['title_pos_4'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Description Position 4" class=" control-label col-md-4 text-left"> Description Position 4 </label>
						<div class="col-md-6">
						  <textarea name='description_pos_4' rows='5' id='description_pos_4' class='form-control '  
			   >{{ $row['description_pos_4'] }}</textarea> 
						 </div> 
						 <div class="col-md-2">
							
						 </div>
					</div> 					
					<div class="form-group  " >
						<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
						<div class="col-md-6"> 
							<label class='radio radio-inline'>
							<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > Inactive </label>
							<label class='radio radio-inline'>
							<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > Active </label> 
						</div> 
						<div class="col-md-2">
							
						</div>
					</div> 					
					<div class="form-group  " >
						<label for="Publish Date" class=" control-label col-md-4 text-left"> Publish Date <span class="asterix"> * </span></label>
						<div class="col-md-6">  
							<div class="input-group m-b" style="width:150px !important;">
								{!! Form::text('publish_date', $row['publish_date'],array('class'=>'form-control date')) !!}
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div> 
						</div> 
						<div class="col-md-2">
							
						 </div>
					</div>
				</fieldset>
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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	
	function sendmotId(boxid)
	{
		$('#boxid').val(boxid);
	}
	
	function selectimg(obj)
	{
		var bid = $('#boxid').val();
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