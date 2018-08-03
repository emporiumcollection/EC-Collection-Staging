@extends('users_admin.traveller.layouts.app')

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
					<div class="m-wizard m-wizard--3 m-wizard--success" id="m_traveller_wizard">
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
    														<input type="text" name="first_name" id="first_name" class="form-control dash-input-style" placeholder="John" required="" value="{{ $info->first_name }}">
    													</div>
    												</div>
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Last Name
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="last_name" id ="last_name"  class="form-control dash-input-style" placeholder="Doe" value="{{ $info->last_name }}" required="">
                                                            <span class="m-form__help">Your public profile only shows your first name. When you request a booking, your Hotel of choice will see your first and last name.</span>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    														Email
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="email" id ="email"  class="form-control dash-input-style" placeholder="Doe" value="{{ $info->email }}" readonly="readonly">
                                                            <span class="m-form__help"></span>
    													</div>
    												</div>
                                                    
                                                    <div class="form-group m-form__group row">
    													<label class="col-xl-3 col-lg-3 col-form-label">
    													   Phone Number	
    													</label>
    													<div class="col-xl-9 col-lg-9">
    														<input type="text" name="txtmobileNumber" id ="txtmobileNumber"  class="form-control dash-input-style" placeholder="Doe" value="{{ $info->mobile_number }}" readonly="readonly">
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
                                                                <option value="euro">Male</option>
                                                                <option value="dollar">Female</option>
                                                                <option value="dollar">Other</option>
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
                                                                <option value="ca">Català</option>
                                                                <option value="da">Dansk</option>
                                                                <option value="de">Deutsch</option>
                                                                <option value="en" selected="selected">English</option>
                                                                <option value="es">Español</option>
                                                                <option value="el">E???????</option>
                                                                <option value="fr">Français</option>
                                                                <option value="hr">Hrvatski</option>
                                                                <option value="it">Italiano</option>
                                                                <option value="hu">Magyar</option>
                                                                <option value="nl">Nederlands</option>
                                                                <option value="no">Norsk</option>
                                                                <option value="pl">Polski</option>
                                                                <option value="pt">Português</option>
                                                                <option value="fi">Suomi</option>
                                                                <option value="sv">Svenska</option>
                                                                <option value="tr">Türkçe</option>
                                                                <option value="is">Íslenska</option>
                                                                <option value="cs">Ceština</option>
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
@stop

@section('custom_js_script')    
<script>
$('input[type="checkbox"][id="copyadd"]').on('ifChecked', function(){
	$('#billing_address').val($('#shipping_address').val());
	$('#billing_address2').val($('#shipping_address2').val());
	$('#billing_city').val($('#shipping_city').val());
	$('#billing_postal_code').val($('#shipping_postal_code').val());
	$('#billing_country').val($('#shipping_country').val());
});

function fillProfile(obj)
{
	var custid = $(obj).val();
	$.ajax({
	  url: "{{ URL::to('getUserprofile')}}",
	  type: "post",
	  data: "customer="+custid,
	  dataType: "json",
	  success: function(data){
		if(data!='error')
		{
			$('#company_phone').val(data.phone);
			$('#company_email').val(data.email);
			$('#company_postal_code').val(data.zip);
			$('#comapny_address').val(data.street);
			$('#company_name').val(data.shoptitle);
			$('#company_city').val(data.city);
		}
	  }
	});
}

function deleteAds(ads_id, formid)
{
	if(ads_id!='')
	{
		var confirmd = confirm("{{ Lang::get('core.ads_delete_confirm_msg') }}");
		if(confirmd==true)
		{
			$.ajax({
			  url: "{{ URL::to('deleteUserAds')}}",
			  type: "post",
			  data: "adsId="+ads_id,
			  dataType: "json",
			  success: function(data){
				if(data!='error')
				{
					$('#'+formid)[0].reset();
				}
				else{
					alert('No Advertisement Found');
				}
			  }
			});
		}
	}
}
</script>
@stop

@section('script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/traveller_wizard.js') }}"></script>
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
@stop
