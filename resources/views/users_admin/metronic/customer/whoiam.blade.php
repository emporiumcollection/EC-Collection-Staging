@extends('users_admin.metronic.layouts.blank_app')

@section('page_name')
    Account  <small>Enter Your Info</small>
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
														Rates
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
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
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
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 2-->
    										<div class="m-wizard__form-step" id="m_wizard_form_step_2">
                                                <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />  
    											<div class="m-form__section" style="margin: 0px;">
                                                    <div class="form-group m-form__group row">
                                                        <img src="{{URL::to('images/800x200.png')}}" />
                                                    </div>
                                                    <div class="m-form__heading margin-top">
    													<h3 class="m-form__heading-title">
    														Profile &amp; Company
    													</h3>
    												</div>
                                                    <div class="col-sm-12 col-md-12">
    													Info text
                                                        <hr />
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
    														Hotel Name:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_name" type="text" id="hotelinfo_name" class="form-control m-input" required=""  value="<?php echo isset($property_assigned->property_name) ? $property_assigned->property_name : '' ?>" />  
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel City:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_city" type="text" id="hotelinfo_city" class="form-control m-input" required=""  value="<?php echo isset($property_assigned->city) ? $property_assigned->city : '' ?>" />  
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel Country:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_country" type="text" id="hotelinfo_country" class="form-control m-input" required=""  value="<?php echo isset($property_assigned->country) ? $property_assigned->country : '' ?>" />  
    													</div>
    												</div>                                                    
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Hotel Website:
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input name="hotelinfo_website" type="text" id="hotelinfo_website" class="form-control m-input" value="<?php echo isset($property_assigned->website) ? $property_assigned->website : '' ?>" />  
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
                                					
                                					
    											</div>
                                            </div>
                                            <!--begin: Form Wizard Step 3-->
                                            <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                                                <input name="form_wizard_3" type="hidden" id="form_wizard_3" value="3" />  
    											<div class="m-form__section">
                                                    <div class="row">                                            
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Rates</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                                            <hr />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <?php if(!empty($commision_contractdata)){  ?>
                                                            <div class="m-radio-list">
                                    							<label class="m-radio">
                                    							     <input type="radio" name="roomavailability" value="full" <?php echo isset($commision_contractdata->commission_type) ? ($commision_contractdata->commission_type=="full" ? 'checked="checked"' : '') : 'checked="checked"'; ?> />
                                                                        Rack Rate (<?php echo (float) $commision_contractdata->full_availability_commission;?>%)
                                                                     <span></span>
                                    							</label>
                                                                <label class="m-radio">
                                    							     <input type="radio" name="roomavailability" value="partial" <?php echo isset($commision_contractdata->commission_type) ? ($commision_contractdata->commission_type=="partial" ? 'checked="checked"' : '') : ''; ?> />
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
                                                            <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Contract</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                                            
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            
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
                                                    	                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_1_item_<?php echo $sn; ?>_head" data-toggle="collapse" href="#m_accordion_1_item_<?php echo $sn; ?>_body" aria-expanded="false">
                                                                                        
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
                                                                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_<?php echo $sn; ?>_body" role="tabpanel" aria-labelledby="m_accordion_1_item_<?php echo $sn; ?>_head" data-parent="#m_accordion_1">
                                                                                             <div class="m-accordion__item-content">
                                                                                              <p>
                                                                                               <?php 
                                                                                               $date_signed = date('Y/m/d');
                                                                                               $str_desc = $row->description;
                $valid_until = date('Y-m-d', strtotime('+2 years', strtotime($date_signed)));
                $valid_until_year = date('Y', strtotime($valid_until));
                $string_array_replace = array(                    
                    '{signed_date}'=>$date_signed,
                    '{valid_until}'=>$valid_until,
                    '{valid_until_year}'=>$valid_until_year,
                );
                foreach($string_array_replace as $key => $value){                    
                    $str_replaced = str_replace($key, $value, $str_desc);
                    $str_desc = $str_replaced;
                }           
                                                                                               
                                                                                               echo nl2br($str_desc); 
                                                                                               
                                                                                               ?>
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
                                                            <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Upload Contract</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                                            
                                                        </div>
										                
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12"><br />             
                                                            
                                                             <div class="form-group m-form__group row">
            													<label class="col-xl-3 col-lg-3 col-form-label">
            														Upload Contract
            													</label>
            													                                                               
                                                        		<input type="file" name="signed_contract">
                                                        				
                                                                    
            												 </div>                                                                                                                      
                                                        </div>                                                        
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            <br />
                                                                <?php 
                                                                    if(isset($hotelcontacts) && count($hotelcontacts) > 0){ 
                                                                ?>        
                                                                        <a href="{{$hotelcontacts[0]->imgsrc.$hotelcontacts[0]->file_name}}" title="{{$hotelcontacts[0]->file_display_name}}" target="_blank" class="btn btn-primary" >View uploaded Contract</a>  
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
                                                            <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center margin-top">
                                                            <h2 class="black-heading-big">Packages</h2>
                                                        </div> 
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                                        </div> 
                                                        <div class="col-xl-12 col-lg-12 m--align-right">
            											     <a href="#" class="btn btn-default" id="package-skip">Skip</a>
						                                </div>
                                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 margin-top" id="dv_pkg">
                                                            
                                                            <div class="form-group m-form__group row">
                                                            
                                                                       
                                                                <div class="m-portlet__body" style="width:100%;">
                                                                    <ul class="nav nav-tabs" role="tablist">
                                                    					<li class="nav-item"> 
                                                                            <a class="nav-link active" href="#sales_marketing" data-toggle="tab"> 
                                                                                Sales & Marketing 
                                                                            </a>
                                                                        </li>
                                                                        <li class="nav-item"> 
                                                                            <a class="nav-link" href="#reservation_distribution" data-toggle="tab"> 
                                                                                Reservation & Distribution 
                                                                            </a>
                                                                        </li>
                                                                        <li class="nav-item"> 
                                                                            <a class="nav-link" href="#advertising" data-toggle="tab"> 
                                                                                Advertising
                                                                            </a>
                                                                        </li>			
                                                    				</ul>
                                                    				<div class="tab-content">
                                                    					
                                                                            <div class="tab-pane active" id="sales_marketing">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_sales_marketing" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}                                    
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Sales_Marketing")
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_sales_marketing_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_sales_marketing_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_sales_marketing_{{ $k }}_head" data-parent="#m_accordion_3_sales_marketing">
                                                            								<div class="m-accordion__item-content">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                                                                            <h4>Package Modules Include:</h4>
                                                                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                                                                            @foreach ($modulesOffered as $moduleRow)
                                                                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                                                                
                                                                                                            @endforeach  
                                                                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
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
                                                                                
                                                                                                        <div class="col-lg-12 m--align-right">
                                                                                                            <div>
                                                                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                        
                                                                                                      
                                                                                                </div>
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    @endif
                                                                                    {{--*/ $k++; /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->     
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <div class="tab-pane" id="reservation_distribution">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_reservation_distribution" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Reservation_Distribution")
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_reservation_distribution_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_reservation_distribution_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_reservation_distribution_{{ $k }}_head" data-parent="#m_accordion_3_reservation_distribution">
                                                            								<div class="m-accordion__item-content">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                                                                            <h4>Package Modules Include:</h4>
                                                                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                                                                            @foreach ($modulesOffered as $moduleRow)
                                                                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                                                                
                                                                                                            @endforeach  
                                                                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                    <div class="row" style="padding: 10px;">
                                                                                                        
                                                                                                        <div class="col-lg-12 m--align-right">
                                                                                                            <div>
                                                                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                        
                                                                                                      
                                                                                                </div>
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    @endif
                                                                                    {{--*/ $k++; /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->     
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="tab-pane" id="advertising">
                                                                                <!--begin::Section-->
                                                            					<div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3_advertising" role="tablist">
                                                            						<!--begin::Item-->
                                                                                    {{--*/ $k=1; $tottyp = count($packages); /*--}}
                                                                                    @foreach($packages as $key=>$package)
                                                                                    @if($package->package_category=="Advertising")
                                                            						<div class="m-accordion__item">
                                                            							<div class="m-accordion__item-head collapsed"  role="tab" id="m_accordion_3_item_advertising_{{ $k }}_head" data-toggle="collapse" href="#m_accordion_3_item_advertising_{{ $k }}_body" aria-expanded="    false">
                                                            								<span class="m-accordion__item-icon">
                                                            									<i class="fa flaticon-user-ok"></i>
                                                            								</span>
                                                            								<span class="m-accordion__item-title">
                                                            									{{$package->package_title}} Price: {!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }}
                                                            								</span>
                                                            								<span class="m-accordion__item-mode"></span>
                                                            							</div>
                                                            							<div class="m-accordion__item-body collapse" id="m_accordion_3_item_advertising_{{ $k }}_body" class=" " role="tabpanel" aria-labelledby="m_accordion_3_item_advertising_{{ $k }}_head" data-parent="#m_accordion_3_advertising">
                                                            								<div class="m-accordion__item-content">
                                                            									<div class="col-sm-6 col-md-6 col-lg-6 pull-left">
                                                                                                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="width: 100%;" >
                                                                                                </div>
                                                                                                <div  class="col-sm-6 col-md-6 col-lg-6 pull-right">
                                                                                                    <div class="row">
                                                                                                        <div  class="col-sm-12 col-md-12 col-lg-12 border-2px">
                                                                                                            <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}}</p>  
                                                                                                            <p>Package Details: {!! nl2br($package->package_description) !!}</p>
                                                                                                            <h4>Package Modules Include:</h4>
                                                                                                            {{--*/  $modulesOffered = DB::table('tb_module')->whereIn('module_id', explode(',',$package->package_modules))->get();/*--}}
                                                                                                            {{--*/ $mod_arr = array(); /*--}}  
                                                                                                            @foreach ($modulesOffered as $moduleRow)
                                                                                                                {{--*/ $mod_arr[] = $moduleRow->module_name; /*--}}                                 
                                                                                                                
                                                                                                            @endforeach  
                                                                                                            {{--*/ $str_module = implode(', ', $mod_arr); echo $str_module; /*--}}
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12 col-md-12 col-lg-12 top-margin-20">
                                                                                                                    <h6>{!! isset($currency->content)?$currency->content:'$' !!} {{ number_format($package->package_price,2) }} </h6>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                    <div class="row" style="padding: 10px;">
                                                                                                        
                                                                                                        <div class="col-lg-12 m--align-right">
                                                                                                            <div>
                                                                                                                <a href="javascript:void(0);" onclick="javaScript:addToCartHotel({{$package->id}},{{ $package->package_price }});" class="btn btn-success">Add to cart</a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                        
                                                                                                      
                                                                                                </div>
                                                            								</div>
                                                            							</div>
                                                            						</div>
                                                                                    @endif
                                                                                    {{--*/ $k++; /*--}}
                                                                                    @endforeach
                                                            						<!--end::Item-->     
                                                                                </div>
                                                                            </div>
                                                
                                                					</div>
                                                					
                                                                    
                                                				</div> 
                                                            
                                						
                                					       </div>
                                                           <div class="col-lg-12 m--align-right" id="pgk_continue_btn" style="display: none;">                     						
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
                            <div class="m-accordion m-accordion--default m-accordion--solid" id="commission_accordion" role="tablist">
                                
                                <!-- contracts start -->
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$commision_contractdata->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$commision_contractdata->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"></span>
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
      /*width: 100%;*/
      height: 400px;
      overflow: hidden;
    }
    
    .carousel-inner > .item {
      position: absolute;
      height: 400px;
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
                         
                                                
            base_url = $("#base_url").val();
            /*$('#Carousel').carousel({
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
                $.ajax({
                    url:base_url+'/hotel/get_cart', 
                    type:'get',
                    success:function(response){ console.log(response);
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
            $(document).on('click','#choose_pkg_btn',function(e){
                e.preventDefault();
                $("#dv_pkg").css('display', '');
                $("#cart_row").css('display', 'none');
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
        });
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
            xhttp.open("GET", "{{ URL::to('hotel/add_package_to_cart')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
            xhttp.send();
        
        } 
        function removeItemFromCart(PackageID,PackagePrice){    

            var PackagePrice=PackagePrice;
            var PackageID=PackageID;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                $.ajax({
                    url:base_url+'/hotel/get_checkout', 
                    type:'get',
                    success:function(response){ console.log(response);
                        $("#cart_row").html('');
                        $("#dv_pkg").css('display', 'none');
                        $("#cart_row").html(response);   
                        
                        
                    }
                }); 
            }
            };
            xhttp.open("GET", "{{ URL::to('removecartitem')}}?cart[package][id]="+PackageID+"&cart[package][price]="+PackagePrice+"&cart[package][qty]=1&cart[package][type]=hotel", true);
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
    var activeTab = '@if($active_tab > 0){{$active_tab}}@else{{0}}@endif'; console.log(activeTab);
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
