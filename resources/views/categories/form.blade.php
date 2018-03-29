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
		<li><a href="{{ URL::to('categories?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'categories/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Categories</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Parent Category" class=" control-label col-md-3 text-left"> Parent Category </label>
									<div class="col-md-7">
									  
									<?php $parent_category_id = explode(',',$row['parent_category_id']);
									$parent_category_id_opt = array( '0' => '-- Select category --' , ); ?>
									<select name='parent_category_id' rows='5'   class='select2 '  > 
										<option  value ="0">-- Select Category --</option> 
										@foreach($parent_categories as $val)
										
											<option  value ="{{$val['id']}}" {{($row['parent_category_id'] == $val['id']) ? " selected='selected' " : '' }}>{{$val['name']}}</option> 						
										@endforeach						
										</select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Name" class=" control-label col-md-3 text-left"> Category Name <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  {!! Form::text('category_name', $row['category_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Description" class=" control-label col-md-3 text-left"> Category Description <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  <textarea name='category_description' rows='5' id='editor' class='form-control editor '  
						required >{{ $row['category_description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Image" class=" control-label col-md-3 text-left"> Category Image </label>
									<div class="col-md-7">
									  <input  type='file' name='category_image' id='category_image' @if($row['category_image'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['category_image'],'/uploads/category_imgs/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Custom Title" class=" control-label col-md-3 text-left"> Category Custom Title </label>
									<div class="col-md-7">
									  {!! Form::text('category_custom_title', $row['category_custom_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="Youtube Id" class=" control-label col-md-3 text-left"> Youtube Channel Url </label>
									<div class="col-md-7">
									  {!! Form::text('category_youtube_channel_url', $row['category_youtube_channel_url'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
									
								<div class="form-group  " >
									<label for="Instagram Channel" class=" control-label col-md-3 text-left"> Instagram Channel </label>
									<div class="col-md-7">
									  {!! Form::text('category_instagram_channel', $row['category_instagram_channel'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
							<div class="form-group  " >
								<label for="InstagramTag" class=" control-label col-md-3 text-left"> Instagram Tag </label>
								<div class="col-md-7">
									{!! Form::text('category_instagram_tag', $row['category_instagram_tag'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
								</div>
								<div class="col-md-2">

								</div>
							</div>
								  <div class="form-group  " >
									<label for="Approved" class=" control-label col-md-3 text-left"> Approved <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='category_approved' value ='0' required @if($row['category_approved'] == '0') checked="checked" @endif > No </label>
					<label class='radio radio-inline'>
					<input type='radio' name='category_approved' value ='1' required @if($row['category_approved'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Published" class=" control-label col-md-3 text-left"> Published <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='category_published' value ='0' required @if($row['category_published'] == '0') checked="checked" @endif > No </label>
					<label class='radio radio-inline'>
					<input type='radio' name='category_published' value ='1' required @if($row['category_published'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Featured" class=" control-label col-md-3 text-left"> Featured <span class="asterix"> * </span></label>
									<div class="col-md-7">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='category_featured' value ='0' required @if($row['category_featured'] == '0') checked="checked" @endif > No </label>
					<label class='radio radio-inline'>
					<input type='radio' name='category_featured' value ='1' required @if($row['category_featured'] == '1') checked="checked" @endif > Yes </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('categories?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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