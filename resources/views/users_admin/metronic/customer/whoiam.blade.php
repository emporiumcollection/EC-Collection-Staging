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
								Add Hotel Information
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
    														<input name="username" type="text" id="username" class="form-control m-input" required=""  value="{{ $user->username }}" />  
    													</div>
    												</div>
    												<div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 {{ Lang::get('core.firstname') }} 
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="{{ $user->first_name }}">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														{{ Lang::get('core.lastname') }}
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="{{ $user->last_name }}" required="">
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
                                    							     <input type="checkbox"  id="contractSignCheck" name="contractSignCheck" <?php echo ($user->contracts=="1") ? 'checked="checked"' : '';  ?> value="1">
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
                                                                        ×
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
    														Hotel Information
    													</h3>
                                                        <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />
                                                        <input name="compedit_id" type="hidden" id="compedit_id" value="" />
    												</div>                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                        								    *Hotel Name
                        								</label>
                                                        <div class="col-xl-9 col-lg-9">
                        								    <input type="text" name="hotelinfo_name" id="name" placeholder="Hotel Name*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->property_name; } ?>" >
                                                        </div>                 
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                								    *Hotel Status
                                								</label>
                                                        <div class="col-xl-9 col-lg-9">
                            								<select name="hotelinfo_status" class="form-control" required="">
                                                                <option value="">Select Status</option>
                                                                <option value="Open" <?php echo (!empty($extra) ? ($extra->hotelinfo_status=='Open') ? 'selected="selected"' : '' : ''); ?> >Open</option>
                                                                <option value="Construction phase"<?php echo (!empty($extra) ? ($extra->hotelinfo_status=='Construction phase') ? 'selected="selected"' : '' : ''); ?>>Construction phase</option>
                                                                <option value="Planning phase"<?php echo (!empty($extra) ? ($extra->hotelinfo_status=='Planning phase') ? 'selected="selected"' : '' : ''); ?>>Planning phase</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Hotel Type</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name="hotelinfo_type" class="form-control" required="">
                                                                <option value="">Hotel Type</option>
                                                                <option value="Alternative" <?php echo (!empty($extra) ? ($extra->hotelinfo_type=='Alternative') ? 'selected="selected"' : '' : ''); ?>>Alternative</option>
                                                                <option value="Beach Resort" <?php echo (!empty($extra) ? ($extra->hotelinfo_type=='Beach Resort') ? 'selected="selected"' : '' : ''); ?>>Beach Resort</option>
                                                                <option value="Resort" <?php echo (!empty($extra) ? ($extra->hotelinfo_type=='Resort') ? 'selected="selected"' : '' : ''); ?>>Resort</option>
                                                                <option value="City" <?php echo (!empty($extra) ? ($extra->hotelinfo_type=='City') ? 'selected="selected"' : '' : ''); ?>>City</option>
                                                                <option value="Mountain" <?php echo (!empty($extra) ? ($extra->hotelinfo_type=='Mountain') ? 'selected="selected"' : '' : ''); ?>>Mountain</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Hotel Building</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name="hotelinfo_building" class="form-control" required="">
                                                                <option value="Hotel Building" <?php echo (!empty($extra) ? ($extra->hotelinfo_building=='Hotel Building') ? 'selected="selected"' : '' : ''); ?>>Hotel Building</option>
                                                                <option value="New Construction" <?php echo (!empty($extra) ? ($extra->hotelinfo_building=='New Construction') ? 'selected="selected"' : '' : ''); ?>>New Construction</option>
                                                                <option value="Existing Building" <?php echo (!empty($extra) ? ($extra->hotelinfo_building=='Existing Building') ? 'selected="selected"' : '' : ''); ?>>Existing Building</option>
                                                                <option value="Conversion" <?php echo (!empty($extra) ? ($extra->hotelinfo_building=='Conversion') ? 'selected="selected"' : '' : ''); ?>>Conversion</option>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Hotel Opening Date</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                        <?php 
                                                            $hod ='';
                                                            if(!empty($extra)) { 
                                                                if(!empty($extra->hotelinfo_opening_date)){
                                                                    $hod = date('m/d/Y', strtotime($extra->hotelinfo_opening_date));
                                                                }                                                            
                                                            }                  
                                                        ?>
                                                            <input type="text" name="hotelinfo_opening_date" id="m_datepicker_1" placeholder="Hotel Opening Date*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $hod; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Street &amp; Number</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_address" placeholder="Street &amp; Number*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelinfo_address; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*City</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_city" placeholder="City*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->city; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Country</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_country" placeholder="Country*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->country; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Postal Code</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_postal" placeholder="Postal Code*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelinfo_postal; } ?>" >
                                                        </div>
                                                    </div>                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Hotel Website</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_website" placeholder="Hotel Website*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->website; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Days open for business</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_daysopen" placeholder="Days open for business*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelinfo_daysopen; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Avg. Daily Rate</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input class="form-control" name="hotelinfo_avg_daily_rate" type="text" placeholder="Avg. Daily Rate*" value="<?php if(!empty($extra)) { echo $extra->hotelinfo_avg_daily_rate; } ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Avg. Occupancy</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelinfo_avg_occupancy" placeholder="Avg. Occupancy*" value="%" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelinfo_avg_occupancy; } ?>">
                                                        </div>
                                                    </div>    
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section">
    											    <div class="m-form__heading">
    												    <h3 class="m-form__heading-title">
    												       Hotel Facilities    													   
    													</h3>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Number of Rooms</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelfac_num_rooms" placeholder="Number of Rooms*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelfac_num_rooms; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Number of Suites</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelfac_num_suites" placeholder="Number of Suites*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotelfac_num_suites; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">F &amp; B Outlets</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <?php 
                                                                $arr_outlets = array();
                                                                if(!empty($extra)) { 
                                                                    if(!empty($extra->hotelfac_fb_outlets)){
                                                                        $str_outlets = $extra->hotelfac_fb_outlets;
                                                                        $arr_outlets = explode(',', $str_outlets);
                                                                    }
                                                                }                                                            
                                                            ?>
                                                            <select name="hotelfac_fb_outlets[]" multiple="" class="form-control" >
                                                                <option value="">-</option>
                                                                <option value="Restaurant" <?php echo in_array('Restaurant', $arr_outlets) ? 'selected="selected"' : '' ?> >Restaurant</option>
                                                                <option value="Bar" <?php echo in_array('Bar', $arr_outlets) ? 'selected="selected"' : '' ?>>Bar</option>
                                                                <option value="Beach Bar" <?php echo in_array('Beach Bar', $arr_outlets) ? 'selected="selected"' : '' ?>>Beach Bar</option>
                                                                <option value="Club" <?php echo in_array('Club', $arr_outlets) ? 'selected="selected"' : '' ?>>Club</option>
                                                                <option value="Lobby/Lounge" <?php echo in_array('Lobby/Lounge', $arr_outlets) ? 'selected="selected"' : '' ?>>Lobby/Lounge</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Guest Facilities</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <?php 
                                                                $arr_guest_fac = array();
                                                                if(!empty($extra)) { 
                                                                    if(!empty($extra->hotelfac_guest_fac)){
                                                                        $str_guest_fac = $extra->hotelfac_guest_fac;
                                                                        $arr_guest_fac = explode(',', $str_guest_fac);
                                                                    }
                                                                }                                                            
                                                             ?>
                                                             <select name="hotelfac_guest_fac[]" multiple="" class="form-control">
                                                                <option value="">-</option>
                                                                <option value="Gym" <?php echo in_array('Gym', $arr_guest_fac) ? 'selected="selected"' : '' ?>>Gym</option>
                                                                <option value="Indoor Pool" <?php echo in_array('Indoor Pool', $arr_guest_fac) ? 'selected="selected"' : '' ?>>Indoor Pool</option>
                                                                <option value="Outdoor Pool" <?php echo in_array('Outdoor Pool', $arr_guest_fac) ? 'selected="selected"' : '' ?>></option>
                                                                <option value="Spa" <?php echo in_array('Spa', $arr_guest_fac) ? 'selected="selected"' : '' ?>>Spa</option>
                                                                <option value="Business Center" <?php echo in_array('Business Center', $arr_guest_fac) ? 'selected="selected"' : '' ?>>Business Center</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Meeting Area</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotelfac_meeting_area" placeholder="Meeting Area*" value="sqm" class="form-control" value="<?php if(!empty($extra)) { echo $extra->hotelfac_meeting_area; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Meeting Facilities</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name="hotelfac_meeting_fac" class="form-control">
                                                                <option>Please select</option>
                                                                <option value="Yes" <?php echo (!empty($extra) ? ($extra->hotelfac_meeting_fac=='Yes') ? 'selected="selected"' : '' : ''); ?>>YES</option>
                                                                <option value="No" <?php echo (!empty($extra) ? ($extra->hotelfac_meeting_fac=='No') ? 'selected="selected"' : '' : ''); ?>>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Comments/Other Facilities</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="hotelfac_comments"  placeholder="Comments/Other Facilities" rows="5" class="form-control"><?php if(!empty($extra)) { echo $extra->hotelfac_comments; } ?></textarea>
                                                           
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section">
    											    <div class="m-form__heading">
    												    <h3 class="m-form__heading-title">
    												       Hotel Description    													   
    													</h3>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Hotel Concept</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                             <textarea name="hoteldesc_concept" placeholder="*Hotel Concept" rows="5" class="form-control" required=""><?php if(!empty($extra)) { echo $extra->hoteldesc_concept; } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Architecture &amp; Design</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="hoteldesc_architecture_design"  placeholder="*Architecture & Design" rows="5" class="form-control"><?php if(!empty($extra)) { echo $extra->architecture_design_desciription; } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Architect Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_architecture_name" placeholder="Architect Name" class="form-control" value="<?php if(!empty($extra)) { echo $extra->architecture_design_title; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Architect Website</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_architecture_website" placeholder="Architect Website" class="form-control" value="<?php if(!empty($extra)) { echo $extra->architecture_design_url; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Interior Designer Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_interior_designer_name" placeholder="Interior Designer Name" class="form-control" value="<?php if(!empty($extra)) { echo $extra->architecture_designer_title; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Interior Designer Website</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_interior_designer_website" placeholder="Interior Designer Website" class="form-control" value="<?php if(!empty($extra)) { echo $extra->architecture_designer_url; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Local Integration</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="hoteldesc_local_integration" id="comment" placeholder="Local Integration" rows="5" class="form-control"><?php if(!empty($extra)) { echo $extra->hoteldesc_local_integration; } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Brand</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                           <textarea name="hoteldesc_brand"  placeholder="Brand" rows="5" class="form-control"> <?php if(!empty($extra)) { echo $extra->hoteldesc_brand; } ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Brand Agency Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                           <input type="text" name="hoteldesc_brand_agency_name" placeholder="Brand Agency Name" class="form-control" value="<?php if(!empty($extra)) { echo $extra->hoteldesc_brand_agency_name; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Brand Agency Website</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_brand_agency_website" placeholder="Brand Agency Website" class=" form-control" value="<?php if(!empty($extra)) { echo $extra->hoteldesc_brand_agency_website; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Brand Linkedin Profile</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hoteldesc_brand_linkdin_profile" placeholder="Brand Linkedin Profile" class="form-control" value="<?php if(!empty($extra)) { echo $extra->hoteldesc_brand_linkdin_profile; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">Brand Instagram Profile</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                             <input type="text" placeholder="Brand Instagram Profile" name="hoteldesc_brand_instagram_profile" class=" form-control" value="<?php if(!empty($extra)) { echo $extra->social_instagram; } ?>">
                                                        </div>
                                                    </div>
                                                 </div>
                                                 <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                 <div class="m-form__section">
    											    <div class="m-form__heading">
    												    <h3 class="m-form__heading-title">
    												       Contact Information    													   
    													</h3>                                                        
                                                    </div>
                                                    <div class="m-form__heading">    												   
                                                        <h6>Property Owning Entity:</h6>                                                       
                                                    </div>
                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Entity Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactinfo_name" placeholder="Entity Name*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotel_contactinfo_name; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Street &amp; Number</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                           <input type="text" name="hotel_contactinfo_address" placeholder="Street & Number*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_address; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*City</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactinfo_city" placeholder="City*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_city; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Country</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                           <input type="text" name="hotel_contactinfo_country" placeholder="Country*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_country; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Postal Code</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                             <input type="text" name="hotel_contactinfo_postal" placeholder="Postal Code*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_postal_code; } ?>">
                                                        </div>
                                                    </div> 
                                                    <div class="m-form__heading">
    												    <h6>
    												       Contact Person:    													   
    													</h6>                                                        
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*First Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactprsn_firstname" placeholder="First Name*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_name; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Last Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactprsn_lastname" placeholder="Last Name*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_last_name; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Company Name</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactprsn_companyname" placeholder="Company Name*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotel_contactprsn_companyname; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Job Title</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactprsn_jobtitle" placeholder="Job Title*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->hotel_contactprsn_jobtitle; } ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">*Phone</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input type="text" name="hotel_contactprsn_phone" placeholder="Phone*" class="form-control" required="" value="<?php if(!empty($extra)) { echo $extra->owner_phone_primary; } ?>">
                                                        </div>
                                                    </div>    
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-12 m-checkbox-inline">
                                							<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                							     <input class="checkbox" type="checkbox" name="hotel_contactprsn_agree" id="termConditionInput"  value="1" required="" <?php echo (!empty($extra) ? ($extra->hotel_contactprsn_agree=='1') ? 'checked="checked"' : '' : ''); ?>>
                                                                 I agree with the <a href="#">Terms and Conditions</a>
                                                                 <span></span>
                                							</label>
                                						</div>
                                                    </div>                                               
                                                 </div>                                                                                                     
                                            </div>
    										<!--end: Form Wizard Step 2-->
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


    <script src="{{ asset('metronic/assets/demo/demo6/base/hotel_wizard.js') }}"></script>
@stop

{{-- For custom script --}}
@section('custom_js_script')
    @parent
    <script>
        $(document).ready( function () { 
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
        });
    </script>
@endsection

@section('script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
