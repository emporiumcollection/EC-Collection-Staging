@extends('users_admin.traveller.layouts.blank_app')

@section('page_name')
    Account  <small>Enter Your Info</small>
@stop

@section('breadcrumb')
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
					<div class="m-wizard m-wizard--3 m-wizard--success" id="m_traveller_wizard">
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
														Personal Information
													</div>
												</div>
											</div>
											<?php /*<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3" class="wizard_step_3">
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
														Personalized Preferences
													</div>
												</div>
											</div>
											*/ ?>
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
														Membership
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
                                        {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'traveller_form' ,'files' => true)) !!}
                                        <div class="m-portlet__body m-portlet__body--no-padding">
                                            <input type="hidden" name="base_url" id="base_url" value="{{ url() }}" />
                                            <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                                <input name="form_wizard" type="hidden" id="form_wizard" value="1" />  
    											<div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														
    													</h3>
    												</div>
                                                    
                                                    <div class="row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="b2c-banner-text">Welcome to Emporium-Lifestyle</div>
                                                            <img src="{{URL::to('images/Traveller-Dashboard.jpg')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Welcome to Emporium-Lifestyle</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--margin-top-5">
                                                            Whatever your heart desires, we make it happen!
                                                            <br /><br />Our par excellence, tailored concierge services ensure that the vision of all our customers is realized and they enjoy nothing less than the vacation of their dreams!
                                                            <br /><br />We take immense pride in our dense network of luxury associates who help make our member's experiences exceptional wherever in the world they choose to go.
                                                        </div> 
                                                        
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
    												
                                                    
                                                    
                                                    
                                                    
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 2-->                                            
    										<div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                                <input name="form_wizard" type="hidden" id="form_wizard" value="1" />  
    											<div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														Personal Information
    													</h3> 
    												</div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
    												<div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 First Name 
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="{{ $user->first_name }}">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Last Name
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="{{ $user->last_name }}" required="">
                                                            <span class="m-form__help">Your public profile only shows your first name. When you request a booking, your Hotel of choice will see your first and last name.</span>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Email
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="email" id ="email"  class="form-control dash-input-style" placeholder="Doe" value="{{ $user->email }}" readonly="readonly">
                                                            <span class="m-form__help"></span>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    													   Phone Number	
    													</label>
    													<div class="col-xl-9 col-lg-9">
                                                            <div class="input-group m-input-group m-input-group--square">
																<div class="input-group-prepend">
																	<span class="input-group-text" id="basic-addon1">
																		{{ $user->mobile_code }}
																	</span>
																</div>
																<input type="text" name="txtmobileNumber" id ="txtmobileNumber"  class="form-control dash-input-style" placeholder="Doe" value="{{ $user->mobile_number }}" readonly="readonly">
															</div>    														
                                                            <span>Add a phone number</span>
                                                            <span class="m-form__help">This is only shared once you have a confirmed booking with a Emporium Voyage Collection Partner Hotel. This is how we communicate booking confirmations.</span>
    													</div>
    												</div>                                                    
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 I Am 
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<select class="form-control" id="gender" name="gender">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Avatar
    													</label>
    													<div class="col-xl-9 col-lg-9">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
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
                                                            </div>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 Preferred Language
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<select class="form-control" id="prefer_communication_with" name="prefer_communication_with">
                                                                <option value="en" selected="selected">English</option>                                                                
                                                                <option value="de">Deutsch</option>                                                                
                                                                <option value="es">Espanol</option>                                                                
                                                                <option value="fr">Francais</option>                                                                
                                                                <option value="it">Italiano</option>                                                                
                                                                <option value="nl">Nederlands</option>                                                                
                                                            </select>
                                                            <span class="m-form__help">We'll send you messages in this language.</span>
    													</div>
    												</div>
                                					
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 Preferred Currency
    													</label>
                                                        <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
    													<div class="col-xl-9 col-lg-9">
    														<select class="form-control" id="preferred_currency" name="preferred_currency">
                                                                <option value="EUR">Currency</option>
                                                                @foreach($currencyList as $currencyCode => $currencyName)

                                                                    <option value="{{ $currencyCode }}" title="{{ $currencyName }}">{{ $currencyName }}
                                                                </option>
                                                    
                                                                @endforeach
                                                            </select>
                                                            <span class="m-form__help">Select the currency in which we display prices.</span>
    													</div>
    												</div>
                                                    
                                                    
                                                    
                                                    
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 1-->
                                            
                                            <!--begin: Form Wizard Step 2-->
    										<?php /* <div class="m-wizard__form-step" id="m_wizard_form_step_3">
    											<div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														Personalized Preferences
    													</h3>
                                                        <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />
                                                        <input name="compedit_id" type="hidden" id="compedit_id" value="" />
                                                        
    												</div>   
                                                    
                                                    <div class="form-group m-form__group row">
    													<div class="col-xl-12 col-lg-12 m--align-right">
    														<a href="#" class="btn btn-default" id="personalized-skip">Skip</a>
    													</div>
    												</div>
                                                    
                                                    
                                                    
                                                        <form action="{{URL::to('personalized-service/save')}}" method="POST">
                                                            
                                                                <div class="personalized-pefrences">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">Where do you want to travel?</h2>
                                                                        <p class="sub-des-heading">You can specify one or more destinations</p>
                                                                    </div>
                                                                    
    													            <div class="col-xl-12 col-lg-12">
                                                                       <div class="choosen-input-align">
                                                                            <select name="destinations[]" data-placeholder="Ex: Argentina, South Africa, Cape Town" class="form-control chosen-select-default chosen-select-input-style" multiple tabindex="4" id="destinationSelect">
                                                                                <?php
                                                                                if(!empty($destinations)) {
                                                                                    foreach ($destinations as $destination) {
                                                                                        echo '<option value="'.$destination["id"].'">'.$destination["name"].'</option>'.PHP_EOL;
                                                                                        
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <div class="wrong-selection-pannel">
                                                                            <p class="sub-des-heading wrong-selected-text">We can not make travel arrangements to "Delhi".</p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-right pref-top-pad">
                                                                        <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                    <h2 class="black-heading-big">What inspires you?</h2>
                                                                </div>
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                    <div class="row inspiration" id="inspiration">
                                                                    <?php
                                                                    if(!empty($inspirations)) {
                                                                        foreach ($inspirations as $inspiration) {
                                                                            ?>
                                                                            <div class="col-md-3 col-sm-6">
                                                                                
                                                                                        <label for="inspiration_{{$inspiration->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$inspiration->category_image)}}');" class="personalized-service-checkbox-label">
                                                                                            <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$inspiration->category_name}}
                                                                                        </label>
                                                                                        <input id="inspiration_{{$inspiration->id}}" class="personalized-service-checkbox-input" name="inspirations[]" value="{{$inspiration->id}}" type="checkbox">
                                                                                    
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?> 
                                                                    </div>                                                                   
                                                                </div>
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left">                   
                                                                            <input type="button" name="previous" data-prev-id="holiday-destination" holiday-destination class="previous btn btn-default" value="Previous" />
                                                                        </div>
                                                                        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right">
                                                                            <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row" id="experience">
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">What would you like experience</h2>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <div class="row exprerience">
                                                                            <?php
                                                                            if(!empty($experiences)) {
                                                                                foreach ($experiences as $experience) {
                                                                                    ?>
                                                                                    <div class="col-md-3 col-sm-6">
                                                                                        
                                                                                            <div class="form-group ps-fields-align">
                                                                                                <label for="experience_{{$experience->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$experience->category_image)}}');" class="personalized-service-checkbox-label">
                                                                                                    <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$experience->category_name}}
                                                                                                </label>
                                                                                                <input id="experience_{{$experience->id}}" class="personalized-service-checkbox-input" name="experiences[]" value="{{$experience->id}}" type="checkbox">
                                                                                            </div>
                                                                                        
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                                                <input type="button" name="previous" data-prev-id="travel-style"  class="previous btn btn-default" value="Previous" />                           
                                                                            </div>
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                                                <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                                            </div>                                                                        
                                                                        </div>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">What is particularly important to you?</h2>
                                                                        <p class="sub-des-heading">Tell us what you value - the more detailed the better.</p>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <textarea class="form-control ps-text-area-style" name="note" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon." id="preferences_note"></textarea>
                                                                    </div> 
                                                                    
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 help-hover-icon">
                                                                        <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                                    </div>
                                                                
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                                                <input type="button" name="previous" data-prev-id="travel-style" class="previous btn btn-default" value="Previous" />
                                                                            </div>
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                                                <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">                                                                
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">How many people travel?</h2>
                                                                    </div>
                                                                </div>   
                                                                <div class="row m--align-center pref-botoom-pad">
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <p class="sub-des-heading suggestions-headin-tittle spinner-label">Adults</p>
                                                                        <p class="smalldes-label">18* Years</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="ps-adults-handle-counter ps-handle-counter">
                                                                            <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                                            <input class="spinner-input" name="adults" type="text" value="2" id="adults">
                                                                            <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m--align-center pref-botoom-pad">
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <p class="sub-des-heading suggestions-headin-tittle spinner-label">Youth</p>
                                                                        <p class="smalldes-label">12-17 Years</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="ps-youth-handle-counter ps-handle-counter">
                                                                            <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                                            <input class="spinner-input" name="youth" type="text" value="0" id="youth">
                                                                            <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                                <div class="row m--align-center pref-botoom-pad">
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <p class="sub-des-heading suggestions-headin-tittle spinner-label">Children</p>
                                                                        <p class="smalldes-label">2-11 Years</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="ps-children-handle-counter ps-handle-counter">
                                                                            <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                                            <input class="spinner-input" name="children" type="text" value="0" id="children">
                                                                            <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m--align-center pref-botoom-pad"> 
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <p class="sub-des-heading suggestions-headin-tittle spinner-label">Toddlers</p>
                                                                        <p class="smalldes-label">under 2 Years</p>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="ps-toddlers-handle-counter ps-handle-counter">
                                                                            <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                                            <input class="spinner-input" name="toddlers" type="text" value="0" id="toddlers">
                                                                            <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                    <div class="row">
                                                                        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                                            <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                                                        </div>
                                                                        <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                                            <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">When would you like to travel?</h2>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div id="t-preferences-picker" class="rsidebar datepic-max-width t-datepicker">
                                                                            
                                                                                <div class="t-check-in"></div>
                                                                                <div class="t-check-out"></div>
                                                                            
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select class="form-control ps-input-style ps-input-width" name="stay_time" id="stay_time">
                                                                                <option value="1-2 Weeks">1-2 Weeks</option>
                                                                                <option value="2-3 Weeks">2-3 Weeks</option>
                                                                                <option value="3-4 Weeks">3-4 Weeks</option>
                                                                                <option value="4-5 Weeks">4-5 Weeks</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group pref-left-pad-10"> 
                                                                            <div class="m-checkbox-list"> 
																				<label class="m-checkbox m-checkbox--state-primary">
																					<input type="checkbox" name="agree" id="agree" />
																					I Agree
																					<span></span>
																				</label>
																			</div>
                                                                            <div class="error" id="error" style="display: none;">
                                                                                Please check agree checkbox.
                                                                            </div>
                                                                            <span class="m-form__help">
																				Some help text goes here
																			</span>                                                                            
                                                                        </div>
                                                                        <div class="form-group pref-left-pad-10">
                                                                            <div class="m-checkbox-list">
																				<label class="m-checkbox m-checkbox--state-primary">
																					<input type="checkbox" name="privacy_policy" id="privacy_policy" />
																					<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Privacy Policy</a>
																					<span></span>
																				</label>
                                                                            </div>
                                                                            <div class="error" id="privacy_policy_error" style="display: none;">
                                                                                Please check privacy policy checkbox.
                                                                            </div>
                                                                            <span class="m-form__help">
																				Some help text goes here
																			</span>
                                                                         </div>            
																		 <div class="form-group pref-left-pad-10">
                                                                            <div class="m-checkbox-list">
                                                                            	<label class="m-checkbox m-checkbox--state-primary">
																					<input type="checkbox" name="cookie_policy" id="cookie_policy" />
																					<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
																					<span></span>
																				</label>
                                                                            </div>
                                                                            <div class="error" id="cookie_policy_error" style="display: none;">
                                                                                Please check cookie policy checkbox.
                                                                            </div>
                                                                            <span class="m-form__help">
																				Some help text goes here
																			</span>
                                                                         </div>
                                                                    </div>
                                                                    <div class="help-hover-icon">
                                                                        <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season." data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                                                <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                                                            </div>
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                                                <button class="btn btn-default" id="preferences_submit_btn">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">                                            
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                                                    </div> 
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <h2 class="black-heading-big">Thank You</h2>
                                                                    </div> 
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                                                    </div> 
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                           
                                                                    </div>                                                                                                                                       
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                                                <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            
                                                                                                                       
                                                        </form>                                                                                    
                                                 </div>                                                                                                     
                                            </div> */ ?>
    										<!--end: Form Wizard Step 2-->
                                            
                                            <!--begin: Form Wizard Step 6-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                                                <input name="form_wizard_3" type="hidden" id="form_wizard_3" value="3" />  
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
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top" id="dv_pkg">
                                                            
                                                            <div class="form-group m-form__group row">
                                                                <div class="m-portlet__body" style="width:100%;">
                                                    				
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_membershiptype" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    <?php 
                                                                                        $cart_session_arr = array();
                                                                                        $cart_session = (\Session::get('hotel_cart'));
                                                                                        if(!empty($cart_session)){
                                                                                            $cart_session_arr = $cart_session;
                                                                                        } 
                                                                                    ?>
                                                                                    {{--*/ $k=1; /*--}}
                                                                                    {{--*/ $m=0; /*--}} 
                                                                                    {{--*/ $prc_flag = 0; /*--}} 
                                                                                    @foreach($packages as $key=>$package) 
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head <?php echo ($m==0) ? '' : 'collapsed' ?>"  role="tab" id="m_accordion_item_membershiptype_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_item_membershiptype_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}}
                                                                                               @if($package->package_price_type!=2) Price: {!! isset($currency->content)?$currency->content:'&euro;' !!}  {{ number_format($package->package_price,2) }} @endif                                                                                               
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body <?php echo ($m==0) ? 'show' : 'collapse' ?>" id="m_accordion_item_membershiptype_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_item_membershiptype_{{ $k }}_head" data-parent="#m_accordion_membershiptype">
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
                                                                                                                    @if($package->package_price_type==2)
                                                                                                                        <input type="hidden" name="hid_package" value="{{$package->id}}" />    
                                                                                                                    @else
                                                                                                                        {{--*/ $prc_flag = 1; /*--}}
                                                                                                                        @if($package->package_price_type!=1)                                                                                          
                                                                                                                            <h6>{!! isset($currency->content)?$currency->content:'&euro;' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                        @else
                                                                                                                            <h6><a href="#" class="btn btn-primary priceonrequest">Request Consultation</a></h6>   
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>                
                                                                                                          
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                <?php /* <div class="row" style="margin-top: 10px;">
                                                                                                    
                                                                                                    <div class="col-xl-8 col-sm-8 col-md-8 col-lg-8">
                                                                                                        
                                                                                                    </div>
                                                                                                    <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 m--align-right">
                                                                                                        <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price_type==1 ? -1 : $package->package_price }});" class="btn btn-success" id="add_to_{{$package->id}}">Add to cart</a>
                                                                                                    </div>
                                                                                                    
                                                                                                </div> */ ?>
                                                                                               
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    {{--*/ $m++;  /*--}}
                                                                                    
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
                                					       </div>
                                                           <div class="col-lg-12 m--align-right" id="pgk_continue_btn">                     						                                                              <input type="hidden" name="hid_ptype" value="{{$prc_flag}}" />
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
    
 <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="agree_model" tabindex="-1" role="dialog" aria-labelledby="agreeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Privacy & Data Protection
    				</h5>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        
                        <form class="m-form">
                        <div class="m-portlet__body">
                            <div class="form-group pref-left-pad-10"> 
                                <div class="m-checkbox-list"> 
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="modal_agree" id="modal_agree" value="1" />
										I Agree to the Emporium-Voyage Privacy & Data Protection Policy
										<span></span>
									</label>
								</div>
                                <div class="error" id="modal_error" style="display: none;">
                                    Please agree to the Privacy & Data Protection Policy.
                                </div>
                                <span class="m-form__help">
									 I agree that my personal data will be collected and stored and used electronically to help the reservation agents with specialized offers pertaining to my travel preferences. 
Note: You may revoke your consent at any time by e-mail to info@emporium-voyage.com or from your settings section in your account admin.
								</span>                                                                            
                            </div>
                            <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
									<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="modal_privacy_policy" id="modal_privacy_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Emporium-Voyage Privacy Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="modal_privacy_policy_error" style="display: none;">
                                    Please check privacy policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Privacy Policy.
								</span>
                             </div>            
							 <div class="form-group pref-left-pad-10">
                                <div class="m-checkbox-list">
                                	<label class="m-checkbox m-checkbox--state-primary">
										<input type="checkbox" name="modal_cookie_policy" id="modal_cookie_policy" value="1" />
										<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
										<span></span>
									</label>
                                </div>
                                <div class="error" id="modal_cookie_policy_error" style="display: none;">
                                    Please check cookie policy checkbox.
                                </div>
                                <span class="m-form__help">
									I have read and agree to the Emporium-Voyage Cookie Policy
								</span>
                             </div>
                        </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-primary" id="contractacceptbtn">Accept</button>
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->
<!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="request_type_model" tabindex="-1" role="dialog" aria-labelledby="requesttypeModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
                {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'request_type_form' ,'files' => true)) !!}
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Request Type
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
                                    <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_companyname" class="form-control" placeholder="Company name" required="required" value="{{ $company->company_name }}" />
                                    </div> 
                                </div>
                                
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_email" class="form-control" placeholder="Email" required="required" value="{{ $company->company_email }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_address" class="form-control" placeholder="Address" required="required" value="{{ $company->company_address }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_city" class="form-control" placeholder="City" required="required" value="{{ $company->company_city }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">State</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_state" class="form-control" placeholder="State" required="required" value="{{ $company->company_state }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_country" class="form-control" placeholder="Country" required="required" value="{{ $company->company_country }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Zip Code</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_zipcode" class="form-control" placeholder="Zip Code" required="required" value="{{ $company->company_postal_code }}" />
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
											<input type="text" name="onrequest_vatnumber" class="form-control" id="onrequest_vatnumber" required="required" value="{{ $company->company_tax_number }}" />  
										</div>
									</div>
                                </div>
                                                    
                            </div>
                        </div>
                        
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
    			</div>
                {!! Form::close() !!}
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up--> 
 <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="request_type_person_model" tabindex="-1" role="dialog" aria-labelledby="requestTypePersonModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
                {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'request_type_person_form' ,'files' => true)) !!}
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Request Type
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
                                    <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_person_address" class="form-control" placeholder="Address" required="required" value="{{ $user->address }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_person_city" class="form-control" placeholder="City" required="required" value="{{ $user->city }}" />
                                    </div> 
                                </div>
                                
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_person_country" class="form-control" placeholder="Country" required="required" value="{{ $user->country }}" />
                                    </div> 
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Zip Code</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="onrequest_person_zipcode" class="form-control" placeholder="Zip Code" required="required" value="{{ $user->zip_code }}" />
                                    </div> 
                                </div>
                                
                                
                                <div class="form-group m-form__group row">
									<label class="col-xl-3 col-lg-3 col-form-label">
										European
									</label>
									<div class="col-xl-9 col-lg-9">
                                        <div class="m-radio-inline">
                							<label class="m-radio">
                							     <input type="radio" name="onrequest_person_european" value="1" <?php echo $user->european==1 ? 'checked="checked"' : ''; ?> />
                                                    Yes
                                                 <span></span>
                							</label>
                                            <label class="m-radio">
                							     <input type="radio" name="onrequest_person_european" value="0" <?php echo $user->european==0 ? 'checked="checked"' : ''; ?> />
                                                    No
                                                 <span></span>
                							</label>
                						</div>
                                    </div>
                                </div>                                
                                <div id="dv_person_vat_no">
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
											<input type="text" name="onrequest_person_vatnumber" class="form-control" id="onrequest_person_vatnumber" required="required" value="{{ $user->vat_number }}" />  
										</div>
									</div>
                                </div>
                                
                                
                            </div>
                        </div>
                        
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">    				
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
    			</div>
                {!! Form::close() !!}
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->   
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
    <!--<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>-->
    <style>
    #m_accordion_membershiptype p{
        font-family: poppins !important;
    }
    .m-content>div:nth-child(even) .row{
        background: none; 
        padding: 0px 0px 30px;
        margin: 0px;
    }
    </style>
@endsection

{{-- For custom script --}}
@section('custom_js_script')
    @parent
        <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
        <script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
        <script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
        <script>
            var base_url = '{{ url() }}';
            function addToCartHotel(PackageID,PackagePrice){               
                var PackagePrice=PackagePrice;
                var PackageID=PackageID;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Package added to cart successfully.");
                    $("#pgk_continue_btn").css('display', '');
                }
                };
                xhttp.open("GET", "{{ URL::to('traveller/add_package_to_cart_wizard')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
                xhttp.send();
            
            } 
            function removeItemFromCart(PackageID){    
    
                //var PackagePrice=PackagePrice;
                var PackageID=PackageID;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    $.ajax({
                        url:base_url+'/traveller/get_cart', 
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


            $(document).ready(function () {
               var _euro = $("input[name=european]:checked").val();
               
               if(_euro!=0){
                    $("#dv_vat_no").css('display', ''); 
               }else{ 
                    $("#dv_vat_no").css('display', 'none');
               }
               $("input[name=european]").click(function(){
                    var europo_val = $("input[name=european]:checked").val();
                    
                    if(europo_val==0){
                        $("#dv_vat_no").css('display', 'none');
                        $("#onrequest_vatnumber").removeAttr('required');
                    }else{
                        $("#dv_vat_no").css('display', '');
                        $("#onrequest_vatnumber").attr('required', 'required');
                    }
               });
               
               var _euro2 = $("input[name=onrequest_person_european]:checked").val();
               
               if(_euro2!=0){ 
                    $("#dv_person_vat_no").css('display', ''); 
               }else{ 
                    $("#dv_person_vat_no").css('display', 'none');
               }
               $("input[name=onrequest_person_european]").click(function(){
                    var europo_val = $("input[name=onrequest_person_european]:checked").val();                    
                    if(europo_val==0){
                        $("#dv_person_vat_no").css('display', 'none');
                        $("#onrequest_person_vatnumber").removeAttr('required');
                    }else{
                        $("#dv_person_vat_no").css('display', '');
                        $("#onrequest_person_vatnumber").attr('required', 'required');
                    }
               });
                $('#request_type_form').validate({
        			submitHandler: function (form) {
        				 $.ajax({
                            url:"{{URL::to('traveller/businessdetails')}}",
                            type:'POST',
                            dataType:'json',
                            data:$(form).serializeArray(),                   
                            success:function(response){
                                if(response.status == 'success'){
                                    toastr.success(response.message);
                                    $("#request_type_model").modal('hide'); 
                                }
                                else{
                                    toastr.error(response.message);
                                }
                            }
                        });
        				return false;
        			}            		
                });
                $('#request_type_person_form').validate({
        			submitHandler: function (form) {
        				 $.ajax({
                            url:"{{URL::to('traveller/persondetails')}}",
                            type:'POST',
                            dataType:'json',
                            data:$(form).serializeArray(),                   
                            success:function(response){
                                if(response.status == 'success'){
                                    toastr.success(response.message);
                                    $("#request_type_person_model").modal('hide'); 
                                }
                                else{
                                    toastr.error(response.message);
                                }
                            }
                        });
        				return false;
        			}            		
                });
            <?php 
                if($logged_user->i_agree == 0 || $logged_user->privacy_policy == 0 || $logged_user->cookie_policy == 0){ ?>
                    $("#agree_model").modal({backdrop: 'static', keyboard: false}, 'show');
            <?php } ?>
            
            $("#continue_btn").click(function(e){
                e.preventDefault();
                var prc  = $('input[name="hid_ptype"]').val(); 
                
;                if(prc>0){                         
                    $.ajax({
                        url:base_url+'/traveller/get_cart', 
                        type:'get',    
                       
                        success:function(response){ 
                            
                            $("#cart_row").css('display', '');
                            $("#cart_row").html('');
                            $("#dv_pkg").css('display', 'none');
                            $("#cart_row").html(response);   
                            
                            
                        }
                    });
                }else{
                    hid_package = $('input[name="hid_package"]').val();
                    
                    $.ajax({
                        url:base_url+'/traveller/free_membership',
                        type:'post',
                        dataType:'json', 
                        data:{hid_package:hid_package},                      
                        success:function(response){ //console.log(response);
                            if(response.status=="success"){
                                window.location.href=base_url+'/traveller/thanks/'+response.order_id;
                            }
                            //$("#cart_row").css('display', '');
                            //$("#cart_row").html('');
                            //$("#dv_pkg").css('display', 'none');
                            //$("#cart_row").html(response);   
                            
                            
                        }
                    });   
                }
            });
            
            $(document).on('click', '.rdocheckouttype', function(e){                
                var typeVal = $(this).val();
                if(typeVal=="business"){
                    $("#request_type_model").modal('show');
                }else{
                    $("#request_type_person_model").modal('show');
                }
            });
            
            $(document).on('click','#checkout_btn',function(e){
                e.preventDefault();
                var chktype = $('input:radio[name="checkouttype"]:checked').length;
                if(chktype > 0){
                    var chkval = $('input:radio[name="checkouttype"]:checked').val();
                    
                    $.ajax({
                        url:base_url+'/traveller/get_checkout', 
                        type:'post',
                        data:{chkval:chkval},
                        dataType:'json',
                        success:function(response){ console.log(response);
                            if(response.status=="success"){
                                $("#cart_row").css('display', '');
                                $("#cart_row").html('');
                                $("#dv_pkg").css('display', 'none');
                                $("#cart_row").html(response.response_data);   
                            }else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }else{
                    toastr.error("Please select atleast one type");
                } 
            });
            /*$(document).on('click','#checkout_btn',function(e){
                e.preventDefault();
                var chktype = $('input:radio[name="checkouttype"]:checked').length;
                if(chktype > 0){
                    $.ajax({
                        url:base_url+'/traveller/get_checkout', 
                        type:'get',
                        success:function(response){ console.log(response);
                            $("#cart_row").css('display', '');
                            $("#cart_row").html('');
                            $("#dv_pkg").css('display', 'none');
                            $("#cart_row").html(response);   
                            
                            
                        }
                    });
                }else{
                    toastr.error("Please select atleast one type");
                } 
            });*/
            
            $(document).on('click','#choose_pkg_btn',function(e){
                e.preventDefault();
                $("#dv_pkg").css('display', '');
                $("#cart_row").css('display', 'none');
            });

            
            $("#contractacceptbtn").click(function(){ 
                var error = true;
                var agree = 0;
                var privacy_policy = 0;
                var cookie_policy = 0;
                if($("#modal_agree").is(":checked")){
                    agree = $("#modal_agree").val();
                    $("#modal_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#modal_error").css("display", "");
                }
                if($("#modal_privacy_policy").is(":checked")){
                    privacy_policy = $("#modal_privacy_policy").val();
                    $("#modal_privacy_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#modal_privacy_policy_error").css("display", "");
                }
                if($("#modal_cookie_policy").is(":checked")){
                    cookie_policy = $("#modal_cookie_policy").val();
                    $("#modal_cookie_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#modal_cookie_policy_error").css("display", "");
                }
                
                
                if(error){ console.log("error");
                    
                }else{
                    var fdata = new FormData();                
                    fdata.append("_token",$("input[name=_token]").val());                    
                    
                    fdata.append("agree", agree); 
                    fdata.append("privacy_policy", privacy_policy);
                    fdata.append("cookie_policy", cookie_policy);
                    
                    $.ajax({
                        url:"{{URL::to('user/iagree')}}",
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
                                $("#agree_model").modal('hide');
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
                
                // Multi Tab Form
                var current_fs, next_fs, previous_fs;
                var left, opacity, scale;
                var animating;

                $(".next").click(function () {                    
                    current_fs = $(this).closest( ".personalized-pefrences" );
                    next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
                    current_fs.addClass('m--hide');    
                    $("#personalized-skip").removeClass('m--hide');                
                });

                $(".previous").click(function () {                    
                    current_fs = $(this).closest( ".personalized-pefrences" );
                    next_fs = $(current_fs).prev(".personalized-pefrences").removeClass('m--hide');                    
                    current_fs.addClass('m--hide'); 
                    $("#personalized-skip").removeClass('m--hide');    
                });

                $(".submit").click(function () {
                    return false;
                });
                
                $('#t-preferences-picker').tDatePicker({
                    'numCalendar':'1',
                    'autoClose':true,
                    'durationArrowTop':'200',
                    'formatDate':'dd-mm-yyyy',
                    'titleCheckIn':'Earliest Arrival',
                    'titleCheckOut':'Late Check Out',
                    'inputNameCheckIn':'preferences_arrive',
                    'inputNameCheckOut':'preferences_late_check_out',
                    'titleDateRange':'days',
                    'titleDateRanges':'days',
                    'iconDate':'<i class="fa fa-calendar"></i>',
                    'limitDateRanges':'365',
                    'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
                    'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
                });
                
                
                $('.personalized-service-checkbox-label').click(function (e) {
                    $(this).toggleClass('active').siblings().removeClass('active');
                });
                // Tooltip
                $('[data-toggle="tooltip"]').tooltip();
                //Input Spinner
                var options = {
                    minimum: 1,
                    maximize: 10,
                    onMinimum: function (e) {
                        console.log('reached minimum: ' + e);
                    },
                    onMaximize: function (e) {
                        console.log('reached maximize' + e);
                    }
                };
                
                $('.ps-adults-handle-counter').handleCounter({minimum:1, maximize: 100});
                $('.ps-youth-handle-counter').handleCounter({minimum:0, maximize: 100});
                $('.ps-children-handle-counter').handleCounter({minimum:0, maximize: 100});
                $('.ps-toddlers-handle-counter').handleCounter({minimum:0, maximize: 100});
                
                //Progress Bar
                var clicks = 1;
                $('.progress-bar-btn-increment').on('click', function () {
                    clicks++;
                    var percent = Math.min(Math.round(clicks / 3 * 100), 100);
                    percent = 25 * clicks;
                    $('.progress-bar-inner').width(percent + '%');
                });
                $('.progress-bar-btn-decrement').on('click', function () {
                    clicks--;
                    var percent = Math.min(Math.round(clicks / 3 * 100), 100);
                    percent = 25 * clicks;
                    $('.progress-bar-inner').width(percent + '%');
                });
                /*//Date Range Picker
                $(".get-travel-details").dateRangePicker({
                        selectForward: (Boolean),
                        stickyMonths: (Boolean),
                        startDate: "12-01-2017",
                        format: ' DD.MM.YYYY',
                        separator: ' to ',
                        getValue: function () {
                            if ($('.get-earliest-arrival').val() && $('.get-checkout-date').val())
                                return $('.get-earliest-arrival').val() + ' to ' + $('.get-checkout-date').val();
                            else
                                return '';
                        },
                        setValue: function (s, s1, s2) {
                            $('.get-earliest-arrival').val(s1);
                            $('.get-checkout-date').val(s2);
                        }
                    }
                ).bind('datepicker-first-date-selected', function (event, obj) {
                    $(".get-checkout-date").val('');
                });*/
                
                /* steps */
               /* $(".next").click(function(){
                    $('.stepwizard-step').find('a').attr("disabled","disabled");
                    var next_value = $(this).data('next-id');
                    $('.'+next_value).removeAttr('disabled');
                 });
                $(".previous").click(function(){
                    $('.stepwizard-step').find('a').attr("disabled","disabled");
                    var pre_value = $(this).data('prev-id');
                    $('.'+pre_value).removeAttr('disabled');
                 });*/
                 /* steps */
            });
        </script>
        
        <!-- toggle responsive top bar-->
                <script>
                    $(".TopbarSearch").click(function(){
                        $(".ResponsiveTopbar").toggle();    
                    });
                </script>
        <!-- toggle responsive top bar end-->
        
        
        <!-- responsive left menu toggle -->

        <script>
         function openNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "100%";
            }

            function closeNav() {
                document.getElementById("editorial-siden-nav-res").style.width = "0";
            }
        </script>
        
        <!-- responsive left menu toggle end -->
    <script>
    
    
    
        $(document).ready(function(){
            
           $("#personalized-skip").click(function(e){ 
                e.preventDefault();
                console.log("ggg");           
                var fdata = new FormData();                
                fdata.append("_token",$("input[name=_token]").val());
                fdata.append("form_wizard",$("input[name=form_wizard_2]").val()); 
                console.log(fdata);
                $.ajax({
                    url:"{{URL::to('traveller_skip_preferences')}}",
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
           $("#preferences_submit_btn").click(function(e){ 
                e.preventDefault();
                
                var destinations=[];
                var i = 0;
                $('#destinationSelect :selected').each(function(){
                     destinations[i]=$(this).val();
                     i++;
                });
                
                var insperations=[];
                var j = 0;
                $('#inspiration .personalized-service-checkbox-input:checked').each(function () {
                   insperations[j] = $(this).val();
                   j++;
                }); 
                
                var experiences=[];
                var k = 0;
                $('#experience .personalized-service-checkbox-input:checked').each(function () {
                   experiences[k] = $(this).val();
                   k++;
                }); 
                
                var note = $("#preferences_note").val();
                
                var error = true;
                if($("#agree").is(":checked")){
                    $("#error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#error").css("display", "");
                }
                if($("#privacy_policy").is(":checked")){
                    $("#privacy_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#privacy_policy_error").css("display", "");
                }
                if($("#cookie_policy").is(":checked")){
                    $("#cookie_policy_error").css("display", "none");
                    error = false;
                }else{
                    error = true;
                    $("#cookie_policy_error").css("display", "");
                }
                
                
                if(error){ console.log("error");
                    //$("#error").css("display", "");
                }else{                    
                    $("#error").css("display", "none");
                    var fdata = new FormData();                
                    fdata.append("_token",$("input[name=_token]").val());
                    fdata.append("form_wizard",$("input[name=form_wizard_2]").val()); 
                    
                    fdata.append("destinations", destinations); 
                    fdata.append("inspirations", insperations);
                    fdata.append("experiences", experiences);
                    fdata.append("note", note);
                    fdata.append("adults",$("input[name=adults]").val());
                    fdata.append("youth",$("input[name=youth]").val());
                    fdata.append("children",$("input[name=children]").val());
                    fdata.append("toddlers",$("input[name=toddlers]").val());
                    
                    
                    fdata.append("earliest_arrival",$("input[name=preferences_arrive]").val());
                    fdata.append("late_check_out",$("input[name=preferences_late_check_out]").val());
                    
                    fdata.append("stay_time",$('#stay_time :selected').val());
                    $.ajax({
                        url:"{{URL::to('personalized-service/ajax_save')}}",
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
                                current_fs = $("#preferences_submit_btn").closest( ".personalized-pefrences" );
                                next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
                                current_fs.addClass('m--hide');  
                                $("#personalized-skip").addClass('m--hide');
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    }); 
                }
           });
        });
    </script>
@endsection

@section('script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/traveller_wizard.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
