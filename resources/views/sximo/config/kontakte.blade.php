@extends('layouts.app')

@section('content')
<style>
 select[multiple] { height:110px !important; }
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Kontakte</h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
			<li class="active"> Kontakte </li>
		  </ul>
		
		  
    </div>

	<div class="page-content-wrapper">  
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	@include('sximo.config.tab')		
<div class="tab-content">
	  <div class="tab-pane active use-padding" id="info">	
	 {!! Form::open(array('url'=>'sximo/config/kontakte/', 'class'=>'form-horizontal row')) !!}
	
	<div class="col-sm-6">
	
		<fieldset> <legend> Kontakte Settings </legend>
		    
		 <div class="form-group">
			<label for="ipt" class="control-label col-md-4"> Head Office <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<textarea rows="6" name="head_office" class="form-control input-sm" required="required">{{$head_office->content}}</textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Gesamtvertrieb <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<textarea rows="6" name="gesamtvertrieb" class="form-control input-sm" required="required">{{$gesamtvertrieb->content}}</textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Presse <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<textarea rows="6" name="presse" class="form-control input-sm" required="required">{{$presse->content}}</textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Footer Text <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<textarea rows="6" name="footerText" class="form-control input-sm" required="required">{{$footer_text->content}}</textarea>
			</div>
		  </div>
		  <div class="form-group">
			<label for="About Text" class=" control-label col-md-4"> About Header Text</label>
			<div class="col-md-8">			
				<textarea rows="6" name="aboutHeaderText" class="form-control input-sm">{{$about_header_text->content}}</textarea>
			</div>
		  </div>
		  <div class="form-group">
			<label for="About Text" class=" control-label col-md-4"> About Text</label>
			<div class="col-md-8">			
				<textarea rows="6" name="aboutText" class="form-control input-sm">{{$about_text->content}}</textarea>
			</div>
		  </div>
  	</fieldset>
	</div> 
	
	<div class="col-sm-6">
	
		<fieldset> <legend> Services Settings </legend>
		    
		 <div class="form-group">
			<label for="ipt" class="control-label col-md-4"> Column One <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<select class="form-control" name="services_column1[]" multiple="multiple">
					@if(!empty($services_titles))
						@foreach($services_titles as $title)
							<option value="{{$title->id}}" {{(!empty($services_column1) && in_array($title->id ,$services_column1)) ? 'selected="selected"': '' }}>{{$title->title}}</option>
						@endforeach
					@endif
				</select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Column Two <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<select class="form-control" name="services_column2[]" multiple="multiple">
					@if(!empty($services_titles))
						@foreach($services_titles as $title)
							<option value="{{$title->id}}" {{(!empty($services_column2) && in_array($title->id ,$services_column2)) ? 'selected="selected"': '' }}>{{$title->title}}</option>
						@endforeach
					@endif
				</select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Column Three <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<select class="form-control" name="services_column3[]" multiple="multiple">
					@if(!empty($services_titles))
						@foreach($services_titles as $title)
							<option value="{{$title->id}}" {{(!empty($services_column3) && in_array($title->id ,$services_column3)) ? 'selected="selected"': '' }}>{{$title->title}}</option>
						@endforeach
					@endif
				</select>
			</div>
		  </div>
  	</fieldset>
	</div>
	
	<div class="col-md-12">
		<div class="form-group">
			<label for="ipt" class=" control-label col-md-6">&nbsp;</label>
			<div class="col-md-3">
				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }} </button>
			 </div> 
		  </div> 
	</div>
 	
 </div>
 {!! Form::close() !!}
</div>
</div>
</div>
</div>


@endsection