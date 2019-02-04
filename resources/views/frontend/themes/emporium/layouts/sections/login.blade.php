 <!-- login signup popup starts here -->
      <div class="popupMainDiv">
         <div class="rightSideSec">
            <div class="popupTopSec"><a href="javascript:void(0);" class="mainPopupClose">×</a></div>
            <img src="{{ asset('themes/emporium/images/emporium-voyage-membership.jpg')}}" alt="Images">
            <div class="accountContent">
               <h2>Your Account With Us</h2>
            </div>
            <div class="popupFooterSec">
               <ul>
                  <li class="col-xs-6"><a class="signInPopupButton" href="javascript:void(0);">Member Sign Up</a></li>
                  <li class="col-xs-6"><a class="logInPopupButton" href="javascript:void(0);">Member Log In</a></li>
                  <li class="col-xs-12"><a href="javascript:void(0);" class="logInPopupButton">Advertiser Login</a></li>
               </ul>
            </div>
            <div class="logInPopup lognSignPopoUp">
               <div class="popupTopSec"><span>Need Help?</span><a href="javascript:void(0);" class="mainPopupClose">×</a></div>
               <img src="{{ asset('themes/emporium/images/emporium-voyage-login.jpg')}}" alt="Images">
               <div class="loginFormDiv">
                  <h2>Members Club<br>Login</h2>

                 <div class="ai-login-form-success-msg"></div>
                 <div class="ai-login-form-error-msg"></div>
                 <form  action="{{URL::to('customer/signin')}}" id="loginFormAction" method="POST">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="Email Address" required="email" />

                     </div>
                     <div class="form-group password-div">
                        <input class="form-control" name="password" placeholder="Password" type="password" required="true" >
                        <a class="forgetPassBtn" href="javascript:void(0);">FORGOT?</a>
                     </div>
                     <button class="button" type="submit">Log In</button>
                  </form>
               </div>
            </div>
            
            <div class="signInPopup lognSignPopoUp">
                <form  action="{{ url('customer/create')}}" method="POST" id="customerRegisterarioForm">
                
               <div class="popupTopSec"><span>NEED HELP?</span><a href="javascript:void(0);" class="mainPopupClose">×</a></div>

               <img src="{{ asset('themes/emporium/images/emporium-voyage-membership.jpg')}}" alt="Images">
               <div class="loginFormDiv sign-top-margin">
                  <h3>Welcome to the Emporium Voyage Members Club</h3> 
                  <div class="ai-sign-up-form-error-msg"></div>
                  <div class="ai-sign-up-form-success-msg"></div>
                  <div class="reltv">
                  <select name="user_type" class="user-type" id="sel-user-type">
                     <option value="">I am:</option>
                     <option value="{!! CommonHelper::getusertype('hotel-b2b') !!}">Luxury Hotel</option>
                     <option value="{!! CommonHelper::getusertype('users-b2c') !!}">Luxury Traveler</option>
                     <option value="{!! CommonHelper::getusertype('advertiser-b2b') !!}">Bespoke Advertiser</option>
                  </select>
                  </div>
                  
                  <div class="user_ref"></div>
                  <div class="form-group mg-top" id="hd-email">
                        <input class="form-control" name="email" type="text" placeholder="Email Address">
                        <span id="email-error-msg" class="hide">Required</span>                        
                  </div>
                  <div class="form-group">
                        <input type="hidden" id="txtmobileDialcode" name="txtmobileDialcode">
                        <input class="form-control"  name="txtmobileNumber" id="txtmobileNumber" type="tel" >
                        <span id="valid-msg" class="hide">✓ Valid</span>
                        <span id="error-msg" class="hide">Invalid number</span>
                  </div>
                  <?php /*<div class="ai-sign-up-form-password-hint">
                    Password must be 8 character.<br />Must be one uppercase character.<br />Must be one Non-alphanumeric (!, @, # etc.) character.                    
                  </div>*/ ?>
                  <div class="form-group">
                        
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" data-html="true" data-toggle="popover" data-placement="top" title="Requirements for new password" data-html="true" data-content="<div class='pass_8'>Password must be 8 character.</div> <div class='upper_case'>&#13;Must be one uppercase character.</div> <div class='non_alpha'>&#13;Must be one Non-alphanumeric (!, @, # etc.) character.</div>">
                  </div>
                  <div class="login-agree-text">
                    By clicking on the become a member button, you agree to our terms and conditions default communication & privacy preferences.
                  </div>
                  <button class="button" type="submit">Become a <span id="sp-mem-type">Bespoke</span> Member</button>
                  
               </div>
               </form>
            </div>
            
            <div class="forgetPassPopup lognSignPopoUp">
               <div class="popupTopSec"><span>NEED HELP?</span><a href="javascript:void(0);" class="mainPopupClose">×</a></div>

               <img src="{{ asset('themes/emporium/images/Kootenay-Aurora-1-X3.jpg')}}" alt="Images">
               <div class="loginFormDiv">
                  <h3>FORGOT YOUR <br>PASSWORD</h3>


                  <div class="ai-forgot-password-form-success-msg"></div>
                  <div class="ai-forgot-password-form-error-msg"></div>


                  <form id="frmForgotPassword" action="{{ url('customer/request')}}" method="POST">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <p>Enter your email and you will get Instructions to reset your password</p>
                     <div class="form-group">
                        <input class="form-control" name="credit_email" type="text" placeholder="Email Address" required>

                     </div>
                     <button class="button" type="submit">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
