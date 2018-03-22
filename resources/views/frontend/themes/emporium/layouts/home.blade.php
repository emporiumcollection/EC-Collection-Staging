    <!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="keywords" content="@yield('meta_keywords') ">
			<meta name="description" content="@yield('meta_description') ">

			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
			<title> @yield('title') | {{ CNF_APPNAME }}</title>
			<!-- Bootstrap -->
			<link href="{{ asset('themes/emporium/css/bootstrap.min.css') }}" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/owl.carousel.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/font-stylesheet.css') }}" rel="stylesheet">
			<link rel="stylesheet" href="{{ asset('themes/emporium/css/jquery.mCustomScrollbar.css') }}">

			<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->

			@section('head')
			@parent
			<link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
			@show

			<link href="{{ asset('themes/emporium/css/style.css') }}" rel="stylesheet">
			<link href="{{ asset('themes/emporium/css/responsive.css') }}" rel="stylesheet">

			@section('custom_css')
			@parent
			<link href="{{ asset('themes/emporium/css/custom.css') }}" rel="stylesheet">
			@show

	   </head>
	   <body>
		  	{{--For Right Side Icons --}}
			@section('right_side_iconbar')
			@parent
			@include('frontend.themes.emporium.layouts.sections.common_right_iconbar')
			@show
			
			{{--For Left Sidebar --}}
		   @section('sidebar')
			@parent
			 @include('frontend.themes.emporium.layouts.sections.home_sidebar')
           @show
		  <div class="page-container">

			 <header id="header">
				<!--<i class="fa fa-bars hamburgMenu" aria-hidden="true"></i>-->
				<div class="logo-wrapper">
				   <a href="{{url('/')}}"><img src="{{ asset('themes/emporium/images/design-location-logo.png') }}" alt="Emporium Voyage"/></a>
				</div>
				<div class="header-content">
				   <div class="col-lg-12 header-search">
				   		{{--For Top Bar --}}
                       @section('top_search_bar')
                           @parent
                           @include('frontend.themes.emporium.layouts.sections.top_search_bar')
                       @show
					</div>
				</div>
			 </header>
			 {{--For Page Content  --}}

			  @yield('content')


			  {{--For Footer  --}}
              @section('footer')
                  @parent
                 @include('frontend.themes.emporium.layouts.sections.footer')
              @show

		  </div>

		@if(!auth()->check()){	
			@include('frontend.themes.emporium.layouts.sections.login')
		@endif

		@include('frontend.themes.emporium.layouts.sections.cookie')

		  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
		  {{-- Site Base URL --}}
		<script type="text/javascript">var BaseURL ='{{ url() }}'; </script>
		  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		  <script src="{{ asset('themes/emporium/js/jquery.min.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/bootstrap.min.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/owl.carousel.js') }}"></script>
		  <!-- custom scrollbar plugin -->
		  <script src="{{ asset('themes/emporium/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
		  @section('javascript')
			@parent
		  <!-- Date Picker js -->
		  <script src="{{ asset('themes/emporium/js/moment.min.js') }}"></script>

		  <script src="{{ asset('themes/emporium/js/daterangepicker.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/single-date.js') }}"></script>
		  <script src="{{ asset('themes/emporium/js/custom.js') }}"></script>
		  @show
		  @section('custom_js')
			@parent
		  <script type="text/javascript">
			 $(document).ready(function () {
				 $(".cookie-bar-hide-btn").click(function () {
					 $(".bootom-cookie-bar-outer").hide();
				 });

				 $(".cookie-bar-hide-btn").click(function () {
					 $(".bootom-cookie-bar-outer").hide();
				 });
					 checkCookie();
				 });
				 function setCookie(cname, cvalue, exdays) {
					 var d = new Date();
					 d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
					 var expires = "expires=" + d.toUTCString();
					 document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
				 }

				 function checkCookie() {
					 var username = getCookie("cookie-bar");

					 if (username == "") {
						 setCookie('cookie-bar', '1', 1);
						 $(".bootom-cookie-bar-outer").show();
					 }else{
						 $(".bootom-cookie-bar-outer").hide();
					 }
				 }
				 function getCookie(cname) {
					 var name = cname + "=";
					 var decodedCookie = decodeURIComponent(document.cookie);
					 var ca = decodedCookie.split(';');
					 for (var i = 0; i < ca.length; i++) {
						 var c = ca[i];
						 while (c.charAt(0) == ' ') {
							 c = c.substring(1);
						 }
						 if (c.indexOf(name) == 0) {
							 return c.substring(name.length, c.length);
						 }
					 }
					 return "";
				 }
		  </script>
		  @show
	   </body>
	</html>