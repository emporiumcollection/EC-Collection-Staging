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
														Personal Information
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
														Personalized Preferences
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
                                            <!--begin: Form Wizard Step 1-->
    										<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
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
    														<input type="text" name="txtmobileNumber" id ="txtmobileNumber"  class="form-control dash-input-style" placeholder="Doe" value="{{ $user->mobile_number }}" readonly="readonly">
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
    														 Preferred Language
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<select class="form-control" id="prefer_communication_with" name="prefer_communication_with">
                                                                <option value="id">Bahasa Indonesia</option>
                                                                <option value="ms">Bahasa Melayu</option>
                                                                <option value="ca">Catal�</option>
                                                                <option value="da">Dansk</option>
                                                                <option value="de">Deutsch</option>
                                                                <option value="en" selected="selected">English</option>
                                                                <option value="es">Espa�ol</option>
                                                                <option value="el">E???????</option>
                                                                <option value="fr">Fran�ais</option>
                                                                <option value="hr">Hrvatski</option>
                                                                <option value="it">Italiano</option>
                                                                <option value="hu">Magyar</option>
                                                                <option value="nl">Nederlands</option>
                                                                <option value="no">Norsk</option>
                                                                <option value="pl">Polski</option>
                                                                <option value="pt">Portugu�s</option>
                                                                <option value="fi">Suomi</option>
                                                                <option value="sv">Svenska</option>
                                                                <option value="tr">T�rk�e</option>
                                                                <option value="is">�slenska</option>
                                                                <option value="cs">Ce�tina</option>
                                                                <option value="ru">???????</option>
                                                                <option value="th">???????</option>
                                                                <option value="zh">?? (??)</option>
                                                                <option value="zh-TW">?? (??)</option>
                                                                <option value="ja">???</option>
                                                                <option value="ko">???</option>
                                                            </select>
                                                            <span class="m-form__help">We'll send you messages in this language.</span>
    													</div>
    												</div>
                                					
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														 Preferred Currency
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<select class="form-control" id="preferred_currency" name="preferred_currency">
                                                                <option value="euro">Euro</option>
                                                                <option value="dollar">Dollar</option>
                                                            </select>
                                                            <span class="m-form__help">here we list our own list of currencies.</span>
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
                                                                                        echo '<option value="'.$destination->id.'">'.$destination->category_name.'</option>'.PHP_EOL;
                                                                                        if(!empty($destination->sub_destinations)) {
                                                                                            foreach ($destination->sub_destinations as $sub_destination) {
                                                                                                echo '<option value="'.$sub_destination->id.'">'.$sub_destination->category_name.'</option>'.PHP_EOL;
                                                                                                if(!empty($sub_destination->sub_destinations)) {
                                                                                                    foreach ($sub_destination->sub_destinations as $sub_dest) {
                                                                                                        echo '<option value="'.$sub_dest->id.'">'.$sub_dest->category_name.'</option>'.PHP_EOL;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
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
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                        <p class="sub-des-heading suggestions-headin-tittle">The following alternatives could be interesting:</p>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <ul class="personalized-suggestions-pannel-list-align">
                                                                            <?php
                                                                            if(!empty($destinations)) {
                                                                                foreach ($destinations as $destination) {
                                                                                    echo '<li><a href="#'.$destination->id.'">'.$destination->category_name.'</a></li>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-right">
                                                                        <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="personalized-pefrences m--hide">
                                                                <div class="row">
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                                    <h2 class="black-heading-big">Inspirations</h2>
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
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
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
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
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
                                                                        <textarea class="form-control ps-text-area-style" name="note" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon or your approximate travel budget." id="preferences_note"></textarea>
                                                                    </div> 
                                                                    
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 help-hover-icon">
                                                                        <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                                    </div>
                                                                
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
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
                                                                        <p class="sub-des-heading suggestions-headin-tittle spinner-label">toddlers</p>
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
                                                                
                                                            
                                                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
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
                                                                    </div>
                                                                    <div class="help-hover-icon">
                                                                        <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season." data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                                    </div>
                                                                
                                                                    <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
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
                                                            
                                                        </form>
                                                    
                                                    
                                                    
                                                                                    
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
    
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
@endsection

{{-- For custom script --}}
@section('custom_js_script')
    @parent
        <script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
        <script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
        <script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                // Multi Tab Form
                var current_fs, next_fs, previous_fs;
                var left, opacity, scale;
                var animating;

                $(".next").click(function () {                    
                    current_fs = $(this).closest( ".personalized-pefrences" );
                    next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
                    current_fs.addClass('m--hide');                    
                });

                $(".previous").click(function () {                    
                    current_fs = $(this).closest( ".personalized-pefrences" );
                    next_fs = $(current_fs).prev(".personalized-pefrences").removeClass('m--hide');                    
                    current_fs.addClass('m--hide');     
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
                console.log("pref");           
                
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
                
                var note = $("#preferences_note").text();
                console.log(destinations);
                console.log(insperations);
                console.log(experiences);
                
                
                
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
                
                var stay_time=[];
                $('#stay_time :selected').each(function(){
                     stay_time[$(this).val()]=$(this).text();
                });
                
                fdata.append("stay_time",stay_time);
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
                            window.location.href="{{URL::to('dashboard')}}";
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                }); 
           });
        });
    </script>
@endsection

@section('script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/traveller_wizard.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop