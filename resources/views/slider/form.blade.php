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
		<li><a href="{{ URL::to('slider?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'slider/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Slider</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                                    <div class="form-group  " >
                                                        <label for="Type" class=" control-label col-md-4 text-left"> Slider Category <span class="asterix"> * </span></label>
                                                        <div class="col-md-6">
                                                            <select name='slider_category' id='slider_category' class=" select2" required > 
                                                                <option value="">-Select-</option>
                                                                <option value="Landing" <?php echo ($row['slider_category'] == 'Landing' ? " selected='selected' " : '' ); ?>>Landing</option>
                                                                <option value="Hotel" <?php echo ($row['slider_category'] == 'Hotel' ? " selected='selected' " : '' ); ?>>Hotels</option>
                                                                <option value="Villas" <?php echo ($row['slider_category'] == 'Villas' ? " selected='selected' " : '' ); ?>>Villas</option>
                                                                <option value="Yachts" <?php echo ($row['slider_category'] == 'Yachts' ? " selected='selected' " : '' ); ?>>Yachts</option>
                                                                <option value="Safari Lodges" <?php echo ($row['slider_category'] == 'Safari Lodges' ? " selected='selected' " : '' ); ?>>Safari Lodges</option>
                                                                <option value="Spas" <?php echo ($row['slider_category'] == 'Spas' ? " selected='selected' " : '' ); ?>>Spas</option>
                                                                @if(!empty($allcats))
                                                                @foreach($allcats as $cats)
                                                                <option value="{{$cats->category_name}}" <?php echo ($row['slider_category'] == $cats->category_name ? " selected='selected' " : '' ); ?>>{{$cats->category_name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select> 
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
									<label for="Slider Image" class=" control-label col-md-4 text-left"> Slider Image </label>
									<div class="col-md-6">
									  <input  type='file' name='slider_img' id='slider_img' @if($row['slider_img'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['slider_img'],'/uploads/slider_images/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Link" class=" control-label col-md-4 text-left"> Slider Link <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('slider_link', $row['slider_link'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slider Video" class=" control-label col-md-4 text-left"> Slider Video </label>
									<div class="col-md-6">
									  {!! Form::text('slider_video', $row['slider_video'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	<a href="#" data-toggle="tooltip" placement="left" class="tips" title="YouTube Video ID"><i class="icon-question2"></i></a>
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Slide Type" class=" control-label col-md-4 text-left"> Slide Type </label>
									<div class="col-md-6">
									  
					<?php $slide_type = explode(',',$row['slide_type']);
					$slide_type_opt = array( 'Image' => 'Image' ,  'Video' => 'Video' , ); ?>
					<select name='slide_type' rows='5'   class='select2 '  > 
						<?php 
						foreach($slide_type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['slide_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
					
						<div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='slider_status' value ='0' required @if($row['slider_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='slider_status' value ='1' required @if($row['slider_status'] == '1') checked="checked" @endif > Active </label> 
									 </div> 
									 <div class="col-md-2">
									 	
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
					<button type="button" onclick="location.href='{{ URL::to('slider?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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