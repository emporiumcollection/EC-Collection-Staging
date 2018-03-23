<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="@yield('meta_keywords') ">
    <meta name="description" content="@yield('meta_description') ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    {{--For Include and Add Files in Head --}}
    @section('head')
        @parent
        <link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">
    @show

    <link href="{{ asset('themes/emporium/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/responsive.css') }}" rel="stylesheet">
    {{--For Custom Styles --}}
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
            <a href="{{url('/')}}"><img src="{{ asset('themes/emporium/images/design-location-logo.png') }}"
                                        alt="Emporium Voyage"/></a>
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
{{-- For Include Login Popup --}}
@if(!auth()->check())
    @include('frontend.themes.emporium.layouts.sections.login')
@endif
{{-- For Cookie Popup of Confidential Data--}}
@include('frontend.themes.emporium.layouts.sections.cookie')

<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
{{-- Site Base URL --}}
<script type="text/javascript">var BaseURL = '{{ url() }}'; </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('themes/emporium/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('themes/emporium/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/emporium/js/owl.carousel.js') }}"></script>
<!-- custom scrollbar plugin -->
<script src="{{ asset('themes/emporium/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('themes/emporium/js/custom/do_ajax.js') }}"></script>
{{-- For including javascript files --}}
@section('javascript')
    @parent
    <!-- Date Picker js -->
    <script src="{{ asset('themes/emporium/js/moment.min.js') }}"></script>

    <script src="{{ asset('themes/emporium/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/single-date.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/destination.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/experience.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/left_search.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/custom/common.js') }}"></script>
@show
{{-- For embed custom javascript code and files  --}}
@section('custom_js')
    @parent

@show
</body>
</html>