<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content=" @yield('robots')">
    <meta name="keywords" content=" {{ CNF_APPNAME }}, @yield('meta_keywords') ">
    <meta name="description" content=" {{ CNF_APPNAME }} - @yield('meta_description') ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> {{ CNF_APPNAME }} - @yield('meta_title') </title>
    
    
    
    
    @yield('meta_link_sitemap')
    
    <meta property="og:url" content="@yield('og_url')" />
    <meta property="og:title" content="@yield('og_title')" />
    <meta property="og:description" content="@yield('og_description')" />
    <meta property="og:type" content="@yield('og_type')" />
    <!--<meta property="og:image" content="@yield('og_image')" />
    <meta property="og:image:width" content="@yield('og_image_width')" />
    <meta property="og:image:height" content="@yield('og_image_height')" /> -->
    @yield('og_image')
    <meta property="og:site_name" content="@yield('og_sitename')" />
    <meta property="og:locale" content="@yield('og_locale')" />
    
    <meta property="article:section" content="@yield('article_section')" />
    @yield('article_tags')
    
    <meta property="twitter:url" content="@yield('twitter_url')" />
    <meta property="twitter:title" content="@yield('twitter_title')" />
    <meta property="twitter:description" content="@yield('twitter_description')" />
    @yield('twitter_image')
    <meta property="twitter:domain" content="@yield('twitter_domain')" />
    <meta property="twitter:card" content="@yield('twitter_card')" />
    <meta property="twitter:creator" content="@yield('twitter_creator')" />
    <meta property="twitter:site" content="@yield('twitter_site')" />
    <script type="application/ld+json">
    @yield('jsonld')
    </script> 
    
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    
    <!-- Web Application Manifest -->
    <link rel="manifest" href="manifest.json">

    
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
    
    <link rel="stylesheet" href="{{ asset('themes/EC/css/styles.css') }}">
    
    <!-- tilt css include -->
    <!-- end of tilt css include -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    {{--For Include and Add Files in Head --}}     
    @section('head')
        @parent        
    @show

    {{--For Custom Styles --}}
    @section('custom_css')
        @parent
        
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

@if(defined('CNF_HUBSPOT_SCRIPT'))
    @if(CNF_HUBSPOT_SCRIPT != '')
    <!-- Start of HubSpot Embed Code -->
    {!! CNF_HUBSPOT_SCRIPT !!}
    <!-- End of HubSpot Embed Code -->
    @endif
@endif
</head>
<body>
    @section('header')
        @parent
        @include('frontend.themes.EC.layouts.sections.header')
    @show
    @yield('content')
{{-- Site Base URL --}}
<script type="text/javascript">var BaseURL = '{{ url() }}'; </script>    
<script type="text/javascript" src="{{ asset('themes/EC/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/jqueryui/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/daterangepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/jquery.mousewheel.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/simpleLightbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/mediaelement-and-player.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/jquery.rangecalendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/fullcalendar/core/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/fullcalendar/daygrid/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('themes/EC/js/plugin/wow.min.js') }}"></script>

<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lg-thumbnail.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/lightbox/js/lg-share.js') }}"></script>
<script src="{{ asset('themes/EC/js/plugin/rellax.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('themes/EC/js/all.js') }}"></script>

  <script>
    var picker = $('#daterangepicker-inline').daterangepicker({
      parentEl: "#daterangepicker-inline-container",
      autoApply: true,
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear',
      }
    });

    picker.on('apply.daterangepicker', function (ev, picker) {
      $('.onrange').html(picker.startDate.format('DD-MM-YYYY') + ' -> ' + picker.endDate.format('DD-MM-YYYY'));
      $('input[name="gl_arrive"]').val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name="gl_departure"]').val(picker.endDate.format('DD-MM-YYYY'));
      $('.include-form').fadeIn("fast");
    });
    picker.data('daterangepicker').hide = function () { };
    picker.data('daterangepicker').show();
  </script>
</body>
</html>
