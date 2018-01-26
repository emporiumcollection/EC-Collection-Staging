
@extends('frontend.layouts.ev.customer')
@section('content')
<section>

    <div>

  <!-- Nav tabs <i class="fa fa-bullhorn" aria-hidden="true"></i></div><span>Ads -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
        <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-bullhorn" aria-hidden="true"></i>ADS</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"><i class="fa fa-star-o" aria-hidden="true"></i>FAVOURITE</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"><i class="fa fa-rocket" aria-hidden="true"></i>Service</a></li>
    <li role="presentation"><a href="#comingsoon" aria-controls="comingsoon" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Magazine</a></li>

    <li  role="presentation" class="<?php echo (isset($active_menu) && $active_menu == 'bookings')? 'active' : ''; ?>">
                                                        <a href="{{URL::to('bookings')}}">
                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>Bookings
                                                        </a>
                                                    </li>

     <li role="presentation"><a href="#accountOptions" aria-controls="accountOptions" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Account Settings</a></li>



       <li role="presentation"><a href="{{ URL::to('')}}" aria-controls="settings" role="tab" data-toggle="tab"> <i class="fa fa-home" aria-hidden="true"></i>Frontend</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Technical Support</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
     <div role="tabpanel" class="tab-pane active" id="profile"> <div class="col-md-8 col-sm-8">
        <div class="row">
            <div class="das-form-outer-align">
                <form class="form-horizontal my-profile-main-form-align">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control dash-input-style" placeholder="Riaan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control dash-input-style" placeholder="designlocations@gmail.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Phone</label>
                        <div class="col-sm-10">          
                            <input type="password" class="form-control dash-input-style" placeholder="+91-9876543210">
                        </div>
                    </div>
                    <div class="form-group profile-page-submit-radio-align">        
                        <div class="col-sm-12">
                            <div class="radio">
                                <label class="radio-label"><input type="radio">Subscribe to our notifications and news to our latest hotels, spa's and offers</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="radio">
                                <label class="radio-label"><input type="radio">I require personalized service bookings in my account profile</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-default dash-btn-style">Save Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div></div></div>
    <div role="tabpanel" class="tab-pane " id="home">Coming Soon....</div>
   
    <div role="tabpanel" class="tab-pane" id="messages">Coming Soon...</div>
 
    <div role="tabpanel" class="tab-pane" id="comingsoon">Coming Soon...</div>
    <div role="tabpanel" class="tab-pane" id="accountOptions"> 
         <div class="row">
                <div >
                    <ul class="list-group" >
                                <li class="list-group-item"><a class="active" href="#">Account Information</a></li>
                                <li class="list-group-item"><a href="#">Profile</a></li>
                                <li class="list-group-item"><a href="#">Featured Items</a></li>
                                <li class="list-group-item"><a href="#">Email</a></li>
                                <li class="list-group-item"><a href="#">Invitions</a></li>
                                <li class="list-group-item"><a href="#">Blocked User</a></li>
                                <li class="list-group-item"><a href="#">Delete Account</a></li>
                            </ul>
               
                </div>
            </div>

    </div>
  </div>

</div>
   
   
</section>
@endsection