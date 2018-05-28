
@extends('frontend.layouts.ev.customer')
@section('content')
<style type="text/css">
    
.hotel-book-now {
                background: #ABA07C;
                color: #fff;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }

</style>
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">


    <!-- Restaurant slider 3 starts here -->
<section id="restaurant3" class="hotelSliderSection fullWidthSlider">
    <div class="container-fluid">
        <div class="hotelSliderwrapper">
                    <div class="owl-carousel hotelSlider1 owl-theme">
                    <div class="item">
                        <div class="sliderimage">
                                <img src="images/restaurant-img01.jpg" alt="image" class="img-responsive"/>
                         </div>
                        <div class="hotelSliderContentImage">
                            <div class="hotelSliderContent">
                    <h1><span>Lunch</span></h1>
                    <h2>Hotel Cipriani Restaurant</h2>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    <p><a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>
                </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="sliderimage">
                                <img src="images/restaurant-img02.jpg" alt="image" class="img-responsive"/>
                            </div>
                        <div class="hotelSliderContentImage">
                            <div class="hotelSliderContent">
                    <h1><span>Lunch</span></h1>
                    <h2>Hotel Cipriani Restaurant</h2>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    <p><a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>
                </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="sliderimage">
                                <img src="images/restaurant-img03.jpg" alt="image" class="img-responsive"/>
                            </div>
                        <div class="hotelSliderContentImage">
                            <div class="hotelSliderContent">
                    <h1><span>Lunch</span></h1>
                    <h2>Hotel Cipriani Restaurant</h2>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    <p><a class="contactUsPopup" data-toggle="modal" data-target="#contactPopupSection" href="javascript:void(0);">Contact Us</a></p>
                </div>
                        </div>
                    </div>
                </div>
                </div>
    </div>
</section>
<div class="container-fluid">
<div class="row equalize sm-equalize-auto">


<div id="contactPopupSection" class="custom_modal modal fade" role="diaxlog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="cstm_heading modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Planet Restaurant</h1>
        <p>Lorem ipsum dolor sit amet.</p>
        <p>Lorem ipsum dolor sit amet.</p>
      </div>
      <div class="modal-body">
        <div class="row">
      <div class="col-md-4">
         <div class="form-field">
             <select>
                 <option>Please select</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
         </div> 
      </div>
       <div class="col-md-4">
         <div class="form-field">
          <input type="text" placeholder="First name*">
         </div> 
      </div>
        <div class="col-md-4">
         <div class="form-field">
          <input type="text" placeholder="Last name*">
         </div> 
      </div>
    </div><!--row -->
     <div class="row">
      <div class="col-md-4">
         <div class="form-field">
            <input type="email" placeholder="Email*">
         </div> 
      </div>
       <div class="col-md-4">
         <div class="form-field row">
            <div class="col-xs-4"><input type="number" placeholder="0"></div> 
            <div class="col-xs-8"><input type="number" placeholder="Telephone"></div> 
  
         </div> 
      </div>
        <div class="col-md-4">
         <div class="form-field row">
           <div class="col-xs-4"><input type="number" placeholder="0"></div> 
            <div class="col-xs-8"><input type="number" placeholder="Telephone"></div> 
         </div> 
      </div>
    </div><!--row -->
    <div class="row">
      <div class="col-md-4">
         <div class="form-field row">
            <label>Preferred date</label>
            <div class="col-xs-4">
                 <select>
                 <option>DD</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
            </div> 
             <div class="col-xs-4">
                 <select>
                 <option>MM</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
            </div> 
             <div class="col-xs-4">
                 <select>
                 <option>YYYY</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
            </div> 
            
         </div> 
      </div>
       <div class="col-md-4">
          <div class="form-field row">
            <label>Preferred time</label>
            <div class="col-xs-6">
                 <select>
                 <option>DD</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
            </div> 
             <div class="col-xs-6">
                 <select>
                 <option>MM</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
                 <option>dummy text</option>
             </select>
            </div> 
           
            
         </div> 
      </div>
        <div class="col-md-4">
         <div class="form-field number-guest">
        <input type="number" placeholder="Number of guest"> 
        
         </div> 
      </div>
    </div><!--row -->
    <div class="row">
        <div class="col-md-12">
           <div class="form-field areafield">
               <textarea placeholder="How can we help"></textarea>
           </div> 
        </div>
    </div><!-- row-->

    <div class="row">
        <div class="col-md-12 term-check">
            <input type="checkbox" id="signup-hotel-cipriani-restaurant">
            <label for="signup-hotel-cipriani-restaurant">By ticking this box, you give your consent to be contacted about the Belmond group's offers, events and updates. You may opt out of receiving our updates at any time, either by using an unsubscribe link or by contacting us at <a href="mailto:privacy@belmond.com" tabindex="-1">privacy@belmond.com</a>. To find out more see our <a target="_blank" href="https://www.belmond.com/privacy-policy" tabindex="-1">privacy policy</a> and full <a target="_blank" href="https://www.belmond.com/legal/terms-and-conditions" tabindex="-1">terms and conditions</a>.</label>
           <div class="btn-outer">
             <button type="submit" class="submit-btn">Submit</button>
           </div>
        </div>
    </div>
      </div>
    
      </div>
    
    </div>

  </div>


 
</div>
</section>

 

  
@endsection


@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">
<style>
.has-error  {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}

.cart-small-border {
      height: 2px;
    width: 200px;
    background: #ABA07C;
    margin-top: -2px;
    z-index: 0;
}
.cart-big-border {
  
    width: 100%;
    background: #eaeaea;
    /* margin-top: -5px; */
    height: 2px;
    z-index: 9999;
}
.customGoldBtn {
    background-color: #ABA07C;
    border: none;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    font-family: Geomanist-Regular;
}
.customGoldBtn .btn i { margin-left: 0;}
</style>
@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection
 

