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
    <link href="{{ asset('themes/emporium/css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{ asset('lib/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
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
        <link href="{{ asset('sximo/assets/css/intlTelInput.css') }}" rel="stylesheet">


    @show
	<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="760dec3f-be0e-4331-bd80-0c07fb2f2e1e" type="text/javascript" async></script>

	<script id="CookieDeclaration" src="https://consent.cookiebot.com/760dec3f-be0e-4331-bd80-0c07fb2f2e1e/cd.js" type="text/javascript" async></script>

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
            <a href="{{url('/')}}"><img src="{{ asset('themes/emporium/images/logo.png') }}"
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

<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
{{-- Site Base URL --}}
<script type="text/javascript">var BaseURL = '{{ url() }}'; </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('themes/emporium/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('themes/emporium/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('themes/emporium/js/owl.carousel.js') }}"></script>
<script src="{{ asset('themes/emporium/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>
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
    <script src="{{ asset('sximo/assets/js/intlTelInput.js')}}" type="text/javascript"></script>
@show
{{-- For embed custom javascript code and files  --}}
@section('custom_js')
    @parent


    <script type="text/javascript">
        $(document).ready(function () {
            // Open Left Navigation For Search By Date on Page Load
            @if(isset($_GET['action']) && $_GET['action']=='bydate' )
            $('[data-action="search-by-date"]').trigger('click');
            @endif

            // Open Left Navigation For Collection on Page Load
            @if(Request::segment(1)=='luxurytravel' && Request::segment(2)=='Hotel')
            $('[data-action="select-collection"]').trigger('click');
            @endif

            // Open Left Navigation For Experience on Page Load
            @if(Request::segment(1)=='luxury_experience')
            $('[data-action="select-experience"]').trigger('click');
            @endif

            // Open Left Navigation For Destinations on Page Load
            @if(Request::segment(1)=='luxury_destinations')
                var datObj = {};
                datObj.catID = '{{$destination_category}}';
                var params = $.extend({}, doAjax_params_default);
                params['url'] = BaseURL + '/destination/destinatinos-ajax';
                params['data'] = datObj;
                params['successCallbackFunction'] = renderDestination;
                doAjax(params);
            @endif





            /*
            * Login BUTTON  Click Action Here
            */
            $("#loginFormAction").submit(function (event) {
                event.preventDefault();

                $(".ai-sign-up-form-error-msg").html('');
                $(".ai-login-form-success-msg").html('');

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{URL::to('customer_ajaxPostSignin')}}",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    success: function (data, textStatus, jqXHR) {
                        if (data.status == 'success') {
                            window.location.href = "{{URL::to('customer/profile')}}";
                        }
                        else {
                            var message = data.message;
                            for (var i = 0; i < data.errors.length; i++) {
                                message += '<br>' + data.errors[i];
                            }
                            $(".ai-login-form-error-msg").html(message);
                        }
                    }
                });
            });


            /*
            * Register BUTTON  Click Start Action Here
            */

            $("#customerRegisterarioForm").submit(function (event) {


                var countryData = $("#txtmobileNumber").intlTelInput("getSelectedCountryData");

                var error = $("#txtmobileNumber").intlTelInput("getValidationError");
                var isValid = $("#txtmobileNumber").intlTelInput("isValidNumber");

                if (isValid) {
                    $("#txtmobileDialcode").val(countryData.dialCode);
                } else {
                    return false
                }
                event.preventDefault();

                $(".ai-sign-up-form-success-msg").html('');
                $(".ai-sign-up-form-error-msg").html('');
                $(".ai-login-form-success-msg").html('');

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{URL::to('customer_ajaxPostCreate')}}",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    success: function (data, textStatus, jqXHR) {


                        if (data.status == 'success') {
                            $(".ai-sign-up-form-success-msg").html(data.message);
                            window.location.href = "{{URL::to('whoiam')}}";
                        }
                        else {
                            var message = data.message;
                            for (var i = 0; i < data.errors.length; i++) {
                                message += '<br>' + data.errors[i];
                            }
                            $(".ai-sign-up-form-error-msg").html(message);
                        }
                    }
                });
            });



        });


        var telInput = $("#txtmobileNumber"),
            errorMsg = $("#error-msg"),
            validMsg = $("#valid-msg");
        // initialise plugin
        telInput.intlTelInput({
            utilsScript: "{{ asset('sximo/assets/js/utils.js')}}"
        });

        var reset = function () {
            telInput.removeClass("error");
            errorMsg.addClass("hide");
            validMsg.addClass("hide");
        };

        // on blur: validate
        telInput.blur(function () {
            reset();
            if ($.trim(telInput.val())) {
                if (telInput.intlTelInput("isValidNumber")) {
                    validMsg.removeClass("hide");
                } else {
                    telInput.addClass("error");
                    errorMsg.removeClass("hide");
                }
            }
        });

        // on keyup / change flag: reset
        telInput.on("keyup change", reset);


    </script>

@show

</body>
</html>