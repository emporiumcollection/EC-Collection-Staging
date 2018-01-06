@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Container</h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
			<li class="active"> Container </li>
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
	 {!! Form::open(array('url'=>'sximo/config/container/', 'class'=>'form-horizontal row')) !!}
	
	<div class="col-sm-6">
	
		<fieldset> <legend> Container Settings </legend>
		    
		 <div class="form-group">
			<label for="ipt" class="control-label col-md-4"> Choose Front-end Design <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<select class="form-control" name="front_design">
					<option value="grid" <?php if(!empty($front_design) && $front_design->content=='grid') { echo 'selected="selected"'; } ?>>Grid View</option>
					<option value="masonry" <?php if(!empty($front_design) && $front_design->content=='masonry') { echo 'selected="selected"'; } ?>>Masonry View</option>
				</select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class="control-label col-md-4"> Produktinformation <span class="asterix"> * </span></label>
			<div class="col-md-8">			
				<textarea class="form-control" name="produktinformation" cols="5" rows="10">@if(!empty($produktinformation)){{$produktinformation->content }}@endif</textarea>
			</div>
		  </div>
		  
  	</fieldset>
		<br>
		<div class="form-group">
		    <label for="ipt" class=" control-label col-md-1">&nbsp;</label>
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