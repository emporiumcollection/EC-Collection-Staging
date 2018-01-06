@extends('layouts.login')

@section('content')
<style>
.gray-bg
{
	background:url({{URL::to('sximo/images/').'/Background2.jpg'}}) no-repeat top center;
}
.middle-box
{
	width:600px;
	margin-left: -250px;
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
 {!! Form::open(array('url'=>'user/create', 'class'=>'form-signup')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.firstname') }}	 </label>
			  {!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'First Name' ,'required'=>'' )) !!}
				<i class="icon-users form-control-feedback"></i>
			</div>
			
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.lastname') }}	 </label>
			 {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Last Name','required'=>'')) !!}
				<i class="icon-users form-control-feedback"></i>
			</div>
			
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.email') }}	 </label>
			 {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address','required'=>'email')) !!}
				<i class="icon-envelop form-control-feedback"></i>
			</div>
			
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.password') }}	</label>
			 {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password','required'=>'')) !!}
				<i class="icon-lock form-control-feedback"></i>
			</div>
			
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.repassword') }}	</label>
			 {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password','required'=>'')) !!}
				<i class="icon-lock form-control-feedback"></i>
			</div>
			<div class="form-group has-feedback">
				<label>{{ Lang::get('core.membership_plans') }}	</label>
					<select name="membership_plan" class="form-control" required="required">
						<option value=""> - Select Plan - </option>
						@foreach($plans as $plan)
							<option value="{{$plan->id}}" {{($plan->id==$planId)?'selected="selected"':''}}> {{$plan->package_name.' - $'.$plan->package_price.' / '.$plan->package_duration.' months'}} </option>
						@endforeach
					</select>
			</div>
			@if(CNF_RECAPTCHA =='true') 
			<div class="form-group has-feedback  animated fadeInLeft delayp1">
				<label class="text-left"> Are u human ? </label>    
				<br />
				{!! captcha_img() !!} <br /><br />
				<input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>

				<div class="clr"></div>
			</div>
			@endif
			<div class="form-group has-feedback">
				<input type="checkbox" value="1" name="accept_terms" class="no-border" required="required">
				<label>Terms and conditions </label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group has-feedback">
				<label>Business Name </label>
			  {!! Form::text('company_name', null, array('class'=>'form-control', 'placeholder'=>'Business Name' ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
				<label>Address </label>
			  {!! Form::text('company_address', null, array('class'=>'form-control', 'placeholder'=>'Address' ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
				<label>Address </label>
			  {!! Form::text('company_address2', null, array('class'=>'form-control', 'placeholder'=>'Address' ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
				<label>Phone # </label>
			  {!! Form::text('company_phone', null, array('class'=>'form-control', 'placeholder'=>'Phone #' ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
				<label>Website </label>
			  {!! Form::text('company_website', null, array('class'=>'form-control', 'placeholder'=>'Website' ,'required'=>'' )) !!}
			</div>
			<div class="form-group has-feedback">
				<label>Tax # </label>
			  {!! Form::text('company_tax_no', null, array('class'=>'form-control', 'placeholder'=>'Tax #' ,'required'=>'' )) !!}
			</div>
		</div>
	</div>
      <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> {{ Lang::get('core.signup') }}	</button>
       </div>
      </div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('user/login')}}"> {{ Lang::get('core.signin') }}  </a> | <a href="{{ URL::to('')}}"> {{ Lang::get('core.backtosite') }}  </a> 
   		</p>
 {!! Form::close() !!}
 </div>
</div> 
@stop
