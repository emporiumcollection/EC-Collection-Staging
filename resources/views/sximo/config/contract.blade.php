@extends('layouts.app')

@section('content')
<style>
.leng { display:none; }
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Contract</h3>
      </div>

	  <ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
		<li class="active"> Contract </li>
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
	 {!! Form::open(array('url'=>'sximo/config/contract/', 'class'=>'form-horizontal row', 'files' => true)) !!}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> Contract Settings </legend>
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract First Name </label>
			<div class="col-md-8">			
				<input type="text" name="contract_first_name" class="form-control input-sm" value="{{$contract_first_name->content}}" />
			</div>
            
			<div class="col-md-8">
			</div>
		  </div>
          
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract Last Name </label>
			<div class="col-md-8">			
				<input type="text" name="contract_last_name" class="form-control input-sm" value="{{$contract_last_name->content}}" />
			</div>
            
			<div class="col-md-4">
			</div>
		  </div>
          
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Logo </label>
			<div class="col-md-8">				
                <input type="file" name="contract_logo">
                <p> <i>Please use image dimension 155px * 30px </i> </p>
				<div style="padding:5px; border:solid 1px #ddd; background:#f5f5f5; width:auto;">
                    @if($contract_logo->content!='')
    				 	@if(file_exists(public_path().'/sximo/images/'.$contract_logo->content))
    				 	<img src="{{ asset('sximo/images/'.$contract_logo->content)}}" alt="{{ CNF_APPNAME }}" style="width: 155px;" />
    				 	@else
    					<img src="{{ asset('sximo/images/logo.png')}}" alt="{{ CNF_APPNAME }}" />
    					@endif
                    @else
    					<img src="{{ asset('sximo/images/logo.png')}}" alt="{{ CNF_APPNAME }}" />
				    @endif	
				</div>	
			 </div> 
			 <div class="col-md-4">
			 </div>
		  </div> 
		  
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract Company Name </label>
			<div class="col-md-8 ldutch">			
				<input type="text" name="contract_company" class="form-control input-sm" value="{{$contract_company->content}}" />
			</div>
			
			<div class="col-md-8 leng">			
				<input type="text" name="contract_company_eng" class="form-control input-sm" value="{{$contract_company_eng->content}}" />
			</div>
			<div class="col-md-4">
			</div>
		  </div>
          
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract Title1 </label>
			<div class="col-md-8 ldutch">			
				<input type="text" name="contract_title1" class="form-control input-sm" value="{{$contract_title1->content}}" />
			</div>
			
			<div class="col-md-8 leng">			
				<input type="text" name="contract_title1_eng" class="form-control input-sm" value="{{$contract_title1_eng->content}}" />
			</div>
			 <div class="col-md-4">
			 </div>
		  </div>
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract Title2 </label>
			<div class="col-md-8 ldutch">			
				<input type="text" name="contract_title2" class="form-control input-sm" value="{{$contract_title2->content}}" />
			</div>
			
			<div class="col-md-8 leng">			
				<input type="text" name="contract_title2_eng" class="form-control input-sm" value="{{$contract_title2_eng->content}}" />
			</div>
			 <div class="col-md-4">
			 </div>
		  </div>
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract Title3 </label>
			<div class="col-md-8 ldutch">			
				<input type="text" name="contract_title3" class="form-control input-sm" value="{{$contract_title3->content}}" />
			</div>
			
			<div class="col-md-8 leng">			
				<input type="text" name="contract_title3_eng" class="form-control input-sm" value="{{$contract_title3_eng->content}}" />
			</div>
			 <div class="col-md-4">
			 </div>
		  </div>
          
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Contract paragraph </label>
			<div class="col-md-8 ldutch">			
				<textarea rows="6" name="contract_paragraph" class="form-control input-sm"> {{$contract_paragraph->content}}</textarea>
			</div>
			
			<div class="col-md-8 leng">			
				<textarea rows="6" name="contract_paragraph_eng" class="form-control input-sm"> {{$contract_paragraph_eng->content}}</textarea>
			</div>
			 <div class="col-md-4">
			 </div>
		  </div>
    </fieldset>
    
	</div>
    
    <div class="col-sm-6">
		<fieldset > <legend> Contract Footer Settings </legend>
        <div class="form-group">
            <label for="ipt" class=" control-label col-md-4"> Contract Block 1 </label>
            <div class="col-md-8">			
            	<textarea rows="6" name="contract_block1" class="form-control input-sm">{{$contract_block1->content}}</textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="ipt" class=" control-label col-md-4"> Contract Block 2 </label>
            <div class="col-md-8">			
            	<textarea rows="6" name="contract_block2" class="form-control input-sm">{{$contract_block2->content}}</textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="ipt" class=" control-label col-md-4"> Contract Block 3 </label>
            <div class="col-md-8">			
            	<textarea rows="6" name="contract_block3" class="form-control input-sm">{{$contract_block3->content}}</textarea>
            </div>
        </div>
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
</script>
@endsection