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
            <!--Begin::Main Portlet-->
            <div class="m-portlet m-portlet--full-height">
				<!--begin: Portlet Head-->
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Update Your Profile
							</h3>
						</div>
					</div>					
				</div>
				<!--end: Portlet Head-->
                <!--begin: Portlet Body-->
				<div class="m-portlet__body m-portlet__body--no-padding">
					<!--begin: Form Wizard-->
					<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
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
														{{ Lang::get('core.personalinfo') }}
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
														Hotel Information
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
														Packages
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
														Advertisement Packages
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
														Checkout
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
                                        {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'m_form' ,'files' => true)) !!}
                                        <div class="m-portlet__body m-portlet__body--no-padding">
                                            <input type="hidden" name="base_url" id="base_url" value="{{ url() }}" />
                                            <!--begin: Form Wizard Step 1-->
    										<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                                <input name="form_wizard" type="hidden" id="form_wizard" value="1" />  
    											<div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														{{ Lang::get('core.personalinfo') }}
    													</h3>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Username:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="username" type="text" id="username" class="form-control m-input" required  value="" />  
    													</div>
    												</div>
    												<div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 {{ Lang::get('core.firstname') }} 
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														{{ Lang::get('core.lastname') }}
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="" required="">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
                                						<label class="col-xl-3 col-lg-3 col-form-label">Phone</label>
                                						<div class="col-xl-9 col-lg-9">          
                                							<input type="text" name="txtPhoneNumber" value="" id="txtPhoneNumber" class="form-control dash-input-style" placeholder="+91-9876543210" required="">
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
                                                                  @if(!empty($info->avatar))
                                                                    <span class="fileinput-exists"> Change</span>
                                                                  @endif
                                                                    
                                                					<input type="file" name="avatar">
                                                				</span>
                                                                <span class="fileinput-filename"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                                <br />
                                                    			Image Dimension 80 x 80 px <br />
                                                    			<?php /* {!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!} */ ?>
                                                            </div>
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-12 m-form__group-sub">     					                                
                                							<div class="m-checkbox-inline">
                                								<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                									<input type="checkbox" id="newsLetter" name="newsLetter">      								
                                									Subscribe to our notifications and news to our latest hotels, spa's and offers. 
                                                                    <span></span>
                                								</label>
                                							</div>
                                						 </div>			
                                					</div>
                                					
                                					<div class="form-group m-form__group row">
                                						<div class="col-12 m-form__group-sub" id="contractSignCheckmain">
                                                            <div class="m-checkbox-inline">
                                    							<label class="m-checkbox m-checkbox--solid m-checkbox--brand" data-toggle="modal" data-target="#myModal">
                                    							     <input type="checkbox"  id="contractSignCheck" name="contractSignCheck" value="">
                                                                     View terms of contract.
                                                                     <span></span>
                                    							</label>
                                                                
                                                                
                                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" style="display: none;" aria-hidden="true">
                                                                   <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                     <div class="modal-header">
                                                                      <h4 class="modal-title">Contract Section</h4>
                                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                       <span aria-hidden="true">
                                                                        �
                                                                       </span>
                                                                      </button>
                                                                     </div>
                                                                     <div class="modal-body">
                                                                      <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
                                                                       <!--begin::Item-->
                                                                       
                                                                       <?php
                                                    	                    if(!empty($contractdata)) {
                                                    	                        $sn = 0;
                                                    	                        foreach ($contractdata as $row) {
                                                    	                            ?>
                                                    	                             <div class="m-accordion__item">
                                                    	                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_<?php echo $sn; ?>_head" data-toggle="collapse" href="#m_accordion_1_item_<?php echo $sn; ?>_body" aria-expanded="    false">
                                                                                            <span class="m-accordion__item-icon">
                                                                                              <i class="fa flaticon-information"></i>
                                                                                            </span>
                                                                                            <span class="m-accordion__item-title">
                                                                                              <?php echo $row->title; ?>
                                                                                            </span>
                                                                                            <span class="m-accordion__item-mode"></span>                          
                                                    	                                </div>
                                                                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_<?php echo $sn; ?>_body" role="tabpanel" aria-labelledby="m_accordion_1_item_<?php echo $sn; ?>_head" data-parent="#m_accordion_<?php echo $sn; ?>">
                                                                                             <div class="m-accordion__item-content">
                                                                                              <p>
                                                                                               <?php echo nl2br($row->description); ?>
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
                                                                     <div class="modal-footer">
                                                                  		<div class="col-sm-12 col-md-9 text-left">
                                                            						<div class="col-12 m-checkbox-inline" id="contractSignCheck">
                                                            							<label class="m-checkbox m-checkbox--solid m-checkbox--brand" data-toggle="modal" data-target="#myModal">
                                                            							     <input type="checkbox"  id="contractSignCheckFinal" name="contractSignCheckFinal" value="accepted" required="">
                                                                                             I hereby accept the terms of contract.
                                                                                             <span></span>
                                                            							</label>
                                                            						</div>
                                                    			         </div>
                                                                         
                                                                         <div class="col-sm-12 col-md-3 text-right">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                         </div>
                                                                      </div>
                                                                    </div>
                                                                   </div>
                                                                  </div>
                                                                
                                                                
                                                            </div>
                                						</div>
                                					</div>
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 1-->
                                            
                                            <!--begin: Form Wizard Step 2-->
    										<div class="m-wizard__form-step" id="m_wizard_form_step_2">
    											<div class="m-form__section m-form__section--first">
    												<div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														{{ Lang::get('core.companydetails') }}
    													</h3>
    												</div>
                                                    <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />
                                                    <input name="compedit_id" type="hidden" id="compedit_id" value="" />
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Firmenname
                                								</label>
                                									<input name="company_name" type="text" id="company_name" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Inhaber
                                								</label>
                                									<input name="company_owner" type="text" id="company_owner" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Ansprechpartner
                                								</label>
                                									<input name="contact_person" type="text" id="contact_person" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" />
                                                            </div> 
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    E-Mail Adresse
                                								</label>
                                									<input name="company_email" type="text" id="company_email" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Phone #
                                								</label>
                                									<input name="company_phone" type="text" id="company_phone" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_phone; } ?>" />
                                                            </div> 
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Website
                                								</label>
                                									<input name="company_website" type="text" id="company_website" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_website; } ?>" />
                                                            </div> 
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Tax #
                                								</label>
                                									<input name="company_tax_no" type="text" id="company_tax_no" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>" />
                                                            </div>    
                                                        </div><!-- //col-lg-6 m-form__group-sub -->
                                                        <div class="col-lg-6">
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Adresse
                                								</label>
                                									<input name="company_address" type="text" id="company_address" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_address; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Adresse
                                								</label>
                                									<input name="company_address2" type="text" id="company_address2" class="form-control m-input"  value="<?php if(!empty($extra)) { echo $extra->company_address2; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    ORT
                                								</label>
                                									<input name="company_city" type="text" id="comapny_city" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_city; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Pin
                                								</label>
                                									<input name="company_postal_code" type="text" id="company_postal_code" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_postal_code; } ?>" maxlength="6" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                                                                <label for="ipt" class="form-control-label">
                                								    Land
                                								</label>
                                									<input name="company_country" type="text" id="comapny_country" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_country; } ?>" />
                                                            </div>
                                                            <div class="form-group m-form__group">
                            									<label for="ipt" class="form-control-label">
                            										Firmenlogo
                            									</label>
                        										<div class="fileinput fileinput-new" data-provides="fileinput">
                                                				  <span class="btn btn-primary btn-file">
                                                					   <span class="fileinput-new">Hochladen</span>
                                                                       @if(!empty($extra->company_logo))
                                                                        <span class="fileinput-exists">Change</span>
                                                                       @endif 
                                                					   <input type="file" name="company_logo">
                                                				    </span>
                                                					<span class="fileinput-filename"></span>
                                                					<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                				</div>
                                                				<br />
                                                				 Image Dimension 155 x 30 px <br />
                                                				@if(!empty($extra))
                                                				{!! SiteHelpers::showUploadedFile($extra->company_logo,'/uploads/users/company/',155, 30, '') !!}
                                                				@endif  
                            								</div>
                                                        </div><!-- //col-lg-6 m-form__group-sub -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 tax-minhead">
                                                            <span class="minhead">Tax Info</span>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group m-form__group row">
                            									<label for="ipt" class="col-md-5 col-2 col-form-label">
                            										Steuernummer
                            									</label>
                            									<div class="col-7">
                            										<input name="steuernummer" type="text" id="steuernummer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>"/>  
                            									</div>
                            								</div>
                                                            <div class="form-group m-form__group row">
                            									<label for="ipt" class="col-md-5 col-2 col-form-label">
                            										Umsatzsteuer ID
                            									</label>
                            									<div class="col-7">
                            										<input name="umsatzsteuer_id" type="text" id="umsatzsteuer_id" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>"/>  
                            									</div>
                            								</div>
                                                            <div class="form-group m-form__group row">
                            									<label for="ipt" class="col-md-5 col-2 col-form-label">
                            										Gesch&auml;ftsf&uuml;hrer
                            									</label>
                                                               
                            									<div class="col-7">
                            										<input name="gesch&auml;ftsf&uuml;hrer" type="text" id="gesch&auml;ftsf&uuml;hrer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>"/>  
                            									</div>
                            								</div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group m-form__group row">
                            									<label for="ipt" class="col-md-5 col-2 col-form-label">
                            										Handelsregister
                            									</label>
                            									<div class="col-7">
                            										<input name="handelsregister" type="text" id="handelsregister" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>"/>  
                            									</div>
                            								</div>
                                                            <div class="form-group m-form__group row">
                            									<label for="ipt" class="col-md-5 col-2 col-form-label">
                            										Amtsgericht
                            									</label>
                            									<div class="col-7">
                            										<input name="amtsgericht" type="text" id="amtsgericht" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->amtsgericht; } ?>" maxlength="6"/>  
                            									</div>
                            								</div>
                                                        </div>
                                                    </div>
    											</div>
    										</div>
    										<!--end: Form Wizard Step 2-->
                                            <!--begin: Form Wizard Step 3-->
    										<div class="m-wizard__form-step" id="m_wizard_form_step_3">
    											<div class="m-form__section m-form__section--first">
    												<div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														{{ Lang::get('core.user_slider_ads') }}
    													</h3>
    												</div>
                                                    <div class="form-group m-form__group row">
                        								<div class="col-12 ml-auto">
                        									<h3>Slider Advertisement Costs you {{(!empty($slider_ads_price))? $def_currency->content.$slider_ads_price->content:''}} and is valid for {{(!empty($slider_ads_expiry_days))?$slider_ads_expiry_days->content:''}} days.</h3>
                        								</div>
                        							</div>
                                                    <input name="form_wizard_3" type="hidden" id="form_wizard_3" value="3" />
                                                    <input name="adscurrency" type="hidden" class="form-control input-sm" value=""/> 
                                                    <input name="adsType" type="hidden" class="form-control input-sm" value="slider"/> 
                                            		<input name="adsprice" type="hidden" class="form-control input-sm" value=""/>
                                                    <input name="adsvalidation" type="hidden" class="form-control input-sm" value=""/> 
                                            		<input name="advedit_id" type="hidden" class="form-control input-sm" value=""/>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_image') }}
                            								</label>
                            								<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <span class="btn btn-primary btn-file">
                                                			  	  <span class="fileinput-new">Hochladen</span>
                                                                  <?php /* @if(!empty(@$slider_ads_info->adv_img))
                                                                    <span class="fileinput-exists"> Change</span>
                                                                  @endif */ ?>
                                                                  <input type="file" name="advertise_img"/>
                                                				</span>
                                                                <span class="fileinput-filename"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                                <br />
                                                    			<?php /* @if(!empty($slider_ads_info))
                                                					{!! SiteHelpers::showUploadedFile($slider_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                                                				  @endif */ ?>
                                                            </div>
                                                        </div>
                        							</div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label class="form-control-label">
    															{{ Lang::get('core.ads_link') }}
    														</label>
    														<input name="adslink" type="text" id="adslink" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_link:''}}" />  
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label class="form-control-label">
    															{{ Lang::get('core.ads_title') }}
    														</label>
    														<input name="adstitle" type="text" id="adstitle" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_title:''}}" />   
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label class="form-control-label">
    															{{ Lang::get('core.ads_description') }}
    														</label>
    														<input name="adsdesc" type="text" id="adsdesc" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_desc:''}}" />     
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label class="form-control-label">
    															{{ Lang::get('core.ads_category') }}
    														</label>
    														<select id="ads_slider_cat" name="ads_slider_cat" required class="form-control m-input">
                                            					<option value="">-- Select --</option>
                                            					<option value="Hotel" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Hotel")?'selected="selected"':''}}>Hotel</option>
                                            					<option value="Villas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Villas")?'selected="selected"':''}}>Villas</option>
                                            					<option value="Yachts" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Yachts")?'selected="selected"':''}}>Yachts</option>
                                            					<option value="Safari Lodges" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Safari Lodges")?'selected="selected"':''}}>Safari Lodges</option>
                                            					<option value="Spas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Spas")?'selected="selected"':''}}>Spas</option>
                                            				</select>    
                                                        </div>
                                                    </div>
                                                    <?php $curdate = date('Y-m-d'); 
					                               if((!empty($slider_ads_info) && $slider_ads_info->adv_expire>=$curdate) || (!empty($slider_ads_price) && $slider_ads_price->content==0)){ ?>
    											     <input name="pay" type="hidden" class="form-control input-sm" value="no"/> 
                                                
                                                <?php } else { ?>
                                                    <input name="pay" type="hidden" class="form-control input-sm" value="yes"/>
                                                <?php } ?>
    											</div>
    										</div>
    										<!--end: Form Wizard Step 3-->
                                            
                                            <!--begin: Form Wizard Step 4-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_4">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														{{ Lang::get('core.user_sidebar_ads') }}
    													</h3>
    												</div>
                                                    <div class="form-group m-form__group row">
                        								<div class="col-12 ml-auto">
                        									<h3>Sidebar Advertisement Costs you {{(!empty($sidebar_ads_price))? $def_currency->content.$sidebar_ads_price->content:''}} and is valid for {{(!empty($sidebar_ads_expiry_days))?$sidebar_ads_expiry_days->content:''}} days.</h3>
                        								</div>
                        							</div>
                                                    <input name="form_wizard_4" type="hidden" id="form_wizard_4" value="4" />
                                                    <input name="adscurrency_2" type="hidden" class="form-control input-sm" value=""/> 
                                                    <input name="adsType_2" type="hidden" class="form-control input-sm" value="sidebar"/> 
                                                    <input name="adsprice_2" type="hidden" class="form-control input-sm" value=""/> 
                                                    <input name="adsvalidation_2" type="hidden" class="form-control input-sm" value=""/> 
                                                    <input name="advedit_id_2" type="hidden" class="form-control input-sm" value=""/>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label class="form-control-label">
        														{{ Lang::get('core.ads_image') }}
        													</label>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <span class="btn btn-primary btn-file">
                                                			  	  <span class="fileinput-new">Hochladen</span>
                                                                   <?php /* @if(!empty(@$sidebar_ads_info->adv_img))
                                                                    <span class="fileinput-exists"> Change</span>
                                                                  @endif */ ?>
                                                                  <input type="file" name="advertise_img_2"/>
                                                				</span>
                                                                <span class="fileinput-filename"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                                <br />
                                                    			<?php /* @if(!empty($sidebar_ads_info))
                                                					{!! SiteHelpers::showUploadedFile($sidebar_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                                                				  @endif */ ?>
                                                            </div>
                                                        </div>
                        							</div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_link') }}
                            								</label>
                            								<input name="adslink_2" type="text" id="side_adslink" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_link:''}}" />  
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_title') }}
                            								</label>
                            								<input name="adstitle_2" type="text" id="side_adstitle" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_title:''}}" />  
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_description') }}
                            								</label>
                            								<input name="adsdesc_2" type="text" id="side_adsdesc" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_desc:''}}" />  
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_category') }}
                            								</label>
                            								<select name="adsCat_2" id="adsCat_2" class="form-control m-input">
                                            					<option value="">-- Select --</option>
                                            					<option value="Hotel" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Hotel")?'selected="selected"':''}}>Hotel</option>
                                            					<option value="Villas" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Villas")?'selected="selected"':''}}>Villas</option>
                                            					<option value="Yachts" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Yachts")?'selected="selected"':''}}>Yachts</option>
                                            					<option value="Safari Lodges" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Safari Lodges")?'selected="selected"':''}}>Safari Lodges</option>
                                            					<option value="Spas" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->ads_cat_id=="Spas")?'selected="selected"':''}}>Spas</option>
                                            					@if(!empty($maindest))
                                            						@foreach($maindest as $dist)
                                            							<option value="{{$dist['id']}}" {{((!empty($sidebar_ads_info)) && $dist['id']==$sidebar_ads_info->ads_cat_id)?'selected="selected"':''}}>{{$dist['name']}}</option>
                                            						@endforeach
                                            					@endif
                                            				</select> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-12">
                                                            <label for="ipt" class="form-control-label">
                            									{{ Lang::get('core.ads_position') }}
                            								</label>
                            								<select name="adspos_2" id="adspos_2" required class="form-control m-input">
                                            					<option value="">-- Select --</option>
                                            					<option value="landing" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="landing")?'selected="selected"':''}}>landing Page Sidebar</option>
                                            					<option value="grid_sidebar" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_sidebar")?'selected="selected"':''}}>Grid Page Sidebar</option>
                                            					<option value="grid_results" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_results")?'selected="selected"':''}}>Grid Page Results </option>
                                            					<option value="detail" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="detail")?'selected="selected"':''}}>Detail Page Sidebar </option>
                                            				</select>
                                                        </div>
                                                    </div>
                                                    <?php $curdate = date('Y-m-d'); 
					                               if((!empty($sidebar_ads_info) && $sidebar_ads_info->adv_expire>=$curdate) || (!empty($sidebar_ads_price) && $sidebar_ads_price->content==0)){ ?>
                                                        <input name="pay_2" type="hidden" class="form-control input-sm" value="no"/>
                                                   <?php } else { ?>
                                                        <input name="pay_2" type="hidden" class="form-control input-sm" value="yes"/>
                                                   <?php } ?>
                                                </div>
                                            </div>
                                            <!--end: Form Wizard Step 4-->
                                            
                                            <!--begin: Form Wizard Step 5-->
    										<div class="m-wizard__form-step" id="m_wizard_form_step_5">
                                                <input name="form_wizard_5" type="hidden" id="form_wizard_5" value="5" />
    											<!--begin::Section-->
    											<div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">
    												<!--begin::Item-->
    												<div class="m-accordion__item active">
    													<div class="m-accordion__item-head"  role="tab" id="m_accordion_1_item_1_head" data-toggle="collapse" href="#m_accordion_1_item_1_body" aria-expanded="  false">
    														<span class="m-accordion__item-icon">
    															<i class="fa flaticon-user-ok"></i>
    														</span>
    														<span class="m-accordion__item-title">
    															{{ Lang::get('core.personalinfo') }}
    														</span>
    														<span class="m-accordion__item-mode"></span>
    													</div>
    													<div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_1_head" data-parent="#m_accordion_1">
    														<!--begin::Content-->
    														<div class="tab-content active  m--padding-30">
    															<div class="m-form__section m-form__section--first">
    																<div class="m-form__heading">
    																	<h4 class="m-form__heading-title">
    																		{{ Lang::get('core.personalinfo') }}
    																	</h4>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Username:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Email:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.firstname') }}
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.lastname') }}
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			
    																		</span>
    																	</div>
    																</div>
                                                                    
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Avatar
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																		<?php /*	{!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!} */ ?>
    																		</span>
    																	</div>
    																</div>
    															</div>
    														</div>
    														<!--end::Section-->
    													</div>
    												</div>
    												<!--end::Item-->
                                                    
                                                    <!--begin::Item-->
    												<div class="m-accordion__item">
    													<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_2_head" data-toggle="collapse" href="#m_accordion_1_item_2_body" aria-expanded="    false">
    														<span class="m-accordion__item-icon">
    															<i class="fa  flaticon-placeholder"></i>
    														</span>
    														<span class="m-accordion__item-title">
    															{{ Lang::get('core.companydetails') }}
    														</span>
    														<span class="m-accordion__item-mode"></span>
    													</div>
    													<div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_2_head" data-parent="#m_accordion_1">
    														<!--begin::Content-->
    														<div class="tab-content  m--padding-30">
    															<div class="m-form__section m-form__section--first">
    																<div class="m-form__heading">
    																	<h4 class="m-form__heading-title">
    																		{{ Lang::get('core.companydetails') }}
    																	</h4>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Firmenname:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_name; } ?>
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Inhaber:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_owner; } ?>
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Ansprechpartner:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->contact_person; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		E-Mail Adresse:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_email; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Phone #:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->contact_person; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Website:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_website; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Tax #:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Adresse:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_address; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Adresse:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_address2; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		ORT:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_city; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Pin:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_postal_code; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Land:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->company_country; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Firmenlogo:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			@if(!empty($extra))
                                                                				    {!! SiteHelpers::showUploadedFile($extra->company_logo,'/uploads/users/company/',155, 30, '') !!}
                                                                				@endif
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Steuernummer:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Umsatzsteuer ID:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Gesch&auml;ftsf&uuml;hrer:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Handelsregister:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		Amtsgericht:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			<?php if(!empty($extra)) { echo $extra->amtsgericht; } ?>
    																		</span>
    																	</div>
    																</div>
    															</div>
    															
    														</div>
    														<!--end::Content-->
    													</div>
    												</div>
    												<!--end::Item-->
                                                    
                                                    <!--begin::Item-->
    												<div class="m-accordion__item">
    													<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_3_head" data-toggle="collapse" href="#m_accordion_1_item_3_body" aria-expanded="    false">
    														<span class="m-accordion__item-icon">
    															<i class="fa  flaticon-placeholder"></i>
    														</span>
    														<span class="m-accordion__item-title">
    															{{ Lang::get('core.user_slider_ads') }}
    														</span>
    														<span class="m-accordion__item-mode"></span>
    													</div>
    													<div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_3_head" data-parent="#m_accordion_1">
    														<!--begin::Content-->
    														<div class="tab-content  m--padding-30">
    															<div class="m-form__section m-form__section--first">
    																<div class="m-form__heading">
    																	<h4 class="m-form__heading-title">
    																		{{ Lang::get('core.user_slider_ads') }}
    																	</h4>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_image') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
                                                                                @if(!empty($slider_ads_info))
    																			 {!! SiteHelpers::showUploadedFile($slider_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                                                                                @endif
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_link') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
                                                                            	{{(!empty($slider_ads_info))?$slider_ads_info->adv_link:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_title') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			{{(!empty($slider_ads_info))?$slider_ads_info->adv_title:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_description') }}
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			{{(!empty($slider_ads_info))?$slider_ads_info->adv_desc:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_category') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
                                                                                {{(!empty($slider_ads_info))?$slider_ads_info->ads_slider_cat:''}}
    																		</span>
    																	</div>
    																</div>
    															</div>
    														</div>
    														<!--end::Content-->
    													</div>
    												</div>
    												<!--end::Item-->
                                                     
                                                    <!--begin::Item-->
    												<div class="m-accordion__item">
    													<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_4_head" data-toggle="collapse" href="#m_accordion_1_item_4_body" aria-expanded="    false">
    														<span class="m-accordion__item-icon">
    															<i class="fa  flaticon-placeholder"></i>
    														</span>
    														<span class="m-accordion__item-title">
    															{{ Lang::get('core.user_sidebar_ads') }}
    														</span>
    														<span class="m-accordion__item-mode"></span>
    													</div>
    													<div class="m-accordion__item-body collapse" id="m_accordion_1_item_4_body" class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_4_head" data-parent="#m_accordion_1">
    														<!--begin::Content-->
    														<div class="tab-content  m--padding-30">
    															<div class="m-form__section m-form__section--first">
    																<div class="m-form__heading">
    																	<h4 class="m-form__heading-title">
    																		{{ Lang::get('core.user_sidebar_ads') }}
    																	</h4>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_image') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			@if(!empty($sidebar_ads_info))
                                                                					{!! SiteHelpers::showUploadedFile($sidebar_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                                                                				@endif
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_link') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_link:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_title') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_title:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_description') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
    																			{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_desc:''}}
    																		</span>
    																	</div>
    																</div>
    																<div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_category') }}:
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
                                                                                {{(!empty($sidebar_ads_info))?$sidebar_ads_info->ads_cat_id:''}}
    																		</span>
    																	</div>
    																</div>
                                                                    <div class="form-group m-form__group m-form__group--sm row">
    																	<label class="col-xl-4 col-lg-4 col-form-label">
    																		{{ Lang::get('core.ads_position') }}
    																	</label>
    																	<div class="col-xl-8 col-lg-8">
    																		<span class="m-form__control-static">
                                                                                {{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_position:''}}
    																		</span>
    																	</div>
    																</div>
    															</div>
    														</div>
    														<!--end::Content-->
    													</div>
    												</div>
    												<!--end::Item-->
    											</div>
    											<!--end::Section-->
                                                
                                                <!--end::Section-->
    											<div class="m-separator m-separator--dashed m-separator--lg"></div>
    											<div class="form-group m-form__group m-form__group--sm row">
    												<div class="col-xl-12">
    													<div class="m-checkbox-inline">
    														<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    															<input type="checkbox" name="accept" value="1">
    															Click here to indicate that you have read and agree to the terms presented in the Terms and Conditions agreement
    															<span></span>
    														</label>
    													</div>
    												</div>
    											</div>
    										</div>
    										<!--end: Form Wizard Step 5-->
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
    												<div class="col-lg-6 m--align-right">
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
<!-- contract section start-->
 <div id="myModal_old" class="modal fade col-md-12" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contract Section</h4>
      </div>
      <div class="modal-body">
      	  <div class="sbox animated fadeInRight">
            <div class="sbox-content">
	                <div class="panel-group" id="uc-accordion">
	                <?php
	                    if(!empty($contractdata)) {
	                        $sn = 0;
	                        foreach ($contractdata as $row) {
	                            ?>
	                             <div class="panel panel-default">
	                                <div class="panel-heading">
	                                    <h4 class="panel-title">
	                                        <a data-toggle="collapse" data-parent="#uc-accordion" href="#uc-collapse-<?php echo $sn; ?>"><?php echo $row->title; ?></a>
	                                    </h4>
	                                </div>
	                                <div id="uc-collapse-<?php echo $sn; ?>" class="panel-collapse collapse <?php echo ($sn == 0)? 'in' : ''; ?>">
	                                    <div class="panel-body"><?php echo nl2br($row->description); ?></div>
	                                </div>
	                            </div>
	                                
	                            <?php
	                            $sn++;
	                        }
	                    }
	                    ?>
	                </div>
            </div>
  			</div>
        
      </div>
      <div class="modal-footer">
      		<div class="form-group ">
						<div class="col-sm-12" id="contractSignCheck">
							<label class="col-sm-2" data-toggle="modal" data-target="#myModal">
							<input type="checkbox"  id="contractSignCheckFinal" name="contractSignCheckFinal" value="accepted" required="">
							</label>
								<div class="checkbox">
									<label class="radio-label">I hereby accept the terms of contract.</label>
								</div>
							

						</div>
			</div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- End contract section start-->




    <script>
	
    </script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/wizard.js') }}"></script>
@stop
@section('script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
