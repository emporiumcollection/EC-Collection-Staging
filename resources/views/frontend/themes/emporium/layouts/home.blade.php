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
    
    <!-- Favicon Start -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/images/favicon/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/images/favicon/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/images/favicon/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/favicon/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/images/favicon/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/images/favicon/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/images/favicon/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/images/favicon/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/images/favicon/android-icon-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/favicon/favicon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('assets/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/ms-icon-144x144.png') }}" />
    <meta name="theme-color" content="#ffffff" />
    <!-- Favicon END -->
    
    <!-- Bootstrap -->
    <link href="{{ asset('themes/emporium/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/font-stylesheet.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('themes/emporium/css/jquery.mCustomScrollbar.css') }}">
    {{--<link href="{{ asset('themes/emporium/css/bootstrap-datepicker.css')}}" rel="stylesheet">--}}
    <link href="{{ asset('lib/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- tilt css include -->
    <!-- end of tilt css include -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--For Include and Add Files in Head --}}
     <link href="{{ asset('themes/emporium/css/slick.css') }}" rel="stylesheet">
    @section('head')
        @parent
        {{--<link href="{{ asset('themes/emporium/css/daterangepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('themes/emporium/css/calendar.css') }}" rel="stylesheet">--}}
    @show

    <link href="{{ asset('themes/emporium/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/responsive.css') }}" rel="stylesheet">
    {{--For Custom Styles --}}
    @section('custom_css')
        @parent
        <style>
            .iub-no-markup{
                color: #fff;
                text-decoration: underline;
            }
            .iub-no-markup:hover{
                color: #fff;
                text-decoration: underline;
            }
        </style>
        <link href="{{ asset('themes/emporium/css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('sximo/assets/css/intlTelInput.css') }}" rel="stylesheet">
        <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    @show
@if(defined('CNF_GOOGLE_ANALYTIC_KEY'))
    @if(CNF_GOOGLE_ANALYTIC_KEY != '')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ CNF_GOOGLE_ANALYTIC_KEY }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', '{{ CNF_GOOGLE_ANALYTIC_KEY }}');
    </script>
    @endif
@endif

{{--*/
$isfLoginned = (bool) \auth()->check();
if((isset($isfPublic)) && ($isfLoginned === false)){ $isfLoginned = (bool) $isfPublic; }
/*--}}
</head>
@if(!empty($pageTitle))
<body class='{{str_replace(" ","_","$pageTitle")}} @if($isfLoginned) {{'user_logged_in'}} @endif '>
@else
<body>
 @endif
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
            {{-- <a href="{{url('/')}}">
                <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage"/>
            </a> --}}
            @if(defined('CNF_FRONTEND_LOGO'))
                @if(file_exists(public_path().'/sximo/images/'.CNF_FRONTEND_LOGO) && CNF_FRONTEND_LOGO !='')
                    <a href="{{url('/')}}">
                        <img src="{{ asset('sximo/images/'.CNF_FRONTEND_LOGO)}}"  alt="{{ CNF_APPNAME }}" class="img-responsive"/>      
                    </a>
                @else
                    <a href="{{url('/')}}">
                        <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage"/>
                    </a>
                @endif
            @else
                <a href="{{url('/')}}">
                    <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png') }}" alt="Emporium Voyage"/>
                </a>
            @endif
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

<!-- Modal -->
<div id="showLoginPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title">Alert</h4>
      </div>
      <div class="modal-body">
        Please Login to view
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- End Modal content-->
    
  </div>
</div>
<!-- End Modal -->
<!-- Modal -->
<div id="showMemberLoginPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body mem-modal-popup">
        
      </div>      
    </div>
    <!-- End Modal content-->
    
  </div>
</div>
<!-- End Modal -->
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
<!-- tilt js include -->

<!-- tilt js include -->
{{-- For including javascript files --}}
@section('javascript')
    @parent
    <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
    <!-- Date Picker js -->
    <script src="{{ asset('themes/emporium/js/moment.min.js') }}"></script>

    {{--<script src="{{ asset('themes/emporium/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/single-date.js') }}"></script>--}}
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
        function checkMembership(param){
            var memtype = param;
            
            var login_type = '';
            if(memtype=="lifestyle-membership"){
                login_type = "Lifestyle";        
            }else if(memtype=="dedicated-membership"){
                login_type = "Dedicated"; 
            }else if(memtype=="bespoke-membership"){
                login_type = "Bespoke"; 
            }
            $("#sp-mem-type").html(login_type);
            
            user_referral = ''; 
            if(memtype=="bespoke-membership"){
                $("input[name='email']").parent('.form-group').removeClass('mg-top');
                user_referral = '<div class="form-group mg-top" id="dv_referral"> <input class="form-control" name="referral_code" type="text" placeholder="Enter Referral Code"> </div>';
                $(user_referral).insertAfter(".user_ref");    
            }else{
                $("#dv_referral").remove();
                $("input[name='email']").parent('.form-group').addClass('mg-top');
            }
            
        }
        $(document).ready(function () {
            console.log(window.location.href);
            $(document).on('click', ".iubenda-white2", function(e){
                e.preventDefault();
                var w=600;
                var h=450;
                var left = (screen.width/2)-(w/2);
                var top = (screen.height/2)-(h/2);
                window.open("https://www.iubenda.com/privacy-policy/70156957", "Emporium Voyage Privacy Policy", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
               console.log("hee"); 
            });
            $(document).on('click', ".iubenda-white", function(e){
                e.preventDefault();
                var w=600;
                var h=450;
                var left = (screen.width/2)-(w/2);
                var top = (screen.height/2)-(h/2);
                window.open("https://www.iubenda.com/privacy-policy/70156957/cookie-policy", "Emporium Voyage Terms and Condition", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
               console.log("hee"); 
            });
            
            
            var list = $('ul.options li');
            $(list).click(function(){
                
                var list_val = $(this).attr('rel');
                var user_ref = '';
                if(list_val.length > 0 && list_val == '3'){
                    
                    //$("input[name='email']").parent('.form-group').removeClass('mg-top');
                    
                    $.ajax({
                        url: "{{URL::to('membershiptypes')}}",
                        type: "GET",
                        dataType: "json",                        
                        success: function (data, textStatus, jqXHR) {
                            if (data.status == 'success') {
                                user_ref = '<div class="reltv" id="dv-member-type"><select name="member_type" class="member-type mg-top" id="sel-member-type" style="margin-top:20px;">';
                                var obj = data.objmember;
                                $("#sel-member-type").empty();                                
                                $.each(obj, function(key, value){
                                    //console.log('key:'+key+':value:'+value.id); 
                                    var ttl = (value.package_title).trim();
                                    ttl = ttl.replace(' ', '-');
                                    ttl = ttl.toLowerCase();
                                    user_ref += "<option value='"+ttl+"'>"+value.package_title+"</option>";
                                });
                                user_ref += '</select></div>'; //console.log(user_ref);
                                $('.user_ref').css('margin-top', '20px');
                                $('.user_ref').html(user_ref);
                                
                                $('.member-type').each(function () {

                                    // Cache the number of options
                                    var $this = $(this),
                                        numberOfOptions = $(this).children('option').length;
                                
                                    // Hides the select element
                                    $this.addClass('s-hidden');
                                
                                    // Wrap the select element in a div
                                    $this.wrap('<div class="newselect"></div>');
                                
                                    // Insert a styled div to sit over the top of the hidden select element
                                    $this.after('<div class="styledSelect"></div>');
                                
                                    // Cache the styled div
                                    var $styledSelect = $this.next('div.styledSelect');
                                
                                    // Show the first select option in the styled div
                                    $styledSelect.text($this.children('option').eq(0).text());
                                
                                    // Insert an unordered list after the styled div and also cache the list
                                    var $list = $('<ul />', {
                                        'class': 'options newoptions'
                                    }).insertAfter($styledSelect);
                                
                                    // Insert a list item into the unordered list for each select option
                                    for (var i = 0; i < numberOfOptions; i++) {
                                        $('<li />', {
                                            text: $this.children('option').eq(i).text(),
                                            rel: $this.children('option').eq(i).val()
                                        }).appendTo($list);
                                    }
                                
                                    // Cache the list items
                                    var $listItems = $list.children('li');
                                
                                    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
                                    $styledSelect.click(function (e) {
                                        e.stopPropagation();
                                        $('div.styledSelect.active').each(function () {
                                            $(this).removeClass('active').next('ul.options').hide();
                                        });
                                        $(this).toggleClass('active').next('ul.options').toggle();
                                    });
                                
                                    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
                                    // Updates the select element to have the value of the equivalent option
                                    $listItems.click(function (e) {
                                        e.stopPropagation();
                                        $styledSelect.text($(this).text()).removeClass('active');
                                        $this.val($(this).attr('rel'));
                                        $list.hide();
                                        
                                        checkMembership($this.val());
                                        
                                        / alert($this.val()); Uncomment this for demonstration! /
                                    });
                                
                                    // Hides the unordered list when clicking outside of it
                                    $(document).click(function () {
                                        $styledSelect.removeClass('active');
                                        $list.hide();
                                    });
                                });
                            }
                            else {
                                
                            }
                        }
                    });
                    
                    //user_ref += '<div class="form-group"> <input class="form-control" name="referral_code" type="text" placeholder="Enter Referral Code"> </div>';
                    //user_ref += '<div class="form-group"><div class="no-referral"><div class="no-referral-input"><input type="checkbox" id="no_referal_code" name="no_referal_code" ></div><div class="no-referral-label">I have no referral code. Please send me invitation</div></div></div>';
                    
                }else{
                    $("#dv-member-type").remove();
                    $("#dv_referral").remove();
                    $("input[name='email']").parent('.form-group').addClass('mg-top');
                    $('.user_ref').css('margin-top', '0px');
                }
                //console.log(user_ref);
                //$('.user_ref').html(user_ref);
                
                
            });
            
            var chk_date = '';
            var dt = new Date();
            var t_chk_v_year = dt.getFullYear(); 
            var t_chk_v_month = dt.getMonth(); 
            var t_chk_v_day = dt.getDate(); 
            chk_date = new Date(t_chk_v_year,t_chk_v_month,t_chk_v_day)
            
            var dt_out = new Date(dt);
            dt_out.setDate(dt.getDate()+1);
            //dt_out.toLocaleDateString();
            
            //var chk_out_date = '';            
            //var dt_out = new Date(dt_out);
            var t_chk_v_out_year = dt_out.getFullYear(); 
            var t_chk_v_out_month = dt_out.getMonth(); 
            var t_chk_v_out_day = dt_out.getDate(); 
            chk_out_date = new Date(t_chk_v_out_year,t_chk_v_out_month,t_chk_v_out_day);
            
            
            //console.log(chk_date+"-"+chk_out_date);            
            
            @if(!empty(Session::get("arrive")))
                chk_date = '{{Session::get("arrive")}}';
            @else 
                chk_date = chk_date;            
            @endif
            
            @if(!empty(Session::get("departure")))
                chk_out_date = '{{Session::get("departure")}}'; 
            @else  
                chk_out_date = chk_out_date;
            @endif
            
            //console.log(chk_date+"-"+chk_out_date);              
                                    
            $('#t-topbar-picker').tDatePicker({
                'numCalendar':'2',
                'autoClose':true,
                'durationArrowTop':'200',
                'formatDate':'mm-dd-yyyy',
                'titleCheckIn':'Arrival',
                'titleCheckOut':'Departure',
                'inputNameCheckIn':'arrive',
                'inputNameCheckOut':'departure',
                'titleDateRange':'days',
                'titleDateRanges':'days',
                'iconDate':'<i class="fa fa-calendar"></i>',
                'limitDateRanges':'365',
                'dateCheckIn':chk_date,
                'dateCheckOut':chk_out_date               
                //'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                //'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
            }).on('afterCheckOut',function(e, dateCO) {
                if(((typeof $(this).closest('form').find('[name="adult"]').val()) != 'undefined') && ((typeof $(this).closest('form').find('[name="adult"]').val()) != undefined)){
                    $(this).closest('form').find('[name="adult"]').focus();
                }
            });
            
            @if(!empty(Session::get("arrive")))
                chk_date2 = '{{Session::get("arrive")}}';
            @else 
                chk_date2 = chk_date;            
            @endif
            
            @if(!empty(Session::get("departure")))
                chk_out_date2 = '{{Session::get("departure")}}'; 
            @else  
                chk_out_date2 = chk_out_date;
            @endif
            
            $('#t-sidebar-picker').tDatePicker({
                'numCalendar':'1',
                'autoClose':true,
                'durationArrowTop':'200',
                'formatDate':'mm-dd-yyyy',
                'titleCheckIn':'Arrival',
                'titleCheckOut':'Departure',
                'inputNameCheckIn':'arrive',
                'inputNameCheckOut':'departure',
                'titleDateRange':'days',
                'titleDateRanges':'days',
                'iconDate':'<i class="fa fa-calendar"></i>',
                'limitDateRanges':'365',
                'dateCheckIn':chk_date2,
                'dateCheckOut':chk_out_date2
                
                //'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                //'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
            });
            
            // Open Left Navigation For Search By Date on Page Load
            @if(isset($_GET['action']) && $_GET['action']=='bydate' )
            $('[data-action="search-by-date"]').trigger('click');
            @endif

            // Open Left Navigation For Collection on Page Load
            @if(Request::segment(1)=='luxurytravel' && Request::segment(2)=='Hotel')
            $('[data-action="select-collection"]').trigger('click');
            @endif

            // Open Left Navigation For Experience on Page Load
           // Open Left Navigation For Experience on Page Load
            @if(Request::segment(1)=='luxury_experience')

                  hideAllOption();

                   var datObj = {};
                    datObj.catID = '{{$destination_category}}';
                  var params = $.extend({}, doAjax_params_default);
                  params['url'] = BaseURL + '/destination/experiences-ajax';
                   params['data'] = datObj;
                  params['successCallbackFunction'] = renderExperience;
                  doAjax(params);
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
                var ref_url = $("input[name=ref_page]").val(); 
                
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{URL::to('customer_ajaxPostSignin')}}",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    success: function (data, textStatus, jqXHR) {
                        if (data.status == 'success') {
                            if(data.gid==3){
                                if(ref_url!='undefined' && ref_url!=''){
                                    window.location.href = ref_url;    
                                }else{
                                //console.log(data.new_user);
                                    if(data.new_user=='1'){
                                        window.location.href = "{{URL::to('traveller')}}";
                                    }else{
                                        window.location.href = "{{URL::to('dashboard')}}";
                                    }
                                }
                            }else{
                                if(ref_url!='undefined' && ref_url!=''){
                                    window.location.href = ref_url;    
                                }else{
                                    window.location.href = "{{URL::to('dashboard')}}";
                                }
                            }
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
                
                if($("#no_referal_code").is(':checked')){                    
                    var email = $("#customerRegisterarioForm input[name='email']").val();
                    if(email==''){
                        $("#email-error-msg").removeClass('hide');
                        $("#customerRegisterarioForm input[name='email']").addClass('email-error');
                        return false
                    }
                    event.preventDefault();
    
                    $(".ai-sign-up-form-success-msg").html('');
                    $(".ai-sign-up-form-error-msg").html('');
                    $(".ai-login-form-success-msg").html('');
    
                    var formData = $(this).serialize();
    
                    $.ajax({
                        url: "{{URL::to('customer_request_referral')}}",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        success: function (data, textStatus, jqXHR) {
    
    
                            if (data.status == 'success') {
                                $(".ai-sign-up-form-error-msg").html(data.message);                                
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
                }else{
                
                    var tobje = $("#txtmobileNumber").closest('.form-group').find('#error-msg');
                    //if(((typeof tobje.html()) != 'undefined') && ((typeof tobje.html()) != undefined)){tobje.html('Invalid number');}
                    var countryData = $("#txtmobileNumber").intlTelInput("getSelectedCountryData");
    
                    var error = $("#txtmobileNumber").intlTelInput("getValidationError");
                    var isValid = $("#txtmobileNumber").intlTelInput("isValidNumber");
    
                    if (isValid) {
                        $("#txtmobileDialcode").val(countryData.dialCode);
                    } else {
                        if(((typeof tobje.html()) != 'undefined') && ((typeof tobje.html()) != undefined) && ($("#txtmobileNumber").val().length <= 0)){
                            //tobje.html('This field is required.');
                            tobje.removeClass('hide');
                        }
                        $("#txtmobileNumber").addClass('error');
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
                                //window.location.href = "{{URL::to('whoiam')}}";
                                if(data.gid==3){
                                    window.location.href = "{{URL::to('traveller')}}";
                                }else{
                                    window.location.href = "{{URL::to('dashboard')}}";
                                }
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
                }
            });



        });


        var telInput = $("#txtmobileNumber"),
            errorMsg = $("#error-msg"),
            validMsg = $("#valid-msg");
        // initialise plugin
        telInput.intlTelInput({
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "";
                  callback(countryCode);
                });
            },
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
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="760dec3f-be0e-4331-bd80-0c07fb2f2e1e" type="text/javascript" async></script>
<style>
.popover>.popover-title{
    font-size:13px;
    color:#000;
}
.popover>.popover-content{
    color:#a94442;
}
.popover.primary {
    border-color:#337ab7;
}
.popover.primary>.arrow {
    border-top-color:#337ab7;
}
.popover.primary>.popover-title {
    color:#fff;
    background-color:#337ab7;
    border-color:#337ab7;
}
.popover.primary.min_char>.popover-content>.pass_8{
    color:#337ab7;
}
.popover.primary.upper_char>.popover-content>.upper_case{
    color:#337ab7;
}
.popover.primary.spec_char>.non_alpha{
    color:#337ab7;
}
.popover.success {
    border-color:#d6e9c6;
}
.popover.success>.arrow {
    border-top-color:#d6e9c6;
}
.popover.success>.popover-title {
    color:#3c763d;
    background-color:#dff0d8;
    border-color:#d6e9c6;
}
.popover.success.min_char>.popover-content>.pass_8{
    color:#3c763d;
}
.popover.success.upper_char>.popover-content>.upper_case{
    color:#3c763d;
}
.popover.success.spec_char>.popover-content>.non_alpha{
    color:#3c763d;
}
.popover.info {
    border-color:#bce8f1;
}
.popover.info>.arrow {
    border-top-color:#bce8f1;
}
.popover.info>.popover-title {
    color:#31708f;
    background-color:#d9edf7;
    border-color:#bce8f1;
}
.popover.info.min_char>.popover-content>.pass_8{
    color:#31708f;
}
.popover.info.upper_char>.popover-content>.upper_case{
    color:#31708f;
}
.popover.info.spec_char>.non_alpha{
    color:#31708f;
}
.popover.warning {
    border-color:#faebcc;
}
.popover.warning>.arrow {
    border-top-color:#faebcc;
}
.popover.warning>.popover-title {
    color:#8a6d3b;
    background-color:#fcf8e3;
    border-color:#faebcc;
}
.popover.warning.min_char>.popover-content>.pass_8{
    color:#8a6d3b;
}
.popover.warning..upper_char>.popover-content>.upper_case{
    color:#8a6d3b;
}
.popover.warning.spec_char>.non_alpha{
    color:#8a6d3b;
}
.popover.danger {
    border-color:#ebccd1;
}
.popover.danger>.arrow {
    border-top-color:#ebccd1;
}
.popover.danger>.popover-title {
    color:#a94442;
    background-color:#f2dede;
    border-color:#ebccd1;
}
.popover.danger.min_char>.popover-content>.pass_8{
    color:#a94442;
}
.popover.danger.upper_char>.popover-content>.upper_case{
    color:#a94442;
}
.popover.danger.spec_char>.non_alpha{
    color:#a94442;
}

</style>
<script>
$(document).ready(function(){

//var special_character = /^[a-zA-Z!”$%&’()*\+,\/;\[\\\]\^_`{|}~]+$/;
//var special_character = /^(?=\S*?[_@./#&+-])\S{1,}$/;
//minimum 8 characters
var bad = /(?=.{8,}).*/;
//1 Uppercase
var good = /^(?=\S*?[A-Z])\S.*$/;
//Alpha Numeric plus minimum 8
//var good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
//Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
//var better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/;
//Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
var best = /^(?=\S*?[^\w\*])\S.*$/;

$('#password').on('keyup', function () {
    var password = $(this);
    var pass = password.val();
    var passLabel = $('[for="password"]');
    var stength = '';
    var pclass = '';
    var pclass_min_char = '';
    
    var tcal = "";
    var rem_class = '';
    if(good.test(pass) == true){
        pclass = 'success';
        tcal = 'upper_char ';
    }
    else{
        rem_class += 'upper_char ';
    }
    pclass_min_char += tcal;
    
    tcal = "";
    if(bad.test(pass) == true){
        pclass = 'success';
        tcal = 'min_char ';
    }
    else{
        rem_class += 'min_char ';
    }
    pclass_min_char += tcal;
    
    tcal = "";
    if(best.test(pass) == true){
        pclass = 'success';
        tcal = 'spec_char';
    }
    else{
        rem_class += 'spec_char ';
    }
    pclass_min_char += tcal;
    
    
    /*var stength = 'Weak';
    var pclass = 'danger';
    if (best.test(pass) == true) {
        stength = 'Very Strong';
        pclass = 'success';
    } else if (better.test(pass) == true) {
        stength = 'Strong';
        pclass = 'warning';
    } else if (good.test(pass) == true) {
        stength = 'Almost Strong';
        pclass = 'warning';
    } else if (bad.test(pass) == true) {
        stength = 'Weak';
    } else {
        stength = 'Very Weak';
    }*/

    var popover = password.attr('data-content', stength).data('bs.popover');
    //var popover = password.data('bs.popover');
    //popover.setContent();
    popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);
    popover.$tip.addClass(popover.options.placement).addClass(pclass_min_char);
    popover.$tip.addClass(popover.options.placement).removeClass(rem_class);

});

$('input[data-toggle="popover"]').popover({
    placement: 'bottom',
    trigger: 'focus'
});

})</script>
</body>
</html>
