@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Default Season</h3>
      </div>

	  <ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
		<li class="active"> Default Season </li>
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
	{!! Form::open(array('url'=>'sximo/config/season/', 'class'=>'form-horizontal row', 'files' => true)) !!}
	
	<div class="col-sm-6">
	
        <fieldset > <legend> Default Season Settings </legend>
            <div class="form-group">
                <label for="ipt" class=" control-label col-md-4"> Start Date </label>
                <div class="col-md-8">			
                	<input type="text" name="season_start_date" class="form-control input-sm datepic" value="{{$season_start_date->content}}" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="ipt" class=" control-label col-md-4"> End Date </label>
                <div class="col-md-8">			
                	<input type="text" name="season_end_date" class="form-control input-sm datepic" value="{{$season_end_date->content}}" />
                </div>    
            </div>        
        </fieldset>
    
	</div>
    
    <div class="col-md-12">
        <div class="form-group">
		    <label for="ipt" class=" control-label col-md-1">&nbsp;</label>
			<div class="col-md-3">
				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }} </button>
            </div> 
        </div> 
    </div>
 	
 
 {!! Form::close() !!}
 </div>
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
    $(document).ready(function(){
        $('.datepic').datepicker({
				numberOfMonths: 2,
				showButtonPanel: true,
				dateFormat: 'yy-mm-dd'
		});    
    });
</script>
@endsection