@extends('layouts.customer_app')

@section('content')
<section> 
    <div class="dashboard-page-top-bar-align">
        <div class="dashboardd-page-heading">
            <h2>Account</h2>
        </div>
    </div>
</section>
<section>
    <div class="col-md-8 col-sm-8">
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
        </div>
    </div>
    <div class="res-mob-menu-align">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="row">
                <div class="dashboard-page-right-nav-align">
                    <nav class="navbar navbar-inverse dashboard-left-main-nav-outer-align">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dashboard-navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>                        
                            </button>
                        </div>
                        <div class="collapse navbar-collapse dashboard-navigation-style right-menu-align" id="dashboard-navigation">
                            <ul class="nav navbar-nav dashboard-menu-align">
                                <li><a class="active" href="#">Account Information</a></li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Featured Items</a></li>
                                <li><a href="#">Email</a></li>
                                <li><a href="#">Invitions</a></li>
                                <li><a href="#">Blocked User</a></li>
                                <li><a href="#">Delete Account</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection