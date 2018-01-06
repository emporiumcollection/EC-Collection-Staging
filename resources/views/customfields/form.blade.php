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
						<fieldset><legend> Custom Fields</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Type" class=" control-label col-md-4 text-left"> Type <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
									<?php $type = explode(',',$row['type']);
									$type_opt = array( 'text' => 'Text' ,  'textarea' => 'Textarea' ,  'textareaeditor' => 'Textarea with Editor' ,  'selectlist' => 'Select List' ,  'checkbox' => 'Checkbox' ,  'tags' => 'Tags' ,  'file' => 'File' ,  'date' => 'Date' ,  'radiobutton' => 'Radio Button' ,  'category' => 'Category' ,  'number' => 'Number' ,  'url' => 'URL' , 'link' => 'Web Link', 'tabs' => 'Tabs', 'group' => 'Group'); ?>
									<select name='type' rows='5' required  class='select2' onchange="show_parameters(this.value);" id="fieldtype" > 
										<?php 
										foreach($type_opt as $key=>$val)
										{
											echo "<option  value ='$key' ".($row['type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
										}						
										?></select> 
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
								 					
								  <div class="form-group  " >
									<label for="Field Elements" class=" control-label col-md-4 text-left"> Field Elements </label>
									<div class="col-md-8">
									  <textarea name='option_values' rows='10' id='option_values' class='form-control '  
				           >{{ $row['option_values'] }}</textarea> 
									<small>( Comma(,) separated values )</small>
									 </div> 
									 
								  </div> 
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
				<div id="parameters">
				{{--*/ $params = json_decode($row['parameters']); /*--}}
					<fieldset>
						<legend>Parameters</legend>
						<div class="paramtext param">
							<div class="form-group  " >
								<label for="text_max_summary" class=" control-label col-md-5 text-left"> Max. characters in Summary view </label>
								<div class="col-md-7">
								  {!! Form::text('text[max_summary]', (!empty(isset($params->text))) ? $params->text->max_summary : '0',array('class'=>'form-control all_param_inputs', 'placeholder'=>'0',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group  " >
								<label for="text_max_details" class=" control-label col-md-5 text-left"> Max. characters in Details view </label>
								<div class="col-md-7">
								  {!! Form::text('text[max_details]', (!empty(isset($params->text))) ? $params->text->max_details : '0',array('class'=>'form-control all_param_inputs', 'placeholder'=>'0',   )) !!} 
								 </div> 
							</div> 
						</div>
						
						<div class="paramtextarea param">
							<div class="form-group  " >
								<label for="textarea_max_summary" class=" control-label col-md-5 text-left"> Max. characters in Summary view </label>
								<div class="col-md-7">
								  {!! Form::text('textarea[max_summary]', (!empty(isset($params->textarea))) ? $params->textarea->max_summary : '0',array('class'=>'form-control all_param_inputs', 'placeholder'=>'0',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group  " >
								<label for="textarea_max_details" class=" control-label col-md-5 text-left"> Max. characters in Details view </label>
								<div class="col-md-7">
								  {!! Form::text('textarea[max_details]', (!empty(isset($params->textarea))) ? $params->textarea->max_details : '0',array('class'=>'form-control all_param_inputs', 'placeholder'=>'0',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group  " >
								<label for="textarea_columns" class=" control-label col-md-5 text-left"> Columns </label>
								<div class="col-md-7">
								 <?php $typearea_column = array(5,10,15,20,25,30,35,40,45,50,55,60,65,70,80,90,100,120); ?>
									<select name='textarea[columns]' rows='5' class='select2 all_param_inputs'  > 
										<?php 
										foreach($typearea_column as $columnval)
										{
											$sel_col = '';
											$sel_col = ((!empty(isset($params->textarea))) && $params->textarea->columns==$columnval) ? "selected='selected'" : "";
											echo "<option  value ='$columnval' $sel_col>".$columnval."</option>"; 						
										}						
										?>
									</select> 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="textarea_newline" class=" control-label col-md-5 text-left"> Preserve newline</label>
								<div class="col-md-7">
									<?php $typearea_newline = array('Details view only','Summary view only','Detail and summary view'); ?>
									<select name='textarea[newline]' rows='5' class='select2 all_param_inputs'  > 
										<?php 
										foreach($typearea_newline as $newlineval)
										{
											$sel_newline = '';
											$sel_newline = ((!empty(isset($params->textarea))) && $params->textarea->newline==$newlineval) ? "selected='selected'" : "";
											echo "<option  value ='$newlineval' $sel_newline>".$newlineval."</option>"; 						
										}						
										?>
									</select> 
								 </div> 
							</div>
						</div>
						
						<div class="paramtextareaeditor param">
							<div class="form-group  " >
								<label for="textarea_editor_width" class=" control-label col-md-5 text-left"> Width</label>
								<div class="col-md-7">
								  {!! Form::text('textareaeditor[width]', (!empty(isset($params->textareaeditor))) ? $params->textareaeditor->width : '100%',array('class'=>'form-control all_param_inputs', 'placeholder'=>'100%',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group  " >
								<label for="textarea_editor_height" class=" control-label col-md-5 text-left"> Height </label>
								<div class="col-md-7">
								  {!! Form::text('textareaeditor[height]', (!empty(isset($params->textareaeditor))) ? $params->textareaeditor->height : '200px',array('class'=>'form-control all_param_inputs', 'placeholder'=>'200px',   )) !!} 
								 </div> 
							</div> 
						</div>
						
						<div class="paramtags param">
							<div class="form-group" >
								<label for="tags_max_char" class=" control-label col-md-5 text-left"> Max. characters</label>
								<div class="col-md-7">
								  {!! Form::text('tags[max_char]', (!empty(isset($params->tags))) ? $params->tags->max_char : '80',array('class'=>'form-control all_param_inputs', 'placeholder'=>'80',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group  " >
								<label for="tags_sort_by" class=" control-label col-md-5 text-left"> Sort by </label>
								<div class="col-md-7">
									<?php $tag_sort_by = array('Alphabetically (0-9‚ A-Z)','Frequency (Most used first)'); ?>
									<select name='tags[sort_by]' rows='5' class='select2 all_param_inputs'  > 
										<?php 
										foreach($tag_sort_by as $sort_by)
										{
											$sel_tagsort = '';
											$sel_tagsort = ((!empty(isset($params->tags))) && $params->tags->sort_by==$sort_by) ? "selected='selected'" : "";
											echo "<option  value ='$sort_by' $sel_tagsort>".$sort_by."</option>"; 						
										}						
										?>
									</select>
								</div> 
							</div> 
							<div class="form-group  " >
								<label for="Search Operator" class=" control-label col-md-5 text-left"> Search Operator</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='tags[search_operator]' class="all_param_inputs" value ='All' {{((!empty(isset($params->tags))) && $params->tags->search_operator=='All') ? "checked='checked'" : "checked='checked'"}}> Match All </label>
									<label class='radio radio-inline'>
									<input type='radio' name='tags[search_operator]' class="all_param_inputs" value ='Any' {{((!empty(isset($params->tags))) && $params->tags->search_operator=='Any') ? "checked='checked'" : ""}}> Match Any </label> 
								</div>
							</div> 
						</div>
						
						<div class="paramfile param">
							<div class="form-group" >
								<label for="file_extensions" class=" control-label col-md-5 text-left"> Acceptable file extensions</label>
								<div class="col-md-7">
									<textarea name='file[extensions]' rows='2' class='form-control all_param_inputs'>{{ (!empty(isset($params->file))) ? $params->file->extensions : 'gif|png|jpg|jpeg|pdf|zip' }} </textarea>
								 </div> 
							</div> 
							<div class="form-group" >
								<label for="file_max_size" class=" control-label col-md-5 text-left"> Maximum Size (in bytes) </label>
								<div class="col-md-7">
								  {!! Form::text('file[max_size]', (!empty(isset($params->file))) ? $params->file->extensions : '10485760',array('class'=>'form-control all_param_inputs', 'placeholder'=>'10485760',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group" >
								<label for="file_text" class=" control-label col-md-5 text-left"> Text </label>
								<div class="col-md-7">
								  {!! Form::text('file[text]', (!empty(isset($params->file))) ? $params->file->text : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="Show Filename" class=" control-label col-md-5 text-left"> Show Filename </label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='file[show_name]' class="all_param_inputs" value ='No' {{((!empty(isset($params->file))) && $params->file->show_name=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='file[show_name]' class="all_param_inputs" value ='Yes' {{((!empty(isset($params->file))) && $params->file->show_name=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div> 
							<div class="form-group" >
								<label for="file_image" class=" control-label col-md-5 text-left"> Image </label>
								<div class="col-md-3">
									<input type="file" name="file_image" class="typefile control-label all_param_inputs" /> 
									<input type="hidden" name="file_image_hidden" value="{{(!empty(isset($params->file))) ? $params->file->image : ''}}" />
									<div >
										{!! SiteHelpers::showUploadedFile((!empty(isset($params->file))) ? $params->file->image : '','/uploads/customfileds_imgs/') !!}
									</div>
								</div>
								<div class="col-md-4 MgnTop5">
									<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(1);">Choose from container</a>
									<input type="hidden" name="container_file_image" id="box1" value="" class="all_param_inputs">
									<span id="boxspan1"></span>
								</div>
							</div>
						</div>
						
						<div class="paramdate param">
							<div class="form-group" >
								<label for="date start year" class=" control-label col-md-5 text-left"> Start year </label>
								<div class="col-md-7">
								  {!! Form::text('date[start_year]', (!empty(isset($params->date))) ? $params->date->start_year : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div> 
							<div class="form-group" >
								<label for="date end year" class=" control-label col-md-5 text-left"> End year </label>
								<div class="col-md-7">
								  {!! Form::text('date[end_year]', (!empty(isset($params->date))) ? $params->date->end_year : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="date_format" class=" control-label col-md-5 text-left"> Date Format </label>
								<div class="col-md-7">
									<?php $date_formats = array('%Y-%m-%d'=>'2016-06-01','%e.%m.%Y'=>'1.06.2016','%e %B %Y'=>'1 June 2016','%B %e, %Y'=>'June 1, 2016','%e/%m/%Y'=>'1/06/2016','%m/%e/%Y'=>'06/1/2016'); ?>
									<select name='date[format]' rows='5' class='select2 all_param_inputs'  > 
										<?php 
										foreach($date_formats as $key=>$format)
										{
											$sel_dateformat = '';
											$sel_dateformat = ((!empty(isset($params->date))) && $params->date->format==$key) ? "selected='selected'" : "";
											echo "<option  value ='$key' $sel_dateformat>".$format."</option>"; 						
										}						
										?>
									</select>
								</div> 
							</div>  
						</div>
						
						<div class="paramcategory param">
							<div class="form-group  " >
								<label for="search_category" class=" control-label col-md-5 text-left"> Search Category </label>
								<div class="col-md-7">
									<select name='category[search]' rows='5' class='select2 all_param_inputs'  > 
										<option value=""> --Select Folder-- </option>
										@foreach($seloptions as $opt)
										  <option value="<?php echo $opt["id"]; ?>" <?php echo ((!empty(isset($params->category))) && $params->category->search==$opt["id"]) ? "selected='selected'" : '' ?>><?php echo $opt["name"]; ?></option>
										@endforeach
									</select>
								</div> 
							</div> 
							<div class="form-group  " >
								<label for="Show Primary Category" class=" control-label col-md-5 text-left"> Show Primary Category </label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_primary]' class="all_param_inputs" value ='No' {{((!empty(isset($params->category))) && $params->category->show_primary=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_primary]' class="all_param_inputs" value ='Yes' {{((!empty(isset($params->category))) && $params->category->show_primary=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group  " >
								<label for="Show Secondary Categories" class=" control-label col-md-5 text-left"> Show Secondary Categories </label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_secondary]' class="all_param_inputs" value ='No' {{((!empty(isset($params->category))) && $params->category->show_secondary=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_secondary]' class="all_param_inputs" value ='Yes' {{((!empty(isset($params->category))) && $params->category->show_secondary=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group  " >
								<label for="Show Breadcrumbs" class=" control-label col-md-5 text-left"> Show Breadcrumbs </label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_breadcrumb]' class="all_param_inputs" value ='No' {{((!empty(isset($params->category))) && $params->category->show_breadcrumb=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='category[show_breadcrumb]' class="all_param_inputs" value ='Yes' {{((!empty(isset($params->category))) && $params->category->show_breadcrumb=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
						</div>
						
						<div class="paramnumber param">
							<div class="form-group  " >
								<label for="Decimals" class=" control-label col-md-5 text-left"> Decimals </label>
								<div class="col-md-7">
									<?php $number_decimal = array(0,1,2,3,4,5); ?>
									<select name='number[decimal]' rows='5' class='select2 all_param_inputs'  > 
										<?php 
										foreach($number_decimal as $decimal)
										{
											$sel_num_dec = '';
											$sel_num_dec = ((!empty(isset($params->number))) && $params->number->decimal==$decimal) ? "selected='selected'" : "";
											echo "<option  value ='$decimal' $sel_num_dec>".$decimal."</option>"; 						
										}						
										?>
									</select>
								</div> 
							</div> 
							<div class="form-group" >
								<label for="Decimal Point" class=" control-label col-md-5 text-left"> Decimal Point </label>
								<div class="col-md-7">
								  {!! Form::text('number[decimal_point]', (!empty(isset($params->number))) ? $params->number->decimal_point : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="Use Thousand Separator" class=" control-label col-md-5 text-left"> Use Thousand Separator </label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='number[use_thousand_separator]' class="all_param_inputs" value ='No' {{((!empty(isset($params->number))) && $params->number->use_thousand_separator=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='number[use_thousand_separator]' class="all_param_inputs" value ='Yes' {{((!empty(isset($params->number))) && $params->number->use_thousand_separator=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group" >
								<label for="Thousand Separator" class=" control-label col-md-5 text-left"> Thousand Separator </label>
								<div class="col-md-7">
								  {!! Form::text('number[thousand_separator]', (!empty(isset($params->number))) ? $params->number->thousand_separator : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
						</div>
						
						<div class="paramurl param">
							<div class="form-group" >
								<label for="URL Format" class=" control-label col-md-5 text-left"> URL Format </label>
								<div class="col-md-7">
								  {!! Form::text('url[format]', (!empty(isset($params->url))) ? $params->url->format : 'http://www.twitter.com/{username}',array('class'=>'form-control all_param_inputs', 'placeholder'=>'http://www.twitter.com/{username}',   )) !!} 
								 </div> 
							</div>
							<div class="form-group" >
								<label for="Display Format" class=" control-label col-md-5 text-left"> Display Format </label>
								<div class="col-md-7">
								  {!! Form::text('url[display_format]', (!empty(isset($params->url))) ? $params->url->format : '@{username}',array('class'=>'form-control all_param_inputs', 'placeholder'=>'@{username}',   )) !!} 
								 </div> 
							</div>
							<div class="form-group" >
								<label for="Link Title" class=" control-label col-md-5 text-left"> Link Title </label>
								<div class="col-md-7">
								  {!! Form::text('url[link_title]', (!empty(isset($params->url))) ? $params->url->link_title : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group" >
								<label for="Link Image" class=" control-label col-md-5 text-left"> Link Image </label>
								<div class="col-md-3">
									<input type="file" name="url_link_image" class="typefile control-label all_param_inputs" />
									<input type="hidden" name="url_link_image_hidden" value="{{(!empty(isset($params->url))) ? $params->url->link_image : ''}}" />
									<div >
										{!! SiteHelpers::showUploadedFile((!empty(isset($params->url))) ? $params->url->link_image : '','/uploads/customfileds_imgs/') !!}
									</div>
								</div> 
								<div class="col-md-4 MgnTop5">
									<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(2);">Choose from container</a>
									<input type="hidden" name="container_url_link_image" class="all_param_inputs" id="box2" value="">
									<span id="boxspan2"></span>
								</div>
							</div>
							<div class="form-group" >
								<label for="Max. number of characters" class=" control-label col-md-5 text-left"> Max. number of characters </label>
								<div class="col-md-7">
								  {!! Form::text('url[max_characters]', (!empty(isset($params->url))) ? $params->url->max_characters : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'15',   )) !!} 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="Open New Window" class=" control-label col-md-5 text-left"> Open New Window</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='url[new_window]' value ='No' class="all_param_inputs" {{((!empty(isset($params->url))) && $params->url->new_window=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='url[new_window]' value ='Yes' class="all_param_inputs" {{((!empty(isset($params->url))) && $params->url->new_window=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group  " >
								<label for="Enable nofollow attribute" class=" control-label col-md-5 text-left"> Enable nofollow attribute</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='url[nofollow_attribute]' value ='No' class="all_param_inputs" {{((!empty(isset($params->url))) && $params->url->nofollow_attribute=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='url[nofollow_attribute]' value ='Yes' class="all_param_inputs" {{((!empty(isset($params->url))) && $params->url->nofollow_attribute=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
						</div>
						
						<div class="paramlink param">
							<div class="form-group  " >
								<label for="Open New Window" class=" control-label col-md-5 text-left"> Open New Window</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='link[new_window]' value ='No' class="all_param_inputs" {{((!empty(isset($params->link))) && $params->link->new_window=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='link[new_window]' value ='Yes' class="all_param_inputs" {{((!empty(isset($params->link))) && $params->link->new_window=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group" >
								<label for="Link text" class=" control-label col-md-5 text-left"> Link Text </label>
								<div class="col-md-7">
								  {!! Form::text('link[link_text]', (!empty(isset($params->link))) ? $params->link->link_text : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group" >
								<label for="Link Title" class=" control-label col-md-5 text-left"> Link Title </label>
								<div class="col-md-7">
								  {!! Form::text('link[link_title]', (!empty(isset($params->link))) ? $params->link->link_title : '',array('class'=>'form-control all_param_inputs', 'placeholder'=>'',   )) !!} 
								 </div> 
							</div>
							<div class="form-group" >
								<label for="Link Image" class=" control-label col-md-5 text-left"> Link Image </label>
								<div class="col-md-3">
									<input type="file" name="link_link_image" class="typefile control-label all_param_inputs" />
									<input type="hidden" name="link_link_image_hidden" value="{{(!empty(isset($params->link))) ? $params->link->link_image : ''}}" />
									<div >
										{!! SiteHelpers::showUploadedFile((!empty(isset($params->link))) ? $params->link->link_image : '','/uploads/customfileds_imgs/') !!}
									</div>
								 </div>
								<div class="col-md-4 MgnTop5">
									<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(3);">Choose from container</a>
									<input type="hidden" name="container_link_link_image" id="box3" value="" class="all_param_inputs">
									<span id="boxspan3"></span>
								</div>
							</div>
							<div class="form-group" >
								<label for="Max. URL Length" class=" control-label col-md-5 text-left"> Max. URL Length</label>
								<div class="col-md-7">
								  {!! Form::text('link[max_length]', (!empty(isset($params->link))) ? $params->link->max_length : '60',array('class'=>'form-control all_param_inputs', 'placeholder'=>'60',   )) !!} 
								 </div> 
							</div>
							<div class="form-group  " >
								<label for="Use internal redirect" class=" control-label col-md-5 text-left">Use internal redirect</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='link[use_internal]' value ='No' class="all_param_inputs" {{((!empty(isset($params->link))) && isset($params->link->use_internal) && $params->link->use_internal=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='link[use_internal]' value ='Yes' class="all_param_inputs" {{((!empty(isset($params->link))) && isset($params->link->use_internal) &&  $params->link->use_internal=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
							<div class="form-group  " >
								<label for="Clipped symbol" class=" control-label col-md-5 text-left">Clipped symbol</label>
								<div class="col-md-7">
									 {!! Form::text('link[clipped_symbol]', (!empty(isset($params->link))) ? $params->link->clipped_symbol : '...',array('class'=>'form-control all_param_inputs', 'placeholder'=>'...',   )) !!} 
								</div>
							</div>
							<div class="form-group  " >
								<label for="Enable nofollow attribute" class=" control-label col-md-5 text-left"> Enable nofollow attribute</label>
								<div class="col-md-7">
									<label class='radio radio-inline'>
									<input type='radio' name='link[nofollow_attribute]' value ='No' class="all_param_inputs" {{((!empty(isset($params->link))) && isset($params->link->use_internal) && $params->link->nofollow_attribute=='No') ? "checked='checked'" : "checked='checked'"}}> No </label>
									<label class='radio radio-inline'>
									<input type='radio' name='link[nofollow_attribute]' value ='Yes' class="all_param_inputs" {{((!empty(isset($params->link))) && isset($params->link->use_internal) && $params->link->nofollow_attribute=='Yes') ? "checked='checked'" : ""}}> Yes </label> 
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		
			<div style="clear:both"></div>	
				
					
		  <div class="form-group">
			<label class="col-sm-4 text-right">&nbsp;</label>
			<div class="col-sm-8">	
			<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
			<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
			<button type="button" onclick="location.href='{{ URL::to('customfields?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
			@if($row['type']=="group")
				<button type="button" onclick="location.href='{{ URL::to('customfields_group/'.$row['id']) }}' " class="btn btn-info btn-sm "><i class="fa  fa-check-circle "></i>  {{ Lang::get('core.sb_edit_group') }} </button>
			@endif
			@if($row['type']=="tabs")
				<button type="button" onclick="location.href='{{ URL::to('customfields_edit_tab_content/'.$row['id'].'/1') }}' " class="btn btn-info btn-sm "><i class="fa  fa-check-circle "></i>  {{ Lang::get('core.sb_edit_tab') }} </button>
			@endif
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
		
		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
		var type = $('#fieldtype').val();
		show_parameters(type);
	});
	
	function show_parameters(type)
	{
		if(type!="")
		{
			if(type!="checkbox" && type!="selectlist" && type!="radiobutton")
			{
				$('#parameters').show();
				$('#parameters .param').hide();
				$('#option_values').attr('disabled','disabled');
				$('#parameters .all_param_inputs').attr('disabled','disabled');
				$('#parameters .param'+type).show();
				$('#parameters .param'+type+' .all_param_inputs').removeAttr('disabled');
			}
			else
			{
				$('#parameters').hide();
				$('#parameters .param').hide();
				$('#option_values').removeAttr('disabled');
				$('#parameters .all_param_inputs').attr('disabled','disabled');
			}
		}
		else
		{
			$('#parameters').hide();
			$('#parameters .param').hide();
			$('#option_values').removeAttr('disabled');
			$('#parameters .all_param_inputs').attr('disabled','disabled');
		}
	}
	
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