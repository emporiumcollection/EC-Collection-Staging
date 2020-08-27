@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('designers?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'designers/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Designers</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-2 text-left"> Id </label>
									<div class="col-md-8">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div class="form-group">
									<label for="Name" class=" control-label col-md-2 text-left"> Creatives <span class="asterix"> * </span></label>
									<div class="col-md-8">
									    <select name='creatives' rows='5' id='creatives' class='select2' >
                                            @if(!empty($creatives))
                                            @foreach($creatives as $creative)
                                            <option value="{{$creative->id}}" {{ (isset($row['creative_id']) && ($row['creative_id']==$creative->id)) ? " selected='selected' " : '' }}>{{$creative->title}}</option>
                                            @endforeach
                                            @endif
                                        </select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                   					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-2 text-left"> Name <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  {!! Form::text('designer_name', $row['designer_name'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true'  )) !!}

									  {!! Form::text('designer_name_eng', $row['designer_name_eng'],array('class'=>'form-control leng', 'placeholder'=>''  )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>

                                    <div class="form-group  " >
									<label for="Intro Text" class=" control-label col-md-2 text-left"> Intro Text <span class="asterix"> * </span></label>
									<div class="col-md-8 ldutch">
									  <textarea name='designer_intro_text' rows='5' id='designer_intro_text' class='form-control editor'  
				         required  >{{ $row['designer_intro_text'] }}</textarea> 
									 </div>

									<div class="col-md-8 leng">
									  <textarea name='designer_intro_text_eng' rows='5' id='designer_intro_text_eng' class='form-control editor'  
				         required  >{{ $row['designer_intro_text_eng'] }}</textarea> 
									 </div>
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-2 text-left"> Description <span class="asterix"> * </span></label>
									<div class="col-md-8 ldutch">
									  <textarea name='designer_description' rows='5' id='designer_description' class='form-control editor'  
				         required  >{{ $row['designer_description'] }}</textarea> 
									 </div>

									<div class="col-md-8 leng">
									  <textarea name='designer_description_eng' rows='5' id='designer_description_eng' class='form-control editor'  
				         required  >{{ $row['designer_description_eng'] }}</textarea> 
									 </div>
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Image1 </label>
									<div class="col-md-8">
									  <input  type='file' name='image1' id='image1' @if($row['image1'] =='') class='required' @endif style='width:150px !important;'  />									  
									<div >
									{!! SiteHelpers::showUploadedFile($row['image1'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-2 text-left"> Image1 Hover Text <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  {!! Form::text('image1_hover', $row['image1_hover'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true'  )) !!}

									  {!! Form::text('image1_hover_eng', $row['image1_hover_eng'],array('class'=>'form-control leng', 'placeholder'=>''  )) !!}
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Image2 </label>
									<div class="col-md-8">
									  <input  type='file' name='image2' id='image2' @if($row['image2'] =='') class='required' @endif style='width:150px !important;'  />									  
									<div >
									{!! SiteHelpers::showUploadedFile($row['image2'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-2 text-left"> Image2 Description <span class="asterix"> * </span></label>
									<div class="col-md-8 ldutch">
									  <textarea name='image2_description' rows='5' id='image2_description' class='form-control editor'  
				         required  >{{ $row['image2_description'] }}</textarea> 
									 </div>

									<div class="col-md-8 leng">
									  <textarea name='image2_description_eng' rows='5' id='image2_description_eng' class='form-control editor'  
				         required  >{{ $row['image2_description_eng'] }}</textarea> 
									 </div>
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
                                  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Image3 </label>
									<div class="col-md-8">
									  <input  type='file' name='image3' id='image3' @if($row['image3'] =='') class='required' @endif style='width:150px !important;'  />									  
									<div >
									{!! SiteHelpers::showUploadedFile($row['image3'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
								  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Featured Image</label>
									<div class="col-md-8">
									  <input  type='file' name='featured_image' id='featured_image' @if($row['featured_image'] =='') class='required' @endif style='width:150px !important;'  />
									  <small>Image dimension max 632 x 464</small>
									<div >
									{!! SiteHelpers::showUploadedFile($row['featured_image'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  
								  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Slider Image 1</label>
									<div class="col-md-8">
									  <input  type='file' name='designer_image' id='designer_image' @if($row['designer_image'] =='') class='required' @endif style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['designer_image'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 

									<div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Slider Image 2</label>
									<div class="col-md-8">
									  <input  type='file' name='designer_image2' id='designer_image2' @if($row['designer_image2'] =='') class='required' @endif style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['designer_image2'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for=" Image" class=" control-label col-md-2 text-left"> Slider Image 3</label>
									<div class="col-md-8">
									  <input  type='file' name='designer_image3' id='designer_image3' @if($row['designer_image3'] =='') class='required' @endif style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['designer_image3'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group">
									<label for=" Image" class=" control-label col-md-2 text-left"> Slider Image 4</label>
									<div class="col-md-8">
									  <input  type='file' name='designer_image4' id='designer_image4' @if($row['designer_image4'] =='') class='required' @endif style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['designer_image4'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group">
									<label for="Designer's video" class=" control-label col-md-2 text-left"> Designer's video</label>
									<div class="col-md-8">
									  <input  type='file' name='designer_video' id='designer_video'  style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['designer_video'],'/uploads/designer_images/') !!}
									
									</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for="Designer URL" class=" control-label col-md-2 text-left"> Designer URL </label>
									<div class="col-md-8">
									  {!! Form::text('designer_url', $row['designer_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for="Position Number" class=" control-label col-md-2 text-left"> Position Number </label>
									<div class="col-md-8">
									  {!! Form::text('designer_num', $row['designer_num'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
									
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-2 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='designer_status' value ='0' required @if($row['designer_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='designer_status' value ='1' required @if($row['designer_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('designers?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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
	</script>		 
@stop