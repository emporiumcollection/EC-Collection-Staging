<link rel="stylesheet" href="{{ asset('sximo/css/supersized.css') }}" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('sximo/css/supersized.shutter.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ asset('sximo/js/supersized.3.2.7.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('sximo/js/supersized.shutter.min.js') }}"></script>
<style>
	.controls-wrapper {
		margin: 0 auto;
		height: 120px;
		width: 100%;
		bottom: 0px;
		right: 10px;
		z-index: 4;
		position: absolute;
		text-align:right;
		margin-bottom:40px;
	}
	.download-wrapper
	{
		background:#fff;
		color:#000;
		padding:15px;
		text-align:center;
		float:right;
		border-radius: 10px;
	}
	#navbar
	{
		display:none;
	}
</style>
<script type="text/javascript">

	jQuery(function ($) {

		$.supersized({

			// Functionality
			slide_interval: 4000,		// Length between transitions
			transition: 1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed: 800,		// Speed of transition

			// Components
			slide_links: 'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			slides: [			// Slideshow Images
			<?php if(!empty($ads_home)) { foreach($ads_home as $imgOBJ){
					
					echo '{image:"'.URL::to('uploads/users/advertisement').'/'.$imgOBJ->adv_img.'",title:"", thumb:"",url:"'.$imgOBJ->adv_link.'"},';
			} }	?>
			]

		});
	});

</script>
<div class="controls-wrapper">
	@if(!empty($share_info))
	<div class="download-wrapper">User {{$share_info->first_name.' '.$share_info->last_name }} shared the following {{$share_info->files_shared}} files with you<br> Please download below.<br>
		<a class="btn btn-default" href="{{$share_info->url_shared}}" download="{{'download'.$share_info->shared_type}}" >Download</a>
		<br>
		<a href="{{URL::to('')}}" style="float:left;"><b>Home </b></a>
		<a href="#" data-toggle="modal" data-target="#myModalads" style="float:right;"><b> Subcribe</b></a>
	</div>
	@endif
</div>

<div class="modal fade" id="myModalads" role="dialog">
	<div class="modal-dialog" role="document">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h2><img src="{{ asset('sximo/images/logo-sximo.png')}}" alt="Your logo"> <span>Account</span></h2>
		  <p>Don’t have an account? <a href="#" id="LearnMoreBtn1" data-dismiss="modal" data-toggle="modal" data-target="#myModalads1" >Register Here</a></p>
		</div>
		
		<div class="span12">
		
		  <div class="loginform-content">
			  <h2>LOG IN TO YOUR ACCOUNT</h2>
					<form method="post" action="{{ url('user/signin')}}" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="input-prepend">
							<input type="email" name="email" placeholder="Email Address" class="prependedInput" required="email" />
						</div>
						<div class="input-prepend">
							<input type="password" name="password" placeholder="******" class="prependedInput" required="true" />
						</div>
						<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgetpassads">Forgot your password?</a>
						<div class="help-block">
							<button type="submit" class="btn btn-large btn-info">Log In</button>
						</div>
					</form>
			  </div>
			</div>
		<div class="modal-footer1">
		  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
		</div>
	  </div>
	</div>
</div>

<!--------------Register popup---------------->

<div class="modal fade" id="myModalads1" role="dialog">
	<div class="modal-dialog reg">
	
	  <!-- Modal content-->
	  <div class="modal-content reg">
			
		<div class="span12">
		
		 <div class="span6">
		 
		 <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h2><img src="{{ asset('sximo/images/logo-sximo.png')}}" alt="Your logo" > <span>Account</span></h2>
		  <p>Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModalads" >Log In</a></p>
		</div>
		 
		 
		  <div class="regform-content">
			@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
			  <h2>SIGN UP AND RECEIVE EXCLUSIVE ACCOUNT BENEFITS:</h2>
				<ul>
				   <li>Collection and Product Previews</li>
				   <li>Special Events</li>
				   <li>Industry News</li>
				   <li>Virtual Binder</li>
				   <li>VIP Offers</li>
				   <li>Quick Ship Expedited Service</li>
				</ul>
			   
					{!! Form::open(array('url'=>'user/create', 'class'=>'form-horizontal reg')) !!}
						<div class="input-prepend">
							{!! Form::text('firstname', null, array('class'=>'prependedInput', 'placeholder'=>'First Name' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('lastname', null, array('class'=>'prependedInput', 'placeholder'=>'Last Name','required'=>'')) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('email', null, array('class'=>'prependedInput', 'placeholder'=>'Email Address','required'=>'email')) !!}
						</div>
						<div class="input-prepend">
							<select name="membership_plan" class="prependedInput" required="required" style="height:31px;">
								<option value=""> - Select Membership Plan - </option>
								@if(!empty($plans))
									@foreach($plans as $plan)
										<option value="{{$plan->id}}"> {{$plan->package_name.' - $'.$plan->package_price.' / '.$plan->package_duration.' months'}} </option>
									@endforeach
								@endif
							</select>					
						</div>
						<div class="input-prepend">
							{!! Form::password('password', array('class'=>'prependedInput', 'placeholder'=>'Password','required'=>'')) !!}
						</div>
						<div class="input-prepend">
							{!! Form::password('password_confirmation', array('class'=>'prependedInput', 'placeholder'=>'Confirm Password','required'=>'')) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_name', null, array('class'=>'prependedInput', 'placeholder'=>'Business Name' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_address', null, array('class'=>'form-control', 'placeholder'=>'Address' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_address2', null, array('class'=>'form-control', 'placeholder'=>'Address' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_phone', null, array('class'=>'form-control', 'placeholder'=>'Phone #' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_website', null, array('class'=>'form-control', 'placeholder'=>'Website' ,'required'=>'' )) !!}
						</div>
						<div class="input-prepend">
							{!! Form::text('company_tax_no', null, array('class'=>'form-control', 'placeholder'=>'Tax #' ,'required'=>'' )) !!}
						</div>
						
						<p><input class="prependedInput check" type="checkbox" name="accept_terms" required="required" value="1">Your time is valuable, please help us tailor our communication to your specific professional interests. SUITE New York does not share or sell personal info. <a href="#">Privacy Policy</a></p>
						
						<div class="help-block">
							<button type="submit" class="btn btn-large btn-info">Submit</button>
						</div>
					</form>
			  </div>
			</div>
		
		
		<div class="span6">
		   <img class="reg-img" src="{{ asset('sximo/images/account_img.jpg')}}" alt="regimg"></a>
		</div>
		</div>
		<div class="modal-footer1">
		  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
		</div>
	  </div>
	  
	</div>
</div>

<!---  Forget password   ----->
<div class="modal fade" id="forgetpassads" role="dialog">
	<div class="modal-dialog" role="document">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h2><img src="{{ asset('sximo/images/logo-sximo.png')}}" alt="Your logo"> <span>Account</span></h2>
		</div>
		
		<div class="span12">
		  <div class="loginform-content">
			  <h2>Forgot Password</h2>
					<form method="post" action="{{ url('user/request')}}" class="form-horizontal">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="input-prepend" style="width:100%;">
							<input type="text" name="credit_email" placeholder="{{ Lang::get('core.email') }}" class="prependedInput" required/>
						</div>
						<div class="help-block">
							<button type="submit" class="btn btn-large btn-info">{{ Lang::get('core.sb_submit') }}</button>
						</div>
					</form>
			  </div>
			</div>
		<div class="modal-footer1">
		  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
		</div>
	  </div>
	</div>
</div>