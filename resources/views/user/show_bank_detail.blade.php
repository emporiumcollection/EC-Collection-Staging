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
			
		<h3 >JohnnyShares - Sharing & Collaboration Platform</h3>
				
	</div>
	<div class="sbox-content">
	<div class="text-center  animated fadeInDown delayp1">
		<img src="{{ asset('sximo/images/logo-sximo.png')}}" />
	</div>		
 {!! Form::open(array('url'=>'bank_agree', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
		<h4>You choose payment through Bank transfer.</h4>
		<input type="hidden" name="usid" value="{{$userid}}" />
	</div>
	<div class="form-group has-feedback">
		<p><b>Name der Bank:</b> Stadtsparkasse München<br>
		<b>Kontoinhaber:</b> Riaan Kleynhans | number7even
		IBAN  DE05 7015 0000 1001 2477 56 
		BIC    SSKMDEMM<br>
		http://www.number7even.com</p>
	</div>
	<div class="form-group has-feedback">
		<input type="checkbox" name="accept_terms" value="1" required="required" /> Agree with terms and conditions.
	</div>
    <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> Submit	</button>
       </div>
    </div>
 {!! Form::close() !!}
 </div>
</div> 
@stop
