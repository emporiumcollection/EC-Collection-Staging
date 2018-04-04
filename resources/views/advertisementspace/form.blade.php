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
		<li><a href="{{ URL::to('advertisementspace?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'advertisementspace/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Advertisement Space</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('space_name', $row['space_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
									<div class="col-md-6">
									  {!! Form::text('space_title', $row['space_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPC Price" class=" control-label col-md-4 text-left"> CPC Price </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpc_price', $row['space_cpc_price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPC Target Clicks" class=" control-label col-md-4 text-left"> CPC Target Clicks </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpc_num_clicks', $row['space_cpc_num_clicks'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPM Price" class=" control-label col-md-4 text-left"> CPM Price </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpm_price', $row['space_cpm_price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPM Target View" class=" control-label col-md-4 text-left"> CPM Target View </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpm_num_view', $row['space_cpm_num_view'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPD Price" class=" control-label col-md-4 text-left"> CPD Price </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpd_price', $row['space_cpd_price'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="CPD Target Days" class=" control-label col-md-4 text-left"> CPD Target Days </label>
									<div class="col-md-6">
									  {!! Form::text('space_cpm_num_days', $row['space_cpm_num_days'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Position" class=" control-label col-md-4 text-left"> Position <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<?php $space_position = explode(',',$row['space_position']);
					$space_position_opt = array( 'landing' => 'Landing Page Sidebar' ,  'landing_slider' => 'landing Page Slider' ,  'grid_results' => 'Grid Page Results' ,  'grid_sidebar' => 'Grid Page Sidebar' ,  'grid_slider' => 'Grid Page Slider',  'detail_sidebar' => 'Detail Page Sidebar' ,  'detail_restaurant_page' => 'Restaurant Detail Page' ,  'detail_spa_page' => 'Spa Detail Page' ,  'detail_bar_page' => 'Bar Detail Page', 'restro_spa_bar_search_page' => 'Restaurant Bar Spa Search Page', 'social_media_page' => 'Social Media Page', 'youtube_channel_page' => 'Youtube channel Page', 'business_menu_page' => 'Business menu Page', 'wetransfer_upload_page' => 'Wetransfer upload files Page', 'wetransfer_download_page' => 'Wetransfer download files Page', 'email_template' => 'Email template', 'contracts_page' => 'Contracts Page' ); ?>
					<select name='space_position' rows='5' required  class='select2 '  > 
						<?php 
						foreach($space_position_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['space_position'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Template" class=" control-label col-md-4 text-left"> Template </label>
									<div class="col-md-6">
									  
					<?php $space_template = explode(',',$row['space_template']);
					$space_template_opt = array( 'slider' => 'Slider' ,  'sidebar' => 'Sidebar' ,  'grid' => 'Result grid' , ); ?>
					<select name='space_template' rows='5'   class='select2 '  > 
						<?php 
						foreach($space_template_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['space_template'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Max Ads" class=" control-label col-md-4 text-left"> Max Ads </label>
									<div class="col-md-6">
									  
					<?php $space_max_ads = explode(',',$row['space_max_ads']);
					$space_max_ads_opt = array( '1' => '1 Item' ,  '2' => '2 Items' ,  '3' => '3 Items' ,  '4' => '4 Items' ,  '5' => '5 Items' ,  '6' => '6 Items' ,  '7' => '7 Items' ,  '8' => '8 Items' ,  '9' => '9 Items' ,  '10' => '10 Items' ,  '11' => '11 Items' ,  '12' => '12 Items' ,  '13' => '13 Items' ,  '14' => '14 Items' ,  '15' => '15 Items' ,  '16' => '16 Items' ,  '17' => '17 Items' ,  '18' => '18 Items' ,  '19' => '19 Items' ,  '20' => '20 Items' ,  '21' => '21 Items' ,  '22' => '22 Items' ,  '23' => '23 Items' ,  '24' => '24 Items' , ); ?>
					<select name='space_max_ads' rows='5'   class='select2 '  > 
						<?php 
						foreach($space_max_ads_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['space_max_ads'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Specific Devices" class=" control-label col-md-4 text-left"> Specific Devices </label>
									<div class="col-md-6">
									  <?php $space_specific_devices = explode(",",$row['space_specific_devices']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='space_specific_devices[]' value ='1'   class='' 
					@if(in_array('1',$space_specific_devices))checked @endif 
					 /> Mobile </label> 
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='space_specific_devices[]' value ='2'   class='' 
					@if(in_array('2',$space_specific_devices))checked @endif 
					 /> Tablet </label> 
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='space_specific_devices[]' value ='3'   class='' 
					@if(in_array('3',$space_specific_devices))checked @endif 
					 /> Desktop </label>  
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category" class=" control-label col-md-4 text-left"> Category </label>
									<div class="col-md-6">
									  <select name='space_category' rows='5' id='space_category' class='select2 '   ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='space_status' value ='0' required @if($row['space_status'] == '0') checked="checked" @endif > Inactive </label>
					<label class='radio radio-inline'>
					<input type='radio' name='space_status' value ='1' required @if($row['space_status'] == '1') checked="checked" @endif > Active </label> 
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
					<button type="button" onclick="location.href='{{ URL::to('advertisementspace?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#space_category").jCombo("{{ URL::to('advertisementspace/comboselect?filter=tb_categories:id:category_name') }}",
		{  selected_value : '{{ $row["space_category"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop