@extends('layouts.app')

@section('content')
<style>
	.param { display:none; }
	.typefile { width:100%; }
	.MgnTop5 { margin-top:5px; }
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('customfields?return='.$return) }}">{{ $pageTitle }}</a></li>
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

		 {!! Form::open(array('url'=>'customfields/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
				<div class="col-md-6">
						<fieldset>
						<legend> Custom Fields</legend>
							<input type="hidden" name="type" value="{{$addfieldType}}" />		
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  
								  <div class="form-group  " >
									<label for="Caption" class=" control-label col-md-4 text-left"> Caption <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('caption', $row['caption'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
								  <div class="form-group  " >
									<label for="Hide Caption" class=" control-label col-md-4 text-left"> Hide Caption </label>
									<div class="col-md-6">
									  
										<label class='radio radio-inline'>
										<input type='radio' name='hide_caption' value ='0'  @if($row['hide_caption'] == '0') checked="checked" @endif > No </label>
										<label class='radio radio-inline'>
										<input type='radio' name='hide_caption' value ='1'  @if($row['hide_caption'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								 
								@if($addfieldType=="tabs")
								  <div class="form-group  " >
									<label for="tab_number" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tab_number') }} <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  {!! Form::text('tab_nums', $row['tab_nums'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true',  )) !!} 
									 </div> 
									 <div class="col-md-2">
										
									 </div>
								  </div> 								  
								 @endif
								  
								  <div class="form-group  " >
									<div class="col-md-12">Prefix and Suffix text to display during field modification:</div>
								  </div>
								  <div class="form-group  " >
									<label for="Prefix" class=" control-label col-md-4 text-left"> Prefix </label>
									<div class="col-md-6">
									  {!! Form::text('prefix_modification', $row['prefix_modification'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Suffix" class=" control-label col-md-4 text-left"> Suffix </label>
									<div class="col-md-6">
									  {!! Form::text('suffix_modification', $row['suffix_modification'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
								  <div class="form-group  " >
									<div class="col-md-12">Prefix and Suffix text during display:</div>
								  </div>
								  <div class="form-group  " >
									<label for="Prefix" class=" control-label col-md-4 text-left"> Prefix </label>
									<div class="col-md-6">
									  {!! Form::text('prefix_display', $row['prefix_display'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Suffix" class=" control-label col-md-4 text-left"> Suffix </label>
									<div class="col-md-6">
									  {!! Form::text('suffix_display', $row['suffix_display'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Size" class=" control-label col-md-4 text-left"> Size </label>
									<div class="col-md-6">
									  {!! Form::text('option_size', $row['option_size'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Placeholder Text" class=" control-label col-md-4 text-left"> Placeholder Text </label>
									<div class="col-md-6">
									  {!! Form::text('placeholder_text', $row['placeholder_text'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Default Value" class=" control-label col-md-4 text-left"> Default Value </label>
									<div class="col-md-6">
									  {!! Form::text('default_value', $row['default_value'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="View Access Level" class=" control-label col-md-4 text-left"> View Access Level <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<?php $view_access_level = explode(',',$row['view_access_level']);
									$view_access_level_opt = array( 'public' => 'Public' ,  'registered' => 'Registered' , ); ?>
									<select name='view_access_level' rows='5' required  class='select2 '  > 
										<?php 
										foreach($view_access_level_opt as $key=>$val)
										{
											echo "<option  value ='$key' ".($row['view_access_level'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
										}						
										?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Edit Access Level" class=" control-label col-md-4 text-left"> Edit Access Level <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<?php $edit_access_level = explode(',',$row['edit_access_level']);
									$edit_access_level_opt = array( 'public' => 'Public' ,  'registered' => 'Registered' , ); ?>
									<select name='edit_access_level' rows='5' required  class='select2 '  > 
										<?php 
										foreach($edit_access_level_opt as $key=>$val)
										{
											echo "<option  value ='$key' ".($row['edit_access_level'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
										}						
										?></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Published" class=" control-label col-md-4 text-left"> Published <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='published' value ='0' required @if($row['published'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='published' value ='1' required @if($row['published'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Shown in Detail View" class=" control-label col-md-4 text-left"> Shown in Detail View <span class="asterix"> * </span></label>
									<div class="col-md-6">
													  
									<label class='radio radio-inline'>
									<input type='radio' name='show_detail_view' value ='0' required @if($row['show_detail_view'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='show_detail_view' value ='1' required @if($row['show_detail_view'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Shown in Summary View" class=" control-label col-md-4 text-left"> Shown in Summary View <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='show_summary_view' value ='0' required @if($row['show_summary_view'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='show_summary_view' value ='1' required @if($row['show_summary_view'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Taggable" class=" control-label col-md-4 text-left"> Taggable <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='taggable' value ='0' required @if($row['taggable'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='taggable' value ='1' required @if($row['taggable'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Simple Searchable" class=" control-label col-md-4 text-left"> Simple Searchable <span class="asterix"> * </span></label>
									<div class="col-md-6">
													  
									<label class='radio radio-inline'>
									<input type='radio' name='simple_search' value ='0' required @if($row['simple_search'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='simple_search' value ='1' required @if($row['simple_search'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Advanced Searchable" class=" control-label col-md-4 text-left"> Advanced Searchable <span class="asterix"> * </span></label>
									<div class="col-md-6">
													  
									<label class='radio radio-inline'>
									<input type='radio' name='advance_search' value ='0' required @if($row['advance_search'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='advance_search' value ='1' required @if($row['advance_search'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Filter Searchable" class=" control-label col-md-4 text-left"> Filter Searchable <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='filter_search' value ='0' required @if($row['filter_search'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='filter_search' value ='1' required @if($row['filter_search'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Required Field" class=" control-label col-md-4 text-left"> Required Field <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<label class='radio radio-inline'>
									<input type='radio' name='required' value ='0' required @if($row['required'] == '0') checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='required' value ='1' required @if($row['required'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Hidden Field" class=" control-label col-md-4 text-left"> Hidden Field <span class="asterix"> * </span></label>
									<div class="col-md-6">
									<label class='radio radio-inline'>
									<input type='radio' name='hidden' value ='0' required @if((!empty($rowhdn)) && ($rowhdn->hidden == '0')) checked="checked" @endif > No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='hidden' value ='1' required @if((!empty($rowhdn)) && ($rowhdn->hidden == '1')) checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
							</fieldset>
			</div>
			
			
			<div class="col-md-6">
				
			</div>
		
			<div style="clear:both"></div>	
				
					
		  <div class="form-group">
			<label class="col-sm-4 text-right">&nbsp;</label>
			<div class="col-sm-8">	
			<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
			<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
			<button type="button" onclick="location.href='{{ URL::to('customfields?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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