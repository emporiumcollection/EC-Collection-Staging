<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{ CNF_APPNAME }} </title>
        <meta name="keywords" content="">
        <meta name="description" content=""/>
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

        <!--Style Includes-->
        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/dashboard.css')}}" rel="stylesheet" type="text/css"/>

        <!--JS Includes-->
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <header>
                        <div class="main-dashboard-header">
                            <nav class="navbar navbar-inverse dash-top-header-style-align">
                                <ul class="nav navbar-nav left-nav-align">
                                    <li class="">
                                        <a href="javascript:void(0);">
                                            <div class="header-icons-style"><i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="header-icons-style"><i class="fa fa-star-o" aria-hidden="true"></i></div><span>Favorites</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="header-icons-style"><i class="fa fa-rocket" aria-hidden="true"></i></div><span>Service</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="header-icons-style"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div><span>Magazine</span>
                                        </a>
                                    </li>
                                    <li class="<?php echo (isset($active_menu) && $active_menu == 'bookings')? 'active' : ''; ?>">
                                        <a href="{{URL::to('bookings')}}">
                                            <div class="header-icons-style"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div><span>Bookings</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right nav-right-login-align">
                                    <li>
                                        <div class="user-image"><img class="img-responsive" src="{{ asset('sximo/assets/images/default.png')}}" alt=""/></div>
                                        <div class="user-drop-down">
                                            <div class="dropdown">
                                                <button class="btn user-btn basic-btn-nav-style btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{ Session::get('fid') }} <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ URL::to('customer/profile')}}">{{ Lang::get('core.m_profile') }}</a></li>
                                                    <li><a href="{{ URL::to('customer/logout')}}">{{ Lang::get('core.m_logout') }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn basic-btn-nav-style btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Help <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0);">Technical Support</a></li>
                                                <li><a href="{{ URL::to('')}}">Frontend</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="referal-btn"><a href="javascript:void(0);">Referal</a></li>
                                </ul>
                            </nav>
                        </div>
                    </header>
                    <div class="after-header-container-align">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>