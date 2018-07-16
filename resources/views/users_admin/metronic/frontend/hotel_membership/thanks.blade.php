@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Account  <small>Enter Your Info</small>
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Account </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
            
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Your Packages
							</h3>
						</div>
					</div>
				</div>
                
				<div class="m-portlet__body">
                    
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row m--align-center">
                                <div class="col-sm-12">  
                                    <img src="{{ asset('themes/emporium/images/thankyou.png') }}" alt="Icon" />                            
                                    <h2>Thank You!</h2>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-xs-6 col-sm-4"><label>First Name</label><p><?php echo $user->first_name; ?></p></div>
                                <div class="col-xs-6 col-sm-4"><label>Last Name</label><p><?php echo $user->last_name; ?></p></div>
                                <div class="col-xs-6 col-sm-4"><label>E-mail</label><p><?php echo $user->email; ?></p></div>
                                <div class="col-xs-6 col-sm-4"><label>Mobile No</label><p><?php echo $user->mobile_number; ?></p></div>
                                <div class="col-xs-6 col-sm-4"><label>Pereferred Date</label><p>12-03-2018</p></div>
                                <div class="col-xs-6 col-sm-4"><label>Pereferred Time</label><p>12:45 Am</p></div>
                                <div class="col-xs-6 col-sm-4"><label>No Of Guest</label><p>3</p></div>
                                <div class="col-xs-12"><label>Message</label><p> Thank you for submitting your information, you will be contact soon by our customer service department.</p></div>
                    
                            </div>
                            <div class="row m--align-center">
                                <div class="col-sm-12">
                                    <a href="{{ URL::to('')}}" class="btn btn-success">Back to Home</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection