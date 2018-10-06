@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Account  <small>View Detail My Info</small>
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
        @if(Session::has('message'))	  
    		   {!! Session::get('message') !!}
    	@endif
        
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
		<div class="col-xl-3 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<div class="m-card-profile__title m--hide">
							Your Profile
						</div>
						<div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
								{!! SiteHelpers::avatarProfile(80,80,'') !!}
							</div>
						</div>
						<div class="m-card-profile__details">
							<span class="m-card-profile__name">
								{{ Session::get('fid') }}
							</span>
							<a href="#" onclick="return false;" class="m-card-profile__email m-link">
								{{ Session::get('eid') }}
							</a>
						</div>
					</div>
                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary m-nav m-nav--hover-bg m-portlet-fit--sides _nav-profile" role="tablist">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
						<li class="m-nav__section m--hide">
							<span class="m-nav__section-text">
								Section
							</span>
						</li>
						<li class="m-nav__item nav-item m-tabs__item">
                            <a href="#myprofile" class="m-nav__link nav-link m-tabs__link active" data-toggle="tab" role="tab">
								<i class="m-nav__link-icon flaticon-profile-1"></i>
								<span class="m-nav__link-title">
									<span class="m-nav__link-wrap">
										<span class="m-nav__link-text">
											{{ Lang::get('core.m_profile') }}
										</span>
										<?php /*<span class="m-nav__link-badge">
											<span class="m-badge m-badge--success">
												2
											</span>
										</span> */ ?>
									</span>
								</span>
							</a>
						</li>
						<li class="m-nav__item nav-item m-tabs__item" style="display: none;">
                            <a href="#slider-ad" class="m-nav__link nav-link m-tabs__link" data-toggle="tab" role="tab">
								<i class="m-nav__link-icon flaticon-coins"></i>
								<span class="m-nav__link-text">
									{{ Lang::get('core.user_slider_ads') }}
								</span>
							</a>
						</li>
						<li class="m-nav__item nav-item m-tabs__item" style="display: none;">
                            <a href="#sidebar-ad" class="m-nav__link nav-link m-tabs__link" data-toggle="tab" role="tab">
								<i class="m-nav__link-icon flaticon-coins"></i>
								<span class="m-nav__link-text">
									{{ Lang::get('core.user_sidebar_ads') }}
								</span>
							</a>
						</li>
					</ul>
					<div class="clearfix"></div>
					<div class="m-portlet__body-separator"></div>
                    <?php /**
					<div class="m-widget1 m-widget1--paddingless">
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Member Profit
									</h3>
									<span class="m-widget1__desc">
										Awerage Weekly Profit
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-brand">
										+$17,800
									</span>
								</div>
							</div>
						</div>
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Orders
									</h3>
									<span class="m-widget1__desc">
										Weekly Customer Orders
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-danger">
										+1,800
									</span>
								</div>
							</div>
						</div>
						<div class="m-widget1__item">
							<div class="row m-row--no-padding align-items-center">
								<div class="col">
									<h3 class="m-widget1__title">
										Issue Reports
									</h3>
									<span class="m-widget1__desc">
										System bugs and issues
									</span>
								</div>
								<div class="col m--align-right">
									<span class="m-widget1__number m--font-success">
										-27,49%
									</span>
								</div>
							</div>
						</div>
					</div>
                    **/ ?>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="tab-content">
        			<div class="tab-pane active" id="myprofile">
                    	<div class="m-portlet__head">
        					<div class="m-portlet__head-tools">
        						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#info" role="tab">
        									<i class="flaticon-share m--hide"></i>
        									{{ Lang::get('core.personalinfo') }}
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#pass" role="tab">
        									{{ Lang::get('core.changepassword') }}
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#company" role="tab">
        									{{ Lang::get('core.companydetails') }}
        								</a>
        							</li>
        						</ul>
        					</div>
        				</div>
        				<div class="tab-content">
        					<div class="tab-pane active" id="info">
                                {!! Form::open(array('url'=>'user/saveprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Username
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="username" type="text" id="username" class="form-control m-input" disabled="disabled" required  value="{{ $info->username }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.email') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="email" type="text" id="email" class="form-control m-input" required  value="{{ $info->email }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.firstname') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="first_name" type="text" id="first_name" class="form-control m-input" required  value="{{ $info->first_name }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.lastname') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="last_name" type="text" id="last_name" class="form-control m-input" required  value="{{ $info->last_name }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Avatar
        									</label>
        									<div class="col-sm-12 col-md-7">
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
                                        			{!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!}
                                                </div>
        									</div>
        								</div>
                                        
                                        @if((count($contracts) > 0) || (count($userContracts) > 0))
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">Contracts</label>
        									<div class="col-sm-12 col-md-7">
                                                <div class="m-form__group-sub">
                                                    <div class="m-checkbox-inline">
                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                            <input type="checkbox" name="accept_contract" value="1" required="required" /> Please accept contracts first.<span></span>
                                                        </label>
                                                    </div>
                                                    <span class="m-form__help"><a href="#" onclick="javascript: return false;" data-toggle="modal" data-target="#contract_model">View contract</a></span>
                                                </div>
        									</div>
        								</div>
                                        @endif
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>  
                        		  
                        		{!! Form::close() !!}
        					</div>
        					<div class="tab-pane " id="pass">
                                {!! Form::open(array('url'=>'user/savepassword/', 'class'=>'m-form m-form--fit m-form--label-align-right ')) !!}
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.newpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password" type="password" id="password" class="form-control m-input" required  value="" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.conewpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password_confirmation" type="password" id="password_confirmation" class="form-control m-input" required  value="" />  
        									</div>
        								</div> 
                            		</div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-danger m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>   
                            		
                        		{!! Form::close() !!}
                            </div>
        					<div class="tab-pane " id="company">
                                {!! Form::open(array('url'=>'user/savecompanydetails/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                                    <div class="m-portlet__body">
                                        <input name="compedit_id" type="hidden" id="compedit_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Firmenname
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_name" type="text" id="company_name" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Inhaber
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_owner" type="text" id="company_owner" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Ansprechpartner
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="contact_person" type="text" id="contact_person" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" />  
                									</div>
                								</div> 
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										E-Mail Adresse
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_email" type="text" id="company_email" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_email; } ?>" />  
                									</div>
                								</div> 
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Phone #
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_phone" type="text" id="company_phone" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_phone; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Website
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_website" type="text" id="company_website" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_website; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Tax #
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_tax_no" type="text" id="company_tax_no" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_tax_number; } ?>" />  
                									</div>
                								</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Adresse
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_address" type="text" id="comapny_address" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_address; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Adresse
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_address2" type="text" id="company_address2" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_address2; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										ORT
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_city" type="text" id="comapny_city" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_city; } ?>" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Pin
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_postal_code" type="text" id="company_postal_code" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_postal_code; } ?>" maxlength="6" />  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Land
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="company_country" type="text" id="comapny_country" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_country; } ?>"/>  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Firmenlogo
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<div class="fileinput fileinput-new" data-provides="fileinput">
                                        				  <span class="btn btn-primary btn-file">
                                        					<span class="fileinput-new">Hochladen</span><span class="fileinput-exists">Change</span>
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
                								</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 tax-minhead">
                                                <span class="minhead">Tax Info</span>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Steuernummer
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="steuernummer" type="text" id="steuernummer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>"/>  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Umsatzsteuer ID
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="umsatzsteuer_id" type="text" id="umsatzsteuer_id" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>"/>  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Gesch&auml;ftsf&uuml;hrer
                									</label>
                                                   
                									<div class="col-sm-12 col-md-7">
                										<input name="gesch&auml;ftsf&uuml;hrer" type="text" id="gesch&auml;ftsf&uuml;hrer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>"/>  
                									</div>
                								</div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Handelsregister
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="handelsregister" type="text" id="handelsregister" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>"/>  
                									</div>
                								</div>
                                                <div class="form-group m-form__group row">
                									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                										Amtsgericht
                									</label>
                									<div class="col-sm-12 col-md-7">
                										<input name="amtsgericht" type="text" id="amtsgericht" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->amtsgericht; } ?>" maxlength="6"/>  
                									</div>
                								</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										
        										<div class="col-sm-12 col-md-12 text-center">
        											<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div> 
                                {!! Form::close() !!}
                            </div>
        				</div>
                    </div><!-- // myprofile -->
                    <div class="tab-pane" id="slider-ad">
                        {!! Form::open(array('url'=>'adspayment', 'class'=>'m-form m-form--fit m-form--label-align-right ','id'=>'sliderads' ,'files' => true)) !!}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
    								<div class="col-12 ml-auto">
    									<h3>Slider Advertisement Costs you {{(!empty($slider_ads_price))? $def_currency->content.$slider_ads_price->content:''}} and is valid for {{(!empty($slider_ads_expiry_days))?$slider_ads_expiry_days->content:''}} days.</h3>
    								</div>
    							</div>
                                
                                <input name="adscurrency" type="hidden" class="form-control input-sm" value="{{$def_currency->content}}"/> 
                                <input name="adsType" type="hidden" class="form-control input-sm" value="slider"/> 
                        		<input name="adsprice" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_price))? $slider_ads_price->content:''}}"/>
                                <input name="adsvalidation" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_expiry_days))?$slider_ads_expiry_days->content:''}}"/> 
                        		<input name="advedit_id" type="hidden" class="form-control input-sm" value="{{(!empty($slider_ads_info))?$slider_ads_info->id:''}}"/> 
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_image') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-primary btn-file">
                            			  	  <span class="fileinput-new">Hochladen</span>
                                              @if(!empty(@$slider_ads_info->adv_img))
                                                <span class="fileinput-exists"> Change</span>
                                              @endif
                                              <input type="file" name="advertise_img"/>
                            				</span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                            <br />
                                			@if(!empty($slider_ads_info))
                            					{!! SiteHelpers::showUploadedFile($slider_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                            				  @endif
                                        </div>
    								</div>
    							</div> 
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_link') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adslink" type="text" id="adslink" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_link:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_title') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adstitle" type="text" id="adstitle" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_title:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_description') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adsdesc" type="text" id="adsdesc" class="form-control m-input" required  value="{{(!empty($slider_ads_info))?$slider_ads_info->adv_desc:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_category') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
                                        <select name="ads_slider_cat" required class="form-control">
                        					<option value="">-- Select --</option>
                        					<option value="Hotel" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Hotel")?'selected="selected"':''}}>Hotel</option>
                        					<option value="Villas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Villas")?'selected="selected"':''}}>Villas</option>
                        					<option value="Yachts" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Yachts")?'selected="selected"':''}}>Yachts</option>
                        					<option value="Safari Lodges" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Safari Lodges")?'selected="selected"':''}}>Safari Lodges</option>
                        					<option value="Spas" {{(!empty($slider_ads_info) && $slider_ads_info->ads_slider_cat=="Spas")?'selected="selected"':''}}>Spas</option>
                        				</select>
    								</div>
    							</div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-sm-12 col-md-2"></div>
										<div class="col-sm-12 col-md-7">
                                            <?php $curdate = date('Y-m-d'); 
					if((!empty($slider_ads_info) && $slider_ads_info->adv_expire>=$curdate) || (!empty($slider_ads_price) && $slider_ads_price->content==0)){ ?>
    											<input name="pay" type="hidden" class="form-control input-sm" value="no"/> 
                                                <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
    												{{ Lang::get('core.sb_savechanges') }}
    											</button>
                                                <button type="button" class="btn btn-danger m-btn m-btn--air m-btn--custom" onclick="deleteAds({{(!empty($slider_ads_info))?$slider_ads_info->id:''}},'sliderads');">
    												{{ Lang::get('core.btn_remove') }}
    											</button>
                                            <?php } else { ?>
                                                <input name="pay" type="hidden" class="form-control input-sm" value="yes"/>
                                                <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
    												{{ Lang::get('core.sb_payment') }}
    											</button> 
                                            <?php } ?>
										</div>
									</div>
								</div>
							</div>
		                {!! Form::close() !!}  
                    </div>
                    <div class="tab-pane tive" id="sidebar-ad">
                        {!! Form::open(array('url'=>'adspayment', 'class'=>'m-form m-form--fit m-form--label-align-right ','id'=>'sidebarads' ,'files' => true)) !!}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
    								<div class="col-12 ml-auto">
    									<h3>Sidebar Advertisement Costs you {{(!empty($sidebar_ads_price))? $def_currency->content.$sidebar_ads_price->content:''}} and is valid for {{(!empty($sidebar_ads_expiry_days))?$sidebar_ads_expiry_days->content:''}} days.</h3>
    								</div>
    							</div>
                                <input name="adscurrency" type="hidden" class="form-control input-sm" value="{{$def_currency->content}}"/> 
		  
                                <input name="adsType" type="hidden" class="form-control input-sm" value="sidebar"/> 
                                
                                <input name="adsprice" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_price))? $sidebar_ads_price->content:''}}"/> 
                                
                                <input name="adsvalidation" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_expiry_days))?$sidebar_ads_expiry_days->content:''}}"/> 
                                
                                <input name="advedit_id" type="hidden" class="form-control input-sm" value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->id:''}}"/>
                                
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_image') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-primary btn-file">
                            			  	  <span class="fileinput-new">Hochladen</span>
                                              @if(!empty(@$sidebar_ads_info->adv_img))
                                                <span class="fileinput-exists"> Change</span>
                                              @endif
                                              <input type="file" name="advertise_img"/>
                            				</span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                            <br />
                                			@if(!empty($sidebar_ads_info))
                            					{!! SiteHelpers::showUploadedFile($sidebar_ads_info->adv_img,'/uploads/users/advertisement/',155, 150, '') !!}
                            				  @endif
                                        </div>
    								</div>
    							</div> 
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_link') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adslink" type="text" id="side_adslink" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_link:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_title') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adstitle" type="text" id="side_adstitle" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_title:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_description') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<input name="adsdesc" type="text" id="side_adsdesc" class="form-control m-input" required  value="{{(!empty($sidebar_ads_info))?$sidebar_ads_info->adv_desc:''}}" />  
    								</div>
    							</div>
                                <div class="form-group m-form__group row">
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_category') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<select name="adsCat" class="form-control">
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
    								<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
    									{{ Lang::get('core.ads_position') }}
    								</label>
    								<div class="col-sm-12 col-md-7">
    									<select name="adspos" required class="form-control">
                        					<option value="">-- Select --</option>
                        					<option value="landing" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="landing")?'selected="selected"':''}}>landing Page Sidebar</option>
                        					<option value="grid_sidebar" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_sidebar")?'selected="selected"':''}}>Grid Page Sidebar</option>
                        					<option value="grid_results" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="grid_results")?'selected="selected"':''}}>Grid Page Results </option>
                        					<option value="detail" {{(!empty($sidebar_ads_info) && $sidebar_ads_info->adv_position=="detail")?'selected="selected"':''}}>Detail Page Sidebar </option>
                        				</select>
    								</div>
    							</div>
                           </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-sm-12 col-md-2"></div>
										<div class="col-sm-12 col-md-7">
                                            <?php $curdate = date('Y-m-d'); 
					                               if((!empty($sidebar_ads_info) && $sidebar_ads_info->adv_expire>=$curdate) || (!empty($sidebar_ads_price) && $sidebar_ads_price->content==0)){ ?>
                                                        <input name="pay" type="hidden" class="form-control input-sm" value="no"/>
                                                        <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
            												{{ Lang::get('core.sb_savechanges') }}
            											</button> 
                                                        <button type="button" class="btn btn-danger m-btn m-btn--air m-btn--custom" onclick="deleteAds({{(!empty($sidebar_ads_info))?$sidebar_ads_info->id:''}},'sidebarads');">
            												{{ Lang::get('core.btn_remove') }}
            											</button> 
                                                   <?php } else { ?>
                                                        <input name="pay" type="hidden" class="form-control input-sm" value="yes"/>
                                                        <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
            												{{ Lang::get('core.sb_payment') }}
            											</button> 
                                                   <?php } ?>
										</div>
									</div>
								</div>
							</div>
		                {!! Form::close() !!} 
                    </div>
                </div><!-- /tab-content -->
			</div><!-- //tabs -->

		</div>
	</div>
    {{--*/ $new_contract_ava = false; /*--}}
    @if((count($contracts) > 0) || (count($userContracts) > 0))
    <div class="modal fade" id="contract_model" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Contracts
    				</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						�
    					</span>
    				</button>
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        {{--<div class="m-portlet__head"></div>--}}
                        
                        <div class="m-portlet__body">
                            <div class="m-accordion m-accordion--default m-accordion--solid" id="contract_accordion" role="tablist">
                                <!-- already accepted contracts start -->
                                @foreach($userContracts as $si_contract)
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                            <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract already_accepted text-success"><i class="r-icon-tag la la-unlock"></i></a></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $si_contract->description; ?>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- already accepted contracts end -->
                                
                                <!-- new contracts start -->
                                @foreach($contracts as $si_contract)
                                    @if(!isset($userContracts[$si_contract->contract_id]))
                                        {{--*/ $new_contract_ava = true; /*--}}
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa flaticon-list-3"></i></span>
                                            <span class="m-accordion__item-title">{{$si_contract->title}} <a href="#" class="si_accept_contract text-danger"><i class="r-icon-tag la la-close"></i></a></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $si_contract->description; ?>
                                            </div>
                                        </div>
                                    </div>    
                                    @endif                                    
                                @endforeach
                                <!-- new contracts end -->
                            </div>
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" id="contractclosebtn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="contractacceptbtn">Accept</button>
    			</div>
    		</div>
    	</div>
    </div>
    @endif
    
@stop

@section('custom_js_script')
<script>
function removeAndAddIcons(thisObj,isAdd){
    if(isAdd === true){
        thisObj.removeClass('text-danger');
        thisObj.addClass('text-success');
        
        thisObj.find('.r-icon-tag').removeClass('la-close');
        thisObj.find('.r-icon-tag').addClass('la-check');
    }else{
        thisObj.removeClass('text-success');
        thisObj.addClass('text-danger');
        
        thisObj.find('.r-icon-tag').removeClass('la-check');
        thisObj.find('.r-icon-tag').addClass('la-close');
    }
}

$(document).ready(function(){
    var ischeckedaccepeted = true;
    $(".si_accept_contract").each(function(){
        if($(this).hasClass('text-danger')){ ischeckedaccepeted = false; }
    });
    if(ischeckedaccepeted === true){
        if($('[name="accept_contract"]').is(":checked") === false){ $('[name="accept_contract"]').closest('label').trigger('click'); }
    }else
    {
        if($('[name="accept_contract"]').is(":checked") === true){ $('[name="accept_contract"]').closest('label').trigger('click'); }
    }
    
    $('#contract_model').on('show.bs.modal', function (e) {
      // do something...
      if($('[name="accept_contract"]').is(":checked") === true){ $(".si_accept_contract").not('.already_accepted').each(function(){removeAndAddIcons($(this),true);}); }else{ $(".si_accept_contract").not('.already_accepted').each(function(){removeAndAddIcons($(this),false);}); }
    });
    
    $(".si_accept_contract").click(function(e){
        e.preventDefault();
        
        if($(this).hasClass('text-danger')){ removeAndAddIcons($(this),true); }else{ removeAndAddIcons($(this),false); }
        
        
        var ischecked = true;
        $(".si_accept_contract").each(function(){
            if($(this).hasClass('text-danger')){ ischecked = false; }
        });
        
        if(ischecked === true){
            $("#contractacceptbtn").trigger('click');
        }else
        {
            if($('[name="accept_contract"]').is(":checked") === true){ $('[name="accept_contract"]').closest('label').trigger('click'); }
        }
        
        return false;
    });
    
   $("#contractacceptbtn").click(function(e){
        e.preventDefault();
        
        $(".si_accept_contract").each(function(){
            removeAndAddIcons($(this),true);
        });
        
        if($('[name="accept_contract"]').is(":checked") === false){ $('[name="accept_contract"]').closest('label').trigger('click'); }
        $("#contractclosebtn").trigger('click');
        
        return false;
   });
   
   @if($new_contract_ava === true)
   $('#contract_model').modal('show')
   @endif
});

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