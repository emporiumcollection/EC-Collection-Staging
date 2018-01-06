<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emporium Yachts Membership Portal</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

        <!--Style Includes-->

        <link href="{{ asset('sximo/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/jquery-ui.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/filters_grid.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/dashboard.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('sximo/assets/css/new-login.css')}}" rel="stylesheet" type="text/css"/>

        <!--JS Includes-->
        <script src="{{ asset('sximo/assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{ asset('sximo/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <section id="login-video">
                        <div class="container">
                            <div class="dl-login-form-bg">
                                @if(Session::has('message'))
                                        {!! Session::get('message') !!}
                                @endif
                                <ul class="parsley-error-list">
                                        @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                        @endforeach
                                </ul>
                                <div class="login-form-container">
                                    <div class="dl-form-heading">
                                        <h2>{{ Lang::get('core.signin') }}</h2>
                                    </div>
                                    <form method="post" action="{{ url('customer/signin')}}" class="form-vertical">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="input-group form-input-align">
                                            <input type="text" name="email" class="new-login-input-style form-control" placeholder="{{ Lang::get('core.email') }}" required>
                                            <span class="input-group-addon form-forgot-pass"></span>
                                        </div>
                                        <div class="input-group form-input-align">
                                            <input class="new-login-input-style form-control" type="password" name="password" placeholder="{{ Lang::get('core.password') }}" required>
                                            <span class="input-group-addon form-forgot-pass"><a class="forgot-password-btn" href="#">Forgot?</a></span>
                                        </div>
                                        <div class="checkbox login-checkbox-align">
                                            <label><input class="checkbox-text-align" value="1" type="checkbox" name="remember"> Stay Logged In</label>
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
                                        @if(CNF_MULTILANG =='1')
                                        <div class="hidden">
                                                <label class="text-left"> {{ Lang::get('core.language') }} </label>	
                                                <select class="form-control" name="language">
                                                        @foreach(SiteHelpers::langOption() as $lang)
                                                        <option value="{{ $lang['folder'] }}" @if(Session::get('lang') ==$lang['folder']) selected @endif>  {{  $lang['name'] }}</option>
                                                        @endforeach

                                                </select>	

                                                <div class="clr"></div>
                                        </div>
                                        @endif
                                        <button type="submit" class="btn btn-default login-btn-style">{{ Lang::get('core.signin') }}</button>
                                    </form>
                                    <div>
                                        <p class="login-not-sign-up"><span class="login-not-sign-up-link"><a href="{{ URL::to('')}}"> {{ Lang::get('core.backtosite') }} </a></span></p>
                                    </div>
                                </div>
                                <div style="display: none;" class="forgot-password-form-container">
                                    <div class="dl-form-heading">
                                        <h2>{{ Lang::get('core.forgotpassword') }}</h2>
                                    </div>
                                    <form method="post" action="{{ url('customer/request')}}" class="form-vertical">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="input-group form-input-align">
                                            <input type="text" name="credit_email" class="new-login-input-style form-control" placeholder="{{ Lang::get('core.enteremailforgot') }}" required>
                                            <span class="input-group-addon form-forgot-pass"></span>
                                        </div>
                                        <button type="submit" class="btn btn-default login-btn-style">{{ Lang::get('core.sb_submit') }}</button>
                                    </form>
                                    <div>
                                        <p class="login-not-sign-up"><span class="login-not-sign-up-link"><a class="login-btn" href="#">Click Here To {{ Lang::get('core.signin') }}</a></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <video autoplay="autoplay" loop="loop">
                            <source src="{{ asset('sximo/assets/video/login-bg.mp4')}}" type="video/mp4" /> 
                        </video>
                    </section>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $(".forgot-password-btn").click(function ( event ) {
                    event.preventDefault();
                    $(".login-form-container").fadeOut();
                    $(".forgot-password-form-container").fadeIn();
                });
                $(".login-btn").click(function ( event ) {
                    event.preventDefault();
                    $(".login-form-container").fadeIn();
                    $(".forgot-password-form-container").fadeOut();
                });
            });
        </script>
    </body>
</html>