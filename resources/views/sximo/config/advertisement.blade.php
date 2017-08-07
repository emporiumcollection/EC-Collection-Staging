@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Advertisement</h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
			<li class="active"> Advertisement </li>
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
	 {!! Form::open(array('url'=>'sximo/config/advertisement/', 'class'=>'form-horizontal row')) !!}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> Advertisement Settings </legend>
		  <div class="form-group">
			 		
		  </div>  
		
		 <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.sidebar_ads_validity') }} </label>
			<div class="col-md-8">
				<input name="sidebar_ads_days" type="text" id="sidebar_ads_days" class="form-control input-sm" required  value="{{(!empty($sidebar_ads_days))?$sidebar_ads_days->content:''}}" />  
			 </div> 
		  </div> 
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.sidebar_ads_price') }} </label>
			<div class="col-md-8">
				<input name="sidebar_ads_price" type="text" id="sidebar_ads_price" class="form-control input-sm" required  value="{{(!empty($sidebar_ads_price))?$sidebar_ads_price->content:''}}" />  
			 </div> 
		  </div>
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.slider_ads_validity') }} </label>
			<div class="col-md-8">
				<input name="slider_ads_days" type="text" id="slider_ads_days" class="form-control input-sm" required  value="{{(!empty($slider_ads_days))?$slider_ads_days->content:''}}" />  
			 </div> 
		  </div> 
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.slider_ads_price') }} </label>
			<div class="col-md-8">
				<input name="slider_ads_price" type="text" id="slider_ads_price" class="form-control input-sm" required  value="{{(!empty($slider_ads_price))?$slider_ads_price->content:''}}" />  
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