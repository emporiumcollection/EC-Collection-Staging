@extends('layouts.login')

@section('content')
<style>
.gray-bg
{
	background:url({{URL::to('sximo/images/').'/Background2.jpg'}}) no-repeat top center;
}
.middle-box
{
	width:450px;
}
</style>
<div class="sbox">
	<div class="sbox-title">
			
		<h3 >Emporium Voyage Membership Portal</h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center  animated fadeInDown delayp1">
		<img src="{{ asset('sximo/assets/images/logo-design_1.png')}}" width="100%" />
	</div>		
 {!! Form::open(array('url'=>'payment', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
		<h4>Thanks for register! please pay the amount to acivate your account.</h4>
		<input type="hidden" name="umid" value="{{$umid}}" />
	</div>


	<div class="form-group has-feedback">
		
		<label>Choose payment method</label><br>
		<input type="radio" name="method" value="paypal" /> Paypal<br>
		<input type="radio" name="method" value="stripe" /> Stripe<br>
		<input type="radio" name="method" value="bank" /> Bank account


	</div>
    <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> Payment	</button>
       </div>
    </div>
 {!! Form::close() !!}
 </div>
</div> 
@stop
