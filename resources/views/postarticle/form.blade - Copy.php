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
		<li><a href="{{ URL::to('postarticle?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'postarticle/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
			<div class="col-md-12">
						<fieldset>
							<legend> Post Article</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category" class=" control-label col-md-4 text-left"> Category <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='cat_id' rows='5' id='cat_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image Position 1" class=" control-label col-md-4 text-left"> Image Position 1 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_1' id='image_pos_1' @if($row['image_pos_1'] =='') class='required' @endif style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['image_pos_1'],'/uploads/article_imgs/') !!}
									
									</div>					
					 
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
								  <div class="form-group  " >
									<label for="Image Position 2" class=" control-label col-md-4 text-left"> Image Position 2 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_2' id='image_pos_2' @if($row['image_pos_2'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_2'],'/uploads/article_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image Position 3" class=" control-label col-md-4 text-left"> Image Position 3 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_3' id='image_pos_3' @if($row['image_pos_3'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_3'],'/uploads/article_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description Position 3" class=" control-label col-md-4 text-left"> Description Position 3 </label>
									<div class="col-md-6">
									  <textarea name='description_pos_3' rows='5' id='description_pos_3' class='form-control '  
				           >{{ $row['description_pos_3'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image Position 4" class=" control-label col-md-4 text-left"> Image Position 4 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_4' id='image_pos_4' @if($row['image_pos_4'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_4'],'/uploads/article_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image Position 5" class=" control-label col-md-4 text-left"> Image Position 5 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_5' id='image_pos_5' @if($row['image_pos_5'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_5'],'/uploads/article_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Image Position 6" class=" control-label col-md-4 text-left"> Image Position 6 </label>
									<div class="col-md-6">
									  <input  type='file' name='image_pos_6' id='image_pos_6' @if($row['image_pos_6'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_6'],'/uploads/article_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title Position 6" class=" control-label col-md-4 text-left"> Title Position 6 </label>
									<div class="col-md-6">
									  {!! Form::text('title_pos_6', $row['title_pos_6'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description Position 6" class=" control-label col-md-4 text-left"> Description Position 6 </label>
									<div class="col-md-6">
									  <textarea name='description_pos_6' rows='5' id='description_pos_6' class='form-control '  
				           >{{ $row['description_pos_6'] }}</textarea> 
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
								  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('postarticle?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
		 
		<form id="wizard_example" action="">
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
					<label for="Category" class=" control-label col-md-4 text-left"> Category <span class="asterix"> * </span></label>
					<div class="col-md-6">
					  <select name='cat_id' rows='5' id='cat_id' class='select2 ' required  ></select> 
					 </div> 
					 <div class="col-md-2">
						
					 </div>
				</div> 					
				<div class="form-group  " >
					<label for="Image Position 1" class=" control-label col-md-4 text-left"> Image Position 1 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_1' id='image_pos_1' @if($row['image_pos_1'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_1'],'/uploads/article_imgs/') !!}
						
						</div>
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
					<label for="Image Position 2" class=" control-label col-md-4 text-left"> Image Position 2 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_2' id='image_pos_2' @if($row['image_pos_2'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_2'],'/uploads/article_imgs/') !!}
						
						</div>
					</div> 
					<div class="col-md-2">
						
					</div>
				</div> 					
				<div class="form-group  " >
					<label for="Image Position 3" class=" control-label col-md-4 text-left"> Image Position 3 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_3' id='image_pos_3' @if($row['image_pos_3'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_3'],'/uploads/article_imgs/') !!}
						
						</div>
					 </div> 
					 <div class="col-md-2">
						
					 </div>
				</div> 
				
				<div class="form-group  " >
					<label for="Image Position 4" class=" control-label col-md-4 text-left"> Image Position 4 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_4' id='image_pos_4' @if($row['image_pos_4'] =='') class='required' @endif style='width:150px !important;'  />
						<div>
						{!! SiteHelpers::showUploadedFile($row['image_pos_4'],'/uploads/article_imgs/') !!}
						
						</div>
					 </div> 
					 <div class="col-md-2">
						
					 </div>
				</div> 					
				<div class="form-group  " >
					<label for="Image Position 5" class=" control-label col-md-4 text-left"> Image Position 5 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_5' id='image_pos_5' @if($row['image_pos_5'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_5'],'/uploads/article_imgs/') !!}
						
						</div>
					</div> 
					<div class="col-md-2">
						
					</div>
				</div> 					
				<div class="form-group  " >
					<label for="Image Position 6" class=" control-label col-md-4 text-left"> Image Position 6 </label>
					<div class="col-md-6">
						<input  type='file' name='image_pos_6' id='image_pos_6' @if($row['image_pos_6'] =='') class='required' @endif style='width:150px !important;'  />
						<div >
						{!! SiteHelpers::showUploadedFile($row['image_pos_6'],'/uploads/article_imgs/') !!}
						
						</div>
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
					<label for="Title Position 6" class=" control-label col-md-4 text-left"> Title Position 6 </label>
					<div class="col-md-6">
					  {!! Form::text('title_pos_6', $row['title_pos_6'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					 </div> 
					 <div class="col-md-2">
						
					 </div>
				</div> 					
				<div class="form-group  " >
					<label for="Description Position 6" class=" control-label col-md-4 text-left"> Description Position 6 </label>
					<div class="col-md-6">
					  <textarea name='description_pos_6' rows='5' id='description_pos_6' class='form-control '  
		   >{{ $row['description_pos_6'] }}</textarea> 
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
		</form>
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#cat_id").jCombo("{{ URL::to('postarticle/comboselect?filter=tb_news_categories:cat_id:cat_name') }}",
		{  selected_value : '{{ $row["cat_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop