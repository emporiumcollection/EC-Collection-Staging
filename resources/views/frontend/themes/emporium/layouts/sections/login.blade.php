 <!-- login signup popup starts here -->
      <div class="popupMainDiv">
         <div class="rightSideSec">
            <div class="popupTopSec"><a href="javascript:void(0);" class="mainPopupClose">×</a></div>
            <img src="{{ asset('themes/emporium/images/Step.jpg')}}" alt="Images">
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
               <div class="popupTopSec"><span>NEED HELP?</span><a href="javascript:void(0);" class="mainPopupClose">×</a></div>
               <img src="{{ asset('themes/emporium/images/angel-fernandez-alonso-220762.jpg')}}" alt="Images">
               <div class="loginFormDiv">
                  <h2>LOGIN WITH <br>YOUR ACCOUNT</h2>

                 <div class="ai-login-form-success-msg"></div>
                 <div class="ai-login-form-error-msg"></div>
                 <form  action="{{URL::to('customer/signin')}}" id="loginFormAction" method="POST">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="Email Address" required="email" />

                     </div>
                     <div class="form-group">
                        <a class="forgetPassBtn" href="javascript:void(0);">FORGOT?</a>

                        <input class="form-control" name="password" placeholder="Password" type="password" required="true" >
                     </div>
                     <button class="button" type="submit">Log In</button>
                  </form>
               </div>
            </div>
            <div class="signInPopup lognSignPopoUp">
               <div class="popupTopSec"><span>NEED HELP?</span><a href="javascript:void(0);" class="mainPopupClose">×</a></div>

               <img src="{{ asset('themes/emporium/images/matthew-kane-365718.jpg')}}" alt="Images">
               <div class="loginFormDiv">
                  <div class="reltv">
                  <select class="user-type">
                     <option>Choose Your User Type</option>
                     <option>B2B Hotel</option>
                     <option>Advertiser</option>
                     <option>Traveller</option>
                  </select>
               </div>
                  <h3>CREATE YOUR ACCOUNT PASSWORD</h3>
                  <div class="ai-sign-up-form-error-msg"></div>
                  <div class="ai-sign-up-form-success-msg"></div>
                  <form  action="{{ url('customer/create')}}" method="POST" id="customerRegisterarioForm">
                     <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="Email Address">

                     </div>
                     <div class="form-group">
                        <input type="hidden" id="txtmobileDialcode" name="txtmobileDialcode">
                        <input class="form-control"  name="txtmobileNumber" id="txtmobileNumber" type="tel" >
                      <span id="valid-msg" class="hide">✓ Valid</span>
                       <span id="error-msg" class="hide">Invalid number</span>
                     </div>
                     <div class="form-group">

                        <input class="form-control" name="password" type="password" placeholder="Password">
                     </div>
                     <button class="button" type="submit">Submit</button>
                  </form>
               </div>
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