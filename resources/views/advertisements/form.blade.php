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
		<li><a href="{{ URL::to('advertisements?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'advertisements/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Advertisements</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="User" class=" control-label col-md-4 text-left"> User <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='user_id' rows='5' id='user_id' class='select2 ' required  ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Image" class=" control-label col-md-4 text-left"> Advertisement Image </label>
									<div class="col-md-6">
									  <input  type='file' name='adv_img' id='adv_img' @if($row['adv_img'] =='') class='required' @endif style='width:150px !important;'  />
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['adv_img'],'/uploads/users/advertisement/') !!}
						
						</div>					
					 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Link" class=" control-label col-md-4 text-left"> Advertisement Link <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('adv_link', $row['adv_link'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'required'   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Title" class=" control-label col-md-4 text-left"> Advertisement Title </label>
									<div class="col-md-6">
									  {!! Form::text('adv_title', $row['adv_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Description" class=" control-label col-md-4 text-left"> Advertisement Description </label>
									<div class="col-md-6">
									  <textarea name='adv_desc' rows='5' id='adv_desc' class='form-control '  
				           >{{ $row['adv_desc'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Position" class=" control-label col-md-4 text-left"> Advertisement Position <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<?php $adv_position = explode(',',$row['adv_position']);
					$adv_position_opt = array( 'landing' => 'Landing Page Sidebar' ,  'landing_slider' => 'landing Page Slider' ,  'grid_results' => 'Grid Page Results' ,  'grid_sidebar' => 'Grid Page Sidebar' ,  'grid_slider' => 'Grid Page Slider',  'detail_sidebar' => 'Detail Page Sidebar' ,  'detail_restaurant_page' => 'Restaurant Detail Page' ,  'detail_spa_page' => 'Spa Detail Page' ,  'detail_bar_page' => 'Bar Detail Page', 'restro_spa_bar_search_page' => 'Restaurant Bar Spa Search Page', 'social_media_page' => 'Social Media Page', 'youtube_channel_page' => 'Youtube channel Page', 'business_menu_page' => 'Business menu Page', 'wetransfer_upload_page' => 'Wetransfer upload files Page', 'wetransfer_download_page' => 'Wetransfer download files Page', 'email_template' => 'Email template', 'contracts_page' => 'Contracts Page' ); ?>
					<select name='adv_position' rows='5' required  class='select2 '  > 
						<?php 
						foreach($adv_position_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['adv_position'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Status" class=" control-label col-md-4 text-left"> Advertisement Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='adv_status' value ='1' required @if($row['adv_status'] == '1') checked="checked" @endif > Active </label>
					<label class='radio radio-inline'>
					<input type='radio' name='adv_status' value ='0' required @if($row['adv_status'] == '0') checked="checked" @endif > Inactive </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Type" class=" control-label col-md-4 text-left"> Advertisement Type <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='adv_type' value ='sidebar' required @if($row['adv_type'] == 'sidebar') checked="checked" @endif > Sidebar </label>
					<label class='radio radio-inline'>
					<input type='radio' name='adv_type' value ='slider' required @if($row['adv_type'] == 'slider') checked="checked" @endif > Slider </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advertisement Category" class=" control-label col-md-4 text-left"> Advertisement Category </label>
									<div class="col-md-6">
									  <select name='ads_cat_id' rows='5' id='ads_cat_id' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<label for="Advertisement Duration" class=" control-label col-md-4 text-left"> Advertisement Duration ( in months ) </label>
									<div class="col-md-6">
									  <select name='ads_duration' class="form-control">
										@for($d=1;$d<=12;$d++)
											<option value="{{$d}}" <?php echo ($row['ads_duration']==$d) ? 'selected="selected"' : '';?>>{{$d}}</option>
										@endfor
									  </select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  
								  <div class="form-group  " >
									<label for="Advertisement Duration" class=" control-label col-md-4 text-left"> Membership Plans </label>
									<div class="col-md-6">
									  <select name='ads_plan' class="form-control">
										@if(!empty($membershipplans))
											@foreach($membershipplans as $plan)
												<option value="{{$plan->id}}" <?php echo ($row['ads_plan']==$plan->id) ? 'selected="selected"' : '';?>>{{$plan->package_name}}</option>
											@endforeach
										@endif
									  </select> 
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
					<button type="button" onclick="location.href='{{ URL::to('advertisements?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#user_id").jCombo("{{ URL::to('advertisements/comboselect?filter=tb_users:id:first_name|last_name') }}",
		{  selected_value : '{{ $row["user_id"] }}' });
		
		$("#ads_cat_id").jCombo("{{ URL::to('advertisements/comboselect?filter=tb_categories:id:category_name') }}",
		{  selected_value : '{{ $row["ads_cat_id"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop