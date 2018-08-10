@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Account Settings
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
            <span class="m-nav__link-text"> Account Settings </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">            
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="#" class="setting-left-side-menu"><i class="m-nav__link-icon fa fa-credit-card"></i> Add Payment Method</a>
                    </div>      
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="{{ URL::to('user/company')}}" class="setting-left-side-menu"><i class="m-nav__link-icon flaticon-profile-1"></i> Create Company</a>
                    </div> 
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="#" class="setting-left-side-menu" id="m_quick_sidebar_toggle_2"><i class="m-nav__link-icon flaticon-music-2"></i> Notifications</a>
                    </div>               
                </div>              
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad m--align-center">
                <div class="m-card-profile__pic">
                    <div class="m-card-profile__pic-wrapper">
						<img src="{{URL::to('images/800x450.png')}}" style="width: 100%;" />
					</div>
				</div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Payment Method</h2>
                <p>Intro text for Payment Method</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="m-portlet m-portlet--full-height  ">
                    {!! Form::open(array('url'=>'user/savetravellerprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                        <div class="m-portlet__body">
                            <div class="payment-box">
                                <div class="col-sm-12 col-md-12 col-lg-12 gray-bg-color">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="background-color: #efefef;">
                                            <div class="heading">Payments Method</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 m--align-left">
                                    <div class="row">
                                        <div class="add-payment-box m--align-center">
                                            <a href="#" data-toggle="modal" data-target="#payment-modal">
                                                <i class="la la-plus la-4x"></i> <br />
                                                <h5>Add Payment Method</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                                    Remeber emporium-voyage never ask you to wire money <a href="#">Learn More</a>
                                </div>
                            </div>
                            <div class="m--clearfix"></div>
                            <div class="payment-box">
                                <div class="col-sm-12 col-md-12 col-lg-12 gray-bg-color">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="background-color: #efefef;">
                                            <div class="heading">Emporium-voyage Gift Card</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 top-pad">
                                    <h4>emporium-voyage gift card balance: 0</h4>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                                    The credit balance from gift cards will be automatically applied when you book a trip.
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="row bottom-pad">
                                        <div class="col-sm-12 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col-sm-9 col-md-6 col-lg-9">
                                                    <div class="form-group m-form__group pad-zero">
        												<label for="example_input_full_name">
        													Enter Emporium-voyage gift card code
        												</label>
        												<input type="email" class="form-control m-input" placeholder="Enter full name">
        											</div>
                                                </div>
                                                <div class="col-sm-3 col-md-3 col-lg-3 pad-zero margin-top">
       												<button class="btn btn-default">Apply to Account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                                    <a href="#">Emporium-voyage gift cards help</a>
                                </div>
                            </div>
                            <div class="m--clearfix"></div>
                            <div class="payment-box">
                                <div class="col-sm-12 col-md-12 col-lg-12 gray-bg-color">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="background-color: #efefef;">
                                            <div class="heading">Your Coupon</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 top-pad">
                                    <div class="row bottom-pad">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-sm-9 col-md-6 col-lg-9">
                                                    <div class="form-group m-form__group pad-zero">
        												<label for="example_input_full_name">
        													Add a Coupon
        												</label>
        												<input type="email" class="form-control m-input" placeholder="Enter full name">
        											</div>
                                                </div>
                                                <div class="col-sm-3 col-md-3 col-lg-3 pad-zero margin-top">
       												<button class="btn btn-default">Add</button>
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="form-group m-form__group">
												<label for="example_input_full_name">
													Showing
												</label>
												<select class="form-control">
                                                    <option value="">All Available</option>
                                                </select>												
											</div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="border-top-with-padding">
                                                Coupon you add to your account will show up here
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div> 
            		{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">
    					Payment Method
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						&times;
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				
                    
                    
                    
                    
                    
                    
                    
						<!--begin::Form-->
						<form class="m-form m-form--fit m-form--label-align-right">
                                <div class="form-group m-form__group row  pad-margin-zero">
									<div class="col-lg-12">
										<img src="{{URL::to('images/credit-cards-768x178.png')}}" width="100%" />									
									</div>
								</div>
	                            <div class="form-group m-form__group row  pad-margin-zero">
									<div class="col-lg-12">
										<label>
											Card Type *
										</label>
										<select class="form-control">
                                            <option value="Private">Private</option>
                                            <option value="Business">Business</option>
                                        </select>									
									</div>
								</div>
								<div class="form-group m-form__group row  pad-margin-zero">
									<div class="col-lg-12">
										<label>
											Card number *
										</label>
										<input type="email" class="form-control m-input" placeholder="Enter full name">										
									</div>
								</div>
								<div class="form-group m-form__group row  pad-margin-zero">
									<div class="col-lg-6">
										<label>
											Expires On *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your address">
										</div>
									</div>
									<div class="col-lg-6">
										<label class="">
											Security Code *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your postcode">
										</div>
									</div>
								</div>
								<div class="form-group m-form__group row  pad-margin-zero">
									<div class="col-lg-6">
										<label>
											First name *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your address">
										</div>
									</div>
									<div class="col-lg-6">
										<label class="">
											Last Name *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your postcode">
										</div>
									</div>
								</div>
                                <div class="form-group m-form__group row pad-margin-zero">
									<div class="col-lg-6">
										<label>
											Postal Code *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your address">
										</div>
									</div>
									<div class="col-lg-6">
										<label class="">
											Country *
										</label>
										<div class="m-input-icon m-input-icon--right">
											<input type="text" class="form-control m-input" placeholder="Enter your postcode">
										</div>
									</div>
								</div>
							
						</form>
						<!--end::Form-->
					
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-dismiss="modal">
    					Cancel
    				</button>
    				<button type="button" class="btn btn-primary">
    					Add Card
    				</button>
    			</div>
    		</div>
    	</div>
    </div>
    <!--end::Modal-->

@stop
@section('custom_js_script')
    <script>
        $(document).ready(function(){
           $("#m_quick_sidebar_toggle_2").click(function(){ console.log("ff");
                $(".m-topbar__nav #m_quick_sidebar_toggle").trigger('click');
                $('#m_quick_sidebar_tabs [href="#m_quick_sidebar_tabs_settings"]').trigger('click');
           }); 
        });
    </script>
@stop