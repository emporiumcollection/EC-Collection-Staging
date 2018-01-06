@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Designer</h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
			<li class="active"> Designer </li>
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
	 {!! Form::open(array('url'=>'sximo/config/designer/', 'class'=>'form-horizontal row')) !!}
	
	<div class="col-sm-12">
	
		<fieldset > <legend> Designer Settings <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></legend>
		  <div class="form-group">
			 		
		  </div>  
		
		 <div class="form-group">
		    <label for="ipt" class=" control-label col-md-2"> Designer Title </label>
			<div class="col-md-6">
				<input name="designer_title" type="text" id="designer_title" class="form-control input-sm ldutch" required  value="{{$designer_title->content}}" /> 

				<input name="designer_title_eng" type="text" id="designer_title_eng" class="form-control input-sm leng"  value="{{$designer_title_eng->content}}" />
			 </div> 
			 <div class="col-md-4">
			 </div>
		  </div> 
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-2"> Designer Description </label>
			<div class="col-md-6 ldutch">			
				<textarea rows="6" name="designer_desc" class="form-control input-sm">{{$designer_desc->content}}</textarea>
			</div>
			
			<div class="col-md-6 leng">			
				<textarea rows="6" name="designer_desc_eng" class="form-control input-sm">{{$designer_desc_eng->content}}</textarea>
			</div>
			 <div class="col-md-4">
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

<script>
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
@endsection