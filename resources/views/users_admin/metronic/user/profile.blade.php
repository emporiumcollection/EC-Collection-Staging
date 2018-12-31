@extends('users_admin.metronic.layouts.app')

@section('page_name')
    
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
            <span class="m-nav__link-text  breadcrumb-end"> Profile </span> 
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
        									Personal Info {{-- Lang::get('core.personalinfo') --}}
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#pass" role="tab">        									
                                            Change Password {{-- Lang::get('core.changepassword') --}}
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#company" role="tab">
        									Company Details {{-- Lang::get('core.companydetails') --}}
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
        										Email {{-- Lang::get('core.email') --}}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="email" type="text" id="email" class="form-control m-input" required  value="{{ $info->email }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										First name {{-- Lang::get('core.firstname') --}}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="first_name" type="text" id="first_name" class="form-control m-input" required  value="{{ $info->first_name }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Last name {{-- Lang::get('core.lastname') --}}
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
                                                <input type="file" name="avatar" class="form-control" />
                                        		Image Dimension 80 x 80 px <br />
                                                @if(!empty($info->avatar))
                                                {!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!}
                                                @endif
                                                <?php /* <div class="fileinput fileinput-new" data-provides="fileinput">
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
                                                </div> */ ?>
        									</div>
        								</div>
                                        
                                        
                                        <div class="form-group m-form__group row">
                                            <label for="ipt" class="col-sm-12 col-md-2 col-form-label">Contracts</label>
                                            <div class="col-sm-12 col-md-7">                                                
                                                <a href="{{ URL::to('signup-contract/view')}}" title="View" class="m-btn btn btn-primary" target="_blank"><i class="la la-eye"></i></a>
                                                <a href="{{ URL::to('signup-contract/download')}}" title="Download" class="m-btn btn btn-success" target="_blank"><i class="la la-file-pdf-o"></i></a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
        												Save Changes {{-- Lang::get('core.sb_savechanges') --}}
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
        										New Password {{-- Lang::get('core.newpassword') --}}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password" type="password" id="password" class="form-control m-input" required  value="" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Confirm Password {{-- Lang::get('core.conewpassword') --}}
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
        												Save Changes {{-- Lang::get('core.sb_savechanges') --}}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>   
                            		
                        		{!! Form::close() !!}
                            </div>
        					<div class="tab-pane " id="company">
                                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                                    <div class="tab-content">
                            			<div class="tab-pane active" id="company_tab_main">
                                        	<div class="m-portlet__head">
                            					<div class="m-portlet__head-tools">
                            						<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                            							<li class="nav-item m-tabs__item">
                            								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#company_tab_1" role="tab">
                            									<i class="flaticon-share m--hide"></i>
                            									Company Details
                            								</a>
                            							</li>
                            							<li class="nav-item m-tabs__item">
                            								<a class="nav-link m-tabs__link" data-toggle="tab" href="#company_tab_2" role="tab">
                            									Management Personnel
                            								</a>
                            							</li>
                            							
                            						</ul>
                            					</div>
                            				</div>
                                            <div class="tab-content">
                            					<div class="tab-pane active" id="company_tab_1">
                                                    {!! Form::open(array('url'=>'user/savecompanydetails/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                                                        <div class="m-portlet__body">
                                                            <input name="compedit_id" type="hidden" id="compedit_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Company Name
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_name" type="text" id="company_name" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_name; } ?>" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Company Owner
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_owner" type="text" id="company_owner" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_owner; } ?>" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Contact Person
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="contact_person" type="text" id="contact_person" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->contact_person; } ?>" />  
                                    									</div>
                                    								</div> 
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Company Email
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
                                    										Address
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_address" type="text" id="comapny_address" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_address; } ?>" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Address
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_address2" type="text" id="company_address2" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_address2; } ?>" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										City
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_city" type="text" id="comapny_city" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_city; } ?>" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Postal Code
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_postal_code" type="text" id="company_postal_code" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_postal_code; } ?>" maxlength="6" />  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Country
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="company_country" type="text" id="comapny_country" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->company_country; } ?>"/>  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Company/Group Logo
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                                                            <input type="file" name="company_logo" class="form-control" />
                                    										<?PHP /* <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            				  <span class="btn btn-primary btn-file">
                                                            					<span class="fileinput-new">Hochladen</span><span class="fileinput-exists">Change</span>
                                                            						<input type="file" name="company_logo">
                                                            					</span>
                                                            					<span class="fileinput-filename"></span>
                                                            					<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                            				</div>
                                                            				<br /> */ ?>
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
                                    										Tax Number
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="steuernummer" type="text" id="steuernummer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->steuernummer; } ?>"/>  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Tax ID
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="umsatzsteuer_id" type="text" id="umsatzsteuer_id" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->umsatzsteuer_id; } ?>"/>  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Executive Director
                                    									</label>
                                                                       
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="gesch&auml;ftsf&uuml;hrer" type="text" id="gesch&auml;ftsf&uuml;hrer" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->geschäftsführer; } ?>"/>  
                                    									</div>
                                    								</div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										Commercial Register
                                    									</label>
                                    									<div class="col-sm-12 col-md-7">
                                    										<input name="handelsregister" type="text" id="handelsregister" class="form-control m-input" required  value="<?php if(!empty($extra)) { echo $extra->handelsregister; } ?>"/>  
                                    									</div>
                                    								</div>
                                                                    <div class="form-group m-form__group row">
                                    									<label for="ipt" class="col-sm-12 col-md-5 col-form-label">
                                    										District Court
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
                                                
                                                <div class="tab-pane" id="company_tab_2">
                                                    {!! Form::open(array('url'=>'', 'class'=>'m-form m-form--fit m-form--label-align-right ', 'id'=>'frm_management_personnel' ,'files' => true)) !!}
                                                        <input name="manper_compedit_id" type="hidden" id="manper_compedit_id" value="<?php if(!empty($extra)) { echo $extra->id; } ?>" />
                                                        <div class="m-portlet__body">
                                                            
                                                            
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Last Name</th>
                                                                            <th>First Name</th>
                                                                            <th style="width: 100px;">Mr/Mrs</th>
                                                                            <th>Actual Job Title</th>
                                                                            <th>Email Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Managing Proprietor/Owner</td>
                                                                            <td><input type="text" name="managing_proprietor_last_name" id="managing_proprietor_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_proprietor_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="managing_proprietor_first_name" id="managing_proprietor_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_proprietor_last_name; } ?>"/></td>
                                                                            <td style="width: 100px;">
                                                                                <select name="managing_proprietor_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->managing_proprietor_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->managing_proprietor_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->managing_proprietor_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="managing_proprietor_job_title" id="managing_proprietor_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_proprietor_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="managing_proprietor_email_address" id="managing_proprietor_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_proprietor_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Managing Director</td>
                                                                            <td><input type="text" name="managing_director_last_name" id="managing_director_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_director_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="managing_director_first_name" id="managing_director_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_director_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="managing_director_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->managing_director_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->managing_director_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->managing_director_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="managing_director_job_title" id="managing_director_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_director_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="managing_director_email_address" id="managing_director_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->managing_director_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>General Manager</td>
                                                                            <td><input type="text" name="general_manager_last_name" id="general_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->general_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="general_manager_first_name" id="general_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->general_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="general_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->general_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->general_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->general_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="general_manager_job_title" id="general_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->general_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="general_manager_email_address" id="general_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->general_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director of Operations</td>
                                                                            <td><input type="text" name="director_of_operations_last_name" id="director_of_operations_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_operations_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_operations_first_name" id="director_of_operations_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_operations_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_of_operations_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_of_operations_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_of_operations_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_of_operations_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_of_operations_job_title" id="director_of_operations_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_operations_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_operations_email_address" id="director_of_operations_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_operations_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Executive Assistant Manager</td>
                                                                            <td><input type="text" name="executive_assistant_manager_last_name" id="executive_assistant_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->executive_assistant_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="executive_assistant_manager_first_name" id="executive_assistant_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->executive_assistant_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="executive_assistant_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->executive_assistant_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->executive_assistant_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->executive_assistant_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="executive_assistant_manager_job_title" id="executive_assistant_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->executive_assistant_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="executive_assistant_manager_email_address" id="executive_assistant_manager_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->executive_assistant_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director of Sales & Marketing</td>
                                                                            <td><input type="text" name="director_of_sales_marketing_last_name" id="director_of_sales_marketing_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_marketing_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_sales_marketing_first_name" id="director_of_sales_marketing_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_marketing_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_of_sales_marketing_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_of_sales_marketing_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_of_sales_marketing_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_of_sales_marketing_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_of_sales_marketing_job_title" id="director_of_sales_marketing_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_marketing_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_sales_marketing_email_address" id="director_of_sales_marketing_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_marketing_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director of Marketing</td>
                                                                            <td><input type="text" name="director_of_marketing_last_name" id="director_of_marketing_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_marketing_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_marketing_first_name" id="director_of_marketing_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_marketing_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_of_marketing_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_of_marketing_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_of_marketing_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_of_marketing_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_of_marketing_job_title" id="director_of_marketing_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_marketing_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_marketing_email_address" id="director_of_marketing_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_marketing_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director of Sales</td>
                                                                            <td><input type="text" name="director_of_sales_last_name" id="director_of_sales_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_sales_first_name" id="director_of_sales_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_of_sales_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_of_sales_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_of_sales_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_of_sales_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_of_sales_job_title" id="director_of_sales_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_sales_email_address" id="director_of_sales_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_sales_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sales Manager</td>
                                                                            <td><input type="text" name="sales_manager_last_name" id="sales_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->sales_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="sales_manager_first_name" id="sales_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->sales_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="sales_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->sales_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->sales_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->sales_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="sales_manager_job_title" id="sales_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->sales_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="sales_manager_email_address" id="sales_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->sales_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Group Sales Contact</td>
                                                                            <td><input type="text" name="group_sales_contact_last_name" id="group_sales_contact_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->group_sales_contact_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="group_sales_contact_first_name" id="group_sales_contact_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->group_sales_contact_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="group_sales_contact_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->group_sales_contact_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->group_sales_contact_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->group_sales_contact_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="group_sales_contact_job_title" id="group_sales_contact_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->group_sales_contact_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="group_sales_contact_email_address" id="group_sales_contact_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->group_sales_contact_email_address; } ?>"/></td>
                                                                        </tr>                                                                        
                                                                        <tr>
                                                                            <td>Leaders Club Contact</td>
                                                                            <td><input type="text" name="leaders_club_contact_last_name" id="leaders_club_contact_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->leaders_club_contact_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="leaders_club_contact_first_name" id="leaders_club_contact_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->leaders_club_contact_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="leaders_club_contact_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->leaders_club_contact_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->leaders_club_contact_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->leaders_club_contact_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="leaders_club_contact_job_title" id="leaders_club_contact_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->leaders_club_contact_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="leaders_club_contact_email_address" id="leaders_club_contact_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->leaders_club_contact_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Internal Public Relations Manager</td>
                                                                            <td><input type="text" name="internal_public_relations_manager_last_name" id="internal_public_relations_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->internal_public_relations_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="internal_public_relations_manager_first_name" id="internal_public_relations_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->internal_public_relations_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="internal_public_relations_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->internal_public_relations_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->internal_public_relations_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->internal_public_relations_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="internal_public_relations_manager_job_title" id="internal_public_relations_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->internal_public_relations_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="internal_public_relations_manager_email_address" id="internal_public_relations_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->internal_public_relations_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director of Rooms Division</td>
                                                                            <td><input type="text" name="director_of_rooms_division_last_name" id="director_of_rooms_division_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_rooms_division_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_rooms_division_first_name" id="director_of_rooms_division_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_rooms_division_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_of_rooms_division_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_of_rooms_division_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_of_rooms_division_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_of_rooms_division_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_of_rooms_division_job_title" id="director_of_rooms_division_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_rooms_division_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_of_rooms_division_email_address" id="director_of_rooms_division_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_of_rooms_division_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rooms Division Manager</td>
                                                                            <td><input type="text" name="rooms_division_manager_last_name" id="rooms_division_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->rooms_division_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="rooms_division_manager_first_name" id="rooms_division_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->rooms_division_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="rooms_division_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->rooms_division_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->rooms_division_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->rooms_division_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="rooms_division_manager_job_title" id="rooms_division_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->rooms_division_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="rooms_division_manager_email_address" id="rooms_division_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->rooms_division_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Director Yield & Revenue Management</td>
                                                                            <td><input type="text" name="director_yield_last_name" id="director_yield_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_yield_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="director_yield_first_name" id="director_yield_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_yield_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="director_yield_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->director_yield_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->director_yield_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->director_yield_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="director_yield_job_title" id="director_yield_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_yield_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="director_yield_email_address" id="director_yield_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->director_yield_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Revenue Manager</td>
                                                                            <td><input type="text" name="revenue_manager_last_name" id="revenue_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->revenue_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="revenue_manager_first_name" id="revenue_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->revenue_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="revenue_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->revenue_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->revenue_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->revenue_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="revenue_manager_job_title" id="revenue_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->revenue_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="revenue_manager_email_address" id="revenue_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->revenue_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Reservations Manager</td>
                                                                            <td><input type="text" name="reservations_manager_last_name" id="reservations_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reservations_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="reservations_manager_first_name" id="reservations_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reservations_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="reservations_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->reservations_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->reservations_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->reservations_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="reservations_manager_job_title" id="reservations_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reservations_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="reservations_manager_email_address" id="reservations_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reservations_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Front Office/Reception Manager</td>
                                                                            <td><input type="text" name="reception_manager_last_name" id="reception_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reception_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="reception_manager_first_name" id="reception_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reception_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="reception_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->reception_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->reception_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->reception_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="reception_manager_job_title" id="reception_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reception_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="reception_manager_email_address" id="reception_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->reception_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Concierge</td>
                                                                            <td><input type="text" name="concierge_last_name" id="concierge_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->concierge_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="concierge_first_name" id="concierge_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->concierge_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="concierge_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->concierge_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->concierge_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->concierge_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="concierge_job_title" id="concierge_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->concierge_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="concierge_email_address" id="concierge_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->concierge_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>LHW Spa Director Contact</td>
                                                                            <td><input type="text" name="lhw_spa_director_contact_last_name" id="lhw_spa_director_contact_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->lhw_spa_director_contact_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="lhw_spa_director_contact_first_name" id="lhw_spa_director_contact_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->lhw_spa_director_contact_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="lhw_spa_director_contact_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->lhw_spa_director_contact_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->lhw_spa_director_contact_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->lhw_spa_director_contact_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="lhw_spa_director_contact_job_title" id="lhw_spa_director_contact_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->lhw_spa_director_contact_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="lhw_spa_director_contact_email_address" id="lhw_spa_director_contact_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->lhw_spa_director_contact_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Spa Manager</td>
                                                                            <td><input type="text" name="spa_manager_last_name" id="spa_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->spa_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="spa_manager_first_name" id="spa_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->spa_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="spa_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->spa_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->spa_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->spa_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="spa_manager_job_title" id="spa_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->spa_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="spa_manager_email_address" id="spa_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->spa_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Chef</td>
                                                                            <td><input type="text" name="chef_last_name" id="chef_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->chef_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="chef_first_name" id="chef_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->chef_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="chef_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->chef_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->chef_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->chef_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="chef_job_title" id="chef_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->chef_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="chef_email_address" id="chef_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->chef_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Food & Beverage Manager</td>
                                                                            <td><input type="text" name="food_beverage_manager_last_name" id="food_beverage_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->food_beverage_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="food_beverage_manager_first_name" id="food_beverage_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->food_beverage_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="food_beverage_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->food_beverage_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->food_beverage_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->food_beverage_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="food_beverage_manager_job_title" id="food_beverage_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->food_beverage_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="food_beverage_manager_email_address" id="food_beverage_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->food_beverage_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Purchasing Manager</td>
                                                                            <td><input type="text" name="purchasing_manager_last_name" id="purchasing_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->purchasing_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="purchasing_manager_first_name" id="purchasing_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->purchasing_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="purchasing_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->purchasing_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->purchasing_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->purchasing_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="purchasing_manager_job_title" id="purchasing_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->purchasing_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="purchasing_manager_email_address" id="purchasing_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->purchasing_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Controller</td>
                                                                            <td><input type="text" name="controller_last_name" id="controller_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->controller_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="controller_first_name" id="controller_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->controller_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="controller_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->controller_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->controller_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->controller_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="controller_job_title" id="controller_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->controller_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="controller_email_address" id="controller_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->controller_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Credit Manager</td>
                                                                            <td><input type="text" name="credit_manager_last_name" id="credit_manager_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->credit_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="credit_manager_first_name" id="credit_manager_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->credit_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="credit_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->credit_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->credit_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->credit_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="credit_manager_job_title" id="credit_manager_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->credit_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="credit_manager_email_address" id="credit_manager_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->credit_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Human Resources Manager</td>
                                                                            <td><input type="text" name="human_resources_manager_last_name" id="human_resources_last_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->human_resources_manager_last_name; } ?>"/></td>
                                                                            <td><input type="text" name="human_resources_manager_first_name" id="human_resources_first_name" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->human_resources_manager_first_name; } ?>"/></td>
                                                                            <td>
                                                                                <select name="human_resources_manager_title" class="form-control m-input">
                                                                                    <option value="Mr" <?php if(!empty($extra)){ echo $extra->human_resources_manager_title=="Mr" ? 'selected="selected"' : ''; } ?>>Mr.</option>
                                                                                    <option value="Mrs" <?php if(!empty($extra)){ echo $extra->human_resources_manager_title=="Mrs" ? 'selected="selected"' : ''; } ?>>Mrs.</option>
                                                                                    <option value="Miss" <?php if(!empty($extra)){ echo $extra->human_resources_manager_title=="Miss" ? 'selected="selected"' : ''; } ?>>Miss</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="human_resources_manager_job_title" id="human_resources_job_title" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->human_resources_manager_job_title; } ?>"/></td>
                                                                            <td><input type="text" name="human_resources_manager_email_address" id="human_resources_email_address" class="form-control m-input" value="<?php if(!empty($extra)) { echo $extra->human_resources_manager_email_address; } ?>"/></td>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            
                                                            
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
                                                
                                                <div class="tab-pane" id="company_tab_3">
                                                          
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                
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
    {{--*/ 
		usort($contracts, function($a, $b) {
			return $a->sort_num - $b->sort_num; 
		});
        
        $contracts = array_reverse($contracts);
        
        $final_contracts = array();
        foreach($contracts as $sicc){
            if(!isset($userContracts[$sicc->contract_id])){ $tempobj = $sicc; $tempobj->already_done = false; }else{ $tempobj = $userContracts[$sicc->contract_id]; $tempobj->already_done = true; }
            if(isset($tempobj->contract_id)){$final_contracts[] = $tempobj;}
        }
        
	/*--}}
    <div class="modal fade" id="contract_model" tabindex="-1" role="dialog" aria-labelledby="contractModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="contractModalLabel">
    					Contracts
    				</h5>
    				{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						�
    					</span>
    				</button>--}}
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        {{--<div class="m-portlet__head"></div>--}}
                        
                        <div class="m-portlet__body">
                            <div class="m-accordion m-accordion--default m-accordion--solid" id="contract_accordion" role="tablist">
                                
                                <!-- contracts start -->
                                {{--*/ $new_contract_ava = false; /*--}}
                                @foreach($final_contracts as $si_contract)
                                {{--*/ $alreadyAccepted = (bool) $si_contract->already_done; $is_agree = (bool) ((isset($si_contract->is_agree))?$si_contract->is_agree:false);  /*--}}
                                {{--*/ if($alreadyAccepted !== true){ $new_contract_ava = true; } /*--}}
                                    <div class="m-accordion__item {{(($alreadyAccepted === true)?(($is_agree === true)?'m-accordion__item--success':'m-accordion__item--danger'):'')}}">
                                        <div class="m-accordion__item-head collapsed" role="tab" id="contract_accordion_item_{{$si_contract->contract_id}}_head" data-toggle="collapse" href="#contract_accordion_item_{{$si_contract->contract_id}}_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><span class="m-switch m-switch--sm {{(($alreadyAccepted === true)?'m-switch--outline m-switch--icon m-switch--success':'m-switch--icon m-switch--info')}}"><label><input type="checkbox" name="accepted_contracts[]" value="{{$si_contract->contract_id}}" class="{{(($alreadyAccepted === true)?'rad_user_contracts':'rad_contracts')}} {{(((bool) $si_contract->is_required  == true)?'rad_required':'')}}" {{(($is_agree === true)?'checked="checked"':'')}} {{(($alreadyAccepted === true)?'disabled="disabled"':'')}} /><span></span></label></span></span>
                                            <span class="m-accordion__item-title">{{$si_contract->title}} <?php echo (((bool) $si_contract->is_required  == true)?'<span class="text-danger">*</span>':''); ?></span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        
                                        <div class="m-accordion__item-body collapse" id="contract_accordion_item_{{$si_contract->contract_id}}_body" role="tabpanel" aria-labelledby="contract_accordion_item_{{$si_contract->contract_id}}_head" data-parent="#contract_accordion">
                                            <div class="m-accordion__item-content">
                                                <?php echo $si_contract->description; ?>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- contracts end -->
                            </div>
                        </div>
                    </div>                				
    			</div>
    			<div class="modal-footer">
    				{{--<button type="button" class="btn btn-secondary" id="contractclosebtn" data-dismiss="modal">Close</button>--}}
                    <button type="button" class="btn btn-primary" id="contractacceptbtn">Save</button>
    			</div>
    		</div>
    	</div>
    </div>
    @endif
    
@stop

@section('custom_js_script')
<script src="{{ asset('sximo/js/jquery.validate.js')}}"></script>
<script>
$(document).ready(function(){  
    
    $('#frm_management_personnel').validate({
    	submitHandler: function (form) {
    		 $.ajax({
                url:"{{URL::to('save_management_personnel')}}",
                type:'POST',
                dataType:'json',
                data:$(form).serializeArray(),                   
                success:function(response){
                    if(response.status == 'success'){
                        toastr.success(response.message);                        
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            });
    		return false;
    	}
    
    });
   $("#contractacceptbtn").click(function(e){
        e.preventDefault();
        
        var btnObj = $(this);
        btnObj.addClass('m-loader m-loader--right');
        btnObj.html('Saving...');
        btnObj.prop('disabled',true);
        var is_runajax = true;
        var agreedval = new Array();
        var disagreedval = new Array();
        $("input.rad_contracts").each(function(){
            var pr = true;
            if($(this).is(":checked") === false){ pr = false; if($(this).hasClass('rad_required')){ is_runajax = false; } }
            
            if(pr === true){ agreedval.push($(this).val()); }
            else{disagreedval.push($(this).val());}            
        });
        
        //run ajax if user will accept all required contracts
        if((is_runajax === true) && ((agreedval.length > 0) || (disagreedval.length > 0))){
            $.ajax({
        	  url: "{{ URL::to('user/acceptcontracts')}}",
        	  type: "post",
        	  data: {"agree_contracts":agreedval,"disagree_contracts":disagreedval},
        	  dataType: "json",
        	  success: function(data){
                if(data.status == "fail"){
                    toastr.error(data.message); 
                    btnObj.removeClass('m-loader m-loader--right');
                    btnObj.html('Save');
                    btnObj.prop('disabled',false);
                }else
                {
                    toastr.success(data.message);
                    $('#contract_model').modal("hide");
                }
        	  },
              error: function(e){
                toastr.error("Unexpected error occured, Please try again after some time!");  
                btnObj.removeClass('m-loader m-loader--right');
                btnObj.html('Save'); 
              }
        	});
        }else
        {
            toastr.error("Please accept all required contracts!");  
            btnObj.removeClass('m-loader m-loader--right');
            btnObj.html('Save'); 
            btnObj.prop('disabled',false);
        }
        //End
        return false;
   });
   
   @if($new_contract_ava === true)
   $('#contract_model').modal({backdrop: 'static', keyboard: false, show: true});
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