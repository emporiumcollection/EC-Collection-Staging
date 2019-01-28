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
        <a href="{{ URL::to('user/settings')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Account Settings </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Create a Company </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4 bg-gray">            
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="{{ URL::to('user/settings')}}" class="setting-left-side-menu"><i class="m-nav__link-icon fa fa-credit-card"></i> Add a Payment Method</a>
                    </div>      
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="{{ URL::to('user/company')}}" class="setting-left-side-menu"><i class="m-nav__link-icon flaticon-profile-1"></i> Create a Company</a>
                    </div> 
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="#" class="setting-left-side-menu" id="m_quick_sidebar_toggle_2"><i class="m-nav__link-icon flaticon-interface-10"></i> Notification Settings</a>
                    </div>               
                </div>              
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad m--align-center">
                <div class="m-card-profile__pic">
                    <div class="m-card-profile__pic-wrapper">
                        <div class="b2c-banner-text">Company Account</div>
						<img src="{{URL::to('images/company.jpg')}}" style="width: 100%;" />
					</div>
				</div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Company account</h2>
                <p>In this section, add all your company related information for tax purposes. Make sure to enter your details correct as the infomration will be used for billing.</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12" style="color: red;">
                @if(Session::has('messagetext'))
    				{!! Session::get('messagetext') !!}
    			@endif
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                
									
                                        {!! Form::open(array('url'=>'user/savecompamy/', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'property_update_form' ,'files' => true)) !!}
                                        <div class="m-portlet__body m--padding-20">
                                            
                                            
    											<div class="m-form__section m-form__section--first">
                                                    
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="row">
                                                        Provide your legal business details to help us confirm you're part of a company.
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Company name<span>*</span> </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_name" value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />             
                                                            <span class="error">{{ $errors->first('company_name') }}</span>
                                                        </div> 
                                                    </div>  
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														Business Address
    													</h3>                                                        
    												</div> 				
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Address </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_address" value="<?php if(!empty($extra)) { echo $extra->company_address; } ?>"  /> 
                                                        </div> 
                                                    </div> 				
                                                    <div class="form-group m-form__group row" style="display: none;">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Suite, bldg, etc. (optional) </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_bldg" value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>"  />    
                                                        </div> 
                                                    </div> 			
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">City </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_city" value="<?php if(!empty($extra)) { echo $extra->company_city; } ?>"  />        
                                                        </div> 
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">State </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_state" value="<?php if(!empty($extra)) { echo $extra->company_state; } ?>"  />                                                   
                                                        </div> 
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">ZIP code </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_postal_code" value="<?php if(!empty($extra)) { echo ($extra->company_postal_code > 0) ? $extra->company_postal_code : '' ; } ?>"  />                                                             
                                                        </div> 
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Country </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_country" value="<?php if(!empty($extra)) { echo $extra->company_country; } ?>"  />                                                             
                                                        </div> 
                                                    </div> 
                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Phone number<span>*</span> </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" class="form-control" placeholder="" name="company_phone" value="<?php if(!empty($extra)) { echo $extra->company_phone; } ?>"  />          
                                                            <span class="error">{{ $errors->first('company_phone') }}</span>          
                                                        </div> 
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-checkbox-inline">
    															<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    																<input type="checkbox" name="copy_amenities_rooms" id="copy_amenities_rooms" checked="" value="1" >
                                                                    Business address and registered office address are the same
    																<span></span>
    															</label>
    														</div>                                                            
                                                        </div>
                                                    </div>      
                                                 </div>                                             
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                    <div class="m-form__section bg-gray">
                                                        <div class="m-form__heading">
        													<h3 class="m-form__heading-title">
                                                                Legal representative
                                                            </h3>
                                                        </div> 
                                                        					
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Name<span>*</span> </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_legal_representive_name" value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" /> 
                                                                <span class="error">{{ $errors->first('company_legal_representive_name') }}</span>
                                                            </div> 
                                                        </div> 				
                                                        <div class="form-group m-form__group row" style="display: none;">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Last name </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_last_name" value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>" />                                                             
                                                            </div> 
                                                        </div> 			
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Email </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_legal_representive_email" value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>"  />                                                             
                                                            </div> 
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Phone number </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_legal_representive_phone" value="<?php if(!empty($extra)) { echo $extra->contact_person_phone; } ?>"  />                                                             
                                                            </div> 
                                                        </div> 
                        
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Country of incorporation </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_legal_representive_country_of_incorporation" value="<?php if(!empty($extra)) { echo $extra->country_of_incorporation; } ?>"  />                                                             
                                                            </div> 
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Registration number </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_registration_number" value="<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>"  />                                                             
                                                            </div> 
                                                        </div> 
                                                        
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Date of incorporation </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control datepic" placeholder="" name="company_legal_representive_dt_incorporation" value="<?php if(!empty($extra)) { echo ((!empty($extra->date_of_incorporation) && ($extra->date_of_incorporation != "0000-00-00" )) ? $extra->date_of_incorporation : ''); } ?>"  />                                                             
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                    <div class="m-form__section">
                                                        <div class="m-form__heading">
        													<h3 class="m-form__heading-title">
                                                            Company owner
                                                            </h3>
                                                        </div> 					
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Name<span>*</span> </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_owner_name" value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>"  />          
                                                                <span class="error">{{ $errors->first('company_owner_name') }}</span>
                                                            </div> 
                                                        </div> 				
                                                        <div class="form-group m-form__group row" style="display: none;">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Last name </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control" placeholder="" name="company_owner_last_name" value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>"  />                                                             
                                                            </div> 
                                                        </div> 			
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">Date of birth </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type="text" class="form-control datepic" placeholder="" name="company_owner_dob" value="<?php if(!empty($extra)) { echo ((!empty($extra->company_owner_dob) && ($extra->company_owner_dob != "0000-00-00" )) ? $extra->company_owner_dob : ''); } ?>" >
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                    <div class="col-sm-12 col-md-12 c0l-lg-12 m--align-right">
                                                        <input type="hidden" name="hid_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
                                                        <button type="submit" class="btn btn-success b-btn"><i class="fa fa-save"></i> Save</button>
                                                    </div>
                                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                    <div class="m-form__section bg-gray">
                                                        <div class="m-form__heading">
        													<h3 class="m-form__heading-title">
                                                            Deactivate Account
                                                            </h3>
                                                        </div> 
                                                        <div class="col-sm-12 col-md-12 c0l-lg-12">
                                                            <button class="btn btn-success b-btn" id="deactivate_account"><i class="fa fa-save"></i> Deactivate My Account</button>
                                                        </div>	
                                                    </div>                        					
    											
                                                                                                                                               
                                            </div>
    										
                                        
    									
    								<!--end: Form Actions -->
                            		{!! Form::close() !!}
								
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
										<img src="" />									
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
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
    <script>
        $(document).ready(function(){
           $("#m_quick_sidebar_toggle_2").click(function(){ console.log("ff");
                $(".m-topbar__nav #m_quick_sidebar_toggle").trigger('click');
                $('#m_quick_sidebar_tabs [href="#m_quick_sidebar_tabs_settings"]').trigger('click');
           });
           $('.datepic').datepicker({
    			numberOfMonths: 1,
    			showButtonPanel: true,
    			format: 'yyyy-mm-dd'
    	   });
           
           $("#deactivate_account").click(function(e){
              e.preventDefault();
              if(confirm('Are you sure, You want to deactivate your account')){
                  $.ajax({
                	  url: "{{ URL::to('user/deactivateaccount')}}",
                	  type: "post",
                	  dataType: "json",
                	  success: function(response){
                		if(response.status == 'success'){
                            toastr.success(response.message);
                            //window.location.href = "{{Url::to('/')}}";
                        }
                      }
                   });
               }
           }); 
           
        });
    </script>
@stop
