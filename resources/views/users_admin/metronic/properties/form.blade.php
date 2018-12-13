@extends('users_admin.metronic.layouts.app')

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Reservation & Distribution </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Properties </span> 
        </a> 
    </li>
    <?php if(!empty($row['property_name'])){ ?>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> <?php echo ucfirst($row['property_name']); ?>  </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> Hotel/Property </span> 
        </a> 
    </li>
    <?php } ?>
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
								Update Property
							</h3>
						</div>
					</div>					
				</div>
				<!--end: Portlet Head-->
                <!--begin: Portlet Body-->
				<div class="m-portlet__body m-portlet__body--no-padding">
					<!--begin: Form Wizard-->
					<div class="m-wizard m-wizard--3 m-wizard--success" id="m_property_update_wizard">
						<!--begin: Message container -->
						<div class="m-portlet__padding-x">
							<!-- Here you can put a message or alert -->
						</div>
						<!--end: Message container -->
						<div class="row m-row--no-padding">
							<div class="col-xl-3 col-lg-12 bg-gray">
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
														Hotel Info
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
														Architecture & Design
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
														Social Networks
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
                                        {!! Form::open(array('url'=>'#', 'class'=>'m-form m-form--label-align-left- m-form--state- ', 'id'=>'property_update_form' ,'files' => true)) !!}
                                        <div class="m-portlet__body m-portlet__body--no-padding">
                                            <input type="hidden" name="base_url" id="base_url" value="{{ url() }}" />
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                            <!--begin: Form Wizard Step 1-->
    										<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                                                <input name="form_wizard" type="hidden" id="form_wizard" value="1" />  
    											<div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
    													<h3 class="m-form__heading-title">
    														Hotel Info
    													</h3>
    												</div>   
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-xl-3 col-sm-3 col-md-3 col-lg-3"></div>
                                                            
                                                        <div class="col-xl-9 col-sm-9 col-md-9 col-lg-9"><a href="#" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>View Hotel Setup Documentation</a></div>
                                                        
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">{{ Lang::get('hotel.property-name') }} <span class="asterix"> * </span></label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('property_name', $row['property_name'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>'', 'required'=>'true'  )) !!}
                                                            <span class="m-form__help">
    															{{ Lang::get('hotel.property-name-help-text') }}
    														</span>  
                                                        </div> 
                                                    </div> 					
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> {{ Lang::get('hotel.property-short-name') }} <span class="asterix"> * </span></label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('property_short_name', $row['property_short_name'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>'',   )) !!}
                                                            <span class="m-form__help">
    															{{ Lang::get('hotel.property-short-name-help-text') }}
    														</span>  
                                                        </div>                                                        
                                                    </div> 					
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Property Type <span class="asterix"> * </span></label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <?php $property_type = explode(',', $row['property_type']);
                                                            $property_type_opt = array('Hotel' => 'Hotel', 'Yachts' => 'Yachts', 'Villas' => 'Villas', 'Spas' => 'Spas', 'Safari Lodges' => 'Safari Lodges');
                                                            ?>
                                                            <select name='property_type' id='property_type' rows='5' required="required"  class='form-control m-input m-input--solid select2 ' onchange="check_yachts(this.value)";  > 
                                                                <?php
                                                                foreach ($property_type_opt as $key => $val) {
                                                                    echo "<option  value ='$key' " . ($row['property_type'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="m-form__help">
    															Please enter property type
    														</span>  
                                                        </div>                                                        
                                                    </div> 					
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Booking Type <span class="asterix"> * </span></label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <?php $booking_type = explode(',', $row['booking_type']);
                                                            $booking_type_opt = array('Rent' => 'Rent', 'Buy' => 'Buy', 'Both' => 'Both',);
                                                            ?>
                                                            <select name='booking_type' rows='5' required="required"  class='form-control m-input m-input--solid select2 '  > 
                                                                <?php
                                                                foreach ($booking_type_opt as $key => $val) {
                                                                    echo "<option  value ='$key' " . ($row['booking_type'] == $key ? " selected='selected' " : '' ) . ">$val</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="m-form__help">
    															Please enter booking type
    														</span>  
                                                        </div>
                                                    </div> 					
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> City Tax ( in % ) </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('city_tax', $row['city_tax'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>'',   )) !!}
                                                            <span class="m-form__help">
    															Please enter city tax
    														</span>  
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> About </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="about_property" class="form-control m-input m-input--solid">{{$row['about_property']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter short note about your property 
    														</span> 
                                                        </div>                                                         
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Property USP </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="property_usp" class="form-control m-input m-input--solid">{{$row['property_usp']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter property USP
    														</span> 
                                                        </div>                                                         
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row" style="display: none;">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Assign User <span class="asterix"> * </span></label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name='assigned_user_id' rows='5' id='assigned_user_id' class='form-control m-input m-input--solid select2' multiple="multiple"></select>
                                                            <span class="m-form__help">
    															
    														</span> 
                                                        </div>                                                        
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Assign Amenities </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name='assigned_amenities[]' rows='5' id='assigned_amenities' class='form-control m-input m-input--solid select2 ' multiple="multiple"  >
                                                                @if(!empty($amenties))
                                                                @foreach($amenties as $amenty)
                                                                <option value="{{$amenty->id}}" {{(isset($row['assign_amenities']) && in_array($amenty->id,explode(',',$row['assign_amenities']))) ? " selected='selected' " : '' }}>{{$amenty->amenity_title}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="m-form__help">
    															Please select assign amenties, Type in the white box to search/select
    														</span> 
                                                        </div>
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Copy Amenities to Rooms </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-checkbox-inline">
    															<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    																<input type="checkbox" name="copy_amenities_rooms" id="copy_amenities_rooms" checked="" value="1" {{($row['copy_amenities_rooms'] == 1) ? " checked='checked' " : '' }} >
    																<span></span>
    															</label>
    														</div>                                                   
                                                        </div>
                                                    </div> 
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Destinations &amp; Experience</label>
                                                        <div class="col-xl-9 col-lg-9">                    
                                                            <select name='destinations[]' id="property_category_id" rows='5' class='form-control m-input m-input--solid select2 ' multiple="multiple"   > 
                                                                <option  value ="0">-- Select Category --</option> 
                                                                @foreach($categories as $val)
                    
                                                                <option  value ="{{$val->id}}" {{(isset($row['property_category_id']) && in_array($val->id,explode(',',$row['property_category_id']))) ? " selected='selected' " : '' }}>{{$val->category_name}}</option> 						
                                                                @endforeach						
                                                            </select> 
                                                            <span class="m-form__help">
    															Please select destination, Type in the white box to search/select.
    														</span>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Use Default Seasons </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-checkbox-inline">
    															<label class="m-checkbox m-checkbox--solid m-checkbox--brand">
    																<input type="checkbox" name="default_seasons" id="default_seasons" value="1" {{($row['default_seasons'] == 1) ? " checked='checked' " : '' }} >
    																<span></span>
    															</label>
    														</div>
                                                            <span class="m-form__help">
    															Used in Reservation Management, Leave checked if you are not sure.
    														</span> 
                                                        </div> 
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 1 Title </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('detail_section1_title', $row['detail_section1_title'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>'',   )) !!}
                                                            <span class="m-form__help">
    															Please enter detail section 1 title
    														</span> 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 1 Description Box 1 </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="detail_section1_description_box1" class="form-control m-input m-input--solid">{{$row['detail_section1_description_box1']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter details section 1 description box 1
    														</span> 
                                                        </div>
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 1 Description Box 2 </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="detail_section1_description_box2" class="form-control m-input m-input--solid">{{$row['detail_section1_description_box2']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter details section 1 description box 2
    														</span> 
                                                        </div>
                                                    </div> 
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 2 Title </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('detail_section2_title', $row['detail_section2_title'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>'',   )) !!}
                                                            <span class="m-form__help">
    															Please enter detail section 2 title
    														</span> 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 2 Description Box 1 </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="detail_section2_description_box1" class="form-control m-input m-input--solid">{{$row['detail_section2_description_box1']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter details section 2 description box 1
    														</span> 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Detail Section 2 Description Box 2 </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="detail_section2_description_box2" class="form-control m-input m-input--solid">{{$row['detail_section2_description_box2']}}</textarea>
                                                            <span class="m-form__help">
    															Please enter details section 2 description box 2
    														</span> 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Assign Detail City</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select name='assign_detail_city' id="assign_detail_city" rows='5' class='form-control m-input m-input--solid select2 ' > 
                                                                <option  value ="0">-- Select --</option> 
                                                                @foreach($categories as $val)
                    
                                                                <option  value ="{{$val->category_name}}" {{(isset($row['assign_detail_city']) && ($val->category_name==$row['assign_detail_city'])) ? " selected='selected' " : '' }}>{{$val->category_name}}</option> 						
                                                                @endforeach						
                                                            </select>
                                                            <span class="m-form__help">
    															Please select assign detail city
    														</span> 
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
    														Architecture
    													</h3>
                                                        <input name="form_wizard_2" type="hidden" id="form_wizard_2" value="2" />
                                                        <input name="compedit_id" type="hidden" id="compedit_id" value="" />
    												</div>                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Title </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('architecture_title', $row['architecture_title'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Description </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="architecture_desciription" class="form-control m-input m-input--solid">{{$row['architecture_desciription']}}</textarea> 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Image </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input  type='file' class="form-control m-input m-input--solid" name='architecture_image' id='architecture_image'  />
                                                            @if(!empty($row['architecture_image']))
                                                            <div >
                                                                {!! SiteHelpers::showUploadedFile($row['architecture_image'],'/uploads/properties_subtab_imgs/') !!}
            
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Video Type </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_video_type" value="upload" id='architecture_displayupload' @if($row['architecture_video_type'] == 'upload') checked="checked" @endif>
    																Upload
    																<span></span>
    															</label>
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_video_type" checked="'checked'" value="link" id='architecture_displaylink' @if($row['architecture_video_type'] == 'link') checked="checked" @endif >
    																Link
    																<span></span>
    															</label>
    														</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="architecture_videotypeupload" style="display:none;" >
                                                        <div class="form-group m-form__group row" >
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Video </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input  type='file' name='architecture_video' id='architecture_video' class="form-control m-input m-input--solid"  />
                                                                <div >
                                                                    {!! SiteHelpers::showUploadedFile($row['architecture_video'],'/uploads/properties_subtab_imgs/') !!}
                
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="architecture_videotypelink" style="display:none;" >
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Link Type </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="m-radio-inline">
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_video_link_type" value ='youtube' @if($row['architecture_video_link_type'] == 'youtube') checked="checked" @endif >
        																Youtube
        																<span></span>
        															</label>
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_video_link_type"  value ='vimeo' @if($row['architecture_video_link_type'] == 'vimeo') checked="checked" @endif >
        																Vimeo
        																<span></span>
        															</label>
        														</div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Video Link </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type='text' name='architecture_video_link' id='architecture_video_link' class="form-control m-input m-input--solid" value="{{$row['architecture_video_link']}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                     
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section bg-gray">
    											    <div class="m-form__heading">
    												    <h3 class="m-form__heading-title">
    												       Design    													   
    													</h3>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Title </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('architecture_design_title', $row['architecture_design_title'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Description </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="architecture_design_desciription" class="form-control m-input m-input--solid">{{$row['architecture_design_desciription']}}</textarea> 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Image </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input  type='file' class="form-control m-input m-input--solid" name='architecture_design_image' id='architecture_design_image'  />
                                                            @if(!empty($row['architecture_design_image']))
                                                            <div >
                                                                {!! SiteHelpers::showUploadedFile($row['architecture_design_image'],'/uploads/properties_subtab_imgs/') !!}
            
                                                            </div>					
                                                            @endif
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Video Type </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            
                                                            <div class="m-radio-inline">
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_design_video_type" value ='upload'  id='architecture_design_displayupload' @if($row['architecture_design_video_type'] == 'upload') checked="checked" @endif >
    																Upload
    																<span></span>
    															</label>
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_design_video_type" value ='link' id='architecture_design_displaylink' @if($row['architecture_design_video_type'] == 'link') checked="checked" @endif >
    																Link
    																<span></span>
    															</label>
    														</div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="architecture_design_videotypeupload" style="display:none;" >
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label" for="Video"> Video </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input  type='file' name='architecture_design_video' class="form-control  m-input m-input--solid" id='architecture_design_video'  />
                                                                @if(!empty($row['architecture_design_video']))
                                                                <div >
                                                                    {!! 	SiteHelpers::showUploadedFile($row['architecture_design_video'],'/uploads/properties_subtab_imgs/') !!}
                
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="architecture_design_videotypelink" style="display:none;" >
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Link Type </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="m-radio-inline">
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_design_video_link_type" value ='youtube'  @if($row['architecture_design_video_link_type'] == 'youtube') checked="checked" @endif >
        																Youtube
        																<span></span>
        															</label>
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_design_video_link_type" value ='vimeo' @if($row['architecture_design_video_link_type'] == 'vimeo') checked="checked" @endif >
        																Vimeo
        																<span></span>
        															</label>
        														</div>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Video Link </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type='text' name='architecture_design_video_link' id='architecture_design_video_link' class="form-control m-input m-input--solid" value="{{$row['architecture_design_video_link']}}" />
                                                            </div>            
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> URL </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('architecture_design_url', $row['architecture_design_url'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div> 
                                                 </div>
                                                 <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                 <div class="m-form__section">
    											    <div class="m-form__heading">
    												    <h3 class="m-form__heading-title">
    												       Designer   													   
    													</h3>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Title </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('architecture_designer_title', $row['architecture_designer_title'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Description </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <textarea name="architecture_designer_desciription" class="form-control m-input m-input--solid">{{$row['architecture_designer_desciription']}}</textarea> 
                                                        </div>
                                                    </div> 
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Image </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <input  type='file' class="form-control m-input m-input--solid" name='architecture_designer_image' id='architecture_designer_image'  />
                                                            <div >
                                                                {!! SiteHelpers::showUploadedFile($row['architecture_designer_image'],'/uploads/properties_subtab_imgs/') !!}
            
                                                            </div>					
            
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Video Type </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_designer_video_type" value ='upload' id='architecture_designer_displayupload' @if($row['architecture_designer_video_type'] == 'upload') checked="checked" @endif >
    																Upload
    																<span></span>
    															</label>
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="architecture_designer_video_type" value ='link' id='architecture_designer_displaylink' @if($row['architecture_designer_video_type'] == 'link') checked="checked" @endif >
    																Link
    																<span></span>
    															</label>
    														</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="architecture_designer_videotypeupload" style="display:none;" >
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Video </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input  type='file' class="form-control m-input m-input--solid" name='architecture_designer_video' id='architecture_designer_video'  />
                                                                @if(!empty($row['architecture_designer_video']))
                                                                <div >
                                                                    {!! SiteHelpers::showUploadedFile($row['architecture_designer_video'],'/uploads/properties_subtab_imgs/') !!}
                
                                                                </div>
                                                                @endif
                                                             </div>
                                                         </div>
                                                    </div>
            
                                                    <div class="architecture_designer_videotypelink" style="display:none;" >
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Link Type </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <div class="m-radio-inline">
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_designer_video_link_type" value='youtube' @if($row['architecture_designer_video_link_type'] == 'youtube') checked="checked" @endif >
        																Upload
        																<span></span>
        															</label>
        															<label class="m-radio m-radio--solid m-radio--brand">
        																<input type="radio" name="architecture_designer_video_link_type" value='vimeo' @if($row['architecture_designer_video_link_type'] == 'vimeo') checked="checked" @endif >
        																Vimeo
        																<span></span>
        															</label>
        														</div>
                                                            </div> 
            
                                                        </div>
            
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label"> Video Link </label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <input type='text' name='architecture_designer_video_link' id='architecture_designer_video_link' class="form-control m-input m-input--solid" value="{{$row['architecture_designer_video_link']}}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> URL </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('architecture_designer_url', $row['architecture_designer_url'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
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
    														Social Networks
    													</h3>
                                                        <input name="form_wizard_3" type="hidden" id="form_wizard_3" value="3" />
                                                        <input name="compedit_id" type="hidden" id="compedit_id" value="" />
    												</div>  
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-xl-3 col-sm-3 col-md-3 col-lg-3"></div>
                                                            
                                                        <div class="col-xl-9 col-sm-9 col-md-9 col-lg-9"><a href="#" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>How to add social networks</a></div>
                                                        
                                                    </div>                                                  
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Social Tab </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <div class="m-radio-inline">
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="social_status" {{($row['social_status'] == '0') ? " checked='checked' " : '' }} value="0">
    																Disable
    																<span></span>
    															</label>
    															<label class="m-radio m-radio--solid m-radio--brand">
    																<input type="radio" name="social_status" {{($row['social_status'] == '1') ? " checked='checked' " : " checked='checked' " }} value="1">
    																Enable
    																<span></span>
    															</label>
    														</div>
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Facebook </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_facebook', $row['social_facebook'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Twitter </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_twitter', $row['social_twitter'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Google+ </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_google', $row['social_google'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Youtube </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_youtube', $row['social_youtube'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Pinterest </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_pinterest', $row['social_pinterest'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Vimeo </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_vimeo', $row['social_vimeo'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                    
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-xl-3 col-lg-3 col-form-label"> Instagram </label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            {!! Form::text('social_instagram', $row['social_instagram'],array('class'=>'form-control m-input m-input--solid', 'placeholder'=>''  )) !!} 
                                                        </div>
                                                    </div>
                                                    
                                                       
                                                </div>                                                                                              
                                            </div>
    										<!--end: Form Wizard Step 3-->
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
@stop

{{-- For custom script --}}
@section('custom_js_script')
    @parent
    <script>
        var base_url = '{{ url() }}';
        /*Dropzone.autoDiscover = false;*/    
        $(document).ready( function () {  
            $(".select2").select2();
            
            $("#assigned_user_id").jCombo("{{ URL::to('properties/comboselect?filter=tb_users:id:first_name|last_name') }}",
                    {selected_value: '{{ $property_user }}'});
                    
            /* architecture video section */
            if ($("#architecture_displayupload").is(":checked"))
            { 
                $(".architecture_videotypeupload").show();
                $(".architecture_videotypelink").hide();
            }

            if ($("#architecture_displaylink").is(":checked"))
            {
                $(".architecture_videotypeupload").hide();
                $(".architecture_videotypelink").show();
            }
            $("input[name=architecture_video_type]").click(function(){
                if ($("#architecture_displayupload").is(":checked"))
                { 
                    $(".architecture_videotypeupload").show();
                    $(".architecture_videotypelink").hide();
                }
    
                if ($("#architecture_displaylink").is(":checked"))
                {
                    $(".architecture_videotypeupload").hide();
                    $(".architecture_videotypelink").show();
                }
            });
            
            chk_design();
            $("input[name=architecture_design_video_type]").click(function(){
                chk_design();
            });
            function chk_design(){                
                if($("#architecture_design_displayupload").is(":checked")){
                    $(".architecture_design_videotypeupload").show();
                    $(".architecture_design_videotypelink").hide();
                }
                if($("#architecture_design_displaylink").is(":checked")){
                    $(".architecture_design_videotypeupload").hide();
                    $(".architecture_design_videotypelink").show();
                }
            }

            chk_designer();
            $("input[name=architecture_designer_video_type]").click(function(){
                chk_designer();
            });
            function chk_designer(){         
                if($("#architecture_designer_displayupload").is(":checked")){
                    $(".architecture_designer_videotypeupload").show();
                    $(".architecture_designer_videotypelink").hide();
                }
                if($("#architecture_designer_displaylink").is(":checked")){
                    $(".architecture_designer_videotypeupload").hide();
                    $(".architecture_designer_videotypelink").show();
                }
            }
            
        });
    </script>
@endsection

@section('script')
    <script type="text/javascript">
        var activeTab = '@if($active_tab > 0){{$active_tab}}@else{{0}}@endif'; 
        activeTab = parseInt(activeTab);
        var prevTab = activeTab;
        activeTab++;
        var base_url = '{{ url() }}';
    </script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/property_update_wizard.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
