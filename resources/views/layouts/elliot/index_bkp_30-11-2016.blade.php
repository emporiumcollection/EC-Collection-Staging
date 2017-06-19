<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> {{ $pageTitle}} | {{ CNF_APPNAME }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon"> 

    <!-- Bootstrap -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/themes/elliot/css/bootstrap.min.css')}}" rel="stylesheet">
   <!-- <link href="{{ asset('sximo/themes/elliot/css/style.css')}}" rel="stylesheet">-->
    <link href="{{ asset('sximo/themes/elliot/css/font-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('sximo/themes/elliot/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('sximo/themes/elliot/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('sximo/themes/sximone/js/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('sximo/themes/elliot/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('sximo/themes/elliot/js/jquery.mixitup.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('sximo/js/plugins/parsley.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('sximo/themes/elliot/js/fancybox/source/jquery.fancybox.js') }}"></script>  
       
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="{{ asset('sximo/css/frontend_templete/style.css')}}" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
	<link href="{{ asset('sximo/css/frontend_templete/magnific-popup.css')}}" rel="stylesheet">
	<!-- JavaScript -->
	<script src="{{ asset('sximo/js/frontend_templete/jquery.magnific-popup.min.js') }}"></script>
	<!--<link href="{{ asset('sximo/css/frontend_templete/component.css')}}" rel="stylesheet">-->
	<style type="text/css">
		@font-face 
		{ 
			font-family: AvenirNext LT Pro Regular; 
			src: url({{ asset('sximo/fonts/AvenirNextLTPro-Regular.otf')}}); 
		}
		#back-top > a {
			background: rgba(0, 0, 0, 0) url("{{URL::to('sximo/images/aarrow.png')}}") no-repeat scroll left center;
		}
		
		.navbar-default
		{
			background-color: #fff;
		}
	</style>
  </head>
  <body data-spy="scroll" data-target=".navMenuCollapse" class="cbp-spmenu-push">
	<div id="wrap">
		<div id="navbar">    
		  <nav class="navbar navbar-default navbar-static-top bg-color1 dark-bg" role="navigation" style="height:195px;">
			<div class="container"> 
				<div class=" nav-menu">
					
			
					<div class="collapse navbar-collapse navMenuCollapse" id="navbar-collapse-1">
						@include('layouts/elliot/topbar')
					</div>
					
					<div class="navbar-header">
						<button class="round-toggle navbar-toggle menu-collapse-btn collapsed" data-toggle="collapse" data-target=".navMenuCollapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					  <a class="" href="{{URL::to('')}}"><img src="{{ asset('uploads/users/company/'.$home_logo->company_logo)}}" alt="Your logo" style="width:100%; max-width:960px;"></a>
					</div>
				</div>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog" role="document">
					
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h2><img src="{{ asset('uploads/users/company/'.$home_logo->company_logo)}}" alt="Your logo" style="width:200px;"> <span>Account</span></h2>
						  <p>Don’t have an account? <a href="#" id="LearnMoreBtn1" data-dismiss="modal" data-toggle="modal" data-target="#myModal1" >Register Here</a></p>
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
										<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgetpass">Forgot your password?</a>
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
		  
				<div class="modal fade" id="myModal1" role="dialog">
					<div class="modal-dialog reg">
					
					  <!-- Modal content-->
					  <div class="modal-content reg">
							
						<div class="span12">
						
						 <div class="span6">
						 
						 <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h2><img src="{{ asset('uploads/users/company/'.$home_logo->company_logo)}}" alt="Your logo" style="width:200px;"> <span>Account</span></h2>
						  <p>Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModal" >Log In</a></p>
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
				<div class="modal fade" id="forgetpass" role="dialog">
					<div class="modal-dialog" role="document">
					
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h2><img src="{{ asset('uploads/users/company/'.$home_logo->company_logo)}}" alt="Your logo" style="width:200px;"> <span>Account</span></h2>
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
			</div>
		  </nav>
		</div>
   
  <!-- Start dinamyc page -->
   @include($pages)
  <!-- End dinamyc page -->
  
  
		</div>
	</div>
	<div class="container"> 
		<p id="back-top">
			<a href="#top" title="Scroll to Top"><span></span>nach oben</a>
		</p>
	</div>
<div id="search">
    <button type="button" class="close" style="background-color:#000;">×</button>
    {!! Form::open(array('url'=>'productsearch', 'class'=>'columns' ,'id' =>'product_search', 'method'=>'get' )) !!}
        <input type="search" value="" placeholder="KEYWORD EINGEBEN" name="searchkeyword" />
        <button type="submit" class="btn btn-primary" style="background:#000;">Suche</button>
    </form>
</div>
<script>
$(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    
});

</script>
<script src="{{ asset('sximo/js/frontend_templete/classie.js')}}"></script>
<script>
	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;

	showLeftPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toright' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
		disableOther( 'showLeftPush' );
	};

	function disableOther( button ) {
		
		if( button !== 'showLeftPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
		if( button !== 'showRightPush' ) {
			classie.toggle( showRightPush, 'disabled' );
		}
	}
</script>
  </body>
</html>