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
		<li><a href="{{ URL::to('presentationslider?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'presentationslider/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Presentation Slider</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Presentation Page Id" class=" control-label col-md-4 text-left"> Presentation Page Id </label>
									<div class="col-md-6">
									  <select name='presentation_page_id' rows='5' id='presentation_page_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Title" class=" control-label col-md-4 text-left"> Slider Title </label>
									<div class="col-md-6">
									  {!! Form::text('slider_title', $row['slider_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Description" class=" control-label col-md-4 text-left"> Slider Description </label>
									<div class="col-md-6">
									  <textarea name='slider_description' rows='5' id='slider_description' class='form-control '  
				           >{{ $row['slider_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Sub Title" class=" control-label col-md-4 text-left"> Slider Sub Title </label>
									<div class="col-md-6">
									  {!! Form::text('slider_sub_title', $row['slider_sub_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Sub Description" class=" control-label col-md-4 text-left"> Slider Sub Description </label>
									<div class="col-md-6">
									  <textarea name='slider_sub_description' rows='5' id='slider_sub_description' class='form-control '  
				           >{{ $row['slider_sub_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Img" class=" control-label col-md-4 text-left"> Slider Img </label>
									<div class="col-md-6">
									  <input  type='file' name='slider_img' id='slider_img' @if($row['slider_img'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['slider_img'],'/uploads/presentation/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Link" class=" control-label col-md-4 text-left"> Slider Link </label>
									<div class="col-md-6">
									  <textarea name='slider_link' rows='5' id='slider_link' class='form-control '  
				           >{{ $row['slider_link'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
									<div class="col-md-6">
									  {!! Form::text('user_id', $row['user_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Created" class=" control-label col-md-4 text-left"> Created </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('created', $row['created'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Updated" class=" control-label col-md-4 text-left"> Updated </label>
									<div class="col-md-6">
									  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('updated', $row['updated'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Video" class=" control-label col-md-4 text-left"> Slider Video </label>
									<div class="col-md-6">
									  <textarea name='slider_video' rows='5' id='slider_video' class='form-control '  
				           >{{ $row['slider_video'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slide Type" class=" control-label col-md-4 text-left"> Slide Type </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='slide_type' value ='Image'  @if($row['slide_type'] == 'Image') checked="checked" @endif > Image </label>
					<label class='radio radio-inline'>
					<input type='radio' name='slide_type' value ='Video'  @if($row['slide_type'] == 'Video') checked="checked" @endif > Video </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advert Id" class=" control-label col-md-4 text-left"> Advert Id </label>
									<div class="col-md-6">
									  {!! Form::text('advert_id', $row['advert_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Status" class=" control-label col-md-4 text-left"> Slider Status </label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='slider_status' value ='1'  @if($row['slider_status'] == '1') checked="checked" @endif > Active </label>
					<label class='radio radio-inline'>
					<input type='radio' name='slider_status' value ='0'  @if($row['slider_status'] == '0') checked="checked" @endif > In Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('presentationslider?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#presentation_page_id").jCombo("{{ URL::to('presentationslider/comboselect?filter=tb_presentation_pages::page_name|page_slug') }}",
		{  selected_value : '{{ $row["presentation_page_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop