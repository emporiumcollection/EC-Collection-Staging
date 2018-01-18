<style>
    .forgot-pass-form-show-hide{
        display:none;
    }
    .create-account-form-show-hide{
        display:none;
    }
    .account-with-us-show-hide{
        display:none;
    }
</style>

<!--Login and Sign Up Pop-up HTML-->

<!--Register Pop Up Start Here main-->
<div id="register-popup" class="popup personlized-service-pop-up-outer">
    <div class="popup-inner personlized-service-pop-up">
        <a href="#" class="popup-close-btn personlized-service-pop-up-close-btn">&times;</a>
        <!--Register Pop Up Start Here main--><div class="popup-content personlized-service-content">
            <div class="popup-form-center">
                <div class="form-tittle">
                    <h3>JohnnyShares - Sharing & Collaboration Platform</h3>
                </div> 
                <div class="form-content clearfix">
                    <div class="form-logo">
                        <img class="img-responsive" src="{{ asset('sximo/assets/images/logo-design_1.png')}}" alt="Design Locations">
                    </div>
                    <div>
                        <ul class="navigation-tabs">
                            <li><a href="#" class="active" id="sign-in-form-link">Sign in</a></li>
                            <li><a href="#" id="forgot-password-link">Forgot Password</a></li>
                            <li><a href="#" id="register-form-link">Register</a></li>
                        </ul>
                    </div>
                    <div class="input-fileds">
                        <form  id="login-form" role="form" style="display: none;">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                <i class="fa fa-user input-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input placeholder="Password" type="Password" name="password"  class="form-control">
                                <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label> Remember Me ? </label>
                                <input class="remember-me-checkbox" name="remember" value="1" type="checkbox">
                                <i class="fa fa-lock input-fa remember-me-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label>Language</label>
                                <select class="form-control" name="language">
                                    <option value="Deutsch"> Deutsch</option>
                                    <option value="en"> English</option>
                                </select>
                            </div>
                            <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Sign In</button>
                        </form>
                        <form id="register-form" role="form" style="display: block;">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="user_name" placeholder="Name" class="form-control">
                                <i class="fa fa-user input-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                <i class="fa fa-user input-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input placeholder="Password" type="Password" name="password"  class="form-control">
                                <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input placeholder="Confirm Password" type="Password" name="password"  class="form-control">
                                <i class="fa fa-lock input-fa" aria-hidden="true"></i>
                            </div>
                            <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Sign Up</button>
                        </form>
                        <form id="forgot-password" role="form" style="display: none;">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" name="email_address" placeholder="Email Address" class="form-control">
                                <i class="fa fa-user input-fa" aria-hidden="true"></i>
                            </div>
                            <button class="btn btn-info form-sign-in-btn btn-sm btn-block" type="submit">Recover Account</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--Register Pop Up End Here main-->
<!--New Login Pop Up Start Here main-->
<div id="login-forms-popup" class="popup login-form-pop-main-align">
    <div class="popup-inner">
        <a href="#" class="popup-close-btn">&times;</a>
        <div class="popup-content">
            <div class="content-area">
<!--                         <a class="dl-pop-logo-align" href="#"><img class="img-responsive" src="{{ asset('sximo/assets/images/design-location-logo.png')}}"></a>-->
            </div>
            <!--Login Forms Start Here-->
            <div class="landing-page-lock-login-btn-outer-align">
                <div class="login-form-show-hide" style="display:block;">
                    <div class="login-sign-up-sidebar-outer-align">
                        <div class="your-account-heading-align">
                            <div class="ps-login-signup-form-top-bar">
                                <!--                                         <div class="col-md-6 col-sm-6">
                                                                             <div class="row">
                                                                                 <div class="ps-forms-cross-icons">
                                                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                                                 </div>
                                                                             </div>
                                                                         </div>-->
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="right-need-help-icon">
                                            <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-login-signup-form-top-bar1">
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="ps-forms-cross-icons">
                                            <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ps-form-main-pannel">
                                <div class="ps-form-heading-outer-align">
                                    <div class="ps-big-form-heading">Login With</div>
                                    <div class="ps-big-form-heading">Your Account</div>
                                </div>
                                <div class="ai-login-form-success-msg"></div>
                                <form class="ps-login-sign-form-pannel" action="{{URL::to('customer/signin')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group ps-form-group-outer">
                                        <input class="form-control ps-login-form-input" name="email" type="text" placeholder="Email Address" required="email" />
                                    </div>
                                    <div class="input-group ps-form-group-outer">
                                        <input class="form-control ps-login-form-input" name="password" placeholder="Password" type="password" required="true" >
                                        <span class="input-group-addon login-forgot-pass-align"><a class="ps-forms-small-heading-link forgot-pass-show-form-btn" href="javascript:void(0)">Forgot?</a></span>
                                    </div>
                                    <div class="ps-login-sign-submit-btn">
                                        <button type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ps-login-sign-up-image">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/angel-fernandez-alonso-220762.jpg')}}" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="forgot-pass-form-show-hide">
                    <div class="login-sign-up-sidebar-outer-align">
                        <div class="your-account-heading-align">
                            <div class="ps-login-signup-form-top-bar">
                                <!--                                         <div class="col-md-6 col-sm-6">
                                                                             <div class="row">
                                                                                 <div class="ps-forms-cross-icons">
                                                                                     <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                                                 </div>
                                                                             </div>
                                                                         </div>-->
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="right-need-help-icon">
                                            <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-login-signup-form-top-bar1">
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="ps-forms-cross-icons">
                                            <a class="show-account-with-us ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ps-form-main-pannel">
                                <div class="ps-form-heading-outer-align">
                                    <div class="ps-big-form-heading">Forgot Your</div>
                                    <div class="ps-big-form-heading">Password</div>
                                    <p class="form-white-samml-des-text">Enter your email and you will get Instructions to reset your password</p>
                                </div>
                                <form class="ps-login-sign-form-pannel" action="{{ url('customer/request')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group ps-form-group-outer">
                                        <input class="form-control ps-login-form-input" name="credit_email" type="text" placeholder="Email Address" required>
                                    </div>
                                    <div class="ps-login-sign-submit-btn">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ps-login-sign-up-image">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/Kootenay Aurora 1-X3.jpg')}}" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="create-account-form-show-hide">
                    <div class="login-sign-up-sidebar-outer-align">
                        <div class="your-account-heading-align">
                            <div class="ps-login-signup-form-top-bar">
                                <!--                                         <div class="col-md-6 col-sm-6">
                                                                             <div class="row">
                                                                                 <div class="ps-forms-cross-icons1">
                                                                                     <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                                                                 </div>
                                                                             </div>
                                                                         </div>-->
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="right-need-help-icon">
                                            <a class="ps-forms-small-heading-link" href="#">Need Help?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ps-login-signup-form-top-bar1">
                                <div class="col-md-12 col-sm-6">
                                    <div class="row">
                                        <div class="ps-forms-cross-icons">
                                            <a class="show-account-with-us  ps-forms-small-heading-link" href="javascript:void(0)">&times;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ps-form-main-pannel">
                                <div class="ps-form-heading-outer-align">
                                    <div class="ps-big-form-heading">Create Your Account</div>
                                    <div class="ps-big-form-heading">Password</div>
                                </div>
                                <div class="ai-sign-up-form-error-msg"></div>
                                <form class="ai-sign-up-form ps-login-sign-form-pannel" action="{{ url('customer/create')}}" method="POST">
                                    <div class="form-group ps-form-group-outer">
                                        <input class="form-control ps-login-form-input" name="email" type="text" placeholder="Email Address">
                                    </div>
                                    <div class="form-group ps-form-group-outer">
                                        <input class="form-control ps-login-form-input" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="ps-login-sign-submit-btn">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ps-login-sign-up-image">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/matthew-kane-365718.jpg')}}" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="">
                    <div class="login-sign-up-sidebar-outer-align account-with-us-show-hide">
                        <div class="your-account-heading-align">
                            <h2>Your Account With Us</h2>
                        </div>
                        <div class="ps-login-sign-up-image">
                            <img class="img-responsive" src="{{ asset('sximo/assets/images/Step.jpg')}}" alt=""/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ps-login-sign-up-main-pannel">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row">
                                <a class="ps-login-sign-up-common ps-sign-up-btn sign-up-show-form-btn" href="javascript:void(0)">Sign Up</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row">
                                <a class="ps-login-sign-up-common  login-show-form-btn" href="javascript:void(0)">Log In</a>
                            </div>
                        </div>
                        <div class="sign-in-with-fb-tab">
                            <a class="ps-login-sign-up-common" href="javascript:void(0)">Sign In With LinkedIn</a>
                        </div>
                    </div>
                </div>
                <!--Login Forms End Here-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--New Login Pop Up End Here main-->

<script>
    $(document).ready(function () {
        /*Login form Scripts*/
        $(".sign-up-show-form-btn").click(function () {
            $(".create-account-form-show-hide").show();
            $(".account-with-us-show-hide").hide();
            $(".login-form-show-hide").hide();
            $(".forgot-pass-form-show-hide").hide();
        });
        $(".login-show-form-btn").click(function () {
            $(".login-form-show-hide").show();
            $(".account-with-us-show-hide").hide();
            $(".create-account-form-show-hide").hide();
            $(".forgot-pass-form-show-hide").hide();
        });
        $(".forgot-pass-show-form-btn").click(function () {
            $(".forgot-pass-form-show-hide").show();
            $(".login-form-show-hide").hide();
            $(".account-with-us-show-hide").hide();
            $(".create-account-form-show-hide").hide();
        });
        $(".show-account-with-us").click(function () {
            $(".account-with-us-show-hide").show();
            $(".forgot-pass-form-show-hide").hide();
            $(".login-form-show-hide").hide();
            $(".create-account-form-show-hide").hide();
        });
        
        $(".ai-sign-up-form").submit(function( event ) {
            event.preventDefault();
            
            $(".ai-sign-up-form-error-msg").html( '' );
            $(".ai-login-form-success-msg").html( '' );
            
            var formData = $(this).serialize();
            
            $.ajax({
                url: "{{URL::to('customer_ajaxPostCreate')}}",
                type: "POST",
                dataType: "json",
                data: formData,
                success: function (data, textStatus, jqXHR) {
                    if(data.status == 'success') {
                        $(".ai-login-form-success-msg").html( data.message );
                        $(".login-form-show-hide").show();
                        $(".account-with-us-show-hide").hide();
                        $(".create-account-form-show-hide").hide();
                        $(".forgot-pass-form-show-hide").hide();
                    }
                    else {
                        var message = data.message;
                        for(var i = 0; i < data.errors.length; i++) {
                            message += '<br>' + data.errors[i];
                        }
                        $(".ai-sign-up-form-error-msg").html( message );
                    }
                }
            });
        });
        
    });
</script>