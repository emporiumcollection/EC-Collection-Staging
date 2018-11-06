@extends('layouts.app')

@section('content')

  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Invoice</h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('sximo/config') }}">Setting</a></li>
			<li class="active"> Invoice </li>
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
	 {!! Form::open(array('url'=>'sximo/config/invoice/', 'class'=>'form-horizontal row')) !!}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> Invoice Settings </legend>
		  <div class="form-group">
			 		
		  </div>  
		
		 <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Invoice # </label>
			<div class="col-md-8">
				<input name="invoice_num" type="text" id="invoice_num" class="form-control input-sm" required  value="{{$invoice_num->content}}" />  
			 </div> 
		  </div> 
		  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Tax Amount ( in % ) </label>
			<div class="col-md-8">
				<input name="tax_amt" type="text" id="tax_amt" class="form-control input-sm" value="<?php if(!empty($tax_amount) && $tax_amount->content>0) { echo $tax_amount->content; } ?>" />  
			 </div> 
		  </div>
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Currency </label>
			<div class="col-md-8">
				<select class="form-control" name="tax_currency">
					<option value="€" <?php if(!empty($currency) && $currency->content=='€') { echo 'selected="selected"'; } ?>>Euro (€)</option>
					<option value="£" <?php if(!empty($currency) && $currency->content=='£') { echo 'selected="selected"'; } ?>>Pound (£)</option>
					<option value="$" <?php if(!empty($currency) && $currency->content=='$') { echo 'selected="selected"'; } ?>>Dollar ($)</option>
				</select>
			 </div> 
		  </div>
		  
		  <legend> Invoice footer Settings </legend>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Bank details </label>
			<div class="col-md-8">			
				<textarea rows="6" name="bankDetail" class="form-control input-sm">{{$bankDet->content}}</textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Company registration details </label>
			<div class="col-md-8">			
				<textarea rows="6" name="regDetail" class="form-control input-sm">{{$regDet->content}}</textarea>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Company contact details </label>
			<div class="col-md-8">			
				<textarea rows="6" name="contactDetail" class="form-control input-sm">{{$contDet->content}}</textarea>
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
	
	<div class="col-sm-6">
	
		<fieldset > <legend> Invoice Header Settings </legend>
		  <div class="form-group">
			 		
		  </div>  
		
		 <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> Invoice phone no. </label>
			<div class="col-md-8">
				<input name="invoice_phone_num" type="text" id="invoice_phone_num" class="form-control input-sm" required  value="{{$invoice_phone_num->content}}" />  
			 </div> 
		  </div> 
		  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Invoice Email id </label>
			<div class="col-md-8">
				<input name="invoice_email_id" type="text" id="invoice_email_id" class="form-control input-sm" value="{{ $invoice_email_id->content }}" />  
			 </div> 
		  </div>
		  
		   <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Invoice Address </label>
			<div class="col-md-8">
				<input name="invoice_address" type="text" id="invoice_address" class="form-control input-sm" value="{{ $invoice_address->content }}" />  
			 </div> 
		  </div>
          
           <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Totals Footer Message </label>
			<div class="col-md-8">
				<input name="invoice_total_footer_message" type="text" id="invoice_total_footer_message" class="form-control input-sm" value="{{ $invoice_total_footer_message->content }}" />  
			 </div> 
		  </div>
          
          <div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> Footer Message </label>
			<div class="col-md-8">
                <textarea rows="6" name="invoice_footer_message" class="form-control input-sm markItUp">{{ $invoice_footer_message->content }}</textarea> 
			 </div> 
		  </div>
		  
  	</fieldset>
	</div> 


 	
 </div>
 {!! Form::close() !!}
</div>
</div>
</div>
</div>


@endsection