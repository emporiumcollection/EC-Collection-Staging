@extends('users_admin.metronic.layouts.blank_app')

@section('page_name')
   
@stop

@section('breadcrumb')
    
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Account </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
            <!--Begin::Main Portlet-->
            <div class="m-portlet m-portlet--full-height">
				<!--begin: Portlet Head-->
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Add Information
							</h3>
						</div>
					</div>					
				</div>
				<!--end: Portlet Head-->
                <!--begin: Portlet Body-->
				<div class="m-portlet__body m-portlet__body--no-padding">
					<!--begin: Form Wizard-->
					<div class="m-wizard m-wizard--3 m-wizard--success" id="m_hotel_wizard">
						<!--begin: Message container -->
						<div class="m-portlet__padding-x">
							<!-- Here you can put a message or alert -->
						</div>
						<!--end: Message container -->
						<div class="row m-row--no-padding">
                            
							<div class="col-xl-3 col-lg-12">
								<!--begin: Form Wizard Head -->
								<div class="m-wizard__head">
									<!--begin: Form Wizard Progress -->
									<div class="m-wizard__progress">
										<div class="progress">
                                            <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<!--end: Form Wizard Progress --> 
<!--begin: Form Wizard Nav -->
									<div class="m-wizard__nav">
										<div class="m-wizard__steps">
                                            <div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_1" class="wizard_step_1">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																1
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Welcome
													</div>
												</div>
											</div>
											<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2" class="wizard_step_2">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																2
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Profile & Company
													</div>
												</div>
											</div>
                                            
                                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3" class="wizard_step_3">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																3
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Commission
													</div>
												</div>
											</div>
                                            
                                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_4" class="wizard_step_4">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																4
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Contract
													</div>
												</div>
											</div>
                                            
                                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_5" class="wizard_step_5">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																5
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Upload Contract
													</div>
												</div>
											</div>
                                            
                                            <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_6" class="wizard_step_6">
												<div class="m-wizard__step-info">
													<a href="#" class="m-wizard__step-number">
														<span>
															<span>
																6
															</span>
														</span>
													</a>
													<div class="m-wizard__step-line">
														<span></span>
													</div>
													<div class="m-wizard__step-label">
														Packages
													</div>
												</div>
											</div>
											
										</div>
									</div>
									<!--end: Form Wizard Nav -->
								</div>
								<!--end: Form Wizard Head -->
							</div>
							<div class="col-xl-9 col-lg-12">
								<!--begin: Form Wizard Form-->
								<div class="m-wizard__form">
									<!--
1) Use m-form--label-align-left class to alight the form input lables to the right
2) Use m-form--state class to highlight input control borders on form validation
-->
                                        {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'hotel_form' ,'files' => true)) !!}
                                        <div class="m-portlet__body m-portlet__body--no-padding">
                                            <input type="hidden" name="base_url" id="base_url" value="{{ url() }}" />
                                            <!--begin: Form Wizard Step 1-->
                                            <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                                <input name="form_wizard_1" type="hidden" id="form_wizard_1" value="1" />  
    											<div class="m-form__section m-form__section--first">                                                    
                                                    
                                                    <div class="row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            @if(!empty($pageslider))
                                                            <div id="Carousel" class="carousel slide">
                                                                 
                                                                <ol class="carousel-indicators">
                                                                    @foreach($pageslider as $key => $slider_row)
                                                                    <li data-target="#Carousel" data-slide-to="{{$key}}" class="{{($key == 0)? 'active' : ''}}"></li>
                                                                    @endforeach
                                                                </ol>
                                                                 
                                                                <!-- Carousel items -->
                                                                <div class="carousel-inner">
                                                                @foreach($pageslider as $key => $slider_row)    
                                                                <div class="item {{($key == 0)? 'active' : ''}}">
                                                                	<div class="row">
                                                                	  <div class="col-md-12">
                                                                        <a href="{{$slider_row->slider_link}}" class="thumbnail">                            
                                                                            <div class="b2c-banner-text">{{$slider_row->slider_title}}</div>
                                                                            <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}" style="max-width:100%;" />
                                                                        </a>
                                                                      </div>                	  
                                                                	</div><!--.row-->
                                                                </div><!--.item-->
                                                                @endforeach 
                                                                 
                                                                </div><!--.carousel-inner-->
                                                                  <a data-slide="prev" href="#Carousel" class="left carousel-control"><</a>
                                                                  <a data-slide="next" href="#Carousel" class="right carousel-control">></a>
                                                            </div><!--.Carousel-->
                                                            @endif
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Welcome to emporium-voyage</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            Emporium-Voyage exclusively markets a selection of the luxury network’s extraordinary Hotels & Luxury Partners, utilising a sophisticated mix of online and offline media to position properties for maximum exposure in an elite market. 
                                                            Members are recognised for their agility, expertise and superior competence in both local and global markets.
                                                            Once listed on Emporium-Voyage or its niche site network, your property will reach 40% corporate as well as 60% leisure travellers with direct payment of the customer at your hotel.
                                                            <hr />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="m-radio-list">
                                    							<label class="m-radio">
                                    							     <input type="radio" name="accountsetup" value="1" <?php echo $user->own_hotel_setup==1 ? 'checked="checked"' : ''; ?>  />
                                                                        Yes, I would like Emporium voyage to set up my account.
                                                                     <span></span>
                                    							</label>
                                                                <label class="m-radio">
                                    							     <input type="radio" name="accountsetup" value="0" <?php echo $user->own_hotel_setup==0 ? 'checked="checked"' : ''; ?> />
                                                                        No, I will set up my account myself.
                                                                     <span></span>
                                    							</label>
                                    						</div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row" id="dv_sel_no_option">
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <hr />
                                                        </div>
                                                        <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4" style="margin-top: 4px;">
                                                            <a href="#" title="Download Setup Guide" class="m-btn btn btn-primary" target="_blank"><i class="la la-file-pdf-o"></i>Download Setup Guide</a>
                                                        </div>
                                                        <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                            Need Help?<br />
                                                            Download Our setup guide
                                                        </div>
                                                    </div>
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 2-->
    										<div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                                <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />  
    											<div class="m-form__section" style="margin: 0px;">
                                                    <div class="form-group m-form__group row">
                                                        
                                                            
                                                                <div class="b2c-banner-text">Profile &amp; Company</div>
                                        						<img src="{{URL::to('images/hotel_company_profile.jpg')}}" style="width: 100%;" />
                                        					
                                        				                                                      
                                                    </div>
                                                    <div class="m-form__heading margin-top">
    													<h3 class="m-form__heading-title">
    														Profile &amp; Company
    													</h3>
    												</div>
                                                    <div class="col-sm-12 col-md-12">
    													The Emporium-Voyage Sales department solicits travel agents, corporations, group/meeting planners and other business-producing entities to develop new and repeat business for our discerning member hotels.
                                                        Please complete all required fields. 
                                                        <hr />
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Username:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="username" type="text" id="username" class="form-control m-input m-input--solid" required=""  value="{{ $user->username }}" />  
    													</div>
    												</div>
    												<div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 First Name 
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="first_name" id="first_name" class="form-control m-input m-input--solid" placeholder="John" required="" value="{{ $user->first_name }}">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Last Name
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="last_name" id ="last_name"  class="form-control m-input m-input--solid" placeholder="Doe" value="{{ $user->last_name }}" required="">
    													</div>
    												</div>                                                    
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Avatar
    													</label>
    													<div class="col-xl-9 col-lg-9">
                                                            <input type="file" name="avatar" class="form-control m-input m-input--solid" />
                                                    		Image Dimension 80 x 80 px <br />
                                                            @if(!empty($user->avatar))
    		                                                {!! SiteHelpers::showUploadedFile($user->avatar,'/uploads/users/',80,80) !!}
                                                            @endif
                                                            <?php /* <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <span class="btn btn-primary btn-file">
                                                                    <span class="fileinput-new">Upload Avatar Image</span>
                                                                    @if(!empty($user->avatar))
                                                                        <span class="fileinput-exists"> Change</span>
                                                                    @endif                                                                    
                                                				    <input type="file" name="avatar">
                                                				</span>
                                                                <span class="fileinput-filename"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                                <br />
                                                    			Image Dimension 80 x 80 px <br />
    		                                                    {!! SiteHelpers::showUploadedFile($user->avatar,'/uploads/users/',80,80) !!}
                                                            </div> */ ?>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel Name:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_name" type="text" id="hotelinfo_name" class="form-control m-input m-input--solid" required=""  value="<?php echo isset($property_assigned->property_name) ? $property_assigned->property_name : '' ?>" />  
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel City:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_city" type="text" id="hotelinfo_city" class="form-control m-input m-input--solid" required=""  value="<?php echo isset($property_assigned->city) ? $property_assigned->city : '' ?>" />  
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel Country:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_country" type="text" id="hotelinfo_country" class="form-control m-input m-input--solid" required=""  value="<?php echo isset($property_assigned->country) ? $property_assigned->country : '' ?>" />  
    													</div>
    												</div>                                                    
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel Website:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_website" type="text" id="hotelinfo_website" class="form-control m-input m-input--solid" value="<?php echo isset($property_assigned->website) ? $property_assigned->website : '' ?>" />  
    													</div>
    												</div>
                                                   
                                                </div>
                                                <div class="m-form__section">
                                                   <div class="m-form__heading margin-top">
    													<h3 class="m-form__heading-title">
    														Company Registration for Tax purposes.
    													</h3>
									               </div>                                                                                                                                                            
                                                   
                                                   <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Billing Company:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_name" type="text" id="company_name" class="form-control m-input m-input--solid" value="{{isset($company_details->company_name) ? $company_details->company_name : ''}}" />  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Owner:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_owner" type="text" id="company_owner" class="form-control m-input m-input--solid" value="{{isset($company_details->company_owner) ? $company_details->company_owner : '' }}"/>  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Contact Person:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="contact_person" type="text" id="contact_person" class="form-control m-input m-input--solid" value="{{isset($company_details->contact_person) ? $company_details->contact_person : ''}}" />  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Contact Email:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_email" type="text" id="company_email" class="form-control m-input m-input--solid" value="{{isset($company_details->company_email) ? $company_details->company_email : '' }}" />  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Address:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_address" type="text" id="company_address" class="form-control m-input m-input--solid" value="{{isset($company_details->company_address) ? $company_details->company_address : ''}}" />  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														City:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_city" type="text" id="company_city" class="form-control m-input m-input--solid" value="{{isset($company_details->company_city) ? $company_details->company_address : ''}}" />  
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Country:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="company_country" type="text" id="company_country" class="form-control m-input m-input--solid" value="{{isset($company_details->company_country) ? $company_details->company_country : ''}}" />  
    													</div>
    												</div>
                                                   
                                                   
                                                   <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Registered European Company
    													</label>
    													<div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
                                    							<label class="m-radio">
                                    							     <input type="radio" name="european" value="1" <?php echo $user->european==1 ? 'checked="checked"' : ''; ?> />
                                                                        Yes
                                                                     <span></span>
                                    							</label>
                                                                <label class="m-radio">
                                    							     <input type="radio" name="european" value="0" <?php echo $user->european==0 ? 'checked="checked"' : ''; ?> />
                                                                        No
                                                                     <span></span>
                                    							</label>
                                    						</div>
                                                        </div>
                                                    </div>
                                                    <div id="dv_vat_no">
                                                        <div class="form-group m-form__group row" >
                                                            <label class="col-xl-3 col-lg-3 col-form-label">
        														
        													</label>
        													<div class="col-xl-9 col-lg-9">
        														Under article 44 EU VAT Directive 2006/112/EC that deals with the place of supply of services, electronic services are deemed to be taxable where the Business customer belongs. Under article 196 EU VAT Directive, the VAT will be levied from the customer, based on the reverse charge mechanism. Emporium-Voyage will request a valid VAT number in one of the EU member states in order not to invoice the VAT to the Business customer. If such VAT number is not provided or is invalid, Emporium-Voyage will invoice the VAT of the country where the Business customer belongs.  
        													</div>
        												</div>
                                                        <div class="form-group m-form__group row">
        													<label class="col-xl-3 col-lg-3 col-form-label">
        														Vat Number
        													</label>
        													<div class="col-xl-9 col-lg-9">
        														<input name="hotelinfo_vat_no" required="required" type="text" id="hotelinfo_vat_no" class="form-control m-input m-input--solid" value="{{isset($company_details->company_tax_number) ? $company_details->company_tax_number : ''}}" />  
        													</div>
        												</div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-12 m-form__group-sub">     					                                
                                							<div class="m-checkbox-inline">
                                								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                									<input type="checkbox" id="newsLetter" name="newsLetter" <?php echo ($user->subscribe_notification==1) ? 'checked="checked"' : '' ?> />      								
                                									Emporium-Voyage would like to send you news, updates and annual reports. 
                                                                    <span></span>
                                								</label>
                                							</div>
                                						 </div>			
                                					</div>
                                					
                                					
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 3-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                                                <input name="form_wizard_3" type="hidden" id="form_wizard_3" value="3" />  
    											<div class="m-form__section">
                                                    <div class="row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="b2c-banner-text">Commission</div>
                                        					<img src="{{URL::to('images/hotel_commission_profile.jpg')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Commission</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
Select the Commission Terms you wish to agree with.                                                             <hr />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <?php if(!empty($commision_contractdata)){  ?>
                                                            <div class="m-radio-list">
                                    							<label class="m-radio">
                                    							     <input type="radio" name="roomavailability" value="full" <?php echo isset($commision_contractdata->commission_type) ? ($commision_contractdata->commission_type=="full" ? 'checked="checked"' : '') : ''; ?> />
                                                                        Rack Rate (<?php echo (float) $commision_contractdata->full_availability_commission;?>%)
                                                                     <span></span>
                                    							</label>
                                                                <label class="m-radio">
                                    							     <input type="radio" name="roomavailability" value="partial" <?php echo isset($commision_contractdata->commission_type) ? ($commision_contractdata->commission_type=="partial" ? 'checked="checked"' : '') : 'checked="checked"'; ?> />
                                                                        Standard Tour Operator (STO <?php echo (float) $commision_contractdata->partial_availability_commission;?>%)
                                                                     <span></span>
                                    							</label>
                                    						</div>  
                                                            <?php } ?>                                                                                                                      
                                                        </div>
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commission_modal">View Commission contract</button>
                                                        </div>
                                                    </div>
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 4-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_4">
                                                <input name="form_wizard_4" type="hidden" id="form_wizard_4" value="4" />  
    											<div class="m-form__section">
                                                    <div class="row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="b2c-banner-text">Contract</div>
                                        					<img src="{{URL::to('images/hotel_contract.jpg')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Contract</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
                                                            Welcome to the Contract section. To streamline the signup & start our Business-to-Business relationship we have made it easy to complete the contract steps. View all sections, approve the section to continue and upon accpetance the contract betweeen your Property and Emporium-Voyage begins.The contract will be visibel in your documents ection and will be send to your by mail and post for your convenience. 
                                                            
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
                                                            
                                                            <div class="form-group m-form__group row">
                                                            
                                                               <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist" style="width: 100%;">
                                                               <!--begin::Item-->
                                                               {{--*/ $new_contract_ava = false; /*--}}
                                                               <?php
                                            	                    if(!empty($contractdata)) {
                                       	                       ?>
                                                                    {{--*/ 
                                                                		usort($contractdata, function($a, $b) {
                                                                			return $a->sort_num - $b->sort_num; 
                                                                		});
                                                                        
                                                                        $contractdata = array_reverse($contractdata);
                                                                        
                                                                        $final_contracts = array();
                                                                        foreach($contractdata as $sicc){
                                                                            if(!isset($userContracts[$sicc->contract_id])){ $tempobj = $sicc; $tempobj->already_done = false; }else{ $tempobj = $userContracts[$sicc->contract_id]; $tempobj->already_done = true; }
                                                                            if(isset($tempobj->contract_id)){$final_contracts[] = $tempobj;}
                                                                        }
                                                                	/*--}}
                                                               <?php                                                                               
                                            	                        $sn = 0;
                                            	                        foreach ($final_contracts as $row) {
                                            	                            ?>
                                                                            {{--*/ $alreadyAccepted = (bool) $row->already_done; $is_agree = (bool) ((isset($row->is_agree))?$row->is_agree:false);  /*--}}
                        {{--*/ if($alreadyAccepted !== true){ $new_contract_ava = true; } /*--}}
                                            	                             <div class="m-accordion__item">
                                            	                                <div class="m-accordion__item-head <?php echo ($sn==0) ? '' : 'collapsed' ?>" role="tab" id="m_accordion_1_item_<?php echo $sn; ?>_head" data-toggle="collapse" href="#m_accordion_1_item_<?php echo $sn; ?>_body" aria-expanded="false">
                                                                                
                                                                                    <span class="m-accordion__item-icon">
                                                                                        <span class="m-switch m-switch--sm {{(($alreadyAccepted === true)?'m-switch--outline m-switch--icon m-switch--success':'m-switch--icon m-switch--info')}}">
                                                                                            <label>
                                                                                                <input type="checkbox" name="accepted_contracts[]" value="{{$row->contract_id}}" class="rad_contracts {{(((bool) $row->is_required  == true)?'rad_required':'')}}" {{(($is_agree === true)?'checked="checked"':'')}} />
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="m-accordion__item-title">
                                                                                      <?php echo $row->title; ?> <?php echo (((bool) $row->is_required  == true)?'<span class="text-danger">*</span>':''); ?>
                                                                                    </span>
                                                                                    <span class="m-accordion__item-mode"></span>                          
                                            	                                </div>
                                                                                <div class="m-accordion__item-body <?php echo ($sn==0) ? 'show' : 'collapse' ?>" id="m_accordion_1_item_<?php echo $sn; ?>_body" role="tabpanel" aria-labelledby="m_accordion_1_item_<?php echo $sn; ?>_head" data-parent="#m_accordion_1">
                                                                                     <div class="m-accordion__item-content">
                                                                                      <p>
                                                                                       <?php 
                                                                                        $group_id = \Session::get('gid');
                                                                                        $default_package = \DB::table('tb_packages')->where('allow_user_groups', $group_id)->where('package_status', 1)->where('package_for', 2)->first();
                                                                                        $str_desc = $row->description;
                                                                                        $current_date = date('Y-m-d');
                                                                                        $date_signed = date('jS F Y');
                                                                                        
                                                                                        $valid_until = date('jS F Y', strtotime('+2 years', strtotime($current_date)));
                                                                                        $valid_until_year = date('Y', strtotime($valid_until));
                                                                                        $string_array_replace = array(                    
                                                                                            '{signed_date}'=>$date_signed,
                                                                                            '{valid_until}'=>$valid_until,
                                                                                            '{valid_until_year}'=>$valid_until_year,
                                                                                            '{annual_fee}'=>(!empty($default_package) ? $default_package->package_price : '2700'),
                                                                                        );
                                                                                        foreach($string_array_replace as $key => $value){                    
                                                                                            $str_replaced = str_replace($key, $value, $str_desc);
                                                                                            $str_desc = $str_replaced;
                                                                                        }       
                                                                                       
                                                                                       ?>
                                                                                       <?php echo nl2br($str_desc); ?>
                                                                                      </p>
                                                                                     </div>
                                                                                </div>
                                            	                            </div>
                                            	                                
                                            	                            <?php
                                            	                            $sn++;
                                            	                        }
                                            	                    }
                                            	                    ?>
                                                               
                                                               
                                                               <!--end::Item-->
                                                               </div>
                                						
                                					       </div>
                                                           <div class="m-form__group form-group row">
                                                                <div class="col-1">
                                                                    <span class="m-switch m-switch--sm m-switch--info">
                                                                        <label>
                                                                            <input type="checkbox" name="accepted_all" value="all" class="rad_accept_all" />
                                                                            <span></span>
                                                                        </label>
                                                                    </span> 
                                                                </div>   
                                                                <label class="col-2 col-form-label">Accept All</label>
                                                           </div>
                                                            
                                                        </div>                                                
                                                        
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top" id="dv_contract_view_download" @if($new_contract_ava) style="display: none;" @else style="display: '';" @endif >
                                                            <div class="form-group m-form__group row">
                                                                <label class="col-xl-2 col-lg-2 col-form-label">
                                                                    Contracts
                                                                </label>
                                                                <div class="col-xl-9 col-lg-9">                                                
                                                                    <a href="{{ URL::to('user/contractflipbook')}}" title="View Contract" class="m-btn btn btn-primary" target="_blank"><i class="la la-eye"></i>View Contract</a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group m-form__group row">
                                                                <label class="col-xl-2 col-lg-2 col-form-label">
                                                                    
                                                                </label>
                                                                <div class="col-xl-9 col-lg-9">                                                
                                                                    
                                                                    <a href="{{ URL::to('signup-contract/download')}}" title="Download contract to proceed" class="m-btn btn btn-success" target="_blank" id="btn_download"><i class="la la-file-pdf-o"></i>Download Contract</a>
                                                                    <input type="hidden" name="hd_download" id="hd_download" value="0" />
                                                                </div>
                                                            </div>              
                                                        </div>
                                                        
                                                    </div>
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 5-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_5">
                                                <input name="form_wizard_5" type="hidden" id="form_wizard_5" value="5" /> 
                                                <input name="propId" type="hidden" id="propId" value="<?php echo isset($assigned_propid) ? $assigned_propid : ''; ?>" />  
                                                <input type="hidden" name="uploadType" value="Hotel Contracts" />
    											<div class="m-form__section">
                                                    <div class="row">
                                                                                                 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="b2c-banner-text">Upload Hotel STO Contract & Terms</div>
                                        					<img src="{{URL::to('images/hotel_contract.jpg')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Upload Hotel STO Contract & Terms</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
This section allows you to upload your Hotels STO contract & Terms. Your contracts are visible from your documents section for your convenience.                                                            
                                                        </div>
										                
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12"><br />             
                                                            
                                                             <div class="form-group m-form__group row">
            													<label class="col-xl-3 col-lg-3 col-form-label">
            														Upload STO Contract
            													</label>
                                                                <div class="col-xl-9 col-lg-9">                                                       
                                                        		  <input type="file" name="signed_contract" class="form-control m-input m-input--solid" />
                                                                </div>
            												 </div>                                                                                                                      
                                                        </div>   
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12"><br />             
                                                            
                                                             <div class="form-group m-form__group row">
            													<label class="col-xl-3 col-lg-3 col-form-label">
            														Upload Hotel Brochure
            													</label>
                                                                <div class="col-xl-9 col-lg-9">                                                      
                                                        		  <input type="file" name="hotel_brochure" class="form-control m-input m-input--solid" />
                                                                </div>
            												 </div>                                                                                                                      
                                                        </div>                                                     
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <br />
                                                                <?php 
                                                                    if(isset($hotelcontacts) && count($hotelcontacts)>0){ 
                                                                ?>  
                                                                        <a href="{{Url::to('user/viewuploadedcontract/')}}/{{$assigned_propid}}" title="View uploaded Contract" target="_blank" class="btn btn-primary" >View uploaded Contract</a>
                                                                <?php  
                                                                    }
                                                                ?>
                                                                <?php 
                                                                    if(isset($hotelcontacts) && count($hotelcontacts)>0){ 
                                                                ?>        
                                                                        
                                                                        <a href="{{Url::to('user/viewuploadedbrochure/')}}/{{$assigned_propid}}" title="View uploaded Brochure" target="_blank" class="btn btn-primary" >View uploaded Brochure</a>
                                                                <?php  
                                                                    }
                                                                ?>
                                                            
                                                        </div>
                                                        
                                                    </div>
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 6-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_6">
                                                <input name="form_wizard_6" type="hidden" id="form_wizard_6" value="6" />  
    											<div class="m-form__section">
                                                    <div class="row" id="package_row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="b2c-banner-text">Our membership Packages</div>
                                        					<img src="{{URL::to('images/hotel_packages.jpg')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Our membership Packages</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
                                                            The emporium-Voyage packages opens a world of opportunity to further market your Brand. To start your Reservation-Distribition & Marketing journey, please pay and confirm your bi-anually subscription. Your invoice will be visible from your accounts section.
                                                            We offer an array of packages to further promote and market your hotel to our high-net-worth members network. You can view additional packages at your leisure from the membership section.
                                                        </div> 
                                                        <?php /* <div class="col-xl-12 col-lg-12 m--align-right">
            											     <a href="#" class="btn btn-default" id="package-skip">Skip</a>
						                                </div> */ ?>
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top" id="dv_pkg">
                                                            
                                                            <div class="form-group m-form__group row">
                                                            
                                                                       
                                                                <div class="m-portlet__body" style="width:100%;">
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                                        <li class="nav-item"> 
                                                                            <a class="nav-link active" href="#membership" data-toggle="tab"> 
                                                                                Membership 
                                                                            </a>
                                                                        </li>
                                                    					<li class="nav-item"> 
                                                                            <a class="nav-link" href="#reservation_distribution" data-toggle="tab"> 
                                                                                Reservation & Distribution 
                                                                            </a>
                                                                        </li>
                                                                        <li class="nav-item"> 
                                                                            <a class="nav-link" href="#sales_marketing" data-toggle="tab"> 
                                                                                Sales & Marketing 
                                                                            </a>
                                                                        </li>                                                                        
                                                                        <li class="nav-item"> 
                                                                            <a class="nav-link" href="#advertising" data-toggle="tab"> 
                                                                                Advertising
                                                                            </a>
                                                                        </li>			
                                                    				</ul>
                                                    				<div class="tab-content">
                                                                            <div class="tab-pane active" id="membership">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_membership" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    <?php 
                                                                                        $cart_session_arr = array();
                                                                                        $cart_session = (\Session::get('hotel_cart'));
                                                                                        if(!empty($cart_session)){
                                                                                            $cart_session_arr = $cart_session;
                                                                                        } 
                                                                                    ?>
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                                                                    {{--*/ $m=0; /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Membership")
                                                                                    
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head <?php echo ($m==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_membership_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_membership_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} 
                                                                                                @if($package->package_price_type!=1)
                                                                                                    Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                                                                @else
                                                                                                    Price: Price on Request
                                                                                                @endif
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body <?php echo ($m==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_membership_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_membership_{{ $k }}_head" data-parent="#m_accordion_3_membership">
                                                            								<div class="m-accordion__item-content">
                                                                                            <div class="row">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                @if($package->package_image!='')
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                @endif
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                @if($package->package_price_type!=1)  
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                @else
                                                                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                                                                @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                
                                                                                                      
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="row" style="margin-top: 10px;">
                                                                                                
                                                                                                <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                                                                    @if(CNF_SUBTRACT_FEE)
                                                                                                    @if($package->package_for==2)
                                                                                                    <div class="m-checkbox-inline">
                                                                        								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                                        <?php $arr_index = $package->id."_hotel";
                                                                                                            $checked = '';
                                                                                                            //print_r($cart_session_arr);
                                                                                                            if(array_key_exists($arr_index, $cart_session_arr)){
                                                                                                                $ind_arr = $cart_session_arr[$arr_index];
                                                                                                                //print_r($ind_arr);
                                                                                                                if(!empty($ind_arr)){
                                                                                                                     if($ind_arr['package']['fee']=='yes'){
                                                                                                                        $checked = 'checked="checked"';
                                                                                                                     }   
                                                                                                                }
                                                                                                            }
                                                                                                        ?>
                                                                        									<input type="checkbox" id="fee_subtract_on_booking_{{$package->id}}" name="fee_subtract_on_booking_{{$package->id}}" value="yes" data-id="{{$package->id}}" class="subtract_checkbox" {{$checked}}>      								
                                                                        									Subtract this fee from my first booking commission. 
                                                                                                            <span></span>
                                                                        								</label>
                                                                        							</div>
                                                                                                    @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                                @if($package->package_for==0 || $package->package_for==1)                                                                                                          
                                                                                                <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 m--align-right">
                                                                                                    <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success" id="add_to_{{$package->id}}">Add to cart</a>
                                                                                                </div>
                                                                                                  
                                                                                                @endif
                                                                                            </div> 
                                                                                               
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                        {{--*/ $m++;  /*--}}
                                                                                    @endif
                                                                                    {{--*/ $k++;  /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->
                                                                                    @if($m==0)
                                                                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                                        <p>Currently no packages in this section.</p>
                                                                                    </div>
                                                                                    @endif 
                                                                                </div>
                                                                            </div>
                                                    					    <div class="tab-pane" id="reservation_distribution">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_reservation_distribution" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    <?php 
                                                                                        $cart_session_arr = array();
                                                                                        $cart_session = (\Session::get('hotel_cart'));
                                                                                        if(!empty($cart_session)){
                                                                                            $cart_session_arr = $cart_session;
                                                                                        } 
                                                                                    ?>
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                                                                    {{--*/ $sn=0; /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Reservation_Distribution")
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head <?php echo ($sn==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_reservation_distribution_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} 
                                                                                                @if($package->package_price_type!=1)  
                                                                                                Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                                                                @else
                                                                                                    Price: Price on Request
                                                                                                @endif
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body <?php echo ($sn==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_reservation_distribution_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-parent="#m_accordion_3_reservation_distribution">
                                                            								<div class="m-accordion__item-content">
                                                                                            <div class="row">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                @if($package->package_image!='')
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                @endif
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                @if($package->package_price_type!=1)  
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                @else
                                                                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                                                                @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                
                                                                                                      
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="row" style="margin-top: 10px;">
                                                                                                
                                                                                                <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                                                                    <?php /* @if(CNF_SUBTRACT_FEE)
                                                                                                    <div class="m-checkbox-inline">
                                                                        								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                                        <?php $arr_index = $package->id."_hotel";
                                                                                                            $checked = '';
                                                                                                            //print_r($cart_session_arr);
                                                                                                            if(array_key_exists($arr_index, $cart_session_arr)){
                                                                                                                $ind_arr = $cart_session_arr[$arr_index];
                                                                                                                //print_r($ind_arr);
                                                                                                                if(!empty($ind_arr)){
                                                                                                                     if($ind_arr['package']['fee']=='yes'){
                                                                                                                        $checked = 'checked="checked"';
                                                                                                                     }   
                                                                                                                }
                                                                                                            }
                                                                                                        ?>
                                                                        									<input type="checkbox" id="fee_subtract_on_booking_{{$package->id}}" name="fee_subtract_on_booking_{{$package->id}}" value="yes" data-id="{{$package->id}}" class="subtract_checkbox" {{$checked}}>      								
                                                                        									Subtract this fee from my first booking commission. 
                                                                                                            <span></span>
                                                                        								</label>
                                                                        							</div>
                                                                                                    @endif */ ?>
                                                                                                </div>
                                                                                                @if($package->package_for==0 || $package->package_for==1)                                                                                                          
                                                                                                <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 m--align-right">
                                                                                                    <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success" id="add_to_{{$package->id}}">Add to cart</a>
                                                                                                </div>
                                                                                                  
                                                                                                @endif
                                                                                            </div> 
                                                                                               
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                        {{--*/ $sn++;  /*--}}
                                                                                    @endif
                                                                                    {{--*/ $k++;  /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item--> 
                                                                                    @if($sn==0)
                                                                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                                        <p>Currently no packages in this section.</p>
                                                                                    </div>
                                                                                    @endif       
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="sales_marketing">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_sales_marketing" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}                                                                                                                   {{--*/ $kn=0; /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Sales_Marketing")
                                                                                    
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head <?php echo $kn==0 ? '' : 'collapsed' ?> "  role="tab" id="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_sales_marketing_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} 
                                                                                                @if($package->package_price_type!=1)  
                                                                                                    Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} 
                                                                                                @else
                                                                                                    Price: Price on Request
                                                                                                @endif
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body <?php echo $kn==0 ? 'show' : 'collapse' ?>" id="m_accordion_3_item_sales_marketing_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-parent="#m_accordion_3_sales_marketing">
                                                            								<div class="m-accordion__item-content">
                                                                                                <div class="row">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                @if($package->package_image!='')
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                @endif
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            
                                                                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                                                                            
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                @if($package->package_price_type==1)
                                                                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>
                                                                                                                @else
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                @endif
                                                                                                                    
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                    <div class="row" style="padding: 10px;">
                                                                                                        
                                                                                                        @if(isset($package_contracts[$package->id]))                                                        
                                                                                                            @if(count($package_contracts[$package->id]) > 0)
                                                                                                            <div class="col-lg-12 m--align-right">
                                                                                                                <div class="form-group m-form__group row">
                                                                                                                    <div class="col-lg-12 m-form__group-sub">
                                                                                                                        <div class="m-checkbox-inline">
                                                                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                                                                <input type="checkbox" class="rcheckboxinput" name="package_checkboxes_{{$package->id}}" value="1" required="required" data-model-id="contract_model_{{$package->id}}" /> Please accept contracts first.<span></span>
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                        <span class="m-form__help"><a href="#" onclick="javascript: return false;" data-toggle="modal" data-target="#contract_model_{{$package->id}}" class="btn btn-primary pull-right">View contracts</a></span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @endif 
                                                                                                        @endif 
                                                                                
                                                                                                        
                                                                                                    </div>
                                                                        
                                                                                                      
                                                                                                </div>
                                                                                                </div>
                                                                                                
                                                                                                <div class="row margin-top">
                                                                                                
                                                                                                    <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                                                                        <?php /* @if(CNF_SUBTRACT_FEE)
                                                                                                        <div class="m-checkbox-inline">
                                                                            								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                                            <?php $arr_index = $package->id."_hotel";
                                                                                                                $checked = '';
                                                                                                                //print_r($cart_session_arr);
                                                                                                                if(array_key_exists($arr_index, $cart_session_arr)){
                                                                                                                    $ind_arr = $cart_session_arr[$arr_index];
                                                                                                                    //print_r($ind_arr);
                                                                                                                    if(!empty($ind_arr)){
                                                                                                                         if($ind_arr['package']['fee']=='yes'){
                                                                                                                            $checked = 'checked="checked"';
                                                                                                                         }   
                                                                                                                    }
                                                                                                                }
                                                                                                            ?>
                                                                            									<input type="checkbox" id="fee_subtract_on_booking_{{$package->id}}" name="fee_subtract_on_booking_{{$package->id}}" value="yes" data-id="{{$package->id}}" class="subtract_checkbox" {{$checked}}>      								
                                                                            									Subtract this fee from my first booking commission. 
                                                                                                                <span></span>
                                                                            								</label>
                                                                            							</div>
                                                                                                        @endif */ ?>
                                                                                                    </div>
                                                                                                    @if($package->package_for==0 || $package->package_for==1)                                                                                                           
                                                                                                    <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 m--align-right">                                                                                                    
                                                                                                        <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success" id="add_to_{{$package->id}}">Add to cart</a>
                                                                                                    </div>
                                                                                                    
                                                                                                    @endif
                                                                                                </div>
                                                                                                
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    {{--*/ $kn++; /*--}}
                                                                                    @endif
                                                                                    {{--*/ $k++; /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->
                                                                                    @if($kn==0)
                                                                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                                        <p>Currently no packages in this section.</p>
                                                                                    </div>
                                                                                    @endif        
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            <div class="tab-pane" id="advertising">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_advertising" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                                                                    {{--*/ $yn=0; /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Advertising")
                                                                                    
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head <?php echo ($yn==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_3_item_advertising_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_advertising_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} 
                                                                                                @if($package->package_price_type!=1)  
                                                                                                Price: {!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }}
                                                                                                @else
                                                                                                    Price: Price on Request
                                                                                                @endif
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body  <?php echo ($yn==0) ? 'show' : 'collapse' ?>" id="m_accordion_3_item_advertising_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_advertising_{{ $k }}_head" data-parent="#m_accordion_3_advertising">
                                                            								<div class="m-accordion__item-content">
                                                                                            <div class="row">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                @if($package->package_image!='')
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                @endif
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            
                                                                                                            <p>{!! nl2br($package->package_description) !!}</p>
                                                                                                            
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                @if($package->package_price_type==1)
                                                                                                                    <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>
                                                                                                                @else
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                    
                                                                                                </div>
                                                                                                </div>
                                                                                                
                                                                                                <div class="row" style="margin-top: 10px;">
                                                                                                
                                                                                                    <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                                                                        <?php /* @if(CNF_SUBTRACT_FEE)
                                                                                                        <div class="m-checkbox-inline">
                                                                            								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                                                                            <?php $arr_index = $package->id."_hotel";
                                                                                                                $checked = '';
                                                                                                                //print_r($cart_session_arr);
                                                                                                                if(array_key_exists($arr_index, $cart_session_arr)){
                                                                                                                    $ind_arr = $cart_session_arr[$arr_index];
                                                                                                                    //print_r($ind_arr);
                                                                                                                    if(!empty($ind_arr)){
                                                                                                                         if($ind_arr['package']['fee']=='yes'){
                                                                                                                            $checked = 'checked="checked"';
                                                                                                                         }   
                                                                                                                    }
                                                                                                                }
                                                                                                            ?>
                                                                            									<input type="checkbox" id="fee_subtract_on_booking_{{$package->id}}" name="fee_subtract_on_booking_{{$package->id}}" value="yes" data-id="{{$package->id}}" class="subtract_checkbox" {{$checked}}>      								
                                                                            									Subtract this fee from my first booking commission. 
                                                                                                                <span></span>
                                                                            								</label>
                                                                            							</div>
                                                                                                        @endif */ ?>
                                                                                                    </div>
                                                                                                    @if($package->package_for==0)                                                                                                    
                                                                                                    <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 m--align-right">
                                                                                                        <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                                
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    {{--*/ $yn++; /*--}}
                                                                                    @endif
                                                                                    {{--*/ $k++; /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->
                                                                                    @if($yn==0)
                                                                                    <div class="col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                                        <p>Currently no packages in this section.</p>
                                                                                    </div>
                                                                                    @endif     
                                                                                </div>
                                                                            </div>
                                                
                                                					</div>
                                                					
                                                                    
                                                				</div> 
                                                            
                                						
                                					       </div>
                                                           <div class="col-lg-12 m--align-right" id="pgk_continue_btn">                     						
                                                                <a id="continue_btn" class="btn btn-success pull-right" style="color: #fff;">Continue</a>		
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row margin-top" id="cart_row">
                                                        
                                                    
                                                    </div>
                                                    
                                                    
    											</div>
                                            </div>
                                            
                                        </div>
                                        
                                        <!--begin: Form Actions -->
    									<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
    										<div class="m-form__actions">
    											<div class="row">
    												<div class="col-lg-6 m--align-left">
    													<a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
    														<span>
    															<i class="la la-arrow-left"></i>
    															&nbsp;&nbsp;
    															<span>
    																Back
    															</span>
    														</span>
    													</a>
    												</div>
    												<div class="col-lg-6 m--align-right" id="wizard_submit_btn">
    													<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
    														<span>
    															<i class="la la-check"></i>
    															&nbsp;&nbsp;
    															<span>
    																{{ Lang::get('core.sb_savechanges') }}
    															</span>
    														</span>
    													</a>
    													<a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
    														<span>
    															<span>
    																Save & Continue
    															</span>
    															&nbsp;&nbsp;
    															<i class="la la-arrow-right"></i>
    														</span>
    													</a>
    												</div>
    											</div>
    										</div>
    									</div>
    								<!--end: Form Actions -->
                            		{!! Form::close() !!}
								</div>
								<!--end: Form Wizard Form-->
							</div>
						</div>
					</div>
					<!--end: Form Wizard-->
				</div>
				<!--end: Portlet Body-->
			</div>
			<!--End::Main Portlet-->
        </div>
	</div>
    
    <!-- Commission modal popup -->
    <div class="modal fade" id="commission_modal" tabindex="-1" role="dialog" aria-labelledby="commissionModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Contracts
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">                        
                        <div class="m-portlet__body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="b2c-banner-text">Commission</div>
                					<img src="{{URL::to('images/hotel_commission_profile.jpg')}}" style="width: 100%;" />
                                </div> 
                            </div>
                            <div class="m-accordion m-accordion--default m-accordion--solid" id="commission_accordion" role="tablist">
                                {{--*/ $new_contract_ava = false; /*--}}
                                <?php
                                    if(!empty($commision_contractdata)) {
                                ?>
                                    
                                <!-- contracts start -->
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$commision_contractdata->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$commision_contractdata->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"></span>
                                            <span class="m-accordion__item-icon">
                                                <span class="m-switch m-switch--sm {{(($commission_contract_selected === true)?'m-switch--outline m-switch--icon m-switch--success':'m-switch--icon m-switch--info')}}">
                                                    <label>
                                                        <input type="checkbox" name="accepted_commission_contracts" class="rad_commission_contracts" {{(($commission_contract_selected === true)?'checked="checked"':'')}} />
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </span>
                                            <span class="m-accordion__item-title">{{$commision_contractdata->title}}</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$commision_contractdata->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$commision_contractdata->contract_id}}_head" data-parent="#commission_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $commision_contractdata->description; ?>
                                            </div>
                                        </div>
                                    </div>
                                <!-- contracts end -->
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    Please confirm the commission contract to proceed to the next step.
                                </div>
                            </div>
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" id="contractclosebtn" data-dismiss="modal">Close</button>
                    {{--<button type="button" class="btn btn-primary" id="contractacceptbtn">Save</button>--}}
    			</div>
    		</div>
    	</div>
    </div>
    <!-- End Commission modal popup --> 
    <!-- Price Request modal popup -->
    <div class="modal fade" id="priceonrequesr_modal" tabindex="-1" role="dialog" aria-labelledby="priceonrequestModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
                {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'priceonrequest_form' ,'files' => true)) !!}
    			<div class="modal-header">
    				<h5 class="modal-title" id="priceonrequestModalLabel">
    					Price On Request
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">                        
                        <div class="m-portlet__body">
                        
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_firstname" class="form-control" placeholder="First name" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_lastname" class="form-control" placeholder="Last name" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_email" class="form-control" placeholder="Email" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_phoneumber" class="form-control" placeholder="Phone Number" required="required" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Message</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <textarea class="form-control" name="onrequest_message" id="onrequest_message" rows="4"></textarea>
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                    <div class="col-xl-9 col-lg-9">
                                        <div class="m-checkbox-inline">
            								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
            									<input type="checkbox" id="onrequest_agree" name="onrequest_agree" required="required" />      								
            									I agree that emporium-voyage consultant can connect me directly. 
                                                <span></span>
            								</label>
            							</div>
                                    </div> 
                                </div>
                            </div>
                                                 
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" id="contractclosebtn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SEND</button>
    			</div>
                {!! Form::close() !!} 
    		</div>
    	</div>
    </div>
    <!-- End Price Request modal popup -->   
@stop

{{-- For custom style  --}}
@section('style')
<link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
    <style>
    .carousel {
      position: relative;
    }
    
    .carousel-inner {
      position: relative;
      height:400px;
      width: 100%;
      overflow: hidden;
    }
    
    .carousel-inner > .item {
      position: absolute;
      height:400px;
      display: none;
      -webkit-transition: 0.6s ease-in-out left;
              transition: 0.6s ease-in-out left;
    }
    
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
      display: block;
      height: auto;
      max-width: 100%;
      line-height: 1;
    }
    
    .carousel-inner > .active,
    .carousel-inner > .next,
    .carousel-inner > .prev {
      display: block;
    }
    
    .carousel-inner > .active {
      left: 0;
    }
    
    .carousel-inner > .next,
    .carousel-inner > .prev {
      position: absolute;
      top: 0;
      width: 100%;
    }
    
    .carousel-inner > .next {
      left: 100%;
    }
    
    .carousel-inner > .prev {
      left: -100%;
    }
    
    .carousel-inner > .next.left,
    .carousel-inner > .prev.right {
      left: 0;
    }
    
    .carousel-inner > .active.left {
      left: -100%;
    }
    
    .carousel-inner > .active.right {
      left: 100%;
    }
    
    .carousel-control {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      width: 15%;
      font-size: 20px;
      color: #ffffff;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
      opacity: 0.5;
      filter: alpha(opacity=50);
    }
    
    .carousel-control.left {
      background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.0001)));
      background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.5) 0), color-stop(rgba(0, 0, 0, 0.0001) 100%));
      background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
      background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);
      background-repeat: repeat-x;
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
    }
    
    .carousel-control.right {
      right: 0;
      left: auto;
      background-image: -webkit-gradient(linear, 0 top, 100% top, from(rgba(0, 0, 0, 0.0001)), to(rgba(0, 0, 0, 0.5)));
      background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.0001) 0), color-stop(rgba(0, 0, 0, 0.5) 100%));
      background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
      background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);
      background-repeat: repeat-x;
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
    }
    
    .carousel-control:hover,
    .carousel-control:focus {
      color: #ffffff;
      text-decoration: none;
      opacity: 0.9;
      filter: alpha(opacity=90);
    }
    
    .carousel-control .icon-prev,
    .carousel-control .icon-next,
    .carousel-control .glyphicon-chevron-left,
    .carousel-control .glyphicon-chevron-right {
      position: absolute;
      top: 50%;
      left: 50%;
      z-index: 5;
      display: inline-block;
    }
    
    .carousel-control .icon-prev,
    .carousel-control .icon-next {
      width: 20px;
      height: 20px;
      margin-top: -10px;
      margin-left: -10px;
      font-family: serif;
    }
    
    .carousel-control .icon-prev:before {
      content: '\2039';
    }
    
    .carousel-control .icon-next:before {
      content: '\203a';
    }
    
    .carousel-indicators {
      position: absolute;
      bottom: 10px;
      left: 50%;
      z-index: 15;
      width: 60%;
      padding-left: 0;
      margin-left: -30%;
      text-align: center;
      list-style: none;
    }
    
    .carousel-indicators li {
      display: inline-block;
      width: 10px;
      height: 10px;
      margin: 1px;
      text-indent: -999px;
      cursor: pointer;
      border: 1px solid #ffffff;
      border-radius: 10px;
    }
    
    .carousel-indicators .active {
      width: 12px;
      height: 12px;
      margin: 0;
      background-color: #ffffff;
    }
    
    .carousel-caption {
      position: absolute;
      right: 15%;
      bottom: 20px;
      left: 15%;
      z-index: 10;
      padding-top: 20px;
      padding-bottom: 20px;
      color: #ffffff;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
    }
    
    .carousel-caption .btn {
      text-shadow: none;
    }
    
    @media screen and (min-width: 768px) {
      .carousel-control .icon-prev,
      .carousel-control .icon-next {
        width: 30px;
        height: 30px;
        margin-top: -15px;
        margin-left: -15px;
        font-size: 30px;
      }
      .carousel-caption {
        right: 20%;
        left: 20%;
        padding-bottom: 30px;
      }
      .carousel-indicators {
        bottom: 20px;
      }
    }
        .carousel-control {
            position: absolute;
        }
        .scrollNextDiv {
            position: absolute;
            bottom: 60px;
            left: 61%;
            text-decoration: none;
            text-transform: uppercase;
            animation-fill-mode: none;
            animation-duration: unset;                
        }
        .carousel-caption a{
            text-decoration: none;
        }
        .carousel-caption a{
            text-decoration: none;
        }
        .carousel-caption a h4{        
            color: #ABA07C;
        }
        .m-widget2 .m-widget2__item .m-widget2__desc{
            vertical-align: middle !important;
        }
        .m-task-link{ text-decoration: none; color: #575962;}
        .m-task-link:hover{ text-decoration: none; color: #575962;}
        
        .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
            margin-top: 0rem;
        }
        .m-widget7 .m-widget7__user{
            margin-bottom: 2rem;
        }
        .m-widget7 .m-widget7__desc{
            margin-top: 2rem;
            margin-bottom: 3em;
        }
        .m-subheader-search{
            margin-top: 20px;
        }
        .m-widget7 .m-widget7__user .m-widget7__user-img .m-widget7__img{
            width: 4.9rem;
        }
        .m-nav-grid>.m-nav-grid__row>.m-nav-grid__item{
            padding: .75rem .75rem;
        }
        
    .carousel {
        margin-bottom: 0;
        /*padding: 0 40px 30px 40px;*/
    }
    /* The controlsy */
    .carousel-control {
    	left: 30px;
        height: 40px;
    	width: 40px;
        background: none repeat scroll 0 0 #222222;
        border: 4px solid #FFFFFF;
        border-radius: 23px 23px 23px 23px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .carousel-control.right {
    	right: 30px;
    }
    /* The indicators */
    .carousel-indicators {
    	right: 50%;
    	top: auto;
    	bottom: -10px;
    	margin-right: -19px;
        display: none;
    }
    /* The colour of the indicators */
    .carousel-indicators li {
    	background: #cecece;
    }
    .carousel-indicators .active {
    background: #428bca;
    }
    
    /* t-date picker  */
    .search-cal-top .t-dates{
        background: #f2f2f2;
        color: #898b96;
        padding: 9px 15px;
        height: 39px;
        box-sizing: border-box;
        border: 1px solid #898b96;
        border-radius: 3px;
    }
    .search-cal-top .t-check-in{
       width: 45% !important;
       margin-right: 17px;
    }
    .search-cal-top .t-check-out{
       width: 45% !important;
    }
    .form-control-height{
        height: 39px !important;
    }
    .ui-widget.ui-widget-content {
        padding: 0px;
        max-width: 350px;
    }
    /* End */
    </style>
@endsection

{{-- For custom script --}}
@section('custom_js_script')
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>

    @parent
    <script>
        /*Dropzone.autoDiscover = false;*/    
        $(document).ready( function () {  
            
            /*var baseUrl = "{{ url::to('addfile') }}";
            var token = "{{ Session::getToken() }}";
            
             var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                url: baseUrl,
                maxFilesize: 3,
                params: {
                    _token: token,
					fold_id: localStorage.getItem('fold_id')
                },
				paramName: "file", // The name that will be used to transfer the file
				addRemoveLinks: true,
				success: function(file, response){
					
				},
				init: function() {
					var thisDropzone = this;
					this.on("processing", function(file) {
						thisDropzone.options.params.fold_id = localStorage.getItem('fold_id');
						thisDropzone.options.url = baseUrl;
					});
				}
             });*/
            
                           
                $('#priceonrequest_form').validate({
        			submitHandler: function (form) {
        				 $.ajax({
                            url:"{{URL::to('priceonrequest')}}",
                            type:'POST',
                            dataType:'json',
                            data:$(form).serializeArray(),                   
                            success:function(response){
                                if(response.status == 'success'){
                                    toastr.success(response.message);
                                    $("#priceonrequesr_modal").modal('hide'); 
                                }
                                else{
                                    toastr.error(response.message);
                                }
                            }
                        });
        				return false;
        			}
        		
            });
            
            $(".priceonrequest").click(function(){
               $("#priceonrequesr_modal").modal('show'); 
            });
            
            $(".rad_accept_all").click(function(){
               if($(".rad_accept_all").is(":checked")){                    
                    $(".rad_contracts").each(function() {
                        this.checked=true;
                    });
               }else{
                    $(".rad_contracts").each(function() {
                        this.checked=false;
                    });
               } 
            });
            
            check_setup('{{$user->own_hotel_setup}}');
            
            $("input[name=accountsetup]").click(function(){
                var _val = $("input[name=accountsetup]:checked").val();                
                check_setup(_val);
            });
            
            function check_setup(_val){
                $.ajax({
                    url:base_url+'/get_setup', 
                    type:'get',    
                    dataType:'json',
                    success:function(response){                        
                        if(_val=='1'){ 
                            $("#add_to_"+response.id).css('display', 'none');
                        }else{  
                            $("#add_to_"+response.id).css('display', '');
                        }
                    }
                });
            }
            
            base_url = $("#base_url").val();
            /*$('#Carousel').carousel({
            $('#Carousel').carousel({
                interval: 5000
            });*/
            var current_fs, next_fs, previous_fs;
            
            
            
            
            // settings
              var $slider = $('.carousel-inner'); // class or id of carousel slider
              var $slide = '.item'; // could also use 'img' if you're not using a ul
              var $transition_time = 1000; // 1 second
              var $time_between_slides = 4000; // 4 seconds
            
              function slides(){
                return $slider.find($slide);
              }
            
              slides().fadeOut();
            
              // set active classes
              slides().first().addClass('active');
              slides().first().fadeIn($transition_time);
            
              // auto scroll 
              $interval = setInterval( 
                function(){
                if(slides().length > 1){
                  var $i = $slider.find($slide + '.active').index();
                                      
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);
            
                  if (slides().length == $i + 1) $i = -1; // loop to start
            
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                  }
                }
                , $transition_time +  $time_between_slides 
              );
            
            
            $(".left").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i - 1 >= 0){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);                  
                  slides().eq($i - 1).fadeIn($transition_time);
                  slides().eq($i - 1).addClass('active');
                }
            });
            
            $(".right").click(function(){
                var $i = $slider.find($slide + '.active').index();
                if($i + 1 < slides().length){ 
                  slides().eq($i).removeClass('active');
                  slides().eq($i).fadeOut($transition_time);
                  slides().eq($i + 1).fadeIn($transition_time);
                  slides().eq($i + 1).addClass('active');
                }
            });
            
            
            $("#contractSignCheck").click(function(){
                if($("#contractSignCheck").is(':checked')){
                    $("#contractSignCheckFinal").prop("checked", true);
                }else{
                    $("#contractSignCheckFinal").prop("checked", false);
                }
            });
            $("#contractSignCheckFinal").click(function(){
                if($("#contractSignCheckFinal").is(':checked')){
                    $("#contractSignCheck").prop("checked", true);
                }else{
                    $("#contractSignCheck").prop("checked", false);
                }
            });
            
            $("#continue_btn").click(function(e){
                e.preventDefault();
                
                /*var subtract_ids = new Array();                                
                $("input.subtract_checkbox").each(function(){ 
                    $pkg_val= $(this).attr('data-id');                                        
                    if($(this).is(":checked")){ 
                        subtract_ids.push($pkg_val);
                    }        
                });                                
                $.ajax({
                    url:base_url+'/hotel/update_cart', 
                    type:'POST',    
                    dataType:'json',
                    data:{"subtract_id":subtract_ids},
                    success:function(response){ 
                        if(response.success){
                            console.log(response.data);
                            $.ajax({
                                url:base_url+'/hotel/get_cart', 
                                type:'get',    
                               
                                success:function(response){ 
                                    console.log("hello");
                                    $("#cart_row").css('display', '');
                                    $("#cart_row").html('');
                                    $("#dv_pkg").css('display', 'none');
                                    $("#cart_row").html(response);   
                                    
                                    
                                }
                            });
                        }
                    }
                });*/
                                              
                $.ajax({
                    url:base_url+'/hotel/get_cart', 
                    type:'get',    
                   
                    success:function(response){ 
                        
                        $("#cart_row").css('display', '');
                        $("#cart_row").html('');
                        $("#dv_pkg").css('display', 'none');
                        $("#cart_row").html(response);   
                        
                        
                    }
                });
            });
            
            $(document).on('click','#checkout_btn',function(e){
                e.preventDefault();
                $.ajax({
                    url:base_url+'/hotel/get_checkout', 
                    type:'get',
                    success:function(response){ console.log(response);
                        $("#cart_row").css('display', '');
                        $("#cart_row").html('');
                        $("#dv_pkg").css('display', 'none');
                        $("#cart_row").html(response);   
                        
                        
                    }
                }); 
            });
            
            $(document).on('click','.subtract_checkbox',function(e){
                var pkgid = $(this).attr('data-id'); 
                var fees = '';           
                if($(this).is(":checked")){ 
                    var fees = 'yes';   
                }
                $.ajax({
                    url:base_url+'/hotel/subtractfee', 
                    type:'POST',    
                    dataType:'json',
                    data:{"pkgid":pkgid, "fees":fees},
                    success:function(response){ 
                        
                    }
                });
            });
            
            
            $(document).on('click','#choose_pkg_btn',function(e){
                e.preventDefault();
                $("#dv_pkg").css('display', '');
                $("#cart_row").css('display', 'none');
            });
            
            $(document).on('click', '#finish_btn', function(e){
                e.preventDefault();                        
                var fdata = new FormData();                
                fdata.append("_token",$("input[name=_token]").val());
                
                $.ajax({
                    url:"{{URL::to('wizard-subtract-fee')}}",
                    type:'POST',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:fdata,
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success:function(response){
                        if(response.status == 'success'){
                            //toastr.success(response.message);
                            window.location.href="{{URL::to('hotel/thanks')}}/"+response.order_id;
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
            });
                                                        
            
            $("#package-skip").click(function(e){ 
                e.preventDefault();                        
                var fdata = new FormData();                
                fdata.append("_token",$("input[name=_token]").val());
                fdata.append("form_wizard",$("input[name=form_wizard_6]").val()); 
                console.log(fdata);
                $.ajax({
                    url:"{{URL::to('package_skip')}}",
                    type:'POST',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:fdata,
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            window.location.href="{{URL::to('dashboard')}}";
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                }); 
           });
           
           $("#btn_download").click(function(){
                $("#hd_download").val(1);
           });
           var _euro = $("input[name=european]:checked").val();
           if(_euro){
                $("#dv_vat_no").css('display', ''); 
           }else{
                $("#dv_vat_no").css('display', 'none');
           }
           $("input[name=european]").click(function(){
                var europo_val = $("input[name=european]:checked").val();
                console.log(europo_val);
                if(europo_val==0){
                    $("#dv_vat_no").css('display', 'none');
                    $("#hotelinfo_vat_no").removeAttr('required');
                }else{
                    $("#dv_vat_no").css('display', '');
                    $("#hotelinfo_vat_no").attr('required', 'required');
                }
           });
           
        });
        function addToCartHotel(PackageID,PackagePrice){    
            var fee_subtract_on_booking = '';             
            if($('#fee_subtract_on_booking_'+PackageID).is(":checked")){
                fee_subtract_on_booking = 'yes';
            }
            var PackagePrice=PackagePrice;
            var PackageID=PackageID;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Package added to cart successfully.");
                $("#pgk_continue_btn").css('display', '');
            }
            };
            xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart_wizard')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel&cart[package][fee]="+fee_subtract_on_booking, true);
            xhttp.send();
        
        } 
        function removeItemFromCart(PackageID){    

            //var PackagePrice=PackagePrice;
            var PackageID=PackageID;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                $.ajax({
                    url:base_url+'/hotel/get_cart', 
                    type:'get',
                    success:function(response){ 
                        $("#cart_row").html('');
                        $("#dv_pkg").css('display', 'none');
                        $("#cart_row").html(response);   
                        
                        
                    }
                }); 
            }
            };
            xhttp.open("GET", "{{ URL::to('removecartitem')}}?cart[package][id]="+PackageID+"&cart[package][qty]=1&cart[package][type]=hotel", true);
            xhttp.send();
    
        }
        
        function containerdropreload()
		{
			window.location.href = $('input[name="curnurl"]').val();
		}                

    </script>
@endsection

@section('script')
    <script type="text/javascript">
    var activeTab = '@if($active_tab > 0){{$active_tab}}@else{{0}}@endif'; 
    activeTab = parseInt(activeTab);
    var prevTab = activeTab;
    activeTab++;
    var base_url = '{{ url() }}';
    var profileSaveUrl = '{{URL::to("user/savenewprofile")}}';
    var companySaveUrl = '{{URL::to("user/savenewcompanydetails")}}';
    var confirmUrl = '{{URL::to("user/confirmnewprofile")}}';
    </script>
    <script src="{{ asset('sximo/js/dropzone.js') }}"></script>    
    <script src="{{ asset('metronic/assets/demo/demo6/base/hotel_wizard.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
